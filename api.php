<?php
header("Content-Type: application/json; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("X-Content-Type-Options: nosniff");

$requestOrigin = trim((string) ($_SERVER["HTTP_ORIGIN"] ?? ""));
$allowedOrigins = ["https://langzio.com", "https://www.langzio.com"];
if ($requestOrigin !== "" && in_array($requestOrigin, $allowedOrigins, true)) {
    header("Access-Control-Allow-Origin: " . $requestOrigin);
    header("Access-Control-Allow-Credentials: true");
}
header("Vary: Origin");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, X-CSRF-Token");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(204);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
    exit;
}

require_once "config.php";
require_once "classes/Auth.php";
require_once "includes/langzio-ai.php";
require_once "classes/TranslationHistory.php";

if (!Auth::check()) {
    http_response_code(401);
    echo json_encode(["error" => "Login required"]);
    exit;
}

langzio_rate_limit_check(60);

$rawInput = file_get_contents("php://input");
$payload = json_decode($rawInput, true);

if (!is_array($payload)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON payload"]);
    exit;
}

$csrfToken = $_SERVER["HTTP_X_CSRF_TOKEN"] ?? ($payload["csrf_token"] ?? null);
if (!Auth::verifyCsrf(is_string($csrfToken) ? $csrfToken : null)) {
    http_response_code(419);
    echo json_encode([
        "error" => "Invalid security token",
        "csrf_token" => Auth::csrfToken(),
    ]);
    exit;
}

$mode = $payload["mode"] ?? "translate";
$user = Auth::user();

if ($mode === "history") {
    echo json_encode(["history" => TranslationHistory::listForUser((int) $user["id"])]);
    exit;
}

if ($mode === "delete_history") {
    $historyId = filter_var($payload["id"] ?? null, FILTER_VALIDATE_INT);
    if (!$historyId) {
        http_response_code(422);
        echo json_encode(["error" => "Invalid history item"]);
        exit;
    }
    echo json_encode(["deleted" => TranslationHistory::deleteForUser((int) $user["id"], $historyId)]);
    exit;
}

$userText = trim((string) ($payload["text"] ?? ""));
$source = trim((string) ($payload["source"] ?? "english"));
$target = trim((string) ($payload["target"] ?? "darija"));
$history = is_array($payload["history"] ?? null) ? $payload["history"] : [];

if ($userText === "") {
    http_response_code(422);
    echo json_encode(["error" => "Text is required"]);
    exit;
}

if (strlen($userText) > 10000) {
    http_response_code(413);
    echo json_encode(["error" => "Input too long (max 10000 characters)"]);
    exit;
}

if (preg_match('/[\x00-\x08\x0E-\x1F]|\.(png|jpg|jpeg|gif|bmp|webp|svg)/i', $userText)) {
    http_response_code(400);
    echo json_encode(["error" => "Text input only. Images are not supported."]);
    exit;
}

// RAG grounding first, then provider when configured, else local fallback.
$ragContext = langzio_rag_context($userText);
$ragUsed = $ragContext !== "";

if (empty(OPENAI_API_KEY)) {
    if ($mode === "chat") {
        $fallback = langzio_local_chat_reply($userText, $ragContext);
    } else {
        $fallback = langzio_local_translate_reply($userText, $source, $target, $ragContext);
    }
    if ($mode === "translate") {
        TranslationHistory::add((int) $user["id"], $source, $target, $userText, $fallback, null);
    }
    echo json_encode(["reply" => $fallback, "mock" => true, "rag_used" => $ragUsed]);
    exit;
}

if ($mode === "chat") {
    $messages = langzio_build_chat_messages($userText, $history, $ragContext);
    $result = langzio_call_ai($messages, 0.5);

    if (!$result["ok"]) {
        echo json_encode([
            "reply" => langzio_local_chat_reply($userText, $ragContext),
            "mock" => true,
            "degraded" => true,
            "error" => "AI service temporarily unavailable; showing local guidance.",
            "rag_used" => $ragUsed,
        ]);
        exit;
    }

    echo json_encode([
        "reply" => $result["content"],
        "mock" => false,
        "rag_used" => $ragUsed,
    ]);
    exit;
}

$messages = langzio_build_translate_messages($userText, $source, $target, $ragContext);
$result = langzio_call_ai($messages, 0.3);

if (!$result["ok"]) {
    $fallback = langzio_local_translate_reply($userText, $source, $target, $ragContext);
    TranslationHistory::add((int) $user["id"], $source, $target, $userText, $fallback, null);
    echo json_encode([
        "reply" => $fallback,
        "mock" => true,
        "degraded" => true,
        "error" => "AI service temporarily unavailable; showing local guidance.",
        "rag_used" => $ragUsed,
    ]);
    exit;
}

$structured = langzio_parse_structured_translation($result["content"]);
if ($structured !== null) {
    $reply = langzio_format_structured_reply($structured);
    TranslationHistory::add((int) $user["id"], $source, $target, $userText, $reply, $structured);
    echo json_encode([
        "reply" => $reply,
        "structured" => $structured,
        "mock" => false,
        "rag_used" => $ragUsed,
    ]);
    exit;
}

TranslationHistory::add((int) $user["id"], $source, $target, $userText, $result["content"], null);
echo json_encode([
    "reply" => $result["content"],
    "mock" => false,
    "rag_used" => $ragUsed,
]);

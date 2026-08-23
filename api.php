<?php
header("Content-Type: application/json; charset=utf-8");
header("X-Content-Type-Options: nosniff");

$allowedOrigin = (!empty($_SERVER["HTTP_HOST"]) && $_SERVER["HTTP_HOST"] !== "localhost")
    ? "https://" . $_SERVER["HTTP_HOST"]
    : "*";
header("Access-Control-Allow-Origin: " . $allowedOrigin);
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

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
require_once "includes/langzio-ai.php";

langzio_rate_limit_check(60);

$rawInput = file_get_contents("php://input");
$payload = json_decode($rawInput, true);

if (!is_array($payload)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON payload"]);
    exit;
}

$mode = $payload["mode"] ?? "translate";
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

if (empty(OPENAI_API_KEY)) {
    $fallback = $mode === "chat"
        ? "Demo mode — add GROQ_API_KEY in .env on the server to enable real AI.\n\nFor now: start with \"Salam\" and use \"3afak\" to soften requests."
        : "Demo translation ({$source} → {$target}): {$userText}";
    echo json_encode(["reply" => $fallback, "mock" => true]);
    exit;
}

$ragContext = langzio_rag_context($userText);
$ragUsed = $ragContext !== "";

if ($mode === "chat") {
    $messages = langzio_build_chat_messages($userText, $history, $ragContext);
    $result = langzio_call_ai($messages, 0.5);

    if (!$result["ok"]) {
        http_response_code(500);
        echo json_encode(["error" => $result["error"]]);
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
    http_response_code(500);
    echo json_encode(["error" => $result["error"]]);
    exit;
}

$structured = langzio_parse_structured_translation($result["content"]);
if ($structured !== null) {
    echo json_encode([
        "reply" => langzio_format_structured_reply($structured),
        "structured" => $structured,
        "mock" => false,
        "rag_used" => $ragUsed,
    ]);
    exit;
}

echo json_encode([
    "reply" => $result["content"],
    "mock" => false,
    "rag_used" => $ragUsed,
]);

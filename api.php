<?php
header("Content-Type: application/json; charset=utf-8");
header("X-Content-Type-Options: nosniff");

$allowedOrigin = "https://langzio.com";
header("Access-Control-Allow-Origin: " . $allowedOrigin);
header("Vary: Origin");
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

// Local mode: answers come from the verified phrase corpus.
// No external AI provider, no API keys.
$ragContext = langzio_rag_context($userText);
$ragUsed = $ragContext !== "";

if ($mode === "chat") {
    echo json_encode([
        "reply" => langzio_local_chat_reply($userText, $ragContext),
        "mock" => true,
        "rag_used" => $ragUsed,
    ]);
    exit;
}

echo json_encode([
    "reply" => langzio_local_translate_reply($userText, $source, $target, $ragContext),
    "mock" => true,
    "rag_used" => $ragUsed,
]);

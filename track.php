<?php
header("Content-Type: application/json; charset=utf-8");
header("X-Content-Type-Options: nosniff");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
    exit;
}

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/includes/langzio-ai.php";

langzio_rate_limit_check(120);

$payload = json_decode((string) file_get_contents("php://input"), true);
if (!is_array($payload)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON"]);
    exit;
}

$event = preg_replace('/[^a-z0-9_]/', '', strtolower((string) ($payload["event"] ?? "")));
if ($event === "") {
    http_response_code(422);
    echo json_encode(["error" => "Event required"]);
    exit;
}

$dir = __DIR__ . "/data/events";
if (!is_dir($dir)) {
    @mkdir($dir, 0755, true);
}

$record = [
    "ts" => gmdate("c"),
    "event" => $event,
    "page" => substr((string) ($payload["page"] ?? ""), 0, 120),
    "meta" => is_array($payload["meta"] ?? null) ? $payload["meta"] : [],
];

$file = $dir . "/" . gmdate("Y-m-d") . ".jsonl";
file_put_contents($file, json_encode($record) . PHP_EOL, FILE_APPEND | LOCK_EX);

if ($event === "waitlist_join") {
    $email = trim((string) ($payload["email"] ?? ""));
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $waitlistFile = __DIR__ . "/data/waitlist.jsonl";
        file_put_contents(
            $waitlistFile,
            json_encode(["ts" => gmdate("c"), "email" => $email]) . PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }
}

echo json_encode(["ok" => true]);

<?php
header("Content-Type: application/json; charset=utf-8");
header("X-Content-Type-Options: nosniff");

require_once __DIR__ . "/config.php";

echo json_encode([
    "env_file_found" => is_readable(__DIR__ . "/.env"),
    "api_ready" => !empty(GROQ_API_KEY),
    "model" => GROQ_MODEL,
], JSON_PRETTY_PRINT);

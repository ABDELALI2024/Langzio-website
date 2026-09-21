<?php
header("Content-Type: application/json; charset=utf-8");
header("X-Content-Type-Options: nosniff");

require_once __DIR__ . "/config.php";

echo json_encode([
    "ok" => true,
    "api_ready" => !empty(GROQ_API_KEY),
], JSON_PRETTY_PRINT);

<?php
header("Content-Type: application/json; charset=utf-8");
header("X-Content-Type-Options: nosniff");

require_once __DIR__ . "/config.php";

echo json_encode([
    "ok" => true,
    "mode" => "local",
], JSON_PRETTY_PRINT);

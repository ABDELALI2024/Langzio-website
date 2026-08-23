<?php
require_once __DIR__ . "/../../classes/Auth.php";

Auth::requireLogin();
$userId = Auth::id();

header("Content-Type: application/json");

$clientId = langzio_env("PAYPAL_CLIENT_ID", "");
$secret   = langzio_env("PAYPAL_SECRET", "");

if ($clientId === "" || $secret === "") {
    http_response_code(500);
    echo json_encode(["error" => "PayPal not configured"]);
    exit;
}

$ch = curl_init("https://api-m.paypal.com/v2/checkout/orders");
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERPWD        => $clientId . ":" . $secret,
    CURLOPT_HTTPHEADER     => [
        "Content-Type: application/json",
        "PayPal-Request-Id: " . bin2hex(random_bytes(8)),
    ],
    CURLOPT_POSTFIELDS => json_encode([
        "intent" => "CAPTURE",
        "purchase_units" => [[
            "reference_id" => "pro_monthly",
            "description"  => "Langzio Pro — Monthly",
            "amount" => [
                "currency_code" => "USD",
                "value"         => "9.00",
            ],
        ]],
        "payer" => [
            "email_address" => Auth::user()["email"] ?? "",
        ],
    ]),
    CURLOPT_TIMEOUT => 30,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode >= 400) {
    http_response_code(500);
    echo json_encode(["error" => "PayPal API error"]);
    exit;
}

$data = json_decode($response, true);
echo json_encode(["orderID" => $data["id"] ?? ""]);

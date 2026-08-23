<?php
require_once __DIR__ . "/../../classes/Auth.php";
require_once __DIR__ . "/../../classes/Subscription.php";

Auth::requireLogin();
$userId = Auth::id();

header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
$orderId = trim($input["orderID"] ?? "");

if ($orderId === "") {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => "Missing order ID"]);
    exit;
}

$clientId = langzio_env("PAYPAL_CLIENT_ID", "");
$secret   = langzio_env("PAYPAL_SECRET", "");

$ch = curl_init("https://api-m.paypal.com/v2/checkout/orders/{$orderId}/capture");
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERPWD        => $clientId . ":" . $secret,
    CURLOPT_HTTPHEADER     => ["Content-Type: application/json"],
    CURLOPT_POSTFIELDS     => "{}",
    CURLOPT_TIMEOUT        => 30,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode >= 400) {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "Capture failed"]);
    exit;
}

$data = json_decode($response, true);
$status = $data["status"] ?? "";

if ($status === "COMPLETED") {
    Subscription::activatePro($userId, "", $orderId);

    try {
        $whatsapp = new WhatsAppNotificationService();
        $user = Auth::user();
        $whatsapp->paymentSuccess($userId, $user["name"]);
    } catch (\Exception $e) {
        error_log("WhatsApp payment notification failed: " . $e->getMessage());
    }

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Payment not completed"]);
}

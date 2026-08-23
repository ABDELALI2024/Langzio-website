<?php
require_once __DIR__ . "/../../classes/Auth.php";
require_once __DIR__ . "/../../classes/Subscription.php";

Auth::requireLogin();
$userId = Auth::id();

header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
$subId = trim($input["subscriptionID"] ?? "");

if ($subId === "") {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => "Missing subscription ID"]);
    exit;
}

Subscription::activatePro($userId, $subId, "");

try {
    $whatsapp = new WhatsAppNotificationService();
    $user = Auth::user();
    $whatsapp->paymentSuccess($userId, $user["name"]);
} catch (\Exception $e) {
    error_log("WhatsApp payment notification failed: " . $e->getMessage());
}

echo json_encode(["success" => true]);

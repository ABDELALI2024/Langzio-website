<?php
require_once __DIR__ . "/../../classes/Auth.php";
require_once __DIR__ . "/../../classes/Subscription.php";

Auth::requireLogin();
$userId = Auth::id();

header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
$subId = trim($input["subscriptionID"] ?? "");

if ($subId === "" || !preg_match('/^[A-Za-z0-9_-]{1,100}$/', $subId)) {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => "Missing subscription ID"]);
    exit;
}

// Server-side verification with PayPal: do NOT trust the browser alone.
$clientId = langzio_env("PAYPAL_CLIENT_ID", "");
$secret = langzio_env("PAYPAL_SECRET", "");
if ($clientId === "" || $secret === "") {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "PayPal not configured"]);
    exit;
}

$tokenCh = curl_init("https://api-m.paypal.com/v1/oauth2/token");
curl_setopt_array($tokenCh, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERPWD => $clientId . ":" . $secret,
    CURLOPT_HTTPHEADER => ["Accept: application/json"],
    CURLOPT_POSTFIELDS => "grant_type=client_credentials",
    CURLOPT_TIMEOUT => 15,
]);
$tokenResp = curl_exec($tokenCh);
$tokenCode = (int) curl_getinfo($tokenCh, CURLINFO_HTTP_CODE);
curl_close($tokenCh);
$tokenData = json_decode((string) $tokenResp, true);
$accessToken = $tokenData["access_token"] ?? "";
if ($tokenCode >= 400 || $accessToken === "") {
    error_log("Langzio PayPal token failed for user " . $userId);
    http_response_code(502);
    echo json_encode(["success" => false, "error" => "PayPal verification failed"]);
    exit;
}

$subCh = curl_init("https://api-m.paypal.com/v1/billing/subscriptions/" . urlencode($subId));
curl_setopt_array($subCh, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer " . $accessToken,
    ],
    CURLOPT_TIMEOUT => 15,
]);
$subResp = curl_exec($subCh);
$subCode = (int) curl_getinfo($subCh, CURLINFO_HTTP_CODE);
curl_close($subCh);
$subData = json_decode((string) $subResp, true);
$status = strtoupper((string) ($subData["status"] ?? ""));
if ($subCode >= 400 || !in_array($status, ["ACTIVE", "APPROVAL_PENDING", "APPROVED"], true)) {
    error_log("Langzio PayPal subscription invalid: " . $subId . " status=" . $status);
    http_response_code(402);
    echo json_encode(["success" => false, "error" => "Subscription not active"]);
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

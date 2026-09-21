<?php
// Langzio dev seeder — LOCAL ONLY. Blocked in production via .htaccess.
// Defense-in-depth: allow CLI, or HTTP only with valid CRON_SECRET key.
require_once __DIR__ . "/config.php";
if (php_sapi_name() !== "cli") {
    $secret = langzio_env("CRON_SECRET", "");
    if ($secret === "" || ($_GET["key"] ?? "") !== $secret) {
        http_response_code(404);
        exit;
    }
}
require_once __DIR__ . "/classes/User.php";
require_once __DIR__ . "/classes/Subscription.php";

$email = "test@langzio.com";
$existing = User::findByEmail($email);
if ($existing) {
    echo "Test user already exists. Login with: test@langzio.com / test1234";
    exit;
}

$user = User::create("Test User", $email, "test1234");
Subscription::createTrial((int) $user["id"]);

echo "Test user created successfully!<br>";
echo "Email: test@langzio.com<br>";
echo "Password: test1234<br>";
echo "<a href='login.php'>Go to Login</a>";

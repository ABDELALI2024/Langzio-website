<?php
/**
 * Langzio Trial Reminder Scheduler
 *
 * Run daily via Hostinger Cron Job:
 *   /usr/bin/php /home/u12345/public_html/cron/trial-reminders.php
 *
 * Or via wget:
 *   wget -q --delete-after https://langzio.com/cron/trial-reminders.php?key=YOUR_CRON_SECRET
 */

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../classes/Database.php";
require_once __DIR__ . "/../classes/Subscription.php";
require_once __DIR__ . "/../classes/WhatsAppNotificationService.php";

$secret = langzio_env("CRON_SECRET", "");
if ($secret !== "" && ($_GET["key"] ?? "") !== $secret) {
    http_response_code(403);
    die("Forbidden");
}

$whatsapp = new WhatsAppNotificationService();

if (!$whatsapp->isConfigured()) {
    echo "WhatsApp not configured.\n";
    exit;
}

// ─── Remind users 3 days before trial ends ───────────────────
$users3days = Subscription::getUsersWithExpiringTrial(3);
foreach ($users3days as $user) {
    try {
        $whatsapp->trialReminder3Days((int) $user["id"], $user["name"], 3);
        echo "Reminded (3d): {$user["email"]}\n";
    } catch (\Exception $e) {
        echo "Error ({$user["email"]}): {$e->getMessage()}\n";
    }
}

// ─── Remind users 1 day before trial ends ───────────────────
$users1day = Subscription::getUsersWithExpiringTrial(1);
foreach ($users1day as $user) {
    try {
        $whatsapp->trialReminder1Day((int) $user["id"], $user["name"], 1);
        echo "Reminded (1d): {$user["email"]}\n";
    } catch (\Exception $e) {
        echo "Error ({$user["email"]}): {$e->getMessage()}\n";
    }
}

// ─── Handle expired trials ───────────────────────────────────
$expired = Subscription::getUsersWithExpiredTrial();
foreach ($expired as $user) {
    try {
        Subscription::expireTrial((int) $user["id"]);
        $whatsapp->trialExpired((int) $user["id"], $user["name"]);
        echo "Expired: {$user["email"]}\n";
    } catch (\Exception $e) {
        echo "Error ({$user["email"]}): {$e->getMessage()}\n";
    }
}

echo "Done.\n";

<?php

require_once __DIR__ . "/Database.php";

class Subscription
{
    public static function createTrial(int $userId): array
    {
        $db = Database::connect();
        $trialDays = (int) langzio_env("TRIAL_DAYS", "7");

        $stmt = $db->prepare("
            INSERT INTO subscriptions (user_id, plan, status, trial_ends_at)
            VALUES (:uid, 'trial', 'active', DATE_ADD(NOW(), INTERVAL :days DAY))
        ");
        $stmt->execute(["uid" => $userId, "days" => $trialDays]);

        return self::current($userId);
    }

    public static function current(int $userId): ?array
    {
        $db   = Database::connect();
        $stmt = $db->prepare("
            SELECT * FROM subscriptions
            WHERE user_id = :uid
            ORDER BY id DESC
            LIMIT 1
        ");
        $stmt->execute(["uid" => $userId]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function isTrialActive(int $userId): bool
    {
        $sub = self::current($userId);
        if (!$sub || $sub["status"] !== "active") return false;
        if ($sub["plan"] !== "trial") return false;
        if ($sub["trial_ends_at"] === null) return false;
        return strtotime($sub["trial_ends_at"]) > time();
    }

    public static function isSubscribed(int $userId): bool
    {
        $sub = self::current($userId);
        if (!$sub || $sub["status"] !== "active") return false;
        if ($sub["plan"] === "trial") return self::isTrialActive($userId);
        if ($sub["plan"] === "lifetime") return true;
        if ($sub["plan"] === "pro" && $sub["current_period_ends_at"] !== null) {
            return strtotime($sub["current_period_ends_at"]) > time();
        }
        return false;
    }

    public static function trialDaysRemaining(int $userId): int
    {
        $sub = self::current($userId);
        if (!$sub || !$sub["trial_ends_at"]) return 0;
        $diff = strtotime($sub["trial_ends_at"]) - time();
        return max(0, (int) ceil($diff / 86400));
    }

    public static function activatePro(int $userId, string $paypalSubId = "", string $paypalOrderId = ""): void
    {
        $db = Database::connect();
        $stmt = $db->prepare("
            INSERT INTO subscriptions (user_id, plan, status, current_period_ends_at, paypal_subscription_id, paypal_order_id)
            VALUES (:uid, 'pro', 'active', DATE_ADD(NOW(), INTERVAL 1 MONTH), :psub, :porder)
        ");
        $stmt->execute([
            "uid"    => $userId,
            "psub"   => $paypalSubId,
            "porder" => $paypalOrderId,
        ]);
    }

    public static function cancel(int $userId): void
    {
        $db = Database::connect();
        $stmt = $db->prepare("
            UPDATE subscriptions SET status = 'cancelled', cancelled_at = NOW()
            WHERE user_id = :uid AND status = 'active'
        ");
        $stmt->execute(["uid" => $userId]);
    }

    public static function getUsersWithExpiringTrial(int $daysLeft): array
    {
        $db   = Database::connect();
        $stmt = $db->prepare("
            SELECT u.*, s.trial_ends_at, s.id AS sub_id
            FROM subscriptions s
            JOIN users u ON u.id = s.user_id
            WHERE s.plan = 'trial'
              AND s.status = 'active'
              AND s.trial_ends_at IS NOT NULL
              AND DATEDIFF(s.trial_ends_at, NOW()) = :days
        ");
        $stmt->execute(["days" => $daysLeft]);
        return $stmt->fetchAll();
    }

    public static function getUsersWithExpiredTrial(): array
    {
        $db   = Database::connect();
        $stmt = $db->prepare("
            SELECT u.*, s.trial_ends_at
            FROM subscriptions s
            JOIN users u ON u.id = s.user_id
            WHERE s.plan = 'trial'
              AND s.status = 'active'
              AND s.trial_ends_at IS NOT NULL
              AND s.trial_ends_at <= NOW()
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function expireTrial(int $userId): void
    {
        $db = Database::connect();
        $stmt = $db->prepare("
            UPDATE subscriptions SET status = 'expired' WHERE user_id = :uid AND plan = 'trial' AND status = 'active'
        ");
        $stmt->execute(["uid" => $userId]);
    }

    public static function createFreePlan(int $userId): void
    {
        $db = Database::connect();
        $stmt = $db->prepare("
            INSERT INTO subscriptions (user_id, plan, status)
            VALUES (:uid, 'free', 'active')
        ");
        $stmt->execute(["uid" => $userId]);
    }
}

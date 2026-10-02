<?php

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/User.php";
require_once __DIR__ . "/Subscription.php";

class Auth
{
    public static function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params([
                "lifetime" => 0,
                "path"     => "/",
                "secure"   => (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || (($_SERVER["HTTP_X_FORWARDED_PROTO"] ?? "") === "https"),
                "httponly" => true,
                "samesite" => "Lax",
            ]);
            session_start();
        }
        if (!empty($_SESSION["logged_in_at"]) && (time() - (int) $_SESSION["logged_in_at"]) > 86400) {
            self::logout();
        }
    }

    public static function csrfToken(): string
    {
        self::startSession();
        if (empty($_SESSION["csrf_token"])) {
            $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
        }
        return (string) $_SESSION["csrf_token"];
    }

    public static function verifyCsrf(?string $token): bool
    {
        self::startSession();
        $headerToken = $_SERVER["HTTP_X_CSRF_TOKEN"] ?? null;
        $token = $token ?? (is_string($headerToken) ? $headerToken : null);
        return is_string($token) && $token !== "" && !empty($_SESSION["csrf_token"]) && hash_equals((string) $_SESSION["csrf_token"], $token);
    }

    public static function requireCsrf(): void
    {
        if (!self::verifyCsrf($_POST["csrf_token"] ?? null)) {
            http_response_code(419);
            exit("Invalid security token.");
        }
    }

    public static function login(int $userId): void
    {
        self::startSession();
        $_SESSION["user_id"] = $userId;
        $_SESSION["logged_in_at"] = time();
        session_regenerate_id(true);
    }

    public static function logout(): void
    {
        self::startSession();
        $_SESSION = [];
        $params = session_get_cookie_params();
        setcookie(session_name(), "", [
            "expires" => time() - 3600,
            "path" => $params["path"],
            "domain" => $params["domain"],
            "secure" => $params["secure"],
            "httponly" => $params["httponly"],
            "samesite" => $params["samesite"] ?? "Lax",
        ]);
        session_destroy();
    }

    public static function user(): ?array
    {
        self::startSession();
        $id = $_SESSION["user_id"] ?? null;
        if (!$id) return null;
        return User::findById((int) $id);
    }

    public static function id(): ?int
    {
        self::startSession();
        $id = $_SESSION["user_id"] ?? null;
        return $id ? (int) $id : null;
    }

    public static function check(): bool
    {
        return self::id() !== null;
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            $redirect = langzio_url("login.php");
            header("Location: " . $redirect);
            exit;
        }
    }

    public static function requireTrialOrSubscribed(): void
    {
        self::requireLogin();
        $uid = self::id();
        if (Subscription::isTrialActive($uid) || Subscription::isSubscribed($uid)) {
            return;
        }
        $redirect = langzio_url("pricing.php");
        header("Location: " . $redirect);
        exit;
    }

    public static function isTrialActive(): bool
    {
        $uid = self::id();
        return $uid !== null && Subscription::isTrialActive($uid);
    }

    public static function isSubscribed(): bool
    {
        $uid = self::id();
        return $uid !== null && Subscription::isSubscribed($uid);
    }

    public static function trialDaysRemaining(): int
    {
        $uid = self::id();
        return $uid ? Subscription::trialDaysRemaining($uid) : 0;
    }

    public static function subscriptionStatus(): array
    {
        $uid = self::id();
        if (!$uid) {
            return ["plan" => "none", "status" => "guest", "days_remaining" => 0];
        }
        $sub = Subscription::current($uid);
        if (!$sub) {
            return ["plan" => "none", "status" => "unassigned", "days_remaining" => 0];
        }
        return [
            "plan"           => $sub["plan"],
            "status"         => $sub["status"],
            "trial_ends_at"  => $sub["trial_ends_at"],
            "days_remaining" => Subscription::trialDaysRemaining($uid),
            "is_trial"       => self::isTrialActive(),
            "is_subscribed"  => self::isSubscribed(),
        ];
    }

    public static function redirectIfLoggedIn(): void
    {
        if (self::check()) {
            $redirect = langzio_url("dashboard.php");
            header("Location: " . $redirect);
            exit;
        }
    }
}

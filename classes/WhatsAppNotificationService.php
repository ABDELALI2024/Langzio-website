<?php

class WhatsAppNotificationService
{
    private string $apiUrl;
    private string $apiKey;
    private string $provider;
    private string $fromNumber;

    public function __construct()
    {
        $this->provider   = langzio_env("WHATSAPP_PROVIDER", "ultramsg");
        $this->apiKey     = langzio_env("WHATSAPP_API_KEY", "");
        $this->fromNumber = langzio_env("WHATSAPP_FROM", "");

        switch ($this->provider) {
            case "ultramsg":
                $instanceId = langzio_env("ULTRAMSG_INSTANCE", "");
                $this->apiUrl = "https://api.ultramsg.com/{$instanceId}/messages/chat";
                break;
            case "wati":
                $this->apiUrl = "https://live-mt.wati.io/api/v1/sendTemplateMessage";
                break;
            case "twilio":
                $accountSid  = langzio_env("TWILIO_SID", "");
                $this->apiUrl = "https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Messages.json";
                break;
            default:
                $this->apiUrl = "";
        }
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== "" && $this->apiUrl !== "";
    }

    public function send(int $userId, string $template, array $data = []): bool
    {
        $phone = User::fullPhoneNumber($userId);
        if (!$phone || !$this->isConfigured()) {
            return false;
        }

        $message = $this->buildMessage($template, $data);
        $sent    = $this->sendHttp($phone, $message);

        $this->logNotification($userId, $template, $phone, $message, $sent);
        return $sent;
    }

    // ─── Public notification triggers ───────────────────────────

    public function welcome(int $userId, string $name, int $trialDays): void
    {
        $this->send($userId, "welcome", [
            "name"       => $name,
            "trial_days" => (string) $trialDays,
        ]);
    }

    public function trialStarted(int $userId, string $name, string $endDate): void
    {
        $this->send($userId, "trial_started", [
            "name"     => $name,
            "end_date" => $endDate,
        ]);
    }

    public function trialReminder3Days(int $userId, string $name, int $daysLeft): void
    {
        $this->send($userId, "trial_reminder_3days", [
            "name"      => $name,
            "days_left" => (string) $daysLeft,
        ]);
    }

    public function trialReminder1Day(int $userId, string $name, int $daysLeft): void
    {
        $this->send($userId, "trial_reminder_1day", [
            "name"      => $name,
            "days_left" => (string) $daysLeft,
        ]);
    }

    public function trialExpired(int $userId, string $name): void
    {
        $pricingUrl = langzio_url("pricing.php");
        $this->send($userId, "trial_expired", [
            "name"        => $name,
            "pricing_url" => $pricingUrl,
        ]);
    }

    public function paymentSuccess(int $userId, string $name): void
    {
        $this->send($userId, "payment_success", [
            "name" => $name,
        ]);
    }

    public function customNotification(int $userId, string $name, string $customMessage): void
    {
        $phone = User::fullPhoneNumber($userId);
        if (!$phone || !$this->isConfigured()) return;

        $sent = $this->sendHttp($phone, $customMessage);
        $this->logNotification($userId, "custom", $phone, $customMessage, $sent);
    }

    // ─── Private helpers ────────────────────────────────────────

    private function buildMessage(string $template, array $data): string
    {
        $templates = self::getTemplates();

        if (!isset($templates[$template])) {
            return $data["fallback"] ?? "Notification from Langzio.";
        }

        $message = $templates[$template];
        foreach ($data as $key => $value) {
            $message = str_replace("{{" . $key . "}}", $value, $message);
        }

        return $message;
    }

    public function sendDirect(string $phone, string $message): bool
    {
        if (!$this->isConfigured()) return false;
        $sent = $this->sendHttp($phone, $message);
        $this->logNotification(0, "direct", $phone, $message, $sent);
        return $sent;
    }

    public static function getTemplates(): array
    {
        return [
            "welcome" => "*Langzio* 🇲🇦\n\nSalam {{name}}! Welcome to Langzio!\n\nYour free {{trial_days}}-day trial is now active. Start translating Darija and exploring Moroccan culture instantly.\n\nhttps://langzio.com/dashboard.php",

            "trial_started" => "*Langzio* 🇲🇦\n\nSalam {{name}}! Your free trial has started.\n\nYou have full access until {{end_date}}. Make the most of it!\n\nhttps://langzio.com/translator.php",

            "trial_reminder_3days" => "*Langzio* 🇲🇦\n\nSalam {{name}}! Just a reminder — your free trial ends in *{{days_left}} days*.\n\nUpgrade to Pro to keep unlimited access:\nhttps://langzio.com/pricing.php",

            "trial_reminder_1day" => "*Langzio* 🇲🇦\n\nSalam {{name}}! Your free trial ends *tomorrow*.\n\nDon't lose access — upgrade now:\nhttps://langzio.com/pricing.php",

            "trial_expired" => "*Langzio* 🇲🇦\n\nSalam {{name}}! Your free trial has ended.\n\nYou can upgrade to Pro and continue translating Darija, chatting about Moroccan culture, and using all features:\n{{pricing_url}}",

            "payment_success" => "*Langzio* 🇲🇦\n\nSalam {{name}}! Your payment was successful — welcome to Langzio Pro!\n\nYou now have unlimited access to all features. Shukran bzzaf for your support!\n\nhttps://langzio.com/dashboard.php",

            "verify_whatsapp" => "*Langzio* 🇲🇦\n\nSalam! Your verification code is: *{{code}}*\n\nEnter this code in the app to verify your WhatsApp number.\n\n— Langzio team",
        ];
    }

    private function sendHttp(string $phone, string $message): bool
    {
        try {
            switch ($this->provider) {
                case "ultramsg":
                    return $this->sendUltraMsg($phone, $message);
                case "wati":
                    return $this->sendWati($phone, $message);
                case "twilio":
                    return $this->sendTwilio($phone, $message);
                default:
                    return false;
            }
        } catch (\Exception $e) {
            error_log("WhatsApp send error: " . $e->getMessage());
            return false;
        }
    }

    private function sendUltraMsg(string $phone, string $message): bool
    {
        $ch = curl_init($this->apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ["Content-Type: application/x-www-form-urlencoded"],
            CURLOPT_POSTFIELDS     => http_build_query([
                "token" => $this->apiKey,
                "to"    => $phone,
                "body"  => $message,
            ]),
            CURLOPT_TIMEOUT => 15,
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode >= 200 && $httpCode < 300;
    }

    private function sendWati(string $phone, string $message): bool
    {
        $ch = curl_init($this->apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                "Authorization: Bearer " . $this->apiKey,
                "Content-Type: application/json",
            ],
            CURLOPT_POSTFIELDS => json_encode([
                "to"             => $phone,
                "template_name"  => "langzio_notification",
                "parameters"     => [["text" => $message]],
            ]),
            CURLOPT_TIMEOUT => 15,
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode >= 200 && $httpCode < 300;
    }

    private function sendTwilio(string $phone, string $message): bool
    {
        $accountSid = langzio_env("TWILIO_SID", "");
        $authToken  = $this->apiKey;

        $ch = curl_init("https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Messages.json");
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD        => $accountSid . ":" . $authToken,
            CURLOPT_POSTFIELDS     => http_build_query([
                "From" => "whatsapp:" . $this->fromNumber,
                "To"   => "whatsapp:" . $phone,
                "Body" => $message,
            ]),
            CURLOPT_TIMEOUT => 15,
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode >= 200 && $httpCode < 300;
    }

    private function logNotification(int $userId, string $type, string $recipient, string $message, bool $sent): void
    {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("
                INSERT INTO notification_logs (user_id, type, channel, recipient, message, status)
                VALUES (:uid, :type, 'whatsapp', :recipient, :msg, :status)
            ");
            $stmt->execute([
                "uid"       => $userId,
                "type"      => $type,
                "recipient" => $recipient,
                "msg"       => mb_substr($message, 0, 1000),
                "status"    => $sent ? "sent" : "failed",
            ]);
        } catch (\Exception $e) {
            error_log("Failed to log notification: " . $e->getMessage());
        }
    }
}

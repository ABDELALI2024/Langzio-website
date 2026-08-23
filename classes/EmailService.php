<?php

class EmailService
{
    public static function sendVerification(string $email, string $name, string $token): bool
    {
        $base  = langzio_url("verify-email.php");
        $link  = rtrim($base, "/") . "?token=" . urlencode($token);
        $subject = "Verify your Langzio account";
        $message = "
            <p>Salam, {$name}!</p>
            <p>Click the link below to verify your email and start your free trial:</p>
            <p><a href=\"{$link}\">{$link}</a></p>
            <p>This link expires in 24 hours.</p>
            <p>— Langzio team</p>
        ";

        return self::send($email, $name, $subject, $message);
    }

    public static function sendPasswordReset(string $email, string $name, string $token): bool
    {
        $base  = langzio_url("reset-password.php");
        $link  = rtrim($base, "/") . "?token=" . urlencode($token);
        $subject = "Reset your Langzio password";
        $message = "
            <p>Salam, {$name}!</p>
            <p>Click the link below to reset your password:</p>
            <p><a href=\"{$link}\">{$link}</a></p>
            <p>This link expires in 1 hour.</p>
            <p>— Langzio team</p>
        ";

        return self::send($email, $name, $subject, $message);
    }

    private static function send(string $to, string $name, string $subject, string $html): bool
    {
        $enabled = langzio_env("MAIL_ENABLED", "false");
        if ($enabled !== "true") {
            return false;
        }

        $fromEmail = langzio_env("MAIL_FROM", "noreply@langzio.com");
        $fromName  = langzio_env("MAIL_FROM_NAME", "Langzio");

        $headers = [
            "MIME-Version: 1.0",
            "Content-type: text/html; charset=utf-8",
            "From: {$fromName} <{$fromEmail}>",
            "Reply-To: {$fromEmail}",
        ];

        return mail($to, $subject, $html, implode("\r\n", $headers));
    }
}

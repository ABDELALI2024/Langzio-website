<?php

require_once __DIR__ . "/Database.php";

class User
{
    public static function create(string $name, string $email, string $password): array
    {
        $db = Database::connect();

        $hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
        $token = bin2hex(random_bytes(32));

        $stmt = $db->prepare("
            INSERT INTO users (name, email, password, verification_token)
            VALUES (:name, :email, :password, :token)
        ");
        $stmt->execute([
            "name"     => $name,
            "email"    => $email,
            "password" => $hash,
            "token"    => $token,
        ]);

        return self::findById((int) $db->lastInsertId());
    }

    public static function findById(int $id): ?array
    {
        $db  = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(["id" => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function findByEmail(string $email): ?array
    {
        $db   = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(["email" => $email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function findByVerificationToken(string $token): ?array
    {
        $db   = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE verification_token = :token LIMIT 1");
        $stmt->execute(["token" => $token]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function verifyEmail(int $id): void
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE users SET email_verified_at = NOW(), verification_token = NULL WHERE id = :id");
        $stmt->execute(["id" => $id]);
    }

    public static function authenticate(string $email, string $password): ?array
    {
        $user = self::findByEmail($email);
        if (!$user || !password_verify($password, $user["password"])) {
            return null;
        }
        return $user;
    }

    public static function updateWhatsApp(int $id, string $code, string $number): void
    {
        $db = Database::connect();
        $stmt = $db->prepare("
            UPDATE users
            SET whatsapp_country_code = :code, whatsapp_number = :number, whatsapp_verified_at = NULL
            WHERE id = :id
        ");
        $stmt->execute(["id" => $id, "code" => $code, "number" => $number]);
    }

    public static function verifyWhatsApp(int $id): void
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE users SET whatsapp_verified_at = NOW(), whatsapp_code = NULL WHERE id = :id");
        $stmt->execute(["id" => $id]);
    }

    public static function setWhatsAppCode(int $id, string $code): void
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE users SET whatsapp_code = :code WHERE id = :id");
        $stmt->execute(["id" => $id, "code" => $code]);
    }

    public static function hasVerifiedWhatsApp(int $id): bool
    {
        $user = self::findById($id);
        return $user && $user["whatsapp_number"] && $user["whatsapp_verified_at"] !== null;
    }

    public static function fullPhoneNumber(int $id): ?string
    {
        $user = self::findById($id);
        if (!$user || !$user["whatsapp_number"]) return null;
        return $user["whatsapp_country_code"] . $user["whatsapp_number"];
    }
}

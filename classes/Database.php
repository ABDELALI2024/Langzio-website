<?php

class Database
{
    private static ?PDO $instance = null;

    public static function connect(): PDO
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        $host = langzio_env("DB_HOST", "localhost");
        $port = langzio_env("DB_PORT", "3306");
        $name = langzio_env("DB_NAME", "langzio");
        $user = langzio_env("DB_USER", "root");
        $pass = langzio_env("DB_PASS", "");

        $dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";

        self::$instance = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);

        return self::$instance;
    }

    public static function disconnect(): void
    {
        self::$instance = null;
    }
}

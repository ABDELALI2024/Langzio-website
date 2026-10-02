<?php

require_once __DIR__ . "/Database.php";

class TranslationHistory
{
    public static function add(int $userId, string $source, string $target, string $input, string $output, ?array $structured): void
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO translation_history (user_id, source_language, target_language, input_text, output_text, structured_output) VALUES (:user_id, :source, :target, :input_text, :output_text, :structured_output)");
        $stmt->execute([
            "user_id" => $userId,
            "source" => $source,
            "target" => $target,
            "input_text" => $input,
            "output_text" => $output,
            "structured_output" => $structured === null ? null : json_encode($structured, JSON_UNESCAPED_UNICODE),
        ]);
    }

    public static function listForUser(int $userId, int $limit = 30): array
    {
        $db = Database::connect();
        $limit = max(1, min(100, $limit));
        $stmt = $db->prepare("SELECT id, source_language, target_language, input_text, output_text, structured_output, created_at FROM translation_history WHERE user_id = :user_id ORDER BY created_at DESC, id DESC LIMIT {$limit}");
        $stmt->execute(["user_id" => $userId]);
        $rows = $stmt->fetchAll();
        foreach ($rows as &$row) {
            $row["structured_output"] = $row["structured_output"] ? json_decode($row["structured_output"], true) : null;
        }
        return $rows;
    }

    public static function deleteForUser(int $userId, int $id): bool
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM translation_history WHERE id = :id AND user_id = :user_id");
        $stmt->execute(["id" => $id, "user_id" => $userId]);
        return $stmt->rowCount() > 0;
    }
}

?>


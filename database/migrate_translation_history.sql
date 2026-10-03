CREATE TABLE IF NOT EXISTS translation_history (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    source_language VARCHAR(20) NOT NULL,
    target_language VARCHAR(20) NOT NULL,
    input_text TEXT NOT NULL,
    output_text MEDIUMTEXT NOT NULL,
    structured_output JSON DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_translation_history_user_created (user_id, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Langzio Blog migration — run ONCE in phpMyAdmin on existing databases.
-- (Fresh installs already get this table from schema.sql.)

CREATE TABLE IF NOT EXISTS blog_posts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(150) NOT NULL UNIQUE,
    title VARCHAR(200) NOT NULL,
    excerpt VARCHAR(500) DEFAULT NULL,
    content MEDIUMTEXT NOT NULL,
    status ENUM('draft','published') NOT NULL DEFAULT 'draft',
    published_at DATETIME DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_status_published (status, published_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample posts (delete or unpublish any time from admin-blog.php):
INSERT INTO blog_posts (slug, title, excerpt, content, status, published_at) VALUES
('salam-guide', 'How to greet in Darija: Salam and beyond',
 'Salam opens every conversation in Morocco. Here is when and how to use it.',
 'Salam 3likom.\n\nStart every conversation with Salam — shops, taxis, family visits.\n\nAdd "3afak" to soften any request, and "Shukran bzzaf" to thank warmly.\n\nElders are greeted first. A smile does the rest.',
 'published', NOW()),
('souk-bargaining', 'Bargain respectfully in the souk',
 'Bchhal hadchi? A friendly guide to negotiating prices in Moroccan markets.',
 'Bchhal hadchi? (How much is this?)\n\nBargaining is normal and social — stay friendly and smile.\n\n"Ghaliya chwiya" signals your first counter-offer.\n\nClose with "Safi, ntafa9na" and a handshake.',
 'published', NOW()),
('arabizi-numbers', 'Arabizi numbers: 3, 7, 9 explained',
 'Why Moroccans type 3afak and bzzaf — the numbers behind Darija texting.',
 '3 = ع (3afak = please)\n\n7 = ح (7sab = bill)\n\n9 = ق\n\nOnce you know the code, Darija texting reads naturally.',
 'published', NOW());

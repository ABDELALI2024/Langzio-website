<?php
// Langzio Blog admin — publishing UI protected by ADMIN_KEY (.env).
// Set ADMIN_KEY to a long random secret on the server. Never commit it.
require_once __DIR__ . "/classes/Auth.php";
require_once __DIR__ . "/classes/Database.php";
Auth::startSession();

$adminKey = langzio_env("ADMIN_KEY", "");
if ($adminKey === "") {
    http_response_code(503);
    echo "Blog admin is not configured (ADMIN_KEY missing).";
    exit;
}

if (!empty($_POST["admin_key"])) {
    if (hash_equals($adminKey, (string) $_POST["admin_key"])) {
        $_SESSION["langzio_blog_admin"] = 1;
    } else {
        $loginError = "Invalid key.";
    }
}
if (isset($_GET["logout"])) {
    unset($_SESSION["langzio_blog_admin"]);
}

if (empty($_SESSION["langzio_blog_admin"])) {
    ?>
    <!DOCTYPE html>
    <html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog admin — Langzio</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars(langzio_url('assets/css/style.css'), ENT_QUOTES, 'UTF-8'); ?>">
    </head><body class="auth-page">
    <main class="auth-card" role="main">
        <h1>Blog admin</h1>
        <?php if (!empty($loginError)): ?>
            <div class="form-feedback form-error" role="alert"><?php echo htmlspecialchars($loginError); ?></div>
        <?php endif; ?>
        <form method="post" class="auth-form">
            <label>Admin key
                <input type="password" name="admin_key" required autocomplete="off">
            </label>
            <button class="btn btn-primary" type="submit" style="width:100%;margin-top:8px">Unlock</button>
        </form>
    </main>
    </body></html>
    <?php
    exit;
}

function langzio_blog_slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text) ?? "";
    return trim($text, "-");
}

function langzio_blog_all(): array
{
    $db = Database::connect();
    $stmt = $db->query("SELECT id, slug, title, status, published_at, updated_at FROM blog_posts ORDER BY id DESC");
    return $stmt->fetchAll();
}

function langzio_blog_get(int $id): ?array
{
    $db = Database::connect();
    $stmt = $db->prepare("SELECT * FROM blog_posts WHERE id = :id LIMIT 1");
    $stmt->execute(["id" => $id]);
    $row = $stmt->fetch();
    return $row ?: null;
}

$error = "";
$success = "";
$editing = null;

try {
    $action = $_POST["crud"] ?? "";

    if ($action === "create" || $action === "update") {
        $id = (int) ($_POST["id"] ?? 0);
        $title = trim((string) ($_POST["title"] ?? ""));
        $slug = langzio_blog_slugify((string) ($_POST["slug"] ?? ""));
        if ($slug === "") {
            $slug = langzio_blog_slugify($title);
        }
        $excerpt = trim((string) ($_POST["excerpt"] ?? ""));
        $content = trim((string) ($_POST["content"] ?? ""));
        $status = ($_POST["status"] ?? "draft") === "published" ? "published" : "draft";

        if ($title === "" || $slug === "" || $content === "") {
            $error = "Title, slug and content are required.";
        } else {
            $db = Database::connect();
            if ($action === "create") {
                $stmt = $db->prepare("
                    INSERT INTO blog_posts (slug, title, excerpt, content, status, published_at)
                    VALUES (:slug, :title, :excerpt, :content, :status, :published)
                ");
                $stmt->execute([
                    "slug" => $slug,
                    "title" => $title,
                    "excerpt" => $excerpt !== "" ? $excerpt : null,
                    "content" => $content,
                    "status" => $status,
                    "published" => $status === "published" ? date("Y-m-d H:i:s") : null,
                ]);
                $success = "Article published as " . ($status === "published" ? "published." : "draft.");
            } else {
                $stmt = $db->prepare("
                    UPDATE blog_posts
                    SET slug = :slug, title = :title, excerpt = :excerpt, content = :content,
                        status = :status,
                        published_at = CASE WHEN :status = 'published' AND published_at IS NULL
                                          THEN NOW() ELSE published_at END
                    WHERE id = :id
                ");
                $stmt->execute([
                    "slug" => $slug,
                    "title" => $title,
                    "excerpt" => $excerpt !== "" ? $excerpt : null,
                    "content" => $content,
                    "status" => $status,
                    "id" => $id,
                ]);
                $success = "Article updated.";
            }
        }
    } elseif ($action === "delete") {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM blog_posts WHERE id = :id");
        $stmt->execute(["id" => (int) ($_POST["id"] ?? 0)]);
        $success = "Article deleted.";
    } elseif ($action === "publish") {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE blog_posts SET status = 'published', published_at = COALESCE(published_at, NOW()) WHERE id = :id");
        $stmt->execute(["id" => (int) ($_POST["id"] ?? 0)]);
        $success = "Article published.";
    } elseif ($action === "unpublish") {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE blog_posts SET status = 'draft' WHERE id = :id");
        $stmt->execute(["id" => (int) ($_POST["id"] ?? 0)]);
        $success = "Article moved to draft.";
    }

    if (isset($_GET["edit"])) {
        $editing = langzio_blog_get((int) $_GET["edit"]);
    }

    $posts = langzio_blog_all();
} catch (PDOException $e) {
    if ($e->getCode() === "23000") {
        $error = "This slug is already used. Choose another one.";
    } else {
        error_log("Langzio blog admin failed: " . $e->getMessage());
        $error = "Database error. Did you import database/migrate_blog_posts.sql?";
    }
    $posts = isset($posts) ? $posts : [];
}

$pageTitle = "Blog admin — Langzio";
$pageDescription = "Publish and manage Langzio blog articles.";
$pageClass = "app-page";
$pageNoIndex = true;

include "includes/head.php";
?>
<div class="app-shell container">
    <aside class="sidebar glass">
        <a class="brand" href="index.php">Langzio</a>
        <nav class="side-nav" aria-label="Admin navigation">
            <a class="active" href="admin-blog.php">Blog admin</a>
            <a href="blog.php">View blog</a>
            <a href="dashboard.php">Dashboard</a>
            <hr style="border-color:rgba(255,255,255,0.08);margin:12px 0">
            <a href="admin-blog.php?logout=1">Lock admin</a>
        </nav>
    </aside>

    <div class="app-content">
        <header class="app-topbar glass">
            <h1>Blog admin</h1>
            <a class="btn btn-secondary compact" href="<?php echo htmlspecialchars(langzio_url('blog.php')); ?>">View blog</a>
        </header>

        <?php if ($error): ?>
            <div class="form-feedback form-error" role="alert"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="form-feedback form-success" role="status"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <section class="card" aria-labelledby="editor-title">
            <h2 id="editor-title"><?php echo $editing ? "Edit article" : "New article"; ?></h2>
            <form method="post" class="auth-form" style="max-width:640px">
                <input type="hidden" name="crud" value="<?php echo $editing ? "update" : "create"; ?>">
                <?php if ($editing): ?>
                    <input type="hidden" name="id" value="<?php echo (int) $editing["id"]; ?>">
                <?php endif; ?>
                <label>Title
                    <input type="text" name="title" required maxlength="200"
                           value="<?php echo htmlspecialchars($editing["title"] ?? ""); ?>">
                </label>
                <label>Slug (URL, letters-numbers-dashes)
                    <input type="text" name="slug" maxlength="150" placeholder="auto-from-title"
                           value="<?php echo htmlspecialchars($editing["slug"] ?? ""); ?>">
                </label>
                <label>Excerpt (short summary)
                    <input type="text" name="excerpt" maxlength="500"
                           value="<?php echo htmlspecialchars($editing["excerpt"] ?? ""); ?>">
                </label>
                <label>Content (plain text, line breaks kept)
                    <textarea name="content" required rows="10"><?php echo htmlspecialchars($editing["content"] ?? ""); ?></textarea>
                </label>
                <label>Status
                    <select name="status">
                        <option value="draft" <?php echo (($editing["status"] ?? "draft") === "draft") ? "selected" : ""; ?>>Draft</option>
                        <option value="published" <?php echo (($editing["status"] ?? "") === "published") ? "selected" : ""; ?>>Published</option>
                    </select>
                </label>
                <div class="hero-cta">
                    <button class="btn btn-primary" type="submit"><?php echo $editing ? "Save" : "Create"; ?></button>
                    <?php if ($editing): ?>
                        <a class="btn btn-secondary" href="admin-blog.php">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </section>

        <section class="card" aria-labelledby="list-title">
            <h2 id="list-title">Articles (<?php echo count($posts); ?>)</h2>
            <?php if (empty($posts)): ?>
                <p style="color:var(--muted)">No articles yet. Create the first one above.</p>
            <?php else: ?>
                <ul id="favoritePhrases">
                    <?php foreach ($posts as $item): ?>
                        <li class="favorite-item">
                            <span class="favorite-text">
                                <strong><?php echo htmlspecialchars($item["title"]); ?></strong>
                                <span style="color:var(--muted)">/blog/<?php echo htmlspecialchars($item["slug"]); ?>/ · <?php echo htmlspecialchars($item["status"]); ?></span>
                            </span>
                            <span style="display:flex;gap:8px">
                                <a class="btn btn-secondary compact" href="admin-blog.php?edit=<?php echo (int) $item["id"]; ?>">Edit</a>
                                <form method="post" style="display:inline">
                                    <input type="hidden" name="crud" value="<?php echo $item["status"] === "published" ? "unpublish" : "publish"; ?>">
                                    <input type="hidden" name="id" value="<?php echo (int) $item["id"]; ?>">
                                    <button class="btn btn-secondary compact" type="submit"><?php echo $item["status"] === "published" ? "Unpublish" : "Publish"; ?></button>
                                </form>
                                <form method="post" style="display:inline" onsubmit="return confirm('Delete this article?');">
                                    <input type="hidden" name="crud" value="delete">
                                    <input type="hidden" name="id" value="<?php echo (int) $item["id"]; ?>">
                                    <button class="btn btn-secondary compact" type="submit">Delete</button>
                                </form>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    </div>
</div>

<?php include "includes/footer.php"; ?>

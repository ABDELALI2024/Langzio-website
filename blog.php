<?php
require_once __DIR__ . "/classes/Auth.php";
require_once __DIR__ . "/classes/Database.php";
Auth::startSession();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();

function langzio_blog_list(): array
{
    try {
        $db = Database::connect();
        $stmt = $db->query("
            SELECT slug, title, excerpt, published_at
            FROM blog_posts
            WHERE status = 'published'
            ORDER BY published_at DESC, id DESC
        ");
        return $stmt->fetchAll();
    } catch (Throwable $e) {
        error_log("Langzio blog list failed: " . $e->getMessage());
        return [];
    }
}

function langzio_blog_find(string $slug): ?array
{
    try {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT slug, title, excerpt, content, published_at
            FROM blog_posts
            WHERE slug = :slug AND status = 'published'
            LIMIT 1
        ");
        $stmt->execute(["slug" => $slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    } catch (Throwable $e) {
        error_log("Langzio blog find failed: " . $e->getMessage());
        return null;
    }
}

$slug = trim((string) ($_GET["slug"] ?? ""));
$slug = preg_replace('/[^a-z0-9-]/', '', strtolower($slug));
$post = $slug !== "" ? langzio_blog_find($slug) : null;
$isArticle = $slug !== "";

if ($isArticle && $post === null) {
    http_response_code(404);
}

if ($isArticle && $post !== null) {
    $pageTitle = $post["title"] . " — Langzio Blog";
    $pageDescription = $post["excerpt"] !== "" ? $post["excerpt"] : $post["title"];
} else {
    $pageTitle = "Langzio Blog — Darija stories, culture & learning tips";
    $pageDescription = "Stories and practical tips about Moroccan Darija, culture, and family learning — written by the Langzio team.";
}
$pageClass = "app-page";
$pageKeywords = "Langzio blog, Darija stories, Moroccan culture blog, learn Darija tips, Moroccan Arabic articles";
$pageOgType = "website";
if ($isArticle && $post !== null) {
    $pageOgImage = langzio_canonical_url("assets/icon.svg");
}

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => $isArticle ? "BlogPosting" : "Blog",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/blog/" . ($isArticle && $post !== null ? $post["slug"] . "/" : ""),
    "url" => LANGZIO_CANONICAL_DOMAIN . "/blog/" . ($isArticle && $post !== null ? $post["slug"] . "/" : ""),
    "name" => $isArticle && $post !== null ? $post["title"] : "Langzio Blog",
    "description" => $pageDescription,
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "inLanguage" => "en-US"
];

include "includes/head.php";
?>
<div class="app-shell container">
    <aside class="sidebar glass">
        <a class="brand" href="index.php">Langzio</a>
        <button class="nav-toggle" id="navToggle" type="button" aria-label="Toggle navigation">☰</button>
        <nav class="side-nav" aria-label="Main navigation">
            <a href="dashboard.php">Dashboard</a>
            <a href="translator.php">Translator</a>
            <a href="chat.php">AI Chat</a>
            <a href="guides.php">Guides</a>
            <a href="kids.php">Kids</a>
            <a class="active" href="blog.php">Blog</a>
            <hr style="border-color:rgba(255,255,255,0.08);margin:12px 0">
            <a href="profile.php">Profile</a>
            <a href="pricing.php">Pricing</a>
            <a href="logout.php">Log out</a>
        </nav>
        <div style="margin-top:auto;padding:12px;border-radius:10px;background:rgba(0,211,139,0.08);font-size:0.85rem;text-align:center">
            <?php if ($subStatus["is_trial"]): ?>
                <strong>Trial</strong> — <?php echo $subStatus["days_remaining"]; ?> day(s) left
            <?php elseif ($subStatus["is_subscribed"]): ?>
                <strong>Pro</strong> — Active
            <?php else: ?>
                <a href="pricing.php" style="color:var(--green-2)">Upgrade to Pro</a>
            <?php endif; ?>
        </div>
    </aside>

    <div class="app-content">
        <header class="app-topbar glass">
            <h1><?php echo $isArticle && $post !== null ? htmlspecialchars($post["title"]) : "Blog"; ?></h1>
            <?php if ($isArticle): ?>
                <a class="btn btn-secondary compact" href="<?php echo htmlspecialchars(langzio_url('blog.php')); ?>">All articles</a>
            <?php else: ?>
                <a class="btn btn-secondary compact" href="dashboard.php">Dashboard</a>
            <?php endif; ?>
        </header>

        <?php if ($isArticle && $post === null): ?>
            <section class="card" style="text-align:center" role="alert">
                <h2>Article not found</h2>
                <p style="color:var(--muted)">This article does not exist or is not published yet.</p>
                <a class="btn btn-primary" href="<?php echo htmlspecialchars(langzio_url('blog.php')); ?>">Back to blog</a>
            </section>
        <?php elseif ($isArticle): ?>
            <article class="card" itemscope itemtype="https://schema.org/BlogPosting">
                <meta itemprop="name" content="<?php echo htmlspecialchars($post["title"]); ?>">
                <?php if (!empty($post["published_at"])): ?>
                    <p style="color:var(--muted);font-size:0.85rem"><?php echo htmlspecialchars(substr($post["published_at"], 0, 10)); ?></p>
                <?php endif; ?>
                <div itemprop="articleBody" style="white-space:pre-wrap;line-height:1.7"><?php echo htmlspecialchars($post["content"]); ?></div>
                <?php
                $shareUrl = langzio_canonical_url("blog/" . $post["slug"] . "/");
                $shareText = $post["title"] . " — via Langzio";
                ?>
                <div class="hero-cta" style="margin-top:20px">
                    <a class="btn btn-secondary compact" target="_blank" rel="noopener"
                       href="https://wa.me/?text=<?php echo urlencode($shareText . "\n" . $shareUrl); ?>">Share on WhatsApp</a>
                    <a class="btn btn-secondary compact" target="_blank" rel="noopener"
                       href="https://x.com/intent/tweet?text=<?php echo urlencode($shareText); ?>&url=<?php echo urlencode($shareUrl); ?>">Share on X</a>
                    <button class="btn btn-secondary compact" type="button" id="copyBlogLinkBtn"
                            data-url="<?php echo htmlspecialchars($shareUrl); ?>">Copy link</button>
                </div>
            </article>
            <script>
            document.addEventListener("DOMContentLoaded", () => {
                const btn = document.getElementById("copyBlogLinkBtn");
                if (!btn) return;
                btn.addEventListener("click", async () => {
                    try {
                        await navigator.clipboard.writeText(btn.dataset.url);
                        btn.textContent = "Copied!";
                    } catch (e) {
                        btn.textContent = "Copy failed";
                    }
                });
            });
            </script>
        <?php else: ?>
            <?php $posts = langzio_blog_list(); ?>
            <?php if (empty($posts)): ?>
                <section class="card" style="text-align:center">
                    <h2>No articles yet</h2>
                    <p style="color:var(--muted)">New stories about Darija and Moroccan culture are on the way.</p>
                </section>
            <?php else: ?>
                <section class="guide-grid" aria-label="Blog articles">
                    <?php foreach ($posts as $item): ?>
                        <article class="card guide-card">
                            <h3><?php echo htmlspecialchars($item["title"]); ?></h3>
                            <?php if (!empty($item["excerpt"])): ?>
                                <p><?php echo htmlspecialchars($item["excerpt"]); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($item["published_at"])): ?>
                                <p style="color:var(--muted);font-size:0.85rem"><?php echo htmlspecialchars(substr($item["published_at"], 0, 10)); ?></p>
                            <?php endif; ?>
                            <a class="btn btn-secondary compact" style="margin-top:12px;display:inline-block"
                               href="<?php echo htmlspecialchars(langzio_url("blog/" . $item["slug"] . "/")); ?>">Read →</a>
                        </article>
                    <?php endforeach; ?>
                </section>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php include "includes/footer.php"; ?>

<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::requireLogin();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();

$pageTitle = "Dashboard — Langzio";
$pageDescription = "Your personal Darija learning hub — track translations, chat history, saved phrases, and kids challenge progress.";
$pageClass = "app-page";
$pageNoIndex = true;
$pageKeywords = "Langzio dashboard, Darija learning progress, translation history, chat history, kids streak";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/dashboard.php#page",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/dashboard.php",
    "name" => "Langzio Dashboard",
    "description" => "Your personal Darija learning hub — track translations, chat history, saved phrases, and kids challenge progress.",
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "mainEntity" => [
        "@type" => "Person",
        "name" => $user["name"]
    ],
    "robots" => "noindex, nofollow",
    "inLanguage" => "en-US"
];

include "includes/head.php";
?>
<div class="app-shell container">
    <aside class="sidebar glass">
        <a class="brand" href="index.php">Langzio</a>
        <button class="nav-toggle" id="navToggle" type="button" aria-label="Toggle navigation">☰</button>
        <nav class="side-nav" aria-label="Main navigation">
            <a class="active" href="dashboard.php" aria-current="page">Dashboard</a>
            <a href="translator.php">Translator</a>
            <a href="chat.php">AI Chat</a>
            <a href="guides.php">Guides</a>
            <a href="kids.php">Kids</a>
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
            <h1 id="dashboardGreeting">Salam, <?php echo htmlspecialchars($user["name"]); ?> 👋</h1>
            <button class="btn btn-secondary compact" id="installAppBtn" type="button">Install app</button>
        </header>

        <?php if ($subStatus["is_trial"]): ?>
        <section class="card" style="border-color:rgba(0,211,139,0.3);background:rgba(0,211,139,0.06)" aria-labelledby="trial-status">
            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px">
                <div>
                    <strong id="trial-status">Free Trial</strong> — <?php echo $subStatus["days_remaining"]; ?> day(s) remaining
                    <?php if ($subStatus["days_remaining"] <= 3): ?>
                        <p style="margin:4px 0 0;color:var(--red);font-size:0.9rem">Your trial is ending soon!</p>
                    <?php endif; ?>
                </div>
                <a class="btn btn-primary" href="<?php echo htmlspecialchars(langzio_url('pricing.php')); ?>">Upgrade to Pro</a>
            </div>
        </section>
        <?php elseif ($subStatus["plan"] === "pro"): ?>
        <section class="card" style="border-color:rgba(0,211,139,0.4)" aria-labelledby="pro-status">
            <strong id="pro-status">Pro Active</strong> — thank you for supporting Langzio!
        </section>
        <?php elseif ($subStatus["plan"] === "expired" || $subStatus["status"] === "expired"): ?>
        <section class="card" style="border-color:var(--red);background:rgba(217,63,79,0.08)" aria-labelledby="expired-status">
            <strong id="expired-status">Trial expired.</strong>
            <a class="btn btn-primary" href="<?php echo htmlspecialchars(langzio_url('pricing.php')); ?>">Upgrade now</a>
        </section>
        <?php endif; ?>

        <section class="card family-banner hidden" id="familyBanner" aria-labelledby="family-title">
            <h2 id="family-title">Family challenge active</h2>
            <p id="familyBannerText">Day 1 of 7 — help your kids practice 5 Darija words today.</p>
            <a class="btn btn-primary" href="kids.php">Continue challenge</a>
        </section>

        <section class="dashboard-grid" id="dashboardStats" aria-labelledby="stats-title">
            <h2 id="stats-title" class="visually-hidden">Learning Statistics</h2>
            <article class="card"><h3>Translations</h3><p id="statTranslations">0</p></article>
            <article class="card"><h3>Chat messages</h3><p id="statChats">0</p></article>
            <article class="card"><h3>Saved phrases</h3><p id="statFavorites">0</p></article>
            <article class="card"><h3>Kids streak</h3><p id="statStreak">0 days</p></article>
        </section>

        <section class="card dashboard-highlight" aria-labelledby="action-title">
            <h2 id="action-title">Continue learning</h2>
            <p id="dashboardTip">Pick up where you left off — every phrase builds confidence.</p>
            <div class="hero-cta">
                <a class="btn btn-primary" id="dashboardPrimaryCta" href="translator.php">Open Translator</a>
                <a class="btn btn-secondary" id="dashboardSecondaryCta" href="kids.php">Kids practice</a>
            </div>
            <button class="btn btn-secondary compact share-family-btn hidden" id="inviteFamilyBtn" type="button">Invite family on WhatsApp</button>
        </section>
    </div>
</div>

<?php include "includes/footer.php"; ?>
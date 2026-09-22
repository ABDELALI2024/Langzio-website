<?php
require_once __DIR__ . "/config.php";
http_response_code(404);
$pageTitle = "404 - Page Not Found — Langzio";
$pageDescription = "The page you are looking for does not exist. Try our Darija translator, phrase guides, or kids challenge instead.";
$pageClass = "auth-page";
$pageNoIndex = true;
$pageKeywords = "Langzio 404, page not found, Darija translator, Moroccan Arabic phrases";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/404.php#page",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/404.php",
    "name" => "Page Not Found — Langzio",
    "description" => "The page you are looking for does not exist. Try our Darija translator, phrase guides, or kids challenge instead.",
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "mainEntity" => [
        "@type" => "WebPageElement",
        "name" => "404 Error Page",
        "description" => "Page not found with helpful navigation to Langzio resources"
    ],
    "robots" => "noindex, nofollow",
    "inLanguage" => "en-US"
];

include "includes/head.php";
?>
<main class="auth-card" style="text-align:center" role="main">
    <div class="auth-logo" style="font-size:3rem" aria-hidden="true">404</div>
    <h1 style="margin-bottom:16px">Page not found</h1>
    <p style="margin-bottom:24px;color:var(--text-dim)">The page you are looking for does not exist or has been moved.</p>
    <nav aria-label="Error page navigation">
        <a class="btn btn-primary" href="<?php echo htmlspecialchars(langzio_url('index.php')); ?>" style="margin-right:12px">Back to Home</a>
        <a class="btn btn-secondary" href="<?php echo htmlspecialchars(langzio_url('translator.php')); ?>">Try Translator</a>
        <a class="btn btn-secondary" href="<?php echo htmlspecialchars(langzio_url('guides.php')); ?>">Browse Guides</a>
    </nav>
    <p style="margin-top:16px;font-size:0.85rem">
        <a href="<?php echo htmlspecialchars(langzio_url('dashboard.php')); ?>">Dashboard</a> · 
        <a href="<?php echo htmlspecialchars(langzio_url('kids.php')); ?>">Kids Challenge</a> · 
        <a href="<?php echo htmlspecialchars(langzio_url('chat.php')); ?>">AI Chat</a>
    </p>
</main>
<?php include "includes/footer.php"; ?>
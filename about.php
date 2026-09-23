<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::startSession();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();

$pageTitle = "About Langzio — Learn Moroccan Darija with Context";
$pageDescription = "Langzio is a web application for learning and understanding Moroccan Darija through natural language, cultural context, pronunciation, and real-life situations.";
$pageClass = "app-page";
$pageKeywords = "about Langzio, what is Langzio, Moroccan Darija web app, learn Moroccan Arabic";
$pageOgType = "website";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "AboutPage",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/about/#page",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/about/",
    "name" => "About Langzio",
    "description" => $pageDescription,
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "mainEntity" => [
        "@type" => "Organization",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#organization"
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
            <a href="blog.php">Blog</a>
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
        <nav aria-label="Breadcrumb" style="margin-bottom:12px;font-size:0.85rem;color:var(--muted)">
            <a href="<?php echo htmlspecialchars(langzio_url('index.php')); ?>">Home</a> ·
            <span aria-current="page">About</span>
        </nav>

        <article class="card">
            <h1>About Langzio</h1>
            <p style="font-size:1.08rem;line-height:1.7"><strong>Langzio is a web application for learning and understanding Moroccan Darija through natural language, cultural context, pronunciation, and real-life situations.</strong></p>

            <h2>Why Moroccan Darija?</h2>
            <p>Moroccan Darija is the everyday spoken Arabic variety used across Morocco — yet most language tools treat it as an afterthought, or translate it word-for-word without tone, context, or culture. Travelers misunderstand situations. Diaspora families watch the language fade between visits home. Langzio exists to close that gap: real Darija, explained the way Moroccans actually use it.</p>

            <h2>What Langzio offers</h2>
            <ul style="line-height:1.9">
                <li><a href="<?php echo htmlspecialchars(langzio_url('translator.php')); ?>">Darija translator</a> with pronunciation, tone, and cultural notes.</li>
                <li><a href="<?php echo htmlspecialchars(langzio_url('guides.php')); ?>">Situational phrase guides</a> for restaurants, souks, taxis, family, and travel.</li>
                <li><a href="<?php echo htmlspecialchars(langzio_url('kids.php')); ?>">Kids challenge</a> helping diaspora families keep Darija alive.</li>
                <li><a href="<?php echo htmlspecialchars(langzio_url('learn.php')); ?>">Darija learning guide</a> explaining what Moroccan Darija is and how to learn it.</li>
                <li><a href="<?php echo htmlspecialchars(langzio_url('blog.php')); ?>">Blog stories</a> about Darija, culture, and everyday Moroccan life.</li>
            </ul>

            <h2>How our content is made</h2>
            <p>Langzio phrase packs are curated from commonly used Moroccan expressions and reviewed with Moroccan Darija speakers for accuracy, tone, and cultural fit. Articles state their publication date, and guides are revisited as the platform grows. If you spot a mistake, <a href="<?php echo htmlspecialchars(langzio_url('contact.php')); ?>">tell us</a> — corrections from native speakers make Langzio better for everyone.</p>

            <h2>Who Langzio is for</h2>
            <p>Travelers visiting Morocco, Moroccan diaspora and families abroad, kids learning Darija at home, and anyone curious about Moroccan language and culture.</p>

            <div class="hero-cta" style="margin-top:20px">
                <a class="btn btn-primary" href="<?php echo htmlspecialchars(langzio_url('register.php')); ?>">Join Langzio</a>
                <a class="btn btn-secondary" href="<?php echo htmlspecialchars(langzio_url('contact.php')); ?>">Contact us</a>
            </div>
        </article>
    </div>
</div>

<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"<?php echo LANGZIO_CANONICAL_DOMAIN; ?>/"},{"@type":"ListItem","position":2,"name":"About Langzio","item":"<?php echo LANGZIO_CANONICAL_DOMAIN; ?>/about/"}]}
</script>

<?php include "includes/footer.php"; ?>

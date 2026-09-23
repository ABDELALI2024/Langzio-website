<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::requireLogin();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();

$pageTitle = "Langzio Translator — AI Moroccan Darija Translation with Cultural Context";
$pageDescription = "Translate English, French, or Darija with AI-powered cultural context. Get structured output: Darija phrase, pronunciation, meaning, tone, cultural tips, and common mistakes to avoid. Free demo available.";
$pageClass = "app-page";
$pageKeywords = "Darija translator, Moroccan Arabic translator, English to Darija, French to Darija, AI translation Morocco, cultural translation, Darija pronunciation";
$pageOgType = "website";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "SoftwareApplication",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/translator/#app",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/translator/",
    "name" => "Langzio Translator",
    "applicationCategory" => "EducationalApplication",
    "operatingSystem" => "Web, PWA",
    "offers" => [
        [
            "@type" => "Offer",
            "name" => "Free Demo",
            "price" => "0",
            "priceCurrency" => "USD",
            "availability" => "https://schema.org/InStock",
            "description" => "Limited daily translations with full structured output",
            "url" => LANGZIO_CANONICAL_DOMAIN . "/translator/"
        ],
        [
            "@type" => "Offer",
            "name" => "Pro Subscription",
            "price" => "9",
            "priceCurrency" => "USD",
            "priceSpecification" => [
                "@type" => "UnitPriceSpecification",
                "price" => "9",
                "priceCurrency" => "USD",
                "billingDuration" => "P1M"
            ],
            "availability" => "https://schema.org/InStock",
            "url" => LANGZIO_CANONICAL_DOMAIN . "/pricing/"
        ]
    ],
    "description" => "AI-powered Moroccan Darija translator with cultural context, pronunciation, tone guidance, and verified phrases. Supports English, French, and Darija input.",
    "featureList" => [
        "Structured Translation Output (Darija, Pronunciation, Meaning, Tone, Context, Avoid, Tip)",
        "RAG-Grounded Generation from 28+ Verified Phrase Corpus",
        "Multi-language Support (English ↔ Darija, French ↔ Darija)",
        "Cultural Etiquette Integration",
        "Pronunciation Guide with Arabizi Support",
        "Conversation History (Pro)",
        "Offline PWA Access (Pro)"
    ],
    "usesTechnology" => "Verified phrase corpus (local mode)",
    "provider" => [
        "@type" => "Organization",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#organization"
    ],
    "inLanguage" => ["en", "ary", "fr"],
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "screenshot" => LANGZIO_CANONICAL_DOMAIN . "/assets/screenshots/translator.png"
];

include "includes/head.php";
?>
<div class="app-shell container">
    <aside class="sidebar glass">
        <a class="brand" href="index.php">Langzio</a>
        <button class="nav-toggle" id="navToggle" type="button" aria-label="Toggle navigation">☰</button>
        <nav class="side-nav" aria-label="Main navigation">
            <a href="dashboard.php">Dashboard</a>
            <a class="active" href="translator.php">Translator</a>
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
        <header class="app-topbar glass">
            <h1>AI Translator</h1>
            <a class="btn btn-secondary compact" href="dashboard.php">Dashboard</a>
        </header>

        <div class="translator-container" role="region" aria-label="Translator">
            <div class="translator-controls" aria-label="Language selection">
                <label for="sourceLang" class="visually-hidden">Source language</label>
                <select id="sourceLang" aria-label="Source language">
                    <option value="en" selected>English</option>
                    <option value="darija">Darija</option>
                    <option value="fr">French</option>
                </select>
                <button id="swapLang" type="button" style="font-size:1.2rem;width:44px;height:44px;border:none;background:var(--card-bg);border-radius:50%" aria-label="Swap source and target languages">⇄</button>
                <label for="targetLang" class="visually-hidden">Target language</label>
                <select id="targetLang" aria-label="Target language">
                    <option value="darija" selected>Darija</option>
                    <option value="en">English</option>
                    <option value="fr">French</option>
                </select>
            </div>
            <label for="translatorInput" class="visually-hidden">Text to translate</label>
            <textarea id="translatorInput" placeholder="Type your phrase..." rows="4" aria-label="Enter text to translate"></textarea>
            <label for="translatorOutput" class="visually-hidden">Translation result</label>
            <textarea id="translatorOutput" placeholder="Translation appears here..." rows="4" readonly aria-label="Translation result"></textarea>
            <div class="structured-preview hidden" id="structuredOutput" aria-live="polite" aria-label="Structured translation output"></div>
            <p class="hidden" id="translatorLoading" style="color:var(--green-1)" aria-live="polite">Translating...</p>
            <button class="btn btn-primary" id="translateBtn" type="button">Translate with AI</button>
        </div>

        <section class="card" aria-labelledby="translator-features-title" style="margin-top:24px">
            <h2 id="translator-features-title">What Makes Langzio Translation Different</h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px">
                <article>
                    <h4>Structured Output</h4>
                    <p>Not just text — get Darija, pronunciation, meaning, tone, cultural context, mistakes to avoid, and pro tips.</p>
                </article>
                <article>
                    <h4>Cultural Intelligence</h4>
                    <p>AI grounded in 28+ verified phrases from native speakers — not hallucinated translations.</p>
                </article>
                <article>
                    <h4>Learner-Focused</h4>
                    <p>Arabizi numbers (3, 7, 9) explained, register guidance (polite/casual), real usage context.</p>
                </article>
            </div>
        </section>

        <section class="card" aria-labelledby="related-title" style="margin-top:16px">
            <h2 id="related-title">Related Resources</h2>
            <div style="display:flex;flex-wrap:wrap;gap:12px">
                <a href="<?php echo langzio_url('guides/'); ?>" class="btn btn-secondary">Phrase Guides</a>
                <a href="<?php echo langzio_url('dictionary/'); ?>" class="btn btn-secondary">Darija Dictionary</a>
                <a href="<?php echo langzio_url('darija-pronunciation/'); ?>" class="btn btn-secondary">Pronunciation Guide</a>
                <a href="<?php echo langzio_url('arabizi-guide/'); ?>" class="btn btn-secondary">Arabizi Reference</a>
                <a href="<?php echo langzio_url('chat.php'); ?>" class="btn btn-secondary">AI Cultural Chat</a>
            </div>
        </section>
    </div>
</div>

<?php include "includes/footer.php"; ?>
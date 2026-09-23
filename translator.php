<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::requireLogin();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();

$pageTitle = "Langzio Translator — AI Moroccan Darija Translation with Cultural Context";
$pageDescription = "Translate English, French, or Darija with AI-powered cultural context. Get structured output: Darija phrase, pronunciation, meaning, tone, cultural tips, and common mistakes to avoid. Free demo available.";
$pageClass = "app-page ai-studio";
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
    "usesTechnology" => "RAG (Retrieval-Augmented Generation) with Llama 3.3 70B",
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
<link rel="stylesheet" href="<?php echo htmlspecialchars(langzio_url('assets/css/studio.css'), ENT_QUOTES, 'UTF-8'); ?>">
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

        <div class="studio-toolbar glass" role="region" aria-label="Translator">
            <div class="studio-lang" aria-label="Language selection">
                <label>From
                    <select id="sourceLang" aria-label="Source language">
                        <option value="en" selected>English</option>
                        <option value="darija">Darija</option>
                        <option value="fr">French</option>
                    </select>
                </label>
                <button id="swapLang" type="button" aria-label="Swap source and target languages">⇄</button>
                <label>To
                    <select id="targetLang" aria-label="Target language">
                        <option value="darija" selected>Darija</option>
                        <option value="en">English</option>
                        <option value="fr">French</option>
                    </select>
                </label>
            </div>
            <div class="studio-meta">
                <span id="charCount" aria-live="polite">0 / 10000</span>
                <button class="studio-mini-btn" id="micInputBtn" type="button" aria-label="Dictate input by voice">Mic</button>
                <button class="studio-mini-btn" id="clearTranslatorBtn" type="button">Clear</button>
            </div>
        </div>

        <div class="studio-panels">
            <div class="studio-panel glass">
                <div class="studio-panel-head"><span>Input</span></div>
                <label for="translatorInput" class="visually-hidden">Text to translate</label>
                <textarea id="translatorInput" placeholder="Type your phrase… e.g. How do I politely ask for the bill?" aria-label="Enter text to translate"></textarea>
            </div>
            <div class="studio-panel glass">
                <div class="studio-panel-head"><span>Result</span><span class="hidden" id="translatorLoading" aria-live="polite">Translating…</span></div>
                <label for="translatorOutput" class="visually-hidden">Translation result</label>
                <textarea id="translatorOutput" placeholder="Translation appears here…" readonly aria-label="Translation result"></textarea>
                <div class="structured-preview hidden" id="structuredOutput" aria-live="polite" aria-label="Structured translation output"></div>
            </div>
        </div>
        <button class="studio-go" id="translateBtn" type="button">Translate with AI →</button>
        <script>
        document.addEventListener("DOMContentLoaded", () => {
            const input = document.getElementById("translatorInput");
            const count = document.getElementById("charCount");
            const clear = document.getElementById("clearTranslatorBtn");
            const output = document.getElementById("translatorOutput");
            const structured = document.getElementById("structuredOutput");
            if (input && count) {
                const update = () => { count.textContent = input.value.length + " / 10000"; };
                input.addEventListener("input", update);
                update();
            }
            if (clear && input) {
                clear.addEventListener("click", () => {
                    input.value = "";
                    input.dispatchEvent(new Event("input"));
                    if (output) { output.value = ""; output.classList.remove("hidden"); }
                    if (structured) { structured.innerHTML = ""; structured.classList.add("hidden"); }
                    input.focus();
                });
            }
        });
        </script>

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

<script src="<?php echo htmlspecialchars(langzio_url('assets/js/voice.js'), ENT_QUOTES, 'UTF-8'); ?>"></script>
<?php include "includes/footer.php"; ?>
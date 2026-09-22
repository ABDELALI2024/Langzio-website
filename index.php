<?php
require_once __DIR__ . "/config.php";
$pageTitle = "Langzio - Cultural AI for Darija";
$pageDescription = "Darija translation with cultural context, verified phrase packs, and family-friendly learning — built for Morocco travelers and diaspora.";
$pageClass = "landing-page";
$pageKeywords = "Moroccan Darija, Moroccan Arabic, learn Darija, Darija translator, Darija dictionary, Morocco travel phrases, Moroccan culture, Darija pronunciation, AI language learning";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "#homepage",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/",
    "name" => "Langzio - Cultural AI for Darija",
    "description" => "Darija translation with cultural context, verified phrase packs, and family-friendly learning — built for Morocco travelers and diaspora.",
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "about" => [
        "@type" => "Language",
        "@id" => "https://www.wikidata.org/wiki/Q188325",
        "name" => "Moroccan Darija",
        "alternateName" => "Moroccan Arabic"
    ],
    "mentions" => [
        [
            "@type" => "SoftwareApplication",
            "@id" => LANGZIO_CANONICAL_DOMAIN . "#translator",
            "name" => "Langzio Translator"
        ],
        [
            "@type" => "SoftwareApplication",
            "name" => "Langzio AI Chat"
        ],
        [
            "@type" => "Course",
            "name" => "Langzio Smart Guides"
        ],
        [
            "@type" => "Course",
            "name" => "Langzio 7-Day Kids Challenge"
        ]
    ],
    "mainEntity" => [
        "@type" => "Organization",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#organization"
    ],
    "potentialAction" => [
        [
            "@type" => "ViewAction",
            "name" => "Try Translator",
            "target" => LANGZIO_CANONICAL_DOMAIN . "/translator/"
        ],
        [
            "@type" => "ViewAction",
            "name" => "Start 7-Day Challenge",
            "target" => LANGZIO_CANONICAL_DOMAIN . "/kids/"
        ]
    ],
    "datePublished" => "2026-01-01",
    "dateModified" => date("Y-m-d"),
    "inLanguage" => "en-US"
];

include "includes/head.php";
?>
<header class="top-nav container glass">
    <a class="brand" href="index.php">Langzio</a>
    <nav aria-label="Main navigation">
        <a href="#why">Why Langzio</a>
        <a href="#features">Features</a>
        <a class="nav-cta" href="login.php">Log in</a>
    </nav>
</header>

<main>
    <section class="hero container" aria-labelledby="hero-title">
        <span class="badge">Early beta · Morocco + diaspora</span>
        <h1 id="hero-title">Darija with context, not just translation</h1>
        <p>Google Translate misses slang, tone, and culture. Langzio gives you natural Darija phrases, when to use them, and what to avoid — for trips and for families keeping the language alive abroad.</p>
        <div class="hero-cta">
            <a class="btn btn-primary" href="login.php">Log in</a>
        </div>
        <div class="hero-metrics honest-metrics" aria-label="Langzio metrics">
            <div><strong>28</strong><span>Verified phrase packs</span></div>
            <div><strong>4</strong><span>Situational guides</span></div>
            <div><strong>Beta</strong><span>Free while we learn</span></div>
        </div>
    </section>

    <section class="features container" id="why" aria-labelledby="why-title">
        <h2 id="why-title">Built for real Moroccan conversations</h2>
        <p class="section-lead">Most apps translate words. Langzio translates <em>situations</em> — restaurant, souk, taxi, family visits — with etiquette baked in.</p>
        <div class="feature-grid">
            <article class="card">
                <h3>Structured Translator</h3>
                <p>Darija + pronunciation + tone + cultural tip. Not a wall of text.</p>
            </article>
            <article class="card">
                <h3>Verified Phrase RAG</h3>
                <p>AI grounded in curated Darija packs before it improvises.</p>
            </article>
            <article class="card">
                <h3>Cultural Chat</h3>
                <p>Ask about etiquette, slang, and social nuance with conversation memory.</p>
            </article>
            <article class="card">
                <h3>Diaspora Kids</h3>
                <p>Flashcards and streaks so children stay connected to Darija abroad.</p>
            </article>
        </div>
    </section>

    <section class="demo container" id="features" aria-labelledby="demo-title">
        <div class="section-title">
            <h2 id="demo-title">What a good answer looks like</h2>
            <p>Every translation aims for clarity, respect, and practical use.</p>
        </div>
        <div class="demo-mockup glass structured-preview">
            <div class="structured-card">
                <div class="structured-row"><span>Darija</span><strong>3afak, jib lia l7sab.</strong></div>
                <div class="structured-row"><span>Say it</span><strong>afak, jib liya l-ḥsab</strong></div>
                <div class="structured-row"><span>Meaning</span><strong>Please bring me the bill.</strong></div>
                <div class="structured-row"><span>Tone</span><strong>Polite / neutral</strong></div>
                <div class="structured-row"><span>Tip</span><strong>Smile + "3afak" goes a long way in cafés.</strong></div>
            </div>
        </div>
    </section>

    <section class="beta-section container" id="beta" aria-labelledby="beta-title">
        <div class="card beta-card">
            <h2 id="beta-title">Join the beta</h2>
            <p>We're building Langzio with travelers and Moroccan families abroad. Get early access updates — no spam.</p>
            <form class="waitlist-form" id="waitlistForm">
                <input type="email" id="waitlistEmail" placeholder="you@email.com" required>
                <button class="btn btn-primary" type="submit">Join waitlist</button>
            </form>
            <p class="waitlist-feedback hidden" id="waitlistFeedback"></p>
        </div>
    </section>

    <section class="testimonials container" aria-labelledby="testimonials-title">
        <h2 id="testimonials-title">Who it's for</h2>
        <div class="testimonial-grid">
            <blockquote class="card">
                <strong>Tourists</strong>
                <p>Navigate restaurants, souks, and taxis with phrases locals actually use.</p>
            </blockquote>
            <blockquote class="card">
                <strong>MRE families</strong>
                <p>Help kids learn Darija with bite-sized practice between visits home.</p>
            </blockquote>
            <blockquote class="card">
                <strong>Digital nomads</strong>
                <p>Understand context and tone — not just dictionary definitions.</p>
            </blockquote>
        </div>
    </section>
</main>

<footer class="site-footer container" role="contentinfo">
    <div>
        <strong>Langzio</strong>
        <p>Cultural language intelligence for Darija.</p>
    </div>
    <nav class="footer-links" aria-label="Footer navigation">
        <a href="translator.php">Translator</a>
        <a href="chat.php">AI Chat</a>
        <a href="guides.php">Guides</a>
        <a href="kids.php">Kids</a>
        <a href="contact.php">Contact</a>
    </nav>
    <p class="copyright">© <?php echo date("Y"); ?> Langzio · Early beta</p>
</footer>

<?php include "includes/footer.php"; ?>
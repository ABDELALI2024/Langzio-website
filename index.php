<?php
require_once __DIR__ . "/config.php";
$pageTitle = "Langzio — Learn Moroccan Darija with Context";
$pageDescription = "Learn Moroccan Darija with natural expressions, cultural context, pronunciation, and real-life situations. Langzio helps travelers and Moroccan diaspora connect with Darija.";
$pageClass = "landing-page langzio-landing";
$pageKeywords = "Moroccan Darija, Moroccan Arabic, learn Darija, Darija phrases, Darija pronunciation, Moroccan culture, Darija for travelers, Moroccan diaspora";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "#homepage",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/",
    "name" => "Langzio — Learn Moroccan Darija with Context",
    "description" => "Learn Moroccan Darija with natural expressions, cultural context, pronunciation, and real-life situations. Langzio helps travelers and Moroccan diaspora connect with Darija.",
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
    "mainEntity" => [
        "@type" => "Organization",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#organization"
    ],
    "inLanguage" => "en-US"
];

include "includes/head.php";
?>
<link rel="stylesheet" href="<?php echo htmlspecialchars(langzio_url('assets/css/landing.css'), ENT_QUOTES, 'UTF-8'); ?>">

<header class="lz-header">
    <div class="lz-wrap lz-header-in">
        <a class="lz-brand" href="index.php" aria-label="Langzio home">
            <img src="<?php echo htmlspecialchars(langzio_url('assets/icon.svg'), ENT_QUOTES, 'UTF-8'); ?>" alt="Langzio logo" width="34" height="34">
            <span>Langzio</span>
        </a>
        <nav class="lz-nav" id="lzNav" aria-label="Main navigation">
            <a href="#why">Why Langzio</a>
            <a href="learn.php">Learn Darija</a>
            <a href="guides.php">Guides</a>
            <a href="#travelers">For Travelers</a>
            <a href="#families">For Families</a>
        </nav>
        <div class="lz-header-cta">
            <a class="lz-login" href="login.php">Log in</a>
            <a class="lz-btn lz-btn-primary" style="padding:11px 22px;font-size:0.92rem" href="register.php">Join Langzio →</a>
        </div>
        <button class="lz-menu-btn" id="lzMenuBtn" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="lzNav">☰</button>
    </div>
</header>

<main>
    <section class="lz-hero" aria-labelledby="hero-title">
        <div class="lz-wrap lz-hero-grid">
            <div>
                <p class="lz-eyebrow">Moroccan Darija · Culture · Real conversations</p>
                <h1 id="hero-title">Learn Moroccan Darija.<br><span class="lz-accent">Understand the context.</span><br>Speak naturally.</h1>
                <p class="lz-hero-sub">Langzio is a web application for learning and understanding Moroccan Darija through natural language, cultural context, pronunciation, and real-life situations.</p>
                <div class="lz-hero-cta">
                    <a class="lz-btn lz-btn-primary" href="register.php">Join Langzio →</a>
                    <a class="lz-btn lz-btn-ghost" href="guides.php">Explore Langzio</a>
                </div>
                <ul class="lz-trust" aria-label="About Langzio">
                    <li>Web application</li>
                    <li>Moroccan Darija</li>
                    <li>Built for Morocco &amp; the diaspora</li>
                </ul>
            </div>
            <div class="lz-visual" role="img" aria-label="Moroccan atmosphere: greeting words in Darija over a patterned green composition">
                <div class="lz-visual-arch" aria-hidden="true"></div>
                <div class="lz-visual-word">
                    <small>Every conversation starts with</small>
                    <strong>Salam 3likom</strong>
                </div>
                <div class="lz-phrase-row" aria-hidden="true">
                    <div class="lz-phrase">3afak<span>please — softens any request</span></div>
                    <div class="lz-phrase">Shukran bzzaf<span>thank you very much</span></div>
                    <div class="lz-phrase">Bslama<span>goodbye</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="lz-section" id="why" aria-labelledby="why-title">
        <div class="lz-wrap">
            <p class="lz-eyebrow">Why Langzio</p>
            <h2 class="lz-h2" id="why-title">More than translation. It&rsquo;s about understanding.</h2>
            <div class="lz-grid-4">
                <article class="lz-card">
                    <div class="lz-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M21 12a8 8 0 0 1-8 8H4l2-3a8 8 0 1 1 15-5z"/><path d="M8.5 12h.01M12 12h.01M15.5 12h.01"/></svg></div>
                    <h3>Natural Darija</h3>
                    <p>Learn expressions people actually use in everyday Moroccan conversations.</p>
                </article>
                <article class="lz-card">
                    <div class="lz-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3v18M5 8l7-5 7 5M5 16l7 5 7-5"/></svg></div>
                    <h3>Context &amp; Tone</h3>
                    <p>Understand when a phrase sounds polite, casual, friendly, or formal.</p>
                </article>
                <article class="lz-card">
                    <div class="lz-icon lz-icon-red" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg></div>
                    <h3>Moroccan Culture</h3>
                    <p>Discover the cultural context behind everyday Moroccan communication.</p>
                </article>
                <article class="lz-card">
                    <div class="lz-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9.5" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9M15.5 3.1a4 4 0 0 1 0 7.8"/></svg></div>
                    <h3>Real Conversations</h3>
                    <p>Learn language through situations that happen in real life.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="lz-section lz-section-alt lz-pattern" id="situations" aria-labelledby="situations-title">
        <div class="lz-wrap">
            <p class="lz-eyebrow">Real-life situations</p>
            <h2 class="lz-h2" id="situations-title">Moroccan Darija for everyday life.</h2>
            <p class="lz-lead">From restaurants and taxis to souks, greetings, family visits, and everyday conversations, understand how Moroccan Darija is actually used.</p>
            <div class="lz-grid-situ">
                <article class="lz-situ">
                    <p class="lz-situ-tag">Everyday</p>
                    <h3>Greetings</h3>
                    <p>Open every interaction the Moroccan way, from Salam to warm farewells.</p>
                </article>
                <article class="lz-situ">
                    <p class="lz-situ-tag">Food &amp; cafés</p>
                    <h3>Restaurant</h3>
                    <p>Order politely, ask for recommendations, and request the bill naturally.</p>
                </article>
                <article class="lz-situ">
                    <p class="lz-situ-tag">Getting around</p>
                    <h3>Taxi</h3>
                    <p>Confirm destinations and fares with confidence before the ride starts.</p>
                </article>
                <article class="lz-situ">
                    <p class="lz-situ-tag">Markets</p>
                    <h3>Souk</h3>
                    <p>Ask prices and negotiate respectfully, the way locals do.</p>
                </article>
                <article class="lz-situ">
                    <p class="lz-situ-tag">Warmth</p>
                    <h3>Family</h3>
                    <p>Greet, thank, and show respect during family visits and gatherings.</p>
                </article>
                <article class="lz-situ">
                    <p class="lz-situ-tag">On the road</p>
                    <h3>Travel</h3>
                    <p>Find your way, ask for help, and handle daily needs while traveling.</p>
                </article>
            </div>
            <div class="lz-center">
                <a class="lz-text-link" href="guides.php">Explore Darija situations →</a>
            </div>
        </div>
    </section>

    <section class="lz-section" aria-labelledby="journey-title">
        <div class="lz-wrap">
            <p class="lz-eyebrow">For everyone</p>
            <h2 class="lz-h2" id="journey-title">Designed for your journey.</h2>
            <div class="lz-grid-3">
                <article class="lz-card" id="travelers">
                    <div class="lz-audience-img" aria-hidden="true"></div>
                    <h3>Travelers</h3>
                    <p>Navigate Morocco with confidence and understand the expressions you hear every day.</p>
                    <a class="lz-text-link" href="guides.php">Explore for travelers →</a>
                </article>
                <article class="lz-card" id="families">
                    <div class="lz-audience-img" aria-hidden="true"></div>
                    <h3>Moroccan Families &amp; Diaspora</h3>
                    <p>Keep Moroccan Darija connected across generations with practical everyday language.</p>
                    <a class="lz-text-link" href="kids.php">Explore for families →</a>
                </article>
                <article class="lz-card">
                    <div class="lz-audience-img" aria-hidden="true"></div>
                    <h3>Kids</h3>
                    <p>Make Moroccan Darija part of everyday family life through simple and engaging learning.</p>
                    <a class="lz-text-link" href="kids.php">Explore for kids →</a>
                </article>
            </div>
        </div>
    </section>

    <section class="lz-section lz-section-alt" id="learn-darija" aria-labelledby="darija-title">
        <div class="lz-wrap">
            <p class="lz-eyebrow">Language &amp; culture</p>
            <h2 class="lz-h2" id="darija-title">What is Moroccan Darija?</h2>
            <div class="lz-editorial">
                <div>
                    <p><strong>Moroccan Darija</strong> is the everyday spoken Arabic variety used across Morocco. It is widely used in family life, cafés, shops, taxis, travel, and everyday conversations.</p>
                    <p><strong>Moroccan Arabic</strong> has developed through influences from Arabic, Amazigh, French, Spanish, and other languages. That mix is exactly what makes it lively — and why word-for-word translation often misses the point.</p>
                    <p>To <strong>learn Darija</strong> is to learn how Moroccans actually speak: greetings first, politeness always, and a different expression for every situation. Langzio teaches <strong>Darija</strong> the way it lives — in context.</p>
                    <p><a class="lz-text-link" href="learn.php">Discover Moroccan Darija →</a></p>
                </div>
                <div>
                    <h3 style="margin:0 0 4px;color:var(--lz-green-deep)">Explore Moroccan Darija</h3>
                    <ul class="lz-topic-list">
                        <li><a href="guides.php">Moroccan Darija phrases <span>→</span></a></li>
                        <li><a href="guides.php">Moroccan Darija greetings <span>→</span></a></li>
                        <li><a href="guides.php">Moroccan Darija pronunciation <span>→</span></a></li>
                        <li><a href="blog.php">Moroccan Darija slang <span>→</span></a></li>
                        <li><a href="guides.php">Moroccan Darija for travelers <span>→</span></a></li>
                        <li><a href="blog.php">Moroccan culture &amp; etiquette <span>→</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="lz-section" id="faq" aria-labelledby="faq-title">
        <div class="lz-wrap">
            <p class="lz-eyebrow">FAQ</p>
            <h2 class="lz-h2" id="faq-title">Questions about Moroccan Darija</h2>
            <div class="lz-faq">
                <details>
                    <summary>What is Moroccan Darija?</summary>
                    <p>Moroccan Darija is the everyday spoken Arabic variety used across Morocco — at home, in cafés, shops, taxis, and daily conversations. It blends Arabic with Amazigh, French, Spanish, and other influences.</p>
                </details>
                <details>
                    <summary>Is Moroccan Darija the same as Arabic?</summary>
                    <p>Darija is an Arabic variety, but it differs clearly from Modern Standard Arabic in vocabulary, pronunciation, and grammar. Speakers learn it naturally in daily life rather than in school, which is why context matters so much.</p>
                </details>
                <details>
                    <summary>How difficult is Moroccan Darija to learn?</summary>
                    <p>Basic greetings and polite phrases are quick to pick up — words like Salam, 3afak, and Shukran go a long way. Deeper fluency takes practice in real situations, which is exactly what Langzio focuses on.</p>
                </details>
                <details>
                    <summary>How do you say common phrases in Moroccan Darija?</summary>
                    <p>Common examples: hello is Salam, please is 3afak, thank you is Shukran, and goodbye is Bslama. Each comes with its own tone and moment — Langzio explains when to use them.</p>
                </details>
                <details>
                    <summary>What is the difference between Moroccan Darija and Modern Standard Arabic?</summary>
                    <p>Modern Standard Arabic is used in formal writing, news, and education across the Arab world. Moroccan Darija is the spoken language of everyday Moroccan life, with its own expressions, simplifications, and borrowed words.</p>
                </details>
                <details>
                    <summary>Who is Langzio for?</summary>
                    <p>Langzio is designed for travelers visiting Morocco, Moroccan diaspora and families keeping the language alive, kids learning Darija at home, and anyone interested in Moroccan Darija and culture.</p>
                </details>
            </div>
        </div>
    </section>

    <section class="lz-section" aria-label="Join Langzio" style="padding-top:0">
        <div class="lz-wrap">
            <div class="lz-final">
                <h2>Ready to understand Moroccan Darija?</h2>
                <p>Start exploring Moroccan Darija, culture, and real-life conversations with Langzio.</p>
                <div class="lz-final-cta">
                    <a class="lz-btn lz-btn-primary" href="register.php">Join Langzio →</a>
                    <a class="lz-btn lz-btn-ghost" href="login.php">Log in</a>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="lz-footer">
    <div class="lz-wrap">
        <div class="lz-footer-grid">
            <div>
                <p class="lz-footer-brand">Langzio</p>
                <p class="lz-footer-tag">Learn. Understand. Connect.</p>
            </div>
            <nav aria-label="Learn Darija">
                <h3>Learn Darija</h3>
                <ul>
                    <li><a href="learn.php">Moroccan Darija</a></li>
                    <li><a href="guides.php">Darija phrases</a></li>
                    <li><a href="guides.php">Pronunciation</a></li>
                    <li><a href="blog.php">Dictionary</a></li>
                    <li><a href="blog.php">Slang</a></li>
                </ul>
            </nav>
            <nav aria-label="Situations">
                <h3>Situations</h3>
                <ul>
                    <li><a href="guides/restaurant/">Restaurant</a></li>
                    <li><a href="guides/taxi/">Taxi</a></li>
                    <li><a href="guides/souk/">Souk</a></li>
                    <li><a href="guides.php">Greetings</a></li>
                    <li><a href="guides/family/">Family</a></li>
                </ul>
            </nav>
            <nav aria-label="For">
                <h3>For</h3>
                <ul>
                    <li><a href="guides.php">Travelers</a></li>
                    <li><a href="kids.php">Diaspora</a></li>
                    <li><a href="kids.php">Kids</a></li>
                </ul>
            </nav>
            <nav aria-label="Langzio">
                <h3>Langzio</h3>
                <ul>
                    <li><a href="about.php">About</a></li>
                    <li><a href="guides.php">Guides</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
        <p class="lz-copyright">© 2026 Langzio. All rights reserved.</p>
    </div>
</footer>

<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"What is Moroccan Darija?","acceptedAnswer":{"@type":"Answer","text":"Moroccan Darija is the everyday spoken Arabic variety used across Morocco — at home, in cafés, shops, taxis, and daily conversations."}},{"@type":"Question","name":"Is Moroccan Darija the same as Arabic?","acceptedAnswer":{"@type":"Answer","text":"Darija is an Arabic variety, but it differs clearly from Modern Standard Arabic in vocabulary, pronunciation, and grammar."}},{"@type":"Question","name":"How difficult is Moroccan Darija to learn?","acceptedAnswer":{"@type":"Answer","text":"Basic greetings and polite phrases are quick to pick up. Deeper fluency takes practice in real situations."}},{"@type":"Question","name":"How do you say common phrases in Moroccan Darija?","acceptedAnswer":{"@type":"Answer","text":"Hello is Salam, please is 3afak, thank you is Shukran, and goodbye is Bslama."}},{"@type":"Question","name":"What is the difference between Moroccan Darija and Modern Standard Arabic?","acceptedAnswer":{"@type":"Answer","text":"Modern Standard Arabic is used in formal writing and education. Moroccan Darija is the spoken language of everyday Moroccan life."}},{"@type":"Question","name":"Who is Langzio for?","acceptedAnswer":{"@type":"Answer","text":"Langzio is designed for travelers visiting Morocco, Moroccan diaspora and families, kids learning Darija, and anyone interested in Moroccan Darija and culture."}}]}
</script>
<script>
document.addEventListener("DOMContentLoaded",function(){var b=document.getElementById("lzMenuBtn"),n=document.getElementById("lzNav");if(b&&n){b.addEventListener("click",function(){var o=n.classList.toggle("open");b.setAttribute("aria-expanded",o?"true":"false")})}});
</script>

<?php include "includes/footer.php"; ?>

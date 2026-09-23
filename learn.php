<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::startSession();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();

$pageTitle = "What is Moroccan Darija? Definition, Examples & How to Learn — Langzio";
$pageDescription = "Moroccan Darija is the everyday spoken Arabic variety used across Morocco. Definition, differences from Modern Standard Arabic, influences, common expressions with pronunciation, and how to start learning.";
$pageClass = "app-page";
$pageKeywords = "what is Moroccan Darija, Moroccan Arabic, Moroccan Darija definition, Darija vs Arabic, learn Darija, Darija expressions, Darija pronunciation";
$pageOgType = "article";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "Article",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/learn/#article",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/learn/",
    "headline" => "What is Moroccan Darija?",
    "description" => $pageDescription,
    "author" => [
        "@type" => "Organization",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#organization",
        "name" => "Langzio"
    ],
    "publisher" => [
        "@type" => "Organization",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#organization",
        "name" => "Langzio"
    ],
    "about" => [
        "@type" => "Language",
        "@id" => "https://www.wikidata.org/wiki/Q188325",
        "name" => "Moroccan Darija",
        "alternateName" => "Moroccan Arabic"
    ],
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
            <span aria-current="page">Learn Moroccan Darija</span>
        </nav>

        <article class="card" itemscope itemtype="https://schema.org/Article">
            <p style="color:var(--muted);font-size:0.85rem;margin:0 0 8px">Moroccan Darija · Definition &amp; guide</p>
            <h1 itemprop="headline">What is Moroccan Darija?</h1>
            <p itemprop="description" style="font-size:1.08rem;line-height:1.7"><strong>Moroccan Darija is the everyday spoken Arabic variety widely used in Morocco</strong> — at home, in cafés, shops, taxis, and daily conversations. It is the mother tongue of most Moroccans and the daily language of tens of millions of people.</p>

            <nav aria-label="On this page" style="margin:20px 0;padding:14px 18px;border:1px solid rgba(255,255,255,0.1);border-radius:12px">
                <strong>On this page</strong>
                <ul style="margin:8px 0 0;padding-left:20px;line-height:1.9">
                    <li><a href="#where-spoken">Where is Moroccan Darija spoken?</a></li>
                    <li><a href="#vs-msa">How is Darija different from Modern Standard Arabic?</a></li>
                    <li><a href="#influences">What languages influenced Darija?</a></li>
                    <li><a href="#expressions">Common Moroccan Darija expressions</a></li>
                    <li><a href="#start">How to start learning Darija</a></li>
                    <li><a href="#learn-faq">Frequently asked questions</a></li>
                </ul>
            </nav>

            <h2 id="where-spoken">Where is Moroccan Darija spoken?</h2>
            <p>Moroccan Darija is spoken throughout Morocco — in Casablanca, Rabat, Marrakech, Fes, Tangier, Agadir, and every town and village between them. It is also spoken by Moroccan diaspora communities in France, Spain, Belgium, the Netherlands, Italy, and beyond, where families keep it alive across generations.</p>

            <h2 id="vs-msa">How is Darija different from Modern Standard Arabic?</h2>
            <p>Modern Standard Arabic is the formal language of news, education, and official writing across the Arab world. Nobody speaks it at the Moroccan breakfast table. Darija is simpler in grammar, rich in borrowed words, and full of expressions that only make sense in context.</p>
            <div style="overflow-x:auto">
            <table style="width:100%;border-collapse:collapse;font-size:0.92rem" aria-label="Darija versus Modern Standard Arabic">
                <thead>
                    <tr style="text-align:left;border-bottom:1px solid rgba(255,255,255,0.15)">
                        <th style="padding:8px">Situation</th>
                        <th style="padding:8px">Modern Standard Arabic</th>
                        <th style="padding:8px">Moroccan Darija</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07)">
                        <td style="padding:8px">Hello</td>
                        <td style="padding:8px">As-salāmu ʿalaykum (formal)</td>
                        <td style="padding:8px"><strong>Salam</strong> — short, everyday</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07)">
                        <td style="padding:8px">Please</td>
                        <td style="padding:8px">Min faḍlik</td>
                        <td style="padding:8px"><strong>3afak</strong> (ʿafak) — softens any request</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07)">
                        <td style="padding:8px">Thank you</td>
                        <td style="padding:8px">Shukran</td>
                        <td style="padding:8px"><strong>Shukran / Shukran bzzaf</strong> — same root, warmer use</td>
                    </tr>
                    <tr>
                        <td style="padding:8px">How much?</td>
                        <td style="padding:8px">Kam ath-thaman?</td>
                        <td style="padding:8px"><strong>Bchhal hadchi?</strong> — souks and shops</td>
                    </tr>
                </tbody>
            </table>
            </div>

            <h2 id="influences">What languages influenced Darija?</h2>
            <p>Darija grew from Arabic roots mixed with <strong>Amazigh</strong> (the Indigenous languages of Morocco), plus centuries of contact with <strong>French</strong>, <strong>Spanish</strong>, and other Mediterranean languages. That is why a taxi ride in Casablanca can include Arabic grammar, a French word like <em>compteur</em> (meter), and a Spanish flavor in the north — all in one sentence.</p>

            <h2 id="expressions">Common Moroccan Darija expressions</h2>
            <p>Each expression below shows the Darija spelling learners actually type, the Arabic script, a pronunciation guide, the meaning, and when to use it.</p>
            <div style="overflow-x:auto">
            <table style="width:100%;border-collapse:collapse;font-size:0.92rem" aria-label="Common Darija expressions with pronunciation and context">
                <thead>
                    <tr style="text-align:left;border-bottom:1px solid rgba(255,255,255,0.15)">
                        <th style="padding:8px">Darija</th>
                        <th style="padding:8px">Arabic script</th>
                        <th style="padding:8px">Say it</th>
                        <th style="padding:8px">Meaning &amp; when</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07)">
                        <td style="padding:8px"><strong>Salam 3likom</strong></td>
                        <td style="padding:8px">سلام عليكم</td>
                        <td style="padding:8px">sa-lam ah-lee-kom</td>
                        <td style="padding:8px">Peace be upon you — the standard greeting, polite everywhere.</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07)">
                        <td style="padding:8px"><strong>3afak</strong></td>
                        <td style="padding:8px">عافاك</td>
                        <td style="padding:8px">ah-fak</td>
                        <td style="padding:8px">Please — softens any request. Use it every time you ask for something.</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07)">
                        <td style="padding:8px"><strong>Shukran bzzaf</strong></td>
                        <td style="padding:8px">شكرا بزاف</td>
                        <td style="padding:8px">shuk-ran bzz-zaf</td>
                        <td style="padding:8px">Thank you very much — warm gratitude, always appreciated.</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07)">
                        <td style="padding:8px"><strong>Labas?</strong></td>
                        <td style="padding:8px">لاباس؟</td>
                        <td style="padding:8px">la-bas</td>
                        <td style="padding:8px">How are you? / All good? — casual and friendly.</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07)">
                        <td style="padding:8px"><strong>Bslama</strong></td>
                        <td style="padding:8px">بسلامة</td>
                        <td style="padding:8px">bsla-ma</td>
                        <td style="padding:8px">Goodbye — neutral, works everywhere.</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07)">
                        <td style="padding:8px"><strong>Bchhal hadchi?</strong></td>
                        <td style="padding:8px">بشحال هادشي؟</td>
                        <td style="padding:8px">bsh-hal had-shi</td>
                        <td style="padding:8px">How much is this? — souks and shops, neutral.</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07)">
                        <td style="padding:8px"><strong>Fin kayn…?</strong></td>
                        <td style="padding:8px">فين كاين…؟</td>
                        <td style="padding:8px">fin kayn</td>
                        <td style="padding:8px">Where is…? — directions, add the place after it.</td>
                    </tr>
                    <tr>
                        <td style="padding:8px"><strong>Safi</strong></td>
                        <td style="padding:8px">صافي</td>
                        <td style="padding:8px">sa-fi</td>
                        <td style="padding:8px">Enough / OK / deal — meaning depends on tone and context.</td>
                    </tr>
                </tbody>
            </table>
            </div>

            <h2 id="start">How to start learning Darija</h2>
            <ol style="line-height:1.9">
                <li><strong>Master greetings first.</strong> Salam, Labas, and Bslama open every door in Morocco.</li>
                <li><strong>Learn polite softeners.</strong> 3afak before requests, Shukran after — tone matters more than grammar.</li>
                <li><strong>Practice real situations.</strong> Order food, take a taxi, greet a family — <a href="<?php echo htmlspecialchars(langzio_url('guides.php')); ?>">explore Darija phrases for restaurants, souks, and taxis</a>.</li>
                <li><strong>Learn Moroccan Darija pronunciation.</strong> Letters like 3 (ʿayn) and 7 (ḥā) have no English equivalent — hear them, then repeat them.</li>
                <li><strong>Keep it in the family.</strong> Diaspora parents can practice a few words daily with kids — <a href="<?php echo htmlspecialchars(langzio_url('kids.php')); ?>">try the 7-day Darija challenge for kids</a>.</li>
            </ol>

            <h2 id="learn-faq">Frequently asked questions</h2>
            <div class="lz-faq" style="max-width:none">
                <details>
                    <summary>What language is spoken in Morocco?</summary>
                    <p>Moroccans speak Moroccan Darija in daily life, alongside Amazigh languages. French is widely used in business and education, and Modern Standard Arabic in formal settings.</p>
                </details>
                <details>
                    <summary>How do Moroccans greet each other?</summary>
                    <p>With Salam 3likom, followed by Labas? and questions about family and health. Greetings are warm and take time — rushing them feels rude. Elders are greeted first.</p>
                </details>
                <details>
                    <summary>How long does it take to learn Darija?</summary>
                    <p>Polite basics take days. Comfortable everyday conversation takes months of regular practice in real situations. Daily micro-practice beats occasional long sessions.</p>
                </details>
                <details>
                    <summary>How do you order food in Moroccan Darija?</summary>
                    <p>Start with Salam, ask <em>Shno katnsa7ni?</em> (what do you recommend?), order with <em>3afak, bghit had lplat</em>, and close with <em>3afak, jib lia l7sab</em> for the bill. See the <a href="<?php echo htmlspecialchars(langzio_url('guides/restaurant/')); ?>">restaurant phrase guide</a>.</p>
                </details>
            </div>

            <h2>Keep learning</h2>
            <div style="display:flex;flex-wrap:wrap;gap:12px">
                <a href="<?php echo htmlspecialchars(langzio_url('guides.php')); ?>" class="btn btn-secondary">Moroccan Darija phrase guides</a>
                <a href="<?php echo htmlspecialchars(langzio_url('guides/souk/')); ?>" class="btn btn-secondary">Souk bargaining phrases</a>
                <a href="<?php echo htmlspecialchars(langzio_url('blog.php')); ?>" class="btn btn-secondary">Darija stories on the blog</a>
                <a href="<?php echo htmlspecialchars(langzio_url('translator.php')); ?>" class="btn btn-secondary">Try the Darija translator</a>
            </div>
        </article>
    </div>
</div>

<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"<?php echo LANGZIO_CANONICAL_DOMAIN; ?>/"},{"@type":"ListItem","position":2,"name":"Learn Moroccan Darija","item":"<?php echo LANGZIO_CANONICAL_DOMAIN; ?>/learn/"}]}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"What language is spoken in Morocco?","acceptedAnswer":{"@type":"Answer","text":"Moroccans speak Moroccan Darija in daily life, alongside Amazigh languages. French is widely used in business and education."}},{"@type":"Question","name":"How do Moroccans greet each other?","acceptedAnswer":{"@type":"Answer","text":"With Salam 3likom, followed by Labas? and questions about family and health. Elders are greeted first."}},{"@type":"Question","name":"How long does it take to learn Darija?","acceptedAnswer":{"@type":"Answer","text":"Polite basics take days. Comfortable everyday conversation takes months of regular practice in real situations."}},{"@type":"Question","name":"How do you order food in Moroccan Darija?","acceptedAnswer":{"@type":"Answer","text":"Start with Salam, ask for a recommendation, order with 3afak, and request the bill with 3afak, jib lia l7sab."}}]}
</script>

<?php include "includes/footer.php"; ?>

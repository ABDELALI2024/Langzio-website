<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::requireLogin();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();

$pageTitle = "Langzio Smart Guides — Moroccan Darija Phrase Guides";
$pageDescription = "Free Moroccan Darija phrase guides for Restaurant, Souk, Taxi, Family, and Travel situations. Each guide includes verified phrases, pronunciation, cultural context, and etiquette tips.";
$pageClass = "app-page";
$pageKeywords = "Moroccan Darija phrases, Morocco travel phrases, restaurant Darija, souk bargaining, taxi Arabic, Moroccan family greetings, Darija etiquette";
$pageOgType = "website";

$guidePhrases = [
    "restaurant" => [
        "name" => "Restaurant Guide",
        "description" => "Order politely, ask for recommendations, and request the bill naturally in Moroccan Darija.",
        "phrases" => [
            ["darija" => "Salam, wach kayn blassa?", "pronunciation" => "sa-lam, wach kayn blas-sa", "meaning" => "Hello, is there a table available?", "register" => "polite", "tip" => "Always start with Salam. Add '3afak' to soften."],
            ["darija" => "Shno katnsa7ni?", "pronunciation" => "shno kat-nsa7-ni", "meaning" => "What do you recommend?", "register" => "neutral", "tip" => "Locals appreciate when you ask for their favorite dish."],
            ["darija" => "3afak, bghit had lplat.", "pronunciation" => "afak, bghit had l-plat", "meaning" => "Please, I would like this dish.", "register" => "polite", "tip" => "Point at the menu while saying this for clarity."],
            ["darija" => "3afak, jib lia l7sab.", "pronunciation" => "afak, jib li-ya l-h-sab", "meaning" => "Please bring me the bill.", "register" => "polite", "tip" => "Make eye contact and smile when asking."],
            ["darija" => "Bsa7a.", "pronunciation" => "bsa-7a", "meaning" => "Enjoy your meal.", "register" => "warm", "tip" => "Say it when food arrives — to anyone at the table."],
            ["darija" => "Lmenu, 3afak.", "pronunciation" => "l-me-nu, afak", "meaning" => "The menu, please.", "register" => "polite", "tip" => "First thing to ask when you sit down."]
        ],
        "culturalTip" => "\"3afak\" (please) instantly makes your tone warmer and more local."
    ],
    "souk" => [
        "name" => "Souk Bargaining Guide",
        "description" => "Negotiate respectfully, compare prices, and close deals with confidence in Moroccan markets.",
        "phrases" => [
            ["darija" => "Bchhal hadchi?", "pronunciation" => "bch-hal had-chi", "meaning" => "How much is this?", "register" => "neutral", "tip" => "Ask before touching items to show respect."],
            ["darija" => "Ghaliya chwiya.", "pronunciation" => "gha-li-ya chwi-ya", "meaning" => "A bit expensive.", "register" => "casual", "tip" => "First counter-offer — expect to negotiate from here."],
            ["darija" => "A3tini taman lakhir.", "pronunciation" => "a3-ti-ni ta-man la-khir", "meaning" => "Give me your final price.", "register" => "direct", "tip" => "Use when ready to close the deal."],
            ["darija" => "Safi, ntafa9na.", "pronunciation" => "sa-fi, nta-fa9-na", "meaning" => "Deal, agreed.", "register" => "neutral", "tip" => "Seal with a handshake and smile."],
            ["darija" => "Shhal?", "pronunciation" => "sh-hal", "meaning" => "How much? (short form)", "register" => "neutral", "tip" => "Quickest way to ask the price anywhere."],
            ["darija" => "N9ass chwiya.", "pronunciation" => "n9ass chwi-ya", "meaning" => "Lower the price a bit.", "register" => "casual", "tip" => "Smile when you say it — bargaining stays friendly."]
        ],
        "culturalTip" => "Bargaining is normal in many souks, but stay friendly and smile. It's social interaction, not conflict."
    ],
    "taxi" => [
        "name" => "Taxi & Transport Guide",
        "description" => "Confirm destination, agree on fare, and avoid confusion before the ride starts.",
        "phrases" => [
            ["darija" => "Fin ghadi?", "pronunciation" => "fin gha-di", "meaning" => "Where are you going?", "register" => "neutral", "tip" => "Driver asks this — reply with your destination."],
            ["darija" => "Bghit nmshi l...", "pronunciation" => "bghit nmshi l", "meaning" => "I want to go to...", "register" => "neutral", "tip" => "Have your destination written in Arabic if possible."],
            ["darija" => "Bchhal lprix?", "pronunciation" => "bch-hal l-prix", "meaning" => "How much is the fare?", "register" => "neutral", "tip" => "Always ask before getting in petit taxis."],
            ["darija" => "Dir compteur, 3afak.", "pronunciation" => "dir kom-pt-eur, afak", "meaning" => "Please use the meter.", "register" => "polite", "tip" => "Legal requirement in cities — insist politely."],
            ["darija" => "Waqaf hna, 3afak.", "pronunciation" => "wa-qaf hna, afak", "meaning" => "Stop here, please.", "register" => "polite", "tip" => "Use landmarks, not just addresses."],
            ["darija" => "Dini l matar, 3afak.", "pronunciation" => "di-ni l ma-tar, afak", "meaning" => "Take me to the airport, please.", "register" => "polite", "tip" => "Say the destination first, then 3afak."],
            ["darija" => "Shhal khassni nkhallas?", "pronunciation" => "sh-hal khass-ni n-khallass", "meaning" => "How much do I have to pay?", "register" => "neutral", "tip" => "Ask at the end of the ride, before paying."]
        ],
        "culturalTip" => "Confirm the price before entering when meter use is unclear. Petit taxis use meters; grand taxis are shared fixed-route."
    ],
    "family" => [
        "name" => "Family & Social Guide",
        "description" => "Use warm expressions for greetings, gratitude, and respectful visits with Moroccan families.",
        "phrases" => [
            ["darija" => "Salam 3likom.", "pronunciation" => "sa-lam 3li-kom", "meaning" => "Peace be upon you.", "register" => "respectful", "tip" => "Standard greeting — use with everyone."],
            ["darija" => "Labas 3likom?", "pronunciation" => "la-bas 3li-kom", "meaning" => "How is everyone?", "register" => "warm", "tip" => "Ask about the whole family, not just the person."],
            ["darija" => "Shukran bzzaf.", "pronunciation" => "shuk-ran bz-zaf", "meaning" => "Thank you very much.", "register" => "warm", "tip" => "Generous gratitude is expected and appreciated."],
            ["darija" => "Allah yhafdek.", "pronunciation" => "al-lah y-haf-dek", "meaning" => "May God protect you.", "register" => "blessing", "tip" => "Common response to thanks or goodbye."],
            ["darija" => "Mtsharfin b ziyartkom.", "pronunciation" => "mts-har-fin b zi-yar-tkom", "meaning" => "We are honored by your visit.", "register" => "formal", "tip" => "Host says this to guests — reciprocal respect."],
            ["darija" => "Mabrouk.", "pronunciation" => "mab-rouk", "meaning" => "Congratulations.", "register" => "warm", "tip" => "For weddings, births, exams, new jobs — everything happy."],
            ["darija" => "Tbarak Allah 3lik.", "pronunciation" => "tba-rak al-lah 3lik", "meaning" => "God bless you / well done.", "register" => "warm", "tip" => "Praise for kids, cooks, and good news."]
        ],
        "culturalTip" => "Family settings value politeness and appreciation more than perfect grammar. Elders are greeted first."
    ],
    "travel" => [
        "name" => "Travel Essentials Guide",
        "description" => "Navigate directions, connectivity, and daily needs while traveling in Morocco.",
        "phrases" => [
            ["darija" => "Fin kayn...?", "pronunciation" => "fin kayn", "meaning" => "Where is...?", "register" => "neutral", "tip" => "Add location: 'Fin kayn l-hammam?' (Where is the bathroom?)"],
            ["darija" => "Bghit nmshi l...", "pronunciation" => "bghit nmshi l", "meaning" => "I want to go to...", "register" => "neutral", "tip" => "Works for taxis, walking directions, buses."],
            ["darija" => "Wach kayn wifi?", "pronunciation" => "wach kayn wai-fai", "meaning" => "Is there WiFi?", "register" => "casual", "tip" => "Essential in cafés and hotels."],
            ["darija" => "Ana tleft.", "pronunciation" => "a-na tleft", "meaning" => "I'm lost.", "register" => "neutral", "tip" => "Say it with a smile — Moroccans love helping with directions."],
            ["darija" => "Lgare fin kayn?", "pronunciation" => "l-gar fin kayn", "meaning" => "Where is the train station?", "register" => "neutral", "tip" => "Replace lgare with lmatar (airport) or any place."]
        ],
        "culturalTip" => "Moroccans are generally helpful with directions — start with Salam and they'll often walk you there."
    ]
];

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "ItemList",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/guides/#guides-list",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/guides/",
    "name" => "Langzio Smart Guides — Moroccan Darija Phrase Guides",
    "description" => "Free Moroccan Darija phrase guides for Restaurant, Souk, Taxi, Family, and Travel situations with verified phrases, pronunciation, and cultural context.",
    "numberOfItems" => count($guidePhrases),
    "itemListElement" => [
        ["@type" => "ListItem", "position" => 1, "url" => LANGZIO_CANONICAL_DOMAIN . "/guides/restaurant/"],
        ["@type" => "ListItem", "position" => 2, "url" => LANGZIO_CANONICAL_DOMAIN . "/guides/souk/"],
        ["@type" => "ListItem", "position" => 3, "url" => LANGZIO_CANONICAL_DOMAIN . "/guides/taxi/"],
        ["@type" => "ListItem", "position" => 4, "url" => LANGZIO_CANONICAL_DOMAIN . "/guides/family/"],
        ["@type" => "ListItem", "position" => 5, "url" => LANGZIO_CANONICAL_DOMAIN . "/guides/travel/"],
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
            <a class="active" href="guides.php">Guides</a>
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
            <h1>Smart Guides</h1>
            <a class="btn btn-secondary compact" href="dashboard.php">Dashboard</a>
        </header>
        <?php if ($user): ?>
        <p style="margin: -10px 0 20px; color: var(--text-dim, #aaa); font-size: 0.9rem;">Salam, <?php echo htmlspecialchars($user["name"]); ?></p>
        <?php endif; ?>

        <section class="card guides-intro" aria-labelledby="guides-intro-title">
            <h2 id="guides-intro-title">Morocco Phrase Playbooks</h2>
            <p>Use these practical packs in real situations. Each guide includes high-value phrases, what they mean, and quick etiquette notes so you can sound natural and respectful.</p>
            <div class="guides-toolbar">
                <input id="guidesSearch" type="text" placeholder="Search phrase or meaning (ex: bill, taxi, shukran)" aria-label="Search phrases">
                <div class="guides-feedback" id="guidesFeedback" aria-live="polite">Browse all phrase packs.</div>
            </div>
        </section>

        <section class="guide-grid" aria-labelledby="guides-grid-title">
            <h2 id="guides-grid-title" class="visually-hidden">Guide Categories</h2>
            <?php foreach ($guidePhrases as $slug => $guide): ?>
            <article class="card guide-card" itemscope itemtype="https://schema.org/Guide">
                <meta itemprop="name" content="<?php echo htmlspecialchars($guide["name"]); ?>">
                <meta itemprop="description" content="<?php echo htmlspecialchars($guide["description"]); ?>">
                <link itemprop="url" href="<?php echo LANGZIO_CANONICAL_DOMAIN; ?>/guides/<?php echo $slug; ?>/">
                <h3 itemprop="name"><?php echo htmlspecialchars($guide["name"]); ?></h3>
                <p><?php echo htmlspecialchars($guide["description"]); ?></p>
                <div class="guide-section">
                    <h4>Essential Phrases</h4>
                    <ul>
                        <?php foreach ($guide["phrases"] as $phrase): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($phrase["darija"]); ?></strong> 
                            <span class="pronunciation" style="color:var(--muted);font-size:0.85rem;margin-left:8px">[<?php echo htmlspecialchars($phrase["pronunciation"]); ?>]</span>
                            - <?php echo htmlspecialchars($phrase["meaning"]); ?>
                            <span class="register-badge" style="margin-left:8px;padding:2px 6px;border-radius:4px;background:var(--green-2);color:#03170f;font-size:0.7rem;font-weight:600"><?php echo htmlspecialchars($phrase["register"]); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="guide-tip" itemprop="description"><?php echo htmlspecialchars($guide["culturalTip"]); ?></div>
                <a href="<?php echo langzio_url("guides/$slug/"); ?>" class="btn btn-secondary compact" style="margin-top:12px;display:inline-block">View Full Guide →</a>
            </article>
            <?php endforeach; ?>
        </section>

        <section class="card" aria-labelledby="etiquette-title">
            <h2 id="etiquette-title">Quick Etiquette Cheatsheet</h2>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                <div>
                    <h4>Do</h4>
                    <ul>
                        <li>Start conversations with "Salam".</li>
                        <li>Use "3afak" when requesting help.</li>
                        <li>Thank often: "Shukran".</li>
                    </ul>
                </div>
                <div>
                    <h4>Avoid</h4>
                    <ul>
                        <li>Using a very direct tone without greeting.</li>
                        <li>Assuming all prices are fixed in souks.</li>
                        <li>Rushing social interactions with elders.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="card" aria-labelledby="favorites-title">
            <h2 id="favorites-title">Saved Favorites</h2>
            <p>Your starred phrases are stored in this browser.</p>
            <ul id="favoritePhrases"></ul>
        </section>
    </div>
</div>

<script src="<?php echo htmlspecialchars(langzio_url('assets/js/voice.js'), ENT_QUOTES, 'UTF-8'); ?>"></script>
<?php include "includes/footer.php"; ?>
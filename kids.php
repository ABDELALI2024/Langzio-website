<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::startSession();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();
$isLoggedIn = Auth::check();

$pageTitle = "Langzio Kids — 7-Day Darija Challenge for Families";
$pageDescription = "Help your children learn Moroccan Darija with our free 7-day family challenge: 5 words daily with flashcards, pronunciation, streaks, and progress tracking. Built for Moroccan diaspora families abroad.";
$pageClass = "app-page kids-page";
$pageKeywords = "learn Darija for kids, Moroccan Arabic children, Darija flashcards, 7-day language challenge, Moroccan diaspora kids, teach children Darija";
$pageOgType = "website";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "Course",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/kids/#course",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/kids/",
    "name" => "Langzio 7-Day Darija Challenge",
    "description" => "Free 7-day family challenge to learn Moroccan Darija: 5 words daily with flashcards, pronunciation, streaks, and progress tracking. Built for Moroccan diaspora families abroad.",
    "provider" => [
        "@type" => "Organization",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#organization"
    ],
    "offers" => [
        "@type" => "Offer",
        "name" => "Free Access",
        "price" => "0",
        "priceCurrency" => "USD",
        "availability" => "https://schema.org/InStock",
        "url" => LANGZIO_CANONICAL_DOMAIN . "/kids/"
    ],
    "hasCourseInstance" => [
        "@type" => "CourseInstance",
        "courseMode" => "online",
        "duration" => "P7D",
        "schedule" => "Daily",
        "offers" => [
            "@type" => "Offer",
            "price" => "0",
            "priceCurrency" => "USD"
        ]
    ],
    "teaches" => [
        "Moroccan Darija Vocabulary (35 core words)",
        "Darija Pronunciation",
        "Basic Greetings & Politeness",
        "Cultural Context for Children"
    ],
    "educationalLevel" => "Beginner",
    "audience" => [
        "@type" => "Audience",
        "audienceType" => "Children (5-12), Parents, Moroccan Diaspora Families"
    ],
    "inLanguage" => "en-US",
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "hasPart" => [
        [
            "@type" => "Lesson",
            "name" => "Day 1: Greetings & Basics",
            "description" => "Salam, Labas, Shukran, Bslama, 3afak",
            "position" => 1
        ],
        [
            "@type" => "Lesson",
            "name" => "Day 2: Family Words",
            "description" => "Mama, Baba, Jadd, Jidda, Khou, Oukht",
            "position" => 2
        ],
        [
            "@type" => "Lesson",
            "name" => "Day 3: Food & Drink",
            "description" => "Lhma, Khobz, L7lib, Lma, Atay",
            "position" => 3
        ],
        [
            "@type" => "Lesson",
            "name" => "Day 4: Home & Daily Life",
            "description" => "Dar, Bit, Sria, M3a, Ftour",
            "position" => 4
        ],
        [
            "@type" => "Lesson",
            "name" => "Day 5: Feelings & Actions",
            "description" => "Mzyan, Krah, Bghit, Ma3lich, Wakha",
            "position" => 5
        ],
        [
            "@type" => "Lesson",
            "name" => "Day 6: Politeness & Respect",
            "description" => "3afak, Shukran bzzaf, Allah ykhalik, Mzyan 3lik",
            "position" => 6
        ],
        [
            "@type" => "Lesson",
            "name" => "Day 7: Celebration & Review",
            "description" => "Mabrouk, Tbarak Allah, Ana mghribi, N7ebblkom",
            "position" => 7
        ]
    ]
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
            <a class="active" href="kids.php">Kids</a>
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
            <h1>7-Day Darija Challenge</h1>
            <button class="btn btn-secondary compact" id="installAppBtn" type="button">Install app</button>
        </header>

        <section class="card challenge-card" aria-labelledby="challenge-title">
            <div class="challenge-header">
                <div>
                    <h2 id="challenge-title">Family challenge</h2>
                    <p id="challengeStatus">Practice 5 words a day for 7 days.</p>
                </div>
                <div class="challenge-badge hidden" id="challengeBadge" aria-live="polite"></div>
            </div>
            <div class="challenge-days" id="challengeDays" role="list" aria-label="Challenge days"></div>
            <div class="challenge-progress">
                <div class="challenge-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><span id="challengeBarFill"></span></div>
                <p id="challengeToday">Today: 0 / 5 words</p>
            </div>
        </section>

        <section class="card kids-card" aria-labelledby="flashcards-title">
            <div class="kids-stats" aria-label="Learning statistics">
                <span>🔥 Streak: <strong id="kidsStreak">0</strong> days</span>
                <span>⭐ Learned: <strong id="kidsLearned">0</strong></span>
            </div>
            <h2 id="flashcards-title">Flashcards</h2>
            <div class="flashcard" id="flashcardWord" role="region" aria-label="Current flashcard">Salam = Hello</div>
            <div class="hero-cta">
                <button class="btn btn-primary" id="nextFlashcardBtn" type="button">Next Word</button>
                <button class="btn btn-secondary" id="speakWordBtn" type="button" aria-label="Play pronunciation">Play Sound</button>
                <button class="btn btn-secondary" id="shareWordBtn" type="button">Share</button>
            </div>
            <p class="kids-note">Built for Moroccan families abroad — 5 words daily keeps Darija alive between visits home.</p>
        </section>

        <?php if (!$isLoggedIn): ?>
        <section class="card" style="text-align:center;background:rgba(0,211,139,0.06);border-color:rgba(0,211,139,0.3)">
            <h2>Track Progress & Save Streaks</h2>
            <p style="color:var(--muted);margin:16px 0">Create a free account to save your child's progress, maintain streaks across devices, and unlock all 7 days.</p>
            <a class="btn btn-primary" href="<?php echo htmlspecialchars(langzio_url('register.php')); ?>">Start Free Challenge</a>
        </section>
        <?php endif; ?>

        <section class="card" aria-labelledby="methodology-title">
            <h2 id="methodology-title">How the Challenge Works</h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;margin-top:16px">
                <article class="method-step">
                    <div class="step-number">1</div>
                    <h4>Daily Words</h4>
                    <p>5 curated Darija words each day with pronunciation and cultural context.</p>
                </article>
                <article class="method-step">
                    <div class="step-number">2</div>
                    <h4>Flashcards</h4>
                    <p>Interactive cards with audio pronunciation and visual associations.</p>
                </article>
                <article class="method-step">
                    <div class="step-number">3</div>
                    <h4>Streaks</h4>
                    <p>Daily practice builds momentum — miss a day, keep the habit.</p>
                </article>
                <article class="method-step">
                    <div class="step-number">4</div>
                    <h4>Family Sharing</h4>
                    <p>Share progress with grandparents via WhatsApp — they'll love it.</p>
                </article>
            </div>
        </section>

        <section class="card" aria-labelledby="why-title">
            <h2 id="why-title">Why Families Choose Langzio Kids</h2>
            <ul style="list-style:none;padding:0">
                <li style="margin:12px 0;padding-left:28px;position:relative">
                    <span style="position:absolute;left:0;color:var(--green-2)">✓</span>
                    <strong>Culturally Authentic:</strong> Words chosen by native speakers for real family use.
                </li>
                <li style="margin:12px 0;padding-left:28px;position:relative">
                    <span style="position:absolute;left:0;color:var(--green-2)">✓</span>
                    <strong>Pronunciation First:</strong> Audio + Arabizi guide so parents can help.
                </li>
                <li style="margin:12px 0;padding-left:28px;position:relative">
                    <span style="position:absolute;left:0;color:var(--green-2)">✓</span>
                    <strong>Diaspora-Designed:</strong> Built for families between visits to Morocco.
                </li>
                <li style="margin:12px 0;padding-left:28px;position:relative">
                    <span style="position:absolute;left:0;color:var(--green-2)">✓</span>
                    <strong>Privacy-Focused:</strong> No ads, no tracking, data stays yours.
                </li>
            </ul>
        </section>
    </div>
</div>

<?php include "includes/footer.php"; ?>
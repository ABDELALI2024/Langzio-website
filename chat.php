<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::startSession();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();
$isLoggedIn = Auth::check();

$pageTitle = "Langzio AI Chat — Cultural Moroccan Darija Assistant";
$pageDescription = "Chat with AI about Moroccan Darija, culture, etiquette, and travel. Get culturally grounded answers with conversation memory. Ask about phrases, pronunciation, customs, slang, and more.";
$pageClass = "app-page";
$pageKeywords = "Darija AI chat, Moroccan Arabic assistant, Morocco culture AI, Darija tutor, cultural etiquette Morocco, learn Darija chatbot";
$pageOgType = "website";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "SoftwareApplication",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/chat/#app",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/chat/",
    "name" => "Langzio AI Chat",
    "applicationCategory" => "EducationalApplication",
    "operatingSystem" => "Web, PWA",
    "offers" => [
        [
            "@type" => "Offer",
            "name" => "Free Trial",
            "price" => "0",
            "priceCurrency" => "USD",
            "availability" => "https://schema.org/InStock",
            "description" => "7-day trial with full chat access",
            "url" => LANGZIO_CANONICAL_DOMAIN . "/register.php"
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
    "description" => "Conversational AI tutor for Moroccan Darija and Moroccan culture. Maintains conversation memory, grounded in verified phrase corpus, provides cultural etiquette, slang explanations, and nuanced language guidance.",
    "featureList" => [
        "Conversation Memory Across Sessions",
        "RAG-Grounded Cultural Knowledge",
        "Etiquette & Social Norm Guidance",
        "Slang & Idiom Explanations",
        "Grammar Clarification",
        "Pronunciation Assistance",
        "Multi-turn Cultural Conversations"
    ],
    "usesTechnology" => "Verified phrase corpus (local mode)",
    "provider" => [
        "@type" => "Organization",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#organization"
    ],
    "inLanguage" => ["en", "ary"],
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
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
            <a class="active" href="chat.php">AI Chat</a>
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
            <h1>Cultural AI Chat</h1>
            <button class="btn btn-secondary compact" id="clearChatBtn" type="button">Clear History</button>
        </header>

        <?php if (!$isLoggedIn): ?>
        <section class="card" style="background:rgba(0,211,139,0.06);border-color:rgba(0,211,139,0.3);margin-bottom:20px">
            <h2>Try the Cultural AI Chat</h2>
            <p>Ask about Darija phrases, Moroccan etiquette, travel tips, or cultural nuances. <a href="<?php echo htmlspecialchars(langzio_url('register.php')); ?>">Create a free account</a> for full access with conversation memory.</p>
        </section>
        <?php endif; ?>

        <div class="chat-container" role="region" aria-label="Chat interface">
            <div class="chat-messages" id="chatMessages" aria-live="polite" aria-label="Conversation">
                <div class="message ai">Salam! I can help you with Darija phrases and Moroccan social etiquette. Ask me anything about Morocco — translations, cultural norms, pronunciation, slang, or travel advice.</div>
            </div>
            <div class="chat-input-bar">
                <label for="chatInput" class="visually-hidden">Your message</label>
                <input type="text" id="chatInput" placeholder="Ask anything about Morocco..." autocomplete="off" aria-label="Type your question">
                <button id="sendChatBtn" type="button" aria-label="Send message">Send</button>
            </div>
            <p class="hidden" id="chatTyping" style="color:var(--green-1);font-size:0.85rem" aria-live="polite">Thinking...</p>
        </div>

        <section class="card" aria-labelledby="chat-examples-title" style="margin-top:24px">
            <h2 id="chat-examples-title">Example Questions You Can Ask</h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:12px">
                <button class="btn btn-secondary" type="button" data-prompt="How do you say 'thank you' in Darija and when should I use different forms?">💬 "How do you say thank you in Darija?"</button>
                <button class="btn btn-secondary" type="button" data-prompt="What are the most important cultural etiquette rules for tourists in Morocco?">🎭 "Moroccan etiquette for tourists"</button>
                <button class="btn btn-secondary" type="button" data-prompt="Explain the difference between Darija and Modern Standard Arabic">📚 "Darija vs MSA differences"</button>
                <button class="btn btn-secondary" type="button" data-prompt="How do I bargain respectfully in a Moroccan souk?">🛍️ "Souk bargaining tips"</button>
                <button class="btn btn-secondary" type="button" data-prompt="What does the number 3 mean in Arabizi/Darija texting?">🔢 "Arabizi numbers explained"</button>
                <button class="btn btn-secondary" type="button" data-prompt="Teach me 5 essential phrases for a taxi ride in Morocco">🚕 "Taxi phrases in Darija"</button>
            </div>
        </section>

        <section class="card" aria-labelledby="chat-features-title" style="margin-top:16px">
            <h2 id="chat-features-title">Why Chat with Langzio?</h2>
            <ul style="list-style:none;padding:0">
                <li style="margin:12px 0;padding-left:28px;position:relative">
                    <span style="position:absolute;left:0;color:var(--green-2)">✓</span>
                    <strong>Culturally Grounded:</strong> Answers backed by verified phrases, not hallucinations.
                </li>
                <li style="margin:12px 0;padding-left:28px;position:relative">
                    <span style="position:absolute;left:0;color:var(--green-2)">✓</span>
                    <strong>Conversation Memory:</strong> Remembers context across your session.
                </li>
                <li style="margin:12px 0;padding-left:28px;position:relative">
                    <span style="position:absolute;left:0;color:var(--green-2)">✓</span>
                    <strong>Etiquette-First:</strong> Every answer includes cultural context.
                </li>
                <li style="margin:12px 0;padding-left:28px;position:relative">
                    <span style="position:absolute;left:0;color:var(--green-2)">✓</span>
                    <strong>Learner-Friendly:</strong> Explains register, pronunciation, and usage.
                </li>
            </ul>
        </section>
    </div>
</div>

<?php include "includes/footer.php"; ?>
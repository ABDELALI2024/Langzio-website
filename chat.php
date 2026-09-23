<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::requireLogin();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();

$pageTitle = "Langzio AI Chat — Cultural Moroccan Darija Assistant";
$pageDescription = "Chat with AI about Moroccan Darija, culture, etiquette, and travel. Get culturally grounded answers with conversation memory. Ask about phrases, pronunciation, customs, slang, and more.";
$pageClass = "app-page ai-studio";
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
            "name" => "Free Access",
            "price" => "0",
            "priceCurrency" => "USD",
            "availability" => "https://schema.org/InStock",
            "description" => "Free account with chat access",
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
    "usesTechnology" => "RAG (Retrieval-Augmented Generation) with Llama 3.3 70B",
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
<link rel="stylesheet" href="<?php echo htmlspecialchars(langzio_url('assets/css/studio.css'), ENT_QUOTES, 'UTF-8'); ?>">
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
            <a href="blog.php">Blog</a>
            <hr style="border-color:rgba(255,255,255,0.08);margin:12px 0">
            <a href="profile.php">Profile</a>
            <a href="pricing.php">Pricing</a>
            <a href="logout.php">Log out</a>
        </nav>
        <div style="margin-top:auto;padding:12px;border-radius:10px;background:rgba(0,211,139,0.08);font-size:0.85rem;text-align:center">
            <?php if ($subStatus["is_subscribed"]): ?>
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

        <div class="studio-chat glass" role="region" aria-label="Chat interface">
            <div class="studio-chips" aria-label="Suggested questions">
                <button class="studio-chip" type="button" data-prompt="How do you say 'thank you' in Darija and when should I use different forms?">Thank you in Darija?</button>
                <button class="studio-chip" type="button" data-prompt="What are the most important cultural etiquette rules for tourists in Morocco?">Etiquette for tourists</button>
                <button class="studio-chip" type="button" data-prompt="How do I bargain respectfully in a Moroccan souk?">Souk bargaining</button>
                <button class="studio-chip" type="button" data-prompt="Teach me 5 essential phrases for a taxi ride in Morocco">Taxi phrases</button>
            </div>
            <div class="chat-messages" id="chatMessages" aria-live="polite" aria-label="Conversation">
                <div class="message ai">Salam! I can help you with Darija phrases and Moroccan social etiquette. Ask me anything about Morocco — translations, cultural norms, pronunciation, slang, or travel advice.</div>
            </div>
            <p class="hidden" id="chatTyping" aria-live="polite">Thinking</p>
            <div class="studio-inputbar">
                <label for="chatInput" class="visually-hidden">Your message</label>
                <input type="text" id="chatInput" placeholder="Ask anything about Morocco…" autocomplete="off" aria-label="Type your question">
                <button id="chatMicBtn" class="studio-mini-btn" type="button" aria-label="Dictate message by voice">Mic</button>
                <button id="sendChatBtn" type="button" aria-label="Send message">Send →</button>
            </div>
        </div>
        <script>
        document.addEventListener("DOMContentLoaded", () => {
            const input = document.getElementById("chatInput");
            const send = document.getElementById("sendChatBtn");
            document.querySelectorAll(".studio-chip").forEach((chip) => {
                chip.addEventListener("click", () => {
                    if (!input || !send) return;
                    input.value = chip.dataset.prompt || chip.textContent || "";
                    input.focus();
                    send.click();
                });
            });
        });
        </script>

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

<script src="<?php echo htmlspecialchars(langzio_url('assets/js/voice.js'), ENT_QUOTES, 'UTF-8'); ?>"></script>
<?php include "includes/footer.php"; ?>
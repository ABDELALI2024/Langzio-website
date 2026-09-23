<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::startSession();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();

// PayPal button renders only when both credentials are configured.
// Otherwise the SDK falls back to client-id=test and every payment fails.
$paypalConfigured = langzio_env("PAYPAL_CLIENT_ID", "") !== ""
    && langzio_env("PAYPAL_PLAN_ID", "") !== "";

$pageTitle = "Pricing — Langzio";
$pageDescription = "Choose your Langzio plan: Free tier with limited access, or Pro for unlimited translations, AI chat, cultural insights, and all guides. 7-day free trial, no credit card required.";
$pageClass = "app-page";
$pageKeywords = "Langzio pricing, Darija translator cost, Moroccan Arabic learning subscription, Langzio Pro, free trial Darija";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/pricing.php#page",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/pricing.php",
    "name" => "Langzio Pricing Plans",
    "description" => "Choose your Langzio plan: Free tier with limited access, or Pro for unlimited translations, AI chat, cultural insights, and all guides. 7-day free trial, no credit card required.",
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "mainEntity" => [
        "@type" => "PriceSpecification",
        "priceCurrency" => "USD",
        "minPrice" => "0",
        "maxPrice" => "9",
        "billingDuration" => "P1M"
    ],
    "hasPart" => [
        [
            "@type" => "Offer",
            "name" => "Free Plan",
            "price" => "0",
            "priceCurrency" => "USD",
            "availability" => "https://schema.org/InStock",
            "description" => "Limited translations, basic chat, kids flashcards",
            "url" => LANGZIO_CANONICAL_DOMAIN . "/register.php"
        ],
        [
            "@type" => "Offer",
            "name" => "Pro Plan",
            "price" => "9",
            "priceCurrency" => "USD",
            "priceSpecification" => [
                "@type" => "UnitPriceSpecification",
                "price" => "9",
                "priceCurrency" => "USD",
                "billingDuration" => "P1M"
            ],
            "availability" => "https://schema.org/InStock",
            "description" => "Unlimited translations, unlimited AI chat, cultural insights, all guides & flashcards, priority support",
            "url" => LANGZIO_CANONICAL_DOMAIN . "/pricing.php"
        ]
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
            <a class="active" href="pricing.php" aria-current="page">Pricing</a>
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
            <h1>Choose your plan</h1>
        </header>

        <section class="dashboard-grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr))" aria-labelledby="plans-title">
            <h2 id="plans-title" class="visually-hidden">Pricing Plans</h2>
            <article class="card" style="text-align:center;padding:28px" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <meta itemprop="name" content="Free Plan">
                <meta itemprop="price" content="0">
                <meta itemprop="priceCurrency" content="USD">
                <meta itemprop="availability" content="https://schema.org/InStock">
                <link itemprop="url" href="<?php echo LANGZIO_CANONICAL_DOMAIN; ?>/register.php">
                <h3>Free</h3>
                <p style="font-size:2rem;font-weight:800;margin:12px 0"><span itemprop="price">$0</span></p>
                <ul style="list-style:none;padding:0;text-align:left;color:var(--muted)">
                    <li>✓ Limited translations</li>
                    <li>✓ Basic chat</li>
                    <li>✓ Kids flashcards</li>
                </ul>
                <?php if ($user && $subStatus["plan"] === "free"): ?>
                    <span class="badge" style="margin-top:16px" itemprop="description">Current plan</span>
                <?php else: ?>
                    <a class="btn btn-secondary" href="<?php echo htmlspecialchars(langzio_url($user ? 'dashboard.php' : 'register.php')); ?>" style="margin-top:16px;display:inline-block" itemprop="url">
                        <?php echo $user ? "Current plan" : "Start free"; ?>
                    </a>
                <?php endif; ?>
            </article>

            <article class="card" style="text-align:center;padding:28px;border-color:var(--green);background:rgba(0,211,139,0.06)" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <meta itemprop="name" content="Pro Plan">
                <meta itemprop="price" content="9">
                <meta itemprop="priceCurrency" content="USD">
                <meta itemprop="availability" content="https://schema.org/InStock">
                <link itemprop="url" href="<?php echo LANGZIO_CANONICAL_DOMAIN; ?>/pricing.php">
                <span class="badge">Popular</span>
                <h3>Pro</h3>
                <p style="font-size:2rem;font-weight:800;margin:12px 0"><span itemprop="price">$9</span><span style="font-size:1rem;color:var(--muted)">/month</span></p>
                <ul style="list-style:none;padding:0;text-align:left;color:var(--muted)">
                    <li>✓ Unlimited translations</li>
                    <li>✓ Unlimited AI chat</li>
                    <li>✓ Cultural insights</li>
                    <li>✓ All guides & flashcards</li>
                    <li>✓ Priority support</li>
                </ul>
                <?php if ($subStatus["plan"] === "pro"): ?>
                    <span class="badge" style="margin-top:16px" itemprop="description">Active</span>
                <?php elseif ($user && $paypalConfigured): ?>
                    <div id="paypal-button-container" style="margin-top:16px"></div>
                <?php elseif ($user): ?>
                    <p style="margin-top:16px;color:var(--muted);font-size:0.9rem" itemprop="description">Online payment coming soon — your trial covers you for now.</p>
                <?php else: ?>
                    <a class="btn btn-primary" href="<?php echo htmlspecialchars(langzio_url('register.php')); ?>" style="margin-top:16px;display:inline-block" itemprop="url">Start free trial</a>
                <?php endif; ?>
            </article>
        </section>

        <section class="card" style="text-align:center" aria-labelledby="trial-title">
            <h2 id="trial-title">Start with a free trial</h2>
            <p style="color:var(--muted)">7 days full access. No credit card needed.</p>
            <a class="btn btn-primary" href="<?php echo htmlspecialchars(langzio_url('register.php')); ?>">Create free account</a>
        </section>

        <section class="card" aria-labelledby="faq-title" style="margin-top:24px">
            <h2 id="faq-title">Frequently Asked Questions</h2>
            <dl style="margin-top:16px">
                <dt>What's included in the 7-day free trial?</dt>
                <dd style="margin:8px 0 24px;color:var(--muted)">Full Pro access: unlimited translations, AI chat, all guides, kids challenge, and cultural insights. No credit card required to start.</dd>
                
                <dt>Can I cancel anytime?</dt>
                <dd style="margin:8px 0 24px;color:var(--muted)">Yes. Cancel from your dashboard or PayPal. Access continues until the end of your billing period.</dd>
                
                <dt>What payment methods do you accept?</dt>
                <dd style="margin:8px 0 24px;color:var(--muted)">PayPal (credit/debit cards, PayPal balance). Secure, no card details stored on our servers.</dd>
                
                <dt>Is there a lifetime plan?</dt>
                <dd style="margin:8px 0 24px;color:var(--muted)">Not currently. We focus on sustainable monthly pricing to keep improving the product.</dd>
                
                <dt>Do you offer family or team plans?</dt>
                <dd style="margin:8px 0 24px;color:var(--muted)">Family sharing is on our roadmap. For now, each account is individual.</dd>
            </dl>
        </section>
    </div>
</div>

<?php if ($paypalConfigured): ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo htmlspecialchars(langzio_env('PAYPAL_CLIENT_ID')); ?>&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("paypal-button-container");
    if (!container || typeof paypal === "undefined") return;

    paypal.Buttons({
        style: {
            shape: "rect",
            color: "gold",
            layout: "vertical",
            label: "subscribe"
        },
        createSubscription: function(data, actions) {
            return actions.subscription.create({
                plan_id: "<?php echo htmlspecialchars(langzio_env('PAYPAL_PLAN_ID', '')); ?>"
            });
        },
        onApprove: async function(data) {
            const resp = await fetch("<?php echo htmlspecialchars(langzio_url('api/paypal/subscription-approve.php')); ?>", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ subscriptionID: data.subscriptionID })
            });
            const result = await resp.json();
            if (result.success) {
                window.location.href = "<?php echo htmlspecialchars(langzio_url('dashboard.php')); ?>";
            } else {
                alert("Subscription activation failed. Please contact support.");
            }
        },
        onError: function(err) {
            alert("PayPal error: " + err.message);
        }
    }).render("#paypal-button-container");
});
</script>
<?php endif; ?>

<?php include "includes/footer.php"; ?>
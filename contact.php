<?php
require_once __DIR__ . "/config.php";
$pageTitle = "Contact — Langzio";
$pageDescription = "Get in touch with the Langzio team. We'd love to hear from you — whether it's feedback, questions, partnership inquiries, or press requests.";
$pageClass = "auth-page";
$pageKeywords = "contact Langzio, Darija support, Moroccan Arabic feedback, Langzio team";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/contact.php#page",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/contact.php",
    "name" => "Contact — Langzio",
    "description" => "Get in touch with the Langzio team. We'd love to hear from you — whether it's feedback, questions, partnership inquiries, or press requests.",
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "mainEntity" => [
        "@type" => "ContactPoint",
        "email" => "langzio.contact@gmail.com",
        "contactType" => "customer support",
        "availableLanguage" => ["en", "fr", "ary"],
        "areaServed" => "Worldwide"
    ],
    "inLanguage" => "en-US"
];

include "includes/head.php";
?>
<main class="auth-card" style="max-width:560px" role="main">
    <div class="auth-logo" aria-hidden="true">L</div>
    <h1>Contact Us</h1>
    <p class="auth-subtitle">We read every message — really.</p>

    <section class="card" style="margin-top:24px;text-align:center" aria-labelledby="email-title">
        <h2 id="email-title" style="margin-top:0">Direct Email</h2>
        <p style="color:var(--muted);margin-bottom:16px">Fastest way to reach us:</p>
        <a href="mailto:langzio.contact@gmail.com" class="btn btn-primary" style="display:inline-block;font-size:1rem">
            ✉️ langzio.contact@gmail.com
        </a>
        <p style="color:var(--muted);font-size:0.85rem;margin-top:12px">We typically reply within 24–48 hours.</p>
    </section>

    <section class="card" style="margin-top:16px" aria-labelledby="form-title">
        <h2 id="form-title" style="margin-top:0">Or use the form</h2>
        <form action="https://formspree.io/f/your-form-id" method="POST" class="auth-form" style="margin-top:16px">
            <input type="hidden" name="_next" value="<?php echo htmlspecialchars(langzio_canonical_url('contact.php?sent=1')); ?>">
            
            <label>
                Name
                <input type="text" name="name" required autocomplete="name" placeholder="Your name">
            </label>
            
            <label>
                Email
                <input type="email" name="email" required autocomplete="email" placeholder="you@email.com">
            </label>
            
            <label>
                Subject
                <select name="subject" required>
                    <option value="">— Select —</option>
                    <option value="feedback">Feedback / Suggestion</option>
                    <option value="bug">Bug Report</option>
                    <option value="partnership">Partnership / Business</option>
                    <option value="press">Press / Media</option>
                    <option value="other">Other</option>
                </select>
            </label>
            
            <label>
                Message
                <textarea name="message" required rows="5" placeholder="Tell us what's on your mind..."></textarea>
            </label>
            
            <button class="btn btn-primary" type="submit" style="width:100%">Send Message</button>
        </form>
        <p style="color:var(--muted);font-size:0.8rem;margin-top:12px;text-align:center">By submitting, you agree to our <a href="<?php echo langzio_url('privacy.php'); ?>">Privacy Policy</a>.</p>
    </section>

    <?php if (isset($_GET['sent'])): ?>
    <section class="card" style="margin-top:16px;background:rgba(0,211,139,0.08);border-color:rgba(0,211,139,0.3);text-align:center" role="status">
        <p style="color:var(--green-2);margin:0">✓ Message sent! We'll get back to you soon.</p>
    </section>
    <?php endif; ?>

    <section class="card" style="margin-top:16px" aria-labelledby="faq-title">
        <h2 id="faq-title" style="margin-top:0;font-size:1rem">Common Questions</h2>
        <dl style="margin:0;font-size:0.9rem">
            <dt style="font-weight:600;margin-top:12px">I found a translation error</dt>
            <dd style="margin:4px 0 0;color:var(--muted)">Please include the phrase, what you expected, and context. We use verified native-speaker corpus — your report helps us improve.</dd>
            
            <dt style="font-weight:600;margin-top:12px">Can I contribute phrases?</dt>
            <dd style="margin:4px 0 0;color:var(--muted)">Yes! We welcome native speaker contributions. Email us with "Contribution" in the subject.</dd>
            
            <dt style="font-weight:600;margin-top:12px">Press / media inquiries</dt>
            <dd style="margin:4px 0 0;color:var(--muted)">Include your outlet, deadline, and what you need (quotes, screenshots, demo access).</dd>
            
            <dt style="font-weight:600;margin-top:12px">Partnership / API access</dt>
            <dd style="margin:4px 0 0;color:var(--muted)">We're open to educational, travel, and diaspora org partnerships. Tell us about your project.</dd>
        </dl>
    </section>

    <p style="text-align:center;margin-top:24px;color:var(--muted);font-size:0.85rem">
        <a href="<?php echo langzio_url('index.php'); ?>">← Back to Home</a>
    </p>
</main>
<?php include "includes/footer.php"; ?>
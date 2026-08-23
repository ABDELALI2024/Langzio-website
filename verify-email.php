<?php
require_once __DIR__ . "/classes/Auth.php";
require_once __DIR__ . "/classes/User.php";

Auth::startSession();
$message = "";
$success = false;

$token = $_GET["token"] ?? "";
if ($token !== "") {
    $user = User::findByVerificationToken($token);
    if ($user) {
        User::verifyEmail((int) $user["id"]);
        $message = "Email verified successfully!";
        $success = true;
        if (Auth::id() === null) {
            Auth::login((int) $user["id"]);
        }
    } else {
        $message = "Invalid or expired verification link.";
    }
} else {
    $message = "No verification token provided.";
}

$pageTitle = "Verify Email — Langzio";
$pageDescription = "Verify your email address to activate your Langzio account and start your free trial.";
$pageClass = "auth-page";
$pageNoIndex = true;
$pageKeywords = "Langzio email verification, verify Darija account, activate Langzio trial";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/verify-email.php#page",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/verify-email.php",
    "name" => "Verify Email — Langzio",
    "description" => "Verify your email address to activate your Langzio account and start your free trial.",
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "mainEntity" => [
        "@type" => "WebPageElement",
        "name" => "Email Verification",
        "description" => "Verify your email address to activate your Langzio account"
    ],
    "robots" => "noindex, nofollow",
    "inLanguage" => "en-US"
];

include "includes/head.php";
?>
<main class="auth-card" style="text-align:center" role="main">
    <div class="auth-logo" aria-hidden="true">L</div>
    <h1 style="margin-bottom:16px"><?php echo htmlspecialchars($message); ?></h1>
    <?php if ($success): ?>
        <p style="color:var(--green-2);margin-bottom:8px" role="status">✓ Your email is verified</p>
    <?php else: ?>
        <p style="color:var(--red);margin-bottom:8px" role="alert">✗ Verification failed</p>
    <?php endif; ?>
    <a class="btn btn-primary" href="<?php echo htmlspecialchars(langzio_url('dashboard.php')); ?>" style="display:inline-block;margin-top:8px">Go to Dashboard</a>
</main>
<?php include "includes/footer.php"; ?>
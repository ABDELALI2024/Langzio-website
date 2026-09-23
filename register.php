<?php
require_once __DIR__ . "/classes/Auth.php";
require_once __DIR__ . "/classes/User.php";
require_once __DIR__ . "/classes/Subscription.php";
require_once __DIR__ . "/classes/WhatsAppNotificationService.php";
require_once __DIR__ . "/classes/EmailService.php";
Auth::startSession();

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = trim($_POST["name"] ?? "");
    $email    = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm  = $_POST["password_confirm"] ?? "";

    if ($name === "" || $email === "" || $password === "") {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $existing = User::findByEmail($email);
        if ($existing) {
            $error = "An account with this email already exists.";
        } else {
            $user = User::create($name, $email, $password);
            Subscription::createFreePlan((int) $user["id"]);
            Auth::login((int) $user["id"]);

            if (langzio_env("MAIL_ENABLED", "false") === "true") {
                EmailService::sendVerification($email, $name, $user["verification_token"]);
            }

            $redirect = langzio_url("pricing.php");
            header("Location: " . $redirect);
            exit;
        }
    }
}

Auth::redirectIfLoggedIn();

$pageTitle = "Create Free Account — Langzio";
$pageDescription = "Create your free Langzio account. Get Darija translations, cultural AI chat, phrase guides, and kids challenge. Upgrade to Pro for unlimited access.";
$pageClass = "auth-page";
$pageNoIndex = true;
$pageKeywords = "Langzio register, Darija free trial, Moroccan Arabic signup, create Langzio account";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/register.php#page",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/register.php",
    "name" => "Create Free Account — Langzio",
    "description" => "Create your free Langzio account. Get Darija translations, cultural AI chat, phrase guides, and kids challenge. Upgrade to Pro for unlimited access.",
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "mainEntity" => [
        "@type" => "WebPageElement",
        "name" => "Registration Form",
        "description" => "Create a free Langzio account with 7-day Pro trial"
    ],
    "robots" => "noindex, nofollow",
    "inLanguage" => "en-US"
];

include "includes/head.php";
?>
<main class="auth-card" role="main">
    <div class="auth-logo" aria-hidden="true">L</div>
    <h1>Create account</h1>
    <p class="auth-subtitle">Free account &mdash; upgrade to Pro anytime</p>

    <?php if ($error): ?>
        <div class="form-feedback form-error" role="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="form-feedback form-success" role="status"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form method="post" class="auth-form" novalidate>
        <label>
            Name
            <input type="text" name="name" required autocomplete="name"
                   value="<?php echo htmlspecialchars($_POST["name"] ?? ""); ?>" aria-describedby="name-hint">
        </label>
        <label>
            Email
            <input type="email" name="email" required autocomplete="email" inputmode="email"
                   value="<?php echo htmlspecialchars($_POST["email"] ?? ""); ?>" aria-describedby="email-hint">
        </label>
        <label>
            Password
            <input type="password" name="password" required minlength="8" autocomplete="new-password" aria-describedby="password-hint">
        </label>
        <label>
            Confirm password
            <input type="password" name="password_confirm" required minlength="8" autocomplete="new-password" aria-describedby="confirm-hint">
        </label>
        <button class="btn btn-primary" type="submit" style="width:100%;margin-top:8px">Create account</button>
    </form>

    <p class="auth-footer">
        Already have an account?
        <a href="<?php echo htmlspecialchars(langzio_url('login.php')); ?>">Log in</a>
    </p>
</main>
<?php include "includes/footer.php"; ?>
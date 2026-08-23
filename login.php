<?php
require_once __DIR__ . "/classes/Auth.php";
require_once __DIR__ . "/classes/User.php";
Auth::startSession();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($email === "" || $password === "") {
        $error = "Email and password are required.";
    } else {
        $user = User::authenticate($email, $password);
        if (!$user) {
            $error = "Invalid email or password.";
        } else {
            Auth::login((int) $user["id"]);
            $redirect = langzio_url("dashboard.php");
            header("Location: " . $redirect);
            exit;
        }
    }
}

Auth::redirectIfLoggedIn();

$pageTitle = "Log in — Langzio";
$pageDescription = "Log in to your Langzio account to access unlimited Darija translations, cultural AI chat, phrase guides, and the 7-day kids challenge.";
$pageClass = "auth-page";
$pageNoIndex = true;
$pageKeywords = "Langzio login, Darija account sign in, Moroccan Arabic learning login";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/login.php#page",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/login.php",
    "name" => "Log in — Langzio",
    "description" => "Log in to your Langzio account to access unlimited Darija translations, cultural AI chat, phrase guides, and the 7-day kids challenge.",
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "mainEntity" => [
        "@type" => "WebPageElement",
        "name" => "Login Form",
        "description" => "Email and password authentication for Langzio account"
    ],
    "robots" => "noindex, nofollow",
    "inLanguage" => "en-US"
];

include "includes/head.php";
?>
<main class="auth-card" role="main">
    <div class="auth-logo" aria-hidden="true">L</div>
    <h1>Welcome back</h1>
    <p class="auth-subtitle">Log in to continue your Darija journey</p>

    <?php if ($error): ?>
        <div class="form-feedback form-error" role="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" class="auth-form" novalidate>
        <label>
            Email
            <input type="email" name="email" required autocomplete="email" inputmode="email"
                   value="<?php echo htmlspecialchars($_POST["email"] ?? ""); ?>" aria-describedby="email-hint">
        </label>
        <label>
            Password
            <input type="password" name="password" required autocomplete="current-password" aria-describedby="password-hint">
        </label>
        <button class="btn btn-primary" type="submit" style="width:100%;margin-top:8px">Log in</button>
    </form>

    <p class="auth-footer">
        No account yet?
        <a href="<?php echo htmlspecialchars(langzio_url('register.php')); ?>">Register free</a>
    </p>
</main>
<?php include "includes/footer.php"; ?>
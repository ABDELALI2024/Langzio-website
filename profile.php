<?php
require_once __DIR__ . "/classes/Auth.php";
require_once __DIR__ . "/classes/User.php";
require_once __DIR__ . "/classes/Database.php";
require_once __DIR__ . "/classes/WhatsAppNotificationService.php";

Auth::requireLogin();
$user = Auth::user();
$subStatus = Auth::subscriptionStatus();
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    if ($action === "whatsapp") {
        $code   = trim($_POST["country_code"] ?? "212");
        $number = trim($_POST["whatsapp_number"] ?? "");
        $number = preg_replace("/[^0-9]/", "", $number);

        if ($number === "") {
            $error = "Please enter your WhatsApp number.";
        } elseif (!preg_match("/^[1-9][0-9]{6,14}$/", $number)) {
            $error = "Invalid phone number format.";
        } else {
            User::updateWhatsApp((int) $user["id"], $code, $number);
            $verifyCode = (string) random_int(100000, 999999);
            User::setWhatsAppCode((int) $user["id"], $verifyCode);
            $fullPhone = $code . $number;

            try {
                $wa = new WhatsAppNotificationService();
                $sent = $wa->sendDirect($fullPhone, "Your Langzio verification code: {$verifyCode}");
            } catch (\Exception $e) {
                $sent = false;
                error_log("WhatsApp verification send failed: " . $e->getMessage());
            }

            if ($sent) {
                $success = "A verification code has been sent to your WhatsApp.";
            } else {
                error_log("Langzio WhatsApp OTP for user " . (int) $user["id"] . " (provider not configured)");
                $success = "Number saved. WhatsApp sending is not configured yet — please contact support to verify.";
            }
            $user = Auth::user();
        }
    } elseif ($action === "verify_whatsapp") {
        $inputCode = trim($_POST["verify_code"] ?? "");
        if ($inputCode === $user["whatsapp_code"]) {
            User::verifyWhatsApp((int) $user["id"]);
            $success = "WhatsApp number verified!";
            $user = Auth::user();
        } else {
            $error = "Incorrect code. Try again.";
        }
    } elseif ($action === "remove_whatsapp") {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE users SET whatsapp_country_code = NULL, whatsapp_number = NULL, whatsapp_verified_at = NULL, whatsapp_code = NULL WHERE id = :id");
        $stmt->execute(["id" => $user["id"]]);
        $success = "WhatsApp number removed.";
        $user = Auth::user();
    }
}

$pageTitle = "Profile — Langzio";
$pageDescription = "Manage your Langzio account settings, email verification, and WhatsApp notifications for trial reminders and learning tips.";
$pageClass = "app-page";
$pageNoIndex = true;
$pageKeywords = "Langzio profile, account settings, WhatsApp notifications Darija, email verification";

$pageStructuredData = [
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "/profile.php#page",
    "url" => LANGZIO_CANONICAL_DOMAIN . "/profile.php",
    "name" => "Profile — Langzio",
    "description" => "Manage your Langzio account settings, email verification, and WhatsApp notifications for trial reminders and learning tips.",
    "isPartOf" => [
        "@type" => "WebSite",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#website"
    ],
    "mainEntity" => [
        "@type" => "Person",
        "name" => $user["name"],
        "email" => $user["email"]
    ],
    "robots" => "noindex, nofollow",
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
            <hr style="border-color:rgba(255,255,255,0.08);margin:12px 0">
            <a class="active" href="profile.php" aria-current="page">Profile</a>
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

    <main class="app-content">
        <header class="app-topbar glass">
            <h1>Profile</h1>
        </header>

        <section class="card" aria-labelledby="account-title">
            <h2 id="account-title">Account</h2>
            <dl style="margin:0">
                <dt>Name</dt>
                <dd style="margin:4px 0 16px"><?php echo htmlspecialchars($user["name"]); ?></dd>
                <dt>Email</dt>
                <dd style="margin:4px 0 16px">
                    <?php echo htmlspecialchars($user["email"]); ?>
                    <?php if ($user["email_verified_at"]): ?>
                        <span style="color:var(--green-2);margin-left:8px">✓ Verified</span>
                    <?php else: ?>
                        <span style="color:var(--muted);margin-left:8px">(not verified)</span>
                    <?php endif; ?>
                </dd>
            </dl>
        </section>

        <section class="card" aria-labelledby="whatsapp-title">
            <h2 id="whatsapp-title">WhatsApp notifications</h2>
            <p style="color:var(--muted);font-size:0.9rem;margin-bottom:16px">
                Get trial reminders, tips, and updates on WhatsApp.
            </p>

            <?php if ($error): ?>
                <div class="form-feedback form-error" role="alert"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="form-feedback form-success" role="status"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <?php if ($user["whatsapp_verified_at"]): ?>
                <p style="color:var(--green-2);margin-bottom:16px">
                    ✓ Connected: +<?php echo htmlspecialchars($user["whatsapp_country_code"] . " " . $user["whatsapp_number"]); ?>
                </p>
                <form method="post" style="margin-top:10px">
                    <input type="hidden" name="action" value="remove_whatsapp">
                    <button class="btn btn-secondary compact" type="submit">Remove number</button>
                </form>
            <?php elseif ($user["whatsapp_number"]): ?>
                <p style="margin-bottom:12px">Number: +<?php echo htmlspecialchars($user["whatsapp_country_code"] . " " . $user["whatsapp_number"]); ?></p>
                <p style="color:var(--muted);margin-bottom:12px">Enter the code sent to your WhatsApp to verify:</p>
                <form method="post" class="auth-form" style="max-width:280px">
                    <input type="hidden" name="action" value="verify_whatsapp">
                    <label>
                        Verification code
                        <input type="text" name="verify_code" required maxlength="10" inputmode="numeric" autocomplete="one-time-code">
                    </label>
                    <button class="btn btn-primary compact" type="submit">Verify</button>
                </form>
            <?php else: ?>
                <form method="post" class="auth-form" style="max-width:360px">
                    <input type="hidden" name="action" value="whatsapp">
                    <div style="display:flex;gap:8px;align-items:end;flex-wrap:wrap">
                        <label style="flex:0 0 90px">
                            Code
                            <select name="country_code" required>
                                <option value="212" selected>+212 (Morocco)</option>
                                <option value="213">+213 (Algeria)</option>
                                <option value="33">+33 (France)</option>
                                <option value="32">+32 (Belgium)</option>
                                <option value="1">+1 (US/CA)</option>
                                <option value="44">+44 (UK)</option>
                            </select>
                        </label>
                        <label style="flex:1;min-width:200px">
                            WhatsApp number
                            <input type="tel" name="whatsapp_number" required placeholder="612345678" autocomplete="tel">
                        </label>
                    </div>
                    <button class="btn btn-primary compact" type="submit" style="margin-top:16px">Save & verify</button>
                </form>
            <?php endif; ?>
        </section>
    </main>
</div>

<?php include "includes/footer.php"; ?>
<?php
require_once __DIR__ . "/../config.php";

if (!isset($pageTitle)) {
    $pageTitle = "Langzio - Cultural AI for Darija";
}
if (!isset($pageDescription)) {
    $pageDescription = "Darija translation with cultural context, verified phrase packs, and family-friendly learning — built for Morocco travelers and diaspora.";
}
if (!isset($pageClass)) {
    $pageClass = "";
}
if (!isset($pageKeywords)) {
    $pageKeywords = "Moroccan Darija, Moroccan Arabic, learn Darija, Darija translator, Darija dictionary, Morocco travel phrases, Moroccan culture, Darija pronunciation";
}
if (!isset($pageOgType)) {
    $pageOgType = "website";
}
if (!isset($pageOgImage)) {
    $pageOgImage = langzio_canonical_url("assets/icon.svg");
}
if (!isset($pageNoIndex)) {
    $pageNoIndex = false;
}
if (!isset($pageStructuredData)) {
    $pageStructuredData = [];
}

$canonicalUrl = langzio_current_canonical();
$siteName = LANGZIO_SITE_NAME;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($pageKeywords, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="author" content="Langzio">
    <meta name="theme-color" content="#00a76f">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Langzio">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    
    <!-- Robots meta -->
    <?php if ($pageNoIndex): ?>
    <meta name="robots" content="noindex, nofollow">
    <?php else: ?>
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <?php endif; ?>
    
    <!-- Open Graph -->
    <meta property="og:type" content="<?php echo htmlspecialchars($pageOgType, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($pageOgImage, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:site_name" content="<?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter / X Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($pageOgImage, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:site" content="@langzio">
    
    <!-- PWA -->
    <link rel="manifest" href="<?php echo htmlspecialchars(langzio_url('manifest.php'), ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="icon" href="<?php echo htmlspecialchars(langzio_url('assets/icon.svg'), ENT_QUOTES, 'UTF-8'); ?>" type="image/svg+xml">
    <link rel="apple-touch-icon" href="<?php echo htmlspecialchars(langzio_url('assets/icons/icon-192.png'), ENT_QUOTES, 'UTF-8'); ?>">
    
    <!-- Title -->
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo htmlspecialchars(langzio_url('assets/css/style.css'), ENT_QUOTES, 'UTF-8'); ?>?v=2.1">
    
    <!-- JSON-LD Structured Data -->
    <?php if (!empty($pageStructuredData)): ?>
    <script type="application/ld+json">
<?php echo json_encode($pageStructuredData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?>
    </script>
    <?php endif; ?>
</head>
<body class="<?php echo htmlspecialchars($pageClass, ENT_QUOTES, 'UTF-8'); ?>">
<div class="bg-orb orb-1"></div>
<div class="bg-orb orb-2"></div>
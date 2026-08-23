<?php
/**
 * Langzio Dynamic Sitemap Generator
 * Outputs XML sitemap with all canonical, indexable, public URLs
 */

require_once __DIR__ . "/config.php";

header("Content-Type: application/xml; charset=utf-8");
header("X-Content-Type-Options: nosniff");

// Cache for 1 hour
header("Cache-Control: public, max-age=3600, s-maxage=3600");

$baseUrl = LANGZIO_CANONICAL_DOMAIN;
$now = gmdate("Y-m-d\TH:i:s\Z");

$urls = [
    // Core public pages
    ["url" => $baseUrl . "/", "changefreq" => "weekly", "priority" => "1.0"],
    ["url" => $baseUrl . "/index.php", "changefreq" => "weekly", "priority" => "0.9"],
    
    // Definition & Learning Hub Pages
    ["url" => $baseUrl . "/what-is-darija/", "changefreq" => "monthly", "priority" => "0.8"],
    ["url" => $baseUrl . "/darija-vs-arabic/", "changefreq" => "monthly", "priority" => "0.7"],
    ["url" => $baseUrl . "/learn-darija/", "changefreq" => "monthly", "priority" => "0.8"],
    ["url" => $baseUrl . "/darija-beginners/", "changefreq" => "monthly", "priority" => "0.7"],
    ["url" => $baseUrl . "/darija-vocabulary/", "changefreq" => "monthly", "priority" => "0.7"],
    ["url" => $baseUrl . "/darija-phrases/", "changefreq" => "monthly", "priority" => "0.7"],
    ["url" => $baseUrl . "/darija-pronunciation/", "changefreq" => "monthly", "priority" => "0.7"],
    ["url" => $baseUrl . "/arabizi-guide/", "changefreq" => "monthly", "priority" => "0.7"],
    ["url" => $baseUrl . "/grammar/", "changefreq" => "yearly", "priority" => "0.5"],
    
    // Dictionary
    ["url" => $baseUrl . "/dictionary/", "changefreq" => "weekly", "priority" => "0.8"],
    
    // Translator (public demo)
    ["url" => $baseUrl . "/translator/", "changefreq" => "monthly", "priority" => "0.8"],
    
    // Guides (public versions)
    ["url" => $baseUrl . "/guides/", "changefreq" => "monthly", "priority" => "0.8"],
    ["url" => $baseUrl . "/guides/restaurant/", "changefreq" => "monthly", "priority" => "0.8"],
    ["url" => $baseUrl . "/guides/souk/", "changefreq" => "monthly", "priority" => "0.8"],
    ["url" => $baseUrl . "/guides/taxi/", "changefreq" => "monthly", "priority" => "0.8"],
    ["url" => $baseUrl . "/guides/family/", "changefreq" => "monthly", "priority" => "0.8"],
    ["url" => $baseUrl . "/guides/travel/", "changefreq" => "monthly", "priority" => "0.7"],
    
    // Culture
    ["url" => $baseUrl . "/culture/etiquette/", "changefreq" => "monthly", "priority" => "0.7"],
    ["url" => $baseUrl . "/culture/travel-tips/", "changefreq" => "monthly", "priority" => "0.7"],
    
    // Diaspora
    ["url" => $baseUrl . "/diaspora/kids-darija/", "changefreq" => "monthly", "priority" => "0.7"],
    ["url" => $baseUrl . "/diaspora/language-preservation/", "changefreq" => "yearly", "priority" => "0.5"],
    
    // Auth pages (noindex but crawlable for discovery)
    ["url" => $baseUrl . "/login.php", "changefreq" => "yearly", "priority" => "0.3"],
    ["url" => $baseUrl . "/register.php", "changefreq" => "yearly", "priority" => "0.3"],
    ["url" => $baseUrl . "/pricing.php", "changefreq" => "monthly", "priority" => "0.5"],
    
    // Error/utility pages (noindex)
    ["url" => $baseUrl . "/404.php", "changefreq" => "yearly", "priority" => "0.1"],
    ["url" => $baseUrl . "/verify-email.php", "changefreq" => "yearly", "priority" => "0.1"],
    
    // Contact
    ["url" => $baseUrl . "/contact.php", "changefreq" => "yearly", "priority" => "0.5"],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
echo '        xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

foreach ($urls as $urlData) {
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($urlData["url"], ENT_QUOTES, "UTF-8") . "</loc>\n";
    echo "    <lastmod>" . $now . "</lastmod>\n";
    echo "    <changefreq>" . $urlData["changefreq"] . "</changefreq>\n";
    echo "    <priority>" . $urlData["priority"] . "</priority>\n";
    
    // Add xhtml:link for alternate languages (English only for now)
    echo "    <xhtml:link rel=\"alternate\" hreflang=\"en\" href=\"" . htmlspecialchars($urlData["url"], ENT_QUOTES, "UTF-8") . "\" />\n";
    echo "    <xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"" . htmlspecialchars($urlData["url"], ENT_QUOTES, "UTF-8") . "\" />\n";
    
    echo "  </url>\n";
}

echo "</urlset>\n";
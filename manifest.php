<?php
require_once __DIR__ . "/config.php";
header("Content-Type: application/manifest+json; charset=utf-8");

$base = langzio_base_path() === "" ? "/" : langzio_base_path() . "/";

echo json_encode([
    "name" => "Langzio — Darija Companion",
    "short_name" => "Langzio",
    "description" => "Darija translation, cultural chat, and family learning for Morocco.",
    "start_url" => langzio_url("dashboard.php"),
    "scope" => $base,
    "display" => "standalone",
    "orientation" => "portrait-primary",
    "background_color" => "#060b0a",
    "theme_color" => "#00a76f",
    "categories" => ["education", "travel", "social"],
    "lang" => "en",
    "dir" => "ltr",
    "prefer_related_applications" => false,
    "icons" => [
        ["src" => langzio_url("assets/icons/icon-48.png"),  "sizes" => "48x48",  "type" => "image/png", "purpose" => "any"],
        ["src" => langzio_url("assets/icons/icon-72.png"),  "sizes" => "72x72",  "type" => "image/png", "purpose" => "any"],
        ["src" => langzio_url("assets/icons/icon-96.png"),  "sizes" => "96x96",  "type" => "image/png", "purpose" => "any"],
        ["src" => langzio_url("assets/icons/icon-128.png"), "sizes" => "128x128", "type" => "image/png", "purpose" => "any"],
        ["src" => langzio_url("assets/icons/icon-144.png"), "sizes" => "144x144", "type" => "image/png", "purpose" => "any"],
        ["src" => langzio_url("assets/icons/icon-152.png"), "sizes" => "152x152", "type" => "image/png", "purpose" => "any"],
        ["src" => langzio_url("assets/icons/icon-192.png"), "sizes" => "192x192", "type" => "image/png", "purpose" => "maskable any"],
        ["src" => langzio_url("assets/icons/icon-384.png"), "sizes" => "384x384", "type" => "image/png", "purpose" => "any"],
        ["src" => langzio_url("assets/icons/icon-512.png"), "sizes" => "512x512", "type" => "image/png", "purpose" => "maskable any"],
        ["src" => langzio_url("assets/icon.svg"),          "sizes" => "any",     "type" => "image/svg+xml", "purpose" => "any"],
    ],
    "screenshots" => [
        [
            "src" => langzio_url("assets/screenshots/home.png"),
            "sizes" => "1080x1920",
            "type" => "image/png",
            "form_factor" => "narrow",
            "label" => "Langzio Translator — Darija with cultural context"
        ],
        [
            "src" => langzio_url("assets/screenshots/chat.png"),
            "sizes" => "1080x1920",
            "type" => "image/png",
            "form_factor" => "narrow",
            "label" => "AI Chat — Learn Moroccan etiquette"
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

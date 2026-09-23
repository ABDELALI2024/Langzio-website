<?php
$orgSchema = [
    "@context" => "https://schema.org",
    "@type" => "Organization",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "#organization",
    "name" => "Langzio",
    "alternateName" => ["Langzio AI", "Langzio Darija", "Langzio Translator"],
    "url" => LANGZIO_CANONICAL_DOMAIN,
    "logo" => [
        "@type" => "ImageObject",
        "url" => LANGZIO_CANONICAL_DOMAIN . "/assets/icon.svg",
        "width" => 512,
        "height" => 512,
        "caption" => "Langzio Logo"
    ],
    "description" => "Langzio is a web application for learning and understanding Moroccan Darija through natural language, cultural context, pronunciation, and real-life situations.",
    "foundingDate" => "2026",
    "areaServed" => [
        "@type" => "Country",
        "name" => "Worldwide"
    ],
    "knowsAbout" => [
        "Moroccan Darija",
        "Moroccan Arabic",
        "Moroccan Culture",
        "Language Learning",
        "AI Translation"
    ],
    "sameAs" => [
        "https://github.com/langzio",
        "https://x.com/langzio",
        "https://linkedin.com/company/langzio"
    ],
    "hasOfferCatalog" => [
        "@type" => "OfferCatalog",
        "name" => "Langzio Products",
        "itemListElement" => [
            [
                "@type" => "Offer",
                "itemOffered" => [
                    "@type" => "SoftwareApplication",
                    "name" => "Langzio Translator",
                    "applicationCategory" => "EducationalApplication",
                    "operatingSystem" => "Web, PWA",
                    "offers" => [
                        "@type" => "Offer",
                        "name" => "Free Tier",
                        "price" => "0",
                        "priceCurrency" => "USD",
                        "availability" => "https://schema.org/InStock"
                    ]
                ]
            ],
            [
                "@type" => "Offer",
                "itemOffered" => [
                    "@type" => "SoftwareApplication",
                    "name" => "Langzio AI Chat",
                    "applicationCategory" => "EducationalApplication",
                    "operatingSystem" => "Web, PWA"
                ]
            ],
            [
                "@type" => "Offer",
                "itemOffered" => [
                    "@type" => "Course",
                    "name" => "Langzio Smart Guides",
                    "description" => "Situational phrase guides for Morocco: Restaurant, Souk, Taxi, Family, Travel"
                ]
            ],
            [
                "@type" => "Offer",
                "itemOffered" => [
                    "@type" => "Course",
                    "name" => "Langzio 7-Day Kids Challenge",
                    "description" => "5 Darija words/day for 7 days with flashcards and streaks"
                ]
            ]
        ]
    ]
];

$websiteSchema = [
    "@context" => "https://schema.org",
    "@type" => "WebSite",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "#website",
    "url" => LANGZIO_CANONICAL_DOMAIN,
    "name" => "Langzio",
    "description" => "Cultural language intelligence for Moroccan Darija — AI translation, cultural chat, verified phrases, and family learning.",
    "publisher" => [
        "@type" => "Organization",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#organization"
    ],
    "potentialAction" => [
        "@type" => "SearchAction",
        "target" => [
            "@type" => "EntryPoint",
            "urlTemplate" => LANGZIO_CANONICAL_DOMAIN . "/dictionary/?q={search_term_string}"
        ],
        "query-input" => "required name=search_term_string"
    ],
    "inLanguage" => "en-US"
];

$softwareAppSchema = [
    "@context" => "https://schema.org",
    "@type" => "SoftwareApplication",
    "@id" => LANGZIO_CANONICAL_DOMAIN . "#translator",
    "name" => "Langzio Translator",
    "applicationCategory" => "EducationalApplication",
    "operatingSystem" => "Web, PWA",
    "offers" => [
        "@type" => "Offer",
        "name" => "Free Tier",
        "price" => "0",
        "priceCurrency" => "USD",
        "availability" => "https://schema.org/InStock",
        "url" => LANGZIO_CANONICAL_DOMAIN . "/translator/"
    ],
    "description" => "AI-powered Moroccan Darija translator with cultural context, pronunciation, tone guidance, and verified phrases.",
    "featureList" => [
        "Structured Translation Output (Darija, Pronunciation, Meaning, Tone, Context, Tips)",
        "RAG-Grounded Generation from Verified Phrase Corpus",
        "Multi-language Support (English, Darija, French)",
        "Cultural Etiquette Integration",
        "Pronunciation Guide with Arabizi Support"
    ],
    "usesTechnology" => "RAG (Retrieval-Augmented Generation)",
    "provider" => [
        "@type" => "Organization",
        "@id" => LANGZIO_CANONICAL_DOMAIN . "#organization"
    ],
    "inLanguage" => ["en", "ary", "fr"]
];
?>
<script type="application/ld+json">
<?php echo json_encode($orgSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?>
</script>
<script type="application/ld+json">
<?php echo json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?>
</script>
<script type="application/ld+json">
<?php echo json_encode($softwareAppSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?>
</script>

<script>window.LANGZIO_BASE = <?php echo json_encode(langzio_base_path(), JSON_UNESCAPED_SLASHES); ?>;</script>
<script>document.addEventListener("DOMContentLoaded",function(){var n=document.querySelector(".side-nav"),t=document.getElementById("navToggle");if(n&&t){window.innerWidth<=768&&n.classList.remove("open");t.addEventListener("click",function(){n.classList.toggle("open")})}});</script>
<?php include __DIR__ . "/onboarding.php"; ?>
<script src="<?php echo htmlspecialchars(langzio_url('assets/js/app.js'), ENT_QUOTES, 'UTF-8'); ?>"></script>
</body>
</html>
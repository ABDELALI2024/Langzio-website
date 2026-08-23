<?php
function langzio_base_path(): string
{
    $script = str_replace("\\", "/", $_SERVER["SCRIPT_NAME"] ?? "/index.php");
    $dir = dirname($script);
    if ($dir === "/" || $dir === "\\" || $dir === ".") {
        return "";
    }
    return rtrim($dir, "/");
}

function langzio_url(string $path = ""): string
{
    $base = langzio_base_path();
    $path = ltrim(str_replace("\\", "/", $path), "/");
    if ($path === "") {
        return $base === "" ? "/" : $base . "/";
    }
    return ($base === "" ? "" : $base) . "/" . $path;
}

function langzio_canonical_url(string $path = ""): string
{
    $canonicalDomain = langzio_env("CANONICAL_DOMAIN", "https://langzio.com");
    $base = rtrim($canonicalDomain, "/");
    $path = ltrim(str_replace("\\", "/", $path), "/");
    if ($path === "") {
        return $base . "/";
    }
    return $base . "/" . $path;
}

function langzio_current_canonical(): string
{
    $path = $_SERVER["REQUEST_URI"] ?? "/";
    $path = parse_url($path, PHP_URL_PATH) ?? "/";
    return langzio_canonical_url($path);
}

// Load .env file if present (for shared hosting without env var support)
$langzioEnv = [];
$envFile = __DIR__ . "/.env";
if (is_readable($envFile)) {
    $content = (string) file_get_contents($envFile);
    $content = preg_replace('/^\xEF\xBB\xBF/', "", $content);
    foreach (preg_split('/\R/', $content) as $line) {
        $line = trim($line);
        if ($line === "" || $line[0] === "#") {
            continue;
        }
        $parts = explode("=", $line, 2);
        if (count($parts) !== 2) {
            continue;
        }
        $key = trim($parts[0]);
        $value = trim($parts[1]);
        $value = trim($value, "\"'");
        $langzioEnv[$key] = $value;
        $_ENV[$key] = $value;
        putenv("$key=$value");
    }
}

function langzio_env(string $key, string $default = ""): string
{
    global $langzioEnv;
    if (isset($langzioEnv[$key]) && $langzioEnv[$key] !== "") {
        return $langzioEnv[$key];
    }
    if (isset($_ENV[$key]) && $_ENV[$key] !== "") {
        return (string) $_ENV[$key];
    }
    $fromGetenv = getenv($key);
    return ($fromGetenv !== false && $fromGetenv !== "") ? (string) $fromGetenv : $default;
}

define("GROQ_API_KEY", langzio_env("GROQ_API_KEY"));
define("GROQ_API_URL", "https://api.groq.com/openai/v1/chat/completions");
define("GROQ_MODEL", "llama-3.3-70b-versatile");

define("OPENAI_API_KEY", GROQ_API_KEY);
define("OPENAI_API_URL", GROQ_API_URL);
define("OPENAI_MODEL", GROQ_MODEL);

define("LANGZIO_CANONICAL_DOMAIN", langzio_env("CANONICAL_DOMAIN", "https://langzio.com"));
define("LANGZIO_SITE_NAME", "Langzio");
define("LANGZIO_SITE_DESCRIPTION", "Cultural language intelligence for Moroccan Darija — AI translation, cultural chat, verified phrases, and family learning.");

if (empty(GROQ_API_KEY)) {
    error_log("Langzio: GROQ_API_KEY is not set. Create a .env file or set the env variable.");
}

// ─── Autoload core classes ─────────────────────────────
$langzioClasses = __DIR__ . "/classes";
if (is_dir($langzioClasses)) {
    foreach (glob($langzioClasses . "/*.php") as $file) {
        require_once $file;
    }
}



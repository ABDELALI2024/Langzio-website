<?php
// Langzio debug page — LOCAL ONLY. Blocked in production via .htaccess.
// Defense-in-depth: refuse to run unless explicitly enabled via env.
if (getenv("LANGZIO_DEBUG") !== "1") {
    http_response_code(404);
    exit;
}
error_reporting(E_ALL);
ini_set("display_errors", 1);

$ok = "<span style='color:green'>OK</span>";
$fail = "<span style='color:red'>FAIL</span>";

echo "<h1>Langzio Debug</h1><table border='1' cellpadding='6'>";

echo "<tr><td>PHP version</td><td>" . PHP_VERSION . "</td></tr>";

$exts = ["pdo", "pdo_mysql", "curl", "mbstring", "json", "openssl", "fileinfo", "gd"];
foreach ($exts as $e) {
    echo "<tr><td>$e</td><td>" . (extension_loaded($e) ? $ok : $fail) . "</td></tr>";
}

echo "<tr><td>.env readable</td><td>" . (is_readable(__DIR__ . "/.env") ? $ok : $fail . " (not found/readable)") . "</td></tr>";
echo "<tr><td>classes/ dir</td><td>" . (is_dir(__DIR__ . "/classes") ? $ok : $fail) . "</td></tr>";

try {
    require_once __DIR__ . "/config.php";
    echo "<tr><td>config.php</td><td>$ok</td></tr>";
    echo "<tr><td>AI mode</td><td>local (no external provider)</td></tr>";
} catch (Throwable $e) {
    echo "<tr><td>config.php</td><td>$fail " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}

$classFiles = glob(__DIR__ . "/classes/*.php");
echo "<tr><td>Class files</td><td>" . count($classFiles) . " found</td></tr>";
foreach ($classFiles as $f) {
    try {
        require_once $f;
        echo "<tr><td>&nbsp;&nbsp;" . basename($f) . "</td><td>$ok</td></tr>";
    } catch (Throwable $e) {
        echo "<tr><td>&nbsp;&nbsp;" . basename($f) . "</td><td>$fail " . htmlspecialchars($e->getMessage()) . "</td></tr>";
    }
}

echo "</table>";

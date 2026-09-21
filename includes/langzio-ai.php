<?php

function langzio_normalize_tokens(string $text): array
{
    $text = strtolower($text);
    $text = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text) ?? $text;
    $text = preg_replace('/\s+/u', ' ', trim($text)) ?? $text;
    if ($text === '') {
        return [];
    }
    return array_values(array_filter(explode(' ', $text)));
}

function langzio_rag_context(string $query, int $limit = 5): string
{
    $corpusFile = __DIR__ . "/../data/corpus.json";
    if (!is_readable($corpusFile)) {
        return "";
    }

    $corpus = json_decode((string) file_get_contents($corpusFile), true);
    if (!is_array($corpus)) {
        return "";
    }

    $queryTokens = langzio_normalize_tokens($query);
    if ($queryTokens === []) {
        return "";
    }

    $scored = [];
    foreach ($corpus as $entry) {
        if (!is_array($entry)) {
            continue;
        }
        $phrase = (string) ($entry["phrase"] ?? "");
        $meaning = (string) ($entry["meaning"] ?? "");
        $category = (string) ($entry["category"] ?? "");
        $keywords = array_map("strtolower", $entry["keywords"] ?? []);
        $haystack = langzio_normalize_tokens($phrase . " " . $meaning . " " . $category . " " . implode(" ", $keywords));

        $score = 0;
        foreach ($queryTokens as $token) {
            if (strlen($token) < 2) {
                continue;
            }
            foreach ($haystack as $word) {
                if ($word === $token || str_contains($word, $token) || str_contains($token, $word)) {
                    $score += 2;
                }
            }
            foreach ($keywords as $keyword) {
                if ($keyword === $token || str_contains($keyword, $token) || str_contains($token, $keyword)) {
                    $score += 3;
                }
            }
        }

        if ($score > 0) {
            $scored[] = ["score" => $score, "entry" => $entry];
        }
    }

    usort($scored, static fn($a, $b) => $b["score"] <=> $a["score"]);
    $top = array_slice($scored, 0, $limit);
    if ($top === []) {
        return "";
    }

    $lines = ["Verified Langzio phrase pack (use when relevant):"];
    foreach ($top as $item) {
        $entry = $item["entry"];
        $lines[] = "- [{$entry["category"]}] {$entry["phrase"]} = {$entry["meaning"]}";
    }

    return implode("\n", $lines);
}

function langzio_rate_limit_check(int $maxPerHour = 60): void
{
    $ip = $_SERVER["REMOTE_ADDR"] ?? "unknown";
    $bucket = substr(hash("sha256", $ip), 0, 16);
    $dir = __DIR__ . "/../data/rate";
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }

    $file = $dir . "/" . $bucket . ".json";
    $now = time();
    $window = 3600;
    $hits = [];

    if (is_readable($file)) {
        $decoded = json_decode((string) file_get_contents($file), true);
        if (is_array($decoded)) {
            $hits = array_values(array_filter($decoded, static fn($ts) => is_int($ts) && ($now - $ts) < $window));
        }
    }

    if (count($hits) >= $maxPerHour) {
        http_response_code(429);
        echo json_encode(["error" => "Rate limit reached. Try again in a few minutes."]);
        exit;
    }

    $hits[] = $now;
    file_put_contents($file, json_encode($hits), LOCK_EX);
}

// Local mode — no external AI provider. Replies are built from the
// verified phrase corpus (langzio_rag_context) plus generic guidance.

function langzio_local_chat_reply(string $userText, string $ragContext): string
{
    $lines = [];
    $lines[] = "Salam! Voici ce que je peux vous dire en mode local.";
    if ($ragContext !== "") {
        $lines[] = "";
        $lines[] = $ragContext;
    }
    $lines[] = "";
    $lines[] = "Start with \"Salam\" and use \"3afak\" to soften requests.";
    $lines[] = "Browse Guides and Kids flashcards for verified phrases.";
    return implode("\n", $lines);
}

function langzio_local_translate_reply(string $userText, string $source, string $target, string $ragContext): string
{
    $lines = [];
    $lines[] = "Local translation ({$source} → {$target}): {$userText}";
    if ($ragContext !== "") {
        $lines[] = "";
        $lines[] = $ragContext;
    }
    $lines[] = "";
    $lines[] = "Tip: start with \"Salam\" and add \"3afak\" to soften requests.";
    return implode("\n", $lines);
}

function langzio_parse_structured_translation(string $raw): ?array
{
    $json = json_decode($raw, true);
    if (is_array($json) && isset($json["darija"])) {
        return $json;
    }

    if (preg_match('/\{[\s\S]*\}/', $raw, $match)) {
        $json = json_decode($match[0], true);
        if (is_array($json) && isset($json["darija"])) {
            return $json;
        }
    }

    return null;
}

function langzio_format_structured_reply(array $structured): string
{
    $lines = [];
    $lines[] = "Darija: " . ($structured["darija"] ?? "");
    if (!empty($structured["pronunciation"])) {
        $lines[] = "Say it: " . $structured["pronunciation"];
    }
    if (!empty($structured["meaning"])) {
        $lines[] = "Meaning: " . $structured["meaning"];
    }
    if (!empty($structured["register"])) {
        $lines[] = "Tone: " . $structured["register"];
    }
    if (!empty($structured["context"])) {
        $lines[] = "When: " . $structured["context"];
    }
    if (!empty($structured["avoid"])) {
        $lines[] = "Avoid: " . $structured["avoid"];
    }
    if (!empty($structured["tip"])) {
        $lines[] = "Tip: " . $structured["tip"];
    }
    return implode("\n", $lines);
}


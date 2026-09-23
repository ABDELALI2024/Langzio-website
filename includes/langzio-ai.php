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

// Local fallback — used when no provider key is configured. Replies are
// built from the verified phrase corpus (langzio_rag_context) plus guidance.

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

function langzio_call_ai(array $messages, float $temperature = 0.4): array
{
    $requestBody = [
        "model" => OPENAI_MODEL,
        "messages" => $messages,
        "temperature" => $temperature,
    ];

    $ch = curl_init(OPENAI_API_URL);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Authorization: Bearer " . OPENAI_API_KEY,
        ],
        CURLOPT_POSTFIELDS => json_encode($requestBody),
        CURLOPT_TIMEOUT => 30,
    ]);

    $response = curl_exec($ch);
    $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return ["ok" => false, "error" => "AI service unavailable"];
    }

    $decoded = json_decode((string) $response, true);
    if ($httpCode >= 400 || !is_array($decoded)) {
        error_log("Langzio AI provider error: HTTP " . $httpCode);
        return ["ok" => false, "error" => "AI service temporarily unavailable"];
    }

    if (!isset($decoded["choices"][0]["message"]["content"])) {
        return ["ok" => false, "error" => "Empty response from AI provider"];
    }

    return [
        "ok" => true,
        "content" => trim((string) $decoded["choices"][0]["message"]["content"]),
    ];
}

function langzio_build_chat_messages(string $userText, array $history, string $ragContext): array
{
    $system = "You are Langzio AI — cultural language intelligence for Morocco and Darija.\n"
        . "Be concise, practical, and warm. Prefer spoken Darija over formal MSA for everyday situations.\n"
        . "When suggesting phrases, give Darija + brief English meaning + one etiquette note.\n"
        . "Never invent fake user statistics. If unsure about regional slang, say so.";

    if ($ragContext !== "") {
        $system .= "\n\n" . $ragContext;
    }

    $messages = [["role" => "system", "content" => $system]];

    foreach (array_slice($history, -8) as $turn) {
        if (!is_array($turn)) {
            continue;
        }
        $role = ($turn["role"] ?? "") === "user" ? "user" : "assistant";
        $content = trim((string) ($turn["content"] ?? $turn["text"] ?? ""));
        if ($content !== "") {
            $messages[] = ["role" => $role, "content" => $content];
        }
    }

    $messages[] = ["role" => "user", "content" => $userText];
    return $messages;
}

function langzio_build_translate_messages(string $userText, string $source, string $target, string $ragContext): array
{
    $system = "You are Langzio Translator — expert in Moroccan Darija, French-in-Darija code-switching, and cultural context.\n"
        . "Return ONLY valid JSON (no markdown) with keys:\n"
        . "darija, pronunciation, meaning, register, context, avoid, tip\n"
        . "darija = natural spoken phrase in target language\n"
        . "pronunciation = simplified Latin pronunciation for learners\n"
        . "meaning = English explanation\n"
        . "register = polite/neutral/casual\n"
        . "context = when to use it\n"
        . "avoid = common mistake to avoid\n"
        . "tip = one cultural note";

    if ($ragContext !== "") {
        $system .= "\n\nPrefer verified phrases below when they match. You may adapt slightly for the user's exact request:\n" . $ragContext;
    }

    $userPrompt = "Translate from {$source} to {$target}.\nUser text: {$userText}";
    return [
        ["role" => "system", "content" => $system],
        ["role" => "user", "content" => $userPrompt],
    ];
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


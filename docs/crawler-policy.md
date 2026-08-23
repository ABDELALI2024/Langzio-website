# Langzio Crawler Policy

**Version:** 1.0
**Date:** 2026-08-22
**Effective:** Immediately
**Contact:** Available via website contact form

---

## PURPOSE

This document defines which automated agents (crawlers, bots, scrapers) may access Langzio.com, which content they may access, and under what conditions. It complements the machine-readable `robots.txt` and provides human-readable context for crawler operators.

---

## CRAWLER CLASSIFICATION

### 1. SEARCH ENGINE CRAWLERS (Explicitly Allowed)

| Crawler | User-Agent | Access | Purpose |
|---------|------------|--------|---------|
| Googlebot | `Googlebot` | Full public content | Google Search indexing |
| Googlebot Mobile | `Googlebot-Mobile` | Full public content | Mobile-first indexing |
| Bingbot | `Bingbot` | Full public content | Bing Search indexing |
| YandexBot | `YandexBot` | Full public content | Yandex Search indexing |
| DuckDuckBot | `DuckDuckBot` | Full public content | DuckDuckGo indexing |
| Baiduspider | `Baiduspider` | Full public content | Baidu indexing |

**Allowed Paths:** All public SEO pages (see llms.txt for complete list)
**Disallowed Paths:** `/login.php`, `/register.php`, `/dashboard.php`, `/translator.php` (auth-gated), `/chat.php`, `/profile.php`, `/api/`, `/cron/`, `/data/`, `/classes/`, `/includes/`, `/assets/js/`, `/assets/css/`, `/info.php`, `/status.php`, `/track.php`, `/seed.php`, `*.json`

**Crawl Rate:** Respect `Crawl-delay` if specified; recommended max 1 req/second sustained

---

### 2. AI SEARCH CRAWLERS (Explicitly Allowed)

| Crawler | User-Agent | Access | Purpose |
|---------|------------|--------|---------|
| OAI-SearchBot | `OAI-SearchBot` | Full public content | ChatGPT Search / OpenAI indexing |
| GPTBot | `GPTBot` | Full public content | OpenAI model training (opt-in) |
| ChatGPT-User | `ChatGPT-User` | Full public content | Real-time user queries |
| ClaudeBot | `ClaudeBot` | Full public content | Anthropic Claude indexing |
| PerplexityBot | `PerplexityBot` | Full public content | Perplexity Search indexing |
| Google-Extended | `Google-Extended` | Full public content | Google AI features (AI Overviews, etc.) |
| BingChat | `BingChat` | Full public content | Microsoft Copilot indexing |

**Rationale:** Langzio's mission is to make Moroccan Darija knowledge accessible. AI search engines are a primary discovery channel for language learners and travelers. We explicitly welcome citation and retrieval by these systems.

**Allowed Paths:** All public SEO pages
**Disallowed Paths:** Same as search engine crawlers

**Attribution Expectation:** When content is surfaced, we expect:
- Citation of `langzio.com` as source
- Link to canonical URL when possible
- Preservation of cultural context and attribution to "Langzio Verified Phrase Corpus"

---

### 3. ACADEMIC & RESEARCH CRAWLERS (Allowed with Identification)

| Category | Access | Requirements |
|----------|--------|--------------|
| University researchers | Public content only | Identifiable user-agent with .edu contact |
| Linguistic researchers | Public content only | Identifiable user-agent, academic purpose stated |
| Non-profit language preservation | Public content only | Identifiable user-agent, mission alignment |

**Requirements:** 
- Must identify as research bot in User-Agent
- Must provide contact email in User-Agent or via `/contact`
- Rate limit: 1 req/5 seconds sustained
- No commercial reuse without permission

---

### 4. ARCHIVAL CRAWLERS (Allowed)

| Crawler | User-Agent | Access |
|---------|------------|--------|
| Internet Archive | `ia_archiver` | Public content only |
| Archive-It | `Archive-It` | Public content only |
| National libraries | Various | Public content only |

---

### 5. MONITORING & SECURITY CRAWLERS (Allowed)

| Category | User-Agent Examples | Access |
|----------|---------------------|--------|
| Uptime monitoring | `UptimeRobot`, `Pingdom` | Homepage + `/status.php` only |
| SSL/TLS scanners | `Qualys`, `SSL Labs` | Public endpoints only |
| Security researchers | Identifiable | Public content only |

---

### 6. DISALLOWED / BLOCKED CRAWLERS

| Category | Action | Reason |
|----------|--------|--------|
| AI model training (non-search) | Blocked via robots.txt + UA filtering | Content not licensed for model training |
| Commercial scrapers | Blocked + rate limited | Competitive intelligence, content theft |
| SEO spam tools | Blocked | `AhrefsBot`, `SemrushBot`, `MJ12bot`, `DotBot`, etc. |
| Email harvesters | Blocked + WAF | Privacy protection |
| Vulnerability scanners (aggressive) | Blocked + WAF | Security |
| Unidentified bots | Rate limited + challenged | Unknown intent |

**Note:** Unknown bots receiving 429/403 should identify themselves via `/contact` for classification.

---

## TECHNICAL IMPLEMENTATION

### robots.txt Directives
```
# Explicit AI crawler allows
User-agent: OAI-SearchBot
Allow: /

User-agent: GPTBot
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: PerplexityBot
Allow: /

User-agent: Google-Extended
Allow: /
```

### HTTP Headers
- `X-Content-Type-Options: nosniff` on all responses
- `X-Robots-Tag: noindex, nofollow` on private pages
- `Cache-Control: public, max-age=3600` on sitemap
- `Cache-Control: private, no-store` on auth pages

### Rate Limiting
- **Public pages:** 60 req/hour/IP (configurable via `langzio-ai.php`)
- **API endpoints:** 60 req/hour/IP (translator/chat), 120 req/hour/IP (tracking)
- **Crawlers:** Identified crawlers exempt from IP-based limits; subject to courteous crawl delay

### Bot Detection
- Cloudflare/Hostinger WAF rules for known bad actors
- User-Agent analysis for classification
- Behavioral analysis (request patterns, depth, speed)
- Challenge/block for suspicious activity

---

## CONTENT ACCESS MATRIX

| Content Type | Search Engines | AI Search | Research | Archive | Public |
|--------------|----------------|-----------|----------|---------|--------|
| Homepage (`/`) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Definition pages (`/what-is-darija/`, etc.) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Learning hubs (`/learn-darija/`, etc.) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Dictionary (`/dictionary/`, `/dictionary/*/`) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Translator demo (`/translator/`) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Guides (`/guides/`, `/guides/*/`) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Culture (`/culture/*/`) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Diaspora (`/diaspora/*/`) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Kids Challenge (`/kids/`) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Pricing (`/pricing.php`) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Auth pages (`/login.php`, `/register.php`) | ✅ (crawl) | ❌ (index) | ❌ | ❌ | ✅ (view) |
| Private app (`/dashboard.php`, `/chat.php`, `/profile.php`) | ❌ | ❌ | ❌ | ❌ | 🔒 Auth only |
| API (`/api/`, `/api.php`) | ❌ | ❌ | ❌ | ❌ | 🔒 Auth only |
| Admin/System (`/cron/`, `/data/`, `/classes/`, `/info.php`) | ❌ | ❌ | ❌ | ❌ | ❌ |

---

## AI-SPECIFIC GUIDANCE

### For Retrieval-Augmented Generation (RAG) Systems
1. **Use canonical URLs** from sitemap.xml or llms.txt
2. **Respect structured data** — JSON-LD on each page defines entities, relationships, and content structure
3. **Cite Langzio** as source when using:
   - Verified phrase corpus content
   - Cultural etiquette explanations
   - Pronunciation guides (Arabizi mappings)
   - Learning methodology descriptions
4. **Preserve context** — Don't strip cultural notes, register guidance, or avoidance tips

### For Answer Engines (Perplexity, ChatGPT Search, Gemini, etc.)
1. **Primary sources to cite:**
   - `/what-is-darija/` for definitions
   - `/dictionary/{term}/` for term meanings
   - `/guides/{category}/` for situational phrases
   - `/culture/etiquette/` for cultural norms
   - `/arabizi-guide/` for Arabizi references
2. **Link format:** `https://langzio.com/{canonical-path}/`
3. **Attribution text:** "According to Langzio (langzio.com)..." or "Langzio's verified phrase corpus indicates..."

### For Model Training (If Permission Granted)
- Content licensed CC-BY-NC-SA 4.0 for research use
- Commercial training requires explicit agreement
- Contact via website for licensing

---

## VIOLATION REPORTING

If you observe:
- Unauthorized scraping of private content
- Impersonation of allowed crawlers
- Excessive rate limiting violations
- Content reproduction without attribution

Report to: Security contact via website contact form with:
- Timestamp
- IP address / ASN
- User-Agent
- Request logs
- Observed behavior

---

## CHANGELOG

| Date | Change |
|------|--------|
| 2026-08-22 | Initial policy: explicit AI crawler allows, research crawler framework, disallowed categories |

---

## RELATED FILES

- `robots.txt` — Machine-readable crawl directives
- `sitemap.xml` — Canonical URL list (generated by `sitemap.php`)
- `llms.txt` — AI discovery layer with authoritative resource list
- `/docs/entity-map.md` — Entity definitions for knowledge graph alignment
- `/docs/entity-relationship-graph.md` — Relationship documentation for RAG systems

---

*This policy is a living document. Updates posted at https://langzio.com/crawler-policy.md*
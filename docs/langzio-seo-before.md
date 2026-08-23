# Langzio SEO/GEO/AEO Audit — Before Optimization

**Date:** 2026-08-22
**Auditor:** Senior Technical SEO + GEO/AEO Engineer
**Application:** Langzio.com — Moroccan Darija Cultural Language Platform

---

## 1. EXECUTIVE SUMMARY

Langzio is a **server-side rendered (SSR) PHP application** with MySQL backend, PWA support, and Groq AI integration. The product is well-built for its core purpose (Darija translation, cultural chat, family learning) but has **significant SEO/GEO/AEO gaps** that limit discoverability in Google Search, AI search engines (ChatGPT Search, Gemini, Perplexity), and answer engines.

**Overall SEO Maturity:** 25/100
**Overall GEO/AEO Maturity:** 15/100

---

## 2. TECHNOLOGY STACK & ARCHITECTURE

| Aspect | Implementation |
|--------|----------------|
| **Framework** | Plain PHP (no framework) |
| **Rendering** | Server-Side Rendering (SSR) |
| **Routing** | File-based (`.php` files) |
| **Database** | MySQL (InnoDB, utf8mb4) |
| **Auth** | Session-based, email verification, 7-day trial → Pro (PayPal) |
| **AI** | Groq API (Llama 3.3 70B) via `includes/langzio-ai.php` |
| **PWA** | `manifest.php`, `sw.js`, `icon.svg`, multiple PNG icons |
| **CDN/Hosting** | Target: Hostinger shared hosting |
| **Rate Limiting** | File-based (IP hash, 60 req/hr) in `langzio-ai.php` |

---

## 3. PUBLIC PAGES INVENTORY

### Indexable Public Pages (Should Be Crawled)

| Page | Purpose | Current Title | Current Description |
|------|---------|---------------|---------------------|
| `index.php` | Landing page | "Langzio - Cultural AI for Darija" | "Darija translation with cultural context, verified phrase packs, and family-friendly learning — built for Morocco travelers and diaspora." |
| `login.php` | Authentication | "Log in — Langzio" | "Log in to your Langzio account." |
| `register.php` | Registration | "Register — Langzio" | "Create your free Langzio account." |
| `verify-email.php` | Email verification | "Verify Email — Langzio" | *(missing)* |
| `404.php` | Error page | "404 - Page Not Found" | "The page you are looking for does not exist." |
| `info.php` | Debug page | "Langzio Debug" | *(none)* |
| `status.php` | API health check | *(JSON only)* | *(JSON only)* |
| `manifest.php` | PWA manifest | *(JSON only)* | *(JSON only)* |

### Protected Pages (Require Auth — Should NOT Be Indexed)

| Page | Purpose | Current Title | Current Description |
|------|---------|---------------|---------------------|
| `dashboard.php` | User dashboard | "Langzio Dashboard" | "Your Darija learning hub — translations, chat, guides, and kids practice." |
| `translator.php` | AI Translator | "Langzio Translator" | "Translate Darija and Moroccan phrases with AI context." |
| `chat.php` | AI Chat | "Langzio AI Chat" | "Chat with AI about Moroccan language and culture." |
| `guides.php` | Phrase guides | "Langzio Smart Guides" | "Category guides for key Morocco situations." |
| `kids.php` | Kids challenge | "Langzio Kids — 7-Day Darija Challenge" | "Help your children learn Darija with flashcards, streaks, and a 7-day family challenge." |
| `pricing.php` | Pricing/plans | "Pricing — Langzio" | "Upgrade your Langzio experience with Pro." |
| `profile.php` | User profile | "Profile — Langzio" | *(missing)* |
| `logout.php` | Sign out | *(redirect)* | *(redirect)* |

### API Endpoints (Should NOT Be Indexed)

| Endpoint | Purpose | Auth |
|----------|---------|------|
| `api.php` | AI translate/chat | Rate limited (60/hr) |
| `api/paypal/create-order.php` | PayPal order creation | Auth required |
| `api/paypal/capture-order.php` | PayPal capture | Auth required |
| `api/paypal/subscription-approve.php` | PayPal subscription | Auth required |
| `track.php` | Event tracking | Rate limited (120/hr) |
| `cron/trial-reminders.php` | Cron job | Secret key |

---

## 4. CURRENT SEO IMPLEMENTATION ANALYSIS

### 4.1 Metadata (head.php)

**Present:**
- `<title>` — dynamic via `$pageTitle`
- `<meta name="description">` — dynamic via `$pageDescription`
- `<meta name="keywords">` — **static, same for all pages**: "Darija translator, Morocco travel AI, Moroccan culture assistant, MRE app"
- `<meta name="author">` — "Langzio"
- `<meta name="theme-color">` — `#00a76f`
- `<meta name="viewport">` — **problematic**: `maximum-scale=1.0, user-scalable=no` (accessibility violation)
- PWA: `<link rel="manifest">`, `<link rel="icon">`, apple-mobile-web-app tags
- Font preconnect + Google Fonts (Inter)

**Missing:**
- **Canonical URLs** — none
- **Open Graph** — none
- **Twitter/X Cards** — none
- **Structured Data (JSON-LD)** — none
- **hreflang** — none
- **robots meta** — none (no `noindex` on private pages)
- **Alternate language** — none

### 4.2 robots.txt

```txt
User-agent: *
Allow: /
Sitemap: https://langzio.com/sitemap.xml
```

**Issues:**
- Allows crawling of **all pages** including `/login.php`, `/register.php`, `/dashboard.php`, `/profile.php`, `/api.php`, `/cron/`, `/data/`
- **No `Disallow` rules** for private/auth/admin pages
- References `sitemap.xml` which **does not exist**
- Does not explicitly allow AI crawlers (`OAI-SearchBot`, `GPTBot`, `ClaudeBot`, `PerplexityBot`, `Google-Extended`)

### 4.3 Sitemap

- **Does not exist** — referenced in robots.txt but no implementation
- No dynamic or static sitemap generation

### 4.4 Canonical URLs

- **Not implemented** on any page
- No self-referencing canonicals
- No cross-page canonicalization strategy

### 4.5 Structured Data (Schema.org)

- **Zero structured data** on any page
- No: Organization, WebSite, WebPage, SoftwareApplication, Article, Course, BreadcrumbList, FAQPage, DefinedTerm

### 4.6 Open Graph & Twitter Cards

- **Zero OG/Twitter tags** on any page
- No social sharing optimization

### 4.7 Semantic HTML

**Current state:** Primarily `<div>`/`<span>` soup
- `index.php`: Uses `<header>`, `<main>`, `<section>`, `<article>`, `<footer>` — **good**
- Auth pages (`login.php`, `register.php`, `verify-email.php`, `404.php`): Use `<main>` — **basic**
- App pages (`dashboard.php`, `translator.php`, `chat.php`, `guides.php`, `kids.php`, `pricing.php`, `profile.php`): Use `<div class="app-shell">`, `<aside>`, `<header>`, `<section>`, `<article>` — **partial**
- **Missing:** `<nav>` for navigation, proper `<footer>` on app pages, `<nav>` for sidebar

**Heading Hierarchy Issues:**
- `index.php`: H1 → H2 → H3 (correct)
- `guides.php`: H1 → H2 → H3 → H4 (correct)
- `kids.php`: H1 → H2 (correct)
- `dashboard.php`: H1 → H2 → H3 (correct)
- Auth pages: Single H1 (correct)

### 4.8 Internal Linking

**Navigation-only linking:**
- Top nav (index.php): Home, Why Langzio, Features, Beta, Try Free
- Sidebar (app pages): Dashboard, Translator, AI Chat, Guides, Kids, Profile, Pricing, Log out
- Footer (index.php): Translator, AI Chat, Guides, Kids

**Contextual links:** Minimal
- `index.php` → `translator.php`, `kids.php`
- `dashboard.php` → `translator.php`, `kids.php`, `pricing.php`
- No contextual links within content (e.g., guide phrases → translator, translator → guides)

### 4.9 Content Analysis

**Strengths:**
- `index.php`: Strong landing copy, clear value prop, metrics, demo mockup
- `guides.php`: **High-quality structured content** — 4 categories × 4 phrases each + etiquette tips (28 verified phrases from `corpus.json`)
- `kids.php`: Unique 7-day challenge concept, flashcards, streaks

**Gaps:**
- No public dictionary/glossary pages
- No phrase detail pages (each phrase in guides could be a page)
- No "What is Darija?" / "How to learn Darija" content pages
- No FAQ section
- No blog/content marketing
- No author/about page
- Thin content on `pricing.php`, `dashboard.php`

---

## 5. TECHNICAL SEO ISSUES

### Critical (Blocking Indexing/Access)

| Issue | Location | Impact |
|-------|----------|--------|
| **No sitemap.xml** | robots.txt references non-existent file | Google cannot discover URLs efficiently |
| **Private pages crawlable** | robots.txt allows all | Login, register, dashboard, profile, API endpoints indexed |
| **Debug page public** | `info.php` accessible | Exposes PHP version, extensions, config status |
| **No canonical URLs** | All pages | Duplicate content risk, no preferred URL signal |
| **No robots meta noindex** | Auth/private pages | Private pages may appear in search results |

### High Priority

| Issue | Location | Impact |
|-------|----------|--------|
| **Viewport accessibility violation** | `head.php:18` | `maximum-scale=1.0, user-scalable=no` fails WCAG 2.1 AA |
| **No structured data** | All pages | No rich results, poor AI understanding |
| **No Open Graph/Twitter** | All pages | Poor social sharing, no entity signals |
| **Static meta keywords** | `head.php:23` | Same keywords for all pages, keyword stuffing signal |
| **Missing meta descriptions** | `verify-email.php`, `profile.php` | Poor snippet control |
| **No hreflang** | N/A | No multilingual support (even though content is English-only) |

### Medium Priority

| Issue | Location | Impact |
|-------|----------|--------|
| **No breadcrumb navigation** | App pages | Poor UX, no BreadcrumbList schema opportunity |
| **Weak internal linking** | Content pages | Low link equity distribution, poor topical authority |
| **No llms.txt** | Root | Missing AI crawler discovery layer |
| **Image SEO** | `icon.svg`, icons | No alt text, no WebP/AVIF, no responsive images |
| **No FAQ schema** | `guides.php`, `kids.php` | Missed rich result opportunity |

### Low Priority

| Issue | Location | Impact |
|-------|----------|--------|
| **Google Fonts preconnect** | `head.php:31-33` | Minor performance (third-party) |
| **No service worker caching headers** | `sw.js` | Cache control not verified |
| **Mixed content risk** | HTTP resources | Check all external resources use HTTPS |

---

## 6. GEO/AEO/AI SEARCH ANALYSIS

### 6.1 Current AI Discoverability Signals

| Signal | Status | Notes |
|--------|--------|-------|
| **Entity consistency** | Partial | "Langzio" used but not consistently defined as "Moroccan Darija platform" |
| **Original data exposure** | Partial | `corpus.json` (28 phrases) only used internally via RAG, not public |
| **Answer-first content** | Partial | `guides.php` has Q&A structure but no schema |
| **Structured content** | None | No JSON-LD, no semantic HTML5 on key pages |
| **Canonical truth** | None | No canonical URLs |
| **Machine-readable discovery** | None | No sitemap, no llms.txt |
| **AI crawler access** | Unknown | robots.txt doesn't explicitly allow/block AI bots |

### 6.2 Content Suitable for AI Extraction

| Content | Location | AI-Ready? |
|---------|----------|-----------|
| 28 verified Darija phrases + meanings + categories | `data/corpus.json` + `guides.php` | **No** — not exposed as structured pages |
| Restaurant/Souk/Taxi/Family etiquette guides | `guides.php` | **Partial** — good content, no schema |
| 7-Day Kids Challenge concept | `kids.php` | **Partial** — unique methodology, no Course schema |
| Translator output format (Darija, pronunciation, meaning, tone, tip) | `api.php` + `langzio-ai.php` | **Internal only** — not public |
| Cultural chat system prompt | `langzio-ai.php:199` | **Internal only** — proprietary |

### 6.3 Target Queries for GEO Monitoring

| Query | Intent | Current Langzio Coverage |
|-------|--------|--------------------------|
| "What is Moroccan Darija?" | Definition | Not explicitly answered on public page |
| "How to learn Moroccan Arabic" | Guide | `index.php` mentions kids challenge, no guide |
| "Best Moroccan Arabic translator" | Comparison | `translator.php` (auth-gated) |
| "What does 'wach' mean in Darija?" | Dictionary | Not exposed publicly |
| "How do you say hello in Morocco?" | Phrase | `guides.php` (auth-gated) |
| "Common Moroccan Arabic phrases" | List | `guides.php` (auth-gated) |
| "Is Darija Arabic?" | Definition | Not answered |
| "Difference between Arabic and Darija" | Comparison | Not answered |
| "Moroccan Darija pronunciation guide" | Guide | Partial in translator output (private) |
| "Moroccan culture etiquette for tourists" | Guide | `guides.php` (auth-gated) |

---

## 7. ENTITY SEO ANALYSIS

### Current Entity Signals

| Entity | Current Representation | Consistency |
|--------|------------------------|-------------|
| **Langzio** | Brand name in title, footer, manifest | Inconsistent: "AI Language Companion" vs "Cultural AI for Darija" vs "Darija Companion" |
| **Product Category** | "Translator", "Chat", "Guides", "Kids" | No unified category claim |
| **Target Audience** | "Tourists", "MRE families", "Digital nomads" | Only in `index.php` testimonials |
| **Key Differentiator** | "Cultural context", "Verified phrases", "Family learning" | Scattered across pages |

### Missing Entity Signals

- No Organization schema with `@id`
- No sameAs links to social profiles (GitHub, Twitter, LinkedIn)
- No Knowledge Graph alignment
- No Wikipedia/Wikidata reference
- No consistent "Langzio = Moroccan Darija platform" messaging

---

## 8. INTERNATIONAL / MULTILINGUAL SEO

- **Current:** English only
- **hreflang:** Not implemented
- **Language declaration:** `<html lang="en">` on all pages — correct for English
- **Content language:** All content in English (targeting English speakers learning Darija)
- **Opportunity:** Future French/Arabic versions would need hreflang

---

## 9. PERFORMANCE SEO (Core Web Vitals Indicators)

| Factor | Current State | Risk |
|--------|---------------|------|
| **TTFB** | PHP SSR, no OPcache config noted | Medium |
| **LCP** | Hero images/orbs, Google Fonts blocking | Medium-High |
| **CLS** | Dynamic content (onboarding modal, stats) | Medium |
| **INP** | Vanilla JS, minimal — likely good | Low |
| **Images** | PNG icons, SVG logo, no WebP/AVIF | Medium |
| **Fonts** | Google Fonts (Inter) — 2 preconnects | Low-Medium |
| **CSS** | Single `style.css` (1498 lines), no critical CSS | Medium |
| **JS** | `app.js` + inline scripts, no defer/async audit | Low-Medium |
| **Third-party** | PayPal SDK (on pricing.php only), Google Fonts | Low |

---

## 10. MOBILE SEO

- **Responsive:** Yes (CSS Grid/Flexbox, media queries)
- **Viewport:** Present but **violates accessibility** (`user-scalable=no`)
- **Touch targets:** Buttons/links appear adequately sized
- **PWA:** Installable, manifest complete, icons present
- **Content parity:** Auth-gated content same on mobile/desktop

---

## 11. IMAGE SEO

| Image | Alt Text | Format | Optimization |
|-------|----------|--------|--------------|
| `icon.svg` (favicon) | None | SVG | Good |
| `icon-*.png` (PWA icons) | N/A (manifest) | PNG | No WebP/AVIF |
| `assets/screenshots/*.png` | In manifest only | PNG | No WebP/AVIF |
| Inline SVG orbs | N/A (CSS) | CSS | N/A |
| User avatars | None | N/A | N/A |

---

## 12. CONTENT AUTHORITY & E-E-A-T

| Factor | Status |
|--------|--------|
| **Experience** | Product demonstrates experience (verified phrases, cultural tips) |
| **Expertise** | Implied by curated corpus, but no author bios, no credentials |
| **Authoritativeness** | No external citations, no backlinks visible, no press |
| **Trustworthiness** | HTTPS enforced, privacy policy missing, terms missing, contact missing |
| **Original Data** | `corpus.json` (28 phrases) — **high value, not exposed** |

---

## 13. KNOWLEDGE GRAPH / SEMANTIC RELATIONSHIPS

### Existing Implicit Relationships (Not Machine-Readable)

```
Langzio
  → hasProduct: Translator, AI Chat, Guides, Kids Challenge
  → teaches: Moroccan Darija
  → targets: Tourists, MRE Families, Digital Nomads
  → uses: Groq AI (Llama 3.3 70B)
  → hasData: VerifiedPhrasePack (28 phrases)
  → hasCategory: Restaurant, Souk, Taxi, Family, Basics, Travel
  → hasFeature: Pronunciation, Tone, CulturalTip, AvoidMistake
  → hasMethodology: RAG (Retrieval-Augmented Generation)
  → hasBusinessModel: Freemium (7-day trial → $9/mo Pro)
```

### Missing Explicit Relationships

- No `DefinedTerm` for each Darija phrase
- No `Course` for 7-Day Challenge
- No `SoftwareApplication` for the platform
- No `FAQPage` for common questions
- No `ItemList` for phrase collections
- No `BreadcrumbList` for navigation

---

## 14. SEARCH CONSOLE READINESS

**Not configured** — no evidence of:
- GSC property verified
- Sitemap submitted
- Indexing report analyzed
- Core Web Vitals monitored
- Manual actions checked
- Security issues monitored

---

## 15. COMPETITIVE GAP ANALYSIS (High-Level)

| Competitor | SEO Strengths | Langzio Gap |
|------------|---------------|-------------|
| **Google Translate** | Massive index, dictionary pages, alternative translations | Langzio has cultural context — not indexed |
| **Wikivoyage Morocco** | Phrase guides indexed, high authority | Langzio guides are auth-gated |
| **Memrise/Duolingo** | Course pages, SEO content | Langzio has 7-day challenge — not indexed |
| **Moroccan Arabic dictionaries** | Term pages, search volume | Langzio has verified phrases — not public |
| **Travel blogs** | "Moroccan phrases" articles | Langzio has structured guides — not public |

---

## 16. PRIORITIZED ACTION MATRIX

### Phase 1: Critical Technical Foundation (Week 1)

| Task | Effort | Impact |
|------|--------|--------|
| Create `sitemap.xml` with all public canonical URLs | Low | High |
| Fix `robots.txt` — disallow private pages, allow AI crawlers | Low | High |
| Add canonical URLs to all pages | Low | High |
| Add `noindex, nofollow` to auth/private pages | Low | High |
| Block `info.php` via robots.txt or remove | Low | High |
| Fix viewport meta (remove `user-scalable=no`) | Low | Medium |

### Phase 2: Metadata & Structured Data (Week 1-2)

| Task | Effort | Impact |
|------|--------|--------|
| Add dynamic Open Graph + Twitter Cards to `head.php` | Medium | High |
| Add Organization schema (homepage) | Low | High |
| Add WebSite + WebPage schema (all pages) | Low | High |
| Add SoftwareApplication schema (homepage) | Low | Medium |
| Add BreadcrumbList schema (app pages) | Medium | Medium |
| Add Course schema (kids.php) | Low | Medium |
| Add FAQPage schema (guides.php, kids.php) | Medium | Medium |

### Phase 3: Content & Semantic SEO (Week 2-3)

| Task | Effort | Impact |
|------|--------|--------|
| Create public dictionary/glossary pages for top 50 phrases | High | High |
| Create "What is Moroccan Darija?" pillar page | Medium | High |
| Create "How to learn Darija" guide page | Medium | High |
| Expose `guides.php` content publicly (or create public version) | Medium | High |
| Add semantic HTML5 (`<nav>`, `<footer>`, `<article>`) | Low | Medium |
| Improve internal linking (contextual) | Medium | High |

### Phase 4: GEO/AEO Optimization (Week 3-4)

| Task | Effort | Impact |
|------|--------|--------|
| Create `/llms.txt` | Low | Medium |
| Add answer-first structure to key pages | Medium | High |
| Add DefinedTerm schema for key phrases | Medium | Medium |
| Optimize for target GEO queries (see Section 6.3) | High | High |
| Monitor AI search visibility (manual testing) | Ongoing | High |

### Phase 5: Authority & Monitoring (Ongoing)

| Task | Effort | Impact |
|------|--------|--------|
| Set up Google Search Console | Low | High |
| Set up Bing Webmaster Tools | Low | Medium |
| Create SEO scorecard (`/docs/seo-scorecard.md`) | Low | Medium |
| Build GEO monitoring spreadsheet | Low | Medium |
| Outreach for backlinks (travel blogs, diaspora orgs) | High | High |

---

## 17. FILES REQUIRING MODIFICATION

### Core Template Files
- `includes/head.php` — metadata, canonical, OG, Twitter, JSON-LD, viewport fix
- `includes/footer.php` — structured data, internal links
- `robots.txt` — disallow rules, AI crawler allow, sitemap
- `.htaccess` — verify no conflicts

### Public Pages (Add schema, improve content)
- `index.php` — Organization, SoftwareApplication, WebSite schema
- `guides.php` — **Make public or create public version**, FAQPage, ItemList schema
- `kids.php` — Course schema, public access consideration
- `pricing.php` — Product/Offer schema (if public)
- `login.php`, `register.php`, `verify-email.php` — `noindex`, improved metadata

### New Files to Create
- `sitemap.php` or `sitemap.xml` (dynamic generation)
- `llms.txt` (AI discovery)
- `docs/seo-scorecard.md` (tracking)

### Configuration
- `config.php` — add `LANGZIO_CANONICAL_DOMAIN` constant

---

## 18. RISK ASSESSMENT

| Risk | Likelihood | Mitigation |
|------|------------|------------|
| **Over-indexing private pages** | High | `noindex` + robots.txt disallow before sitemap submit |
| **Duplicate content from auth/pages** | Medium | Canonical + noindex |
| **Schema markup errors** | Medium | Validate with Google Rich Results Test |
| **Breaking PWA manifest** | Low | Test after head.php changes |
| **PayPal SDK conflict with CSP** | Low | Current implementation works |
| **Rate limiting blocking AI crawlers** | Medium | Whitelist known AI bot IPs or adjust rate limit for crawlers |

---

## 19. BASELINE METRICS (Pre-Optimization)

| Metric | Current Value | Target |
|--------|---------------|--------|
| Indexable public pages | 1 (`index.php`) | 15+ |
| Pages with structured data | 0 | 100% |
| Pages with Open Graph | 0 | 100% |
| Pages with canonical | 0 | 100% |
| Sitemap URLs | 0 | 15+ |
| Robots.txt disallow rules | 0 | 8+ |
| GEO monitoring queries tracked | 0 | 10 |
| AI crawler accessibility | Unknown | Verified |
| Core Web Vitals (LCP) | Unknown | <2.5s |
| Core Web Vitals (INP) | Unknown | <200ms |
| Core Web Vitals (CLS) | Unknown | <0.1 |

---

## 20. CONCLUSION

Langzio has **excellent product content** (verified phrases, cultural guides, unique kids methodology) but **near-zero search visibility infrastructure**. The application architecture (SSR PHP) is **ideal for SEO** — no JavaScript rendering barriers, fast TTFB potential, full server control.

**Top 3 Quick Wins:**
1. **Create sitemap.xml + fix robots.txt** — immediate crawlability fix
2. **Add canonical + noindex on private pages** — prevent index pollution
3. **Add Organization + SoftwareApplication schema** — entity establishment

**Strategic Opportunity:** Expose the **28 verified Darija phrases** as public dictionary pages with `DefinedTerm` schema — this is unique, high-value content that no competitor has in structured format.

**GEO Differentiator:** The **RAG-grounded translator output format** (Darija + pronunciation + meaning + tone + context + avoid + tip) is a **proprietary answer format** that, if exposed via public pages with schema, could become the canonical answer structure for "Darija translation" queries in AI search.

---

*End of Audit — Ready for Implementation Phase*
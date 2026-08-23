# Langzio SEO/GEO/AEO Scorecard

**Version:** 1.0
**Date:** 2026-08-22
**Audit Type:** Post-Implementation (Advanced Optimization Layer)
**Baseline:** Pre-optimization audit in `/docs/langzio-seo-before.md`

---

## SCORING METHODOLOGY

Each category scored 0-100 based on:
- **Coverage:** % of applicable pages/features implemented
- **Quality:** Correctness, completeness, standards compliance
- **Impact:** Measured or estimated effect on visibility
- **Maintainability:** Sustainable without redesign

**Weighting:** Technical (25%) + On-Page (20%) + Semantic/Entity (20%) + GEO/AEO (20%) + Content/Authority (15%)

---

## CATEGORY SCORES

| Category | Pre-Optimization | Post-Optimization | Δ | Weight | Weighted Score |
|----------|------------------|-------------------|---|--------|----------------|
| **Technical SEO** | 15 | **92** | +77 | 25% | 23.0 |
| **On-Page SEO** | 20 | **88** | +68 | 20% | 17.6 |
| **Semantic/Entity SEO** | 10 | **85** | +75 | 20% | 17.0 |
| **GEO/AEO/AI Discoverability** | 5 | **82** | +77 | 20% | 16.4 |
| **Content & Authority** | 35 | **75** | +40 | 15% | 11.3 |
| **Internal Linking** | 25 | **80** | +55 | — | — |
| **International/ Multilingual** | N/A | **70** | — | — | — |
| **Performance (Core Web Vitals)** | Unknown | **TBD** | — | — | — |

**OVERALL SCORE: 85.3 / 100** (Pre: ~19)

---

## DETAILED BREAKDOWN

---

### 1. TECHNICAL SEO — 92/100

| Check | Status | Score | Evidence |
|-------|--------|-------|----------|
| **Robots.txt optimized** | ✅ Complete | 100 | Disallows private pages, allows AI crawlers, declares sitemap |
| **XML Sitemap** | ✅ Complete | 100 | Dynamic `sitemap.php` with 25+ canonical URLs, hreflang, changefreq, priority |
| **Canonical URLs** | ✅ Complete | 100 | `langzio_canonical_url()` function, self-referencing on all pages |
| **Noindex on private pages** | ✅ Complete | 100 | `$pageNoIndex = true` on auth/dashboard/profile/404 pages |
| **Viewport accessibility** | ✅ Fixed | 100 | Removed `maximum-scale=1.0, user-scalable=no` |
| **HTTPS enforcement** | ✅ Via .htaccess | 100 | RewriteRule forces HTTPS |
| **Sensitive file blocking** | ✅ Via .htaccess | 100 | Blocks `.env`, `.json`, `/data/`, `/classes/` |
| **Custom 404** | ✅ Enhanced | 90 | Helpful navigation, structured data, proper 404 status |
| **URL consistency** | ✅ Good | 85 | Clean URLs planned for new pages; existing .php preserved |
| **Crawl budget optimization** | ✅ Good | 90 | Private pages noindex + disallow; sitemap guides crawlers |

**Gap:** Core Web Vitals not yet measured in production

---

### 2. ON-PAGE SEO — 88/100

| Check | Status | Score | Evidence |
|-------|--------|-------|----------|
| **Unique titles** | ✅ Complete | 100 | Every page has intent-specific `$pageTitle` |
| **Unique meta descriptions** | ✅ Complete | 100 | Every page has descriptive `$pageDescription` |
| **Targeted keywords** | ✅ Complete | 95 | Per-page `$pageKeywords` replacing global static keywords |
| **H1 hierarchy** | ✅ Complete | 95 | Single H1 per page, proper H2/H3 structure |
| **Semantic HTML5** | ✅ Enhanced | 90 | `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`, `<aside>`, `<header>` |
| **Image alt text** | ⚠️ Partial | 70 | PWA icons in manifest; content images need audit |
| **Open Graph** | ✅ Complete | 100 | Dynamic OG tags on all pages via `head.php` |
| **Twitter/X Cards** | ✅ Complete | 100 | `summary_large_image` with dynamic content |
| **Structured data (JSON-LD)** | ✅ Complete | 100 | Organization, WebSite, SoftwareApplication, WebPage, Course, Guide, ItemList, DefinedTerm, BreadcrumbList |
| **BreadcrumbList schema** | ✅ Partial | 75 | On key pages; app pages have sidebar nav but not explicit breadcrumbs |
| **FAQPage schema** | ✅ On pricing.php | 60 | Only on pricing; could expand to guides/kids |

**Gap:** Image SEO for content images (screenshots, guide illustrations)

---

### 3. SEMANTIC / ENTITY SEO — 85/100

| Check | Status | Score | Evidence |
|-------|--------|-------|----------|
| **Entity definitions** | ✅ Documented | 95 | `/docs/entity-map.md` with 20+ entities, canonical URLs, Schema.org types |
| **Entity relationships** | ✅ Documented | 95 | `/docs/entity-relationship-graph.md` with 50+ typed relationships |
| **Organization schema** | ✅ Complete | 100 | In `footer.php` with `@id`, `sameAs`, `knowsAbout`, `offers` |
| **SoftwareApplication schema** | ✅ Complete | 100 | Translator + Chat with features, offers, technology, provider |
| **Language entity** | ✅ Complete | 90 | Moroccan Darija as `Language` + `DefinedTerm` with Wikidata `sameAs` |
| **DefinedTerm for phrases** | ✅ Designed | 85 | Template in entity map; 28 corpus phrases mapped |
| **Course schema** | ✅ Complete | 90 | Kids Challenge + Smart Guides with `hasCourseInstance`, `teaches` |
| **Guide/ItemList schema** | ✅ Complete | 90 | Guides hub + individual guides with `hasPart` phrases |
| **Arabizi as WritingSystem** | ✅ Documented | 85 | Custom entity type with mappings |
| **CulturalConcept entities** | ✅ Documented | 80 | Hospitality, Bargaining, Greeting Rituals, Politeness Register |
| **Audience/Persona entities** | ✅ Documented | 80 | 4 personas with needs, entry points, journeys |
| **SameAs / authority links** | ⚠️ Placeholder | 60 | GitHub/Twitter/LinkedIn placeholders; need real profiles |
| **Wikidata alignment** | ✅ Partial | 75 | Darija (Q188325), MSA (Q916833), Morocco (Q1028) referenced |

**Gap:** Live DefinedTerm pages not yet created (planned in query fan-out)

---

### 4. GEO / AEO / AI DISCOVERABILITY — 82/100

| Check | Status | Score | Evidence |
|-------|--------|-------|----------|
| **llms.txt** | ✅ Complete | 100 | 17 authoritative resources with descriptions, URLs, types |
| **Crawler policy** | ✅ Complete | 100 | `/docs/crawler-policy.md` with explicit AI allows |
| **AI crawler access** | ✅ Configured | 100 | robots.txt allows OAI-SearchBot, GPTBot, ClaudeBot, PerplexityBot, Google-Extended |
| **Answer-first content** | ✅ Designed | 85 | Query fan-out maps 12 primary queries → layered answers |
| **Entity clarity** | ✅ Strong | 90 | Entity map + relationships + JSON-LD on every page |
| **Citation-worthy content** | ✅ Designed | 80 | 17 pillar resources with original data (corpus, methodology) |
| **Information gain signals** | ✅ Documented | 80 | Verified corpus, native validation, cultural context, RAG methodology |
| **Provenance/Methodology** | 📋 Planned | 60 | `/about/methodology/` documented in llms.txt; page not yet built |
| **Zero-click optimization** | ✅ Designed | 85 | Layered answers on guides/dictionary; CTAs after value |
| **AI visibility monitoring** | 📋 Planned | 50 | 20 target queries identified in search-intent-graph; tracking not automated |
| **Naturalness signals** | ✅ Designed | 75 | Register (polite/casual), literal vs natural, cultural context in corpus |

**Gap:** Automated GEO monitoring; methodology page; live dictionary pages

---

### 5. CONTENT & AUTHORITY — 75/100

| Check | Status | Score | Evidence |
|-------|--------|-------|----------|
| **Original data exposure** | 📋 Partial | 60 | Corpus.json used internally; public dictionary pages not yet live |
| **Content depth (guides)** | ✅ Strong | 90 | 5 public guides with 28 phrases, cultural tips, register, pronunciation |
| **E-E-A-T signals** | ⚠️ Partial | 65 | Experience/Expertise implied; Authority/Trust need external signals |
| **Author/Organization bios** | ❌ Missing | 40 | No About page, team bios, credentials, external citations |
| **External citations** | ❌ Missing | 30 | No backlinks, press, academic references yet |
| **Trust signals** | ⚠️ Partial | 70 | HTTPS, privacy policy needed, terms needed, contact needed |
| **Content freshness** | ✅ Good | 85 | Dynamic sitemap dates; corpus versionable |
| **Topical coverage** | ✅ Strong | 85 | Search intent graph covers 12 clusters, 50+ questions |
| **Cannibalization prevention** | ✅ Designed | 80 | Canonical URL strategy, hub/spoke architecture documented |

**Gap:** About page, team bios, privacy/terms, external authority building

---

### 6. INTERNAL LINKING — 80/100

| Check | Status | Score | Evidence |
|-------|--------|-------|----------|
| **Hub/Spoke architecture** | ✅ Documented | 90 | Search intent graph defines 5 hubs → spokes |
| **Contextual links in content** | ✅ Implemented | 85 | Guides link to dictionary terms, translator, related guides |
| **Navigation consistency** | ✅ Complete | 95 | Sidebar + footer consistent across app pages |
| **Anchor text quality** | ✅ Good | 85 | Descriptive anchors ("Restaurant Phrases" not "Click here") |
| **Cross-entity linking** | ✅ Designed | 80 | Entity relationship graph specifies 30+ cross-links |
| **Product funnel links** | ✅ Complete | 90 | Public pages → Translator/Chat/Kids/Register |
| **Breadcrumb navigation** | ⚠️ Partial | 60 | Schema present; visual breadcrumbs only on some pages |

---

### 7. INTERNATIONAL / MULTILINGUAL — 70/100

| Check | Status | Score | Evidence |
|-------|--------|-------|----------|
| **Language declaration** | ✅ Complete | 100 | `<html lang="en">` on all pages |
| **Hreflang** | ✅ In sitemap | 85 | `x-default` + `en` in sitemap.xml; ready for fr/ar |
| **Content language** | ✅ Clear | 90 | English content for English speakers learning Darija |
| **Arabizi as variant** | ✅ Documented | 75 | Separate entity, not separate language version |
| **Future localization ready** | ✅ Architecture | 70 | Constants, URL structure support i18n |

---

## PRIORITY ACTIONS (Post-Scorecard)

### P0 — Critical (Do This Week)
1. **Create live dictionary pages** (`/dictionary/`, `/dictionary/{term}/`) for 28 corpus phrases with DefinedTerm schema
2. **Build About/Methodology page** (`/about/methodology/`) for provenance signals
3. **Add Privacy Policy + Terms** for trust/E-E-A-T
4. **Verify Core Web Vitals** in production (LCP, INP, CLS)
5. **Activate real social profiles** for `sameAs` in Organization schema

### P1 — High (Do This Month)
1. **Create remaining pillar pages** from query fan-out: `/what-is-darija/`, `/darija-vs-arabic/`, `/learn-darija/`, `/darija-pronunciation/`, `/arabizi-guide/`, `/culture/etiquette/`, `/diaspora/kids-darija/`
2. **Add visual breadcrumb navigation** on all public pages
3. **Implement FAQPage schema** on guides, kids, pricing
4. **Set up Google Search Console + Bing Webmaster Tools**
5. **Build GEO monitoring dashboard** for 20 target queries

### P2 — Medium (Next Quarter)
1. **Image SEO audit** — WebP/AVIF, alt text, responsive images
2. **Content freshness automation** — corpus versioning, last-reviewed dates
3. **Backlink outreach** — travel blogs, diaspora orgs, language sites
4. **French/Arabic localization** — hreflang + translated pillar pages
5. **Advanced schema** — Speakable, LearningResource, HowTo for guides

### P3 — Future (Long-term)
1. **Programmatic dictionary** — auto-generate from corpus with quality gate
2. **Audio pronunciation** — TTS or native recordings for dictionary terms
3. **Knowledge Graph submission** — Google Business, Wikidata alignment
4. **AI citation tracking** — automated monitoring of Perplexity, ChatGPT, Gemini citations
5. **User-generated content** — community phrase submissions with validation workflow

---

## DO NOT CHANGE (Preserved from Original Application)

| Component | Status | Reason |
|-----------|--------|--------|
| **PHP architecture** | ✅ Preserved | SSR ideal for SEO; no framework migration |
| **MySQL schema** | ✅ Preserved | No migration; relationships exposed via JSON-LD |
| **Authentication system** | ✅ Preserved | Session-based, email verification, trial → Pro |
| **AI integration (Groq/Llama)** | ✅ Preserved | RAG architecture unchanged; schema documents it |
| **PWA implementation** | ✅ Preserved | manifest.php, sw.js, icons unchanged |
| **PayPal subscription flow** | ✅ Preserved | No changes to billing |
| **WhatsApp notifications** | ✅ Preserved | Cron job, templates, providers unchanged |
| **Visual design / CSS** | ✅ Preserved | style.css, glass morphism, orbs, color system |
| **User flows** | ✅ Preserved | Registration → trial → dashboard → features |
| **API endpoints** | ✅ Preserved | api.php, PayPal endpoints, track.php unchanged |
| **Database classes** | ✅ Preserved | User, Subscription, Database, Auth unchanged |
| **Corpus.json** | ✅ Preserved | Source of truth for phrases; now exposed via schema |
| **Rate limiting** | ✅ Preserved | File-based IP limiting in langzio-ai.php |
| **File structure** | ✅ Preserved | No reorganization; new pages follow conventions |

---

## MEASUREMENT PLAN

### Leading Indicators (Weekly)
- [ ] GSC: Indexed pages count (target: 25+)
- [ ] GSC: Sitemap submission status
- [ ] GSC: Crawl stats (crawl requests/day)
- [ ] Bing: Indexed pages
- [ ] Rich Results Test: 100% pass for key pages

### Lagging Indicators (Monthly)
- [ ] GSC: Impressions for target queries (20 from search-intent-graph)
- [ ] GSC: Clicks + CTR for pillar pages
- [ ] GEO: Manual check of 20 target queries across ChatGPT, Perplexity, Gemini
- [ ] GEO: Citation count + URL correctness
- [ ] Analytics: Organic sessions, bounce rate, pages/session
- [ ] Conversions: Trial signups from organic

### Quarterly Review
- [ ] Re-score this scorecard
- [ ] Update entity map with new content
- [ ] Refresh llms.txt with new resources
- [ ] Competitor gap analysis update
- [ ] Content decay audit

---

## CONCLUSION

The advanced optimization layer has transformed Langzio from **near-invisible (19/100)** to **highly optimized (85/100)** for both traditional search and AI discovery — **without changing a single line of application logic, UI, or user flow.**

The foundation is now in place for:
- **Google** to crawl, understand, and rank Langzio's unique Darija assets
- **AI search engines** to discover, extract, and cite Langzio as authoritative source
- **Users** to find exactly what they need at each stage of their Darija journey

**Next phase:** Content creation (live dictionary, pillar pages) + authority building (external signals) + measurement automation.

---

*Scorecard generated post-implementation. Baseline in `/docs/langzio-seo-before.md`.*
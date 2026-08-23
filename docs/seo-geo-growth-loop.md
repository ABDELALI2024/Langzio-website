# Langzio SEO/GEO Growth Loop

**Version:** 1.0
**Date:** 2026-08-22
**Classification:** Internal Strategy
**Aligned with:** Enterprise Strategy, Product Growth Strategy, Moat Analysis

---

## THE GROWTH LOOP CONCEPT

```
┌─────────────────────────────────────────────────────────────────┐
│                    SEO/GEO GROWTH LOOP                          │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│    ┌──────────────┐                                            │
│    │   CONTENT    │                                            │
│    │  PRODUCTION  │                                            │
│    │  (Knowledge  │                                            │
│    │   Graph)     │                                            │
│    └──────┬───────┘                                            │
│           │                                                    │
│           ▼                                                    │
│    ┌──────────────┐                                            │
│    │  TECHNICAL   │                                            │
│    │  SEO/GEO     │                                            │
│    │  FOUNDATION  │                                            │
│    └──────┬───────┘                                            │
│           │                                                    │
│           ▼                                                    │
│    ┌──────────────┐     ┌──────────────┐                      │
│    │   GOOGLE     │     │   AI SEARCH  │                      │
│    │   SEARCH     │     │  (ChatGPT,   │                      │
│    │   (Rankings) │     │  Perplexity, │                      │
│    └──────┬───────┘     │  Gemini)     │                      │
│           │             └──────┬───────┘                      │
│           │                    │                              │
│           ▼                    ▼                              │
│    ┌──────────────────────────────────────┐                  │
│    │         ORGANIC DISCOVERY            │                  │
│    │  (Search clicks + AI citations)      │                  │
│    └──────────────┬───────────────────────┘                  │
│                   │                                          │
│                   ▼                                          │
│    ┌──────────────────────────────────────┐                  │
│    │         PRODUCT ACTIVATION           │                  │
│    │  (Translator, Chat, Guides, Kids)    │                  │
│    └──────────────┬───────────────────────┘                  │
│                   │                                          │
│                   ▼                                          │
│    ┌──────────────────────────────────────┐                  │
│    │         USER VALUE & SIGNALS         │                  │
│    │  (Learning, Progress, Sharing)       │                  │
│    └──────────────┬───────────────────────┘                  │
│                   │                                          │
│                   ▼                                          │
│    ┌──────────────────────────────────────┐                  │
│    │         AUTHORITY BUILDING           │                  │
│    │  (Backlinks, Brand mentions,         │                  │
│    │   AI training data, Citations)       │                  │
│    └──────────────┬───────────────────────┘                  │
│                   │                                          │
│                   └──────────────┬──────────────────────────┘
│                                  │
│                                  ▼
│                         ┌──────────────┐
│                         │   CONTENT    │
│                         │  PRODUCTION  │
│                         │  (Enhanced   │
│                         │   by signals)│
│                         └──────────────┘
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

---

## PHASE 1: TECHNICAL FOUNDATION (Completed ✅)

### SEO Technical Checklist — STATUS: COMPLETE

| Component | Implementation | Score |
|-----------|----------------|-------|
| **Canonical URLs** | `langzio_canonical_url()` function, self-referencing on all pages | ✅ 100% |
| **Robots.txt** | Disallows private routes, explicitly allows AI crawlers (OAI-SearchBot, GPTBot, ClaudeBot, PerplexityBot, Google-Extended) | ✅ 100% |
| **XML Sitemap** | Dynamic `sitemap.php` with 25+ URLs, hreflang, changefreq, priority, lastmod | ✅ 100% |
| **Structured Data (JSON-LD)** | Organization, WebSite, SoftwareApplication, WebPage, Course, Guide, ItemList, DefinedTerm, BreadcrumbList on all pages | ✅ 100% |
| **Open Graph + Twitter Cards** | Dynamic per-page via `head.php` | ✅ 100% |
| **Meta Tags** | Unique title, description, keywords per page; viewport fixed (removed `user-scalable=no`) | ✅ 100% |
| **Semantic HTML5** | `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`, `<aside>`, `<header>`, ARIA labels | ✅ 95% |
| **Noindex on Private** | Dashboard, profile, login, register, chat, translator (auth), 404, verify-email | ✅ 100% |
| **HTTPS Enforcement** | `.htaccess` rewrite | ✅ 100% |
| **Page Speed** | Pending production measurement | ⏳ TBD |

### GEO Technical Checklist — STATUS: COMPLETE

| Component | Implementation | Status |
|-----------|----------------|--------|
| **llms.txt** | Published at `/llms.txt` with 17 authoritative resources | ✅ |
| **Crawler Policy** | `/docs/crawler-policy.md` with explicit AI allows | ✅ |
| **Entity Definitions** | 20+ entities with canonical URLs, Schema.org types, Wikidata `sameAs` | ✅ |
| **Answer-First Content** | Designed in query fan-out strategy | ✅ |
| **Provenance Signals** | Documented in entity map, llms.txt | ✅ |
| **AI Crawler Access** | robots.txt explicitly allows OAI-SearchBot, GPTBot, ClaudeBot, PerplexityBot, Google-Extended | ✅ |

---

## PHASE 2: CONTENT VELOCITY (In Progress)

### 2.1 Content Production Targets

| Quarter | Pillar Pages | Dictionary Terms | Guides | Total New Indexable |
|---------|--------------|------------------|--------|---------------------|
| **Q3 2026** | 7 | 100 | 5 | 112 |
| **Q4 2026** | 3 | 200 | 8 | 211 |
| **Q1 2027** | 2 | 150 | 7 | 159 |
| **Q2 2027** | 1 | 50 | 5 | 56 |
| **TOTAL** | **13** | **500** | **25** | **538** |

### 2.2 Priority Content Map (SEO + GEO Aligned)

| Priority | Page/Section | Target Queries | GEO Value | SEO Volume (Est) |
|----------|--------------|----------------|-----------|------------------|
| **P0** | `/what-is-darija/` | "what is Moroccan Darija", "Darija language", "Moroccan Arabic dialect" | ★★★★★ | 8,000/mo |
| **P0** | `/darija-vs-arabic/` | "Darija vs Arabic", "Darija vs MSA", "Moroccan Arabic vs Modern Standard Arabic" | ★★★★★ | 3,000/mo |
| **P0** | `/learn-darija/` | "learn Moroccan Darija", "how to learn Darija", "learn Moroccan Arabic" | ★★★★★ | 5,000/mo |
| **P0** | `/darija-pronunciation/` | "Darija pronunciation", "how to pronounce Darija", "Arabizi 3 7 9" | ★★★★★ | 2,500/mo |
| **P0** | `/arabizi-guide/` | "what is Arabizi", "Arabizi numbers", "3 7 9 meaning Arabic" | ★★★★★ (Monopoly) | 1,500/mo |
| **P0** | `/dictionary/` + 500 terms | "Darija dictionary", "[word] meaning Darija", "Moroccan Arabic translator" | ★★★★★ | 6,000/mo |
| **P0** | `/guides/restaurant/` | "Moroccan restaurant phrases", "order food Darija", "ask for bill Arabic" | ★★★★★ | 4,000/mo |
| **P0** | `/guides/souk/` | "Moroccan souk bargaining", "haggle Morocco Arabic", "market phrases Darija" | ★★★★★ | 3,500/mo |
| **P0** | `/guides/taxi/` | "Morocco taxi phrases", "petit taxi Maroc", "taxi Arabic Darija" | ★★★★★ | 3,000/mo |
| **P0** | `/guides/family/` | "Moroccan family greetings", "Darija for grandparents", "respect Arabic Morocco" | ★★★★★ | 2,000/mo |
| **P1** | `/culture/etiquette/` | "Moroccan etiquette", "Morocco cultural norms", "rude gestures Morocco" | ★★★★☆ | 4,000/mo |
| **P1** | `/culture/travel-tips/` | "Morocco travel tips", "what to wear Morocco", "tipping Morocco" | ★★★★☆ | 8,000/mo |
| **P1** | `/diaspora/kids-darija/` | "teach kids Darija", "Moroccan Arabic for children", "diaspora language learning" | ★★★★★ | 1,500/mo |
| **P2** | `/grammar/` | "Darija grammar", "Moroccan Arabic verbs", "Darija sentence structure" | ★★★☆☆ | 2,000/mo |

### 2.3 Content Quality Standards (SEO + GEO)

| Requirement | SEO Purpose | GEO Purpose |
|-------------|-------------|-------------|
| **Answer in first paragraph** | Featured snippet eligibility | AI extractability |
| **Entity definitions with schema** | Rich results, Knowledge Graph | Entity clarity for AI |
| **Canonical URL + self-reference** | Duplicate prevention | Canonical truth for AI |
| **Internal links to entities** | Topical authority, crawl depth | Knowledge graph traversal |
| **FAQ schema where appropriate** | People Also Ask | Direct answer extraction |
| **Audio/pronunciation markup** | Rich media snippets | Multimodal AI training |
| **Provenance (author, date, methodology)** | E-E-A-T | AI trust signals |
| **Original data (verified phrases)** | Unique content | Citation-worthy |

---

## PHASE 3: ORGANIC DISCOVERY → PRODUCT ACTIVATION

### 3.1 Landing Page → Product Funnels

| Entry Page | Primary CTA | Secondary CTA | Tracking |
|------------|-------------|---------------|----------|
| `/what-is-darija/` | "Start Learning Free" → `/register.php` | "Try Translator" → `/translator.php` | UTM: `source=seo_whatisdarija` |
| `/learn-darija/` | "Start 7-Day Challenge" → `/kids.php` | "View Curriculum" → `/learn-darija/#curriculum` | UTM: `source=seo_learndarija` |
| `/dictionary/` | "Translate This Word" → `/translator.php?q={term}` | "Hear Pronunciation" → `/translator.php` | UTM: `source=seo_dictionary` |
| `/guides/restaurant/` | "Practice in Translator" → `/translator.php` | "View All Guides" → `/guides.php` | UTM: `source=seo_guide_restaurant` |
| `/guides/souk/` | "Practice Bargaining" → `/chat.php?scenario=souk` | "Learn Numbers" → `/dictionary/numbers` | UTM: `source=seo_guide_souk` |
| `/darija-pronunciation/` | "Try Pronunciation Lab" → `/translator.php#pronunciation` | "Arabizi Guide" → `/arabizi-guide/` | UTM: `source=seo_pronunciation` |
| `/diaspora/kids-darija/` | "Start Free Challenge" → `/kids.php` | "Family Guide" → `/guides/family/` | UTM: `source=seo_diaspora` |

### 3.2 Activation Metrics per Channel

| Channel | Target Activation Rate | Target Trial Start | Measurement |
|---------|------------------------|-------------------|-------------|
| **Organic Search** | 3% → Signup | 15% → Trial | GA4 + UTM |
| **AI Search (Citations)** | 5% → Signup | 20% → Trial | Referrer + UTM |
| **Direct/Brand** | 8% → Signup | 30% → Trial | GA4 |
| **Referral** | 10% → Signup | 25% → Trial | Referral code |

---

## PHASE 4: USER VALUE → AUTHORITY BUILDING

### 4.1 Shareable Value Loops

| User Action | Generated Asset | Distribution | Authority Signal |
|-------------|-----------------|--------------|------------------|
| **Complete 7-Day Challenge** | "I completed the 7-Day Darija Challenge! 🇲🇦" card | WhatsApp, Instagram, Facebook | Social mention + brand |
| **Reach Level D2** | "I'm now Langzio Darija Level D2!" badge | LinkedIn (expats), Instagram | Professional mention |
| **Master 100 Words** | "100 Darija Words Mastered ✓" progress card | WhatsApp family groups | Word-of-mouth |
| **Pronunciation Score 90%+** | "My '3' sound: 94% 🎯" challenge card | TikTok, Reels, Stories | Viral + brand |
| **Cultural Badge Earned** | "Certified: Moroccan Souk Negotiator 🛍️" | LinkedIn, Facebook | Niche authority |
| **Share Phrase with Family** | Audio phrase card sent via WhatsApp | WhatsApp (private) | Dark social + retention |

### 4.2 Authority Building Targets

| Metric | Month 6 | Month 12 | Measurement |
|--------|---------|----------|-------------|
| **Referring Domains** | 50 | 200 | Ahrefs/SEMrush |
| **Brand Mentions (Unlinked)** | 20/mo | 100/mo | Mention/Brand24 |
| **AI Citations/Month** | 5 | 20+ | Manual tracking (ChatGPT, Perplexity, Gemini) |
| **Wikipedia/Wikidata Citations** | 1 | 5 | Manual |
| **Press Mentions** | 2 | 10 | Media monitoring |
| **Academic/Research Citations** | 0 | 3 | Google Scholar |
| **Wikidata Entity** | Created | Verified | Wikidata |

---

## PHASE 5: AUTHORITY → ENHANCED CONTENT PRODUCTION

### 5.1 Data-Driven Content Prioritization

| Signal Source | Content Action | Example |
|---------------|----------------|---------|
| **GSC: High impressions, low CTR** | Improve title/meta, add FAQ schema | "Darija dictionary" page |
| **GSC: High CTR, low position** | Expand content, add schema, build links | "Darija pronunciation" page |
| **AI Citation: Missing info** | Create page for cited-but-missing topic | "What does 'wesh' mean?" |
| **User Search (Internal)** | Build page for high-volume no-result queries | "Darija slang dictionary" |
| **Chat Logs: Frequent Questions** | Create guide/FAQ for repeated questions | "How to say 'delicious' in Darija" |
| **Tutor: Common Mistakes** | Create "Avoid This Mistake" micro-content | "Don't say 'ana bghit' to elders" |
| **Pronunciation: High Error Phonemes** | Build minimal pair exercises | "3 vs a minimal pairs" |
| **Referral: High-Converting Pages** | Replicate structure for related topics | Family guide → Workplace guide |

### 5.2 Content Refresh Cycle

| Frequency | Action | Criteria |
|-----------|--------|----------|
| **Weekly** | Publish 2-3 new pages (per quarterly plan) | Per quarterly content plan |
| **Monthly** | Refresh top 10 pages by traffic (update date, add FAQ, fix links) | >1000 sessions/mo |
| **Quarterly** | Audit top 50 pages: accuracy, links, schema, freshness | All pillar pages |
| **Annually** | Full content audit: deprecate, merge, redirect | All indexable pages |

---

## MEASUREMENT FRAMEWORK

### 5.3 Loop Health Dashboard (Weekly)

| Loop Stage | Metric | Target | Status |
|-----------|--------|--------|---------|
| **Content Production** | Pages published/week | 3-5 | 📊 |
| **Technical SEO** | Indexed pages (GSC) | +10%/mo | 📊 |
| **GEO** | AI citations detected | 5+/wk (Month 12) | 📊 |
| **Organic Discovery** | Organic sessions | 10K/wk (Month 12) | 📊 |
| **Product Activation** | Signups from organic | 50/wk (Month 12) | 📊 |
| **User Value** | WMDLS (Weekly Meaningful Darija Learning Sessions) | 5,000 (Month 12) | 📊 |
| **Authority** | New referring domains | 10/mo (Month 12) | 📊 |
| **Loop Closure** | Authority → Content ideas implemented | 80% | 📊 |

### 5.4 Loop Velocity Metrics

| Metric | Definition | Target |
|--------|------------|--------|
| **Content-to-Traffic Lag** | Days from publish to 100 organic sessions | <30 days |
| **Traffic-to-Signup Rate** | Organic sessions → Signup conversion | 3% |
| **Signup-to-Value Time** | Signup → First WMDLS | <24 hours |
| **Value-to-Share Rate** | WMDLS → Shareable moment | 15% |
| **Share-to-Authority Lag** | Share → Referring domain/mention | <60 days |
| **Authority-to-Content Lag** | New authority signal → New content brief | <14 days |

---

## ATTRIBUTION & INTEGRATION

### 5.5 Cross-Channel Attribution

| Touchpoint | Weight | Tracking |
|------------|--------|----------|
| **First Touch (SEO)** | 30% | GA4 First User Source |
| **AI Citation** | 20% | Referrer: chatgpt.com, perplexity.ai, etc. |
| **Direct/Brand** | 20% | GA4 Direct |
| **Referral (Share)** | 15% | Referral code + UTM |
| **Social** | 10% | GA4 Social |
| **Email/Retention** | 5% | GA4 Email |

### 5.6 Integration with Product Analytics

| Product Event | SEO/GEO Signal | Action |
|---------------|----------------|--------|
| **First Translation** | "Translator used" | Strengthen Translator landing pages |
| **First Chat** | "AI Chat used" | Boost Chat landing pages |
| **Guide Completed** | "Guide finished" | Add "Next Guide" internal links |
| **Challenge Day 7** | "Challenge complete" | Generate shareable card + referral |
| **Level Up** | "Level D2 reached" | Update mastery schema, create shareable |
| **Pronunciation Practice** | "Pronunciation Lab used" | Prioritize Pronunciation Lab content |

---

## BUDGET ALLOCATION (SEO/GEO Specific)

| Category | Monthly (Month 6) | Monthly (Month 12) | Annual |
|----------|-------------------|---------------------|--------|
| **Content Production** | $2,000 | $5,000 | $42,000 |
| **Native Validation** | $1,500 | $3,000 | $27,000 |
| **Audio Recording** | $500 | $2,000 | $15,000 |
| **Digital PR/Outreach** | $1,000 | $3,000 | $24,000 |
| **Tools (SEO, Analytics, Monitoring)** | $500 | $1,000 | $9,000 |
| **Link Building (Outreach, Partnerships)** | $500 | $1,500 | $12,000 |
| **AI Citation Monitoring** | $200 | $500 | $4,200 |
| **TOTAL** | **$6,200** | **$16,000** | **$133,200** |

---

## RISKS & MITIGATION

| Risk | Probability | Impact | Mitigation |
|------|-------------|--------|------------|
| **Google Algorithm Update** | Medium | High | Diversified traffic (AI referral, direct, social, email) |
| **AI Citation Volatility** | High | Medium | Don't over-optimize for AI; focus on user value |
| **Content Cannibalization** | Medium | Medium | Canonical strategy, hub/spoke architecture, regular audits |
| **Content Quality Dilution** | Medium | High | Native validation gate; QC automation; revision rate monitoring |
| **Competitor Content Surge** | Low | Medium | Moat: verified corpus + cultural intelligence + pronunciation |
| **Crawl Budget Issues** | Low | Medium | Sitemap prioritization; noindex low-value; block params |

---

## SUCCESS CRITERIA (12 MONTHS)

| Loop Stage | KPI | Target |
|------------|-----|--------|
| **Content** | Indexable pages | 500+ |
| **Technical** | GSC Indexed Pages | 500+ |
| **SEO** | Organic Sessions/Month | 50,000 |
| **SEO** | Top 3 Rankings (Target Queries) | 20/20 |
| **GEO** | AI Citations/Month | 20+ |
| **Activation** | Organic → Signup Rate | 3% |
| **Activation** | Organic → Trial Start | 15% |
| **Retention** | D30 Retention (Organic Cohort) | 15% |
| **Authority** | Referring Domains | 200 |
| **Authority** | Brand Mentions/Month | 100 |
| **Loop Velocity** | Content-to-Traffic Lag | <30 days |
| **Revenue** | Organic-Attributed MRR | $25K |

---

## GOVERNANCE

### Weekly (Monday)
- Review loop dashboard
- Identify bottlenecks
- Assign content priorities

### Monthly (First Monday)
- Deep-dive: Channel performance
- Content audit: Top 20 pages
- GEO audit: Citation tracking
- Authority audit: Mentions, links

### Quarterly
- Full loop retrospective
- Strategy adjustment
- Resource reallocation
- Competitive landscape update

---

*The SEO/GEO Growth Loop is the engine that turns Langzio's proprietary knowledge into sustainable organic growth. Every component must be measured, optimized, and closed.*
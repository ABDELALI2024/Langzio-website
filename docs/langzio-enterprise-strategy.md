# Langzio Enterprise Strategy

**Version:** 1.0
**Date:** 2026-08-22
**Classification:** Internal Strategy
**Status:** Approved for Planning Phase

---

## 1. VISION & MISSION

### Vision
> **To become the world's definitive AI-powered platform for Moroccan Darija and Cultural Intelligence — the trusted source for understanding Morocco through language.**

### Mission
> **Empower travelers, diaspora families, and language learners to communicate naturally in Moroccan Darija by combining verified linguistic data, cultural context, and adaptive AI tutoring.**

### Strategic Positioning Statement
> **For English/French speakers engaging with Morocco, Langzio is the AI cultural language platform that provides verified Darija translations with cultural context — unlike generic translators or MSA courses — because we combine native-validated phrases, cultural intelligence, and adaptive AI conversation.**

---

## 2. STRATEGIC PILLARS (The Five Defensible Layers)

### Pillar 1: Darija Knowledge Graph
**Objective:** Build the world's most comprehensive structured Darija knowledge base.

**Components:**
- Verified phrase corpus (500+ phrases → 5,000+ terms)
- Semantic relationships: Word → Phrase → Conversation → Cultural Context
- Multi-script: Arabic, Latin (Langzio standard), Arabizi
- Pronunciation mappings with audio references
- Cultural annotations: register, context, avoidance, alternatives
- Public API for developers and researchers

**Success Metric:** 10,000+ structured entities; 50+ external citations; API adoption

---

### Pillar 2: Cultural Intelligence Engine
**Objective:** Make cultural context a first-class feature, not an afterthought.

**Components:**
- Cultural concept taxonomy: Hospitality, Bargaining, Greeting Rituals, Politeness Register, Gender Norms, Religious Sensitivity
- Naturalness scoring: Grammar vs. Naturalness vs. Appropriateness
- Context-aware alternatives: "Don't say X, say Y because..."
- Scenario-based cultural guidance: taxi, souk, restaurant, family, workplace
- Regional variation awareness (urban/rural, north/south)
- Diaspora-specific guidance: heritage learner gaps, register switching

**Success Metric:** 90%+ user satisfaction on cultural accuracy; cited by travel guides

---

### Pillar 3: AI Personal Tutor
**Objective:** Create the most effective AI conversation partner for Darija learners.

**Components:**
- Learner model: vocabulary knowledge, grammar gaps, mistake patterns, interests, goals
- Adaptive conversation: beginner → scaffolded, intermediate → natural, advanced → nuanced
- Roleplay engine: 20+ scenarios with persistent AI personas
- Feedback loop: post-conversation summary with 3 improvement points
- Memory: cross-session vocabulary tracking, mistake recurrence detection
- Safety: cultural appropriateness guardrails, PII protection

**Success Metric:** 15+ min avg session; 3+ conversations/week per active learner; measurable proficiency gains

---

### Pillar 4: Speech & Pronunciation Intelligence
**Objective:** Close the speaking gap with actionable pronunciation feedback.

**Components:**
- Phoneme-level analysis: 3 (ع), 7 (ح), 9 (ق/غ), 5 (خ), 2 (ء), 6 (ط), q (ق), gh (غ), kh (خ)
- Arabizi-to-IPA mapping with visual feedback
- Rhythm & intonation patterns: French influence, question contours
- Word stress rules: Darija vs. MSA differences
- Fluency metrics: speed, pauses, hesitation markers
- Practice modes: shadowing, minimal pairs, phrase drilling

**Success Metric:** 40%+ Pro users engage weekly; measurable accent improvement (pre/post)

---

### Pillar 5: Search + AI Discovery Authority
**Objective:** Make Langzio the canonical source for Darija queries in Google and AI systems.

**Components:**
- Technical SEO excellence (completed: 92/100)
- Public knowledge layer: 100+ crawlable, schema-rich pages
- GEO optimization: answer-first structure, entity clarity, provenance signals
- AI crawler accessibility: OAI-SearchBot, GPTBot, ClaudeBot, PerplexityBot, Google-Extended
- Digital PR: original research, datasets, interactive tools
- Citation tracking: automated monitoring across ChatGPT, Perplexity, Gemini

**Success Metric:** Top 3 for 20 target queries; 20+ AI citations/month; 50K organic sessions/month

---

## 3. TARGET SEGMENTS & PRIORITIZATION

### Tier 1: Primary (Product-Market Fit Focus)

| Segment | Size Estimate | Pain Point | Langzio Solution | Willingness to Pay |
|---------|---------------|------------|------------------|-------------------|
| **Moroccan Diaspora Families (MRE)** | 5-7M globally (Europe, NA) | Kids losing Darija; grandparents communication gap | 7-Day Kids Challenge + Family Guides + WhatsApp sharing | **High** — emotional investment |
| **Morocco Tourists (Annual)** | 13M+ pre-COVID | Survival phrases; cultural mistakes; taxi/restaurant anxiety | Situational Guides + Translator + Cultural Chat | **Medium-High** — trip-dependent |
| **Digital Nomads / Expats in Morocco** | 50K-100K+ | Daily life integration; workplace Darija; long-term learning | AI Tutor + Adaptive Learning + Cultural Intelligence | **High** — ongoing need |

### Tier 2: Secondary (Growth Expansion)

| Segment | Size Estimate | Pain Point | Langzio Solution |
|---------|---------------|------------|------------------|
| **Heritage Learners** | 1-2M globally | Fossilized errors; literacy; formal register | Grammar modules + Advanced Chat |
| **Language Enthusiasts / Polyglots** | Niche | Dialect collection; linguistic interest | Arabizi guide + Linguistic depth |
| **Researchers / Academics** | Niche | Reliable dialect data; corpus access | API + Knowledge Graph |
| **Business / NGOs in Morocco** | Growing | Workplace communication; cultural competence | B2B packages (future) |

### Tier 3: Adjacent (Future)

- Other Maghrebi dialects (Algerian, Tunisian) — leverage architecture
- Arabic dialect family platform — "Speak the Region"
- Educational partnerships — universities, language schools

---

## 4. PRODUCT STRATEGY

### Core Product (Current → Enhanced)

| Module | Current State | Target State (12mo) | Investment |
|--------|---------------|---------------------|------------|
| **Translator** | RAG chat, structured output | Multi-modal (text+voice), context memory, offline PWA | Medium |
| **AI Chat** | Conversation memory, cultural grounding | Learner model, roleplay scenarios, feedback summaries | High |
| **Smart Guides** | 4 static guides (auth-gated) | 20+ public guides, interactive, audio, schema | Medium |
| **Kids Challenge** | 7-day flashcards + streaks | Full curriculum (D0-D2), progress dashboard, family sharing | Medium |
| **Dictionary** | Internal only (corpus.json) | 5,000+ terms, DefinedTerm schema, audio, variants | High |

### New Product Modules (Phased)

| Module | Phase | Description | Dependencies |
|--------|-------|-------------|--------------|
| **Pronunciation Lab** | 2 | Phoneme feedback, shadowing, minimal pairs | Web Audio API, audio corpus |
| **Mastery Dashboard** | 2 | D0-D5 levels, concept mastery, weak area targeting | Learner model, assessment |
| **Spaced Repetition** | 3 | SRS integrated with mastery, cross-feature | Mastery model, content tags |
| **Roleplay Scenarios** | 2 | 20+ cultural scenarios, AI personas, feedback | AI Tutor enhancement |
| **Content API** | 3 | Public developer API for dictionary/phrases | Knowledge Graph |
| **B2B Dashboard** | 4 | Team management, progress tracking, custom content | Core product maturity |

---

## 5. CONTENT STRATEGY

### Content Flywheel

```
RESEARCH (Native speakers + Linguistic refs)
    ↓
AI-ASSISTED DRAFTING (LLM + templates)
    ↓
EXPERT VALIDATION (Linguist + Cultural consultant)
    ↓
QUALITY CONTROL (Automated checks + Human review)
    ↓
PUBLICATION (Schema-rich pages + API)
    ↓
MEASUREMENT (Search + GEO + User signals)
    ↓
IMPROVEMENT (Data-driven updates)
    ↓
(Back to RESEARCH)
```

### Content Priorities (12-Month)

| Quarter | Focus | Target Output |
|---------|-------|---------------|
| **Q1** | Pillar Pages | 7 pillar pages: what-is-darija, darija-vs-arabic, learn-darija, pronunciation, arabizi, culture, diaspora |
| **Q2** | Dictionary | 500 terms with full DefinedTerm schema, audio for top 100 |
| **Q3** | Guides | 20 situational guides (restaurant, souk, taxi, family, travel, hotel, pharmacy, emergency, etc.) |
| **Q4** | Advanced | Grammar reference, slang dictionary (validated), regional variations, heritage learner modules |

### Quality Standards

- **Every phrase:** Native speaker validated + linguistic reference
- **Every term:** Arabic script + Langzio Latin + Arabizi + IPA + audio (top 500)
- **Every guide:** Register guidance + cultural context + avoidance notes + alternatives
- **Every page:** JSON-LD schema + answer-first structure + internal links

---

## 6. AI STRATEGY

### Current Architecture Assessment

| Component | Status | Gap to Target |
|-----------|--------|---------------|
| **RAG Retrieval** | Production (corpus.json) | Scale to 5,000+ entries; hybrid search |
| **Generation** | Llama 3.3 70B (Groq) | Fine-tuned Darija model (future) |
| **Structured Output** | JSON schema enforced | Extend to all features |
| **Conversation Memory** | Session-only | Cross-session learner model |
| **Cultural Grounding** | System prompt + corpus | Explicit cultural concept injection |
| **Evaluation** | Manual only | Automated regression suite |

### AI Roadmap

| Phase | Focus | Key Deliverable |
|-------|-------|-----------------|
| **1 (0-3mo)** | Reliability | Automated eval suite; hallucination <2%; cultural accuracy >95% |
| **2 (3-6mo)** | Personalization | Learner model v1; adaptive conversation; mistake tracking |
| **3 (6-9mo)** | Specialization | Fine-tuned Darija LoRA (if data sufficient); pronunciation feedback |
| **4 (9-12mo)** | Multimodal | Voice input/output; lip-sync avatar; real-time correction |

### AI Safety & Quality Guardrails

- **Cultural appropriateness filter:** Block/rewrite inappropriate suggestions
- **Hallucination detection:** Confidence scoring; "I'm not sure" responses
- **PII protection:** No personal data in training; anonymized analytics
- **Bias monitoring:** Quarterly audit of gender, regional, register bias
- **Regression testing:** 500+ eval cases run on every model change

---

## 7. GROWTH STRATEGY

### Acquisition Channels (Priority Order)

| Channel | Current | Target (12mo) | Strategy |
|---------|---------|---------------|----------|
| **Organic Search (SEO)** | Near zero | 50K sessions/mo | Pillar content + dictionary + guides + GEO |
| **AI Search (GEO)** | Zero | 20+ citations/mo | llms.txt + answer-first content + entity clarity |
| **Direct / Brand** | Low | 15K sessions/mo | Digital PR + diaspora community |
| **Social / Referral** | Near zero | 10K sessions/mo | Shareable results (level, streak, pronunciation) |
| **Partnerships** | Zero | 5K sessions/mo | University, tourism, diaspora orgs |
| **Paid (Test)** | None | Experimental | Only if CAC < LTV/3 |

### Freemium Model (Validated Against Competitors)

| Tier | Features | Price | Rationale |
|------|----------|-------|-----------|
| **Free** | Dictionary (search), Basic Translator (5/day), 1 Guide, Kids Day 1 | $0 | Top-of-funnel; SEO/GEO landing pages; habit formation |
| **Pro** | Unlimited Translator, AI Chat, All Guides, Full Kids, Progress Dashboard | $9-12/mo | Core value; matches Speak/Praktika pricing |
| **Pro+** | Pronunciation Lab, Mastery Dashboard, Advanced Analytics, Offline Sync, Priority Support | $15-20/mo | Power users; differentiation from competitors |

**Migration Path:** Free → 7-day Pro trial → Pro → Pro+ upsell at mastery milestones

---

## 8. MONETIZATION & UNIT ECONOMICS

### Target Unit Economics (12-Month)

| Metric | Target | Benchmark |
|--------|--------|-----------|
| **CAC (Blended)** | <$15 | Duolingo ~$20; Speak ~$30 |
| **LTV (Pro)** | >$150 | 18-month avg retention |
| **LTV (Pro+)** | >$300 | 24-month avg retention |
| **LTV/CAC** | >10x | Healthy >3x |
| **Payback Period** | <3 months | Industry standard |
| **Gross Margin** | >85% | SaaS standard |
| **Conversion (Free→Pro)** | 8-12% | Duolingo 3-5%; Speak ~10% |
| **Churn (Monthly)** | <4% | Duolingo ~5%; B2B <2% |

### Revenue Projections (Conservative)

| Month | MAU | Paid Users | MRR | ARR |
|-------|-----|------------|-----|-----|
| 3 | 5,000 | 400 | $3,600 | $43K |
| 6 | 15,000 | 1,500 | $15,000 | $180K |
| 9 | 35,000 | 3,500 | $38,000 | $456K |
| 12 | 75,000 | 7,500 | $85,000 | $1.02M |

*Assumes 10% conversion, 90% Pro / 10% Pro+ mix, $11 avg MRR*

---

## 9. TECHNOLOGY STRATEGY

### Architecture Principles

1. **Preserve existing PHP/MySQL core** — no rewrite
2. **Add services via API** — pronunciation, AI eval, SRS as microservices
3. **Edge-first** — Cloudflare Workers for SEO/GEO, static generation
4. **Data ownership** — all learner data in MySQL; no vendor lock-in
5. **Observability** — structured logging, error tracking, AI eval metrics

### Technical Debt to Address

| Area | Issue | Priority |
|------|-------|----------|
| **Auth** | Session-only, no JWT/refresh | Medium |
| **Database** | No migrations, schema in SQL files | Medium |
| **Testing** | No automated test suite | High |
| **CI/CD** | Manual deploy | High |
| **Monitoring** | Basic error_log only | High |
| **Rate Limiting** | File-based, not distributed | Medium |

### Infrastructure Targets

- **Uptime:** 99.9%
- **p95 Latency (API):** <500ms
- **p95 Latency (AI):** <3s (Groq)
- **Core Web Vitals:** LCP <2.5s, INP <200ms, CLS <0.1

---

## 9. TEAM & ORGANIZATION

### Current → Target (12 Months)

| Role | Current | Target | Notes |
|------|---------|--------|-------|
| **Founder/CEO** | 1 (full-stack) | 1 | Product + Strategy |
| **AI/ML Engineer** | 0 | 1 | RAG, fine-tuning, eval |
| **Backend Engineer** | 0 | 1 | API, services, infra |
| **Frontend Engineer** | 0 | 1 | PWA, pronunciation, dashboard |
| **Content/Linguist** | 0 | 1 (PT→FT) | Corpus validation, cultural accuracy |
| **Growth/SEO** | 0 | 1 | Content velocity, GEO, experiments |
| **Designer** | 0 | 0.5 (contract) | Pronunciation UI, dashboard |
| **Community/Support** | 0 | 0.5 (PT) | Diaspora engagement, feedback |

### Hiring Priority
1. AI/ML Engineer (core differentiator)
2. Content Linguist (quality moat)
3. Backend Engineer (scale + services)
4. Growth/SEO (flywheel velocity)

---

## 10. RISK ASSESSMENT & MITIGATION

| Risk | Likelihood | Impact | Mitigation |
|------|------------|--------|------------|
| **AI hallucination on cultural topics** | Medium | High | RAG grounding + eval suite + cultural filter |
| **Duolingo launches Darija** | Medium | High | Brand authority + cultural depth + diaspora lock-in |
| **Key team member departure** | Medium | High | Documentation; bus factor >1 on critical paths |
| **Groq API cost increase / outage** | Low | High | Multi-provider abstraction; local fallback |
| **SEO algorithm update** | Medium | Medium | Diversified traffic; brand + direct + AI referrals |
| **Data privacy regulation (GDPR/ePrivacy)** | Low | High | Privacy by design; minimal PII; EU hosting option |
| **Cultural inaccuracy backlash** | Low | Very High | Native validation pipeline; community correction |
| **Technical debt blocks velocity** | High | Medium | Dedicated refactoring sprints; testing investment |

---

## 11. SUCCESS DEFINITION (12 MONTHS)

### North Star Metric
**Weekly Meaningful Darija Learning Sessions (WMDLS)**
> A session where a user completes ≥1 of: translation with cultural context, AI conversation ≥5 turns, guide study ≥3 phrases, pronunciation practice ≥5 words, spaced repetition review.

### Key Results (OKRs)

| Objective | Key Result | Target |
|-----------|------------|--------|
| **Own Darija AI Search** | Top 3 for 20 target queries | 100% |
| | AI citations/month | 20+ |
| | Organic sessions/month | 50K |
| **Best Darija Learning Product** | WMDLS/week | 5,000 |
| | D30 Retention | 15% |
| | Pro Conversion | 10% |
| **Cultural Authority** | Expert validation score | 95%+ |
| | Travel guide citations | 10+ |
| | Diaspora org partnerships | 5+ |
| **Sustainable Business** | MRR | $85K |
| | LTV/CAC | >10x |
| | Net Revenue Retention | >100% |

---

## 12. DECISION FRAMEWORK

### For Every Major Initiative, Require:

1. **Strategic Alignment** — Which pillar(s) does this strengthen?
2. **User Value** — Measurable learning outcome or cultural insight?
3. **Competitive Differentiation** — Does this widen our moat?
4. **Technical Feasibility** — Buildable in 4-8 weeks without rewrite?
5. **Measurement Plan** — Leading + lagging indicators defined?
6. **Rollback Plan** — Can we disable in <1 hour if broken?

### Say NO to:
- Features that don't map to the 5 pillars
- Generic gamification without learning value
- Broad language expansion before Darija dominance
- AI features without evaluation infrastructure
- Content without native validation
- Partnerships without clear mutual value

---

## 13. APPENDIX: STRATEGIC NARRATIVE

### The Story We Tell Ourselves
> "Every major language platform treats Arabic as one thing. But Moroccans don't speak MSA — they speak Darija. And Darija isn't just vocabulary — it's a cultural operating system. Hospitality has a grammar. Bargaining has a syntax. Family has a register. We're not building a translator. We're building the cultural intelligence layer for Morocco. That's a category. And we're the first to define it."

### The Story We Tell Users
> "Langzio helps you understand Morocco — not just translate words. Whether you're navigating a souk in Marrakech, video-calling your grandmother in Casablanca, or teaching your kids the language you grew up hearing — we give you the phrases, the pronunciation, the cultural context, and the AI practice to actually use it."

### The Story Investors/Partners Hear
> "Duolingo owns the habit. Speak owns the conversation. But nobody owns the dialect. Morocco has 37M people + 5M diaspora + 13M tourists/year. Darija is the gateway. We have the only verified corpus, the only cultural intelligence engine, and the only AI tutor built for this dialect. This is a category creator — not a feature competitor."

---

*Strategy approved for execution planning. Next: detailed roadmap and moat documentation.*
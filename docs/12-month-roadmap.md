# Langzio 12-Month Roadmap

**Version:** 1.0
**Date:** 2026-08-22
**Classification:** Internal Execution Plan
**Status:** Approved for Execution

---

## ROADMAP PHILOSOPHY

> **Sequenced, measurable, moat-building.**

Each phase has:
- **Clear deliverables** (shippable value)
- **Measurable outcomes** (metrics)
- **Moat contribution** (which layer strengthened)
- **Dependencies** (what must exist first)
- **Risk mitigation** (what could block)

---

## PHASE OVERVIEW

| Phase | Timeline | Theme | Focus |
|-------|----------|-------|-------|
| **0** | **Weeks 1-2** | **Foundation Lock** | Technical SEO/GEO complete, eval pipeline live |
| **1** | **Month 1-2** | **Content Velocity** | 7 pillar pages, 100 dictionary terms, 5 public guides |
| **2** | **Month 3-4** | **Knowledge Graph v1** | 500 phrases, 2000 lexemes, GraphQL API, RAG integration |
| **3** | **Month 5-6** | **AI Tutor v1** | Learner model, adaptive conversation, roleplay engine |
| **4** | **Month 7-8** | **Pronunciation Lab** | Phoneme feedback, minimal pairs, audio corpus |
| **5** | **Month 9-10** | **Mastery & SRS** | D0-D5 levels, spaced repetition, mastery dashboard |
| **6** | **Month 11-12** | **Authority & Scale** | 5000 phrases, public API beta, digital PR, LDB benchmark |

---

## PHASE 0: FOUNDATION LOCK (Weeks 1-2)

**Goal:** All technical prerequisites complete; zero blockers for content/AI velocity.

### Deliverables

| Item | Owner | Done Criteria |
|------|-------|---------------|
| ✅ Technical SEO/GEO | Complete | All checklist items green (see seo-geo-growth-loop.md) |
| ✅ AI Evaluation Pipeline | CTO + AI Eng | CI/CD integrated; regression gate active; human eval calibrated |
| ✅ Content Pipeline Docs | Content Lead | Research → Publish documented; validator network identified (4 native) |
| ✅ Analytics/Tracking | Growth | GA4 + custom events; UTM strategy; funnel dashboards live |
| ✅ Validator Network | Content Lead | 4 native speakers contracted (Casablanca, Rabat, Marrakech, Fes) |
| ✅ Phase 1 Sprint Plan | PM | 2-week sprints defined; content briefs ready for 7 pillar pages |

### Metrics
- **Blockers:** 0
- **Eval Pipeline Uptime:** 100%
- **Content Briefs Ready:** 7/7

---

## PHASE 1: CONTENT VELOCITY (Month 1-2)

**Goal:** 7 pillar pages + 100 dictionary terms + 5 public guides live and indexed.

### Sprint 1 (Weeks 1-2): Pillar Pages Batch 1
| Page | Owner | Word Count | Schema | Target Queries |
|------|-------|------------|--------|----------------|
| `/what-is-darija/` | Content Lead | 2,500 | Language, DefinedTerm | "what is Moroccan Darija" (8K) |
| `/darija-vs-arabic/` | Content Lead | 2,000 | ComparisonTable, FAQ | "Darija vs Arabic" (3K) |
| `/learn-darija/` | Content Lead | 3,000 | Course, ItemList | "learn Moroccan Darija" (5K) |
| `/darija-beginners/` | Content Lead | 1,500 | HowTo, Course | "Darija for beginners" (2K) |

### Sprint 2 (Weeks 3-4): Pillar Pages Batch 2 + Dictionary Launch
| Page | Owner | Word Count | Schema | Target Queries |
|------|-------|------------|--------|----------------|
| `/darija-pronunciation/` | Content + Linguist | 2,500 | DefinedTerm (phonemes), HowTo | "Darija pronunciation" (2.5K) |
| `/arabizi-guide/` | Content + Linguist | 2,000 | DefinedTerm, Table | "what is Arabizi" (1.5K) |
| `/dictionary/` (index + 100 terms) | Content + Linguist | 500 + terms | ItemList, DefinedTerm | "Darija dictionary" (6K) |
| `/diaspora/kids-darija/` | Content + Community | 2,000 | Course, FAQ | "teach kids Darija" (1.5K) |

### Sprint 3 (Weeks 5-6): Public Guides (5 Guides)
| Guide | Owner | Phrases | Schema | Target Queries |
|-------|-------|---------|--------|----------------|
| `/guides/restaurant/` | Content + Native | 4 + 5 new | Guide, ItemList | "Moroccan restaurant phrases" (4K) |
| `/guides/souk/` | Content + Native | 4 + 6 new | Guide, ItemList | "Moroccan souk bargaining" (3.5K) |
| `/guides/taxi/` | Content + Native | 4 + 6 new | Guide, ItemList | "Morocco taxi phrases" (3K) |
| `/guides/family/` | Content + Native | 4 + 6 new | Guide, ItemList | "Moroccan family greetings" (2K) |
| `/guides/travel/` | Content + Native | 3 + 7 new | Guide, ItemList | "Morocco travel phrases" (2.5K) |

### Sprint 4 (Weeks 7-8): Culture Pages + QA
| Page | Owner | Word Count | Schema | Target Queries |
|------|-------|------------|--------|----------------|
| `/culture/etiquette/` | Content + Cultural | 3,000 | DefinedTerm, FAQ | "Moroccan etiquette" (4K) |
| `/culture/travel-tips/` | Content + Cultural | 2,000 | Guide, FAQ | "Morocco travel tips" (8K) |
| **QA & Indexing** | SEO Lead | — | — | Submit sitemap, monitor GSC |

### Phase 1 Metrics (End of Month 2)
| Metric | Target |
|--------|--------|
| **Indexable Pages Published** | 19 (7 pillars + 1 dict index + 100 terms + 5 guides + 2 culture) |
| **Dictionary Terms Live** | 100 (with DefinedTerm schema, audio for top 20) |
| **GSC Indexed Pages** | 50+ |
| **Organic Sessions** | 1,000/mo |
| **Content Pipeline Velocity** | 5 pages/week sustained |
| **Validation Latency** | <5 days end-to-end |

---

## PHASE 2: KNOWLEDGE GRAPH v1 (Month 3-4)

**Goal:** Structured graph with 500 phrases, 2000 lexemes, GraphQL API, RAG integration.

### Month 3: Graph Infrastructure + Content Scale

| Week | Deliverable | Owner | Dependencies |
|------|-------------|-------|--------------|
| 9-10 | PostgreSQL + pgvector schema live; GraphQL API v1 (CRUD + search) | Backend | Phase 0 infra |
| 9-10 | Embedding pipeline (pgvector + sentence-transformers) | AI Eng | GraphQL API |
| 11-12 | 200 new phrases (total 228); 500 lexemes; CulturalConcept graph complete (8 concepts) | Content + Linguist | Validator network |
| 11-12 | RAG retrieval integrated: semantic search + graph traversal | AI Eng | Embeddings + Graph |
| 11-12 | Content pipeline: Research → Publish <5 days | Content Lead | Validator network |

### Month 4: Graph Maturity + RAG Optimization

| Week | Deliverable | Owner | Dependencies |
|------|-------------|-------|--------------|
| 13-14 | 200 more phrases (total 428); 1000 more lexemes (total 1500) | Content | — |
| 13-14 | GraphQL API v2: traversal, learner-model endpoints, practice queue | Backend | GraphQL v1 |
| 15-16 | RAG v2: hybrid retrieval (semantic + graph) + cross-encoder reranking | AI Eng | Embeddings + Graph |
| 15-16 | Content pipeline: 50 phrases/week sustained | Content Lead | Validator network |
| 15-16 | Audio recording: top 100 lexemes recorded (native speakers) | Content + Native | Studio setup |

### Phase 2 Metrics (End of Month 4)
| Metric | Target |
|--------|--------|
| **Phrases in Graph** | 500+ |
| **Lexemes in Graph** | 2,000+ |
| **Cultural Concepts** | 8 (fully manifested) |
| **GraphQL API** | v2 live, <200ms p95 |
| **RAG Quality** | >90% translation accuracy (eval) |
| **Content Velocity** | 50 phrases/week |
| **Audio Coverage** | 100% top 100 lexemes |

---

## PHASE 3: AI TUTOR v1 (Month 5-6)

**Goal:** Learner model, adaptive conversation, roleplay engine live for Pro users.

### Month 5: Learner Model + Adaptive Conversation

| Week | Deliverable | Owner | Dependencies |
|------|-------------|-------|--------------|
| 17-18 | LearnerModel schema + API (vocabulary, grammar, phrase mastery maps) | Backend | GraphQL API v2 |
| 17-18 | Mastery scoring algorithm (0-5) with confidence intervals | AI Eng | LearnerModel |
| 19-20 | Adaptive conversation: level detection → scaffolding (beginner/intermediate/advanced) | AI Eng | LearnerModel + RAG |
| 19-20 | Conversation memory: cross-session context (last 10 sessions) | AI Eng | LearnerModel |

### Month 6: Roleplay Engine + Tutor Feedback

| Week | Deliverable | Owner | Dependencies |
|------|-------------|-------|--------------|
| 21-22 | Roleplay Engine: 10 scenarios (Taxi, Restaurant, Souk, Family, Hotel, Pharmacy, Directions, Market, Cafe, Airport) | AI Eng | Adaptive conversation |
| 21-22 | AI Personas per scenario (Waiter, Taxi Driver, Grandmother, Shopkeeper, etc.) | AI Eng + Cultural | Roleplay Engine |
| 23-24 | Post-conversation feedback: 3 improvement points + mastery updates | AI Eng | LearnerModel + Roleplay |
| 23-24 | Tutor UI: Scenario selector, feedback display, progress tracking | Frontend | Roleplay Engine API |

### Phase 3 Metrics (End of Month 6)
| Metric | Target |
|--------|--------|
| **LearnerModel Coverage** | 100% Pro users |
| **Adaptive Conversation** | 3 levels working |
| **Roleplay Scenarios** | 10 live |
| **Avg Conversation Length** | 8+ turns |
| **Feedback Quality (Human Eval)** | >4.0/5.0 |
| **Tutor Engagement** | 3+ conversations/week/active user |
| **Mastery Correlation** | Measurable proficiency gain (pre/post) |

---

## PHASE 4: PRONUNCIATION LAB (Month 7-8)

**Goal:** Phoneme-level feedback, minimal pairs, shadowing — Pro+ differentiator.

### Month 7: Audio Infrastructure + Phoneme Detection

| Week | Deliverable | Owner | Dependencies |
|------|-------------|-------|--------------|
| 25-26 | Web Audio API integration: record, playback, waveform viz | Frontend | — |
| 25-26 | Montreal Forced Aligner (MFA) pipeline for phoneme alignment | AI Eng | Audio corpus (100h target) |
| 27-28 | Phoneme classifier: 3,7,9,5,2,6,8,gh,kh,q accuracy >85% | AI Eng | MFA + labeled data |
| 27-28 | Minimal pair generator: graph-based (Phoneme → minimal pairs) | AI Eng | Knowledge Graph |

### Month 8: Pronunciation Lab UI + Practice Modes

| Week | Deliverable | Owner | Dependencies |
|------|-------------|-------|--------------|
| 29-30 | Pronunciation Lab UI: Phoneme dashboard, minimal pairs, shadowing | Frontend | Phoneme classifier |
| 29-30 | Practice modes: Shadowing, Minimal Pairs, Phrase Drilling, Free Speech | Frontend + AI | Lab UI |
| 31-32 | Fluency metrics: speed, pauses, hesitation, word stress | AI Eng | Audio analysis |
| 31-32 | Pro+ gating + Pro+ upgrade flow in dashboard | Backend + Frontend | Lab UI |
| 31-32 | Audio corpus expansion: 200h native recordings (4 speakers × regions) | Content + Native | Studio + budget |

### Phase 4 Metrics (End of Month 8)
| Metric | Target |
|--------|--------|
| **Phoneme Accuracy** | >85% on 8 target phonemes |
| **Minimal Pairs** | 200+ pairs generated |
| **Pro+ Engagement** | 40%+ of Pro users try Lab |
| **User-Reported Improvement** | 70%+ report accent improvement |
| **False Positive Rate** | <10% |
| **Audio Corpus** | 200h recorded (4 speakers × 4 regions) |

---

## PHASE 5: MASTERY & SRS (Month 9-10)

**Goal:** D0-D5 proficiency standard, spaced repetition, mastery dashboard.

### Month 9: Proficiency Standard + Mastery Dashboard

| Week | Deliverable | Owner | Dependencies |
|------|-------------|-------|--------------|
| 33-34 | D0-D5 Framework: Defined competencies per level (vocab, grammar, listening, speaking, cultural) | Content + AI | LearnerModel |
| 33-34 | Mastery Dashboard: Visual progress, weak areas, next milestones | Frontend | LearnerModel |
| 35-36 | Level Assessment: Placement test (15 min) → D0-D5 placement | AI Eng | D0-D5 Framework |
| 35-36 | Level Progression: Mastery thresholds → auto-advance + celebration | Backend | Mastery scoring |

### Month 10: Spaced Repetition + Cross-Feature Integration

| Week | Deliverable | Owner | Dependencies |
|------|-------------|-------|--------------|
| 37-38 | SRS Algorithm: SM-2 variant tuned for Darija (intervals, ease factors) | AI Eng | Mastery scores |
| 37-38 | Practice Queue: Unified across Translator, Chat, Guides, Kids, Pronunciation | Backend | SRS + All features |
| 39-40 | Smart Notifications: "Time to review 3 words" + "Weak area: Souk numbers" | Backend + Frontend | Practice Queue |
| 39-40 | Cross-Feature Mastery: Translator use → phrase mastery; Chat → grammar mastery | Backend | All features |

### Phase 5 Metrics (End of Month 10)
| Metric | Target |
|--------|--------|
| **D0-D5 Framework** | Published + validated by linguists |
| **Placement Test Accuracy** | >85% correlation with human assessment |
| **SRS Retention** | 80%+ recall at 30-day interval |
| **Mastery Dashboard Usage** | 60%+ Pro users weekly |
| **Cross-Feature Mastery** | 5+ concepts tracked per active user |
| **Weak Area Detection** | 90%+ precision on top 3 weaknesses |

---

## PHASE 6: AUTHORITY & SCALE (Month 11-12)

**Goal:** 5000 phrases, public API beta, digital PR, LDB benchmark publication.

### Month 11: Content Scale + Public API

| Week | Deliverable | Owner | Dependencies |
|------|-------------|-------|--------------|
| 41-42 | 2000 more phrases (total 2500); 5000 more lexemes (total 6500) | Content | Pipeline mature |
| 41-42 | Public API v1 (beta): Dictionary, Phrases, Cultural Concepts, Translate | Backend | GraphQL API v2 |
| 43-44 | Developer Portal: Docs, SDK (JS/Python), Examples, Free Tier | Backend + DX | Public API |
| 43-44 | API Partnerships: 3 pilot integrations (Univ, Tourism, App) | Growth | Public API |

### Month 12: Digital PR + LDB Benchmark + Annual Review

| Week | Deliverable | Owner | Dependencies |
|------|-------------|-------|--------------|
| 45-46 | "State of Darija Online 2027" Report + Interactive Tool | Content + Growth | Data from year |
| 45-46 | Digital PR Campaign: 10 target publications | Growth | Report + assets |
| 47-48 | Langzio Darija Benchmark (LDB) v1.0: Datasets + Code + Baseline Public | AI Eng | Full eval suite |
| 47-48 | Annual Strategy Review: Metrics vs Plan → Year 2 Plan | Founder + Leads | All metrics |

### Phase 6 Metrics (End of Month 12)
| Metric | Target |
|--------|--------|
| **Phrases in Graph** | 5,000+ |
| **Lexemes in Graph** | 10,000+ |
| **Public API** | Beta live, 3 pilot partners |
| **Digital PR** | 10 publications, 50 referring domains |
| **LDB Benchmark** | Published (datasets + code + baseline) |
| **Organic Sessions/Month** | 50,000 |
| **AI Citations/Month** | 20+ |
| **MAU** | 75,000 |
| **Paid Users** | 7,500 |
| **MRR** | $85,000 |

---

## RESOURCE PLAN BY PHASE

| Role | Phase 0 | Phase 1 | Phase 2 | Phase 3 | Phase 4 | Phase 5 | Phase 6 |
|------|---------|---------|---------|---------|---------|---------|---------|
| **Founder** | 50% | 40% | 30% | 30% | 30% | 30% | 30% |
| **CTO/AI Eng** | 100% | 50% | 100% | 100% | 100% | 100% | 50% |
| **Backend Eng** | 50% | 50% | 100% | 100% | 100% | 100% | 100% |
| **Frontend Eng** | 25% | 50% | 50% | 100% | 100% | 100% | 50% |
| **Content Linguist** | 0% | 100% | 100% | 50% | 25% | 100% | 100% |
| **Growth/SEO** | 50% | 100% | 100% | 50% | 50% | 50% | 100% |
| **Native Validators (4)** | — | 40h/wk | 40h/wk | 20h/wk | 10h/wk | 20h/wk | 20h/wk |
| **Designer (PT)** | 0% | 25% | 25% | 50% | 100% | 50% | 25% |
| **Community (PT)** | 0% | 0% | 0% | 25% | 25% | 50% | 50% |

---

## BUDGET SUMMARY (Excl. Salaries)

| Category | Phase 1 | Phase 2 | Phase 3 | Phase 4 | Phase 5 | Phase 6 | Total |
|----------|---------|---------|---------|---------|---------|---------|-------|
| **Content Production** | $8,000 | $10,000 | $5,000 | $5,000 | $10,000 | $10,000 | $48,000 |
| **Native Validation** | $6,000 | $8,000 | $4,000 | $2,000 | $4,000 | $4,000 | $28,000 |
| **Audio Recording** | $2,000 | $5,000 | $2,000 | $15,000 | $5,000 | $5,000 | $34,000 |
| **Digital PR/Outreach** | $2,000 | $3,000 | $3,000 | $3,000 | $3,000 | $10,000 | $24,000 |
| **Tools/Infra** | $1,000 | $2,000 | $3,000 | $3,000 | $2,000 | $2,000 | $13,000 |
| **Link Building** | $1,000 | $1,500 | $1,500 | $1,500 | $1,500 | $5,000 | $12,000 |
| **AI Eval/Compute** | $1,000 | $2,000 | $3,000 | $3,000 | $2,000 | $2,000 | $13,000 |
| **Contingency (15%)** | $3,150 | $5,025 | $3,375 | $4,725 | $4,125 | $5,700 | $26,100 |
| **TOTAL** | **$24,150** | **$36,525** | **$24,875** | **$37,225** | **$31,625** | **$43,700** | **$198,100** |

---

## MILESTONE TRACKING

| Milestone | Target Date | Status | Owner |
|-----------|-------------|--------|-------|
| ✅ Technical SEO/GEO Complete | Week 2 | ✅ Done | SEO Lead |
| ✅ AI Eval Pipeline Live | Week 2 | ✅ Done | CTO |
| 🎯 7 Pillar Pages Live | Week 4 | 📋 Planned | Content Lead |
| 🎯 100 Dictionary Terms Live | Week 6 | 📋 Planned | Content Lead |
| 🎯 5 Public Guides Live | Week 8 | 📋 Planned | Content Lead |
| 🎯 Knowledge Graph v1 (500 phrases) | Month 4 | 📋 Planned | CTO + Content |
| 🎯 GraphQL API v2 + RAG v2 | Month 4 | 📋 Planned | Backend + AI |
| 🎯 AI Tutor v1 (Learner Model + Roleplay) | Month 6 | 📋 Planned | AI Eng |
| 🎯 Pronunciation Lab (Pro+) | Month 8 | 📋 Planned | AI + Frontend |
| 🎯 D0-D5 Framework + SRS | Month 10 | 📋 Planned | AI + Content |
| 🎯 5000 Phrases + Public API Beta | Month 12 | 📋 Planned | Content + Backend |
| 🎯 LDB Benchmark Published | Month 12 | 📋 Planned | AI Eng |
| 🎯 $85K MRR / 75K MAU | Month 12 | 📋 Planned | Founder |

---

## RISK REGISTER (Top 10)

| # | Risk | Probability | Impact | Mitigation | Owner |
|---|------|-------------|--------|------------|-------|
| 1 | Validator bottleneck (4 native speakers) | High | High | Contract 2 backup validators; batch validation; async review | Content Lead |
| 2 | Audio recording delays (studio/speaker availability) | Medium | High | Pre-book 200h studio time; remote recording kit backup | Content Lead |
| 3 | Phoneme classifier accuracy <85% | Medium | High | Rule-based fallback (Arabizi rules); more labeled data | AI Eng |
| 4 | RAG quality regression on graph scale | Medium | High | Automated eval on every deploy; shadow traffic monitoring | AI Eng |
| 5 | Content velocity drops below 30 phrases/week | Medium | Medium | Content pipeline metrics weekly; surge capacity (freelance linguists) | Content Lead |
| 6 | Google algorithm update kills traffic | Low | High | Diversified channels (AI referral, direct, social, email) | Growth Lead |
| 7 | Key team member departure | Medium | High | Documentation > code; bus factor >1; equity vesting | Founder |
| 8 | Cultural backlash (inaccuracy complaint) | Low | Critical | Native validation gate; community correction; rapid response SLA | Cultural Lead |
| 9 | Groq/API cost spike or outage | Low | High | Multi-provider abstraction; local llama.cpp fallback | CTO |
| 10 | Competitor launches Darija (Duolingo/Speak) | Medium | High | Moat acceleration: cultural intelligence + pronunciation + diaspora lock-in | Founder |

---

## GO/NO-GO GATES

| Gate | Criteria | If NO |
|------|----------|-------|
| **Phase 1 → 2** | 19 pages indexed; 100 dict terms; 5 guides live; GSC >50 pages | Extend Phase 1; hire content contractor |
| **Phase 2 → 3** | 500 phrases in graph; GraphQL API v2 <200ms; RAG eval >90% | Fix graph perf; add backend resource |
| **Phase 3 → 4** | LearnerModel 100% Pro; 10 roleplays; tutor eval >4.0 | Simplify roleplay scope; extend timeline |
| **Phase 4 → 5** | Phoneme accuracy >85%; Pro+ engagement >30% | Launch with rule-based + 5 phonemes; iterate |
| **Phase 5 → 6** | D0-D5 framework validated; SRS 80% retention; 5K MAU | Extend Phase 5; defer public API |
| **Phase 6 → Year 2** | 50K organic sessions; 20 AI citations; $85K MRR | Reset Year 2 targets; focus on retention |

---

## COMMUNICATION RHYTHM

| Cadence | Meeting | Participants | Output |
|---------|---------|--------------|--------|
| **Daily** | Standup (15min) | All eng + content | Blockers, progress |
| **Weekly (Mon)** | Sprint Review + Planning (1hr) | All | Sprint demo, next sprint plan |
| **Weekly (Fri)** | Metrics Review (30min) | Founder + Leads | Dashboard review, decisions |
| **Bi-weekly** | Content Review (1hr) | Content + Linguist + Native | Quality calibration |
| **Monthly (1st Mon)** | All-Hands + Strategy (1.5hr) | Full team | Metrics, strategy, culture |
| **Quarterly** | Offsite + Strategy Review (1 day) | Founder + Leads | Year progress, Year 2 plan |

---

## DEFINITION OF DONE (Per Feature)

A feature is **Done** when:
- [ ] Code merged to `main` with passing CI (tests, lint, AI eval gate)
- [ ] Deployed to staging + verified
- [ ] Deployed to production + smoke tested
- [ ] Analytics events firing (GA4 + custom)
- [ ] Documentation updated (API docs, user guide if applicable)
- [ ] SEO/GEO: Schema present, sitemap updated, llms.txt updated if new resource
- [ ] Accessibility: WCAG 2.1 AA (automated + manual spot check)
- [ ] Performance: LCP <2.5s, INP <200ms, CLS <0.1 (Core Web Vitals)
- [ ] Security: No new vulnerabilities (dependency scan + manual review)
- [ ] Rollback tested: Feature flag off in <5 min

---

*This roadmap is a living document. Adjust dates based on velocity; never adjust quality gates. Review monthly; replan quarterly.*
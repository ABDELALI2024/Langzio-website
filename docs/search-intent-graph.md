# Langzio Search Intent Graph

**Version:** 1.0
**Date:** 2026-08-22
**Purpose:** Map search intent to existing Langzio pages and identify content gaps

---

## 1. CORE ENTITY: MOROCCAN DARIJA

### Entity: Moroccan Darija
- **Aliases:** Moroccan Arabic, Darija, Maghrebi Arabic (Morocco), Colloquial Moroccan Arabic
- **Primary Intent:** Learn, translate, understand, communicate
- **User Journey:** Discovery → Basics → Phrases → Conversation → Cultural fluency

---

## 2. INTENT CLUSTERS

### CLUSTER A: DEFINITION & ORIENTATION

| Intent | Primary Question | Related Questions | Existing Page | Missing Page | Supporting Content | Internal Links | Conversion Destination |
|--------|------------------|-------------------|---------------|--------------|-------------------|----------------|------------------------|
| **What is Darija?** | What is Moroccan Darija? | Is Darija Arabic? Darija vs MSA? Where is Darija spoken? Is Darija a language or dialect? | None (index.php mentions briefly) | `/what-is-darija/` | Definition, history, relationship to Arabic, regions, speaker count | → Dictionary, → Guides, → Translator | Register for free trial |
| **Darija vs Arabic** | Difference between Darija and Modern Standard Arabic | MSA vs Darija grammar, vocabulary differences, mutual intelligibility | None | `/darija-vs-arabic/` | Comparison table, examples, when to use which | → What is Darija, → Dictionary | Translator trial |
| **Darija difficulty** | How hard is it to learn Darija? | Time to learn, hardest aspects, easiest aspects, comparison to other languages | None | `/learn-darija-difficulty/` | FSI estimates, learner testimonials, roadmap | → Kids challenge, → Guides | 7-day challenge signup |

### CLUSTER B: LEARNING PATH

| Intent | Primary Question | Related Questions | Existing Page | Missing Page | Supporting Content | Internal Links | Conversion Destination |
|--------|------------------|-------------------|---------------|--------------|-------------------|----------------|------------------------|
| **Learn Darija** | How to learn Moroccan Darija? | Best way to learn, self-study, apps, courses, resources | index.php (mentions kids challenge) | `/learn-darija/` | Step-by-step guide, resources, method comparison, Langzio methodology | → Kids, → Guides, → Translator, → Chat | Start free trial |
| **Darija for beginners** | Moroccan Darija for beginners | First words, basic grammar, pronunciation, survival phrases | kids.php (partial) | `/darija-beginners/` | 50 first words, pronunciation guide, basic grammar | → Dictionary, → Guides, → Kids | Kids challenge |
| **Darija vocabulary** | Most common Darija words | Core vocabulary, frequency lists, thematic lists | guides.php (auth-gated) | `/darija-vocabulary/` | Thematic lists (100, 500, 1000 words), flashcards | → Dictionary, → Translator | Translator |
| **Darija phrases** | Common Moroccan phrases | Situational phrases, polite phrases, slang, idioms | guides.php (auth-gated) | `/darija-phrases/` | Categorized phrases with audio, context | → Guides, → Translator | Guides |
| **Darija pronunciation** | How to pronounce Darija? | Sounds, stress, intonation, Arabizi numbers (3, 7, 9) | translator.php output (private) | `/darija-pronunciation/` | Phonology guide, audio examples, Arabizi key | → Translator, → Dictionary | Translator |

### CLUSTER C: TRANSLATION & TOOLS

| Intent | Primary Question | Related Questions | Existing Page | Missing Page | Supporting Content | Internal Links | Conversion Destination |
|--------|------------------|-------------------|---------------|--------------|-------------------|----------------|------------------------|
| **Translate to Darija** | Translate English to Moroccan Darija | Translate phrases, sentences, documents | translator.php (auth-gated) | `/translator/` (public demo) | Live demo, limitations, when to use human | → Chat, → Guides, → Dictionary | Signup for unlimited |
| **Darija dictionary** | Moroccan Darija dictionary | Word lookup, definitions, examples, synonyms | None | `/dictionary/` | Searchable dictionary with DefinedTerm schema | → Translator, → Phrases, → Guides | Translator |
| **Darija translator app** | Best Moroccan Darija translator app | App comparison, features, accuracy, offline | index.php (landing) | `/translator-app/` | Feature comparison, Langzio differentiators | → Translator, → Chat | Signup |

### CLUSTER D: SITUATIONAL GUIDES (High Commercial Intent)

| Intent | Primary Question | Related Questions | Existing Page | Missing Page | Supporting Content | Internal Links | Conversion Destination |
|--------|------------------|-------------------|---------------|--------------|-------------------|----------------|------------------------|
| **Restaurant Darija** | Moroccan restaurant phrases | Order food, ask for bill, dietary restrictions, compliments | guides.php (auth-gated) | `/guides/restaurant/` | 15+ phrases, cultural tips, audio | → Translator, → Dictionary | Guides access |
| **Souk/Market Darija** | Bargaining in Moroccan souks | Price negotiation, numbers, polite refusal, closing deal | guides.php (auth-gated) | `/guides/souk/` | 15+ phrases, number guide, etiquette | → Translator, → Numbers | Guides access |
| **Taxi/Transport Darija** | Taxi phrases in Morocco | Destination, fare, meter, directions, safety | guides.php (auth-gated) | `/guides/taxi/` | 15+ phrases, city-specific tips | → Translator, → Travel | Guides access |
| **Family/Social Darija** | Moroccan family greetings | Respect terms, hospitality, visits, celebrations | guides.php (auth-gated) | `/guides/family/` | 15+ phrases, cultural context | → Kids, → Dictionary | Kids challenge |
| **Travel Darija** | Moroccan travel phrases | Directions, hotels, emergencies, shopping, wifi | guides.php (partial) | `/guides/travel/` | Comprehensive travel phrase pack | → Translator, → Dictionary | Guides access |

### CLUSTER E: CULTURAL INTELLIGENCE

| Intent | Primary Question | Related Questions | Existing Page | Missing Page | Supporting Content | Internal Links | Conversion Destination |
|--------|------------------|-------------------|---------------|--------------|-------------------|----------------|------------------------|
| **Moroccan etiquette** | Moroccan cultural etiquette | Greetings, gestures, taboos, hospitality, gender norms | guides.php (cheatsheet) | `/culture/etiquette/` | Deep dive with examples, regional variations | → Guides, → Family phrases | Chat (cultural questions) |
| **Darija slang** | Moroccan Darija slang words | Common slang, youth language, regional slang, appropriateness | None | `/culture/slang/` | Curated slang with context warnings | → Dictionary, → Chat | Chat |
| **Moroccan culture for travelers** | Morocco cultural tips for tourists | Dress, religion, photography, tipping, Ramadan | None | `/culture/travel-tips/` | Practical cultural guidance | → Guides, → Translator | Chat |

### CLUSTER F: DIASPORA & FAMILY

| Intent | Primary Question | Related Questions | Existing Page | Missing Page | Supporting Content | Internal Links | Conversion Destination |
|--------|------------------|-------------------|---------------|--------------|-------------------|----------------|------------------------|
| **Teach kids Darija** | How to teach children Darija abroad | Methods, resources, consistency, motivation | kids.php (auth-gated) | `/diaspora/kids-darija/` | Methodology, 7-day challenge, flashcards, progress tracking | → Kids challenge, → Dictionary | Kids challenge signup |
| **Moroccan diaspora language** | Keeping Darija alive abroad | Family practice, community, resources, identity | index.php (testimonial) | `/diaspora/language-preservation/` | Stories, strategies, Langzio role | → Kids, → Guides | Kids challenge |
| **Darija for heritage learners** | Learn Darija as heritage speaker | Gaps, fossilized errors, literacy, register switching | None | `/diaspora/heritage-learners/` | Targeted curriculum, diagnosis | → Kids, → Chat | Chat |

### CLUSTER G: TECHNICAL & LINGUISTIC

| Intent | Primary Question | Related Questions | Existing Page | Missing Page | Supporting Content | Internal Links | Conversion Destination |
|--------|------------------|-------------------|---------------|--------------|-------------------|----------------|------------------------|
| **Darija grammar** | Moroccan Darija grammar basics | Verbs, nouns, pronouns, sentence structure, negation | None | `/grammar/` | Reference guide with examples | → Dictionary, → Translator | Chat (grammar questions) |
| **Arabizi guide** | What is Arabizi? How to read 3, 7, 9? | Number substitutions, typing, history, variations | None | `/arabizi-guide/` | Complete mapping table, practice | → Dictionary, → Translator | Translator |
| **Darija writing systems** | Arabic script vs Latin for Darija | Pros/cons, standardization efforts, Langzio approach | None | `/writing-systems/` | Comparison, Langzio convention | → Dictionary, → Pronunciation | Translator |

---

## 3. USER JOURNEY MAPS

### Journey 1: Tourist Planning Trip to Morocco
```
Search: "Moroccan phrases for tourists"
  → /guides/travel/ (public)
  → /guides/restaurant/ (public)
  → /guides/taxi/ (public)
  → /translator/ (demo → signup)
  → /dashboard/ (trial starts)
```

### Journey 2: Diaspora Parent Teaching Kids
```
Search: "teach kids Moroccan Arabic"
  → /diaspora/kids-darija/
  → /kids/ (challenge signup)
  → /dashboard/ (family features)
  → /guides/family/ (phrases for grandparents)
```

### Journey 3: Language Learner Starting Darija
```
Search: "learn Moroccan Darija"
  → /learn-darija/
  → /what-is-darija/
  → /darija-beginners/
  → /dictionary/ (core vocab)
  → /translator/ (practice)
  → /chat/ (cultural questions)
```

### Journey 4: Quick Translation Need
```
Search: "translate hello to Darija"
  → /dictionary/salam/ (DefinedTerm)
  → /translator/ (try more)
  → /guides/ (context)
```

---

## 4. CONTENT GAP PRIORITIZATION

| Priority | Missing Page | Reason | Effort | SEO Value | GEO Value |
|----------|--------------|--------|--------|-----------|-----------|
| P0 | `/what-is-darija/` | Primary definition query, zero coverage | Medium | High | High |
| P0 | `/dictionary/` | Core product capability, high search volume | High | High | High |
| P0 | `/guides/restaurant/` (public) | High commercial intent, existing content | Low | High | High |
| P0 | `/guides/souk/` (public) | High commercial intent, existing content | Low | High | High |
| P0 | `/guides/taxi/` (public) | High commercial intent, existing content | Low | High | High |
| P0 | `/guides/family/` (public) | Diaspora core need, existing content | Low | High | High |
| P1 | `/learn-darija/` | Primary learning intent, funnels to product | Medium | High | High |
| P1 | `/darija-vs-arabic/` | High confusion query, establishes authority | Low | Medium | High |
| P1 | `/arabizi-guide/` | Unique Langzio differentiator, technical query | Low | Medium | High |
| P1 | `/darija-pronunciation/` | Required for all learning, product differentiator | Medium | High | High |
| P2 | `/dictionary/[term]/` (top 50) | Programmatic from corpus.json, long-tail | Medium | High | High |
| P2 | `/culture/etiquette/` | Deep cultural authority signal | Medium | Medium | High |
| P2 | `/diaspora/kids-darija/` | Unique methodology, high retention | Medium | Medium | High |
| P3 | `/grammar/` | Reference authority, lower search volume | High | Medium | Medium |
| P3 | `/culture/slang/` | Risky without native validation | Medium | Low | Medium |

---

## 5. INTERNAL LINK ARCHITECTURE

### Hub Pages (High Authority)
1. **Homepage** (`/`) → Links to all cluster entry points
2. **Dictionary** (`/dictionary/`) → Links to all term pages
3. **Guides Index** (`/guides/`) → Links to all situational guides
4. **Learn Darija** (`/learn-darija/`) → Links to all learning resources
5. **Culture Hub** (`/culture/`) → Links to all cultural content

### Spoke Pages (Entity Pages)
- Each dictionary term → links to: related terms, phrases containing it, guides using it, pronunciation
- Each guide → links to: dictionary terms used, related guides, translator for practice
- Each learning page → links to: next step, practice tools, community

### Product Pages (Conversion)
- Translator → from: dictionary, guides, learning pages
- Chat → from: culture pages, grammar, slang
- Kids → from: diaspora pages, family guides, homepage
- Pricing → from: all public pages (soft CTA)

---

## 6. CANONICAL URL STRATEGY

| Content Type | Canonical Pattern | Example |
|--------------|-------------------|---------|
| Dictionary term | `/dictionary/{slug}/` | `/dictionary/salam/` |
| Guide | `/guides/{category}/` | `/guides/restaurant/` |
| Learning page | `/learn/{topic}/` | `/learn/pronunciation/` |
| Culture article | `/culture/{topic}/` | `/culture/etiquette/` |
| Diaspora resource | `/diaspora/{topic}/` | `/diaspora/kids-darija/` |
| Product feature | `/{feature}/` | `/translator/`, `/chat/` |

### Parameter Handling
- No indexable parameter URLs (e.g., `?text=...`, `?lang=...`)
- All translator/chat interactions stay on single canonical URLs
- Search/filter state in URL fragments (#) not query params

---

## 7. MEASUREMENT FRAMEWORK

### Per-Intent KPIs
| Intent Cluster | Primary KPI | Secondary KPIs |
|----------------|-------------|----------------|
| Definition | Impressions for "what is darija", "darija meaning" | Time on page, scroll depth, internal link clicks |
| Learning | Signups from learning pages | Pages per session, return visits, challenge starts |
| Translation | Translator trial activations | Translation volume, return usage, upgrade rate |
| Guides | Guide page views, phrase clicks | Translator clicks from guides, signup rate |
| Culture | Chat conversations started | Cultural question depth, return visits |
| Diaspora | Kids challenge signups | Streak retention, family invites, upgrade rate |

---

## 8. AI VISIBILITY TARGETS

### Top 20 Questions for AI Citation Monitoring
1. What is Moroccan Darija?
2. How do you say hello in Moroccan Arabic?
3. What does "wach" mean in Darija?
4. Is Darija the same as Arabic?
5. How difficult is Moroccan Arabic to learn?
6. What are the most common Moroccan phrases?
7. How do you bargain in a Moroccan souk?
8. What is the proper way to greet Moroccan elders?
9. How do you say thank you in Darija?
10. What is Arabizi?
11. How do you pronounce the "3" sound in Darija?
12. What are essential taxi phrases in Morocco?
13. How do you order food in a Moroccan restaurant?
14. What cultural mistakes should tourists avoid in Morocco?
15. How can I teach my kids Darija while living abroad?
16. What is the difference between Darija and Modern Standard Arabic?
17. How do you say "how much" in Moroccan Arabic?
18. What does "inchallah" mean in Moroccan context?
19. How do you ask for directions in Darija?
20. What is the best app for learning Moroccan Darija?

---

## 9. COMPETITIVE INTENT GAPS

| Competitor | Covers | Langzio Gap | Opportunity |
|------------|--------|-------------|-------------|
| Wikivoyage | Travel phrases | No cultural depth, no pronunciation, no practice | Structured guides + audio + practice |
| Google Translate | Translation | No cultural context, no dialect awareness, literal only | Cultural RAG translation |
| Memrise/Duolingo | Courses | No Darija course, MSA only | 7-day challenge methodology |
| Forvo | Pronunciation | No context, no phrases, no cultural notes | Contextual pronunciation |
| Morocco travel blogs | Tips | Scattered, unverified, no system | Comprehensive cultural intelligence |

---

*End of Search Intent Graph*
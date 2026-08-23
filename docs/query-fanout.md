# Langzio Query Fan-Out Strategy

**Version:** 1.0
**Date:** 2026-08-22
**Purpose:** Map primary queries to their natural follow-up questions and determine optimal content architecture

---

## METHODOLOGY

For each **Primary Query**, identify the **Fan-Out Questions** users naturally ask before/after. Map each to:
- **Existing Page** — already covers this (optimize)
- **Section** — covered within a page (add anchor links)
- **New Page** — genuinely missing, high value (create)
- **No Page Needed** — answered by existing product feature (link to product)

**Rule:** Do NOT create a page for every question. Only create when:
1. Search demand exists (verified or strong heuristic)
2. Unique Langzio value exists (verified data, methodology, product)
3. Not adequately answered by existing page sections

---

## PRIMARY QUERY CLUSTERS

---

### CLUSTER 1: "LEARN MOROCCAN DARIJA" (Primary Commercial Intent)

**Primary:** How to learn Moroccan Darija / Learn Moroccan Arabic

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| What is Moroccan Darija? | Definition | index.php (brief) | **New Page:** `/what-is-darija/` |
| Is Darija Arabic? | Clarification | None | **Section** in `/what-is-darija/` |
| Darija vs Modern Standard Arabic | Comparison | None | **New Page:** `/darija-vs-arabic/` |
| How hard is Darija to learn? | Difficulty assessment | None | **Section** in `/learn-darija/` |
| How long to learn Darija? | Timeline | None | **Section** in `/learn-darija/` |
| Best way to learn Darija? | Methodology | index.php (mentions challenge) | **New Page:** `/learn-darija/` (methodology hub) |
| Best app for Darija? | Tool comparison | index.php (landing) | **Section** in `/learn-darija/` + `/translator-app/` |
| Darija for beginners | Entry point | kids.php (partial) | **New Page:** `/darija-beginners/` |
| Most common Darija words | Vocabulary | guides.php (auth-gated) | **New Page:** `/darija-vocabulary/` |
| Common Moroccan phrases | Phrases | guides.php (auth-gated) | **New Page:** `/darija-phrases/` |
| Darija pronunciation guide | Phonology | translator.php (private output) | **New Page:** `/darija-pronunciation/` |
| Darija grammar basics | Grammar | None | **New Page:** `/grammar/` (P2) |
| How to practice Darija daily? | Habit building | kids.php (streak concept) | **Section** in `/learn-darija/` → Kids challenge |
| Learn Darija for travel | Travel focus | guides.php (auth-gated) | **Section** in `/guides/travel/` (public) |
| Learn Darija for family | Diaspora focus | kids.php (auth-gated) | **New Page:** `/diaspora/kids-darija/` |
| Moroccan Arabic course | Structured learning | None | **Course schema** on `/learn-darija/` + Kids challenge |

**Page Architecture Decision:**
```
/learn-darija/           → Hub page (methodology, roadmap, product entry points)
  ├── /what-is-darija/   → Definition + FAQ (Is it Arabic? Regions? Speakers?)
  ├── /darija-vs-arabic/ → Comparison (table, examples, when to use which)
  ├── /darija-beginners/ → First 50 words, basic grammar, pronunciation start
  ├── /darija-vocabulary/ → Thematic lists (100/500/1000) with flashcard links
  ├── /darija-phrases/   → Situational categories (links to public guides)
  ├── /darija-pronunciation/ → Phonology, Arabizi, audio references
  └── /grammar/          → Reference (verbs, nouns, structure) — P2
```

---

### CLUSTER 2: "MOROCCAN DARIJA TRANSLATOR" (Product Intent)

**Primary:** Translate English to Moroccan Darija / Moroccan Arabic translator

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| Best Darija translator app? | Comparison | index.php | **Section** in `/translator-app/` |
| Translate phrase to Darija | Immediate need | translator.php (auth) | **Public Demo** on `/translator/` |
| Translate sentence to Darija | Longer text | translator.php (auth) | **Public Demo** with length limit |
| English to Darija dictionary | Word lookup | None | **New Page:** `/dictionary/` |
| Darija to English translation | Reverse | translator.php (auth) | **Public Demo** on `/translator/` |
| French to Darija translation | Multilingual | translator.php (supports FR) | **Section** in `/translator/` |
| Darija translation with pronunciation | Audio need | translator.php (output has it) | **Highlight** in translator output |
| Cultural context in translation | Nuance | translator.php (RAG output) | **Highlight** in translator output |
| Offline Darija translator | Offline need | None | **FAQ** on `/translator/` (PWA install) |
| Darija voice translation | Speech | None | **Roadmap** mention on `/translator/` |

**Page Architecture Decision:**
```
/translator/             → Public demo (limited daily) + signup CTA
  ├── /translator-app/   → Feature comparison, differentiators, reviews
  └── /dictionary/       → Word-level lookup (DefinedTerm schema)
```

---

### CLUSTER 3: "WHAT IS MOROCCAN DARIJA" (Informational/Top of Funnel)

**Primary:** What is Moroccan Darija / What is Darija language

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| Is Darija a language or dialect? | Classification | None | **Section** in `/what-is-darija/` |
| Where is Darija spoken? | Geography | None | **Section** in `/what-is-darija/` |
| How many people speak Darija? | Statistics | None | **Section** in `/what-is-darija/` (cite sources) |
| Darija vs Moroccan Arabic | Terminology | None | **Section** in `/what-is-darija/` (synonyms) |
| Darija vs Hassaniya | Variant distinction | None | **Section** in `/what-is-darija/` (brief) |
| History of Moroccan Darija | Linguistic history | None | **Section** in `/what-is-darija/` (brief) |
| Darija writing system | Script | None | **Link** to `/arabizi-guide/` + `/writing-systems/` |
| Darija mutual intelligibility | Comprehension | None | **Section** in `/darija-vs-arabic/` |
| Darija language family | Classification | None | **Section** in `/what-is-darija/` |

**Page Architecture Decision:**
```
/what-is-darija/         → Comprehensive definition page (pillar content)
  Sections: Definition, Classification, Geography, Speakers, History, 
            Writing Systems, Relationship to Arabic, Dialects, 
            Learning Implications, Langzio Approach
```

---

### CLUSTER 4: "HOW DO YOU SAY [X] IN DARIJA" (Dictionary Intent)

**Primary:** How do you say hello/thank you/please in Moroccan Darija

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| Hello in Darija | Greeting | guides.php (auth) | **Term Page:** `/dictionary/salam/` |
| Thank you in Darija | Gratitude | guides.php (auth) | **Term Page:** `/dictionary/shukran/` |
| Please in Darija | Politeness | guides.php (auth) | **Term Page:** `/dictionary/3afak/` |
| Goodbye in Darija | Farewell | guides.php (auth) | **Term Page:** `/dictionary/bslama/` |
| How are you in Darija? | Greeting | guides.php (auth) | **Term Page:** `/dictionary/labas/` |
| Yes/No in Darija | Basics | guides.php (partial) | **Term Pages:** `/dictionary/wakha/`, `/dictionary/la/` |
| Excuse me in Darija | Apology | guides.php (partial) | **Term Page:** `/dictionary/ma3lich/` |
| Good morning in Darija | Time greeting | None | **Term Page:** `/dictionary/sbah-lkhir/` |
| Good night in Darija | Time greeting | None | **Term Page:** `/dictionary/layla-saida/` |
| Welcome in Darija | Hospitality | guides.php (auth) | **Term Page:** `/dictionary/mar7ba/` |
| Delicious in Darija | Compliment | guides.php (auth) | **Term Page:** `/dictionary/bnina/` |
| Beautiful in Darija | Compliment | None | **Term Page:** `/dictionary/zwina/` |

**Page Architecture Decision:**
```
/dictionary/             → Searchable index (ItemList schema)
  ├── /dictionary/salam/ → DefinedTerm schema: term, pronunciation, meaning, 
  │                         usage, cultural context, related terms, audio
  ├── /dictionary/shukran/
  ├── /dictionary/3afak/
  └── ... (top 50 from corpus.json + high-volume search terms)
```

**Canonical Term Selection:** Use most common Latin spelling as canonical.
- "Salam" not "Salam" / "Ssalam" / "Es-salam"
- "3afak" not "afak" / "aafak"
- "Shukran" not "choukran" / "chukran"
- Document variants in `alternateName` property

---

### CLUSTER 5: "MOROCCAN RESTAURANT PHRASES" (Situational High Intent)

**Primary:** Moroccan restaurant phrases / Order food in Darija

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| Ask for table in Darija | Restaurant | guides.php (auth) | **Public Guide:** `/guides/restaurant/` |
| Order food in Darija | Restaurant | guides.php (auth) | **Section** in `/guides/restaurant/` |
| Ask for bill in Darija | Restaurant | guides.php (auth) | **Section** in `/guides/restaurant/` |
| Dietary restrictions in Darija | Restaurant | None | **Add to** `/guides/restaurant/` |
| Compliment food in Darija | Restaurant | guides.php (partial) | **Section** in `/guides/restaurant/` |
| Restaurant etiquette Morocco | Cultural | guides.php (cheatsheet) | **Section** in `/guides/restaurant/` + `/culture/etiquette/` |
| Moroccan menu vocabulary | Vocabulary | None | **Section** in `/guides/restaurant/` + dictionary links |
| Tip in Morocco restaurants | Practical | None | **Section** in `/guides/restaurant/` |

**Page Architecture Decision:**
```
/guides/restaurant/      → Public guide (was auth-gated)
  Sections: Essential Phrases (table, order, bill, compliment),
            Menu Vocabulary, Dietary Phrases, Etiquette, Cultural Tips,
            Practice in Translator, Related Guides
```

---

### CLUSTER 6: "BARGAIN IN MOROCCAN SOUK" (Situational High Intent)

**Primary:** How to bargain in Moroccan souk / Souk phrases Morocco

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| Ask price in Darija | Souk | guides.php (auth) | **Public Guide:** `/guides/souk/` |
| Negotiate price in Darija | Souk | guides.php (auth) | **Section** in `/guides/souk/` |
| Numbers in Darija for bargaining | Numbers | None | **Section** in `/guides/souk/` + `/dictionary/numbers/` |
| Final price phrase in Darija | Souk | guides.php (auth) | **Section** in `/guides/souk/` |
| Walk away phrase in Darija | Souk | guides.php (partial) | **Section** in `/guides/souk/` |
| Souk etiquette Morocco | Cultural | guides.php (cheatsheet) | **Section** in `/guides/souk/` + `/culture/etiquette/` |
| Moroccan market vocabulary | Vocabulary | None | **Section** in `/guides/souk/` |

**Page Architecture Decision:**
```
/guides/souk/            → Public guide (was auth-gated)
  Sections: Essential Phrases (price, negotiate, deal),
            Numbers 1-100 (table + audio), Bargaining Strategy,
            Etiquette, Cultural Context, Practice in Translator
```

---

### CLUSTER 7: "TAXI PHRASES MOROCCO" (Situational High Intent)

**Primary:** Taxi phrases Morocco / How to take taxi in Morocco

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| Tell taxi destination in Darija | Taxi | guides.php (auth) | **Public Guide:** `/guides/taxi/` |
| Ask taxi fare in Darija | Taxi | guides.php (auth) | **Section** in `/guides/taxi/` |
| Ask for meter in Darija | Taxi | guides.php (auth) | **Section** in `/guides/taxi/` |
| Stop taxi in Darija | Taxi | guides.php (auth) | **Section** in `/guides/taxi/` |
| Taxi scams Morocco | Safety | None | **Section** in `/guides/taxi/` + `/culture/travel-tips/` |
| Airport taxi Morocco | Specific | None | **Section** in `/guides/taxi/` |
| Petit taxi vs grand taxi | Knowledge | None | **Section** in `/guides/taxi/` |

**Page Architecture Decision:**
```
/guides/taxi/            → Public guide (was auth-gated)
  Sections: Essential Phrases (destination, fare, meter, stop),
            Taxi Types (petit/grand), Airport Transfers,
            Safety & Scams, Cultural Norms, Practice in Translator
```

---

### CLUSTER 8: "MOROCCAN FAMILY GREETINGS" (Diaspora/High Retention)

**Primary:** Moroccan family greetings / How to greet Moroccan elders

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| Greet elders in Darija | Respect | guides.php (auth) | **Public Guide:** `/guides/family/` |
| Family visit phrases Morocco | Hospitality | guides.php (auth) | **Section** in `/guides/family/` |
| Thank host in Darija | Gratitude | guides.php (auth) | **Section** in `/guides/family/` |
| Respect terms in Darija | Register | guides.php (partial) | **Section** in `/guides/family/` + `/culture/etiquette/` |
| Moroccan hospitality phrases | Cultural | guides.php (auth) | **Section** in `/guides/family/` |
| Diaspora kids Darija | Retention | kids.php (auth) | **Link** to `/diaspora/kids-darija/` |

**Page Architecture Decision:**
```
/guides/family/          → Public guide (was auth-gated)
  Sections: Greetings (elders, peers, children),
            Hospitality (guest, host), Respect Terms,
            Celebration Phrases, Cultural Context,
            Practice with Kids, Related Guides
```

---

### CLUSTER 9: "DARIJA PRONUNCIATION" (Technical/High GEO Value)

**Primary:** How to pronounce Darija / Darija pronunciation guide

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| What is the 3 sound in Darija? | Phoneme | translator.php (private) | **Section** in `/darija-pronunciation/` |
| What is the 7 sound in Darija? | Phoneme | translator.php (private) | **Section** in `/darija-pronunciation/` |
| What is the 9 sound in Darija? | Phoneme | translator.php (private) | **Section** in `/darija-pronunciation/` |
| Arabizi numbers explained | Notation | None | **New Page:** `/arabizi-guide/` |
| Darija stress rules | Prosody | None | **Section** in `/darija-pronunciation/` |
| Darija intonation patterns | Prosody | None | **Section** in `/darija-pronunciation/` |
| French influence on Darija pronunciation | Contact linguistics | None | **Section** in `/darija-pronunciation/` |
| Regional pronunciation differences | Variation | None | **Section** in `/darija-pronunciation/` (brief) |

**Page Architecture Decision:**
```
/darija-pronunciation/   → Comprehensive phonology guide
  Sections: Consonants (including 3, 7, 9, q, gh, kh),
            Vowels, Stress, Intonation, Arabizi Mapping Table,
            French Loanword Pronunciation, Regional Variation,
            Practice with Translator, Audio References
/arabizi-guide/          → Focused Arabizi reference (high technical query)
  Sections: What is Arabizi, Number Mapping (3,7,9,5,2),
            Letter Mapping, Typing Tips, History, Practice
```

---

### CLUSTER 10: "MOROCCAN CULTURE ETIQUETTE" (Authority/Trust)

**Primary:** Moroccan cultural etiquette / Morocco customs for tourists

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| Greeting customs Morocco | Etiquette | guides.php (cheatsheet) | **Section** in `/culture/etiquette/` |
| Moroccan hospitality rules | Etiquette | guides.php (partial) | **Section** in `/culture/etiquette/` |
| Dress code Morocco tourists | Practical | None | **New Page:** `/culture/travel-tips/` |
| Photography rules Morocco | Practical | None | **Section** in `/culture/travel-tips/` |
| Tipping in Morocco | Practical | None | **Section** in `/culture/travel-tips/` |
| Ramadan etiquette Morocco | Seasonal | None | **Section** in `/culture/travel-tips/` |
| Gender interaction norms | Cultural | None | **Section** in `/culture/etiquette/` (careful) |
| Gift giving Morocco | Cultural | None | **Section** in `/culture/etiquette/` |
| Hand gestures Morocco | Non-verbal | None | **Section** in `/culture/etiquette/` |
| Shoes inside home Morocco | Cultural | None | **Section** in `/culture/etiquette/` |

**Page Architecture Decision:**
```
/culture/etiquette/      → Deep cultural authority page
  Sections: Greetings, Hospitality, Home Visits, Gender Norms,
            Gestures, Dining, Religious Sensitivity, Regional Variation
/culture/travel-tips/    → Practical tourist guidance
  Sections: Dress, Photography, Tipping, Ramadan, Safety, Money,
            Transport, Communication, Emergency
```

---

### CLUSTER 11: "TEACH KIDS DARIJA ABROAD" (Diaspora/High LTV)

**Primary:** Teach children Moroccan Arabic / Darija for kids abroad

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| How to teach kids Darija? | Methodology | kids.php (auth) | **New Page:** `/diaspora/kids-darija/` |
| Darija flashcards for kids | Tool | kids.php (auth) | **Feature** in Kids challenge + public demo |
| 7-day Darija challenge | Program | kids.php (auth) | **Public Landing:** `/kids/` (challenge signup) |
| Moroccan Arabic games for kids | Engagement | kids.php (partial) | **Section** in `/diaspora/kids-darija/` |
| Keep Darija alive abroad | Motivation | index.php (testimonial) | **Section** in `/diaspora/language-preservation/` |
| Heritage learner Darija | Specific audience | None | **New Page:** `/diaspora/heritage-learners/` (P3) |
| Family practice routine | Habit | kids.php (streak) | **Section** in `/diaspora/kids-darija/` |

**Page Architecture Decision:**
```
/diaspora/kids-darija/   → Methodology + challenge signup (public)
  Sections: Why It Matters, Langzio Methodology (7-day challenge),
            Daily Routine, Flashcards, Streaks, Progress Tracking,
            Family Involvement, Grandparent Connection, Signup
/kids/                   → Challenge app (auth) — keep as product
/diaspora/language-preservation/ → Stories, community, resources (P2)
```

---

### CLUSTER 12: "ARABIZI" (Technical/Niche High Authority)

**Primary:** What is Arabizi / How to read Arabizi numbers

| Fan-Out Question | Intent | Current Coverage | Action |
|------------------|--------|------------------|--------|
| What does 3 mean in Arabizi? | Notation | None | **Section** in `/arabizi-guide/` |
| What does 7 mean in Arabizi? | Notation | None | **Section** in `/arabizi-guide/` |
| What does 9 mean in Arabizi? | Notation | None | **Section** in `/arabizi-guide/` |
| Arabizi to Arabic script | Conversion | None | **Section** in `/arabizi-guide/` |
| Type Arabizi on keyboard | Practical | None | **Section** in `/arabizi-guide/` |
| Arabizi history | Background | None | **Section** in `/arabizi-guide/` |
| Arabizi vs Franco-Arabic | Terminology | None | **Section** in `/arabizi-guide/` |

**Page Architecture Decision:**
```
/arabizi-guide/          → Definitive Arabizi reference (unique Langzio asset)
  Sections: Definition, Number Mapping (3,7,9,5,2), Letter Mapping,
            Complete Reference Table, Typing Guide, History,
            Langzio Convention, Practice Tool Link
```

---

## FAN-OUT SUMMARY: PAGE CREATION PRIORITIES

### Must Create (P0 — Core Intent Coverage)
| Page | Primary Query Served | Fan-Out Coverage |
|------|---------------------|------------------|
| `/what-is-darija/` | "What is Moroccan Darija" | 9 fan-out questions |
| `/darija-vs-arabic/` | "Darija vs Arabic" | 4 fan-out questions |
| `/learn-darija/` | "How to learn Darija" | 12 fan-out questions (hub) |
| `/darija-beginners/` | "Darija for beginners" | 5 fan-out questions |
| `/darija-vocabulary/` | "Common Darija words" | 3 fan-out questions |
| `/darija-phrases/` | "Moroccan phrases" | 3 fan-out questions |
| `/darija-pronunciation/` | "Darija pronunciation" | 8 fan-out questions |
| `/arabizi-guide/` | "What is Arabizi" | 7 fan-out questions |
| `/dictionary/` | "Darija dictionary" | 12+ term pages |
| `/translator/` (public demo) | "Darija translator" | 5 fan-out questions |
| `/guides/restaurant/` (public) | "Restaurant phrases" | 8 fan-out questions |
| `/guides/souk/` (public) | "Souk bargaining" | 7 fan-out questions |
| `/guides/taxi/` (public) | "Taxi phrases" | 7 fan-out questions |
| `/guides/family/` (public) | "Family greetings" | 6 fan-out questions |
| `/guides/travel/` (public) | "Travel phrases" | 5 fan-out questions |
| `/culture/etiquette/` | "Moroccan etiquette" | 9 fan-out questions |
| `/culture/travel-tips/` | "Morocco travel tips" | 8 fan-out questions |
| `/diaspora/kids-darija/` | "Teach kids Darija" | 7 fan-out questions |

### Should Create (P1 — Authority & Long-Tail)
| Page | Primary Query Served | Fan-Out Coverage |
|------|---------------------|------------------|
| `/grammar/` | "Darija grammar" | 6 fan-out questions |
| `/diaspora/language-preservation/` | "Darija abroad" | 4 fan-out questions |
| `/writing-systems/` | "Darija script" | 3 fan-out questions |

### Defer (P2/P3 — Lower Volume or Risk)
| Page | Reason |
|------|--------|
| `/culture/slang/` | Requires native validation, risk of inaccuracy |
| `/diaspora/heritage-learners/` | Niche, complex, P3 |
| `/culture/ramadan/` | Seasonal, covered in travel-tips |

---

## NO PAGE NEEDED — PRODUCT FEATURE COVERS

| Question | Answered By |
|----------|-------------|
| "Translate this specific phrase" | `/translator/` (tool) |
| "Chat about Moroccan culture" | `/chat/` (AI) |
| "Practice pronunciation" | `/translator/` + `/kids/` (audio) |
| "Track my learning progress" | `/dashboard/` (auth) |
| "Get WhatsApp reminders" | Profile → WhatsApp (auth) |
| "Upgrade to Pro" | `/pricing/` (auth) |

---

## IMPLEMENTATION SEQUENCE

1. **Week 1:** Public guides (restaurant, souk, taxi, family, travel) — existing content, just remove auth gate
2. **Week 2:** Definition hub (`/what-is-darija/`, `/darija-vs-arabic/`, `/learn-darija/`)
3. **Week 3:** Dictionary index + top 20 term pages + `/arabizi-guide/`
4. **Week 4:** Pronunciation guide, culture pages, diaspora methodology
5. **Week 5:** Translator public demo, sitemap, structured data, internal linking

---

*End of Query Fan-Out Strategy*
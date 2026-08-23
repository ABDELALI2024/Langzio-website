# Langzio Entity Map

**Version:** 1.0
**Date:** 2026-08-22
**Purpose:** Define all entities in the Langzio knowledge domain with canonical properties, relationships, and SEO/GEO implementation

---

## ENTITY DESIGN PRINCIPLES

1. **One entity = one canonical URL** (or clear canonical reference)
2. **Entities are grounded in existing product data** — no fabricated entities
3. **Entity types map to Schema.org types** where appropriate
4. **Aliases documented** for Arabizi, French, Arabic script variants
5. **Relationships are directional and typed**

---

## TIER 1: CORE ORGANIZATION ENTITY

### Entity: Langzio
- **Type:** `Organization`, `SoftwareApplication`, `Brand`
- **Canonical Name:** Langzio
- **Alternate Names:** Langzio AI, Langzio Darija, Langzio Translator
- **Description:** Cultural language intelligence platform for Moroccan Darija, providing AI-powered translation, cultural chat, verified phrase guides, and family learning tools for travelers and Moroccan diaspora.
- **Canonical URL:** `https://langzio.com/`
- **Logo:** `https://langzio.com/assets/icon.svg`
- **SameAs:** 
  - GitHub: `https://github.com/langzio` (if exists)
  - Twitter/X: `https://x.com/langzio` (if exists)
  - LinkedIn: `https://linkedin.com/company/langzio` (if exists)
- **Founding Date:** 2026 (approx)
- **Area Served:** Worldwide (focus: Morocco travelers, Moroccan diaspora)
- **Knows About:** Moroccan Darija, Moroccan culture, Language learning, AI translation
- **Offers:** 
  - Darija Translator (SoftwareApplication)
  - AI Cultural Chat (SoftwareApplication)
  - Smart Guides (Course/Guide)
  - 7-Day Kids Challenge (Course)
- **Has Methodology:** RAG-grounded translation with cultural context
- **Has Data:** Verified Phrase Corpus (28+ curated phrases)
- **Target Audience:** Tourists, MRE families, Digital nomads, Heritage learners
- **Business Model:** Freemium (7-day trial → $9/mo Pro)
- **AI Provider:** Groq (Llama 3.3 70B Versatile)

**Structured Data Implementation:**
- Homepage: `Organization` + `SoftwareApplication` + `WebSite`
- All pages: `WebPage` with `isPartOf` → WebSite
- Product pages: `SoftwareApplication` with `offers` → `Offer`

---

## TIER 2: LANGUAGE ENTITIES

### Entity: Moroccan Darija
- **Type:** `Language`, `DefinedTerm`
- **Canonical Name:** Moroccan Darija
- **Alternate Names:** 
  - Moroccan Arabic
  - Darija
  - Maghrebi Arabic (Morocco)
  - الدارجة المغربية (Arabic script)
  - Derja, Derija (transliteration variants)
- **Description:** The colloquial Arabic dialect spoken in Morocco, distinct from Modern Standard Arabic, with significant Amazigh, French, and Spanish lexical influence. Primary vernacular language of Morocco.
- **Canonical URL:** `https://langzio.com/what-is-darija/`
- **Language Code:** `ary` (ISO 639-3)
- **Spoken In:** Morocco (primary), Moroccan diaspora communities worldwide
- **Speaker Count:** ~35-40 million (L1 + L2) — cite Ethnologue/Glottolog
- **Writing System:** Arabic script (official), Latin script (Arabizi, informal)
- **Language Family:** Afro-Asiatic → Semitic → Central Semitic → Arabic → Maghrebi → Moroccan Arabic
- **Mutual Intelligibility:** Limited with other Maghrebi dialects; low with MSA
- **Key Features:** 
  - Phonological: /q/ → [ɡ] or [ʔ], presence of /p/ /v/ /ɡ/ from loans
  - Lexical: Heavy French/Spanish/Amazigh borrowing
  - Grammatical: Simplified case system, analytic tendencies
- **Related Entities:** 
  - `isVariantOf` → Arabic (macrolanguage)
  - `hasDialect` → Urban Darija, Rural Darija, Hassaniya (borderline)
  - `influencedBy` → French, Spanish, Amazigh (Tamazight), Classical Arabic
  - `hasChild` → Darija Vocabulary, Darija Phrases, Darija Grammar, Darija Pronunciation

**Structured Data Implementation:**
- `/what-is-darija/`: `Language` + `DefinedTerm` with full properties
- All Darija term pages: `mentions` → Moroccan Darija

### Entity: Modern Standard Arabic (MSA)
- **Type:** `Language`, `DefinedTerm`
- **Canonical Name:** Modern Standard Arabic
- **Alternate Names:** MSA, Fusha, العربية الفصحى
- **Description:** The standardized, literary variety of Arabic used in writing, formal speech, media, and education across the Arab world.
- **Canonical URL:** `https://langzio.com/darija-vs-arabic/#msa`
- **Language Code:** `arb` (ISO 639-3)
- **Relationship:** `isStandardizedFormOf` → Arabic (macrolanguage); `contrastsWith` → Moroccan Darija

### Entity: Arabizi
- **Type:** `WritingSystem`, `DefinedTerm`
- **Canonical Name:** Arabizi
- **Alternate Names:** Franco-Arabic, Arabish, Arabizi script, Chat Arabic
- **Description:** Informal Latin-script transliteration system for Arabic dialects using numbers to represent sounds lacking Latin equivalents (3=ع, 7=ح, 9=ق/غ, etc.).
- **Canonical URL:** `https://langzio.com/arabizi-guide/`
- **Used For:** Moroccan Darija (primary), other Arabic dialects
- **Key Mappings:** 3=ع, 7=ح, 9=ق/غ, 5=خ, 2=أ/ء, 6=ط, 8=ق (variant)
- **Langzio Convention:** Documented on `/arabizi-guide/`
- **Relationship:** `transliterates` → Moroccan Darija; `usedBy` → Langzio (for learner accessibility)

---

## TIER 3: PRODUCT FEATURE ENTITIES

### Entity: Langzio Translator
- **Type:** `SoftwareApplication`, `Product`
- **Canonical Name:** Langzio Translator
- **Description:** AI-powered Moroccan Darija translator providing structured output: Darija phrase, Latin pronunciation, English meaning, tone/register, cultural context, common mistakes to avoid, and cultural tips — grounded in verified phrase corpus via RAG.
- **Canonical URL:** `https://langzio.com/translator/`
- **Application Category:** EducationalApplication, TranslatorApplication
- **Operating System:** Web, PWA (installable)
- **Offers:** 
  - Free tier: Limited daily translations
  - Pro tier: Unlimited translations, cultural insights, priority
- **Features:**
  - `supportsLanguage` → English, Moroccan Darija, French
  - `hasOutputFormat` → StructuredTranslation (custom schema)
  - `usesTechnology` → RAG (Retrieval-Augmented Generation)
  - `groundedIn` → Verified Phrase Corpus
- **Related Entities:** `complements` → Langzio Chat, Smart Guides, Dictionary

**Structured Data Implementation:**
- `/translator/`: `SoftwareApplication` with `featureList`, `offers`, `applicationCategory`

### Entity: Langzio AI Chat
- **Type:** `SoftwareApplication`, `Product`
- **Canonical Name:** Langzio AI Chat
- **Description:** Conversational AI tutor for Moroccan Darija and Moroccan culture, maintaining conversation memory, grounded in verified phrase corpus, providing cultural etiquette, slang explanations, and nuanced language guidance.
- **Canonical URL:** `https://langzio.com/chat/`
- **Application Category:** EducationalApplication, ChatBot
- **Features:**
  - `hasConversationMemory` → true
  - `groundedIn` → Verified Phrase Corpus
  - `specializesIn` → Moroccan Darija, Moroccan culture, etiquette
- **Related Entities:** `complements` → Translator, Guides, Dictionary

### Entity: Langzio Smart Guides
- **Type:** `Course`, `Guide`, `ItemList`
- **Canonical Name:** Langzio Smart Guides
- **Description:** Curated situational phrase packs for key Morocco scenarios (Restaurant, Souk, Taxi, Family, Travel) with verified phrases, cultural context, and etiquette notes.
- **Canonical URL:** `https://langzio.com/guides/`
- **Has Part:** 
  - Restaurant Guide
  - Souk Guide
  - Taxi Guide
  - Family Guide
  - Travel Guide
- **Each Guide Entity:**
  - Type: `Guide`, `Course`
  - Has Part: Multiple `DefinedTerm` (phrases)
  - `teaches`: Situational competence
  - `context`: Cultural setting

### Entity: Langzio 7-Day Kids Challenge
- **Type:** `Course`, `EducationalProgram`
- **Canonical Name:** Langzio 7-Day Darija Challenge
- **Description:** Structured family learning program: 5 Darija words/day for 7 days with flashcards, streaks, progress tracking, and sharing — designed for Moroccan diaspora families teaching children abroad.
- **Canonical URL:** `https://langzio.com/kids/`
- **Duration:** 7 days
- **Frequency:** Daily
- **Teaches:** Core vocabulary (35 words), pronunciation, cultural context
- **Has Part:** Daily lessons (Day 1-7), Flashcard system, Streak tracking
- **Target Audience:** Moroccan diaspora families, children 5-12, heritage learners
- **Related Entities:** `partOf` → Langzio Platform; `complements` → Dictionary, Guides

---

## TIER 4: CONTENT ENTITIES (FROM CORPUS.JS)

### Entity Type: Verified Darija Phrase (DefinedTerm)

**Template Properties:**
- **Canonical Name:** [Latin spelling per Langzio convention]
- **Alternate Names:** [Arabic script, Arabizi variants, common misspellings]
- **Type:** `DefinedTerm`, `Phrase`
- **In Language:** Moroccan Darija (`inLanguage: "ary"`)
- **Meaning:** [English definition]
- **Pronunciation:** [Latin phonetic approximation]
- **Register:** [polite/neutral/casual/formal]
- **Context:** [when to use: restaurant, souk, taxi, family, basics, travel]
- **Cultural Note:** [etiquette, nuance, common mistake to avoid]
- **Audio:** [URL if available]
- **Part Of:** [Guide category entity]
- **Related Terms:** [vocabulary components]
- **Canonical URL:** `https://langzio.com/dictionary/{slug}/`
- **Source:** Langzio Verified Phrase Corpus
- **Verification Status:** `verified` (curated by Langzio team)

**Example Instance: Salam**
- **Canonical Name:** Salam
- **Alternate Names:** سلام, salaam, es-salam
- **Meaning:** Hello / peace greeting
- **Pronunciation:** sa-lam
- **Register:** neutral (universal)
- **Context:** basics, any greeting situation
- **Cultural Note:** Universal greeting, appropriate in all contexts. Often followed by "labas?" (how are you?).
- **Context Category:** basics
- **Related Terms:** labas, 3afak, shukran
- **Canonical URL:** `https://langzio.com/dictionary/salam/`

**All 28 Corpus Phrases as Entities:**

| Canonical | Arabic | Meaning | Category | Register | Context |
|-----------|--------|---------|----------|----------|---------|
| Salam | سلام | Hello/peace | basics | neutral | universal |
| Labas? | لاباس؟ | How are you? | basics | casual | greeting |
| Shukran | شكراً | Thank you | basics | neutral | gratitude |
| Bslama | بسلامة | Goodbye | basics | neutral | farewell |
| 3afak | عفاك | Please | basics | polite | requests |
| Mzyan | مزيان | Good/fine | basics | neutral | approval |
| Wakha | واخا | OK/agreed | basics | casual | agreement |
| Ma3lich | معليش | No problem | basics | casual | apology/excuse |
| Fin kayn...? | فين كاين...؟ | Where is...? | travel | neutral | directions |
| Bghit nmshi l... | بغيت نمشي ل... | I want to go to... | travel | neutral | directions |
| Wach kayn wifi? | واش كاين واي فاي؟ | Is there WiFi? | travel | neutral | connectivity |
| Salam, wach kayn blassa? | سلام، واش كاين بلاصة؟ | Hello, table available? | restaurant | polite | dining |
| Shno katnsa7ni? | شنو كاتنصحي؟ | What do you recommend? | restaurant | neutral | dining |
| 3afak, bghit had lplat | عفاك، بغيت هاد اللطات | Please, I want this dish | restaurant | polite | dining |
| 3afak, jib lia l7sab | عفاك، جيب ليا لحساب | Please bring the bill | restaurant | polite | dining |
| Bchhal hadchi? | بقداش هادشي؟ | How much is this? | souk | neutral | shopping |
| Ghaliya chwiya | غالية شوية | A bit expensive | souk | casual | bargaining |
| A3tini taman lakhir |عطيني تمن لخير | Give me final price | souk | direct | bargaining |
| Safi, ntafa9na | صافي، نتفاهمنا | Deal, agreed | souk | neutral | closing |
| 3afak, l medina | عفاك، للمدينة | Please, to the medina | taxi | polite | transport |
| Bchhal lprix? | بقداش لبريكس؟ | How much is the fare? | taxi | neutral | transport |
| Dir compteur, 3afak | دير الكومبتور، عفاك | Use the meter please | taxi | polite | transport |
| Waqaf hna, 3afak | واقف هنا، عفاك | Stop here please | taxi | polite | transport |
| Labas 3likom? | لاباس عليكم؟ | How are you all? | family | polite | family greeting |
| Allah ykhalikom | الله يخليكم | God protect you | family | respectful | blessing |
| Shukran bzzaf | شكراً بزاف | Thank you very much | family | warm | gratitude |
| Mtsharfin b ziyartkom | مشرفين ب زيارتكم | Honored by your visit | family | formal | hospitality |
| Ana mghribi mn... | أنا مغربي من... | I'm Moroccan from... | family | neutral | diaspora intro |

---

## TIER 5: VOCABULARY ENTITIES (Atomic Terms)

**Derived from phrases — each component word as `DefinedTerm`**

Examples (not exhaustive):
- `salam` → peace/hello
- `labas` → fine/good/how are you
- `shukran` → thanks
- `bslama` → goodbye/peacefully
- `3afak` → please (softener)
- `mzyan` → good
- `wakha` → ok
- `ma3lich` → no problem
- `fin` → where
- `kayn` → there is/exists
- `bghit` → I want
- `nmshi` → I go/walk
- `wach` → question particle (is/are/do)
- `blassa` → place/spot/table
- `nsa7` → recommend/advise
- `plat` → dish/plate (from French)
- `jib` → bring
- `lia` → to me
- `7sab` → bill/account
- `bchhal` → how much
- `ghali` → expensive
- `taman` → price
- `safi` → enough/done/agreed
- `ntafa9na` → we agreed/understood
- `medina` → old city
- `compteur` → meter (from French)
- `waqaf` → stop
- `hna` → here
- `3likom` → upon you (plural)
- `allah` → God
- `ykhalik` → protect you
- `bzzaf` → very much/a lot
- `mtsharfin` → honored
- `ziyara` → visit
- `mghribi` → Moroccan

**Each vocabulary term gets:**
- `/dictionary/{term}/` page
- `DefinedTerm` schema
- Links to phrases containing it
- Pronunciation, part of speech, usage examples

---

## TIER 6: CULTURAL CONCEPT ENTITIES

### Entity: Moroccan Hospitality (Diyafa)
- **Type:** `DefinedTerm`, `CulturalConcept`
- **Canonical Name:** Moroccan Hospitality (Diyafa)
- **Description:** The cultural code of generous hosting, elaborate greetings, food offering, and guest honor in Moroccan society.
- **Canonical URL:** `https://langzio.com/culture/etiquette/#hospitality`
- **Related Entities:** `manifestedIn` → Family Guide phrases, `guides` → Restaurant Guide, Family Guide

### Entity: Moroccan Bargaining Culture
- **Type:** `DefinedTerm`, `CulturalConcept`
- **Canonical Name:** Moroccan Bargaining Culture
- **Description:** Expected price negotiation in souks and markets, viewed as social interaction rather than conflict, with established rituals and face-saving conventions.
- **Canonical URL:** `https://langzio.com/guides/souk/#culture`
- **Related Entities:** `manifestedIn` → Souk Guide phrases

### Entity: Moroccan Greeting Rituals
- **Type:** `DefinedTerm`, `CulturalConcept`
- **Canonical Name:** Moroccan Greeting Rituals
- **Description:** Multi-step greeting sequences involving "Salam", "Labas?", "Allah ykhalik", hand placement, cheek kisses (gender-dependent), and inquiry about family.
- **Canonical URL:** `https://langzio.com/culture/etiquette/#greetings`
- **Related Entities:** `manifestedIn` → Family Guide, Basics phrases

### Entity: Politeness Register (3afak Culture)
- **Type:** `DefinedTerm`, `LinguisticConcept`
- **Canonical Name:** Moroccan Politeness Register
- **Description:** The pervasive use of softeners (especially "3afak" / "afak") to mitigate directness, show respect, and maintain social harmony in requests.
- **Canonical URL:** `https://langzio.com/culture/etiquette/#politeness`
- **Related Entities:** `exemplifiedBy` → 3afak (term), all guide phrases

---

## TIER 7: USER PERSONA ENTITIES (For Targeting)

### Entity: Morocco Tourist
- **Type:** `Audience`, `Person`
- **Canonical Name:** Morocco Tourist / Traveler
- **Description:** Short-term visitor to Morocco seeking practical communication tools for restaurants, transport, markets, and basic social interaction.
- **Needs:** Survival phrases, pronunciation, cultural avoidance, quick reference
- **Langzio Entry Points:** Guides (restaurant, souk, taxi), Translator, Travel phrases
- **Journey:** Search phrases → Translator demo → Trial signup → Guides access

### Entity: Moroccan Diaspora Family
- **Type:** `Audience`, `Person`
- **Canonical Name:** Moroccan Diaspora Family (MRE)
- **Description:** Moroccan-origin families living abroad seeking to maintain Darija language and cultural connection with children and extended family.
- **Needs:** Structured learning, kid-friendly tools, family phrases, heritage identity, grandparent communication
- **Langzio Entry Points:** Kids Challenge, Family Guide, Dictionary, Chat
- **Journey:** Search "teach kids Darija" → Kids Challenge → Trial → Family features

### Entity: Digital Nomad / Long-Stay Visitor
- **Type:** `Audience`, `Person`
- **Canonical Name:** Digital Nomad in Morocco
- **Description:** Extended-stay remote workers needing deeper communication, cultural integration, and practical daily language.
- **Needs:** Conversational fluency, cultural nuance, workplace language, long-term learning path
- **Langzio Entry Points:** Chat (cultural questions), Translator, Guides, Learning path

### Entity: Heritage Learner
- **Type:** `Audience`, `Person`
- **Canonical Name:** Moroccan Heritage Learner
- **Description:** Person of Moroccan descent with passive/receptive Darija skills seeking to activate speaking, fill gaps, and master register switching.
- **Needs:** Grammar clarification, fossilized error correction, literacy, formal register
- **Langzio Entry Points:** Chat (grammar), Dictionary, Guides (advanced)

---

## ENTITY CANONICALIZATION RULES

### Latin Spelling Convention (Langzio Standard)
| Sound | Langzio Spelling | Variants to Redirect |
|-------|------------------|---------------------|
| ع | 3 | a, aa, e |
| ح | 7 | h, hh |
| ق/غ | 9 | g, gh, q, k |
| خ | 5 | kh, x |
| ط | 6 | t, tt |
| ص | s | ss |
| ض | d | dd |
| ظ | z | zh |
| ء/أ | 2 | a, ', aa |

**Rule:** Canonical term uses most phonetically transparent spelling for English speakers.
- "Salam" not "Ssalam" or "Es-salam"
- "3afak" not "afak" or "aafak" 
- "Shukran" not "Choukran"
- "Bchhal" not "B9al" or "Bqal"
- "Ghaliya" not "Raliya" or "Ghaliya"

**Implementation:** 
- Canonical URL uses Langzio spelling
- `alternateName` includes all variants
- Redirect common variants to canonical (if feasible)
- Internal links always use canonical

---

## ENTITY IMPLEMENTATION CHECKLIST

### For Each Entity Page:
- [ ] Unique canonical URL
- [ ] `Organization` / `Language` / `DefinedTerm` / `SoftwareApplication` / `Course` / `Guide` schema
- [ ] `name`, `alternateName`, `description` properties
- [ ] `url` = canonical URL
- [ ] `sameAs` for external authoritative sources (Wikidata, Ethnologue, etc.)
- [ ] `subjectOf` → Langzio (for content entities)
- [ ] `isPartOf` / `hasPart` relationships
- [ ] BreadcrumbList schema
- [ ] Internal links to related entities
- [ ] Open Graph / Twitter Card with entity-specific image

### For Cross-Entity References:
- [ ] Use `mentions` / `about` / `mainEntity` in parent page schema
- [ ] Anchor text = canonical entity name
- [ ] Link to canonical entity URL
- [ ] Contextual paragraph explaining relationship

---

## EXTERNAL AUTHORITY MAPPING (sameAs targets)

| Entity | Wikidata | Wikipedia | Ethnologue | Glottolog | Other |
|--------|----------|-----------|------------|-----------|-------|
| Moroccan Darija | Q188325 | Moroccan Arabic | ary | mora1285 | |
| Modern Standard Arabic | Q916833 | Modern Standard Arabic | arb | mode1248 | |
| Arabizi | Q4784693 | Arabizi | | | |
| Morocco | Q1028 | Morocco | | | |
| Tamazight | Q56476 | Berber languages | | | |

**Rule:** Only add `sameAs` when confident. Do not guess.

---

## ENTITY RELATIONSHIP MATRIX (Summary)

| From Entity | Relationship | To Entity | Schema Property |
|-------------|--------------|-----------|-----------------|
| Langzio | offers | Langzio Translator | `offers` |
| Langzio | offers | Langzio AI Chat | `offers` |
| Langzio | offers | Smart Guides | `offers` |
| Langzio | offers | 7-Day Kids Challenge | `offers` |
| Langzio | knowsAbout | Moroccan Darija | `knowsAbout` |
| Langzio | hasMethodology | RAG Translation | `hasMethodology` |
| Langzio Translator | groundedIn | Verified Phrase Corpus | `groundedIn` |
| Langzio AI Chat | groundedIn | Verified Phrase Corpus | `groundedIn` |
| Smart Guides | hasPart | Restaurant Guide | `hasPart` |
| Smart Guides | hasPart | Souk Guide | `hasPart` |
| Smart Guides | hasPart | Taxi Guide | `hasPart` |
| Smart Guides | hasPart | Family Guide | `hasPart` |
| Restaurant Guide | hasPart | Salam wach kayn blassa | `hasPart` |
| Verified Phrase | inLanguage | Moroccan Darija | `inLanguage` |
| Verified Phrase | partOf | Guide Category | `isPartOf` |
| Vocabulary Term | partOf | Verified Phrase | `isPartOf` |
| Arabizi | transliterates | Moroccan Darija | `transliterates` |
| Moroccan Darija | influencedBy | French | `influencedBy` |
| Moroccan Darija | influencedBy | Amazigh | `influencedBy` |
| Moroccan Darija | contrastsWith | Modern Standard Arabic | `contrastsWith` |

---

*End of Entity Map*
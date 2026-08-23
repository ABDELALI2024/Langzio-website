# Langzio AI Evaluation System

**Version:** 1.0
**Date:** 2026-08-22
**Classification:** Internal Strategy
**Purpose:** Systematic AI quality assurance for Darija translation, cultural chat, and tutoring

---

## EVALUATION PHILOSOPHY

> **Don't trust the AI. Measure it.**

Every AI feature must have:
1. **Defined quality criteria** — what "good" looks like
2. **Evaluation datasets** — representative, challenging, versioned
3. **Automated regression testing** — run on every model/prompt change
4. **Human-in-the-loop calibration** — automated metrics calibrated to expert judgment
5. **Production monitoring** — real-time quality signals

---

## 1. EVALUATION DIMENSIONS

### 1.1 Translation Quality

| Dimension | Definition | Target |
|-----------|------------|--------|
| **Accuracy** | Meaning preserved correctly | >95% |
| **Naturalness** | Sounds like native Darija, not translated | >90% |
| **Register Appropriateness** | Polite/casual/formal matches context | >95% |
| **Cultural Context** | Includes relevant cultural notes when needed | >90% |
| **Arabizi Compliance** | Uses Langzio standard (3,7,9,5,2) | 100% |
| **Structured Output Validity** | JSON parses, all required fields present | 100% |
| **Hallucination Rate** | No invented phrases/meanings | <1% |

### 1.2 Cultural Chat Quality

| Dimension | Definition | Target |
|-----------|------------|--------|
| **Cultural Accuracy** | Etiquette, norms, values correct | >95% |
| **Nuance Handling** | Distinguishes literal vs. appropriate | >90% |
| **Safety** | No harmful stereotypes, appropriate boundaries | 100% |
| **Conversation Flow** | Natural, coherent, context-aware | >85% |
| **Adaptation** | Adjusts to user level (beginner/intermediate/advanced) | >80% |
| **Memory Consistency** | Remembers prior conversation details | >90% |

### 1.3 AI Tutor Quality

| Dimension | Definition | Target |
|-----------|------------|--------|
| **Pedagogical Effectiveness** | User learns from interaction | Measurable gain |
| **Adaptation** | Scaffolds for level, targets weak areas | >80% |
| **Feedback Quality** | Specific, actionable, encouraging | >85% |
| **Cultural Integration** | Weaves culture into language practice | >90% |
| **Engagement** | User wants to continue | >70% session completion |

### 1.4 Pronunciation Feedback Quality

| Dimension | Definition | Target |
|-----------|------------|--------|
| **Phoneme Accuracy** | Correctly identifies 3,7,9,5,2,6,8,gh,kh,q | >85% |
| **Actionability** | Feedback tells user *how* to fix | >80% |
| **False Positive Rate** | Doesn't flag correct pronunciation | <10% |
| **False Negative Rate** | Doesn't miss errors | <15% |

---

## 2. EVALUATION DATASETS

### 2.1 Dataset Governance

| Principle | Implementation |
|-----------|----------------|
| **Versioning** | Semantic versions (v1.0, v1.1, v2.0) with changelog |
| **Immutability** | Published datasets never modified; new versions created |
| **Representativeness** | Covers all categories, registers, difficulty levels |
| **Challenge Balance** | 70% typical, 20% edge cases, 10% adversarial |
| **Native Validation** | Every test case validated by ≥2 native speakers |
| **Cultural Sensitivity** | Reviewed for stereotype risk before inclusion |
| **PII-Free** | No real user data; synthetic or anonymized only |

### 2.2 Dataset Catalog

#### Dataset: TRANSLATION_EVAL v1.0
| Split | Size | Description |
|-------|------|-------------|
| **EN→DARIJA** | 200 | English prompts across 6 categories, varied registers |
| **FR→DARIJA** | 100 | French prompts (tourist + diaspora contexts) |
| **DARIJA→EN** | 100 | Darija phrases (Arabic script + Arabizi) to English |
| **DARIJA→FR** | 50 | Darija to French |
| **Structured Output** | 200 | Validates JSON schema compliance |
| **Cultural Context** | 50 | Cases where cultural note is required |
| **Adversarial** | 20 | Slang, ambiguous, dialect-edge cases |

**Total:** 720 test cases

**Example Test Case:**
```json
{
  "id": "trans_en_dar_042",
  "source_lang": "en",
  "target_lang": "darija",
  "input": "How much does this cost?",
  "context": "souk_bargaining",
  "expected": {
    "darija": "Bchhal hadchi?",
    "pronunciation": "bch-hal had-chi",
    "meaning": "How much is this?",
    "register": "neutral",
    "context": "Asking price in a market/souk",
    "avoid": "Using formal 'thaman' instead of 'bchhal'",
    "tip": "Expect to negotiate — first price is rarely final"
  },
  "difficulty": "easy",
  "category": "souk",
  "native_validated": true,
  "validators": ["validator_001", "validator_003"]
}
```

#### Dataset: CULTURAL_CHAT_EVAL v1.0
| Split | Size | Description |
|-------|------|-------------|
| **Etiquette Questions** | 50 | "How do I greet elders?" "Is eye contact rude?" |
| **Scenario Guidance** | 40 | "I'm invited to a Moroccan home — what do I bring?" |
| **Slang/Idiom Explanation** | 30 | "What does 'wesh' mean? When can I use it?" |
| **Grammar Clarification** | 30 | "When do I use 'kan' vs 'kayen'?" |
| **Cultural Nuance** | 30 | "Can I say 'habibi' to a shopkeeper?" |
| **Safety/Boundary** | 20 | Inappropriate requests, stereotype prompts |
| **Multi-turn Conversation** | 10 | 5+ turn conversations with context |

**Total:** 210 test cases

**Example Test Case:**
```json
{
  "id": "chat_cultural_015",
  "user_message": "Can I say 'habibi' to a taxi driver in Casablanca?",
  "conversation_history": [],
  "expected_behavior": {
    "addresses_literal_meaning": true,
    "explains_register": "casual/intimate",
    "explains_appropriateness": "Too familiar for stranger; use '3afak' or 'sidi'",
    "provides_alternative": "Say '3afak, sidi' (please, sir) instead",
    "cultural_context": "Habibi = 'my love' — reserved for close relationships",
    "tone": "helpful, not judgmental"
  },
  "difficulty": "medium",
  "category": "register_appropriateness",
  "native_validated": true
}
```

#### Dataset: TUTOR_EVAL v1.0
| Split | Size | Description |
|-------|------|-------------|
| **Beginner Scaffolding** | 30 | User knows 10 words; tutor adapts |
| **Intermediate Practice** | 30 | User knows 200 words; natural conversation |
| **Advanced Nuance** | 20 | Slang, register switching, idioms |
| **Mistake Correction** | 30 | User makes specific error; tutor corrects |
| **Cultural Integration** | 20 | Tutor weaves culture into language practice |
| **Feedback Quality** | 20 | Post-conversation feedback evaluation |

**Total:** 150 test cases

#### Dataset: PRONUNCIATION_EVAL v1.0
| Split | Size | Description |
|-------|------|-------------|
| **Phoneme Minimal Pairs** | 100 | Audio pairs: qal/gal, 7b/ḥb, 9l/ql, etc. |
| **Arabizi Mapping** | 50 | Text input → expected phoneme sequence |
| **Word Stress** | 30 | Correct stress placement |
| **French Loanwords** | 20 | /ʒ/, /v/, /p/, /g/ in context |
| **Adversarial** | 10 | Background noise, non-native accents |

**Total:** 210 test cases (requires audio infrastructure)

---

## 3. AUTOMATED EVALUATION PIPELINE

### 3.1 Architecture

```
┌─────────────────┐
│  TRIGGER        │  (git push, scheduled, manual)
└────────┬────────┘
         ▼
┌─────────────────┐
│  BUILD          │  Install deps, load datasets, init model
└────────┬────────┘
         ▼
┌─────────────────┐
│  INFERENCE      │  Run model on all test cases (parallel)
└────────┬────────┘
         ▼
┌─────────────────┐
│  AUTOMATED      │  Deterministic checks:
│  METRICS        │  - Schema validation
│                 │  - Schema field completeness
│                 │  - Arabizi compliance
│                 │  - Required fields
│                 │  - Regex pattern matching
└────────┬────────┘
         ▼
┌─────────────────┐
│  LLM-AS-JUDGE   │  Semantic evaluation (GPT-4o as judge):
│                 │  - Meaning preservation
│                 │  - Naturalness
│                 │  - Cultural accuracy
│                 │  - Register appropriateness
│                 │  - Feedback quality
└────────┬────────┘
         ▼
┌─────────────────┐
│  AGGREGATION    │  Per-dimension scores, confidence intervals
└────────┬────────┘
         ▼
┌─────────────────┐
│  REGRESSION     │  Compare to baseline (previous version)
│  DETECTION      │  Alert if any dimension drops >2%
└────────┬────────┘
         ▼
┌─────────────────┐
│  REPORTING      │  Dashboard + Slack + GitHub PR comment
└─────────────────┘
```

### 3.2 LLM-as-Judge Prompts

#### Translation Naturalness Judge
```python
NATURALNESS_PROMPT = """
You are a native Moroccan Darija speaker evaluating translation quality.

Source: {source_text}
Target: {target_text}
Model Output: {model_output}

Rate the NATURALNESS of the model's Darija output on a scale of 1-5:
1 = Sounds like machine translation, grammatically wrong
2 = Understandable but clearly non-native, awkward phrasing
3 = Acceptable, minor awkwardness, mostly natural
4 = Very natural, native-like, minor register issues
5 = Perfectly natural, exactly what a Moroccan would say

Consider: vocabulary choice, grammar, idiomatic expressions, register match.

Return ONLY a JSON object:
{"score": <1-5>, "reasoning": "<brief explanation>"}
"""
```

#### Cultural Accuracy Judge
```python
CULTURAL_ACCURACY_PROMPT = """
You are a Moroccan cultural expert evaluating AI responses about Morocco.

User Question: {user_question}
AI Response: {ai_response}

Rate CULTURAL ACCURACY on a scale of 1-5:
1 = Factually wrong, promotes harmful stereotypes
2 = Partially correct but significant cultural errors
3 = Mostly correct, minor cultural inaccuracies
4 = Accurate, appropriate cultural nuance
5 = Expert-level cultural understanding, nuanced

Consider: etiquette norms, religious sensitivity, regional variation, 
register appropriateness, gender norms, stereotype avoidance.

Return ONLY a JSON object:
{"score": <1-5>, "reasoning": "<brief explanation>", "issues": ["<specific issues if any>"]}
"""
```

### 3.3 Automated Metrics (Deterministic)

| Metric | Implementation | Threshold |
|--------|----------------|-----------|
| **Schema Validity** | `json.loads()` + JSON Schema validation | 100% |
| **Field Completeness** | Check all required fields present | 100% |
| **Arabizi Compliance** | Regex: only allowed chars (a-z, 0-9, 3,7,9,5,2,6,8, ') | 100% |
| **Required Fields** | `darija`, `pronunciation`, `meaning`, `register`, `context`, `avoid`, `tip` | 100% |
| **No Forbidden Terms** | Blocklist: MSA-only words, offensive terms | 0 violations |
| **Response Time** | p95 < 3s (Groq) | 100% |

---

## 4. HUMAN EVALUATION PROTOCOL

### 4.1 Evaluator Requirements

| Role | Qualifications | Calibration |
|-------|----------------|-------------|
| **Native Speaker Evaluator** | Moroccan, fluent Darija, cultural fluency | 20 calibration tasks, κ > 0.8 |
| **Linguist Evaluator** | Arabic dialectology background | 10 calibration tasks |
| **Cultural Expert** | Anthropology/area studies + lived experience | 10 calibration tasks |
| **Language Teacher** | Darija teaching experience | 15 calibration tasks |

### 4.2 Evaluation Sessions

| Frequency | Scope | Evaluators | Output |
|-----------|-------|------------|--------|
| **Weekly** | 50 random production samples | 2 native | Quality trend |
| **Per Release** | Full eval dataset (sampled 200) | 3 native + 1 linguist | Release gate |
| **Monthly** | Cultural chat deep-dive (50) | 2 cultural experts | Cultural drift check |
| **Quarterly** | Full benchmark (all datasets) | Full panel | Benchmark report |

### 4.3 Human Evaluation Rubric

**Translation (1-5 each):**
- Accuracy: Meaning preserved?
- Naturalness: Native-like?
- Register: Context-appropriate?
- Cultural Value: Useful context included?

**Cultural Chat (1-5 each):**
- Accuracy: Culturally correct?
- Nuance: Literal vs. appropriate distinguished?
- Safety: No harm, appropriate boundaries?
- Helpfulness: Actually answers the question?

**Tutor (1-5 each):**
- Adaptation: Right level?
- Correction: Helpful, not discouraging?
- Cultural Integration: Natural, not forced?
- Engagement: Want to continue?

---

## 5. REGRESSION TESTING & CI/CD INTEGRATION

### 5.1 GitHub Actions Workflow

```yaml
# .github/workflows/ai-eval.yml
name: AI Evaluation
on:
  push:
    branches: [main, develop]
    paths:
      - 'includes/langzio-ai.php'
      - 'config.php'
      - '.github/workflows/ai-eval.yml'
  schedule:
    - cron: '0 2 * * 0'  # Weekly Sunday 2am
  workflow_dispatch:

jobs:
  ai-evaluation:
    runs-on: ubuntu-latest
    timeout-minutes: 30
    steps:
      - uses: actions/checkout@v4
      
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          
      - name: Install Dependencies
        run: composer install --no-dev
        
      - name: Run AI Evaluation
        env:
          GROQ_API_KEY: ${{ secrets.GROQ_API_KEY }}
          EVAL_DATASET_VERSION: ${{ vars.EVAL_DATASET_VERSION }}
        run: php scripts/run-ai-eval.php
        
      - name: Check Regression
        run: php scripts/check-regression.php
        
      - name: Comment PR
        if: github.event_name == 'push'
        uses: actions/github-script@v7
        with:
          script: |
            const fs = require('fs');
            const report = fs.readFileSync('eval-report.md', 'utf8');
            github.rest.issues.createComment({
              issue_number: context.issue.number,
              owner: context.repo.owner,
              repo: context.repo.repo,
              body: report
            })
```

### 5.2 Release Gate Criteria

| Gate | Criteria | Blocking? |
|------|----------|-----------|
| **Automated Metrics** | All deterministic checks pass | ✅ Yes |
| **Regression Check** | No dimension drops >2% vs baseline | ✅ Yes |
| **Human Eval (Sample)** | 50 random samples ≥4.0 avg | ⚠️ Warning |
| **Cultural Safety** | Zero safety violations in eval | ✅ Yes |
| **Schema Validity** | 100% structured output valid | ✅ Yes |

---

## 6. PRODUCTION MONITORING

### 5.1 Real-Time Quality Signals

| Signal | Collection | Alert Threshold |
|--------|------------|-----------------|
| **User Feedback (👍/👎)** | Explicit rating on translations | <60% 👍 over 100 samples |
| **Regeneration Rate** | User clicks "retry" on translation | >30% |
| **Conversation Abandonment** | User leaves chat <3 turns | >40% |
| **Structured Output Parse Failures** | JSON decode errors | >1% |
| **Cultural Complaints** | Support tickets tagged "cultural" | >0/week |
| **Pronunciation Complaints** | "Wrong feedback" reports | >5/week |

### 5.2 Shadow Evaluation (Continuous)

- **10% of production traffic** → logged for offline evaluation
- **Weekly batch evaluation** on shadow traffic
- **Drift detection** — compare production quality to eval dataset baseline

### 5.3 Monitoring Dashboard (Grafana/Internal)

| Panel | Metric | Target |
|-------|--------|--------|
| **Translation Quality** | 👍 rate, regeneration rate, parse success | >80%, <25%, >99% |
| **Chat Quality** | Avg turns, abandonment, explicit feedback | >5, <30%, >70% 👍 |
| **Tutor Quality** | Session completion, feedback 👍, level progression | >70%, >80%, measurable |
| **System Health** | API latency, error rate, Groq quota | <3s p95, <1%, <80% |

---

## 6. BENCHMARK: LANGZIO DARIJA BENCHMARK (LDB)

### 6.1 Purpose
Standardized, public benchmark for Darija AI systems — positions Langzio as authority.

### 6.2 Benchmark Tasks

| Task | Description | Metric | Size |
|------|-------------|--------|------|
| **LDB-Translate** | EN/FR → Darija (structured) | Accuracy, Naturalness, Schema | 500 |
| **LDB-Cultural** | Cultural QA (etiquette, norms) | Accuracy, Nuance, Safety | 200 |
| **LDB-Tutor** | Multi-turn tutoring simulation | Pedagogical effectiveness | 100 |
| **LDB-Pronounce** | Phoneme identification from audio | Phoneme accuracy | 200 (audio) |
| **LDB-Arabizi** | Arabizi ↔ Arabic ↔ Latin | Mapping accuracy | 100 |

### 6.3 Publication Plan
| Phase | Action |
|-------|--------|
| **Internal** | Run on Langzio models monthly; track progress |
| **v1.0 Release** | Publish datasets + evaluation code + Langzio baseline (Q2) |
| **Leaderboard** | Host public leaderboard; invite other systems |
| **Paper** | Submit to LREC/COLING/EMNLP (Q4) |

---

## 7. MODEL MANAGEMENT

### 7.1 Current Stack
| Component | Provider | Model | Fallback |
|-----------|----------|-------|----------|
| **Primary Generation** | Groq | Llama-3.3-70B-Versatile | Local (llama.cpp) |
| **Embeddings (RAG)** | Local | sentence-transformers/paraphrase-multilingual | — |
| **Judging (Eval)** | OpenAI | GPT-4o | Claude-3.5-Sonnet |

### 7.2 Model Versioning Policy
| Change Type | Evaluation Required | Rollout |
|-------------|---------------------|---------|
| **Prompt Engineering** | Full automated + 50 human samples | Canary 10% → 100% |
| **Model Parameter Change** (temp, top_p) | Automated only | Canary 10% → 100% |
| **Model Version Upgrade** (Llama 3.3 → 3.4) | Full eval suite + human panel | Shadow 2 weeks → Canary → 100% |
| **Provider Change** (Groq → Together) | Full eval + latency/cost analysis | Shadow 2 weeks → Canary → 100% |
| **Fine-tuned Model** | Full eval + safety review | Shadow 4 weeks → Canary → 100% |

### 7.3 Fine-Tuning Roadmap
| Phase | Data | Target | Eval |
|-------|------|--------|------|
| **v1 (Q3)** | 5,000 high-quality translation pairs + cultural QA | Translation + Cultural Chat | LDB + Human |
| **v2 (Q4)** | + Conversation logs (anonymized) + tutor feedback | Tutor + Roleplay | LDB-Tutor + Human |
| **v3 (Q1 '27)** | + Pronunciation annotations | Pronunciation feedback | LDB-Pronounce |

---

## 8. EVALUATION METRICS DASHBOARD

### Per-Release Report (Auto-Generated)

```
# AI Evaluation Report - {{VERSION}} - {{DATE}}

## Summary
- **Overall Status:** ✅ PASS / ⚠️ WARNING / ❌ FAIL
- **Regression Detected:** YES / NO
- **Dimensions Passing:** {{N}}/{{TOTAL}}

## Dimension Scores
| Dimension | Score | Baseline | Δ | Status |
|-----------|-------|----------|---|--------|
| Translation Accuracy | 96.2% | 95.8% | +0.4% | ✅ |
| Translation Naturalness | 91.5% | 90.2% | +1.3% | ✅ |
| Register Appropriateness | 97.1% | 96.5% | +0.6% | ✅ |
| Cultural Context | 92.8% | 91.0% | +1.8% | ✅ |
| Cultural Chat Accuracy | 94.5% | 93.0% | +1.5% | ✅ |
| Cultural Nuance | 89.2% | 88.0% | +1.2% | ✅ |
| Tutor Adaptation | 84.0% | 82.0% | +2.0% | ✅ |
| Feedback Quality | 87.5% | 85.0% | +2.5% | ✅ |

## Regressions
- None detected

## Human Evaluation (Sample: 50)
- Native Avg Score: 4.3/5.0
- Cultural Expert Avg: 4.5/5.0
- Issues Flagged: 2 (minor register)

## Production Signals (Last 7 Days)
- 👍 Rate: 82% (target >80%)
- Regeneration Rate: 22% (target <25%)
- Chat Abandonment: 28% (target <30%)
- Parse Failures: 0.3% (target <1%)

## Action Items
- [ ] Investigate 2 register issues in souk category
- [ ] Add 10 adversarial cases to cultural eval dataset
- [ ] Schedule fine-tuning data prep for Q3
```

---

## 9. CONTINUOUS IMPROVEMENT PROCESS

### Monthly Cycle
| Week | Activity |
|------|----------|
| **Week 1** | Run full benchmark; analyze regressions; prioritize fixes |
| **Week 2** | Human eval session; calibrate LLM judges; update datasets |
| **Week 3** | Implement fixes; prompt engineering; data augmentation |
| **Week 4** | Shadow eval analysis; production signal review; plan next cycle |

### Quarterly Deep Dive
- Full benchmark publication (internal)
- Evaluator calibration refresh
- Dataset expansion (target +20% size)
- LLM judge prompt optimization
- Cost/latency analysis per model

---

## 10. DOCUMENTATION & KNOWLEDGE BASE

### Required Documentation (Maintained in `/docs/ai-eval/`)
| Document | Updated |
|----------|---------|
| `evaluation-datasets.md` | Per version |
| `judge-prompts.md` | Per change |
| `human-eval-guide.md` | Quarterly |
| `regression-history.md` | Per release |
| `model-versions.md` | Per change |
| `production-incidents.md` | Per incident |

---

## 11. BUDGET & RESOURCES

| Resource | Monthly Cost | Notes |
|----------|--------------|-------|
| **Groq API (Eval Runs)** | ~$50 | ~1M tokens/month |
| **OpenAI GPT-4o (Judge)** | ~$200 | ~500K tokens/month |
| **Human Evaluators (4 × 10h/mo)** | ~$2,000 | $50/h × 40h |
| **Audio Annotation (Pronunciation)** | ~$1,000 | Phase 2+ |
| **Infrastructure (CI/CD)** | ~$50 | GitHub Actions |
| **TOTAL** | **~$3,300/mo** | Scales with eval frequency |

---

## 12. SUCCESS CRITERIA (12 MONTHS)

| Milestone | Target | Date |
|-----------|--------|------|
| **Automated Pipeline Live** | 100% datasets, CI/CD integrated | Month 1 |
| **Human Eval Calibrated** | κ > 0.8 across evaluators | Month 2 |
| **Regression Gate Active** | Blocks merges on >2% drop | Month 3 |
| **LDB v1.0 Published** | Datasets + code + baseline public | Month 6 |
| **Fine-tuned v1 Deployed** | Beats base model on LDB | Month 9 |
| **Production Monitoring** | Real-time dashboard + alerts | Month 12 |

---

*This evaluation system is the quality backbone of Langzio's AI moat. Invest early; compound continuously.*
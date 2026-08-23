document.addEventListener("DOMContentLoaded", () => {
    initReferral();
    initOnboarding();
    initPwa();
    initWaitlist();
    initDashboard();
    initTranslator();
    initChat();
    initKidsMode();
    initGuides();
    trackEvent("page_view", { page: window.location.pathname });
});

function langzioBase() {
    return window.LANGZIO_BASE || "";
}

async function trackEvent(event, meta = {}) {
    try {
        await fetch(`${langzioBase()}/track.php`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ event, page: window.location.pathname, meta })
        });
    } catch (e) {
        /* analytics should never block UX */
    }
}

function bumpStat(key, amount = 1) {
    const stats = readStats();
    stats[key] = (stats[key] || 0) + amount;
    localStorage.setItem("langzio_stats", JSON.stringify(stats));
}

function readStats() {
    try {
        const parsed = JSON.parse(localStorage.getItem("langzio_stats") || "{}");
        return typeof parsed === "object" && parsed ? parsed : {};
    } catch (e) {
        return {};
    }
}

const CHALLENGE_DAILY_GOAL = 5;
const CHALLENGE_LENGTH = 7;

function todayKey() {
    return new Date().toISOString().slice(0, 10);
}

function getPersona() {
    return localStorage.getItem("langzio_persona") || "";
}

function getShareLink() {
    const ref = localStorage.getItem("langzio_ref") || "family";
    return `${window.location.origin}${langzioBase()}/kids.php?ref=${ref}&challenge=1`;
}

function shareOnWhatsApp(message) {
    window.open(`https://wa.me/?text=${encodeURIComponent(message)}`, "_blank", "noopener");
}

function initReferral() {
    const params = new URLSearchParams(window.location.search);
    const ref = params.get("ref");
    if (ref) {
        localStorage.setItem("langzio_ref", ref.slice(0, 40));
        trackEvent("referral_land", { ref });
    }
    if (params.get("challenge") === "1") {
        startFamilyChallenge();
    }
}

function startFamilyChallenge() {
    if (!localStorage.getItem("langzio_challenge_start")) {
        localStorage.setItem("langzio_challenge_start", todayKey());
        trackEvent("challenge_start");
    }
}

function getChallengeCompletedDays() {
    try {
        const parsed = JSON.parse(localStorage.getItem("langzio_challenge_completed") || "[]");
        return Array.isArray(parsed) ? parsed : [];
    } catch (e) {
        return [];
    }
}

function getTodayChallengeCount() {
    const day = localStorage.getItem("langzio_challenge_today_date");
    if (day !== todayKey()) return 0;
    return parseInt(localStorage.getItem("langzio_challenge_today_count") || "0", 10);
}

function bumpChallengeProgress() {
    startFamilyChallenge();
    const today = todayKey();
    let count = getTodayChallengeCount();
    count += 1;
    localStorage.setItem("langzio_challenge_today_count", String(count));
    localStorage.setItem("langzio_challenge_today_date", today);

    if (count >= CHALLENGE_DAILY_GOAL) {
        const completed = getChallengeCompletedDays();
        if (!completed.includes(today)) {
            completed.push(today);
            localStorage.setItem("langzio_challenge_completed", JSON.stringify(completed));
            trackEvent("challenge_day_complete", { day: completed.length });
        }
    }
    renderChallengeUi();
}

function renderChallengeUi() {
    const daysEl = document.getElementById("challengeDays");
    const barFill = document.getElementById("challengeBarFill");
    const todayEl = document.getElementById("challengeToday");
    const statusEl = document.getElementById("challengeStatus");
    const badgeEl = document.getElementById("challengeBadge");
    if (!daysEl) return;

    const completed = getChallengeCompletedDays();
    const todayCount = getTodayChallengeCount();
    const start = localStorage.getItem("langzio_challenge_start");

    daysEl.innerHTML = "";
    for (let i = 1; i <= CHALLENGE_LENGTH; i += 1) {
        const dot = document.createElement("span");
        dot.className = "challenge-day";
        dot.textContent = String(i);
        if (i <= completed.length) dot.classList.add("done");
        else if (i === completed.length + 1 && todayCount > 0) dot.classList.add("active");
        daysEl.appendChild(dot);
    }

    if (barFill) {
        const pct = Math.min(100, (todayCount / CHALLENGE_DAILY_GOAL) * 100);
        barFill.style.width = `${pct}%`;
    }
    if (todayEl) {
        todayEl.textContent = `Today: ${todayCount} / ${CHALLENGE_DAILY_GOAL} words`;
    }
    if (statusEl && start) {
        statusEl.textContent = `Day ${Math.min(completed.length + 1, CHALLENGE_LENGTH)} of ${CHALLENGE_LENGTH} — keep your family streak alive.`;
    }
    if (badgeEl) {
        if (completed.length >= CHALLENGE_LENGTH) {
            badgeEl.textContent = "🏆 Darija Champion";
            badgeEl.classList.remove("hidden");
        } else if (completed.length >= 3) {
            badgeEl.textContent = "🔥 On fire";
            badgeEl.classList.remove("hidden");
        } else {
            badgeEl.classList.add("hidden");
        }
    }
}

function initOnboarding() {
    const modal = document.getElementById("onboardingModal");
    if (!modal || getPersona()) return;

    const appPages = ["dashboard.php", "translator.php", "chat.php", "guides.php", "kids.php"];
    const onAppPage = appPages.some((page) => window.location.pathname.endsWith(page));
    if (!onAppPage) return;

    modal.classList.remove("hidden");
    modal.querySelectorAll(".onboarding-option").forEach((btn) => {
        btn.addEventListener("click", () => {
            const persona = btn.dataset.persona || "both";
            localStorage.setItem("langzio_persona", persona);
            modal.classList.add("hidden");
            trackEvent("onboarding_complete", { persona });
            if (persona === "diaspora" || persona === "both") {
                startFamilyChallenge();
                if (!window.location.pathname.endsWith("kids.php")) {
                    window.location.href = `${langzioBase()}/kids.php?challenge=1`;
                }
            }
        });
    });
}

function initPwa() {
    if ("serviceWorker" in navigator) {
        navigator.serviceWorker.register(`${langzioBase()}/sw.js`).catch(() => {});
    }

    window.addEventListener("beforeinstallprompt", (event) => {
        event.preventDefault();
        window.deferredPrompt = event;
    });

    document.querySelectorAll("#installAppBtn").forEach((btn) => {
        btn.addEventListener("click", async () => {
            if (window.deferredPrompt) {
                window.deferredPrompt.prompt();
                await window.deferredPrompt.userChoice;
                window.deferredPrompt = null;
                trackEvent("pwa_install");
                return;
            }
            alert("To install: open browser menu → Add to Home Screen.");
        });
    });
}

function initWaitlist() {
    const form = document.getElementById("waitlistForm");
    if (!form) return;

    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        const emailInput = document.getElementById("waitlistEmail");
        const feedback = document.getElementById("waitlistFeedback");
        const email = emailInput ? emailInput.value.trim() : "";
        if (!email) return;

        await trackEvent("waitlist_join", { email_domain: email.split("@")[1] || "" });
        await fetch(`${langzioBase()}/track.php`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ event: "waitlist_join", email, page: window.location.pathname })
        }).catch(() => {});

        if (feedback) {
            feedback.textContent = "You're on the list. Shukran — we'll be in touch.";
            feedback.classList.remove("hidden");
        }
        form.reset();
    });
}

function initDashboard() {
    const statTranslations = document.getElementById("statTranslations");
    if (!statTranslations) return;

    const stats = readStats();
    const favorites = JSON.parse(localStorage.getItem("langzio_guide_favorites") || "[]");
    const streak = parseInt(localStorage.getItem("langzio_kids_streak") || "0", 10);
    const learned = parseInt(localStorage.getItem("langzio_kids_learned") || "0", 10);
    const persona = getPersona();
    const completed = getChallengeCompletedDays();
    const todayCount = getTodayChallengeCount();

    document.getElementById("statTranslations").textContent = stats.translations || 0;
    document.getElementById("statChats").textContent = stats.chats || 0;
    document.getElementById("statFavorites").textContent = Array.isArray(favorites) ? favorites.length : 0;
    document.getElementById("statStreak").textContent = `${streak} day${streak === 1 ? "" : "s"}`;

    const greeting = document.getElementById("dashboardGreeting");
    if (greeting) {
        greeting.textContent = persona === "diaspora"
            ? "Marhaba, family 👋"
            : persona === "traveler"
                ? "Ready for Morocco?"
                : "Your progress";
    }

    const banner = document.getElementById("familyBanner");
    const bannerText = document.getElementById("familyBannerText");
    if (banner && (persona === "diaspora" || persona === "both" || localStorage.getItem("langzio_challenge_start"))) {
        banner.classList.remove("hidden");
        if (bannerText) {
            if (completed.length >= CHALLENGE_LENGTH) {
                bannerText.textContent = "Challenge complete! Your kids finished 7 days of Darija. Bzaf mzyan!";
            } else {
                bannerText.textContent = `Day ${completed.length + 1} of 7 — ${todayCount}/${CHALLENGE_DAILY_GOAL} words done today.`;
            }
        }
    }

    const tip = document.getElementById("dashboardTip");
    const primaryCta = document.getElementById("dashboardPrimaryCta");
    const secondaryCta = document.getElementById("dashboardSecondaryCta");
    const actionTitle = document.getElementById("dashboardActionTitle");
    const inviteBtn = document.getElementById("inviteFamilyBtn");

    if (persona === "diaspora" || persona === "both") {
        if (actionTitle) actionTitle.textContent = "Family practice";
        if (tip) {
            tip.textContent = todayCount >= CHALLENGE_DAILY_GOAL
                ? "Today's goal done! Come back tomorrow to keep the 7-day challenge alive."
                : `Kids need ${CHALLENGE_DAILY_GOAL - todayCount} more word(s) today to complete the daily goal.`;
        }
        if (primaryCta) {
            primaryCta.href = "kids.php";
            primaryCta.textContent = "Continue challenge";
        }
        if (secondaryCta) {
            secondaryCta.href = "guides.php";
            secondaryCta.textContent = "Family phrases";
        }
        if (inviteBtn) {
            inviteBtn.classList.remove("hidden");
            inviteBtn.addEventListener("click", () => {
                shareOnWhatsApp(`Join our family Darija challenge on Langzio 🇲🇦\n${getShareLink()}`);
                trackEvent("family_invite");
            });
        }
    } else if (tip) {
        if (streak > 0) {
            tip.textContent = `Kids streak active (${streak} days). Keep it going with one flashcard today.`;
        } else if ((stats.translations || 0) === 0) {
            tip.textContent = "Start with: \"How do I politely ask for the bill?\"";
        } else {
            tip.textContent = `${learned} words practiced. You're building real Darija muscle memory.`;
        }
    }
}

async function postToApi(payload) {
    const response = await fetch(`${langzioBase()}/api.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
    });
    const data = await response.json();
    if (!response.ok) {
        throw new Error(data.error || "Request failed");
    }
    return data;
}

function renderStructuredOutput(container, structured) {
    if (!container || !structured) return;
    const fields = [
        ["Darija", structured.darija],
        ["Say it", structured.pronunciation],
        ["Meaning", structured.meaning],
        ["Tone", structured.register],
        ["When", structured.context],
        ["Avoid", structured.avoid],
        ["Tip", structured.tip]
    ].filter(([, value]) => value);

    container.innerHTML = fields.map(([label, value]) =>
        `<div class="structured-row"><span>${label}</span><strong>${escapeHtml(String(value))}</strong></div>`
    ).join("");
    container.classList.remove("hidden");
}

function escapeHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;");
}

function initTranslator() {
    const input = document.getElementById("translatorInput");
    const output = document.getElementById("translatorOutput");
    const structuredEl = document.getElementById("structuredOutput");
    const button = document.getElementById("translateBtn");
    const loading = document.getElementById("translatorLoading");
    const sourceLang = document.getElementById("sourceLang");
    const targetLang = document.getElementById("targetLang");
    const swapBtn = document.getElementById("swapLang");

    if (!input || !output || !button || !loading || !sourceLang || !targetLang || !swapBtn) return;

    swapBtn.addEventListener("click", () => {
        const temp = sourceLang.value;
        sourceLang.value = targetLang.value;
        targetLang.value = temp;
    });

    button.addEventListener("click", async () => {
        const text = input.value.trim();
        if (!text) return;

        loading.classList.remove("hidden");
        button.disabled = true;
        output.value = "";
        if (structuredEl) {
            structuredEl.innerHTML = "";
            structuredEl.classList.add("hidden");
        }

        try {
            const data = await postToApi({
                mode: "translate",
                text,
                source: sourceLang.value,
                target: targetLang.value
            });
            output.value = data.reply || "No translation received.";
            if (data.structured && structuredEl) {
                renderStructuredOutput(structuredEl, data.structured);
                output.classList.add("hidden");
            } else {
                output.classList.remove("hidden");
            }
            if (!data.mock) {
                bumpStat("translations");
                trackEvent("translate", { source: sourceLang.value, target: targetLang.value, rag: !!data.rag_used });
            }
        } catch (error) {
            output.classList.remove("hidden");
            output.value = "Error: " + (error.message || "Request failed");
        } finally {
            loading.classList.add("hidden");
            button.disabled = false;
        }
    });
}

function initChat() {
    const chatMessages = document.getElementById("chatMessages");
    const chatInput = document.getElementById("chatInput");
    const sendBtn = document.getElementById("sendChatBtn");
    const typing = document.getElementById("chatTyping");
    const clearBtn = document.getElementById("clearChatBtn");
    const storageKey = "langzio_chat_history";

    if (!chatMessages || !chatInput || !sendBtn || !typing) return;

    const saved = localStorage.getItem(storageKey);
    if (saved) {
        try {
            const messages = JSON.parse(saved);
            messages.forEach((msg) => addMessage(chatMessages, msg.text, msg.role));
        } catch (e) {
            localStorage.removeItem(storageKey);
        }
    }

    const getHistoryForApi = () => {
        return Array.from(chatMessages.querySelectorAll(".message"))
            .slice(-10)
            .map((el) => ({
                role: el.classList.contains("user") ? "user" : "assistant",
                content: el.textContent || ""
            }));
    };

    const persistMessages = () => {
        const list = Array.from(chatMessages.querySelectorAll(".message")).map((el) => ({
            role: el.classList.contains("user") ? "user" : "ai",
            text: el.textContent || ""
        }));
        localStorage.setItem(storageKey, JSON.stringify(list));
    };

    const sendChat = async () => {
        const text = chatInput.value.trim();
        if (!text) return;

        addMessage(chatMessages, text, "user");
        chatInput.value = "";
        persistMessages();
        typing.classList.remove("hidden");
        sendBtn.disabled = true;

        const history = getHistoryForApi().slice(0, -1);

        try {
            const data = await postToApi({ mode: "chat", text, history });
            addMessage(chatMessages, data.reply || "I could not answer that right now.", "ai");
            if (!data.mock) {
                bumpStat("chats");
                trackEvent("chat", { rag: !!data.rag_used });
            }
        } catch (error) {
            addMessage(chatMessages, "Error: " + (error.message || "Request failed"), "ai");
        } finally {
            typing.classList.add("hidden");
            sendBtn.disabled = false;
            persistMessages();
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    };

    sendBtn.addEventListener("click", sendChat);
    chatInput.addEventListener("keydown", (event) => {
        if (event.key === "Enter") sendChat();
    });

    if (clearBtn) {
        clearBtn.addEventListener("click", () => {
            chatMessages.innerHTML = '<div class="message ai">Salam! I can help you with Darija phrases and Moroccan social etiquette.</div>';
            localStorage.removeItem(storageKey);
        });
    }
}

function addMessage(container, text, role) {
    const item = document.createElement("div");
    item.className = "message " + role;
    item.textContent = text;
    container.appendChild(item);
}

function initKidsMode() {
    const flashcard = document.getElementById("flashcardWord");
    const nextBtn = document.getElementById("nextFlashcardBtn");
    const speakBtn = document.getElementById("speakWordBtn");
    const shareBtn = document.getElementById("shareWordBtn");
    const streakEl = document.getElementById("kidsStreak");
    const learnedEl = document.getElementById("kidsLearned");
    if (!flashcard || !nextBtn || !speakBtn) return;

    startFamilyChallenge();
    renderChallengeUi();

    const cards = [
        { darija: "Salam", english: "Hello" },
        { darija: "Labas?", english: "How are you?" },
        { darija: "Shukran", english: "Thank you" },
        { darija: "Bslama", english: "Goodbye" },
        { darija: "Mzyan", english: "Good" },
        { darija: "3afak", english: "Please" },
        { darija: "Wakha", english: "OK / agreed" },
        { darija: "Ma3lich", english: "No problem" },
        { darija: "Bghit nmshi", english: "I want to go" },
        { darija: "Fin kayn...?", english: "Where is...?" },
        { darija: "Bchhal hadchi?", english: "How much is this?" },
        { darija: "Labas 3likom?", english: "How are you all?" },
        { darija: "Shukran bzzaf", english: "Thank you very much" },
        { darija: "Allah ykhalik", english: "May God protect you" },
        { darija: "Safi", english: "Enough / done" },
        { darija: "Mtsharfin b ziyartkom", english: "Honored by your visit" },
        { darija: "Bghit nmshi l medina", english: "I want to go to the medina" },
        { darija: "Wach kayn wifi?", english: "Is there WiFi?" },
        { darija: "Ghaliya chwiya", english: "It's a bit expensive" },
        { darija: "Safi, ntafa9na", english: "Deal!" }
    ];

    let index = 0;
    const seenKey = "langzio_kids_seen";
    const streakKey = "langzio_kids_streak";
    const lastDayKey = "langzio_kids_last_day";
    const learnedKey = "langzio_kids_learned";

    let streak = parseInt(localStorage.getItem(streakKey) || "0", 10);
    let learned = parseInt(localStorage.getItem(learnedKey) || "0", 10);
    let seen = new Set(JSON.parse(localStorage.getItem(seenKey) || "[]"));

    function updateKidsStats() {
        if (streakEl) streakEl.textContent = String(streak);
        if (learnedEl) learnedEl.textContent = String(learned);
    }

    function markDailyPractice() {
        const today = todayKey();
        const lastDay = localStorage.getItem(lastDayKey);
        if (lastDay === today) return;
        if (lastDay) {
            const yesterday = new Date();
            yesterday.setDate(yesterday.getDate() - 1);
            const y = yesterday.toISOString().slice(0, 10);
            streak = lastDay === y ? streak + 1 : 1;
        } else {
            streak = 1;
        }
        localStorage.setItem(streakKey, String(streak));
        localStorage.setItem(lastDayKey, today);
        updateKidsStats();
        trackEvent("kids_streak", { streak });
    }

    function showCard(i) {
        const card = cards[i];
        flashcard.textContent = `${card.darija} = ${card.english}`;
    }

    showCard(index);
    updateKidsStats();

    nextBtn.addEventListener("click", () => {
        markDailyPractice();
        bumpChallengeProgress();
        const card = cards[index];
        if (!seen.has(card.darija)) {
            seen.add(card.darija);
            learned = seen.size;
            localStorage.setItem(seenKey, JSON.stringify([...seen]));
            localStorage.setItem(learnedKey, String(learned));
        }

        index = (index + 1) % cards.length;
        flashcard.classList.add("flip");
        setTimeout(() => {
            showCard(index);
            flashcard.classList.remove("flip");
            updateKidsStats();
        }, 180);
        trackEvent("kids_card");
    });

    speakBtn.addEventListener("click", () => {
        if (!("speechSynthesis" in window)) return;
        const darija = cards[index].darija;
        const utterance = new SpeechSynthesisUtterance(darija);
        utterance.rate = 0.9;
        speechSynthesis.speak(utterance);
    });

    if (shareBtn) {
        shareBtn.addEventListener("click", () => {
            const card = cards[index];
            shareOnWhatsApp(`Today we learned Darija on Langzio 🇲🇦\n${card.darija} = ${card.english}\nJoin us: ${getShareLink()}`);
            trackEvent("kids_share");
        });
    }
}

function initGuides() {
    const searchInput = document.getElementById("guidesSearch");
    const feedback = document.getElementById("guidesFeedback");
    const favoritesList = document.getElementById("favoritePhrases");
    const phraseItems = Array.from(document.querySelectorAll(".guide-section li"));
    const guideCards = Array.from(document.querySelectorAll(".guide-card"));
    const favoritesKey = "langzio_guide_favorites";

    if (!searchInput || !feedback || !favoritesList || phraseItems.length === 0 || guideCards.length === 0) return;

    let favorites = readFavorites().filter((item) => typeof item === "object" && item && typeof item.phrase === "string");

    phraseItems.forEach((item) => {
        const strong = item.querySelector("strong");
        const phrase = (strong ? strong.textContent : "").trim();
        const fullText = (item.textContent || "").replace(/\s+/g, " ").trim();
        const meaning = fullText.replace(phrase, "").replace(/^-/, "").trim();
        const phraseId = toSlug(phrase);

        item.dataset.phrase = normalizeText(phrase);
        item.dataset.meaning = normalizeText(meaning);
        item.dataset.phraseId = phraseId;

        const actions = document.createElement("span");
        actions.className = "phrase-actions";

        const copyBtn = document.createElement("button");
        copyBtn.className = "phrase-btn";
        copyBtn.type = "button";
        copyBtn.textContent = "Copy";
        copyBtn.addEventListener("click", async () => {
            try {
                await copyText(`${phrase} - ${meaning}`);
                feedback.textContent = `Copied: ${phrase}`;
                trackEvent("guide_copy");
            } catch (error) {
                feedback.textContent = "Copy failed on this browser.";
            }
        });

        const favoriteBtn = document.createElement("button");
        favoriteBtn.className = "phrase-btn favorite-btn";
        favoriteBtn.type = "button";
        favoriteBtn.textContent = hasFavorite(phraseId) ? "Saved" : "Save";
        favoriteBtn.addEventListener("click", () => {
            favorites = toggleFavorite(favorites, { id: phraseId, phrase, meaning });
            favoriteBtn.textContent = hasFavorite(phraseId) ? "Saved" : "Save";
            favoriteBtn.classList.toggle("is-saved", hasFavorite(phraseId));
            localStorage.setItem(favoritesKey, JSON.stringify(favorites));
            renderFavorites();
            trackEvent("guide_save");
        });
        favoriteBtn.classList.toggle("is-saved", hasFavorite(phraseId));

        actions.appendChild(copyBtn);
        actions.appendChild(favoriteBtn);
        item.appendChild(actions);
    });

    searchInput.addEventListener("input", () => {
        const query = normalizeText(searchInput.value.trim());
        let visibleCount = 0;

        phraseItems.forEach((item) => {
            const inPhrase = item.dataset.phrase.includes(query);
            const inMeaning = item.dataset.meaning.includes(query);
            const show = query === "" || inPhrase || inMeaning;
            item.classList.toggle("hidden", !show);
            if (show) visibleCount += 1;
        });

        guideCards.forEach((card) => {
            const hasVisiblePhrase = Array.from(card.querySelectorAll(".guide-section li"))
                .some((li) => !li.classList.contains("hidden"));
            card.classList.toggle("hidden", !hasVisiblePhrase);
        });

        feedback.textContent = query === ""
            ? "Browse all phrase packs."
            : `${visibleCount} phrase(s) match "${searchInput.value.trim()}".`;
    });

    renderFavorites();

    function renderFavorites() {
        favoritesList.innerHTML = "";
        if (favorites.length === 0) {
            favoritesList.innerHTML = "<li>No favorites yet. Click Save on a phrase.</li>";
            return;
        }

        favorites.forEach((favorite) => {
            const item = document.createElement("li");
            item.className = "favorite-item";

            const text = document.createElement("span");
            text.className = "favorite-text";
            text.textContent = `${favorite.phrase} - ${favorite.meaning}`;

            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.className = "favorite-remove";
            removeBtn.textContent = "Remove";
            removeBtn.addEventListener("click", () => {
                favorites = favorites.filter((entry) => entry.id !== favorite.id);
                localStorage.setItem(favoritesKey, JSON.stringify(favorites));
                syncFavoriteButtons();
                renderFavorites();
            });

            item.appendChild(text);
            item.appendChild(removeBtn);
            favoritesList.appendChild(item);
        });
    }

    function readFavorites() {
        const raw = localStorage.getItem(favoritesKey);
        if (!raw) return [];
        try {
            const parsed = JSON.parse(raw);
            return Array.isArray(parsed) ? parsed : [];
        } catch (error) {
            return [];
        }
    }

    function toggleFavorite(current, favorite) {
        if (current.some((item) => item.id === favorite.id)) {
            return current.filter((item) => item.id !== favorite.id);
        }
        return [...current, favorite];
    }

    function hasFavorite(id) {
        return favorites.some((item) => item.id === id);
    }

    function syncFavoriteButtons() {
        const buttons = Array.from(document.querySelectorAll(".favorite-btn"));
        buttons.forEach((button) => {
            const li = button.closest("li");
            const id = li ? li.dataset.phraseId : "";
            const saved = hasFavorite(id);
            button.textContent = saved ? "Saved" : "Save";
            button.classList.toggle("is-saved", saved);
        });
    }

    function normalizeText(value) {
        return value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }

    function toSlug(value) {
        return value.toLowerCase().replace(/[^a-z0-9]+/g, "-").replace(/^-+|-+$/g, "");
    }

    async function copyText(text) {
        if (navigator.clipboard && typeof navigator.clipboard.writeText === "function") {
            await navigator.clipboard.writeText(text);
            return;
        }

        const temp = document.createElement("textarea");
        temp.value = text;
        temp.setAttribute("readonly", "");
        temp.style.position = "absolute";
        temp.style.left = "-9999px";
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        document.body.removeChild(temp);
    }
}

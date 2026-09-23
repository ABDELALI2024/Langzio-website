/* Langzio voice helpers — speech output (TTS) + speech input (dictation).
   Uses the browser Web Speech API only: no backend, no keys, no cost.
   All controls hide gracefully when the browser lacks support.
   Auto-initializes on DOMContentLoaded; safe to load on any page. */

document.addEventListener("DOMContentLoaded", () => {
    initLangzioVoice();
});

function langzioSpeak(text) {
    if (!("speechSynthesis" in window)) return false;
    const clean = (text || "").trim();
    if (clean === "") return false;
    try {
        window.speechSynthesis.cancel();
        const utterance = new SpeechSynthesisUtterance(clean);
        utterance.lang = "en-US";
        utterance.rate = 0.95;
        const voices = window.speechSynthesis.getVoices();
        const english = voices.find((v) => (v.lang || "").toLowerCase().startsWith("en"));
        if (english) utterance.voice = english;
        window.speechSynthesis.speak(utterance);
        return true;
    } catch (e) {
        return false;
    }
}

function langzioListen(input, btn) {
    const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SR || !input) return;
    if (btn && btn.dataset.listening === "1") return;
    let recog = null;
    try {
        recog = new SR();
    } catch (e) {
        return;
    }
    recog.lang = "en-US";
    recog.interimResults = false;
    recog.maxAlternatives = 1;
    if (btn) {
        btn.dataset.listening = "1";
        btn.classList.add("is-recording");
        btn.setAttribute("aria-pressed", "true");
    }
    recog.onresult = (event) => {
        const transcript = event.results && event.results[0] && event.results[0][0]
            ? event.results[0][0].transcript
            : "";
        if (transcript) {
            input.value = transcript;
            input.dispatchEvent(new Event("input", { bubbles: true }));
            input.focus();
        }
    };
    const reset = () => {
        if (btn) {
            delete btn.dataset.listening;
            btn.classList.remove("is-recording");
            btn.setAttribute("aria-pressed", "false");
        }
    };
    recog.onend = reset;
    recog.onerror = reset;
    try {
        recog.start();
    } catch (e) {
        reset();
    }
}

function initLangzioVoice() {
    const canSpeak = "speechSynthesis" in window;
    const canListen = !!(window.SpeechRecognition || window.webkitSpeechRecognition);

    // Translator: mic fills the input, Listen reads the result.
    const tInput = document.getElementById("translatorInput");
    const tOutput = document.getElementById("translatorOutput");
    const micBtn = document.getElementById("micInputBtn");
    const speakBtn = document.getElementById("speakResultBtn");
    if (micBtn) {
        if (!canListen || !tInput) {
            micBtn.classList.add("hidden");
        } else {
            micBtn.addEventListener("click", () => langzioListen(tInput, micBtn));
        }
    }
    if (speakBtn) {
        if (!canSpeak) {
            speakBtn.classList.add("hidden");
        } else {
            speakBtn.addEventListener("click", () => {
                const structured = document.getElementById("structuredOutput");
                let text = "";
                if (structured && !structured.classList.contains("hidden")) {
                    const first = structured.querySelector(".structured-row strong");
                    text = first ? first.textContent || "" : structured.textContent || "";
                }
                if (!text && tOutput) text = tOutput.value || "";
                langzioSpeak(text);
            });
        }
    }

    // Chat: mic fills the message input.
    const chatInput = document.getElementById("chatInput");
    const chatMic = document.getElementById("chatMicBtn");
    if (chatMic) {
        if (!canListen || !chatInput) {
            chatMic.classList.add("hidden");
        } else {
            chatMic.addEventListener("click", () => langzioListen(chatInput, chatMic));
        }
    }

    // Guides: a Listen button on every phrase (reads the Darija text).
    if (canSpeak) {
        document.querySelectorAll(".guide-section li").forEach((item) => {
            if (item.querySelector(".speak-phrase-btn")) return;
            const strong = item.querySelector("strong");
            const phrase = (strong ? strong.textContent : "").trim();
            if (phrase === "") return;
            const btn = document.createElement("button");
            btn.className = "phrase-btn speak-phrase-btn";
            btn.type = "button";
            btn.textContent = "Listen";
            btn.setAttribute("aria-label", "Listen to pronunciation: " + phrase);
            btn.addEventListener("click", () => langzioSpeak(phrase));
            const actions = item.querySelector(".phrase-actions");
            if (actions) {
                actions.appendChild(btn);
            } else {
                item.appendChild(btn);
            }
        });
    }
}

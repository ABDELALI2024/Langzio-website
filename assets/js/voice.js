/* Langzio voice input (dictation) — English only.
   Uses the browser Web Speech API only: no backend, no keys, no cost.
   No voice output: Darija is never vocalized.
   Mic controls hide gracefully when the browser lacks support.
   Auto-initializes on DOMContentLoaded; safe to load on any page. */

document.addEventListener("DOMContentLoaded", () => {
    initLangzioVoice();
});

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
    const canListen = !!(window.SpeechRecognition || window.webkitSpeechRecognition);

    // Translator: mic dictates English input.
    const tInput = document.getElementById("translatorInput");
    const micBtn = document.getElementById("micInputBtn");
    if (micBtn) {
        if (!canListen || !tInput) {
            micBtn.classList.add("hidden");
        } else {
            micBtn.addEventListener("click", () => langzioListen(tInput, micBtn));
        }
    }

    // Chat: mic dictates the English message.
    const chatInput = document.getElementById("chatInput");
    const chatMic = document.getElementById("chatMicBtn");
    if (chatMic) {
        if (!canListen || !chatInput) {
            chatMic.classList.add("hidden");
        } else {
            chatMic.addEventListener("click", () => langzioListen(chatInput, chatMic));
        }
    }
}

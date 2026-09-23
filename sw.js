const CACHE = "langzio-v4";
const OFFLINE_ASSETS = [
    "./",
    "./index.php",
    "./dashboard.php",
    "./translator.php",
    "./chat.php",
    "./guides.php",
    "./kids.php",
    "./blog.php",
    "./pricing.php",
    "./profile.php",
    "./manifest.php",
    "./assets/css/style.css",
    "./assets/js/app.js",
    "./assets/js/voice.js",
    "./assets/icon.svg",
    "./assets/offline-phrases.json",
    "./assets/icons/icon-48.png",
    "./assets/icons/icon-72.png",
    "./assets/icons/icon-96.png",
    "./assets/icons/icon-128.png",
    "./assets/icons/icon-144.png",
    "./assets/icons/icon-152.png",
    "./assets/icons/icon-192.png",
    "./assets/icons/icon-384.png",
    "./assets/icons/icon-512.png"
];

self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open(CACHE).then((cache) => cache.addAll(OFFLINE_ASSETS)).then(() => self.skipWaiting())
    );
});

self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches.keys().then((keys) =>
            Promise.all(keys.filter((k) => k !== CACHE).map((k) => caches.delete(k)))
        ).then(() => self.clients.claim())
    );
});

self.addEventListener("fetch", (event) => {
    if (event.request.method !== "GET") return;
    const url = new URL(event.request.url);
    if (url.origin !== self.location.origin) return;

    event.respondWith(
        caches.match(event.request).then((cached) => {
            if (cached) return cached;
            return fetch(event.request).then((response) => {
                if (!response || response.status !== 200 || response.type !== "basic") {
                    return response;
                }
                const clone = response.clone();
                caches.open(CACHE).then((cache) => cache.put(event.request, clone));
                return response;
            }).catch(() => {
                if (url.pathname.includes(".php") && !url.pathname.includes("api/") && !url.pathname.includes("cron/")) {
                    return caches.match("./index.php");
                }
                return caches.match(event.request);
            });
        })
    );
});

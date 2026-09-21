# Langzio — Hostinger Deployment Guide (PHP 8.1+ / Apache / MySQL)

> Stack stays **PHP + Apache + MySQL**. No Node.js, no Vercel, no build step.
> No real secrets in this file — fill them only in the server `.env`.

## 1. Create website
hPanel → Websites → Add website → domain `langzio.com` → document root `public_html/`.

## 2. Select PHP
Websites → PHP Configuration → **PHP 8.1+** (8.2 recommended).
Required extensions: `pdo`, `pdo_mysql`, `curl`, `mbstring`, `json`, `openssl`.

## 3. Configure domain
Domains → `langzio.com` → point A-record to Hostinger. Force HTTPS ON.
Canonical is `https://langzio.com` (see `.htaccess` redirect + `CANONICAL_DOMAIN`).

## 4. Upload / deploy Git repository
Option A (Git): Websites → Git → repo `ABDELALI2024/Langzio-website`, branch `master`, deploy path `public_html/`.
Option B (manual): upload all files **except** `.git/`, `.env`, `*.zip` to `public_html/`.
Verify `.env` and `langzio_hostinger.zip` are NOT in the repo (`git ls-files` must not list them).

## 5. Create MySQL database
Databases → MySQL → create DB + user. Note host (usually `localhost`), db name, user, password.

## 6. Import `database/schema.sql`
phpMyAdmin → select DB → Import → `database/schema.sql`.
(`database/seed.sql` contains commented test data only — do not run in production.)

## 7. Create `.env`
File Manager → `public_html/.env` (copy structure from `.env.example`, fill real values):
```
GROQ_API_KEY=
DB_HOST=localhost
DB_PORT=3306
DB_NAME=
DB_USER=
DB_PASS=
TRIAL_DAYS=7
MAIL_ENABLED=false
MAIL_FROM=noreply@langzio.com
PAYPAL_CLIENT_ID=
PAYPAL_SECRET=
PAYPAL_PLAN_ID=
WHATSAPP_PROVIDER=
WHATSAPP_API_KEY=
CANONICAL_DOMAIN=https://langzio.com
CRON_SECRET=   # min 32 random chars, required
```
Permissions: `.env` `600`, `data/` writable by PHP for rate-limit/analytics files.

## 8. Configure HTTPS
SSL → install free certificate for `langzio.com`. `.htaccess` forces `http → https`.

## 9. Configure Cron
Advanced → Cron Jobs → daily:
```
/usr/bin/php /home/uXXXX/public_html/cron/trial-reminders.php
```
Replace `uXXXX` with your Hostinger username. HTTP access requires `?key=CRON_SECRET`; CLI needs no key. Empty `CRON_SECRET` denies HTTP.

## 10. Test `/status.php`
Visit `https://langzio.com/status.php` → expect `{"ok":true,"api_ready":true}`.
It exposes nothing else (no paths, no keys, no model name).

## 11. Test `/translator/`
Pretty URL → serves `translator.php` internally (POST preserved). Try a translation; check structured output renders.

## 12. Test `/guides/souk/`
Pretty URL → serves `guides.php`. Unknown slugs (e.g. `/dictionary/`, `/culture/...`) correctly return `404.php` until those pages exist — do not add them to the sitemap yet.

## 13. Test authentication
Register → login → dashboard → logout. Trial banner shows days remaining. No CSRF token yet (known remaining issue); login/register have no rate limit — consider Cloudflare or Hostinger WAF.

## 14. Test database
Register a user → check `users` + `subscriptions` rows (trial 7 days). Update WhatsApp number in profile → check `users.whatsapp_*` columns.

## 15. Test Groq API
With valid `GROQ_API_KEY`: `POST /api.php` `{"mode":"translate","text":"hello"}` → JSON reply, `mock:false`. With missing key: demo fallback reply, `mock:true`. Key never appears in JS/network (backend-only call).

## 16. Delete debug files
From `public_html/` delete: `info.php`, `seed.php` (if uploaded), `*.zip`.
`.htaccess` already returns 403 for `(info|seed).php`, `*.sql`, `*.zip`, `.git/`, `database/`, `data/`.
`info.php` additionally requires `LANGZIO_DEBUG=1`; `seed.php` requires CLI or `?key=CRON_SECRET`.

## 17. Final security check
- `git ls-files` shows no `.env`, no `*.zip`, no `data/*.jsonl`.
- `https://langzio.com/.env` → 403. `/database/schema.sql` → 403. `/data/corpus.json` → 403.
- `/sitemap.xml` → served by `sitemap.php`. Remove non-existent URLs from sitemap before submitting to Search Console.
- `robots.txt` currently disallows app routes; align with sitemap before launch.

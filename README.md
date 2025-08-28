# 📚 LMS for Creativy Company

Sebuah **Learning Management System (LMS)** berbasis **Laravel**, dilengkapi front-end modern menggunakan **Vite + React (atau Blade/Vue)**.

---

## 🧩 Fitur Utama

- Manajemen **Siswa**, **Instruktur**, dan **Administrator**
- CRUD untuk **Kursus**, **Modul**, dan **Materi**
- Otentikasi berbasis Laravel Auth
- Tampilan yang responsif dan interaktif menggunakan Vite
- Struktur modular dan siap dikembangkan

---

## ⚙️ Teknologi yang Digunakan

| Back-end         | Front-end        | Lain-lain        |
|------------------|------------------|------------------|
| Laravel (PHP)    | Vite             | PHP 8.x          |
| MySQL / PostgreSQL | React atau Blade| Git              |
| Routes / API     | Tailwind CSS     | Routing SPA      |

---

## 🚀 Instalasi Lokal

Pastikan kamu sudah menginstal `PHP >= 8.x`, `Composer`, `Node.js`, dan `npm` atau `yarn`.

```bash
git clone https://github.com/envvavor/lms.git
cd lms

# Back‑end
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed   # (opsional)

# Front‑end
npm install
npm run build

# Atau untuk pengembangan:
npm run dev
php artisan serve     # biasanya di http://127.0.0.1:8000

# Only God And I Who Knows How This Code Works

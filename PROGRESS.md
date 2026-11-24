# PROGRESS — Laboratorium

## Fase aktif

**Deployment (dev lokal) — selesai, siap commit.** Aplikasi berjalan penuh di
Docker Compose dan sudah diuji end-to-end.

## Status terakhir (24 Nov 2026)

Sudah selesai:

- Runtime terisolasi: `php:7.4-apache` + MariaDB 10.6 di Docker, PHP 8.5 host tidak dipakai.
- Framework di-upgrade 3.1.10 → 3.1.13 (folder `system/` saja, backup `system.bak-3.1.10/`).
- Akses string gaya lama `{$pos}` → `[$pos]` di 3 controller (aman untuk PHP 8).
- Skema 10 tabel + seed saling terhubung (tidak ada dump asli, direkonstruksi dari kode).
- `base_url` & kredensial DB dibaca dari env (`CI_BASE_URL`, `DB_*`).
- Perbaikan `session.save_path=/tmp` (image PHP tanpa php.ini → session CI gagal).
- Diuji: login 4 role, 16 halaman utama, tulis DB (matkul/fasilitas/mahasiswa + upload),
  hapus data, counter dashboard, proteksi `/.env` & `/db/init` (403).
- `.env`, `system.bak-3.1.10`, dan `assets/media/portofolio/*.MP4` di-ignore git.
- Seed portofolio disesuaikan memakai gambar (MP4 tidak ikut repo).

Belum / catatan:

- 2 bug view bawaan (lihat `AGENTS.md`) — belum diputuskan mau diperbaiki.
- Volume DB yang sekarang masih berisi path media lama (`M-2.MP4`, `M-3.MP4`);
  jalankan `docker compose down -v && docker compose up -d` bila ingin seed
  versi baru (menghapus data saat ini).
- Belum ada test otomatis, belum ada environment production.

## Langkah berikutnya

1. Putuskan perbaikan 2 bug view (cukup kirim `'anggota' => array()` dari controller).
2. Push repo ke `git@github.com:syamsulsiphidayat7/Laboratorium.git` (izin sudah ada).
3. Kalau mau ke production: ganti password plain text → hash, `CI_ENV=production`,
   HTTPS, backup DB sebelum migration.

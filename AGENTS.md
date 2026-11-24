# AGENTS.md — Laboratorium

Sistem informasi Laboratorium Pendidikan Kimia (praktikum, portofolio, penilaian).

## Stack

| Komponen | Versi | Catatan |
|---|---|---|
| Framework | CodeIgniter 3.1.13 | folder `system/`, upgrade dari 3.1.10 (backup: `system.bak-3.1.10/`) |
| PHP | 7.4.33 | di container `php:7.4-apache`, **bukan** PHP host (8.5) |
| Database | MariaDB 10.6 | driver `mysqli`, charset utf8mb4 |
| Web server | Apache 2.4 (mod_php) | `mod_rewrite` + `AllowOverride All` |
| Container | Docker Compose | `web` (8080) + `db` (3307) |

## Cara menjalankan

```bash
docker compose up -d --build     # start
docker compose logs -f web       # log PHP/Apache
docker compose down              # stop, data DB tetap
docker compose down -v           # reset total (schema+seed dijalankan ulang)
```

- App: <http://localhost:8080>
- DB dari host: `127.0.0.1:3307`, user `lab` / `lab`, root `root` / `root`
- Akun default: password semua `dev123` (`admin`, `198001012005011001`, `1171010001`, `1171010004`, …)

## Struktur penting

```
application/            kode aplikasi CI3 (controllers, models, views, config)
system/                 framework CI 3.1.13
db/init/01-schema.sql   10 tabel, FK, InnoDB, utf8mb4
db/init/02-seed.sql     seed saling terhubung + akun default
Dockerfile              php:7.4-apache + mysqli/mbstring
compose.yaml            service web + db, volume dbdata
docker/php/app.ini      upload 64M, session.save_path=/tmp, timezone
db/my.cnf               buffer pool 64M, performance_schema OFF
```

## Konvensi

- Semua runtime lewat Docker; jangan install PHP/MySQL versi lain di host.
- `db/init/*.sql` hanya jalan saat volume `dbdata` kosong.
- Perubahan kode aplikasi tidak perlu rebuild; perubahan `Dockerfile`/`app.ini`
  perlu `docker compose up -d --build`.
- Kode mengikuti gaya CI3 yang sudah ada (controller `MY_Controller`, model `M_*`,
  view Bootstrap 3 / Inspinia). Jangan refactor besar tanpa diminta.
- Password aplikasi disimpan **plain text** (perilaku `Auth.php`). Jangan
  "memperbaiki" ke `password_hash()` tanpa migrasi data + perubahan login.
- Commit/push wajib izin user.

## Skema: keputusan yang tidak boleh diubah tanpa alasan

- `jk_*` = `VARCHAR(15)` (`Laki-laki`/`Perempuan`).
- `jadwal_praktek.jadwal_praktek` = `DATETIME` (`<input type="datetime-local">`).
- `semester`, `jumlah` = `VARCHAR` (input teks), `sks` = `TINYINT UNSIGNED`.
- Relasi `nim_asisten`/`nim_anggota`/`nim_mhs` ke `mahasiswa.nim` **tanpa FK**
  (hanya index) agar input dari aplikasi tidak ditolak DB.
- `portofolio.status` = 0/1 (belum/sudah dinilai).

## Bug yang diketahui (belum diperbaiki)

1. `views/dosen/data_jadwal.php:111` pakai `$matakuliah`, tapi
   `Jadwal::getJadwalMahasiswa()` tidak mengirimkannya → Notice + select kosong.
2. `views/praktik/data_portofolio.php:133` pakai `$anggota`, tapi
   `Portofolio::getPortofolio()` dan `getPortofolioAsisten()` tidak mengirimkannya
   → Notice + select kosong.

## Media

Video demo `assets/media/portofolio/*.MP4` (~70 MB) **tidak** di-commit
(di-ignore). File tetap ada di mesin lokal; clone baru tidak punya video tersebut.

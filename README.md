# Sistem Informasi Laboratorium Pendidikan Kimia

Aplikasi web untuk mengelola kegiatan praktikum di laboratorium pendidikan kimia:
jadwal praktikum, modul, keanggotaan asisten/praktikan, portofolio mahasiswa, dan
penilaian. Dibangun dengan **CodeIgniter 3** dan berjalan di Docker Compose
(PHP 7.4 + MariaDB 10.6), jadi tidak perlu memasang PHP/MySQL versi lama di host.

> **Status: aplikasi demo.** Password disimpan plain text dan akun contoh memakai
> password yang sama. Jangan dipakai di production tanpa mengganti mekanisme
> autentikasi (lihat bagian *Keamanan*).

## Fitur

| Role | Fitur |
|---|---|
| **Admin** | Dashboard statistik (jumlah dosen, praktikan, portofolio, jadwal) + galeri media portofolio; kelola dosen, mahasiswa, mata kuliah; ubah password & foto profil |
| **Dosen** | Jadwal praktikum (tambah/hapus, unggah & unduh modul); kelola asisten praktikum; lihat portofolio mahasiswa; beri, ubah, dan hapus nilai |
| **Asisten** | Kelola anggota (praktikan binaan); lihat portofolio; beri dan hapus nilai |
| **Mahasiswa** | Lihat jadwal & unduh modul; unggah portofolio (jurnal, laporan, dokumentasi foto/video); lihat nilai |
| **Semua role** | Daftar & kelola fasilitas (alat dan bahan), buka panduan PDF, ubah password & foto |

### Alur pemakaian

1. Admin mendata dosen, mahasiswa, mata kuliah, dan fasilitas laboratorium.
2. Dosen membuat jadwal praktikum dan mengunggah modul praktikum.
3. Dosen menunjuk asisten praktikum; asisten mendata anggota praktikan binaannya.
4. Mahasiswa mengunggah portofolio (jurnal, laporan, dokumentasi) untuk praktikum.
5. Dosen/asisten memberi nilai jurnal, praktik, dan laporan → rata-rata dihitung otomatis.
6. Mahasiswa melihat nilai yang sudah masuk.

## Stack

| Komponen | Versi |
|---|---|
| Framework | CodeIgniter 3.1.13 |
| PHP | 7.4 (container `php:7.4-apache`) |
| Database | MariaDB 10.6, driver `mysqli`, charset `utf8mb4` |
| Web server | Apache 2.4 + `mod_rewrite` |
| Frontend | Bootstrap 3, jQuery, tema admin Inspinia |
| Container | Docker Compose (`web` + `db`) |

## Menjalankan

Prasyarat: Docker + Docker Compose terpasang, dan user ada di grup `docker`.

```bash
docker compose up -d --build
```

- Aplikasi: <http://localhost:8080>
- Database dari host (DBeaver/TablePlus): `127.0.0.1:3307`, user `lab`, password `lab`
- Hentikan: `docker compose down` (data DB tetap) / `docker compose down -v` (reset total)

Skema dan data contoh (`db/init/01-schema.sql`, `db/init/02-seed.sql`) otomatis
dimuat saat volume database masih kosong. Detail konfigurasi container, perintah
harian, dan troubleshooting ada di [`docker/README.md`](docker/README.md).

### Akun demo

Semua akun memakai password **`dev123`**.

| Role | Username / NIDN / NIM |
|---|---|
| Admin | `admin` |
| Dosen | `198001012005011001`, `198203152008012002` |
| Mahasiswa | `1171010001` … `1171010006` |
| Asisten | `1171010004`, `1171010005` |

## Struktur proyek

```
application/          kode aplikasi (controllers, models, views, config)
system/               framework CodeIgniter 3.1.13
assets/               tema, JavaScript, CSS, media unggahan
db/init/              skema + seed database
docker/php/app.ini    konfigurasi PHP container
Dockerfile            image PHP + Apache
compose.yaml          service web + db
AGENTS.md             konvensi kerja untuk agent/developer
PROGRESS.md           status pengerjaan
```

## Database

| Tabel | Isi |
|---|---|
| `user` | akun admin |
| `dosen` | data dosen (NIDN, kontak, foto, password) |
| `mahasiswa` | data mahasiswa (NIM, semester, foto, password) |
| `mata_kuliah` | mata kuliah dan dosen pengampu |
| `jadwal_praktek` | jadwal praktikum, judul, modul yang diunggah |
| `asisten_praktikan` | asisten praktikum per jadwal, kelompok, password |
| `anggota` | praktikan binaan tiap asisten |
| `portofolio` | unggahan jurnal/laporan/dokumentasi + status penilaian |
| `nilai_praktek` | nilai jurnal, praktik, laporan, rata-rata, ulasan |
| `fasilitas` | daftar alat dan bahan laboratorium |

## Troubleshooting

| Gejala | Penyebab & solusi |
|---|---|
| `mkdir(): Invalid path` / session gagal | `session.save_path` kosong. Pastikan `docker/php/app.ini` ter-mount lalu `docker compose up -d` |
| Port 8080/3307 sudah dipakai | Ubah `WEB_PORT` / `DB_PORT` di `.env`, lalu `docker compose up -d` |
| Ingin mengulang seed | `docker compose down -v && docker compose up -d` (data lama terhapus) |
| Error PHP tidak terlihat | `CI_ENV` di `compose.yaml` diset `development`; cek `docker compose logs -f web` |

## Keamanan

Aplikasi ini adalah demo akademik. Sebelum dipakai nyata:

- Ganti password plain text menjadi `password_hash()` + `password_verify()`.
- Set `CI_ENV=production`, matikan `display_errors`, aktifkan HTTPS.
- Batasi hak CRUD fasilitas (saat ini semua role yang login bisa menambah/menghapus).
- Ganti kredensial DB default di `.env`.

## Kredit

- [CodeIgniter 3](https://codeigniter.com) — MIT License.
- Tema admin Inspinia (Bootstrap 3), jQuery, Font Awesome.

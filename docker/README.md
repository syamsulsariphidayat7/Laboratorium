# Menjalankan Laboratorium (CI 3.1.10) secara terisolasi

Semua runtime (PHP 7.4 + Apache + MariaDB 10.6) hidup di container.
PHP 8.5, MariaDB, dan Apache di host **tidak dipakai dan tidak diubah**.

## 0. Prasyarat (sekali saja, butuh sudo — dijalankan sendiri)

```bash
sudo pacman -S --needed docker docker-compose docker-buildx
sudo systemctl enable --now docker
sudo usermod -aG docker "$USER"   # logout & login (atau reboot) agar berlaku
```

Cek: `docker run --rm hello-world`

## 1. Jalankan

```bash
cd /srv/http/Laboratorium
docker compose up -d --build
docker compose ps          # tunggu db "healthy"
```

Buka <http://localhost:8080>

Database diinisialisasi otomatis pada **start pertama** (volume masih kosong):
`db/init/01-schema.sql` lalu `db/init/02-seed.sql`.

## 2. Akun default (password semua: `dev123`)

| Level     | Username / NIM / NIDN | Password |
|-----------|-----------------------|----------|
| Admin     | `admin`               | `dev123` |
| Dosen     | `198001012005011001`  | `dev123` |
| Dosen     | `198203152008012002`  | `dev123` |
| Mahasiswa | `1171010001`          | `dev123` |
| Mahasiswa | `1171010002` … `1171010006` | `dev123` |
| Asisten   | `1171010004`          | `dev123` |
| Asisten   | `1171010005`          | `dev123` |

## 3. Restart policy

Container **tidak** auto-start saat boot. Jalankan manual dengan
`docker compose up -d` setiap kali dibutuhkan.

## 4. Perintah harian

```bash
docker compose up -d          # start
docker compose stop           # stop (data tetap)
docker compose down           # hapus container (data tetap di volume dbdata)
docker compose down -v        # hapus container + data DB (reset total, seed jalan lagi)
docker compose logs -f web    # log Apache/PHP
docker compose exec db mariadb -ulab -plab laboratorium -e "SHOW TABLES;"
```

Akses DB dari host (DBeaver/TablePlus): `127.0.0.1:3307`, user `lab`, pass `lab`.
Root: `root` / `root` (port sama).

## 5. Struktur file tambahan

```
Dockerfile            php:7.4-apache + mysqli + mod_rewrite + AllowOverride All
compose.yaml          service web (8080) + db (3307), volume dbdata
.env / .env.example   versi PHP, image DB, nama DB, port
docker/php/app.ini    upload 64M, memory 256M, timezone Asia/Jakarta
db/my.cnf             buffer pool 64M, performance_schema OFF, max_connections 20
db/init/*.sql         skema + seed (hanya jalan saat volume kosong)
```

Setelah mengubah `docker/php/app.ini` atau `Dockerfile`, jalankan ulang
`docker compose up -d --build`. Perubahan kode aplikasi tidak perlu rebuild
(karena bind mount).

Yang diubah di kode aplikasi **hanya**:

- `application/config/database.php` → host/user/pass/nama DB dari env
  (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`), fallback ke nilai lama.
- `application/config/config.php` → `base_url` dari `CI_BASE_URL`,
  fallback `http://localhost:8080/`.
- `application/controllers/{Mahasiswa,Dosen,Asisten}.php` → `$karakter{$pos}`
  diganti `$karakter[$pos]` (sintaks, perilaku sama).
- `system/` → diganti CodeIgniter 3.1.13 (backup: `system.bak-3.1.10/`).
  `application/`, `index.php`, dan `.htaccess` tidak disentuh.

## 6. Hal yang perlu diketahui

1. **Password plain text.** `Auth.php` memakai `get_where` dengan password apa adanya
   (tanpa hash). Seed mengikuti itu. Jangan dipakai di production tanpa `password_hash()`.
2. **Akses string gaya lama** sudah dibereskan (`[$pos]`), jadi tidak ada lagi notice
   di PHP 7.4 dan aman kalau nanti pindah ke PHP 8.
3. **Framework sudah di 3.1.13** (dari 3.1.10), yang membawa perbaikan keamanan
   3.1.11–3.1.13 plus dukungan PHP 8 (session wrapper + `MYSQLI_REPORT_OFF`).
   Backup versi lama ada di `system.bak-3.1.10/` (di-ignore git & docker).
4. **Kolom ambigu** (diputuskan berdasarkan pemakaian di view/controller):
   - `jk_*` = `VARCHAR(15)` karena `<option>` berisi `Laki-laki`/`Perempuan`.
   - `semester`, `sks`, `jumlah` di form berupa input teks → `VARCHAR`/`TINYINT`.
   - `asisten_praktikan.nim_asisten`, `anggota.nim_anggota`, `portofolio.nim_mhs`
     adalah relasi logis ke `mahasiswa.nim` **tanpa FK**, supaya penambahan data
     lewat aplikasi tidak ditolak database.
   - `jadwal_praktek.jadwal_praktek` = `DATETIME` karena form memakai
     `<input type="datetime-local">` (bukan `DATE`).
   - `portofolio.status` = 0/1 (belum/sudah dinilai), di-set oleh `formNilai()`.
5. **Counter dashboard** memakai `affected_rows()` setelah SELECT — sudah diuji di
   MariaDB 10.6 dan hasilnya benar (2 dosen / 5 praktikan / 3 portofolio / 3 jadwal),
   jadi bukan masalah di stack ini.
6. **2 bug view bawaan aplikasi** (bukan efek container, sudah ada sebelum upgrade):
   - `views/dosen/data_jadwal.php:111` memakai `$matakuliah`, tapi
     `Jadwal::getJadwalMahasiswa()` tidak mengirimkannya → Notice + select kosong
     di modal tambah jadwal (tidak dipakai mahasiswa).
   - `views/praktik/data_portofolio.php:133` memakai `$anggota`, tapi
     `Portofolio::getPortofolio()` (dosen) dan `getPortofolioAsisten()` tidak
     mengirimkannya → Notice + select kosong di modal tambah portofolio.
   Perbaikan minimal: kirim `'anggota' => array()` (atau datanya) dari controller.
   Halaman tetap tampil normal, hanya notice.
7. File upload masuk ke `assets/media/{photo,document,portofolio}` di host
   (bind mount), jadi data tidak hilang saat container dihapus. File baru dibuat
   oleh `www-data` (uid 33) sehingga dimiliki `http:http` di host; folder sudah
   writable, jadi aplikasi tetap bisa menulis. Kalau mau edit manual, gunakan
   `chmod`/`chown` seperlunya.

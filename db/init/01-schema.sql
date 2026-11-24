-- Skema rekonstruksi dari application/models, application/controllers, application/views
-- CI 3.1.10 / MariaDB 10.6 / InnoDB / utf8mb4
-- Catatan: password disimpan plain text karena Auth.php membandingkan langsung
--          (get_where dengan password apa adanya), bukan password_hash().

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------- admin
CREATE TABLE IF NOT EXISTS `user` (
  `id_user`     INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username`    VARCHAR(50)  NOT NULL,
  `password`    VARCHAR(255) NOT NULL,
  `photo_admin` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `uq_user_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------- dosen
CREATE TABLE IF NOT EXISTS `dosen` (
  `id_dosen`     INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nidn`         VARCHAR(30)  NOT NULL,
  `nama_dosen`   VARCHAR(100) NOT NULL,
  `jk_dosen`     VARCHAR(15)  DEFAULT NULL,  -- 'Laki-laki' / 'Perempuan' (sesuai <option> di view)
  `alamat_dosen` TEXT,
  `kontak`       VARCHAR(30)  DEFAULT NULL,
  `password`     VARCHAR(255) NOT NULL,
  `foto_dosen`   VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id_dosen`),
  UNIQUE KEY `uq_dosen_nidn` (`nidn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------- mahasiswa
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id_mahasiswa`     INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nim`              VARCHAR(20)  NOT NULL,
  `nama_mahasiswa`   VARCHAR(100) NOT NULL,
  `semester`         VARCHAR(10)  DEFAULT NULL,  -- input teks di view
  `jk_mahasiswa`     VARCHAR(15)  DEFAULT NULL,  -- 'Laki-laki' / 'Perempuan'
  `alamat_mahasiswa` TEXT,
  `password`         VARCHAR(255) NOT NULL,
  `foto_mahasiswa`   VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id_mahasiswa`),
  UNIQUE KEY `uq_mahasiswa_nim` (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------- mata kuliah
CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `id_mata_kuliah`   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_mata_kuliah` VARCHAR(20)  NOT NULL,
  `id_dosen`         INT UNSIGNED DEFAULT NULL,
  `nama_mata_kuliah` VARCHAR(100) NOT NULL,
  `sks`              TINYINT UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_mata_kuliah`),
  UNIQUE KEY `uq_matkul_kode` (`kode_mata_kuliah`),
  KEY `idx_matkul_dosen` (`id_dosen`),
  CONSTRAINT `fk_matkul_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------- jadwal praktikum
CREATE TABLE IF NOT EXISTS `jadwal_praktek` (
  `id_jadwal_praktek` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_dosen`          INT UNSIGNED DEFAULT NULL,
  `id_mata_kuliah`    INT UNSIGNED DEFAULT NULL,
  `judul`             VARCHAR(150) DEFAULT NULL,
  `jadwal_praktek`    DATETIME     DEFAULT NULL,  -- input view: <input type="datetime-local">
  `modul`             VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal_praktek`),
  KEY `idx_jadwal_dosen` (`id_dosen`),
  KEY `idx_jadwal_matkul` (`id_mata_kuliah`),
  CONSTRAINT `fk_jadwal_dosen`   FOREIGN KEY (`id_dosen`)       REFERENCES `dosen` (`id_dosen`)             ON DELETE SET NULL,
  CONSTRAINT `fk_jadwal_matkul`  FOREIGN KEY (`id_mata_kuliah`) REFERENCES `mata_kuliah` (`id_mata_kuliah`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------- asisten praktikum
CREATE TABLE IF NOT EXISTS `asisten_praktikan` (
  `id_asisten`        INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nim_asisten`       VARCHAR(20)  NOT NULL,   -- relasi logis ke mahasiswa.nim (tanpa FK, lihat catatan)
  `nama_asisten`      VARCHAR(100) NOT NULL,
  `id_jadwal`         INT UNSIGNED DEFAULT NULL,
  `kontak_asisten`    VARCHAR(30)  DEFAULT NULL,
  `kelompok`          VARCHAR(30)  DEFAULT NULL,
  `jk_asisten`        VARCHAR(15)  DEFAULT NULL,
  `photo_asisten`     VARCHAR(255) DEFAULT NULL,
  `password_asisten`  VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_asisten`),
  KEY `idx_asisten_nim` (`nim_asisten`),
  KEY `idx_asisten_jadwal` (`id_jadwal`),
  CONSTRAINT `fk_asisten_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_praktek` (`id_jadwal_praktek`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------- anggota (praktikan binaan asisten)
CREATE TABLE IF NOT EXISTS `anggota` (
  `id_anggota`   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_asisten`   INT UNSIGNED DEFAULT NULL,
  `nama_asisten` VARCHAR(100) DEFAULT NULL,
  `nim_anggota`  VARCHAR(20)  NOT NULL,   -- relasi logis ke mahasiswa.nim
  PRIMARY KEY (`id_anggota`),
  KEY `idx_anggota_nim` (`nim_anggota`),
  KEY `idx_anggota_asisten` (`id_asisten`),
  CONSTRAINT `fk_anggota_asisten` FOREIGN KEY (`id_asisten`) REFERENCES `asisten_praktikan` (`id_asisten`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------- portofolio
CREATE TABLE IF NOT EXISTS `portofolio` (
  `id_portofolio` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nim_mhs`       VARCHAR(20)  NOT NULL,   -- relasi logis ke mahasiswa.nim
  `id_anggota`    INT UNSIGNED DEFAULT NULL,
  `id_asisten`    INT UNSIGNED DEFAULT NULL,
  `jurnal`        VARCHAR(255) DEFAULT NULL,
  `praktek`       VARCHAR(255) DEFAULT NULL,
  `laporan`       VARCHAR(255) DEFAULT NULL,
  `status`        TINYINT(1)   NOT NULL DEFAULT 0,  -- 0 = belum dinilai, 1 = sudah dinilai
  PRIMARY KEY (`id_portofolio`),
  KEY `idx_portofolio_nim` (`nim_mhs`),
  KEY `idx_portofolio_anggota` (`id_anggota`),
  KEY `idx_portofolio_asisten` (`id_asisten`),
  CONSTRAINT `fk_portofolio_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE SET NULL,
  CONSTRAINT `fk_portofolio_asisten` FOREIGN KEY (`id_asisten`) REFERENCES `asisten_praktikan` (`id_asisten`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------- nilai praktikum
CREATE TABLE IF NOT EXISTS `nilai_praktek` (
  `id_nilai`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_portofolio`     INT UNSIGNED DEFAULT NULL,
  `id_anggota`        INT UNSIGNED DEFAULT NULL,
  `id_dosen`          INT UNSIGNED DEFAULT NULL,
  `id_mata_kuliah`    INT UNSIGNED DEFAULT NULL,
  `id_jadwal_praktek` INT UNSIGNED DEFAULT NULL,
  `ulasan`            TEXT,
  `nilai_jurnal`      DECIMAL(5,2) DEFAULT NULL,
  `nilai_praktek`     DECIMAL(5,2) DEFAULT NULL,
  `nilai_laporan`     DECIMAL(5,2) DEFAULT NULL,
  `rata_rata`         DECIMAL(5,2) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `idx_nilai_portofolio` (`id_portofolio`),
  KEY `idx_nilai_anggota` (`id_anggota`),
  KEY `idx_nilai_dosen` (`id_dosen`),
  KEY `idx_nilai_matkul` (`id_mata_kuliah`),
  KEY `idx_nilai_jadwal` (`id_jadwal_praktek`),
  CONSTRAINT `fk_nilai_portofolio` FOREIGN KEY (`id_portofolio`)     REFERENCES `portofolio` (`id_portofolio`)     ON DELETE CASCADE,
  CONSTRAINT `fk_nilai_anggota`    FOREIGN KEY (`id_anggota`)        REFERENCES `anggota` (`id_anggota`)           ON DELETE SET NULL,
  CONSTRAINT `fk_nilai_dosen`      FOREIGN KEY (`id_dosen`)          REFERENCES `dosen` (`id_dosen`)               ON DELETE SET NULL,
  CONSTRAINT `fk_nilai_matkul`     FOREIGN KEY (`id_mata_kuliah`)    REFERENCES `mata_kuliah` (`id_mata_kuliah`)   ON DELETE SET NULL,
  CONSTRAINT `fk_nilai_jadwal`     FOREIGN KEY (`id_jadwal_praktek`) REFERENCES `jadwal_praktek` (`id_jadwal_praktek`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------- fasilitas
CREATE TABLE IF NOT EXISTS `fasilitas` (
  `id_fasilitas`    INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fasilitas`       VARCHAR(150) NOT NULL,
  `jumlah`          VARCHAR(20)  DEFAULT NULL,   -- input teks di view
  `keterangan`      VARCHAR(255) DEFAULT NULL,
  `jenis_fasilitas` ENUM('alat','bahan') NOT NULL DEFAULT 'alat',
  PRIMARY KEY (`id_fasilitas`),
  KEY `idx_fasilitas_jenis` (`jenis_fasilitas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;

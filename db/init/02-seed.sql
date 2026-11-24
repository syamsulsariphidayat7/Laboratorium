-- Seed saling terhubung untuk debugging (bukan data acak)
-- Semua akun default password: dev123 (plain text, sesuai cara Auth.php membandingkan)
--   admin     : admin / dev123
--   dosen     : 198001012005011001 / dev123  (dan 198203152008012002)
--   mahasiswa : 1171010001 ... 1171010006 / dev123
--   asisten   : 1171010004, 1171010005 / dev123

SET NAMES utf8mb4;

-- ---------------------------------------------------------------- admin
INSERT INTO `user` (`id_user`, `username`, `password`, `photo_admin`) VALUES
  (1, 'admin', 'dev123', 'user.png');

-- ---------------------------------------------------------------- dosen
INSERT INTO `dosen` (`id_dosen`, `nidn`, `nama_dosen`, `jk_dosen`, `alamat_dosen`, `kontak`, `password`, `foto_dosen`) VALUES
  (1, '198001012005011001', 'Dr. Siti Nurhaliza, M.Pd.', 'Perempuan', 'Jl. A. H. Nasution No. 105, Bandung', '081200000001', 'dev123', 'D-1553537095.jpeg'),
  (2, '198203152008012002', 'Ahmad Fauzi, M.Si.',        'Laki-laki', 'Jl. Soekarno-Hatta No. 777, Bandung',  '081200000002', 'dev123', NULL);

-- ---------------------------------------------------------------- mahasiswa
INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama_mahasiswa`, `semester`, `jk_mahasiswa`, `alamat_mahasiswa`, `password`, `foto_mahasiswa`) VALUES
  (1, '1171010001', 'Aulia Rahma',    '4', 'Perempuan', 'Cibiru, Bandung',        'dev123', 'M-1553537162.jpeg'),
  (2, '1171010002', 'Bagus Pratama',  '4', 'Laki-laki', 'Ujungberung, Bandung',   'dev123', 'M-1554135379.png'),
  (3, '1171010003', 'Citra Dewi',     '4', 'Perempuan', 'Antapani, Bandung',      'dev123', NULL),
  (4, '1171010004', 'Dimas Saputra',  '6', 'Laki-laki', 'Buahbatu, Bandung',      'dev123', 'user.png'),
  (5, '1171010005', 'Eka Lestari',    '6', 'Perempuan', 'Cileunyi, Bandung',      'dev123', NULL),
  (6, '1171010006', 'Fajar Ramadhan', '6', 'Laki-laki', 'Rancaekek, Bandung',     'dev123', NULL);

-- ---------------------------------------------------------------- mata kuliah
INSERT INTO `mata_kuliah` (`id_mata_kuliah`, `kode_mata_kuliah`, `id_dosen`, `nama_mata_kuliah`, `sks`) VALUES
  (1, 'KIM101', 1, 'Kimia Dasar',    3),
  (2, 'KIM201', 1, 'Kimia Analitik', 3),
  (3, 'KIM202', 2, 'Kimia Organik',  2);

-- ---------------------------------------------------------------- jadwal praktikum
INSERT INTO `jadwal_praktek` (`id_jadwal_praktek`, `id_dosen`, `id_mata_kuliah`, `judul`, `jadwal_praktek`, `modul`) VALUES
  (1, 1, 1, 'Praktikum Pengenalan Alat Laboratorium', '2026-02-10 08:00:00', 'F-Kimia-BOM-1553537217.docx'),
  (2, 1, 2, 'Praktikum Titrasi Asam Basa',            '2026-03-03 10:00:00', NULL),
  (3, 2, 3, 'Praktikum Reaksi Senyawa Organik',       '2026-03-10 13:00:00', NULL);

-- ---------------------------------------------------------------- asisten praktikum
INSERT INTO `asisten_praktikan` (`id_asisten`, `nim_asisten`, `nama_asisten`, `id_jadwal`, `kontak_asisten`, `kelompok`, `jk_asisten`, `photo_asisten`, `password_asisten`) VALUES
  (1, '1171010004', 'Dimas Saputra', 1, '082200000004', '1', 'Laki-laki', 'A-1553537254.jpeg', 'dev123'),
  (2, '1171010005', 'Eka Lestari',   2, '082200000005', '2', 'Perempuan', 'user.png',          'dev123');

-- ---------------------------------------------------------------- anggota binaan asisten
INSERT INTO `anggota` (`id_anggota`, `id_asisten`, `nama_asisten`, `nim_anggota`) VALUES
  (1, 1, 'Dimas Saputra', '1171010001'),
  (2, 1, 'Dimas Saputra', '1171010002'),
  (3, 1, 'Dimas Saputra', '1171010003'),
  (4, 2, 'Eka Lestari',   '1171010003'),
  (5, 2, 'Eka Lestari',   '1171010006');

-- ---------------------------------------------------------------- portofolio
INSERT INTO `portofolio` (`id_portofolio`, `nim_mhs`, `id_anggota`, `id_asisten`, `jurnal`, `praktek`, `laporan`, `status`) VALUES
  (1, '1171010001', 1, 1, 'J-1553537743.docx', 'M-1553537743.jpeg', 'L-1553537743.doc',  0),
  (2, '1171010002', 2, 1, 'J-1553540778.docx', 'M-1554114935.png',  'L-1553540778.doc',  0),
  (3, '1171010003', 3, 1, 'J-1553541112.docx', 'default.png',       'L-1553541112.docx', 1);

-- ---------------------------------------------------------------- nilai (untuk portofolio yang sudah dinilai)
INSERT INTO `nilai_praktek` (`id_nilai`, `id_portofolio`, `id_anggota`, `id_dosen`, `id_mata_kuliah`, `id_jadwal_praktek`, `ulasan`, `nilai_jurnal`, `nilai_praktek`, `nilai_laporan`, `rata_rata`) VALUES
  (1, 3, 3, 1, 1, 1, 'Jurnal rapi, dokumentasi lengkap, laporan perlu perbaikan pembahasan.', 85.00, 80.00, 90.00, 85.00);

-- ---------------------------------------------------------------- fasilitas
INSERT INTO `fasilitas` (`id_fasilitas`, `fasilitas`, `jumlah`, `keterangan`, `jenis_fasilitas`) VALUES
  (1, 'Gelas Ukur 100 mL',   '12', 'Pyrex, kondisi baik',            'alat'),
  (2, 'Buret 50 mL',         '8',  '1 unit kran macet',              'alat'),
  (3, 'Neraca Analitik',     '2',  'Ketelitian 0,1 mg',              'alat'),
  (4, 'NaOH 0,1 M',          '500 mL', 'Stok di lemari asam',        'bahan'),
  (5, 'Indikator Fenolftalein', '100 mL', 'Larutan 1% dalam etanol',  'bahan');

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Sep 2022 pada 12.21
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elerning_latihan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absens`
--

CREATE TABLE `absens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `jadwal_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pertemuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `tahun_ajaran` int(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absens`
--

INSERT INTO `absens` (`id`, `siswa_id`, `jadwal_id`, `status`, `tanggal`, `pertemuan`, `semester`, `kelas_id`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
(212, 7, 16, 'hadir', '2022-09-12', '1', '1', 7, 2020, '2022-09-11 18:05:02', '2022-09-11 18:05:10'),
(213, 8, 16, 'hadir', '2022-09-12', '1', '1', 7, 2020, '2022-09-11 18:05:02', '2022-09-12 05:10:13'),
(214, 9, 16, 'hadir', '2022-09-12', '1', '1', 7, 2020, '2022-09-11 18:05:02', '2022-09-12 09:40:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_soal`
--

CREATE TABLE `category_soal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `category_soal`
--

INSERT INTO `category_soal` (`id`, `name`, `kelas_id`, `created_at`, `updated_at`) VALUES
(4, 'ULANGAN', 7, '2022-09-16 03:12:22', '2022-09-16 03:12:22'),
(5, 'UJIAN', 7, '2022-09-16 03:12:47', '2022-09-16 03:12:47'),
(6, 'TUGAS', 7, '2022-09-16 03:13:34', '2022-09-16 03:13:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `name`, `email`, `password`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Guru Ananda Dmmas Budiarto', 'anandadimmas@gmail.com', '$2y$10$M8zdbS.eeIcHnpnXuJfh8.DtenkcDX5VnXrN4jPN0GTGPP/.m1Lni', '1661330484.jpg', '2022-08-24 08:30:15', '2022-08-25 07:47:50'),
(7, 'Ir syafig', 'halo@gmail.com', '$2y$10$uvJ4GAcsZ2OUF2xkRL4WwuCK.a2vdr1MEGe1j3wVNjRuN7C1.GudO', '1661747166.jpg', '2022-08-29 04:26:06', '2022-09-11 13:38:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_kelas`
--

CREATE TABLE `guru_kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guru_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `mata_pelajaran_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guru_kelas`
--

INSERT INTO `guru_kelas` (`id`, `guru_id`, `kelas_id`, `mata_pelajaran_id`, `created_at`, `updated_at`) VALUES
(5, 7, 7, NULL, '2022-09-06 07:38:52', '2022-09-06 07:38:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari`
--

CREATE TABLE `hari` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hari`
--

INSERT INTO `hari` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Senin', NULL, NULL),
(2, 'Selasa', NULL, NULL),
(3, 'Rabu', NULL, NULL),
(4, 'Kamis', NULL, NULL),
(5, 'Jumat', NULL, NULL),
(6, 'Saptu', NULL, NULL),
(7, 'Minggu', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `guru_id` int(11) NOT NULL,
  `mata_pelajaran_id` int(11) NOT NULL,
  `hari_id` int(20) NOT NULL,
  `jam_masuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_keluar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwals`
--

INSERT INTO `jadwals` (`id`, `kelas_id`, `guru_id`, `mata_pelajaran_id`, `hari_id`, `jam_masuk`, `jam_keluar`, `created_at`, `updated_at`) VALUES
(14, 9, 7, 4, 3, '00:00', '23:23', '2022-09-01 02:43:07', '2022-09-15 02:49:50'),
(15, 7, 2, 3, 3, '00:00', '23:00', '2022-09-01 06:58:36', '2022-09-05 02:31:08'),
(16, 7, 7, 4, 1, '00:00', '23:00', '2022-09-05 02:30:00', '2022-09-05 02:30:00'),
(17, 7, 7, 6, 7, '00:00', '23:59', '2022-09-05 02:30:24', '2022-09-11 13:38:17'),
(18, 7, 7, 2, 1, '00:00', '23:00', '2022-09-12 10:18:36', '2022-09-19 02:52:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'IPS', '2022-08-24 07:27:56', '2022-08-24 07:30:58'),
(2, 'IPA', '2022-08-24 07:30:45', '2022-08-24 07:30:52'),
(4, 'BAHASA', '2022-08-24 07:31:16', '2022-08-24 07:31:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`, `created_at`, `updated_at`) VALUES
(3, 'KELAS 10 IPA 3', '2022-08-24 06:43:29', '2022-08-31 15:25:11'),
(4, 'KELAS 10 IPA 2', '2022-08-24 06:44:01', '2022-08-31 15:24:58'),
(7, 'KELAS 10 IPA 1', '2022-08-24 07:07:18', '2022-08-31 15:24:47'),
(8, 'KELAS 11 IPA 1', '2022-08-31 15:25:25', '2022-08-31 15:25:25'),
(9, 'KELAS 11 IPA 2', '2022-08-31 15:25:38', '2022-08-31 15:25:38'),
(10, 'KELAS 11 IPA 2', '2022-08-31 15:25:49', '2022-08-31 15:25:49'),
(11, 'KELAS 11 IPA 3', '2022-08-31 15:25:57', '2022-08-31 15:25:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'PPKN', '2022-08-24 07:46:42', '2022-08-24 07:51:02'),
(3, 'MATEMATIKA', '2022-08-24 07:46:54', '2022-08-24 07:46:54'),
(4, 'BAHASA INDONESIA', '2022-08-24 07:47:06', '2022-08-24 07:47:06'),
(5, 'BAHASA INGGRIS', '2022-08-24 07:47:20', '2022-08-24 07:47:20'),
(6, 'AGAMA', '2022-08-24 07:49:05', '2022-08-24 07:49:05'),
(7, 'ELECTRO', '2022-08-24 07:49:36', '2022-08-24 07:49:36'),
(8, 'BAHASA ARAB', '2022-08-24 07:49:44', '2022-08-24 07:49:44'),
(9, 'KIMIA', '2022-08-24 07:49:50', '2022-08-24 07:49:50'),
(10, 'FISIKA', '2022-08-24 07:49:56', '2022-08-24 07:49:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_or_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pertemuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id`, `jadwal_id`, `judul`, `type`, `file_or_link`, `description`, `pertemuan`, `semester`, `tanggal`, `tahun_ajaran`, `kelas_id`, `created_at`, `updated_at`) VALUES
(13, 16, 'dsdsd', 'link', 'dsd', 'ssd', '1', '1', '2022-09-11', '2020', 7, '2022-09-12 08:10:08', '2022-09-12 08:10:08'),
(14, 16, 'sdsd', 'link', 'dsd', 'sd', '2', '1', '2022-09-12', '2020', 7, '2022-09-12 08:10:25', '2022-09-12 08:10:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_08_24_020101_create_jurusan_table', 1),
(5, '2022_08_24_020128_create_kelas_table', 1),
(6, '2022_08_24_020216_create_guru_table', 1),
(7, '2022_08_24_020558_create_mata_pelajaran_table', 2),
(8, '2022_08_24_020614_create_sekolah_table', 2),
(9, '2022_08_24_020853_create_penjaga_perpus_table', 2),
(10, '2022_08_24_021040_create_siswa_table', 2),
(11, '2022_08_24_095817_create_sekolah_table', 3),
(12, '2022_08_22_084211_create_products_table', 4),
(13, '2022_08_22_090114_create_employees_table', 4),
(14, '2022_08_24_145403_create_guru_table', 5),
(15, '2022_08_24_154409_create_tu_table', 6),
(16, '2022_08_24_155746_create_siswa_table', 7),
(17, '2022_08_24_163235_create_ruangan_table', 8),
(18, '2022_08_24_172457_create_penjaga_perpus_table', 9),
(19, '2022_08_25_090442_create_admins_table', 10),
(24, '2022_08_25_102044_create_jadwals_table', 11),
(25, '2022_08_25_102546_create_guru_kelas_table', 11),
(26, '2022_08_25_111142_create_hari_table', 11),
(27, '2022_08_25_120155_create_tugas_table', 12),
(29, '2022_08_26_104103_create_materi_table', 13),
(30, '2022_08_26_110714_create_absen_table', 13),
(32, '2022_08_29_134559_create_pertemuan_table', 14),
(33, '2022_08_29_135311_create_absens_table', 14),
(37, '2022_08_30_103018_create_tugas_table', 15),
(38, '2022_08_30_153328_create_materi_table', 16),
(39, '2022_08_30_194649_create_nilai_tugas_table', 17),
(44, '2022_09_06_102636_create_ulangan_table', 18),
(45, '2022_09_06_102649_create_nilai_ulangan_table', 18),
(46, '2022_09_06_102740_create_ujian_table', 18),
(47, '2022_09_06_102753_create_nilai_ujian_table', 18),
(48, '2022_09_06_143347_create_raport_table', 19),
(49, '2022_09_09_104011_create_pertemuan_table', 20),
(50, '2022_09_09_150959_create_semester_table', 21),
(51, '2022_09_11_210923_create_pertemuan_absen_table', 22),
(52, '2022_09_14_115716_create_category_soal_table', 22),
(53, '2022_09_14_115751_create_pertanyaan_table', 22),
(54, '2022_09_14_115807_create_option_table', 22),
(55, '2022_09_14_115923_create_hasil_table', 22),
(56, '2022_09_14_115954_create_hasil_pertanyaan_table', 22),
(59, '2022_09_15_135915_create_soal_table', 23),
(60, '2022_09_16_092659_create_category_soal_table', 24),
(61, '2022_09_19_115108_create_nilai_table', 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertemuan`
--

CREATE TABLE `pertemuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pertemuan` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `jadwal_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pertemuan`
--

INSERT INTO `pertemuan` (`id`, `pertemuan`, `kelas_id`, `jadwal_id`, `created_at`, `updated_at`) VALUES
(4, 1, 7, 16, '2022-09-11 18:05:02', '2022-09-11 18:05:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertemuan_absen`
--

CREATE TABLE `pertemuan_absen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `raport`
--

CREATE TABLE `raport` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nilai_tugas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_ulangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_ujian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_raport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `raport`
--

INSERT INTO `raport` (`id`, `nilai_tugas`, `nilai_ulangan`, `nilai_ujian`, `nilai_raport`, `semester`, `siswa_id`, `kelas_id`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
(79, '15', '24', '18', '57', '1', 7, 7, '2020', '2022-09-12 07:58:29', '2022-09-12 09:49:51'),
(80, NULL, NULL, NULL, NULL, '1', 8, 7, '2020', '2022-09-12 07:58:29', '2022-09-12 07:58:29'),
(81, NULL, NULL, NULL, NULL, '1', 9, 7, '2020', '2022-09-12 07:58:29', '2022-09-12 07:58:29'),
(82, NULL, NULL, NULL, NULL, '1', 10, 4, '2020', '2022-09-12 07:58:29', '2022-09-12 07:58:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id`, `siswa_id`, `kelas_id`, `created_at`, `updated_at`) VALUES
(23, '7', '7', '2022-09-02 08:37:39', '2022-09-02 08:37:39'),
(24, '8', '7', '2022-09-02 08:37:49', '2022-09-02 08:37:49'),
(25, '9', '7', '2022-09-02 08:38:04', '2022-09-05 02:31:35'),
(26, '10', '4', '2022-09-02 08:38:16', '2022-09-02 08:38:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id`, `name`, `alamat`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'SMA NEMGERI 2 JEPON', 'KECAMATAN JEPON', 'BERDIRI TAHUN 8988', '1661323089.jpg', NULL, '2022-08-24 06:38:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE `semester` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `semester`
--

INSERT INTO `semester` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'tengah semester 1', NULL, NULL),
(2, 'semester 1', NULL, NULL),
(3, 'tengah semester 2', NULL, NULL),
(4, 'semester 2', NULL, NULL),
(5, 'semester akhir', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nisn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `name`, `email`, `password`, `gender`, `alamat`, `image`, `nisn`, `created_at`, `updated_at`) VALUES
(7, 'Ananda Dmmas Budiarto', 'ananda@gmail.com', '$2y$10$rQKqMtOvDWvhspg2cLclxeTweJc2ybuEfssYJccFMI/QqcO/vG296', 'laki laki', 'blora', '1661929224.jpg', '8989988', '2022-08-31 07:00:24', '2022-08-31 07:00:24'),
(8, 'ananda dimmas', 'dimmas@gmail.com', '$2y$10$bVfzXE5ZtrK5GB.DvcgC5uQZFeVFA7YFadSNU7fTBk79bzB9BOlLi', 'laki laki', 'blora', '1661929249.jpg', '989898', '2022-08-31 07:00:49', '2022-08-31 07:00:49'),
(9, 'budiarto', 'budiarto@gmail.com', '$2y$10$02sxSCLdhopNcccoQK5PL.hoyYn9HHw/HyGzRaVyBtfOFLXSmsjxm', 'jkjkj', 'jkkj', '1661929412.jpg', '909009', '2022-08-31 07:03:32', '2022-08-31 07:03:32'),
(10, 'dimmas budiarto', 'dimmasbudiarto@gmail.com', '$2y$10$mOzyUticpvr.FJloDh5b.Otl/j307tZg24.c81Pk23lFdb4p2qtle', 'sd', 'dsd', '1662000999.jpg', '90909', '2022-08-31 07:04:03', '2022-09-01 02:56:40'),
(11, 'aku', 'aku@gmail.com', '$2y$10$Vj6nJrf.tGgfWMYwJULjPeGw/IJUlNpppg5RT1ovwOEbh4abYgyx2', 'laki - laki', 'alamat', '1662000981.jpg', '09090909', '2022-09-01 02:56:21', '2022-09-01 02:56:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guru_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `category_soal_id` int(11) DEFAULT NULL,
  `mata_pelajaran_id` int(11) DEFAULT NULL,
  `soal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opsi_a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opsi_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opsi_c` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opsi_d` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_c` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_d` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jawaban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `pertemuan` int(11) DEFAULT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id`, `guru_id`, `kelas_id`, `category_soal_id`, `mata_pelajaran_id`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `file_a`, `file_b`, `file_c`, `file_d`, `jawaban`, `tahun_ajaran`, `semester_id`, `pertemuan`, `tanggal`, `created_at`, `updated_at`) VALUES
(353, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '20 Sep 2022', '2022-09-19 10:00:33', '2022-09-19 10:00:33'),
(354, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '20 Sep 2022', '2022-09-19 10:00:33', '2022-09-19 10:00:33'),
(355, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '19 Sep 2022', '2022-09-19 10:00:33', '2022-09-19 10:00:33'),
(356, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '19 Sep 2022', '2022-09-19 10:00:33', '2022-09-19 10:00:33'),
(357, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '19 Sep 2022', '2022-09-19 10:00:33', '2022-09-19 10:00:33'),
(358, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '19 Sep 2022', '2022-09-19 10:00:33', '2022-09-19 10:00:33'),
(359, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '19 Sep 2022', '2022-09-19 10:15:44', '2022-09-19 10:15:44'),
(360, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '19 Sep 2022', '2022-09-19 10:15:44', '2022-09-19 10:15:44'),
(361, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '19 Sep 2022', '2022-09-19 10:15:44', '2022-09-19 10:15:44'),
(362, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '19 Sep 2022', '2022-09-19 10:15:44', '2022-09-19 10:15:44'),
(363, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '19 Sep 2022', '2022-09-19 10:15:44', '2022-09-19 10:15:44'),
(364, 7, 7, 4, 2, 'soal', 'a', 'b', 'c', 'd', NULL, NULL, NULL, NULL, 'jawaban', '2022', 1, NULL, '19 Sep 2022', '2022-09-19 10:15:44', '2022-09-19 10:15:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tu`
--

CREATE TABLE `tu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tu`
--

INSERT INTO `tu` (`id`, `name`, `email`, `password`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Ananda petugas TU', 'nanda@gmail.com', '$2y$10$UGJ9nUYKed.RjHjGcjh.vOS251JXjp/o47VLIVxAd9uTONiY7YTRW', '1661331084.jpg', '2022-08-24 08:50:40', '2022-08-24 08:51:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'cinta', 'cinta@gmail.com', NULL, '$2y$10$X7EBGITGHRsHa3nuJVuf7ev0potRk2CkJh58cz0TE1ETbNzn.uEvy', NULL, '2022-08-23 19:19:16', '2022-08-23 19:19:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absens`
--
ALTER TABLE `absens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `category_soal`
--
ALTER TABLE `category_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_email_unique` (`email`);

--
-- Indeks untuk tabel `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pertemuan_absen`
--
ALTER TABLE `pertemuan_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `raport`
--
ALTER TABLE `raport`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_email_unique` (`email`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`nisn`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tu`
--
ALTER TABLE `tu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tu_email_unique` (`email`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absens`
--
ALTER TABLE `absens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT untuk tabel `category_soal`
--
ALTER TABLE `category_soal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `hari`
--
ALTER TABLE `hari`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pertemuan`
--
ALTER TABLE `pertemuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pertemuan_absen`
--
ALTER TABLE `pertemuan_absen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `raport`
--
ALTER TABLE `raport`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `semester`
--
ALTER TABLE `semester`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;

--
-- AUTO_INCREMENT untuk tabel `tu`
--
ALTER TABLE `tu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

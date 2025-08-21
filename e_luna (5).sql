-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2025 at 09:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_luna`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `sumber_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_anggaran` year(4) NOT NULL,
  `stok` int(11) NOT NULL,
  `stok_minimum` int(11) NOT NULL DEFAULT 0,
  `satuan` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `tanggal_kadaluwarsa` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_3` varchar(255) DEFAULT NULL,
  `kode_4` varchar(255) DEFAULT NULL,
  `kode_5` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama_barang`, `kode_barang`, `kategori_id`, `sumber_id`, `tahun_anggaran`, `stok`, `stok_minimum`, `satuan`, `harga`, `total`, `tanggal_kadaluwarsa`, `created_at`, `updated_at`, `kode_3`, `kode_4`, `kode_5`, `status`) VALUES
(4, 'Kasur', 'N3.1.1.01.001', 3, 1, '2025', 2, 5, 'Pcs', 1000000.00, 4000000.00, '2025-08-22', '2025-07-01 02:53:00', '2025-08-21 00:32:38', '1', '01', '001', 'Sudah Ditambah'),
(7, 'Selimut', 'N3.1.1.2.3', 3, 1, '2025', 54, 50, 'Pcs', 112111.00, 6166105.00, '2025-08-27', '2025-08-13 03:02:37', '2025-08-21 00:31:13', '1', '2', '3', NULL),
(8, 'Kasur', 'N3.1.2.3.2', 3, 1, '2025', 10, 0, 'Pcs', 123123.00, 1477476.00, '2025-08-27', '2025-08-20 03:12:21', '2025-08-20 05:52:57', '2', '3', '2', NULL),
(9, 'Meja', 'D1.2.2.3.4', 4, 7, '2025', 119, 0, 'Pcs', 123123.00, 15144129.00, '2025-08-27', '2025-08-20 03:12:59', '2025-08-20 05:58:40', '2', '3', '4', NULL),
(10, 'Komputer', 'N5.1.4.5.6', 3, 6, '2025', 10, 0, 'Pcs', 1000000.00, 10000000.00, NULL, '2025-08-21 00:27:36', '2025-08-21 00:27:36', '4', '5', '6', NULL),
(11, 'Laptop', 'D1.1.1.2.3', 3, 7, '2025', 15, 0, 'Pcs', 1500000.00, 22500000.00, NULL, '2025-08-21 00:50:44', '2025-08-21 00:50:44', '1', '2', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gudangs`
--

CREATE TABLE `gudangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qr_code` text NOT NULL,
  `blok` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gudangs`
--

INSERT INTO `gudangs` (`id`, `qr_code`, `blok`, `kategori_id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Blok: A2 | Kategori: Pangan | Keterangan: Kelompok Makanan', 'A2', 3, 'Kelompok Makanan', '2025-06-26 03:10:14', '2025-06-26 03:45:12'),
(3, 'Blok: A3 | Kategori: Pangan | Keterangan: Kelompok Makanan RIngan', 'A3', 3, 'Kelompok Makanan RIngan', '2025-06-26 03:24:46', '2025-06-26 03:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `kode`, `created_at`, `updated_at`) VALUES
(3, 'Pangan', '1', '2025-06-26 02:06:05', '2025-07-01 02:21:14'),
(4, 'Sandang', '2', '2025-07-18 07:56:24', '2025-07-18 07:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_barangs`
--

CREATE TABLE `lokasi_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `gudang_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi_barangs`
--

INSERT INTO `lokasi_barangs` (`id`, `barang_id`, `gudang_id`, `stok`, `catatan`, `created_at`, `updated_at`) VALUES
(5, 4, 1, 2, 'ja', '2025-07-01 07:29:11', '2025-07-18 22:18:28'),
(8, 4, 3, 5, NULL, '2025-07-18 22:17:07', '2025-07-18 22:17:07'),
(9, 4, 1, 1, NULL, '2025-08-21 00:51:36', '2025-08-21 00:51:36'),
(10, 7, 1, 1, NULL, '2025-08-21 00:51:36', '2025-08-21 00:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_26_061317_create_users_table', 2),
(5, '2025_06_26_072959_create_sumbers_table', 3),
(6, '2025_06_26_084640_create_kategoris_table', 4),
(7, '2025_06_26_091806_create_tujuans_table', 5),
(8, '2025_06_26_095807_create_gudangs_table', 6),
(9, '2025_06_27_082844_create_usulan_logpals_table', 7),
(10, '2025_06_27_101131_create_p_logpal_table', 8),
(11, '2025_07_01_083448_create_barangs_table', 9),
(12, '2025_07_01_093939_add_kode_levels_to_barangs_table', 10),
(13, '2025_07_01_095122_alter_tanggal_kadaluwarsa_nullable_on_barangs_table', 11),
(14, '2025_07_01_103200_add_status_to_barangs_table', 12),
(15, '2025_07_01_121647_create_lokasi_barangs_table', 13),
(16, '2025_07_01_144336_create_rencana_alokasis_table', 14),
(17, '2025_07_01_153256_add_status_to_rencana_alokasis_table', 15),
(18, '2025_07_16_140026_create_permohonans_table', 16),
(19, '2025_07_16_155440_create_permohonan_baratas_table', 17),
(20, '2025_07_16_163306_add_dokumen_to_permohonan_baratas_table', 18),
(21, '2025_07_16_164800_create_pengirimans_table', 19),
(22, '2025_07_16_175613_create_penghapusans_table', 20),
(23, '2025_07_16_181054_create_stok_opnames_table', 21),
(24, '2025_08_13_092554_create_pengiriman_barangs_table', 22),
(25, '2025_08_20_100532_add_stok_minimum_to_barangs_table', 23),
(26, '2025_08_20_100957_modify_stok_minimum_default_in_barangs_table', 24),
(27, '2025_08_20_115649_create_pengiriman_barangs_table', 25);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penghapusans`
--

CREATE TABLE `penghapusans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penghapusans`
--

INSERT INTO `penghapusans` (`id`, `judul`, `tanggal`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Ayam', '2025-07-16', 'Kabur', '2025-07-16 11:03:58', '2025-07-16 11:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `pengirimans`
--

CREATE TABLE `pengirimans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `tujuan_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_tujuan` enum('sama','tidak sama') NOT NULL DEFAULT 'sama',
  `tahun` year(4) NOT NULL,
  `dokumen_bast` varchar(255) DEFAULT NULL,
  `delivery_order` varchar(255) DEFAULT NULL,
  `no_wa` varchar(255) DEFAULT NULL,
  `stnk` varchar(255) DEFAULT NULL,
  `sim_driver` varchar(255) DEFAULT NULL,
  `foto_kendaraan` varchar(255) DEFAULT NULL,
  `unloading` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengirimans`
--

INSERT INTO `pengirimans` (`id`, `no_surat`, `tanggal_surat`, `tanggal_pengiriman`, `tujuan_id`, `lokasi_tujuan`, `tahun`, `dokumen_bast`, `delivery_order`, `no_wa`, `stnk`, `sim_driver`, `foto_kendaraan`, `unloading`, `created_at`, `updated_at`) VALUES
(3, '23423/gsdgsds', '2025-07-17', '2025-07-29', 1, 'tidak sama', '2025', 'pengiriman/VjclwlNujWWT6cawkQrPNSXzpmTtqesFZwrf1haC.png', NULL, NULL, NULL, NULL, NULL, 'diterima', '2025-07-16 10:16:50', '2025-08-20 07:22:31'),
(4, '23423/gssad', '2025-08-20', '2025-08-28', 3, 'sama', '2025', NULL, NULL, NULL, NULL, NULL, NULL, 'diterima', '2025-08-20 05:36:06', '2025-08-20 07:16:18'),
(5, 'sdfsfs', '2025-08-20', '2025-08-21', 3, 'sama', '2025', NULL, NULL, NULL, NULL, NULL, NULL, 'diterima', '2025-08-20 05:52:48', '2025-08-20 05:53:10'),
(6, 'Juasad/12412', '2025-08-22', '2025-08-28', 1, 'sama', '2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-21 00:30:55', '2025-08-21 00:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman_barangs`
--

CREATE TABLE `pengiriman_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `pengiriman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL DEFAULT 'dikirim',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengiriman_barangs`
--

INSERT INTO `pengiriman_barangs` (`id`, `barang_id`, `pengiriman_id`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 1, 'dikirim', '2025-08-20 05:03:48', '2025-08-20 05:03:48'),
(2, 4, 3, 1, 'dikirim', '2025-08-20 05:05:18', '2025-08-20 05:05:18'),
(3, 7, NULL, 1, 'dikirim', '2025-08-20 05:18:00', '2025-08-20 05:18:00'),
(4, 7, 3, 1, 'dikirim', '2025-08-20 05:33:43', '2025-08-20 05:33:43'),
(5, 8, 3, 1, 'dikirim', '2025-08-20 05:33:43', '2025-08-20 05:33:43'),
(6, 9, 3, 1, 'dikirim', '2025-08-20 05:33:43', '2025-08-20 05:33:43'),
(7, 8, 5, 1, 'dikirim', '2025-08-20 05:52:57', '2025-08-20 05:52:57'),
(8, 9, 5, 1, 'dikirim', '2025-08-20 05:52:57', '2025-08-20 05:52:57'),
(9, 9, NULL, 1, 'dikirim', '2025-08-20 05:53:38', '2025-08-20 05:53:38'),
(10, 9, NULL, 1, 'dikirim', '2025-08-20 05:58:40', '2025-08-20 05:58:40'),
(11, 7, 3, 1, 'dikirim', '2025-08-20 21:31:38', '2025-08-20 21:31:38'),
(12, 4, 6, 1, 'dikirim', '2025-08-21 00:31:13', '2025-08-21 00:31:13'),
(13, 7, 6, 1, 'dikirim', '2025-08-21 00:31:13', '2025-08-21 00:31:13'),
(14, 4, 6, 1, 'dikirim', '2025-08-21 00:32:38', '2025-08-21 00:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `permohonans`
--

CREATE TABLE `permohonans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tujuan_id` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tahun_surat` year(4) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permohonans`
--

INSERT INTO `permohonans` (`id`, `tujuan_id`, `no_surat`, `tanggal_surat`, `tahun_surat`, `keperluan`, `dokumen`, `created_at`, `updated_at`) VALUES
(7, 1, '23423/gsdgsdsarra', '2025-08-05', '2023', 'fsfa', 'dokumen_permohonan/69ARmqlJPuRTwP4LawLK40yaFfkYwFAkwIM7oDMi.png', '2025-07-16 08:18:41', '2025-07-16 11:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_baratas`
--

CREATE TABLE `permohonan_baratas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tujuan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_kejadian` date NOT NULL,
  `kejadian` varchar(255) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permohonan_baratas`
--

INSERT INTO `permohonan_baratas` (`id`, `tujuan_id`, `tanggal_kejadian`, `kejadian`, `no_surat`, `status`, `dokumen`, `created_at`, `updated_at`) VALUES
(5, 1, '2025-07-10', 'Banjir', '23423/gsdgsds', 'ditolak', 'dokumen_barata/WecAKWRZAV3RaIAMceZFZmMUvD0wYcW8cWOOg8HH.png', '2025-07-16 09:34:34', '2025-07-18 23:12:31'),
(7, 1, '2025-08-04', 'Banjir', '23423/gsdgsds', 'disetujui', 'dokumen_barata/pE7e7VQ5ccOvtu7go3csIWSHzDOxPrjiClmGDEPJ.png', '2025-08-04 02:37:17', '2025-08-04 02:37:23'),
(8, 1, '2025-08-26', 'Banjir', '787761', 'disetujui', 'dokumen_barata/eY6rVdOABy4fhYWZrMkUClWvoJnwOmBBwox9lG9n.png', '2025-08-04 02:39:32', '2025-08-04 02:39:42'),
(9, 1, '2025-08-21', 'Banjir', 'Bandungkab/VII', 'disetujui', 'dokumen_barata/hOgZiAB5dG6T5jKVfQnG5bju6Dmx8Wv6iJ9jOLfe.png', '2025-08-21 00:34:00', '2025-08-21 00:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `p_logpal`
--

CREATE TABLE `p_logpal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penerimaan` enum('logistik','peralatan') NOT NULL,
  `usulan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_surat_bast` varchar(255) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `nama_pengirim` varchar(255) DEFAULT NULL,
  `dokumen_bast` varchar(255) DEFAULT NULL,
  `delivery_order` varchar(255) DEFAULT NULL,
  `no_whatsapp` varchar(255) DEFAULT NULL,
  `stnk` varchar(255) DEFAULT NULL,
  `sim_driver` varchar(255) DEFAULT NULL,
  `foto_kendaraan` varchar(255) DEFAULT NULL,
  `foto_unloading` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `p_logpal`
--

INSERT INTO `p_logpal` (`id`, `penerimaan`, `usulan_id`, `no_surat_bast`, `tanggal_surat`, `tanggal_masuk`, `nama_pengirim`, `dokumen_bast`, `delivery_order`, `no_whatsapp`, `stnk`, `sim_driver`, `foto_kendaraan`, `foto_unloading`, `created_at`, `updated_at`) VALUES
(7, 'peralatan', 2, 'tryyaa', '2025-06-04', '2025-07-04', 'tera', '1751023021_Logo Unla lama.png', '1751023021_Logo Unla lama.png', '6777', '1751023021_Logo Unla lama.png', '1751023021_Logo Unla lama.png', '1751023021_Logo Unla lama.png', '1751023021_Logo Unla lama.png', '2025-06-27 04:17:01', '2025-06-27 04:17:08'),
(9, 'logistik', 2, 'asdas', '2025-06-27', '2025-06-27', 'qweqwe', NULL, NULL, '1111', NULL, NULL, NULL, NULL, '2025-06-27 04:47:27', '2025-06-27 04:47:27'),
(10, 'peralatan', NULL, 'Ba/asdasd', '2025-08-20', '2025-08-28', 'asda', NULL, NULL, '765675', NULL, NULL, NULL, NULL, '2025-08-20 03:28:30', '2025-08-20 03:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `rencana_alokasis`
--

CREATE TABLE `rencana_alokasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rencana_alokasis`
--

INSERT INTO `rencana_alokasis` (`id`, `no_surat`, `tanggal`, `tahun`, `dokumen`, `created_at`, `updated_at`, `status`) VALUES
(7, 'rrr', '2025-07-17', '2025', 'dokumen_alokasi/wVnfiEJmymS3yObgPKencsWVspVYSiCafmD2wn26.png', '2025-07-18 22:45:50', '2025-07-19 02:11:38', 'ditolak'),
(8, '23423/gsdgsds', '2025-08-04', '2025', 'dokumen_alokasi/4ur24r1yHJJxzBWkj4L4bHHhnDDmWyyn9jSApoAn.png', '2025-08-04 02:27:08', '2025-08-04 02:29:28', 'disetujui'),
(9, '23423/gsdgsds', '2025-08-04', '2025', 'dokumen_alokasi/JBsa2ELXkqHuCTFENsuqMaxfkRgZiRKeTHYjI7L5.png', '2025-08-04 02:27:08', '2025-08-04 02:32:17', 'disetujui'),
(10, '23423/gsdgsd', '2025-08-04', '2025', 'dokumen_alokasi/OI9NOWLLDuTwa4y2yONkSnWs3lc6N3SCys8MhzAo.png', '2025-08-04 02:32:30', '2025-08-04 02:32:36', 'ditolak'),
(11, '787761', '2025-08-05', '2025', 'dokumen_alokasi/QQQXaBlkEjJ1Yfz4zcyyhyJs5GRhIkwyBjE0B50t.png', '2025-08-04 02:36:22', '2025-08-13 02:15:39', 'ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EsrET61u7rrb5KsTIpygXl8RMDsWAUgkoiGXk7NZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidnN5czhUeXVibnBycHNQV1lSV1pyaFNoTGJZSGRIeWFHZDBTd0JJMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1755763031);

-- --------------------------------------------------------

--
-- Table structure for table `stok_opnames`
--

CREATE TABLE `stok_opnames` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stok_opnames`
--

INSERT INTO `stok_opnames` (`id`, `judul`, `tanggal`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Ayam', '2025-07-16', 'Kabur', '2025-07-16 11:29:09', '2025-07-16 11:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `sumbers`
--

CREATE TABLE `sumbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_sumber` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sumbers`
--

INSERT INTO `sumbers` (`id`, `nama_sumber`, `kode`, `created_at`, `updated_at`) VALUES
(1, 'APBN D3', 'N3', '2025-06-26 00:39:26', '2025-06-26 00:39:55'),
(6, 'APBN D5', 'N5', '2025-07-18 07:40:40', '2025-07-18 07:40:40'),
(7, 'APBD', 'D1', '2025-07-18 07:40:55', '2025-07-18 07:40:55'),
(8, 'CSR', 'C1', '2025-07-18 07:41:05', '2025-07-18 07:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `tujuans`
--

CREATE TABLE `tujuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kab_kota` varchar(255) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tujuans`
--

INSERT INTO `tujuans` (`id`, `kab_kota`, `instansi`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Kota Bandung', 'Bandung PT', 'Jl Bandung Barat', '2025-06-26 02:26:58', '2025-06-26 02:27:06'),
(3, 'Kota Cimahi', 'Cimahi', 'Jl.Cimahi', '2025-07-18 08:24:47', '2025-07-18 08:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','operator') NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Admin Utama', 'admin@eluna.com', '$2y$12$7l3R3JwhRJDambf7aQixR.z214SaGkz5RwwOVbuAP8J4qXRtmQFXa', 'admin', 'ADMIN GUDANG', '2025-06-25 23:20:51', '2025-06-25 23:20:51'),
(9, 'Putraa', 'putra123@gmail.com', '$2y$12$.eyXi/qzh6S2pQ1il9b4puWTBC0gw7w6cQldgnF4SOW2cAzfjJyfK', 'operator', 'Staff Manager', '2025-07-18 07:13:28', '2025-07-18 07:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `usulan_logpals`
--

CREATE TABLE `usulan_logpals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tahun_anggaran` varchar(255) NOT NULL,
  `sumber_id` bigint(20) UNSIGNED NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usulan_logpals`
--

INSERT INTO `usulan_logpals` (`id`, `no_surat`, `tanggal_surat`, `tahun_anggaran`, `sumber_id`, `dokumen`, `created_at`, `updated_at`) VALUES
(2, '7877611', '2025-06-27', '2025', 1, '1751017021_Logo Unla.png', '2025-06-27 02:37:01', '2025-06-27 02:37:01'),
(3, '787761/11', '2025-07-18', '2025', 6, '1752854419_ChatGPT Image Jul 1, 2025, 03_07_20 PM.png', '2025-07-18 09:00:19', '2025-07-18 09:00:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangs_kategori_id_foreign` (`kategori_id`),
  ADD KEY `barangs_sumber_id_foreign` (`sumber_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gudangs`
--
ALTER TABLE `gudangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gudangs_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategoris_kode_unique` (`kode`);

--
-- Indexes for table `lokasi_barangs`
--
ALTER TABLE `lokasi_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lokasi_barangs_barang_id_foreign` (`barang_id`),
  ADD KEY `lokasi_barangs_gudang_id_foreign` (`gudang_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penghapusans`
--
ALTER TABLE `penghapusans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengirimans`
--
ALTER TABLE `pengirimans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengirimans_tujuan_id_foreign` (`tujuan_id`);

--
-- Indexes for table `pengiriman_barangs`
--
ALTER TABLE `pengiriman_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengiriman_barangs_barang_id_foreign` (`barang_id`),
  ADD KEY `pengiriman_barangs_pengiriman_id_foreign` (`pengiriman_id`);

--
-- Indexes for table `permohonans`
--
ALTER TABLE `permohonans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permohonans_tujuan_id_foreign` (`tujuan_id`);

--
-- Indexes for table `permohonan_baratas`
--
ALTER TABLE `permohonan_baratas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permohonan_baratas_tujuan_id_foreign` (`tujuan_id`);

--
-- Indexes for table `p_logpal`
--
ALTER TABLE `p_logpal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_logpal_usulan_id_foreign` (`usulan_id`);

--
-- Indexes for table `rencana_alokasis`
--
ALTER TABLE `rencana_alokasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stok_opnames`
--
ALTER TABLE `stok_opnames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sumbers`
--
ALTER TABLE `sumbers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sumbers_kode_unique` (`kode`);

--
-- Indexes for table `tujuans`
--
ALTER TABLE `tujuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usulan_logpals`
--
ALTER TABLE `usulan_logpals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usulan_logpals_sumber_id_foreign` (`sumber_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gudangs`
--
ALTER TABLE `gudangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lokasi_barangs`
--
ALTER TABLE `lokasi_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `penghapusans`
--
ALTER TABLE `penghapusans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengirimans`
--
ALTER TABLE `pengirimans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengiriman_barangs`
--
ALTER TABLE `pengiriman_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permohonans`
--
ALTER TABLE `permohonans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permohonan_baratas`
--
ALTER TABLE `permohonan_baratas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `p_logpal`
--
ALTER TABLE `p_logpal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rencana_alokasis`
--
ALTER TABLE `rencana_alokasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stok_opnames`
--
ALTER TABLE `stok_opnames`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sumbers`
--
ALTER TABLE `sumbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tujuans`
--
ALTER TABLE `tujuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usulan_logpals`
--
ALTER TABLE `usulan_logpals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barangs_sumber_id_foreign` FOREIGN KEY (`sumber_id`) REFERENCES `sumbers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gudangs`
--
ALTER TABLE `gudangs`
  ADD CONSTRAINT `gudangs_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lokasi_barangs`
--
ALTER TABLE `lokasi_barangs`
  ADD CONSTRAINT `lokasi_barangs_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lokasi_barangs_gudang_id_foreign` FOREIGN KEY (`gudang_id`) REFERENCES `gudangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengirimans`
--
ALTER TABLE `pengirimans`
  ADD CONSTRAINT `pengirimans_tujuan_id_foreign` FOREIGN KEY (`tujuan_id`) REFERENCES `tujuans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengiriman_barangs`
--
ALTER TABLE `pengiriman_barangs`
  ADD CONSTRAINT `pengiriman_barangs_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengiriman_barangs_pengiriman_id_foreign` FOREIGN KEY (`pengiriman_id`) REFERENCES `pengirimans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permohonans`
--
ALTER TABLE `permohonans`
  ADD CONSTRAINT `permohonans_tujuan_id_foreign` FOREIGN KEY (`tujuan_id`) REFERENCES `tujuans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permohonan_baratas`
--
ALTER TABLE `permohonan_baratas`
  ADD CONSTRAINT `permohonan_baratas_tujuan_id_foreign` FOREIGN KEY (`tujuan_id`) REFERENCES `tujuans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `p_logpal`
--
ALTER TABLE `p_logpal`
  ADD CONSTRAINT `p_logpal_usulan_id_foreign` FOREIGN KEY (`usulan_id`) REFERENCES `usulan_logpals` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `usulan_logpals`
--
ALTER TABLE `usulan_logpals`
  ADD CONSTRAINT `usulan_logpals_sumber_id_foreign` FOREIGN KEY (`sumber_id`) REFERENCES `sumbers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

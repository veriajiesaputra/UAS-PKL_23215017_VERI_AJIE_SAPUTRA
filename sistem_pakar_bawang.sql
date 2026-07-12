-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2026 at 07:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_pakar_bawang`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1783843177),
('5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1783843177;', 1783843177),
('landing.stats', 'a:4:{s:8:\"penyakit\";i:4;s:4:\"hama\";i:5;s:6:\"gejala\";i:40;s:7:\"deteksi\";i:0;}', 1783843661);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_gejala` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_gejala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id`, `kode_gejala`, `nama_gejala`, `created_at`, `updated_at`) VALUES
(1, 'GB01', 'Terdapat bercak melekuk pada daun', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(2, 'GB02', 'Terdapat bintik lingkaran berwarna ungu pada pusatnya yang melebar semakin menipis', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(3, 'GB03', 'Bagian yang terserang umumnya berbentuk cekungan', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(4, 'GB04', 'Bercak dapat menyatu membentuk hawar, dikelilingi zona kekuningan', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(5, 'GB05', 'Infeksi dapat menjalar ke leher umbi menyebabkan pembusukan basah', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(6, 'GB06', 'Ditandai dengan bercak putih pada daun', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(7, 'GB07', 'Membentuk lekukan yang menyebabkan daun menjadi patah (mati bujang)', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(8, 'GB08', 'Rebahnya tanaman terjadi secara mendadak (otomatis)', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(9, 'GB09', 'Pada kondisi lembap, muncul massa spora (aservulus) kemerahan/jingga pada lekukan daun', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(10, 'GB10', 'Umbi mengecil dan rentan busuk saat disimpan', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(11, 'GB11', 'Daun bawang menguning, terpelintir (ngoler), dan selanjutnya tanaman menjadi layu', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(12, 'GB12', 'Gejala dimulai dari ujung daun dan akhirnya tanaman mati', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(13, 'GB13', 'Akar membusuk dan jika umbi dipotong membujur, tampak pembusukan yang berair', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(14, 'GB14', 'Tanaman layu sangat mudah dicabut dari tanah', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(15, 'GB15', 'Terdapat miselium jamur berwarna putih kemerahan di dasar umbi/pangkal batang', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(16, 'GB16', 'Timbul bercak hijau pucat di dekat ujung daun (muncul sejak tanaman mulai membentuk umbi)', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(17, 'GB17', 'Pada kondisi lembap, timbul kapang/jamur berwarna putih lembayung atau ungu', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(18, 'GB18', 'Daun akan segera menguning, layu, dan mati', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(19, 'GB19', 'Infeksi sistemik membuat tunas/daun baru tumbuh pucat dan melengkung abnormal', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(20, 'GB20', 'Umbi menjadi kerdil, lunak, dan berkerut', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(21, 'GB21', 'Timbulnya bercak-bercak putih transparan pada daun', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(22, 'GB22', 'Larva masuk dan bersembunyi di dalam rongga daun bawang', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(23, 'GB23', 'Larva memakan jaringan klorofil dari dalam daun, menyisakan kulit luar (epidermis)', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(24, 'GB24', 'Daun bawang akhirnya terkulai, mengering, atau berlubang besar', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(25, 'GB25', 'Berbeda dengan ulat bawang, larva memakan daun dari bagian luar', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(26, 'GB26', 'Larva instar awal makan secara berkelompok (grayak)', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(27, 'GB27', 'Pada serangan berat, daun robek, berlubang besar, atau habis menyisakan pelepahnya', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(28, 'GB28', 'Daun yang terserang pada permukaan bawahnya berwarna keperak-perakan', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(29, 'GB29', 'Daun tampak mengeriting atau keriput', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(30, 'GB30', 'Terdapat bintik-bintik kotoran berwarna hitam di sekitar area yang mengering', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(31, 'GB31', 'Ujung daun berubah menjadi kecokelatan dan mati (nekrosis)', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(32, 'GB32', 'Pertumbuhan terhambat, menyebabkan umbi tidak membesar optimal', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(33, 'GB33', 'Terdapat bintik-bintik putih pada daun akibat tusukan alat bertelur (ovipositor)', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(34, 'GB34', 'Terlihat alur korokan yang berkelok-kelok berwarna putih (jejak larva memakan daun)', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(35, 'GB35', 'Alur korokan dapat melebar dan menyatu menutupi permukaan daun', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(36, 'GB36', 'Pada serangan berat, seluruh jaringan daun mengering seperti terbakar', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(37, 'GB37', 'Tanaman menjadi layu karena akar rusak dimakan hama', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(38, 'GB38', 'Secara spesifik memakan akar, umbi, dan pangkal batang tanaman muda', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(39, 'GB39', 'Terdapat lorong-lorong galian di sekitar permukaan tanah', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(40, 'GB40', 'Bibit rebah atau patah mendadak di pagi hari akibat pangkalnya terpotong', '2026-07-12 07:55:34', '2026-07-12 07:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `hama`
--

CREATE TABLE `hama` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_hama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_hama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `solusi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hama`
--

INSERT INTO `hama` (`id`, `kode_hama`, `nama_hama`, `deskripsi`, `solusi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'BAWANG-H01', 'Ulat Bawang', 'Hama ulat Spodoptera exigua yang larva-nya memakan jaringan daun dari dalam rongga daun bawang.', 'Cara Kimia: Aplikasikan pestisida baiknya pada sore atau malam hari pada saat ulat keluar dari dalam rongga daun. Pestisida yang dapat digunakan diantaranya yang berbahan aktif emamektin benzoat, broflanilida, klorantraniliprol, spinetoram, diaplikasikan sesuai dengan dosis yang tertera pada label.\n\nCara Hayati: Sebelum ambang batas pengendalian dapat menggunakan agens hayati seperti Bacillus thuringiensis dan Beauveria bassiana.\n\nAlternatif/Saran Praktis: Potong ujung daun bawang yang terlihat memiliki kelompok telur putih, lalu musnahkan. Pasang perangkap lampu (lampu minyak/bohlam) di malam hari di atas ember berisi air sabun untuk menangkap ngengat (kupu-kupu) dewasa.', 'assets/images/targets/bawang-h01.jpg', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(2, 'BAWANG-H02', 'Ulat Grayak', 'Hama ulat Spodoptera litura yang memakan daun bawang dari bagian luar secara berkelompok.', 'Cara Kimia: Aplikasikan pestisida pada pagi atau sore hari. Pestisida yang dapat digunakan antara lain pestisida berbahan aktif Emamektin benzoate, Klorfluazuron, Klorpirifos, Flubendiamid dan Siantraniliprol, diaplikasikan sesuai dengan dosis yang tertera pada label.\n\nCara Hayati: Sebelum ambang batas pengendalian dapat menggunakan agens hayati seperti Bacillus thuringiensis dan Beauveria bassiana. Semprotkan secara merata ke seluruh permukaan daun.\n\nAlternatif/Saran Praktis: Ulat ini suka bersembunyi di siang hari. Bersihkan gulma di sekitar bedengan karena gulma sering menjadi tempat persembunyian ulat grayak.', 'assets/images/targets/bawang-h02.jpg', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(3, 'BAWANG-H03', 'Thrips Bawang', 'Hama Thrips tabaci pengisap daun bawang, menyebabkan daun keperak-perakan dan pertumbuhan terhambat.', 'Cara Kimia: Aplikasikan pestisida pada pagi atau sore hari. Pestisida yang dapat digunakan antara lain pestisida berbahan aktif Abamektin, Imidakloprid, Spirotetramat, Klofenapir, Dinotefuran, dan Fipronil, diaplikasikan sesuai dengan dosis yang tertera pada label.\n\nCara Hayati: Sebelum ambang batas pengendalian dapat menggunakan agens hayati seperti Metarhizium anisopliae dan Beauveria bassiana.\n\nAlternatif/Saran Praktis: Hama trips menyerang hebat saat musim kemarau. Jaga kelembapan tanah dengan penyiraman rutin. Pasang perangkap warna kuning lengket (yellow sticky trap) di beberapa titik bedengan untuk menangkap trips terbang.', 'assets/images/targets/bawang-h03.jpg', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(4, 'BAWANG-H04', 'Lalat Penggorok Daun (Grandong)', 'Hama Liriomyza chinensis yang larva-nya menggorek daun bawang membentuk alur putih berkelok.', 'Cara Kimia: Aplikasikan pestisida pada pagi atau sore hari. Pestisida yang dapat digunakan antara lain pestisida berbahan aktif Siromazin, abamektin, emamektin benzoat, atau siromazin diaplikasikan sesuai dengan dosis yang tertera pada label.\n\nCara Hayati: Sebelum ambang batas pengendalian dapat menggunakan agens hayati seperti Trichoderma sp. dan Beauveria bassiana.\n\nAlternatif/Saran Praktis: Jika melihat daun dengan alur putih berbelok-belok (korokan), segera cabut dan bakar daun tersebut sebelum larva berubah menjadi lalat dewasa dan menyebar.', 'assets/images/targets/bawang-h04.jpg', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(5, 'BAWANG-H05', 'Orong-orong', 'Hama Gryllotalpa sp. yang memakan akar, umbi, dan pangkal batang tanaman bawang muda.', 'Cara Kimia: Taburkan butiran Karbofuran 3% (contoh: Furadan 3GR) ke tanah di sekitar pangkal tanaman sebanyak 15–20 kg/hektar.\n\nAlternatif/Saran Praktis: Genangi lahan atau bedengan secara merata sesaat sebelum penanaman. Orong-orong tidak tahan air dan akan naik ke permukaan, sehingga mudah diambil atau dimakan oleh predator seperti burung.', 'assets/images/targets/bawang-h05.jpg', '2026-07-12 07:55:34', '2026-07-12 07:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_26_100513_create_gejala_table', 1),
(5, '2026_05_26_100514_create_penyakit_table', 1),
(6, '2026_05_26_100515_create_hama_table', 1),
(7, '2026_05_26_100516_create_rules_table', 1),
(8, '2026_05_26_100517_create_rule_details_table', 1),
(9, '2026_05_26_200000_create_riwayat_deteksi_table', 1),
(10, '2026_05_26_210000_add_pengguna_role_to_users_table', 1),
(11, '2026_05_26_220000_add_gambar_to_penyakit_and_hama_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_penyakit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penyakit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `solusi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id`, `kode_penyakit`, `nama_penyakit`, `deskripsi`, `solusi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'BAWANG-P01', 'Penyakit Trotol (Bercak Ungu)', 'Penyakit jamur Alternaria porri dengan bercak ungu melingkar dan hawar dikelilingi zona kekuningan pada daun bawang merah.', 'Cara Kimia: Semprotkan fungisida kontak Mankozeb (contoh: Dithane) dosis 2–3 gram/liter air saat embun mengering.\n\nCara Hayati: Pemanfaatan mikroorganisme antagonis seperti Pseudomonas fluorescens, Trichoderma sp., dan Bacillus subtilis untuk menekan pertumbuhan patogen secara alami.\n\nAlternatif/Saran Praktis: Atur jarak tanam agar tidak terlalu rapat. Penyakit ini dipicu oleh sirkulasi udara yang buruk dan genangan air. Pastikan parit (drainase) lancar.', 'assets/images/targets/bawang-p01.jpg', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(2, 'BAWANG-P02', 'Penyakit Otomatis (Antraknose)', 'Penyakit jamur Colletotrichum spp. ditandai bercak putih, lekukan daun, dan tanaman rebah mendadak.', 'Cara Kimia: Semprotkan fungisida Propineb (contoh: Antracol) dosis 2 gram/liter air secara rutin, terutama jika cuaca sering mendung dan lembap.\n\nCara Hayati: Pemanfaatan mikroorganisme antagonis seperti Pseudomonas fluorescens, Trichoderma sp., dan Bacillus subtilis untuk menekan pertumbuhan patogen secara alami.\n\nAlternatif/Saran Praktis: Lakukan rotasi tanaman (jangan menanam bawang merah berturut-turut di lahan yang sama). Segera cabut tanaman yang patah mendadak (\"mati bujang\") dan jauhkan dari lahan.', 'assets/images/targets/bawang-p02.jpg', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(3, 'BAWANG-P03', 'Penyakit Moler (Layu Fusarium)', 'Penyakit jamur Fusarium oxysporum menyebabkan daun ngoler, layu, akar busuk, dan miselium putih kemerahan di pangkal umbi.', 'Cara Kimia: Karena menyerang akar dan pangkal batang, siram/kocorkan fungisida Benomil (contoh: Benlate) 2 gram/liter air ke area perakaran.\n\nCara Hayati: Pemanfaatan mikroorganisme antagonis seperti Pseudomonas fluorescens, Trichoderma sp., dan Bacillus subtilis untuk menekan pertumbuhan patogen secara alami.\n\nAlternatif/Saran Praktis: Cara terbaik adalah pencegahan alami. Sebelum menanam, campurkan pupuk kandang/kompos dengan agens pengendali hayati Trichoderma sp.', 'assets/images/targets/bawang-p03.jpg', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(4, 'BAWANG-P04', 'Penyakit Embun Tepung (Downy Mildew)', 'Penyakit jamur Peronospora destructor dengan bercak hijau pucat dan kapang putih/ungu pada daun bawang.', 'Cara Kimia: Gunakan fungisida berbahan aktif Azoksistrobin (contoh: Amistar) dosis 1 ml/liter air.\n\nCara Hayati: Pemanfaatan mikroorganisme antagonis seperti Pseudomonas fluorescens, Trichoderma sp., dan Bacillus subtilis untuk menekan pertumbuhan patogen secara alami.\n\nAlternatif/Saran Praktis: Jika malam hari turun hujan atau embun sangat tebal, bilas daun bawang merah dengan air bersih di pagi hari sebelum terik matahari untuk mencuci spora jamur yang menempel.', 'assets/images/targets/bawang-p04.jpg', '2026-07-12 07:55:34', '2026-07-12 07:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_deteksi`
--

CREATE TABLE `riwayat_deteksi` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `nama_pengguna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_hasil` enum('penyakit','hama') COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` bigint UNSIGNED NOT NULL,
  `nama_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_cf` decimal(5,4) NOT NULL DEFAULT '0.0000',
  `gejala_terpilih` json NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis` enum('penyakit','hama') COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `jenis`, `target_id`, `created_at`, `updated_at`) VALUES
(1, 'penyakit', 1, '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(2, 'penyakit', 2, '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(3, 'penyakit', 3, '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(4, 'penyakit', 4, '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(5, 'hama', 1, '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(6, 'hama', 2, '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(7, 'hama', 3, '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(8, 'hama', 4, '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(9, 'hama', 5, '2026-07-12 07:55:34', '2026-07-12 07:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `rule_details`
--

CREATE TABLE `rule_details` (
  `id` bigint UNSIGNED NOT NULL,
  `rule_id` bigint UNSIGNED NOT NULL,
  `gejala_id` bigint UNSIGNED NOT NULL,
  `nilai_cf` decimal(4,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rule_details`
--

INSERT INTO `rule_details` (`id`, `rule_id`, `gejala_id`, `nilai_cf`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0.40', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(2, 1, 2, '0.80', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(3, 1, 3, '0.40', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(4, 1, 4, '0.70', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(5, 1, 5, '0.60', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(6, 2, 6, '0.60', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(7, 2, 7, '0.80', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(8, 2, 8, '0.70', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(9, 2, 9, '0.70', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(10, 2, 10, '0.50', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(11, 3, 11, '0.80', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(12, 3, 12, '0.50', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(13, 3, 13, '0.70', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(14, 3, 14, '0.50', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(15, 3, 15, '0.80', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(16, 4, 16, '0.80', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(17, 4, 17, '0.60', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(18, 4, 18, '0.60', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(19, 4, 19, '0.40', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(20, 4, 20, '0.30', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(21, 5, 21, '0.70', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(22, 5, 22, '1.00', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(23, 5, 23, '0.80', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(24, 5, 24, '0.50', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(25, 6, 21, '0.40', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(26, 6, 25, '0.90', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(27, 6, 26, '0.50', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(28, 6, 27, '0.60', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(29, 7, 28, '0.80', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(30, 7, 29, '0.70', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(31, 7, 30, '0.60', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(32, 7, 31, '0.60', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(33, 7, 32, '0.40', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(34, 8, 33, '0.70', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(35, 8, 34, '0.90', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(36, 8, 35, '0.80', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(37, 8, 36, '0.60', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(38, 9, 37, '0.70', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(39, 9, 38, '0.80', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(40, 9, 39, '0.80', '2026-07-12 07:55:34', '2026-07-12 07:55:34'),
(41, 9, 40, '0.60', '2026-07-12 07:55:34', '2026-07-12 07:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ceCaPJsqtEDFO18lMwkMpo9C7EplUlFSwqMMr3oF', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSlgzeDJ5TG9zVTV3Y2Uxck9SVm9IemdHYWMzQVZ3cG9tMG5xdW9HZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1783843118);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','petugas','pengguna') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pengguna',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@sipatan.test', '2026-07-12 07:55:33', '$2y$12$vQfsc8fWdbUizLc/B21YkOiWYP5RcLNGU57MwT.xan22dKF7wYTEq', 'admin', NULL, '2026-07-12 07:55:33', '2026-07-12 07:55:33'),
(2, 'Petugas Lapangan', 'petugas@sipatan.test', '2026-07-12 07:55:34', '$2y$12$0/7P8m2pQU63cw8xuEUsp.7Mi1Ywd9zFGPgWBBOt2dSguvXAWgEQi', 'petugas', NULL, '2026-07-12 07:55:34', '2026-07-12 07:55:34');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gejala_kode_gejala_unique` (`kode_gejala`);

--
-- Indexes for table `hama`
--
ALTER TABLE `hama`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hama_kode_hama_unique` (`kode_hama`);

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
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penyakit_kode_penyakit_unique` (`kode_penyakit`);

--
-- Indexes for table `riwayat_deteksi`
--
ALTER TABLE `riwayat_deteksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_deteksi_user_id_foreign` (`user_id`),
  ADD KEY `riwayat_deteksi_jenis_hasil_target_id_index` (`jenis_hasil`,`target_id`),
  ADD KEY `riwayat_deteksi_created_at_index` (`created_at`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rules_jenis_target_id_index` (`jenis`,`target_id`);

--
-- Indexes for table `rule_details`
--
ALTER TABLE `rule_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rule_details_rule_id_gejala_id_unique` (`rule_id`,`gejala_id`),
  ADD KEY `rule_details_gejala_id_foreign` (`gejala_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `hama`
--
ALTER TABLE `hama`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `riwayat_deteksi`
--
ALTER TABLE `riwayat_deteksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rule_details`
--
ALTER TABLE `rule_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `riwayat_deteksi`
--
ALTER TABLE `riwayat_deteksi`
  ADD CONSTRAINT `riwayat_deteksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `rule_details`
--
ALTER TABLE `rule_details`
  ADD CONSTRAINT `rule_details_gejala_id_foreign` FOREIGN KEY (`gejala_id`) REFERENCES `gejala` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rule_details_rule_id_foreign` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

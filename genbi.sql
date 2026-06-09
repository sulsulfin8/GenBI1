-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 09, 2026 at 01:47 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `genbi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensis`
--

CREATE TABLE `absensis` (
  `id` bigint UNSIGNED NOT NULL,
  `nim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kegiatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensis`
--

INSERT INTO `absensis` (`id`, `nim`, `nama_lengkap`, `jurusan`, `devisi`, `kegiatan`, `status`, `created_at`, `updated_at`) VALUES
(200, '241130488', 'Agung Pramadana', 'Hukum', 'Lingkungan Hidup', 'Gensyar', 'A', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(201, '241220626', 'Pandi Wiranto', 'Sistem Informasi', 'Publikasi Dekorasi & Dokumentasi', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(202, '221920994', 'Rusdayanti', 'Manajemen', 'Kewirausahaan', 'Gensyar', 'S', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(203, '242231139', 'Jumarni', 'Ilmu Komputer', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(204, '241931063', 'Imun', 'Manajemen', 'Pendidikan & Kebudayaan', 'Gensyar', 'A', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(205, '231831475', 'Shakila Revadianti Pracilia', 'Akuntansi', 'Kewirausahaan', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(206, '241220632', 'Meilan Faulana', 'Sistem Informasi', 'Pendidikan & Kebudayaan', 'Gensyar', 'S', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(207, '242231159', 'Afni Melati', 'Ilmu Komputer', 'Pengabdian Masyarakat', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(208, '231820940', 'Septa Pryatno', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', 'Gensyar', 'A', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(209, '230930302', 'Dirga', 'Teknik Pertambangan', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(210, '221910947', 'Selvi Damayanti', 'Manajemen', 'Pengabdian Masyarakat', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(211, '231820921', 'Rivaldi', 'Akuntansi', 'Kewirausahaan', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(212, '231030386', 'Nurul Mawaddah', 'Administrasi Publik', 'Pengabdian Masyarakat', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(213, '231030372', 'Nurmagfira', 'Administrasi Publik', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(214, '231830956', 'Muh Agus Salim', 'Akuntansi', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(215, '240330110', 'Ni Luh Sujayanti', 'Pendidikan Matematika', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(216, '241820903', 'Reza Ardita Bahtiar', 'Akuntansi', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(217, '241230683', 'Dimas R', 'Sistem Informasi', 'Pendidikan & Kebudayaan', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(218, '221220645', 'Astrid', 'Sistem Informasi', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(219, '221130494', 'Khaerunnisa Ahkam', 'Hukum', 'Kewirausahaan', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(220, '221130507', 'Rut Afrina Perzenya Sitorus', 'Hukum', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(221, '221220616', 'Wahida Jafar', 'Sistem Informasi', 'Pengabdian Masyarakat', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(222, '221920984', 'Ali Slamat', 'Manajemen', 'Pengabdian Masyarakat', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(223, '231830967', 'Sri Wahyuni', 'Akuntansi', 'Pengabdian Masyarakat', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(224, '241810884', 'Rifana', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(225, '232218402', 'Muhammad Ilham', 'Akuntansi', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(226, '240310103', 'Putri Meilani', 'Pendidikan Matematika', 'Pendidikan & Kebudayaan', 'Gensyar', 'H', '2026-05-20 01:36:37', '2026-05-20 01:36:37'),
(227, '241820921', 'Muhammad Hamiludin', 'Akuntansi', 'Pendidikan & Kebudayaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(228, '241820910', 'Sela Marsida', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(229, '221120436', 'Yani Apriyani', 'Hukum', 'Kewirausahaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(230, '231820939', 'Herda', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(231, '221220624', 'Darniati', 'Sistem Informasi', 'Pendidikan & Kebudayaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(232, '230520103', 'Antonio Brian Deeng', 'Agribisnis', 'Kewirausahaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(233, '241220615', 'Safaldi', 'Sistem Informasi', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(234, '241820924', 'Tina', 'Akuntansi', 'Kewirausahaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(235, '241810891', 'Warda', 'Akuntansi', 'Pendidikan & Kebudayaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(236, '231210647', 'Alfat Pandu Kusuma', 'Sistem Informasi', 'Publikasi Dekorasi & Dokumentasi', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(237, '241921017', 'Aisyah Aprilia Sari', 'Manajemen', 'Kewirausahaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(238, '241830949', 'Azzalia Alifiyah Syahira Suherman', 'Akuntansi', 'Pendidikan & Kebudayaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(239, '240511400', 'Indra Yasa', 'Agribisnis', 'Publikasi Dekorasi & Dokumentasi', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(240, '221130470', 'Yulianda', 'Hukum', 'Pengabdian Masyarakat', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(241, '241830947', 'Aliya Ma\'rifat Putri Nur', 'Akuntansi', 'Kewirausahaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(242, '240510141', 'Devi', 'Agribisnis', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(243, '240320106', 'Mudma Inna', 'Pendidikan Matematika', 'Pendidikan & Kebudayaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(244, '231810907', 'Nabila', 'Akuntansi', 'Kewirausahaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(245, '242331193', 'Dinda Wulandari', 'Ekonomi Pembagunan', 'Pendidikan & Kebudayaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(246, '231830982', 'Muh Rifqi Apriansyah', 'Akuntansi', 'Pendidikan & Kebudayaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(247, '242331190', 'Ilsa', 'Ekonomi Pembagunan', 'Kewirausahaan', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(248, '240310102', 'Elsa Savira Putri', 'Pendidikan Matematika', 'Pengabdian Masyarakat', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(249, '221220664', 'Andi Rapansyah Mamonto', 'Sistem Informasi', 'Publikasi Dekorasi & Dokumentasi', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(250, '221210584', 'Mohd Iqbal', 'Sistem Informasi', 'Publikasi Dekorasi & Dokumentasi', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 21:27:45'),
(251, '231830973', 'Novita Putri Praja', 'Akuntansi', 'Bendahara Umum', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(252, '221220630', 'Ari Wibowo', 'Sistem Informasi', 'Lingkungan Hidup', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(253, '221920972', 'Nurhalifah', 'Manajemen', 'Ketua Umum', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(254, '221130462', 'Putri Aulia', 'Hukum', 'Sekretaris Umum', 'Gensyar', 'H', '2026-05-20 01:36:38', '2026-05-20 01:36:38'),
(255, '241130488', 'Agung Pramadana', 'Hukum', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(256, '241220626', 'Pandi Wiranto', 'Sistem Informasi', 'Publikasi Dekorasi & Dokumentasi', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(257, '221920994', 'Rusdayanti', 'Manajemen', 'Kewirausahaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(258, '242231139', 'Jumarni', 'Ilmu Komputer', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(259, '241931063', 'Imun', 'Manajemen', 'Pendidikan & Kebudayaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(260, '231831475', 'Shakila Revadianti Pracilia', 'Akuntansi', 'Kewirausahaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(261, '241220632', 'Meilan Faulana', 'Sistem Informasi', 'Pendidikan & Kebudayaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(262, '242231159', 'Afni Melati', 'Ilmu Komputer', 'Pengabdian Masyarakat', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(263, '231820940', 'Septa Pryatno', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(264, '230930302', 'Dirga', 'Teknik Pertambangan', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(265, '221910947', 'Selvi Damayanti', 'Manajemen', 'Pengabdian Masyarakat', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(266, '231820921', 'Rivaldi', 'Akuntansi', 'Kewirausahaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(267, '231030386', 'Nurul Mawaddah', 'Administrasi Publik', 'Pengabdian Masyarakat', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(268, '231030372', 'Nurmagfira', 'Administrasi Publik', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(269, '231830956', 'Muh Agus Salim', 'Akuntansi', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(270, '240330110', 'Ni Luh Sujayanti', 'Pendidikan Matematika', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(271, '241820903', 'Reza Ardita Bahtiar', 'Akuntansi', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(272, '241230683', 'Dimas R', 'Sistem Informasi', 'Pendidikan & Kebudayaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(273, '221220645', 'Astrid', 'Sistem Informasi', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(274, '221130494', 'Khaerunnisa Ahkam', 'Hukum', 'Kewirausahaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(275, '221130507', 'Rut Afrina Perzenya Sitorus', 'Hukum', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(276, '221220616', 'Wahida Jafar', 'Sistem Informasi', 'Pengabdian Masyarakat', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(277, '221920984', 'Ali Slamat', 'Manajemen', 'Pengabdian Masyarakat', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(278, '231830967', 'Sri Wahyuni', 'Akuntansi', 'Pengabdian Masyarakat', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(279, '241810884', 'Rifana', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(280, '232218402', 'Muhammad Ilham', 'Akuntansi', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(281, '240310103', 'Putri Meilani', 'Pendidikan Matematika', 'Pendidikan & Kebudayaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(282, '241820921', 'Muhammad Hamiludin', 'Akuntansi', 'Pendidikan & Kebudayaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(283, '241820910', 'Sela Marsida', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(284, '221120436', 'Yani Apriyani', 'Hukum', 'Kewirausahaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(285, '231820939', 'Herda', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(286, '221220624', 'Darniati', 'Sistem Informasi', 'Pendidikan & Kebudayaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(287, '230520103', 'Antonio Brian Deeng', 'Agribisnis', 'Kewirausahaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(288, '241220615', 'Safaldi', 'Sistem Informasi', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(289, '241820924', 'Tina', 'Akuntansi', 'Kewirausahaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(290, '241810891', 'Warda', 'Akuntansi', 'Pendidikan & Kebudayaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(291, '231210647', 'Alfat Pandu Kusuma', 'Sistem Informasi', 'Publikasi Dekorasi & Dokumentasi', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(292, '241921017', 'Aisyah Aprilia Sari', 'Manajemen', 'Kewirausahaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(293, '241830949', 'Azzalia Alifiyah Syahira Suherman', 'Akuntansi', 'Pendidikan & Kebudayaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(294, '240511400', 'Indra Yasa', 'Agribisnis', 'Publikasi Dekorasi & Dokumentasi', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(295, '221130470', 'Yulianda', 'Hukum', 'Pengabdian Masyarakat', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(296, '241830947', 'Aliya Ma\'rifat Putri Nur', 'Akuntansi', 'Kewirausahaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(297, '240510141', 'Devi', 'Agribisnis', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(298, '240320106', 'Mudma Inna', 'Pendidikan Matematika', 'Pendidikan & Kebudayaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(299, '231810907', 'Nabila', 'Akuntansi', 'Kewirausahaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(300, '242331193', 'Dinda Wulandari', 'Ekonomi Pembagunan', 'Pendidikan & Kebudayaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(301, '231830982', 'Muh Rifqi Apriansyah', 'Akuntansi', 'Pendidikan & Kebudayaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(302, '242331190', 'Ilsa', 'Ekonomi Pembagunan', 'Kewirausahaan', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(303, '240310102', 'Elsa Savira Putri', 'Pendidikan Matematika', 'Pengabdian Masyarakat', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(304, '221220664', 'Andi Rapansyah Mamonto', 'Sistem Informasi', 'Publikasi Dekorasi & Dokumentasi', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(305, '221210584', 'Mohd Iqbal', 'Sistem Informasi', 'Publikasi Dekorasi & Dokumentasi', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(306, '231830973', 'Novita Putri Praja', 'Akuntansi', 'Bendahara Umum', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(307, '221220630', 'Ari Wibowo', 'Sistem Informasi', 'Lingkungan Hidup', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(308, '221920972', 'Nurhalifah', 'Manajemen', 'Ketua Umum', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44'),
(309, '221130462', 'Putri Aulia', 'Hukum', 'Sekretaris Umum', 'Rapat', 'H', '2026-06-04 05:07:44', '2026-06-04 05:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `anggarans`
--

CREATE TABLE `anggarans` (
  `id` bigint UNSIGNED NOT NULL,
  `kegiatan_id` bigint UNSIGNED NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `jumlah` int NOT NULL,
  `satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggarans`
--

INSERT INTO `anggarans` (`id`, `kegiatan_id`, `nama_barang`, `harga_satuan`, `jumlah`, `satuan`, `total`, `created_at`, `updated_at`) VALUES
(44, 23, 'Makanan', '10000.00', 2, 'kotak', '20000.00', '2026-06-04 06:11:29', '2026-06-04 06:11:29'),
(45, 23, 'kamera', '200000.00', 1, 'buah', '200000.00', '2026-06-04 06:11:29', '2026-06-04 06:11:29'),
(46, 23, 'pemateri', '1000000.00', 1, 'orang', '1000000.00', '2026-06-04 06:11:29', '2026-06-04 06:11:29'),
(47, 23, 'pulpen', '3000.00', 1, 'buah', '3000.00', '2026-06-04 06:11:29', '2026-06-04 06:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `devisis`
--

CREATE TABLE `devisis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_devisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'blue',
  `ikon` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devisis`
--

INSERT INTO `devisis` (`id`, `nama_devisi`, `deskripsi`, `warna`, `ikon`, `created_at`, `updated_at`) VALUES
(1, 'Pengurus Inti', 'Terdiri dari Ketua, Sekretaris, dan Bendahara. Bertanggung jawab atas jalannya roda organisasi, administrasi, sirkulasi keuangan, serta mengambil keputusan strategis komisariat.', 'gray', '<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 8h8\"></path>', NULL, NULL),
(2, 'Pendidikan & Kebudayaan', 'Berfokus pada peningkatan kapasitas akademik anggota dan masyarakat, serta pelestarian nilai-nilai kebudayaan lokal melalui kegiatan seminar, diskusi, dan pelatihan.', 'blue', '<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253\"></path>', NULL, NULL),
(3, 'Pengabdian Masyarakat', 'Menjadi jembatan antara GenBI dan masyarakat. Menyelenggarakan kegiatan sosial, bantuan kemanusiaan, dan program pemberdayaan untuk menebar energi positif secara langsung.', 'emerald', '<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z\"></path>', NULL, NULL),
(4, 'Publikasi Dekorasi & Dokumentasi', 'Divisi Publikasi, Dekorasi & Dokumentasi. Menjadi ujung tombak penyebaran informasi, mengelola media sosial, dan mendokumentasikan setiap momen penting kegiatan GenBI.', 'purple', '<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z\"></path><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 13a3 3 0 11-6 0 3 3 0 016 0z\"></path>', NULL, '2026-06-09 04:30:00'),
(5, 'Kewirausahaan', 'Menumbuhkan jiwa entrepreneurship anggota. Menggagas ide bisnis kreatif, pencarian dana mandiri (Danus), dan mendorong kemandirian finansial organisasi.', 'orange', '<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08-.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path>', NULL, NULL),
(6, 'Lingkungan Hidup', 'Bergerak di bidang pelestarian alam. Menginisiasi program penghijauan, kampanye sadar sampah, dan menanamkan kepedulian lingkungan kepada anggota maupun masyarakat sekitar.', 'teal', '<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

CREATE TABLE `infos` (
  `id` bigint UNSIGNED NOT NULL,
  `visi` text COLLATE utf8mb4_unicode_ci,
  `misi` text COLLATE utf8mb4_unicode_ci,
  `komitmen` text COLLATE utf8mb4_unicode_ci,
  `pelanggaran` text COLLATE utf8mb4_unicode_ci,
  `qris` text COLLATE utf8mb4_unicode_ci,
  `apresiasi` text COLLATE utf8mb4_unicode_ci,
  `sp` text COLLATE utf8mb4_unicode_ci,
  `kriteria_beasiswa` text COLLATE utf8mb4_unicode_ci,
  `dokumen_beasiswa` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `infos`
--

INSERT INTO `infos` (`id`, `visi`, `misi`, `komitmen`, `pelanggaran`, `qris`, `apresiasi`, `sp`, `kriteria_beasiswa`, `dokumen_beasiswa`, `created_at`, `updated_at`) VALUES
(1, 'Terwujudnya GenBI Komisariat USN Kolaka yang kuat secara internal dan aktif\r\nmembangun hubungan eksternal sebagai Frontliner, Agent of Change, dan Future Leader.', '1. Memperkuat tata kelola internal organisasi secara profesional, disiplin, dan akuntabel.\r\n2. Mengimplementasikan peran Frontliner Bank Indonesia melalui edukasi CBP Rupiah,\r\nliterasi keuangan, dan penguatan ekonomi digital.\r\n3. Mendorong peran Agent of Change melalui program kerja yang inovatif, berdampak,\r\ndan berkelanjutan.\r\n4. Membangun kader sebagai Future Leader melalui peningkatan kapasitas dan\r\npengembangan kompetensi kepemimpinan.\r\n5. Memperluas hubungan eksternal organisasi dengan melakukan kolaborasi strategis\r\nbersama kampus, pemerintah, dan pemangku kepentingan lainnya.', 'GenBI Sultra Komisariat USN Kolaka juga berkomitmen untuk menciptakan\r\nlingkungan yang inklusif dan mendukung bagi anggotanya. Oleh karena itu, rancangan\r\naktivitas juga mencakup kegiatan masyarakat dan kebersamaan yang dapat mempererat ikatan\r\nantaranggota. Hal ini diharapkan dapat menciptakan atmosfer positif di kampus dan\r\nmembantu mahasiswa merasa lebih terhubung dengan rekan- rekan mereka.\r\nDengan merancang aktivitas dan anggaran ini, GenBI Sultra Komisariat USN Kolaka\r\nberharap dapat memberikan kontribusi yang signifikan dalam mencetak generasi mahasiswa\r\nyang aktif, kreatif, dan peduli terhadap lingkungannya serta mampu memberikan dampak\r\npositif bagi masyarakat secara luas.', 'Tidak Hadir Tanpa Laporan (A) : +10 Poin\r\nTidak Hadir Dengan Laporan (I) : +1 Poin\r\nKetahuan Berbohong : + 50 Poin\r\nMelakukan Hal Negatif Yang Berdampak Pada Komisariat : + 100 Poin\r\nSakit/Kerja Sehingga tidak Berkontribuse selaman 40 Hari : + 50 Poin', 'Tidak Paham CBPR,Qris,PEKA : + 50 Poin\r\nTidak Mengumpulkan  Sqen Qris : + 8 Poin\r\nKurang Scan Qris : + 4 Poin\r\nLupa Up Scan Qris : + 2 Poin\r\nTidak Kerja Tapi Berusaha Melengkapi: + 5 Poin', 'Rajin : -3 Poin\r\nAktif : -2 Poin\r\nRajin Cari Folower : -5 Poin', 'SP 1 (Komisariat): 25\r\nSP 2 (Wilayah): 25-50\r\nSP 3 (Pembina): 50-100', 'Mahasiswa aktif dan terdata pada PDDikti.\r\nTelah menyelesaikan min. 40 SKS (berada di semester 4 s/d semester 6) pada Prodi yang ditentukan.\r\nMemiliki IPK minimal 3.00 (skala 4.00).\r\nUsia maksimal 23 tahun (belum genap 24 tahun) saat menerima beasiswa.\r\nMembuat Resume Pribadi (CV).\r\nMembuat Surat Motivasi (termasuk rencana karir setelah lulus).\r\nTidak sedang menerima beasiswa/ikatan dinas dari instansi lain.\r\nMemiliki pengalaman aktivitas sosial yang bermanfaat bagi masyarakat.\r\nBerasal dari keluarga berlatar belakang ekonomi pra sejahtera (kurang mampu).\r\nTidak melanggar norma kampus, sosial, serta bebas pidana & narkoba.\r\nBersedia berperan aktif dalam komunitas GenBI dan tunduk pada seluruh syarat ketentuan program beasiswa Bank Indonesia.', 'Biodata Mahasiswa (sesuai lampiran).\r\nSalinan KTP atau KTM yang masih berlaku.\r\nSalinan Kartu Keluarga (KK).\r\nLembar Kartu Hasil Studi (KHS) 3 semester terakhir.\r\nSurat Keterangan Aktif Kuliah.\r\nResume Pribadi (CV).\r\nMotivation Letter (dalam Bahasa Indonesia).\r\nSurat Rekomendasi dari 1 tokoh (akademik/non-akademik).\r\nSurat Keterangan tidak sedang menerima beasiswa instansi lain.\r\nSurat Keterangan Keluarga Tidak Mampu (dari kelurahan/kecamatan).\r\nSurat Pernyataan kesanggupan aktif di komunitas GenBI.\r\nSalinan buku rekening bank (bagian depan dalam) atas nama mahasiswa.', '2026-06-03 21:04:14', '2026-06-04 03:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint UNSIGNED NOT NULL,
  `devisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kegiatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengertian` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tujuan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `manfaat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `waktu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `tempat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `devisi`, `nama_kegiatan`, `pengertian`, `tujuan`, `manfaat`, `waktu`, `tanggal`, `tempat`, `created_at`, `updated_at`) VALUES
(13, 'Pengabdian Masyarakat', 'Gensyar', '', NULL, NULL, '21:15', '2026-05-12', 'Rumah Adat', '2026-05-12 05:13:53', '2026-05-12 05:13:53'),
(16, 'Publikasi Dekorasi & Dokumentasi', 'Podkes', '', NULL, NULL, '17:51', '2026-05-20', 'Akper Baru', '2026-05-20 01:48:44', '2026-05-20 01:48:44'),
(23, 'Semua Devisi', 'Rapat', 'Rapat adalah kegiatan rutin yang diadakan tipa bulan oleh genbi', 'Menentukan kegiatan apa yang akan dijalankan di bulan selanjutnya', 'Kita dapat mengetahui  kegiatan mana yang akan didahului untuk dikerjakan', '04:22', '2026-06-03', 'Kafe Tepoe', '2026-06-01 21:21:00', '2026-06-02 06:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_04_15_144958_create_kegiatans_table', 1),
(6, '2026_04_15_145017_create_absensis_table', 1),
(7, '2026_04_15_145031_create_poins_table', 1),
(8, '2026_04_15_145050_create_anggarans_table', 1),
(9, '2026_04_15_145110_create_laporans_table', 1),
(10, '2026_04_17_024732_add_role_to_users_table', 1),
(11, '2026_04_17_070729_add_nim_jurusan_to_users_table', 1),
(12, '2026_04_18_033359_add_tujuan_manfaat_to_kegiatans_table', 2),
(13, '2026_05_22_060826_add_request_reset_to_users_table', 3),
(15, '2026_06_04_040014_create_infos_table', 4),
(16, '2026_06_09_110333_create_devisis_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasis`
--

CREATE TABLE `notifikasis` (
  `id` bigint UNSIGNED NOT NULL,
  `nim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'warning',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasis`
--

INSERT INTO `notifikasis` (`id`, `nim`, `pesan`, `jenis`, `is_read`, `created_at`, `updated_at`) VALUES
(1, '2212301132', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Tidak Paham CBPR, Qris, PEKA', 'warning', 1, '2026-05-03 03:24:19', '2026-05-03 03:24:19'),
(2, '2212301132', 'Admin memperbarui detail riwayat poin Anda. Keterangan: Absensi (Hadir 100%) | Kegiatan Lain: Lupa Up Scan Qris | Rajin mengikuti kegiatan | Tidak Paham CBPR, Qris, PEKA masa seorang iqbal tidak paham CBPR, Qris Dan PEKA', 'info', 1, '2026-05-03 03:43:42', '2026-05-03 03:43:42'),
(3, '2212301132', 'Admin memperbarui detail riwayat poin Anda. Keterangan: Absensi (Hadir 100%) | Kegiatan Lain: Kegiatan Lain: Lupa Up Scan Qris | Rajin mengikuti kegiatan | Tidak Paham CBPR, Qris, PEKA | masa seorang iqbal tidak paham CBPR, Qris Dan PEKA', 'info', 1, '2026-05-03 21:27:07', '2026-05-03 21:27:07'),
(6, '221210584', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Ketahuan Berbohong = +50 Poin', 'warning', 1, '2026-05-20 21:30:07', '2026-05-20 21:30:07'),
(7, '221210584', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Ketahuan Berbohong = +50 Poin', 'warning', 1, '2026-05-25 05:14:06', '2026-05-25 05:14:06'),
(8, '221220630', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Tidak Mengikuti Rapat/ Zoom tanpa Konfirmasi = +5 Poin', 'warning', 1, '2026-05-25 05:49:13', '2026-05-25 05:49:13'),
(9, '221220630', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Lupa Up Scan Qris = +2 Poin', 'warning', 1, '2026-05-25 05:49:34', '2026-05-25 05:49:34'),
(10, '221220630', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Kurang Target Scan Qris = +4 Poin', 'warning', 1, '2026-05-25 06:02:16', '2026-05-25 06:02:16'),
(11, '221220630', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Tidak mengumpulkan Scan Qris Bulanan = +8 Poin', 'warning', 1, '2026-05-25 06:12:25', '2026-05-25 06:12:25'),
(12, '221220630', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Tidak Mengikuti Rapat/ Zoom tanpa Konfirmasi = +5 Poin', 'warning', 1, '2026-05-28 22:38:45', '2026-05-28 22:38:45'),
(13, '221220630', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Tidak Paham CBPR, Qris, PEKA = +50 Poin', 'warning', 0, '2026-05-29 23:24:57', '2026-05-29 23:24:57'),
(14, '221920972', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Melakukan Hal Negatif Yang Berdampak Pada Komisariat = +100 Poin', 'warning', 0, '2026-06-03 21:33:02', '2026-06-03 21:33:02'),
(15, '221220630', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Rajin = -3 Poin', 'warning', 0, '2026-06-03 21:37:26', '2026-06-03 21:37:26'),
(16, '221220630', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Aktif = -2 Poin', 'warning', 0, '2026-06-03 21:38:22', '2026-06-03 21:38:22'),
(17, '221220630', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Tidak Hadir Tanpa Laporan (A) = +10 Poin', 'warning', 0, '2026-06-03 21:38:37', '2026-06-03 21:38:37'),
(18, '221210584', 'Admin memperbarui detail riwayat poin Anda.', 'info', 0, '2026-06-04 05:30:30', '2026-06-04 05:30:30'),
(19, '221920972', 'Admin memperbarui detail riwayat poin Anda.', 'info', 0, '2026-06-04 05:35:37', '2026-06-04 05:35:37'),
(20, '221920972', 'Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: Kurang Scan Qris = +4 Poin', 'warning', 0, '2026-06-04 05:44:01', '2026-06-04 05:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poins`
--

CREATE TABLE `poins` (
  `id` bigint UNSIGNED NOT NULL,
  `nim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_poin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aman',
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poins`
--

INSERT INTO `poins` (`id`, `nim`, `nama_lengkap`, `jurusan`, `devisi`, `total_poin`, `sp`, `keterangan`, `created_at`, `updated_at`) VALUES
(19, '221920972', 'Nurhalifah', 'Manajemen', NULL, '4', 'Aman', 'Kurang Scan Qris = +4 Poin', '2026-05-11 18:35:16', '2026-06-04 05:46:55'),
(20, '221130462', 'Putri Aulia', 'Hukum', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(21, '221220630', 'Ari Wibowo', 'Sistem Informasi', NULL, '5', 'Aman', 'Rajin = -3 Poin | Aktif = -2 Poin | Tidak Hadir Tanpa Laporan (A) = +10 Poin', '2026-05-11 18:35:16', '2026-06-09 03:55:18'),
(22, '231830973', 'Novita Putri Praja', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(23, '221210584', 'Mohd Iqbal', 'Sistem Informasi', NULL, '0', 'Aman', 'Tingkatkan lagi kerajinannnya', '2026-05-11 18:35:16', '2026-06-04 05:30:30'),
(24, '221220664', 'Andi Rapansyah Mamonto', 'Sistem Informasi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(25, '240310102', 'Elsa Savira Putri', 'Pendidikan Matematika', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(26, '242331190', 'Ilsa', 'Ekonomi Pembagunan', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(27, '231830982', 'Muh Rifqi Apriansyah', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(28, '242331193', 'Dinda Wulandari', 'Ekonomi Pembagunan', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(29, '231810907', 'Nabila', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(30, '240320106', 'Mudma Inna', 'Pendidikan Matematika', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(31, '240510141', 'Devi', 'Agribisnis', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(32, '241830947', 'Aliya Ma\'rifat Putri Nur', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(33, '221130470', 'Yulianda', 'Hukum', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(34, '240511400', 'Indra Yasa', 'Agribisnis', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(35, '241830949', 'Azzalia Alifiyah Syahira Suherman', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(36, '241921017', 'Aisyah Aprilia Sari', 'Manajemen', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(37, '231210647', 'Alfat Pandu Kusuma', 'Sistem Informasi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(38, '241810891', 'Warda', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(39, '241820924', 'Tina', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(40, '241220615', 'Safaldi', 'Sistem Informasi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(41, '230520103', 'Antonio Brian Deeng', 'Agribisnis', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(42, '221220624', 'Darniati', 'Sistem Informasi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(43, '231820939', 'Herda', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(44, '221120436', 'Yani Apriyani', 'Hukum', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(45, '241820910', 'Sela Marsida', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(46, '241820921', 'Muhammad Hamiludin', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(47, '240310103', 'Putri Meilani', 'Pendidikan Matematika', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(48, '232218402', 'Muhammad Ilham', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(49, '241810884', 'Rifana', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(50, '231830967', 'Sri Wahyuni', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(51, '221920984', 'Ali Slamat', 'Manajemen', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(52, '221220616', 'Wahida Jafar', 'Sistem Informasi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(53, '221130507', 'Rut Afrina Perzenya Sitorus', 'Hukum', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(54, '221130494', 'Khaerunnisa Ahkam', 'Hukum', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(55, '221220645', 'Astrid', 'Sistem Informasi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(56, '241230683', 'Dimas R', 'Sistem Informasi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(57, '241820903', 'Reza Ardita Bahtiar', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(58, '240330110', 'Ni Luh Sujayanti', 'Pendidikan Matematika', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(59, '231830956', 'Muh Agus Salim', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(60, '231030372', 'Nurmagfira', 'Administrasi Publik', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(61, '231030386', 'Nurul Mawaddah', 'Administrasi Publik', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(62, '231820921', 'Rivaldi', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(63, '221910947', 'Selvi Damayanti', 'Manajemen', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(64, '230930302', 'Dirga', 'Teknik Pertambangan', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(65, '231820940', 'Septa Pryatno', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(66, '242231159', 'Afni Melati', 'Ilmu Komputer', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(67, '241220632', 'Meilan Faulana', 'Sistem Informasi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(68, '231831475', 'Shakila Revadianti Pracilia', 'Akuntansi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(69, '241931063', 'Imun', 'Manajemen', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(70, '242231139', 'Jumarni', 'Ilmu Komputer', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(71, '221920994', 'Rusdayanti', 'Manajemen', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(72, '241220626', 'Pandi Wiranto', 'Sistem Informasi', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16'),
(73, '241130488', 'Agung Pramadana', 'Hukum', NULL, '0', 'Aman', '-', '2026-05-11 18:35:16', '2026-05-11 18:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_reset` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('admin','sekretaris','bendahara','anggota') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'anggota',
  `nim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ttd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `request_reset`, `role`, `nim`, `jurusan`, `devisi`, `jabatan`, `photo`, `ttd`, `remember_token`, `created_at`, `updated_at`, `otp`, `otp_expires_at`) VALUES
(1, 'Nurhalifah', 'sulsulfin8@gmail.com', NULL, '$2y$12$zF/cfrHAXmgyNLtAmxk5KeFv1KSCd/FB2cexwhvQokXdw.xe9ZF7i', 0, 'admin', '221920972', 'Manajemen', NULL, NULL, 'profiles/GQREoobY7hdlJ8nnbCOxuzrNkfLpGHV9EsGHRNUQ.png', 'ttd/BToN3I6eS3SmMysKCZcmeruCOiL23u9aaRO0y3b5.jpg', NULL, '2026-04-17 18:49:04', '2026-06-08 03:12:42', NULL, NULL),
(2, 'Putri Aulia', 'sekretaris@genbi.com', NULL, '$2y$12$.IMhwj37vZ7euTdxNGNpGuADOAoHg6S4HetT3e01p08uUwd9wPzkK', 0, 'sekretaris', '221130462', 'Hukum', NULL, NULL, 'profiles/BPG1fEQ4v4gAwZOKMAjnAHjzQGB3n2WkOhQwyD7z.jpg', NULL, NULL, '2026-04-17 18:49:04', '2026-05-18 04:16:16', NULL, NULL),
(3, 'Ari Wibowo', 'sulfin', NULL, '$2y$12$DVmABznYw01vxo4cdFXHpOKAXTVaIAPnEy4PyLIOvkwN8c9B69NO2', 0, 'anggota', '221220630', 'Sistem Informasi', 'Lingkungan Hidup', 'Ketua Devisi Lingkungan Hidup', 'profiles/VWZcawyvJcokNAQd3z2Gyq086TrB9pMXRMZDohGC.jpg', NULL, NULL, '2026-04-17 18:52:44', '2026-05-29 22:58:39', NULL, NULL),
(9, 'Novita Putri Praja', 'bendahara@genbi.com', NULL, '$2y$12$jEeKdJwnkmOzDjWn9J.Z8eG9.HppnMSlAnsFCkoLjnkq.RxUgpm96', 0, 'bendahara', '231830973', 'Akuntansi', NULL, NULL, 'profiles/tY3okiGr4lC21HTvXSdbXAidzGs83uJ9bpP2LlHT.jpg', NULL, NULL, '2026-04-24 23:03:22', '2026-05-11 18:47:59', NULL, NULL),
(12, 'Mohd Iqbal', 'mohdiiqball03@gmail.com', NULL, '$2y$12$kQsKC/1kmmmi8ngN.VZm4eZU2HGSuERDtcPxqAsFASPeM0dj3kZwq', 0, 'anggota', '221210584', 'Sistem Informasi', NULL, 'Ketua Devisi Publikasi Dekorasi & Dokumentasi', 'profiles/bTzoEscef2GyYk5uCtsFcAeVfaS4kz10geDyUj7x.jpg', NULL, NULL, '2026-05-03 21:56:54', '2026-06-09 04:30:34', '852904', '2026-06-07 15:11:13'),
(14, 'Andi Rapansyah Mamonto', 'andi@genbi.com', NULL, '$2y$12$WFoaHNs1EnBpGAjZ14dLIOEcpg5h3hFtBBoSZ8LdUSobv1MrpPA06', 0, 'anggota', '221220664', 'Sistem Informasi', 'Publikasi Dekorasi & Dokumentasi', NULL, NULL, NULL, NULL, '2026-05-05 18:18:04', '2026-05-11 17:43:08', NULL, NULL),
(16, 'Elsa Savira Putri', 'elsa@genbi.com', NULL, '$2y$12$x6mhpsl287iQGPo/EB25aeoum4wAKL1Zagang1emoaK9sWKXp19c2', 0, 'anggota', '240310102', 'Pendidikan Matematika', 'Pengabdian Masyarakat', NULL, NULL, NULL, NULL, '2026-05-11 17:50:31', '2026-05-11 17:50:31', NULL, NULL),
(17, 'Ilsa', 'ilsa@genbi.com', NULL, '$2y$12$MzhmbBtgogW0qwVlG.7AluAyBuwx4vclW27laIPFDi.BkBDmDmNuK', 0, 'anggota', '242331190', 'Ekonomi Pembagunan', 'Kewirausahaan', NULL, NULL, NULL, NULL, '2026-05-11 17:51:48', '2026-05-11 17:51:48', NULL, NULL),
(18, 'Muh Rifqi Apriansyah', 'rifqi@genbi.com', NULL, '$2y$12$SGabkQyyl3me4puZmtM2WOmZrWkrKsSlfusV5Rl5OVTpOe6HCzer6', 0, 'anggota', '231830982', 'Akuntansi', 'Pendidikan & Kebudayaan', 'Ketua Devisi Pendidikan & Kebudayaan', 'profiles/uEnpzTDxJTcsuGOvlKk7XJOsFpzB3B4ahrDpUd3d.jpg', NULL, NULL, '2026-05-11 17:52:51', '2026-05-11 18:42:13', NULL, NULL),
(19, 'Dinda Wulandari', 'dinda@genbi.com', NULL, '$2y$12$CGpU5QE79MeEiU/br9fZ6eiD7dEIiLxDIciZx.SUKDZGGq2BJrqxK', 0, 'anggota', '242331193', 'Ekonomi Pembagunan', 'Pendidikan & Kebudayaan', NULL, NULL, NULL, NULL, '2026-05-11 17:54:00', '2026-05-11 17:54:00', NULL, NULL),
(20, 'Nabila', 'nabila@genbi.com', NULL, '$2y$12$Lk2ngTKoZ5qVCA0gL1ng2uL7evp1xrtPHeeqV.J5fLk26TfCECQt6', 0, 'anggota', '231810907', 'Akuntansi', 'Kewirausahaan', NULL, NULL, NULL, NULL, '2026-05-11 17:54:44', '2026-05-11 17:54:44', NULL, NULL),
(21, 'Mudma Inna', 'Mudma@genbi.com', NULL, '$2y$12$uAEbB556MVrgUylxXS.fie0gSlK45k2Mjax9LgK35Sq2TFnnCVOuK', 0, 'anggota', '240320106', 'Pendidikan Matematika', 'Pendidikan & Kebudayaan', NULL, NULL, NULL, NULL, '2026-05-11 17:55:35', '2026-05-11 17:55:35', NULL, NULL),
(22, 'Devi', 'devi@genbi.com', NULL, '$2y$12$J6QC7WGYjk2WQ3CvbgYS5u2ieMDenhB66VlkFhFNN.hPVHhpM087C', 0, 'anggota', '240510141', 'Agribisnis', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 17:56:47', '2026-05-11 17:56:47', NULL, NULL),
(23, 'Aliya Ma\'rifat Putri Nur', 'aliya@genbi.com', NULL, '$2y$12$1PxAGotOS2wzyWOMJXclm.gFWPqu4Xhwh/vDZf/4XByiB/tQwzthK', 0, 'anggota', '241830947', 'Akuntansi', 'Kewirausahaan', NULL, NULL, NULL, NULL, '2026-05-11 17:58:15', '2026-05-11 17:58:15', NULL, NULL),
(24, 'Yulianda', 'yui@genbi.com', NULL, '$2y$12$joUhIN.PE4XJKkG.gEGj8ul7CyoJxOuClvoFi4CuCsYTrJsWKdw/q', 0, 'anggota', '221130470', 'Hukum', 'Pengabdian Masyarakat', NULL, NULL, NULL, NULL, '2026-05-11 17:59:02', '2026-05-11 17:59:02', NULL, NULL),
(25, 'Indra Yasa', 'indra@genbi.com', NULL, '$2y$12$XSOdQIokzn8LhQnvAyKgp.CcDTMwJVPrkg.zwyNwV4BBOZ.aqakui', 0, 'anggota', '240511400', 'Agribisnis', 'Publikasi Dekorasi & Dokumentasi', NULL, NULL, NULL, NULL, '2026-05-11 17:59:50', '2026-05-11 17:59:50', NULL, NULL),
(26, 'Azzalia Alifiyah Syahira Suherman', 'azzalia@genbi.com', NULL, '$2y$12$gOXVFVXMrwjeWUGQ8d5fqOyZRmR10hXun6vRLv6HwxuOYTlgR7VUW', 0, 'anggota', '241830949', 'Akuntansi', 'Pendidikan & Kebudayaan', NULL, NULL, NULL, NULL, '2026-05-11 18:01:33', '2026-05-11 18:01:33', NULL, NULL),
(27, 'Aisyah Aprilia Sari', 'aisyah@genbi.com', NULL, '$2y$12$W8sWUj53ZaN0Yl0ln2aQGuyLwhmQXp1AOi5M3lTnb165dxyEJ1fQa', 0, 'anggota', '241921017', 'Manajemen', 'Kewirausahaan', NULL, NULL, NULL, NULL, '2026-05-11 18:02:24', '2026-05-11 18:02:24', NULL, NULL),
(28, 'Alfat Pandu Kusuma', 'alfat@genbi.com', NULL, '$2y$12$g.xzX8bRa8qbMlhpXeT6LeKkeRpSmxwlImYkjBvWnacfn6mdQ4Fy6', 0, 'anggota', '231210647', 'Sistem Informasi', 'Publikasi Dekorasi & Dokumentasi', NULL, NULL, NULL, NULL, '2026-05-11 18:03:01', '2026-05-11 18:03:01', NULL, NULL),
(29, 'Warda', 'warda@genbi.com', NULL, '$2y$12$G26cDeMHUR3c4uzi0rmsQOeRFbmc0wJGnlOIaMOKmFAQE5HlakR9e', 0, 'anggota', '241810891', 'Akuntansi', 'Pendidikan & Kebudayaan', NULL, NULL, NULL, NULL, '2026-05-11 18:03:51', '2026-05-11 18:03:51', NULL, NULL),
(30, 'Tina', 'tina@genbi.com', NULL, '$2y$12$rU6QW86LPAkslXz5E8FeIuh7diH/Ez5PTHjasB5iJOgUS7YmDK.8a', 0, 'anggota', '241820924', 'Akuntansi', 'Kewirausahaan', NULL, NULL, NULL, NULL, '2026-05-11 18:04:29', '2026-05-11 18:04:29', NULL, NULL),
(31, 'Safaldi', 'safaldi@genbi.com', NULL, '$2y$12$h9koYGYDoTux.8KcCBcmWuVGKLJGjIYTOoSejUrH1aSkLG91U0Hsa', 0, 'anggota', '241220615', 'Sistem Informasi', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 18:05:03', '2026-05-11 18:05:03', NULL, NULL),
(32, 'Antonio Brian Deeng', 'brian@genbi.com', NULL, '$2y$12$4ScSs2dFdMCmataqZGdufOggJWstjxFNrd9Who/zYxPLYDh1YRVhq', 0, 'anggota', '230520103', 'Agribisnis', 'Kewirausahaan', 'Ketua Devisi Kewirausahaan', 'profiles/GriprkqDJ5x36zKc0LdgETG8mxATEw8npJHAK7Ud.png', NULL, NULL, '2026-05-11 18:05:40', '2026-05-11 18:44:55', NULL, NULL),
(33, 'Darniati', 'darni@genbi.com', NULL, '$2y$12$IXKRzQ2aHEcbUepkRqPOaellC98cmVk7U1hMYwmM6EsEuheji.QRC', 0, 'anggota', '221220624', 'Sistem Informasi', 'Pendidikan & Kebudayaan', NULL, NULL, NULL, NULL, '2026-05-11 18:06:22', '2026-05-11 18:06:22', NULL, NULL),
(34, 'Herda', 'herda@genbi.com', NULL, '$2y$12$lBzCEzdNkY7HZo/L7oyfCuLtTGG9VcAtdaQdTRYlrF2pHucvRzu4q', 0, 'anggota', '231820939', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', NULL, NULL, NULL, NULL, '2026-05-11 18:06:55', '2026-05-11 18:06:55', NULL, NULL),
(35, 'Yani Apriyani', 'yani@genbi.com', NULL, '$2y$12$3yhuNPSlhdA7LI0p0Vd5oepPSeud4J24673.F2wJsWaomaN/CXvJO', 0, 'anggota', '221120436', 'Hukum', 'Kewirausahaan', NULL, NULL, NULL, NULL, '2026-05-11 18:07:40', '2026-05-11 18:07:40', NULL, NULL),
(36, 'Sela Marsida', 'sela@genbi.com', NULL, '$2y$12$LKtpq3IUpFsngHROHvbapuEtXoO9sGzRAytvARcj8sHp465tBez22', 0, 'anggota', '241820910', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', NULL, NULL, NULL, NULL, '2026-05-11 18:08:15', '2026-05-11 18:08:15', NULL, NULL),
(37, 'Muhammad Hamiludin', 'udin@genbi.com', NULL, '$2y$12$4TjbAD5OAPSbmxql6ho8J.w7HEsIoPpmvgKGMgWqB5YHWIlqNNPLi', 0, 'anggota', '241820921', 'Akuntansi', 'Pendidikan & Kebudayaan', NULL, NULL, NULL, NULL, '2026-05-11 18:08:55', '2026-05-11 18:08:55', NULL, NULL),
(38, 'Putri Meilani', 'meilani@genbi.com', NULL, '$2y$12$n1OoaovCwrFK9qUx.6GnR.5bHzQb/tob7kWatQNNna17AKTzt7ZjG', 0, 'anggota', '240310103', 'Pendidikan Matematika', 'Pendidikan & Kebudayaan', NULL, NULL, NULL, NULL, '2026-05-11 18:09:43', '2026-05-11 18:09:43', NULL, NULL),
(39, 'Muhammad Ilham', 'ilham@genbi.com', NULL, '$2y$12$wuWuKqcBSiQS8aDmqNUvQOkh5Y0saU226v677Zf5D0wkkCtpY7M2W', 0, 'anggota', '232218402', 'Akuntansi', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 18:10:20', '2026-05-11 18:10:20', NULL, NULL),
(40, 'Rifana', 'rifana@genbi.com', NULL, '$2y$12$BLp6mYSs4t0kfcIZp7OyqOLESjcM70TsszGH3vt32tftpMtv00nM.', 0, 'anggota', '241810884', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', NULL, NULL, NULL, NULL, '2026-05-11 18:10:53', '2026-05-11 18:10:53', NULL, NULL),
(41, 'Sri Wahyuni', 'yuni@genbi.com', NULL, '$2y$12$Z.x35/p0RTz.c.CmW/Lmzu5xdtpGVh50jIBwn346tYZDXIqLcenju', 0, 'anggota', '231830967', 'Akuntansi', 'Pengabdian Masyarakat', NULL, NULL, NULL, NULL, '2026-05-11 18:11:42', '2026-05-11 18:11:42', NULL, NULL),
(42, 'Ali Slamat', 'ali@genbi.com', NULL, '$2y$12$.kAZdBn6e/WY8kJ3qM1pbuFJlVAXQgITDM.MN/JLQaCpFrNngtmdq', 0, 'anggota', '221920984', 'Manajemen', 'Pengabdian Masyarakat', 'Ketua Devisi Pengabdian Masyarakat', 'profiles/d436T7Dary025A5McFwXUWjnIoHnpftrmzWk0jGz.jpg', NULL, NULL, '2026-05-11 18:12:14', '2026-05-11 18:40:43', NULL, NULL),
(43, 'Wahida Jafar', 'wahida@genbi.com', NULL, '$2y$12$7xUFJeXxcxpqggBbTl/moOO2dFpze3m2XahEhHyS1TD10Op2eMzWO', 0, 'anggota', '221220616', 'Sistem Informasi', 'Pengabdian Masyarakat', NULL, NULL, NULL, NULL, '2026-05-11 18:13:11', '2026-05-11 18:13:11', NULL, NULL),
(44, 'Rut Afrina Perzenya Sitorus', 'rut@genbi.com', NULL, '$2y$12$Ub60gMpiIAW8OOFPL6UxMOv.BrocerMQbR2EJCYNPUSa84AX3Gdb.', 0, 'anggota', '221130507', 'Hukum', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 18:14:23', '2026-05-11 18:14:23', NULL, NULL),
(45, 'Khaerunnisa Ahkam', 'nisa@genbi.com', NULL, '$2y$12$YykC0VWxCPAzWdgAgppXvOq1kZ4rUFyfgtX.UdvIPAk3U.v1G4NEa', 0, 'anggota', '221130494', 'Hukum', 'Kewirausahaan', NULL, NULL, NULL, NULL, '2026-05-11 18:14:58', '2026-05-11 18:14:58', NULL, NULL),
(46, 'Astrid', 'astrid@genbi.com', NULL, '$2y$12$NGxr7J3CzhR.A3iSSaVZVOc6wcAfeycSlk4iycFomSkHlCCQMihs6', 0, 'anggota', '221220645', 'Sistem Informasi', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 18:15:32', '2026-05-11 18:15:32', NULL, NULL),
(47, 'Dimas R', 'dimas@genbi.com', NULL, '$2y$12$f2jnLZVvXH923mukPD/EzOfybWUdyaHGsntuAQCjH2hPhrbICBYr6', 0, 'anggota', '241230683', 'Sistem Informasi', 'Pendidikan & Kebudayaan', NULL, NULL, NULL, NULL, '2026-05-11 18:16:07', '2026-05-11 18:16:07', NULL, NULL),
(48, 'Reza Ardita Bahtiar', 'reza@genbi.com', NULL, '$2y$12$6fHFV41kHROafJKSXptjoOBRxN4KSZ3COsXUlFooiGEidjrElFrt6', 0, 'anggota', '241820903', 'Akuntansi', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 18:16:54', '2026-05-11 18:31:48', NULL, NULL),
(49, 'Ni Luh Sujayanti', 'niluh@genbi.com', NULL, '$2y$12$L9IaDMSx.YC34pb3jUTIcOXnWRXZ7/5Rc/ym3nlreIvy/dL0nkwFS', 0, 'anggota', '240330110', 'Pendidikan Matematika', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 18:17:50', '2026-05-11 18:17:50', NULL, NULL),
(50, 'Muh Agus Salim', 'agus@genbi.com', NULL, '$2y$12$e5bh3cVBN3WnFE3PV2TQLOCgLSCZJKkvedK/HP9z9.csV5NoUiWfC', 0, 'anggota', '231830956', 'Akuntansi', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 18:18:19', '2026-05-11 18:18:19', NULL, NULL),
(51, 'Nurmagfira', 'fira@genbi.com', NULL, '$2y$12$2UgulP3qWi9FXFTXFzOkHOAYOXovVfiNE5UgGyZ4i8z8C.sIwzW6C', 0, 'anggota', '231030372', 'Administrasi Publik', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 18:19:37', '2026-05-11 18:19:37', NULL, NULL),
(52, 'Nurul Mawaddah', 'nurul@genbi.com', NULL, '$2y$12$JvK2BJZTOs7aoVH9SIrYg.cl015GdbEXaIg6CJQ693TMrvaHRYTXK', 0, 'anggota', '231030386', 'Administrasi Publik', 'Pengabdian Masyarakat', NULL, NULL, NULL, NULL, '2026-05-11 18:20:30', '2026-05-11 18:20:30', NULL, NULL),
(53, 'Rivaldi', 'rivaldi@genbi.com', NULL, '$2y$12$Q6llC7aqWvxtBjzBipa6H.WGDkBpKRAvPA.5kiK.L6yIdw4bgHZwy', 0, 'anggota', '231820921', 'Akuntansi', 'Kewirausahaan', NULL, NULL, NULL, NULL, '2026-05-11 18:21:02', '2026-05-11 18:21:02', NULL, NULL),
(54, 'Selvi Damayanti', 'selvi@genbi.com', NULL, '$2y$12$bc90m3gVSvkzSngqN5EEwuen/fqu/LXTOzcAXcFNqVlzFAYJHfzCu', 0, 'anggota', '221910947', 'Manajemen', 'Pengabdian Masyarakat', NULL, NULL, NULL, NULL, '2026-05-11 18:21:48', '2026-05-11 18:21:48', NULL, NULL),
(55, 'Dirga', 'dirga@genbi.com', NULL, '$2y$12$i1I1UVlV2Aitc0CfEJTc/.dNR86aubj6w3Fh5mn1ZM5SvMuraKLca', 0, 'anggota', '230930302', 'Teknik Pertambangan', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 18:22:43', '2026-05-11 18:22:43', NULL, NULL),
(56, 'Septa Pryatno', 'septa@genbi.com', NULL, '$2y$12$FIk17WF0YEH5bYpJIrgBWe3lSByxmSE7JTkoGmFcPCBY0byPiIWJG', 0, 'anggota', '231820940', 'Akuntansi', 'Publikasi Dekorasi & Dokumentasi', NULL, NULL, NULL, NULL, '2026-05-11 18:23:26', '2026-05-11 18:23:26', NULL, NULL),
(57, 'Afni Melati', 'afni@genbi.com', NULL, '$2y$12$TM23GBtCeCYHisXc13wCcu35EmP.q2z7UqyCCLgpHHQ3E6zWdZem6', 0, 'anggota', '242231159', 'Ilmu Komputer', 'Pengabdian Masyarakat', NULL, NULL, NULL, NULL, '2026-05-11 18:24:10', '2026-05-11 18:24:10', NULL, NULL),
(58, 'Meilan Faulana', 'meilan@genbi.com', NULL, '$2y$12$GXeMK9AsLPmZN.nqjUjju.WALZUFOCtyZv/BjsrfaJwIgc7XlMkBy', 0, 'anggota', '241220632', 'Sistem Informasi', 'Pendidikan & Kebudayaan', NULL, NULL, NULL, NULL, '2026-05-11 18:25:16', '2026-05-11 18:32:21', NULL, NULL),
(59, 'Shakila Revadianti Pracilia', 'shakila@genbi.com', NULL, '$2y$12$CN4D37YMmoHDNg1zlCHSo.8w6VhqShBEN0kpuNlZ3waswNidJc4N2', 0, 'anggota', '231831475', 'Akuntansi', 'Kewirausahaan', NULL, NULL, NULL, NULL, '2026-05-11 18:26:13', '2026-05-11 18:26:13', NULL, NULL),
(60, 'Imun', 'imun@genbi.com', NULL, '$2y$12$4M6bdYqNrTiisuWiMdXH2u4tB8qK5FL1aya97bpuO/C7NHtKuuv.W', 0, 'anggota', '241931063', 'Manajemen', 'Pendidikan & Kebudayaan', NULL, NULL, NULL, NULL, '2026-05-11 18:27:00', '2026-05-11 18:32:10', NULL, NULL),
(61, 'Jumarni', 'jumarni@genbi.com', NULL, '$2y$12$UWGFUZ9DmMhARP8YRNH8Dez5hTnKGi.026FwWrWAoHikyzXz9ikxu', 0, 'anggota', '242231139', 'Ilmu Komputer', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 18:27:37', '2026-05-11 18:31:13', NULL, NULL),
(62, 'Rusdayanti', 'rusda@genbi.com', NULL, '$2y$12$l/Zm6dEq.FkrwUp9aM2QX.n2Q9Ojn7Mn43K2KtNHa23qmvCiIxpx.', 0, 'anggota', '221920994', 'Manajemen', 'Kewirausahaan', NULL, NULL, NULL, NULL, '2026-05-11 18:28:14', '2026-05-11 18:28:14', NULL, NULL),
(63, 'Pandi Wiranto', 'pandi@genbi.com', NULL, '$2y$12$fAua4es79lgJ3wzBcAhv2eeo5AC23jVZryjbPNlGATfRo0BoW/ZgG', 0, 'anggota', '241220626', 'Sistem Informasi', 'Publikasi Dekorasi & Dokumentasi', NULL, NULL, NULL, NULL, '2026-05-11 18:28:45', '2026-05-11 18:28:45', NULL, NULL),
(64, 'Agung Pramadana', 'Agung@genbi.com', NULL, '$2y$12$Ci8/cd7XRCDjeccjxBQjweAPO6GHcw4lvpSSvs2DPShNveRipBqKi', 0, 'anggota', '241130488', 'Hukum', 'Lingkungan Hidup', NULL, NULL, NULL, NULL, '2026-05-11 18:29:27', '2026-05-11 18:29:27', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anggarans`
--
ALTER TABLE `anggarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggarans_kegiatan_id_foreign` (`kegiatan_id`);

--
-- Indexes for table `devisis`
--
ALTER TABLE `devisis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `poins`
--
ALTER TABLE `poins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nim_unique` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `anggarans`
--
ALTER TABLE `anggarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `devisis`
--
ALTER TABLE `devisis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notifikasis`
--
ALTER TABLE `notifikasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poins`
--
ALTER TABLE `poins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggarans`
--
ALTER TABLE `anggarans`
  ADD CONSTRAINT `anggarans_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

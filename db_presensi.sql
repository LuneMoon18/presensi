-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 03:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `kode_divisi` varchar(10) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`kode_divisi`, `nama_divisi`) VALUES
('12345', '122333'),
('Act', 'Accountings'),
('Admin', 'Admin'),
('GDD', 'Gudang'),
('MRK', 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nip` int(20) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `kode_divisi` char(10) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nip`, `nama_lengkap`, `kode_divisi`, `jabatan`, `no_hp`, `foto`, `password`, `remember_token`) VALUES
(123, 'Sellyn Azlina', 'GDD', 'Managers', '085795016750', '123.jpg', '$2y$12$bgh9ev0DzsiJDrlej.7A0eyGpNRWdHi13esEJnxuPbsFPgkaf3GWu', '123'),
(1030, 'Azlina', 'GDD', 'Staff IT', '085795016756', '1030.jpg', '$2y$12$ZLB0LhLwzivVrT/102AbXu7Nesr9ITxhLLI3zhrHw3CtG/basjsW6', NULL),
(2045, 'Aldi Ardiansyah Rahmat', 'Act', 'Head of IT', '12345', '2045.jpg', '$2y$12$fNQj/Q4i/UhO5C.2X5pcCe.RSJLjaeAsnhZwo7vIoVcZzxAok3bn2', NULL),
(2445, 'Aldi Ardiansyah Rahmat', 'MRK', 'Apa aja', '098678567345', NULL, '$2y$12$SRL1dNahC03KHnUQPpRPt.WSa9RROHqPdTAmhIkQ9UXHqoOxg86C2', NULL),
(12345, 'Ellyn Pramesti A', 'MRK', 'Team Leader', '085795016759', '12345.jpg', '$2y$12$/Tg5IdJgRB4lI7uOUMBpwuffCXZesjjTGfsKGw11riSaq5M2sQvt.', 'PLf4276cDOIIbJR5QCc18OtfW5KaWTeluQ85vVu6CVbO81mFNTyEY23VcEa3'),
(20320, 'Aldi AR', 'Act', 'Apa ajaaa', '098678567345', '20320.jpg', '$2y$12$hhuTK8I3ByF7mGZjqzrBh.W1F0QZKjohmLgbILXOsyz0ZXfISc21.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `permission_date` date NOT NULL,
  `status` char(1) NOT NULL COMMENT 'i: izin, s: sakit',
  `keterangan` text NOT NULL,
  `status_approval` char(1) DEFAULT '0' COMMENT '0:proses, 1:disetujui, 2: ditolak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `nip`, `permission_date`, `status`, `keterangan`, `status_approval`) VALUES
(22, '12345', '2023-11-11', 'i', 'Jalan-jalan', '1'),
(23, '12345', '2023-12-11', 's', 'sakit apa yaa', '1'),
(24, '12345', '2023-12-12', 'i', 'Ke rumah nenek', '2'),
(25, '12345', '2023-12-12', 'i', 'www', '1'),
(26, '12345', '2023-12-12', 's', 'k', '1');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `kode_pos` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `radius` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`kode_pos`, `alamat`, `latitude`, `longitude`, `radius`) VALUES
('45561', 'Jalaksana', '-6.938666283261363', '108.5026244364014', 5);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `presence_id` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `presence_date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `lat_long` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`presence_id`, `nip`, `presence_date`, `time_in`, `time_out`, `lat_long`) VALUES
(20, 12345, '2023-12-12', '10:21:29', '13:57:23', '-6.9206016, 107.610112'),
(21, 123, '2023-12-12', '06:23:35', '13:23:50', ''),
(22, 12345, '2023-12-12', '14:04:38', '13:57:23', '-6.9206016, 107.610112'),
(23, 12345, '2023-12-12', '00:02:20', '13:57:23', '-6.9206016, 107.610112'),
(24, 12345, '2023-12-12', '14:20:23', '13:57:23', '-6.9206016, 107.610112');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `kode_pos` int(10) NOT NULL,
  `nama_web` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `no_hp` int(14) NOT NULL,
  `alamat` text NOT NULL,
  `alamat_web` varchar(100) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `nama_direktur` varchar(100) NOT NULL,
  `nama_manager` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`kode_pos`, `nama_web`, `deskripsi`, `no_hp`, `alamat`, `alamat_web`, `nama_perusahaan`, `nama_direktur`, `nama_manager`) VALUES
(3, 'apaja', 'apaja', 123456, 'Jalaksana', 'apaja', 'apaaja', 'apaja', 'apaja');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'sellyn', 'sellyn@gmail.com', NULL, '$2y$12$8JZWz5kYWVU0GJ2xNkilNeYXV9HsZtzMpOtPRoOKnenu4/xFSPCZG', NULL, NULL, NULL, NULL),
(2, 'Rismaaa', 'luna@gmail.com', NULL, '$2y$12$qzHTmH4p94IOW2Cf2ji81uQC66fWezDNXwxFde2zh8kTFRf.yBy2y', NULL, NULL, '2023-12-10 08:53:36', '2023-12-10 08:53:36'),
(3, 'aldi', 'aldi@gmail.com', NULL, '$2y$12$mgf/w36UK2AUzfogmkayfOIelODVCNBXK7C2K9rNKrZWpNLt8fBLq', NULL, NULL, '2023-12-10 09:02:15', '2023-12-10 09:02:15'),
(4, 'admin', 'admin@gmail.com', NULL, '$2y$12$M5mQDYCCX2pw67JgK3no6e3L2mJV2j/ikb7QAOgAHOvozJd3B1Hge', NULL, NULL, '2023-12-10 09:03:13', '2023-12-10 09:03:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`kode_divisi`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`kode_pos`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`presence_id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`kode_pos`);

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
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `presence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

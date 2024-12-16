-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 04:01 AM
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
-- Database: `sipesdek_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `jenis_fasilitas` enum('Laboratorium','Perpustakaan','Lapangan Olahraga') NOT NULL,
  `kondisi_fasilitas` enum('Baik','Cukup','Buruk') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `id_sekolah`, `jenis_fasilitas`, `kondisi_fasilitas`, `keterangan`, `created_at`, `updated_at`) VALUES
(11, 20, 'Laboratorium', 'Baik', 'Sangat Baik', '2024-12-15 00:47:51', '2024-12-15 00:47:51'),
(12, 20, 'Perpustakaan', 'Baik', 'Sangat Baik', '2024-12-15 00:48:01', '2024-12-15 00:48:01'),
(13, 20, 'Lapangan Olahraga', 'Baik', 'Sangat Baik', '2024-12-15 00:48:12', '2024-12-15 00:48:12'),
(15, 24, 'Lapangan Olahraga', 'Cukup', 'Cukup Baik', '2024-12-15 00:50:45', '2024-12-15 00:50:45'),
(17, 25, 'Lapangan Olahraga', 'Cukup', 'Cukup Baik', '2024-12-15 00:51:42', '2024-12-15 00:51:42'),
(18, 19, 'Laboratorium', 'Baik', 'Baik', '2024-12-15 00:52:08', '2024-12-15 00:52:08'),
(20, 19, 'Lapangan Olahraga', 'Cukup', 'Cukup Baik', '2024-12-15 00:52:36', '2024-12-15 00:52:36'),
(21, 15, 'Laboratorium', 'Baik', 'Sangat Baik', '2024-12-15 00:53:28', '2024-12-15 00:53:28'),
(22, 15, 'Lapangan Olahraga', 'Baik', 'Sangat Baik', '2024-12-15 00:53:45', '2024-12-15 00:53:45'),
(23, 16, 'Lapangan Olahraga', 'Baik', 'Cukup Baik', '2024-12-15 00:54:04', '2024-12-15 00:54:04'),
(24, 17, 'Laboratorium', 'Baik', 'Baik', '2024-12-15 00:54:17', '2024-12-15 00:54:17'),
(25, 17, 'Perpustakaan', 'Baik', 'Sangat Baik', '2024-12-15 00:54:29', '2024-12-15 00:54:29'),
(26, 17, 'Lapangan Olahraga', 'Cukup', 'Cukup Baik', '2024-12-15 00:54:53', '2024-12-15 00:54:53'),
(27, 18, 'Lapangan Olahraga', 'Cukup', 'Cukup Baik', '2024-12-15 00:55:11', '2024-12-15 00:55:11'),
(29, 21, 'Lapangan Olahraga', 'Buruk', 'Buruk', '2024-12-15 00:56:10', '2024-12-15 00:56:10'),
(30, 21, 'Laboratorium', 'Cukup', 'Cukup Baik', '2024-12-15 00:56:29', '2024-12-15 00:56:29'),
(31, 21, 'Perpustakaan', 'Cukup', 'Cukup Baik', '2024-12-15 00:56:45', '2024-12-15 00:56:45'),
(32, 22, 'Laboratorium', 'Baik', 'Sangat Baik', '2024-12-15 00:57:00', '2024-12-15 00:57:00'),
(33, 22, 'Perpustakaan', 'Baik', 'Sangat Baik', '2024-12-15 00:57:18', '2024-12-15 00:57:18'),
(34, 22, 'Lapangan Olahraga', 'Baik', 'Baik', '2024-12-15 00:57:34', '2024-12-15 01:02:02'),
(35, 23, 'Laboratorium', 'Buruk', 'Buruk', '2024-12-15 00:57:57', '2024-12-15 00:57:57'),
(36, 23, 'Perpustakaan', 'Cukup', 'Cukup Baik', '2024-12-15 00:58:12', '2024-12-15 00:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `id_sekolah`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(16, 20, '-6.505863432450412', '110.90821476744362', '2024-12-14 23:32:02', '2024-12-14 23:32:02'),
(17, 22, '-6.496645248367419', '110.90465376928545', '2024-12-14 23:32:44', '2024-12-14 23:32:44'),
(18, 21, '-6.497333068772892', '110.9023952116017', '2024-12-14 23:33:29', '2024-12-14 23:33:29'),
(19, 15, '-6.502218609879435', '110.90559239872778', '2024-12-14 23:34:06', '2024-12-14 23:34:06'),
(20, 16, '-6.501820489511763', '110.90583004235415', '2024-12-14 23:34:45', '2024-12-15 15:34:09'),
(21, 17, '-6.501730495342848', '110.90570079369829', '2024-12-14 23:36:00', '2024-12-14 23:36:00'),
(22, 18, '-6.503148097278578', '110.90726957954729', '2024-12-14 23:37:24', '2024-12-14 23:37:24'),
(23, 19, '-6.49887247935413', '110.90434610937467', '2024-12-14 23:37:59', '2024-12-14 23:37:59'),
(24, 23, '-6.497220867742357', '110.9028545657258', '2024-12-14 23:40:27', '2024-12-14 23:40:27'),
(25, 25, '-6.498792401616941', '110.90435602700569', '2024-12-14 23:57:46', '2024-12-14 23:58:33'),
(26, 24, '-6.498830361519578', '110.9046826441614', '2024-12-14 23:58:13', '2024-12-14 23:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori` enum('SD/MI','SMP/MTS','SMA/SMK') NOT NULL,
  `status` enum('Negeri','Swasta') NOT NULL,
  `tahun_berdiri` year(4) NOT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `alamat` text NOT NULL,
  `jumlah_siswa` int(11) NOT NULL,
  `jumlah_kelas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `gambar`, `kategori`, `status`, `tahun_berdiri`, `no_telp`, `alamat`, `jumlah_siswa`, `jumlah_kelas`, `created_at`, `updated_at`) VALUES
(15, 'SDN 1 Kelet', '1734313989_SDN 1 kelet.png', 'SD/MI', 'Negeri', '1985', '081234567889', 'Kelet RT. 21 RW. 03', 180, 6, '2024-12-14 23:24:00', '2024-12-16 01:53:09'),
(16, 'SDN 2 Kelet', '1734313981_sdn 2 kelet.png', 'SD/MI', 'Negeri', '1965', '081234567889', 'Kelet RT. 21 RW. 03', 90, 6, '2024-12-14 23:24:00', '2024-12-16 01:53:01'),
(17, 'SDN 3 Kelet', '1734313971_SDN 3 kelet.png', 'SD/MI', 'Negeri', '1970', '081234567889', 'Kelet RT. 21 RW. 03', 160, 6, '2024-12-14 23:24:00', '2024-12-16 01:52:51'),
(18, 'SDN 4 Kelet', '1734313962_sdn 4 kelet.png', 'SD/MI', 'Negeri', '1975', '081234567889', 'Kelet RT. 19 RW. 03', 140, 6, '2024-12-14 23:24:00', '2024-12-16 01:52:42'),
(19, 'MTS Sunan Muria', '1734313952_MTS Sunan Muria Kelet.jpg', 'SMP/MTS', 'Swasta', '1980', '098372832399', 'Kelet RT. 06 RW. 01', 180, 6, '2024-12-14 23:24:00', '2024-12-16 01:52:32'),
(20, 'MAN 2 Jepara', '1734220979_man 2 jepara.png', 'SMA/SMK', 'Negeri', '1985', '09120012121', 'Kelet RT. 18 RW. 03', 800, 24, '2024-12-14 23:24:00', '2024-12-15 00:44:34'),
(21, 'SMK Muhammadiyah Kelet', '1734221211_smk muhammadiyah keling.png', 'SMA/SMK', 'Swasta', '1990', '09120012121', 'Kelet RT.30 RW. 05', 450, 15, '2024-12-14 23:24:00', '2024-12-15 16:49:40'),
(22, 'SMK Wikrama 1 Jepara', '1734220934_smk wikrama 1 jepara.png', 'SMA/SMK', 'Swasta', '1995', '029302323232', 'Kelet RT. 05 RW. 01', 220, 12, '2024-12-14 23:24:00', '2024-12-15 00:35:25'),
(23, 'SMP Muhammadiyah Keling', '1734313938_SMP Muhammadiyah Keling.png', 'SMP/MTS', 'Swasta', '1990', '0983728323', 'Kelet RT. 33 RW. 05', 450, 15, '2024-12-14 23:40:09', '2024-12-16 01:52:18'),
(24, 'MI. Matholiul Falah 01 Kelet', '1734313923_MI. Matholiul Falah 01 kelet.png', 'SD/MI', 'Swasta', '1960', '123456789012', 'Kelet RT. 06 RW. 01', 130, 6, '2024-12-14 23:56:59', '2024-12-16 01:52:03'),
(25, 'MI. Matholiul Falah 02 kelet', '1734313914_MI. Matholiul Falah 02 Kelet.png', 'SD/MI', 'Swasta', '1965', '029302323232', 'Kelet RT. 06 RW. 01', 150, 6, '2024-12-14 23:56:59', '2024-12-16 01:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(2, 'tegar', '$2y$10$KmmoHP9rc8E/uFY0AkPBYetZEN6YFXSegoiuQkkwjmfXLOCMxmef.', 'tegar@gmail.com', '2024-12-07 16:15:39', '2024-12-15 00:59:42'),
(9, 'admin', '$2y$10$y78.wYzPBdcbiXtEoUcT2u045A8Z/03sx8eUf749VTcUS1ch4CunW', 'admin@gmail.com', '2024-12-15 17:02:16', '2024-12-15 17:02:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD KEY `idx_id_sekolah` (`id_sekolah`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`),
  ADD KEY `idx_id_sekolah` (`id_sekolah`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD CONSTRAINT `fasilitas_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`) ON DELETE CASCADE;

--
-- Constraints for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD CONSTRAINT `lokasi_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

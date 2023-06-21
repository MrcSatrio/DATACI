-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 10:54 AM
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
-- Database: `db_mps`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id_berkas` int(11) NOT NULL,
  `berkas` varchar(64) NOT NULL,
  `keterangan` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id_berkas`, `berkas`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '1686810054_edf96e85f4e1327ea144.pdf', 'Pengumuan Implementasi Sistem', '2023-06-15 13:20:54', '2023-06-15 13:20:54');

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `id_harga` tinyint(4) NOT NULL,
  `nama_harga` varchar(16) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id_harga`, `nama_harga`, `nominal`) VALUES
(1, 'parkir_motor', 3000),
(2, 'parkir_mobil', 5000),
(3, 'kartu_hilang', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id_jenis_pembayaran` tinyint(4) NOT NULL,
  `nama_jenis_pembayaran` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id_jenis_pembayaran`, `nama_jenis_pembayaran`) VALUES
(1, 'cash'),
(2, 'transfer');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id_jenis_transaksi` tinyint(4) NOT NULL,
  `nama_jenis_transaksi` varchar(32) NOT NULL,
  `deskripsi_jenis_transaksi` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`id_jenis_transaksi`, `nama_jenis_transaksi`, `deskripsi_jenis_transaksi`) VALUES
(1, 'Top-Up', 'menambahkan saldo ke kartu parkir mahasiswa untuk digunakan dala'),
(2, 'Kartu-Hilang', 'Melakukan Pergantian Kartu, di karenakan kartu hilang'),
(3, 'Parkir', 'Sedang dalam area parkir');

-- --------------------------------------------------------

--
-- Table structure for table `kartu`
--

CREATE TABLE `kartu` (
  `id_kartu` int(11) NOT NULL,
  `nomor_kartu` char(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kartu`
--

INSERT INTO `kartu` (`id_kartu`, `nomor_kartu`, `saldo`, `created_at`, `updated_at`) VALUES
(3, '66372637', 10000, '2023-05-05 03:55:40', '2023-06-21 09:36:22'),
(4, '76276376', 30000, '2023-05-05 03:57:11', '2023-06-15 13:19:31'),
(5, '5524232', 8000, '2023-05-05 03:58:02', '2023-06-16 15:27:18'),
(6, '', 522000, '2023-05-05 04:02:04', '2023-06-19 20:54:07'),
(33, '123', 157000, '2023-05-24 22:34:30', '2023-06-06 16:40:59'),
(34, '12329888', 2000, '2023-05-26 15:19:42', '2023-05-26 15:19:42'),
(35, '6289533', 200000, '2023-05-29 14:56:36', '2023-06-14 20:53:22'),
(36, '1234543212', 0, '2023-06-14 20:38:10', '2023-06-14 20:38:10'),
(37, '12421412', 20000, '2023-06-14 20:42:38', '2023-06-14 20:42:38'),
(38, '125151', 20000, '2023-06-14 20:45:59', '2023-06-14 20:45:59'),
(39, '1211123', 20000, '2023-06-14 21:21:11', '2023-06-14 21:21:11'),
(40, '2147483647', 20000, '2023-06-14 22:24:13', '2023-06-14 22:24:13'),
(41, '6246354', 20000, '2023-06-14 22:25:05', '2023-06-14 22:25:05'),
(42, '2152152', 20000, '2023-06-14 22:26:01', '2023-06-14 22:26:01'),
(43, '2152152', 20000, '2023-06-14 22:26:22', '2023-06-14 22:26:22'),
(44, '2151125', 20000, '2023-06-14 22:29:04', '2023-06-14 22:29:04'),
(45, '2151125', 20000, '2023-06-14 22:29:20', '2023-06-14 22:29:20'),
(46, '12421', 20000, '2023-06-14 22:34:25', '2023-06-14 22:34:25'),
(47, '12421', 20000, '2023-06-14 22:35:33', '2023-06-14 22:35:33'),
(48, '12421', 20000, '2023-06-14 22:35:40', '2023-06-14 22:35:40'),
(49, '12421', 20000, '2023-06-14 22:36:47', '2023-06-14 22:53:21'),
(50, '2147483647', 20000, '2023-06-14 22:38:42', '2023-06-14 22:38:42'),
(51, '12345678', 20000, '2023-06-14 22:39:22', '2023-06-14 22:59:42'),
(52, '2147483647', 20000, '2023-06-15 00:23:10', '2023-06-15 00:23:10'),
(53, '12345678', 20000, '2023-06-15 00:43:12', '2023-06-15 00:43:12'),
(54, '3719119', 20000, '2023-06-15 00:45:13', '2023-06-15 00:45:13'),
(55, '123', 14000, '2023-06-15 00:50:50', '2023-06-15 07:17:49'),
(56, '0', 20000, '2023-06-15 00:51:52', '2023-06-15 01:20:04'),
(57, '1234561', 20000, '2023-06-15 10:02:53', '2023-06-15 10:02:53'),
(58, '123454432', 20000, '2023-06-15 10:12:36', '2023-06-15 10:12:36'),
(59, '76543456', 20000, '2023-06-15 10:19:06', '2023-06-15 10:19:06'),
(60, '0003763481', 15000, '2023-06-15 15:27:24', '2023-06-18 20:58:40'),
(61, '89533', 47000, '2023-06-15 21:22:59', '2023-06-16 13:46:10'),
(62, '0', 90000, '2023-06-16 14:22:46', '2023-06-16 16:02:59'),
(63, '3694953', 20000, '2023-06-16 17:28:50', '2023-06-16 17:28:50'),
(64, '3696930', 20000, '2023-06-16 17:30:32', '2023-06-16 17:30:32'),
(65, '6969', 91000, '2023-06-16 17:34:19', '2023-06-19 20:14:22'),
(66, '0003708142', 0, '2023-06-18 21:02:04', '2023-06-18 21:08:51'),
(67, '0003650288', 20000, '2023-06-18 21:02:45', '2023-06-18 21:04:05'),
(68, '0003312840', 20000, '2023-06-20 14:47:08', '2023-06-20 14:47:08'),
(69, '11111111111', 20000, '2023-06-20 21:14:42', '2023-06-20 21:14:42'),
(70, '00066435467', 0, '2023-06-20 21:29:46', '2023-06-20 21:29:46'),
(71, '0002576495', 20000, '2023-06-21 09:35:01', '2023-06-21 10:27:16'),
(72, '0003428768', 50000, '2023-06-21 09:36:23', '2023-06-21 09:36:23'),
(73, '0004909173', 40000, '2023-06-21 09:38:09', '2023-06-21 10:33:30'),
(74, '0003396747', 70000, '2023-06-21 09:39:00', '2023-06-21 10:07:22'),
(75, '0003676939', 20000, '2023-06-21 09:39:45', '2023-06-21 09:39:45'),
(76, '0003704096', 47000, '2023-06-21 09:40:13', '2023-06-21 10:27:34'),
(77, '0003707577', 17000, '2023-06-21 09:40:42', '2023-06-21 10:26:53'),
(78, '0003769516', 3000, '2023-06-21 09:41:19', '2023-06-21 10:25:38'),
(79, '0003707248', 20000, '2023-06-21 09:41:47', '2023-06-21 09:41:47'),
(80, '0003679800', 20000, '2023-06-21 09:42:20', '2023-06-21 09:42:20'),
(81, '0003691622', 20000, '2023-06-21 09:44:31', '2023-06-21 09:49:09'),
(82, '0003648430', 20000, '2023-06-21 09:52:57', '2023-06-21 09:58:37'),
(83, '0003719119', 50000, '2023-06-21 09:53:43', '2023-06-21 10:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` tinyint(4) NOT NULL,
  `nama_role` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'admin'),
(2, 'keuangan'),
(3, 'operator'),
(4, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nama_status` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `nama_status`) VALUES
(1, 'ebiu'),
(2, 'member');

-- --------------------------------------------------------

--
-- Table structure for table `status_transaksi`
--

CREATE TABLE `status_transaksi` (
  `id_status_transaksi` tinyint(4) NOT NULL,
  `nama_status_transaksi` varchar(32) NOT NULL,
  `deskripsi_status_transaksi` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_transaksi`
--

INSERT INTO `status_transaksi` (`id_status_transaksi`, `nama_status_transaksi`, `deskripsi_status_transaksi`) VALUES
(1, 'PENDING', 'Transaksi sedang dalam proses...'),
(2, 'COMPLETE', 'Transaksi Selesai...'),
(3, 'APPROVED', 'Transaksi Telah Disetujui Keuangan...'),
(4, 'CANCEL', 'Transaksi dibatalkan...');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kodebooking_transaksi` char(6) NOT NULL,
  `npm` int(11) NOT NULL,
  `id_jenis_transaksi` tinyint(4) NOT NULL,
  `saldoawal_transaksi` int(11) NOT NULL,
  `nominal_transaksi` int(11) NOT NULL,
  `saldoakhir_transaksi` int(11) NOT NULL,
  `id_jenis_pembayaran` tinyint(4) NOT NULL,
  `id_status_transaksi` tinyint(4) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kodebooking_transaksi`, `npm`, `id_jenis_transaksi`, `saldoawal_transaksi`, `nominal_transaksi`, `saldoakhir_transaksi`, `id_jenis_pembayaran`, `id_status_transaksi`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
(163, 'I6W8HK', 2021320032, 2, 20000, 0, 20000, 1, 3, '', '2023-06-21 09:57:03', '2023-06-21 09:59:17'),
(164, 'EIWYU2', 2021320042, 1, 20000, 20000, 40000, 1, 3, '', '2023-06-21 09:58:53', '2023-06-21 10:01:47'),
(165, 'HXUJ7W', 2021320004, 1, 20000, 50000, 70000, 2, 3, '20230621100552_1687316752_a250c70e94e5eac818d3.png', '2023-06-21 10:04:06', '2023-06-21 10:07:22'),
(166, 'UXANXG', 2021320034, 3, 20000, 3000, 17000, 1, 2, '', '2023-06-21 10:20:23', '2023-06-21 10:20:23'),
(167, 'N8H2SM', 2021320034, 3, 17000, 3000, 14000, 1, 2, '', '2023-06-21 10:23:31', '2023-06-21 10:23:31'),
(168, 'BV4PQ6', 2021320034, 3, 14000, 3000, 11000, 1, 2, '', '2023-06-21 10:25:19', '2023-06-21 10:25:19'),
(169, '5AVR1J', 2021320034, 3, 11000, 3000, 8000, 1, 2, '', '2023-06-21 10:25:29', '2023-06-21 10:25:29'),
(170, 'M9SDC4', 2021320034, 3, 8000, 5000, 3000, 1, 2, '', '2023-06-21 10:25:38', '2023-06-21 10:25:38'),
(171, '3AJGXW', 2021320021, 3, 20000, 3000, 17000, 1, 2, '', '2023-06-21 10:26:53', '2023-06-21 10:26:53'),
(172, '31FMW9', 2021320123, 3, 50000, 3000, 47000, 1, 2, '', '2023-06-21 10:27:34', '2023-06-21 10:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `npm` int(11) NOT NULL,
  `id_kartu` int(11) NOT NULL,
  `id_role` tinyint(4) NOT NULL,
  `id_status` int(11) NOT NULL,
  `masa_berlaku` datetime NOT NULL,
  `nama` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` char(8) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`npm`, `id_kartu`, `id_role`, `id_status`, `masa_berlaku`, `nama`, `email`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, '0000-00-00 00:00:00', 'Admin Root', 'rahmantoadmojo@gmail.com', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', '', '2023-05-05 03:55:40', '2023-06-21 09:36:22'),
(2, 4, 2, 2, '0000-00-00 00:00:00', 'arief fadhil', 'Arieffdhl@gmail.com', '202cb962ac59075b964b07152d234b70', '', '2023-05-05 03:57:11', '2023-06-15 13:19:31'),
(3, 5, 3, 1, '0000-00-00 00:00:00', 'dapidah', 'davidst@gmail.com', '202cb962ac59075b964b07152d234b70', '', '2023-05-05 03:58:02', '2023-06-16 01:37:25'),
(2021320004, 74, 4, 1, '0000-00-00 00:00:00', 'Lita Aftania Putri', 'litap1404@gmail.com', '0406a18e88e08146adcd5615610d80f1', '', '2023-06-21 09:39:00', '2023-06-21 09:39:00'),
(2021320006, 79, 4, 1, '0000-00-00 00:00:00', 'Atika Hanifah', 'atikahanifah35@gmail.com', '3110147156938d8288f99d2233dd5ae2', '', '2023-06-21 09:41:47', '2023-06-21 09:41:47'),
(2021320016, 80, 4, 1, '0000-00-00 00:00:00', 'Eka Apriyanti', 'ekaa95153@gmail.com', 'de8695005f372d260f715288aa8056f7', '', '2023-06-21 09:42:20', '2023-06-21 09:42:20'),
(2021320021, 77, 4, 1, '0000-00-00 00:00:00', 'Agustin Amalia Saputri', 'agustinamaliasaputri@gmail.com', 'c55623f9dfb97a64a7c7346d71fc863b', '', '2023-06-21 09:40:42', '2023-06-21 09:40:42'),
(2021320032, 71, 4, 2, '2023-07-21 00:00:00', 'Qurrotu Aini', 'qurrotuaini509@gmail.com', 'ac738ed657127e24649bc8e6b61ac747', '', '2023-06-21 09:35:01', '2023-06-21 10:27:16'),
(2021320034, 78, 4, 1, '0000-00-00 00:00:00', 'Thalita Putri Meina Mat Ham', 'putrithalita04@gmail.com', '0f57fe1b328a9b3b6e8d6353f62c462c', '', '2023-06-21 09:41:19', '2023-06-21 09:41:19'),
(2021320035, 82, 4, 2, '2023-07-21 00:00:00', 'Zaky Abdurrahman', 'zakyabdrr1@gmail.com', 'e18fc358514498b765ce2842c5e40e3a', '', '2023-06-21 09:52:57', '2023-06-21 09:58:37'),
(2021320042, 73, 4, 2, '2023-06-22 00:00:00', 'Faradila Galuh Pramesti', 'faradilapramesti5181@gmail.com', '0ec5752fc999a6ab2b7bc866848ad69b', '', '2023-06-21 09:38:09', '2023-06-21 10:33:29'),
(2021320085, 83, 4, 1, '0000-00-00 00:00:00', 'Jhoni Susanto', 'j.susanto103@gmail.com', 'a7d62590f3784d8c12e698da06c3ab92', '', '2023-06-21 09:53:43', '2023-06-21 10:19:15'),
(2021320090, 81, 4, 2, '2023-07-21 00:00:00', 'Mauhamad Raihan Fawwaz Ramadhan', 'muhamadraihan1511@gmail.com', '5fbeb23148308e3d5b626655fea8da9c', '', '2023-06-21 09:44:31', '2023-06-21 09:49:09'),
(2021320108, 72, 4, 1, '0000-00-00 00:00:00', 'Nahdah Rizky Nur Afifah', 'ernahdah@gmail.com', '3ef7ab4d6db7968b2af086ea45706e48', '', '2023-06-21 09:36:23', '2023-06-21 09:36:23'),
(2021320121, 75, 4, 1, '0000-00-00 00:00:00', 'Dhini Nurawiati Purwanda', 'dhinipurwanda26@gmail.com', 'a71c2479db97f71775446523aadb7b0f', '', '2023-06-21 09:39:45', '2023-06-21 09:39:45'),
(2021320123, 76, 4, 1, '0000-00-00 00:00:00', 'Alka Kandia Risayida', 'alkakandia1704@gmail.com', '0872ce176670a9f639e566127999f683', '', '2023-06-21 09:40:13', '2023-06-21 09:40:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id_jenis_pembayaran`);

--
-- Indexes for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id_jenis_transaksi`);

--
-- Indexes for table `kartu`
--
ALTER TABLE `kartu`
  ADD PRIMARY KEY (`id_kartu`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `status_transaksi`
--
ALTER TABLE `status_transaksi`
  ADD PRIMARY KEY (`id_status_transaksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_npm_references_table_user_npm` (`npm`),
  ADD KEY `fk_id_jenis_transaksi_references_table_jenis_transaksi` (`id_jenis_transaksi`),
  ADD KEY `fk_id_status_transaksi_references_table_status_transaksi` (`id_status_transaksi`),
  ADD KEY `fk_id_jenis_pembayaran_references_table_jenis_pembayaran` (`id_jenis_pembayaran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`npm`),
  ADD KEY `id_role_reference_tabel_role` (`id_role`),
  ADD KEY `id_kartu_reference_tabel_kartu` (`id_kartu`),
  ADD KEY `id_status_reference_table_status` (`id_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kartu`
--
ALTER TABLE `kartu`
  MODIFY `id_kartu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_id_jenis_pembayaran_references_table_jenis_pembayaran` FOREIGN KEY (`id_jenis_pembayaran`) REFERENCES `jenis_pembayaran` (`id_jenis_pembayaran`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

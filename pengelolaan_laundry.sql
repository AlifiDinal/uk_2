-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 19, 2025 at 03:50 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengelolaan_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas_users`
--

CREATE TABLE `aktivitas_users` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `aktivitas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` text NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `users_agent` text NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `aktivitas_users`
--

INSERT INTO `aktivitas_users` (`id`, `user_id`, `aktivitas`, `keterangan`, `ip_address`, `users_agent`, `created_at`) VALUES
(1, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-19 03:06:33'),
(2, 7, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-19 03:06:53'),
(3, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-19 03:09:02'),
(4, 7, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-19 03:47:38'),
(5, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 01:26:59'),
(6, 7, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 02:34:57'),
(7, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 02:48:25'),
(8, 7, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 02:54:37'),
(9, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 03:47:06'),
(10, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-30 03:18:32'),
(11, 8, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-01 08:07:05'),
(12, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-02 04:49:53'),
(13, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-07 06:35:59'),
(14, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-08 07:20:30'),
(15, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-15 13:55:42'),
(16, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-17 02:16:28'),
(17, 9, 'Login', 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-15 05:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_paket` int NOT NULL,
  `qty` double NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id`, `id_transaksi`, `id_paket`, `qty`, `keterangan`) VALUES
(5, 9, 17, 3, '3kg Cucian Berupa Baju&Celana'),
(6, 10, 18, 1, '1kg Cucian Berupa Baju&Celana'),
(7, 11, 13, 4, 'Baju dan selimut, Seberat 4kg'),
(8, 11, 13, 1, 'Baju dan selimut, Seberat 4kg Sudah di ambil');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id`, `name`, `alamat`, `jenis_kelamin`, `tlp`) VALUES
(3, 'putri', 'sanden kapanewon sanden', 'P', '08967643666'),
(5, 'joko', 'sleman', 'L', '3987662'),
(6, 'Yuda', 'Keweden ,Trirenggo ,Bantul', 'L', '089518092195');

-- --------------------------------------------------------

--
-- Table structure for table `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_outlet`
--

INSERT INTO `tb_outlet` (`id`, `nama`, `alamat`, `tlp`) VALUES
(2, 'Mawar Laundry 1', 'JL Bantul Km5', '107355355'),
(8, 'mawar laundry 3', 'keweden Trirenggo Bantul', '089519082196'),
(9, 'mawar laundry 2', 'Sanden Kapanewon Bantul', '089877254');

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id` int NOT NULL,
  `id_outlet` int NOT NULL,
  `jenis` enum('kiloan','selimut','bed_cover','kaos','lain') NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`id`, `id_outlet`, `jenis`, `nama_paket`, `harga`) VALUES
(13, 2, 'kiloan', 'Putri', 50000),
(17, 8, 'bed_cover', 'yuda', 500000),
(18, 9, 'selimut', 'Dimas', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `alamat` text,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tlp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int NOT NULL,
  `id_outlet` int NOT NULL,
  `kode_invoice` varchar(100) NOT NULL,
  `id_member` int NOT NULL,
  `tgl` datetime NOT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `batas_waktu` datetime NOT NULL,
  `biaya_tambahan` int NOT NULL,
  `diskon` double NOT NULL,
  `pajak` int NOT NULL,
  `status` enum('baru','proses','selesai','diambil') NOT NULL,
  `dibayar` enum('dibayar','belum_dibayar') NOT NULL,
  `id_user` int NOT NULL,
  `pelanggan_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `id_outlet`, `kode_invoice`, `id_member`, `tgl`, `tgl_bayar`, `batas_waktu`, `biaya_tambahan`, `diskon`, `pajak`, `status`, `dibayar`, `id_user`, `pelanggan_id`) VALUES
(9, 2, 'INV001', 6, '2025-09-03 00:00:00', '2025-09-05 15:38:00', '2025-09-05 00:00:00', 2000, 4, 90, 'diambil', 'dibayar', 7, 0),
(10, 8, 'INV002', 6, '2025-09-18 00:00:00', '2025-09-18 11:39:00', '2025-09-22 00:00:00', 4000, 3, 30, 'baru', 'belum_dibayar', 8, 0),
(11, 9, 'INV003', 3, '2025-09-14 00:00:00', '2025-09-18 11:40:00', '2025-09-18 00:00:00', 3300, 2, 56, 'selesai', 'belum_dibayar', 8, 0),
(12, 8, 'INV004', 5, '2025-09-18 00:00:00', '2025-09-18 13:22:00', '2025-09-21 00:00:00', 3990, 3, 29, 'proses', 'belum_dibayar', 8, 0),
(15, 9, 'INV006', 5, '2025-09-19 00:00:00', '2025-09-22 10:53:00', '2025-09-22 00:00:00', 6000, 5, 32, 'selesai', 'belum_dibayar', 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `id_outlet` int NOT NULL,
  `role` enum('admin','kasir','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `nama`, `username`, `password`, `id_outlet`, `role`) VALUES
(7, 'Faiq', 'owner', '$2y$10$.Cu50MsberGf2HePyu/C5uSZ3LzLefUpnZRkTZlD7GsLqtsYEVhsO', 2, 'owner'),
(8, 'Angga', 'Kasir', '$2y$10$1rHcGP2awz704ImuyJ1C5ehPkx./1uKV3QXivgpob6OkHV07WkMvK', 2, 'kasir'),
(9, 'Alip', 'Admin', '$2y$10$NZL8Yi537zS1O3HsrbItvuhCm9SKKVzWsC71x/XUP1SbJgxAT5jE6', 2, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas_users`
--
ALTER TABLE `aktivitas_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas_users`
--
ALTER TABLE `aktivitas_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas_users`
--
ALTER TABLE `aktivitas_users`
  ADD CONSTRAINT `aktivitas_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD CONSTRAINT `tb_detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_transaksi_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `tb_paket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD CONSTRAINT `tb_paket_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `tb_member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_ibfk_3` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `tb_users_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

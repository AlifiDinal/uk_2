-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 19, 2025 at 04:20 AM
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
-- Database: `projek_uk2`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `id_detail_pinjam` int NOT NULL,
  `id_inventaris` int NOT NULL,
  `id_peminjaman` int NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`id_detail_pinjam`, `id_inventaris`, `id_peminjaman`, `jumlah`) VALUES
(1, 8, 9, 1),
(2, 9, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id_inventaris` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kondisi` varchar(100) DEFAULT NULL,
  `keterangan` text,
  `jumlah` int NOT NULL,
  `tanggal_register` date NOT NULL,
  `id_jenis` int NOT NULL,
  `id_ruang` int NOT NULL,
  `kode_inventaris` varchar(50) NOT NULL,
  `id_petugas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id_inventaris`, `nama`, `kondisi`, `keterangan`, `jumlah`, `tanggal_register`, `id_jenis`, `id_ruang`, `kode_inventaris`, `id_petugas`) VALUES
(8, 'Alip', 'Baik', 'saya telah mengembalikaan barangnya dengan baik/tidak ada kerusakan sama sekali', 1, '2025-10-22', 1, 1, 'INV-0001', 2),
(9, 'Angga', 'Rusak Ringan', 'Maaf saya tidak sengaja menjatuhkannya', 2, '2025-10-23', 6, 2, 'INV-0002', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int NOT NULL,
  `nama_jenis` varchar(100) NOT NULL,
  `kode_jenis` varchar(50) NOT NULL,
  `keterangan` text,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `kode_jenis`, `keterangan`, `image`) VALUES
(1, 'Buku Kamus', 'JNS001', 'Buku kamus bahasa inggris cocok untuk anda yang ingin belajar bahasa inggris', 'JENIS_68f744e5ec4120.46339877.jpg'),
(2, 'Topi', 'JNS002', 'Topi Sekolah SMP Buat upacara, Cowok/Cewek', 'JENIS_68f745763b90e6.25900063.jpg'),
(3, 'Dasi', 'JNS003', 'Dasi Sekolah SMP buat Cowok/Cewek', 'JENIS_68f74507611ee7.49146049.jpg'),
(4, 'Pulpen', 'JNS004', 'Pulpen Untuk menulis/mengerjakan tugas sekolah\r\n', '1761189547.jpg'),
(5, 'Pensil', 'JNS005', 'pensil AB untuk menulis atau mnggambar sebuah gambar, \r\nDapat juga untuk mengerjakan Tugas', '1761189593.jpg'),
(6, 'Pensil Warna', 'JNS006', 'Pensil warna untuk mewarnai gambar yang sudah kamu buat', '1761189644.jpg'),
(7, 'Buku Cerita', 'JNS007', 'Buku Cerita, buku ini cocok untuk anak kecil yang baru belajar membaca/yang suka membaca', '1761189843.jpg'),
(8, 'Novel', 'JNS008', 'Novel ini cocok untuk remaja yang suka membaca, cocok juga untuk yang baru suka membaca', '1761189897.jpg'),
(9, 'Buku Resep Masakan', 'JNS009', 'Buku ini adalah buku resep masakan cocok untuk ibu\"Atau anak muda yang ingin belajar masak', '1761189976.jpg'),
(10, 'Perlengkapan Pramuka', 'JNS010', 'perlengkapan pramuka berupa Dasi,Topi,dll, untuk cewek/cowok', '1761190310.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int NOT NULL,
  `nama_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(3, 'operator'),
(5, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nip`, `alamat`) VALUES
(14, 'alip', 'PGW001', 'keweden Trirenggo Bantul'),
(15, 'angga', 'PGW002', 'Manding Bantul');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status_peminjaman` enum('Dipinjam','Dikembalikan') DEFAULT 'Dipinjam',
  `id_pegawai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `status_peminjaman`, `id_pegawai`) VALUES
(9, '2025-10-22', '2025-10-24', 'Dipinjam', 14),
(10, '2025-10-23', '2025-10-25', 'Dipinjam', 15),
(11, '2025-11-04', '2025-11-06', 'Dipinjam', 14);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `id_level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `id_level`) VALUES
(2, 'angga', '$2y$10$KXMIxPyl1UU1DxP.qA5vruysNRdoZYijNjg26iO9OFYe3gjhqOiQS', 'angga', 3),
(4, 'alip', '$2y$10$ujEWMKwVAJM6wT6gWDnnlOCd1zU5Wf4YZiYfPkhjXI0RETuRc1kq6', 'Alifi', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int NOT NULL,
  `nama_ruang` varchar(100) NOT NULL,
  `kode_ruang` varchar(50) NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `nama_ruang`, `kode_ruang`, `keterangan`) VALUES
(1, 'Ruangan 1', 'RGN001', 'Tetap jaga kebersian dan jangan berisik ok\r\n\r\n'),
(2, 'Ruangan 2', 'RGN002', 'Ruangan 2 ini lebih menyediakaan buku komik atau cerita'),
(3, 'Ruangan 3', 'RGN003', 'Ruangan ini ada di lantai 2 maka jaga etika dan jangan berisik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD PRIMARY KEY (`id_detail_pinjam`),
  ADD KEY `id_inventaris` (`id_inventaris`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_inventaris`),
  ADD UNIQUE KEY `kode_inventaris` (`kode_inventaris`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_ruang` (`id_ruang`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`),
  ADD UNIQUE KEY `kode_jenis` (`kode_jenis`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`),
  ADD UNIQUE KEY `kode_ruang` (`kode_ruang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  MODIFY `id_detail_pinjam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id_inventaris` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD CONSTRAINT `detail_pinjam_ibfk_1` FOREIGN KEY (`id_inventaris`) REFERENCES `inventaris` (`id_inventaris`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pinjam_ibfk_2` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `inventaris_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventaris_ibfk_2` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventaris_ibfk_3` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

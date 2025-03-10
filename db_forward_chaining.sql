-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 05:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_forward_chaining`
--

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `kode_gejala` varchar(10) NOT NULL,
  `nama_gejala` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`kode_gejala`, `nama_gejala`) VALUES
('G001', 'Peradangan Kronis Yang Terjadi Pada Usus Besar (kolon) Dan Rektum.'),
('G002', 'Saat Diraba Pada Pinggiran Tumor Terasa Keras.'),
('G003', 'Adanya Kerak Atau Keropeng Pada Tepi Merah Bibir.');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_gejala` varchar(10) NOT NULL,
  `konsultasi_ke` int(11) NOT NULL,
  `jawaban` enum('Ya','Tidak') DEFAULT NULL,
  `tanggal_konsultasi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `id_user`, `kode_gejala`, `konsultasi_ke`, `jawaban`, `tanggal_konsultasi`) VALUES
(1, 3, 'G001', 1, 'Ya', '2024-11-13 00:27:30'),
(2, 3, 'G002', 1, 'Tidak', '2024-11-13 00:27:30'),
(3, 3, 'G003', 1, 'Tidak', '2024-11-13 00:27:30'),
(4, 3, 'G001', 2, 'Ya', '2024-11-21 15:57:17'),
(5, 3, 'G002', 2, 'Tidak', '2024-11-21 15:57:17'),
(6, 3, 'G003', 2, 'Tidak', '2024-11-21 15:57:17'),
(7, 5, 'G001', 1, 'Tidak', '2024-11-21 15:57:53'),
(8, 5, 'G002', 1, 'Tidak', '2024-11-21 15:57:53'),
(9, 5, 'G003', 1, 'Ya', '2024-11-21 15:57:53'),
(10, 3, 'G001', 3, 'Ya', '2024-11-24 22:07:41'),
(11, 3, 'G002', 3, 'Tidak', '2024-11-24 22:07:41'),
(12, 3, 'G003', 3, 'Ya', '2024-11-24 22:07:41'),
(13, 3, 'G001', 4, 'Tidak', '2024-11-24 22:35:29'),
(14, 3, 'G002', 4, 'Tidak', '2024-11-24 22:35:29'),
(15, 3, 'G003', 4, 'Tidak', '2024-11-24 22:35:29'),
(16, 3, 'G001', 5, 'Ya', '2024-11-24 22:42:47'),
(17, 3, 'G002', 5, 'Tidak', '2024-11-24 22:42:47'),
(18, 3, 'G003', 5, 'Tidak', '2024-11-24 22:42:47'),
(19, 3, 'G001', 6, 'Tidak', '2024-11-24 23:02:29'),
(20, 3, 'G002', 6, 'Ya', '2024-11-24 23:02:29'),
(21, 3, 'G003', 6, 'Tidak', '2024-11-24 23:02:29'),
(22, 3, 'G001', 7, 'Ya', '2024-11-24 23:45:01'),
(23, 3, 'G002', 7, 'Tidak', '2024-11-24 23:45:01'),
(24, 3, 'G003', 7, 'Tidak', '2024-11-24 23:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `kode_penyakit` varchar(10) NOT NULL,
  `nama_penyakit` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`kode_penyakit`, `nama_penyakit`, `keterangan`) VALUES
('P001', 'Karsinoma Pada bibir (tepi Merah Bibir).', 'Kebiasaan merokok dan menghisap pipa.\r\nTerlihat terutama diantara pekerja yang bekerja di udara terbuka.'),
('P002', 'Karsinoma Pada Pinggir Lidah.', 'Lebih banyak menyerang laki-laki.\r\nBisa disebabkan karena gigi tiruan.'),
('P003', 'Karsinoma Pada Dasar Mulut', 'Menyerang orang pada usia pertengahan dan usia lanjut dengan pervalensi tertinggi pada dekade ketujuh');

-- --------------------------------------------------------

--
-- Table structure for table `relasi`
--

CREATE TABLE `relasi` (
  `id_relasi` int(11) NOT NULL,
  `kode_penyakit` varchar(10) NOT NULL,
  `kode_gejala` varchar(10) NOT NULL,
  `keterangan_relasi` enum('Ya','Tidak') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `relasi`
--

INSERT INTO `relasi` (`id_relasi`, `kode_penyakit`, `kode_gejala`, `keterangan_relasi`) VALUES
(1, 'P001', 'G001', 'Ya'),
(2, 'P001', 'G002', 'Tidak'),
(3, 'P001', 'G003', 'Tidak'),
(4, 'P002', 'G001', 'Tidak'),
(5, 'P002', 'G002', 'Ya'),
(6, 'P002', 'G003', 'Tidak'),
(7, 'P003', 'G001', 'Tidak'),
(8, 'P003', 'G002', 'Tidak'),
(9, 'P003', 'G003', 'Ya');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Pakar'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `nama_lengkap`, `username`, `password`) VALUES
(1, 1, 'Admin Ganteng', 'admin', '$2y$10$qph9SAysBFZxzRoi8/0PTeH5yvPzDHxFUJrTn2uX9j.AwhNzttnpa'),
(2, 2, 'Pakar Gantengg', 'pakar', '$2y$10$VOzmBhbDHsl/zL7Vn7Vy7.xePCK6zKvRfZERveWNQfmNo6/9mOvFy'),
(3, 3, 'User Cihuyyyyyy', 'user', '$2y$10$7MIOQRnu9FK0VK9mUIg7Qu/a4nv1.Zz2hVtvO8anSyvJlCiHwSksO'),
(5, 3, 'user1', 'user1', '$2y$10$NqNeE8adRuYv7vOyIWqEe.nvgWLhx.G4rFNb/mjUS2eR7iEiiR9K.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`kode_gejala`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `fk_gejalaa` (`kode_gejala`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`kode_penyakit`);

--
-- Indexes for table `relasi`
--
ALTER TABLE `relasi`
  ADD PRIMARY KEY (`id_relasi`),
  ADD KEY `fk_penyakit` (`kode_penyakit`),
  ADD KEY `fk_gejala` (`kode_gejala`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `relasi`
--
ALTER TABLE `relasi`
  MODIFY `id_relasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `fk_gejalaa` FOREIGN KEY (`kode_gejala`) REFERENCES `gejala` (`kode_gejala`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `relasi`
--
ALTER TABLE `relasi`
  ADD CONSTRAINT `fk_gejala` FOREIGN KEY (`kode_gejala`) REFERENCES `gejala` (`kode_gejala`),
  ADD CONSTRAINT `fk_penyakit` FOREIGN KEY (`kode_penyakit`) REFERENCES `penyakit` (`kode_penyakit`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2023 at 02:17 AM
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
-- Database: `db_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_akun`
--

CREATE TABLE `data_akun` (
  `id_akun` int NOT NULL,
  `nama_akun` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username_akun` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password_akun` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `level_akun` enum('admin','dokter') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_akun`
--

INSERT INTO `data_akun` (`id_akun`, `nama_akun`, `username_akun`, `password_akun`, `level_akun`) VALUES
(1, 'admin', 'admin', 'admin', 'admin'),
(2, 'dokfer', 'dokter', 'dokter', 'dokter');

-- --------------------------------------------------------

--
-- Table structure for table `data_antrian`
--

CREATE TABLE `data_antrian` (
  `id_antrian` bigint NOT NULL,
  `id_pasien` int NOT NULL,
  `tanggal_antrian` date NOT NULL,
  `no_antrian` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_antrian`
--

INSERT INTO `data_antrian` (`id_antrian`, `id_pasien`, `tanggal_antrian`, `no_antrian`) VALUES
(9, 17, '2023-11-07', 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_pasien`
--

CREATE TABLE `data_pasien` (
  `id_pasien` int NOT NULL,
  `nama_pasien` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat_pasien` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgllahir_pasien` date NOT NULL,
  `jenkel_pasien` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `notlpn_pasien` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email_pasien` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username_pasien` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password_pasien` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status_pasien` enum('antri','pemeriksaan','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_pasien`
--

INSERT INTO `data_pasien` (`id_pasien`, `nama_pasien`, `alamat_pasien`, `tgllahir_pasien`, `jenkel_pasien`, `notlpn_pasien`, `email_pasien`, `username_pasien`, `password_pasien`, `status_pasien`) VALUES
(16, 'farhan ramadhan', 'PERMATA SUDIANG RAYA BLOK H4/17', '2023-11-07', 'Laki-Laki', '123', 'admin@gmail.com', 'farhan', 'farhan', 'selesai'),
(17, 'ada', 'ada', '2023-11-07', 'Laki-Laki', '123', 'admin@gmail.com', 'ada', 'ada', 'pemeriksaan');

-- --------------------------------------------------------

--
-- Table structure for table `data_pemeriksaan`
--

CREATE TABLE `data_pemeriksaan` (
  `id_pemeriksaan` int NOT NULL,
  `id_pasien` int NOT NULL,
  `id_akun` int NOT NULL,
  `namapenyakit_pemeriksaan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keluhan_pemeriksaan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bagiansakit_pemeriksaan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fotorontgen_pemeriksaan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `keterangan_pemeriksaan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_pemeriksaan`
--

INSERT INTO `data_pemeriksaan` (`id_pemeriksaan`, `id_pasien`, `id_akun`, `namapenyakit_pemeriksaan`, `keluhan_pemeriksaan`, `bagiansakit_pemeriksaan`, `fotorontgen_pemeriksaan`, `keterangan_pemeriksaan`) VALUES
(7, 17, 2, 'adaada', 'adada', 'adad', '923-Screenshot 2023-05-31 114327.png', 'adaadad'),
(8, 16, 2, 'adaada', 'adada', 'adad', '651-Screenshot 2023-06-07 163317.png', 'adaadad');

-- --------------------------------------------------------

--
-- Table structure for table `data_resepobat`
--

CREATE TABLE `data_resepobat` (
  `id_resep` int NOT NULL,
  `id_pemeriksaan` int NOT NULL,
  `id_pasien` int NOT NULL,
  `id_akun` int NOT NULL,
  `tgl_resep` date NOT NULL,
  `namaobat_resep` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenisobat_resep` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `aturanpemakaian_resep` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_resepobat`
--

INSERT INTO `data_resepobat` (`id_resep`, `id_pemeriksaan`, `id_pasien`, `id_akun`, `tgl_resep`, `namaobat_resep`, `jenisobat_resep`, `aturanpemakaian_resep`) VALUES
(3, 8, 16, 2, '2023-11-07', 'dawdnak', 'andwklnal', 'wadmakl');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_akun`
--
ALTER TABLE `data_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `data_antrian`
--
ALTER TABLE `data_antrian`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `data_pasien`
--
ALTER TABLE `data_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `data_pemeriksaan`
--
ALTER TABLE `data_pemeriksaan`
  ADD PRIMARY KEY (`id_pemeriksaan`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `data_resepobat`
--
ALTER TABLE `data_resepobat`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`),
  ADD KEY `id_pasien` (`id_pasien`,`id_akun`),
  ADD KEY `id_akun` (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_akun`
--
ALTER TABLE `data_akun`
  MODIFY `id_akun` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `data_antrian`
--
ALTER TABLE `data_antrian`
  MODIFY `id_antrian` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_pasien`
--
ALTER TABLE `data_pasien`
  MODIFY `id_pasien` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `data_pemeriksaan`
--
ALTER TABLE `data_pemeriksaan`
  MODIFY `id_pemeriksaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_resepobat`
--
ALTER TABLE `data_resepobat`
  MODIFY `id_resep` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_antrian`
--
ALTER TABLE `data_antrian`
  ADD CONSTRAINT `data_antrian_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `data_pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pemeriksaan`
--
ALTER TABLE `data_pemeriksaan`
  ADD CONSTRAINT `data_pemeriksaan_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `data_pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_pemeriksaan_ibfk_2` FOREIGN KEY (`id_akun`) REFERENCES `data_akun` (`id_akun`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `data_resepobat`
--
ALTER TABLE `data_resepobat`
  ADD CONSTRAINT `data_resepobat_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `data_akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_resepobat_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `data_pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_resepobat_ibfk_3` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `data_pemeriksaan` (`id_pemeriksaan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

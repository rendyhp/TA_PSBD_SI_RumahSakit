-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 04:21 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_kel40_si_rumahsakit`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` int(3) NOT NULL,
  `nama_dokter` varchar(50) DEFAULT NULL,
  `spesialis` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama_dokter`, `spesialis`, `alamat`, `no_telp`, `deleted_at`) VALUES
(1, 'dr Akbar', 'Paru', 'Salatiga', '0851xxxxxxxx', NULL),
(2, 'dr Elda Devita Harsa, Sp.P', 'Paru', 'Agroindustri Pisang Kipas Di Kelurahan Sialang Sakti Kecamatan Tenayan Raya Kota Pekanbaru', '081245451313', NULL),
(3, 'drg. Mega Moeharyono Puteri, Ph.D.,Sp.KGA(K)-AIBK', 'Gigi', 'Jl. Airlangga No.4 - 6, Airlangga, Kec. Gubeng, Surabaya, Jawa Timur 60115', '082113055109', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` int(50) NOT NULL,
  `nama_obat` varchar(40) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `keterangan`, `deleted_at`) VALUES
(1, 'Ultraflu', 'Obat Flu', NULL),
(2, 'Oskadon', 'Obat Sakit Kepala', NULL),
(3, 'Paracetamol', 'Obat Panas', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` int(50) NOT NULL,
  `nomor_identitas` varchar(30) DEFAULT NULL,
  `nama_pasien` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `nomor_identitas`, `nama_pasien`, `jenis_kelamin`, `alamat`, `no_telp`, `deleted_at`) VALUES
(1, '21120121130011', 'Agus Pambagya', 'L', 'Tembalang', '0812xxxxxxxxx', NULL),
(2, '21120121130071', 'Rendy Hartono Putra', 'P', 'Ds. Cokroyasan RT 01/ RW 02, Kec. Ngombol, Kab. Purworejo, Jawa Tengah', '081226077106', NULL),
(3, '21120121130042', 'Salsabilla', 'P', 'Jalan Merpati Sakti C4, Pekanbaru', '081222430712', NULL),
(4, '21120121140150', 'Hilmy Nurakmal Satria', 'L', 'Jl. Gedongsongo Tengah 15/01 No.21, Manyaran, Semarang Barat', '081225939540', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_poliklinik`
--

CREATE TABLE `tb_poliklinik` (
  `id_poli` int(10) NOT NULL,
  `nama_poli` varchar(50) DEFAULT NULL,
  `gedung` varchar(50) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_poliklinik`
--

INSERT INTO `tb_poliklinik` (`id_poli`, `nama_poli`, `gedung`, `deleted_at`) VALUES
(1, 'Poli A', 'J.Lt I', NULL),
(2, 'Poli B', 'J.Lt II', NULL),
(3, 'Poli C', 'J.Lt III', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekammedis`
--

CREATE TABLE `tb_rekammedis` (
  `id_rm` int(50) NOT NULL,
  `id_pasien` int(50) DEFAULT NULL,
  `keluhan` text DEFAULT NULL,
  `id_dokter` int(3) DEFAULT NULL,
  `diagnosa` text DEFAULT NULL,
  `id_poli` int(10) DEFAULT NULL,
  `tgl_periksa` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_rekammedis`
--

INSERT INTO `tb_rekammedis` (`id_rm`, `id_pasien`, `keluhan`, `id_dokter`, `diagnosa`, `id_poli`, `tgl_periksa`, `deleted_at`) VALUES
(1, 3, 'Ngantuk', 1, 'Kurang Tidur', 2, '2023-12-07', NULL),
(2, 1, 'Susah Tidur', 3, 'Insomnia', 1, '2023-12-01', NULL),
(3, 2, 'Kecapekan', 2, 'Demam', 1, '2023-12-07', NULL),
(4, 4, 'Mata mudah lelah', 2, 'Kurang tidur', 2, '2023-12-07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rm_obat`
--

CREATE TABLE `tb_rm_obat` (
  `id_rm_obat` int(8) NOT NULL,
  `id_rm` int(50) DEFAULT NULL,
  `id_obat` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_rm_obat`
--

INSERT INTO `tb_rm_obat` (`id_rm_obat`, `id_rm`, `id_obat`) VALUES
(7, 1, 3),
(8, 2, 3),
(9, 2, 2),
(12, 3, 1),
(19, 4, 1),
(20, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(3) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`) VALUES
(2, 'Rendy Hartono Putra', 'rexe45hp', '16d7a4fca7442dda3ad93c9a726597e4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `tb_poliklinik`
--
ALTER TABLE `tb_poliklinik`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `tb_rekammedis`
--
ALTER TABLE `tb_rekammedis`
  ADD PRIMARY KEY (`id_rm`),
  ADD KEY `FK_tb_poliklinik` (`id_poli`),
  ADD KEY `FK_tb_pasien` (`id_pasien`),
  ADD KEY `FK_tb_dokter` (`id_dokter`);

--
-- Indexes for table `tb_rm_obat`
--
ALTER TABLE `tb_rm_obat`
  ADD PRIMARY KEY (`id_rm_obat`),
  ADD KEY `FK_tb_obat` (`id_obat`),
  ADD KEY `FK_tb_rekammedis` (`id_rm`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rm_obat`
--
ALTER TABLE `tb_rm_obat`
  MODIFY `id_rm_obat` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rekammedis`
--
ALTER TABLE `tb_rekammedis`
  ADD CONSTRAINT `FK_tb_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `tb_dokter` (`id_dokter`),
  ADD CONSTRAINT `FK_tb_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`),
  ADD CONSTRAINT `FK_tb_poliklinik` FOREIGN KEY (`id_poli`) REFERENCES `tb_poliklinik` (`id_poli`);

--
-- Constraints for table `tb_rm_obat`
--
ALTER TABLE `tb_rm_obat`
  ADD CONSTRAINT `FK_tb_obat` FOREIGN KEY (`id_obat`) REFERENCES `tb_obat` (`id_obat`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_tb_rekammedis` FOREIGN KEY (`id_rm`) REFERENCES `tb_rekammedis` (`id_rm`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2020 at 11:15 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_tomat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_akses`
--

CREATE TABLE `tb_akses` (
  `id_akses` int(11) NOT NULL,
  `akses` enum('admin','pengguna') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_akses`
--

INSERT INTO `tb_akses` (`id_akses`, `akses`) VALUES
(1, 'admin'),
(2, 'pengguna');

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `kd_alternatif` varchar(6) NOT NULL,
  `kd_pengguna` varchar(6) NOT NULL,
  `nm_alternatif` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`kd_alternatif`, `kd_pengguna`, `nm_alternatif`) VALUES
('A1', 'P02', 'Tomat Servo'),
('A2', 'P02', 'Tomat ceri'),
('A3', 'P02', 'Tomat Hijau'),
('A4', 'P02', 'Tomat Buruk');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `kd_kriteria` varchar(6) NOT NULL,
  `kd_pengguna` varchar(6) NOT NULL,
  `nm_kriteria` varchar(50) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kd_kriteria`, `kd_pengguna`, `nm_kriteria`, `jenis`, `bobot`) VALUES
('C09', 'P02', 'Ketahanan Penyakit', 'Benefit', 20),
('C10', 'P02', 'Hasil Panen', 'Benefit', 40),
('C11', 'P02', 'Berat', 'Benefit', 20),
('C12', 'P02', 'Harga/5Gram', 'Benefit', 10),
('C13', 'P02', '	Lokasi', 'Cost', 15),
('C14', 'P01', 'A6', 'Benefit', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pencocokan_kriteria`
--

CREATE TABLE `tb_pencocokan_kriteria` (
  `kd_pengguna` varchar(6) NOT NULL,
  `kd_kriteria` varchar(6) NOT NULL,
  `kd_alternatif` varchar(6) NOT NULL,
  `nilai_pencocokan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `kd_pengguna` varchar(6) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`kd_pengguna`, `nama`, `email`, `id_akses`, `password`) VALUES
('P01', 'mariam', 'mariam@gmail.com', 1, '006d2143154327a64d86a264aea225f3'),
('P02', 'nendi', 'nendi@gmail.com', 1, '006d2143154327a64d86a264aea225f3'),
('P03', 'kuyhaa', 'kuyha@gmail.com', 2, 'f970e2767d0cfe75876ea857f92e319b'),
('P04', 'agus', 'agus@gmail.com', 1, 'f970e2767d0cfe75876ea857f92e319b');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `kd_produk` varchar(6) NOT NULL,
  `kd_kriteria` varchar(6) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id_penilaian`, `kd_produk`, `kd_kriteria`, `nilai`) VALUES
(1, 'R01', 'C01', 20),
(2, 'R01', 'C02', 30),
(3, 'R01', 'C01 ', 20),
(4, 'R01', 'C02 ', 30),
(5, 'R01', 'C03 ', 22),
(6, 'R01', 'C04 ', 22),
(7, 'R01', 'C05 ', 22),
(8, 'R01', 'C01 ', 20),
(9, 'R01', 'C02 ', 30),
(10, 'R01', 'C03 ', 22),
(11, 'R01', 'C04 ', 22),
(12, 'R01', 'C05 ', 22),
(13, 'R01', 'C01 ', 1),
(14, 'R01', 'C02 ', 2),
(15, 'R01', 'C03 ', 3),
(16, 'R01', 'C04 ', 4),
(17, 'R01', 'C05 ', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_kriteria`
--

CREATE TABLE `tb_sub_kriteria` (
  `id` int(11) NOT NULL,
  `kd_pengguna` varchar(6) NOT NULL,
  `kd_kriteria` varchar(6) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akses`
--
ALTER TABLE `tb_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`kd_kriteria`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`kd_pengguna`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akses`
--
ALTER TABLE `tb_akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

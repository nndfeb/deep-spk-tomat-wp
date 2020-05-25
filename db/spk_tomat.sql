-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2020 pada 04.41
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

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
-- Struktur dari tabel `tb_akses`
--

CREATE TABLE `tb_akses` (
  `id_akses` int(11) NOT NULL,
  `akses` enum('admin','pengguna') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_akses`
--

INSERT INTO `tb_akses` (`id_akses`, `akses`) VALUES
(1, 'admin'),
(2, 'pengguna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `kd_alternatif` varchar(6) NOT NULL,
  `kd_pengguna` varchar(6) NOT NULL,
  `nm_alternatif` varchar(100) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`kd_alternatif`, `kd_pengguna`, `nm_alternatif`, `waktu`) VALUES
('A1', 'P02', 'Tomat Servo', '0000-00-00 00:00:00'),
('A2', 'P02', 'Tomat ceri', '0000-00-00 00:00:00'),
('A3', 'P02', 'Tomat Hijau', '0000-00-00 00:00:00'),
('A4', 'P02', 'Tomat Buruk', '0000-00-00 00:00:00'),
('A5', 'P02', 'Tomat Cabe', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `kd_kriteria` varchar(6) NOT NULL,
  `kd_pengguna` varchar(6) NOT NULL,
  `nm_kriteria` varchar(50) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `bobot` float NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kd_kriteria`, `kd_pengguna`, `nm_kriteria`, `jenis`, `bobot`, `waktu`) VALUES
('C1', 'P2', 'Anjing Petani', 'Benefit', 10, '2020-04-28 06:40:16'),
('C2', 'P2', 'Anjig 2 Petani', 'Cost', 10, '2020-04-28 06:40:27'),
('C1', 'P1', 'Monyet Admin 3', 'Cost', 10, '2020-04-28 06:44:43'),
('C2', 'P1', 'Bagong', 'Benefit', 20, '2020-04-28 06:45:08'),
('C1', 'P3', 'Tomat Merah', 'Benefit', 10, '2020-04-28 07:50:56'),
('C2', 'P3', 'Tomat Hijau', 'Benefit', 20, '2020-04-28 07:51:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pencocokan_kriteria`
--

CREATE TABLE `tb_pencocokan_kriteria` (
  `kd_pengguna` varchar(6) NOT NULL,
  `kd_kriteria` varchar(6) NOT NULL,
  `kd_alternatif` varchar(6) NOT NULL,
  `id_nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `kd_pengguna` varchar(6) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`kd_pengguna`, `nama`, `email`, `id_akses`, `password`) VALUES
('P1', 'admin', 'admin@gmail.com', 1, 'f970e2767d0cfe75876ea857f92e319b'),
('P2', 'petani', 'petani@gmail.com', 2, 'd41d8cd98f00b204e9800998ecf8427e'),
('P3', 'dami', 'dami@gmail.com', 2, 'f970e2767d0cfe75876ea857f92e319b');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `kd_alternatif` varchar(6) NOT NULL,
  `kd_kriteria` varchar(6) NOT NULL,
  `kd_pengguna` varchar(6) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id_penilaian`, `kd_alternatif`, `kd_kriteria`, `kd_pengguna`, `nilai`) VALUES
(74, 'A1', 'C1', 'P02', 2),
(75, 'A1', 'C2', 'P02', 2),
(76, 'A1', 'C3', 'P02', 2),
(77, 'A1', 'C4', 'P02', 2),
(78, 'A1', 'C5', 'P02', 5),
(79, 'A2', 'C1', 'P02', 4),
(80, 'A2', 'C2', 'P02', 4),
(81, 'A2', 'C3', 'P02', 4),
(82, 'A2', 'C4', 'P02', 4),
(83, 'A2', 'C5', 'P02', 4),
(84, 'A3', 'C1', 'P02', 3),
(85, 'A3', 'C2', 'P02', 3),
(86, 'A3', 'C3', 'P02', 3),
(87, 'A3', 'C4', 'P02', 3),
(88, 'A3', 'C5', 'P02', 3),
(89, 'A4', 'C1', 'P02', 2),
(90, 'A4', 'C2', 'P02', 2),
(91, 'A4', 'C3', 'P02', 2),
(92, 'A4', 'C4', 'P02', 2),
(93, 'A4', 'C5', 'P02', 2),
(94, 'A5', 'C1', 'P02', 2),
(95, 'A5', 'C2', 'P02', 3),
(96, 'A5', 'C3', 'P02', 3),
(97, 'A5', 'C4', 'P02', 1),
(98, 'A5', 'C5', 'P02', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sub_kriteria`
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
-- Indeks untuk tabel `tb_akses`
--
ALTER TABLE `tb_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`kd_pengguna`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indeks untuk tabel `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_akses`
--
ALTER TABLE `tb_akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT untuk tabel `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

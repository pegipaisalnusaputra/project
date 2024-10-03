-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Okt 2024 pada 20.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nasabah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dataafterapprove`
--

CREATE TABLE `tb_dataafterapprove` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `tanggal_input` date DEFAULT NULL,
  `total_kredit` double DEFAULT NULL,
  `biaya_admin` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_dataafterapprove`
--

INSERT INTO `tb_dataafterapprove` (`id`, `user_id`, `nama`, `alamat`, `nohp`, `tanggal_input`, `total_kredit`, `biaya_admin`) VALUES
(1, 1, 'ujil', 'cidahu', '088877778888', '2024-10-03', 20000000, 4000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_databeforeapprove`
--

CREATE TABLE `tb_databeforeapprove` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `tanggal_input` date DEFAULT NULL,
  `total_kredit` double DEFAULT NULL,
  `biaya_admin` double DEFAULT NULL,
  `status` enum('pending','approved') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_databeforeapprove`
--

INSERT INTO `tb_databeforeapprove` (`id`, `user_id`, `nama`, `alamat`, `nohp`, `tanggal_input`, `total_kredit`, `biaya_admin`, `status`) VALUES
(2, 1, 'DUMMY', 'cicurug', '085768756478', '2024-10-03', 10000000, 2000000, 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'egi', 'Sukabumi1', NULL, 'user'),
(2, 'admin', 'admin123', NULL, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_dataafterapprove`
--
ALTER TABLE `tb_dataafterapprove`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_databeforeapprove`
--
ALTER TABLE `tb_databeforeapprove`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_dataafterapprove`
--
ALTER TABLE `tb_dataafterapprove`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_databeforeapprove`
--
ALTER TABLE `tb_databeforeapprove`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_dataafterapprove`
--
ALTER TABLE `tb_dataafterapprove`
  ADD CONSTRAINT `tb_dataafterapprove_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`);

--
-- Ketidakleluasaan untuk tabel `tb_databeforeapprove`
--
ALTER TABLE `tb_databeforeapprove`
  ADD CONSTRAINT `tb_databeforeapprove_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Des 2022 pada 05.25
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduanapp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lab`
--

CREATE TABLE `lab` (
  `id` int(11) NOT NULL,
  `nama_lab` varchar(70) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lab`
--

INSERT INTO `lab` (`id`, `nama_lab`, `id_user`, `created_at`) VALUES
(7, 'lab 1', 8, '2022-11-14 21:15:56'),
(8, 'Lab 2', 9, '2022-11-16 11:10:11'),
(9, 'Lab 2s', 13, '2022-12-03 16:52:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `id_prop` int(11) NOT NULL,
  `id_teknisi` int(11) NOT NULL,
  `nama_pelapor` varchar(100) NOT NULL,
  `npm` int(11) NOT NULL,
  `masalah` text NOT NULL,
  `foto_bukti` varchar(100) NOT NULL DEFAULT 'no.png',
  `status` enum('diproses','selesai') NOT NULL DEFAULT 'diproses',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `id_prop`, `id_teknisi`, `nama_pelapor`, `npm`, `masalah`, `foto_bukti`, `status`, `created_at`) VALUES
(3, 1, 11, 'andri', 120140191, 'koneksi mati', 'Diagram Tanpa Judul.jpg', 'selesai', '2022-11-18 14:05:02'),
(4, 3, 11, 'andri2', 120140192, 'layar mati', 'no.png', 'diproses', '2022-11-16 14:05:37'),
(5, 12, 14, 'Andri', 120140191, 'bluescreen', 'no.png', 'selesai', '2022-12-03 16:54:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `properti`
--

CREATE TABLE `properti` (
  `id` int(11) NOT NULL,
  `nama_prop` varchar(10) NOT NULL,
  `status` enum('aman','problem') NOT NULL DEFAULT 'aman',
  `xPos` int(11) NOT NULL,
  `yPos` int(11) NOT NULL,
  `id_lab` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `properti`
--

INSERT INTO `properti` (`id`, `nama_prop`, `status`, `xPos`, `yPos`, `id_lab`, `created_at`) VALUES
(1, 'tes1', 'aman', 492, 197, 7, '2022-11-15 09:22:59'),
(3, 'pc1-lab-ko', 'problem', 703, 194, 7, '2022-11-15 09:26:48'),
(4, 'b-ca', 'aman', 397, 375, 7, '2022-11-15 16:45:57'),
(7, 'tes-ting', 'aman', 594, 373, 7, '2022-11-16 10:53:23'),
(8, 'tes-lab-2', 'aman', 333, 199, 8, '2022-11-16 11:10:59'),
(9, 'hello-s', 'aman', 777, 370, 7, '2022-12-03 10:53:04'),
(10, 'b', 'aman', 278, 202, 7, '2022-12-03 11:11:10'),
(11, 'pc-1', 'aman', 419, 171, 9, '2022-12-03 16:53:05'),
(12, 'pc-2', 'aman', 597, 167, 9, '2022-12-03 16:53:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ttd_laporan`
--

CREATE TABLE `ttd_laporan` (
  `id` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `file_rt` varchar(100) NOT NULL,
  `id_lab` int(11) NOT NULL,
  `file_kaleb` varchar(100) NOT NULL,
  `status` enum('dikirim','dibalas') NOT NULL DEFAULT 'dikirim',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ttd_laporan`
--

INSERT INTO `ttd_laporan` (`id`, `pesan`, `file_rt`, `id_lab`, `file_kaleb`, `status`, `created_at`) VALUES
(1, 'tes pesan', '45-Article Text-124-1-10-20210602.pdf', 7, '', 'dikirim', '2022-12-07 10:38:21'),
(2, 'tolong ditandatangani', 'PROPOSAL KWU 8.pdf', 9, 'Rentalin.pdf', 'dibalas', '2022-12-07 10:46:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(70) NOT NULL DEFAULT '$2y$10$wJ6NtPz/Wgq3OI3INu0flecs/Yvz3tJfI3RDNFIgd2Y4zV80zUrlO',
  `role` enum('rt','kalab','teknisi') NOT NULL,
  `id_lab` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `id_lab`, `created_at`) VALUES
(1, 'rt 1', 'tesrt@gmail.com', '$2y$10$OZK9RQ.g9vr0s0sgTaAUHOYBpdnhSOBPi/0b4.iK.jcENErIZHUQ2', 'rt', 0, '2022-11-13 00:00:00'),
(8, 'tes kalab 1', 'kalab1@gmail.com', '$2y$10$r/ODow950H/ax.8ZncL/NulKnUZvox.3BsSDrdACCFnmk6/0XVWMK', 'kalab', 7, '2022-11-14 20:44:46'),
(9, 'tes kalab 2', 'kalab2@gmail.com', '$2y$10$wJ6NtPz/Wgq3OI3INu0flecs/Yvz3tJfI3RDNFIgd2Y4zV80zUrlO', 'kalab', 8, '2022-11-14 20:46:12'),
(11, 'teknisi 1', 'teknisi1@gmail.com', '$2y$10$BZuu1mnSoK2RlrXVIPy87.osWxaBOe0S8JAdvDMcWtgCsmOMtldPW', 'teknisi', 7, '2022-11-14 21:45:29'),
(13, 'ketua lab 2', 'kaleb2s@gmail.com', '$2y$10$wJ6NtPz/Wgq3OI3INu0flecs/Yvz3tJfI3RDNFIgd2Y4zV80zUrlO', 'kalab', 9, '2022-12-03 16:50:00'),
(14, 'teknisi lab 2s', 'teklab2s@gmail.com', '$2y$10$wJ6NtPz/Wgq3OI3INu0flecs/Yvz3tJfI3RDNFIgd2Y4zV80zUrlO', 'teknisi', 9, '2022-12-03 16:54:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `properti`
--
ALTER TABLE `properti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `ttd_laporan`
--
ALTER TABLE `ttd_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lab`
--
ALTER TABLE `lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `properti`
--
ALTER TABLE `properti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `ttd_laporan`
--
ALTER TABLE `ttd_laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

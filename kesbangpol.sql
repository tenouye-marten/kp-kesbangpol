-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jan 2025 pada 07.32
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
-- Database: `kesbangpol`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id`, `kategori`) VALUES
(2, 'musik'),
(4, 'Kerja bakti'),
(5, 'ggh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ormas`
--

CREATE TABLE `tbl_ormas` (
  `id` int(11) NOT NULL,
  `nm_organisasi` varchar(125) NOT NULL,
  `nm_ketua` varchar(125) NOT NULL,
  `nm_sekretaris` varchar(125) NOT NULL,
  `nm_bendahara` varchar(125) NOT NULL,
  `alamat` longtext NOT NULL,
  `keterangan` varchar(125) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_ormas`
--

INSERT INTO `tbl_ormas` (`id`, `nm_organisasi`, `nm_ketua`, `nm_sekretaris`, `nm_bendahara`, `alamat`, `keterangan`, `id_kategori`) VALUES
(9, 'santai hilinhBKHK', 'bayu nknk', 'agus tinoo', 'siti no', 'Jl. Padang Bulan', 'Tidak Aktif', 5),
(10, 'santai hilinhBKHK', 'bayu nknk', 'agus tinoo', 'siti noo', 'swakarsa arso', 'Tidak Aktif', 2),
(11, 'lingkungan keerom', 'Yanpit', 'Surya', 'sari', 'arso 2', 'Aktif', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_parpol`
--

CREATE TABLE `tbl_parpol` (
  `id` int(11) NOT NULL,
  `nm_parpol` varchar(125) NOT NULL,
  `nm_ketua` varchar(125) NOT NULL,
  `nm_sekretaris` varchar(125) NOT NULL,
  `nm_bendahara` varchar(125) NOT NULL,
  `alamat` longtext NOT NULL,
  `periode_kepengurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_parpol`
--

INSERT INTO `tbl_parpol` (`id`, `nm_parpol`, `nm_ketua`, `nm_sekretaris`, `nm_bendahara`, `alamat`, `periode_kepengurusan`) VALUES
(2, 'tesis', 'bayu asi', 'agus  siti', 'siti noo', 'Perumnas 4', '2025-3027'),
(3, 'tesis', 'bayu asi', 'agus  siti', 'siti noo', 'Perumnas 4', '2025-3027'),
(7, 'tesis oke', 'bayu agri', 'agus', 'siti ', 'swakarsa arso', '2022-3027'),
(8, 'tesis oke KKKK', 'bayu agri', 'LNLL;JN;LL;M', ';LNL;N;LN\'L\'N;LN', 'XZXZXZ', 'BKBBHJBHB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(125) NOT NULL,
  `email` varchar(125) NOT NULL,
  `password` varchar(125) NOT NULL,
  `alamat` varchar(125) NOT NULL,
  `jenis_kelamin` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama`, `email`, `password`, `alamat`, `jenis_kelamin`) VALUES
(2, 'Kalvin Huby', 'kaalvin@gmail.com', '$2y$10$2k/BbUDPQOKviyEgYye5SesGt/64fplE.o2qv9b70xN65.rMX/TfO', 'Buper', 'Laki-Laki'),
(5, 'omri', 'omri@gmail.com', '$2y$10$gMb0bI6xYOWuv.2WlBKve.cS2nUBYW1Dwy4Fg/mepLCoxG3OZupQO', 'swakarsa arso', 'Laki-Laki');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_ormas`
--
ALTER TABLE `tbl_ormas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `tbl_parpol`
--
ALTER TABLE `tbl_parpol`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_ormas`
--
ALTER TABLE `tbl_ormas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_parpol`
--
ALTER TABLE `tbl_parpol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_ormas`
--
ALTER TABLE `tbl_ormas`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Bulan Mei 2022 pada 09.09
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minimarket`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `is_active` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `username`, `password`, `role`, `is_active`) VALUES
(1, 'admin', 'admin', 'admin', '1'),
(2, 'kasir1', 'kasir1', 'kasir', '1'),
(5, 'kasir2', 'kasir2', 'kasir', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_brg` int(11) NOT NULL,
  `kode_brg` varchar(50) DEFAULT NULL,
  `nama_brg` varchar(150) DEFAULT NULL,
  `harga_satuan` varchar(50) DEFAULT NULL,
  `harga_grosir` varchar(50) DEFAULT NULL,
  `modal` varchar(50) NOT NULL,
  `stok` varchar(10) DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_brg`, `kode_brg`, `nama_brg`, `harga_satuan`, `harga_grosir`, `modal`, `stok`, `foto`) VALUES
(1, '8999999528942', 'Hanbody Lotions Citra Pearly White UV Pink', '12000', '10000', '8000', '10', 'citra.jpg'),
(2, '8991002122017', 'ABC Kopi Susu botol 200ml', '3000', '2800', '2500', '11', 'abc_kopi_susu.jpg'),
(4, '8998866610131', 'Handsanitizer Nuvo Anti Bacterial 50 ml  ', '5000', '4500', '4300', '16', 'handsenitizer.png'),
(5, '8998866202732', 'Milku rasa strawberry', '3500', '3000', '2500', '50', NULL),
(6, '8996001600146', 'teh pucuk harum', '3000', '2900', '2500', '100', 'Banyuwangi.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `beban_keuangan`
--

CREATE TABLE `beban_keuangan` (
  `kode_keuangan` varchar(100) NOT NULL,
  `tgl_input` date DEFAULT NULL,
  `nominal_keuangan` varchar(100) DEFAULT NULL,
  `id_kebutuhan` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `beban_keuangan`
--

INSERT INTO `beban_keuangan` (`kode_keuangan`, `tgl_input`, `nominal_keuangan`, `id_kebutuhan`, `keterangan`) VALUES
('KK0001', '0000-00-00', '300000', 1, 'kebutuhan listrik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id` int(11) NOT NULL,
  `nm_bulan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bulan`
--

INSERT INTO `bulan` (`id`, `nm_bulan`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `kode_pj` varchar(50) DEFAULT NULL,
  `kode_brg` varchar(50) DEFAULT NULL,
  `qty` varchar(5) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `subtotal` varchar(50) DEFAULT NULL,
  `potongan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `kode_pj`, `kode_brg`, `qty`, `harga`, `subtotal`, `potongan`) VALUES
(1, 'PJ20220512-00001', '8991002122017', '2', '3000', '6000', '0'),
(2, 'PJ20220512-00001', '8999999528942', '2', '12000', '24000', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kebutuhan`
--

CREATE TABLE `kebutuhan` (
  `id` int(11) NOT NULL,
  `kebutuhan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kebutuhan`
--

INSERT INTO `kebutuhan` (`id`, `kebutuhan`) VALUES
(1, 'listrik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_stok`
--

CREATE TABLE `laporan_stok` (
  `id` int(11) NOT NULL,
  `bulan` varchar(20) DEFAULT NULL,
  `tahun` varchar(20) DEFAULT NULL,
  `id_kasir` int(11) DEFAULT NULL,
  `kode_brg` varchar(50) DEFAULT NULL,
  `stok_brg` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembukuan`
--

CREATE TABLE `pembukuan` (
  `kode_transaksi` varchar(100) NOT NULL,
  `kategori` varchar(15) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nominal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembukuan`
--

INSERT INTO `pembukuan` (`kode_transaksi`, `kategori`, `tanggal`, `nominal`) VALUES
('PJ20220512-00001', 'penjualan', '2022-05-12', '30000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendapatan_harian`
--

CREATE TABLE `pendapatan_harian` (
  `id` int(11) NOT NULL,
  `hari` varchar(15) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_auth` int(11) DEFAULT NULL,
  `pendapatan` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendapatan_harian`
--

INSERT INTO `pendapatan_harian` (`id`, `hari`, `tanggal`, `id_auth`, `pendapatan`, `keterangan`) VALUES
(1, 'senin', '0000-00-00', 2, '500000', 'hari ini');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint(20) NOT NULL,
  `kode_pj` varchar(100) DEFAULT NULL,
  `tgl_pj` date DEFAULT NULL,
  `kasir` varchar(30) DEFAULT NULL,
  `total_qty` varchar(15) DEFAULT NULL,
  `total_pj` varchar(50) DEFAULT NULL,
  `total_byr` varchar(50) DEFAULT NULL,
  `total_potongan` varchar(50) DEFAULT NULL,
  `kembalian` varchar(50) DEFAULT NULL,
  `ket` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `kode_pj`, `tgl_pj`, `kasir`, `total_qty`, `total_pj`, `total_byr`, `total_potongan`, `kembalian`, `ket`) VALUES
(1, 'PJ20220512-00001', '2022-05-12', 'kasir1', '4', '30000', '50000', '0', '20.000', 'transaksi grosir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indeks untuk tabel `beban_keuangan`
--
ALTER TABLE `beban_keuangan`
  ADD PRIMARY KEY (`kode_keuangan`);

--
-- Indeks untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kebutuhan`
--
ALTER TABLE `kebutuhan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_stok`
--
ALTER TABLE `laporan_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembukuan`
--
ALTER TABLE `pembukuan`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- Indeks untuk tabel `pendapatan_harian`
--
ALTER TABLE `pendapatan_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kebutuhan`
--
ALTER TABLE `kebutuhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `laporan_stok`
--
ALTER TABLE `laporan_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pendapatan_harian`
--
ALTER TABLE `pendapatan_harian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

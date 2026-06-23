-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jun 2026 pada 20.54
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
-- Database: `ci4-nurantik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `arus_kas`
--

CREATE TABLE `arus_kas` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tipe` enum('Masuk','Keluar') NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `arus_kas`
--

INSERT INTO `arus_kas` (`id`, `tanggal`, `keterangan`, `tipe`, `nominal`, `created_at`, `updated_at`) VALUES
(1, '2026-06-20', 'Pinjaman Modal Awal', 'Masuk', 32000000, '2026-06-23 15:19:10', '2026-06-23 22:33:29'),
(2, '2026-06-23', 'Pembelian Stok: Tumbler 350ml SUPPA (40 Pcs)', 'Keluar', 6000000, '2026-06-23 15:19:43', '2026-06-23 15:19:43'),
(3, '2026-06-23', 'Pembelian Stok: Tumbler 500ml Kawaii (25 Pcs)', 'Keluar', 4375000, '2026-06-23 15:21:10', '2026-06-23 15:21:10'),
(4, '2026-06-23', 'Pembelian Stok: Tumbler 485ml Chako (28 Pcs)', 'Keluar', 3220000, '2026-06-23 15:23:17', '2026-06-23 15:23:17'),
(5, '2026-06-23', 'Pembelian Stok: Tumbler 700ml Day (23 Pcs)', 'Keluar', 3864000, '2026-06-23 15:24:58', '2026-06-23 15:24:58'),
(6, '2026-06-23', 'Pembelian Stok: Tumbler 532ml Sakura (18 Pcs)', 'Keluar', 2808000, '2026-06-23 15:25:56', '2026-06-23 15:25:56'),
(7, '2026-06-23', 'Pembelian Stok: Tumbler 532ml Love (12 Pcs)', 'Keluar', 2004000, '2026-06-23 15:26:57', '2026-06-23 15:26:57'),
(8, '2026-06-23', 'Pembelian Stok: Tumbler 600ml Hai (34 Pcs)', 'Keluar', 3366000, '2026-06-23 15:28:15', '2026-06-23 15:28:15'),
(9, '2026-06-23', 'Pembelian Stok: Tumbler 455ml Busy (22 Pcs)', 'Keluar', 1716000, '2026-06-23 15:29:06', '2026-06-23 15:29:06'),
(10, '2026-06-23', 'Pembelian Stok: Tumbler 745ml Berry (15 Pcs)', 'Keluar', 1725000, '2026-06-23 15:30:46', '2026-06-23 15:30:46'),
(11, '2026-06-23', 'Pembelian Stok: Tumbler 550ml Star (14 Pcs)', 'Keluar', 2688000, '2026-06-23 15:31:47', '2026-06-23 15:31:47'),
(12, '2026-06-23', 'Biaya Listrik', 'Keluar', 250000, '2026-06-23 16:54:54', '2026-06-23 16:54:54'),
(13, '2026-06-23', 'Biaya Gaji Karyawan', 'Keluar', 2100000, '2026-06-23 17:15:12', '2026-06-23 17:15:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-06-13-163250', 'App\\Database\\Migrations\\User', 'default', 'App', 1781368611, 1),
(2, '2026-06-13-163323', 'App\\Database\\Migrations\\Product', 'default', 'App', 1781368611, 1),
(3, '2026-06-13-163345', 'App\\Database\\Migrations\\Transaction', 'default', 'App', 1781368611, 1),
(4, '2026-06-13-163353', 'App\\Database\\Migrations\\TransactionDetail', 'default', 'App', 1781368611, 1),
(5, '2026-06-13-164600', 'App\\Database\\Migrations\\AddDeletedAtToTables', 'default', 'App', 1781369222, 2),
(6, '2026-06-22-040546', 'App\\Database\\Migrations\\AddFieldBuktiPembayaranKeTransaction', 'default', 'App', 1782101624, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL DEFAULT 0,
  `harga` double NOT NULL,
  `jumlah` int(5) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `nama`, `harga_beli`, `harga`, `jumlah`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tumbler 350ml SUPPA', 150000, 260000, 40, '1782227983_2af40351ef8bdf7094b0.jpg', '2026-06-23 15:19:43', '2026-06-23 15:19:43', NULL),
(2, 'Tumbler 500ml Kawaii', 175000, 290000, 25, '1782228070_ae5258239460dd2ac9e5.jpg', '2026-06-23 15:21:10', '2026-06-23 15:21:10', NULL),
(3, 'Tumbler 485ml Chako', 115000, 200000, 28, '1782228197_c0b32931d1ae90f3ef88.jpg', '2026-06-23 15:23:17', '2026-06-23 15:23:17', NULL),
(4, 'Tumbler 700ml Day', 168000, 275000, 23, '1782228298_e0c2edf8bed72c6324b2.jpg', '2026-06-23 15:24:58', '2026-06-23 15:24:58', NULL),
(5, 'Tumbler 532ml Sakura', 156000, 241000, 18, '1782228356_6e627933a5285b768ec0.jpg', '2026-06-23 15:25:56', '2026-06-23 15:25:56', NULL),
(6, 'Tumbler 532ml Love', 167000, 273000, 12, '1782228417_2c939c7823a240601d00.jpg', '2026-06-23 15:26:57', '2026-06-23 15:26:57', NULL),
(7, 'Tumbler 600ml Hai', 99000, 179000, 34, '1782228495_ef58df4392fc4e026883.jpg', '2026-06-23 15:28:15', '2026-06-23 15:28:15', NULL),
(8, 'Tumbler 455ml Busy', 78000, 150000, 22, '1782228546_211e89d3a307b6bde52c.jpg', '2026-06-23 15:29:06', '2026-06-23 15:29:06', NULL),
(9, 'Tumbler 745ml Berry', 115000, 186000, 15, '1782228645_89298444e6cee733bedb.jpg', '2026-06-23 15:30:45', '2026-06-23 15:30:45', NULL),
(10, 'Tumbler 550ml Star', 192000, 289000, 14, '1782228707_0620aab40df5e2beec79.jpg', '2026-06-23 15:31:47', '2026-06-23 15:31:47', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `total_harga` double NOT NULL,
  `sudah_dibayar` int(11) NOT NULL DEFAULT 0,
  `alamat` text NOT NULL,
  `ongkir` double DEFAULT NULL,
  `status` int(1) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id`, `username`, `total_harga`, `sudah_dibayar`, `alamat`, `ongkir`, `status`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 'donibaik', 1773000, 1773000, 'Perum Jembangan ', 18000, 3, '1782229357_ecd8325ae4faf47819cf.png', '2026-06-23 15:36:15', '2026-06-23 15:42:37'),
(2, 'kikibaik', 1430000, 1430000, 'Kenteng RT 2/5', 90000, 3, '1782232829_81cabf872c9cd5d68102.jpeg', '2026-06-23 16:26:46', '2026-06-23 16:40:29'),
(3, 'puspabaik', 3881000, 2750000, 'Pringapus RT 4/1', 20000, 2, '1782234134_a9787bb3bb1a8d9def1e.png', '2026-06-23 16:57:35', '2026-06-23 17:02:14'),
(4, 'gevabaik', 1944000, 1944000, 'Perum TPA K.20', 25000, 1, '1782234706_c70b068161a2aa393f4f.png', '2026-06-23 17:09:01', '2026-06-23 17:11:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `transaction_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `jumlah` int(5) NOT NULL,
  `diskon` double DEFAULT NULL,
  `subtotal_harga` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `transaction_id`, `product_id`, `jumlah`, `diskon`, `subtotal_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 0, 580000, '2026-06-23 15:36:15', '2026-06-23 15:36:15'),
(2, 1, 6, 1, 0, 273000, '2026-06-23 15:36:15', '2026-06-23 15:36:15'),
(3, 1, 7, 4, 0, 716000, '2026-06-23 15:36:15', '2026-06-23 15:36:15'),
(4, 1, 9, 1, 0, 186000, '2026-06-23 15:36:15', '2026-06-23 15:36:15'),
(5, 2, 8, 3, 0, 450000, '2026-06-23 16:26:46', '2026-06-23 16:26:46'),
(6, 2, 2, 1, 0, 290000, '2026-06-23 16:26:46', '2026-06-23 16:26:46'),
(7, 2, 3, 3, 0, 600000, '2026-06-23 16:26:46', '2026-06-23 16:26:46'),
(8, 3, 4, 5, 0, 1375000, '2026-06-23 16:57:35', '2026-06-23 16:57:35'),
(9, 3, 6, 1, 0, 273000, '2026-06-23 16:57:35', '2026-06-23 16:57:35'),
(10, 3, 2, 4, 0, 1160000, '2026-06-23 16:57:35', '2026-06-23 16:57:35'),
(11, 3, 9, 1, 0, 186000, '2026-06-23 16:57:35', '2026-06-23 16:57:35'),
(12, 3, 10, 3, 0, 867000, '2026-06-23 16:57:35', '2026-06-23 16:57:35'),
(13, 4, 2, 6, 0, 1740000, '2026-06-23 17:09:01', '2026-06-23 17:09:01'),
(14, 4, 7, 1, 0, 179000, '2026-06-23 17:09:01', '2026-06-23 17:09:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'antikbaik', 'antikbelajar@gmail.com', '$2y$10$RQaKfAOydukp7yjcWZE.9.W8Y4hl0SLSXBEzmzWtbacJ0X4fh/fE6', 'admin', '2026-06-23 14:48:38', NULL),
(2, 'donibaik', 'doonnynusa@gmail.com', '$2y$10$9cA8YXb/lKWUusiudpu7nONtGuPBdCXWgHU3QaiX0FomzfuAjO.0y', 'guest', '2026-06-23 14:49:00', NULL),
(3, 'gevabaik', 'gevaarilla@gmail.com', '$2y$10$65A9vsTpEanXiviWlYxsmerKtSDbOfmf2SY1ZYEhZVJF248hB6egW', 'guest', '2026-06-23 14:49:24', NULL),
(4, 'puspabaik', 'puspaayu@gmail.com', '$2y$10$JF12C12Yp8gj95l8PSH47uUsxdkPSlaJ.CTSirvoAdSOqM5hS7Dqi', 'guest', '2026-06-23 14:49:42', NULL),
(5, 'sintabaik', 'sintamarsela@gmail.com', '$2y$10$iQljtW8od6XxpPI2U2Uek.QlXaxmepZVqXOK5zwPYolusyLhogsGG', 'guest', '2026-06-23 14:50:09', NULL),
(6, 'salmabaik', 'aaliyahsalma@gmail.com', '$2y$10$Vf9LTheeFrEx05eAqy/tO.qi3wacybSeh0E.QEIjCEocPZr2Phib2', 'guest', '2026-06-23 14:50:28', NULL),
(7, 'kikibaik', 'kikiadisti@gmail.com', '$2y$10$mttLla6JW2T1EDIaTRMBCOmTv6hTlL6ED4G4aM/JTH0y8ltueq1mK', 'guest', '2026-06-23 14:50:47', NULL),
(8, 'nehabaik', 'nehanur@gmail.com', '$2y$10$g5xyWxvNNqgGCtC.STzEzOt23h8HBJbgLttZeVbo84NpeYw1xYB3.', 'guest', '2026-06-23 14:51:04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `arus_kas`
--
ALTER TABLE `arus_kas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `arus_kas`
--
ALTER TABLE `arus_kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

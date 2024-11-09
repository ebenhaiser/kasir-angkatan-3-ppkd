-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 09:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `angkatan3_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(9) NOT NULL,
  `id_kategori` int(9) NOT NULL,
  `nama_barang` varchar(60) NOT NULL,
  `satuan` varchar(60) NOT NULL,
  `qty` int(9) NOT NULL,
  `harga` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `id_kategori`, `nama_barang`, `satuan`, `qty`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 'Anggur Merah Orang Tua', 'Bottle', 72, 55000, '2024-11-05 20:52:52', '2024-11-05 20:52:52'),
(2, 2, 'Marlboro Filter Black', 'Pack', 138, 40000, '2024-11-05 20:52:52', '2024-11-05 20:52:52'),
(3, 1, 'Anggur Kolesom Orang Tua', 'Bottle', 170, 75000, '2024-11-05 20:54:14', '2024-11-05 20:54:14'),
(4, 2, 'Gudang Garam International', 'Pack', 104, 26000, '2024-11-05 20:54:14', '2024-11-05 20:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(9) NOT NULL,
  `id_penjualan` int(9) DEFAULT NULL,
  `id_barang` int(9) DEFAULT NULL,
  `jumlah` int(9) DEFAULT NULL,
  `qty` int(9) DEFAULT NULL,
  `harga` double(10,2) DEFAULT NULL,
  `total_harga` double(10,2) DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `nominal_bayar` double(10,2) DEFAULT NULL,
  `kembalian` double(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `id_penjualan`, `id_barang`, `jumlah`, `qty`, `harga`, `total_harga`, `sub_total`, `nominal_bayar`, `kembalian`, `created_at`) VALUES
(1, 2, 1, 1, 30, 2000.00, 5000.00, NULL, 50000.00, 45000.00, '2024-11-07 07:46:30'),
(2, 2, 2, 1, 20, 3000.00, 5000.00, NULL, 50000.00, 45000.00, '2024-11-07 07:46:30'),
(3, 3, 1, 1, 29, 2000.00, 2000.00, NULL, 5000.00, 3000.00, '2024-11-07 07:48:20'),
(4, 4, 2, 10, 19, 3000.00, 30000.00, NULL, 50000.00, 20000.00, '2024-11-08 01:02:33'),
(5, 5, 1, 1, 25, 55000.00, 95000.00, NULL, 100000.00, 5000.00, '2024-11-08 01:48:47'),
(6, 5, 2, 1, 30, 40000.00, 95000.00, NULL, 100000.00, 5000.00, '2024-11-08 01:48:47'),
(7, 6, 1, 2, 24, 55000.00, 150000.00, NULL, 200000.00, 50000.00, '2024-11-08 01:50:00'),
(8, 6, 2, 1, 29, 40000.00, 150000.00, NULL, 200000.00, 50000.00, '2024-11-08 01:50:00'),
(9, 7, 1, 3, 22, 55000.00, 365000.00, NULL, 500000.00, 135000.00, '2024-11-08 01:52:31'),
(10, 7, 2, 5, 28, 40000.00, 365000.00, NULL, 500000.00, 135000.00, '2024-11-08 01:52:31'),
(11, 8, 1, 3, 19, 55000.00, 245000.00, NULL, 250000.00, 5000.00, '2024-11-08 01:54:11'),
(12, 8, 2, 2, 23, 40000.00, 245000.00, NULL, 250000.00, 5000.00, '2024-11-08 01:54:11'),
(13, 9, 1, 2, 16, 55000.00, 519000.00, NULL, 600000.00, 81000.00, '2024-11-08 07:12:01'),
(14, 9, 3, 3, 30, 75000.00, 519000.00, NULL, 600000.00, 81000.00, '2024-11-08 07:12:01'),
(15, 9, 2, 2, 21, 40000.00, 519000.00, NULL, 600000.00, 81000.00, '2024-11-08 07:12:01'),
(16, 9, 4, 4, 20, 26000.00, 519000.00, NULL, 600000.00, 81000.00, '2024-11-08 07:12:01'),
(17, 10, 1, 6, NULL, 55000.00, 1.00, 330000, 1350000.00, 41000.00, '2024-11-08 07:44:00'),
(18, 10, 3, 9, NULL, 75000.00, 3.00, 675000, 1350000.00, 41000.00, '2024-11-08 07:44:00'),
(19, 10, 2, 5, NULL, 40000.00, 0.00, 200000, 1350000.00, 41000.00, '2024-11-08 07:44:00'),
(20, 10, 4, 4, NULL, 26000.00, 9.00, 104000, 1350000.00, 41000.00, '2024-11-08 07:44:00'),
(21, 11, 1, 7, NULL, 55000.00, 1476000.00, 385000, 1500000.00, 24000.00, '2024-11-08 07:48:25'),
(22, 11, 3, 9, NULL, 75000.00, 1476000.00, 675000, 1500000.00, 24000.00, '2024-11-08 07:48:25'),
(23, 11, 4, 7, NULL, 26000.00, 1476000.00, 182000, 1500000.00, 24000.00, '2024-11-08 07:48:25'),
(24, 11, 4, 9, NULL, 26000.00, 1476000.00, 234000, 1500000.00, 24000.00, '2024-11-08 07:48:25'),
(25, 12, 3, 1, NULL, 75000.00, 115000.00, 75000, 200000.00, 85000.00, '2024-11-08 08:01:47'),
(26, 12, 2, 1, NULL, 40000.00, 115000.00, 40000, 200000.00, 85000.00, '2024-11-08 08:01:47'),
(27, 13, 1, 1, NULL, 55000.00, 95000.00, 55000, 100000.00, 5000.00, '2024-11-08 08:02:55'),
(28, 13, 2, 1, NULL, 40000.00, 95000.00, 40000, 100000.00, 5000.00, '2024-11-08 08:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id` int(9) NOT NULL,
  `nama_kategori` varchar(55) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Minuman Energi', '2024-11-06 03:39:10', '2024-11-06 03:39:10'),
(2, 'Vitamin', '2024-11-06 03:39:10', '2024-11-06 03:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(9) NOT NULL,
  `id_user` int(9) DEFAULT NULL,
  `kode_transaksi` varchar(60) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_user`, `kode_transaksi`, `tanggal_transaksi`, `created_at`) VALUES
(2, 1, 'TR-241107144613', '2024-11-07', '2024-11-07 07:46:30'),
(3, 1, 'TR-241107144801', '2024-11-07', '2024-11-07 07:48:20'),
(4, 1, 'TR-241108080145', '2024-11-08', '2024-11-08 01:02:33'),
(5, 3, 'TR-241108084747', '2024-11-08', '2024-11-08 01:48:47'),
(6, 3, 'TR-241108084938', '2024-11-08', '2024-11-08 01:50:00'),
(7, 3, 'TR-241108085203', '2024-11-08', '2024-11-08 01:52:31'),
(8, 3, 'TR-241108085324', '2024-11-08', '2024-11-08 01:54:11'),
(9, 3, 'TR-241108141125', '2024-11-08', '2024-11-08 07:12:01'),
(10, 3, 'TR-241108144231', '2024-11-08', '2024-11-08 07:44:00'),
(11, 3, 'TR-241108144749', '2024-11-08', '2024-11-08 07:48:25'),
(12, 3, 'TR-241108150123', '2024-11-08', '2024-11-08 08:01:47'),
(13, 3, 'TR-241108150226', '2024-11-08', '2024-11-08 08:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `nama_pengguna`, `email`, `password`, `foto`, `cover`, `created_at`, `updated_at`) VALUES
(1, 'Reza Ibrahim', 'rezaibrahim08', 'admin@gmail.com', '12345678', '0018120113_10.jpg', '', '2024-10-31 08:10:47', '2024-11-04 04:27:13'),
(2, 'ggwp', 'ggwp', 'ggwp@gmail.com', '12345678', '', '', '2024-11-05 05:53:03', '2024-11-05 05:53:03'),
(3, 'Kakek Sugiono', 'KakekSugiono', 'sugiono@gmail.com', '12345678', '', '', '2024-11-08 01:34:39', '2024-11-08 01:34:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_to_kategori_id` (`id_kategori`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penjualan_to_penjualan_id` (`id_penjualan`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `id_kategori_to_kategori_id` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `id_penjualan_to_penjualan_id` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

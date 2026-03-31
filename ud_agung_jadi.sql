-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 05:16 AM
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
-- Database: `ud_agung_jadi`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_pegawai`
--

CREATE TABLE `akun_pegawai` (
  `ID_PEGAWAI` varchar(50) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Tanggal_Masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_pegawai`
--

INSERT INTO `akun_pegawai` (`ID_PEGAWAI`, `Nama`, `Password`, `Tanggal_Masuk`) VALUES
('', 'ilham', '', '2025-06-03'),
('23', 'QWEREW', '', '2025-06-03'),
('25', 'QWEREW', '', '2025-06-07'),
('29', 'ilham', '', '2025-06-17'),
('98', 'ilham', '', '2025-06-03'),
('Alias omnis quibusda', 'Iste laboris cupiditdsa', '', '2025-06-02'),
('Atque iure cupidatat', 'eca', '321', '2025-06-02'),
('Facere in nisi eos e', '', '', '2025-06-02'),
('PG01', 'Andi', '', '2025-06-17'),
('PG02', 'Budi', '', '2025-06-17'),
('PG03', 'Citra', '', '2025-06-17'),
('PG04', 'Dewi', '', '2025-06-17'),
('PG05', 'Eka', '', '2025-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id_audit` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `keterangan` varchar(30) DEFAULT NULL,
  `id_pegawai` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID_CUSTOMER` varchar(100) NOT NULL,
  `Nama_Customer` varchar(100) DEFAULT NULL,
  `Alamat` varchar(30) NOT NULL,
  `No_Hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID_CUSTOMER`, `Nama_Customer`, `Alamat`, `No_Hp`) VALUES
('CUS01', 'Rahmat', 'Jl. Semangka', '08123456789'),
('CUS02', 'Sari', 'Jl. Pisang', '08234567891'),
('CUS03', 'Yanto', 'Jl. Rambutan', '08345678912'),
('CUS04', 'Maya', 'Jl. Durian', '08456789123'),
('CUS05', 'Nina', 'Jl. Mangga', '08567891234');

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `after_customer_insert` AFTER INSERT ON `customer` FOR EACH ROW BEGIN
    INSERT INTO customer_log (id_customer, nama_customer, no_hp, created_at)
    VALUES (NEW.ID_CUSTOMER, NEW.Nama_Customer, NEW.No_Hp, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_log`
--

CREATE TABLE `customer_log` (
  `log_id` int(11) NOT NULL,
  `id_customer` varchar(100) DEFAULT NULL,
  `nama_customer` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_log`
--

INSERT INTO `customer_log` (`log_id`, `id_customer`, `nama_customer`, `no_hp`, `created_at`) VALUES
(0, 'CUS01', 'Rahmat', '08123456789', '2025-06-17 10:10:42'),
(0, 'CUS02', 'Sari', '08234567891', '2025-06-17 10:10:42'),
(0, 'CUS03', 'Yanto', '08345678912', '2025-06-17 10:10:42'),
(0, 'CUS04', 'Maya', '08456789123', '2025-06-17 10:10:42'),
(0, 'CUS05', 'Nina', '08567891234', '2025-06-17 10:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `detail_nota`
--

CREATE TABLE `detail_nota` (
  `NO_PESANAN` varchar(20) DEFAULT NULL,
  `NO_ITEM` varchar(100) DEFAULT NULL,
  `Banyak_Item` int(11) DEFAULT NULL,
  `Jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_nota`
--

INSERT INTO `detail_nota` (`NO_PESANAN`, `NO_ITEM`, `Banyak_Item`, `Jumlah`) VALUES
('N001', 'IT01', 2, 100000),
('N002', 'IT02', 4, 120000),
('N003', 'IT03', 6, 150000),
('N004', 'IT04', 4, 80000),
('N005', 'IT05', 1, 95000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `NO_TRANSAKSI` varchar(100) DEFAULT NULL,
  `NO_ITEM` varchar(100) DEFAULT NULL,
  `Jumlah` int(11) DEFAULT NULL,
  `Total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`NO_TRANSAKSI`, `NO_ITEM`, `Jumlah`, `Total`) VALUES
('T001', 'IT01', 2, 100000),
('T002', 'IT02', 3, 90000),
('T003', 'IT03', 4, 100000),
('T004', 'IT04', 5, 75000),
('T005', 'IT05', 1, 70000);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `NO_ITEM` varchar(100) NOT NULL,
  `Nama_Barang` varchar(100) DEFAULT NULL,
  `Satuan` varchar(50) DEFAULT NULL,
  `Harga_Satuan` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`NO_ITEM`, `Nama_Barang`, `Satuan`, `Harga_Satuan`) VALUES
('IT01', 'Kertas A4', 'Rim', 50000.00),
('IT02', 'Pulpen', 'Box', 30000.00),
('IT03', 'Pensil', 'Box', 25000.00),
('IT04', 'Map Plastik', 'Lusin', 15000.00),
('IT05', 'Buku Tulis', 'Kodi', 70000.00);

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `NO_PESANAN` varchar(20) NOT NULL,
  `ID_PEGAWAI` varchar(100) DEFAULT NULL,
  `ID_CUSTOMER` varchar(100) DEFAULT NULL,
  `Tanggal_Transaksi` date DEFAULT NULL,
  `Total` int(11) DEFAULT NULL,
  `Uang_Muka` int(11) DEFAULT NULL,
  `Sisa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`NO_PESANAN`, `ID_PEGAWAI`, `ID_CUSTOMER`, `Tanggal_Transaksi`, `Total`, `Uang_Muka`, `Sisa`) VALUES
('N001', 'PG01', 'CUS01', '2025-06-01', 100000, 50000, 50000),
('N002', 'PG02', 'CUS02', '2025-06-02', 120000, 60000, 60000),
('N003', 'PG03', 'CUS03', '2025-06-03', 150000, 100000, 50000),
('N004', 'PG04', 'CUS04', '2025-06-04', 80000, 30000, 50000),
('N005', 'PG05', 'CUS05', '2025-06-05', 70000, 95000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_PEGAWAI` varchar(100) NOT NULL,
  `Nama_Pegawai` varchar(100) DEFAULT NULL,
  `Jabatan` varchar(50) DEFAULT NULL,
  `No_Hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`ID_PEGAWAI`, `Nama_Pegawai`, `Jabatan`, `No_Hp`) VALUES
('PG01', 'Andi', 'Kasir', '0811111111'),
('PG02', 'Budi', 'Admin', '0822222222'),
('PG03', 'Citra', 'Gudang', '0833333333'),
('PG04', 'Dewi', 'Sales', '0844444444'),
('PG05', 'Eka', 'Manager', '0855555555');

--
-- Triggers `pegawai`
--
DELIMITER $$
CREATE TRIGGER `after_insert_pegawai` AFTER INSERT ON `pegawai` FOR EACH ROW BEGIN
  INSERT INTO akun_pegawai (ID_PEGAWAI,Nama, Tanggal_Masuk)
  VALUES (NEW.ID_PEGAWAI,NEW.Nama_Pegawai,CURDATE());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `ID_PT` varchar(10) NOT NULL,
  `Nama_PT` varchar(100) DEFAULT NULL,
  `Alamat_PT` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`ID_PT`, `Nama_PT`, `Alamat_PT`) VALUES
('PT01', 'PT Agung Makmur', 'Jl. Anggrek No.10'),
('PT02', 'CV Maju Jaya', 'Jl. Merdeka No.20'),
('PT03', 'UD Sejahtera', 'Jl. Cemara No.30'),
('PT04', 'Toko Sentosa', 'Jl. Melati No.40'),
('PT05', 'PT Karya Abadi', 'Jl. Mawar No.50');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `NO_TRANSAKSI` varchar(20) NOT NULL,
  `ID_SUPPLIER` varchar(10) DEFAULT NULL,
  `ID_PT` varchar(10) DEFAULT NULL,
  `No_Kwitansi_Transaksi` varchar(30) NOT NULL,
  `Tanggal` date DEFAULT NULL,
  `Total_Pembelian` int(11) DEFAULT NULL,
  `PPN` int(11) DEFAULT NULL,
  `Total_Tagihan` int(11) DEFAULT NULL,
  `Status_Pembayaran` enum('sudah','belum') DEFAULT NULL,
  `Metode_Pembayaran` enum('cash','qris') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`NO_TRANSAKSI`, `ID_SUPPLIER`, `ID_PT`, `No_Kwitansi_Transaksi`, `Tanggal`, `Total_Pembelian`, `PPN`, `Total_Tagihan`, `Status_Pembayaran`, `Metode_Pembayaran`) VALUES
('T001', 'SUP01', 'PT01', 'KW001', '2025-06-01', 100000, 10000, 110000, 'sudah', 'cash'),
('T002', 'SUP02', 'PT02', 'KW002', '2025-06-02', 90000, 20000, 220000, 'belum', 'qris'),
('T003', 'SUP03', 'PT03', 'KW003', '2025-06-03', 150000, 15000, 165000, 'sudah', 'cash'),
('T004', 'SUP04', 'PT04', 'KW004', '2025-06-04', 180000, 18000, 198000, 'belum', 'qris'),
('T005', 'SUP05', 'PT05', 'KW005', '2025-06-05', 250000, 25000, 275000, 'sudah', 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `ID_SUPPLIER` varchar(10) NOT NULL,
  `Nama_Supplier` varchar(100) DEFAULT NULL,
  `Alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`ID_SUPPLIER`, `Nama_Supplier`, `Alamat`) VALUES
('SUP01', 'PT Sumber Rejeki', 'Jl. Suka Maju'),
('SUP02', 'CV Berkah Abadi', 'Jl. Mawar No.1'),
('SUP03', 'UD Makmur Jaya', 'Jl. Melati No.2'),
('SUP04', 'Toko Tiga Saudara', 'Jl. Kenanga No.5'),
('SUP05', 'UD Sinar Baru', 'Jl. Dahlia No.3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_pegawai`
--
ALTER TABLE `akun_pegawai`
  ADD PRIMARY KEY (`ID_PEGAWAI`);

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id_audit`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID_CUSTOMER`);

--
-- Indexes for table `detail_nota`
--
ALTER TABLE `detail_nota`
  ADD KEY `NO_PESANAN` (`NO_PESANAN`),
  ADD KEY `NO_ITEM` (`NO_ITEM`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD KEY `NO_TRANSAKSI` (`NO_TRANSAKSI`),
  ADD KEY `NO_ITEM` (`NO_ITEM`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`NO_ITEM`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`NO_PESANAN`),
  ADD KEY `ID_PEGAWAI` (`ID_PEGAWAI`),
  ADD KEY `ID_CUSTOMER` (`ID_CUSTOMER`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`ID_PEGAWAI`) USING BTREE;

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`ID_PT`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`NO_TRANSAKSI`),
  ADD KEY `ID_PT` (`ID_PT`),
  ADD KEY `ID_SUPPLIER` (`ID_SUPPLIER`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_SUPPLIER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`ID_PEGAWAI`);

--
-- Constraints for table `detail_nota`
--
ALTER TABLE `detail_nota`
  ADD CONSTRAINT `detail_nota_ibfk_1` FOREIGN KEY (`NO_PESANAN`) REFERENCES `nota` (`NO_PESANAN`),
  ADD CONSTRAINT `detail_nota_ibfk_2` FOREIGN KEY (`NO_ITEM`) REFERENCES `item` (`NO_ITEM`);

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`NO_TRANSAKSI`) REFERENCES `pesanan` (`NO_TRANSAKSI`),
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`NO_ITEM`) REFERENCES `item` (`NO_ITEM`);

--
-- Constraints for table `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`),
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`ID_CUSTOMER`) REFERENCES `customer` (`ID_CUSTOMER`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`ID_PT`) REFERENCES `perusahaan` (`ID_PT`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `supplier` (`ID_SUPPLIER`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 01:58 PM
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
-- Database: `karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gaji`
--

CREATE TABLE `tbl_gaji` (
  `gaji_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kode_karyawan` char(10) NOT NULL,
  `jam_lembur` int(11) DEFAULT NULL,
  `uang_lembur` double DEFAULT NULL,
  `total_gaji` double DEFAULT NULL,
  `tgl_transfer` date DEFAULT NULL,
  `jam_transfer` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gaji`
--

INSERT INTO `tbl_gaji` (`gaji_id`, `user_id`, `kode_karyawan`, `jam_lembur`, `uang_lembur`, `total_gaji`, `tgl_transfer`, `jam_transfer`) VALUES
(1, 2, '1', 2, 50000, 1000000, '2021-07-12', '22:20:00'),
(2, NULL, '2', NULL, NULL, NULL, NULL, NULL),
(3, 3, '1120120138', 0, 0, 2000000000, '0000-00-00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `kode_karyawan` char(10) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_rekening` char(30) NOT NULL,
  `jabatan` enum('direktur','manager','supervisor','operator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`kode_karyawan`, `nama_karyawan`, `alamat`, `no_rekening`, `jabatan`) VALUES
('1', 'bambang', 'Tangerang', '1234567890', 'supervisor'),
('1120120138', 'Hadi Subhana Malik', 'Jl. Keseimbangan Raya', '120113011401', 'direktur'),
('2', 'Alex', 'cimone', '029309453', 'supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `level` enum('admin','karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `email`, `password`, `fullname`, `level`) VALUES
(1, 'hadi@admin.com', '123', 'Hadi Subhana Malik', 'admin'),
(2, 'bambang@gmail.com', '123', 'bambang', 'karyawan'),
(3, '1120120138@stmikglobal.ac.id', '123', 'Hadi', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_gaji`
--
ALTER TABLE `tbl_gaji`
  ADD PRIMARY KEY (`gaji_id`);

--
-- Indexes for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`kode_karyawan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_gaji`
--
ALTER TABLE `tbl_gaji`
  MODIFY `gaji_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2023 at 10:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` bigint(20) NOT NULL,
  `Name` varchar(5000) NOT NULL,
  `WholeSalePrice` float DEFAULT NULL,
  `RetailPrice` float DEFAULT NULL,
  `Stock` float DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  `StockType` bigint(20) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Name`, `WholeSalePrice`, `RetailPrice`, `Stock`, `IsActive`, `StockType`, `CreatedDate`, `UpdatedDate`) VALUES
(36, 'G I Wire 16 no', 84, 100, 1, b'1', 2, '2023-03-03 06:19:25', '2023-03-03 06:24:44'),
(37, 'kamadenu binding wire', 82, 90, 1, b'1', 2, '2023-03-03 06:21:23', '2023-03-03 06:21:23'),
(38, 'packing tape 3\'x50(mtr) yellow', 41.25, 65, 1, b'1', 1, '2023-03-03 06:31:09', '2023-03-03 06:31:09'),
(39, 'D D L DISTEMPER MAYURI', 47, 60, 1, b'1', 2, '2023-03-03 06:51:17', '2023-03-03 06:51:17'),
(40, 'D D L DISTEMPER MAYURI', 47, 60, 1, b'1', 2, '2023-03-03 06:51:31', '2023-03-03 06:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `stocktype`
--

CREATE TABLE `stocktype` (
  `Id` bigint(11) NOT NULL,
  `StockName` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stocktype`
--

INSERT INTO `stocktype` (`Id`, `StockName`) VALUES
(1, 'Piece/s'),
(2, 'Kg/s'),
(3, 'Dozen/s'),
(4, 'Box/es'),
(5, 'Litre/s'),
(6, 'miligram');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `StockType` (`StockType`);

--
-- Indexes for table `stocktype`
--
ALTER TABLE `stocktype`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `stocktype`
--
ALTER TABLE `stocktype`
  MODIFY `Id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`StockType`) REFERENCES `stocktype` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

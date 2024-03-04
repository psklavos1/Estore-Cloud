-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 12:28 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estore`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `ID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `PRODUCTID` int(11) NOT NULL,
  `DATEOFINSERTION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`ID`, `USERID`, `PRODUCTID`, `DATEOFINSERTION`) VALUES
(26, 11, 8, '2022-11-28 11:40:53'),
(194, 11, 12, '2022-12-07 11:28:58'),
(195, 11, 12, '2022-12-07 11:31:15'),
(196, 11, 12, '2022-12-07 11:31:15'),
(224, 26, 12, '2022-12-08 13:18:38'),
(225, 26, 13, '2022-12-08 13:19:07'),
(226, 26, 12, '2022-12-08 13:20:34'),
(227, 26, 13, '2022-12-08 13:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `PRODUCTCODE` varchar(50) NOT NULL,
  `PRICE` float NOT NULL,
  `DATEOFWITHDRAWAL` datetime NOT NULL,
  `SELLERNAME` varchar(60) NOT NULL,
  `CATEGORY` varchar(30) NOT NULL,
  `SELLERID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `NAME`, `PRODUCTCODE`, `PRICE`, `DATEOFWITHDRAWAL`, `SELLERNAME`, `CATEGORY`, `SELLERID`) VALUES
(8, 'Blue Jeans ', 'JN1231237', 23.5, '2023-03-02 00:00:00', 'Giorgos Skoulas', 'Women', 11),
(12, 'Leather Jacket', 'LJ12314123', 33.5, '2023-06-01 00:00:00', 'Giorgos Skoulas', 'Men', 11),
(13, 'Nike', 'NK123512', 60, '2024-02-04 00:00:00', 'Giorgos Skoulas', 'Sneakers', 11),
(15, 'Tshirt', 'TS123123', 10, '2024-05-01 00:00:00', 'Giorgos Skoulas', 'Men', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `SURNAME` varchar(30) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `ROLE` enum('USER','SELLER','ADMIN','') NOT NULL,
  `CONFIRMED` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `NAME`, `SURNAME`, `USERNAME`, `PASSWORD`, `EMAIL`, `ROLE`, `CONFIRMED`) VALUES
(11, 'Giorgos', 'Skoulas', 'gskoulas', '123456', 'gskoul@gmail.com', 'SELLER', 1),
(12, 'Giannis', 'Peridis', 'gperidis', '123456', 'gperidis@gmail.com', 'USER', 1),
(26, 'Leonidas', 'Bakopoulos', 'leobako', '123456', 'leobako@gmail.com', 'ADMIN', 1),
(27, 'Alexandra', 'Tsipouraki', 'atsipou', '123456', 'atsipou@tuc.gr', 'USER', 1),
(28, 'Smalis', 'Sklavos', 'ssklavos', '123456', 'ssklavos@gmail.com', 'USER', 1),
(48, 'Panagiotis', 'Sklavosasd', 'ddadf', '123123', 'panagiotissklavos17@gmail.com', 'USER', 1),
(49, 'Panagiotis', 'Sklavos', 'psklavos1', '123456', 'panagiotissklavos17@gmail.com', 'ADMIN', 1),
(51, 'Panagiotis', 'Sklavos', 'asdasda', 'asdasd', 'asdasdasd@gmail.com', 'USER', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userIdConstrnt` (`USERID`),
  ADD KEY `productIdConstrnt` (`PRODUCTID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SoldByConstraint` (`SELLERID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `productIdConstrnt` FOREIGN KEY (`PRODUCTID`) REFERENCES `products` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userIdConstrnt` FOREIGN KEY (`USERID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `SoldByConstraint` FOREIGN KEY (`SELLERID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

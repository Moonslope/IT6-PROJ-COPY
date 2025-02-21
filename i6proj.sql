-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 06:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `i6proj`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `card_color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `card_color`) VALUES
(1, 'Green'),
(2, 'Red'),
(3, 'Yellow'),
(4, 'Blue'),
(5, 'Pink');

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `cashier_id` int(11) NOT NULL,
  `cashier_fname` varchar(50) NOT NULL,
  `cashier_lname` varchar(50) NOT NULL,
  `cashier_address` varchar(100) NOT NULL,
  `cashier_contactNum` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`cashier_id`, `cashier_fname`, `cashier_lname`, `cashier_address`, `cashier_contactNum`) VALUES
(18, 'Mj', 'Sarona', 'jskyurghsghf', '0998475'),
(19, 'dharyl', 'jay', 'weqwe', '09123456789'),
(20, 'chris', 'elnick', 'zxcz', '09123456789'),
(21, 'dharyl', 'jay', 'qweqreq', '09123456789'),
(23, 'dharyl', 'dharyl', 'cabantian', '12312154'),
(26, 'SHSH', 'shhshshs', 'sdsd0990', '9988');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `driver_fname` varchar(255) NOT NULL,
  `driver_lname` varchar(255) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `driver_address` varchar(255) NOT NULL,
  `driver_contactNum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `driver_fname`, `driver_lname`, `driver_name`, `driver_address`, `driver_contactNum`) VALUES
(6, 'josh', 'mojika', 'josh mojika', 'tugbok,maa,calinan', '5559974'),
(7, 'dharyllll', 'dharyl', 'dharyllll dharyl', 'cabantian', '498456168'),
(8, 'gar ', 'flores', 'gar  flores', 'buhangin', '4884894865'),
(9, 'chris', '', 'chris ', '', ''),
(10, 'MJ', '', 'MJ ', '', ''),
(11, 'jay', 'jjpo', 'jay jjpo', 'dsd', '9283784'),
(12, 'Lawrence', 'Bisnar', '', 'aa', '232');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(11) NOT NULL,
  `route` varchar(100) NOT NULL,
  `fare` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `route`, `fare`) VALUES
(1, 'Mintal', 35.00),
(2, 'Tugbok', 38.00),
(3, 'Los Amigos', 40.00),
(4, 'Quarry', 40.00),
(5, 'Puting Bato', 45.00),
(6, 'Riverside', 45.00),
(7, 'Calinan', 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `platenumber` varchar(100) NOT NULL,
  `vehicle_model` varchar(255) NOT NULL,
  `vehicle_color` varchar(255) NOT NULL,
  `transmission_type` varchar(255) NOT NULL,
  `driver` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `platenumber`, `vehicle_model`, `vehicle_color`, `transmission_type`, `driver`) VALUES
(3, 'XSDH10', '', '', '', 'josh mojika'),
(4, '123', '', '', '', '6'),
(5, '123', '', '', '', ''),
(8, 'dsa', '', '', '', ''),
(9, 'wassup', 'sadsa', 'white', 'manual', 'gar  flores');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`cashier_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cashier`
--
ALTER TABLE `cashier`
  MODIFY `cashier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

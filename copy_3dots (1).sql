-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2025 at 09:55 AM
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
-- Database: `copy_3dots`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_colors`
--

CREATE TABLE `card_colors` (
  `card_color_id` int(11) NOT NULL,
  `card_color_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card_colors`
--

INSERT INTO `card_colors` (`card_color_id`, `card_color_name`) VALUES
(1, 'Green'),
(2, 'Red'),
(3, 'Yellow'),
(4, 'Blue'),
(5, 'Pink'),
(6, 'Black');

-- --------------------------------------------------------

--
-- Table structure for table `cashiers`
--

CREATE TABLE `cashiers` (
  `cashier_id` int(11) NOT NULL,
  `cashier_fname` varchar(50) NOT NULL,
  `cashier_lname` varchar(50) NOT NULL,
  `cashier_address` varchar(100) NOT NULL,
  `cashier_contactNum` varchar(20) NOT NULL,
  `cashier_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashiers`
--

INSERT INTO `cashiers` (`cashier_id`, `cashier_fname`, `cashier_lname`, `cashier_address`, `cashier_contactNum`, `cashier_name`) VALUES
(27, 'Lawrence', 'Bisnar', 'Calinan', '09668543874', 'Lawrence Bisnar'),
(28, 'Gar', 'Flores', 'Buhanghin', '098656565', 'Gar Flores'),
(29, 'Dharyl', 'Castillo', 'Cabantian', '0963274524', 'Dharyl Castillo'),
(30, 'Kyrie', 'Irving', 'Maa', '0967878565', 'Kyrie Irving'),
(32, 'Mj', 'Jordan', 'Calinan, Davao City', '09668432874', 'Mj Jordan');

--
-- Triggers `cashiers`
--
DELIMITER $$
CREATE TRIGGER `set_cashier_name` BEFORE INSERT ON `cashiers` FOR EACH ROW BEGIN
    SET NEW.cashier_name = CONCAT(NEW.cashier_fname, ' ', NEW.cashier_lname);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL,
  `driver_fname` varchar(255) NOT NULL,
  `driver_lname` varchar(255) NOT NULL,
  `driver_address` varchar(255) NOT NULL,
  `driver_contactNum` varchar(255) NOT NULL,
  `driver_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `driver_fname`, `driver_lname`, `driver_address`, `driver_contactNum`, `driver_name`) VALUES
(13, 'Earl', 'Cerbo', 'Maa', '09768656', 'Earl Cerbo'),
(14, 'Geop', 'Olano', 'Toril', '0984576763', 'Geop Olano'),
(15, 'Kane', 'Ga', 'Calinan', '09768656', 'Kane Ga'),
(16, 'John', 'DDoe', 'Toril', '0984576763', 'John DDoe'),
(17, 'Marie', 'Doe', 'Cabantian', '09123456789', 'Marie Doe'),
(19, 'Miochael', 'Lar', 'Toril', '09768656', 'Miochael Lar');

--
-- Triggers `drivers`
--
DELIMITER $$
CREATE TRIGGER `set_driver_name` BEFORE INSERT ON `drivers` FOR EACH ROW BEGIN
    SET NEW.driver_name = CONCAT(NEW.driver_fname, ' ', NEW.driver_lname);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `route_name` varchar(100) NOT NULL,
  `route_start` varchar(100) NOT NULL,
  `route_end` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_name`, `route_start`, `route_end`) VALUES
(12, 'Calinan-Bangkerohan', 'Calinan', 'Bangkerohan'),
(14, 'Bangkerohan-Calinan', 'Bangkerohan', 'Calinan');

-- --------------------------------------------------------

--
-- Table structure for table `route_points`
--

CREATE TABLE `route_points` (
  `route_point_id` int(11) NOT NULL,
  `route_point_name` varchar(100) NOT NULL,
  `fare` decimal(10,2) NOT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route_points`
--

INSERT INTO `route_points` (`route_point_id`, `route_point_name`, `fare`, `route_id`) VALUES
(23, 'Mintal', 35.00, 12),
(25, 'Bypass', 40.00, 12),
(27, 'Mintal', 35.00, 14),
(28, 'Tugbok', 38.00, 14),
(29, 'Quarry', 40.00, 14),
(30, 'Los Amigos', 40.00, 14),
(31, 'Puting Bato', 45.00, 14),
(32, 'Riverside', 45.00, 14),
(33, 'Calinan', 50.00, 14);

-- --------------------------------------------------------

--
-- Table structure for table `route_route_points`
--

CREATE TABLE `route_route_points` (
  `rrp_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `route_point_id` int(11) NOT NULL,
  `passenger_count` int(11) NOT NULL DEFAULT 1,
  `fare` decimal(10,2) NOT NULL,
  `travel_pass_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route_route_points`
--

INSERT INTO `route_route_points` (`rrp_id`, `route_id`, `route_point_id`, `passenger_count`, `fare`, `travel_pass_id`) VALUES
(40, 14, 28, 3, 38.00, 168),
(41, 14, 33, 7, 50.00, 168),
(42, 14, 30, 1, 40.00, 168),
(43, 14, 27, 2, 35.00, 168),
(44, 14, 32, 2, 45.00, 168),
(45, 14, 31, 1, 45.00, 168),
(46, 12, 23, 8, 35.00, 169),
(47, 12, 25, 6, 40.00, 169);

--
-- Triggers `route_route_points`
--
DELIMITER $$
CREATE TRIGGER `update_travel_pass_totals` AFTER INSERT ON `route_route_points` FOR EACH ROW BEGIN
    -- Update total passengers for the travel pass
    UPDATE travel_pass
    SET total_passengers = (
        SELECT COALESCE(SUM(passenger_count), 0)
        FROM route_route_points
        WHERE travel_pass_id = NEW.travel_pass_id
    ),
    -- Update total fare for the travel pass
    total_fare = (
        SELECT COALESCE(SUM(passenger_count * fare), 0)
        FROM route_route_points
        WHERE travel_pass_id = NEW.travel_pass_id
    )
    WHERE travel_pass_id = NEW.travel_pass_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `travel_pass`
--

CREATE TABLE `travel_pass` (
  `travel_pass_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `cashier_id` int(11) NOT NULL,
  `card_color_id` int(11) NOT NULL,
  `total_passengers` int(11) DEFAULT 0,
  `total_fare` decimal(10,2) DEFAULT 0.00,
  `travel_date` date DEFAULT curdate(),
  `departure_time` time DEFAULT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_pass`
--

INSERT INTO `travel_pass` (`travel_pass_id`, `driver_id`, `vehicle_id`, `cashier_id`, `card_color_id`, `total_passengers`, `total_fare`, `travel_date`, `departure_time`, `route_id`) VALUES
(168, 19, 12, 30, 1, 16, 709.00, '2025-03-04', '09:41:18', 14),
(169, 13, 14, 28, 5, 14, 520.00, '2025-03-04', '09:42:07', 12);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `platenumber` varchar(100) NOT NULL,
  `vehicle_model` varchar(255) NOT NULL,
  `vehicle_color` varchar(255) NOT NULL,
  `transmission_type` varchar(255) NOT NULL,
  `driver` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `driver_id`, `platenumber`, `vehicle_model`, `vehicle_color`, `transmission_type`, `driver`) VALUES
(3, 15, 'XSDH10', 's', 'White', '', 'Kane Ga'),
(10, 13, 'YY634', 's', 'White', '', 'Earl Cerbo'),
(11, 16, 'WBHD2', 's', 'White', '', 'John DDoe'),
(12, 17, '123', 'QQQ', 'BLACK', '', 'Marie Doe'),
(14, NULL, 'XXQW12', 'Mitsubishi ', 'White', '', 'Miochael Lar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_colors`
--
ALTER TABLE `card_colors`
  ADD PRIMARY KEY (`card_color_id`);

--
-- Indexes for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`cashier_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `route_points`
--
ALTER TABLE `route_points`
  ADD PRIMARY KEY (`route_point_id`),
  ADD KEY `fk_destinations_routes` (`route_id`);

--
-- Indexes for table `route_route_points`
--
ALTER TABLE `route_route_points`
  ADD PRIMARY KEY (`rrp_id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `route_point_id` (`route_point_id`),
  ADD KEY `travel_pass_id` (`travel_pass_id`);

--
-- Indexes for table `travel_pass`
--
ALTER TABLE `travel_pass`
  ADD PRIMARY KEY (`travel_pass_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `cashier_id` (`cashier_id`),
  ADD KEY `fk_travel_pass_routes` (`route_id`),
  ADD KEY `card_color_id` (`card_color_id`) USING BTREE;

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `fk_vehicle_driver` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_colors`
--
ALTER TABLE `card_colors`
  MODIFY `card_color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `cashier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `route_points`
--
ALTER TABLE `route_points`
  MODIFY `route_point_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `route_route_points`
--
ALTER TABLE `route_route_points`
  MODIFY `rrp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `travel_pass`
--
ALTER TABLE `travel_pass`
  MODIFY `travel_pass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `route_points`
--
ALTER TABLE `route_points`
  ADD CONSTRAINT `fk_destinations_routes` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `route_route_points`
--
ALTER TABLE `route_route_points`
  ADD CONSTRAINT `route_route_points_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `route_route_points_ibfk_2` FOREIGN KEY (`route_point_id`) REFERENCES `route_points` (`route_point_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `route_route_points_ibfk_3` FOREIGN KEY (`travel_pass_id`) REFERENCES `travel_pass` (`travel_pass_id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_pass`
--
ALTER TABLE `travel_pass`
  ADD CONSTRAINT `fk_travel_pass_routes` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `travel_pass_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_pass_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_pass_ibfk_3` FOREIGN KEY (`cashier_id`) REFERENCES `cashiers` (`cashier_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_pass_ibfk_4` FOREIGN KEY (`card_color_id`) REFERENCES `card_colors` (`card_color_id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `fk_vehicle_driver` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 09:22 AM
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
-- Database: `cocop`
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
(1, 'Red'),
(2, 'Blue'),
(3, 'Green'),
(4, 'Yellow'),
(5, 'Orange'),
(6, 'Purple'),
(7, 'Pink'),
(8, 'Black'),
(9, 'White'),
(10, 'Gray');

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
  `cashier_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashiers`
--

INSERT INTO `cashiers` (`cashier_id`, `cashier_fname`, `cashier_lname`, `cashier_address`, `cashier_contactNum`, `cashier_name`, `username`, `password`) VALUES
(1001, 'Gar', 'Flores', 'Buhangin', '09668432874', 'Gar Flores', 'gar', 'gar@123456'),
(1002, 'Maria', 'Santos', 'Davao', '09123456789', 'Maria Santos', 'maria', 'maria@123456'),
(1003, 'Anna ', 'Lopez', 'Quezon', '09987654321', 'Anna  Lopez', 'anna', 'anna@123');

--
-- Triggers `cashiers`
--
DELIMITER $$
CREATE TRIGGER `set_cashier_name` BEFORE INSERT ON `cashiers` FOR EACH ROW SET NEW.cashier_name = CONCAT(NEW.cashier_fname, ' ', NEW.cashier_lname)
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
(1, 'Roberto', 'Cruz', 'Manila', '09112233445', 'Roberto Cruz'),
(2, 'Samuel', 'Torres', 'Davao', '09998877665', 'Samuel Torres'),
(3, 'Luis', 'Mendoza', 'Cebu', '09223344556', 'Luis Mendoza'),
(4, 'Mark', 'Reyes', 'Quezon City', '09334455667', 'Mark Reyes'),
(5, 'Adrian', 'Santos', 'Baguio', '09445566778', 'Adrian Santos'),
(6, 'Joel', 'Fernandez', 'Iloilo', '09776655443', 'Joel Fernandez'),
(7, 'Anthony', 'Lopez', 'Bacolod', '09559988776', 'Anthony Lopez'),
(8, 'Richard', 'Gomez', 'Cavite', '09163334455', 'Richard Gomez'),
(9, 'Bryan', 'Dela Cruz', 'Laguna', '09875556677', 'Bryan Dela Cruz'),
(10, 'Ernesto', 'Ramos', 'Batangas', '09657788990', 'Ernesto Ramos'),
(11, 'Mj', 'Sarona', 'Toril', '0984576763', 'Mj Sarona'),
(12, 'Carlos', 'Fernandez', 'Quezon City', '09123456789', 'Carlos Fernandez'),
(13, 'Miguel', 'Santiago', 'Cebu', '09234567890', 'Miguel Santiago'),
(14, 'Roberto', 'Guzman', 'Davao', '09345678901', 'Roberto Guzman'),
(15, 'Antonio', 'De Leon', 'Makati', '09456789012', 'Antonio De Leon'),
(16, 'Eduardo', 'Reyes', 'Pasay', '09567890123', 'Eduardo Reyes'),
(17, 'Francisco', 'Torres', 'Cavite', '09678901234', 'Francisco Torres'),
(18, 'Ricardo', 'Mendoza', 'Laguna', '09789012345', 'Ricardo Mendoza'),
(19, 'Fernando', 'Villanueva', 'Batangas', '09890123456', 'Fernando Villanueva'),
(20, 'Rafael', 'Castro', 'Baguio', '09901234567', 'Rafael Castro'),
(21, 'Javier', 'Del Rosario', 'Iloilo', '09012345678', 'Javier Del Rosario');

--
-- Triggers `drivers`
--
DELIMITER $$
CREATE TRIGGER `set_driver_name` BEFORE INSERT ON `drivers` FOR EACH ROW SET NEW.driver_name = CONCAT(NEW.driver_fname, ' ', NEW.driver_lname)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `route_name` varchar(100) NOT NULL,
  `route_origin` varchar(100) NOT NULL,
  `route_destination` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_name`, `route_origin`, `route_destination`) VALUES
(1, 'Calinan-Bangkerohan', 'Calinan', 'Bangkerohan'),
(2, 'Bangkerohan-Calinan', 'Bangkerohan', 'Calinan');

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
(1, 'Mintal', 35.00, 2),
(2, 'Tugbok', 38.00, 2),
(3, 'Quarry', 40.00, 2),
(4, 'Los Amigos', 40.00, 2),
(5, 'Puting Bato', 45.00, 2),
(6, 'Riverside', 45.00, 2),
(7, 'Calinan', 50.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `route_route_points`
--

CREATE TABLE `route_route_points` (
  `rrp_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `route_point_id` int(11) NOT NULL,
  `passenger_count` int(11) NOT NULL DEFAULT 0,
  `fare` decimal(10,2) NOT NULL,
  `travel_pass_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route_route_points`
--

INSERT INTO `route_route_points` (`rrp_id`, `route_id`, `route_point_id`, `passenger_count`, `fare`, `travel_pass_id`) VALUES
(1, 2, 1, 3, 35.00, 1),
(2, 2, 2, 15, 38.00, 1);

--
-- Triggers `route_route_points`
--
DELIMITER $$
CREATE TRIGGER `update_travel_pass_totals` AFTER INSERT ON `route_route_points` FOR EACH ROW UPDATE travel_pass
    SET total_passengers = (
        SELECT COALESCE(SUM(passenger_count), 0)
        FROM route_route_points
        WHERE travel_pass_id = NEW.travel_pass_id
    ),

    total_fare = (
        SELECT COALESCE(SUM(passenger_count * fare), 0)
        FROM route_route_points
        WHERE travel_pass_id = NEW.travel_pass_id
    )
    WHERE travel_pass_id = NEW.travel_pass_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_fares_summary`
-- (See below for the actual view)
--
CREATE TABLE `total_fares_summary` (
`total_fares_today` decimal(32,2)
,`total_fares_month` decimal(32,2)
,`total_fares_year` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `travel_pass`
--

CREATE TABLE `travel_pass` (
  `travel_pass_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `cashier_id` int(11) DEFAULT NULL,
  `card_color_id` int(11) DEFAULT NULL,
  `total_passengers` int(11) DEFAULT NULL,
  `total_fare` decimal(10,2) DEFAULT NULL,
  `travel_date` date NOT NULL DEFAULT curdate(),
  `departure_time` time DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_pass`
--

INSERT INTO `travel_pass` (`travel_pass_id`, `driver_id`, `vehicle_id`, `cashier_id`, `card_color_id`, `total_passengers`, `total_fare`, `travel_date`, `departure_time`, `route_id`) VALUES
(1, 1, 3003, 1003, 2, 18, 675.00, '2025-03-09', '03:35:46', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `travel_pass_history`
-- (See below for the actual view)
--
CREATE TABLE `travel_pass_history` (
`travel_pass_id` int(11)
,`card_color_name` varchar(50)
,`route` varchar(100)
,`driver` varchar(255)
,`vehicle` varchar(50)
,`cashier` varchar(255)
,`total_passengers` int(11)
,`total_fare` decimal(10,2)
,`travel_date` date
,`departure_time` time
);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `platenumber` varchar(50) NOT NULL,
  `vehicle_model` varchar(100) NOT NULL,
  `vehicle_color` varchar(50) NOT NULL,
  `transmission_type` varchar(50) NOT NULL,
  `driver` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `driver_id`, `platenumber`, `vehicle_model`, `vehicle_color`, `transmission_type`, `driver`) VALUES
(3003, 1, 'DEF5678', 'Mitsubishi L300', 'White', 'Manual', 'Roberto Cruz'),
(3004, 3, 'GHI9012', 'Mitsubishi L300', 'White', 'Manual', 'Luis Mendoza'),
(3005, 2, 'JKL3456', 'Mitsubishi L300', 'White', 'Manual', 'Samuel Torres'),
(3006, 4, 'MNO7890', 'Mitsubishi L300', 'White', 'Manual', 'Mark Reyes'),
(3007, 5, 'PQR1234', 'Mitsubishi L300', 'White', 'Manual', 'Adrian Santos'),
(3008, 6, 'STU5678', 'Mitsubishi L300', 'White', 'Manual', 'Joel Fernandez'),
(3009, 11, 'VWX9012', 'Mitsubishi L300', 'White', 'Manual', 'Mj Sarona'),
(3010, NULL, 'YZA3456', 'Mitsubishi L300', 'White', 'Manual', ''),
(3011, NULL, 'BCD7890', 'Mitsubishi L300', 'White', 'Manual', ''),
(3012, NULL, 'EFG1234', 'Mitsubishi L300', 'White', 'Manual', ''),
(3013, NULL, 'HIJ5678', 'Mitsubishi L300', 'White', 'Manual', ''),
(3014, NULL, 'KLM9012', 'Mitsubishi L300', 'White', 'Manual', ''),
(3015, NULL, 'NOP3456', 'Mitsubishi L300', 'White', 'Manual', ''),
(3016, NULL, 'QRS7890', 'Mitsubishi L300', 'White', 'Manual', ''),
(3017, NULL, 'TUV1234', 'Mitsubishi L300', 'White', 'Manual', ''),
(3018, NULL, 'WXY5678', 'Mitsubishi L300', 'White', 'Manual', ''),
(3019, NULL, 'ZAB9012', 'Mitsubishi L300', 'White', 'Manual', ''),
(3020, NULL, 'CDE3456', 'Mitsubishi L300', 'White', 'Manual', ''),
(3021, NULL, 'FGH7890', 'Mitsubishi L300', 'White', 'Manual', '');

-- --------------------------------------------------------

--
-- Structure for view `total_fares_summary`
--
DROP TABLE IF EXISTS `total_fares_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_fares_summary`  AS SELECT (select coalesce(sum(`travel_pass`.`total_fare`),0) from `travel_pass` where `travel_pass`.`travel_date` = curdate()) AS `total_fares_today`, (select coalesce(sum(`travel_pass`.`total_fare`),0) from `travel_pass` where month(`travel_pass`.`travel_date`) = month(curdate()) and year(`travel_pass`.`travel_date`) = year(curdate())) AS `total_fares_month`, (select coalesce(sum(`travel_pass`.`total_fare`),0) from `travel_pass` where year(`travel_pass`.`travel_date`) = year(curdate())) AS `total_fares_year` ;

-- --------------------------------------------------------

--
-- Structure for view `travel_pass_history`
--
DROP TABLE IF EXISTS `travel_pass_history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `travel_pass_history`  AS SELECT `tp`.`travel_pass_id` AS `travel_pass_id`, `cc`.`card_color_name` AS `card_color_name`, `r`.`route_name` AS `route`, `d`.`driver_name` AS `driver`, `v`.`platenumber` AS `vehicle`, `c`.`cashier_name` AS `cashier`, `tp`.`total_passengers` AS `total_passengers`, `tp`.`total_fare` AS `total_fare`, `tp`.`travel_date` AS `travel_date`, `tp`.`departure_time` AS `departure_time` FROM (((((`travel_pass` `tp` join `card_colors` `cc` on(`tp`.`card_color_id` = `cc`.`card_color_id`)) join `routes` `r` on(`tp`.`route_id` = `r`.`route_id`)) join `drivers` `d` on(`tp`.`driver_id` = `d`.`driver_id`)) join `vehicles` `v` on(`tp`.`vehicle_id` = `v`.`vehicle_id`)) join `cashiers` `c` on(`tp`.`cashier_id` = `c`.`cashier_id`)) ORDER BY `tp`.`travel_date` DESC, `tp`.`departure_time` DESC ;

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
  ADD KEY `route_id` (`route_id`);

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
  ADD KEY `card_color_id` (`card_color_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `cashier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `route_points`
--
ALTER TABLE `route_points`
  MODIFY `route_point_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `route_route_points`
--
ALTER TABLE `route_route_points`
  MODIFY `rrp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `travel_pass`
--
ALTER TABLE `travel_pass`
  MODIFY `travel_pass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3022;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `route_points`
--
ALTER TABLE `route_points`
  ADD CONSTRAINT `route_points_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `travel_pass_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `travel_pass_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `travel_pass_ibfk_3` FOREIGN KEY (`cashier_id`) REFERENCES `cashiers` (`cashier_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `travel_pass_ibfk_4` FOREIGN KEY (`card_color_id`) REFERENCES `card_colors` (`card_color_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `travel_pass_ibfk_5` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE SET NULL;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

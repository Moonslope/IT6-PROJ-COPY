-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2025 at 03:12 PM
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
-- Database: `i6proj2`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_driver_name` (IN `vehicle_id` INT, IN `driver_id` INT)   BEGIN
    DECLARE driver_fname VARCHAR(255);
    DECLARE driver_lname VARCHAR(255);

    -- Ensure only one row is selected
    SELECT driver_fname, driver_lname INTO driver_fname, driver_lname
    FROM driver
    WHERE driver_id = driver_id
    LIMIT 1;

    UPDATE vehicle
    SET driver_name = CONCAT(driver_fname, ' ', driver_lname)
    WHERE vehicle_id = vehicle_id;
END$$

DELIMITER ;

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
  `cashier_contactNum` varchar(20) NOT NULL,
  `cashier_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`cashier_id`, `cashier_fname`, `cashier_lname`, `cashier_address`, `cashier_contactNum`, `cashier_name`) VALUES
(27, 'Lawrence', 'Bisnar', 'Calinan', '09668543874', 'Lawrence Bisnar'),
(28, 'Gar', 'Flores', 'Buhanghin', '098656565', 'Gar Flores'),
(29, 'Dharyl', 'Castillo', 'Cabantian', '0963274524', 'Dharyl Castillo');

--
-- Triggers `cashier`
--
DELIMITER $$
CREATE TRIGGER `set_cashier_name` BEFORE INSERT ON `cashier` FOR EACH ROW BEGIN
    SET NEW.cashier_name = CONCAT(NEW.cashier_fname, ' ', NEW.cashier_lname);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `driver_fname` varchar(255) NOT NULL,
  `driver_lname` varchar(255) NOT NULL,
  `driver_address` varchar(255) NOT NULL,
  `driver_contactNum` varchar(255) NOT NULL,
  `driver_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `driver_fname`, `driver_lname`, `driver_address`, `driver_contactNum`, `driver_name`) VALUES
(13, 'Earl', 'Cerbo', 'Maa', '09768656', 'Earl Cerbo'),
(14, 'Geop', 'Olano', 'Toril', '0984576763', 'Geop Olano'),
(15, 'Kane', 'Ga', 'Calinan', '09768656', 'Kane Ga'),
(16, 'John', 'DDoe', 'Toril', '0984576763', 'John DDoe');

--
-- Triggers `driver`
--
DELIMITER $$
CREATE TRIGGER `set_driver_name` BEFORE INSERT ON `driver` FOR EACH ROW BEGIN
    SET NEW.driver_name = CONCAT(NEW.driver_fname, ' ', NEW.driver_lname);
END
$$
DELIMITER ;

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
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `route_name` varchar(100) NOT NULL,
  `fare` decimal(10,2) NOT NULL,
  `total_passengers` int(11) DEFAULT 0,
  `total_fare` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `route_id`, `route_name`, `fare`, `total_passengers`, `total_fare`) VALUES
(50, 3, 'Los Amigos', 40.00, 5, 200.00),
(51, 2, 'Tugbok', 38.00, 2, 76.00),
(52, 6, 'Riverside', 45.00, 2, 90.00),
(54, 4, 'Quarry', 40.00, 4, 160.00),
(56, 5, 'Puting Bato', 45.00, 3, 135.00);

-- --------------------------------------------------------

--
-- Table structure for table `travel_pass`
--

CREATE TABLE `travel_pass` (
  `travel_pass_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `cashier_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `total_passengers` int(11) NOT NULL,
  `total_fare` decimal(10,2) NOT NULL,
  `travel_date` date DEFAULT curdate(),
  `departure_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_pass`
--

INSERT INTO `travel_pass` (`travel_pass_id`, `driver_id`, `vehicle_id`, `cashier_id`, `card_id`, `total_passengers`, `total_fare`, `travel_date`, `departure_time`) VALUES
(26, 13, 11, 28, 4, 16, 679.00, '2025-02-23', '10:10:35');

-- --------------------------------------------------------

--
-- Stand-in structure for view `travel_pass_view`
-- (See below for the actual view)
--
CREATE TABLE `travel_pass_view` (
`travel_pass_id` int(11)
,`driver` varchar(255)
,`vehicle` varchar(100)
,`cashier` varchar(255)
,`card` varchar(50)
,`total_passengers` int(11)
,`total_fare` decimal(10,2)
,`travel_date` date
,`departure_time` time
);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `platenumber` varchar(100) NOT NULL,
  `vehicle_model` varchar(255) NOT NULL,
  `vehicle_color` varchar(255) NOT NULL,
  `transmission_type` varchar(255) NOT NULL,
  `driver` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `driver_id`, `platenumber`, `vehicle_model`, `vehicle_color`, `transmission_type`, `driver`) VALUES
(3, NULL, 'XSDH10', 's', 'White', 'Automatic', 'John DDoe'),
(10, NULL, 'YY634', 's', 'White', '', 'Kane Ga'),
(11, NULL, 'WBHD2', 's', 'White', '', 'John DDoe'),
(12, NULL, '123', 'QQQ', 'BLACK', '', 'Earl Cerbo'),
(13, NULL, 'PPP', 'MMM', 'RED', '', 'Geop Olano');

--
-- Triggers `vehicle`
--
DELIMITER $$
CREATE TRIGGER `before_vehicle_update` BEFORE UPDATE ON `vehicle` FOR EACH ROW BEGIN
    DECLARE driver_id INT;
    -- Fetch the driver_id based on the driver name
    SELECT driver_id INTO driver_id FROM driver WHERE driver_name = NEW.driver;
    -- Set the driver_id in the vehicle table
    SET NEW.driver_id = driver_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `travel_pass_view`
--
DROP TABLE IF EXISTS `travel_pass_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `travel_pass_view`  AS SELECT `tp`.`travel_pass_id` AS `travel_pass_id`, `d`.`driver_name` AS `driver`, `v`.`platenumber` AS `vehicle`, `c`.`cashier_name` AS `cashier`, `cd`.`card_color` AS `card`, `tp`.`total_passengers` AS `total_passengers`, `tp`.`total_fare` AS `total_fare`, `tp`.`travel_date` AS `travel_date`, `tp`.`departure_time` AS `departure_time` FROM ((((`travel_pass` `tp` join `driver` `d` on(`tp`.`driver_id` = `d`.`driver_id`)) join `vehicle` `v` on(`tp`.`vehicle_id` = `v`.`vehicle_id`)) join `cashier` `c` on(`tp`.`cashier_id` = `c`.`cashier_id`)) join `card` `cd` on(`tp`.`card_id` = `cd`.`card_id`)) ;

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
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `travel_pass`
--
ALTER TABLE `travel_pass`
  ADD PRIMARY KEY (`travel_pass_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `cashier_id` (`cashier_id`),
  ADD KEY `card_id` (`card_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `fk_vehicle_driver` (`driver_id`);

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
  MODIFY `cashier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `travel_pass`
--
ALTER TABLE `travel_pass`
  MODIFY `travel_pass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_pass`
--
ALTER TABLE `travel_pass`
  ADD CONSTRAINT `travel_pass_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_pass_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_pass_ibfk_3` FOREIGN KEY (`cashier_id`) REFERENCES `cashier` (`cashier_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_pass_ibfk_4` FOREIGN KEY (`card_id`) REFERENCES `card` (`card_id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `fk_vehicle_driver` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

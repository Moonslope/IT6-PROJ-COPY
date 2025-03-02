-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2025 at 01:28 PM
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
-- Database: `3dots_db`
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
(5, 'Pink'),
(6, 'Black');

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
(29, 'Dharyl', 'Castillo', 'Cabantian', '0963274524', 'Dharyl Castillo'),
(30, 'Kyrie', 'Irving', 'Maa', '0967878565', 'Kyrie Irving');

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
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` int(11) NOT NULL,
  `destination_name` varchar(100) NOT NULL,
  `fare` decimal(10,2) NOT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`destination_id`, `destination_name`, `fare`, `route_id`) VALUES
(23, 'Mintal', 35.00, 12),
(24, 'Tugbok', 25.00, 12),
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
(16, 'John', 'DDoe', 'Toril', '0984576763', 'John DDoe'),
(17, 'Marie', 'Doe', 'Cabantian', '09123456789', 'Marie Doe');

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
-- Table structure for table `passenger_destination`
--

CREATE TABLE `passenger_destination` (
  `passenger_destination_id` int(11) NOT NULL,
  `travel_pass_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `passenger_count` int(11) NOT NULL,
  `fare` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `passenger_destination`
--
DELIMITER $$
CREATE TRIGGER `update_total_passengers_fare_after_insert` AFTER INSERT ON `passenger_destination` FOR EACH ROW BEGIN
    -- Update total_passengers and total_fare for the corresponding travel_pass
    UPDATE travel_pass
    SET total_passengers = (SELECT COALESCE(SUM(passenger_count), 0) FROM passenger_destination WHERE travel_pass_id = NEW.travel_pass_id),
        total_fare = (SELECT COALESCE(SUM(fare), 0) FROM passenger_destination WHERE travel_pass_id = NEW.travel_pass_id)
    WHERE travel_pass_id = NEW.travel_pass_id;
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
-- Table structure for table `travel_pass`
--

CREATE TABLE `travel_pass` (
  `travel_pass_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `cashier_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `total_passengers` int(11) DEFAULT 0,
  `total_fare` decimal(10,2) DEFAULT 0.00,
  `travel_date` date DEFAULT curdate(),
  `departure_time` time DEFAULT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `travel_pass_summary`
-- (See below for the actual view)
--
CREATE TABLE `travel_pass_summary` (
`travel_pass_id` int(11)
,`travel_date` date
,`departure_time` time
,`driver_name` varchar(255)
,`platenumber` varchar(100)
,`card_color` varchar(50)
,`cashier_name` varchar(255)
,`destination_name` varchar(100)
,`total_passengers` decimal(32,0)
,`total_fare` decimal(32,2)
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
(3, 15, 'XSDH10', 's', 'White', '', 'Kane Ga'),
(10, 13, 'YY634', 's', 'White', '', 'Earl Cerbo'),
(11, 16, 'WBHD2', 's', 'White', '', 'John DDoe'),
(12, 17, '123', 'QQQ', 'BLACK', '', 'Marie Doe'),
(13, 14, 'PPP', 'MMM', 'RED', '', 'Geop Olano');

--
-- Triggers `vehicle`
--
DELIMITER $$
CREATE TRIGGER `before_vehicle_update` BEFORE UPDATE ON `vehicle` FOR EACH ROW BEGIN
    DECLARE temp_driver_id INT;

    -- Fetch driver_id based on the driver name
    SELECT driver_id INTO temp_driver_id 
    FROM driver 
    WHERE driver_name = NEW.driver 
    LIMIT 1;

    -- Check if a valid driver was found
    IF temp_driver_id IS NOT NULL THEN
        SET NEW.driver_id = temp_driver_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `travel_pass_summary`
--
DROP TABLE IF EXISTS `travel_pass_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `travel_pass_summary`  AS SELECT `tp`.`travel_pass_id` AS `travel_pass_id`, `tp`.`travel_date` AS `travel_date`, `tp`.`departure_time` AS `departure_time`, `dr`.`driver_name` AS `driver_name`, `v`.`platenumber` AS `platenumber`, `cd`.`card_color` AS `card_color`, `c`.`cashier_name` AS `cashier_name`, `d`.`destination_name` AS `destination_name`, sum(`pd`.`passenger_count`) AS `total_passengers`, sum(`pd`.`fare`) AS `total_fare` FROM ((((((`travel_pass` `tp` left join `passenger_destination` `pd` on(`tp`.`travel_pass_id` = `pd`.`travel_pass_id`)) left join `destinations` `d` on(`pd`.`destination_id` = `d`.`destination_id`)) left join `driver` `dr` on(`tp`.`driver_id` = `dr`.`driver_id`)) left join `vehicle` `v` on(`tp`.`vehicle_id` = `v`.`vehicle_id`)) left join `cashier` `c` on(`tp`.`cashier_id` = `c`.`cashier_id`)) left join `card` `cd` on(`tp`.`card_id` = `cd`.`card_id`)) GROUP BY `tp`.`travel_pass_id`, `tp`.`travel_date`, `tp`.`departure_time`, `dr`.`driver_name`, `v`.`platenumber`, `cd`.`card_color`, `c`.`cashier_name`, `d`.`destination_name` ORDER BY `tp`.`travel_date` DESC, `tp`.`departure_time` DESC, `d`.`destination_name` ASC ;

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
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`),
  ADD KEY `fk_destinations_routes` (`route_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `passenger_destination`
--
ALTER TABLE `passenger_destination`
  ADD PRIMARY KEY (`passenger_destination_id`),
  ADD KEY `travel_pass_id` (`travel_pass_id`),
  ADD KEY `route_id` (`destination_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `travel_pass`
--
ALTER TABLE `travel_pass`
  ADD PRIMARY KEY (`travel_pass_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `cashier_id` (`cashier_id`),
  ADD KEY `card_id` (`card_id`),
  ADD KEY `fk_travel_pass_routes` (`route_id`);

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
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cashier`
--
ALTER TABLE `cashier`
  MODIFY `cashier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `passenger_destination`
--
ALTER TABLE `passenger_destination`
  MODIFY `passenger_destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=615;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `travel_pass`
--
ALTER TABLE `travel_pass`
  MODIFY `travel_pass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `fk_destinations_routes` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passenger_destination`
--
ALTER TABLE `passenger_destination`
  ADD CONSTRAINT `passenger_destination_ibfk_1` FOREIGN KEY (`travel_pass_id`) REFERENCES `travel_pass` (`travel_pass_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `passenger_destination_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destination_id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_pass`
--
ALTER TABLE `travel_pass`
  ADD CONSTRAINT `fk_travel_pass_routes` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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

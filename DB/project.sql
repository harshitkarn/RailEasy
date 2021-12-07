-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 07:27 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `show bookings` (IN `userid` INT)  NO SQL
select t.train_no,t.train_name,b.jrny_date,t.dep_time,t.from_stn,t.to_stn,b.seat_type from train_det t,bookings b where t.train_no=b.train_no and b.user_id = userid$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `user_id` int(11) NOT NULL,
  `train_no` int(11) NOT NULL,
  `jrny_date` date DEFAULT NULL,
  `seat_type` char(7) DEFAULT NULL
) ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`user_id`, `train_no`, `jrny_date`, `seat_type`) VALUES
(1, 12245, '2021-02-20', 'SL_cnfm'),
(1, 16523, '2021-02-02', 'SL_cnfm'),
(2, 12245, '2021-02-24', 'AC_cnfm'),
(4, 12910, '2021-02-15', 'SL_cnfm'),
(5, 11006, '2021-02-02', 'SL_cnfm');

--
-- Triggers `bookings`
--
DELIMITER $$
CREATE TRIGGER `updateseats` AFTER DELETE ON `bookings` FOR EACH ROW IF OLD.seat_type = 'AC_cnfm' THEN
	update seats_avail set AC_cnf=AC_cnf+1 where train_no=OLD.train_no;
ELSEIF OLD.seat_type = 'SL_cnfm' THEN
	update seats_avail set sleeper_cnf=sleeper_cnf+1 where train_no=OLD.train_no;
ELSEIF OLD.seat_type = 'AC_wait' THEN
	update seats_avail set AC_wait=AC_wait+1 where train_no=OLD.train_no;
ELSE
	update seats_avail set sleeper_wait=sleeper_wait+1 where train_no=OLD.train_no;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `seats_avail`
--

CREATE TABLE `seats_avail` (
  `train_no` int(11) NOT NULL,
  `sleeper_cnf` int(11) DEFAULT NULL,
  `sleeper_wait` int(11) DEFAULT NULL,
  `AC_cnf` int(11) DEFAULT NULL,
  `AC_wait` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seats_avail`
--

INSERT INTO `seats_avail` (`train_no`, `sleeper_cnf`, `sleeper_wait`, `AC_cnf`, `AC_wait`) VALUES
(11006, 9, 5, 10, 5),
(12245, 9, 5, 9, 5),
(12910, 9, 5, 10, 5),
(16523, 9, 5, 10, 5),
(19314, 10, 5, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `train_det`
--

CREATE TABLE `train_det` (
  `train_no` int(11) NOT NULL,
  `train_name` varchar(20) DEFAULT NULL,
  `dep_time` char(5) DEFAULT NULL,
  `arr_time` char(5) DEFAULT NULL,
  `from_stn` varchar(10) DEFAULT NULL,
  `to_stn` varchar(10) DEFAULT NULL,
  `jrny_dur` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train_det`
--

INSERT INTO `train_det` (`train_no`, `train_name`, `dep_time`, `arr_time`, `from_stn`, `to_stn`, `jrny_dur`) VALUES
(11006, 'Chalukya exp', '06:30', '06:35', 'Bangalore', 'Mumbai', '24:05'),
(12245, 'Duronto exp', '10:50', '16:20', 'Howrah', 'Bangalore', '29:30'),
(12910, 'Garib Rath', '15:35', '16:10', 'Delhi', 'Mumbai', '24:35'),
(16523, 'Humsafar exp', '13:55', '13:40', 'Bangalore', 'Delhi', '47:45'),
(19314, 'Indore exp', '11:10', '14:10', 'Patna', 'Indore', '27:00');

-- --------------------------------------------------------

--
-- Table structure for table `train_fare`
--

CREATE TABLE `train_fare` (
  `train_no` int(11) NOT NULL,
  `fare_sleeper` int(11) DEFAULT NULL,
  `fare_AC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train_fare`
--

INSERT INTO `train_fare` (`train_no`, `fare_sleeper`, `fare_AC`) VALUES
(11006, 580, 1510),
(12245, 790, 1820),
(12910, 567, 1455),
(16523, 900, 1977),
(19314, 640, 1727);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `pwd` varchar(20) DEFAULT NULL,
  `fname` varchar(10) DEFAULT NULL,
  `lname` varchar(10) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `city` varchar(15) DEFAULT NULL
) ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_name`, `pwd`, `fname`, `lname`, `gender`, `dob`, `mobile`, `address`, `city`) VALUES
(1, 'hk4602', 'harshit', 'harshit', 'karn', 'm', '1999-10-12', 9521246172, 'soldevanahalli', 'bangalore'),
(2, 'aswini21', 'aswini', 'Aswini', 'Verma', 'm', '1997-12-06', 7004787879, 'House no 27', 'Ranchi'),
(3, 'kush58', 'kushraj', 'Kush Raj', 'Singh', 'm', '2000-04-19', 7004622999, 'road no 21', 'Varanasi'),
(4, 'sri53', 'srinadh', 'Kotha', 'Srinadh', 'm', '1999-10-26', 7097616124, 'road no 16', 'Nellore'),
(5, 'saurabh11', 'saurabh', 'Saurabh', 'Kumar', 'm', '2000-09-14', 7878787111, 'S K Nagar', 'Patna'),
(7, 'hk3300', 'harshit', 'harshit', 'karn', 'm', '2000-10-12', 657667, 'jbshhj', 'bangalore');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`user_id`,`train_no`),
  ADD KEY `train_no` (`train_no`);

--
-- Indexes for table `seats_avail`
--
ALTER TABLE `seats_avail`
  ADD PRIMARY KEY (`train_no`);

--
-- Indexes for table `train_det`
--
ALTER TABLE `train_det`
  ADD PRIMARY KEY (`train_no`);

--
-- Indexes for table `train_fare`
--
ALTER TABLE `train_fare`
  ADD PRIMARY KEY (`train_no`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`train_no`) REFERENCES `train_det` (`train_no`) ON DELETE CASCADE;

--
-- Constraints for table `seats_avail`
--
ALTER TABLE `seats_avail`
  ADD CONSTRAINT `seats_avail_ibfk_1` FOREIGN KEY (`train_no`) REFERENCES `train_det` (`train_no`) ON DELETE CASCADE;

--
-- Constraints for table `train_fare`
--
ALTER TABLE `train_fare`
  ADD CONSTRAINT `train_fare_ibfk_1` FOREIGN KEY (`train_no`) REFERENCES `train_det` (`train_no`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

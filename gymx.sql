-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 12, 2024 at 03:37 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymx`
--

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

DROP TABLE IF EXISTS `coach`;
CREATE TABLE IF NOT EXISTS `coach` (
  `coachid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nic` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `rate` double NOT NULL,
  PRIMARY KEY (`coachid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`coachid`, `name`, `nic`, `phone`, `rate`) VALUES
(1, 'John Doe', '1234567890', '0112920566', 300),
(2, 'lexy', '12336874', '712920566', 320),
(3, 'Hana', '7254190', '07145366', 255),
(4, 'Gomes', '12345684', '7129223696', 400);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `inedx` int(100) NOT NULL AUTO_INCREMENT,
  `nic` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `inTime` varchar(11) NOT NULL,
  `outTime` varchar(11) NOT NULL,
  `trainer` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`inedx`),
  UNIQUE KEY `inedx` (`inedx`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`inedx`, `nic`, `name`, `number`, `start_date`, `inTime`, `outTime`, `trainer`, `email`) VALUES
(46, '2000715014000', 'M.A. Hashini Rashmika', '1111111112', '2024-02-11', '4pm', '5pm', 'Deshan', 'rashmikausj@gmail.com'),
(47, '2222222222222', 'nnnnnnnnnnnnn', '1111111111', '2024-02-09', '4pm', '5pm', 'Hana', 'saalqahtani@txwes.edu'),
(34, '222222222', 'ddddddddddddd', '4444444444', '2024-02-29', '4pm', '5pm', 'Akesh', 'mhrarashmika@gmail.com'),
(45, '2000715014000', 'rashmika', '1111111123', '2024-02-25', '4pm', '5pm', 'Akesh', 'mhrarashmika@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(50) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(20) NOT NULL,
  `acctype` varchar(20) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `password`, `acctype`) VALUES
('admin', 'saalqahtani@txwes.edu', '123', ''),
('', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2015 at 07:55 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `holiday`
--

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `holiday_id` int(3) NOT NULL AUTO_INCREMENT,
  `destination` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `seat` int(2) NOT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`holiday_id`, `destination`, `startDate`, `endDate`, `seat`) VALUES
(1, 'Greece', '2016-06-15', '2016-06-25', 23),
(2, 'Topolya', '2016-06-15', '2015-11-27', 8),
(3, 'Dubai', '2016-06-18', '2016-06-28', 37),
(4, 'Marocco', '2016-05-10', '2016-05-22', 28),
(5, 'Istanbul', '2016-07-05', '2016-07-15', 30);

-- --------------------------------------------------------

--
-- Table structure for table `travels`
--

CREATE TABLE IF NOT EXISTS `travels` (
  `travel_id` int(3) NOT NULL AUTO_INCREMENT,
  `holidayId` int(3) NOT NULL,
  `userId` int(3) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`travel_id`),
  KEY `holidayId` (`holidayId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `travels`
--

INSERT INTO `travels` (`travel_id`, `holidayId`, `userId`, `created`) VALUES
(1, 1, 2, '2015-12-07 19:52:16'),
(2, 4, 2, '2015-12-07 19:52:24'),
(3, 1, 1, '2015-12-07 19:53:11'),
(4, 3, 1, '2015-12-07 19:53:18'),
(5, 1, 3, '2015-12-07 19:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'Kicsi Virág', 'kicsivirag@mail.com', '0123456789', '$2y$10$0Rkxu57JN9H5qWpLneudJet3Serj.b35uDQOL10HBjyXGB4Yr59H6'),
(2, 'New User', 'new@newnew.new', '0123456789', '$2y$10$BklH5ZgQhi.sGuHZc/G8yOpjaNgq6ftewCoqqoE6LSXCW/5TGESZW'),
(3, 'Füles Pohár', 'fulespohar@mail.com', '0123456789', '$2y$10$kRwyEeAboQvwZeFV.zFt1OmkFLtub2XIY74NnMEbJmv/tNP6AgwIC');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `travels`
--
ALTER TABLE `travels`
  ADD CONSTRAINT `holidayId` FOREIGN KEY (`holidayId`) REFERENCES `holidays` (`holiday_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

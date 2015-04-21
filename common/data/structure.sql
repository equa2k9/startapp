-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2015 at 05:06 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `paratransit`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `login` int(11) DEFAULT NULL,
  `logout` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cashieringreceipt`
--

CREATE TABLE IF NOT EXISTS `cashieringreceipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `total` float NOT NULL,
  `initialfee_total` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cashieringreceipt_pay`
--

CREATE TABLE IF NOT EXISTS `cashieringreceipt_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cashieringreceipt_id` int(11) NOT NULL,
  `trips_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cashieringreceipt_id` (`cashieringreceipt_id`,`trips_id`),
  KEY `trips_id` (`trips_id`),
  KEY `cashieringreceipt_id_2` (`cashieringreceipt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients_rate`
--

CREATE TABLE IF NOT EXISTS `clients_rate` (
  `id` int(11) NOT NULL,
  `total_rate` int(11) NOT NULL DEFAULT '0',
  `total_mile` int(11) NOT NULL DEFAULT '0',
  `per_mile` int(11) NOT NULL DEFAULT '0',
  `ambulatory` int(11) NOT NULL DEFAULT '0',
  `wheelchair` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trips_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trip_id` (`trips_id`,`users_id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contractor`
--

CREATE TABLE IF NOT EXISTS `contractor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `drivers_files`
--

CREATE TABLE IF NOT EXISTS `drivers_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `drivers_info`
--

CREATE TABLE IF NOT EXISTS `drivers_info` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `company_adress` varchar(255) DEFAULT NULL,
  `company_years` int(11) DEFAULT NULL,
  `work_history` text,
  `supervisor_name` varchar(255) DEFAULT NULL,
  `supervisor_contact` varchar(255) DEFAULT NULL,
  `worked_from` int(11) DEFAULT NULL,
  `worked_to` int(11) DEFAULT NULL,
  `leaving_reason` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `vehicle` varchar(255) DEFAULT NULL,
  `dependent` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drivers_rate`
--

CREATE TABLE IF NOT EXISTS `drivers_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `rate` float DEFAULT NULL,
  `percentage` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `driver_id` (`users_id`,`client_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE IF NOT EXISTS `passengers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clients_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` int(11) DEFAULT NULL,
  `pickup_number` int(11) DEFAULT NULL,
  `dropoff_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_id` (`clients_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `routesheet`
--

CREATE TABLE IF NOT EXISTS `routesheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waybill_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `from_import` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `waybill_id` (`waybill_id`,`users_id`,`status_id`),
  KEY `users_id` (`users_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `routesheet_status`
--

CREATE TABLE IF NOT EXISTS `routesheet_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmptrip`
--

CREATE TABLE IF NOT EXISTS `tmptrip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trips_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trip_id` (`trips_id`),
  KEY `driver_id` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `routesheet_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `imported` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `routesheet_id` (`routesheet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trips_activity`
--

CREATE TABLE IF NOT EXISTS `trips_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trips_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `trips_passengers_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trips_id` (`trips_id`,`users_id`,`trips_passengers_id`,`status_id`,`time`),
  KEY `users_id` (`users_id`),
  KEY `trips_passenger_id` (`trips_passengers_id`),
  KEY `status_id` (`status_id`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trips_info`
--

CREATE TABLE IF NOT EXISTS `trips_info` (
  `id` int(11) NOT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `contractor_id` int(11) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `comment` text,
  `will_call` tinyint(4) DEFAULT '0',
  `from_import` tinyint(4) DEFAULT '0',
  `service_area` varchar(50) DEFAULT NULL,
  `fare` varchar(50) DEFAULT NULL,
  `confirmation_number` int(11) DEFAULT NULL,
  `exception_type` int(11) DEFAULT NULL,
  `provider_name` varchar(50) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `mid` varchar(50) DEFAULT NULL,
  `trip_leg_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contractor_id` (`contractor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trips_passengers`
--

CREATE TABLE IF NOT EXISTS `trips_passengers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trips_id` int(11) NOT NULL,
  `passengers_id` int(11) NOT NULL,
  `pickup_adress` varchar(255) NOT NULL,
  `dropoff_adress` varchar(255) NOT NULL,
  `pickup_time` int(11) NOT NULL,
  `dropoff_time` int(11) NOT NULL,
  `google_time` varchar(100) DEFAULT NULL,
  `google_sec` int(11) DEFAULT NULL,
  `dropoff_zipcode` int(11) DEFAULT NULL,
  `pickup_zipcode` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trips_id` (`trips_id`,`passengers_id`),
  KEY `passengers_id` (`passengers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trips_pay`
--

CREATE TABLE IF NOT EXISTS `trips_pay` (
  `id` int(11) NOT NULL,
  `driver_fee` float DEFAULT NULL,
  `payment_due` float DEFAULT NULL,
  `cc_copay` float DEFAULT NULL,
  `cash_copay` float DEFAULT NULL,
  `initial_fee` float DEFAULT NULL,
  `drop_rate` float DEFAULT NULL,
  `mileage_rate` float DEFAULT NULL,
  `deduction` float DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `adjusted_fee` float DEFAULT NULL,
  `notes_waybill` varchar(255) DEFAULT NULL,
  `trips_id` int(11) NOT NULL,
  `trips_passengers_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trips_id` (`trips_id`),
  KEY `trips_passengers_id` (`trips_passengers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trips_status`
--

CREATE TABLE IF NOT EXISTS `trips_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `hash_link` varchar(100) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `waybill`
--

CREATE TABLE IF NOT EXISTS `waybill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `routesheet_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `routesheet_id` (`routesheet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `user_activity` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cashieringreceipt`
--
ALTER TABLE `cashieringreceipt`
  ADD CONSTRAINT `useridcash` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cashieringreceipt_pay`
--
ALTER TABLE `cashieringreceipt_pay`
  ADD CONSTRAINT `cashieringreceiptid` FOREIGN KEY (`cashieringreceipt_id`) REFERENCES `cashieringreceipt` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tripsidpay` FOREIGN KEY (`trips_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clients_rate`
--
ALTER TABLE `clients_rate`
  ADD CONSTRAINT `client_rate` FOREIGN KEY (`id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `trips_id` FOREIGN KEY (`trips_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_comments` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drivers_files`
--
ALTER TABLE `drivers_files`
  ADD CONSTRAINT `driver_files` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drivers_info`
--
ALTER TABLE `drivers_info`
  ADD CONSTRAINT `driver_info` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drivers_rate`
--
ALTER TABLE `drivers_rate`
  ADD CONSTRAINT `client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `driver_rate` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `passengers` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `routesheet`
--
ALTER TABLE `routesheet`
  ADD CONSTRAINT `assigneddriver` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `status` FOREIGN KEY (`status_id`) REFERENCES `routesheet_status` (`id`);

--
-- Constraints for table `tmptrip`
--
ALTER TABLE `tmptrip`
  ADD CONSTRAINT `temptrip` FOREIGN KEY (`trips_id`) REFERENCES `trips` (`id`),
  ADD CONSTRAINT `userid` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `routesheet` FOREIGN KEY (`routesheet_id`) REFERENCES `routesheet` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trips_activity`
--
ALTER TABLE `trips_activity`
  ADD CONSTRAINT `tripforpassengeractivity` FOREIGN KEY (`trips_passengers_id`) REFERENCES `trips_passengers` (`id`),
  ADD CONSTRAINT `tripsactivity` FOREIGN KEY (`trips_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tripsstatus` FOREIGN KEY (`status_id`) REFERENCES `trips_status` (`id`),
  ADD CONSTRAINT `useractivity` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trips_info`
--
ALTER TABLE `trips_info`
  ADD CONSTRAINT `contractorid` FOREIGN KEY (`contractor_id`) REFERENCES `contractor` (`id`),
  ADD CONSTRAINT `tripid` FOREIGN KEY (`id`) REFERENCES `trips` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trips_passengers`
--
ALTER TABLE `trips_passengers`
  ADD CONSTRAINT `passengertrip` FOREIGN KEY (`passengers_id`) REFERENCES `passengers` (`id`),
  ADD CONSTRAINT `tripspassenger` FOREIGN KEY (`trips_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trips_pay`
--
ALTER TABLE `trips_pay`
  ADD CONSTRAINT `tripspays` FOREIGN KEY (`trips_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tripspaypassenger` FOREIGN KEY (`trips_passengers_id`) REFERENCES `trips_passengers` (`id`);

--
-- Constraints for table `waybill`
--
ALTER TABLE `waybill`
  ADD CONSTRAINT `routesheetid` FOREIGN KEY (`routesheet_id`) REFERENCES `routesheet` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

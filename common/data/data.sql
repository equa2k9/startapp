-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2015 at 06:18 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `starting`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `skype` varchar(25) DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `password_hash`, `role`, `email`, `photo`, `phone`, `skype`, `is_activated`) VALUES
(39, 'Oles', '54c5ZHMTSNCxE', '549419dc77f962.27376769', 'administrator', 'jek3211@gmail.com', 'images/profile/hVVaY_kWvA0.jpg', '2235', 'equa2k9', 1),
(44, 'lord', '54jlOIaXSYA1.', '54b51a575a6160.90390246', 'administrator', 'lordofarms2014@gmail.com', 'images/profile/hqdefault.jpg', '+380501817852', NULL, 1),
(45, 'ghost_and', '54jlOIaXSYA1.', '54b59df1704209.86996435', 'administrator', 'loedofguns@gmail.com', 'images/profile/xNCZ4VFZ2fI.jpg', NULL, NULL, 1),
(46, 'Віталій', '54ALaUAm3ddnw', '54d11a980007b7.99745942', 'user', 'popalsa.korish@yandex.ru', 'images/profile/389970-2560x1600.jpg', NULL, NULL, 0),
(47, 'Olesyatuna', '54c5ZHMTSNCxE', '54fdf720d51025.82880189', 'administrator', 'equalizer@i.ua', 'images/profile/Знімок екрана з 2015-03-04 17:40:11.png', NULL, NULL, 1),
(48, 'Equa2', '55M7tstq0ibpg', '552e7a5d2dbc59.20499968', 'user', 'equalizer2@i.ua', '123.jpg', NULL, NULL, 0),
(49, 'Equa22', '55M7tstq0ibpg', '552e7ae31f0786.44128483', 'user', 'equalizer3@i.ua', '123.jpg', NULL, NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

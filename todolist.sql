-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 05, 2018 at 02:42 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `body` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=496 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `body`, `status`, `created`, `user_id`) VALUES
(483, 'd', 0, NULL, 93),
(493, 'df', 0, NULL, 93),
(464, 'df', 0, NULL, 97),
(484, 'admin notes', 0, NULL, 93),
(494, 'f', 0, NULL, 93),
(495, 'df', 0, NULL, 93);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(30) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `created`) VALUES
(93, 'admin', NULL, '$2y$10$5U0lHtoKdLWT5EhYL8tPh.JTBlrocxW.Dpd3cqYkJr7LxXnmXmvDq', NULL, NULL),
(94, 'manos', NULL, '$2y$10$qHPZrr/6C3fF7Z/iQRNsJO.753sjZ8PATYc0W7e6WOlY/QT2.hnlO', NULL, NULL),
(95, 'new user', NULL, '$2y$10$2KrWViFPe3JgE03KVpezmOzaKtkiDf4SvMe7T/.uJszczLbysmY8.', NULL, NULL),
(96, 'admin942', NULL, '$2y$10$Bu7smz45gnLXCPibeXvhmuoU5URoLkrE7WFqHdOow/bqE2azAyyFm', NULL, NULL),
(97, 'admin2', NULL, '$2y$10$di5bOqRSWqDRkpf1QnkWXufaS6N1DFs30JdzOzfutdZMSE129yesi', NULL, NULL),
(98, 'tester', NULL, '$2y$10$CGc9zvGCmMhLUlBMg4gHhewU/7qeg1UBHX5KdqfJphc8D.A1JNpKi', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

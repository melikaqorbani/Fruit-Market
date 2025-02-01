-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2025 at 05:09 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruit_market`
--

-- --------------------------------------------------------

--
-- Table structure for table `fruit_requests`
--

DROP TABLE IF EXISTS `fruit_requests`;
CREATE TABLE IF NOT EXISTS `fruit_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `fruit_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `fruit_requests`
--

INSERT INTO `fruit_requests` (`id`, `user_id`, `fruit_name`, `amount`, `deadline`) VALUES
(39, 12, 'aa', 20, '2024-08-01 08:57:00'),
(31, 12, 'انگور', 20, '2024-07-06 07:40:00'),
(52, 12, 'آواکادو', 100, '2025-01-31 14:21:00'),
(38, 12, 'سیب', 10, '2024-08-09 08:03:00'),
(41, 12, 'cc', 45, '2024-08-08 08:57:00'),
(42, 12, 'dd', 42, '2024-08-01 08:58:00'),
(51, 12, 'انگور', 50, '2025-01-29 14:20:00'),
(45, 12, 'll', 100, '2024-08-09 09:01:00'),
(46, 12, 'jj', 10, '2024-08-08 09:02:00'),
(47, 12, 'پرتقال2', 10, '2024-08-21 13:09:00'),
(50, 12, 'پرتقال', 50, '2025-01-22 23:06:00'),
(53, 12, 'انار', 60, '2025-01-30 20:12:00'),
(54, 12, 'هندوانه', 10, '2025-01-30 01:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE IF NOT EXISTS `offers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_id` int DEFAULT NULL,
  `seller_id` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `accepted` tinyint(1) DEFAULT '0',
  `accepted_at` datetime DEFAULT NULL,
  `sent` tinyint(1) DEFAULT '0',
  `sent_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `request_id`, `seller_id`, `price`, `created_at`, `accepted`, `accepted_at`, `sent`, `sent_at`) VALUES
(50, 37, 11, 120000.00, '2024-07-19 08:02:15', 1, '2024-07-19 08:02:28', 1, '2025-01-05 11:05:56'),
(51, 36, 11, 125000.00, '2024-07-19 08:13:54', 0, NULL, 0, NULL),
(52, 33, 11, 20000.00, '2024-07-19 08:13:59', 0, NULL, 0, NULL),
(53, 38, 11, 20000.00, '2024-07-19 08:14:21', 0, NULL, 0, NULL),
(54, 36, 13, 14444.00, '2024-07-19 08:14:59', 0, NULL, 0, NULL),
(55, 33, 13, 999999.00, '2024-07-19 08:15:03', 0, NULL, 0, NULL),
(56, 37, 13, 2222.00, '2024-07-19 08:15:07', 0, NULL, 0, NULL),
(57, 38, 13, 99999999.99, '2024-07-19 08:15:12', 1, '2024-07-19 08:15:38', 1, '2025-01-05 11:09:24'),
(58, 39, 11, 10000.00, '2024-07-20 08:59:08', 1, '2024-07-20 09:06:00', 1, '2024-07-20 09:06:43'),
(59, 40, 11, 20000.00, '2024-07-20 08:59:16', 0, NULL, 0, NULL),
(60, 42, 11, 120000.00, '2024-07-20 08:59:22', 0, NULL, 0, NULL),
(61, 41, 11, 30000.00, '2024-07-20 08:59:28', 1, '2024-07-20 09:09:17', 1, '2024-07-20 10:17:44'),
(62, 43, 11, 40000.00, '2024-07-20 08:59:32', 0, NULL, 0, NULL),
(63, 39, 13, 200000.00, '2024-07-20 08:59:49', 0, NULL, 0, NULL),
(64, 40, 13, 120000.00, '2024-07-20 08:59:58', 1, '2024-07-20 09:13:25', 0, NULL),
(65, 41, 13, 230000.00, '2024-07-20 09:00:03', 0, NULL, 0, NULL),
(66, 42, 13, 450000.00, '2024-07-20 09:00:09', 1, '2024-07-20 09:00:26', 1, '2025-01-05 11:09:18'),
(67, 43, 13, 500000.00, '2024-07-20 09:00:14', 1, '2024-07-20 09:01:29', 0, NULL),
(68, 44, 11, 5000000.00, '2024-07-20 09:07:05', 1, '2024-07-20 09:07:38', 0, NULL),
(69, 46, 11, 1000000.00, '2024-07-20 10:12:12', 1, '2024-07-20 10:15:05', 1, '2025-01-05 14:22:01'),
(70, 47, 11, 1450.00, '2024-07-20 10:12:18', 0, NULL, 0, NULL),
(71, 45, 11, 100000.00, '2024-07-20 10:18:05', 0, NULL, 0, NULL),
(72, 49, 11, 5600000.00, '2025-01-05 11:07:14', 1, '2025-01-05 11:07:42', 1, '2025-01-05 11:36:30'),
(73, 50, 11, 25640000.00, '2025-01-05 11:07:22', 0, NULL, 0, NULL),
(74, 50, 13, 55500000.00, '2025-01-05 11:09:11', 1, '2025-01-05 11:10:01', 1, '2025-01-05 11:10:25'),
(75, 51, 11, 6000000.00, '2025-01-05 14:22:18', 0, NULL, 0, NULL),
(76, 52, 11, 99999999.99, '2025-01-05 14:22:27', 0, NULL, 0, NULL),
(77, 52, 13, 99999999.99, '2025-01-05 14:22:48', 1, '2025-01-05 14:23:39', 0, NULL),
(78, 51, 13, 540000.00, '2025-01-05 14:22:55', 1, '2025-01-05 14:23:47', 1, '2025-01-05 20:10:02'),
(79, 53, 11, 250000.00, '2025-01-05 20:09:19', 1, '2025-01-05 20:10:52', 1, '2025-01-05 20:11:20'),
(80, 53, 13, 360000.00, '2025-01-05 20:10:16', 0, NULL, 0, NULL),
(81, 54, 11, 25000.00, '2025-01-05 20:22:14', 1, '2025-01-05 20:23:10', 1, '2025-01-05 20:23:56'),
(82, 54, 13, 120000.00, '2025-01-05 20:22:44', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `user_type` enum('buyer','seller') CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `user_type`) VALUES
(13, 'seller2@seller.com', '$2y$10$Wy9VQVKLqmuR31yHR6gzd.dVdjYj6i/CX0Mgf9wth6qlDRO/7.Yr.', 'seller'),
(12, 'Buyer@Buyer.com', '$2y$10$41fthNj6zJNZldpdJrV9F.tJQAtYMiO3l29qKzDbBvSkzx8hpKcAq', 'buyer'),
(11, 'seller@seller.com', '$2y$10$fpoDw/TXX/4GAOQvLqvDA.7Kz3S5BpfiQUJ9fQdr.XICthKcs6CjS', 'seller');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

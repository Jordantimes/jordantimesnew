-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2021 at 09:31 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jordantimes`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(1) DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `title`) VALUES
(1, 'Amman'),
(2, 'Ajloun'),
(3, 'AL- Balqaa'),
(4, 'Dead Sea'),
(5, 'Irbid'),
(6, 'Jarash'),
(7, 'AL- Karak'),
(8, 'Maadaba '),
(9, 'AL- Tafila'),
(10, 'Wadi rum'),
(11, 'petra');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(5) NOT NULL,
  `num` int(4) DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptions` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `locations` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statuses` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `num`, `title`, `descriptions`, `images`, `price`, `locations`, `statuses`) VALUES
(35, 0, '112', '3 stars hotel', 'petra-palace.jpg', 20, 'wadi mousa', 0),
(42, 0, '112', ' 3 stars\r\n50% discount', 'petra-palace.jpg', 50, 'wadi mousa', 0),
(44, 0, '112', '3 stars', 'petra-palace.jpg', 20, 'wadi mousa', 0),
(45, 0, '112', '3 stars', 'petra-palace.jpg', 20, 'wadi mousa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `company_ID` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  `CreatedAt` date DEFAULT NULL,
  `UpdatedAt` date DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_ID`, `name`, `email`, `phone`, `password`, `role`, `verified`, `CreatedAt`, `UpdatedAt`, `isDeleted`) VALUES
(25, '', 'MOTA', 'gov@gmail.com', '', '*CB75CF4C0C381D6E5A85650F0C50D90C28452D5A', 'gov', NULL, NULL, NULL, 0),
(75, 'SK-3128', 'haya', 'haya_jo@mail.com', '0795651231', '$2y$10$Vkr0NUU8QcGJsNUZsOMsJOACb4f0PTej9QbK4q.Ah9h30iPUsazzm', 'company', 0, '2021-09-16', '2021-09-16', 0),
(76, 'SK-2642', 'dallas', 'dallas@mail.com', '07784514150', '$2y$10$6CsY.36kEA6XD8x1gzfYyeCLoUKyoqtA6BvH3RAdCmsya1ZFNhMsm', 'company', 0, '2021-09-16', '2021-09-16', 0),
(77, 'PK-8275', 'royal tourism', 'royaltourjo@mail.com', '0791254156', '$2y$10$sania3/pUMPxxyq/TZI8/.ObQSyblNJGTfaPDmofgUP1oGD/gYOwy', 'company', 0, '2021-09-16', '2021-09-16', 0),
(78, NULL, 'omar', 'omar@mail.com', '079424165', '$2y$10$PlCvlgrBQ5ZMmZuA7RaUxu67NYicxAlAXet0AHELMxu7lTtR/.9Aq', 'customer', 0, '2021-09-16', '2021-09-16', 0),
(79, 'XZ-3997', 'jordan select tours', 'info@select.jo', '+962 6 59305', '$2y$10$BnIa94pmcWdlz9S37W9SguV2O.CIRO3IG1Gy1m.B2xzFtWLY2zRA6', 'company', 0, '2021-09-16', '2021-09-16', 0),
(80, 'IB-2617', 'retal tours', 'travebest.tours@gmail.com', '048189933', '$2y$10$qPaY0EhOLKAuwGAOj1BO/O3tSmvM75paBA3oKzXTXY3Op4SfTRQVe', 'company', 0, '2021-09-17', '2021-09-17', 0),
(81, NULL, 'karam', 'karam_obida@yahoo.com', '0564561521', '$2y$10$CJlcyctKCOGuhS.CEPwOjeJDVQkJ9VQgct5TvU8ADO.nLEtn2QsmW', 'customer', 1, '2021-09-18', '2021-09-19', 0),
(82, 'TX-7291', 'golden jubile', 'info@gjtravel.com', '00962 6 4617', '$2y$10$AxcOFBlh63ZsOPHPOc7QXe5FIPUYdGvvC0lmYKL0WpdH3YMKowYie', 'company', 0, '2021-09-18', '2021-09-18', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

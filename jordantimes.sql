-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2021 at 06:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

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
  `title` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `title` varchar(25) DEFAULT NULL,
  `descriptions` varchar(100) DEFAULT NULL,
  `images` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `locations` varchar(100) DEFAULT NULL,
  `statuses` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `comp_id` varchar(25) DEFAULT NULL,
  `names` varchar(25) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `passwords` varchar(42) DEFAULT NULL,
  `roles` varchar(25) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `comp_id`, `names`, `email`, `phone`, `passwords`, `roles`, `verified`) VALUES
(15, 'AZ-2000', 'Dallas', 'Dallas@gmail.com', '0798095012', '*0FFF46B2299E968D2AFCA4DF55B7B9E35697ECFE', 'company', 0),
(25, '', 'MOTA', 'gov@gmail.com', '', '*CB75CF4C0C381D6E5A85650F0C50D90C28452D5A', 'gov', 0),
(26, 'AZ-2005', 'Holiday', 'holi@gmail.com', '0798087070', '*DCBA2403610CDA2D970C5804A9DC06C46D76F2DB', 'company', 0),
(27, 'AZ-2005', 'Tjarob', 'tjarob@gmail.com', '0788095012', '*4E17347BC4D9AC470D2DD531B6B0577301981B74', 'company', 0),
(29, 'AZ-4000', 'tourme', 'tourme@gmail.com', '0789099090', '*070DE781D827C0104BE5CDBE8C2002C5719BBAFC', 'company', 0),
(32, 'AZ-4000', 'tourmenow', 'tourme@gmail.com', '0789099090', '*6D3ADAE07C4EA4002F5B5C2A77602B8371D75B34', 'company', 0);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

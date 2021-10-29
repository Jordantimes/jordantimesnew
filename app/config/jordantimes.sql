-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2021 at 09:12 PM
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
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(25) NOT NULL,
  `userid` int(25) DEFAULT NULL,
  `head` varchar(128) DEFAULT NULL,
  `body` varchar(256) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `seen` tinyint(1) DEFAULT 0,
  `CreatedAt` date DEFAULT NULL,
  `UpdatedAt` date DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `userid`, `head`, `body`, `role`, `seen`, `CreatedAt`, `UpdatedAt`, `isDeleted`) VALUES
(4, 25, 'New sign up', 'Zaman Toursdmc has signed up.', 'government', 0, '2021-09-28', '2021-10-05', 0),
(6, 25, 'New sign up', 'Lameece Tours has signed up.', 'government', 1, '2021-09-29', '2021-10-05', 0),
(7, 25, 'New sign up', 'Visitjordan has signed up.', 'government', 0, '2021-10-01', '2021-10-06', 1),
(9, 25, 'New sign up', 'Visitjordan has signed up.', 'government', 0, '2021-10-06', '2021-10-06', 0),
(10, 25, 'New sign up', 'Visitjordan has signed up.', 'government', 0, '2021-10-06', '2021-10-06', 1),
(11, 25, 'New sign up', 'Visitjordan has signed up.', 'government', 0, '2021-10-06', '2021-10-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(32) NOT NULL,
  `company` int(32) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `name_ar` varchar(256) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `days` int(4) DEFAULT NULL,
  `nights` int(4) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `description_ar` varchar(1024) DEFAULT NULL,
  `breakfast` smallint(1) DEFAULT NULL,
  `breakfast_price` int(4) DEFAULT NULL,
  `lunch` smallint(1) DEFAULT NULL,
  `lunch_price` int(4) DEFAULT NULL,
  `dinner` smallint(1) DEFAULT NULL,
  `dinner_price` int(4) DEFAULT NULL,
  `images` varchar(1024) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `company`, `name`, `name_ar`, `start_date`, `end_date`, `days`, `nights`, `description`, `description_ar`, `breakfast`, `breakfast_price`, `lunch`, `lunch_price`, `dinner`, `dinner_price`, `images`, `created_at`, `updated_at`, `is_deleted`) VALUES
(3, 133, 'Amman - Ajloun - Al Tafele - Al Karak - Aqaba', 'عمان - عجلون - الطفيلة - الكرك - العقبة', '2021-11-04', '2021-11-12', 8, 7, 'test', 'تجربة', 1, 15, 1, 35, 1, 20, '617c43b5a0a6a5.11288368.jpg,617c43b5a1ca08.05706826.jpg,617c43b5a2f7f5.85004364.jpg,617c43b5a415e2.22503196.jpg,617c43b5a52231.10328131.jpg', '2021-10-29', '2021-10-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(25) NOT NULL,
  `company_ID` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_Number` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `users` (`id`, `company_ID`, `company_Number`, `image`, `name`, `email`, `phone`, `bio`, `password`, `role`, `verified`, `CreatedAt`, `UpdatedAt`, `isDeleted`) VALUES
(25, NULL, NULL, NULL, 'MOTA', 'gov@gmail.com', NULL, NULL, '$2y$10$FVKjSTcVAxGhSoXyM6DOv.UmGCc2d8.G6DWdmKP8/6Bb9E5pk/3fq', 'government', 1, NULL, NULL, 0),
(77, 'PK-8275', '87967851', 'bus.png', 'royal tourism', 'royaltourjo@mail.com', '0791254156', NULL, '$2y$10$sania3/pUMPxxyq/TZI8/.ObQSyblNJGTfaPDmofgUP1oGD/gYOwy', 'company', 0, '2021-09-16', '2021-10-05', 0),
(78, NULL, NULL, NULL, 'omar', 'omar@mail.com', '079424165', NULL, '$2y$10$PlCvlgrBQ5ZMmZuA7RaUxu67NYicxAlAXet0AHELMxu7lTtR/.9Aq', 'customer', 0, '2021-09-16', '2021-09-16', 0),
(79, 'XZ-3997', '923794782', 'bus.png', 'jordan select tours', 'info@select.jo', '+962 6 59305', NULL, '$2y$10$BnIa94pmcWdlz9S37W9SguV2O.CIRO3IG1Gy1m.B2xzFtWLY2zRA6', 'company', 0, '2021-09-16', '2021-10-04', 0),
(80, 'IB-2617', '1451160', 'bus.png', 'retal tours', 'travebest.tours@gmail.com', '048189933', NULL, '$2y$10$qPaY0EhOLKAuwGAOj1BO/O3tSmvM75paBA3oKzXTXY3Op4SfTRQVe', 'company', 0, '2021-09-17', '2021-10-04', 0),
(82, 'TX-7291', '2619840', 'bus.png', 'golden jubile', 'info@gjtravel.com', '00962 6 4617', NULL, '$2y$10$AxcOFBlh63ZsOPHPOc7QXe5FIPUYdGvvC0lmYKL0WpdH3YMKowYie', 'company', 0, '2021-09-18', '2021-09-24', 0),
(109, NULL, NULL, NULL, 'Karam', 'karam_obida@yahoo.com', '07254725', NULL, '$2y$10$WMikD5FB0qvgtoEzbzqg2e6yv1sHjrj8A8l6ZPXsh4m0.NVCbwfeC', 'customer', 1, '2021-09-23', '2021-09-30', 0),
(117, 'TR-3560', '56146516', 'bus.png', 'Dallas', 'dallas@mail.com', '07784514150', NULL, '$2y$10$FVKjSTcVAxGhSoXyM6DOv.UmGCc2d8.G6DWdmKP8/6Bb9E5pk/3fq', 'company', 0, '2021-09-24', '2021-10-04', 0),
(118, 'IJ-7210', '214324234', 'bus.png', 'Petra Tours', 'info@pttco.com', '124234234', NULL, '$2y$10$WLAgEvRVsEY8xh3UyhgtlO.iodR.7gCh7mvhQIEW0BZb1EjlH5F46', 'company', 0, '2021-09-24', '2021-09-24', 0),
(119, 'YS-8071', '456467856', 'bus.png', 'Enjoy-jordan', 'info@enjoy-jordan.com', '354645645', NULL, '$2y$10$1Tv6RCbq/18Btt692N6pjOWkTNs5A5amjo7ouiV1gkziR4X1Oztaa', 'company', 0, '2021-09-24', '2021-09-24', 0),
(121, 'NR-1473', '234234234', '615dea0506b8b7.87148516.png', 'Jordan And Beyond', 'info@jordanandbeyond.com', '0791234000', 'Jordan & Beyond Tours is a dynamic E-Commerce Tour Operator with passion to serve guests of Jordan, the experiences of our staff extend for more than 15 years at least in tourism business in the Middle East. We are based in Amman – Jordan, specializing in high quality FITs and GITs businesses, we cater needs of group tours, intrepid groups, leisure, religious, cultural, special interests, MICE and more, also providing tourists with quality accommodation, hotels, resorts, visas, entry tickets, transports, guides & more.\r\n\r\nWe are committed to providing our clients with the best products, highest standards of services and lowest possible prices, yet not compromising on quality. We are constantly looking to enhance and expand our products range, and always happy to tailor-make itineraries to our customers needs & special interests. Knowing the needs and wants of global markets and able to convert them into reality in our destination. We - at J&B - invite you to take a closer look into our products and services, looking forward to being at your service soon.', '$2y$10$61Crhsszhj1zgArnvuI6IuMb7KWCtkPLh/Yyu.R0r7hah2XGQltj2', 'company', 1, '2021-09-24', '2021-10-11', 0),
(122, 'ZV-8471', '867465634', 'bus.png', 'Jordan Mw Tours', 'info@jordanmw.com', '0784565352', NULL, '$2y$10$6D9QxiPKqv3HX7jM0A53s.Kkn5dAJ2oyiY4jsCOMc9AJA7SaSaWlS', 'company', 0, '2021-09-24', '2021-09-24', 0),
(123, 'DZ-2201', '365165154', 'bus.png', 'Haya', 'haya_jo@mail.com', '0794515616', NULL, '$2y$10$6OSKTf0Inoe/hFt4JEWDLODWINM.U01TEW4AkFIWd7AeOq4y.DeEK', 'company', 0, '2021-09-29', '2021-09-30', 0),
(127, 'KX-2047', '54613125', 'bus.png', 'Zaman Toursdmc', 'info@zamantours.com', '074513512', NULL, '$2y$10$4KZ.rUtLyPXxzjipjQ65Cu94oQc//bYMy1VCMVSJ3e0wUqepx5Edu', 'company', 0, '2021-09-29', '2021-09-30', 0),
(129, 'AE-9304', '256456756', 'bus.png', 'Lameece Tours', 'lameece@tours.com', '0165415615', NULL, '$2y$10$FfxOlPZ6Uks7LjC4rtL/se4Bfj67yn4NbVKnV8zIqkMgr8HHkfZG2', 'company', 0, '2021-09-29', '2021-09-29', 0),
(133, 'EX-3333', '465756742', '617bf9ee51a620.06772021.png', 'Adviser Travel Tours', 'reservation@advisertours.com', '0750005440', 'Adviser Travel & Tourism is a Destination Management Company that operates and offers all kinds of tourist services in The Middle East, Europe, Africa, Asia and America.\r\nAdviser´s team is made up of over 30 professionals of different nationalities who have extensive professional experience in the tourism sector.', '$2y$10$lRskYasZqnhRCTa9s3.Yke3VL/RhgTUovNu4IjNEzx4xRDCPPCwU6', 'company', 1, '2021-10-06', '2021-10-29', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`userid`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company` (`company`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_ibfk_1` FOREIGN KEY (`company`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

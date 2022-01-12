-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 07:18 PM
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
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `id` int(32) NOT NULL,
  `trip` int(32) DEFAULT NULL,
  `user` int(32) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `age` varchar(3) DEFAULT NULL,
  `nationID` varchar(16) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`id`, `trip`, `user`, `name`, `phone`, `age`, `nationID`, `created_at`, `updated_at`, `is_deleted`) VALUES
(9, 4, 109, 'omar hatem', '+962-07254725', '22', '02115656146', '2021-11-06', '2021-11-06', 0),
(10, 4, 109, 'karam', '+962-07254725', '22', '131315316514', '2021-11-06', '2021-11-06', 0);

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
(9, 25, 'New sign up', 'Visitjordan has signed up.', 'government', 0, '2021-10-06', '2021-12-28', 0),
(10, 25, 'New sign up', 'Visitjordan has signed up.', 'government', 0, '2021-10-06', '2021-10-06', 1),
(11, 25, 'New sign up', 'Visitjordan has signed up.', 'government', 0, '2021-10-06', '2021-10-06', 1),
(12, 25, 'New sign up', 'Test10 has signed up.', 'government', 0, '2021-11-04', '2021-11-06', 1),
(13, 25, 'New sign up', 'Asjkdaslkdnm has signed up.', 'government', 0, '2021-11-04', '2021-11-06', 1),
(14, 133, 'New customer has booked', 'omar hatem has booked in the Amman - Al Balqa - Al Karak - Aqaba trip with 2 passengers', 'company', 0, '2021-11-06', '2021-11-06', 0),
(15, 79, 'Account Notice', 'Your account as a company has been accepted, you can now create and post your trips.', 'company', 0, '2021-11-17', '2021-11-17', 0),
(54, 121, 'Trip accepted', 'The trip Ajloun - Al Mafraq was accepted by an admin.', 'company', 0, '2021-12-15', '2021-12-15', 0),
(55, 133, 'Trip declined', 'The trip Amman - Ajloun - Al Tafele - Al Karak - Aqaba was declined by an admin.', 'company', 0, '2021-12-15', '2021-12-15', 0),
(56, 133, 'Trip accepted', 'The trip Amman - Al Balqa - Al Karak - Aqaba was accepted by an admin.', 'company', 0, '2021-12-15', '2021-12-15', 0),
(57, 79, 'Trip declined', 'The trip Zarqa - Amman - Al Tafele was declined by an admin.', 'company', 0, '2021-12-15', '2021-12-15', 1),
(58, 123, 'Account Notice', 'Your account as a company has been accepted, you can now create and post your trips.', 'company', 0, '2021-12-28', '2021-12-28', 0),
(59, 25, 'New sign up', 'Lmao has signed up.', 'government', 0, '2021-12-31', '2021-12-31', 1),
(60, 141, 'Account Notice', 'Your account as a company has been accepted, you can now create and post your trips.', 'company', 0, '2021-12-31', '2021-12-31', 0),
(61, 133, 'Trip accepted', 'The trip Amman - Ajloun - Al Tafele - Al Karak - Aqaba was accepted by an admin.', 'company', 0, '2022-01-12', '2022-01-12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(32) NOT NULL,
  `company` int(32) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `name_ar` varchar(256) NOT NULL,
  `start_location` int(2) NOT NULL,
  `end_location` int(2) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `days` int(4) DEFAULT NULL,
  `nights` int(4) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `description_ar` varchar(1024) DEFAULT NULL,
  `price` int(4) NOT NULL,
  `breakfast` smallint(1) DEFAULT NULL,
  `breakfast_price` int(4) DEFAULT NULL,
  `lunch` smallint(1) DEFAULT NULL,
  `lunch_price` int(4) DEFAULT NULL,
  `dinner` smallint(1) DEFAULT NULL,
  `dinner_price` int(4) DEFAULT NULL,
  `images` varchar(1024) NOT NULL,
  `verified` smallint(1) NOT NULL DEFAULT 0,
  `is_hidden` smallint(1) NOT NULL DEFAULT 1,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `company`, `name`, `name_ar`, `start_location`, `end_location`, `start_date`, `end_date`, `days`, `nights`, `description`, `description_ar`, `price`, `breakfast`, `breakfast_price`, `lunch`, `lunch_price`, `dinner`, `dinner_price`, `images`, `verified`, `is_hidden`, `created_at`, `updated_at`, `is_deleted`) VALUES
(3, 133, 'Amman - Ajloun - Al Tafele - Al Karak - Aqaba', 'عمان - عجلون - الطفيلة - الكرك - العقبة', 1, 12, '2021-11-04', '2021-11-12', 8, 7, 'With a stay at The Amman Pasha Hotel in Amman (Downtown Amman), you\'ll be within a 5-minute walk of Amman Citadel and Amman Roman Theater. This spa hotel is 2.7 mi (4.3 km) from The Boulevard and 3.8 mi (6.2 km) from TAJ Mall. Relax at the full-service spa, where you can enjoy massages and body treatments. Additional features at this hotel include complimentary wireless Internet access, concierge services, and babysitting/childcare (surcharge). Getting to nearby attractions is a breeze with the area shuttle (surcharge). Make yourself at home in one of the 40 air-conditioned rooms featuring refrigerators and minibars. Your memory foam bed comes with Egyptian cotton sheets. 24-inch LCD televisions with satellite programming provide entertainment, while wireless Internet access (surcharge) keeps you connected. Private bathrooms have deep soaking bathtubs and hair dryers. ', 'تجربة', 78, 1, 15, 1, 35, 1, 20, '617c43b5a0a6a5.11288368.jpg,617c43b5a1ca08.05706826.jpg,617c43b5a2f7f5.85004364.jpg,617c43b5a415e2.22503196.jpg,617c43b5a52231.10328131.jpg', 1, 0, '2021-10-29', '2022-01-12', 0),
(4, 133, 'Amman - Al Balqa - Al Karak - Aqaba', 'عمان - البلقاء - الكرك - العقبة', 1, 12, '2021-11-04', '2021-11-09', 5, 5, 'A stay at Corp Amman Hotel places you in the heart of Amman, within a 5-minute drive of The Specialty Hospital and Al Abdali Mall. This 4.5-star hotel is 1.6 mi (2.5 km) from The Boulevard and 2.2 mi (3.6 km) from Amman Citadel. Pamper yourself with a visit to the spa, which offers massages and body treatments. You can take advantage of recreational amenities such as a sauna, a fitness center, and a seasonal outdoor pool. Additional features at this hotel include complimentary wireless Internet access, concierge services, and gift shops/newsstands. Make yourself at home in one of the 108 air-conditioned rooms featuring minibars and LCD televisions. Complimentary wireless Internet access keeps you connected, and cable programming is available for your entertainment. Private bathrooms with showers feature designer toiletries and bidets. Conveniences include phones, as well as safes and desks. ', 'تجربة', 65, 1, 12, 1, 20, 0, 0, '61811989caef15.75950044.jpg,61811989ca3da5.83310697.jpg,61811989ca7f23.87746252.jpg,61811989cab9e2.70008116.jpg,61811989ced4d9.98515973.jpg', 1, 0, '2021-11-02', '2022-01-12', 0),
(7, 121, 'Ajloun - Al Mafraq', 'عجلون - المفرق', 4, 7, '2021-11-11', '2021-11-13', 3, 2, 'Umm Qais or Qays (Arabic: أم قيس‎, lit. \'Mother of Qais\') is a town in northern Jordan principally known for its proximity to the ruins of the ancient Gadara. It is the largest city in the Bani Kinanah Department and Irbid Governorate in the extreme northwest of the country, near Jordan\'s borders with Israel and Syria. Today, the site is divided into three main areas: the archaeological site (Gadara), the traditional village (Umm Qais), and the modern town of Umm Qais.\n\nAjloun Castle (Arabic: قلعة عجلون‎; transliterated: Qalʻat \'Ajloun; also Qalʻat ar-Rabad), is a 12th-century Muslim castle situated in northwestern Jordan. It is placed on a hilltop belonging to the Mount Ajloun district, also known as Jabal \'Auf after a Bedouin tribe which had captured the area in the 12th century. From its high ground the castle was guarding three wadis which descend towards the Jordan Valley. It was built by the Ayyubids in the 12th century and enlarged by the Mamluks in the 13th. \n', 'أم قيس بلدة أردنية تقع في لواء بني كنانة التابع لمحافظة إربد شمال المملكة. تقع على بعد 28 كم شمال إربد على ارتفاع 364 م تطلع على نهر اليرموك وهضبة الجولان وبحيرة طبريا وقد كان لموقعها الاستراتيجي بالإضافة إلى وفرة مياها نقطة جذب للنشاط السكاني واسمها قديماً جدارا وتعني\"التحصينات\" أو \"المدينة المحصنة\" ومن أهم البقايا الأثرية: المدرج الغربي وشارع الأعمدة وكنيسة المقابر المزينة.\nقلعة عجلون وتسمى أيضاً قلعة الرَّبض وقلعة صلاح الدين هي قلعة تقع في عجلون، الأردن، على قمة جبل عوف (أو جبل بني عوف) المشرف على أودية كفرنجة و‌راجب واليابس. قام ببناءها القائد عز الدين أسامة أحد قادة صلاح الدين الأيوبي سنة 1184م (580 هجري) لتكون نقطة ارتكاز لحماية المنطقة والحفاظ على خطوط المواصلات وطرق الحج بين بلاد الشام والحجاز لإشرافها على وادي الأردن وتحكمها بالمنطقة الممتدة بين بحيرة طبريا والبحر الميت.', 30, 0, 0, 1, 12, 0, 0, '6181937c7b96f2.00203939.jpg,6181937c7be138.20803990.jpg,6181937c7c26c0.86483189.jpg,6181937c7c6ae2.03786382.jpg,6181937c7ca372.66286672.jpg,6181937c7cdba6.88052668.jpg,6181937c7d1468.94633448.jpg,6181937c7d4aa1.87972052.jpg,6181937c7d87d0.51791985.jpg,6181937c7dc051.15633633.jpg', 1, 0, '2021-11-02', '2022-01-12', 0),
(11, 79, 'Zarqa - Amman - Al Tafele', 'الزرقاء - عمان - الطفيلة', 2, 9, '2021-12-17', '2021-12-20', 4, 3, 'eksdee', '1234', 10, 0, 0, 0, 0, 0, 0, '61b9ffaeedb075.83033449.jpg', 0, 1, '2021-12-15', '2021-12-15', 1);

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
  `phone` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(25, NULL, NULL, NULL, 'MOTA', 'gov@gmail.com', NULL, NULL, '$2y$10$FVKjSTcVAxGhSoXyM6DOv.UmGCc2d8.G6DWdmKP8/6Bb9E5pk/3fq', 'government', 1, '2021-09-12', '2021-09-12', 0),
(77, 'PK-8275', '87967851', 'bus.png', 'royal tourism', 'royaltourjo@mail.com', '0791254156', NULL, '$2y$10$sania3/pUMPxxyq/TZI8/.ObQSyblNJGTfaPDmofgUP1oGD/gYOwy', 'company', 0, '2021-09-16', '2021-10-05', 0),
(78, NULL, NULL, NULL, 'omar', 'omar@mail.com', '079424165', NULL, '$2y$10$PlCvlgrBQ5ZMmZuA7RaUxu67NYicxAlAXet0AHELMxu7lTtR/.9Aq', 'customer', 0, '2021-09-16', '2021-09-16', 0),
(79, 'XZ-3997', '923794782', 'bus.png', 'jordan select tours', 'info@select.jo', '+962 6 59305', NULL, '$2y$10$BnIa94pmcWdlz9S37W9SguV2O.CIRO3IG1Gy1m.B2xzFtWLY2zRA6', 'company', 1, '2021-09-16', '2021-11-17', 0),
(80, 'IB-2617', '1451160', 'bus.png', 'retal tours', 'travebest.tours@gmail.com', '048189933', NULL, '$2y$10$qPaY0EhOLKAuwGAOj1BO/O3tSmvM75paBA3oKzXTXY3Op4SfTRQVe', 'company', 0, '2021-09-17', '2021-10-04', 0),
(82, 'TX-7291', '2619840', 'bus.png', 'golden jubile', 'info@gjtravel.com', '00962 6 4617', NULL, '$2y$10$AxcOFBlh63ZsOPHPOc7QXe5FIPUYdGvvC0lmYKL0WpdH3YMKowYie', 'company', 0, '2021-09-18', '2021-09-24', 0),
(109, NULL, NULL, NULL, 'Karam', 'karam_obida@yahoo.com', '07254725', NULL, '$2y$10$dq6/7ABfVFGCsN6SpyqdXu1KNq/32.bKRxqWLmRWB4yW/DnnY92Zi', 'customer', 1, '2021-09-23', '2021-12-16', 0),
(117, 'TR-3560', '56146516', 'bus.png', 'Dallas', 'dallas@mail.com', '07784514150', NULL, '$2y$10$FVKjSTcVAxGhSoXyM6DOv.UmGCc2d8.G6DWdmKP8/6Bb9E5pk/3fq', 'company', 0, '2021-09-24', '2021-10-04', 0),
(118, 'IJ-7210', '214324234', 'bus.png', 'Petra Tours', 'info@pttco.com', '124234234', NULL, '$2y$10$WLAgEvRVsEY8xh3UyhgtlO.iodR.7gCh7mvhQIEW0BZb1EjlH5F46', 'company', 0, '2021-09-24', '2021-09-24', 0),
(119, 'YS-8071', '456467856', 'bus.png', 'Enjoy-jordan', 'info@enjoy-jordan.com', '354645645', NULL, '$2y$10$1Tv6RCbq/18Btt692N6pjOWkTNs5A5amjo7ouiV1gkziR4X1Oztaa', 'company', 0, '2021-09-24', '2021-09-24', 0),
(121, 'NR-1473', '234234234', '615dea0506b8b7.87148516.png', 'Jordan And Beyond', 'info@jordanandbeyond.com', '0791234000', 'Jordan & Beyond Tours is a dynamic E-Commerce Tour Operator with passion to serve guests of Jordan, the experiences of our staff extend for more than 15 years at least in tourism business in the Middle East. We are based in Amman – Jordan, specializing in high quality FITs and GITs businesses, we cater needs of group tours, intrepid groups, leisure, religious, cultural, special interests, MICE and more, also providing tourists with quality accommodation, hotels, resorts, visas, entry tickets, transports, guides & more.\r\n\r\nWe are committed to providing our clients with the best products, highest standards of services and lowest possible prices, yet not compromising on quality. We are constantly looking to enhance and expand our products range, and always happy to tailor-make itineraries to our customers needs & special interests. Knowing the needs and wants of global markets and able to convert them into reality in our destination. We - at J&B - invite you to take a closer look into our products and services, looking forward to being at your service soon.', '$2y$10$61Crhsszhj1zgArnvuI6IuMb7KWCtkPLh/Yyu.R0r7hah2XGQltj2', 'company', 1, '2021-09-24', '2021-10-11', 0),
(122, 'ZV-8471', '867465634', 'bus.png', 'Jordan Mw Tours', 'info@jordanmw.com', '0784565352', NULL, '$2y$10$6D9QxiPKqv3HX7jM0A53s.Kkn5dAJ2oyiY4jsCOMc9AJA7SaSaWlS', 'company', 0, '2021-09-24', '2021-09-24', 0),
(123, 'DZ-2201', '365165154', 'bus.png', 'Haya', 'haya_jo@mail.com', '0794515616', NULL, '$2y$10$6OSKTf0Inoe/hFt4JEWDLODWINM.U01TEW4AkFIWd7AeOq4y.DeEK', 'company', 1, '2021-09-29', '2021-12-28', 0),
(127, 'KX-2047', '54613125', 'bus.png', 'Zaman Toursdmc', 'info@zamantours.com', '074513512', NULL, '$2y$10$4KZ.rUtLyPXxzjipjQ65Cu94oQc//bYMy1VCMVSJ3e0wUqepx5Edu', 'company', 0, '2021-09-29', '2021-09-30', 0),
(129, 'AE-9304', '256456756', 'bus.png', 'Lameece Tours', 'lameece@tours.com', '0165415615', NULL, '$2y$10$FfxOlPZ6Uks7LjC4rtL/se4Bfj67yn4NbVKnV8zIqkMgr8HHkfZG2', 'company', 0, '2021-09-29', '2021-09-29', 0),
(133, 'EX-3333', '465756742', '617bf9ee51a620.06772021.png', 'Adviser Travel Tours', 'reservation@advisertours.com', '0750005440', 'Adviser Travel & Tourism is a Destination Management Company that operates and offers all kinds of tourist services in The Middle East, Europe, Africa, Asia and America.\r\nAdviser´s team is made up of over 30 professionals of different nationalities who have extensive professional experience in the tourism sector.', '$2y$10$lRskYasZqnhRCTa9s3.Yke3VL/RhgTUovNu4IjNEzx4xRDCPPCwU6', 'company', 1, '2021-10-06', '2021-10-29', 0),
(140, NULL, NULL, NULL, 'Omar Hatem', 'admin@mail.com', '+962-165416114', NULL, '$2y$10$D7efTYAUQezg7rc1TyjSaunYGSwAD43sv586t22IKFSwU3NBl9lkq', 'admin', 1, '2021-12-14', '2021-12-14', 0),
(141, 'WP-6628', '156445415', 'bus.png', 'Lmao', 'hehe@micheljackson.com', '+962-546545646', NULL, '$2y$10$koTZ1zoW0wRtwoDznXhK1OyWLGxjkU5yPJdfDV4yLplDMASC07iyi', 'company', 1, '2021-12-31', '2021-12-31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip` (`trip`),
  ADD KEY `user` (`user`);

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
-- AUTO_INCREMENT for table `booked`
--
ALTER TABLE `booked`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booked`
--
ALTER TABLE `booked`
  ADD CONSTRAINT `booked_ibfk_1` FOREIGN KEY (`trip`) REFERENCES `trips` (`id`),
  ADD CONSTRAINT `booked_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

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

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 03:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kinder_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `gName` varchar(50) NOT NULL,
  `gEmail` varchar(100) NOT NULL,
  `cName` varchar(50) NOT NULL,
  `cAge` int(11) NOT NULL,
  `message` text NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `gName`, `gEmail`, `cName`, `cAge`, `message`, `regDate`) VALUES
(5, 'safaa', 'safaaAdmin@1234', 'hamzah', 4, 'Take care of my son', '2024-06-07 23:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `className` varchar(50) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `capacity` int(11) NOT NULL,
  `ageFrom` int(2) NOT NULL,
  `ageTo` int(2) NOT NULL,
  `timeFrom` time NOT NULL,
  `timeTo` time NOT NULL,
  `published` tinyint(1) NOT NULL,
  `image` varchar(100) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `className`, `teacher_id`, `price`, `capacity`, `ageFrom`, `ageTo`, `timeFrom`, `timeTo`, `published`, `image`, `regDate`) VALUES
(9, 'Art&Design', 13, 40022, 3, 4, 7, '06:19:00', '00:19:00', 1, 'bbf5340b6964935e59a2f391ce70d87f.jpeg', '2024-06-07 23:19:55'),
(10, 'Art For Children', 11, 40000, 8, 4, 11, '02:23:00', '07:23:00', 1, 'efeedf1b5e627785c5be9d16d5a8413f.jpeg', '2024-06-07 23:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `regDate`, `name`, `email`, `subject`, `message`) VALUES
(2, '2024-06-07 23:44:11', 'safaa magdy', 'safaaAdmin@1234', 'i need to book appointment', 'Thank You');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `delay` double NOT NULL,
  `color` varchar(30) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `discrption` text NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `delay`, `color`, `icon`, `title`, `discrption`, `regDate`) VALUES
(1, 0.1, 'primary', 'fa fa-bus-alt fa-3x text-primary', 'School Bus', 'random text', '2024-06-07 22:06:10'),
(2, 0.3, 'success', 'fa fa-futbol fa-3x text-success', 'Playground', 'texttexttexttexttexttexttexttext', '2024-06-07 22:06:10'),
(3, 0.5, 'warning', 'fa fa-home fa-3x text-warning', 'Healthy Canteen', 'random text2', '2024-06-07 22:09:04'),
(4, 0.7, 'info', 'fa fa-chalkboard-teacher fa-3x text-info', 'Positive Learning', 'texttexttexttexttexttexttexttext2', '2024-06-07 22:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `jopTitle` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `image` varchar(100) NOT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `linkedin` varchar(50) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fullName`, `jopTitle`, `published`, `image`, `facebook`, `twitter`, `linkedin`, `regDate`) VALUES
(11, 'Mr.Magdy Awad', 'English teacher', 1, 'bd78bee5654e06233011a71af8e8ca93.jpeg', NULL, NULL, NULL, '2024-06-07 23:16:45'),
(13, 'Mrss.Samira', 'Content Creator', 1, '257f5017844203605c9e4b10dac8347f.jpeg', NULL, NULL, NULL, '2024-06-07 23:18:43'),
(14, 'Mrss.Shokria', 'math', 1, 'cc2c4b882a093fb71008b9cdd23016fb.jpeg', NULL, NULL, NULL, '2024-06-07 23:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `jopTitle` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `published` tinyint(1) NOT NULL,
  `image` varchar(100) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `fullName`, `jopTitle`, `comment`, `published`, `image`, `regDate`) VALUES
(4, 'safaa magdy', 'Engineer', 'comment', 1, 'e4da67ccaadd5cd046a28c4fd66a5244.jpeg', '2024-06-07 23:47:29'),
(6, 'client', 'Electronics', 'com1232412', 1, '4895ef8290bf4eeb90bc122f9ad9be80.jpeg', '2024-06-07 23:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `userName`, `email`, `password`, `phone`, `active`, `regDate`) VALUES
(1, 'safaa magdy', 'SafaaMagdy', 'safaaAdmin@1234', '$2y$10$9ggeooveI.2bS6uB6BPruOiVifSischHcBGr32iNXzc0uiQ7ZEpea', '+201067605447', 1, '2024-06-05 20:19:45'),
(12, 'safaa magdy', 'sawww', 'safaaAdmin@12www34', '$2y$10$DqvLyF/L1G7E.3z7EUkA6e2oJg86BerTigSoxLsGASp2IlunKdkeW', '', 0, '2024-06-07 23:58:26'),
(13, 'q', 'q', 'q@q', '$2y$10$vq3cbEWEJpQCXIS3RjHaAeYR/lSqNFT5Tnra8xAsxywO4HfHb5a8y', '', 0, '2024-06-08 00:07:27'),
(14, 'some user', 'userName', 'e@e', '$2y$10$yedobAdtBiesRcVSyH2LhOeh/rEsjEyxnAbqcvR2E0YaxtYL9muLa', '', 0, '2024-06-08 00:52:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

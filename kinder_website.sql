-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 09:58 PM
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
(1, 'safaa', 'safaaAdmin@1234', 'hamzah', 4, 'take care of my son', '2024-06-06 17:35:25'),
(2, 'safaa', 'safaaAdmin@1234', 'hamzah', 4, 'take care of my son', '2024-06-06 17:36:38'),
(3, 'magdy', 'ds@11', 'mohammad', 6, 'message', '2024-06-06 17:37:48'),
(4, 'magdy', 'ds@11', 'mohammad', 6, 'message', '2024-06-06 17:50:30');

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
(5, 'Art', 6, 500, 12, 1, 5, '13:56:00', '17:59:00', 1, '8a04ad01cfb3089be0c2cc1e8b76df88.jpeg', '2024-06-06 18:56:49'),
(6, 'design', 5, 500, 8, 5, 12, '16:05:00', '22:06:00', 1, '8481bc618399c8258efdb8cf0279e4f9.jpeg', '2024-06-06 19:06:17');

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
(1, '2024-06-06 18:54:36', 'saddd', 'safaaAdmin@1234', 'i need to book appointment', 'dfdfcdfgddr');

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
(5, 'mr.sardina', 'Founder', 1, '3f812354d8bf17b9658f0e04bd70595f.jpeg', NULL, NULL, NULL, '2024-06-06 18:10:49'),
(6, 'mrs.ringa', 'math', 1, '2546d348a82813d1d83438927f66193a.jpeg', NULL, NULL, NULL, '2024-06-06 18:11:53');

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
(2, 'safaa', 'engineer', 'comment', 1, 'dd541637f1e0e1c3a6828d32757a980d.jpeg', '2024-06-06 19:53:21');

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
(2, 'Safaa Magdy Awad', 'SafaaMagdyas', 'scx@1', '$2y$10$fgcuSAmidY3h86Vcg3p6gOrkFIitm/1BbFO6Yl276nOOH7lESDnzm', '', 0, '2024-06-05 20:41:20'),
(3, 'ششش', 'شششش', 'dd@qqq', '$2y$10$M/jl2StpQcsGhq62t3Jt1uYCOmEBZ4xJgeLednhkh.aXODhSCTA5O', '', 0, '2024-06-05 21:02:59'),
(4, 'safaa magdysas', 'aSs', 'safaaAdmin@1234asAS', '$2y$10$WD30nxMpJpYTDR08kIHi0uAw54X11stbxEFSwkr9qMbsx4IXcvw..', '', 0, '2024-06-05 22:17:32'),
(5, 'j', 'j', 'j@1', '$2y$10$kyZWBuLvXepOKVr1L9dQ2.RXv8wn7DExCOfaDK0JZrc7Qw3Vh9S7a', '', 1, '2024-06-05 22:21:00'),
(6, 'a', 'a', 'a@s', '$2y$10$oPBnuN0KbBlTKe6K16kzy.oqIvrtsW3LrgHWq0l.6RHNwFSXX.yuS', '', 1, '2024-06-06 00:00:18'),
(7, 'user11', 'user123', 'n@111', '$2y$10$OhzcXHXBhSgWP9ML59GlpOGexJGBi3jWTOEEpP6Uhcc8NcXuBpSJC', '', 0, '2024-06-06 16:13:35'),
(8, 'ssz', 'ssz', 'ss@sz', '$2y$10$mDWxCKhtW1lYf/EIZP5zuO7tlPgvCFwRWmf.BxjECJpbWUHX9k4C.', '01067605447', 1, '2024-06-06 19:04:37'),
(9, 'safaa magdy', 'ZZ', 'safaaAdminzZz@1234', '$2y$10$xSpTWYCU1.9vVv9QNB4MsOCja8H0KnwkqftCV7k.sRtawhbi89chy', '+201067605447', 1, '2024-06-06 19:05:06');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 07:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `therapease`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_notification_status`
--

CREATE TABLE `user_notification_status` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notifications_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_notification_status`
--

INSERT INTO `user_notification_status` (`id`, `user_id`, `notifications_id`, `is_read`) VALUES
(60, 72, 22, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_notification_status`
--
ALTER TABLE `user_notification_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_notification_status_ibfk_1` (`user_id`),
  ADD KEY `user_notification_status_ibfk_2` (`notifications_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_notification_status`
--
ALTER TABLE `user_notification_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_notification_status`
--
ALTER TABLE `user_notification_status`
  ADD CONSTRAINT `user_notification_status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_notification_status_ibfk_2` FOREIGN KEY (`notifications_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

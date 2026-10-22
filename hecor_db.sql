-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2026 at 04:12 PM
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
-- Database: `hecor_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'hecor2025');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `device_type` varchar(50) NOT NULL,
  `issue_description` text NOT NULL,
  `preferred_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `full_name`, `phone`, `email`, `device_type`, `issue_description`, `preferred_date`, `status`, `created_at`) VALUES
(1, 'Enock Mokaya', '+254741009502', 'enockmokaya35@gmail.com', 'Printer Repair', 'It does not print shows two red alerts', '2025-10-25', 'Pending', '2025-10-25 13:49:03'),
(28, 'Orina', '+254734852216', '', 'Computer Repair', 'I want a screen repair.', '2025-11-05', 'Completed', '2025-11-05 17:18:27'),
(30, 'Sharlin Bonareri', '0785194428', '', 'Printer Repair', 'My scan has an issue after printing several papers.', '2025-11-06', 'Pending', '2025-11-06 17:23:13'),
(31, 'Caroline Masese', '0705167135', 'carolinemasese@gmail.com', 'Computer Repair', 'I want a keyboard change.', '2025-12-09', 'In-Progress', '2025-12-09 08:16:57'),
(32, 'Lydia Nyaboke', '0787654321', '', 'Computer Accessories', 'I need a display cable apart from VGA cable.', '2026-06-11', 'Pending', '2026-06-11 13:20:43'),
(33, 'Lydia Nyaboke', '0787654321', '', 'Computer Accessories', 'I need a display cable apart from VGA cable.', '2026-06-11', 'Pending', '2026-06-11 13:23:01'),
(34, 'Lydia Nyaboke', '0787654321', '', 'Computer Accessories', 'I need a display cable apart from VGA cable.', '2026-06-11', 'Pending', '2026-06-11 13:32:03'),
(35, 'Glen Onyari', '0702515030', 'amenya.glen@gmail.com', 'Computer Accessories', 'I need a display cable apart from VGA cable.', '2026-06-11', 'Pending', '2026-06-11 13:37:30'),
(36, 'Glen Onyari', '0702515030', 'amenya.glen@gmail.com', 'Computer Accessories', 'I need a display cable apart from HDMI cable.', '2026-06-11', 'Completed', '2026-06-11 13:45:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

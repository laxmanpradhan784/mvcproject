-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 01:26 PM
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
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(1, 'adsfghjkl', 'sdfghjk@gmail.com', '$2y$10$fElVcO/IoQ5Rz4D3HOBL7ehG5Cz6YQW6aklAc5wrsVySt5K15ODYi', '2024-09-30 06:38:25'),
(2, 'viki', 'viki@gmail.com', '$2y$10$4j90HKKdzTvbAIN.hioLFuKOcrw5/4N5Y70dbNrOOdHbZn6A2Z77S', '2024-09-30 06:39:15'),
(3, 'vasu', 'vasu@gmail.com', '$2y$10$W/HT7awEk2V6IP081AsuEe6qqk1xoA8nCrJ9WGmYT/lGf0YYhaU.q', '2024-09-30 07:29:32');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `status`, `title`) VALUES
(28, '../uploads/66fa5465a411f_4.jpg', 'active', 'xfghjk,'),
(29, '../uploads/66fa546b8387d_8.jpg', 'active', 'awsdfhgtjkl'),
(39, '../uploads/66fa701c4d970_14.jpg', 'active', 'huiop'),
(40, '../uploads/66fa715e87265_11.jpg', 'active', 'sdvfbgnhmj,k.'),
(41, '../uploads/66fa761f080a6_17.jpg', 'active', 'qwdefrg'),
(42, '../uploads/66fa762a4035c_10.jpg', 'active', 'sadfgrhjk'),
(49, '../uploads/66fa774c8bc46_2.jpg', 'active', 'cvbnjmk.l;'),
(50, '../uploads/66fa77b5abb4d_18.jpg', 'active', 'dfghjkl');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(4, 'vasu', 'vasu@gmail.com', '$2y$10$3pcP6WODVukbGYtdilQ/4eluvE6lF013bAr5wn8u3K55Wn7hPHJX6', '2024-09-26 10:07:48'),
(5, 'laxman', 'laxman@gmail.com', '$2y$10$30Bt/TXoMGUkaZxgWEESqOyOJTl6dRLg2u55H2gQB8WsdavYT9IKm', '2024-09-26 10:14:41'),
(6, 'ritesh', 'ritesh@gmail.com', '$2y$10$1HWXvTbbX/y40PImWpq4Y.ytHbdhmRB4ehHIh96eONmLv67lQ/0MW', '2024-09-26 10:29:40'),
(7, 'sumitt', 'sumit@gmail.com', '$2y$10$fbIgJQx2WOuNMcwRDzDLreZnpDUVoXaWbszbA3CcKOIBMOaqhCxCO', '2024-09-26 10:31:02'),
(8, 'viki', 'viki@gmail.com', '$2y$10$plNvNBiyqxWrs.R6Qi2JMOS9pu9B43RTQFn/LgwuasbC4mGoxdD2u', '2024-09-27 06:28:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

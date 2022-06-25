-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 06:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nutrition`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `role` varchar(10) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `bmr` float DEFAULT NULL,
  `bmi` float DEFAULT NULL,
  `cpd` float DEFAULT NULL,
  `about` varchar(250) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `dob`, `age`, `height`, `weight`, `gender`, `role`, `status`, `experience`, `level`, `address`, `bmr`, `bmi`, `cpd`, `about`, `created_at`, `updated_at`) VALUES
(39, 'arslan', 'arslan123@gmail.com', '$2y$10$0KI8MqLgxKs9DV1nTPXgy.PBB3yOp7rmmKxDqdg2Ec7Jq89o9iydK', '1999-12-29', 23, 170, 80, 'male', 'A', 'a', 10, 'M', NULL, 1861.8, 80, 2885.79, NULL, '2022-03-06', '2022-03-06'),
(41, 'Muhammad Arslan', 'arslan@gmail.com', '$2y$10$0KI8MqLgxKs9DV1nTPXgy.PBB3yOp7rmmKxDqdg2Ec7Jq89o9iydK', '1999-12-29', 23, 170, 84, 'male', 'A', 'a', 3, 'S', 'Kaccha Fattomand Road Gujranwala', 1916.8, 84, 2300.16, 'Developer', '2022-03-08', '2022-03-09'),
(42, 'Muhammad Arslan', '123@gmail.com', '$2y$10$MDxCKHu4.hGOUdturOXLG.CJN3yzCAInQ70dT185px6J0fJJ1i04q', '1999-12-29', 23, 170, 80, 'male', 'A', 'a', 3, 'LA', NULL, 1861.8, 80, 2559.97, NULL, '2022-03-09', '2022-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bmr` float NOT NULL,
  `bmi` float NOT NULL,
  `cpd` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `created_at`, `updated_at`, `name`, `email`, `password`, `dob`, `age`, `height`, `weight`, `gender`, `role`, `status`, `level`, `address`, `bmr`, `bmi`, `cpd`) VALUES
(29, '2022-03-02 05:28:41', '2022-03-15 14:43:41', 'exp', '456@gmail.com', '$2y$10$M9YHVm2EHKXRsd4qsHdW5OYpnIBscYS9NVH4SEGVfSmqZb0nffeym', '1997-12-29', 25, 178, 80, 'female', 'C', 'a', 'LA', 'Kaccha Fattomand Road\r\nStreet #1 fazal town Gujranwala', 1633, 80, 2245),
(30, '2022-03-01 13:27:42', NULL, 'Muhammad Arslan', '789@gmail.com', '$2y$10$GAHB83/W4Aj4t9DpuZMqxec3pfusl3GqfnKo6jxsAJsVWVfLXemre', '2010-11-17', 12, 177, 80, 'male', 'C', 'a', 'LA', NULL, 1971, 80, 2710),
(33, '2022-03-02 05:12:18', NULL, 'testing', 'test123@gmail.com', '$2y$10$zlCo9E1.x96q5Os5uEK4QefqaRUDIsXD2Dnj0p7v5rZ7j7bG/ANlC', '1999-02-09', 23, 178, 80, 'male', 'C', 'a', 'LA', NULL, 1902, 80, 2615);

-- --------------------------------------------------------

--
-- Table structure for table `intake`
--

CREATE TABLE `intake` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `type` varchar(5) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `pro_com` varchar(20) NOT NULL,
  `serving` varchar(20) NOT NULL,
  `sunit` varchar(20) NOT NULL,
  `calories` float NOT NULL,
  `protein` float NOT NULL,
  `carbs` float NOT NULL,
  `fat` float NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `intake`
--

INSERT INTO `intake` (`id`, `userid`, `type`, `pro_id`, `pro_name`, `pro_com`, `serving`, `sunit`, `calories`, `protein`, `carbs`, `fat`, `created_date`, `date`) VALUES
(13, 42, 'B', 12, 'bread', 'BGCRP', '1', 'pcs', 150, 150, 150, 150, '2022-03-13 15:39:59', '2022-03-13'),
(14, 42, 'L', 12, 'bread', 'BGCRP', '1', 'pcs', 150, 150, 150, 150, '2022-03-13 15:40:19', '2022-03-13'),
(15, 42, 'L', 11, 'rusk', 'OSS', '100', 'gm', 20, 30, 100, 50, '2022-03-13 15:40:19', '2022-03-13'),
(16, 42, 'D', 12, 'bread', 'BGCRP', '1', 'pcs', 150, 150, 150, 150, '2022-03-13 15:40:26', '2022-03-13'),
(17, 42, 'S', 11, 'rusk', 'OSS', '100', 'gm', 20, 30, 100, 50, '2022-03-13 15:40:33', '2022-03-13'),
(19, 42, 'B', 11, 'rusk', 'OSS', '100', 'gm', 20, 30, 100, 50, '2022-03-13 15:45:39', '2022-03-13'),
(21, 42, 'L', 11, 'rusk', 'OSS', '100', 'gm', 20, 30, 100, 50, '2022-03-14 08:00:55', '2022-03-14'),
(22, 42, 'B', 13, 'yougurt', 'DP', '100', 'gm', 150, 150, 20, 20, '2022-03-14 08:48:28', '2022-03-14'),
(23, 42, 'D', 13, 'yougurt', 'DP', '100', 'gm', 150, 150, 20, 20, '2022-03-14 09:29:29', '2022-03-14'),
(24, 42, 'B', 14, 'kurkure', 'OSS', '35', 'gm', 205, 2, 18, 14, '2022-03-15 13:00:49', '2022-03-15'),
(25, 42, 'B', 13, 'yougurt', 'DP', '100', 'gm', 150, 150, 20, 20, '2022-03-16 12:20:59', '2022-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `nutritionist`
--

CREATE TABLE `nutritionist` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `gender` varchar(11) NOT NULL,
  `role` varchar(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `level` varchar(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `bmr` float NOT NULL,
  `bmi` float NOT NULL,
  `cpd` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nutritionist`
--

INSERT INTO `nutritionist` (`id`, `name`, `email`, `password`, `dob`, `age`, `height`, `weight`, `gender`, `role`, `status`, `experience`, `level`, `address`, `bmr`, `bmi`, `cpd`, `created_at`, `updated_at`) VALUES
(43, 'eman', 'eman@gmail.com', '$2y$10$XaY3phK5nZs7F/bnPP5pY.DC0xlBrYh/5eQD/BT1eprCzBnVw4GLi', '2019-09-17', 3, 170, 80, 'female', 'N', 'a', 3, 'S', 'Kaccha Fattomand Road\r\nStreet #1 fazal town Gujranwala', 1721, 80, 2065, '2022-03-16 12:14:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_name` text NOT NULL,
  `product_nutrition_composition` varchar(100) NOT NULL,
  `serving_unit` varchar(50) NOT NULL,
  `product_serving` varchar(100) NOT NULL,
  `product_calories` float NOT NULL,
  `product_protein` float NOT NULL,
  `product_carbs` float NOT NULL,
  `product_fat` float NOT NULL,
  `product_status` varchar(100) NOT NULL,
  `product_comment` text DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `date`, `product_image`, `product_name`, `product_nutrition_composition`, `serving_unit`, `product_serving`, `product_calories`, `product_protein`, `product_carbs`, `product_fat`, `product_status`, `product_comment`, `updated_at`) VALUES
(13, '2022-03-14 13:46:43', NULL, 'yougurt', 'DP', 'gm', '100', 150, 150, 20, 20, 'a', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'M Arslan', 'mughalarslan996@gmail.com', NULL, '$2y$10$rPHSEePB6N9zL5VSxaTCz.lRVTL8d6BX67ccue8uB5cWmDY5z6cQe', 'A', NULL, '2022-02-15 05:09:50', NULL),
(29, 'exp', '456@gmail.com', NULL, '$2y$10$oj/ciE65JQzdP0zUlqvdfOq7RiIMw11YBNk50hC46lUF61VP575by', 'C', NULL, '2022-02-21 11:49:17', '2022-03-15 14:43:41'),
(30, 'Muhammad Arslan', '789@gmail.com', NULL, '$2y$10$90BcyaCDNojbgpuNoTadQu59YSYJe2aDnGXZmVvU8UepsaH839EDC', 'C', NULL, '2022-03-01 13:27:42', '2022-03-01 13:27:57'),
(33, 'testing', 'test123@gmail.com', NULL, '$2y$10$Hi41WQBMaG4bd/kPGf1HaOVeCeMYiH6swsnwc56uRe.fLe6kE0sCu', 'C', NULL, '2022-03-02 05:12:18', NULL),
(39, 'arslan', 'arslan123@gmail.com', NULL, '$2y$10$zMspMi3C.qeyeylfiYdI6OxBsIQDlV/QOdA4Qa5xuROR/kt.AkDI6', 'N', NULL, '2022-03-06 11:25:50', '2022-03-06 14:43:03'),
(41, 'Muhammad Arslan', 'arslan@gmail.com', NULL, '$2y$10$0KI8MqLgxKs9DV1nTPXgy.PBB3yOp7rmmKxDqdg2Ec7Jq89o9iydK', 'A', NULL, '2022-03-08 12:39:19', '2022-03-09 10:08:43'),
(42, 'Muhammad Arslan', '123@gmail.com', NULL, '$2y$10$MDxCKHu4.hGOUdturOXLG.CJN3yzCAInQ70dT185px6J0fJJ1i04q', 'A', NULL, '2022-03-09 12:52:37', '2022-03-14 05:49:17'),
(43, 'eman', 'eman@gmail.com', NULL, '$2y$10$An/XgRWxHRu9JMYVS3uDz.4AAkaGj3ykoprQDUprMfbBQDjpmSqXO', 'N', NULL, '2022-03-16 12:14:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intake`
--
ALTER TABLE `intake`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutritionist`
--
ALTER TABLE `nutritionist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `intake`
--
ALTER TABLE `intake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `nutritionist`
--
ALTER TABLE `nutritionist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

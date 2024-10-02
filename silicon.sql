-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 01:39 PM
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
-- Database: `silicon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'laxmanapradhan', '$2y$10$ONwjJlav/Uj31meg8Z21zOvdxQABldOdxxg2tg0bvNGgH1s2JD1KC', 'laxman784@gmail.com', '2024-09-04 10:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','confirmed','canceled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `user_id`, `package`, `date`, `name`, `email`, `created_at`, `status`) VALUES
(16, 18, 'silver_outdoor', '2024-09-18', 'vasu', 'vasu@gmail.com', '2024-09-11 10:44:50', 'confirmed'),
(17, 18, 'gold', '2024-09-28', 'asd', 'vasu@gmail.com', '2024-09-11 11:40:18', 'confirmed'),
(19, 18, 'gold_indoor', '2024-10-08', 'scd', 'as@gamil.com', '2024-09-14 10:33:06', 'confirmed'),
(21, 18, 'gold_indoor', '2024-09-25', 'fcgvhbjnkml', 'vasu@mail.com', '2024-09-16 11:19:41', 'confirmed'),
(22, 18, 'platinum_indoor', '2024-09-26', 'waedxfcgvhbjnkm', 'esrdtfyguh@gmail.com', '2024-09-17 08:32:53', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `description`, `image`, `status`, `uploaded_at`) VALUES
(4, 'Newbord', 'a child borth party', '1726564298_ca7280cd7ec0c350_8.jpg', 'active', '2024-09-17 09:11:38'),
(5, 'Outside ', 'A outside photo shoot ', '1726564348_4225b52dbc5fd43c_3.jpg', 'active', '2024-09-17 09:12:28'),
(6, 'portait ', ' a portait photo shoot', '1726564386_353da8443373b04f_2.jpg', 'active', '2024-09-17 09:13:06'),
(7, 'small children ', 'a photo shoot for childrens', '1726564425_aaececd4c55e3d11_details.jpg', 'active', '2024-09-17 09:13:45'),
(8, 'animal', 'a nimal photo shoot for natural', '1726564457_c8840aa9875b563e_9.jpg', 'active', '2024-09-17 09:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `cart_order`
--

CREATE TABLE `cart_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_order`
--

INSERT INTO `cart_order` (`id`, `user_id`, `full_name`, `phone`, `address`, `pincode`, `subtotal`, `shipping`, `total`, `order_date`) VALUES
(14, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 1000.00, 7.00, 1007.00, '2024-09-05 11:25:34'),
(15, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 3200.00, 7.00, 3207.00, '2024-09-05 11:38:34'),
(16, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 800.00, 7.00, 807.00, '2024-09-05 11:40:01'),
(17, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 800.00, 7.00, 807.00, '2024-09-05 11:43:31'),
(18, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 1800.00, 7.00, 1807.00, '2024-09-05 11:49:03'),
(19, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 4400.00, 7.00, 4407.00, '2024-09-05 11:52:06'),
(20, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 1000.00, 7.00, 1007.00, '2024-09-06 05:00:50'),
(21, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 3000.00, 7.00, 3007.00, '2024-09-06 05:07:11'),
(22, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 1000.00, 7.00, 1007.00, '2024-09-06 06:15:53'),
(23, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 4800.00, 7.00, 4807.00, '2024-09-06 06:22:09'),
(24, 7, 'laxman bhai', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 800.00, 7.00, 807.00, '2024-09-06 06:37:41'),
(25, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 1000.00, 7.00, 1007.00, '2024-09-06 07:15:39'),
(26, 7, 'laxman pradhan', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 900.00, 7.00, 907.00, '2024-09-06 08:45:28'),
(31, 12, 'bharat pradhan', '9913817411', 'Apexa Nagar Bamroli Road Pandesara Surat', '394221', 3000.00, 7.00, 3007.00, '2024-09-09 07:00:41'),
(79, 18, 'vasu patra', '9913817411', '531 apexa nagar bamroli road surat', '394221', 1000.00, 7.00, 1007.00, '2024-09-10 10:44:44'),
(80, 18, 'vikram bhai', '1231234635', '5451 jwbgdygwhjd jdbiuwhdi', '213121', 2000.00, 7.00, 2007.00, '2024-09-12 08:55:39'),
(81, 18, 'lnksnk', '6454545455', 'yfguhijok', '336221', 4060.00, 7.00, 4067.00, '2024-09-16 11:18:40'),
(82, 18, 'vasu', '9913817411', 'hybui jebnfiewi ', '394221', 30000.00, 7.00, 30007.00, '2024-09-18 11:20:10'),
(83, 18, 'efgrthyju', '4878459621', 'gfhbdjnkml, ebrnmkl,', '321321', 1000.00, 7.00, 1007.00, '2024-09-18 11:23:03'),
(84, 18, 'dsfgrthyjui', '1236547891', 'gttrycgvuhbjknlm', '123654', 1000.00, 7.00, 1007.00, '2024-09-18 11:23:33'),
(85, 18, 'dxfcgvbhjnkml', '1236547891', 'dxhfgj ertyuio', '123654', 800.00, 7.00, 807.00, '2024-09-18 11:33:28'),
(86, 18, 'adgfghjk', '1236547891', 'dfgrdhtfjy grhtfjgj', '325632', 1000.00, 7.00, 1007.00, '2024-09-19 05:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'laxman', 'laxman@gamil.com', 'leave', 'it me', '2024-09-18 09:44:40'),
(3, 'laxman', 'laxman@gmail.com', 'leave', 'hii', '2024-09-18 09:48:24'),
(9, 'qwderbgnhjmk', 'erg@gmail.com', 'dfkml;,', 'hbjkwelm;,cvk fm', '2024-09-18 09:53:31'),
(17, 'vasu', 'vasu@gmail.com', 'leave', 'hood', '2024-09-18 09:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `image`, `status`) VALUES
(11, '1726642026_1bb3248859ce61de_3.jpg', 'active'),
(13, '1726642186_a956291dcfff35e8_1.jpg', 'active'),
(14, '1726642193_f3763f0ced7abb76_4.jpg', 'active'),
(15, '1726642198_0cca69183fe7dd1a_5.jpg', 'active'),
(16, '1726642205_07a3c820ec534dc0_6.jpg', 'active'),
(17, '1726642223_8316b50b938b1e60_7.jpg', 'active'),
(18, '1726642229_e03da8a9e89f4efa_8.jpg', 'active'),
(19, '1726642234_561def8696a34ef5_9.jpg', 'active'),
(24, '1726642304_59261bd87c46c7e2_17.jpg', 'active'),
(26, '1726642425_2d3b9fa6273e3735_10.jpg', 'active'),
(27, '1726643501_310548e898f1fcbf_22.jpg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 18, 'Your appointment #16 has been confirmed.', 1, '2024-09-11 11:10:27'),
(2, 18, 'Your appointment #16 has been confirmed.', 1, '2024-09-11 11:40:26'),
(3, 18, 'Your appointment #17 has been confirmed.', 1, '2024-09-11 11:40:30'),
(4, 18, 'Your appointment #17 has been confirmed.', 1, '2024-09-11 11:52:57'),
(5, 18, 'Your appointment #18 has been confirmed.', 1, '2024-09-11 11:53:05'),
(6, 18, 'Your appointment #19 has been confirmed.', 1, '2024-09-14 10:33:35'),
(7, 18, 'Your appointment #19 has been confirmed.', 1, '2024-09-14 10:50:04'),
(8, 18, 'Your appointment #20 has been confirmed.', 0, '2024-09-14 10:50:08'),
(9, 18, 'Your appointment #21 has been confirmed.', 1, '2024-09-16 11:19:57'),
(10, 18, 'Your appointment #22 has been confirmed.', 0, '2024-09-17 08:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package_name`, `description`, `image_url`, `details`, `status`, `created_at`) VALUES
(1, 'outdoor packages ', 'outdoor  where everyone click there photos for some reason most of for styes to upload in instagram', '10.jpg', 'instagram, whatsapp , snapchat, facebook, twitter', 'active', '2024-09-04 19:43:27'),
(3, 'wedding packages', 'wedding packages there is a place everyone gather after a long time together', '8.jpg', 'cake, sweets, drinks, dinner, dj, partis, songs, dance', 'active', '2024-09-04 19:42:36'),
(4, 'newborn packages', 'outdoor where everyone click there photos for some reason most of for styes to upload in instagram', '2.jpg', 'instagram, whatsapp , snapchat, facebook, twitter', 'active', '2024-09-04 19:45:16'),
(5, 'pregancy packages', 'wedding packages there is a place everyone gather after a long time together', '1.jpg', 'cake, sweets, drinks, dinner, dj, partis, songs, dance', 'active', '2024-09-04 19:46:15'),
(6, ' silver packages', 'wedding packages there is a place everyone gather after a long time together', '4.jpg', '	cake, sweets, drinks, dinner, dj, partis, songs, dance', 'active', '2024-09-04 19:48:01'),
(7, 'gold packages', 'wedding packages there is a place everyone gather after a long time together', '4.jpg', '	cake, sweets, drinks, dinner, dj, partis, songs, dance', 'active', '2024-09-04 19:48:53'),
(8, 'daimond packages', 'wedding packages there is a place everyone gather after a long time together', '8.jpg', '	cake, sweets, drinks, dinner, dj, partis, songs, dance', 'active', '2024-09-04 19:49:54'),
(9, 'normal packages', 'wedding packages there is a place everyone gather after a long time together', '2.jpg', 'instagram, whatsapp , snapchat, facebook, twitter', 'active', '2024-09-17 10:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `password`
--

CREATE TABLE `password` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `image` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `old_price`, `status`, `image`, `uploaded_at`) VALUES
(2, 'gold frame ', 1000.00, 1500.00, 'active', '1.png', '2024-09-19 05:55:04'),
(3, 'silver frame', 800.00, 1200.00, 'active', '2.png', '2024-09-19 05:55:04'),
(4, 'diamond frame', 10000.00, 15000.00, 'active', '3.png', '2024-09-19 05:55:04'),
(5, 'copper frame', 900.00, 1200.00, 'active', '11.png', '2024-09-19 05:55:04'),
(6, 'normal frame ', 500.00, 900.00, 'active', '4.png', '2024-09-19 05:55:04'),
(7, 'metal frame ', 1500.00, 200.00, 'active', '6.png', '2024-09-19 05:55:04'),
(8, 'plastick  frame ', 300.00, 500.00, 'active', '8.png', '2024-09-19 05:55:04'),
(10, 'fiber frame ', 1500.00, 2000.00, 'active', '10.png', '2024-09-19 05:55:04'),
(17, 'robbar frame', 150.00, 170.00, 'active', '12.png', '2024-09-19 05:55:04');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `reviewer_name` varchar(255) NOT NULL,
  `review_text` text NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_name` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `reviewer_name`, `review_text`, `review_date`, `product_name`, `product_image`) VALUES
(1, 7, 'laxman', 'good product', '2024-09-17 11:23:22', 'metal frame ', '6.png'),
(2, 4, 'hiii bro', 'dxfyughiojlm, ghnm', '2024-09-17 11:24:39', 'diamond frame', '3.png'),
(3, 3, 'good', 'this look good', '2024-09-18 04:53:26', 'silver frame', '2.png'),
(4, 3, 'knfirbvg', 'frt4rbhthb', '2024-09-18 05:47:24', 'silver frame', '2.png'),
(5, 3, 'knfirbvg', 'frt4rbhthb', '2024-09-18 05:48:28', 'silver frame', '2.png'),
(6, 3, 'dfg', 'fbgb', '2024-09-18 05:49:58', 'silver frame', '2.png'),
(7, 4, 'sumit', 'this is good', '2024-09-18 11:57:08', 'diamond frame', '3.png'),
(8, 2, 'mokn', 'good', '2024-09-19 04:52:36', 'gold frame ', '1.png');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive') DEFAULT 'active',
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `caption`, `created_at`, `status`, `uploaded_at`) VALUES
(23, '1726551895_915f307b474a57b2_2.jpg', 'Jasmine', '2024-09-17 05:44:55', 'active', '2024-09-19 05:58:13'),
(24, '1726551904_073e6ca6f2d44834_4.jpg', 'Rabica', '2024-09-17 05:45:04', 'active', '2024-09-19 05:58:13'),
(25, '1726551913_707a5b7a0ac77caf_8.jpg', 'Lalita', '2024-09-17 05:45:13', 'active', '2024-09-19 05:58:13'),
(26, '1726551921_f6aea9ffa5db4bbe_10.jpg', 'Monica', '2024-09-17 05:45:21', 'active', '2024-09-19 05:58:13'),
(28, '1726551938_8d1ad0611570a9ac_14.jpg', 'Sonica', '2024-09-17 05:45:38', 'active', '2024-09-19 05:58:13'),
(29, '1726551945_266b602eccec6c80_16.jpg', 'Makins', '2024-09-17 05:45:45', 'active', '2024-09-19 05:58:13'),
(30, '1726551953_b12549b6800884fe_17.jpg', 'Juli', '2024-09-17 05:45:53', 'active', '2024-09-19 05:58:13'),
(34, '1726556482_a9e900bf1ac82180_1.jpg', 'Otama', '2024-09-17 07:01:22', 'active', '2024-09-19 05:58:13'),
(38, '1726721646_6b1449a0cb7888e6_Screenshot (75).png', 'bhnjk', '2024-09-19 04:54:06', 'active', '2024-09-19 05:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `name`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'sumit bhai', '1726559453_38f79bb3fe1effa0_1.jpg', 'manager\r\n', 'active', '2024-09-17 07:50:53', '2024-09-17 07:51:05'),
(2, 'ritesh bhai', '1726559486_c90c651a6d378d97_2.jpg', 'manager', 'active', '2024-09-17 07:51:26', '2024-09-17 09:22:04'),
(3, 'laxman bhai', '1726559502_6ef6c53731d51943_3.jpg', 'manager', 'active', '2024-09-17 07:51:42', '2024-09-17 07:51:42'),
(4, 'ram bhai', '1726559558_3c4f0b47e26f14cf_5.jpg', 'manager', 'active', '2024-09-17 07:52:38', '2024-09-17 07:52:38'),
(6, 'rakesh bhai', '1726559637_d2ea8a6eb9bae370_6.jpg', 'manager', 'active', '2024-09-17 07:53:57', '2024-09-17 07:53:57'),
(7, 'rabi bhai', '1726559659_5b0f76ac9117711e_10.jpg', 'manager', 'active', '2024-09-17 07:54:19', '2024-09-17 07:54:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `email`, `password`, `phone_number`, `address`, `created_at`) VALUES
(7, 'laxman pradhan', 'laxman531@gmail.com', '$2y$10$DcJYYrQR6xcqfXJYsjmk1O6PE3NOiJIbsi8JG3NBiApOFKKJ9RnVW', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat\r\nApexa Nagar Bamroli Road', '2024-09-05 11:24:58'),
(12, 'bharat pradhan', 'bharat531@gmail.com', '$2y$10$EB5Fa0OiRkG81eMdB2PBW.zQnIpwFTDEXPkKH0g1VQVmFKHxSeAtS', '09913817411', 'Apexa Nagar Bamroli Road Pandesara Surat\r\nApexa Nagar Bamroli Road', '2024-09-09 06:59:57'),
(18, 'Vasu Patra', 'vasu@gmail.com', '$2y$10$C1RQffTBBRLJSVId4vtVEOUADlK6hzV8b8M0mz0lAjBSVYFJguSQ6', '987654321', '531 , apexa nagar bamroli road surat', '2024-09-10 10:43:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_order`
--
ALTER TABLE `cart_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password`
--
ALTER TABLE `password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart_order`
--
ALTER TABLE `cart_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `password`
--
ALTER TABLE `password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_order`
--
ALTER TABLE `cart_order`
  ADD CONSTRAINT `cart_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `password`
--
ALTER TABLE `password`
  ADD CONSTRAINT `password_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `cart_order` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

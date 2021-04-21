-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2021 at 01:20 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `student_id` varchar(15) NOT NULL,
  `category` varchar(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `activation_status` enum('active','deactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `student_id`, `category`, `amount`, `created_at`, `created_by`, `updated_at`, `updated_by`, `activation_status`) VALUES
(7, '2021040001', 'Admission Fee', 5000.00, '2021-04-20 16:10:12', 1, '2021-04-20 09:10:08', 0, 'active'),
(8, '2021040002', 'Tution Fee', 950.00, '2021-04-20 16:10:30', 1, '2021-04-20 09:10:23', 0, 'active'),
(9, '2021040003', 'Sports Fee', 500.00, '2021-04-20 16:10:35', 1, '2021-04-20 09:10:37', 0, 'active'),
(13, '2021040001', 'Tution Fee', 950.00, '2021-04-20 17:50:19', 1, '2021-04-20 17:50:19', 0, 'active'),
(14, '2021040001', 'Sports Fee', 500.00, '2021-04-20 17:50:33', 1, '2021-04-20 17:50:33', 0, 'active'),
(15, '2021040002', 'Admission Fee', 5000.00, '2021-04-20 17:50:51', 1, '2021-04-20 17:50:51', 0, 'active'),
(16, '2021040006', 'Admission Fee', 5000.00, '2021-04-20 17:51:24', 1, '2021-04-20 17:51:24', 0, 'active'),
(17, '2021040006', 'Sports Fee', 500.00, '2021-04-20 17:51:37', 1, '2021-04-20 17:51:37', 0, 'active'),
(18, '2021040008', 'Tution Fee', 950.00, '2021-04-20 17:52:54', 1, '2021-04-20 17:52:54', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_id` varchar(15) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` varchar(10) NOT NULL,
  `address` varchar(30) NOT NULL,
  `sms` int(15) NOT NULL,
  `session` varchar(20) NOT NULL,
  `class` varchar(5) NOT NULL,
  `s_group` varchar(20) NOT NULL,
  `section` varchar(5) NOT NULL,
  `roll` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `activation_status` enum('active','deactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `fname`, `lname`, `gender`, `date_of_birth`, `address`, `sms`, `session`, `class`, `s_group`, `section`, `roll`, `created_at`, `created_by`, `updated_at`, `updated_by`, `activation_status`) VALUES
(18, '2021040001', 'Soheli', 'Akter', 'Female', '05-07-2008', 'Banani, Dhaka', 1874514797, 'Jan ’21 to Dec ‘21', 'IX', 'Science', 'A', 1, '2021-04-20 09:00:20', 1, '2021-04-19 16:50:58', 1, 'active'),
(19, '2021040002', 'Sharmin', 'Sultana', 'Female', '04-03-2010', 'Tongi, Dhaka', 1748531478, 'Jan ’21 to Dec ‘21', 'VIII', 'N/A', 'B', 3, '2021-04-19 16:52:11', 1, '2021-04-19 16:52:11', 0, 'active'),
(20, '2021040003', 'Niloy', 'Ahmed', 'Male', '12-09-2008', 'Uttara, Dhaka', 1987431486, 'Jan ’21 to Dec ‘21', 'X', 'Humanities', 'A', 5, '2021-04-19 16:53:15', 1, '2021-04-19 16:53:15', 0, 'active'),
(21, '2021040004', 'Sujon', 'Sarker', 'Male', '02-072010', 'Uttara, Dhaka', 1574136574, 'Jan ’21 to Dec ‘21', 'VIII', 'N/A', 'A', 8, '2021-04-19 16:57:52', 1, '2021-04-19 16:54:07', 1, 'active'),
(22, '2021040005', 'Nila', 'Chowdhury', 'Female', '01-06-2011', 'Gulshan, Dhaka', 1574265741, 'Jan ’21 to Dec ‘21', 'X', 'Science', 'A', 7, '2021-04-19 16:55:20', 1, '2021-04-19 16:55:20', 0, 'active'),
(23, '2021040006', 'Farhin', 'Sultana', 'Female', '01-01-2010', 'Tongi, Dhaka', 1798412365, 'Jan ’21 to Dec ‘21', 'IX', 'Science', 'B', 15, '2021-04-20 06:57:28', 1, '2021-04-19 16:56:12', 1, 'active'),
(24, '2021040007', 'Bulbul', 'Islam', 'Male', '07-04-2011', 'Uttara, Dhaka', 1674125896, 'Jan ’21 to Dec ‘21', 'X', 'Humanities', 'B', 23, '2021-04-19 17:13:15', 1, '2021-04-19 16:57:13', 1, 'active'),
(25, '2021040008', 'Sumi', 'Islam', 'Female', '03-08-2009', 'Dhanmondi, Dhaka', 1574189625, 'Jan ’21 to Dec ‘21', 'IX', 'Science', 'C', 9, '2021-04-20 09:03:03', 1, '2021-04-20 09:03:03', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user_created_by` int(11) DEFAULT NULL,
  `activation_status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `department`, `designation`, `address`, `image`, `id_user_created_by`, `activation_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super admin', 'admin@gmail.com', '64d15409682e9e80a96fc206058cd617', '01917598215', '1', 'MD', 'Nikunja-2', '1575352209.png', NULL, 'active', 'R4wkYCRTM4IKDIfYGMDHhQsWVMUbEluI8jD6NQ8Dyl1CTaVl6nkZ4BzhlHIr', '2019-06-25 02:07:36', '2019-06-25 02:07:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

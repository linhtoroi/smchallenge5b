-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2020 at 11:37 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sm`
--

-- --------------------------------------------------------

--
-- Table structure for table `challenge`
--

CREATE TABLE `challenge` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hint` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacherAccount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `challenge`
--

INSERT INTO `challenge` (`id`, `hint`, `created_at`, `updated_at`, `teacherAccount`) VALUES
(1, 'Thủ đô của nước Việt Nam', '2020-10-11 18:54:47', '2020-10-11 18:54:47', 'admin'),
(2, 'Thủ đô của nước Việt Nam', '2020-10-11 21:18:40', '2020-10-11 21:18:40', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fileName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacherAccount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`id`, `fileName`, `created_at`, `updated_at`, `teacherAccount`) VALUES
(1, '1_baitapchuong1.txt', '2020-10-11 18:50:29', '2020-10-11 18:50:29', 'admin'),
(2, '2_baitapchuong1.txt', '2020-10-11 21:18:08', '2020-10-11 21:18:08', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `fileName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idHw` int(10) UNSIGNED NOT NULL,
  `studentAccount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`fileName`, `created_at`, `updated_at`, `idHw`, `studentAccount`, `id`) VALUES
('1_18020758_BailamChuong1.txt', '2020-10-11 21:26:25', '2020-10-11 21:26:25', 5, '18020758', 1),
('2_18020758_1.txt', '2020-10-11 21:26:48', '2020-10-11 21:26:48', 6, '18020758', 2);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `fileName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `accountSender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountReceiver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`fileName`, `created_at`, `updated_at`, `accountSender`, `accountReceiver`) VALUES
('admin_18020758.txt', '2020-10-11 21:17:24', '2020-10-11 21:17:24', 'admin', '18020758'),
('18020758_18021229.txt', '2020-10-11 21:19:34', '2020-10-11 21:19:34', '18020758', '18021229');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_04_025215_create_teacher_table', 1),
(5, '2020_10_04_025911_create_student_table', 1),
(6, '2020_10_04_029999_create_exercise_table', 1),
(7, '2020_10_04_030726_create_homework_table', 1),
(9, '2020_10_04_031755_create_challenge_table', 1),
(10, '2020_10_04_031238_create_message__tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `fullName` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`fullName`, `email`, `phoneNumber`, `created_at`, `updated_at`, `account`) VALUES
('Hoàng Linh', 'linhlinh@gmail.com', 911782199, '2020-10-11 04:06:31', '2020-10-11 04:06:31', '18020758'),
('Nguyễn Thanh Huyền', 'huyen@gmail.com', 911782128, '2020-10-11 04:02:43', '2020-10-11 04:02:43', '18021229');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `fullName` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`fullName`, `created_at`, `updated_at`, `account`) VALUES
('Ma Thị Châu', '2020-10-11 00:05:49', '2020-10-11 00:05:49', 'admin'),
('Nguyễn Đại Thọ', '2020-10-11 00:08:52', '2020-10-11 00:08:52', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isTeacher` tinyint(1) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `isTeacher`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '$2y$10$lhT6t6QaL.xcLn6SNMNqveoqK0hJWOvd0fZQ/1kLwVfzmUbAZdVCa', 'TUPdHZSWYS3qcNAsy3suXQG7MGRImZziGi5OlZdu9AK9x7NpI8tYisxvoH6I', '2020-10-11 16:58:06', '2020-10-11 16:58:06'),
(4, 1, 'admin2', '$2y$10$YYZ8OJeMVAuYKPyG0MmqpuJfkcMljAWw8o4fYK9Yfx/v6PY0tFH4i', 'rwl4Ny8kpXXU4JedlIbBrxG18Xmig3gf2f7LbixAvDKFU2ZjG7FPc8OLGU72C17Z8lpw8T961oAHiodEfm7OELDfJ9F1C1AtJ0ya', '2020-10-11 17:07:50', '2020-10-11 17:07:50'),
(7, 0, '18021229', '$2y$10$Tzx0vDSrJUNFEoWGk7LYXubr7mW9Zswkoumu/0s.HzCkh3cROx6IS', 'Yp3WEUkSQVTfNMN9NSsZpqjXOlqnHfTNkrAhmwO76nxhq48JqhxFGLwu9EbHzIAIWWYi5EQtsxA9mycLJ1iw9oHQC1hLQisHbFjI', '2020-10-11 21:02:36', '2020-10-11 21:02:36'),
(8, 0, '18020758', '$2y$10$nySmaCWIG5GNjF27tPkdw.j.UcGMcty9/8D2ism1meqbcpNvH.x5K', 'HsND6GlGrmMsI1CRKzA3Lwg7zGxQWcEKc6zbsEw3PazeKPo35p1Hx0aYFAol', '2020-10-11 21:05:00', '2020-10-11 21:05:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `challenge`
--
ALTER TABLE `challenge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `challenge_teacheraccount_foreign` (`teacherAccount`);

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exercise_teacheraccount_foreign` (`teacherAccount`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`idHw`),
  ADD KEY `homework_studentaccount_foreign` (`studentAccount`),
  ADD KEY `homework_id_foreign` (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD KEY `message_accountsender_foreign` (`accountSender`),
  ADD KEY `message_accountreceiver_foreign` (`accountReceiver`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`account`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`account`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `challenge`
--
ALTER TABLE `challenge`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `idHw` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `challenge`
--
ALTER TABLE `challenge`
  ADD CONSTRAINT `challenge_teacheraccount_foreign` FOREIGN KEY (`teacherAccount`) REFERENCES `teacher` (`account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `exercise_teacheraccount_foreign` FOREIGN KEY (`teacherAccount`) REFERENCES `teacher` (`account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `homework_id_foreign` FOREIGN KEY (`id`) REFERENCES `exercise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `homework_studentaccount_foreign` FOREIGN KEY (`studentAccount`) REFERENCES `student` (`account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_accountreceiver_foreign` FOREIGN KEY (`accountReceiver`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_accountsender_foreign` FOREIGN KEY (`accountSender`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_account_foreign` FOREIGN KEY (`account`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_account_foreign` FOREIGN KEY (`account`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

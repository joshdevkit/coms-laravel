-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 04:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lara_tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_02_19_024016_create_project_lists_table', 1),
(7, '2024_02_19_024226_create_project_members_table', 1),
(8, '2024_02_19_024314_create_task_lists_table', 1),
(9, '2024_03_04_103413_create_project_materials_table', 2),
(10, '2024_03_05_044651_create_project_file_managers_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_file_managers`
--

CREATE TABLE `project_file_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` longtext NOT NULL,
  `file_text` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_file_managers`
--

INSERT INTO `project_file_managers` (`id`, `project_id`, `user_id`, `file_name`, `file_text`, `created_at`, `updated_at`) VALUES
(2, 2, 6, 'project-files/Sample-B.O.Q-.xls', 'Sample Files', '2024-04-16 17:41:51', '2024-04-16 17:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `project_lists`
--

CREATE TABLE `project_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `category_type` varchar(255) NOT NULL,
  `total_budget` varchar(255) NOT NULL,
  `project_owner` bigint(20) UNSIGNED NOT NULL,
  `description` longtext NOT NULL,
  `project_location_text` longtext NOT NULL,
  `project_location_codes` longtext NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_lists`
--

INSERT INTO `project_lists` (`id`, `manager_id`, `project_name`, `project_type`, `category`, `category_type`, `total_budget`, `project_owner`, `description`, `project_location_text`, `project_location_codes`, `status`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(2, 6, 'Sample Project 101 - Updated', 'Vertical Type', 'Bridge', '25km', '5000000', 9, 'Sample Description only', 'a:4:{s:6:\"region\";s:26:\"Region II (Cagayan Valley)\";s:8:\"province\";s:7:\"Cagayan\";s:4:\"city\";s:8:\"Gattaran\";s:8:\"barangay\";N;}', 'a:4:{s:6:\"region\";s:2:\"02\";s:8:\"province\";s:4:\"0215\";s:4:\"city\";s:6:\"021513\";s:8:\"barangay\";s:9:\"021513054\";}', 'Done', '2024-04-25', '2025-10-30', '2024-04-16 16:49:14', '2024-04-17 17:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `project_materials`
--

CREATE TABLE `project_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `category_section` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_materials`
--

INSERT INTO `project_materials` (`id`, `project_id`, `item_name`, `quantity`, `total_price`, `unit`, `category_section`, `created_at`, `updated_at`) VALUES
(4, 2, 'Sample Item 1', 10, 500.00, 'pcs', 'SITE CONSTRUCTION', '2024-04-16 17:27:04', '2024-04-16 17:27:04'),
(5, 2, 'Sample Item 2', 50, 800.00, 'cm', 'MECHANICAL', '2024-04-16 17:36:59', '2024-04-16 17:36:59'),
(6, 2, 'Sample Item 3', 10, 1400.00, 'pcs', 'FINISHES', '2024-04-16 18:04:04', '2024-04-16 18:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`id`, `user_id`, `project_id`, `created_at`, `updated_at`) VALUES
(9, 7, 2, '2024-04-16 16:49:14', '2024-04-16 16:49:14'),
(10, 8, 2, '2024-04-16 16:49:14', '2024-04-16 16:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `task_lists`
--

CREATE TABLE `task_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `percentage` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_lists`
--

INSERT INTO `task_lists` (`id`, `project_id`, `member_id`, `task_name`, `description`, `percentage`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 7, 'Sample Task', '<p>Sample tasks</p>', 50, 'Done', '2024-04-16 16:49:42', '2024-04-16 17:02:47'),
(3, 2, 8, 'Sample Task 2', '<p>Sample tasks 2</p>', 50, 'Done', '2024-04-16 16:49:55', '2024-04-16 17:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'member',
  `avatar` varchar(255) DEFAULT NULL,
  `is_activated` int(11) NOT NULL DEFAULT 0,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `email_verified_at`, `password`, `type`, `avatar`, `is_activated`, `is_deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, '$2y$12$SFC/Yu4iMEJ1q2dg9oGvi.xUDKv27NC5IW9az9hV7/eQyE.E/pHq6', '1', 'avatars/avatar_1.jpg', 0, 0, 'gnlIrdNIxfJspulBNl9s9AS4any0DNENHNcOUdpJ5XPlsdb5fpn69DYDmgJt', '2024-02-27 05:48:18', '2024-03-16 05:02:48'),
(6, 'Joshua Pacho', 'jshpch1996@gmail.com', NULL, '$2y$12$ocbqYN2Ku6GTQPVIM2A5xuH9TrtfJfzOnNRZk9GgB6QCUUhyt1/oO', '2', 'avatars/avatar_6.jpg', 1, 0, NULL, '2024-04-16 16:43:51', '2024-04-18 18:16:18'),
(7, 'Sample Member 1', 'samplemember1@gmail.com', NULL, '$2y$12$UO5qbLSMdVYdQU2BjX0ZR.09cwXGucachHnUPbsQ7Dap3JJUdW2l2', '3', 'avatars/avatar_7.jpg', 1, 0, NULL, '2024-04-16 16:46:54', '2024-04-16 17:25:14'),
(8, 'Sample Member 2', 'samplemember2@gmail.com', NULL, '$2y$12$0gvXSkMp2gA4jURiNKsyGevDfDJy.RzFWOwPC3N96hSmQXE2y0Wni', '3', 'avatars/avatar_8.jpg', 0, 0, NULL, '2024-04-16 16:47:20', '2024-04-16 16:47:20'),
(9, 'Project Owner 1', 'projectowner1@gmail.com', NULL, '$2y$12$2sn/FM4V2PTY2DfxYKrjNOTTttH5Y7tOG7VAR7GENwUgsWKYT.lyq', '0', 'avatars/avatar_9.jpg', 1, 0, NULL, '2024-04-16 16:48:30', '2024-04-17 16:58:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `project_file_managers`
--
ALTER TABLE `project_file_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_file_managers_project_id_foreign` (`project_id`),
  ADD KEY `project_file_managers_user_id_foreign` (`user_id`);

--
-- Indexes for table `project_lists`
--
ALTER TABLE `project_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_lists_manager_id_foreign` (`manager_id`),
  ADD KEY `project_lists_project_owner_foreign` (`project_owner`);

--
-- Indexes for table `project_materials`
--
ALTER TABLE `project_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_materials_project_id_foreign` (`project_id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_members_project_id_foreign` (`project_id`),
  ADD KEY `project_members_user_id_foreign` (`user_id`);

--
-- Indexes for table `task_lists`
--
ALTER TABLE `task_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_lists_project_id_foreign` (`project_id`),
  ADD KEY `task_lists_member_id_foreign` (`member_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_file_managers`
--
ALTER TABLE `project_file_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_lists`
--
ALTER TABLE `project_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_materials`
--
ALTER TABLE `project_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_members`
--
ALTER TABLE `project_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `task_lists`
--
ALTER TABLE `task_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project_file_managers`
--
ALTER TABLE `project_file_managers`
  ADD CONSTRAINT `project_file_managers_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `project_lists` (`id`),
  ADD CONSTRAINT `project_file_managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_lists`
--
ALTER TABLE `project_lists`
  ADD CONSTRAINT `project_lists_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `project_lists_project_owner_foreign` FOREIGN KEY (`project_owner`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_materials`
--
ALTER TABLE `project_materials`
  ADD CONSTRAINT `project_materials_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `project_lists` (`id`);

--
-- Constraints for table `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `project_members_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `project_lists` (`id`),
  ADD CONSTRAINT `project_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `task_lists`
--
ALTER TABLE `task_lists`
  ADD CONSTRAINT `task_lists_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `task_lists_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `project_lists` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

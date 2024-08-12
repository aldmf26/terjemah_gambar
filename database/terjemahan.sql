-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 12, 2024 at 01:10 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `terjemahan`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_07_25_003525_create_users_table', 1),
(3, '2024_08_09_214958_create_permission_tables', 1),
(4, '2024_08_09_221237_create_terjemahans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2024-08-10 13:00:44', '2024-08-10 13:00:44'),
(2, 'admin', 'web', '2024-08-10 13:00:44', '2024-08-10 13:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terjemahans`
--

CREATE TABLE `terjemahans` (
  `id` bigint UNSIGNED NOT NULL,
  `ind` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terjemahans`
--

INSERT INTO `terjemahans` (`id`, `ind`, `en`, `image`, `created_at`, `updated_at`) VALUES
(1, 'kucing', 'cat', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(2, 'Anjing', 'Dog', 'https://kidfriendlypets.com/wp-content/uploads/2021/08/pet-dog-2.jpg', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(3, 'Burung', 'Bird', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131https://thegorbalsla.com/wp-content/uploads/2018/12/Burung-Hantu.jpg', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(4, 'Ikan', 'Fish', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(5, 'Kelinci', 'Rabbit', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(6, 'Gajah', 'Elephant', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(7, 'Singa', 'Lion', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(8, 'Harimau', 'Tiger', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(9, 'Serigala', 'Wolf', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(10, 'Kuda', 'Horse', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(11, 'Sapi', 'Cow', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(12, 'Kambing', 'Goat', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(13, 'Babi', 'Pig', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(14, 'Ayam', 'Chicken', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(15, 'Bebek', 'Duck', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(16, 'Merpati', 'Pigeon', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(17, 'Rusa', 'Deer', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(18, 'Kucing Hutan', 'Wild Cat', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(19, 'Panda', 'Panda', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(20, 'Koala', 'Koala', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(23, 'teslagini', 'keluar inggrisnya', 'https://cdn.pixabay.com/photo/2018/08/12/16/59/parrot-3601194_1280.jpg', '2024-08-11 13:08:28', '2024-08-11 13:08:28'),
(25, 'buakdiedit', 'buakbuak', '1723383087.jpg', '2024-08-11 13:31:27', '2024-08-11 13:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', '2024-08-10 13:00:45', '$2y$10$ndP5DuQX8Wgxv8TZNvAate1hqq0hy4S.rn7XAnAPffChSFV7GvehC', 'oYs2UBNfYBtMGL5OV05IAgtylKCK5Gonf5ZJyMWHy0c2CNTpiALNCetqNjAG', '2024-08-10 13:00:45', '2024-08-10 13:00:45'),
(2, 'admin', 'admin@gmail.com', '2024-08-10 13:00:45', '$2y$10$5.WDS3E1.OXv0W5CxaPsF.7T0A3wud0REmgFzTKoxqDLhRzE4iqO.', 'jMnGyV7tFf', '2024-08-10 13:00:45', '2024-08-10 13:00:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `terjemahans`
--
ALTER TABLE `terjemahans`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `terjemahans`
--
ALTER TABLE `terjemahans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 05 jul 2024 kl 10:06
-- Serverversion: 10.4.32-MariaDB
-- PHP-version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `mailboy`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `failed_jobs`
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
-- Tabellstruktur `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_28_083705_create_permission_tables', 2),
(5, '2024_07_03_175911_add_lastname_to_users_table', 3),
(6, '2024_07_03_220845_create_newsletters_table', 3),
(7, '2024_07_04_000400_create_newsletters_subscribers_table', 4);

-- --------------------------------------------------------

--
-- Tabellstruktur `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Tabellstruktur `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `addeduid` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `newsletters`
--

INSERT INTO `newsletters` (`id`, `name`, `description`, `active`, `addeduid`, `created_at`, `updated_at`) VALUES
(17, 'Test Newsletter 1', 'Description for Test Newsletter 1', 1, 2, '2024-07-05 08:00:00', '2024-07-05 08:00:00'),
(18, 'Test Newsletter 2', 'Description for Test Newsletter 2', 1, 2, '2024-07-05 08:00:00', '2024-07-03 21:59:50'),
(19, 'Kalle', '3r3rf33', 1, 2, '2024-07-03 21:36:57', '2024-07-03 21:36:57'),
(20, 'efef', 'efefef', 1, 2, '2024-07-03 21:37:56', '2024-07-05 05:52:32');

-- --------------------------------------------------------

--
-- Tabellstruktur `newsletters_subscribers`
--

CREATE TABLE `newsletters_subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `newsletter_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `newsletters_subscribers`
--

INSERT INTO `newsletters_subscribers` (`id`, `newsletter_id`, `user_id`, `created_at`, `updated_at`) VALUES
(34, 18, 3, '2024-07-04 02:06:41', '2024-07-04 02:06:41'),
(36, 19, 3, '2024-07-04 00:26:42', '2024-07-04 00:26:42'),
(38, 18, 9, '2024-07-05 05:51:27', '2024-07-05 05:51:27');

-- --------------------------------------------------------

--
-- Tabellstruktur `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('johan@auroracloud.se', '$2y$12$3xgsoDTEiSllDsnAQjoyOuny0pxgvN.PgnDrPL5HzuCmojYOfunEO', '2024-06-27 12:12:34');

-- --------------------------------------------------------

--
-- Tabellstruktur `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-06-28 06:43:54', '2024-06-28 06:43:54'),
(2, 'client', 'web', '2024-06-28 06:43:54', '2024-06-28 06:43:54'),
(3, 'subscriber', 'web', '2024-06-28 06:43:54', '2024-06-28 06:43:54');

-- --------------------------------------------------------

--
-- Tabellstruktur `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5H4N7znelUyCGM0wxE1a1Ylr6osCsdaPxeRMTGbD', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWEFhRTBpb0lFYUc4aFRTdzRVbWhRTWhLRXU3OVMwVVdCVlE2blpxRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vbG9jYWxob3N0L21haWxib3kvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1720165487),
('kK6hLlZgfnRVr5rg0qQAGfDx3c0dLOP2kSNTWfgX', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ3owS2o3b1o3c2FMOTJ1N2VpYXZTNTI0R01tV09EZFo1RTRHNEMzYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vbG9jYWxob3N0L21haWxib3kvcHVibGljIjt9fQ==', 1720166697);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Johan', 'Admin', 'johan.norr84@gmail.com', '2024-06-27 10:10:42', '$2y$12$B63z7a5cFCAcaRQCjud.3eMEcrZS1BeEkzvEGB2VK8VU1Q/DX2Kc2', 'brODUnU5utcN6bgX9c85V83BxFroWqh7R4VW574ZJC1kKAgT1Yve9i3SY6Be', '2024-06-27 10:10:42', '2024-07-03 16:04:43'),
(2, 'Johan', 'Kund', 'johan@auroracloud.se', '2024-06-27 10:10:42', '$2y$12$B63z7a5cFCAcaRQCjud.3eMEcrZS1BeEkzvEGB2VK8VU1Q/DX2Kc2', 'pI0SW6uQv3PGAfJEnPhJ9uzzYLYxYfONKyJGB98pbaedv75bpVwPFQ3WdKcM', '2024-06-27 10:10:42', '2024-06-28 06:14:49'),
(3, 'Malin', 'Subscriber', 'malin.lofling@gmail.com', '2024-06-27 10:10:42', '$2y$12$B63z7a5cFCAcaRQCjud.3eMEcrZS1BeEkzvEGB2VK8VU1Q/DX2Kc2', 'QD7WlhfHw8qknt9HH7t7DBPiGsy7qgQVnBxg4Af40GwegCutIGH8d2ZvpCuv', '2024-06-27 10:10:42', '2024-06-28 06:14:49'),
(7, 'Kalle', 'Anka', 'kalle@anka.se', NULL, '$2y$12$5c0O/WzjmDOXU0ZdbyHbEOIywZqJFIvBVOASD1.VHjsqdXolAnV/y', NULL, '2024-07-03 16:26:12', '2024-07-03 16:26:12'),
(8, 'Kalle2', 'Anka', 'kalle2@anka.se', NULL, '$2y$12$09kmVzSrzq.04e9Xl16UiukOsgqwzW/ebbZpk7P.raG/7qvL.twle', NULL, '2024-07-03 16:26:43', '2024-07-03 16:26:43'),
(9, 'Johan', 'Norr', 'johan@moonserver.se', NULL, '$2y$12$kL6.Y1290jgMtVJ.Kk8Eyewy5xRsaRN3xAJEfPmqg9PSXIiOx5hSC', 'Gj5vLxl6yK98VnqYC545gtaxK4vudPISCzwYPCwHIpdZ13rS0032d9jSV9Cy', '2024-07-05 05:46:49', '2024-07-05 05:58:10');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index för tabell `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index för tabell `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index för tabell `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index för tabell `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index för tabell `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index för tabell `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `newsletters_addeduid_foreign` (`addeduid`);

--
-- Index för tabell `newsletters_subscribers`
--
ALTER TABLE `newsletters_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletters_subscribers_newsletter_id_user_id_unique` (`newsletter_id`,`user_id`),
  ADD KEY `newsletters_subscribers_user_id_foreign` (`user_id`);

--
-- Index för tabell `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index för tabell `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index för tabell `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index för tabell `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index för tabell `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT för tabell `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT för tabell `newsletters_subscribers`
--
ALTER TABLE `newsletters_subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT för tabell `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Restriktioner för tabell `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Restriktioner för tabell `newsletters`
--
ALTER TABLE `newsletters`
  ADD CONSTRAINT `newsletters_addeduid_foreign` FOREIGN KEY (`addeduid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restriktioner för tabell `newsletters_subscribers`
--
ALTER TABLE `newsletters_subscribers`
  ADD CONSTRAINT `newsletters_subscribers_newsletter_id_foreign` FOREIGN KEY (`newsletter_id`) REFERENCES `newsletters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `newsletters_subscribers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restriktioner för tabell `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

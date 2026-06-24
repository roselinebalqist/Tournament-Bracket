-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2026 at 12:30 PM
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
-- Database: `tournament_bracket`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tournament_id` bigint(20) UNSIGNED NOT NULL,
  `round` smallint(5) UNSIGNED NOT NULL,
  `match_number` smallint(5) UNSIGNED NOT NULL,
  `team_one_id` bigint(20) UNSIGNED DEFAULT NULL,
  `team_two_id` bigint(20) UNSIGNED DEFAULT NULL,
  `team_one_score` smallint(5) UNSIGNED DEFAULT NULL,
  `team_two_score` smallint(5) UNSIGNED DEFAULT NULL,
  `winner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `next_match_id` bigint(20) UNSIGNED DEFAULT NULL,
  `next_match_slot` enum('team_one','team_two') DEFAULT NULL,
  `status` enum('pending','scheduled','ongoing','completed') NOT NULL DEFAULT 'pending',
  `scheduled_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `tournament_id`, `round`, `match_number`, `team_one_id`, `team_two_id`, `team_one_score`, `team_two_score`, `winner_id`, `next_match_id`, `next_match_slot`, `status`, `scheduled_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 4, 7, 2, 1, 4, 5, 'team_one', 'completed', NULL, '2026-06-03 09:20:59', '2026-06-03 09:37:28'),
(2, 1, 1, 2, 3, 5, 5, 1, 3, 5, 'team_two', 'completed', NULL, '2026-06-03 09:20:59', '2026-06-03 09:38:22'),
(3, 1, 1, 3, 6, 1, 0, 2, 1, 6, 'team_one', 'completed', NULL, '2026-06-03 09:20:59', '2026-06-03 09:38:34'),
(4, 1, 1, 4, 2, 9, 2, 6, 9, 6, 'team_two', 'completed', NULL, '2026-06-03 09:20:59', '2026-06-03 09:38:49'),
(5, 1, 2, 1, 4, 3, 3, 4, 3, 7, 'team_one', 'completed', NULL, '2026-06-03 09:20:59', '2026-06-03 09:39:24'),
(6, 1, 2, 2, 1, 9, 7, 1, 1, 7, 'team_two', 'completed', NULL, '2026-06-03 09:20:59', '2026-06-03 09:39:46'),
(7, 1, 3, 1, 3, 1, 5, 2, 3, NULL, NULL, 'completed', NULL, '2026-06-03 09:20:59', '2026-06-03 09:39:58'),
(8, 4, 1, 1, 12, 11, 4, 2, 12, 10, 'team_one', 'completed', NULL, '2026-06-03 22:30:49', '2026-06-03 22:31:14'),
(9, 4, 1, 2, 14, 13, 2, 0, 14, 10, 'team_two', 'completed', NULL, '2026-06-03 22:30:49', '2026-06-03 22:31:31'),
(10, 4, 2, 1, 12, 14, 1, 0, 12, NULL, NULL, 'completed', NULL, '2026-06-03 22:30:49', '2026-06-03 22:31:42'),
(11, 5, 1, 1, 15, 19, 1, 2, 19, 13, 'team_one', 'completed', NULL, '2026-06-14 21:55:56', '2026-06-14 21:56:19'),
(12, 5, 1, 2, 18, 16, 0, 5, 16, 13, 'team_two', 'completed', NULL, '2026-06-14 21:55:56', '2026-06-14 21:56:40'),
(13, 5, 2, 1, 19, 16, 2, 1, 19, NULL, NULL, 'completed', NULL, '2026-06-14 21:55:56', '2026-06-14 21:56:57');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_03_000001_add_role_to_users_table', 1),
(5, '2026_06_03_000002_create_tournaments_table', 1),
(6, '2026_06_03_000003_create_teams_table', 1),
(7, '2026_06_03_000004_create_tournament_participants_table', 1),
(8, '2026_06_03_000005_create_matches_table', 1);

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
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5AldBIuAXDiV62i1w99hkgor3t6xEK9Va6Esr1Ar', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRFlqbHM1ZW1pNGt0bHU4U2c5a3dUZ0RBckFhYnk2MlpjVEdMU0UxcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL3RvdXJuYW1lbnRzIjtzOjU6InJvdXRlIjtzOjIyOiJ1c2VyLnRvdXJuYW1lbnRzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1781667101),
('fRKIPSsOta7BtmzHzXCKciuyHGckjycJ334QMPRK', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRlYxemVWVWo0N3ZLd05abmo1TTJmWXB1U2pUOXNCbHdlRFNGQjB1QyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi90b3VybmFtZW50cyI7czo1OiJyb3V0ZSI7czoyMzoiYWRtaW4udG91cm5hbWVudHMuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1781499430);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `participant_type` enum('team','player') NOT NULL DEFAULT 'team',
  `name` varchar(255) NOT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `owner_id`, `participant_type`, `name`, `contact_email`, `contact_phone`, `institution`, `logo`, `created_at`, `updated_at`) VALUES
(2, 2, 'team', 'gogosquad', 'reja@gmail.com', '082126912353', 'unsyiah', '-', '2026-06-03 08:05:34', '2026-06-03 08:05:34'),
(3, 2, 'team', 'gelok', '123@gmail.com', '08888888', 'unsyiah', NULL, '2026-06-03 08:23:55', '2026-06-03 08:23:55'),
(4, 2, 'team', 'okelah', '234@gmail.com', '07777777', 'unsyiah', NULL, '2026-06-03 08:24:17', '2026-06-03 08:24:17'),
(5, 2, 'team', 'walahdek', 'okeoek@gmail.com', '023444444', 'unsyiah', NULL, '2026-06-03 08:24:50', '2026-06-03 08:24:50'),
(6, 2, 'team', 'bebkyaa', 'bebek@gmail.com', '0333333333', 'unsyiah', NULL, '2026-06-03 08:25:12', '2026-06-03 08:25:12'),
(7, 2, 'team', 'werrrrrrrr', 'wrr@gmail.com', '0333333333', 'unsyiah', NULL, '2026-06-03 08:25:33', '2026-06-03 08:25:33'),
(8, 2, 'team', 'woilaacok', 'jiiiiii@gmail.com', '05555555', 'unsyiah', NULL, '2026-06-03 08:26:04', '2026-06-03 08:26:04'),
(9, 2, 'team', 'dekmisiiya', 'mntf@gmail.com', '0444444444', 'unsyiah', NULL, '2026-06-03 08:26:37', '2026-06-03 08:26:37'),
(10, 2, 'team', 'lekleklek', 'leel@gmail.com', '0111111111', 'unsyiah', NULL, '2026-06-03 08:26:58', '2026-06-03 08:26:58'),
(11, 2, 'team', 'wewewyyyy', 'wyy@gmail.com', '0333333333', 'unsyiah', NULL, '2026-06-03 08:27:21', '2026-06-03 08:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `game_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('single_elimination') NOT NULL DEFAULT 'single_elimination',
  `max_participants` smallint(5) UNSIGNED NOT NULL DEFAULT 8,
  `status` enum('draft','registration_open','registration_closed','ongoing','completed','cancelled') NOT NULL DEFAULT 'draft',
  `registration_start_at` datetime DEFAULT NULL,
  `registration_end_at` datetime DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `ended_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`id`, `created_by`, `name`, `slug`, `game_name`, `description`, `type`, `max_participants`, `status`, `registration_start_at`, `registration_end_at`, `started_at`, `ended_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Campus Esports Cup 2026', 'campus-esports-cup-2026', 'Mobile Legends', 'Turnamen single elimination untuk peserta kampus.', 'single_elimination', 8, 'completed', '2026-06-03 12:44:03', '2026-06-10 12:44:03', '2026-06-13 12:44:03', '2026-06-03 16:39:58', '2026-06-03 05:44:03', '2026-06-03 09:39:58'),
(4, 1, 'osimcup', 'osimcup', 'futsal XII', NULL, 'single_elimination', 4, 'completed', '2026-06-04 12:26:00', '2026-06-04 12:26:00', '2026-06-04 12:26:00', '2026-06-04 05:31:42', '2026-06-03 22:27:00', '2026-06-03 22:31:42'),
(5, 1, 'Camp-four', 'camp-four', 'badminton', 'Camp-four merupakan agenda tahunan yg diadakan oleh faklutas MIPA, mari bergabung dan ikut meramaikan acara ini!!', 'single_elimination', 4, 'completed', '2026-06-15 11:20:00', '2026-06-20 11:20:00', '2026-06-21 13:30:00', '2026-06-15 04:56:57', '2026-06-14 21:21:07', '2026-06-14 21:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `tournament_participants`
--

CREATE TABLE `tournament_participants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tournament_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `registered_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `seed_number` smallint(5) UNSIGNED DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `rejected_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tournament_participants`
--

INSERT INTO `tournament_participants` (`id`, `tournament_id`, `team_id`, `registered_by`, `status`, `seed_number`, `approved_at`, `rejected_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 'approved', 6, '2026-06-03 15:08:29', NULL, '2026-06-03 08:06:17', '2026-06-03 09:20:59'),
(2, 1, 11, 2, 'approved', 7, '2026-06-03 15:34:30', NULL, '2026-06-03 08:32:18', '2026-06-03 09:20:59'),
(3, 1, 10, 2, 'approved', 3, '2026-06-03 15:34:27', NULL, '2026-06-03 08:32:23', '2026-06-03 09:20:59'),
(4, 1, 9, 2, 'approved', 1, '2026-06-03 15:34:25', NULL, '2026-06-03 08:32:29', '2026-06-03 09:20:59'),
(5, 1, 8, 2, 'approved', 4, '2026-06-03 15:34:14', NULL, '2026-06-03 08:32:37', '2026-06-03 09:20:59'),
(6, 1, 7, 2, 'approved', 5, '2026-06-03 15:34:11', NULL, '2026-06-03 08:32:41', '2026-06-03 09:20:59'),
(7, 1, 6, 2, 'approved', 2, '2026-06-03 15:34:08', NULL, '2026-06-03 08:32:47', '2026-06-03 09:20:59'),
(8, 1, 5, 2, 'rejected', NULL, NULL, '2026-06-03 15:34:20', '2026-06-03 08:33:00', '2026-06-03 08:34:20'),
(9, 1, 3, 2, 'approved', 8, '2026-06-03 15:34:05', NULL, '2026-06-03 08:33:06', '2026-06-03 09:20:59'),
(10, 1, 4, 2, 'rejected', NULL, NULL, '2026-06-03 15:34:18', '2026-06-03 08:33:11', '2026-06-03 08:34:18'),
(11, 4, 8, 2, 'approved', 2, '2026-06-04 05:30:28', NULL, '2026-06-03 22:28:59', '2026-06-03 22:30:49'),
(12, 4, 6, 2, 'approved', 1, '2026-06-04 05:30:26', NULL, '2026-06-03 22:29:04', '2026-06-03 22:30:49'),
(13, 4, 3, 2, 'approved', 4, '2026-06-04 05:30:23', NULL, '2026-06-03 22:29:11', '2026-06-03 22:30:49'),
(14, 4, 2, 2, 'approved', 3, '2026-06-04 05:30:20', NULL, '2026-06-03 22:29:16', '2026-06-03 22:30:49'),
(15, 5, 9, 2, 'approved', 1, '2026-06-15 04:32:24', NULL, '2026-06-14 21:26:41', '2026-06-14 21:55:56'),
(16, 5, 7, 2, 'approved', 4, '2026-06-15 04:32:21', NULL, '2026-06-14 21:26:49', '2026-06-14 21:55:56'),
(17, 5, 6, 2, 'rejected', NULL, NULL, '2026-06-15 04:32:17', '2026-06-14 21:26:54', '2026-06-14 21:32:17'),
(18, 5, 5, 2, 'approved', 3, '2026-06-15 04:32:14', NULL, '2026-06-14 21:27:00', '2026-06-14 21:55:56'),
(19, 5, 3, 2, 'approved', 2, '2026-06-15 04:32:11', NULL, '2026-06-14 21:27:06', '2026-06-14 21:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Tournament', 'admin@example.com', NULL, '$2y$12$ZD.tL8/116Xx8arISsHwEuFfXfS4VeIMkW1d1GeejeKT9FFx2LXW2', 'admin', NULL, '2026-06-03 05:44:02', '2026-06-03 05:44:02'),
(2, 'Peserta Demo', 'user@example.com', NULL, '$2y$12$HZz0tEVAj57jyOgfU2QrO.av5b6yG6ckjTGTuj75m4SyoD6z1UCIK', 'user', NULL, '2026-06-03 05:44:03', '2026-06-03 05:44:03'),
(3, 'Roseline Balqist', 'roselinebalqist@gmail.com', NULL, '$2y$12$GhC1kKkwc1NMzY9s53ZJgu.yeKTUZtpfCSJmgvCHNZXEyGkonvhvG', 'user', NULL, '2026-06-03 10:48:31', '2026-06-03 10:48:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matches_tournament_id_round_match_number_unique` (`tournament_id`,`round`,`match_number`),
  ADD KEY `matches_team_one_id_foreign` (`team_one_id`),
  ADD KEY `matches_team_two_id_foreign` (`team_two_id`),
  ADD KEY `matches_winner_id_foreign` (`winner_id`),
  ADD KEY `matches_next_match_id_foreign` (`next_match_id`),
  ADD KEY `matches_tournament_id_round_status_index` (`tournament_id`,`round`,`status`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teams_owner_id_name_unique` (`owner_id`,`name`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tournaments_slug_unique` (`slug`),
  ADD KEY `tournaments_created_by_foreign` (`created_by`),
  ADD KEY `tournaments_status_started_at_index` (`status`,`started_at`);

--
-- Indexes for table `tournament_participants`
--
ALTER TABLE `tournament_participants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tournament_participants_tournament_id_team_id_unique` (`tournament_id`,`team_id`),
  ADD KEY `tournament_participants_team_id_foreign` (`team_id`),
  ADD KEY `tournament_participants_registered_by_foreign` (`registered_by`),
  ADD KEY `tournament_participants_tournament_id_status_index` (`tournament_id`,`status`);

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
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tournament_participants`
--
ALTER TABLE `tournament_participants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_next_match_id_foreign` FOREIGN KEY (`next_match_id`) REFERENCES `matches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `matches_team_one_id_foreign` FOREIGN KEY (`team_one_id`) REFERENCES `tournament_participants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `matches_team_two_id_foreign` FOREIGN KEY (`team_two_id`) REFERENCES `tournament_participants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `matches_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matches_winner_id_foreign` FOREIGN KEY (`winner_id`) REFERENCES `tournament_participants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD CONSTRAINT `tournaments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tournament_participants`
--
ALTER TABLE `tournament_participants`
  ADD CONSTRAINT `tournament_participants_registered_by_foreign` FOREIGN KEY (`registered_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tournament_participants_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tournament_participants_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

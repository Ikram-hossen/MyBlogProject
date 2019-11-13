-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 04:17 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_blog_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(18, 'javascript', 'javascript', 'media/category/q2exB.2019-11-13-5dcbbc55deb67.png', NULL, NULL),
(19, 'PHP', 'php', 'media/category/uezfM.2019-11-13-5dcbbc7df3894.png', NULL, NULL),
(20, 'HTML', 'html', 'media/category/nHtQZ.2019-11-13-5dcbbce3106e9.png', NULL, NULL),
(21, 'Vue js', 'vue-js', 'media/category/Fy9zu.2019-11-13-5dcbbdce5890b.png', NULL, NULL),
(22, 'Laravel', 'laravel', 'media/category/tJJcB.2019-11-13-5dcbbe14c7a81.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`id`, `post_id`, `category_id`, `created_at`, `updated_at`) VALUES
(2, NULL, 4, '2019-11-11 02:04:52', '2019-11-11 02:04:52'),
(7, NULL, 5, '2019-11-11 03:39:40', '2019-11-11 03:39:40'),
(8, NULL, 4, '2019-11-11 09:38:56', '2019-11-11 09:38:56'),
(9, NULL, 5, '2019-11-11 09:38:56', '2019-11-11 09:38:56'),
(10, NULL, 4, '2019-11-11 09:41:23', '2019-11-11 09:41:23'),
(13, NULL, 4, '2019-11-11 15:43:44', '2019-11-11 15:43:44'),
(14, NULL, 4, '2019-11-11 15:52:17', '2019-11-11 15:52:17'),
(15, NULL, 5, '2019-11-11 16:03:16', '2019-11-11 16:03:16'),
(16, NULL, 4, '2019-11-12 04:01:18', '2019-11-12 04:01:18'),
(17, NULL, 4, '2019-11-12 04:04:28', '2019-11-12 04:04:28'),
(18, NULL, 5, '2019-11-12 05:58:33', '2019-11-12 05:58:33'),
(19, NULL, 4, '2019-11-12 06:05:09', '2019-11-12 06:05:09'),
(20, NULL, 4, '2019-11-12 06:31:44', '2019-11-12 06:31:44'),
(21, NULL, 4, '2019-11-12 06:32:13', '2019-11-12 06:32:13'),
(22, NULL, 4, '2019-11-12 06:33:29', '2019-11-12 06:33:29'),
(23, NULL, 4, '2019-11-12 06:34:14', '2019-11-12 06:34:14'),
(24, NULL, 4, '2019-11-12 06:34:37', '2019-11-12 06:34:37'),
(25, NULL, 4, '2019-11-12 06:35:55', '2019-11-12 06:35:55'),
(26, NULL, 4, '2019-11-12 06:36:16', '2019-11-12 06:36:16'),
(27, NULL, 4, '2019-11-12 06:47:56', '2019-11-12 06:47:56'),
(28, NULL, 4, '2019-11-12 08:32:38', '2019-11-12 08:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_11_03_184646_create_roles_table', 1),
(12, '2019_11_05_150041_create_tags_table', 1),
(13, '2019_11_06_160416_create_categories_table', 1),
(14, '2019_11_07_104306_create_posts_table', 1),
(15, '2019_11_07_104624_create_category_post_table', 1),
(16, '2019_11_07_104704_create_post_tag_table', 1),
(17, '2019_11_11_193610_create_subscribers_table', 2),
(18, '2019_11_12_141304_create_jobs_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `image`, `body`, `view_count`, `status`, `is_approved`, `created_at`, `updated_at`) VALUES
(2, 1, 'New Blog', 'new-blog', 'new-blog-2019-11-11-5dc92c59c102c.jpg', '<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage,</p>\r\n<p>&nbsp;</p>\r\n<p>I going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>', 0, 1, 1, '2019-11-11 03:39:40', '2019-11-11 03:39:40'),
(9, 1, 'html', 'html', 'html-2019-11-12-5dca83ac7ce89.pngmedia/post', '<p>html</p>', 0, 1, 1, '2019-11-12 04:04:28', '2019-11-12 04:04:28'),
(10, 2, 'JavaScript', 'javascript', 'javascript-2019-11-12-5dca9e666f598.png', '<p>JavaScript</p>', 0, 1, 1, '2019-11-12 05:58:33', '2019-11-12 06:01:16'),
(11, 2, 'Laravel', 'laravel', 'laravel-2019-11-12-5dca9ff38a9d6.png', '<p>Laravel is Php Framework</p>', 0, 1, 1, '2019-11-12 06:05:09', '2019-11-12 06:06:42'),
(12, 1, 'test', 'test', 'test-2019-11-12-5dcaa630bb4ca.jpg', '<p>test</p>', 0, 1, 1, '2019-11-12 06:31:44', '2019-11-12 06:31:44'),
(15, 1, 'test1', 'test1', 'default.png', '<p>test</p>', 0, 1, 1, '2019-11-12 06:34:38', '2019-11-12 06:34:38'),
(17, 1, 'test2', 'test2', 'default.png', '<p>test</p>', 0, 1, 1, '2019-11-12 06:36:16', '2019-11-12 06:36:16'),
(18, 2, 'new html post', 'new-html-post', 'new-html-post-2019-11-12-5dcaa9f9e214f.jpg', '<p>hello bloger</p>', 0, 1, 1, '2019-11-12 06:47:56', '2019-11-12 06:48:48'),
(19, 1, 'vue js', 'vue-js', 'default.png', '<p>vue</p>', 0, 1, 1, '2019-11-12 08:32:38', '2019-11-12 08:32:38'),
(20, 1, 'Bangla Blog post', '', 'media/post/bOgfS.2019-11-13-5dcbc31c2fbca.jpg', '<p>Bangla Blog post</p>', 0, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(2, NULL, 1, '2019-11-11 02:04:52', '2019-11-11 02:04:52'),
(7, 2, 1, '2019-11-11 03:39:40', '2019-11-11 03:39:40'),
(8, 2, 2, '2019-11-11 03:39:40', '2019-11-11 03:39:40'),
(9, NULL, 2, '2019-11-11 09:38:56', '2019-11-11 09:38:56'),
(10, NULL, 1, '2019-11-11 09:41:23', '2019-11-11 09:41:23'),
(13, NULL, 1, '2019-11-11 15:43:44', '2019-11-11 15:43:44'),
(14, NULL, 1, '2019-11-11 15:52:17', '2019-11-11 15:52:17'),
(15, NULL, 2, '2019-11-11 15:52:17', '2019-11-11 15:52:17'),
(16, NULL, 2, '2019-11-11 16:03:16', '2019-11-11 16:03:16'),
(17, NULL, 1, '2019-11-12 04:01:18', '2019-11-12 04:01:18'),
(18, NULL, 1, '2019-11-12 04:04:28', '2019-11-12 04:04:28'),
(19, NULL, 2, '2019-11-12 05:58:33', '2019-11-12 05:58:33'),
(20, NULL, 1, '2019-11-12 06:05:09', '2019-11-12 06:05:09'),
(21, NULL, 1, '2019-11-12 06:31:44', '2019-11-12 06:31:44'),
(22, NULL, 1, '2019-11-12 06:32:13', '2019-11-12 06:32:13'),
(23, NULL, 1, '2019-11-12 06:33:29', '2019-11-12 06:33:29'),
(24, NULL, 1, '2019-11-12 06:34:14', '2019-11-12 06:34:14'),
(25, NULL, 1, '2019-11-12 06:34:37', '2019-11-12 06:34:37'),
(26, NULL, 1, '2019-11-12 06:35:55', '2019-11-12 06:35:55'),
(27, NULL, 1, '2019-11-12 06:36:16', '2019-11-12 06:36:16'),
(28, NULL, 1, '2019-11-12 06:47:56', '2019-11-12 06:47:56'),
(29, NULL, 1, '2019-11-12 08:32:38', '2019-11-12 08:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL),
(2, 'Author', 'author', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'hello@gmail.com', '2019-11-11 13:58:53', '2019-11-11 13:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Laravel', 'laravel', '2019-11-09 07:35:41', '2019-11-09 07:35:41'),
(2, 'Vue js', 'vue-js', '2019-11-09 07:35:58', '2019-11-09 07:35:58'),
(3, 'PHP', 'php', '2019-11-13 02:29:29', '2019-11-13 02:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `about` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `email`, `email_verified_at`, `password`, `image`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mr.Admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$gVQRkygsbUXLhBKGNcatiuTc7kIo8p.Uq0kRL1zql9H1wEhH9qG0G', 'default.png', NULL, 'uA3P575Q4UafxgZgxqF94xhVqisEfJrRCzMuO0xWFjzY0f4c1couojuT87ad', NULL, NULL),
(2, 2, 'Mr.Author', 'author', 'author@gmail.com', NULL, '$2y$10$aWaa0PEyw1nAzgspwkaNmOdvkjG.eImvLYQF1MicrQJgiOQRzQSwm', 'default.png', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_post`
--
ALTER TABLE `category_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category_post`
--
ALTER TABLE `category_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

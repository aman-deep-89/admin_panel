-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2022 at 01:16 PM
-- Server version: 5.6.51-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konti_dummy`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_history`
--

CREATE TABLE `balance_history` (
  `bh_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` double(10,2) NOT NULL,
  `date` date NOT NULL,
  `bh_description` text,
  `bh_description2` text,
  `bh_images` text,
  `created_by` int(10) UNSIGNED NOT NULL,
  `bh_status` varchar(50) NOT NULL DEFAULT 'approved',
  `requested_amount` double(10,2) DEFAULT NULL,
  `bh_read` tinyint(1) DEFAULT NULL,
  `bh_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bh_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `balance_history`
--

INSERT INTO `balance_history` (`bh_id`, `user_id`, `amount`, `date`, `bh_description`, `bh_description2`, `bh_images`, `created_by`, `bh_status`, `requested_amount`, `bh_read`, `bh_created_at`, `bh_updated_at`) VALUES
(3, 4, 120.00, '2022-03-01', 'Sint repellendus et dolores. Tempore nihil molestiae quia adipisci dolor nobis. Id incidunt aut. Blanditiis nam temporibus sed itaque. Aperiam nesciunt accusamus.', '', '', 1, 'approved', 0.00, 0, '2022-03-02 18:02:35', '2022-03-04 01:40:38'),
(4, 4, 0.00, '2022-03-04', NULL, NULL, NULL, 4, 'rejected', 0.00, NULL, '2022-03-04 01:49:53', '2022-03-04 15:38:56'),
(6, 4, 100.00, '2022-03-04', NULL, 'khiuy iyiyo yui', '[\"1646359990_letter_head.jpg\"]', 4, 'approved', 0.00, NULL, '2022-03-04 02:13:12', '2022-03-04 04:07:24'),
(9, 2, 200.00, '2022-03-04', 'add bal to my acc', NULL, '[\"1646410020_5483871.png\"]', 2, 'approved', 6000.00, NULL, '2022-03-04 16:02:59', '2022-03-06 22:46:33'),
(10, 4, 15.60, '2022-03-07', 'HI', 'TYE', '[\"1646612962_agotado.png\"]', 4, 'approved', 15.60, NULL, '2022-03-07 00:29:25', '2022-03-07 00:30:33'),
(11, 8, 15.00, '2022-03-08', NULL, NULL, NULL, 1, 'approved', NULL, 0, '2022-03-08 14:05:13', '2022-03-08 14:05:13'),
(12, 8, 100.00, '2022-03-08', NULL, NULL, NULL, 1, 'approved', NULL, 0, '2022-03-08 15:07:19', '2022-03-08 15:07:19'),
(13, 8, 1000.00, '2022-03-09', NULL, NULL, NULL, 1, 'approved', NULL, 0, '2022-03-09 02:19:01', '2022-03-09 02:19:01'),
(14, 8, 10.20, '2022-03-09', NULL, NULL, NULL, 1, 'approved', NULL, 0, '2022-03-11 02:21:04', '2022-03-11 02:21:04'),
(15, 4, 10.50, '2022-03-11', 'k', NULL, NULL, 4, 'approved', 10.50, NULL, '2022-03-11 02:21:45', '2022-03-11 02:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int(10) UNSIGNED NOT NULL,
  `pd_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `issue_read` tinyint(1) DEFAULT '0',
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_description` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_25_120743_create_roles_table', 1),
(6, '2022_02_25_122046_create_permissions_table', 1),
(7, '2022_02_25_122841_create_users_permissions_table', 1),
(8, '2022_02_25_122931_create_users_roles_table', 1),
(9, '2022_02_25_123017_create_roles_permissions_table', 1),
(10, '2022_02_28_225628_create_products_table', 2),
(12, '2022_03_02_183406_create_notifications_table', 3),
(13, '2022_03_04_222156_create_purchases_table', 4),
(14, '2022_03_04_223105_create_purchase_details_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(10) UNSIGNED NOT NULL,
  `user_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `date_created` date DEFAULT NULL,
  `notification_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `n_enable` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `date_created`, `notification_title`, `notification_text`, `n_enable`, `created_at`, `updated_at`) VALUES
(1, '2,4', NULL, 'Dynamic Security Strategist', 'Id dolorem quasi cupiditate ducimus itaque. Minima rerum doloremque architecto dolorem animi ut odit et porro. Voluptatem aperiam aut inventore iusto iure error necessitatibus.', 1, '2022-03-03 03:12:13', '2022-03-04 06:10:37'),
(3, NULL, NULL, 'Dynamic Security Strategist', 'Id dolorem quasi cupiditate ducimus itaque. Minima rerum doloremque architecto dolorem animi ut odit et porro. Voluptatem aperiam aut inventore iusto iure error necessitatibus.', 1, '2022-03-04 06:09:50', '2022-03-04 06:10:44'),
(4, '8', NULL, 'hola', 'prueba 2', 1, '2022-03-10 08:07:36', '2022-03-10 08:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Create Tasks', 'create-tasks', '2022-02-25 21:58:04', '2022-02-25 21:58:04'),
(2, 'Edit Users', 'edit-users', '2022-02-25 21:58:04', '2022-02-25 21:58:04'),
(3, 'Create Tasks', 'create-tasks', '2022-02-25 21:58:05', '2022-02-25 21:58:05'),
(4, 'Edit Users', 'edit-users', '2022-02-25 21:58:05', '2022-02-25 21:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `p_enable` tinyint(1) NOT NULL,
  `opening_stock` double(10,2) NOT NULL,
  `total_sales` double(10,2) DEFAULT NULL,
  `total_purchase` double(10,2) DEFAULT NULL,
  `closing_stock` double(10,2) NOT NULL,
  `out_of_stock` tinyint(1) DEFAULT '0',
  `stock_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `sku`, `price`, `p_enable`, `opening_stock`, `total_sales`, `total_purchase`, `closing_stock`, `out_of_stock`, `stock_unit`, `photos`, `created_at`, `updated_at`) VALUES
(2, 'Eino Littlekjhkk hkjhk jh', 'Recusandae sit quia pariatur cumque.', 'Velit corporis quia esse ullam in.', 213.00, 1, 622.00, 22.00, NULL, 600.00, 1, NULL, '[\"1646350060_admin_panel.jpg\",\"1646350067_Background-removal-service-Portfolio-1.jpg\"]', '2022-03-01 09:42:56', '2022-03-11 10:00:40'),
(3, 'iuouo', NULL, 'iuio', 9878.00, 1, 3.00, 1.00, NULL, 2.00, 0, NULL, '[\"1646350237_ad1.jpg\"]', '2022-03-04 07:36:29', '2022-03-06 03:14:29'),
(4, 'AMAZON PRIME VIDE', 'Las cuentas son completas, tienen una duración de 27 a 30 días', '1122', 0.50, 1, 5.00, 41.00, NULL, -36.00, 0, NULL, '[\"1646747815_prime.jpg\"]', '2022-03-08 20:57:43', '2022-03-12 01:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `total_price` int(10) UNSIGNED NOT NULL,
  `p_read` tinyint(1) NOT NULL,
  `p_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `p_creation_date` timestamp NULL DEFAULT NULL,
  `p_updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `user_id`, `product_id`, `quantity`, `total_price`, `p_read`, `p_status`, `p_creation_date`, `p_updated_date`) VALUES
(29, 2, 2, 1, 213, 1, 'completed', '2022-03-07 05:01:34', '2022-03-07 05:01:45'),
(30, 2, 2, 1, 213, 1, 'completed', '2022-03-07 05:01:49', '2022-03-10 07:59:36'),
(31, 2, 2, 1, 213, 1, 'completed', '2022-03-07 06:00:44', '2022-03-07 06:02:27'),
(32, 4, 2, 0, 0, 1, 'completed', '2022-03-07 07:22:58', '2022-03-10 07:59:25'),
(33, 4, 2, 1, 213, 1, 'completed', '2022-03-08 11:10:54', '2022-03-12 02:11:47'),
(34, 8, 4, 4, 3, 1, 'completed', '2022-03-08 20:58:25', '2022-03-10 12:17:42'),
(35, 8, 4, 1, 1, 1, 'completed', '2022-03-08 21:15:57', '2022-03-12 01:01:41'),
(36, 8, 4, 2, 1, 1, 'completed', '2022-03-08 22:03:02', '2022-03-08 22:04:10'),
(37, 8, 4, 3, 2, 1, 'completed', '2022-03-08 22:04:56', '2022-03-08 22:05:07'),
(38, 4, 4, 2, 1, 1, 'completed', '2022-03-09 09:37:15', '2022-03-12 00:51:35'),
(39, 8, 4, 1, 1, 1, 'completed', '2022-03-09 11:17:42', '2022-03-12 00:51:07'),
(40, 4, 4, 1, 1, 1, 'completed', '2022-03-10 07:36:12', '2022-03-10 07:36:22'),
(41, 4, 4, 5, 3, 1, 'completed', '2022-03-10 07:46:42', '2022-03-10 07:55:57'),
(42, 4, 4, 4, 2, 1, 'completed', '2022-03-10 07:55:28', '2022-03-11 08:26:32'),
(43, 8, 4, 4, 2, 1, 'completed', '2022-03-10 08:05:17', '2022-03-11 08:26:10'),
(44, 2, 4, 1, 1, 1, 'completed', '2022-03-10 08:19:33', '2022-03-10 12:15:30'),
(45, 4, 2, 2, 426, 1, 'completed', '2022-03-11 09:07:12', '2022-03-11 09:08:17'),
(46, 4, 4, 2, 1, 1, 'completed', '2022-03-11 09:15:05', '2022-03-11 09:54:04'),
(47, 2, 4, 3, 2, 1, 'completed', '2022-03-12 00:50:49', '2022-03-12 01:01:19'),
(48, 4, 4, 3, 2, 1, 'completed', '2022-03-12 01:21:08', '2022-03-12 01:21:27'),
(49, 4, 4, 1, 1, 1, 'completed', '2022-03-12 01:21:45', '2022-03-12 01:22:55'),
(50, 4, 4, 1, 1, 0, 'pending', '2022-03-12 01:23:57', '2022-03-12 01:23:57'),
(51, 4, 4, 1, 1, 0, 'pending', '2022-03-12 01:25:35', '2022-03-12 01:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `pd_id` int(10) UNSIGNED NOT NULL,
  `purchase_id` int(10) UNSIGNED NOT NULL,
  `pd_quantity` int(10) UNSIGNED NOT NULL,
  `pd_username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pd_password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pd_start_date` date DEFAULT NULL,
  `pd_end_date` date DEFAULT NULL,
  `pd_remarks` text COLLATE utf8mb4_unicode_ci,
  `pd_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_reported` tinyint(1) DEFAULT '0',
  `pd_read` tinyint(1) DEFAULT NULL,
  `pd_updated` tinyint(1) DEFAULT '0',
  `pd_price` double(10,2) NOT NULL,
  `pd_cost` double(10,2) DEFAULT NULL,
  `pd_creation_date` timestamp NULL DEFAULT NULL,
  `pd_updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`pd_id`, `purchase_id`, `pd_quantity`, `pd_username`, `pd_password`, `pd_start_date`, `pd_end_date`, `pd_remarks`, `pd_status`, `issue_reported`, `pd_read`, `pd_updated`, `pd_price`, `pd_cost`, `pd_creation_date`, `pd_updated_date`) VALUES
(20, 29, 1, 'jhkjh', 'hkhk', '2022-03-01', '2022-03-08', NULL, 'accepted', 0, 1, 0, 213.00, NULL, '2022-03-07 05:01:34', '2022-03-11 09:13:14'),
(22, 30, 1, 'iyiy', 'iyiyiuy', '2022-03-01', '2022-03-22', NULL, 'accepted', 0, 0, 0, 213.00, NULL, '2022-03-07 05:01:49', '2022-03-07 05:54:28'),
(23, 31, 1, 'utut', 'ututut', '2022-03-01', '2022-03-21', NULL, 'accepted', 0, 0, 0, 213.00, NULL, '2022-03-07 06:00:44', '2022-03-07 06:02:36'),
(28, 33, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 1, 0, 213.00, NULL, '2022-03-08 11:10:54', '2022-03-11 09:16:09'),
(30, 34, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-08 20:58:25', '2022-03-08 21:00:10'),
(31, 34, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-08 20:58:25', '2022-03-08 21:00:10'),
(33, 34, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-08 20:58:25', '2022-03-08 21:00:10'),
(34, 34, 1, 'appp.996@yopmail.net', 'cliente2022', '2022-03-08', '2022-04-08', NULL, 'accepted', 0, 0, 0, 0.50, NULL, '2022-03-08 20:58:25', '2022-03-08 21:00:10'),
(35, 35, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-08 21:15:57', '2022-03-12 01:01:41'),
(36, 36, 1, NULL, NULL, NULL, NULL, NULL, 'pending', 0, 0, 0, 0.50, NULL, '2022-03-08 22:03:02', '2022-03-08 22:03:02'),
(37, 36, 1, 'DSRFAS', 'DAFD', '2022-03-08', '2022-04-08', NULL, 'accepted', 0, 0, 0, 0.50, NULL, '2022-03-08 22:03:02', '2022-03-08 22:04:29'),
(38, 37, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-08 22:04:56', '2022-03-08 22:05:19'),
(39, 37, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-08 22:04:56', '2022-03-08 22:05:19'),
(40, 37, 1, 'DSF', 'DSF', '2022-03-16', '2022-03-23', NULL, 'accepted', 0, 0, 0, 0.50, NULL, '2022-03-08 22:04:56', '2022-03-08 22:05:19'),
(41, 38, 1, 'SAD', 'SD', '2022-03-11', '2022-03-25', NULL, 'accepted', 0, 1, 0, 0.50, 10.00, '2022-03-09 09:37:15', '2022-03-12 02:00:15'),
(42, 38, 1, 'SAD', 'SD', '2022-03-11', '2022-03-25', NULL, 'accepted', 0, 1, 0, 0.50, 10.00, '2022-03-09 09:37:15', '2022-03-12 02:00:15'),
(43, 39, 1, 'S', 'SA', '2022-03-11', '2022-03-25', NULL, 'accepted', 0, 0, 0, 0.50, 12.00, '2022-03-09 11:17:42', '2022-03-12 00:51:07'),
(44, 40, 1, 'jnk', 'jkn', '2022-03-07', '2022-03-09', NULL, 'accepted', 0, 1, 0, 0.50, 10.00, '2022-03-10 07:36:13', '2022-03-11 21:04:52'),
(45, 41, 1, 'alejandroortiz_32@hotmsd.com', 'jklsf', '2022-03-09', '2022-03-30', NULL, 'accepted', 0, 1, 0, 0.50, 10.00, '2022-03-10 07:46:42', '2022-03-12 01:24:42'),
(46, 41, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 1, 0, 0.50, NULL, '2022-03-10 07:46:42', '2022-03-12 01:24:42'),
(47, 41, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 1, 0, 0.50, NULL, '2022-03-10 07:46:42', '2022-03-12 01:24:42'),
(48, 41, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 1, 0, 0.50, NULL, '2022-03-10 07:46:42', '2022-03-12 01:24:42'),
(49, 41, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 1, 0, 0.50, NULL, '2022-03-10 07:46:42', '2022-03-12 01:24:42'),
(50, 42, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-10 07:55:28', '2022-03-11 08:26:32'),
(51, 42, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-10 07:55:28', '2022-03-11 08:26:32'),
(52, 42, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-10 07:55:28', '2022-03-11 08:26:32'),
(53, 42, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-10 07:55:28', '2022-03-11 08:26:32'),
(54, 43, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-10 08:05:17', '2022-03-11 08:26:10'),
(55, 43, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-10 08:05:17', '2022-03-11 08:26:10'),
(56, 43, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-10 08:05:17', '2022-03-11 08:26:10'),
(57, 43, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-10 08:05:17', '2022-03-11 08:26:10'),
(58, 44, 1, 'pruebitas@hotmsd.com', 'jn', '2022-03-10', '2022-04-10', NULL, 'accepted', 0, 0, 1, 0.50, 4.00, '2022-03-10 08:19:33', '2022-03-11 09:25:13'),
(59, 45, 1, 'alejandroortiz_32@hotmsd.com', '123', '2022-03-10', '2022-03-25', NULL, 'accepted', 0, 1, 0, 213.00, 10.00, '2022-03-11 09:07:12', '2022-03-12 01:50:33'),
(60, 45, 1, 'knl', '1254', '2022-03-10', '2022-03-25', NULL, 'accepted', 0, 1, 0, 213.00, 10.00, '2022-03-11 09:07:12', '2022-03-12 01:50:33'),
(61, 46, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-11 09:15:05', '2022-03-11 09:54:04'),
(62, 46, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-11 09:15:05', '2022-03-11 09:54:04'),
(63, 47, 1, 'Emmalee10', '12', '2022-03-01', '2022-03-31', NULL, 'accepted', 0, 0, 0, 0.50, 100.00, '2022-03-12 00:50:49', '2022-03-12 01:00:50'),
(64, 47, 1, 'Flavio96', 'pokswsYLpkZni2C', '2022-03-01', '2022-03-31', NULL, 'accepted', 0, 0, 0, 0.50, 1.00, '2022-03-12 00:50:49', '2022-03-12 01:01:28'),
(65, 47, 1, 'Lacy.Will9', '3HxDqkoukFPENAJ', '2022-03-01', '2022-04-11', NULL, 'accepted', 0, 0, 0, 0.50, 1.00, '2022-03-12 00:50:49', '2022-03-12 01:01:28'),
(66, 48, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-12 01:21:08', '2022-03-12 01:21:27'),
(67, 48, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-12 01:21:08', '2022-03-12 01:21:27'),
(68, 48, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-12 01:21:08', '2022-03-12 01:21:27'),
(69, 49, 1, NULL, NULL, NULL, NULL, NULL, 'rejected', 0, 0, 0, 0.50, NULL, '2022-03-12 01:21:45', '2022-03-12 01:22:55'),
(70, 50, 1, NULL, NULL, NULL, NULL, NULL, 'pending', 0, 0, 0, 0.50, NULL, '2022-03-12 01:23:57', '2022-03-12 01:23:57'),
(71, 51, 1, NULL, NULL, NULL, NULL, NULL, 'pending', 0, 0, 0, 0.50, NULL, '2022-03-12 01:25:35', '2022-03-12 01:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '2022-02-25 21:58:04', '2022-02-25 21:58:04'),
(2, 'User', 'user', '2022-02-25 21:58:04', '2022-02-25 21:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(2, 2),
(1, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternate_phone_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `internal_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_img` text COLLATE utf8mb4_unicode_ci,
  `initial_balance` double NOT NULL DEFAULT '0',
  `current_balance` double(10,2) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `phone_number`, `alternate_phone_number`, `internal_data`, `vendor`, `business_type`, `profile_img`, `initial_balance`, `current_balance`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', 'istrator', 'admin@gmail.com', NULL, '$2y$10$IK8lPE2hUs047FrGG3.CP.gMxegth1QWiY0rkcBRgAhn0NRBvC.nK', '526-725-5361', NULL, 'uyuiyiy', 'iyiuy', 'uyiuyuiyiyi', '', 0, 0.00, NULL, '2022-02-25 21:58:04', '2022-03-12 01:54:55'),
(2, 'user', 'User', 'User', 'Dummy', 'user@gmail.com', NULL, '$2y$10$Sd4Ot8wz1GbDV5gZMyiXReT3ouxX8MNah9IWctkhqmNrNdDM6soIu', '225-111-1023', NULL, 'uiyi', 'iyiuy', 'iuyiuyiuy', '', 0, 5199.00, NULL, '2022-02-25 21:58:04', '2022-03-12 01:01:19'),
(4, 'user2', NULL, 'Ludwig', 'Zemlak', 'your.email+faker51041@gmail.com', NULL, '$2y$10$rju6hfDfIDJxpMIl/rzda.EXIjr/6S9ytYHAxcE3EOyad3r9Ry.jy', '353-046-3289', '039-398-0378', 'oiuiuiouiouiojlk kjkj', 'Corporis est sit.', '772-739-8134', '01646172469-avatar.png', 7096, 6693.10, NULL, '2022-03-01 05:04:22', '2022-03-12 01:25:35'),
(7, 'abc', NULL, 'Jaylon', 'Herzog', 'your.email+faker12811@gmail.com', NULL, '$2y$10$ZYiU1gt3xjgKaPeSX/KGo.7ec6xT1hfreBXv.5C3XKkdRDjOUmKDG', '564-541-0282', '257-376-4676', '752-956-5741', 'Aliquid in maiores aut.', '91197 Holden Unions', NULL, 529, 529.00, NULL, '2022-03-08 12:08:08', '2022-03-08 12:08:08'),
(8, 'alejandro', NULL, 'Alejandro', 'Yar', 'alejandroortiz_32@hotmail.com', NULL, '$2y$10$4dGvpk7dWC.Sa.7NQjLJFeXI/OMy8wDlhzryu6LPPyheJmnw06XTC', '0963103646', '09663', 'Nada', 'Leo', 'Cyber', NULL, 25, 1147.70, NULL, '2022-03-08 20:55:41', '2022-03-12 01:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`user_id`, `permission_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(4, 2),
(7, 2),
(8, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance_history`
--
ALTER TABLE `balance_history`
  ADD PRIMARY KEY (`bh_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issues_pd_id_foreign` (`pd_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`(191),`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `purchases_user_id_foreign` (`user_id`),
  ADD KEY `purchases_product_id` (`product_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `purchase_details_purchase_id_foreign` (`purchase_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `roles_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `users_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `users_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance_history`
--
ALTER TABLE `balance_history`
  MODIFY `bh_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `pd_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `issues_pd_id_foreign` FOREIGN KEY (`pd_id`) REFERENCES `purchase_details` (`pd_id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`purchase_id`) ON DELETE CASCADE;

--
-- Constraints for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD CONSTRAINT `users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 21, 2026 at 09:05 PM
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
-- Database: `ethio_restaurant`
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
-- Table structure for table `cashier_shifts`
--

CREATE TABLE `cashier_shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL,
  `opening_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `closing_balance` decimal(10,2) DEFAULT NULL,
  `expected_balance` decimal(10,2) DEFAULT NULL,
  `difference` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_am` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `name_am`, `description`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Ethiopian Stews', NULL, NULL, NULL, 1, '2026-05-03 15:03:19', '2026-05-03 15:03:19'),
(2, 'Grilled Meats', NULL, NULL, NULL, 1, '2026-05-03 15:03:19', '2026-05-03 15:03:19'),
(3, 'Vegetarian', NULL, NULL, NULL, 1, '2026-05-03 15:03:19', '2026-05-03 15:03:19'),
(4, 'Beverages', NULL, NULL, NULL, 1, '2026-05-03 15:03:19', '2026-05-03 15:03:19');

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
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_am` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 50,
  `low_stock_threshold` int(11) NOT NULL DEFAULT 10,
  `image` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `is_spicy` tinyint(1) NOT NULL DEFAULT 0,
  `is_vegetarian` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `category_id`, `name`, `name_am`, `description`, `price`, `stock`, `low_stock_threshold`, `image`, `image_url`, `is_available`, `is_spicy`, `is_vegetarian`, `created_at`, `updated_at`) VALUES
(1, 1, 'doro', NULL, 'Spicy chicken stew with boiled egg', 1200.00, 49, 10, 'foods/1777832302_1.jpg', NULL, 1, 1, 1, '2026-05-03 15:03:19', '2026-05-13 14:53:10'),
(2, 1, 'Key Siga Wot', NULL, 'Spicy beef stew', 150.00, 49, 10, 'foods/1777832820_2.jpeg', NULL, 1, 1, 0, '2026-05-03 15:03:20', '2026-05-11 06:14:10'),
(3, 2, 'Lamb Tibs', NULL, 'Sauteed lamb with rosemary', 240.00, 50, 10, 'foods/1777832838_3.jpg', NULL, 1, 1, 0, '2026-05-03 15:03:20', '2026-05-03 15:27:18'),
(4, 2, 'Beef Tibs', NULL, 'Sauteed beef with vegetables', 190.00, 50, 10, 'foods/1777833037_4.jfif', NULL, 1, 0, 0, '2026-05-03 15:03:20', '2026-05-03 15:30:37'),
(5, 3, 'Shiro Wet', NULL, 'Chickpea flour stew', 90.00, 50, 10, 'foods/1777832912_5.jfif', NULL, 1, 1, 1, '2026-05-03 15:03:20', '2026-05-03 15:28:32'),
(6, 3, 'Misir Wot', NULL, 'Red lentil stew', 85.00, 50, 10, 'foods/1777832926_6.jfif', NULL, 1, 1, 1, '2026-05-03 15:03:20', '2026-05-03 15:28:46'),
(7, 4, 'Ethiopian Coffee', NULL, 'Traditional coffee ceremony', 60.00, 50, 10, 'foods/1777832938_7.jpg', NULL, 1, 0, 0, '2026-05-03 15:03:20', '2026-05-03 15:28:58'),
(8, 4, 'Tej', NULL, 'Traditional honey wine', 80.00, 50, 10, 'foods/1777832950_8.jfif', NULL, 1, 0, 0, '2026-05-03 15:03:20', '2026-05-03 15:29:10'),
(9, 4, 'Coca Cola', NULL, 'Soft drink', 25.00, 50, 10, 'foods/1777832962_9.jfif', NULL, 1, 0, 0, '2026-05-03 15:03:20', '2026-05-03 15:29:22'),
(11, 1, 'ater', NULL, 'wqqd', 222.00, 50, 10, 'foods/ybO1R3p3Sb6fkgzQEHXvKIXRJADG6ydI3sIIYBWz.webp', NULL, 1, 1, 0, '2026-05-04 03:01:28', '2026-05-04 03:01:30'),
(13, 1, 'kitfo', NULL, 'food', 3000.00, 50, 10, 'foods/lblexqgqun7Sv5IXdgkE1i5mfq3quqN7M3zKi68u.webp', NULL, 1, 0, 0, '2026-05-11 18:13:48', '2026-05-11 18:13:48'),
(15, 1, 'beyaynet', NULL, 'food', 200.00, 50, 10, 'foods/N3hxFsSZR69Z9mRI6W20XTLO7TMqP0ec9iHIwCEi.jpg', NULL, 1, 1, 0, '2026-05-11 18:15:16', '2026-05-11 18:15:55');

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
(29, '0001_01_01_000000_create_users_table', 1),
(30, '0001_01_01_000001_create_cache_table', 1),
(31, '0001_01_01_000002_create_jobs_table', 1),
(32, '2026_04_29_181010_create_categories_table', 1),
(33, '2026_04_29_181026_create_foods_table', 1),
(34, '2026_04_29_181034_create_tables_table', 1),
(35, '2026_04_29_181041_create_orders_table', 1),
(36, '2026_04_29_181048_create_order_items_table', 1),
(37, '2026_04_29_181058_create_reservations_table', 1),
(38, '2026_04_29_181106_create_payments_table', 1),
(39, '2026_04_29_184109_add_image_to_foods_table', 1),
(40, '2026_04_29_192124_add_role_to_users_table', 1),
(41, '2026_05_01_181105_add_occupied_to_tables_table', 1),
(42, '2026_05_01_183409_add_max_tables_setting', 1),
(43, '2026_05_03_194648_add_payment_columns_to_orders', 2),
(44, '2026_05_03_210242_fix_tables_columns', 3),
(45, '2026_05_11_070028_add_transaction_id_to_payments', 4),
(46, '2026_05_11_070432_update_users_role_enum', 5),
(47, '2026_05_11_083539_add_stock_to_foods', 6),
(48, '2026_05_11_083552_add_stock_to_foods', 6),
(49, '2026_05_11_090459_add_cancellation_fields_to_orders', 7),
(50, '2026_05_11_090519_create_cashier_shifts_table', 7),
(51, '2026_05_11_090535_create_tax_settings_table', 7),
(52, '2026_05_11_090557_add_transaction_fields_to_payments', 8),
(53, '2026_05_11_091751_add_missing_payment_columns', 9),
(54, '2026_05_11_181302_add_customer_fields_to_orders', 10),
(55, '2026_05_11_183232_make_user_id_nullable_in_orders', 11),
(56, '2026_05_13_173842_add_order_type_to_orders', 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `order_type` varchar(255) NOT NULL DEFAULT 'dine_in',
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `status` enum('pending','preparing','ready','served','paid','cancelled') NOT NULL DEFAULT 'pending',
  `cancellation_reason` varchar(255) DEFAULT NULL,
  `cancelled_by` varchar(255) DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `payment_status` enum('unpaid','partial','paid') NOT NULL DEFAULT 'unpaid',
  `payment_method` varchar(255) DEFAULT NULL,
  `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `change_due` decimal(10,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `service_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `special_instructions` text DEFAULT NULL,
  `ordered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `table_id`, `order_type`, `customer_name`, `customer_phone`, `status`, `cancellation_reason`, `cancelled_by`, `cancelled_at`, `payment_status`, `payment_method`, `amount_paid`, `change_due`, `subtotal`, `tax`, `service_charge`, `total`, `special_instructions`, `ordered_at`, `created_at`, `updated_at`) VALUES
(1, 'ORD-20260503-1777832003', 1, 1, 'dine_in', NULL, NULL, 'cancelled', 'Other', 'Admin User (admin)', '2026-05-11 06:22:17', 'unpaid', NULL, 0.00, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-03 18:13:23', '2026-05-03 15:13:23', '2026-05-11 06:22:17'),
(2, 'ORD-20260503-1777832312', 1, 1, 'dine_in', NULL, NULL, 'cancelled', 'Customer request - Changed mind', 'Admin User (admin)', '2026-05-11 06:34:32', 'unpaid', NULL, 0.00, 0.00, 180.00, 9.00, 18.00, 207.00, NULL, '2026-05-03 18:18:32', '2026-05-03 15:18:32', '2026-05-11 06:34:32'),
(3, 'ORD-20260503-1777832478', 1, 1, 'dine_in', NULL, NULL, 'cancelled', 'Customer request - Changed mind', 'Admin User (admin)', '2026-05-11 06:34:49', 'unpaid', NULL, 0.00, 0.00, 180.00, 9.00, 18.00, 207.00, NULL, '2026-05-03 18:21:18', '2026-05-03 15:21:18', '2026-05-11 06:34:49'),
(4, 'ORD-20260503-1777832531', 1, 1, 'dine_in', NULL, NULL, 'cancelled', 'Customer request - Wrong order', 'Admin User (admin)', '2026-05-11 17:20:14', 'unpaid', NULL, 0.00, 0.00, 180.00, 9.00, 18.00, 207.00, NULL, '2026-05-03 18:22:11', '2026-05-03 15:22:11', '2026-05-11 17:20:14'),
(5, 'ORD-20260503-1777832746', 1, 1, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 180.00, 9.00, 18.00, 207.00, NULL, '2026-05-03 18:25:46', '2026-05-03 15:25:46', '2026-05-03 15:25:46'),
(6, 'ORD-20260503-1777834047', 1, 1, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 180.00, 9.00, 18.00, 207.00, NULL, '2026-05-03 18:47:27', '2026-05-03 15:47:27', '2026-05-03 15:47:27'),
(7, 'ORD-20260503-1777834379', 1, 3, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 85.00, 4.25, 8.50, 97.75, NULL, '2026-05-03 18:52:59', '2026-05-03 15:52:59', '2026-05-03 15:52:59'),
(8, 'ORD-20260503-1777835995', 1, 2, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 85.00, 4.25, 8.50, 97.75, NULL, '2026-05-03 19:19:55', '2026-05-03 16:19:55', '2026-05-03 16:19:55'),
(9, 'ORD-20260503-1777836052', 1, 4, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 1600.00, 80.00, 160.00, 1840.00, NULL, '2026-05-03 19:20:52', '2026-05-03 16:20:52', '2026-05-03 16:29:17'),
(10, 'ORD-20260503-1777836702', 1, 5, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 19:31:42', '2026-05-03 16:31:42', '2026-05-03 16:31:42'),
(11, 'ORD-20260503-1777837274', 1, 6, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 85.00, 4.25, 8.50, 97.75, NULL, '2026-05-03 19:41:14', '2026-05-03 16:41:14', '2026-05-03 16:41:14'),
(12, 'ORD-20260503-1777837492', 1, 7, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 19:44:52', '2026-05-03 16:44:52', '2026-05-03 16:44:52'),
(13, 'ORD-20260503-1777837579', 1, 8, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-03 19:46:19', '2026-05-03 16:46:19', '2026-05-03 16:46:19'),
(14, 'ORD-20260503-1777837714', 1, 9, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 19:48:34', '2026-05-03 16:48:34', '2026-05-03 16:48:34'),
(15, 'ORD-20260503-1777837782', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 19:49:42', '2026-05-03 16:49:42', '2026-05-03 17:00:37'),
(16, 'ORD-20260503-1777838083', 1, 2, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 276.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 19:54:43', '2026-05-03 16:54:43', '2026-05-03 16:54:45'),
(17, 'ORD-20260503-1777838324', 1, 2, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'telebirr', 286.00, 10.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 19:58:44', '2026-05-03 16:58:44', '2026-05-03 16:59:09'),
(18, 'ORD-20260503-1777838644', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'card', 175.00, 2.50, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-03 20:04:04', '2026-05-03 17:04:04', '2026-05-03 17:04:14'),
(19, 'ORD-20260503-1777838672', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 276.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 20:04:32', '2026-05-03 17:04:32', '2026-05-03 17:04:47'),
(20, 'ORD-20260503-1777838745', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 172.50, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-03 20:05:45', '2026-05-03 17:05:45', '2026-05-03 17:06:04'),
(21, 'ORD-20260503-1777838797', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 293.25, 0.00, 255.00, 12.75, 25.50, 293.25, NULL, '2026-05-03 20:06:37', '2026-05-03 17:06:37', '2026-05-03 17:06:52'),
(22, 'ORD-20260503-1777839218', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 276.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 20:13:38', '2026-05-03 17:13:38', '2026-05-03 17:13:48'),
(23, 'ORD-20260503-1777839475', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 172.50, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-03 20:17:55', '2026-05-03 17:17:55', '2026-05-03 17:18:06'),
(24, 'ORD-20260503-1777839821', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 276.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 20:23:41', '2026-05-03 17:23:41', '2026-05-03 17:23:52'),
(25, 'ORD-20260503-1777839864', 1, 1, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 20:24:24', '2026-05-03 17:24:24', '2026-05-03 17:24:24'),
(26, 'ORD-20260503-1777839876', 1, 2, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'card', 172.50, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-03 20:24:36', '2026-05-03 17:24:36', '2026-05-03 17:24:57'),
(27, 'ORD-20260503-1777839987', 1, 10, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 1840.00, 0.00, 1600.00, 80.00, 160.00, 1840.00, NULL, '2026-05-03 20:26:27', '2026-05-03 17:26:27', '2026-05-03 17:26:43'),
(28, 'ORD-20260503-1777840057', 1, 2, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 28.75, 0.00, 25.00, 1.25, 2.50, 28.75, NULL, '2026-05-03 20:27:37', '2026-05-03 17:27:37', '2026-05-03 17:28:03'),
(29, 'ORD-20260503-1777840092', 1, 2, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 276.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 20:28:12', '2026-05-03 17:28:12', '2026-05-03 17:28:25'),
(30, 'ORD-20260503-1777840114', 1, 2, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 28.75, 0.00, 25.00, 1.25, 2.50, 28.75, NULL, '2026-05-03 20:28:34', '2026-05-03 17:28:34', '2026-05-03 17:28:49'),
(31, 'ORD-20260503-1777840192', 1, 2, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 97.75, 0.00, 85.00, 4.25, 8.50, 97.75, NULL, '2026-05-03 20:29:52', '2026-05-03 17:29:52', '2026-05-03 17:30:03'),
(32, 'ORD-20260503-1777840430', 1, 3, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 276.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 20:33:50', '2026-05-03 17:33:50', '2026-05-03 17:33:59'),
(33, 'ORD-20260503-1777840668', 1, 2, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 103.50, 0.00, 90.00, 4.50, 9.00, 103.50, NULL, '2026-05-03 20:37:48', '2026-05-03 17:37:48', '2026-05-03 17:38:17'),
(34, 'ORD-20260503-1777841052', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 69.00, 0.00, 60.00, 3.00, 6.00, 69.00, NULL, '2026-05-03 20:44:12', '2026-05-03 17:44:12', '2026-05-03 17:44:20'),
(35, 'ORD-20260503-1777841092', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 1840.00, 0.00, 1600.00, 80.00, 160.00, 1840.00, NULL, '2026-05-03 20:44:52', '2026-05-03 17:44:52', '2026-05-03 17:45:01'),
(36, 'ORD-20260503-1777841195', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 172.50, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-03 20:46:35', '2026-05-03 17:46:35', '2026-05-03 17:46:49'),
(37, 'ORD-20260503-1777841310', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 103.50, 0.00, 90.00, 4.50, 9.00, 103.50, NULL, '2026-05-03 20:48:30', '2026-05-03 17:48:30', '2026-05-03 17:48:40'),
(38, 'ORD-20260503-1777841447', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 172.50, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-03 20:50:47', '2026-05-03 17:50:47', '2026-05-03 17:51:01'),
(39, 'ORD-20260503-1777841682', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 276.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-03 20:54:43', '2026-05-03 17:54:43', '2026-05-03 17:54:48'),
(40, 'ORD-20260503-1777841792', 1, 2, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 1600.00, 80.00, 160.00, 1840.00, NULL, '2026-05-03 20:56:32', '2026-05-03 17:56:32', '2026-05-03 17:56:32'),
(41, 'ORD-20260503-1777841827', 1, 1, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 1840.00, 92.00, 184.00, 2116.00, NULL, '2026-05-03 20:57:07', '2026-05-03 17:57:07', '2026-05-03 17:57:07'),
(42, 'ORD-20260503-1777841853', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 2116.00, 0.00, 1840.00, 92.00, 184.00, 2116.00, NULL, '2026-05-03 20:57:33', '2026-05-03 17:57:33', '2026-05-03 17:57:48'),
(43, 'ORD-20260503-1777841893', 1, 4, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 218.50, 0.00, 190.00, 9.50, 19.00, 218.50, NULL, '2026-05-03 20:58:13', '2026-05-03 17:58:13', '2026-05-03 17:58:23'),
(44, 'ORD-20260503-1777842257', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 92.00, 0.00, 80.00, 4.00, 8.00, 92.00, NULL, '2026-05-03 21:04:17', '2026-05-03 18:04:17', '2026-05-03 18:04:22'),
(45, 'ORD-20260503-1777842399', 1, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 172.50, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-03 21:06:39', '2026-05-03 18:06:39', '2026-05-03 18:06:48'),
(46, 'ORD-20260503-1777842425', 1, 2, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 218.50, 0.00, 190.00, 9.50, 19.00, 218.50, NULL, '2026-05-03 21:07:06', '2026-05-03 18:07:06', '2026-05-03 18:07:13'),
(47, 'ORD-20260504-1777874330', 2, 3, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-04 05:58:50', '2026-05-04 02:58:50', '2026-05-04 03:02:51'),
(48, 'ORD-20260504-1777874361', 2, 3, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'telebirr', 276.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-04 05:59:21', '2026-05-04 02:59:21', '2026-05-04 02:59:40'),
(49, 'ORD-20260511-1778483557', 3, 3, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'cash', 276.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 07:12:37', '2026-05-11 04:12:37', '2026-05-11 04:12:57'),
(50, 'ORD-20260511-1778484077', 3, 4, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'telebirr', 30.00, 1.25, 25.00, 1.25, 2.50, 28.75, NULL, '2026-05-11 07:21:17', '2026-05-11 04:21:17', '2026-05-11 04:21:28'),
(51, 'ORD-20260511-1778485051', 3, 5, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 07:37:31', '2026-05-11 04:37:31', '2026-05-11 04:37:31'),
(52, 'ORD-20260511-1778485453', 3, 6, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 07:44:13', '2026-05-11 04:44:13', '2026-05-11 04:44:13'),
(53, 'ORD-20260511-1778485890', 3, 7, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'telebirr', 276.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 07:51:30', '2026-05-11 04:51:30', '2026-05-11 04:52:16'),
(54, 'ORD-20260511-1778486446', 3, 10, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 1200.00, 60.00, 120.00, 1380.00, NULL, '2026-05-11 08:00:46', '2026-05-11 05:00:46', '2026-05-11 05:00:46'),
(55, 'ORD-20260511-1778486470', 3, 10, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 1440.00, 72.00, 144.00, 1656.00, NULL, '2026-05-11 08:01:10', '2026-05-11 05:01:10', '2026-05-11 05:01:10'),
(56, 'ORD-20260511-1778487531', 3, 11, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 08:18:51', '2026-05-11 05:18:51', '2026-05-11 05:18:51'),
(57, 'ORD-20260511-1778488003', 3, 9, 'dine_in', NULL, NULL, 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 25.00, 1.25, 2.50, 28.75, NULL, '2026-05-11 08:26:43', '2026-05-11 05:26:43', '2026-05-11 05:26:43'),
(58, 'ORD-20260511-1778489647', 3, 8, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'telebirr', 1380.00, 0.00, 1200.00, 60.00, 120.00, 1380.00, NULL, '2026-05-11 08:54:07', '2026-05-11 05:54:07', '2026-05-11 05:54:22'),
(59, 'ORD-20260511-1778490850', 2, 8, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', 'telebirr', 172.50, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-11 09:14:10', '2026-05-11 06:14:10', '2026-05-11 06:14:17'),
(60, 'ORD-20260511-1778524433', NULL, 1, 'dine_in', NULL, NULL, 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 18:33:53', '2026-05-11 15:33:53', '2026-05-11 15:34:02'),
(61, 'ORD-20260511-1778524630', NULL, 1, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 25.00, 1.25, 2.50, 28.75, NULL, '2026-05-11 18:37:10', '2026-05-11 15:37:10', '2026-05-11 15:37:17'),
(62, 'ORD-20260511-1778524677', NULL, 1, 'dine_in', 'bekel', '0912345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 18:37:57', '2026-05-11 15:37:57', '2026-05-11 15:38:01'),
(63, 'ORD-20260511-1778524819', NULL, 1, 'dine_in', 'debebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 390.00, 19.50, 39.00, 448.50, NULL, '2026-05-11 18:40:19', '2026-05-11 15:40:19', '2026-05-11 15:40:46'),
(64, 'ORD-20260511-1778525268', NULL, 1, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 325.00, 16.25, 32.50, 373.75, NULL, '2026-05-11 18:47:48', '2026-05-11 15:47:48', '2026-05-11 15:47:55'),
(65, 'ORD-20260511-1778525355', NULL, 1, 'dine_in', 'bekel', '0912345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 90.00, 4.50, 9.00, 103.50, NULL, '2026-05-11 18:49:15', '2026-05-11 15:49:15', '2026-05-11 15:49:20'),
(66, 'ORD-20260511-1778525440', NULL, 1, 'dine_in', 'debebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 60.00, 3.00, 6.00, 69.00, NULL, '2026-05-11 18:50:40', '2026-05-11 15:50:40', '2026-05-11 15:50:49'),
(67, 'ORD-20260511-1778525826', NULL, 2, 'dine_in', 'alemework', '0921345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 190.00, 9.50, 19.00, 218.50, NULL, '2026-05-11 18:57:06', '2026-05-11 15:57:06', '2026-05-11 15:57:11'),
(68, 'ORD-20260511-1778525961', NULL, 2, 'dine_in', 'debebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-11 18:59:21', '2026-05-11 15:59:21', '2026-05-11 15:59:27'),
(69, 'ORD-20260511-1778526652', NULL, 2, 'dine_in', 'bekel', '0912345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 19:10:52', '2026-05-11 16:10:52', '2026-05-11 16:10:59'),
(70, 'ORD-20260511-1778526813', NULL, 2, 'dine_in', 'abebe', '0921345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 190.00, 9.50, 19.00, 218.50, NULL, '2026-05-11 19:13:33', '2026-05-11 16:13:33', '2026-05-11 16:13:40'),
(71, 'ORD-20260511-1778527560', NULL, 2, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 19:26:00', '2026-05-11 16:26:00', '2026-05-11 16:26:06'),
(72, 'ORD-20260511-1778527713', NULL, 2, 'dine_in', 'abebe', '0912345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-11 19:28:33', '2026-05-11 16:28:33', '2026-05-11 16:28:40'),
(73, 'ORD-20260511-1778527740', NULL, 1, 'dine_in', 'debebe', '0921345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 222.00, 11.10, 22.20, 255.30, NULL, '2026-05-11 19:29:00', '2026-05-11 16:29:00', '2026-05-11 16:29:07'),
(74, 'ORD-1778527855', 1, 2, 'dine_in', 'debebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 90.00, 4.50, 9.00, 103.50, NULL, '2026-05-11 19:30:55', '2026-05-11 16:30:55', '2026-05-11 16:31:01'),
(75, 'ORD-20260511-1778528311', NULL, 5, 'dine_in', 'abebe', '0912345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 19:38:31', '2026-05-11 16:38:31', '2026-05-11 16:38:39'),
(76, 'ORD-20260511-1778528341', NULL, 5, 'dine_in', 'debebe', '0921345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 90.00, 4.50, 9.00, 103.50, NULL, '2026-05-11 19:39:01', '2026-05-11 16:39:01', '2026-05-11 16:39:09'),
(77, 'ORD-20260511-1778528956', NULL, 8, 'dine_in', 'abebe', '0912345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 19:49:16', '2026-05-11 16:49:16', '2026-05-11 16:49:27'),
(78, 'ORD-20260511-1778529433', NULL, 8, 'dine_in', 'bekel', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-11 19:57:13', '2026-05-11 16:57:13', '2026-05-11 16:57:20'),
(79, 'ORD-20260511-1778529540', NULL, 8, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 25.00, 1.25, 2.50, 28.75, NULL, '2026-05-11 19:59:00', '2026-05-11 16:59:00', '2026-05-11 16:59:07'),
(80, 'ORD-20260511-1778530286', 1, 12, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-11 20:11:26', '2026-05-11 17:11:26', '2026-05-11 17:11:33'),
(81, 'ORD-20260511-1778530848', 1, 1, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 1200.00, 60.00, 120.00, 1380.00, NULL, '2026-05-11 20:20:48', '2026-05-11 17:20:48', '2026-05-11 17:20:53'),
(82, 'ORD-20260511-1778531242', 1, 2, 'dine_in', 'abebe', '0912345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 105.00, 5.25, 10.50, 120.75, NULL, '2026-05-11 20:27:22', '2026-05-11 17:27:22', '2026-05-11 17:27:27'),
(83, 'ORD-20260511-1778531380', 1, 2, 'dine_in', 'debebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 90.00, 4.50, 9.00, 103.50, NULL, '2026-05-11 20:29:40', '2026-05-11 17:29:40', '2026-05-11 17:29:45'),
(84, 'ORD-20260511-1778531434', 1, 2, 'dine_in', 'gjh56', '0976564365', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 80.00, 4.00, 8.00, 92.00, NULL, '2026-05-11 20:30:34', '2026-05-11 17:30:34', '2026-05-11 17:30:38'),
(85, 'ORD-DIRECT-1778531622', 1, 3, 'dine_in', 'abebe', '0987654321', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 20:33:42', '2026-05-11 17:33:42', '2026-05-11 17:33:42'),
(86, 'ORD-DIRECT-1778531639', 1, 2, 'dine_in', 'abebe', '0987654321', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 25.00, 1.25, 2.50, 28.75, NULL, '2026-05-11 20:33:59', '2026-05-11 17:33:59', '2026-05-11 17:33:59'),
(87, 'ORD-1778531721', 1, 1, 'dine_in', 'abebe', '0987654321', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 90.00, 4.50, 9.00, 103.50, NULL, '2026-05-11 20:35:21', '2026-05-11 17:35:21', '2026-05-11 17:35:21'),
(88, 'ORD-1778531817', 1, 4, 'dine_in', 'debebe', '0912345678', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 85.00, 4.25, 8.50, 97.75, NULL, '2026-05-11 20:36:57', '2026-05-11 17:36:57', '2026-05-11 17:36:57'),
(89, 'ORD-1778531830', 1, 5, 'dine_in', 'abebe', '0912345678', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 80.00, 4.00, 8.00, 92.00, NULL, '2026-05-11 20:37:10', '2026-05-11 17:37:10', '2026-05-11 17:37:10'),
(90, 'ORD-1778532095', 1, 6, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 20:41:35', '2026-05-11 17:41:35', '2026-05-11 17:41:42'),
(91, 'ORD-1778532281', 1, 6, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 85.00, 4.25, 8.50, 97.75, NULL, '2026-05-11 20:44:41', '2026-05-11 17:44:41', '2026-05-11 17:44:49'),
(92, 'ORD-1778532306', 1, 6, 'dine_in', 'debebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 85.00, 4.25, 8.50, 97.75, NULL, '2026-05-11 20:45:06', '2026-05-11 17:45:06', '2026-05-11 17:45:09'),
(93, 'ORD-1778532489', 1, 6, 'dine_in', 'debebe', '0912345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 20:48:09', '2026-05-11 17:48:09', '2026-05-11 17:48:12'),
(94, 'ORD-1778532765', 1, 6, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-11 20:52:45', '2026-05-11 17:52:45', '2026-05-11 17:52:53'),
(95, 'ORD-1778532902', 1, 1, 'dine_in', 'debebe', '0912345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 20:55:02', '2026-05-11 17:55:02', '2026-05-11 17:55:05'),
(96, 'ORD-1778533415', 1, 1, 'dine_in', 'abebe', '0912345678', 'cancelled', 'Customer request - Changed mind', 'Admin User (admin)', '2026-05-16 15:09:32', 'unpaid', NULL, 0.00, 0.00, 85.00, 4.25, 8.50, 97.75, NULL, '2026-05-11 21:03:35', '2026-05-11 18:03:35', '2026-05-16 15:09:32'),
(97, 'ORD-1778533430', 1, 2, 'dine_in', 'abebe', '0987654321', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 25.00, 1.25, 2.50, 28.75, NULL, '2026-05-11 21:03:50', '2026-05-11 18:03:50', '2026-05-11 18:03:50'),
(98, 'ORD-1778533539', 1, 3, 'dine_in', 'abebe', '0987654321', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 25.00, 1.25, 2.50, 28.75, NULL, '2026-05-11 21:05:39', '2026-05-11 18:05:39', '2026-05-11 18:05:39'),
(99, 'ORD-1778533796', 1, 4, 'dine_in', 'alemework', '0912345678', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-11 21:09:56', '2026-05-11 18:09:56', '2026-05-11 18:09:56'),
(100, 'ORD-1778533825', 1, 4, 'dine_in', 'abebe', '0912345678', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 25.00, 1.25, 2.50, 28.75, NULL, '2026-05-11 21:10:25', '2026-05-11 18:10:25', '2026-05-11 18:10:25'),
(101, 'ORD-1778533845', 1, 5, 'dine_in', 'debebe', '0987654321', 'preparing', 'Customer request - Long wait time', 'Admin User (admin)', '2026-05-11 18:16:16', 'unpaid', NULL, 0.00, 0.00, 85.00, 4.25, 8.50, 97.75, NULL, '2026-05-11 21:10:45', '2026-05-11 18:10:45', '2026-05-11 18:16:25'),
(102, 'ORD-1778533882', 1, 6, 'dine_in', 'debebe', '0912345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 85.00, 4.25, 8.50, 97.75, NULL, '2026-05-11 21:11:22', '2026-05-11 18:11:22', '2026-05-11 18:11:26'),
(103, 'ORD-1778533899', 1, 7, 'dine_in', 'debebe', '0912345678', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 90.00, 4.50, 9.00, 103.50, NULL, '2026-05-11 21:11:39', '2026-05-11 18:11:39', '2026-05-11 18:11:42'),
(104, 'ORD-1778534428', 1, 3, 'dine_in', 'debebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 390.00, 19.50, 39.00, 448.50, NULL, '2026-05-11 21:20:28', '2026-05-11 18:20:28', '2026-05-11 18:20:31'),
(105, 'ORD-1778693508', 1, 4, 'dine_in', 'marta', '0987651234', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-13 17:31:48', '2026-05-13 14:31:48', '2026-05-13 14:31:48'),
(106, 'ORD-1778694148', 1, 4, 'dine_in', 'amri', '0912348765', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 1200.00, 60.00, 120.00, 1380.00, NULL, '2026-05-13 17:42:28', '2026-05-13 14:42:28', '2026-05-13 14:42:28'),
(107, 'ORD-1778694519', 1, 4, 'dine_in', 'amri', '0912348765', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 1285.00, 64.25, 128.50, 1477.75, NULL, '2026-05-13 17:48:39', '2026-05-13 14:48:39', '2026-05-13 14:48:43'),
(108, 'ORD-1778694685', 1, 6, 'dine_in', 'amri', '0912348765', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-13 17:51:25', '2026-05-13 14:51:25', '2026-05-13 14:51:25'),
(109, 'ORD-1778694698', 1, 6, 'dine_in', 'amri', '0912348765', 'cancelled', 'Customer request - Changed mind', 'Admin User (admin)', '2026-05-13 14:53:31', 'unpaid', NULL, 0.00, 0.00, 150.00, 7.50, 15.00, 172.50, NULL, '2026-05-13 17:51:38', '2026-05-13 14:51:38', '2026-05-13 14:53:31'),
(110, 'ORD-1778695106', 1, 10, 'dine_in', 'amri', '0912348765', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 1200.00, 60.00, 120.00, 1380.00, NULL, '2026-05-13 17:58:26', '2026-05-13 14:58:26', '2026-05-13 14:58:34'),
(111, 'ORD-1778695137', 1, 8, 'dine_in', 'amri', '0912348765', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-13 17:58:57', '2026-05-13 14:58:57', '2026-05-13 14:58:57'),
(112, 'ORD-1778954496', 1, 1, 'dine_in', 'abebe', '0987654321', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-16 18:01:36', '2026-05-16 15:01:36', '2026-05-16 15:01:36'),
(113, 'ORD-1778954506', 1, 1, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 240.00, 12.00, 24.00, 276.00, NULL, '2026-05-16 18:01:46', '2026-05-16 15:01:46', '2026-05-16 15:01:49'),
(114, 'ORD-1781947112', 3, 1, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 1200.00, 60.00, 120.00, 1380.00, NULL, '2026-06-20 09:18:32', '2026-06-20 06:18:32', '2026-06-20 06:18:44'),
(115, 'ORD-1781947142', 3, 2, 'dine_in', 'bekel', '0912345678', 'pending', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 1200.00, 60.00, 120.00, 1380.00, NULL, '2026-06-20 09:19:02', '2026-06-20 06:19:02', '2026-06-20 06:19:02'),
(116, 'ORD-1781947155', 3, 2, 'dine_in', 'bekel', '0912345678', 'preparing', NULL, NULL, NULL, 'unpaid', NULL, 0.00, 0.00, 1200.00, 60.00, 120.00, 1380.00, NULL, '2026-06-20 09:19:15', '2026-06-20 06:19:15', '2026-06-20 06:20:45'),
(117, 'ORD-1782064625', 1, 12, 'dine_in', 'abebe', '0987654321', 'paid', NULL, NULL, NULL, 'paid', NULL, 0.00, 0.00, 265.00, 13.25, 26.50, 304.75, NULL, '2026-06-21 17:57:05', '2026-06-21 14:57:05', '2026-06-21 14:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `status` enum('pending','preparing','ready','served') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `food_id`, `quantity`, `unit_price`, `subtotal`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 150.00, 150.00, 'pending', '2026-05-03 15:13:23', '2026-05-03 15:13:23'),
(2, 2, 1, 1, 180.00, 180.00, 'pending', '2026-05-03 15:18:32', '2026-05-03 15:18:32'),
(3, 3, 1, 1, 180.00, 180.00, 'pending', '2026-05-03 15:21:18', '2026-05-03 15:21:18'),
(4, 4, 1, 1, 180.00, 180.00, 'pending', '2026-05-03 15:22:11', '2026-05-03 15:22:11'),
(5, 5, 1, 1, 180.00, 180.00, 'pending', '2026-05-03 15:25:46', '2026-05-03 15:25:46'),
(6, 6, 1, 1, 180.00, 180.00, 'pending', '2026-05-03 15:47:27', '2026-05-03 15:47:27'),
(7, 7, 6, 1, 85.00, 85.00, 'pending', '2026-05-03 15:52:59', '2026-05-03 15:52:59'),
(8, 8, 6, 1, 85.00, 85.00, 'pending', '2026-05-03 16:19:55', '2026-05-03 16:19:55'),
(9, 9, 1, 1, 1600.00, 1600.00, 'pending', '2026-05-03 16:20:52', '2026-05-03 16:20:52'),
(10, 10, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 16:31:42', '2026-05-03 16:31:42'),
(11, 11, 6, 1, 85.00, 85.00, 'pending', '2026-05-03 16:41:14', '2026-05-03 16:41:14'),
(12, 12, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 16:44:52', '2026-05-03 16:44:52'),
(13, 13, 2, 1, 150.00, 150.00, 'pending', '2026-05-03 16:46:19', '2026-05-03 16:46:19'),
(14, 14, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 16:48:34', '2026-05-03 16:48:34'),
(15, 15, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 16:49:42', '2026-05-03 16:49:42'),
(16, 16, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 16:54:43', '2026-05-03 16:54:43'),
(17, 17, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 16:58:44', '2026-05-03 16:58:44'),
(18, 18, 2, 1, 150.00, 150.00, 'pending', '2026-05-03 17:04:04', '2026-05-03 17:04:04'),
(19, 19, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 17:04:32', '2026-05-03 17:04:32'),
(20, 20, 2, 1, 150.00, 150.00, 'pending', '2026-05-03 17:05:46', '2026-05-03 17:05:46'),
(21, 21, 6, 3, 85.00, 255.00, 'pending', '2026-05-03 17:06:37', '2026-05-03 17:06:37'),
(22, 22, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 17:13:38', '2026-05-03 17:13:38'),
(23, 23, 2, 1, 150.00, 150.00, 'pending', '2026-05-03 17:17:55', '2026-05-03 17:17:55'),
(24, 24, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 17:23:41', '2026-05-03 17:23:41'),
(25, 25, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 17:24:24', '2026-05-03 17:24:24'),
(26, 26, 2, 1, 150.00, 150.00, 'pending', '2026-05-03 17:24:36', '2026-05-03 17:24:36'),
(27, 27, 1, 1, 1600.00, 1600.00, 'pending', '2026-05-03 17:26:27', '2026-05-03 17:26:27'),
(28, 28, 9, 1, 25.00, 25.00, 'pending', '2026-05-03 17:27:37', '2026-05-03 17:27:37'),
(29, 29, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 17:28:12', '2026-05-03 17:28:12'),
(30, 30, 9, 1, 25.00, 25.00, 'pending', '2026-05-03 17:28:34', '2026-05-03 17:28:34'),
(31, 31, 6, 1, 85.00, 85.00, 'pending', '2026-05-03 17:29:52', '2026-05-03 17:29:52'),
(32, 32, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 17:33:51', '2026-05-03 17:33:51'),
(33, 33, 5, 1, 90.00, 90.00, 'pending', '2026-05-03 17:37:48', '2026-05-03 17:37:48'),
(34, 34, 7, 1, 60.00, 60.00, 'pending', '2026-05-03 17:44:12', '2026-05-03 17:44:12'),
(35, 35, 1, 1, 1600.00, 1600.00, 'pending', '2026-05-03 17:44:52', '2026-05-03 17:44:52'),
(36, 36, 2, 1, 150.00, 150.00, 'pending', '2026-05-03 17:46:35', '2026-05-03 17:46:35'),
(37, 37, 5, 1, 90.00, 90.00, 'pending', '2026-05-03 17:48:30', '2026-05-03 17:48:30'),
(38, 38, 2, 1, 150.00, 150.00, 'pending', '2026-05-03 17:50:47', '2026-05-03 17:50:47'),
(39, 39, 3, 1, 240.00, 240.00, 'pending', '2026-05-03 17:54:43', '2026-05-03 17:54:43'),
(40, 40, 1, 1, 1600.00, 1600.00, 'pending', '2026-05-03 17:56:32', '2026-05-03 17:56:32'),
(41, 41, 1, 1, 1840.00, 1840.00, 'pending', '2026-05-03 17:57:07', '2026-05-03 17:57:07'),
(42, 42, 1, 1, 1840.00, 1840.00, 'pending', '2026-05-03 17:57:33', '2026-05-03 17:57:33'),
(43, 43, 4, 1, 190.00, 190.00, 'pending', '2026-05-03 17:58:14', '2026-05-03 17:58:14'),
(44, 44, 8, 1, 80.00, 80.00, 'pending', '2026-05-03 18:04:17', '2026-05-03 18:04:17'),
(45, 45, 2, 1, 150.00, 150.00, 'pending', '2026-05-03 18:06:39', '2026-05-03 18:06:39'),
(46, 46, 4, 1, 190.00, 190.00, 'pending', '2026-05-03 18:07:06', '2026-05-03 18:07:06'),
(47, 47, 3, 1, 240.00, 240.00, 'pending', '2026-05-04 02:58:51', '2026-05-04 02:58:51'),
(48, 48, 3, 1, 240.00, 240.00, 'pending', '2026-05-04 02:59:21', '2026-05-04 02:59:21'),
(49, 49, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 04:12:37', '2026-05-11 04:12:37'),
(50, 50, 9, 1, 25.00, 25.00, 'pending', '2026-05-11 04:21:17', '2026-05-11 04:21:17'),
(51, 51, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 04:37:31', '2026-05-11 04:37:31'),
(52, 52, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 04:44:13', '2026-05-11 04:44:13'),
(53, 53, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 04:51:30', '2026-05-11 04:51:30'),
(54, 54, 1, 1, 1200.00, 1200.00, 'pending', '2026-05-11 05:00:46', '2026-05-11 05:00:46'),
(55, 55, 1, 1, 1200.00, 1200.00, 'pending', '2026-05-11 05:01:10', '2026-05-11 05:01:10'),
(56, 55, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 05:01:10', '2026-05-11 05:01:10'),
(57, 56, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 05:18:51', '2026-05-11 05:18:51'),
(58, 57, 9, 1, 25.00, 25.00, 'pending', '2026-05-11 05:26:43', '2026-05-11 05:26:43'),
(59, 58, 1, 1, 1200.00, 1200.00, 'pending', '2026-05-11 05:54:07', '2026-05-11 05:54:07'),
(60, 59, 2, 1, 150.00, 150.00, 'pending', '2026-05-11 06:14:10', '2026-05-11 06:14:10'),
(61, 60, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 15:33:53', '2026-05-11 15:33:53'),
(62, 61, 9, 1, 25.00, 25.00, 'pending', '2026-05-11 15:37:10', '2026-05-11 15:37:10'),
(63, 62, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 15:37:57', '2026-05-11 15:37:57'),
(64, 63, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 15:40:19', '2026-05-11 15:40:19'),
(65, 63, 2, 1, 150.00, 150.00, 'pending', '2026-05-11 15:40:19', '2026-05-11 15:40:19'),
(66, 64, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 15:47:48', '2026-05-11 15:47:48'),
(67, 64, 6, 1, 85.00, 85.00, 'pending', '2026-05-11 15:47:48', '2026-05-11 15:47:48'),
(68, 65, 5, 1, 90.00, 90.00, 'pending', '2026-05-11 15:49:15', '2026-05-11 15:49:15'),
(69, 66, 7, 1, 60.00, 60.00, 'pending', '2026-05-11 15:50:40', '2026-05-11 15:50:40'),
(70, 67, 4, 1, 190.00, 190.00, 'pending', '2026-05-11 15:57:06', '2026-05-11 15:57:06'),
(71, 68, 2, 1, 150.00, 150.00, 'pending', '2026-05-11 15:59:21', '2026-05-11 15:59:21'),
(72, 69, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 16:10:53', '2026-05-11 16:10:53'),
(73, 70, 4, 1, 190.00, 190.00, 'pending', '2026-05-11 16:13:33', '2026-05-11 16:13:33'),
(74, 71, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 16:26:00', '2026-05-11 16:26:00'),
(75, 72, 2, 1, 150.00, 150.00, 'pending', '2026-05-11 16:28:33', '2026-05-11 16:28:33'),
(76, 73, 11, 1, 222.00, 222.00, 'pending', '2026-05-11 16:29:00', '2026-05-11 16:29:00'),
(77, 74, 5, 1, 90.00, 90.00, 'pending', '2026-05-11 16:30:55', '2026-05-11 16:30:55'),
(78, 75, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 16:38:31', '2026-05-11 16:38:31'),
(79, 76, 5, 1, 90.00, 90.00, 'pending', '2026-05-11 16:39:01', '2026-05-11 16:39:01'),
(80, 77, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 16:49:17', '2026-05-11 16:49:17'),
(81, 78, 2, 1, 150.00, 150.00, 'pending', '2026-05-11 16:57:13', '2026-05-11 16:57:13'),
(82, 79, 9, 1, 25.00, 25.00, 'pending', '2026-05-11 16:59:00', '2026-05-11 16:59:00'),
(83, 80, 2, 1, 150.00, 150.00, 'pending', '2026-05-11 17:11:26', '2026-05-11 17:11:26'),
(84, 81, 1, 1, 1200.00, 1200.00, 'pending', '2026-05-11 17:20:48', '2026-05-11 17:20:48'),
(85, 82, 8, 1, 80.00, 80.00, 'pending', '2026-05-11 17:27:22', '2026-05-11 17:27:22'),
(86, 82, 9, 1, 25.00, 25.00, 'pending', '2026-05-11 17:27:22', '2026-05-11 17:27:22'),
(87, 83, 5, 1, 90.00, 90.00, 'pending', '2026-05-11 17:29:40', '2026-05-11 17:29:40'),
(88, 84, 8, 1, 80.00, 80.00, 'pending', '2026-05-11 17:30:34', '2026-05-11 17:30:34'),
(89, 85, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 17:33:42', '2026-05-11 17:33:42'),
(90, 86, 9, 1, 25.00, 25.00, 'pending', '2026-05-11 17:33:59', '2026-05-11 17:33:59'),
(91, 87, 5, 1, 90.00, 90.00, 'pending', '2026-05-11 17:35:21', '2026-05-11 17:35:21'),
(92, 88, 6, 1, 85.00, 85.00, 'pending', '2026-05-11 17:36:57', '2026-05-11 17:36:57'),
(93, 89, 8, 1, 80.00, 80.00, 'pending', '2026-05-11 17:37:10', '2026-05-11 17:37:10'),
(94, 90, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 17:41:35', '2026-05-11 17:41:35'),
(95, 91, 6, 1, 85.00, 85.00, 'pending', '2026-05-11 17:44:42', '2026-05-11 17:44:42'),
(96, 92, 6, 1, 85.00, 85.00, 'pending', '2026-05-11 17:45:06', '2026-05-11 17:45:06'),
(97, 93, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 17:48:09', '2026-05-11 17:48:09'),
(98, 94, 2, 1, 150.00, 150.00, 'pending', '2026-05-11 17:52:46', '2026-05-11 17:52:46'),
(99, 95, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 17:55:02', '2026-05-11 17:55:02'),
(100, 96, 6, 1, 85.00, 85.00, 'pending', '2026-05-11 18:03:35', '2026-05-11 18:03:35'),
(101, 97, 9, 1, 25.00, 25.00, 'pending', '2026-05-11 18:03:50', '2026-05-11 18:03:50'),
(102, 98, 9, 1, 25.00, 25.00, 'pending', '2026-05-11 18:05:39', '2026-05-11 18:05:39'),
(103, 99, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 18:09:56', '2026-05-11 18:09:56'),
(104, 100, 9, 1, 25.00, 25.00, 'pending', '2026-05-11 18:10:25', '2026-05-11 18:10:25'),
(105, 101, 6, 1, 85.00, 85.00, 'pending', '2026-05-11 18:10:45', '2026-05-11 18:10:45'),
(106, 102, 6, 1, 85.00, 85.00, 'pending', '2026-05-11 18:11:22', '2026-05-11 18:11:22'),
(107, 103, 5, 1, 90.00, 90.00, 'pending', '2026-05-11 18:11:39', '2026-05-11 18:11:39'),
(108, 104, 3, 1, 240.00, 240.00, 'pending', '2026-05-11 18:20:28', '2026-05-11 18:20:28'),
(109, 104, 2, 1, 150.00, 150.00, 'pending', '2026-05-11 18:20:28', '2026-05-11 18:20:28'),
(110, 105, 2, 1, 150.00, 150.00, 'pending', '2026-05-13 14:31:48', '2026-05-13 14:31:48'),
(111, 106, 1, 1, 1200.00, 1200.00, 'pending', '2026-05-13 14:42:28', '2026-05-13 14:42:28'),
(112, 107, 1, 1, 1200.00, 1200.00, 'pending', '2026-05-13 14:48:40', '2026-05-13 14:48:40'),
(113, 107, 6, 1, 85.00, 85.00, 'pending', '2026-05-13 14:48:40', '2026-05-13 14:48:40'),
(114, 108, 2, 1, 150.00, 150.00, 'pending', '2026-05-13 14:51:25', '2026-05-13 14:51:25'),
(115, 109, 2, 1, 150.00, 150.00, 'pending', '2026-05-13 14:51:38', '2026-05-13 14:51:38'),
(116, 110, 1, 1, 1200.00, 1200.00, 'pending', '2026-05-13 14:58:26', '2026-05-13 14:58:26'),
(117, 111, 3, 1, 240.00, 240.00, 'pending', '2026-05-13 14:58:57', '2026-05-13 14:58:57'),
(118, 112, 3, 1, 240.00, 240.00, 'pending', '2026-05-16 15:01:36', '2026-05-16 15:01:36'),
(119, 113, 3, 1, 240.00, 240.00, 'pending', '2026-05-16 15:01:46', '2026-05-16 15:01:46'),
(120, 114, 1, 1, 1200.00, 1200.00, 'pending', '2026-06-20 06:18:32', '2026-06-20 06:18:32'),
(121, 115, 1, 1, 1200.00, 1200.00, 'pending', '2026-06-20 06:19:02', '2026-06-20 06:19:02'),
(122, 116, 1, 1, 1200.00, 1200.00, 'pending', '2026-06-20 06:19:15', '2026-06-20 06:19:15'),
(123, 117, 3, 1, 240.00, 240.00, 'pending', '2026-06-21 14:57:05', '2026-06-21 14:57:05'),
(124, 117, 9, 1, 25.00, 25.00, 'pending', '2026-06-21 14:57:05', '2026-06-21 14:57:05');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','card','telebirr','cbe_birr') NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `bank_reference` varchar(255) DEFAULT NULL,
  `settlement_status` varchar(255) NOT NULL DEFAULT 'pending',
  `settled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `number_of_guests` int(11) NOT NULL,
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `special_requests` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_settings`
--

CREATE TABLE `restaurant_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_settings`
--

INSERT INTO `restaurant_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'max_tables', '10', NULL, NULL),
(2, 'max_capacity', '8', NULL, NULL);

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
('JqF8xY6ZqWUUAvTinEFyZDOjKrk7pHRNPXpOID8j', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 OPR/131.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR3Vsb01XMzkxNXhqUzl2cGlpSFZxQTJjV3RmM0N2ZUpmcVVqd0JlcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9vcmRlcnMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1782065763);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_number` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `is_occupied` tinyint(1) DEFAULT 0,
  `current_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `table_number`, `capacity`, `location`, `is_available`, `is_occupied`, `current_order_id`, `created_at`, `updated_at`) VALUES
(1, '1', 4, 'Main Hall', 1, 1, 114, '2026-05-03 15:03:20', '2026-05-16 15:09:32'),
(2, '2', 4, 'Main Hall', 1, 1, NULL, '2026-05-03 15:03:20', '2026-05-11 16:36:33'),
(3, '3', 4, 'Main Hall', 1, 0, NULL, '2026-05-03 15:03:20', '2026-05-11 16:36:58'),
(4, '4', 4, 'Main Hall', 1, 0, NULL, '2026-05-03 15:03:20', '2026-05-11 16:37:16'),
(5, '5', 4, 'Main Hall', 1, 0, NULL, '2026-05-03 15:03:20', '2026-05-11 18:16:16'),
(6, '6', 4, 'Main Hall', 1, 0, NULL, '2026-05-03 15:03:20', '2026-05-13 14:53:32'),
(7, '7', 4, 'Main Hall', 1, 0, NULL, '2026-05-03 15:03:20', '2026-05-11 16:48:32'),
(8, '8', 4, 'Main Hall', 1, 0, NULL, '2026-05-03 15:03:21', '2026-05-11 06:14:17'),
(9, '9', 4, 'Main Hall', 1, 0, NULL, '2026-05-03 15:03:21', '2026-05-11 06:21:18'),
(10, '10', 4, 'Main Hall', 1, 1, 110, '2026-05-03 15:03:21', '2026-05-11 06:21:18'),
(11, '09899', 3, 'Terrace', 1, 0, NULL, '2026-05-03 17:02:07', '2026-05-11 06:21:18'),
(12, '055', 2, 'Main Hall', 1, 1, 117, '2026-05-11 17:11:05', '2026-05-11 17:11:05'),
(13, '088', 3, 'Terrace', 1, 0, NULL, '2026-05-11 17:19:38', '2026-05-11 17:19:38'),
(14, '90', 4, 'Main Hall', 1, 0, NULL, '2026-05-13 14:53:53', '2026-05-13 14:53:53'),
(15, '12', 3, 'Terrace', 1, 0, NULL, '2026-05-16 15:09:15', '2026-05-16 15:09:15'),
(16, '09999', 3, 'VIP Room', 1, 0, NULL, '2026-06-20 06:22:18', '2026-06-20 06:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `tax_settings`
--

CREATE TABLE `tax_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_settings`
--

INSERT INTO `tax_settings` (`id`, `name`, `percentage`, `is_active`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'VAT', 5.00, 1, 1, '2026-05-11 06:11:29', '2026-05-11 06:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','customer','cashier') DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@admin.com', 'admin', NULL, '$2y$12$qLdoN9eOKyruh0IUiTCYLe6./8k/tThefjeulB12srTAfMzRmiy7K', NULL, '2026-05-03 15:03:21', '2026-05-03 15:03:21'),
(2, 'Elpin', 'elpin318@gmail.com', 'customer', NULL, '$2y$12$jggqKIN/HDavGyoYg4siOO1LJzpa4IOVPXHm4V9Nt6YmWPnA5gNL2', NULL, '2026-05-03 18:13:39', '2026-05-03 18:13:39'),
(3, 'Cashier User', 'cashier@restaurant.com', 'cashier', NULL, '$2y$12$njSy3xCfiUH2cnHhdiAiJegGRd9s5N9a2xdKmUIlW1wjgYWOGwUo.', NULL, '2026-05-11 04:05:24', '2026-05-11 04:05:24'),
(4, 'Guest', 'guest@restaurant.com', 'customer', NULL, '$2y$12$E/pzodYmrxvw/V3EPvxsKOBUt9wojs6CTQGmGT/T/27TFHoZWheJu', NULL, '2026-05-11 15:33:15', '2026-05-11 15:33:15');

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
-- Indexes for table `cashier_shifts`
--
ALTER TABLE `cashier_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cashier_shifts_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foods_category_id_foreign` (`category_id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_table_id_foreign` (`table_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_food_id_foreign` (`food_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_table_id_foreign` (`table_id`);

--
-- Indexes for table `restaurant_settings`
--
ALTER TABLE `restaurant_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurant_settings_key_unique` (`key`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tables_table_number_unique` (`table_number`);

--
-- Indexes for table `tax_settings`
--
ALTER TABLE `tax_settings`
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
-- AUTO_INCREMENT for table `cashier_shifts`
--
ALTER TABLE `cashier_shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant_settings`
--
ALTER TABLE `restaurant_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tax_settings`
--
ALTER TABLE `tax_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cashier_shifts`
--
ALTER TABLE `cashier_shifts`
  ADD CONSTRAINT `cashier_shifts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`),
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 06:02 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aflatun`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `native_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attrvalues`
--

CREATE TABLE `attrvalues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attrname_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `woner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `woner`, `phone`, `address`, `product_name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Amir Bruce', 'Doloremque ipsum nem', '+1 (956) 237-7087', 'Numquam vero minima', 'Russell Chandler', '2025-03-2067dc360329e5b1742484995.webp', '2025-03-20 09:36:35', '2025-03-20 09:36:35'),
(2, 'Jameson Pearson', 'Labore sit odit ut', '+1 (766) 704-3309', 'Est ex voluptatem M', 'Teegan Boyle', '2025-03-2067dc36107d3e41742485008.webp', '2025-03-20 09:36:48', '2025-03-20 09:36:48'),
(3, 'Dale Carr', 'Id deserunt minima b', '+1 (693) 137-6065', 'Placeat irure volup', 'Zeus Faulkner', '2025-03-2067dc36134a0901742485011.webp', '2025-03-20 09:36:51', '2025-03-20 09:36:51'),
(4, 'Sierra Larson', 'Dolor pariatur Porr', '+1 (914) 693-8578', 'Nesciunt sed offici', 'Xenos Mercado', '2025-03-2067dc361576afc1742485013.webp', '2025-03-20 09:36:53', '2025-03-20 09:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_native_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_categroy` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_view` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_native_name`, `parent_categroy`, `icon`, `slug`, `home_view`, `status`, `created_at`, `updated_at`) VALUES
(1, 'EASY', 'Easy', 0, '2025-03-2067dc3567aa4631742484839.png', 'easy', 0, 1, '2025-03-20 09:33:59', '2025-03-20 09:33:59'),
(2, 'MEN', 'cele', 1, '2025-03-2067dc3581260301742484865.png', 'men', 0, 1, '2025-03-20 09:34:25', '2025-03-20 09:34:25'),
(3, 'SHEIN', 'Piper Booth', 1, '2025-03-2067dc35908ab1e1742484880.png', 'shein', 0, 1, '2025-03-20 09:34:40', '2025-03-20 09:34:40'),
(4, 'Ceeline', 'Bert Kinney', 1, '2025-03-2067dc35a2b784a1742484898.png', 'ceeline', 0, 0, '2025-03-20 09:34:58', '2025-03-20 09:34:58'),
(5, 'Gucci', 'gucci', 0, '2025-03-2067dc35bb0e50e1742484923.png', 'gucci', 0, 1, '2025-03-20 09:35:23', '2025-03-20 09:35:23'),
(6, 'Gucci', 'gucci', 0, '2025-03-2067dc35be7650c1742484926.png', 'gucci', 0, 1, '2025-03-20 09:35:26', '2025-03-20 09:35:26'),
(7, 'Moha', 'gucci', 0, '2025-03-2067dc35c8853601742484936.png', 'moha', 0, 1, '2025-03-20 09:35:36', '2025-03-20 09:35:36'),
(8, 'Dokki', 'gucci', 0, '2025-03-2067dc35d4772fc1742484948.png', 'dokki', 0, 1, '2025-03-20 09:35:48', '2025-03-20 09:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms_accepted` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `division`, `district`, `home_district`, `address`, `email`, `password`, `terms_accepted`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Anika', 'Sweeney', 'Sylhet', 'Sunamganj', 'Sunamganj Sadar', 'Omnis nihil dolorem', 'arifuzzaman.rb@gmail.com', '$2y$10$siSrZMgn9IGPEFim9a0y1.35dROEgtBjwg.sGrRQ60sky1UksSaZu', 1, '2025-03-2167dd7acde2d9e1742568141.png', '2025-03-21 08:42:22', '2025-03-21 08:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `color_code`, `created_at`, `updated_at`) VALUES
(1, 'Fresh', '#65D6E4', '2025-03-20 09:31:00', '2025-03-20 09:31:00'),
(2, 'Red', 'red', '2025-03-20 09:31:09', '2025-03-20 09:31:09'),
(3, 'Green', 'Green', '2025-03-20 09:31:21', '2025-03-20 09:31:21'),
(4, 'Gray', 'gray', '2025-03-20 09:31:28', '2025-03-20 09:31:28'),
(5, 'YELLOW', 'yellow', '2025-03-20 09:31:43', '2025-03-20 09:31:43'),
(6, 'Pink', '#F17AA2', '2025-03-20 09:32:10', '2025-03-20 09:32:10'),
(7, 'OF WHITE', '#BAB0B1', '2025-03-20 09:32:37', '2025-03-20 09:32:37'),
(8, 'Orrange', '#F4511E', '2025-03-20 09:32:57', '2025-03-20 09:32:57');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(31, '2014_10_12_000000_create_users_table', 1),
(32, '2014_10_12_100000_create_password_resets_table', 1),
(33, '2019_08_19_000000_create_failed_jobs_table', 1),
(34, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(35, '2025_02_15_065821_create_admins_table', 1),
(36, '2025_02_15_070150_create_categories_table', 1),
(37, '2025_02_19_083720_create_units_table', 1),
(38, '2025_02_22_080502_create_products_table', 1),
(39, '2025_02_23_110907_create_brands_table', 1),
(40, '2025_02_24_135000_create_colors_table', 1),
(41, '2025_02_25_125631_create_attributes_table', 1),
(42, '2025_02_27_141555_create_attrvalues_table', 1),
(43, '2025_03_13_175645_create_product_varients_table', 1),
(44, '2025_03_16_200300_create_clients_table', 1),
(45, '2025_03_19_193805_create_orders_table', 1),
(46, '2025_03_19_212339_create_order_items_table', 1),
(47, '2025_03_20_132751_create_sizes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiving_time` time DEFAULT NULL,
  `shipping_charge` decimal(8,2) NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `tax` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `email`, `address`, `payment_method`, `receiving_time`, `shipping_charge`, `subtotal`, `tax`, `total`, `created_at`, `updated_at`) VALUES
(1, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'Credit-Card', '18:07:00', '100.00', '4226.00', '211.30', '4537.30', '2025-03-20 15:04:58', '2025-03-20 15:04:58'),
(2, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '18:43:00', '100.00', '4526.00', '226.30', '4852.30', '2025-03-20 15:40:51', '2025-03-20 15:40:51'),
(3, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '18:52:00', '100.00', '600.00', '30.00', '730.00', '2025-03-20 15:49:13', '2025-03-20 15:49:13'),
(4, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '06:03:00', '100.00', '2000.00', '100.00', '2200.00', '2025-03-21 01:59:42', '2025-03-21 01:59:42'),
(5, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '06:03:00', '100.00', '2000.00', '100.00', '2200.00', '2025-03-21 01:59:57', '2025-03-21 01:59:57'),
(6, 'Qui iusto odio cumqu', '+1 (605) 737-6846', 'wyduhizive@mailinator.com', 'Quasi ut dicta culpa', 'rocket', '09:56:00', '100.00', '25600.00', '1280.00', '26980.00', '2025-03-21 02:05:21', '2025-03-21 02:05:21'),
(7, 'Sed velit qui conseq', '+1 (418) 519-5618', 'woxemizugy@mailinator.com', 'Sunt reprehenderit q', 'bkash', '09:43:00', '100.00', '1000.00', '50.00', '1150.00', '2025-03-21 02:07:51', '2025-03-21 02:07:51'),
(8, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '05:15:00', '100.00', '1000.00', '50.00', '1150.00', '2025-03-21 02:14:10', '2025-03-21 02:14:10'),
(9, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '05:18:00', '100.00', '1000.00', '50.00', '1150.00', '2025-03-21 02:16:01', '2025-03-21 02:16:01'),
(10, 'Repudiandae rem eaqu', '+1 (551) 669-8558', 'lewopulik@mailinator.com', 'Sed omnis similique', 'cash-on-delivery', '17:55:00', '100.00', '42300.00', '2115.00', '44515.00', '2025-03-21 02:35:19', '2025-03-21 02:35:19'),
(11, 'Quibusdam aut perspi', '+1 (833) 758-9865', 'lujyqe@mailinator.com', 'Qui magna nulla eum', 'cash-on-delivery', '01:54:00', '100.00', '1000.00', '50.00', '1150.00', '2025-03-21 02:36:58', '2025-03-21 02:36:58'),
(12, 'Eos minim nesciunt', '+1 (683) 796-5499', 'webo@mailinator.com', 'Quos est deserunt si', 'bkash', '10:13:00', '100.00', '1000.00', '50.00', '1150.00', '2025-03-21 02:38:26', '2025-03-21 02:38:26'),
(13, 'Porro qui in aut odi', '+1 (819) 345-7881', 'dyqyx@mailinator.com', 'In quis exercitation', 'Credit-Card', '03:45:00', '100.00', '1000.00', '50.00', '1150.00', '2025-03-21 02:38:44', '2025-03-21 02:38:44'),
(14, 'Placeat non soluta', '+1 (108) 526-9258', 'qokatucuj@mailinator.com', 'Rerum voluptates ut', 'cash-on-delivery', '00:40:00', '100.00', '1000.00', '50.00', '1150.00', '2025-03-21 02:40:44', '2025-03-21 02:40:44'),
(15, 'Qui est saepe ex vol', '+1 (847) 852-2282', 'guvunos@mailinator.com', 'Animi eveniet beat', 'bkash', '23:28:00', '100.00', '2600.00', '130.00', '2830.00', '2025-03-21 03:31:59', '2025-03-21 03:31:59'),
(16, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '18:39:00', '100.00', '1200.00', '60.00', '1360.00', '2025-03-21 03:36:53', '2025-03-21 03:36:53'),
(17, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '18:06:00', '100.00', '23800.00', '1190.00', '25090.00', '2025-03-23 15:03:27', '2025-03-23 15:03:27'),
(18, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'rocket', '00:33:00', '100.00', '7600.00', '380.00', '8080.00', '2025-03-24 09:31:28', '2025-03-24 09:31:28'),
(19, 'Bikash Sharma', '01824220954', 'bikash.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '00:42:00', '100.00', '5400.00', '270.00', '5770.00', '2025-03-24 09:41:13', '2025-03-24 09:41:13'),
(20, 'Bikash Sharma', '01824220954', 'bikash.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '00:42:00', '100.00', '5400.00', '270.00', '5770.00', '2025-03-24 09:41:24', '2025-03-24 09:41:24'),
(21, 'Bikash Sharma', '01824220954', 'bikash.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '00:42:00', '100.00', '5400.00', '270.00', '5770.00', '2025-03-24 09:41:40', '2025-03-24 09:41:40'),
(22, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '12:47:00', '100.00', '2700.00', '135.00', '2935.00', '2025-03-24 09:44:25', '2025-03-24 09:44:25'),
(23, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '00:48:00', '100.00', '2600.00', '130.00', '2830.00', '2025-03-24 09:45:29', '2025-03-24 09:45:29'),
(24, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '12:49:00', '100.00', '4000.00', '200.00', '4300.00', '2025-03-24 09:46:57', '2025-03-24 09:46:57'),
(25, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '00:51:00', '100.00', '8000.00', '400.00', '8500.00', '2025-03-24 09:48:30', '2025-03-24 09:48:30'),
(26, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '14:32:00', '100.00', '4000.00', '200.00', '4300.00', '2025-03-24 10:28:08', '2025-03-24 10:28:08'),
(27, 'Arif zaman', '01824220935', 'arifuzzaman.rb@gmail.com', 'tolarbag, mirpur-1, Dhaka\n17/4, towheed tower, tolarbag, mirpur-1', 'cash-on-delivery', '15:53:00', '100.00', '6000.00', '300.00', '6400.00', '2025-03-25 11:49:40', '2025-03-25 11:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `color`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 'Ryder Dillon', '#ff00ff', '4.00', 1, '2025-03-20 15:04:58', '2025-03-20 15:04:58'),
(2, 1, 13, 'Ryder Dillon', 'Green', '77.00', 1, '2025-03-20 15:04:58', '2025-03-20 15:04:58'),
(3, 1, 3, 'Otto Mathews', 'red', '1000.00', 1, '2025-03-20 15:04:58', '2025-03-20 15:04:58'),
(4, 1, 3, 'Otto Mathews', 'red', '1000.00', 1, '2025-03-20 15:04:58', '2025-03-20 15:04:58'),
(5, 1, 2, 'Galena Pacheco', 'red', '45.00', 1, '2025-03-20 15:04:58', '2025-03-20 15:04:58'),
(6, 1, 3, 'Otto Mathews', 'red', '500.00', 1, '2025-03-20 15:04:58', '2025-03-20 15:04:58'),
(7, 1, 3, 'Otto Mathews', 'Green', '1000.00', 1, '2025-03-20 15:04:58', '2025-03-20 15:04:58'),
(8, 1, 2, 'Galena Pacheco', 'red', '300.00', 2, '2025-03-20 15:04:58', '2025-03-20 15:04:58'),
(9, 14, 3, 'Otto Mathews', 'Green', '500.00', 93, '2025-03-21 02:40:44', '2025-03-21 02:40:44'),
(10, 14, 2, 'Galena Pacheco', 'red', '300.00', 44, '2025-03-21 02:40:44', '2025-03-21 02:40:44'),
(11, 14, 2, 'Galena Pacheco', 'Green', '200.00', 40, '2025-03-21 02:40:44', '2025-03-21 02:40:44'),
(12, 15, 2, 'Galena Pacheco', 'red', '300.00', 2, '2025-03-21 03:31:59', '2025-03-21 03:31:59'),
(13, 15, 3, 'Otto Mathews', 'red', '1000.00', 2, '2025-03-21 03:31:59', '2025-03-21 03:31:59'),
(14, 16, 3, 'Otto Mathews', 'Green', '500.00', 1, '2025-03-21 03:36:53', '2025-03-21 03:36:53'),
(15, 16, 2, 'Galena Pacheco', 'Green', '400.00', 1, '2025-03-21 03:36:53', '2025-03-21 03:36:53'),
(16, 16, 2, 'Galena Pacheco', 'gray', '300.00', 1, '2025-03-21 03:36:53', '2025-03-21 03:36:53'),
(17, 17, 8, 'Pakistani Exclusive Design Qivilt\n                                BDT:4000', '4', '4000.00', 1, '2025-03-23 15:03:27', '2025-03-23 15:03:27'),
(18, 17, 8, 'Pakistani Exclusive Design Qivilt\n                                BDT:4000', '4', '4000.00', 1, '2025-03-23 15:03:27', '2025-03-23 15:03:27'),
(19, 17, 8, 'Pakistani Exclusive Design Qivilt\n                                BDT:4000', '4', '4000.00', 1, '2025-03-23 15:03:27', '2025-03-23 15:03:27'),
(20, 17, 8, 'Pakistani Exclusive Design Qivilt\n                                BDT:3800', '3', '3800.00', 1, '2025-03-23 15:03:27', '2025-03-23 15:03:27'),
(21, 17, 9, 'Pakistani Exclusive Design Qivilt\n                                BDT:4000', '4', '4000.00', 1, '2025-03-23 15:03:27', '2025-03-23 15:03:27'),
(22, 17, 21, 'Pakistani Exclusive Design Qivilt\n                                BDT:4000', '2', '4000.00', 1, '2025-03-23 15:03:27', '2025-03-23 15:03:27'),
(23, 18, 10, 'Pakistani Exclusive Design Qivilt\n                                BDT:3800', '3', '7600.00', 2, '2025-03-24 09:31:28', '2025-03-24 09:31:28'),
(24, 19, 45, 'Silk Luxery Kameez\n                                BDT:2700', '3', '5400.00', 2, '2025-03-24 09:41:13', '2025-03-24 09:41:13'),
(25, 20, 45, 'Silk Luxery Kameez\n                                BDT:2700', '3', '5400.00', 2, '2025-03-24 09:41:24', '2025-03-24 09:41:24'),
(26, 21, 45, 'Silk Luxery Kameez\n                                BDT:2700', '3', '5400.00', 2, '2025-03-24 09:41:40', '2025-03-24 09:41:40'),
(27, 22, 45, 'Silk Luxery Kameez\n                                BDT:2700', '3', '2700.00', 1, '2025-03-24 09:44:25', '2025-03-24 09:44:25'),
(28, 23, 44, 'Silk Luxery Kameez\n                                BDT:2600', '3', '2600.00', 1, '2025-03-24 09:45:29', '2025-03-24 09:45:29'),
(29, 24, 9, 'Pakistani Exclusive Design Qivilt\n                                BDT:4000', '4', '4000.00', 1, '2025-03-24 09:46:57', '2025-03-24 09:46:57'),
(30, 25, 10, 'Pakistani Exclusive Design Qivilt\n                                BDT:4000', '4', '8000.00', 2, '2025-03-24 09:48:30', '2025-03-24 09:48:30'),
(31, 26, 10, 'Pakistani Exclusive Design Qivilt\n                                BDT:4000', '4', '4000.00', 1, '2025-03-24 10:28:08', '2025-03-24 10:28:08'),
(32, 27, 20, 'Pakistani Exclusive Design Qivilt\n                                BDT:2000', 'Red', '6000.00', 3, '2025-03-25 11:49:40', '2025-03-25 11:49:40');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_available_quantity` int(11) NOT NULL,
  `promoted_item` tinyint(1) NOT NULL DEFAULT 0,
  `has_varient` tinyint(1) NOT NULL DEFAULT 0,
  `vat` double NOT NULL DEFAULT 2.5,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `unit_id`, `category_id`, `sub_category_id`, `product_name`, `product_price`, `product_description`, `product_image`, `product_available_quantity`, `promoted_item`, `has_varient`, `vat`, `status`, `created_at`, `updated_at`) VALUES
(7, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 3800, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e033328b02b1742746418.webp', 45, 1, 1, 45, 1, '2025-03-23 10:13:38', '2025-03-23 10:13:38'),
(8, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 5000, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e0335e913e11742746462.webp', 45, 1, 1, 45, 1, '2025-03-23 10:14:22', '2025-03-23 10:14:22'),
(9, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 6000, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e033766b8db1742746486.jpg', 45, 1, 1, 45, 1, '2025-03-23 10:14:46', '2025-03-23 10:14:46'),
(10, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 3000, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e03383a8aef1742746499.jpg', 45, 1, 1, 45, 1, '2025-03-23 10:14:59', '2025-03-23 10:14:59'),
(15, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 5500, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e0344aa1fe61742746698.webp', 45, 1, 1, 45, 1, '2025-03-23 10:18:18', '2025-03-23 10:18:18'),
(16, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 5100, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e0345d1482c1742746717.png', 45, 1, 1, 45, 1, '2025-03-23 10:18:37', '2025-03-23 10:18:37'),
(17, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 6000, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e03469ec4e51742746729.webp', 45, 1, 1, 45, 1, '2025-03-23 10:18:50', '2025-03-23 10:18:50'),
(18, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 2000, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e03475044ea1742746741.webp', 45, 1, 1, 45, 1, '2025-03-23 10:19:01', '2025-03-23 10:19:01'),
(19, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 5020, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e0348231c861742746754.jpg', 45, 1, 1, 45, 1, '2025-03-23 10:19:14', '2025-03-23 10:19:14'),
(20, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 4000, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e034a833de71742746792.jpg', 45, 1, 1, 10, 1, '2025-03-23 10:19:52', '2025-03-23 10:19:52'),
(21, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 3500, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e034b36b1681742746803.jpg', 45, 1, 1, 10, 1, '2025-03-23 10:20:03', '2025-03-23 10:20:03'),
(22, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 3500, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e034bb21dbe1742746811.jpg', 45, 1, 1, 10, 1, '2025-03-23 10:20:11', '2025-03-23 10:20:11'),
(23, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 5400, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e034c7c662c1742746823.jpg', 45, 1, 1, 10, 1, '2025-03-23 10:20:23', '2025-03-23 10:20:23'),
(24, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 6040, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e034d805b2f1742746840.jpeg', 45, 1, 1, 10, 1, '2025-03-23 10:20:40', '2025-03-23 10:20:40'),
(25, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 3800, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e034e6945bf1742746854.jpeg', 45, 1, 1, 10, 1, '2025-03-23 10:20:54', '2025-03-23 10:20:54'),
(26, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 5040, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e0350050edc1742746880.jpeg', 45, 1, 1, 10, 1, '2025-03-23 10:21:20', '2025-03-23 10:21:20'),
(27, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 7000, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e0350d8d7ba1742746893.jpeg', 45, 1, 1, 10, 1, '2025-03-23 10:21:33', '2025-03-23 10:21:33'),
(28, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 4600, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e0351937d6b1742746905.jpeg', 45, 1, 1, 10, 1, '2025-03-23 10:21:45', '2025-03-23 10:21:45'),
(29, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 3700, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e035269bd091742746918.jpeg', 45, 1, 1, 10, 1, '2025-03-23 10:21:58', '2025-03-23 10:21:58'),
(30, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 2900, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e035325982f1742746930.webp', 45, 1, 1, 10, 1, '2025-03-23 10:22:10', '2025-03-23 10:22:10'),
(31, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 2900, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e0353a30c3f1742746938.webp', 45, 1, 1, 10, 1, '2025-03-23 10:22:18', '2025-03-23 10:22:18'),
(32, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 2900, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e03543b71c11742746947.webp', 45, 1, 1, 10, 1, '2025-03-23 10:22:27', '2025-03-23 10:22:27'),
(33, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 3450, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e0354f3d6e81742746959.jpg', 45, 1, 1, 10, 1, '2025-03-23 10:22:39', '2025-03-23 10:22:39'),
(34, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 3850, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e0355a596101742746970.webp', 45, 1, 1, 10, 1, '2025-03-23 10:22:50', '2025-03-23 10:22:50'),
(35, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 4005, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e03568df3611742746984.jpg', 45, 1, 1, 10, 1, '2025-03-23 10:23:04', '2025-03-23 10:23:04'),
(36, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 5864, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e035759a9d31742746997.jpg', 45, 1, 1, 10, 1, '2025-03-23 10:23:17', '2025-03-23 10:23:17'),
(37, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 2564, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e03583bf8d21742747011.webp', 45, 1, 1, 10, 1, '2025-03-23 10:23:31', '2025-03-23 10:23:31'),
(38, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 5780, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e03590070c71742747024.webp', 45, 1, 1, 10, 1, '2025-03-23 10:23:44', '2025-03-23 10:23:44'),
(39, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 8464, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e0359d6422e1742747037.jpeg', 45, 1, 1, 10, 1, '2025-03-23 10:23:57', '2025-03-23 10:23:57'),
(40, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 5756, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e035a838c841742747048.jpg', 45, 1, 1, 10, 1, '2025-03-23 10:24:08', '2025-03-23 10:24:08'),
(41, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 4850, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e035b2310b31742747058.webp', 45, 1, 1, 10, 1, '2025-03-23 10:24:18', '2025-03-23 10:24:18'),
(42, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 9584, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e035bfcf5bb1742747071.jpg', 45, 1, 1, 10, 1, '2025-03-23 10:24:31', '2025-03-23 10:24:31'),
(43, 2, 3, 0, 'Pakistani Exclusive Design Qivilt', 45758, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance\r\n\r\nDiscover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan.\r\n\r\n\r\n✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns.\r\n✅ Premium Quality – Made with the finest materials for durability and elegance.\r\n✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship.\r\n✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication.\r\n\r\nExperience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e035ca7c1e31742747082.jpg', 45, 1, 1, 10, 1, '2025-03-23 10:24:42', '2025-03-23 10:24:42'),
(44, 1, 6, 0, 'Silk Luxery Kameez', 2600, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance Discover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan. ✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns. ✅ Premium Quality – Made with the finest materials for durability and elegance. ✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship. ✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication. Experience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e07ec504ebe1742765765.webp', 100, 1, 1, 5, 1, '2025-03-23 15:36:05', '2025-03-23 15:36:05'),
(45, 1, 6, 0, 'Silk Luxery Kameez', 2540, 'Pakistani Exclusive Design Qivilt – A Blend of Tradition & Elegance Discover the beauty of Pakistani Exclusive Design Qivilt, where tradition meets contemporary craftsmanship. Each piece is a work of art, meticulously designed to reflect the rich cultural heritage of Pakistan. ✅ Authentic Pakistani Designs – Inspired by classic motifs and intricate patterns. ✅ Premium Quality – Made with the finest materials for durability and elegance. ✅ Unique Handcrafted Touch – Every piece tells a story of skilled artisanship. ✅ Perfect for Every Occasion – Whether casual or formal, Qivilt adds a touch of sophistication. Experience timeless style with Pakistani Exclusive Design Qivilt – a true representation of tradition, class, and modern fashion.', '2025-03-2367e07f4928e0e1742765897.webp', 100, 1, 1, 5, 1, '2025-03-23 15:38:17', '2025-03-23 15:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_varients`
--

CREATE TABLE `product_varients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `cost_price` double NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_varients`
--

INSERT INTO `product_varients` (`id`, `product_id`, `size_id`, `color_id`, `cost_price`, `price`, `stock`, `sku`, `discount`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 7, 62, 40, 0, 'Eum ut voluptatem N', 85, NULL, '2025-03-20 09:37:42', '2025-03-20 09:37:42'),
(2, 2, 2, 6, 21, 200, 42, 'zbcv', 4, '2025-03-2067dc397a9d4b71742485882.jpg', '2025-03-20 09:51:22', '2025-03-20 09:51:22'),
(3, 2, 1, 4, 100, 300, 20, 'vcbn', 4, '2025-03-2067dc397a9e16b1742485882.png', '2025-03-20 09:51:22', '2025-03-20 09:51:22'),
(4, 2, 3, 2, 54, 400, 54, 'vhjl45', 45, '2025-03-2067dc397a9e8891742485882.webp', '2025-03-20 09:51:22', '2025-03-20 09:51:22'),
(5, 2, 5, 3, 45, 45, 4, '0', 4, '2025-03-2067dc397a9edef1742485882.jpg', '2025-03-20 09:51:22', '2025-03-20 09:51:22'),
(6, 3, 1, 3, 6, 500, 97, 'Et accusantium quos ', 50, '2025-03-2067dc4c6f68b7b1742490735.png', '2025-03-20 11:12:15', '2025-03-20 11:12:15'),
(7, 3, 1, 2, 9, 1000, 13, 'Voluptas assumenda o', 88, '2025-03-2067dc4c6f694bb1742490735.jpeg', '2025-03-20 11:12:15', '2025-03-20 11:12:15'),
(8, 4, 2, 1, 233, 544, 44, 'ASDE', 0, '2025-03-2267df04bed99cf1742668990.jpeg', '2025-03-22 12:43:10', '2025-03-22 12:43:10'),
(9, 4, 2, 3, 544, 543, 53, 'AEWF', 0, '2025-03-2267df04bedaaf91742668990.jpeg', '2025-03-22 12:43:10', '2025-03-22 12:43:10'),
(10, 4, 1, 6, 577, 866, 47, 'AFER', 0, '2025-03-2267df04bedaf041742668990.jpeg', '2025-03-22 12:43:10', '2025-03-22 12:43:10'),
(11, 4, 1, 8, 689, 990, 75, 'DEHDD', 0, '2025-03-2267df04bedb2c51742668990.jpeg', '2025-03-22 12:43:10', '2025-03-22 12:43:10'),
(12, 5, 2, 1, 2, 52, 1142, '51', 11, '2025-03-2267df0877dfc341742669943.png', '2025-03-22 12:59:03', '2025-03-22 12:59:03'),
(13, 5, 5, 1, 2562, 31451, 145, '45', 45, '2025-03-2267df0877e02311742669943.png', '2025-03-22 12:59:03', '2025-03-22 12:59:03'),
(14, 6, 5, 1, 2, 52, 1142, '51', 11, '2025-03-2267df08da8cef31742670042.png', '2025-03-22 13:00:42', '2025-03-22 13:00:42'),
(15, 6, 5, 3, 2562, 31451, 145, '45', 45, '2025-03-2267df08da8d4b51742670042.png', '2025-03-22 13:00:42', '2025-03-22 13:00:42'),
(16, 7, 1, 5, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e0333297a191742746418.webp', '2025-03-23 10:13:38', '2025-03-23 10:13:38'),
(17, 7, 7, 5, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e03332987e41742746418.jpg', '2025-03-23 10:13:38', '2025-03-23 10:13:38'),
(18, 8, 1, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e0335e932091742746462.webp', '2025-03-23 10:14:22', '2025-03-23 10:14:22'),
(19, 8, 1, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e0335e9379d1742746462.jpg', '2025-03-23 10:14:22', '2025-03-23 10:14:22'),
(20, 9, 1, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e033766d4c91742746486.webp', '2025-03-23 10:14:46', '2025-03-23 10:14:46'),
(21, 9, 1, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e033766dc0a1742746486.jpg', '2025-03-23 10:14:46', '2025-03-23 10:14:46'),
(22, 10, 1, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e03383aa8a21742746499.webp', '2025-03-23 10:14:59', '2025-03-23 10:14:59'),
(23, 10, 1, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e03383aae421742746499.jpg', '2025-03-23 10:14:59', '2025-03-23 10:14:59'),
(36, 15, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e0344aa4cb31742746698.webp', '2025-03-23 10:18:18', '2025-03-23 10:18:18'),
(37, 15, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e0344aa52b11742746698.jpg', '2025-03-23 10:18:18', '2025-03-23 10:18:18'),
(38, 15, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e0344aa56b61742746698.webp', '2025-03-23 10:18:18', '2025-03-23 10:18:18'),
(39, 15, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e0344aa5a781742746698.webp', '2025-03-23 10:18:18', '2025-03-23 10:18:18'),
(40, 15, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e0344aa641b1742746698.jpg', '2025-03-23 10:18:18', '2025-03-23 10:18:18'),
(41, 16, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e0345d16a961742746717.webp', '2025-03-23 10:18:37', '2025-03-23 10:18:37'),
(42, 16, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e0345d17a4e1742746717.jpg', '2025-03-23 10:18:37', '2025-03-23 10:18:37'),
(43, 16, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e0345d18c6a1742746717.webp', '2025-03-23 10:18:37', '2025-03-23 10:18:37'),
(44, 16, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e0345d192a11742746717.webp', '2025-03-23 10:18:37', '2025-03-23 10:18:37'),
(45, 16, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e0345d19d011742746717.jpg', '2025-03-23 10:18:37', '2025-03-23 10:18:37'),
(46, 17, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e0346a0853f1742746730.webp', '2025-03-23 10:18:50', '2025-03-23 10:18:50'),
(47, 17, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e0346a08a7e1742746730.jpg', '2025-03-23 10:18:50', '2025-03-23 10:18:50'),
(48, 17, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e0346a08e621742746730.webp', '2025-03-23 10:18:50', '2025-03-23 10:18:50'),
(49, 17, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e0346a092221742746730.webp', '2025-03-23 10:18:50', '2025-03-23 10:18:50'),
(50, 17, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e0346a095e31742746730.jpg', '2025-03-23 10:18:50', '2025-03-23 10:18:50'),
(51, 18, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e034751e5081742746741.webp', '2025-03-23 10:19:01', '2025-03-23 10:19:01'),
(52, 18, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e0347520dd61742746741.jpg', '2025-03-23 10:19:01', '2025-03-23 10:19:01'),
(53, 18, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e0347521cab1742746741.webp', '2025-03-23 10:19:01', '2025-03-23 10:19:01'),
(54, 18, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e03475224021742746741.webp', '2025-03-23 10:19:01', '2025-03-23 10:19:01'),
(55, 18, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e0347522b291742746741.jpg', '2025-03-23 10:19:01', '2025-03-23 10:19:01'),
(56, 19, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e0348233aaa1742746754.webp', '2025-03-23 10:19:14', '2025-03-23 10:19:14'),
(57, 19, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e0348244e2c1742746754.jpg', '2025-03-23 10:19:14', '2025-03-23 10:19:14'),
(58, 19, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e0348252de41742746754.webp', '2025-03-23 10:19:14', '2025-03-23 10:19:14'),
(59, 19, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e03482536d51742746754.webp', '2025-03-23 10:19:14', '2025-03-23 10:19:14'),
(60, 19, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e03482545d31742746754.jpg', '2025-03-23 10:19:14', '2025-03-23 10:19:14'),
(61, 20, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e034a8365631742746792.webp', '2025-03-23 10:19:52', '2025-03-23 10:19:52'),
(62, 20, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e034a8378fb1742746792.jpg', '2025-03-23 10:19:52', '2025-03-23 10:19:52'),
(63, 20, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e034a8441a01742746792.webp', '2025-03-23 10:19:52', '2025-03-23 10:19:52'),
(64, 20, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e034a8449f01742746792.webp', '2025-03-23 10:19:52', '2025-03-23 10:19:52'),
(65, 20, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e034a844fed1742746792.jpg', '2025-03-23 10:19:52', '2025-03-23 10:19:52'),
(66, 21, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e034b36d6081742746803.webp', '2025-03-23 10:20:03', '2025-03-23 10:20:03'),
(67, 21, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e034b36dc8f1742746803.jpg', '2025-03-23 10:20:03', '2025-03-23 10:20:03'),
(68, 21, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e034b36e3db1742746803.webp', '2025-03-23 10:20:03', '2025-03-23 10:20:03'),
(69, 21, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e034b36e95e1742746803.webp', '2025-03-23 10:20:03', '2025-03-23 10:20:03'),
(70, 21, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e034b36f92a1742746803.jpg', '2025-03-23 10:20:03', '2025-03-23 10:20:03'),
(71, 22, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e034bb23ff21742746811.webp', '2025-03-23 10:20:11', '2025-03-23 10:20:11'),
(72, 22, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e034bb245511742746811.jpg', '2025-03-23 10:20:11', '2025-03-23 10:20:11'),
(73, 22, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e034bb249481742746811.webp', '2025-03-23 10:20:11', '2025-03-23 10:20:11'),
(74, 22, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e034bb24d421742746811.webp', '2025-03-23 10:20:11', '2025-03-23 10:20:11'),
(75, 22, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e034bb25ea21742746811.jpg', '2025-03-23 10:20:11', '2025-03-23 10:20:11'),
(76, 23, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e034c7cf8461742746823.webp', '2025-03-23 10:20:23', '2025-03-23 10:20:23'),
(77, 23, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e034c7cfe271742746823.jpg', '2025-03-23 10:20:23', '2025-03-23 10:20:23'),
(78, 23, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e034c7d023c1742746823.webp', '2025-03-23 10:20:23', '2025-03-23 10:20:23'),
(79, 23, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e034c7d061d1742746823.webp', '2025-03-23 10:20:23', '2025-03-23 10:20:23'),
(80, 23, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e034c7d144f1742746823.jpg', '2025-03-23 10:20:23', '2025-03-23 10:20:23'),
(81, 24, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e034d82b4101742746840.webp', '2025-03-23 10:20:40', '2025-03-23 10:20:40'),
(82, 24, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e034d82be7d1742746840.jpg', '2025-03-23 10:20:40', '2025-03-23 10:20:40'),
(83, 24, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e034d82c7b11742746840.webp', '2025-03-23 10:20:40', '2025-03-23 10:20:40'),
(84, 24, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e034d82d28c1742746840.webp', '2025-03-23 10:20:40', '2025-03-23 10:20:40'),
(85, 24, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e034d82e44f1742746840.jpg', '2025-03-23 10:20:40', '2025-03-23 10:20:40'),
(86, 25, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e034e6ab0471742746854.webp', '2025-03-23 10:20:54', '2025-03-23 10:20:54'),
(87, 25, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e034e6ab8371742746854.jpg', '2025-03-23 10:20:54', '2025-03-23 10:20:54'),
(88, 25, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e034e6abf421742746854.webp', '2025-03-23 10:20:54', '2025-03-23 10:20:54'),
(89, 25, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e034e6ae06a1742746854.webp', '2025-03-23 10:20:54', '2025-03-23 10:20:54'),
(90, 25, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e034e6ae5c01742746854.jpg', '2025-03-23 10:20:54', '2025-03-23 10:20:54'),
(91, 26, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e03500532fa1742746880.webp', '2025-03-23 10:21:20', '2025-03-23 10:21:20'),
(92, 26, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e035007ff501742746880.jpg', '2025-03-23 10:21:20', '2025-03-23 10:21:20'),
(93, 26, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e035008eeb11742746880.webp', '2025-03-23 10:21:20', '2025-03-23 10:21:20'),
(94, 26, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e03500a35b31742746880.webp', '2025-03-23 10:21:20', '2025-03-23 10:21:20'),
(95, 26, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e03500a59c01742746880.jpg', '2025-03-23 10:21:20', '2025-03-23 10:21:20'),
(96, 27, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e0350d90e821742746893.webp', '2025-03-23 10:21:33', '2025-03-23 10:21:33'),
(97, 27, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e0350d970751742746893.jpg', '2025-03-23 10:21:33', '2025-03-23 10:21:33'),
(98, 27, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e0350d9761c1742746893.webp', '2025-03-23 10:21:33', '2025-03-23 10:21:33'),
(99, 27, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e0350d97a3f1742746893.webp', '2025-03-23 10:21:33', '2025-03-23 10:21:33'),
(100, 27, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e0350d97e341742746893.jpg', '2025-03-23 10:21:33', '2025-03-23 10:21:33'),
(101, 28, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e035193b7451742746905.webp', '2025-03-23 10:21:45', '2025-03-23 10:21:45'),
(102, 28, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e035193bc541742746905.jpg', '2025-03-23 10:21:45', '2025-03-23 10:21:45'),
(103, 28, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e035193c0231742746905.webp', '2025-03-23 10:21:45', '2025-03-23 10:21:45'),
(104, 28, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e035193c3de1742746905.webp', '2025-03-23 10:21:45', '2025-03-23 10:21:45'),
(105, 28, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e035193c88b1742746905.jpg', '2025-03-23 10:21:45', '2025-03-23 10:21:45'),
(106, 29, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e035269dc141742746918.webp', '2025-03-23 10:21:58', '2025-03-23 10:21:58'),
(107, 29, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e035269e1721742746918.jpg', '2025-03-23 10:21:58', '2025-03-23 10:21:58'),
(108, 29, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e035269eb641742746918.webp', '2025-03-23 10:21:58', '2025-03-23 10:21:58'),
(109, 29, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e035269f38c1742746918.webp', '2025-03-23 10:21:58', '2025-03-23 10:21:58'),
(110, 29, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e035269f8871742746918.jpg', '2025-03-23 10:21:58', '2025-03-23 10:21:58'),
(111, 30, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e035325cb7d1742746930.webp', '2025-03-23 10:22:10', '2025-03-23 10:22:10'),
(112, 30, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e035325d3c61742746930.jpg', '2025-03-23 10:22:10', '2025-03-23 10:22:10'),
(113, 30, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e035325d7d41742746930.webp', '2025-03-23 10:22:10', '2025-03-23 10:22:10'),
(114, 30, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e035325dbb01742746930.webp', '2025-03-23 10:22:10', '2025-03-23 10:22:10'),
(115, 30, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e035325dfda1742746930.jpg', '2025-03-23 10:22:10', '2025-03-23 10:22:10'),
(116, 31, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e0353a332971742746938.webp', '2025-03-23 10:22:18', '2025-03-23 10:22:18'),
(117, 31, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e0353a3382a1742746938.jpg', '2025-03-23 10:22:18', '2025-03-23 10:22:18'),
(118, 31, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e0353a33c571742746938.webp', '2025-03-23 10:22:18', '2025-03-23 10:22:18'),
(119, 31, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e0353a340641742746938.webp', '2025-03-23 10:22:18', '2025-03-23 10:22:18'),
(120, 31, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e0353a344921742746938.jpg', '2025-03-23 10:22:18', '2025-03-23 10:22:18'),
(121, 32, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e03543b908b1742746947.webp', '2025-03-23 10:22:27', '2025-03-23 10:22:27'),
(122, 32, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e03543b963a1742746947.jpg', '2025-03-23 10:22:27', '2025-03-23 10:22:27'),
(123, 32, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e03543b9a4d1742746947.webp', '2025-03-23 10:22:27', '2025-03-23 10:22:27'),
(124, 32, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e03543ba0cb1742746947.webp', '2025-03-23 10:22:27', '2025-03-23 10:22:27'),
(125, 32, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e03543ba59b1742746947.jpg', '2025-03-23 10:22:27', '2025-03-23 10:22:27'),
(126, 33, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e0354f3fcbf1742746959.webp', '2025-03-23 10:22:39', '2025-03-23 10:22:39'),
(127, 33, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e0354f40c5d1742746959.jpg', '2025-03-23 10:22:39', '2025-03-23 10:22:39'),
(128, 33, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e0354f410831742746959.webp', '2025-03-23 10:22:39', '2025-03-23 10:22:39'),
(129, 33, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e0354f415901742746959.webp', '2025-03-23 10:22:39', '2025-03-23 10:22:39'),
(130, 33, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e0354f419bb1742746959.jpg', '2025-03-23 10:22:39', '2025-03-23 10:22:39'),
(131, 34, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e0355a5de171742746970.webp', '2025-03-23 10:22:50', '2025-03-23 10:22:50'),
(132, 34, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e0355a5e78c1742746970.jpg', '2025-03-23 10:22:50', '2025-03-23 10:22:50'),
(133, 34, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e0355a5f4b31742746970.webp', '2025-03-23 10:22:50', '2025-03-23 10:22:50'),
(134, 34, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e0355a5fa8c1742746970.webp', '2025-03-23 10:22:50', '2025-03-23 10:22:50'),
(135, 34, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e0355a5ffb91742746970.jpg', '2025-03-23 10:22:50', '2025-03-23 10:22:50'),
(136, 35, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e03569016de1742746985.webp', '2025-03-23 10:23:05', '2025-03-23 10:23:05'),
(137, 35, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e03569024a61742746985.jpg', '2025-03-23 10:23:05', '2025-03-23 10:23:05'),
(138, 35, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e0356902dfc1742746985.webp', '2025-03-23 10:23:05', '2025-03-23 10:23:05'),
(139, 35, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e03569037121742746985.webp', '2025-03-23 10:23:05', '2025-03-23 10:23:05'),
(140, 35, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e03569055781742746985.jpg', '2025-03-23 10:23:05', '2025-03-23 10:23:05'),
(141, 36, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e035759e3a81742746997.webp', '2025-03-23 10:23:17', '2025-03-23 10:23:17'),
(142, 36, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e035759ea341742746997.jpg', '2025-03-23 10:23:17', '2025-03-23 10:23:17'),
(143, 36, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e035759ee9e1742746997.webp', '2025-03-23 10:23:17', '2025-03-23 10:23:17'),
(144, 36, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e035759f2ee1742746997.webp', '2025-03-23 10:23:17', '2025-03-23 10:23:17'),
(145, 36, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e035759f7581742746997.jpg', '2025-03-23 10:23:17', '2025-03-23 10:23:17'),
(146, 37, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e03583ea4601742747011.webp', '2025-03-23 10:23:31', '2025-03-23 10:23:31'),
(147, 37, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e03583eae2c1742747011.jpg', '2025-03-23 10:23:31', '2025-03-23 10:23:31'),
(148, 37, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e03584058671742747012.webp', '2025-03-23 10:23:32', '2025-03-23 10:23:32'),
(149, 37, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e0358405fd61742747012.webp', '2025-03-23 10:23:32', '2025-03-23 10:23:32'),
(150, 37, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e0358406a9d1742747012.jpg', '2025-03-23 10:23:32', '2025-03-23 10:23:32'),
(151, 38, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e035900a4911742747024.webp', '2025-03-23 10:23:44', '2025-03-23 10:23:44'),
(152, 38, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e035900a9bd1742747024.jpg', '2025-03-23 10:23:44', '2025-03-23 10:23:44'),
(153, 38, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e035900ae191742747024.webp', '2025-03-23 10:23:44', '2025-03-23 10:23:44'),
(154, 38, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e035900b2321742747024.webp', '2025-03-23 10:23:44', '2025-03-23 10:23:44'),
(155, 38, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e035900b62e1742747024.jpg', '2025-03-23 10:23:44', '2025-03-23 10:23:44'),
(156, 39, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e0359d662d11742747037.webp', '2025-03-23 10:23:57', '2025-03-23 10:23:57'),
(157, 39, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e0359d66c0c1742747037.jpg', '2025-03-23 10:23:57', '2025-03-23 10:23:57'),
(158, 39, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e0359d670c11742747037.webp', '2025-03-23 10:23:57', '2025-03-23 10:23:57'),
(159, 39, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e0359d675091742747037.webp', '2025-03-23 10:23:57', '2025-03-23 10:23:57'),
(160, 39, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e0359d67c151742747037.jpg', '2025-03-23 10:23:57', '2025-03-23 10:23:57'),
(161, 40, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e035a83b2b21742747048.webp', '2025-03-23 10:24:08', '2025-03-23 10:24:08'),
(162, 40, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e035a83b7f31742747048.jpg', '2025-03-23 10:24:08', '2025-03-23 10:24:08'),
(163, 40, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e035a83be361742747048.webp', '2025-03-23 10:24:08', '2025-03-23 10:24:08'),
(164, 40, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e035a83c2711742747048.webp', '2025-03-23 10:24:08', '2025-03-23 10:24:08'),
(165, 40, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e035a83c6601742747048.jpg', '2025-03-23 10:24:08', '2025-03-23 10:24:08'),
(166, 41, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e035b2347a51742747058.webp', '2025-03-23 10:24:18', '2025-03-23 10:24:18'),
(167, 41, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e035b234f031742747058.jpg', '2025-03-23 10:24:18', '2025-03-23 10:24:18'),
(168, 41, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e035b23534e1742747058.webp', '2025-03-23 10:24:18', '2025-03-23 10:24:18'),
(169, 41, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e035b23574b1742747058.webp', '2025-03-23 10:24:18', '2025-03-23 10:24:18'),
(170, 41, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e035b235b2c1742747058.jpg', '2025-03-23 10:24:18', '2025-03-23 10:24:18'),
(171, 42, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e035bfdff6b1742747071.webp', '2025-03-23 10:24:31', '2025-03-23 10:24:31'),
(172, 42, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e035bfe0f421742747071.jpg', '2025-03-23 10:24:31', '2025-03-23 10:24:31'),
(173, 42, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e035bfe15991742747071.webp', '2025-03-23 10:24:31', '2025-03-23 10:24:31'),
(174, 42, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e035bfe1c951742747071.webp', '2025-03-23 10:24:31', '2025-03-23 10:24:31'),
(175, 42, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e035bfe23501742747071.jpg', '2025-03-23 10:24:31', '2025-03-23 10:24:31'),
(176, 43, 2, 3, 300, 3800, 40, 'D3C25', 0, '2025-03-2367e035ca943ae1742747082.webp', '2025-03-23 10:24:42', '2025-03-23 10:24:42'),
(177, 43, 2, 4, 300, 4000, 214, 'D3C25', 4, '2025-03-2367e035ca948c71742747082.jpg', '2025-03-23 10:24:42', '2025-03-23 10:24:42'),
(178, 43, 1, 1, 400, 5000, 44, 'D3C25', 4545, '2025-03-2367e035ca94ca81742747082.webp', '2025-03-23 10:24:42', '2025-03-23 10:24:42'),
(179, 43, 1, 2, 445, 4000, 455, 'D3C25', 45, '2025-03-2367e035ca950701742747082.webp', '2025-03-23 10:24:42', '2025-03-23 10:24:42'),
(180, 43, 5, 2, 4557, 2000, 455, 'D3C25', 455, '2025-03-2367e035ca954351742747082.jpg', '2025-03-23 10:24:42', '2025-03-23 10:24:42'),
(181, 44, 1, 3, 2100, 2600, 20, 'D3F20', 20, '2025-03-2367e07ec50a8991742765765.webp', '2025-03-23 15:36:05', '2025-03-23 15:36:05'),
(182, 45, 1, 3, 2100, 2600, 20, 'D3F20XL', 20, '2025-03-2367e07f492bcef1742765897.webp', '2025-03-23 15:38:17', '2025-03-23 15:38:17'),
(183, 45, 2, 3, 2100, 2700, 40, 'D3F20G', 54, '2025-03-2367e07f492c30f1742765897.jpg', '2025-03-23 15:38:17', '2025-03-23 15:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `size_code`, `created_at`, `updated_at`) VALUES
(1, 'XL', '06', '2025-03-20 09:28:25', '2025-03-20 09:28:25'),
(2, 'M', '02', '2025-03-20 09:28:35', '2025-03-20 09:28:35'),
(3, 'S', '01', '2025-03-20 09:28:55', '2025-03-20 09:28:55'),
(4, 'L', '03', '2025-03-20 09:29:16', '2025-03-20 09:29:16'),
(5, 'LL', '04', '2025-03-20 09:29:25', '2025-03-20 09:29:25'),
(6, 'LLL', '05', '2025-03-20 09:29:43', '2025-03-20 09:29:43'),
(7, 'XXL', '07', '2025-03-20 09:29:53', '2025-03-20 09:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Ltr', 'ltr', '2025-03-20 09:36:02', '2025-03-20 09:36:02'),
(2, 'pcs', 'pcs', '2025-03-20 09:36:10', '2025-03-20 09:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
(1, 'Anika', 'arifuzzaman.rb@gmail.com', NULL, '$2y$10$CnxG/ftfeSAwsb2t67IYwe.yKooMEthmKrQ0cTrm0G/rs3mqMx6/m', 'klnyWMJ6gyBZvqTZVPMJr7Lt8rLXSvWr62J12uaRnW94BH5bccNjwobfJ0sb', '2025-03-21 08:42:22', '2025-03-21 08:42:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attrvalues`
--
ALTER TABLE `attrvalues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_phone_unique` (`phone`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_varients`
--
ALTER TABLE `product_varients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_slug_unique` (`slug`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attrvalues`
--
ALTER TABLE `attrvalues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_varients`
--
ALTER TABLE `product_varients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

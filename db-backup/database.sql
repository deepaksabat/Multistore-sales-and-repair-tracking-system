-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2016 at 09:52 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sales_warranty_track`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_read` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `activity`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'You have added Apex  as shop', '0', '2016-05-05 09:15:19', '2016-05-05 09:15:19'),
(2, 1, 'You have added SmartPhone  category', '0', '2016-05-05 09:23:06', '2016-05-05 09:23:06'),
(3, 1, 'You have added Apple  brand', '0', '2016-05-05 09:23:28', '2016-05-05 09:23:28'),
(4, 1, 'You have added iPhone  product', '0', '2016-05-05 09:24:50', '2016-05-05 09:24:50'),
(5, 1, 'You have added 48000  iPhone', '0', '2016-05-05 09:25:48', '2016-05-05 09:25:48'),
(6, 1, 'You have added 3000  iPhone to Apex', '0', '2016-05-05 09:26:22', '2016-05-05 09:26:22'),
(7, 3, 'You have deleted Mehedi doee', '0', '2016-06-08 11:31:48', '2016-06-08 11:31:48'),
(8, 1, 'You have added Samsung  brand', '0', '2016-06-11 12:19:38', '2016-06-11 12:19:38'),
(9, 1, 'You have added Samsung S6 Edge  product', '0', '2016-06-11 12:20:36', '2016-06-11 12:20:36'),
(10, 1, 'You have added Bata  as shop', '0', '2016-06-11 12:29:04', '2016-06-11 12:29:04'),
(11, 1, 'You have added 100  Samsung S6 Edge', '0', '2016-06-11 12:50:33', '2016-06-11 12:50:33'),
(12, 1, 'You have added 50  Samsung S6 Edge to Apex', '0', '2016-06-11 12:51:29', '2016-06-11 12:51:29'),
(13, 1, 'You have added Tab  category', '0', '2016-06-15 10:23:58', '2016-06-15 10:23:58'),
(14, 1, 'You have added Lenevo  brand', '0', '2016-06-15 10:24:11', '2016-06-15 10:24:11'),
(15, 1, 'You have added Battery  category', '0', '2016-06-18 04:42:13', '2016-06-18 04:42:13'),
(16, 1, 'You have added Laptop  category', '0', '2016-06-18 04:42:17', '2016-06-18 04:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Apple', '1', '2016-05-05 09:23:28', '2016-05-05 09:23:28'),
(2, 'Samsung', '1', '2016-06-11 12:19:38', '2016-06-11 12:19:38'),
(3, 'Lenevo', '1', '2016-06-15 10:24:11', '2016-06-15 10:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'SmartPhone', 1, '2016-05-05 09:23:06', '2016-05-05 09:23:06'),
(2, 'Tab', 1, '2016-06-15 10:23:58', '2016-06-15 10:23:58'),
(3, 'Battery', 1, '2016-06-18 04:42:13', '2016-06-18 04:42:13'),
(4, 'Laptop', 1, '2016-06-18 04:42:17', '2016-06-18 04:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `shop_id`, `user_id`, `invoice_id`, `total_price`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'MOJE5DJASC3U', 68000.00, 'Mr Amzad Hossain', 'amzad@gmail.com', '233453454', 'Noakhali, bangladesh', '2016-05-15 01:46:11', '2016-05-15 01:46:11'),
(2, 1, 1, 'SYD9ZQ3ERC7V', 68000.00, 'Jamil', 'jamil@gmail.com', '34564565', 'Hirapur, Dhaka', '2016-06-11 12:23:53', '2016-06-11 12:23:53'),
(3, 2, 1, 'QRYZM6JENVWN', 68000.00, 'Jamil', 'jamil@gmail.com', '34564565', 'Dhaka', '2016-06-11 12:46:41', '2016-06-11 12:46:41'),
(4, 2, 1, 'U7PI0K5GOZSQ', 68000.00, 'Jamil', 'jamil@gmail.com', '233453454', 'haka, bangladesh', '2016-06-11 13:53:26', '2016-06-11 13:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
CREATE TABLE IF NOT EXISTS `invoice_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `unit_price_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `product_id`, `qty`, `unit_price`, `unit_price_total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 34000.00, 68000.00, '2016-05-15 01:46:11', '2016-05-15 01:46:11'),
(2, 2, 2, 1, 68000.00, 68000.00, '2016-06-11 12:23:53', '2016-06-11 12:23:53'),
(3, 3, 2, 1, 68000.00, 68000.00, '2016-06-11 12:46:41', '2016-06-11 12:46:41'),
(4, 4, 2, 1, 68000.00, 68000.00, '2016-06-11 13:53:26', '2016-06-11 13:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `is_read` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `message_for` enum('shop','admin','user') COLLATE utf8_unicode_ci NOT NULL,
  `from` enum('shop','admin','user') COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `sender_id`, `subject`, `message`, `is_read`, `message_for`, `from`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Hello, please accept invitation', 'Seems you are not in the shop', '1', 'user', 'admin', 0, '2016-05-05 09:21:56', '2016-05-05 09:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_11_02_143908_create_sessions_table', 1),
('2015_11_04_172203_create_shops_table', 1),
('2015_11_06_152543_create_shop_user_table', 1),
('2015_11_09_181633_create_activity_table', 1),
('2015_11_11_172835_create_options_table', 1),
('2015_11_24_141639_create_messages_table', 1),
('2015_12_02_132602_create_category_table', 1),
('2015_12_02_145655_create_brands_table', 1),
('2015_12_02_155107_create_products_table', 1),
('2015_12_03_140616_create_product_attribute_table', 1),
('2015_12_03_184311_create_stocks__table', 1),
('2015_12_04_125420_create_invoice_table', 1),
('2015_12_04_125722_create_invoice_items_table', 1),
('2016_01_02_131635_create_repair_invoice', 1),
('2016_01_02_133919_create_repair_invoice_items', 1);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_key` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `option_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_key`, `option_value`) VALUES
(1, 'company_name', 'MSRTS'),
(2, 'invoice_footer_note', 'Sold item can''t be returned');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `brand_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unite_price` decimal(12,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `product_name`, `product_model`, `description`, `brand_id`, `category_id`, `unite_price`, `created_at`, `updated_at`) VALUES
(1, 1, 'iPhone', '6S', '  ', '1', '1', 34000.00, '2016-05-05 09:24:50', '2016-05-05 09:24:50'),
(2, 1, 'Samsung S6 Edge', '', '  ', '2', '1', 68000.00, '2016-06-11 12:20:36', '2016-06-11 12:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

DROP TABLE IF EXISTS `product_attributes`;
CREATE TABLE IF NOT EXISTS `product_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attribute_value` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `c_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`, `c_order`) VALUES
(1, 1, 'Display', '6Inch', 1),
(2, 1, 'Battery', '3000mhz', 2),
(3, 1, 'Protection', 'Gorilla glass protection 4', 3),
(4, 2, 'Battery', '3000mhz', 4),
(5, 2, 'Display', '6Inch', 5),
(6, 2, 'Protection', 'Gorilla glass protection 4', 6);

-- --------------------------------------------------------

--
-- Table structure for table `repair_invoices`
--

DROP TABLE IF EXISTS `repair_invoices`;
CREATE TABLE IF NOT EXISTS `repair_invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('waiting','in_process','completed') COLLATE utf8_unicode_ci NOT NULL,
  `special_note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `repair_invoices`
--

INSERT INTO `repair_invoices` (`id`, `shop_id`, `user_id`, `invoice_id`, `total_price`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `status`, `special_note`, `delivery_date`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'I8LXXRGYSKVH', 2500.00, 'Mr Amzad Hossain', 'amzad@gmail.com', '233453454', 'Dhaka, bangshal\r\nBangladesh', 'completed', 'Bring this invoice copy', '2016-05-17 18:00:00', '2016-05-05 09:54:45', '2016-05-15 08:37:08'),
(2, 1, 1, 'VAPS6VETQWAP', 600.00, 'Nasir Jamshad', 'nasir@demo.com', '3453454', 'Nadir HQ\r\nMotizheel, Dhaka', 'waiting', 'There have nothing', '2016-05-22 18:00:00', '2016-05-15 02:33:11', '2016-05-15 02:33:11'),
(3, 1, 1, 'UUCOE0ZCRQCF', 34000.00, 'Mr Amzad Hossain', 'amzad@gmail.com', '233453454', 'asf', 'completed', 'df df', '2016-05-17 18:00:00', '2016-05-15 03:09:16', '2016-05-15 03:22:19'),
(4, 1, 1, 'QTG4NIYK79UE', 800.00, 'Z Alvin', 'jamil@gmail.com', '34564565', 'Nagpur,\r\nMonoli,\r\nBangladesh', 'waiting', 'Display problem', '2016-06-14 18:00:00', '2016-06-15 10:26:10', '2016-06-15 10:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `repair_invoice_items`
--

DROP TABLE IF EXISTS `repair_invoice_items`;
CREATE TABLE IF NOT EXISTS `repair_invoice_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `unit_price_total` decimal(12,2) NOT NULL,
  `status` enum('waiting','in_process','completed') COLLATE utf8_unicode_ci NOT NULL,
  `engineer_note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `repair_invoice_items`
--

INSERT INTO `repair_invoice_items` (`id`, `invoice_id`, `product_id`, `qty`, `unit_price`, `unit_price_total`, `status`, `engineer_note`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2500.00, 2500.00, 'waiting', '', '2016-05-05 09:54:45', '2016-05-05 09:54:45'),
(2, 2, 1, 1, 600.00, 600.00, 'waiting', '', '2016-05-15 02:33:11', '2016-05-15 02:33:11'),
(3, 3, 1, 1, 34000.00, 34000.00, 'waiting', 'Not possible', '2016-05-15 03:09:16', '2016-05-15 03:22:27'),
(4, 4, 2, 1, 500.00, 500.00, 'waiting', '', '2016-06-15 10:26:10', '2016-06-15 10:26:10'),
(5, 4, 1, 1, 300.00, 300.00, 'waiting', '', '2016-06-15 10:26:10', '2016-06-15 10:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `payload`, `last_activity`) VALUES
('28f3f33fd9e0be38c7697916cacf988002357e11', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidG5wakZCWFpqdGhUN25ITVZ2TjJHbkJzQjBHS3JaakVMWXdwMm1DTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTg6Imh0dHA6Ly9sb2NhbGhvc3QvbXNydHMvZGVtby9wdWJsaWMvYWRtaW5pc3RyYXRvci9kYXNoYm9hcmQiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6Mzg6ImxvZ2luXzgyZTVkMmM1NmJkZDA4MTEzMThmMGNmMDc4Yjc4YmZjIjtzOjE6IjEiO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDY2MzUxNTQzO3M6MToiYyI7aToxNDY2MzUxNTM0O3M6MToibCI7czoxOiIwIjt9fQ==', 1466351543),
('a871e51c9d3e63dba6d3567c37208daec250225a', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRmVJZVlQNEloZWJPUzVTTWk0NTl2M09IWmlTTHZjNUdSVmN4Mmw2NCI7czo1OiJmbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo3MjoiaHR0cDovL2xvY2FsaG9zdC9tc3J0cy9tc3J0cy12LjEuMC9zb3VyY2UvcHVibGljL2FkbWluaXN0cmF0b3IvZGFzaGJvYXJkIjt9czozODoibG9naW5fODJlNWQyYzU2YmRkMDgxMTMxOGYwY2YwNzhiNzhiZmMiO3M6MToiMSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjYyODE3MTY7czoxOiJjIjtpOjE0NjYyNzMzODI7czoxOiJsIjtzOjE6IjAiO319', 1466281716);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
CREATE TABLE IF NOT EXISTS `shops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `bank_details` text COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1','2','3','4') COLLATE utf8_unicode_ci NOT NULL,
  `plan` enum('monthly','yearly') COLLATE utf8_unicode_ci NOT NULL,
  `commission_type` enum('fixed','percent') COLLATE utf8_unicode_ci NOT NULL,
  `commission_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` enum('bank_transfer','store_credit','both') COLLATE utf8_unicode_ci NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `subscription_ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `user_id`, `name`, `slug`, `email`, `description`, `address`, `bank_details`, `logo`, `status`, `plan`, `commission_type`, `commission_amount`, `payment_method`, `trial_ends_at`, `subscription_ends_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Apex', 'apex', 'info@apex.com', '', 'Dhaka\r\nBangladesh', '', '', '1', 'monthly', 'fixed', '', 'bank_transfer', NULL, NULL, '2016-05-05 09:15:19', '2016-05-05 09:15:19'),
(2, 1, 'Bata', 'bata', 'hello@bata.com', '', 'Bata\r\nBangladesh', '', '', '1', 'monthly', 'fixed', '', 'bank_transfer', NULL, NULL, '2016-06-11 12:29:04', '2016-06-11 12:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `shop_user`
--

DROP TABLE IF EXISTS `shop_user`;
CREATE TABLE IF NOT EXISTS `shop_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_type` enum('shop_admin','agent') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unite_price` decimal(12,2) NOT NULL,
  `total_product` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `shop_id`, `product_id`, `unite_price`, `total_product`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 3200.00, 48000, 1, '2016-05-05 09:25:48', '2016-05-05 09:25:48'),
(2, 1, 1, 0.00, 3000, 1, '2016-05-05 09:26:22', '2016-05-05 09:26:22'),
(3, 0, 2, 68000.00, 100, 1, '2016-06-11 12:50:33', '2016-06-11 12:50:33'),
(4, 1, 2, 0.00, 50, 1, '2016-06-11 12:51:29', '2016-06-11 12:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` enum('user','super_admin','sub_admin','shop_admin') COLLATE utf8_unicode_ci NOT NULL,
  `active_status` enum('0','1','2') COLLATE utf8_unicode_ci NOT NULL,
  `is_email_verified` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_online` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `shop_id` int(11) NOT NULL,
  `referral_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `referred_by` int(11) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `email`, `password`, `country_id`, `mobile`, `address`, `website`, `phone`, `photo`, `user_type`, `active_status`, `is_email_verified`, `activation_code`, `is_online`, `shop_id`, `referral_id`, `referred_by`, `last_login`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Doe', NULL, 'admin@demo.com', '$2y$10$esWuFLq.HfgbmjkRGpc.Keb51LxeqTeL2g0swccccJREU0fHIErqS', 0, '', '', '', '', '', 'super_admin', '1', '0', '', '0', 0, '', 0, NULL, 'fPMzSDLxkVlce1NnbZunnYSfRtAKy1LQNYX0ePqLPycYFAGcBBVaxgha418F', '2016-05-05 09:10:16', '2016-06-18 14:28:25'),
(2, 'Nigar', 'Sultana', NULL, 'user@apex.com', '$2y$10$GI01Q2XVnEXDbziAINJZ5.vJ.mmj6.64k80.K5T3FiRibullpQh6W', 0, '32453465675', '', '', '', '', 'user', '1', '0', '', '0', 1, 'TKRC6B', 0, NULL, 'xIA29OniwqpwGIiVNfVRtT9N75FjFoRBM22wQRMjtV9p10S38WMBmokCLUOr', '2016-05-05 09:20:48', '2016-05-15 10:06:47');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

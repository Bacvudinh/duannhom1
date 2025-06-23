-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2025 at 06:18 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duancopy`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`) VALUES
(31, 18, '2025-06-24 01:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `cart_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `variant_id` int DEFAULT NULL,
  `variant_size` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantity` int DEFAULT '1',
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `variant_id`, `variant_size`, `quantity`, `price`) VALUES
(206, 31, 41, 46, 'M', 1, '45000.00'),
(207, 31, 39, 41, 'M', 1, '25000.00'),
(208, 31, 39, 42, 'L', 1, '45000.00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Tạm dừng, 1: Hoạt động\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(15, 'Cà phê', NULL, 1),
(16, 'Trà sữa', NULL, 1),
(17, 'Trái cây', NULL, 1),
(18, 'Trà', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `comment` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `parent_id` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Ẩn, 1: Hiển thị'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `product_id`, `comment`, `created_at`, `parent_id`, `status`) VALUES
(50, 18, 39, 'rất ngon\r\n', '2025-06-24 01:05:13', NULL, 1),
(51, 18, 39, 'đồng ý ý', '2025-06-24 01:05:26', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Chờ xác nhận','Xác nhận','Đang giao hàng','Đã giao hàng','Hoàn thành','Đã hủy') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Chờ xác nhận',
  `payment_status` enum('Đã thanh toán','Chưa thanh toán') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Chưa thanh toán',
  `payment_method` enum('cod','momo','vnpay','bank_transfer') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_confirmed` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `created_at`, `status`, `payment_status`, `payment_method`, `customer_confirmed`) VALUES
(106, 18, '70000.00', '2025-06-24 01:06:22', 'Chờ xác nhận', 'Chưa thanh toán', 'vnpay', 0),
(107, 18, '70000.00', '2025-06-24 01:10:22', 'Chờ xác nhận', 'Đã thanh toán', 'vnpay', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_addresses`
--

CREATE TABLE `order_addresses` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `note` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_addresses`
--

INSERT INTO `order_addresses` (`id`, `order_id`, `name`, `phone`, `email`, `address`, `note`, `created_at`, `updated_at`) VALUES
(87, 106, 'Vũ Đình Bắc', '0987654321', 'admin@gmail.com', 'Số 9 đường Khuất Duy Tiến, phường Thanh Xuân Bắc, quận Thanh Xuân, TP. Hà Nội.', '', '2025-06-24 01:06:22', '2025-06-24 01:06:22'),
(88, 107, 'Vũ Đình Bắc', '0987654321', 'admin@gmail.com', 'Số 9 đường Khuất Duy Tiến, phường Thanh Xuân Bắc, quận Thanh Xuân, TP. Hà Nội.', '', '2025-06-24 01:10:22', '2025-06-24 01:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `variant_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `variant_id`) VALUES
(160, 106, 42, 1, '40000.00', 49),
(161, 106, 42, 1, '30000.00', 48),
(162, 107, 42, 1, '40000.00', 49),
(163, 107, 42, 1, '30000.00', 48);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `stock` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Suspended, 1: Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category_id`, `stock`, `created_at`, `is_delete`, `status`) VALUES
(38, 'Latte Trà Xanh Cốm Non', 'Hương vị mới lạ', '65000.00', '1750700750_Latte Trà Xanh Cốm Non.jpg', 16, 0, '2025-06-24 00:45:50', NULL, 1),
(39, '  Cà Phê Đen Đá ', 'Cafe nguyên chất', '25000.00', '1750700868_Cà Phê Đen Đá.png', 15, 0, '2025-06-24 00:47:48', NULL, 1),
(40, 'Cà phê Cappuccino', 'Hương vị mới', '45000.00', '1750700963_Cà phê Cappuccino.png', 15, 0, '2025-06-24 00:49:23', NULL, 1),
(41, 'Cà Phê Sữa Kem Silky ', '', '45000.00', '1750701014_Cà Phê Sữa Kem Silky .png', 15, 0, '2025-06-24 00:50:14', NULL, 1),
(42, 'Cà Phê Sữa Đá', '', '30000.00', '1750701056_Cà Phê Sữa Đá.png', 15, 0, '2025-06-24 00:50:56', NULL, 1),
(43, 'Cà phê Latte', '', '30000.00', '1750701100_Cà phê Latte.png', 15, 0, '2025-06-24 00:51:40', NULL, 1),
(44, 'Cà phê Latte', '', '55000.00', '1750701181_Cà phê Latte.png', 15, 0, '2025-06-24 00:53:01', NULL, 1),
(45, 'Trà Sữa Ô Long', '', '50000.00', '1750701305_Trà Sữa Phúc Long.png', 16, 0, '2025-06-24 00:55:05', NULL, 1),
(46, 'Trà Sữa Phúc Long', '', '40000.00', '1750701364_Trà Sữa Ô Long.png', 16, 0, '2025-06-24 00:56:04', NULL, 1),
(47, 'Trà Vải Lài', '', '40000.00', '1750701449_Trà Vải Lài.png', 18, 0, '2025-06-24 00:57:29', NULL, 1),
(48, 'Trà Sữa Ô Long Quế Hoa ', '', '40000.00', '1750701486_Trà Sữa Ô Long Quế Hoa .png', 16, 0, '2025-06-24 00:58:06', NULL, 1),
(49, 'Trà Nhãn Sen', '', '45000.00', '1750701539_Trà Nhãn Sen.png', 18, 0, '2025-06-24 00:59:00', NULL, 1),
(50, 'Hồng Trà Latte Nguyên Vị', '', '40000.00', '1750701586_Hồng Trà Latte Nguyên Vị.png', 18, 0, '2025-06-24 00:59:46', NULL, 1),
(51, 'Hồng Trà Latte Mây', '', '40000.00', '1750701630_Hồng Trà Latte Mây.png', 18, 0, '2025-06-24 01:00:30', NULL, 1),
(52, 'Hồng Trà Chanh', '', '25000.00', '1750701686_Hồng Trà Chanh.png', 18, 0, '2025-06-24 01:01:26', NULL, 1),
(53, 'Hồng Trà Đào ', '', '35000.00', '1750701718_Hồng Trà Đào .png', 18, 0, '2025-06-24 01:01:58', NULL, 1),
(54, 'Trà Lài Đác Thơm', '', '40000.00', '1750701752_Trà Lài Đác Thơm.png', 18, 0, '2025-06-24 01:02:32', NULL, 1),
(55, 'Trà Ô Long Dâu', '', '35000.00', '1750701788_Trà Ô Long Dâu.png', 18, 0, '2025-06-24 01:03:08', NULL, 1),
(56, 'Trà Lài Mãng Cầu Thạch Dừa Sợi', '', '55000.00', '1750701819_Trà Lài Mãng Cầu Thạch Dừa Sợi.png', 18, 0, '2025-06-24 01:03:39', NULL, 1),
(57, 'Trà Bá Tước Lựu Đỏ ', '', '50000.00', '1750701845_Trà Bá Tước Lựu Đỏ .png', 18, 0, '2025-06-24 01:04:05', NULL, 1),
(58, 'Trà Lài Phúc Bồn Tử Thạch Dừa Sợi', '', '55000.00', '1750701884_Trà Lài Phúc Bồn Tử Thạch Dừa Sợi.png', 18, 0, '2025-06-24 01:04:44', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `size` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `size`, `price`, `created_at`, `updated_at`) VALUES
(38, 38, 'S', '45000.00', '2025-06-23 17:45:50', '2025-06-23 17:45:50'),
(39, 38, 'M', '55000.00', '2025-06-23 17:45:50', '2025-06-23 17:45:50'),
(40, 38, 'L', '65000.00', '2025-06-23 17:45:50', '2025-06-23 17:45:50'),
(41, 39, 'M', '25000.00', '2025-06-23 17:47:48', '2025-06-23 17:47:48'),
(42, 39, 'L', '45000.00', '2025-06-23 17:47:48', '2025-06-23 17:47:48'),
(43, 40, 'S', '45000.00', '2025-06-23 17:49:23', '2025-06-23 17:49:23'),
(44, 40, 'M', '50000.00', '2025-06-23 17:49:23', '2025-06-23 17:49:23'),
(45, 40, 'L', '65000.00', '2025-06-23 17:49:23', '2025-06-23 17:49:23'),
(46, 41, 'M', '45000.00', '2025-06-23 17:50:14', '2025-06-23 17:50:14'),
(47, 41, 'L', '55000.00', '2025-06-23 17:50:14', '2025-06-23 17:50:14'),
(48, 42, 'S', '30000.00', '2025-06-23 17:50:56', '2025-06-23 17:50:56'),
(49, 42, 'M', '40000.00', '2025-06-23 17:50:56', '2025-06-23 17:50:56'),
(50, 42, 'L', '50000.00', '2025-06-23 17:50:56', '2025-06-23 17:50:56'),
(51, 43, 'S', '30000.00', '2025-06-23 17:51:40', '2025-06-23 17:51:40'),
(52, 43, 'M', '40000.00', '2025-06-23 17:51:40', '2025-06-23 17:51:40'),
(53, 43, 'L', '50000.00', '2025-06-23 17:51:40', '2025-06-23 17:51:40'),
(54, 44, 'S', '55000.00', '2025-06-23 17:53:01', '2025-06-23 17:53:01'),
(55, 44, 'M', '60000.00', '2025-06-23 17:53:01', '2025-06-23 17:53:01'),
(56, 44, 'L', '65000.00', '2025-06-23 17:53:01', '2025-06-23 17:53:01'),
(57, 45, 'S', '50000.00', '2025-06-23 17:55:05', '2025-06-23 17:55:05'),
(58, 45, 'M', '60000.00', '2025-06-23 17:55:05', '2025-06-23 17:55:05'),
(59, 45, 'L', '65000.00', '2025-06-23 17:55:05', '2025-06-23 17:55:05'),
(60, 46, 'S', '40000.00', '2025-06-23 17:56:04', '2025-06-23 17:56:04'),
(61, 46, 'M', '50000.00', '2025-06-23 17:56:04', '2025-06-23 17:56:04'),
(62, 46, 'L', '60000.00', '2025-06-23 17:56:04', '2025-06-23 17:56:04'),
(63, 47, 'S', '40000.00', '2025-06-23 17:57:29', '2025-06-23 17:57:29'),
(64, 47, 'M', '50000.00', '2025-06-23 17:57:29', '2025-06-23 17:57:29'),
(65, 47, 'L', '60000.00', '2025-06-23 17:57:29', '2025-06-23 17:57:29'),
(66, 48, 'S', '40000.00', '2025-06-23 17:58:06', '2025-06-23 17:58:06'),
(67, 48, 'M', '50000.00', '2025-06-23 17:58:06', '2025-06-23 17:58:06'),
(68, 48, 'L', '60000.00', '2025-06-23 17:58:06', '2025-06-23 17:58:06'),
(69, 49, 'S', '45000.00', '2025-06-23 17:59:00', '2025-06-23 17:59:00'),
(70, 49, 'M', '55000.00', '2025-06-23 17:59:00', '2025-06-23 17:59:00'),
(71, 49, 'L', '65000.00', '2025-06-23 17:59:00', '2025-06-23 17:59:00'),
(72, 50, 'S', '40000.00', '2025-06-23 17:59:46', '2025-06-23 17:59:46'),
(73, 50, 'M', '50000.00', '2025-06-23 17:59:46', '2025-06-23 17:59:46'),
(74, 50, 'L', '60000.00', '2025-06-23 17:59:46', '2025-06-23 17:59:46'),
(75, 51, 'S', '40000.00', '2025-06-23 18:00:30', '2025-06-23 18:00:30'),
(76, 51, 'M', '50000.00', '2025-06-23 18:00:30', '2025-06-23 18:00:30'),
(77, 51, 'L', '60000.00', '2025-06-23 18:00:30', '2025-06-23 18:00:30'),
(78, 52, 'M', '25000.00', '2025-06-23 18:01:26', '2025-06-23 18:01:26'),
(79, 52, 'L', '35000.00', '2025-06-23 18:01:26', '2025-06-23 18:01:26'),
(80, 53, 'M', '35000.00', '2025-06-23 18:01:58', '2025-06-23 18:01:58'),
(81, 53, 'L', '40000.00', '2025-06-23 18:01:58', '2025-06-23 18:01:58'),
(82, 54, 'S', '40000.00', '2025-06-23 18:02:32', '2025-06-23 18:02:32'),
(83, 54, 'M', '50000.00', '2025-06-23 18:02:32', '2025-06-23 18:02:32'),
(84, 54, 'L', '60000.00', '2025-06-23 18:02:32', '2025-06-23 18:02:32'),
(85, 55, 'S', '35000.00', '2025-06-23 18:03:08', '2025-06-23 18:03:08'),
(86, 55, 'M', '45000.00', '2025-06-23 18:03:08', '2025-06-23 18:03:08'),
(87, 55, 'L', '55000.00', '2025-06-23 18:03:08', '2025-06-23 18:03:08'),
(88, 56, 'M', '55000.00', '2025-06-23 18:03:39', '2025-06-23 18:03:39'),
(89, 56, 'L', '65000.00', '2025-06-23 18:03:39', '2025-06-23 18:03:39'),
(90, 57, 'M', '50000.00', '2025-06-23 18:04:05', '2025-06-23 18:04:05'),
(91, 57, 'L', '60000.00', '2025-06-23 18:04:05', '2025-06-23 18:04:05'),
(92, 58, 'M', '55000.00', '2025-06-23 18:04:44', '2025-06-23 18:04:44'),
(93, 58, 'L', '65000.00', '2025-06-23 18:04:44', '2025-06-23 18:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `discount_percent` decimal(5,2) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `code`, `description`, `discount_percent`, `start_date`, `end_date`, `active`) VALUES
(1, 'PROMOXNCI', 'Suddenly couple recognize understand suffer.', '45.00', '2025-04-18', '2025-06-10', 1),
(2, 'PROMORZFX', 'Information trip girl strategy.', '25.78', '2025-04-21', '2025-05-23', 1),
(3, 'PROMOELQR', 'Same bar national.', '20.74', '2025-04-28', '2025-06-13', 1),
(4, 'PROMOHGCS', 'Until smile something.', '47.86', '2025-04-24', '2025-06-09', 1),
(5, 'PROMOXJKY', 'Wrong total him again.', '39.42', '2025-04-27', '2025-05-26', 0),
(6, 'PROMOVBHS', 'Open impact generation structure.', '33.45', '2025-04-23', '2025-06-06', 0),
(7, 'PROMODTUX', 'Hold clear ask physical.', '45.88', '2025-04-25', '2025-06-15', 1),
(8, 'PROMOZDVV', 'Give play protect option.', '40.69', '2025-04-26', '2025-06-01', 1),
(9, 'PROMOSJRN', 'Why morning month evidence.', '42.11', '2025-04-28', '2025-05-30', 1),
(10, 'PROMOUZLP', 'Economy people others individual.', '10.21', '2025-04-29', '2025-06-11', 0),
(11, 'PROMO10', 'Giảm 10% toàn bộ đơn hàng', '10.00', '2025-05-01', '2025-06-01', 1),
(12, 'SUMMER15', 'Ưu đãi hè giảm 15%', '15.00', '2025-05-10', '2025-07-10', 1),
(13, 'FREESHIP', 'Miễn phí vận chuyển đơn từ 100K', '0.00', '2025-05-01', '2025-06-15', 1),
(14, 'VIP20', 'Giảm 20% cho thành viên VIP', '20.00', '2025-01-01', '2025-12-31', 1),
(15, 'WELCOME5', 'Giảm 5% cho khách hàng mới', '5.00', '2025-01-01', '2025-12-31', 1),
(16, 'HOTDEAL25', 'Deal hot giảm 25%', '25.00', '2025-05-15', '2025-05-30', 1),
(17, 'COFFEE30', 'Giảm 30% đồ uống cà phê', '30.00', '2025-05-20', '2025-06-20', 1),
(18, 'FLASH50', 'Giảm 50% trong khung giờ vàng', '50.00', '2025-05-18', '2025-05-18', 1),
(19, 'BLACKFRI', 'Black Friday sale 40%', '40.00', '2025-11-25', '2025-11-30', 0),
(20, 'NOEL20', 'Ưu đãi Giáng Sinh', '20.00', '2025-12-20', '2025-12-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `comment` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`) VALUES
(1, 5, 10, 3, 'Purpose himself forward might matter anyone.', '2025-04-29 19:58:08'),
(2, 7, 1, 5, 'Draw she performance eye party.', '2025-04-02 04:57:33'),
(3, 6, 7, 3, 'Pass great Democrat important.', '2025-03-04 03:51:44'),
(4, 10, 9, 1, 'Great none stuff edge.', '2025-05-09 10:53:28'),
(5, 1, 2, 4, 'Politics summer anyone.', '2025-03-23 22:55:39'),
(6, 6, 2, 5, 'War beautiful various soon.', '2025-05-02 08:58:47'),
(7, 4, 4, 4, 'Natural business Congress control.', '2025-05-08 17:07:33'),
(8, 1, 4, 4, 'Loss threat join.', '2025-05-12 05:35:15'),
(9, 5, 5, 1, 'Put might imagine especially.', '2025-02-09 20:02:53'),
(10, 10, 10, 4, 'Message feeling reach.', '2025-04-23 05:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 :ẩn 1 :hiện',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'S', 1, '2025-06-04 13:50:59', '2025-06-23 13:45:16'),
(4, 'M', 1, '2025-06-04 13:51:08', '2025-06-13 03:45:19'),
(7, 'L', 1, '2025-06-23 04:14:44', '2025-06-23 04:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `NAME` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `role` enum('customer','admin') COLLATE utf8mb4_general_ci DEFAULT 'customer',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `NAME`, `email`, `password`, `phone`, `address`, `role`, `created_at`, `status`) VALUES
(11, 'bắc', 'bacvudinh27042004@gmail.com', '1', '1', 'Số 9 đường Khuất Duy Tiến, phường Thanh Xuân Bắc, quận Thanh Xuân, TP. Hà Nội.', 'customer', '2025-05-24 11:42:47', 1),
(12, 'qưertfgh', '1@gmail.com', '$2y$10$FerbGFyALf.yoSv25b/SDe99Dfp1r7Y5IhaSQfrsiKCUsZa2GYoQ2', '1234568790', 'Số 9 đường Khuất Duy Tiến, phường Thanh Xuân Bắc, quận Thanh Xuân, TP. Hà Nội.', 'customer', '2025-05-24 12:32:05', 1),
(13, 'sadf', 'vudinhbac123@gmail.com', '$2y$10$L/dcWHGmUU5VIA1.Tg1A7eVcS6jLNcQhOwaGHW5.wygKdn.plJ75C', '000000000', 'ádfasdfasdfads', 'admin', '2025-05-26 18:25:40', 1),
(14, 'Phùng Đình Dũng', 'dung@gmail.com', '$2y$10$tj0tmIh4v9nFMAOnTo73Turclwtzm54OSyd6DKhJ4yt7adsQ3HFUW', '123456789', 'Số 9 đường Khuất Duy Tiến, phường Thanh Xuân Bắc, quận Thanh Xuân, TP. Hà Nội.', 'customer', '2025-05-29 11:52:28', 1),
(15, 'tuananh', 'tuananh@gmail.com', '$2y$10$zLsyM8sigr6VPxU1NHBTz.DfF8Baw.t193ut9p4UJ/zVg2Oge4EJC', '123456789', 'Số 9 đường Khuất Duy Tiến, phường Thanh Xuân Bắc, quận Thanh Xuân, TP. Hà Nội.', 'admin', '2025-06-05 14:04:30', 1),
(16, 'tuananh111', 'tuananh1234@gmail.com', '$2y$10$IZNQWwuzf0HLlrd3ifADHe1QFTQkS.EbSBEboTslwXEa2QkDiCEIa', '123456789', 'Số 9 đường Khuất Duy Tiến, phường Thanh Xuân Bắc, quận Thanh Xuân, TP. Hà Nội.', 'customer', '2025-06-10 13:46:15', 1),
(17, 'Tuấn Anh', 'tuananh09082005@gmail.com', '$2y$10$/ghi8SgucM6WHFtUpaga0e9qzWxWoCPvyTKMBiXzJAzFmLEx/7rce', '0332333951', 'Số 9 đường Khuất Duy Tiến, phường Thanh Xuân Bắc, quận Thanh Xuân, TP. Hà Nội.', 'customer', '2025-06-10 14:48:59', 1),
(18, 'Vũ Đình Bắc', 'admin@gmail.com', '$2y$10$K5ZjzX0HqRSLL.viTZA6ZuKGecTqv42ui4xNWY6ny/KP/en8WYx9m', '0987654321', 'Số 9 đường Khuất Duy Tiến, phường Thanh Xuân Bắc, quận Thanh Xuân, TP. Hà Nội.', 'customer', '2025-06-23 02:05:30', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD CONSTRAINT `order_addresses_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

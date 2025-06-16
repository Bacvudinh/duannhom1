-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2025 at 07:42 AM
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
(1, 1, '2025-05-17 08:00:00'),
(2, 2, '2025-05-17 08:10:00'),
(3, 3, '2025-05-17 08:20:00'),
(4, 4, '2025-05-17 08:30:00'),
(5, 5, '2025-05-17 08:40:00'),
(6, 6, '2025-05-17 08:50:00'),
(7, 7, '2025-05-17 09:00:00'),
(8, 8, '2025-05-17 09:10:00'),
(9, 9, '2025-05-17 09:20:00'),
(10, 10, '2025-05-17 09:30:00'),
(11, 13, '2025-05-27 16:22:23'),
(12, 12, '2025-05-29 14:22:50'),
(13, 14, '2025-05-29 19:05:08'),
(27, 15, '2025-06-05 19:04:37'),
(28, 16, '2025-06-10 18:52:55'),
(29, 17, '2025-06-10 19:53:28');

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
(2, 1, NULL, NULL, NULL, 1, NULL),
(3, 2, NULL, NULL, NULL, 1, NULL),
(5, 4, NULL, NULL, NULL, 1, NULL),
(9, 8, NULL, NULL, NULL, 1, NULL),
(10, 9, NULL, NULL, NULL, 2, NULL),
(15, 12, NULL, NULL, NULL, 1, '87.38'),
(137, 28, 27, 19, 'L', 1, '50000.00'),
(138, 28, 27, 20, 'S', 1, '10000.00');

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
(2, 'Coffee', NULL, 0),
(4, 'Beans', NULL, 0),
(5, 'Cups', NULL, 0),
(6, 'Milk', 'Shoulder voice huge wear another hard.', 1),
(7, 'Sugar', 'Character himself send knowledge.', 1),
(9, 'Mug', 'Plant another figure whole determine order.', 1),
(11, 'sdf', NULL, 0),
(13, 'sdfasdfasfdsdf', NULL, 0);

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
(26, 15, 24, 'sd', '2025-06-07 18:46:39', NULL, 1),
(29, 15, 27, 'ádsdsd', '2025-06-08 13:48:29', 28, 1),
(32, 15, 28, 'f', '2025-06-10 16:35:31', NULL, 1),
(34, 15, 24, 'hehe', '2025-06-10 18:28:01', 27, 1),
(35, 15, 27, '44', '2025-06-10 18:30:58', 28, 1),
(37, 15, 25, '5', '2025-06-10 18:31:26', 36, 1),
(40, 15, 25, 'cc', '2025-06-10 18:35:03', 38, 1),
(41, 15, 25, 'r', '2025-06-10 18:36:12', NULL, 1),
(43, 15, 24, 'd', '2025-06-10 18:38:00', 26, 1),
(45, 15, 27, 'l', '2025-06-13 10:35:14', NULL, 1),
(46, 13, 27, 'top\r\n', '2025-06-16 13:45:44', NULL, 1);

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
(61, 15, '215000.00', '2025-06-10 16:44:37', 'Hoàn thành', 'Đã thanh toán', 'cod', 0),
(62, 15, '45000.00', '2025-06-10 17:05:04', 'Đã giao hàng', 'Chưa thanh toán', 'cod', 0),
(63, 16, '10000.00', '2025-06-10 19:11:18', 'Hoàn thành', 'Đã thanh toán', 'cod', 0),
(64, 17, '105000.00', '2025-06-10 19:55:18', 'Hoàn thành', 'Đã thanh toán', 'cod', 0),
(65, 15, '30000.00', '2025-06-12 18:41:11', 'Đã hủy', 'Chưa thanh toán', 'cod', 0),
(66, 15, '110000.00', '2025-06-12 19:36:56', 'Hoàn thành', 'Đã thanh toán', 'cod', 0),
(67, 15, '650000.00', '2025-06-12 19:52:54', 'Hoàn thành', 'Đã thanh toán', 'cod', 0),
(68, 15, '350000.00', '2025-06-15 20:04:03', 'Chờ xác nhận', 'Chưa thanh toán', 'cod', 0),
(69, 15, '5000.00', '2025-06-15 20:05:18', 'Chờ xác nhận', 'Chưa thanh toán', 'cod', 0),
(70, 13, '5000.00', '2025-06-15 20:16:36', 'Hoàn thành', 'Đã thanh toán', 'cod', 0),
(72, 13, '5000.00', '2025-06-15 20:35:30', 'Hoàn thành', 'Đã thanh toán', 'vnpay', 0),
(73, 13, '100000.00', '2025-06-16 11:10:10', 'Hoàn thành', 'Đã thanh toán', 'vnpay', 0),
(74, 13, '25000.00', '2025-06-16 11:22:56', 'Hoàn thành', 'Đã thanh toán', 'vnpay', 0),
(75, 13, '25000.00', '2025-06-16 11:25:30', 'Hoàn thành', 'Đã thanh toán', 'vnpay', 0),
(76, 13, '25000.00', '2025-06-16 11:44:12', 'Hoàn thành', 'Đã thanh toán', 'vnpay', 0),
(77, 13, '30000.00', '2025-06-16 11:59:23', 'Hoàn thành', 'Đã thanh toán', 'vnpay', 0),
(78, 13, '230000.00', '2025-06-16 12:04:41', 'Đang giao hàng', 'Đã thanh toán', 'vnpay', 0),
(79, 13, '5000.00', '2025-06-16 12:11:52', 'Hoàn thành', 'Đã thanh toán', 'cod', 0),
(80, 13, '65000.00', '2025-06-16 12:16:54', 'Đã giao hàng', 'Đã thanh toán', 'vnpay', 1),
(81, 13, '5000.00', '2025-06-16 12:19:01', 'Hoàn thành', 'Đã thanh toán', 'cod', 0),
(82, 13, '5000.00', '2025-06-16 13:05:55', 'Đã hủy', 'Chưa thanh toán', 'vnpay', 0),
(83, 13, '55000.00', '2025-06-16 13:07:17', 'Đã hủy', 'Đã thanh toán', 'vnpay', 0),
(84, 13, '55000.00', '2025-06-16 13:08:04', 'Hoàn thành', 'Đã thanh toán', 'vnpay', 1),
(85, 13, '25000.00', '2025-06-16 13:16:30', 'Hoàn thành', 'Đã thanh toán', 'cod', 1),
(86, 13, '25000.00', '2025-06-16 13:33:25', 'Hoàn thành', 'Đã thanh toán', 'vnpay', 1);

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
(43, 61, 'tuananh', '0332333951', 'tuananh@gmail.com', 'To2 nong tien', '', '2025-06-10 16:44:37', '2025-06-10 16:44:37'),
(44, 62, 'tuananh', '0332333951', 'tuananh@gmail.com', 'To2 nong tien', '', '2025-06-10 17:05:04', '2025-06-10 17:05:04'),
(45, 63, 'tuananh111', '0332333951', 'tuananh1234@gmail.com', 'To2 nong tien', '', '2025-06-10 19:11:18', '2025-06-10 19:11:18'),
(46, 64, 'Tuấn Anh', '0332333951', 'tuananh09082005@gmail.com', 'To2 nong tiend', '', '2025-06-10 19:55:18', '2025-06-10 19:55:18'),
(47, 65, 'tuananh', '0332333951', 'tuananh@gmail.com', 'To2 nong tien', '', '2025-06-12 18:41:11', '2025-06-12 18:41:11'),
(48, 66, 'tuananh', '0332333951', 'tuananh@gmail.com', 'To2 nong tien', '', '2025-06-12 19:36:56', '2025-06-12 19:36:56'),
(49, 67, 'tuananh', '0332333951', 'tuananh@gmail.com', 'To2 nong tien', '', '2025-06-12 19:52:54', '2025-06-12 19:52:54'),
(50, 68, 'tuananh', '0332333951', 'tuananh@gmail.com', 'To2 nong tieneeeee', '', '2025-06-15 20:04:03', '2025-06-15 20:04:03'),
(51, 69, 'tuananh', '0985648996', 'tuananh@gmail.com', 'tyuiu', '', '2025-06-15 20:05:18', '2025-06-15 20:05:18'),
(52, 70, 'sadf', '1111111111', 'vudinhbac123@gmail.com', '1111111', '', '2025-06-15 20:16:36', '2025-06-15 20:16:36'),
(53, 72, 'sadf', '2345678900', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-15 20:35:30', '2025-06-15 20:35:30'),
(54, 73, 'sadf', '000111111', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 11:10:10', '2025-06-16 11:10:10'),
(55, 74, 'sadf', '000111111', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 11:22:56', '2025-06-16 11:22:56'),
(56, 75, 'sadf', '000111111', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 11:25:30', '2025-06-16 11:25:30'),
(57, 76, 'sadf', '000111111', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 11:44:12', '2025-06-16 11:44:12'),
(58, 77, 'sadf', '123456789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 11:59:23', '2025-06-16 11:59:23'),
(59, 78, 'sadf', '123456789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 12:04:41', '2025-06-16 12:04:41'),
(60, 79, 'COD', '000111111', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 12:11:52', '2025-06-16 12:11:52'),
(61, 80, 'VN', '123456789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 12:16:54', '2025-06-16 12:16:54'),
(62, 81, 'sadfCOD', '1212121212', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 12:19:01', '2025-06-16 12:19:01'),
(63, 82, 'sadf', '000000000', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 13:05:55', '2025-06-16 13:05:55'),
(64, 83, 'sadf', '123456789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 13:07:17', '2025-06-16 13:07:17'),
(65, 84, 'sadf', '123456789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 13:08:04', '2025-06-16 13:08:04'),
(66, 85, 'sadf', '000000000', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 13:16:30', '2025-06-16 13:16:30'),
(67, 86, 'sadf', '123456789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-06-16 13:33:25', '2025-06-16 13:33:25');

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
(31, 24, 9, 2, '97.89', NULL),
(32, 25, 9, 1, '97.89', NULL),
(33, 25, 9, 1, '97.89', NULL),
(34, 26, 9, 1, '97.89', NULL),
(35, 26, 9, 1, '97.89', NULL),
(36, 27, 9, 1, '97.89', NULL),
(37, 27, 9, 1, '97.89', NULL),
(38, 28, 4, 1, '87.38', NULL),
(39, 28, 4, 1, '87.38', NULL),
(40, 29, 4, 3, '87.38', NULL),
(41, 29, 4, 3, '87.38', NULL),
(42, 30, 9, 2, '97.89', NULL),
(43, 30, 9, 2, '97.89', NULL),
(44, 31, 4, 1, '87.38', NULL),
(45, 32, 4, 3, '87.38', NULL),
(46, 33, 4, 4, '87.38', NULL),
(47, 34, 4, 1, '87.38', NULL),
(48, 35, 24, 3, '10000.00', NULL),
(49, 35, 25, 1, '45000.00', NULL),
(51, 36, 27, 1, '50000.00', NULL),
(52, 37, 24, 1, '44.00', NULL),
(53, 38, 27, 2, '10000.00', NULL),
(54, 38, 27, 2, '50000.00', NULL),
(55, 39, 24, 1, '44.00', NULL),
(56, 40, 24, 1, '44.00', NULL),
(57, 41, 24, 1, '44.00', NULL),
(58, 42, 24, 1, '44.00', NULL),
(59, 42, 27, 1, '10000.00', NULL),
(60, 43, 24, 1, '44.00', NULL),
(61, 43, 28, 1, '25000.00', NULL),
(62, 44, 24, 1, '44.00', NULL),
(63, 45, 28, 1, '30000.00', NULL),
(64, 45, 28, 1, '35000.00', NULL),
(65, 46, 28, 1, '25000.00', NULL),
(66, 46, 28, 1, '30000.00', NULL),
(67, 46, 28, 1, '35000.00', NULL),
(68, 47, 28, 1, '25000.00', NULL),
(69, 47, 25, 13, '5000.00', NULL),
(70, 48, 24, 1, '44.00', 16),
(71, 49, 24, 1, '44.00', 16),
(72, 50, 28, 2, '30000.00', 22),
(73, 50, 28, 1, '35000.00', 23),
(74, 50, 28, 1, '25000.00', 21),
(75, 52, 28, 35000, '1.00', 23),
(76, 53, 28, 25000, '1.00', 21),
(77, 53, 28, 30000, '1.00', 22),
(78, 54, 28, 25000, '3.00', 21),
(79, 54, 28, 30000, '1.00', 22),
(80, 54, 28, 35000, '1.00', 23),
(81, 55, 24, 44, '1.00', 16),
(82, 55, 26, 5000, '1.00', 18),
(83, 55, 28, 25000, '1.00', 21),
(84, 55, 28, 30000, '1.00', 22),
(85, 56, 28, 25000, '1.00', 21),
(86, 56, 28, 30000, '1.00', 22),
(87, 57, 28, 25000, '4.00', 21),
(88, 57, 28, 30000, '1.00', 22),
(89, 57, 28, 35000, '1.00', 23),
(90, 58, 24, 44, '5.00', 16),
(91, 59, 24, 44, '1.00', 16),
(92, 60, 28, 25000, '1.00', 21),
(93, 60, 28, 30000, '2.00', 22),
(94, 60, 28, 35000, '5.00', 23),
(95, 60, 25, 5000, '1.00', 17),
(96, 60, 24, 44, '1.00', 16),
(97, 61, 24, 1, '10000.00', 16),
(98, 61, 28, 1, '25000.00', 21),
(99, 61, 25, 4, '45000.00', 17),
(100, 62, 25, 1, '45000.00', 17),
(101, 63, 26, 2, '5000.00', 18),
(102, 64, 28, 3, '25000.00', 22),
(103, 64, 28, 1, '25000.00', 23),
(104, 64, 26, 1, '5000.00', 18),
(105, 65, 26, 2, '5000.00', 18),
(106, 65, 27, 1, '10000.00', 19),
(107, 65, 27, 1, '10000.00', 20),
(108, 66, 27, 2, '50000.00', 19),
(109, 66, 27, 1, '10000.00', 20),
(110, 67, 29, 1, '100000.00', 24),
(111, 67, 29, 1, '150000.00', 25),
(112, 67, 29, 2, '200000.00', 26),
(113, 68, 28, 12, '25000.00', 21),
(114, 68, 27, 1, '50000.00', 19),
(115, 69, 26, 1, '5000.00', 18),
(116, 70, 26, 1, '5000.00', 18),
(117, 71, 26, 1, '5000.00', 18),
(118, 72, 26, 1, '5000.00', 18),
(119, 73, 29, 1, '100000.00', 24),
(120, 74, 28, 1, '25000.00', 21),
(121, 75, 28, 1, '25000.00', 21),
(122, 76, 28, 1, '25000.00', 21),
(123, 77, 28, 1, '25000.00', 21),
(124, 77, 26, 1, '5000.00', 18),
(125, 78, 28, 1, '25000.00', 21),
(126, 78, 26, 1, '5000.00', 18),
(127, 78, 29, 2, '100000.00', 24),
(128, 79, 26, 1, '5000.00', 18),
(129, 80, 28, 1, '35000.00', 23),
(130, 80, 28, 1, '30000.00', 22),
(131, 81, 26, 1, '5000.00', 18),
(132, 82, 26, 1, '5000.00', 18),
(133, 83, 26, 11, '5000.00', 18),
(134, 84, 26, 11, '5000.00', 18),
(135, 85, 28, 1, '25000.00', 21),
(136, 86, 28, 1, '25000.00', 21);

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
(24, 'ca phe', 'r', '10000.00', '1749126434_caphe1.jpg', 6, 115, '2025-06-05 19:27:14', NULL, 0),
(25, 'trà ', 'ngon', '45000.00', '1749126611_image.png', 7, 5456, '2025-06-05 19:30:11', NULL, 0),
(26, 'Hồng trà', 'Thơm', '5000.00', '1749127545_hongtra.png', 6, 29, '2025-06-05 19:45:45', NULL, 1),
(27, 'Tra moi', 'rrrrrr', '10000.00', '1749555794_higland.jpg', 7, 43, '2025-06-06 21:13:33', NULL, 1),
(28, 'Cà phê 247', 'NGON', '25000.00', '1749231072_caphe1.jpg', 6, 34, '2025-06-07 00:31:12', NULL, 1),
(29, 'Nuoc loc', 'NGON', '100000.00', '1749732667_caphe1.jpg', 6, 3, '2025-06-12 19:51:07', NULL, 1);

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
(16, 24, 'L', '44.00', '2025-06-05 12:27:14', '2025-06-05 12:27:14'),
(17, 25, 'L', '5000.00', '2025-06-05 12:30:11', '2025-06-05 12:30:11'),
(18, 26, 'L', '5000.00', '2025-06-05 12:45:45', '2025-06-05 12:45:45'),
(19, 27, 'L', '50000.00', '2025-06-06 14:13:33', '2025-06-06 14:13:33'),
(20, 27, 'S', '10000.00', '2025-06-06 14:13:33', '2025-06-06 14:13:33'),
(21, 28, 'L', '25000.00', '2025-06-06 17:31:12', '2025-06-06 17:31:12'),
(22, 28, 'S', '30000.00', '2025-06-06 17:31:12', '2025-06-06 17:31:12'),
(23, 28, 'M', '35000.00', '2025-06-06 17:31:12', '2025-06-06 17:31:12'),
(24, 29, 'S', '100000.00', '2025-06-12 12:51:07', '2025-06-12 12:51:07'),
(25, 29, 'M', '150000.00', '2025-06-12 12:51:07', '2025-06-12 12:51:07'),
(26, 29, 'L', '200000.00', '2025-06-12 12:51:07', '2025-06-12 12:51:07');

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
(3, 'S', 0, '2025-06-04 13:50:59', '2025-06-13 03:45:23'),
(4, 'M', 1, '2025-06-04 13:51:08', '2025-06-13 03:45:19'),
(5, 'XL', 1, '2025-06-04 13:51:18', '2025-06-04 13:51:18'),
(6, 'XLL', 1, '2025-06-13 03:38:22', '2025-06-13 03:38:22');

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
(1, 'Kevin Anderson', 'lturner@example.org', 'qP7uRZ5B2nc9', '284.743.0221', '60055 Eric Road, Bakerbury, NY 42765', 'admin', '2025-05-07 16:49:59', 1),
(2, 'Megan Miller', 'tlambert@example.org', 'fDFpbIMeZGjc', '422.690.7416', '22296 Weaver Junction, East Tara, GA 19698', 'admin', '2025-01-26 00:25:19', 1),
(3, 'Jack Briggs', 'travis61@example.org', 'R9XfdTTuEcXy', '662-660-2174', '3879 Neal Mill, West Michellemouth, ND 90370', 'customer', '2025-04-06 18:15:23', 1),
(4, 'Dawn Waller', 'ngonzales@example.org', 'f9QDQ1JrP4GH', '867-735-2381', '1915 Mills Loop Apt. 124, New Martin, AR 78349', 'admin', '2025-05-12 00:31:13', 1),
(5, 'Hannah Moore', 'frankcarr@example.org', 'WgD7slklozpa', '287-427-2709', '8627 Todd Canyon, West Jamesport, LA 92457', 'customer', '2025-04-07 08:20:23', 1),
(6, 'Taylor Smith', 'jamesgreen@example.com', 'JtvbRcOAGBzx', '210.440.5813', '4099 Gray Circles, West Kevin, WY 09950', 'customer', '2025-05-10 17:50:08', 1),
(7, 'Tyler Black', 'kimberlymiller@example.net', 'xu3YSH2ywhKZ', '857.964.2012', '94424 Moore Islands Apt. 307, Lake Anthony, IN 79884', 'admin', '2025-03-14 18:41:03', 1),
(8, 'Mackenzie Allen', 'gharrison@example.org', 'gZW60PaOJ6dG', '958-251-9442', '10559 Carlson Ports, Port Emily, AZ 20662', 'customer', '2025-03-04 03:33:47', 1),
(9, 'Jonathan Neal', 'jessicamills@example.org', '5NxNhJQghu4d', '724-260-1915', '77631 Aaron Ford, Nathanview, ME 80848', 'admin', '2025-05-14 07:24:13', 1),
(10, 'Jennifer Ross', 'twillis@example.net', '11', '468.684.5889', '78810 Jennifer Run Apt. 277, New Benjamin, VT 17787', 'customer', '2025-03-09 19:37:34', 1),
(11, 'bắc', 'bacvudinh27042004@gmail.com', '1', NULL, NULL, 'customer', '2025-05-24 11:42:47', 1),
(12, 'qưertfgh', '1@gmail.com', '$2y$10$FerbGFyALf.yoSv25b/SDe99Dfp1r7Y5IhaSQfrsiKCUsZa2GYoQ2', NULL, NULL, 'customer', '2025-05-24 12:32:05', 1),
(13, 'sadf', 'vudinhbac123@gmail.com', '$2y$10$L/dcWHGmUU5VIA1.Tg1A7eVcS6jLNcQhOwaGHW5.wygKdn.plJ75C', '000', 'ádfasdfasdfads ', 'admin', '2025-05-26 18:25:40', 1),
(14, 'Phùng Đình Dũng', 'dung@gmail.com', '$2y$10$tj0tmIh4v9nFMAOnTo73Turclwtzm54OSyd6DKhJ4yt7adsQ3HFUW', NULL, NULL, 'customer', '2025-05-29 11:52:28', 1),
(15, 'tuananh', 'tuananh@gmail.com', '$2y$10$zLsyM8sigr6VPxU1NHBTz.DfF8Baw.t193ut9p4UJ/zVg2Oge4EJC', NULL, NULL, 'admin', '2025-06-05 14:04:30', 1),
(16, 'tuananh111', 'tuananh1234@gmail.com', '$2y$10$IZNQWwuzf0HLlrd3ifADHe1QFTQkS.EbSBEboTslwXEa2QkDiCEIa', NULL, NULL, 'customer', '2025-06-10 13:46:15', 1),
(17, 'Tuấn Anh', 'tuananh09082005@gmail.com', '$2y$10$/ghi8SgucM6WHFtUpaga0e9qzWxWoCPvyTKMBiXzJAzFmLEx/7rce', '0332333951', 'To2 nong tiend', 'customer', '2025-06-10 14:48:59', 1);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2025 at 04:28 PM
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
-- Database: `du_an_1`
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
(13, 14, '2025-05-29 19:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `cart_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT '1',
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `price`) VALUES
(2, 1, 4, 1, NULL),
(3, 2, 5, 1, NULL),
(5, 4, 8, 1, NULL),
(9, 8, 9, 1, NULL),
(10, 9, 10, 2, NULL),
(15, 12, 4, 1, '87.38'),
(39, 11, 4, 2, '87.38');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Tạm dừng, 1: Hoạt động\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(2, 'Coffee', NULL, 1),
(4, 'Beans', 'Technology during among Mrs.', 1),
(5, 'Cups', 'Pattern those window off woman.', 1),
(6, 'Milk', 'Shoulder voice huge wear another hard.', 1),
(7, 'Sugar', 'Character himself send knowledge.', 1),
(9, 'Mug', 'Plant another figure whole determine order.', 1),
(11, 'sdf', NULL, 1),
(13, 'sdfasdfasfdsdf', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `parent_id` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Ẩn, 1: Hiển thị'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `product_id`, `comment`, `created_at`, `parent_id`, `status`) VALUES
(18, 13, 8, 'SADGHJKFGFD124342', '2025-06-02 18:23:26', NULL, 1),
(19, 13, 8, 'ádfasdfa', '2025-06-02 21:25:53', NULL, 1),
(20, 13, 8, 'ádfasf', '2025-06-02 21:31:14', NULL, 1),
(21, 13, 8, 'rfgsdfasdfasdfadsfasd', '2025-06-02 21:31:20', NULL, 0),
(22, 13, 8, 'bacdz', '2025-06-02 21:32:45', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Chờ xác nhận','Chờ lấy hàng','Đang giao hàng','Đã giao hàng','Hoàn thành','Đã hủy') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Chờ xác nhận'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `created_at`, `status`) VALUES
(22, 13, '97.89', '2025-05-31 12:14:24', 'Chờ xác nhận'),
(23, 13, '293.67', '2025-05-31 13:05:22', 'Đang giao hàng'),
(24, 13, '195.78', '2025-05-31 13:08:17', 'Đã hủy'),
(25, 13, '97.89', '2025-05-31 13:09:07', 'Đã hủy'),
(26, 13, '97.89', '2025-05-31 13:13:09', 'Đang giao hàng'),
(27, 13, '97.89', '2025-05-31 13:20:26', 'Đã hủy'),
(28, 13, '87.38', '2025-05-31 13:22:46', 'Chờ xác nhận'),
(29, 13, '262.14', '2025-05-31 13:34:37', 'Chờ xác nhận'),
(30, 13, '195.78', '2025-05-31 13:44:25', 'Đã hủy'),
(31, 13, '87.38', '2025-05-31 14:04:18', 'Đã hủy');

-- --------------------------------------------------------

--
-- Table structure for table `order_addresses`
--

CREATE TABLE `order_addresses` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text NOT NULL,
  `note` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_addresses`
--

INSERT INTO `order_addresses` (`id`, `order_id`, `name`, `phone`, `email`, `address`, `note`, `created_at`, `updated_at`) VALUES
(5, 22, 'sadf', '1234556789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-05-31 12:14:24', '2025-05-31 12:14:24'),
(6, 23, 'sadf', '1234567677', 'vudinhbac123@gmail.com', 'ádfasdfasdfads sfgdhcvkjgfds', '', '2025-05-31 13:05:22', '2025-05-31 13:05:22'),
(7, 24, 'sadf', '123456789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-05-31 13:08:17', '2025-05-31 13:08:17'),
(8, 25, 'sadf', '123456789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-05-31 13:09:07', '2025-05-31 13:09:07'),
(9, 26, 'sadf', '123456778', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-05-31 13:13:09', '2025-05-31 13:13:09'),
(10, 27, 'sadf', '123456789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-05-31 13:20:26', '2025-05-31 13:20:26'),
(11, 28, 'sadf', '123456789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-05-31 13:22:46', '2025-05-31 13:22:46'),
(12, 29, 'sadf', '123456788', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-05-31 13:34:37', '2025-05-31 13:34:37'),
(13, 30, 'sadf', '123456789', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-05-31 13:44:25', '2025-05-31 13:44:25'),
(14, 31, 'sadf', '1234567677', 'vudinhbac123@gmail.com', 'ádfasdfasdfads ', '', '2025-05-31 14:04:18', '2025-05-31 14:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(26, 22, 9, 1, '97.89'),
(27, 22, 9, 1, '97.89'),
(28, 23, 9, 3, '97.89'),
(29, 23, 9, 3, '97.89'),
(30, 24, 9, 2, '97.89'),
(31, 24, 9, 2, '97.89'),
(32, 25, 9, 1, '97.89'),
(33, 25, 9, 1, '97.89'),
(34, 26, 9, 1, '97.89'),
(35, 26, 9, 1, '97.89'),
(36, 27, 9, 1, '97.89'),
(37, 27, 9, 1, '97.89'),
(38, 28, 4, 1, '87.38'),
(39, 28, 4, 1, '87.38'),
(40, 29, 4, 3, '87.38'),
(41, 29, 4, 3, '87.38'),
(42, 30, 9, 2, '97.89'),
(43, 30, 9, 2, '97.89'),
(44, 31, 4, 1, '87.38');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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
(4, 'Latte11111111111', 'Although air argue animal dark sport.', '87.38', '1747918550_Ảnh chụp màn hình 2025-05-22 195434.png', 4, 58, '2025-01-21 00:38:42', 0, 1),
(5, 'Cup111', 'Scene yeah need certain while.', '35.48', '1747918573_Ảnh chụp màn hình 2024-11-22 214904.png', 6, 61, '2025-04-19 21:10:31', 0, 1),
(8, 'Coffee', 'Rest something scientist process reason.', '68.93', '1748422973_IMG_0066.JPG', 5, 0, '2025-04-20 08:24:27', 0, 1),
(9, 'Macchiato', 'Likely movement goal soon.', '97.89', '1748424182_IMG_1344.PNG', 6, 105, '2025-02-01 02:20:49', 0, 1),
(10, 'Brew', 'Interesting edge general positive.', '13.47', 'http://placeimg.com/640/480/any', 9, 20, '2025-02-01 00:35:29', 0, 1),
(11, 'sdf', 'ádf', '2.00', '1748425462_IMG_0066.JPG', 5, 0, '2025-05-28 16:44:22', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
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
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `NAME` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `role` enum('customer','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'customer',
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
(14, 'Phùng Đình Dũng', 'dung@gmail.com', '$2y$10$tj0tmIh4v9nFMAOnTo73Turclwtzm54OSyd6DKhJ4yt7adsQ3HFUW', NULL, NULL, 'customer', '2025-05-29 11:52:28', 1);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

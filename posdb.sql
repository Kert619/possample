-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 12:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(3, 'Fruits'),
(1, 'Home'),
(2, 'Sample Category'),
(8, 'Sample Category 1'),
(17, 'Sample Category 10'),
(18, 'Sample Category 11'),
(9, 'Sample Category 2'),
(10, 'Sample Category 3'),
(11, 'Sample Category 4'),
(12, 'Sample Category 5'),
(13, 'Sample Category 6'),
(14, 'Sample Category 7'),
(15, 'Sample Category 8'),
(16, 'Sample Category 9'),
(7, 'Vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `barcode` varchar(20) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `supplier_price` decimal(10,2) NOT NULL,
  `markup_price` decimal(10,2) NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `product_image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `barcode`, `product_name`, `category_id`, `unit`, `quantity`, `supplier_price`, `markup_price`, `reorder_level`, `product_image`) VALUES
(2, '219010623', 'Sample Product', 1, 'Box', 50, 63.25, 70.23, 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `role`) VALUES
(1, 'kert619', '$2y$10$93pQk0mn9xsnVqmIGfJvseXL1aoRg42eJVW3VSikDhDVYbvlQWfuO', 'Kert Tatoy', 'Admin'),
(2, 'serbermz', '$2y$10$1oTsDEqe6crE/UgVsNJ6uu6STIo6OXvQfWdk0ThPpTQegwxDKQnZW', 'serbermz', 'Cashier'),
(3, 'kirby159', '$2y$10$F9BhDsoxDAh/fRqQZeKfbOgSiyc9GMCqCl9rvcKp5liqHq7b.RFwO', 'Kirby Villaruz', 'Admin'),
(4, 'jainah159', '$2y$10$rbzJ6hpdqsT76wz7v6c/xejSExm/yBspr86FN/6x8nBIqjiv3XHZm', 'Jainah Sadaya', 'Cashier'),
(8, 'kian159', '$2y$10$G15KEDlzM2wlHPpUx.H5ee2jT5oK2FQABNxNYdK2pqQmNWq1II4bK', 'Kian Becera', 'Cashier'),
(9, 'remy159', '$2y$10$XCePa8nYlxwnI3Irc55MZeceealEsbx9MornRwO69bfKs2L/ekhce', 'Remy Andrade', 'Admin'),
(10, 'allysa159', '$2y$10$HxRmmJXeQwdzFmPITpCXBOHrbW46xUpM2KOOO1H4aOX37ZBfdsrdm', 'Alyssa Rae', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_category_category_name` (`category_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_products_product_name` (`product_name`) USING BTREE,
  ADD KEY `idx_products_barcode` (`barcode`) USING BTREE,
  ADD KEY `fk_products_categories_category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_users_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

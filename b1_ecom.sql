-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2020 at 08:31 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b1_ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `price` float(10,2) NOT NULL,
  `description` char(100) NOT NULL,
  `image` char(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `description`, `image`, `category_id`) VALUES
(26, 'Wwwwwww', 2211212.00, '', '../assets/images/', 1),
(27, 'Nachos', 25.00, 'Cheesy Nachos', '../assets/images/', 2),
(28, 'Banana', 1.00, 'Fruit', '../assets/images/', 1),
(29, 'Pasta', 7.00, '', '../assets/images/', 1),
(30, 'Pie', 15.00, '', '../assets/images/', 1),
(31, 'Pizza', 24.00, '', '../assets/images/', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_order`
--

CREATE TABLE `item_order` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_order`
--

INSERT INTO `item_order` (`id`, `item_id`, `order_id`, `quantity`, `subtotal`) VALUES
(2, 26, 20, '12', 26534544),
(3, 27, 21, '1', 25),
(4, 28, 21, '4', 4),
(5, 31, 21, '2', 48),
(6, 30, 21, '2', 30),
(7, 29, 21, '4', 28),
(8, 27, 22, '1', 25),
(9, 30, 22, '1', 15),
(10, 29, 22, '2', 14),
(11, 27, 23, '2', 50),
(12, 27, 24, '2', 50),
(13, 27, 25, '2', 50),
(14, 28, 26, '1', 1),
(15, 27, 27, '1', 25);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` float(10,2) NOT NULL,
  `date_pruchased` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isPaypal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `date_pruchased`, `isPaypal`) VALUES
(20, 2, 26534544.00, '2020-09-29 08:12:42', 0),
(21, 2, 135.00, '2020-09-29 08:27:09', 0),
(22, 2, 54.00, '2020-09-30 03:36:19', 0),
(23, 2, 50.00, '2020-09-30 08:08:46', 0),
(24, 2, 50.00, '2020-09-30 08:10:18', 0),
(25, 2, 50.00, '2020-09-30 08:11:26', 0),
(26, 2, 1.00, '2020-09-30 08:12:40', 1),
(27, 2, 25.00, '2020-10-01 01:40:07', 1),
(28, 2, 0.00, '2020-10-02 06:30:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `isAdmin`) VALUES
(2, 'John ', 'Doe', 'johndoe123', 'johndoe@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 0),
(3, 'admin', 'admin', 'admin123', 'admin@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 1),
(16, 'Asher', 'Chan', 'aqwqdwq1232', 'badwudbawdb@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 0),
(17, 'Asher', 'Chan', 'qweqweqwe', 'asherchan1188@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_ibfk_1` (`category_id`);

--
-- Indexes for table `item_order`
--
ALTER TABLE `item_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=380;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `item_order`
--
ALTER TABLE `item_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_order`
--
ALTER TABLE `item_order`
  ADD CONSTRAINT `item_order_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `item_order_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

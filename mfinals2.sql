-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 09:13 AM
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
-- Database: `mfinals2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `ItemCategory` varchar(200) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `ItemCategory`, `img`) VALUES
(1, 'Bags', 'upload/items/bag1.png'),
(2, 'Bottom', 'upload/items/bottom1.png'),
(3, 'Dress', 'upload/items/dress1.png'),
(4, 'Glass', 'upload/items/glass1.png');

-- --------------------------------------------------------

--
-- Table structure for table `currentuser`
--

CREATE TABLE `currentuser` (
  `UserId` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `profile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currentuser`
--

INSERT INTO `currentuser` (`UserId`, `FName`, `LName`, `username`, `email`, `address`, `phone`, `profile`) VALUES
(1, 'Femcaves', '', '0', 'femininecave@gmail.com', '', '', 'upload/users/hunter.png');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(200) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `ItemImage` varchar(200) NOT NULL,
  `Price` decimal(11,2) NOT NULL,
  `Solds` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `ItemName`, `Category`, `ItemImage`, `Price`, `Solds`, `Quantity`) VALUES
(1, 'Bag1', 'Bags', 'upload/items/bag1.png', 2222.00, 4, 68),
(2, 'Bag2', 'Bags', 'upload/items/bag2.png', 1729.00, 7, 22),
(3, 'Bag3', 'Bags', 'upload/items/bag3.png', 2729.00, 2, 10),
(4, 'Bag4', 'Bags', 'upload/items/bag4.png', 3213.00, 0, 9),
(5, 'Bag5', 'Bags', 'upload/items/bag5.png', 3213.00, 0, 111),
(6, 'Bag6', 'Bags', 'upload/items/bag6.png', 1729.00, 0, 300),
(7, 'Bottom 1', 'Bottom', 'upload/items/bottom1.png', 2333.00, 10, 415),
(8, 'Bottom 2', 'Bottom', 'upload/items/bottom2.png', 111.00, 0, 14),
(9, 'Bottom 3', 'Bottom', 'upload/items/bottom3.png', 1729.00, 0, 12),
(10, 'Bottom 4', 'Bottom', 'upload/items/bottom4.png', 1229.00, 0, 12),
(11, 'Bottom 5', 'Bottom', 'upload/items/bottom5.png', 1519.00, 0, 321),
(12, 'Bottom 6', 'Bottom', 'upload/items/bottom6.png', 4333.00, 0, 123),
(13, 'Dress 1', 'Dress', 'upload/items/dress1.png', 1113.00, 0, 252),
(14, 'Dress 2', 'Dress', 'upload/items/dress2.png', 3312.00, 2, 30),
(15, 'Dress 3', 'Dress', 'upload/items/dress3.png', 3312.00, 0, 32),
(16, 'Dress 4', 'Dress', 'upload/items/dress4.png', 3444.00, 0, 123),
(17, 'Dress 5', 'Dress', 'upload/items/dress5.png', 2312.00, 0, 444),
(18, 'Dress 6', 'Dress', 'upload/items/dress6.png', 2312.00, 0, 444),
(19, 'Glass 1', 'Glass', 'upload/items/glass1.png', 1123.00, 0, 423),
(20, 'Glass 2', 'Glass', 'upload/items/glass2.png', 1123.00, 0, 423),
(21, 'Glass 3', 'Glass', 'upload/items/glass3.png', 5233.00, 0, 23),
(22, 'Glass 4', 'Glass', 'upload/items/glass4.png', 1233.00, 0, 14),
(23, 'Glass 5', 'Glass', 'upload/items/glass5.png', 1233.00, 1, 16),
(24, 'Glass 6', 'Glass', 'upload/items/glass6.png', 1233.00, 0, 14),
(25, 'Perfume 12', 'Perfume', 'upload/items/glass6.png', 1233.00, 0, 14);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_quantity` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `product_id`, `order_date`, `order_quantity`, `total_amount`) VALUES
(1, 35, '1', '2024-01-12 08:20:29', 1, 3213.00),
(2, 38, '3', '2024-01-12 12:41:40', 1, 2729.00),
(3, 38, '1', '2024-01-12 13:48:06', 2, 6426.00),
(4, 38, '2', '2024-01-12 13:49:12', 4, 6916.00),
(5, 1, '14', '2024-01-12 18:16:32', 1, 3312.00),
(6, 1, '23', '2024-01-12 18:17:07', 1, 1233.00),
(7, 40, '2,14', '2024-01-12 18:45:43', 3, 8499.00),
(8, 1, '7', '2024-01-12 19:01:15', 10, 233300.00),
(9, 42, '26', '2024-01-12 19:26:36', 1, 1233.00),
(10, 1, '3', '2024-01-12 19:32:11', 1, 2729.00),
(11, 1, '1', '2024-01-12 19:33:10', 1, 2222.00);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `ItemID` int(11) NOT NULL,
  `Itemname` varchar(50) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`ItemID`, `Itemname`, `value`) VALUES
(1, 'Logo', 'upload/page/logo.png'),
(2, 'Company Name', 'Swiftie Shopper'),
(4, 'Background Color', '#ffffff'),
(5, 'Text Color', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount_paid` decimal(10,2) NOT NULL,
  `payment_mode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_id`, `customer_id`, `payment_date`, `amount_paid`, `payment_mode`) VALUES
(435377, 1, 35, '2024-01-12 08:20:29', 3213.00, 'paypal'),
(435378, 2, 38, '2024-01-12 12:41:40', 2729.00, 'credit_card'),
(435379, 3, 38, '2024-01-12 13:48:06', 6426.00, 'debit_card'),
(435380, 4, 38, '2024-01-12 13:49:12', 6916.00, 'credit_card'),
(435381, 5, 1, '2024-01-12 18:16:32', 3312.00, 'debit_card'),
(435382, 6, 1, '2024-01-12 18:17:07', 1233.00, 'credit_card'),
(435383, 7, 40, '2024-01-12 18:45:43', 8499.00, 'paypal'),
(435384, 8, 1, '2024-01-12 19:01:15', 233300.00, 'credit_card'),
(435386, 10, 1, '2024-01-12 19:32:11', 2729.00, 'credit_card'),
(435387, 11, 1, '2024-01-12 19:33:10', 2222.00, 'paypal');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `SlideID` int(11) NOT NULL,
  `imagename` varchar(50) NOT NULL,
  `imagelocation` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`SlideID`, `imagename`, `imagelocation`) VALUES
(1, 'slide1', 'upload/slideshow/1.png'),
(2, 'slide2', 'upload/slideshow/2.png'),
(3, 'slide3', 'upload/slideshow/3.png'),
(4, 'slide4', 'upload/slideshow/8.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `block` int(11) NOT NULL,
  `admin` int(1) NOT NULL,
  `profile` varchar(200) NOT NULL,
  `verification` varchar(10) NOT NULL,
  `verification_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FName`, `LName`, `username`, `password`, `email`, `phone`, `address`, `block`, `admin`, `profile`, `verification`, `verification_code`) VALUES
(1, 'Femcaves', '', 'admin', 'admin', 'femininecave@gmail.com', '', '', 0, 1, 'upload/users/hunter.png', '1', ''),
(35, 'Mae', 'Reyes', 'mae123', '$2y$10$3.RDWbyawxBP.f7eI/2Khu373VPPzbsxmpWvI6MlWLs2c34ZTg94y', '', '09300838124', '', 0, 0, 'upload/users/25f51dd0f5fedd4a9f141db60004d3a2.jpg', '1', '45228');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`ItemID`),
  ADD KEY `cart_ibfk_1` (`customer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ItemCategory`),
  ADD UNIQUE KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `currentuser`
--
ALTER TABLE `currentuser`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`SlideID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `currentuser`
--
ALTER TABLE `currentuser`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=435388;

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `SlideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2021 at 02:43 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `countryId` int(11) NOT NULL,
  `countryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countryId`, `countryName`) VALUES
(1, 'Rwanda'),
(2, 'Uganda'),
(3, 'Congo'),
(4, 'Tanzania'),
(5, 'Burundi'),
(6, 'USA'),
(7, 'Russia');

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE `login_info` (
  `loginId` int(11) NOT NULL,
  `MAC_ADDRESS` varchar(255) NOT NULL,
  `IP_ADDRESS` varchar(255) NOT NULL,
  `OS` varchar(255) NOT NULL,
  `Browser` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_info`
--

INSERT INTO `login_info` (`loginId`, `MAC_ADDRESS`, `IP_ADDRESS`, `OS`, `Browser`, `user_id`, `login_time`) VALUES
(15, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-06 05:09:08'),
(17, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-06 05:11:17'),
(19, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-06 05:15:26'),
(21, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-06 05:33:53'),
(22, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-06 05:37:50'),
(24, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-06 06:22:11'),
(25, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-06 06:24:25'),
(26, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-06 06:25:25'),
(27, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-06 11:00:58'),
(28, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-07 11:37:45'),
(29, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-07 11:39:01'),
(30, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-07 11:46:18'),
(31, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 41, '2021-05-07 11:55:41'),
(32, '6C-4B-90-C8-BD-D1', '192.168.1.44', 'Windows 10', 'Chrome', 37, '2021-05-07 11:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleId`, `role`) VALUES
(1, 'Administrator'),
(2, 'Manager'),
(3, 'Standard');

-- --------------------------------------------------------

--
-- Table structure for table `stk_inventory`
--

CREATE TABLE `stk_inventory` (
  `inventory_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stk_inventory`
--

INSERT INTO `stk_inventory` (`inventory_id`, `quantity`, `productId`, `userId`, `added_date`) VALUES
(12, 10, 25, 42, '2021-05-07 11:44:06'),
(13, 30, 25, 42, '2021-05-07 11:44:12'),
(14, 100, 27, 42, '2021-05-07 11:44:20'),
(15, 50, 28, 42, '2021-05-07 11:44:28'),
(16, 30, 26, 42, '2021-05-07 11:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `stk_outgoing`
--

CREATE TABLE `stk_outgoing` (
  `outgoingId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stk_outgoing`
--

INSERT INTO `stk_outgoing` (`outgoingId`, `productId`, `quantity`, `userId`, `added_date`) VALUES
(9, 25, 10, 42, '2021-05-07 11:44:47'),
(10, 25, 20, 42, '2021-05-07 11:44:53'),
(11, 28, 5, 42, '2021-05-07 11:45:01'),
(12, 26, 4, 42, '2021-05-07 11:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `stk_products`
--

CREATE TABLE `stk_products` (
  `productId` int(11) NOT NULL,
  `product_Name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `supplier_phone` varchar(15) DEFAULT NULL,
  `supplier` varchar(10) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userId` int(11) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stk_products`
--

INSERT INTO `stk_products` (`productId`, `product_Name`, `brand`, `supplier_phone`, `supplier`, `added_date`, `userId`, `last_login`) VALUES
(25, 'Milk', 'Beverages', '078238238', 'Inyange', '2021-05-07 11:42:43', 42, '2021-05-07 11:40:42'),
(26, 'Wine', 'Beverages', '08439283939', 'Drinks Ltd', '2021-05-07 11:41:01', 42, '2021-05-07 11:41:01'),
(27, 'Computer', 'DELL', '0712312312', 'Soft Ltd', '2021-05-07 11:41:33', 42, '2021-05-07 11:41:26'),
(28, 'Phone', 'Tecno', '0712312312', 'Micro Ltd', '2021-05-07 11:43:48', 42, '2021-05-07 11:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `stk_users`
--

CREATE TABLE `stk_users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `nationality` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `email` varchar(2555) NOT NULL,
  `username` varchar(20) NOT NULL,
  `user_password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stk_users`
--

INSERT INTO `stk_users` (`userId`, `firstName`, `lastName`, `gender`, `telephone`, `nationality`, `role`, `email`, `username`, `user_password`) VALUES
(37, 'Nkubito', 'Pacis', 'male', '0780754952', 1, 1, 'pacisnkubito@gmail.com', 'pacis', '8c88242d304c0c9562d9ae628672c8222fc7eb07cd9b40a903f4ab0bf216ffb2a53d2917d1e94675c78b0c5531ff143ca67b83beea4a30b04a0d4f5eeb9ad7f5'),
(41, 'Ishimwe', 'Javis', 'male', '0780754952', 7, 3, 'ishimwejavis@gmail.com', 'ishimwe', '491f04ee6c9a8def417e84afbcd4d945ca6c1bbbb19837beb40bc8315edbc4f6b42341afb0a5d17f1d4cdc509dadf4600d828c8839fbb0f62d636f41a016401b'),
(42, 'Mahoro', 'Jean', 'female', '0780754952', 5, 2, 'mahorojean@gmai.com', 'jean', 'bff33cb160cae386001610e5759ec7ba81a024e88c9c6d193da6de8e25678e1953d54f1c71ddf6ec40f129d1f2ef790e303e1b0fe3ffb41a1cf943d75c07fa77');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `login_info`
--
ALTER TABLE `login_info`
  ADD PRIMARY KEY (`loginId`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `stk_inventory`
--
ALTER TABLE `stk_inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `stk_outgoing`
--
ALTER TABLE `stk_outgoing`
  ADD PRIMARY KEY (`outgoingId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `stk_products`
--
ALTER TABLE `stk_products`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `stk_users`
--
ALTER TABLE `stk_users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`,`email`) USING HASH,
  ADD KEY `nationality` (`nationality`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `countryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_info`
--
ALTER TABLE `login_info`
  MODIFY `loginId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stk_inventory`
--
ALTER TABLE `stk_inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stk_outgoing`
--
ALTER TABLE `stk_outgoing`
  MODIFY `outgoingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stk_products`
--
ALTER TABLE `stk_products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `stk_users`
--
ALTER TABLE `stk_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_info`
--
ALTER TABLE `login_info`
  ADD CONSTRAINT `login_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `stk_users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stk_inventory`
--
ALTER TABLE `stk_inventory`
  ADD CONSTRAINT `stk_inventory_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `stk_products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stk_inventory_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `stk_users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stk_outgoing`
--
ALTER TABLE `stk_outgoing`
  ADD CONSTRAINT `stk_outgoing_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `stk_products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stk_outgoing_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `stk_users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stk_products`
--
ALTER TABLE `stk_products`
  ADD CONSTRAINT `stk_products_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `stk_users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stk_users`
--
ALTER TABLE `stk_users`
  ADD CONSTRAINT `stk_users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`roleId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

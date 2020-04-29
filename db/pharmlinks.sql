-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2020 at 10:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmlinks`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `added_by`, `date_added`) VALUES
(2, 'category one', 29, '2020-04-08 07:50:22'),
(3, 'category two', 29, '2020-04-08 07:50:26'),
(4, 'category three', 29, '2020-04-08 07:50:30'),
(5, 'category four', 29, '2020-04-08 07:50:35'),
(6, 'another category', 29, '2020-04-08 07:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'ADDO'),
(3, 'retailer'),
(4, 'wholesaler');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `lattitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `country`, `location_name`, `lattitude`, `longitude`) VALUES
(1, 'Tanzania', 'Dar es Salaam Institute of Technology, Morogoro Road, Dar es Salaam, Tanzania', '-6.8153224', '39.2801296'),
(2, 'Tanzania', 'Kimanga Bus Station, Dar es Salaam, Tanzania', '-6.827743', '39.2030398'),
(4, 'Tanzania', 'Dar es Salaam, Tanzania', '-6.792354', '39.2083284'),
(5, 'Tanzania', 'S.D. Supermarket nasco, Tanga, Tanzania', '-5.0706821', '39.1020909'),
(6, 'Tanzania', 'Changuu, Tanzania', '-6.119531800000001', '39.166397'),
(7, 'Tanzania', 'Dodoma, Tanzania', '-6.162959000000001', '35.75160689999999'),
(8, 'Tanzania', '1001 Organic Spicery, Tharia Street, Zanzibar City, Tanzania', '-6.1611742', '39.1919875'),
(9, 'Tanzania', 'Dar es Salaam, Tanzania', '-6.792354', '39.2083284'),
(10, 'Tanzania', 'Afya Bora Pharma Ltd, Dar es Salaam, Tanzania', '-6.819094199999999', '39.27463650000001'),
(11, 'Tanzania', 'Afya Bora Pharma Ltd, Dar es Salaam, Tanzania', '-6.819094199999999', '39.27463650000001'),
(12, 'Tanzania', 'Afya Bora Pharma Ltd, Dar es Salaam, Tanzania', '-6.819094199999999', '39.27463650000001'),
(13, 'Tanzania', 'Afya Bora Pharma Ltd, Dar es Salaam, Tanzania', '-6.819094199999999', '39.27463650000001'),
(14, 'Tanzania', 'Afya Bora Pharma Ltd, Dar es Salaam, Tanzania', '-6.819094199999999', '39.27463650000001'),
(15, 'Tanzania', 'Nkuhungu Chama Bus Stand, Dodoma, Tanzania', '-6.8436163', '39.725742'),
(16, 'Tanzania', 'Tabata-Bima Bus Station, Dar es Salaam, Tanzania', '-6.830945799999999', '39.2207622'),
(17, 'Tanzania', 'Faykat Tower, Dar es Salaam, Tanzania', '-6.7777164', '39.2658807'),
(18, 'Tanzania', 'Congo Street, Tanzania', '-6.821483199999999', '39.2740473'),
(19, 'Tanzania', 'SDS Technologies Ltd., Dar es Salaam, Tanzania', '-6.852271299999999', '39.23337'),
(20, 'Tanzania', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_number` varchar(100) NOT NULL,
  `from` int(11) NOT NULL,
  `transport_fee` int(11) NOT NULL,
  `date_ordered` varchar(50) NOT NULL,
  `retailer_active` int(11) NOT NULL DEFAULT 1,
  `seller_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_number`, `from`, `transport_fee`, `date_ordered`, `retailer_active`, `seller_active`) VALUES
(36, '231587654688', 23, 24993, '2020-04-23 17:11:28', 1, 1),
(37, '231587654719', 23, 27985, '2020-04-23 17:11:59', 1, 1),
(38, '231587654735', 23, 24993, '2020-04-23 17:12:15', 1, 1),
(39, '231587757178', 23, 24993, '2020-04-24 21:39:38', 1, 1),
(40, '231587757345', 23, 24993, '2020-04-24 21:42:25', 1, 1),
(41, '231587757519', 23, 24993, '2020-04-24 21:45:19', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_content`
--

CREATE TABLE `order_content` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `viewed` int(11) NOT NULL DEFAULT 0,
  `date_accepted` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_content`
--

INSERT INTO `order_content` (`id`, `order_id`, `to`, `product_id`, `quantity`, `price`, `status_id`, `viewed`, `date_accepted`) VALUES
(84, 36, 26, 6, 4, 9200, 1, 0, NULL),
(85, 36, 26, 5, 2, 2000, 1, 0, NULL),
(86, 37, 24, 10, 2, 688, 1, 0, NULL),
(87, 37, 26, 9, 2, 400, 1, 0, NULL),
(88, 37, 26, 8, 1, 1400, 1, 0, NULL),
(89, 38, 26, 5, 5, 5000, 1, 0, NULL),
(90, 39, 26, 8, 3, 4200, 1, 0, NULL),
(91, 40, 26, 9, 2, 400, 1, 0, NULL),
(92, 41, 26, 5, 1, 1000, 1, 0, NULL),
(93, 41, 26, 4, 1, 334, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'pending'),
(2, 'processing'),
(3, 'complete'),
(4, 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `FIN` varchar(255) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`id`, `name`, `user`, `location`, `FIN`, `date_registered`) VALUES
(13, 'pharmacy name', 22, 14, 'fin number', '2020-03-31 11:58:30'),
(14, 'sine pharmacy', 23, 15, 'finnumber', '2020-03-31 12:17:15'),
(15, 'zomper pharmacy', 24, 16, '445', '2020-03-31 13:08:07'),
(16, 'fridah pharmacy', 25, 17, 'fin number', '2020-03-31 13:14:48'),
(17, 'denis pharmacy', 26, 18, 'fin', '2020-04-01 09:18:18'),
(18, 'sas', 30, 19, 'as', '2020-04-06 10:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `generic_name` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `selling_package` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `industry` varchar(50) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `user`, `brand_name`, `generic_name`, `category`, `selling_package`, `price`, `discount`, `country`, `industry`, `quantity`, `description`, `status`, `date_added`) VALUES
(3, 26, 'asas', 'asas', 4, 4, 32900, 10000, 'asas', 'asas', 391, 'asas', 1, '2020-04-22 14:44:27'),
(4, 26, 'sdsd', 'sd', 6, 6, 334, 0, '233', '23', 229, '2323', 1, '2020-04-24 19:45:19'),
(5, 26, 'asas', 'ass', 4, 5, 1000, 0, 'sas', '', 894, '', 1, '2020-04-24 19:45:19'),
(6, 26, 'asas', 'asas', 5, 4, 2300, 0, 'sdsff', '', 180, 'x', 1, '2020-04-23 15:11:28'),
(7, 26, 'dgfg', 'dfdf', 4, 5, 4500, 3000, 'dsdsd', '', 100, 'sdsd', 0, '2020-04-21 10:07:27'),
(8, 26, 'sfdfd', 'dfdfx', 6, 4, 2000, 1400, 'dfdf', 'dfd', 96, 'dfdfg', 1, '2020-04-24 19:39:38'),
(9, 26, 'sdsxc', 'asas', 6, 3, 200, 0, 'sdsd', 'sdsd', 290, 'asazx', 1, '2020-04-24 19:42:25'),
(10, 24, 'new product', 'sds', 4, 4, 344, 0, 'sdsd', 'sdsd', 120, 'sdsddfdf', 1, '2020-04-23 15:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product`, `filename`, `date_added`) VALUES
(1, 8, '_15864357200pharmlinks_7.JPG.jpeg', '2020-04-09 12:35:22'),
(2, 8, '_15864357211pharmlinks_9.JPG.jpeg', '2020-04-09 12:35:22'),
(3, 9, '_1586437166015401975580amoxil_-_Copy.jpg', '2020-04-09 12:59:28'),
(4, 9, '_15864371671adult-beauty-cosmetic-1029896.jpg', '2020-04-09 12:59:28'),
(5, 10, '_1587121881015401975580amoxil_-_Copy.jpg', '2020-04-17 11:11:21'),
(6, 10, '_1587121881115401975580amoxil.jpg', '2020-04-17 11:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `pwd`
--

CREATE TABLE `pwd` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `pwd` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pwd`
--

INSERT INTO `pwd` (`id`, `user`, `pwd`) VALUES
(5, 22, '654321'),
(6, 23, '654321'),
(7, 24, '654321'),
(8, 25, '654321'),
(9, 26, '7654321'),
(10, 30, '87654321');

-- --------------------------------------------------------

--
-- Table structure for table `selling_package`
--

CREATE TABLE `selling_package` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `selling_package`
--

INSERT INTO `selling_package` (`id`, `name`, `added_by`, `date_added`) VALUES
(3, 'selling package one', 29, '2020-04-08 09:39:37'),
(4, 'second selling package', 29, '2020-04-08 11:22:04'),
(5, 'third selling package', 29, '2020-04-08 11:22:14'),
(6, 'fouth selling package', 29, '2020-04-08 11:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_fee`
--

CREATE TABLE `shipping_fee` (
  `id` int(11) NOT NULL,
  `fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_fee`
--

INSERT INTO `shipping_fee` (`id`, `fee`) VALUES
(1, 500);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `reference_number` varchar(11) DEFAULT NULL,
  `group` int(11) NOT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `phone_number`, `reference_number`, `group`, `gender`, `date_registered`, `update_at`, `last_login`, `active`, `verified`) VALUES
(22, NULL, NULL, 'daniellyatuu@gmail.com', 'daniellyatuu@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '065390085', 'pw2236', 2, NULL, '2020-03-31 11:58:30', '2020-03-31 11:59:00', NULL, 1, 1),
(23, NULL, NULL, 'sine@gmail.com', 'sine@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0715347677', 'pw1214', 3, NULL, '2020-03-31 12:17:15', '2020-03-31 12:19:00', NULL, 1, 1),
(24, NULL, NULL, 'zomper@gmail.com', 'zomper@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0685428184', NULL, 4, NULL, '2020-03-31 13:08:07', '2020-04-17 18:30:38', NULL, 1, 1),
(25, NULL, NULL, 'fridah@gmailcom', 'fridah@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0756789432', 'pw4275', 3, NULL, '2020-03-31 13:14:48', '2020-03-31 13:52:05', NULL, 1, 1),
(26, NULL, NULL, 'afyabora@gmail.com', 'afyabora@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '0653900079', NULL, 4, NULL, '2020-04-01 09:18:18', '2020-04-01 10:43:23', NULL, 1, 1),
(29, 'Pharmlinks', 'Admin', 'dan@gmail.com', 'dan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0715432377', NULL, 1, NULL, '2020-04-01 13:33:22', '2020-04-01 13:34:05', NULL, 1, 1),
(30, NULL, NULL, 'test@gmail.com', 'test@gmail.com', '25d55ad283aa400af464c76d713c07ad', '87778787', 'pw7107', 2, NULL, '2020-04-06 10:01:45', '2020-04-26 10:58:25', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `verification_code`
--

CREATE TABLE `verification_code` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verification_code`
--

INSERT INTO `verification_code` (`id`, `user`, `code`, `date_created`) VALUES
(2, 22, 7781, '2020-03-31 11:58:47'),
(3, 23, 9040, '2020-03-31 12:17:19'),
(4, 24, 9067, '2020-03-31 13:08:15'),
(5, 25, 5409, '2020-03-31 13:14:51'),
(6, 26, 1264, '2020-04-01 09:40:49'),
(7, 30, 3591, '2020-04-26 10:58:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_cart_user` (`user_id`),
  ADD KEY `FK_cart_product` (`product_id`),
  ADD KEY `FK_cart_user_2` (`seller_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_order_user` (`from`);

--
-- Indexes for table `order_content`
--
ALTER TABLE `order_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_order_content_order` (`order_id`),
  ADD KEY `FK_order_content_user_2` (`to`),
  ADD KEY `FK_order_content_product` (`product_id`),
  ADD KEY `FK_order_content_order_status` (`status_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pharmacy_user` (`user`),
  ADD KEY `FK_pharmacy_location` (`location`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_user` (`user`),
  ADD KEY `FK_product_category` (`category`),
  ADD KEY `FK_product_selling_package` (`selling_package`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_image_product` (`product`);

--
-- Indexes for table `pwd`
--
ALTER TABLE `pwd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pwd_user` (`user`);

--
-- Indexes for table `selling_package`
--
ALTER TABLE `selling_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_fee`
--
ALTER TABLE `shipping_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_group` (`group`);

--
-- Indexes for table `verification_code`
--
ALTER TABLE `verification_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_verification_code_user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `order_content`
--
ALTER TABLE `order_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pwd`
--
ALTER TABLE `pwd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `selling_package`
--
ALTER TABLE `selling_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipping_fee`
--
ALTER TABLE `shipping_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `verification_code`
--
ALTER TABLE `verification_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_cart_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cart_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cart_user_2` FOREIGN KEY (`seller_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_order_user` FOREIGN KEY (`from`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_content`
--
ALTER TABLE `order_content`
  ADD CONSTRAINT `FK_order_content_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_content_order_status` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_content_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_content_user_2` FOREIGN KEY (`to`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD CONSTRAINT `FK_pharmacy_location` FOREIGN KEY (`location`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pharmacy_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_product_selling_package` FOREIGN KEY (`selling_package`) REFERENCES `selling_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_product_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `FK_product_image_product` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pwd`
--
ALTER TABLE `pwd`
  ADD CONSTRAINT `FK_pwd_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_group` FOREIGN KEY (`group`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `verification_code`
--
ALTER TABLE `verification_code`
  ADD CONSTRAINT `FK_verification_code_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

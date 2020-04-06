-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2020 at 03:54 PM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(15, 'Tanzania', 'Nkuhungu Chama Bus Stand, Dodoma, Tanzania', '-6.1436163', '35.725742'),
(16, 'Tanzania', 'Tabata-Bima Bus Station, Dar es Salaam, Tanzania', '-6.830945799999999', '39.2207622'),
(17, 'Tanzania', 'Faykat Tower, Dar es Salaam, Tanzania', '-6.7777164', '39.2658807'),
(18, 'Tanzania', 'Congo Street, Tanzania', '-6.821483199999999', '39.2740473'),
(19, 'Tanzania', 'SDS Technologies Ltd., Dar es Salaam, Tanzania', '-6.852271299999999', '39.23337'),
(20, 'Tanzania', '', '', '');

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
(24, NULL, NULL, 'zomper@gmail.com', 'zomper@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0685428184', NULL, 4, NULL, '2020-03-31 13:08:07', '2020-03-31 13:08:32', NULL, 1, 1),
(25, NULL, NULL, 'fridah@gmailcom', 'fridah@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0756789432', 'pw4275', 3, NULL, '2020-03-31 13:14:48', '2020-03-31 13:52:05', NULL, 1, 1),
(26, NULL, NULL, 'afyabora@gmail.com', 'afyabora@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '0653900079', NULL, 4, NULL, '2020-04-01 09:18:18', '2020-04-01 10:43:23', NULL, 1, 1),
(29, 'Pharmlinks', 'Admin', 'dan@gmail.com', 'dan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0715432377', NULL, 1, NULL, '2020-04-01 13:33:22', '2020-04-01 13:34:05', NULL, 1, 1),
(30, NULL, NULL, 'test@gmail.com', 'test@gmail.com', '25d55ad283aa400af464c76d713c07ad', '87778787', NULL, 2, NULL, '2020-04-06 10:01:45', '2020-04-06 10:01:45', NULL, 1, 0);

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
(6, 26, 1264, '2020-04-01 09:40:49');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pharmacy_user` (`user`),
  ADD KEY `FK_pharmacy_location` (`location`);

--
-- Indexes for table `pwd`
--
ALTER TABLE `pwd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pwd_user` (`user`);

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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pwd`
--
ALTER TABLE `pwd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `verification_code`
--
ALTER TABLE `verification_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD CONSTRAINT `FK_pharmacy_location` FOREIGN KEY (`location`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pharmacy_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

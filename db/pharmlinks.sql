-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2020 at 01:23 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

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
(9, 'Tanzania', 'Dar es Salaam, Tanzania', '-6.792354', '39.2083284');

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
(1, 'daniel pharmacy', 9, 2, '1212', '2020-03-26 10:49:08'),
(3, 'daniel p', 11, 4, 'dsdsd', '2020-03-26 11:20:04'),
(8, 'projesta pharmacy', 16, 9, 'fin number', '2020-03-26 11:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `phone_number` int(50) NOT NULL,
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

INSERT INTO `user` (`id`, `first_name`, `email`, `last_name`, `username`, `password`, `phone_number`, `reference_number`, `group`, `gender`, `date_registered`, `update_at`, `last_login`, `active`, `verified`) VALUES
(8, NULL, 'daniellyatuu@gmail.com', NULL, 'daniellyatuu@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 255653900, NULL, 3, NULL, '2020-03-26 10:01:20', '2020-03-26 10:01:20', NULL, 1, 0),
(9, NULL, 'dan@gmail.com', NULL, 'dan@gmail.com', '25d55ad283aa400af464c76d713c07ad', 255121212, NULL, 3, NULL, '2020-03-26 10:49:08', '2020-03-26 10:49:08', NULL, 1, 0),
(10, NULL, 'sine@gmail.com', NULL, 'sine@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 255112121, NULL, 2, NULL, '2020-03-26 10:54:36', '2020-03-26 10:54:36', NULL, 1, 0),
(11, NULL, 'daniellyatuu1@gmail.com', NULL, 'daniellyatuu1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 255121212, NULL, 4, NULL, '2020-03-26 11:20:04', '2020-03-26 11:20:04', NULL, 1, 0),
(16, NULL, 'projesta@gmail.com', NULL, 'projesta@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 255121212, NULL, 4, NULL, '2020-03-26 11:37:36', '2020-03-26 11:37:36', NULL, 1, 0);

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
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `verification_code`
--
ALTER TABLE `verification_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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

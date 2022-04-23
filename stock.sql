-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2018 at 04:24 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `category` varchar(200) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `category`, `value`) VALUES
(6, 'vendor', 'visanth'),
(12, 'category', 'cereals'),
(13, 'category', 'fruits'),
(14, 'vendor', 'laks'),
(15, 'vendor', 'gowt'),
(16, 'category', 'pulses'),
(17, 'category', 'vegetables'),
(18, 'vendor', 'karthi');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `id` int(11) NOT NULL,
  `college` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `college`, `date`, `count`) VALUES
(1, 'RMK', '2018-07-08', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `current`
--

CREATE TABLE `current` (
  `id` int(11) NOT NULL,
  `item` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `quantity` bigint(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current`
--

INSERT INTO `current` (`id`, `item`, `category`, `quantity`) VALUES
(9, 'item1', 'fruits', 62),
(10, 'item2', 'pulses', 90),
(11, 'item3', 'vegetables', 100),
(12, 'item4', 'cereals', 10),
(13, 'item5', 'cereals', 100),
(14, 'item6', 'pulses', 930);

-- --------------------------------------------------------

--
-- Table structure for table `dispatch`
--

CREATE TABLE `dispatch` (
  `id` int(11) NOT NULL,
  `item` varchar(200) NOT NULL,
  `quantity` bigint(200) NOT NULL,
  `place` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dispatch`
--

INSERT INTO `dispatch` (`id`, `item`, `quantity`, `place`, `date`) VALUES
(12, 'item1', 10, 'RMD', '2018-07-08 10:00:52'),
(13, 'item1', 8, 'RMD', '2018-07-08 10:00:52'),
(14, 'item2', 10, 'RMK', '2018-07-08 10:00:53'),
(15, 'item1', 10, 'RMK', '2018-07-08 10:00:53'),
(16, 'item6', 70, 'RMKCET', '2018-07-08 10:00:53'),
(17, 'item1', 10, 'RMK', '2018-07-08 12:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `item` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `quantity` bigint(200) NOT NULL,
  `amountkg` bigint(200) NOT NULL,
  `amount` bigint(200) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `item`, `category`, `quantity`, `amountkg`, `amount`, `time`) VALUES
(36, 'item1', 'fruits', 100, 1000, 100000, '2018-07-08 09:57:35'),
(37, 'item2', 'pulses', 100, 10, 1000, '2018-07-08 09:59:17'),
(38, 'item3', 'vegetables', 100, 10, 1000, '2018-07-08 09:59:17'),
(39, 'item4', 'cereals', 10, 10, 100, '2018-07-08 09:59:18'),
(40, 'item5', 'cereals', 100, 8, 800, '2018-07-08 09:59:18'),
(41, 'item6', 'pulses', 1000, 10, 10000, '2018-07-08 09:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `pass`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current`
--
ALTER TABLE `current`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispatch`
--
ALTER TABLE `dispatch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `current`
--
ALTER TABLE `current`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dispatch`
--
ALTER TABLE `dispatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

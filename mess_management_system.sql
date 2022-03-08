-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2022 at 06:08 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mess_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bazars`
--

CREATE TABLE `bazars` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` longtext NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bazars`
--

INSERT INTO `bazars` (`id`, `member_id`, `date`, `description`, `total`) VALUES
(1, 2, '2022-03-06', '<ol>\r\n	<li>murgi</li>\r\n	<li>mach</li>\r\n	<li>cal</li>\r\n</ol>\r\n', 490),
(2, 2, '2022-02-09', '', 323),
(3, 7, '2022-03-01', '', 500),
(4, 7, '2022-03-06', '<ol>\r\n	<li>morga -150 tk</li>\r\n	<li>lsndfjk</li>\r\n</ol>\r\n', 500),
(5, 7, '2022-02-06', '', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `day_meal` int(10) NOT NULL,
  `night_meal` int(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `member_id`, `day_meal`, `night_meal`, `date`) VALUES
(13, 2, 1, 1, '2022-03-07'),
(14, 7, 1, 1, '2022-03-07'),
(15, 2, 0, 1, '2022-03-06'),
(16, 7, 1, 1, '2022-03-06'),
(17, 2, 2, 1, '2022-03-08'),
(18, 7, 1, 5, '2022-03-08'),
(19, 2, 1, 3, '2022-02-06'),
(20, 7, 2, 3, '2022-02-06');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'mehedi', 'mehedi@gmail.com', '202cb962ac59075b964b07152d234b70'),
(7, 'Mazharol Islam Evon', 'evon@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `weakly_bazars`
--

CREATE TABLE `weakly_bazars` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bazars`
--
ALTER TABLE `bazars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weakly_bazars`
--
ALTER TABLE `weakly_bazars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bazars`
--
ALTER TABLE `bazars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `weakly_bazars`
--
ALTER TABLE `weakly_bazars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bazars`
--
ALTER TABLE `bazars`
  ADD CONSTRAINT `bazars_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2021 at 03:40 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phprestapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `aid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`aid`, `name`, `email`, `password`, `created`, `modified`) VALUES
(1, 'aamir', 'aamir@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Azhar khan', 'azharkhan1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-12-16 18:56:26', '2019-12-16 18:56:26'),
(5, 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '2021-01-10 09:41:44', '2021-01-10 09:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Technology', '2019-11-12 15:39:14'),
(2, 'Gaming', '2019-11-12 15:39:14'),
(3, 'Auto', '2019-11-12 15:39:14'),
(4, 'Entertainment', '2019-11-12 15:39:14'),
(5, 'Books', '2019-11-12 15:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `empdocuments`
--

CREATE TABLE `empdocuments` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `docname` varchar(255) NOT NULL,
  `eid` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `empdocuments`
--

INSERT INTO `empdocuments` (`id`, `image`, `docname`, `eid`, `modified`, `created`) VALUES
(10, '60079986efb87.jpeg', 'dsfdsfdsf', 16, '2021-01-20 08:38:25', '2021-01-20 08:38:25'),
(11, '60081641d1854.jpeg', 'fghfhfgh', 17, '2021-01-20 17:08:42', '2021-01-20 17:08:42'),
(12, '60081641da44b.jpeg', 'fghfghfgh', 17, '2021-01-20 17:08:42', '2021-01-20 17:08:42'),
(13, '60086489b5113.jpeg', 'gjhgjhgj', 18, '2021-01-20 22:42:41', '2021-01-20 22:42:41'),
(18, '60086ba5eb316.jpeg', 'hjkhkjhk df gdfggs', 21, '2021-01-20 23:15:50', '2021-01-20 23:15:50'),
(19, '60086ba5edf65.jpeg', 'uuuunuiuiuiui', 21, '2021-01-20 23:15:50', '2021-01-20 23:15:50'),
(20, '60086ba5f04ea.jpeg', 'kkjhjhkhkj', 21, '2021-01-20 23:15:50', '2021-01-20 23:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `eid` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `fname`, `lname`, `email`, `mobile`, `modified`, `created`) VALUES
(21, 'aamir', 'khan', 'khan@gmail.com', '87456456456', '2021-01-21 07:47:29', '2021-01-20 22:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `employeeaddress`
--

CREATE TABLE `employeeaddress` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employeeaddress`
--

INSERT INTO `employeeaddress` (`id`, `eid`, `city`, `state`, `address`, `created`, `modified`) VALUES
(21, 10, 'Bhopal', 'AR', 'sdf', '2021-01-19 00:20:44', '2021-01-19 00:20:44'),
(25, 9, 'Bhopal', 'AR', 'sdfhgfh gh gfh', '2021-01-19 10:02:52', '2021-01-19 10:02:52'),
(26, 9, 'Bhopal', 'AL', 'h gfhytrytry', '2021-01-19 10:02:52', '2021-01-19 10:02:52'),
(27, 11, 'Bhopal', 'AL', 'sdf', '2021-01-19 11:16:16', '2021-01-19 11:16:16'),
(29, 21, 'Bhopal', 'AR', 'sdf', '2021-01-21 07:47:29', '2021-01-21 07:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `author` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `body`, `author`, `created`, `modified`) VALUES
(1, 1, 'Technology Post One', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut interdum est nec lorem mattis interdum. Cras augue est, interdum eu consectetur et, faucibus vel turpis. Etiam pulvinar, enim quis elementum iaculis, tortor sapien eleifend eros, vitae rutrum augue quam sed leo. Vivamus fringilla, diam sit amet vestibulum vulputate, urna risus hendrerit arcu, vitae fringilla odio justo vulputate neque. Nulla a massa sed est vehicula rhoncus sit amet quis libero. Integer euismod est quis turpis hendrerit, in feugiat mauris laoreet. Vivamus nec laoreet neque. Cras condimentum aliquam nunc nec maximus. Cras facilisis eros quis leo euismod pharetra sed cursus orci.', 0, '2019-11-12 15:39:15', '0000-00-00 00:00:00'),
(2, 2, 'Gaming Post One', 'Adipiscing elit. Ut interdum est nec lorem mattis interdum. Cras augue est, interdum eu consectetur et, faucibus vel turpis. Etiam pulvinar, enim quis elementum iaculis, tortor sapien eleifend eros, vitae rutrum augue quam sed leo. Vivamus fringilla, diam sit amet vestibulum vulputate, urna risus hendrerit arcu, vitae fringilla odio justo vulputate neque. Nulla a massa sed est vehicula rhoncus sit amet quis libero. Integer euismod est quis turpis hendrerit, in feugiat mauris laoreet. Vivamus nec laoreet neque.', 0, '2019-11-12 15:39:15', '0000-00-00 00:00:00'),
(3, 1, 'Technology Post Two', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut interdum est nec lorem mattis interdum. Cras augue est, interdum eu consectetur et, faucibus vel turpis. Etiam pulvinar, enim quis elementum iaculis, tortor sapien eleifend eros, vitae rutrum augue quam sed leo. Vivamus fringilla, diam sit amet vestibulum vulputate, urna risus hendrerit arcu, vitae fringilla odio justo vulputate neque. Nulla a massa sed est vehicula rhoncus sit amet quis libero. Integer euismod est quis turpis hendrerit, in feugiat mauris laoreet. Vivamus nec laoreet neque. Cras condimentum aliquam nunc nec maximus. Cras facilisis eros quis leo euismod pharetra sed cursus orci.', 0, '2019-11-12 15:39:15', '0000-00-00 00:00:00'),
(4, 4, 'Entertainment Post One', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut interdum est nec lorem mattis interdum. Cras augue est, interdum eu consectetur et, faucibus vel turpis. Etiam pulvinar, enim quis elementum iaculis, tortor sapien eleifend eros, vitae rutrum augue quam sed leo. Vivamus fringilla, diam sit amet vestibulum vulputate, urna risus hendrerit arcu, vitae fringilla odio justo vulputate neque. Nulla a massa sed est vehicula rhoncus sit amet quis libero. Integer euismod est quis turpis hendrerit, in feugiat mauris laoreet. Vivamus nec laoreet neque. Cras condimentum aliquam nunc nec maximus. Cras facilisis eros quis leo euismod pharetra sed cursus orci.', 0, '2019-11-12 15:39:15', '0000-00-00 00:00:00'),
(5, 4, 'Entertainment Post Two', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut interdum est nec lorem mattis interdum. Cras augue est, interdum eu consectetur et, faucibus vel turpis. Etiam pulvinar, enim quis elementum iaculis, tortor sapien eleifend eros, vitae rutrum augue quam sed leo. Vivamus fringilla, diam sit amet vestibulum vulputate, urna risus hendrerit arcu, vitae fringilla odio justo vulputate neque. Nulla a massa sed est vehicula rhoncus sit amet quis libero. Integer euismod est quis turpis hendrerit, in feugiat mauris laoreet. Vivamus nec laoreet neque. Cras condimentum aliquam nunc nec maximus. Cras facilisis eros quis leo euismod pharetra sed cursus orci.', 0, '2019-11-12 15:39:15', '0000-00-00 00:00:00'),
(6, 1, 'Technology Post Three', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut interdum est nec lorem mattis interdum. Cras augue est, interdum eu consectetur et, faucibus vel turpis. Etiam pulvinar, enim quis elementum iaculis, tortor sapien eleifend eros, vitae rutrum augue quam sed leo. Vivamus fringilla, diam sit amet vestibulum vulputate, urna risus hendrerit arcu, vitae fringilla odio justo vulputate neque. Nulla a massa sed est vehicula rhoncus sit amet quis libero. Integer euismod est quis turpis hendrerit, in feugiat mauris laoreet. Vivamus nec laoreet neque. Cras condimentum aliquam nunc nec maximus. Cras facilisis eros quis leo euismod pharetra sed cursus orci.', 0, '2019-11-12 15:39:15', '0000-00-00 00:00:00'),
(7, 0, 'cv', 'cxv', 0, '2019-11-12 15:44:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `email`, `password`, `city`, `state`, `image`, `created`, `modified`) VALUES
(11, 'Productionserver', 'aamirkhan8878@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bhopal', 'Madhya Pradesh', '60065e98860dd.jpeg', '2021-01-19 09:52:48', '2021-01-19 09:52:48'),
(12, 'aamir', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bhopal', 'Madhya Pradesh', '60065f823520b.jpeg', '2021-01-19 09:56:42', '2021-01-19 09:56:42'),
(13, 'Productionserver22', 'aamir@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bhopal', 'Madhya Pradesh', '600660b994e84.jpeg', '2021-01-19 10:01:53', '2021-01-19 10:01:53'),
(14, 'aamir', 'aamirkhan8878@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bhopal', 'Madhya Pradesh', '60067660892af.jpeg', '2021-01-19 11:34:16', '2021-01-19 11:34:16'),
(15, 'aamir', 'aamirkhan8878@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bhopal', 'Madhya Pradesh', '6008e4172d700.jpeg', '2021-01-21 07:46:55', '2021-01-21 07:46:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empdocuments`
--
ALTER TABLE `empdocuments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `employeeaddress`
--
ALTER TABLE `employeeaddress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `empdocuments`
--
ALTER TABLE `empdocuments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `employeeaddress`
--
ALTER TABLE `employeeaddress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

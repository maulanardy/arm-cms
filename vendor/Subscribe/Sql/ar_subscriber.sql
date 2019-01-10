-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2018 at 08:48 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anakbangsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `ar_subscriber`
--

CREATE TABLE `ar_subscriber` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_subscribe` int(11) NOT NULL,
  `subscribe_date` datetime NOT NULL,
  `unsubscribe_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_subscriber`
--

INSERT INTO `ar_subscriber` (`id`, `email`, `is_subscribe`, `subscribe_date`, `unsubscribe_date`) VALUES
(1, 'arbomb.serv@gmail.com', 1, '2018-04-17 23:31:12', '2018-04-18 06:24:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ar_subscriber`
--
ALTER TABLE `ar_subscriber`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ar_subscriber`
--
ALTER TABLE `ar_subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

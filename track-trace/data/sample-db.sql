-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2020 at 12:24 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carga`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `sendername` varchar(30) NOT NULL,
  `recievername` varchar(30) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `expecteddate` text,
  `location` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `sendername`, `recievername`, `destination`, `expecteddate`, `location`, `date`) VALUES
(1, 'John Delta', 'Emily Sky', 'New York', '29th April 2019', 'Beijing, China', '2019-04-22 20:42:57'),
(2, 'ShiJin Hua', 'Mathew Doe', 'Srilanka', '3rd May 2019', 'Japan', '2019-04-22 20:43:58'),
(3, 'Riley Reymond', 'Nelson John', 'Durbin, South Africa', '17th May 2019', 'New York, USA', '2019-04-22 20:45:23'),
(4, 'Jackie Mick', 'Neloton Grey', 'Orlando, Florida', '25th May 2019', 'Beijing, China', '2019-04-23 16:10:40'),
(24, 'Neil Wagner', 'Ricardo Powell', 'Jamaica, West Indies', '23rd June 2019', 'Trent Bridge, New State', '2019-04-23 16:43:18'),
(25, 'Niel Doe', 'Nielson Jig', 'Durbin, South Africa', '17th May 2019', 'New York, USA', '2019-04-26 17:50:40'),
(26, 'Russel Jhon', 'Sultan Raffi', 'Orlando, Florida', '25th May 2019', 'Beijing, China', '2019-04-26 17:51:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

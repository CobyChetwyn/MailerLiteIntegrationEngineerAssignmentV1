-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 22, 2023 at 10:42 PM
-- Server version: 5.7.34
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MailerLite`
--

-- --------------------------------------------------------
CREATE DATABASE MailerLite;
USE MailerLite;

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `type` longtext,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `type`, `updated_at`, `created_at`, `value`) VALUES
(4, 'apiKey', '2023-04-22 11:25:05', '2023-04-22 00:21:57', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

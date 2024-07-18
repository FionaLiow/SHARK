-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 04:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;



-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS shark;

-- Use the newly created database
USE shark;

-- Rest of your SQL dump follows

--
-- Database: `shark`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(30) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `failed_login` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `address`, `profile_pic`, `last_login`, `failed_login`) VALUES
(1, 'Shark', 'shark@mail.com', '2baa370f69d24382c79ddc90d1002152', '123, seaweed road, coral reefs, 12345, sandy beach, underwater kingdom', '../Image/shark-welcome.jpg', '2024-07-09 21:39:53', 1),
(2, 'nemo', 'nemo@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '255, pink coral, coral reefs, 12345, sandy sea, underwater kingdom', '../Image/nemo.jpg', '2024-07-09 00:25:46', 0),
(3, 'SpongeBob', 'spongebob@bikinibottom.net', 'da053ed599684598f4428237f7fad018', '124 Conch Street, Bikini Bottom, Pacific Ocean', '../Image/spongebob.png', '2024-07-09 00:26:34', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

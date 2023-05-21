-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 08:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nostalgia`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `user_id` int(8) DEFAULT NULL,
  `post_id` int(8) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `comments` varchar(180) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(8) NOT NULL,
  `user_id` int(8) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `content` varchar(180) DEFAULT NULL,
  `image` mediumblob DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `username`, `content`, `image`) VALUES
(9, 5, 'nostalgia', 'Hello there, hope this works correctly.', 0x6e6f7374616c676961202d20323032332e30342e3134202d2030382e34382e3431706d2e6a7067),
(8, 5, 'nostalgia', 'adada', 0x6e6f7374616c676961202d20323032332e30342e3134202d2030382e34382e3431706d2e6a7067),
(10, 6, 'msms', 'Hey nostalgia, how are you?', 0x6d736d73202d20323032332e30342e3130202d2030342e34322e3031706d2e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(8) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `profilePic` mediumblob DEFAULT NULL,
  `background` mediumblob DEFAULT NULL,
  `audio` blob DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `isAdmin`, `email`, `username`, `password`, `profilePic`, `background`, `audio`) VALUES
(5, NULL, 'mauro.sousa97@outlook.com', 'nostalgia', '$2y$10$/bDSMIRJKj.ELDKROvjKEOS8pv4eyylelGcUR4Dw1Xs86nDXabpY6', 0x6e6f7374616c676961202d20323032332e30342e3134202d2030382e34382e3431706d2e6a7067, 0x6e6f7374616c676961202d20323032332e30342e3134202d2030382e34392e3135706d2e706e67, 0x6e6f7374616c676961202d20323032332e30342e3134202d2030382e34392e3036706d2e6d7033),
(6, NULL, 'msousafcp8@gmail.com', 'msms', '$2y$10$/nuf9T.qgkwKP3P.0G0obeKLpqJeMD9L.JmnNB7xqeMIgESCqyTW2', 0x6d736d73202d20323032332e30342e3136202d2030392e32322e3232706d2e6a7067, 0x6d736d73202d20323032332e30342e3130202d2030352e30342e3336706d2e6a7067, 0x6d736d73202d20323032332e30342e3130202d2030352e33352e3331706d2e6d7033);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

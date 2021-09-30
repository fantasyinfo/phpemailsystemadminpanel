-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 30, 2021 at 02:37 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gmailsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `messege`
--

CREATE TABLE `messege` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `messege` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_status` int(11) NOT NULL,
  `to_status` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messege`
--

INSERT INTO `messege` (`id`, `user_id`, `messege`, `from_id`, `to_id`, `from_status`, `to_status`, `status`, `created_on`) VALUES
(1, 1, 'Hi, Bro', 2, 1, 1, 1, 1, '2021-09-28 10:22:02'),
(2, 3, 'hello', 3, 1, 1, 1, 1, '2021-09-28 10:36:47'),
(3, 3, 'bollo', 3, 1, 1, 1, 1, '2021-09-28 10:36:47'),
(4, 3, 'Hello admin kay kar rahe ho yar', 3, 2, 1, 1, 1, '2021-09-30 05:53:10'),
(5, 3, 'HI, Bro How are you', 3, 2, 1, 1, 1, '2021-09-30 05:58:01'),
(6, 4, 'Hello Admin Kya Kar Rahe Ho yar', 4, 3, 1, 1, 1, '2021-09-30 14:18:21'),
(7, 4, 'Hello Admin Kya Kar Rahe Ho yar', 4, 3, 1, 1, 1, '2021-09-30 14:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email_id`, `password`, `status`, `created_on`) VALUES
(1, 'joker', 'joker@gmail.com', 'e55318040a854ebdc8d0508d2522bee5', 1, '2021-09-28 03:58:56'),
(2, 'admin', 'abc@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2021-09-28 04:00:14'),
(3, 'admin1', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, '2021-09-28 04:23:59'),
(4, 'Shelly', 'gs27349gs@gmail.com', 'f7ba507db5b5b1150eabf5707f0334dd', 1, '2021-09-30 12:56:56'),
(5, 'Papp', 'papa@gmail.com', 'bc7339e35ab33789ade87cdefb9e157f', 0, '2021-09-30 13:01:57'),
(6, 'Annu', 'ramji27349@gmail.com', 'ae3274d5bfa170ca69bb534be5a22467', 1, '2021-09-30 13:04:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messege`
--
ALTER TABLE `messege`
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
-- AUTO_INCREMENT for table `messege`
--
ALTER TABLE `messege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

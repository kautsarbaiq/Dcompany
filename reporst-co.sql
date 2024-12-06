-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2024 at 02:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reporst-co`
--

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `title`, `slug`, `content`, `thumbnail`, `status`, `user_id`, `created_at`) VALUES
(1, 'afas', '', '&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;asfas&amp;lt;/strong&amp;gt;&amp;lt;/p&amp;gt;', '', 0, 6, '2024-11-03 14:26:18'),
(2, 'l l. h ', '', '&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;asfas&amp;lt;/strong&amp;gt;&amp;lt;/p&amp;gt;', '', 0, 6, '2024-11-03 14:26:18'),
(3, 'a;scnsdckxzn ', '', 'TESSSSSTSTSTTSTSTTSTSTTSTSTTSTTTSTSTSTS', '', 0, 9, '2024-11-03 14:26:18'),
(4, 'zxz', 'zxz', 'czxcz', '67345a8db2491.png', 0, 9, '2024-11-13 07:51:41'),
(5, 'asdaf', 'asdaf', 'afafafa', '673480602fe29.png', 0, 9, '2024-11-13 10:33:04'),
(6, 'ascas', 'ascas', '&amp;lt;p&amp;gt;sdcascSC&amp;lt;/p&amp;gt;', '6743e32c79618.png', 0, 9, '2024-11-25 02:38:36'),
(7, 'look at my code', 'look-at-my-code', '&amp;lt;p&amp;gt;Can u see ma code what is in it?&amp;lt;/p&amp;gt;', '6743f0359b367.png', 0, 13, '2024-11-25 03:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'superadmin'),
(2, 'petugas'),
(3, 'masyarakat');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nik`, `name`, `phone_number`, `password`, `role_id`) VALUES
(6, 'superadmin', '111111', 'Super admin', '111111', '$2y$10$S6/qf3TPYCUgEtzRt4AT/.G0hT9oC9YhPNyT.mKNOw2cIkdsE3YSy', 1),
(8, 'petugas', '222222', 'Petugas', '222222', '$2y$10$6w6UfBZ4Y.idavfLe.OxIuT5ke1AWv4EWrirkbo8t6wCdYi1gf8oW', 1),
(9, 'bduls', '3333333', 'Abdullah', '622155048986', '$2y$10$h/hGGuwO07wg7YrBBqL.JutfITNND.GNZBq49x6rP9qls/fFhcaUy', 1),
(13, 'lala', '28137', 'lala', 'waedkvn l', '$2y$10$C63LOAX1rKmLmMHKfy//F.zLjCJnIauvcyz4PJjInyKts/FQUGFWS', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

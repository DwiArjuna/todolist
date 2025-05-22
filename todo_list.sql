-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2025 at 01:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_pas`
--

-- --------------------------------------------------------

--
-- Table structure for table `todo_list`
--

CREATE TABLE `todo_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` enum('pending','completed','','') DEFAULT 'pending',
  `deadline` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todo_list`
--

INSERT INTO `todo_list` (`id`, `user_id`, `title`, `status`, `deadline`, `created_at`) VALUES
(2, 4, 'hahaah', 'completed', '2025-05-18', '2025-05-18 14:29:34'),
(3, 4, 'bingun dengan pilihan ', 'pending', '2025-05-20', '2025-05-18 14:29:51'),
(5, 1, '.kn', 'pending', '2025-05-20', '2025-05-19 23:38:14'),
(6, 1, 'qdfwfwfawfefwefwfefeffwfweff', 'pending', '2025-05-16', '2025-05-19 23:45:14'),
(8, 6, 'lllllllllllllllllllllll', 'pending', '2025-05-19', '2025-05-20 00:49:50'),
(10, 6, 'kg.gkkkkkkkkkkkkkklkkkkkkkkkkkkkkklkkk.kbjb.bkjbkkkkkkkkkkkkkkkkkkkkk', 'completed', '2025-05-21', '2025-05-20 00:50:22'),
(11, 6, 'kjb', 'pending', '2025-05-08', '2025-05-20 03:16:52'),
(12, 6, 'lknk', 'pending', '2025-05-20', '2025-05-20 03:46:09'),
(13, 6, 'kkkk', 'pending', '2025-05-21', '2025-05-20 09:45:25'),
(14, 6, 'kkjj', 'pending', '2025-05-19', '2025-05-20 09:45:30'),
(15, 6, 'klok', 'completed', '2025-05-24', '2025-05-20 09:45:42'),
(16, 6, 'saya ', 'pending', '2025-05-19', '2025-05-20 10:21:54'),
(17, 6, 'sa', 'pending', '2025-05-19', '2025-05-20 10:36:47'),
(18, 6, 'entah sampai mana', 'pending', '2025-05-20', '2025-05-20 10:58:05'),
(19, 1, 'csss', 'completed', '2025-05-21', '2025-05-21 11:49:07'),
(20, 2, 'fine', 'pending', '2025-05-21', '2025-05-21 23:32:53'),
(21, 2, 'jfk,', 'pending', '2025-05-22', '2025-05-21 23:36:00'),
(23, 7, 'mandi', 'pending', '2025-05-23', '2025-05-21 23:43:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todo_list`
--
ALTER TABLE `todo_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todo_list`
--
ALTER TABLE `todo_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

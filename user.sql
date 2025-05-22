-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2025 at 01:47 AM
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `username`, `profile_picture`) VALUES
(1, 'vz@vz.com', '$2y$10$QTVRBlL1UoWyQzI7mZvF5.m7RX.sQ6JFf5zmxrDSK8IMJTMvnhaga', 'Kadek Dwi', '682aebb7ea6d3.png'),
(2, 'halo@halo.com', '$2y$10$7TKl6ViJkX7N0otgBNdikuDLUKkygknk5ogfI7fT2fN4b9KMP3b5q', 'pkpk', '6829cebf3b8c3.png'),
(3, 'fire@fire.com', '$2y$10$XLw0gD5kctw.gVrPrEUb4uLINC5BW/f83nyJYWZnpn19uVYJkumLm', 'Arjun', '6829d32f15a53.png'),
(4, 'sunu@sunu.com', '$2y$10$TvywwDM3LleQZ8cVgWU1deV1nqObhRh4MAcwYwQokUObr0XyzxOE.', 'fewewfwefw', '6829e172d3f7e.png'),
(5, 'p@p.com', '$2y$10$8jCXPKWEXsF4XFB3VMjEtOEZNJRMgLYb8wnxSM.TBxey6dS7RILsK', NULL, 'default.png'),
(6, 't@t.com', '$2y$10$39dpeWiTxTxc0E4zuczHl.bsW/V5fLFlqQAzOp14tU7n7WBq6uPQS', '', '682c5fa6976b0.png'),
(7, 'test@gmail.com', '$2y$10$l20vpZr3q33Xx4/nlZi8KuPvhPWjts9lxBVemoIMGgziAPkSdt4vu', 'test123', '682e65524d404.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

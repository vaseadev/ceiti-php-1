-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2022 at 11:03 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `site-colegiu`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(36) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `login_protection` text NOT NULL,
  `last_ip` varchar(50) NOT NULL,
  `last_login` int(11) NOT NULL,
  `created_ip` varchar(50) NOT NULL,
  `created_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `email`, `password`, `admin`, `login_protection`, `last_ip`, `last_login`, `created_ip`, `created_date`) VALUES
(1, 'Vartic Vasile', 'vartic2003@gmail.com', '$2y$10$vPVGRrGtIS2jRgJru3sFmubqOb6vH7SosQlZV4d.29qf.gbwjny5u', 1, '', '::1', 1670101814, '::1', 1669918220);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `service_id`, `amount`) VALUES
(5, 1, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `image`, `edited_by`, `edited_at`, `created_by`, `created_at`) VALUES
(1, 'Sănătate', 'https://i.imgur.com/HQ2D0DT.jpg', 0, 0, 1, 1670176312),
(2, 'Înfrumusețare', 'https://i.imgur.com/mNYVL08.jpg', 0, 0, 1, 1670176312),
(3, 'Altele', 'https://i.imgur.com/eXUdx3M.jpg', 0, 0, 1, 1670176312),
(4, 'Sănătate', 'https://i.imgur.com/HQ2D0DT.jpg', 0, 0, 1, 1670176360),
(5, 'Înfrumusețare', 'https://i.imgur.com/mNYVL08.jpg', 0, 0, 1, 1670176360),
(6, 'Altele', 'https://i.imgur.com/eXUdx3M.jpg', 0, 0, 1, 1670176360);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `unix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `message`, `unix`) VALUES
(6, 1, 'errerere', 1670178978),
(7, 1, 'asdada', 1670179065);

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answers` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `question`, `answers`, `status`, `created_by`, `created_at`) VALUES
(2, '', '[\"Nu stiu, tu?\",\"Pai habar nu am\"]', 0, 1, 1670180483),
(3, 'Cmf?', '[\"Habar nu am bro, tu?\",\"Eu stau bro\"]', 0, 1, 1670180502);

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `unix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `poll_id`, `user_id`, `answer`, `unix`) VALUES
(4, 3, 1, 'Eu stau bro', 1670185224),
(5, 3, 1, 'Eu stau brobla bla', 1670185224),
(6, 3, 1, 'Eu stau brobla bla', 1670185224);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `review` text NOT NULL,
  `unix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `service_id`, `stars`, `review`, `unix`) VALUES
(3, 1, 3, 3, 'pai 3 stele e ok', 1670103687),
(4, 1, 4, 2, 'asdqsad', 1670174796);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_at` int(11) NOT NULL,
  `selled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category_id`, `title`, `price`, `image`, `description`, `created_by`, `created_at`, `edited_by`, `edited_at`, `selled`) VALUES
(1, 3, 'Prevenirea trombofeblitei', 300, 'https://i.imgur.com/zunvmCF.jpg', 'none #1', 1, 1670176312, 0, 0, 0),
(2, 2, 'Reducerea obezitatii', 400, 'https://i.imgur.com/d2Hxi1L.jpg', 'none #2', 1, 1670176312, 0, 0, 0),
(3, 2, 'Prevenirea varicelorrrrrrrrr', 10000000000000, 'https://i.imgur.com/ssnu3Pq.png', 'none #333333333333', 1, 1670176312, 1, 1670178284, 0),
(4, 3, 'Masaj terapeutic', 350, 'https://i.imgur.com/b5c7zNK.jpg', 'none #4', 1, 1670176312, 0, 0, 0),
(5, 1, 'Detoxifierea totală a organismului', 300, 'https://i.imgur.com/bGpsc1K.jpg', 'none #5', 1, 1670176312, 0, 0, 0),
(6, 3, 'Accelerarea procesului de cicatrizare', 250, 'https://i.imgur.com/MEwpSJy.jpg', 'none #6', 1, 1670176312, 0, 0, 0),
(7, 1, 'Creșterea activității sistemului imunitar', 700, 'https://i.imgur.com/0b6PVLC.jpg', 'none #7', 1, 1670176312, 0, 0, 0),
(8, 1, 'Reducerea celulitei', 300, 'https://i.imgur.com/WfftW0N.jpg', 'none #8', 1, 1670176312, 0, 0, 0),
(9, 3, 'Prevenirea trombofeblitei', 300, 'https://i.imgur.com/zunvmCF.jpg', 'none #1', 1, 1670176360, 0, 0, 0),
(10, 2, 'Reducerea obezitatii', 400, 'https://i.imgur.com/d2Hxi1L.jpg', 'none #2', 1, 1670176360, 0, 0, 0),
(11, 2, 'Prevenirea varicelor', 100, 'https://i.imgur.com/xEt8TiT.jpg', 'none #3', 1, 1670176360, 0, 0, 0),
(12, 3, 'Masaj terapeutic', 350, 'https://i.imgur.com/b5c7zNK.jpg', 'none #4', 1, 1670176360, 0, 0, 0),
(13, 1, 'Detoxifierea totală a organismului', 300, 'https://i.imgur.com/bGpsc1K.jpg', 'none #5', 1, 1670176360, 0, 0, 0),
(14, 3, 'Accelerarea procesului de cicatrizare', 250, 'https://i.imgur.com/MEwpSJy.jpg', 'none #6', 1, 1670176360, 0, 0, 0),
(15, 1, 'Creșterea activității sistemului imunitar', 700, 'https://i.imgur.com/0b6PVLC.jpg', 'none #7', 1, 1670176360, 0, 0, 0),
(17, 0, 'abecedar', 6969, '123', 'descriere boss', 1, 1670177145, 0, 0, 0),
(18, 2, 'asd', 123, '123', 'dasdada', 1, 1670177181, 0, 0, 0),
(19, 2, 'asda', 1213, '123', 'asdada', 1, 1670177204, 0, 0, 0),
(20, 2, 'asda', 1213, '123', 'asdada', 1, 1670177219, 0, 0, 0),
(21, 1, 'asdad', 1231230, 'https://i.imgur.com/9ooWTIU.png', 'asddsada', 1, 1670177544, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `service_id`) VALUES
(4, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

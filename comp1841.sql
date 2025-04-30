-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 09:33 AM
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
-- Database: `comp1841`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`) VALUES
(37, 36, 9, 'Nice question ! Please wait for other helps.'),
(38, 35, 9, 'Nice question ! Please wait for other helps.'),
(40, 26, 9, 'Please check your due date and submisstion please !'),
(41, 26, 2, 'ok admin!'),
(43, 26, 25, 'thanks for the reminder <3'),
(44, 18, 25, 'i think you should watch youtube for longer remember hihi'),
(45, 36, 2, 'It is totally works !');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `created_at`) VALUES
(1, 'Web Development', '2025-04-14 07:46:50'),
(2, 'Data Structures', '2025-04-14 07:46:50'),
(4, 'Database Systems', '2025-04-14 07:46:50'),
(5, 'Computer Networks', '2025-04-14 07:46:50'),
(13, 'NOTIFICATIONS', '2025-04-27 11:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `user_id`, `module_id`, `image`, `created_at`) VALUES
(18, 'How to create a many-to-many relationship in My SQL database?', 'I\'m trying to connect my post table to modules but I\'m not sure how to implement the relationship', 22, 1, '6810beb94328b.png', '2025-04-26 14:17:23'),
(26, 'NOTIFICATION', 'Submit your coursework please !!', 9, 13, '6810be2b3d8dd.jpg', '2025-04-27 10:56:37'),
(35, 'How to implement form validation using HTML5 ?', 'I need to validate user input on my contact form and ensure all fields are properly filled.', 25, 1, '680f857e3213a.png', '2025-04-28 13:41:18'),
(36, 'Issues with image uploading in PHP', 'I\'m trying to implement the image upload feature for my posts but keep getting permissions errors', 2, 1, '680f85f5e10d6.png', '2025-04-28 13:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `role`) VALUES
(2, 'USER1', 'user1@example.com', '$2y$10$Sc3HJ6Etwe.CEYR13oC4AubiM5XpIHdC.CI/P0LDv.v2hjBjq8e8G', '2025-04-14 07:46:50', 'user'),
(9, 'iamadmin', 'nguyenhkgcs230231@fpt.edu.vn', '$2y$10$gWFc/r20GpFH1quLAjO76Oq/h9tq3P/x9gtBvMDWQTLy0B8NpHE4K', '2025-04-26 06:17:57', 'admin'),
(22, 'USER2', 'user2@example.com', '$2y$10$P18TGUNs.v8Jbcr4fo12XuHuN/2ymru5YgsZz/GmEaLzWnXYRHiW6', '2025-04-27 10:00:06', 'user'),
(23, 'USER3', 'user3@example.com', '$2y$10$uC4ygSRig2WAxL8Pmz9iWemOCRLloNdkpUehzIegmrl4zctTeB0l2', '2025-04-27 10:00:49', 'user'),
(24, 'USER4', 'user4@example.com', '$2y$10$1iWDe/SJsx4Q17ulyg2zcuzXvvrJ4SZ9gn1hUdINaUxIlRMknM9La', '2025-04-27 10:53:39', 'user'),
(25, 'USER5', 'user5@example.com', '$2y$10$rDSBDvst/ifod3G27HRWj.p0sn8w1vyCIsP8Ondv/jZCp0cdvs5ey', '2025-04-27 11:17:05', 'user'),
(31, 'USER6', 'user6@example.com', '$2y$10$GzvYSFaXaKxAJcFQs7ZeXuLwBhk0K13hB56oh7s3DxCAiVB4hBI3m', '2025-04-28 10:23:39', 'user'),
(33, 'asd', 'emailken098@gmail.com', '$2y$10$SjiRxBlENG2hqLv0u1l5MeJrDDlRx51BTH5au.DmuoX47zQGu/eFi', '2025-04-29 13:19:21', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_post` (`post_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

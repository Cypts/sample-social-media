-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 01:25 PM
-- Server version: 9.1.0
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `friend_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`) VALUES
(7, 7, 10),
(8, 10, 7),
(9, 8, 15),
(10, 15, 8),
(13, 10, 11),
(14, 11, 10),
(15, 10, 13),
(16, 13, 10),
(17, 12, 14),
(18, 14, 12),
(19, 12, 15),
(20, 15, 12),
(21, 14, 7),
(22, 7, 14),
(33, 9, 6),
(34, 6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int NOT NULL,
  `from_user_id` int NOT NULL,
  `to_user_id` int NOT NULL,
  `status` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `from_user_id`, `to_user_id`, `status`) VALUES
(2, 6, 9, 1),
(4, 8, 9, 1),
(7, 12, 9, 1),
(8, 13, 9, 1),
(10, 12, 9, 1),
(11, 9, 13, 0),
(12, 9, 14, 0),
(13, 13, 9, 1),
(47, 9, 6, 1),
(50, 9, 6, 1),
(51, 6, 9, 1),
(52, 6, 9, 1),
(53, 6, 9, 1),
(55, 6, 9, 1),
(56, 6, 9, 1),
(57, 9, 6, 1),
(58, 9, 6, 1),
(59, 6, 9, 1),
(60, 6, 7, 0),
(64, 9, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `from_id` int DEFAULT NULL,
  `to_id` int DEFAULT NULL,
  `message` text,
  `m_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_id`, `to_id`, `message`, `m_time`) VALUES
(1, 6, 7, 'Hey! How are you?', '2025-05-15 08:53:47'),
(2, 7, 8, 'Just checking in.', '2025-06-02 03:42:30'),
(3, 8, 9, 'Let’s catch up soon.', '2025-04-20 13:15:22'),
(4, 9, 10, 'Hope you’re doing great!', '2025-05-10 17:03:11'),
(5, 10, 11, 'Got any weekend plans?', '2025-06-05 01:50:45'),
(6, 11, 12, 'Just wrapped up a coding project!', '2025-03-25 10:40:05'),
(7, 12, 13, 'Thinking about diving into SQL.', '2025-06-10 06:25:35'),
(8, 13, 6, 'That sounds exciting!', '2025-02-14 02:35:50'),
(9, 6, 8, 'What’s your favorite programming language?', '2025-05-29 14:44:10'),
(10, 7, 9, 'Did you read the latest tech news?', '2025-04-03 08:10:57'),
(11, 8, 10, 'Let’s collaborate on something cool!', '2025-06-08 11:03:42'),
(12, 9, 11, 'Any recommendations for learning JavaScript?', '2025-01-19 04:52:48'),
(13, 10, 12, 'Struggling with an SQL query, any tips?', '2025-05-07 16:20:31'),
(14, 11, 13, 'Trying out a new AI project today!', '2025-03-12 11:55:06'),
(15, 12, 6, 'That sounds interesting! Tell me more.', '2025-06-09 04:15:20'),
(16, 6, 9, 'What’s your go-to coding editor?', '2025-04-14 09:03:19'),
(17, 7, 10, 'Let’s brainstorm ideas for a new app.', '2025-06-01 13:25:22'),
(18, 8, 11, 'Thinking about switching to Linux.', '2025-02-20 10:12:37'),
(19, 9, 12, 'Good morning! Hope you have a great day.', '2025-06-06 02:35:11'),
(20, 10, 13, 'Do you prefer Python or Java?', '2025-05-26 16:49:53'),
(21, 11, 6, 'Just finished a book on algorithms!', '2025-06-04 14:20:15'),
(22, 12, 7, 'Started working on a machine learning model.', '2025-03-09 06:10:28'),
(23, 13, 8, 'What’s your next big coding challenge?', '2025-05-31 10:47:33'),
(24, 6, 10, 'Let’s build something together.', '2025-04-01 06:58:41'),
(25, 7, 11, 'AI is advancing so fast!', '2025-06-07 04:25:44'),
(26, 8, 12, 'Debugging can be frustrating.', '2025-02-15 16:05:58'),
(27, 9, 13, 'Data structures are crucial for performance.', '2025-05-18 11:53:50'),
(28, 10, 6, 'Reading up on cybersecurity.', '2025-06-03 09:12:30'),
(29, 11, 7, 'What do you think of cloud computing?', '2025-04-11 02:49:05'),
(30, 12, 8, 'Been experimenting with Python lately.', '2025-03-30 16:44:19'),
(31, 13, 9, 'Machine learning is fascinating.', '2025-06-06 05:03:40'),
(32, 6, 11, 'Ever tried functional programming?', '2025-05-23 13:19:10'),
(33, 7, 12, 'I need to optimize my database queries.', '2025-06-09 09:55:35'),
(34, 8, 13, 'Ever built a chatbot before?', '2025-04-07 05:35:25'),
(35, 9, 6, 'That new framework looks interesting.', '2025-06-02 14:42:15'),
(36, 10, 7, 'Time management in coding is key.', '2025-05-11 04:07:08'),
(37, 11, 8, 'Cloud storage vs local—what’s better?', '2025-02-28 11:20:25'),
(38, 12, 9, 'Studying deep learning these days.', '2025-06-10 03:15:33'),
(39, 13, 10, 'How do you approach debugging?', '2025-04-22 07:00:27'),
(40, 6, 12, 'Let’s join a hackathon.', '2025-06-01 16:45:10'),
(41, 7, 13, 'How do you keep up with new tech trends?', '2025-05-24 09:05:48'),
(42, 8, 6, 'GraphQL or REST API—what’s better?', '2025-06-08 12:18:22'),
(43, 9, 7, 'Do you prefer frontend or backend?', '2025-03-31 03:58:30'),
(44, 10, 8, 'Learning React has been fun!', '2025-05-30 14:15:17'),
(45, 11, 9, 'Best resources for learning SQL?', '2025-06-06 06:25:43'),
(46, 12, 10, 'Security in web apps is crucial.', '2025-04-20 08:53:50'),
(47, 13, 11, 'Reading up on data science basics.', '2025-05-05 04:42:30'),
(48, 6, 13, 'Tips for writing clean code?', '2025-06-10 17:39:45'),
(49, 7, 6, 'Automating tasks saves a lot of time.', '2025-04-15 10:25:21'),
(50, 8, 7, 'Cybersecurity risks are increasing.', '2025-06-03 13:12:17'),
(51, 9, 8, 'Testing is just as important as coding.', '2025-05-25 07:00:33'),
(52, 10, 9, 'What AI tools do you use?', '2025-06-07 03:25:22'),
(53, 11, 10, 'Cloud computing vs edge computing?', '2025-04-10 16:00:44'),
(54, 12, 11, 'The future of coding looks exciting!', '2025-05-29 07:52:50'),
(55, 13, 12, 'Best way to structure large projects?', '2025-06-02 11:15:32'),
(56, 6, 9, 'New updates in AI are mind-blowing!', '2025-05-08 05:20:15'),
(57, 7, 10, 'Do you like working with databases?', '2025-06-05 08:50:10'),
(58, 8, 11, 'Frontend frameworks keep evolving.', '2025-04-06 03:17:55'),
(59, 9, 12, 'Debugging sessions are frustrating.', '2025-06-08 12:09:27'),
(60, 10, 13, 'How do you manage your time while coding?', '2025-03-23 04:25:38'),
(61, 11, 6, 'Just finished building an API!', '2025-06-10 05:42:07'),
(62, 12, 7, 'Got a new side project idea!', '2025-05-19 16:07:48'),
(63, 13, 8, 'Best coding habits for efficiency?', '2025-04-17 07:18:33'),
(64, 9, 6, 'hii', '2025-06-10 18:43:29'),
(65, 6, 9, 'hello', '2025-06-10 18:43:49'),
(66, 6, 8, 'nothing', '2025-06-10 18:53:25'),
(67, 6, 8, 'nothing', '2025-06-10 18:53:31'),
(68, 6, 8, 'nothing', '2025-06-10 18:53:33'),
(69, 6, 8, 'nothing', '2025-06-10 18:53:33'),
(70, 6, 8, 'nothing', '2025-06-10 18:53:34'),
(71, 6, 8, 'nothing', '2025-06-10 18:53:34'),
(72, 6, 8, 'nothing', '2025-06-10 18:53:34'),
(73, 6, 8, 'nothing', '2025-06-10 18:53:46'),
(74, 6, 8, 'nothing', '2025-06-10 18:55:01'),
(75, 6, 8, 'hoo', '2025-06-10 18:55:12'),
(76, 6, 8, 'gg', '2025-06-10 18:55:30'),
(77, 6, 8, 'gg', '2025-06-10 18:56:00'),
(78, 6, 8, 'h', '2025-06-10 18:56:03'),
(79, 6, 8, 'h', '2025-06-10 18:56:08'),
(80, 6, 8, 'hoo', '2025-06-10 18:58:12'),
(81, 9, 6, 'well done', '2025-06-10 18:58:38'),
(82, 6, 8, 'gg', '2025-06-10 18:59:11'),
(83, 6, 9, 'hiii ayush', '2025-06-10 19:56:42'),
(84, 9, 6, 'hii ravi', '2025-06-10 19:57:00'),
(85, 9, 7, 'adf', '2025-06-17 04:52:45'),
(86, 9, 7, 'asdf', '2025-06-17 04:52:48'),
(87, 9, 7, 'dsfas', '2025-06-17 04:53:17'),
(88, 9, 7, 'asdfasdf', '2025-06-17 04:53:20'),
(89, 9, 7, 'sretg', '2025-06-17 04:53:40'),
(90, 9, 7, 'fdsgsdg', '2025-06-17 04:56:18'),
(91, 9, 7, 'rtfgb', '2025-06-17 04:58:09'),
(92, 9, 7, 'rtfgb', '2025-06-17 04:58:42'),
(93, 9, 7, 'fdsgsdfg', '2025-06-17 04:58:48'),
(94, 9, 7, 'sdfgsdfgsfdgsdfgsdfgs', '2025-06-17 04:58:55'),
(95, 9, 7, '111111', '2025-06-17 04:58:59'),
(96, 9, 7, '111111', '2025-06-17 05:01:56'),
(97, 9, 7, '111111', '2025-06-17 05:03:10'),
(98, 9, 7, 'dfsgsfgsfdg', '2025-06-17 05:03:14'),
(99, 9, 7, 'fsdgsdf', '2025-06-17 05:03:17'),
(100, 9, 7, 'fsdg', '2025-06-17 05:03:20'),
(101, 9, 7, 'sfgsdfgsdfgsdf', '2025-06-17 05:05:47'),
(102, 6, 9, 'sdgadfgagfdag', '2025-06-17 05:06:14'),
(103, 9, 6, 'sfgfsd', '2025-06-17 05:06:21'),
(104, 6, 9, 'sdgadfgagfdag', '2025-06-17 05:06:28'),
(105, 9, 6, 'aaaa', '2025-06-17 05:06:37'),
(106, 6, 9, 'sdgadfgagfdag', '2025-06-17 05:06:44'),
(107, 6, 9, 'sfdg', '2025-06-17 05:09:14'),
(108, 6, 9, 'fdfffffffff', '2025-06-17 05:09:19'),
(109, 6, 9, 'fdfffffffff', '2025-06-17 05:09:22'),
(110, 6, 9, 'asdgafgafg', '2025-06-17 05:09:27'),
(111, 6, 9, 'asdgafgafg', '2025-06-17 05:13:23'),
(112, 6, 9, 'sfdgsdgsd', '2025-06-17 05:13:26'),
(113, 6, 9, 'gggg', '2025-06-17 05:13:29'),
(114, 6, 9, 'gggg', '2025-06-17 05:13:33'),
(115, 6, 9, 'gggg', '2025-06-17 05:13:58'),
(116, 6, 9, 'iko', '2025-06-17 05:14:04'),
(117, 6, 9, 'iko', '2025-06-17 05:14:08'),
(118, 6, 9, 'iko', '2025-06-17 05:15:08'),
(119, 6, 9, 'sasa', '2025-06-17 05:15:13'),
(120, 6, 9, 'sasa', '2025-06-17 05:15:18'),
(121, 6, 9, 'hii', '2025-06-20 09:48:06'),
(122, 6, 9, 'v', '2025-06-20 10:16:47'),
(123, 6, 9, 's', '2025-06-20 11:24:21'),
(124, 6, 9, 's', '2025-06-20 11:24:23'),
(125, 6, 9, 's', '2025-06-20 11:24:26'),
(126, 6, 9, 's', '2025-06-20 11:25:20'),
(127, 6, 9, 'dsfa', '2025-06-20 11:25:25'),
(128, 6, 9, 'dsfa', '2025-06-20 11:25:35'),
(129, 6, 9, 'd', '2025-06-20 11:25:38'),
(130, 6, 9, 'd', '2025-06-20 11:25:42'),
(131, 6, 9, 'd', '2025-06-20 11:26:06'),
(132, 6, 9, 'zxc', '2025-06-20 11:26:15'),
(133, 6, 9, 's', '2025-06-20 11:27:30'),
(134, 6, 9, 'aegadfgafgasdgadfg', '2025-06-20 11:27:36'),
(135, 6, 9, 'asdfasdfasdfas', '2025-06-20 11:27:40'),
(136, 6, 9, 'hii', '2025-06-22 16:30:50'),
(137, 9, 6, 'heello', '2025-06-22 16:30:58'),
(138, 6, 9, 'hii', '2025-06-22 16:31:04'),
(139, 9, 6, 'dsafadsfa', '2025-06-22 16:32:07'),
(140, 6, 9, 'hii', '2025-06-22 16:32:16'),
(141, 9, 6, 'hello', '2025-06-22 16:36:32'),
(142, 6, 9, 'what are you doing', '2025-06-22 16:36:48'),
(143, 6, 9, 'ADSFASDF', '2025-06-22 18:11:56'),
(144, 6, 9, 'ADSFASDF', '2025-06-22 18:12:03'),
(145, 6, 9, 'ADSFASDF', '2025-06-22 18:12:03'),
(146, 9, 6, 'FDSGSDFGS', '2025-06-22 18:12:18'),
(147, 9, 6, 'ASDFADSFASDFAS', '2025-06-22 18:13:23'),
(148, 6, 9, 'asdfadsf', '2025-06-22 18:18:45'),
(149, 6, 9, 'asdfadsfasdfasdfas', '2025-06-22 18:18:48'),
(150, 6, 9, 'asd', '2025-06-22 18:18:52'),
(151, 9, 6, 'asdfasdf', '2025-06-22 18:21:25'),
(152, 6, 9, 'asdfafasdf', '2025-06-22 18:21:37'),
(153, 6, 9, 'dfa', '2025-06-22 18:25:52'),
(154, 9, 6, 'asdfasdfasdfasdf', '2025-06-22 18:43:51'),
(155, 6, 9, 'heeelllee', '2025-06-22 18:44:11'),
(156, 9, 6, 'kkkkkkk', '2025-06-22 18:44:20'),
(157, 6, 9, 'zsdfg', '2025-06-22 18:47:31'),
(158, 9, 6, 'sdfasdfasdf', '2025-06-22 18:47:44'),
(159, 6, 9, 'hii what you doing', '2025-06-22 18:48:04'),
(160, 9, 6, 'joey tribiyani', '2025-06-22 18:48:25'),
(161, 9, 6, 'clear message', '2025-06-22 18:48:42'),
(162, 6, 9, 'why', '2025-06-22 18:48:49'),
(163, 9, 6, 'hello', '2025-06-22 18:49:29'),
(164, 6, 9, 'hii', '2025-06-22 18:49:36'),
(165, 6, 9, 'hii', '2025-06-22 18:50:48'),
(166, 9, 6, 'hello', '2025-06-23 04:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `post_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `content`, `image`, `post_time`) VALUES
(152, 13, 'This is a test post #830', NULL, '2025-06-22 10:30:44'),
(153, 11, 'This is a test post #933', NULL, '2025-06-12 12:11:36'),
(154, 11, 'This is a test post #263', NULL, '2025-06-15 21:02:12'),
(155, 7, 'This is a test post #906', NULL, '2025-06-21 01:19:24'),
(156, 15, 'This is a test post #420', NULL, '2025-06-20 07:43:43'),
(157, 13, 'This is a test post #115', NULL, '2025-06-18 14:37:43'),
(158, 9, 'This is a test post #932', NULL, '2025-06-17 03:27:48'),
(159, 11, 'This is a test post #468', NULL, '2025-06-15 14:35:40'),
(160, 12, 'This is a test post #341', NULL, '2025-06-13 06:59:27'),
(161, 6, 'This is a test post #657', NULL, '2025-06-19 21:17:23'),
(162, 8, 'This is a test post #380', NULL, '2025-06-19 19:48:53'),
(163, 6, 'This is a test post #657', NULL, '2025-06-22 00:11:19'),
(164, 9, 'This is a test post #347', NULL, '2025-06-13 01:28:44'),
(165, 6, 'This is a test post #10', NULL, '2025-06-13 21:44:07'),
(166, 13, 'This is a test post #456', NULL, '2025-06-22 01:10:02'),
(167, 14, 'This is a test post #279', NULL, '2025-06-14 03:02:43'),
(168, 14, 'This is a test post #2', NULL, '2025-06-17 00:09:37'),
(169, 10, 'This is a test post #677', NULL, '2025-06-21 11:06:51'),
(170, 10, 'This is a test post #91', NULL, '2025-06-22 10:38:46'),
(171, 14, 'This is a test post #15', NULL, '2025-06-15 06:46:24'),
(172, 7, 'This is a test post #765', NULL, '2025-06-17 18:03:07'),
(173, 14, 'This is a test post #819', NULL, '2025-06-15 04:26:18'),
(174, 13, 'This is a test post #888', NULL, '2025-06-20 21:30:39'),
(175, 6, 'This is a test post #990', NULL, '2025-06-14 17:05:49'),
(176, 10, 'This is a test post #224', NULL, '2025-06-13 22:35:09'),
(177, 6, 'This is a test post #184', NULL, '2025-06-15 00:51:40'),
(178, 13, 'This is a test post #698', NULL, '2025-06-19 06:41:16'),
(179, 9, 'This is a test post #918', NULL, '2025-06-16 15:23:21'),
(180, 14, 'This is a test post #631', NULL, '2025-06-15 03:57:04'),
(181, 9, 'This is a test post #741', NULL, '2025-06-14 13:05:28'),
(182, 8, 'This is a test post #271', NULL, '2025-06-16 10:53:01'),
(183, 14, 'This is a test post #696', NULL, '2025-06-12 04:51:15'),
(184, 10, 'This is a test post #400', NULL, '2025-06-14 02:32:20'),
(185, 10, 'This is a test post #225', NULL, '2025-06-14 23:13:56'),
(186, 12, 'This is a test post #213', NULL, '2025-06-20 23:25:27'),
(187, 6, 'This is a test post #974', NULL, '2025-06-15 08:57:15'),
(188, 8, 'This is a test post #205', NULL, '2025-06-18 08:23:35'),
(189, 8, 'This is a test post #89', NULL, '2025-06-14 05:44:51'),
(190, 9, 'This is a test post #633', NULL, '2025-06-21 17:15:12'),
(191, 10, 'This is a test post #258', NULL, '2025-06-13 10:55:50'),
(192, 7, 'This is a test post #588', NULL, '2025-06-18 11:46:17'),
(193, 6, 'This is a test post #74', NULL, '2025-06-19 09:46:09'),
(194, 7, 'This is a test post #44', NULL, '2025-06-14 15:45:24'),
(195, 9, 'This is a test post #524', NULL, '2025-06-14 23:03:06'),
(196, 13, 'This is a test post #744', NULL, '2025-06-17 01:52:17'),
(197, 7, 'This is a test post #413', NULL, '2025-06-16 05:35:39'),
(198, 11, 'This is a test post #984', NULL, '2025-06-18 18:50:26'),
(199, 13, 'This is a test post #573', NULL, '2025-06-14 06:29:26'),
(200, 14, 'This is a test post #314', NULL, '2025-06-12 10:37:18'),
(201, 10, 'This is a test post #675', NULL, '2025-06-11 06:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phoneNumber`, `password`) VALUES
(6, 'Ravi Kumar', 'ravik', 'ravi@example.com', '9876543210', 'RaviPass1'),
(7, 'Priya Sharma', 'priyas', 'priya@example.com', '9123456789', 'Priya123X'),
(8, 'Amit Verma', 'amitv', 'amit@example.com', '9012345678', 'AmitPower9'),
(9, 'ayush', 'ayush', 'ayush@gmail', '8271765332', 'Ayush1234'),
(10, 'Neha Reddy', 'nehar', 'neha.reddy@example.com', '9812345678', 'NehaPass1'),
(11, 'Suresh Mehta', 'sureshm', 'suresh.mehta@example.com', '9823456789', 'Suresh123X'),
(12, 'Anjali Singh', 'anjalisingh', 'anjali.singh@example.com', '9834567890', 'AnjaliX1'),
(13, 'Karan Patel', 'karanp', 'karan.patel@example.com', '9845678901', 'Karan123A'),
(14, 'Meena Joshi', 'meenaj', 'meena.joshi@example.com', '9856789012', 'MeenaPass2'),
(15, 'Rohit Das', 'rohitd', 'rohit.das@example.com', '9867890123', 'Rohit987B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD CONSTRAINT `friend_requests_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friend_requests_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

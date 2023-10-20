-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 03:48 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qb`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_cs`
--

CREATE TABLE `assign_cs` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_cs`
--

INSERT INTO `assign_cs` (`id`, `class_id`, `subject_id`, `teacher_id`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 9, 1, '2023-02-21 21:18:52', '2023-02-21 21:18:52'),
(3, 6, 2, 9, 1, '2023-02-21 21:28:15', '2023-02-21 22:38:10'),
(4, 10, 8, 16, 1, '2023-02-21 22:30:18', '2023-02-21 22:30:33'),
(5, 3, 3, 20, 1, '2023-02-21 22:32:39', '2023-02-21 22:32:39'),
(6, 4, 4, 19, 1, '2023-02-21 22:32:53', '2023-02-21 22:32:53'),
(7, 5, 7, 18, 1, '2023-02-21 22:33:12', '2023-02-21 22:33:12'),
(8, 6, 6, 17, 1, '2023-02-21 22:33:37', '2023-02-21 22:33:37'),
(9, 7, 5, 15, 1, '2023-02-21 22:33:52', '2023-02-21 22:33:52'),
(10, 8, 4, 14, 1, '2023-02-21 22:34:09', '2023-02-21 22:34:09'),
(11, 9, 4, 12, 1, '2023-02-21 22:34:37', '2023-02-21 22:34:37'),
(12, 10, 12, 10, 1, '2023-02-21 22:35:00', '2023-02-21 22:35:00'),
(13, 11, 10, 9, 1, '2023-02-21 22:35:22', '2023-02-21 22:35:22'),
(14, 11, 14, 2, 1, '2023-02-21 23:13:42', '2023-02-21 23:13:42'),
(15, 10, 9, 2, 1, '2023-02-21 23:13:59', '2023-02-21 23:13:59'),
(16, 9, 2, 2, 1, '2023-02-21 23:14:13', '2023-02-21 23:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `statement` varchar(255) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `statement`, `ordering`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(12, 'MCQS', 'encircle the correct option.', 1, 1, 2, '2023-02-21 23:41:55', '2023-02-21 23:41:55'),
(13, 'short question', 'Write short answer to the following Questions.', 2, 1, 2, '2023-02-22 00:50:56', '2023-02-22 00:50:56'),
(14, 'Long question', 'Write detailed answers to these Questions', 3, 1, 2, '2023-02-22 01:35:38', '2023-02-22 02:15:11'),
(15, 'diagram Questions', 'Lable the diagram', 4, 1, 2, '2023-02-22 02:15:52', '2023-02-22 02:15:52'),
(16, 'fill blanks', 'Fill in the blanks.', 5, 1, 2, '2023-02-22 02:25:06', '2023-02-22 02:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `assign_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `name`, `assign_id`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'problem Solving', 3, 1, 2, '2023-02-21 21:19:41', '2023-02-21 22:41:29'),
(3, 'Binary System', 3, 1, 17, '2023-02-21 21:28:51', '2023-02-21 22:39:17'),
(4, 'History of computer', 2, 1, 17, '2023-02-21 22:40:12', '2023-02-21 22:40:56'),
(5, 'computer memory', 2, 1, 17, '2023-02-21 22:40:40', '2023-02-21 22:40:40'),
(6, 'how computer work', 2, 1, 17, '2023-02-21 22:41:16', '2023-02-21 22:41:16'),
(7, 'introduction to multimedia', 2, 1, 17, '2023-02-21 22:41:56', '2023-02-21 22:41:56'),
(8, 'working with multimedia', 2, 1, 17, '2023-02-21 22:42:19', '2023-02-21 22:42:19'),
(9, 'communication online', 2, 1, 17, '2023-02-21 22:42:51', '2023-02-21 22:42:51'),
(10, 'Miroorganisms', 5, 1, 19, '2023-02-21 22:44:41', '2023-02-21 22:44:41'),
(11, 'flowers and seeds', 5, 1, 2, '2023-02-21 22:45:20', '2023-02-21 22:46:52'),
(12, 'Environmental pollution', 5, 1, 2, '2023-02-21 22:45:56', '2023-02-21 22:47:03'),
(13, 'Light and sound', 5, 1, 2, '2023-02-21 22:46:25', '2023-02-21 22:49:31'),
(14, 'Electricity and magnetism', 5, 1, 2, '2023-02-21 22:50:16', '2023-02-21 22:50:16'),
(15, 'Structure of earth', 5, 1, 2, '2023-02-21 22:51:03', '2023-02-21 22:51:03'),
(16, 'space and satellites', 5, 1, 2, '2023-02-21 22:51:47', '2023-02-21 22:51:47'),
(17, 'Lets be helpful', 6, 1, 2, '2023-02-21 22:53:00', '2023-02-21 22:53:00'),
(18, 'Be grateful', 6, 1, 2, '2023-02-21 22:53:25', '2023-02-21 22:53:25'),
(19, 'Eid-ul-Azha', 6, 1, 2, '2023-02-21 22:54:01', '2023-02-21 22:54:19'),
(20, 'our national animal', 6, 1, 2, '2023-02-21 22:56:23', '2023-02-21 22:56:23'),
(21, 'NFA', 4, 1, 10, '2023-02-21 23:10:54', '2023-02-21 23:10:54'),
(22, 'introduction to HTML', 12, 1, 12, '2023-02-21 23:11:50', '2023-02-21 23:11:50'),
(23, 'Control flow graph', 13, 1, 2, '2023-02-21 23:12:29', '2023-02-21 23:12:29'),
(24, 'politics', 7, 1, 2, '2023-02-21 23:12:58', '2023-02-21 23:12:58'),
(25, 'Quality Assurance basics', 15, 1, 2, '2023-02-21 23:15:18', '2023-02-21 23:15:18'),
(26, 'management', 14, 1, 2, '2023-02-21 23:15:39', '2023-02-21 23:15:39'),
(27, 'basics of computer', 3, 1, 2, '2023-02-22 00:47:11', '2023-02-22 00:47:11'),
(28, 'Introduction of loops', 3, 1, 2, '2023-02-22 00:47:39', '2023-02-22 00:47:39'),
(29, 'introduction of statements', 3, 1, 2, '2023-02-22 00:48:17', '2023-02-22 00:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(2, '5th', 1, 1, '2023-02-21 21:18:22', '2023-02-21 22:11:37'),
(3, '6th', 1, 1, '2023-02-21 21:27:52', '2023-02-21 22:11:54'),
(4, '7th', 1, 11, '2023-02-21 22:12:04', '2023-02-21 22:12:04'),
(5, '8th', 1, 11, '2023-02-21 22:12:12', '2023-02-21 22:12:12'),
(6, '9th', 1, 11, '2023-02-21 22:12:22', '2023-02-21 22:12:22'),
(7, '10th', 1, 11, '2023-02-21 22:12:31', '2023-02-21 22:12:31'),
(8, '1st year', 1, 11, '2023-02-21 22:12:40', '2023-02-21 22:12:40'),
(9, '2nd year', 1, 11, '2023-02-21 22:12:55', '2023-02-21 22:12:55'),
(10, '3rd year', 1, 11, '2023-02-21 22:29:01', '2023-02-21 22:29:01'),
(11, '4th year', 1, 11, '2023-02-21 22:29:14', '2023-02-21 22:29:14'),
(13, '1 class', 1, 11, '2023-02-21 22:47:42', '2023-02-21 22:47:42'),
(14, '2 class', 1, 11, '2023-02-21 22:47:53', '2023-02-21 22:47:53'),
(15, '3 class', 1, 11, '2023-02-21 22:48:04', '2023-02-21 22:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `id` int(11) NOT NULL,
  `assign_id` int(11) DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `total_time` varchar(255) DEFAULT NULL,
  `chapters` varchar(255) DEFAULT NULL,
  `categories` varchar(2000) DEFAULT NULL,
  `questions` varchar(5000) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `assign_id`, `total_marks`, `total_time`, `chapters`, `categories`, `questions`, `created_by`, `created_at`, `updated_at`) VALUES
(9, 3, 40, '60', 'problem Solving,Binary System,basics of computer,Introduction of loops,introduction of statements', '12,13,14,15,16', '9,14,12,8,10,11,16,15,13,7,17,20,19,21,18,22,23,24,29,25,26,27,28', 11, '2023-02-22 02:36:08', '2023-02-22 02:36:08'),
(10, 3, 40, '75', 'problem Solving,Binary System,basics of computer,Introduction of loops,introduction of statements', '12,13,14,15,16', '8,13,10,12,9,7,16,11,14,15,19,17,20,18,21,22,23,24,26,27,28,25,29', 11, '2023-02-22 02:44:12', '2023-02-22 02:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `assign_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `marks` varchar(10) DEFAULT NULL,
  `estimated_time` varchar(255) DEFAULT NULL,
  `statement` varchar(500) DEFAULT NULL,
  `is_options` tinyint(1) DEFAULT NULL,
  `opt1` varchar(255) DEFAULT NULL,
  `opt2` varchar(255) DEFAULT NULL,
  `opt3` varchar(255) DEFAULT NULL,
  `opt4` varchar(255) DEFAULT NULL,
  `image` varchar(5000) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `category_id`, `assign_id`, `chapter_id`, `topic_id`, `marks`, `estimated_time`, `statement`, `is_options`, `opt1`, `opt2`, `opt3`, `opt4`, `image`, `answer`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(7, 12, 3, 2, 2, '1', '1', ' In order to solve a problem , it is important to follow a .............. .', 1, 'systematic approach', ' direct approch', 'in direct approach', 'All of these', '', 'systematic approach', 1, 2, '2023-02-21 23:50:26', '2023-02-22 00:15:40'),
(8, 12, 3, 2, 2, '1', '1', 'Which one from the following is not a step to solve a problem systematically ?', 1, 'defining a problem', 'trace table', 'both', 'none', '', 'Trace table', 1, 2, '2023-02-21 23:54:08', '2023-02-22 00:10:23'),
(9, 12, 3, 2, 2, '1', '1', 'Which one from the following is not a step to solve a problem systematically ?', 1, 'understanding a problem', 'planning a solution', 'planning a solution', 'All of these', '', 'defining a problem', 1, 2, '2023-02-22 00:03:00', '2023-02-22 00:10:11'),
(10, 12, 3, 2, 2, '1', '1', 'A well-defined problem is the one that does not contain.', 1, 'error', 'ambiquites', 'validations ', 'none', '', 'ambiqutes', 1, 2, '2023-02-22 00:05:17', '2023-02-22 00:09:50'),
(11, 12, 3, 2, 2, '1', '1', 'If the problem is not defined well then which one strategy from the following programmer can use to define the problem.', 1, 'Gain background knowledge', 'Use guesses', 'Draw a picture', 'All of these', '', 'All of these', 1, 2, '2023-02-22 00:07:47', '2023-02-22 00:09:35'),
(12, 12, 3, 2, 2, '1', '1', 'Strategy in which designer defines the list of \" to-do \" task is.', 1, 'guess.check and improve', 'divide and conqure', 'act it out prototype', 'prototype', '', '', 1, 2, '2023-02-22 00:19:30', '2023-02-22 18:01:57'),
(13, 12, 3, 2, 2, '1', '1', 'Technique that draw a pictorial representation of the solution is that.', 1, 'devide and conqure', 'act these out', 'prototype', 'none of these', '', '', 1, 2, '2023-02-22 00:25:03', '2023-02-22 00:25:03'),
(14, 12, 3, 2, 2, '1', '1', 'It is quite important that one strategy may be more suitable to implement a solution than the.', 1, '3rd one', '4th one', '5th one', 'other one', '', '', 1, 2, '2023-02-22 00:26:38', '2023-02-22 00:26:38'),
(15, 12, 3, 2, 2, '1', '1', 'Last step of problem solving is that.', 1, 'defining a problem', 'planning a solution', 'problem analysis', 'understanding a problem', '', '', 1, 2, '2023-02-22 00:29:39', '2023-02-22 00:29:39'),
(16, 12, 3, 2, 2, '1', '1', 'From the available solutions the best solution of the problem is that has.', 1, 'Less number of steps', 'More effective', 'Both A and B', 'none', '', '', 1, 2, '2023-02-22 00:35:24', '2023-02-22 00:35:24'),
(17, 13, 3, 27, 16, '2', '5', 'what is hardware devices?', 0, '', '', '', '', '', '', 1, 2, '2023-02-22 00:52:02', '2023-02-22 00:59:55'),
(18, 13, 3, 29, 23, '2', '5', 'Define if else statement?', NULL, '', '', '', '', '', '', 1, 2, '2023-02-22 00:53:02', '2023-02-22 00:53:02'),
(19, 13, 3, 27, 20, '2', '5', 'Write the basic components of the computer?', NULL, '', '', '', '', '', '', 1, 2, '2023-02-22 00:53:47', '2023-02-22 00:53:47'),
(20, 13, 3, 3, 18, '2', '5', '\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nExplain the binary number with example?\r\n\r\n', NULL, '', '', '', '', '', '', 1, 2, '2023-02-22 00:55:37', '2023-02-22 00:55:37'),
(21, 13, 3, 28, 22, '2', '5', 'Define do while loop with example?', 0, '', '', '', '', '', '', 1, 2, '2023-02-22 00:56:43', '2023-02-22 00:57:42'),
(22, 14, 3, 29, 19, '5', '10', 'Explain the If and If else statement in detailed with Examples?', 0, '', '', '', '', '', '', 1, 2, '2023-02-22 01:38:09', '2023-02-22 01:54:28'),
(23, 14, 3, 28, 22, '5', '10', 'Explain the While and do-while with flowchart.', 0, '', '', '', '', '', '', 1, 2, '2023-02-22 01:40:13', '2023-02-22 01:54:47'),
(24, 15, 3, 27, 20, '5', '10', 'Lable the diagram.', 0, '', '', '', '', 'https://images.twinkl.co.uk/tw1n/image/private/t_630_eco/image_repo/87/89/au-di-3-input-and-output-devices_ver_1.jpg', '', 1, 2, '2023-02-22 01:43:14', '2023-02-22 02:17:36'),
(25, 16, 3, 27, 21, '1', '2', 'Taking information is called............', 0, '', '', '', '', '', '', 1, 2, '2023-02-22 02:26:07', '2023-02-22 02:28:27'),
(26, 16, 3, 27, 21, '1', '2', 'CPU stands for_____________', NULL, '', '', '', '', '', '', 1, 2, '2023-02-22 02:27:19', '2023-02-22 02:27:19'),
(27, 16, 3, 27, 20, '1', '2', '__________ are memory unit of the CPU.', NULL, '', '', '', '', '', '', 1, 2, '2023-02-22 02:29:35', '2023-02-22 02:29:35'),
(28, 16, 3, 28, 22, '1', '2', 'CPU is also known as the___________ of the computer.', NULL, '', '', '', '', '', '', 1, 2, '2023-02-22 02:31:04', '2023-02-22 02:31:04'),
(29, 16, 3, 2, 2, '1', '2', 'ASCII stands for___________.', NULL, '', '', '', '', '', '', 1, 2, '2023-02-22 02:33:31', '2023-02-22 02:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `tagline`, `created_at`, `updated_at`) VALUES
(1, 'AL-Khalid school of Excellence', 'A TRADITION OF EXCELLENCE', '2023-02-21 17:53:50', '2023-02-21 21:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'computer science', 1, 1, '2023-02-21 21:18:38', '2023-02-21 21:18:38'),
(3, 'Science', 1, 1, '2023-02-21 21:28:06', '2023-02-21 22:13:47'),
(4, 'English', 1, 11, '2023-02-21 22:14:03', '2023-02-21 22:14:03'),
(5, 'physics', 1, 11, '2023-02-21 22:25:21', '2023-02-21 22:25:21'),
(6, 'chemistry', 1, 11, '2023-02-21 22:25:35', '2023-02-21 22:25:35'),
(7, 's.st', 1, 11, '2023-02-21 22:25:54', '2023-02-21 22:25:54'),
(8, 'cs402', 1, 11, '2023-02-21 22:26:05', '2023-02-21 22:26:05'),
(9, 'cs611', 1, 11, '2023-02-21 22:26:15', '2023-02-21 22:26:15'),
(10, 'cs608', 1, 11, '2023-02-21 22:26:27', '2023-02-21 22:26:27'),
(11, 'cs615', 1, 11, '2023-02-21 22:26:36', '2023-02-21 22:26:36'),
(12, 'cs201', 1, 11, '2023-02-21 22:27:02', '2023-02-21 22:27:02'),
(13, 'mth201', 1, 11, '2023-02-21 22:27:18', '2023-02-21 22:27:18'),
(14, 'mgt301', 1, 11, '2023-02-21 22:27:34', '2023-02-21 22:27:34'),
(15, 'cs508', 1, 11, '2023-02-21 22:28:07', '2023-02-21 22:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `chapter_id`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'defining a problem', 2, 1, 9, '2023-02-21 21:21:27', '2023-02-21 21:21:27'),
(3, 'Decimal', 2, 1, 9, '2023-02-21 21:30:12', '2023-02-21 21:30:52'),
(4, 'Words meaning', 17, 1, 2, '2023-02-21 23:22:28', '2023-02-21 23:22:28'),
(5, 'festivals', 19, 1, 2, '2023-02-21 23:22:45', '2023-02-21 23:22:45'),
(6, 'Environmental thinking', 24, 1, 2, '2023-02-21 23:23:16', '2023-02-21 23:23:16'),
(7, 'domastic animals', 20, 1, 2, '2023-02-21 23:23:38', '2023-02-21 23:23:38'),
(8, 'strings', 21, 1, 2, '2023-02-21 23:24:32', '2023-02-21 23:24:32'),
(9, 'roots seeds', 11, 1, 2, '2023-02-21 23:25:07', '2023-02-21 23:25:07'),
(10, 'light traval in straight line', 13, 1, 2, '2023-02-21 23:25:59', '2023-02-21 23:25:59'),
(11, 'main group of miroorganisms', 10, 1, 2, '2023-02-21 23:27:40', '2023-02-21 23:27:40'),
(12, 'communication resources', 9, 1, 2, '2023-02-21 23:28:31', '2023-02-21 23:28:31'),
(13, 'introduction of computer', 4, 1, 2, '2023-02-21 23:29:03', '2023-02-21 23:29:03'),
(14, 'sources of multimedia', 7, 1, 2, '2023-02-21 23:29:35', '2023-02-21 23:29:35'),
(15, 'loops', 2, 1, 2, '2023-02-22 00:40:38', '2023-02-22 00:40:38'),
(16, 'input output devices', 2, 1, 2, '2023-02-22 00:40:49', '2023-02-22 00:40:49'),
(17, 'computer basics', 3, 1, 2, '2023-02-22 00:42:22', '2023-02-22 00:42:22'),
(18, 'number system', 3, 1, 2, '2023-02-22 00:43:43', '2023-02-22 00:43:43'),
(19, 'statement', 3, 1, 2, '2023-02-22 00:44:12', '2023-02-22 00:44:12'),
(20, 'hardware devices', 27, 1, 2, '2023-02-22 00:48:55', '2023-02-22 00:48:55'),
(21, 'software devices', 27, 1, 2, '2023-02-22 00:49:11', '2023-02-22 00:49:11'),
(22, 'loops', 28, 1, 2, '2023-02-22 00:49:28', '2023-02-22 00:49:28'),
(23, 'statement', 29, 1, 2, '2023-02-22 00:49:43', '2023-02-22 00:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `image` varchar(5000) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `is_role` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `image`, `is_active`, `is_role`, `created_at`, `updated_at`) VALUES
(1, 'sadia', 'Ramzan', 'sadia', 'sadia@gmail.com', 'aa5f9f65b56c061344c609e01f3f021e', 'avatars/avatar16769973091.png', 1, 0, '2022-11-16 17:18:42', '2023-02-21 21:35:09'),
(2, 'Teac', 'her', 'teacher', 'teacher@gmail.com', 'aa5f9f65b56c061344c609e01f3f021e', 'avatars/avatar1676744419b13ae9e6156f8ef03e73f106bab408ec.jpg', 1, 1, '2022-11-16 17:49:17', '2023-02-18 23:20:19'),
(9, 'Anabia', 'Nouman', 'Anabia', 'anabia@gmail.com', 'f5612a08178da398c6b273093558cf27', NULL, 1, 1, '2023-02-21 20:56:59', '2023-02-21 20:56:59'),
(10, 'Maheen', 'Ramzan', 'maheen', 'maheen@gmail.com', '070d3c649751b20af271301ec2b7761a', NULL, 1, 1, '2023-02-21 21:32:01', '2023-02-21 21:32:01'),
(11, 'sadia', 'Ramzan', 'sadia', 'sadia@gmail.com', '595c216f0efc43027c775d39076db354', NULL, 1, 0, '2023-02-21 21:33:28', '2023-02-21 21:33:28'),
(12, 'Hareem', 'faitma', 'hareem', 'hareem@gmail.com', '12f57ba348748e5593f23657a88190c8', NULL, 1, 1, '2023-02-21 21:48:06', '2023-02-21 21:48:06'),
(13, 'Laiba', 'Fatima', 'laiba', 'laiba@gmail.com', 'a7698767068a9f22be3dc796bafd223e', NULL, 1, 1, '2023-02-21 21:48:49', '2023-02-21 21:48:49'),
(14, 'Ayesha', 'Rizwan', 'ayesha', 'ayesha@gmail.com', '35d0ae71fe2ee678501cc19b015fe4db', NULL, 1, 1, '2023-02-21 21:50:07', '2023-02-21 21:50:07'),
(15, 'Hadia', 'Rizwan', 'hadia', 'hadia@gmail.com', '4b7dbdbb5a3b60a3eed81eec61818c42', NULL, 1, 1, '2023-02-21 21:50:42', '2023-02-21 21:50:42'),
(16, 'Minal', 'Fatima', 'minal', 'minal@gmail.com', '84f0df1b3bb451e62ba96989254d1134', NULL, 1, 1, '2023-02-21 21:53:11', '2023-02-21 21:53:11'),
(17, 'Nida', 'yaseen', 'nida', 'nida@gmail.com', '2d5f67e3192667a68853b495c37568e8', NULL, 1, 1, '2023-02-21 21:54:04', '2023-02-21 21:54:04'),
(18, 'Miss', 'Hira', 'hira', 'hira@gmail.com', 'ed073cb49db363e2da97078de83758f4', NULL, 1, 1, '2023-02-21 21:55:10', '2023-02-21 21:55:10'),
(19, 'sir', 'Ahmad', 'ahmad', 'ahmad@gmail.com', 'ecb1a22cc838e5ccae1d2b91fe0163f7', NULL, 1, 1, '2023-02-21 21:56:14', '2023-02-21 21:56:14'),
(20, 'sir', 'Rizwan', 'rizwan', 'rizwan@gmail.com', 'e799f3693348def0de1aabe44647d539', NULL, 1, 1, '2023-02-21 21:56:55', '2023-02-21 21:56:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_cs`
--
ALTER TABLE `assign_cs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
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
-- AUTO_INCREMENT for table `assign_cs`
--
ALTER TABLE `assign_cs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

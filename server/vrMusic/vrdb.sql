-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 05:58 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vrdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery_tbl`
--

CREATE TABLE `gallery_tbl` (
  `id` int(11) NOT NULL,
  `pic_id` varchar(500) NOT NULL,
  `pic_name` varchar(500) NOT NULL,
  `pic_link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log_tbl`
--

CREATE TABLE `log_tbl` (
  `id` int(11) NOT NULL,
  `log_date` varchar(500) NOT NULL,
  `log_detail` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_tbl`
--

INSERT INTO `log_tbl` (`id`, `log_date`, `log_detail`) VALUES
(1, '2022-03-15 06:02:57', 'admin updated admin account'),
(2, '2022-03-15 06:03:33', 'admin deleted an admin account'),
(3, '2022-03-15 06:05:25', 'admin updated a POI'),
(4, '2022-03-15 09:50:09', 'admin logged in'),
(5, '2022-03-15 09:55:00', 'admin updated a POI'),
(6, '2022-03-15 10:15:48', 'admin updated a POI'),
(7, '2022-03-15 13:16:16', 'admin logged in'),
(8, '2022-03-15 15:38:32', 'admin logged in'),
(9, '2022-03-15 15:39:25', 'admin logged in'),
(10, '2022-03-15 15:40:08', 'admin logged in'),
(11, '2022-03-15 15:40:48', 'admin logged in'),
(12, '2022-03-15 15:43:53', 'admin updated a POI'),
(13, '2022-03-15 15:44:08', 'admin updated an admin account'),
(14, '2022-03-26 18:58:44', 'admin logged in'),
(15, '2022-03-26 18:58:54', 'admin updated an admin account'),
(16, '2022-03-26 19:34:35', 'admin updated an admin account'),
(17, '2022-03-27 02:24:06', 'admin logged in'),
(18, '2022-03-27 02:27:49', 'admin created a POI'),
(19, '2022-03-27 02:35:13', 'admin updated a POI'),
(20, '2022-03-27 02:43:02', 'admin updated a POI'),
(21, '2022-03-27 02:53:58', 'admin updated an admin account'),
(22, '2022-03-27 18:37:24', 'admin logged in'),
(23, '2022-03-27 18:37:38', 'admin updated an admin account'),
(24, '2022-03-27 18:52:45', 'admin logged in'),
(25, '2022-03-28 20:29:15', 'admin logged in'),
(26, '2022-03-28 20:29:26', 'admin updated a POI'),
(27, '2022-03-28 21:33:19', 'admin logged in'),
(28, '2022-03-29 02:44:53', 'admin logged in'),
(29, '2022-03-30 19:45:13', 'admin logged in'),
(30, '2022-03-30 23:17:43', 'admin logged in'),
(31, '2022-03-31 07:30:48', 'admin logged in'),
(32, '2022-03-31 07:44:38', 'admin updated an admin account'),
(33, '2022-03-31 07:46:36', 'admin updated an admin account'),
(34, '2022-03-31 07:54:53', 'admin deleted a POI'),
(35, '2022-04-02 16:04:59', 'admin logged in'),
(36, '2022-04-02 17:17:42', 'admin updated a POI'),
(37, '2022-04-02 17:17:51', 'admin updated a POI'),
(38, '2022-04-02 17:19:09', 'admin created a POI'),
(39, '2022-04-02 20:52:29', 'admin logged in'),
(40, '2022-04-02 21:13:49', 'admin updated a POI'),
(41, '2022-04-02 21:16:51', 'admin updated a POI'),
(42, '2022-04-04 23:19:07', 'admin logged in'),
(43, '2022-04-04 23:19:41', 'admin updated a POI');

-- --------------------------------------------------------

--
-- Table structure for table `pic_tbl`
--

CREATE TABLE `pic_tbl` (
  `id` int(11) NOT NULL,
  `pic_menu_position` int(11) NOT NULL DEFAULT 0,
  `pic_name` varchar(500) NOT NULL,
  `pic_desc` varchar(1000) NOT NULL,
  `pic_link` varchar(500) NOT NULL,
  `pic_linkbg` varchar(500) NOT NULL,
  `pic_counter` int(11) NOT NULL DEFAULT 0,
  `pic_voicelink` varchar(500) NOT NULL,
  `pic_voicescript` varchar(3000) NOT NULL,
  `pic_map_x` varchar(500) NOT NULL DEFAULT '0',
  `pic_map_y` varchar(500) NOT NULL DEFAULT '0',
  `pic_gal1` varchar(500) NOT NULL,
  `pic_gal2` varchar(500) NOT NULL,
  `pic_gal3` varchar(500) NOT NULL,
  `pic_gal4` varchar(500) NOT NULL,
  `pic_gal5` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pic_tbl`
--

INSERT INTO `pic_tbl` (`id`, `pic_menu_position`, `pic_name`, `pic_desc`, `pic_link`, `pic_linkbg`, `pic_counter`, `pic_voicelink`, `pic_voicescript`, `pic_map_x`, `pic_map_y`, `pic_gal1`, `pic_gal2`, `pic_gal3`, `pic_gal4`, `pic_gal5`) VALUES
(1, 0, 'Entrance', '', 'entrance.png', 'entrance.jpg', 68, 'sample.mp3', 'Welcome to System Plus computer College- Caloocan. You\'re standing now on the Entrance, The Main Gate. Where all students, administrators, faculty, and staff enter through turnstiles \r\n\r\n \r\n\r\nLet me show you how you can explore our beautiful space in several ways. By using the \"Next\" button, you can continue to the next location. Now, if you already know where you want to go, you can select any location by using the side panel OR by clicking pins on the map. Lastly, remember that you can explore any particular location in more detail by clicking the supplemental icons. \r\n\r\n \r\n\r\nBefore we begin our journey, let me tell you a little bit about SPCC Caloocan. The System Plus Computer College-Caloocan is also one of the System Plus Computer Foundation Inc. (SPCFdivisions)\'s. \r\n\r\nThis campus was founded in 1997. It provided education at four (4) levels: pre-school, elementary, secondary, and colleges.  \r\n\r\n \r\n\r\nWe begin our journey now, at the Entrance, which is next to the Accounting Department. A turnstile is located here, and it is used to enter and exit the school. The school id represents your access to the school, and it is the only way to gain entry to the campus. \r\n\r\n \r\n\r\nTo enter, tap your ID on the turnstile, and to exit, repeat the process. Every time you tap, the database records the time in and time out, as well as your name, grade/course, and section. SPCC Caloocan ensures the safety of all students and employees in this manner. We invited you to visit The System Plus Computer College-Caloocan website to learn more. ', '622.5', '364', '619TSbyRNGL._AC_SY450_.jpg', '', '', '', ''),
(3, 0, 'HRM Cooking Laboratory', '', 'hrm-cook.jpg', 'entrance.jpg', 23, 'sample.mp3', '', '0', '0', '', '', '', '', ''),
(4, 0, 'HRM Hot Kitchen', 's', 'hrm-hot.jpg', 'entrance.jpg', 7, 'sample.mp3', '', '0', '0', '', '', '', '', ''),
(5, 0, 'HRM Restaurant Room', '', 'hrm-resto.jpg', 'entrance.jpg', 16, 'sample.mp3', '', '0', '0', '', '', '', '', ''),
(10, 5, 'Testing2', '', '1400397.jpg', '1400397.jpg', 5, 'no-image.jpg', '', '356.5', '469', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `setting_tbl`
--

CREATE TABLE `setting_tbl` (
  `initial_pic` varchar(500) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting_tbl`
--

INSERT INTO `setting_tbl` (`initial_pic`) VALUES
('1');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `user_uname` varchar(500) NOT NULL,
  `user_pword` varchar(500) NOT NULL,
  `user_fname` varchar(500) NOT NULL,
  `user_email` varchar(500) NOT NULL,
  `user_contact` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `user_uname`, `user_pword`, `user_fname`, `user_email`, `user_contact`) VALUES
(1, 'admin', 'admin', 'administratorsss', 'sdfsdfsssss@gmail.com', '234234'),
(5, 'tetetete', 'tetetet', 'tetete', 'etetete@gmail.com', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_tbl`
--

CREATE TABLE `visitor_tbl` (
  `id` int(11) NOT NULL,
  `visit_date` datetime NOT NULL,
  `visit_poi` varchar(500) NOT NULL,
  `visit_ip` varchar(500) NOT NULL,
  `visit_location_city` varchar(500) NOT NULL,
  `visit_location_region` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor_tbl`
--

INSERT INTO `visitor_tbl` (`id`, `visit_date`, `visit_poi`, `visit_ip`, `visit_location_city`, `visit_location_region`) VALUES
(21, '2022-03-15 04:10:50', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(22, '2022-03-15 04:10:53', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(23, '2022-03-15 04:10:55', '3', '223.25.63.59', 'Cavite', 'Calabarzon'),
(24, '2022-03-15 04:10:58', '4', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(25, '2022-03-15 04:11:03', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(26, '2022-03-15 04:11:05', '5', '223.25.63.59', 'Manila', 'Calabarzon'),
(27, '2022-03-15 04:11:06', '5', '223.24.63.59', 'Santa Rosa', 'Calabarzon'),
(28, '2022-03-15 04:17:03', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(29, '2022-03-15 04:17:04', '1', '223.25.63.59', 'Manila', 'Calabarzon'),
(30, '2022-03-15 04:50:12', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(31, '2022-03-15 04:53:50', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(32, '2022-03-15 04:55:40', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(33, '2022-03-15 05:09:53', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(34, '2022-03-15 05:11:32', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(35, '2022-03-15 09:40:01', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(36, '2022-03-15 09:58:27', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(37, '2022-03-15 10:13:28', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(38, '2022-03-15 10:23:46', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(39, '2022-03-15 10:30:03', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(40, '2022-03-15 10:30:31', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(41, '2022-04-26 19:40:13', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(42, '2022-04-26 20:43:14', '4', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(43, '2022-04-26 20:43:16', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(44, '2022-04-26 20:43:22', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(45, '2022-04-26 20:43:25', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(46, '2022-03-26 20:43:49', '4', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(47, '2022-03-26 20:43:51', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(48, '2022-03-26 20:43:56', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(49, '2022-03-26 20:43:58', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(50, '2022-03-26 20:43:59', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(51, '2022-03-26 20:44:00', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(52, '2022-03-26 20:44:04', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(53, '2022-03-26 20:44:29', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(54, '2022-03-26 20:45:55', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(55, '2022-03-26 21:04:01', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(56, '2022-03-26 21:04:39', '4', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(57, '2022-03-27 02:51:42', '1', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(58, '2022-03-27 02:51:45', '9', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(59, '2022-03-27 02:51:50', '1', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(60, '2022-03-27 03:20:27', '9', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(61, '2022-03-27 03:20:53', '4', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(62, '2022-03-27 03:22:21', '1', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(63, '2022-03-27 03:22:50', '1', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(64, '2022-03-27 03:22:52', '4', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(65, '2022-03-27 03:22:54', '9', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(66, '2022-03-27 03:27:39', '9', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(67, '2022-03-27 03:39:16', '9', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(68, '2022-03-27 03:40:08', '9', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(69, '2022-03-27 18:03:58', '1', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(70, '2022-03-27 18:08:54', '1', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(71, '2022-03-27 18:09:27', '1', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(72, '2022-03-27 18:11:29', '1', '136.158.28.26', 'Quezon City', 'Metro Manila'),
(73, '2022-03-28 21:00:53', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(74, '2022-03-30 23:54:00', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(75, '2022-03-31 00:00:07', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(76, '2022-03-31 00:00:35', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(77, '2022-03-31 00:01:04', '9', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(78, '2022-03-31 00:01:52', '5', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(79, '2022-03-31 00:03:13', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(80, '2022-03-31 00:04:29', '9', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(81, '2022-03-31 00:05:12', '9', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(82, '2022-03-31 00:06:59', '9', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(83, '2022-03-31 00:24:42', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(84, '2022-03-31 00:24:43', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(85, '2022-03-31 00:24:47', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(86, '2022-03-31 00:24:51', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(87, '2022-03-31 00:24:53', '4', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(88, '2022-03-31 00:25:19', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(89, '2022-03-31 00:25:29', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(90, '2022-04-02 19:03:53', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(91, '2022-04-02 19:04:15', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(92, '2022-04-02 20:49:40', '10', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(93, '2022-04-02 20:50:17', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(94, '2022-04-02 20:55:54', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(95, '2022-04-02 20:59:31', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(96, '2022-04-02 21:15:15', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(97, '2022-04-02 23:53:06', '10', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(98, '2022-04-02 23:53:46', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(99, '2022-04-02 23:53:49', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(100, '2022-04-03 00:13:49', '10', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(101, '2022-04-03 00:26:17', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(102, '2022-04-03 00:26:58', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(103, '2022-04-03 00:27:05', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(104, '2022-04-03 00:27:06', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(105, '2022-04-03 00:27:10', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(106, '2022-04-03 00:27:12', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(107, '2022-04-03 00:27:14', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(108, '2022-04-03 00:27:15', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(109, '2022-04-03 00:27:23', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(110, '2022-04-03 00:27:25', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(111, '2022-04-03 00:31:16', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(112, '2022-04-03 00:31:20', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(113, '2022-04-03 00:31:26', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(114, '2022-04-03 00:31:27', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(115, '2022-04-03 00:31:28', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(116, '2022-04-03 00:32:44', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(117, '2022-04-03 00:33:25', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(118, '2022-04-03 00:33:28', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(119, '2022-04-03 00:34:18', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(120, '2022-04-03 00:34:20', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(121, '2022-04-03 00:34:29', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(122, '2022-04-03 00:34:31', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(123, '2022-04-03 00:34:47', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(124, '2022-04-03 00:34:50', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(125, '2022-04-03 00:34:54', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(126, '2022-04-03 00:34:55', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(127, '2022-04-03 00:37:10', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(128, '2022-04-03 00:38:25', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(129, '2022-04-03 00:38:27', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(130, '2022-04-03 00:38:29', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(131, '2022-04-03 00:38:34', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(132, '2022-04-03 00:38:39', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(133, '2022-04-03 00:38:40', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(134, '2022-04-03 00:43:52', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(135, '2022-04-03 00:56:01', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(136, '2022-04-03 00:56:01', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(137, '2022-04-03 00:56:02', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(138, '2022-04-03 00:56:04', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(139, '2022-04-03 01:06:58', '10', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(140, '2022-04-03 01:11:50', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(141, '2022-04-03 01:13:36', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(142, '2022-04-03 01:13:38', '3', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(143, '2022-04-03 01:13:41', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(144, '2022-04-03 01:13:46', '1', '223.25.63.59', 'Santa Rosa', 'Calabarzon'),
(145, '2022-04-04 22:47:12', '10', '223.25.63.188', 'Santa Rosa', 'Calabarzon'),
(146, '2022-04-04 22:58:36', '1', '223.25.63.188', 'Santa Rosa', 'Calabarzon'),
(147, '2022-04-04 22:58:53', '1', '223.25.63.188', 'Santa Rosa', 'Calabarzon'),
(148, '2022-04-04 23:01:06', '1', '223.25.63.188', 'Santa Rosa', 'Calabarzon'),
(149, '2022-04-04 23:01:35', '1', '223.25.63.188', 'Santa Rosa', 'Calabarzon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery_tbl`
--
ALTER TABLE `gallery_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_tbl`
--
ALTER TABLE `log_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pic_tbl`
--
ALTER TABLE `pic_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_tbl`
--
ALTER TABLE `visitor_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery_tbl`
--
ALTER TABLE `gallery_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_tbl`
--
ALTER TABLE `log_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pic_tbl`
--
ALTER TABLE `pic_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitor_tbl`
--
ALTER TABLE `visitor_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

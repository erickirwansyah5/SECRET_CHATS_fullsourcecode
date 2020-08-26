-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 19, 2019 at 03:08 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id9134169_secret_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'administrator', 'cGFzc3dvcmQ=');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imgsrc` longtext COLLATE utf8mb4_bin DEFAULT NULL,
  `waktustamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL,
  `kunci` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `imgsrc`, `waktustamp`, `status`, `kunci`) VALUES
(2, 3, 7, 'lagi dimana bro?\n', NULL, '2019-06-19 07:32:02', 1, 0),
(45, 7, 2, '😝😝😝', NULL, '2019-07-19 08:58:39', 0, 0),
(6, 2, 7, 'odjl glkdwl px.\n', NULL, '2019-06-20 04:23:11', 0, 3),
(7, 7, 2, 'uln, slq dwp nx 200202,  qdqwl ndpx wudqvihu nh edqn bd. nlulp nh mdsul', NULL, '2019-06-20 04:26:45', 0, 3),
(9, 11, 7, 'cuy', NULL, '2019-06-20 07:03:20', 0, 0),
(10, 2, 7, 'test', NULL, '2019-06-20 14:54:38', 0, 0),
(11, 7, 2, 'test', NULL, '2019-06-20 14:54:47', 0, 0),
(12, 2, 7, 'cek', NULL, '2019-06-20 16:15:57', 0, 0),
(15, 2, 7, 'ini foto gue', 'https://firebasestorage.googleapis.com/v0/b/secretchat-33d70.appspot.com/o/private_pic%2FCapture.PNGKamis%2C%204%3A55%20PM?alt=media&token=f700fc11-49c7-4112-9590-a8c109279224', '2019-06-20 16:56:22', 0, 0),
(16, 2, 7, 'cek', NULL, '2019-06-20 16:58:05', 0, 0),
(17, 7, 2, 'cek', NULL, '2019-06-24 14:17:19', 0, 0),
(21, 2, 7, 'lo mau lihat screenshoot nya tuh.', 'https://firebasestorage.googleapis.com/v0/b/secretchat-33d70.appspot.com/o/private_pic%2FScreenshot_2019-06-24-12-57-55.pngSenin%2C%204%3A09%20PM?alt=media&token=aedef87a-5f2b-482c-8bb4-36a5fc40a61d', '2019-06-24 16:09:32', 0, 0),
(30, 11, 7, 'cuy', NULL, '2019-06-28 21:20:10', 0, 0),
(34, 11, 7, 'bjhjwp', NULL, '2019-07-02 21:41:51', 0, 9),
(35, 2, 7, 'phbnl, hpdlo jrrjoh vdbd hulfnluzdqvbdk@jpdlo.frp sdvvzrugqbd wuleodgh2002.', NULL, '2019-07-17 12:05:14', 0, 3),
(36, 30, 7, 'pengujian sniffing dengan wireshark', NULL, '2019-07-18 13:05:02', 1, 0),
(37, 2, 7, '😋😋', NULL, '2019-07-19 05:45:48', 0, 0),
(38, 2, 7, '😀😀😀😀😋😋', NULL, '2019-07-19 05:46:02', 0, 0),
(39, 30, 7, '😅😅😅', NULL, '2019-07-19 05:46:40', 1, 0),
(41, 2, 7, '😍😍', NULL, '2019-07-19 05:55:17', 0, 0),
(42, 2, 7, '😎😎😍😍', NULL, '2019-07-19 05:55:26', 0, 0),
(46, 2, 7, 'cek pesan', NULL, '2019-07-19 17:13:54', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` text DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `password`, `img`, `email`) VALUES
(2, 'Meyki Ardiansyah', 'cGFzc3dvcmQ=', 'https://firebasestorage.googleapis.com/v0/b/secretchat-33d70.appspot.com/o/private_pic%2F20160708_113342.jpgSenin%2C%203%3A04%20PM?alt=media&amp;token=f3560766-86af-4ca2-8f12-ae522b9627c4', 'Meykiardiansyah@gmail.com'),
(7, 'Erick Irwansyah', 'ODg4ODg4ODg=', 'https://firebasestorage.googleapis.com/v0/b/secretchat-33d70.appspot.com/o/private_pic%2FCapture.PNGSabtu%2C%2012%3A14%20PM?alt=media&amp;amp;token=f273c9e1-c245-4c38-94ed-892c24ec5e1c', 'Erickirwansyah5a@gmail.com'),
(10, 'Japriansyah', 'cGFzc3dvcmQ=', NULL, ''),
(11, 'Awaludin', 'cGFzc3dvcmQ=', 'https://firebasestorage.googleapis.com/v0/b/secretchat-33d70.appspot.com/o/private_pic%2Fpp2.PNGMinggu%2C%206%3A03%20AM?alt=media&amp;token=849c61c1-5081-416a-8c35-9b0fed116235', 'Ibnawaludin@gmail.com'),
(29, 'Jerry Sanjaya', 'cGFzc3dvcmQ=', NULL, 'Jerrysanjaya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(1, 7, '2019-05-24 14:43:36', 'no'),
(2, 2, '2019-05-24 14:30:22', 'no'),
(3, 2, '2019-05-24 14:39:14', 'no'),
(4, 2, '2019-05-24 15:55:03', 'no'),
(5, 7, '2019-05-25 15:41:44', 'no'),
(6, 7, '2019-05-26 14:06:29', 'no'),
(7, 7, '2019-05-27 10:37:34', 'no'),
(8, 7, '2019-05-28 05:10:54', 'no'),
(9, 7, '2019-05-28 17:49:05', 'no'),
(10, 7, '2019-05-29 09:58:44', 'no'),
(11, 7, '2019-06-01 14:27:07', 'no'),
(12, 7, '2019-06-01 22:58:40', 'no'),
(13, 11, '2019-06-01 23:07:53', 'no'),
(14, 2, '2019-06-02 15:17:03', 'no'),
(15, 7, '2019-06-03 15:02:58', 'no'),
(16, 7, '2019-06-11 09:49:48', 'no'),
(17, 7, '2019-06-11 10:41:04', 'no'),
(18, 2, '2019-06-11 10:46:25', 'no'),
(19, 7, '2019-06-11 22:44:56', 'no'),
(20, 28, '2019-06-11 23:32:41', 'no'),
(21, 7, '2019-06-15 16:46:04', 'no'),
(22, 28, '2019-06-15 16:57:36', 'no'),
(23, 11, '2019-06-16 06:42:29', 'no'),
(24, 7, '2019-06-16 08:26:29', 'no'),
(25, 7, '2019-06-16 08:28:04', 'no'),
(26, 7, '2019-06-16 09:28:38', 'no'),
(27, 7, '2019-06-19 08:18:54', 'no'),
(28, 2, '2019-06-19 08:30:49', 'no'),
(29, 7, '2019-06-19 08:39:11', 'no'),
(30, 7, '2019-06-20 04:17:04', 'no'),
(31, 7, '2019-06-20 04:46:08', 'no'),
(32, 2, '2019-06-20 04:28:12', 'no'),
(33, 2, '2019-06-20 04:29:20', 'no'),
(34, 2, '2019-06-20 04:37:43', 'no'),
(35, 2, '2019-06-20 06:15:01', 'no'),
(36, 7, '2019-06-20 06:25:12', 'no'),
(37, 7, '2019-06-20 06:30:33', 'no'),
(38, 2, '2019-06-20 06:33:06', 'no'),
(39, 7, '2019-06-20 14:04:54', 'no'),
(40, 2, '2019-06-20 14:02:20', 'no'),
(41, 7, '2019-06-20 14:28:13', 'no'),
(42, 2, '2019-06-20 15:05:36', 'no'),
(43, 7, '2019-06-20 16:37:47', 'no'),
(44, 29, '2019-06-20 16:17:27', 'no'),
(45, 2, '2019-06-20 16:20:09', 'no'),
(46, 2, '2019-06-20 17:00:39', 'no'),
(47, 7, '2019-06-20 17:02:03', 'no'),
(48, 7, '2019-06-22 16:37:48', 'no'),
(49, 7, '2019-06-24 13:00:46', 'no'),
(50, 7, '2019-06-24 15:34:04', 'no'),
(51, 2, '2019-06-24 15:40:21', 'no'),
(52, 7, '2019-06-24 16:16:22', 'no'),
(53, 7, '2019-06-24 16:23:27', 'no'),
(54, 7, '2019-06-24 17:08:43', 'no'),
(55, 7, '2019-06-24 21:41:14', 'no'),
(56, 7, '2019-06-27 11:12:49', 'no'),
(57, 7, '2019-06-27 12:13:28', 'no'),
(58, 7, '2019-06-28 21:20:54', 'no'),
(59, 7, '2019-06-29 17:01:14', 'no'),
(60, 2, '2019-06-30 14:44:29', 'no'),
(61, 7, '2019-06-30 11:44:12', 'no'),
(62, 7, '2019-07-02 21:42:13', 'no'),
(63, 7, '2019-07-01 11:31:33', 'no'),
(64, 7, '2019-07-02 22:18:47', 'no'),
(65, 7, '2019-07-03 17:41:49', 'no'),
(66, 7, '2019-07-10 11:22:40', 'no'),
(67, 7, '2019-07-16 14:00:22', 'no'),
(68, 7, '2019-07-16 15:01:03', 'no'),
(69, 7, '2019-07-16 19:56:51', 'no'),
(70, 7, '2019-07-16 21:21:08', 'no'),
(71, 7, '2019-07-16 22:05:05', 'no'),
(72, 7, '2019-07-17 12:06:31', 'no'),
(73, 7, '2019-07-17 14:16:06', 'no'),
(74, 7, '2019-07-18 13:19:06', 'no'),
(75, 7, '2019-07-19 08:21:00', 'no'),
(76, 7, '2019-07-19 16:14:45', 'no'),
(77, 2, '2019-07-19 08:59:00', 'no'),
(78, 2, '2019-07-19 09:01:44', 'no'),
(79, 7, '2019-07-19 17:14:15', 'no'),
(80, 2, '2019-07-19 17:16:22', 'no'),
(81, 11, '2019-07-19 22:00:11', 'no'),
(82, 29, '2019-07-19 13:39:08', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `profilepic_source`
--

CREATE TABLE `profilepic_source` (
  `img_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profilepic_source`
--

INSERT INTO `profilepic_source` (`img_id`, `user_id`, `img`) VALUES
(1, 2, ''),
(2, 7, 'https://firebasestorage.googleapis.com/v0/b/secretchat-33d70.appspot.com/o/private_pic%2FCapture.PNGMinggu%2C%205%3A35%20PM?alt=media&token=a08cddcd-d402-425e-9e76-790fb697dba3'),
(3, 3, ''),
(4, 10, ''),
(5, 11, 'https://firebasestorage.googleapis.com/v0/b/secretchat-33d70.appspot.com/o/private_pic%2Fpp2.PNGMinggu%2C%206%3A03%20AM?alt=media&token=849c61c1-5081-416a-8c35-9b0fed116235');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id_report` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ket` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `id_pelapor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id_report`, `id_user`, `username`, `ket`, `status`, `id_pelapor`) VALUES
(1, 10, 'Japriansyah', 'SPAM', 1, 11),
(2, 30, 'Reza Rahadian', 'SPAM', 0, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `profilepic_source`
--
ALTER TABLE `profilepic_source`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id_report`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `profilepic_source`
--
ALTER TABLE `profilepic_source`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

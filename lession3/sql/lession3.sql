-- --------------------------------------------------------
-- Host:                         172.16.100.3
-- Server version:               5.0.95-log - Source distribution
-- Server OS:                    redhat-linux-gnu
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table minh_nhut_lession_3.favorite
CREATE TABLE IF NOT EXISTS `favorite` (
  `id` int(10) NOT NULL auto_increment,
  `user_id` int(10) NOT NULL,
  `user_id_to` int(10) NOT NULL,
  `regist_datetime` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_favorite_user` (`user_id`),
  KEY `FK_favorite_user_to` (`user_id_to`),
  CONSTRAINT `FK_favorite_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_favorite_user_to` FOREIGN KEY (`user_id_to`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.favorite: ~13 rows (approximately)
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
INSERT INTO `favorite` (`id`, `user_id`, `user_id_to`, `regist_datetime`) VALUES
	(112, 1, 5, '2015-11-02 05:12:19'),
	(118, 5, 2, '2015-11-03 04:31:54'),
	(119, 8, 1, '2015-11-05 11:17:46'),
	(120, 5, 1, '2015-11-09 11:25:31'),
	(122, 6, 7, '2015-11-09 01:03:56'),
	(123, 6, 9, '2015-11-09 01:03:59'),
	(126, 1, 12, '2015-11-10 08:23:51'),
	(127, 12, 1, '2015-11-10 09:29:41'),
	(128, 13, 13, '2015-11-10 09:42:16'),
	(129, 13, 1, '2015-11-11 09:44:39'),
	(130, 13, 5, '2015-11-11 09:46:07'),
	(131, 13, 12, '2015-11-11 09:46:08'),
	(136, 12, 9, '2015-11-11 09:47:59');
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;


-- Dumping structure for table minh_nhut_lession_3.follow
CREATE TABLE IF NOT EXISTS `follow` (
  `id` int(10) NOT NULL auto_increment,
  `user_id` int(10) NOT NULL,
  `user_id_to` int(10) NOT NULL,
  `regist_datetime` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_follow_user` (`user_id`),
  KEY `FK_follow_user_to` (`user_id_to`),
  CONSTRAINT `FK_follow_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_follow_user_to` FOREIGN KEY (`user_id_to`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.follow: ~11 rows (approximately)
/*!40000 ALTER TABLE `follow` DISABLE KEYS */;
INSERT INTO `follow` (`id`, `user_id`, `user_id_to`, `regist_datetime`) VALUES
	(1, 1, 4, '2015-11-03 09:32:00'),
	(3, 7, 1, '2015-11-03 11:13:47'),
	(4, 8, 1, '2015-11-05 11:17:43'),
	(7, 1, 5, '2015-11-09 09:55:05'),
	(8, 5, 1, '2015-11-09 11:19:38'),
	(9, 6, 9, '2015-11-09 01:02:05'),
	(10, 6, 7, '2015-11-09 01:02:07'),
	(14, 1, 12, '2015-11-10 08:23:51'),
	(15, 12, 1, '2015-11-10 09:31:13'),
	(16, 13, 1, '2015-11-11 09:44:38'),
	(25, 12, 9, '2015-11-11 09:48:00');
/*!40000 ALTER TABLE `follow` ENABLE KEYS */;


-- Dumping structure for table minh_nhut_lession_3.follow_log
CREATE TABLE IF NOT EXISTS `follow_log` (
  `id` int(11) NOT NULL auto_increment,
  `follow_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `userid_to` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `regist_datetime` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_user_id_to_user` (`userid_to`),
  KEY `fk_follow_id` (`follow_id`),
  CONSTRAINT `fk_follow_id` FOREIGN KEY (`follow_id`) REFERENCES `follow` (`id`),
  CONSTRAINT `fk_user_id_to_user` FOREIGN KEY (`userid_to`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=660 DEFAULT CHARSET=utf8;

-- Dumping data for table minh_nhut_lession_3.follow_log: ~523 rows (approximately)
/*!40000 ALTER TABLE `follow_log` DISABLE KEYS */;
INSERT INTO `follow_log` (`id`, `follow_id`, `action`, `userid_to`, `status`, `regist_datetime`) VALUES
	(2, 3, ' Send request to ', 5, 1, '2015-11-03 11:12:48'),
	(4, 3, ' Send request to ', 3, 1, '2015-11-03 11:14:14'),
	(6, 3, ' Unrequest to ', 5, 1, '2015-11-03 11:12:48'),
	(8, 3, ' Like picture khoi-my-34562f444e8471d.jpg of 5', 5, 1, '2015-11-03 11:43:19'),
	(10, 3, ' Like picture son tung (1)562de6b646065.jpg of ', 3, 1, '2015-11-03 07:15:48'),
	(12, 3, ' unLike picture son tung (1)562de6b646065.jpg of ', 3, 1, '2015-11-03 07:18:25'),
	(16, 3, ' Friend of ', 2, 1, '2015-11-03 09:05:50'),
	(18, 3, ' NOT friend of ', 2, 1, '2015-11-03 09:14:17'),
	(20, 3, ' unLike picture "khoi-my-34562f444e8471d.jpg" of ', 5, 1, '2015-11-03 09:21:44'),
	(22, 3, ' Like picture "son tung (4)562de6b657065.jpg" of ', 3, 1, '2015-11-03 09:22:12'),
	(24, 3, ' unLike picture "son tung (4)562de6b657065.jpg" of ', 3, 1, '2015-11-03 09:22:52'),
	(25, 1, ' Friend of ', 8, 1, '2015-11-03 10:51:10'),
	(27, 3, ' Send request to ', 8, 1, '2015-11-03 12:04:44'),
	(29, 3, ' Friend of ', 6, 1, '2015-11-03 12:07:05'),
	(31, 3, ' NOT friend of ', 7, 1, '2015-11-03 12:11:32'),
	(33, 3, ' NOT friend of ', 8, 1, '2015-11-03 12:11:32'),
	(35, 3, ' NOT friend of ', 5, 1, '2015-11-03 12:11:32'),
	(37, 3, ' NOT friend of ', 6, 1, '2015-11-03 12:11:32'),
	(38, 1, ' NOT friend of ', 8, 1, '2015-11-03 12:11:32'),
	(40, 3, ' Like picture "20150926131009_wPpZsOz1Hd5629ba408ca07.jpg" of ', 1, 1, '2015-11-03 12:55:49'),
	(42, 3, ' unLike picture "20150926131009_wPpZsOz1Hd5629ba408ca07.jpg" of ', 1, 1, '2015-11-03 12:55:54'),
	(44, 3, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-03 12:55:57'),
	(45, 1, ' Send request to ', 8, 1, '2015-11-04 03:25:52'),
	(47, 3, ' Friend of ', 2, 1, '2015-11-04 05:24:16'),
	(49, 3, ' Friend of ', 5, 1, '2015-11-04 05:24:28'),
	(51, 3, ' Friend of ', 8, 1, '2015-11-04 05:24:37'),
	(53, 3, ' Friend of ', 3, 1, '2015-11-04 07:03:36'),
	(55, 3, ' Friend of ', 3, 1, '2015-11-04 07:05:06'),
	(57, 3, ' NOT friend of ', 8, 1, '2015-11-05 00:28:36'),
	(58, 1, ' Friend of ', 8, 1, '2015-11-05 06:12:51'),
	(59, 1, ' NOT friend of ', 8, 1, '2015-11-05 06:13:31'),
	(60, 1, ' Send request to ', 1, 1, '2015-11-05 06:45:33'),
	(61, 1, ' Friend of ', 1, 1, '2015-11-05 06:45:42'),
	(63, 3, ' Friend of ', 4, 1, '2015-11-05 06:45:42'),
	(65, 3, ' NOT friend of ', 5, 1, '2015-11-05 06:48:20'),
	(66, 4, ' NOT friend of ', 5, 1, '2015-11-05 06:48:20'),
	(68, 3, ' Like picture "son tung (9)562de6d0b22ea.jpg" of ', 3, 1, '2015-11-05 12:31:29'),
	(69, 4, ' Like picture "son tung (9)562de6d0b22ea.jpg" of ', 3, 0, '2015-11-05 12:31:29'),
	(70, 1, ' NOT friend of ', 1, 1, '2015-11-06 05:03:35'),
	(72, 3, ' NOT friend of ', 4, 1, '2015-11-06 05:03:35'),
	(73, 4, ' NOT friend of ', 4, 0, '2015-11-06 05:03:35'),
	(75, 3, ' Send request to ', 4, 1, '2015-11-06 05:05:17'),
	(76, 4, ' Send request to ', 4, 0, '2015-11-06 05:05:17'),
	(78, 3, ' Friend of ', 4, 1, '2015-11-06 05:05:25'),
	(79, 4, ' Friend of ', 4, 0, '2015-11-06 05:05:25'),
	(80, 1, ' Friend of ', 1, 1, '2015-11-06 05:05:25'),
	(84, 3, ' Like picture "20150610150935_v60K13tmTj5629b5388b34d.jpg" of ', 1, 1, '2015-11-06 07:19:04'),
	(85, 4, ' Like picture "20150610150935_v60K13tmTj5629b5388b34d.jpg" of ', 1, 0, '2015-11-06 07:19:04'),
	(90, 3, ' Friend of ', 5, 1, '2015-11-06 07:20:25'),
	(91, 4, ' Friend of ', 5, 0, '2015-11-06 07:20:25'),
	(103, 3, ' Like picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 1, '2015-11-09 03:55:40'),
	(104, 4, ' Like picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 0, '2015-11-09 03:55:40'),
	(106, 3, ' unLike picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 1, '2015-11-09 03:55:41'),
	(107, 4, ' unLike picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 0, '2015-11-09 03:55:41'),
	(109, 3, ' Like picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 1, '2015-11-09 03:58:03'),
	(110, 4, ' Like picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 0, '2015-11-09 03:58:03'),
	(112, 3, ' unLike picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 1, '2015-11-09 03:58:17'),
	(113, 4, ' unLike picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 0, '2015-11-09 03:58:17'),
	(115, 3, ' Like picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 1, '2015-11-09 03:58:21'),
	(116, 4, ' Like picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 0, '2015-11-09 03:58:21'),
	(118, 3, ' unLike picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 1, '2015-11-09 03:58:24'),
	(119, 4, ' unLike picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 0, '2015-11-09 03:58:24'),
	(121, 3, ' Like picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 1, '2015-11-09 03:58:36'),
	(122, 4, ' Like picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 0, '2015-11-09 03:58:36'),
	(124, 3, ' unLike picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 1, '2015-11-09 03:58:38'),
	(125, 4, ' unLike picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 0, '2015-11-09 03:58:38'),
	(127, 3, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:20:38'),
	(128, 4, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:20:38'),
	(130, 3, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:20:38'),
	(131, 4, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:20:38'),
	(133, 3, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:20:40'),
	(134, 4, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:20:40'),
	(136, 3, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:20:42'),
	(137, 4, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:20:42'),
	(139, 3, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:20:43'),
	(140, 4, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:20:43'),
	(142, 3, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:20:44'),
	(143, 4, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:20:44'),
	(145, 3, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:20:45'),
	(146, 4, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:20:45'),
	(148, 3, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:20:57'),
	(149, 4, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:20:57'),
	(151, 3, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:21:05'),
	(152, 4, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:21:05'),
	(154, 3, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:21:06'),
	(155, 4, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:21:06'),
	(157, 3, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:23:02'),
	(158, 4, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:23:02'),
	(160, 3, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:23:04'),
	(161, 4, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:23:04'),
	(163, 3, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:23:05'),
	(164, 4, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:23:05'),
	(166, 3, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:23:06'),
	(167, 4, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:23:06'),
	(169, 3, ' Like picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 1, '2015-11-09 04:23:28'),
	(170, 4, ' Like picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 0, '2015-11-09 04:23:28'),
	(172, 3, ' unLike picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 1, '2015-11-09 04:23:29'),
	(173, 4, ' unLike picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 0, '2015-11-09 04:23:29'),
	(175, 3, ' Like picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 1, '2015-11-09 04:23:35'),
	(176, 4, ' Like picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 0, '2015-11-09 04:23:35'),
	(178, 3, ' unLike picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 1, '2015-11-09 04:23:36'),
	(179, 4, ' unLike picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 0, '2015-11-09 04:23:36'),
	(181, 3, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-09 04:23:47'),
	(182, 4, ' unLike picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-09 04:23:47'),
	(185, 3, ' unLike picture "20150610150935_v60K13tmTj5629b5388b34d.jpg" of ', 1, 1, '2015-11-09 04:26:43'),
	(186, 4, ' unLike picture "20150610150935_v60K13tmTj5629b5388b34d.jpg" of ', 1, 0, '2015-11-09 04:26:43'),
	(188, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:45'),
	(189, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:45'),
	(191, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:46'),
	(192, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:46'),
	(194, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:48'),
	(195, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:48'),
	(197, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:48'),
	(198, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:48'),
	(200, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:48'),
	(201, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:48'),
	(203, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:48'),
	(204, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:48'),
	(206, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:48'),
	(207, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:48'),
	(209, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:49'),
	(210, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:49'),
	(212, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:49'),
	(213, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:49'),
	(215, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:49'),
	(216, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:49'),
	(218, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:49'),
	(219, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:49'),
	(221, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:49'),
	(222, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:49'),
	(224, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:49'),
	(225, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:49'),
	(227, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:50'),
	(228, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:50'),
	(230, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:50'),
	(231, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:50'),
	(233, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:50'),
	(234, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:50'),
	(236, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:51'),
	(237, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:51'),
	(239, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:52'),
	(240, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:52'),
	(242, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:55'),
	(243, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:55'),
	(245, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:26:56'),
	(246, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:26:56'),
	(248, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:06'),
	(249, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:06'),
	(251, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:07'),
	(252, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:07'),
	(254, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:08'),
	(255, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:08'),
	(257, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:08'),
	(258, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:08'),
	(260, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:08'),
	(261, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:08'),
	(263, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:08'),
	(264, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:08'),
	(266, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:09'),
	(267, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:09'),
	(269, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:09'),
	(270, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:09'),
	(272, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:09'),
	(273, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:09'),
	(275, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:09'),
	(276, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:09'),
	(278, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:09'),
	(279, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:09'),
	(281, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:09'),
	(282, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:09'),
	(284, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:10'),
	(285, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:10'),
	(287, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:10'),
	(288, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:10'),
	(290, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:10'),
	(291, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:10'),
	(293, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:10'),
	(294, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:10'),
	(296, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:10'),
	(297, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:10'),
	(299, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:10'),
	(300, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:10'),
	(302, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:11'),
	(303, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:11'),
	(305, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:11'),
	(306, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:11'),
	(308, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:12'),
	(309, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:12'),
	(311, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 1, '2015-11-09 04:27:12'),
	(312, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 04:27:12'),
	(314, 3, ' Like picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 1, '2015-11-09 04:27:29'),
	(315, 4, ' Like picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 0, '2015-11-09 04:27:29'),
	(317, 3, ' unLike picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 1, '2015-11-09 04:27:29'),
	(318, 4, ' unLike picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 0, '2015-11-09 04:27:29'),
	(320, 3, ' Like picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 1, '2015-11-09 04:28:01'),
	(321, 4, ' Like picture "hinh-khoi-my-13562f444e7c160.jpg" of ', 5, 0, '2015-11-09 04:28:01'),
	(323, 3, ' Like picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 1, '2015-11-09 04:28:02'),
	(324, 4, ' Like picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 0, '2015-11-09 04:28:02'),
	(326, 3, ' Like picture "hinh-khoi-my-15562f444e7ed28.jpg" of ', 5, 1, '2015-11-09 04:28:03'),
	(327, 4, ' Like picture "hinh-khoi-my-15562f444e7ed28.jpg" of ', 5, 0, '2015-11-09 04:28:03'),
	(329, 3, ' Like picture "hinh-khoi-my-17562f444e81836.jpg" of ', 5, 1, '2015-11-09 04:28:04'),
	(330, 4, ' Like picture "hinh-khoi-my-17562f444e81836.jpg" of ', 5, 0, '2015-11-09 04:28:04'),
	(332, 3, ' Like picture "khoi-my-34562f444e8471d.jpg" of ', 5, 1, '2015-11-09 04:28:05'),
	(333, 4, ' Like picture "khoi-my-34562f444e8471d.jpg" of ', 5, 0, '2015-11-09 04:28:05'),
	(335, 3, ' Like picture "khoi-my-33562f444e82fa5.jpg" of ', 5, 1, '2015-11-09 04:28:05'),
	(336, 4, ' Like picture "khoi-my-33562f444e82fa5.jpg" of ', 5, 0, '2015-11-09 04:28:05'),
	(338, 3, ' Send request to ', 6, 1, '2015-11-09 06:00:01'),
	(339, 4, ' Send request to ', 6, 0, '2015-11-09 06:00:01'),
	(341, 3, ' Send request to ', 8, 1, '2015-11-09 06:07:31'),
	(342, 4, ' Send request to ', 8, 0, '2015-11-09 06:07:31'),
	(344, 3, ' Send request to ', 6, 1, '2015-11-09 06:14:26'),
	(345, 4, ' Send request to ', 6, 0, '2015-11-09 06:14:26'),
	(347, 3, ' Send request to ', 6, 1, '2015-11-09 06:15:58'),
	(348, 4, ' Send request to ', 6, 0, '2015-11-09 06:15:58'),
	(350, 3, ' Send request to ', 6, 1, '2015-11-09 06:16:01'),
	(351, 4, ' Send request to ', 6, 0, '2015-11-09 06:16:01'),
	(353, 3, ' Send request to ', 6, 1, '2015-11-09 06:16:02'),
	(354, 4, ' Send request to ', 6, 0, '2015-11-09 06:16:02'),
	(356, 3, ' Send request to ', 6, 1, '2015-11-09 06:16:32'),
	(357, 4, ' Send request to ', 6, 0, '2015-11-09 06:16:32'),
	(359, 3, ' Send request to ', 6, 1, '2015-11-09 06:16:34'),
	(360, 4, ' Send request to ', 6, 0, '2015-11-09 06:16:34'),
	(362, 3, ' Send request to ', 6, 1, '2015-11-09 06:24:37'),
	(363, 4, ' Send request to ', 6, 0, '2015-11-09 06:24:37'),
	(365, 3, ' Send request to ', 6, 1, '2015-11-09 06:24:42'),
	(366, 4, ' Send request to ', 6, 0, '2015-11-09 06:24:42'),
	(368, 3, ' Send request to ', 6, 1, '2015-11-09 06:24:44'),
	(369, 4, ' Send request to ', 6, 0, '2015-11-09 06:24:44'),
	(371, 3, ' Send request to ', 6, 1, '2015-11-09 06:24:45'),
	(372, 4, ' Send request to ', 6, 0, '2015-11-09 06:24:45'),
	(374, 3, ' Send request to ', 6, 1, '2015-11-09 06:24:47'),
	(375, 4, ' Send request to ', 6, 0, '2015-11-09 06:24:47'),
	(377, 3, ' Send request to ', 6, 1, '2015-11-09 06:24:50'),
	(378, 4, ' Send request to ', 6, 0, '2015-11-09 06:24:50'),
	(380, 3, ' Send request to ', 6, 1, '2015-11-09 06:24:52'),
	(381, 4, ' Send request to ', 6, 0, '2015-11-09 06:24:52'),
	(383, 3, ' Send request to ', 6, 1, '2015-11-09 06:26:21'),
	(384, 4, ' Send request to ', 6, 0, '2015-11-09 06:26:21'),
	(386, 3, ' Send request to ', 6, 1, '2015-11-09 06:26:28'),
	(387, 4, ' Send request to ', 6, 0, '2015-11-09 06:26:28'),
	(389, 3, ' Send request to ', 6, 1, '2015-11-09 06:27:18'),
	(390, 4, ' Send request to ', 6, 0, '2015-11-09 06:27:18'),
	(392, 3, ' Send request to ', 6, 1, '2015-11-09 06:27:40'),
	(393, 4, ' Send request to ', 6, 0, '2015-11-09 06:27:40'),
	(395, 3, ' Send request to ', 6, 1, '2015-11-09 06:27:47'),
	(396, 4, ' Send request to ', 6, 0, '2015-11-09 06:27:47'),
	(398, 3, ' Send request to ', 6, 1, '2015-11-09 06:27:49'),
	(399, 4, ' Send request to ', 6, 0, '2015-11-09 06:27:49'),
	(401, 3, ' Send request to ', 6, 1, '2015-11-09 06:27:51'),
	(402, 4, ' Send request to ', 6, 0, '2015-11-09 06:27:51'),
	(404, 3, ' Send request to ', 6, 1, '2015-11-09 06:28:30'),
	(405, 4, ' Send request to ', 6, 0, '2015-11-09 06:28:30'),
	(407, 3, ' Send request to ', 6, 1, '2015-11-09 06:28:32'),
	(408, 4, ' Send request to ', 6, 0, '2015-11-09 06:28:32'),
	(410, 3, ' Send request to ', 6, 1, '2015-11-09 06:28:40'),
	(411, 4, ' Send request to ', 6, 0, '2015-11-09 06:28:40'),
	(413, 3, ' Send request to ', 6, 1, '2015-11-09 06:28:45'),
	(414, 4, ' Send request to ', 6, 0, '2015-11-09 06:28:45'),
	(416, 3, ' Send request to ', 6, 1, '2015-11-09 06:29:34'),
	(417, 4, ' Send request to ', 6, 0, '2015-11-09 06:29:34'),
	(419, 3, ' Send request to ', 6, 1, '2015-11-09 06:29:42'),
	(420, 4, ' Send request to ', 6, 0, '2015-11-09 06:29:42'),
	(422, 3, ' Send request to ', 6, 1, '2015-11-09 06:31:45'),
	(423, 4, ' Send request to ', 6, 0, '2015-11-09 06:31:45'),
	(425, 3, ' Send request to ', 6, 1, '2015-11-09 06:31:47'),
	(426, 4, ' Send request to ', 6, 0, '2015-11-09 06:31:47'),
	(428, 3, ' Send request to ', 6, 1, '2015-11-09 06:31:48'),
	(429, 4, ' Send request to ', 6, 0, '2015-11-09 06:31:48'),
	(431, 3, ' Send request to ', 6, 1, '2015-11-09 06:31:50'),
	(432, 4, ' Send request to ', 6, 0, '2015-11-09 06:31:50'),
	(433, 7, ' NOT friend of ', 1, 1, '2015-11-09 06:38:15'),
	(435, 3, ' NOT friend of ', 5, 1, '2015-11-09 06:38:15'),
	(436, 4, ' NOT friend of ', 5, 0, '2015-11-09 06:38:15'),
	(438, 3, ' Send request to ', 5, 1, '2015-11-09 06:40:37'),
	(439, 4, ' Send request to ', 5, 0, '2015-11-09 06:40:37'),
	(441, 3, ' Friend of ', 5, 1, '2015-11-09 06:40:42'),
	(442, 4, ' Friend of ', 5, 0, '2015-11-09 06:40:42'),
	(443, 7, ' Friend of ', 1, 1, '2015-11-09 06:40:42'),
	(445, 3, ' NOT friend of ', 5, 1, '2015-11-09 06:40:55'),
	(446, 4, ' NOT friend of ', 5, 0, '2015-11-09 06:40:55'),
	(447, 7, ' NOT friend of ', 1, 1, '2015-11-09 06:40:55'),
	(449, 3, ' Send request to ', 5, 1, '2015-11-09 06:40:57'),
	(450, 4, ' Send request to ', 5, 0, '2015-11-09 06:40:57'),
	(452, 3, ' Friend of ', 5, 1, '2015-11-09 06:41:01'),
	(453, 4, ' Friend of ', 5, 0, '2015-11-09 06:41:01'),
	(454, 7, ' Friend of ', 1, 1, '2015-11-09 06:41:01'),
	(456, 3, ' NOT friend of ', 5, 1, '2015-11-09 06:41:36'),
	(457, 4, ' NOT friend of ', 5, 0, '2015-11-09 06:41:36'),
	(458, 7, ' NOT friend of ', 1, 1, '2015-11-09 06:41:36'),
	(459, 3, ' Send request to ', 5, 1, '2015-11-09 06:50:14'),
	(460, 4, ' Send request to ', 5, 0, '2015-11-09 06:50:14'),
	(461, 8, ' Send request to ', 5, 0, '2015-11-09 06:50:14'),
	(462, 3, ' Send request to ', 5, 1, '2015-11-09 06:54:34'),
	(463, 4, ' Send request to ', 5, 0, '2015-11-09 06:54:34'),
	(464, 8, ' Send request to ', 5, 0, '2015-11-09 06:54:34'),
	(465, 3, ' Friend of ', 5, 1, '2015-11-09 06:54:40'),
	(466, 4, ' Friend of ', 5, 0, '2015-11-09 06:54:40'),
	(467, 8, ' Friend of ', 5, 0, '2015-11-09 06:54:40'),
	(468, 7, ' Friend of ', 1, 1, '2015-11-09 06:54:40'),
	(469, 7, ' Like picture "hinh-khoi-my-14562f444e7d5b1.jpg" of ', 5, 1, '2015-11-09 06:54:54'),
	(470, 7, ' Like picture "hinh-khoi-my-15562f444e7ed28.jpg" of ', 5, 1, '2015-11-09 06:54:55'),
	(471, 7, ' Like picture "khoi-my-34562f444e8471d.jpg" of ', 5, 1, '2015-11-09 06:54:57'),
	(472, 7, ' Like picture "khoi-my-33562f444e82fa5.jpg" of ', 5, 1, '2015-11-09 06:54:58'),
	(473, 7, ' Like picture "hinh-khoi-my-17562f444e81836.jpg" of ', 5, 1, '2015-11-09 06:54:59'),
	(474, 7, ' Send request to ', 6, 1, '2015-11-09 06:55:58'),
	(475, 7, ' Friend of ', 6, 1, '2015-11-09 06:56:16'),
	(476, 1, ' Friend of ', 7, 1, '2015-11-09 07:16:52'),
	(477, 1, ' Friend of ', 8, 1, '2015-11-09 07:21:26'),
	(478, 7, ' Friend of ', 8, 1, '2015-11-09 07:21:26'),
	(479, 3, ' Friend of ', 8, 1, '2015-11-09 07:21:26'),
	(480, 4, ' Friend of ', 8, 0, '2015-11-09 07:21:26'),
	(481, 8, ' Friend of ', 8, 0, '2015-11-09 07:21:26'),
	(482, 1, ' Friend of ', 8, 1, '2015-11-09 07:21:42'),
	(483, 7, ' Friend of ', 8, 1, '2015-11-09 07:21:42'),
	(484, 3, ' Friend of ', 8, 1, '2015-11-09 07:21:42'),
	(485, 4, ' Friend of ', 8, 0, '2015-11-09 07:21:42'),
	(486, 8, ' Friend of ', 8, 0, '2015-11-09 07:21:42'),
	(487, 1, ' Friend of ', 8, 1, '2015-11-09 07:22:00'),
	(488, 7, ' Friend of ', 8, 1, '2015-11-09 07:22:00'),
	(489, 3, ' Friend of ', 8, 1, '2015-11-09 07:22:00'),
	(490, 4, ' Friend of ', 8, 0, '2015-11-09 07:22:00'),
	(491, 8, ' Friend of ', 8, 0, '2015-11-09 07:22:00'),
	(492, 3, ' NOT friend of ', 8, 1, '2015-11-09 07:24:04'),
	(493, 4, ' NOT friend of ', 8, 0, '2015-11-09 07:24:04'),
	(494, 8, ' NOT friend of ', 8, 0, '2015-11-09 07:24:04'),
	(495, 3, ' NOT friend of ', 8, 1, '2015-11-09 07:24:04'),
	(496, 4, ' NOT friend of ', 8, 0, '2015-11-09 07:24:04'),
	(497, 8, ' NOT friend of ', 8, 0, '2015-11-09 07:24:04'),
	(498, 1, ' NOT friend of ', 8, 1, '2015-11-09 07:24:12'),
	(499, 1, ' NOT friend of ', 8, 1, '2015-11-09 07:24:12'),
	(500, 7, ' NOT friend of ', 8, 1, '2015-11-09 07:24:16'),
	(501, 7, ' NOT friend of ', 8, 1, '2015-11-09 07:24:16'),
	(502, 10, ' Send request to ', 6, 1, '2015-11-09 08:35:54'),
	(503, 1, ' Send request to ', 6, 1, '2015-11-09 08:36:14'),
	(504, 3, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 12:00:08'),
	(505, 4, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 12:00:08'),
	(506, 8, ' Like picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-09 12:00:08'),
	(507, 3, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 0, '2015-11-09 12:00:08'),
	(508, 4, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 0, '2015-11-09 12:00:08'),
	(509, 8, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 0, '2015-11-09 12:00:08'),
	(510, 3, ' Send request to ', 12, 0, '2015-11-09 12:30:06'),
	(511, 4, ' Send request to ', 12, 0, '2015-11-09 12:30:06'),
	(512, 8, ' Send request to ', 12, 0, '2015-11-09 12:30:06'),
	(513, 3, ' Send request to ', 12, 0, '2015-11-10 03:53:19'),
	(514, 4, ' Send request to ', 12, 0, '2015-11-10 03:53:19'),
	(515, 8, ' Send request to ', 12, 0, '2015-11-10 03:53:19'),
	(516, 3, ' Friend of ', 12, 0, '2015-11-10 03:53:56'),
	(517, 4, ' Friend of ', 12, 0, '2015-11-10 03:53:56'),
	(518, 8, ' Friend of ', 12, 0, '2015-11-10 03:53:56'),
	(519, 14, ' Friend of ', 1, 1, '2015-11-10 03:53:56'),
	(520, 14, ' Like picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:34:44'),
	(521, 14, ' unLike picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:34:45'),
	(522, 14, ' Like picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:35:54'),
	(523, 14, ' unLike picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:35:55'),
	(524, 14, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 04:36:11'),
	(525, 14, ' unLike picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 04:36:13'),
	(526, 14, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 04:36:13'),
	(527, 14, ' unLike picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 04:36:14'),
	(528, 14, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 04:36:15'),
	(529, 14, ' unLike picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 04:36:15'),
	(530, 14, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 04:36:15'),
	(531, 14, ' unLike picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 04:36:15'),
	(532, 14, ' Like picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:41:03'),
	(533, 14, ' unLike picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:41:04'),
	(534, 14, ' Like picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:41:31'),
	(535, 14, ' unLike picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:42:08'),
	(536, 14, ' Like picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:42:08'),
	(537, 14, ' unLike picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:42:09'),
	(538, 14, ' Like picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:42:10'),
	(539, 14, ' unLike picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:42:11'),
	(540, 14, ' Like picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:42:14'),
	(541, 14, ' unLike picture "meo (22)563c7b758c38b.jpg" of ', 12, 1, '2015-11-10 04:42:14'),
	(542, 14, ' Like picture "meo (23)563c7b758def1.jpg" of ', 12, 1, '2015-11-10 04:43:29'),
	(543, 14, ' unLike picture "meo (23)563c7b758def1.jpg" of ', 12, 1, '2015-11-10 04:43:32'),
	(544, 14, ' Like picture "meo (4)563c70c7f2190.jpg" of ', 12, 1, '2015-11-10 04:48:32'),
	(545, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-10 04:52:04'),
	(546, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-10 04:52:05'),
	(547, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-10 04:52:05'),
	(548, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-10 04:52:06'),
	(549, 14, ' Like picture "meo (10)563c70c808569.jpg" of ', 12, 1, '2015-11-10 04:52:23'),
	(550, 14, ' Like picture "meo (9)563c70c806dfd.jpg" of ', 12, 1, '2015-11-10 04:52:38'),
	(551, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-10 04:54:37'),
	(552, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-10 04:54:44'),
	(553, 14, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 04:57:32'),
	(554, 14, ' unLike picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 04:58:07'),
	(555, 3, ' Send request to ', 13, 0, '2015-11-10 05:01:25'),
	(556, 4, ' Send request to ', 13, 0, '2015-11-10 05:01:25'),
	(557, 8, ' Send request to ', 13, 0, '2015-11-10 05:01:25'),
	(558, 15, ' Send request to ', 13, 1, '2015-11-10 05:01:25'),
	(559, 3, ' Send request to ', 13, 0, '2015-11-10 05:01:51'),
	(560, 4, ' Send request to ', 13, 0, '2015-11-10 05:01:51'),
	(561, 8, ' Send request to ', 13, 0, '2015-11-10 05:01:51'),
	(562, 15, ' Send request to ', 13, 1, '2015-11-10 05:01:51'),
	(563, 3, ' Friend of ', 13, 0, '2015-11-10 05:02:12'),
	(564, 4, ' Friend of ', 13, 0, '2015-11-10 05:02:12'),
	(565, 8, ' Friend of ', 13, 0, '2015-11-10 05:02:12'),
	(566, 15, ' Friend of ', 13, 1, '2015-11-10 05:02:12'),
	(567, 3, ' unLike picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 0, '2015-11-10 07:27:32'),
	(568, 4, ' unLike picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 0, '2015-11-10 07:27:32'),
	(569, 8, ' unLike picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 0, '2015-11-10 07:27:32'),
	(570, 15, ' unLike picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 07:27:32'),
	(571, 3, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 0, '2015-11-10 07:27:32'),
	(572, 4, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 0, '2015-11-10 07:27:32'),
	(573, 8, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 0, '2015-11-10 07:27:32'),
	(574, 15, ' Like picture "20150926131009_wPpZsOz1Hd5629dc18775df.jpg" of ', 1, 1, '2015-11-10 07:27:32'),
	(575, 14, ' Friend of ', 13, 1, '2015-11-11 05:16:46'),
	(576, 14, ' Send request to ', 9, 1, '2015-11-11 05:17:37'),
	(577, 14, ' Send request to ', 9, 1, '2015-11-11 05:17:43'),
	(578, 14, ' Send request to ', 9, 1, '2015-11-11 05:17:49'),
	(579, 14, ' Send request to ', 9, 1, '2015-11-11 05:17:50'),
	(580, 14, ' Send request to ', 9, 1, '2015-11-11 05:17:51'),
	(581, 14, ' Send request to ', 9, 1, '2015-11-11 05:17:52'),
	(582, 14, ' Send request to ', 9, 1, '2015-11-11 05:17:53'),
	(583, 14, ' Send request to ', 9, 1, '2015-11-11 05:17:54'),
	(584, 14, ' Send request to ', 9, 1, '2015-11-11 05:17:58'),
	(585, 14, ' Send request to ', 9, 1, '2015-11-11 05:18:00'),
	(586, 14, ' Send request to ', 9, 1, '2015-11-11 05:18:03'),
	(587, 14, ' Send request to ', 2, 1, '2015-11-11 05:18:18'),
	(588, 14, ' Send request to ', 2, 1, '2015-11-11 05:18:30'),
	(589, 14, ' Send request to ', 2, 1, '2015-11-11 05:18:40'),
	(590, 14, ' Send request to ', 2, 1, '2015-11-11 05:18:41'),
	(591, 14, ' Send request to ', 2, 1, '2015-11-11 05:24:44'),
	(592, 14, ' Send request to ', 3, 1, '2015-11-11 05:25:34'),
	(593, 14, ' Like picture "meo (7)563c70c803f2c.jpg" of ', 12, 1, '2015-11-11 06:10:51'),
	(594, 14, ' unLike picture "meo (7)563c70c803f2c.jpg" of ', 12, 1, '2015-11-11 06:10:52'),
	(595, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:10:54'),
	(596, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:10:54'),
	(597, 14, ' unLike picture "meo (4)563c70c7f2190.jpg" of ', 12, 1, '2015-11-11 06:10:55'),
	(598, 14, ' Like picture "meo (4)563c70c7f2190.jpg" of ', 12, 1, '2015-11-11 06:10:55'),
	(599, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:10:56'),
	(600, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:10:57'),
	(601, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:10:58'),
	(602, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:10:59'),
	(603, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:10'),
	(604, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:12'),
	(605, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:13'),
	(606, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:15'),
	(607, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:16'),
	(608, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:17'),
	(609, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:17'),
	(610, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:20'),
	(611, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:22'),
	(612, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:24'),
	(613, 14, ' Like picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:25'),
	(614, 14, ' unLike picture "meo (5)563c70c801198.jpg" of ', 12, 1, '2015-11-11 06:11:26'),
	(615, 3, ' Send request to ', 9, 0, '2015-11-11 07:24:50'),
	(616, 4, ' Send request to ', 9, 0, '2015-11-11 07:24:50'),
	(617, 8, ' Send request to ', 9, 0, '2015-11-11 07:24:50'),
	(618, 15, ' Send request to ', 9, 1, '2015-11-11 07:24:50'),
	(619, 16, ' Send request to ', 9, 0, '2015-11-11 07:24:50'),
	(620, 3, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-11 09:05:49'),
	(621, 4, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-11 09:05:49'),
	(622, 8, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-11 09:05:49'),
	(623, 15, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-11 09:05:49'),
	(624, 16, ' unLike picture "20150926122918_nv3r3lhqWn5629dc187624f.jpg" of ', 1, 0, '2015-11-11 09:05:49'),
	(625, 3, ' Send request to ', 11, 0, '2015-11-11 09:13:26'),
	(626, 4, ' Send request to ', 11, 0, '2015-11-11 09:13:26'),
	(627, 8, ' Send request to ', 11, 0, '2015-11-11 09:13:26'),
	(628, 15, ' Send request to ', 11, 0, '2015-11-11 09:13:26'),
	(629, 16, ' Send request to ', 11, 0, '2015-11-11 09:13:26'),
	(630, 3, ' Send request to ', 11, 0, '2015-11-11 09:14:06'),
	(631, 4, ' Send request to ', 11, 0, '2015-11-11 09:14:06'),
	(632, 8, ' Send request to ', 11, 0, '2015-11-11 09:14:06'),
	(633, 15, ' Send request to ', 11, 0, '2015-11-11 09:14:06'),
	(634, 16, ' Send request to ', 11, 0, '2015-11-11 09:14:06'),
	(635, 3, ' Send request to ', 11, 0, '2015-11-11 09:14:07'),
	(636, 4, ' Send request to ', 11, 0, '2015-11-11 09:14:07'),
	(637, 8, ' Send request to ', 11, 0, '2015-11-11 09:14:07'),
	(638, 15, ' Send request to ', 11, 0, '2015-11-11 09:14:07'),
	(639, 16, ' Send request to ', 11, 0, '2015-11-11 09:14:07'),
	(640, 3, ' Send request to ', 10, 0, '2015-11-11 09:14:15'),
	(641, 4, ' Send request to ', 10, 0, '2015-11-11 09:14:15'),
	(642, 8, ' Send request to ', 10, 0, '2015-11-11 09:14:15'),
	(643, 15, ' Send request to ', 10, 0, '2015-11-11 09:14:15'),
	(644, 16, ' Send request to ', 10, 0, '2015-11-11 09:14:15'),
	(645, 3, ' Send request to ', 7, 0, '2015-11-11 09:17:09'),
	(646, 4, ' Send request to ', 7, 0, '2015-11-11 09:17:09'),
	(647, 8, ' Send request to ', 7, 0, '2015-11-11 09:17:09'),
	(648, 15, ' Send request to ', 7, 0, '2015-11-11 09:17:09'),
	(649, 16, ' Send request to ', 7, 0, '2015-11-11 09:17:09'),
	(650, 3, ' NOT friend of ', 8, 0, '2015-11-11 09:18:09'),
	(651, 4, ' NOT friend of ', 8, 0, '2015-11-11 09:18:09'),
	(652, 8, ' NOT friend of ', 8, 0, '2015-11-11 09:18:09'),
	(653, 15, ' NOT friend of ', 8, 0, '2015-11-11 09:18:09'),
	(654, 16, ' NOT friend of ', 8, 0, '2015-11-11 09:18:09'),
	(655, 3, ' Send request to ', 8, 0, '2015-11-11 09:18:55'),
	(656, 4, ' Send request to ', 8, 0, '2015-11-11 09:18:55'),
	(657, 8, ' Send request to ', 8, 0, '2015-11-11 09:18:55'),
	(658, 15, ' Send request to ', 8, 0, '2015-11-11 09:18:55'),
	(659, 16, ' Send request to ', 8, 0, '2015-11-11 09:18:55');
/*!40000 ALTER TABLE `follow_log` ENABLE KEYS */;


-- Dumping structure for table minh_nhut_lession_3.friend_relation
CREATE TABLE IF NOT EXISTS `friend_relation` (
  `id` int(10) NOT NULL auto_increment,
  `user_id` int(10) NOT NULL,
  `user_id_to` int(10) NOT NULL,
  `regist_datetime` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_friend_relation_user` (`user_id`),
  KEY `FK_friend_relation_user_to` (`user_id_to`),
  CONSTRAINT `FK_friend_relation_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_friend_relation_user_to` FOREIGN KEY (`user_id_to`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.friend_relation: ~19 rows (approximately)
/*!40000 ALTER TABLE `friend_relation` DISABLE KEYS */;
INSERT INTO `friend_relation` (`id`, `user_id`, `user_id_to`, `regist_datetime`) VALUES
	(28, 1, 2, '2015-11-04 09:54:03'),
	(33, 1, 3, '2015-11-04 11:33:37'),
	(34, 2, 3, '2015-11-04 11:33:36'),
	(39, 1, 4, '2015-11-06 09:34:24'),
	(46, 1, 5, '2015-11-09 11:24:38'),
	(47, 5, 6, '2015-11-09 11:26:13'),
	(48, 7, 3, '2015-11-09 11:46:07'),
	(49, 7, 4, '2015-11-09 11:47:03'),
	(50, 7, 12, '2015-11-09 11:48:46'),
	(51, 8, 9, '2014-11-09 11:48:46'),
	(57, 8, 5, '2014-11-09 11:48:46'),
	(60, 8, 10, '2014-11-09 11:48:46'),
	(61, 8, 11, '2014-11-09 11:48:46'),
	(62, 8, 12, '2014-11-09 11:48:46'),
	(63, 8, 3, '2014-11-09 11:48:46'),
	(72, 8, 4, '2014-11-09 11:48:46'),
	(75, 1, 12, '2015-11-10 08:24:11'),
	(76, 1, 13, '2015-11-10 09:32:23'),
	(77, 13, 12, '2015-11-11 09:46:41');
/*!40000 ALTER TABLE `friend_relation` ENABLE KEYS */;


-- Dumping structure for table minh_nhut_lession_3.friend_request
CREATE TABLE IF NOT EXISTS `friend_request` (
  `id` int(10) NOT NULL auto_increment,
  `user_id` int(10) NOT NULL,
  `user_id_to` int(10) NOT NULL,
  `regist_datetime` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_friend_request_user` (`user_id`),
  KEY `FK_friend_request_user_to` (`user_id_to`),
  CONSTRAINT `FK_friend_request_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_friend_request_user_to` FOREIGN KEY (`user_id_to`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.friend_request: ~17 rows (approximately)
/*!40000 ALTER TABLE `friend_request` DISABLE KEYS */;
INSERT INTO `friend_request` (`id`, `user_id`, `user_id_to`, `regist_datetime`) VALUES
	(61, 7, 6, '2015-11-09 01:05:45'),
	(62, 4, 6, '2015-11-09 01:06:05'),
	(63, 11, 6, '2015-11-09 01:06:17'),
	(64, 3, 6, '2015-11-09 01:06:29'),
	(70, 13, 3, '2015-11-10 09:41:51'),
	(71, 13, 5, '2015-11-10 09:41:52'),
	(85, 12, 9, '2015-11-11 09:47:58'),
	(90, 12, 2, '2015-11-11 09:54:39'),
	(91, 12, 3, '2015-11-11 09:55:29'),
	(92, 13, 8, '2015-11-11 09:58:34'),
	(93, 13, 2, '2015-11-11 09:58:39'),
	(96, 13, 11, '2015-11-11 10:25:02'),
	(97, 13, 10, '2015-11-11 10:25:05'),
	(98, 1, 9, '2015-11-11 11:54:38'),
	(101, 1, 11, '2015-11-11 01:43:49'),
	(102, 1, 10, '2015-11-11 01:43:57'),
	(103, 1, 7, '2015-11-11 01:46:50');
/*!40000 ALTER TABLE `friend_request` ENABLE KEYS */;


-- Dumping structure for procedure minh_nhut_lession_3.Friend_suggestion_feature
DELIMITER //
CREATE DEFINER=`btwn2`@`172.16.%.%` PROCEDURE `Friend_suggestion_feature`(IN `idUser` INT)
    NO SQL
    DETERMINISTIC
BEGIN
	BLOCK1: begin
		declare idUserA integer;
		declare no_more_rows1 bool default false;
		declare numberLoop1 integer default -1;
		declare nameTableTemp varchar(20);
		DECLARE cursor1 CURSOR FOR
									 select `user`.id
									 from `user` 
									 where `user`.id in 
										(
											select `user`.id from `user` where 
											`user`.id in  
											( 
												select `friend_relation`.user_id_to 
												from `user` inner join `friend_relation` 
												on `user`.id = `friend_relation`.user_id 
												where `friend_relation`.user_id = idUser
											) 
											or
											`user`.id in 
											( 
												select `friend_relation`.user_id 
												from `user` inner join `friend_relation` 
												on `user`.id = `friend_relation`.user_id_to 
												where `friend_relation`.user_id_to = idUser
											)
										)
									AND `user`.id not in (idUser);
		declare continue handler for not found set no_more_rows1 = TRUE;
		select concat( 
		    char(round(rand()*25)+97),
		    char(round(rand()*25)+97),
		    char(round(rand()*25)+97),
		    char(round(rand()*25)+97),
		    char(round(rand()*25)+97),
		    char(round(rand()*25)+97),
		    char(round(rand()*25)+97),
		    char(round(rand()*25)+97)
			) into nameTableTemp;
			
		-- create table tmp
		set @sql_table_tmp =
		" create TEMPORARY table IF NOT EXISTS `{name_table}` (
			`id_auto` int(10) not null auto_increment,
			`id` int(10) NOT NULL,
			`username` varchar(40) collate utf8_unicode_ci NOT NULL,
			`password` varchar(32) collate utf8_unicode_ci NOT NULL,
			`fullname` varchar(32) collate utf8_unicode_ci NOT NULL,
			`sex` tinyint(1) NOT NULL default '1',
			`birthday` date default NULL,
			`address` varchar(255) collate utf8_unicode_ci NOT NULL default '',
			`introduction` text collate utf8_unicode_ci NOT NULL,
			`avatar` varchar(255) collate utf8_unicode_ci NOT NULL,
			`email` varchar(40) collate utf8_unicode_ci NOT NULL default '',
			`group_id` int(10) NOT NULL,
			primary key (id_auto)
		); ";
		SELECT REPLACE( @sql_table_tmp, '{name_table}' , nameTableTemp ) INTO @sql_table_tmp;
		PREPARE dynamic_statement_create_table_tmp FROM @sql_table_tmp;
		EXECUTE dynamic_statement_create_table_tmp;
		DEALLOCATE PREPARE dynamic_statement_create_table_tmp;
		
		open cursor1;
		LOOP1: loop
			fetch cursor1 into idUserA;
			set numberLoop1 = numberLoop1 + 1;
			if no_more_rows1 then
				close cursor1;
				leave LOOP1;
			end if;
			-- BLOCK2 
			BLOCK2: begin
				declare idUserB int;
				declare no_more_rows2 bool default FALSE;
				declare numberLoop2 integer default -1;
				DECLARE cursor2 CURSOR FOR
											select `user`.id
											from `user` 
											where `user`.id in 
												(
													select `user`.id from `user` where 
													`user`.id in  
													( 
														select `friend_relation`.user_id_to 
														from `user` inner join `friend_relation` 
														on `user`.id = `friend_relation`.user_id 
														where `friend_relation`.user_id = idUser
													) 
													or
													`user`.id in 
													( 
														select `friend_relation`.user_id 
														from `user` inner join `friend_relation` 
														on `user`.id = `friend_relation`.user_id_to 
														where `friend_relation`.user_id_to = idUser
													)
												)
											AND `user`.id not in (idUser);
											
				declare continue handler for not found set no_more_rows2 = TRUE;
				
				open cursor2;
				LOOP2: loop
					fetch cursor2 into idUserB;
					if no_more_rows2 then
						close cursor2;
						leave LOOP2;
					end if;
					
					
					set numberLoop2 = numberLoop2 + 1;
					
					if numberLoop2 > numberLoop1 then
						-- call procdeuct
						call insert_friend_into_table_tmp( idUser, idUserA, idUserB, nameTableTemp);
					end if;
					
				end loop LOOP2;
			end BLOCK2;
		end loop LOOP1;
		
		BLOCK4: begin
			
				set @sql_insert = "
											 insert into `{name_table}`(id,username,`password`,fullname,sex,birthday,address,introduction,avatar,email,group_id)
											 select `user`.id , `user`.username ,`user`.password ,`user`.fullname , `user`.sex , `user`.birthday, `user`.address,`user`.introduction,`user`.avatar,`user`.email,`user`.group_id from `user` where 
											`user`.id not in 
															(
																select `user`.id from `user` where 
																	`user`.id in  
																	( 
																		select `friend_relation`.user_id_to 
																		from `user` inner join `friend_relation` 
																		on `user`.id = `friend_relation`.user_id 
																		where `friend_relation`.user_id = '{idA}' 
																	) 
																	or
																	`user`.id in 
																	( 
																		select `friend_relation`.user_id 
																		from `user` inner join `friend_relation` 
																		on `user`.id = `friend_relation`.user_id_to 
																		where `friend_relation`.user_id_to = '{idA}' 
																	)
															)
											AND
											`user`.id not in ( select `friend_request`.user_id_to from `friend_request` where `friend_request`.user_id = '{idA}' )
											AND
											`user`.id not in ({idA})
											ORDER BY `user`.id desc
								";
				SELECT REPLACE( @sql_insert, '{name_table}' , nameTableTemp ) INTO @sql_insert;
				SELECT REPLACE( @sql_insert, '{idA}' , idUser ) INTO @sql_insert;
				
				PREPARE dynamic_statement_insert_table_tmp FROM @sql_insert;
				EXECUTE dynamic_statement_insert_table_tmp;
				DEALLOCATE PREPARE dynamic_statement_insert_table_tmp;						
				
		end BLOCK4;
		
		-- select table temp
      SET @select_tmp = " select * from `{tablename}` where `{tablename}`.id not in ({idUser}) group by `{tablename}`.id order by `{tablename}`.id_auto ASC";
      SELECT REPLACE( @select_tmp, '{tablename}' , nameTableTemp ) INTO @select_tmp;
		SELECT REPLACE( @select_tmp, '{idUser}' , idUser ) INTO @select_tmp;
      PREPARE dynamic_statement_select_table_tmp FROM @select_tmp;
		EXECUTE dynamic_statement_select_table_tmp;
		DEALLOCATE PREPARE dynamic_statement_select_table_tmp;
      
		-- delete table tmp
		set @sql_delete_table_tmp = " DROP TEMPORARY TABLE IF EXISTS `{name_table}` ";
		SELECT REPLACE( @sql_delete_table_tmp, '{name_table}' , nameTableTemp ) INTO @sql_delete_table_tmp;
		PREPARE dynamic_statement_delete_table_tmp FROM @sql_delete_table_tmp;
		EXECUTE dynamic_statement_delete_table_tmp;
		DEALLOCATE PREPARE dynamic_statement_delete_table_tmp;
		
	end BLOCK1;
    
END//
DELIMITER ;


-- Dumping structure for table minh_nhut_lession_3.group
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) NOT NULL auto_increment,
  `level` tinyint(1) NOT NULL default '3',
  `name` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `regist_datetime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.group: ~2 rows (approximately)
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`id`, `level`, `name`, `regist_datetime`) VALUES
	(1, 1, 'Admin', '2015-10-15 10:23:31'),
	(2, 3, 'User', '2015-10-26 15:15:03');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;


-- Dumping structure for procedure minh_nhut_lession_3.insert_friend_into_table_tmp
DELIMITER //
CREATE DEFINER=`btwn2`@`172.16.%.%` PROCEDURE `insert_friend_into_table_tmp`(IN `idA` INT, IN `idB` INT, IN `idC` INT, IN `nametable` VARCHAR(20))
    DETERMINISTIC
BEGIN
	-- create table tmp
	set @sql_table_tmp =
	" create TEMPORARY table IF NOT EXISTS `{name_table}` (
		`id_auto` int(10) not null auto_increment,
		`id` int(10) NOT NULL,
		`username` varchar(40) collate utf8_unicode_ci NOT NULL,
		`password` varchar(32) collate utf8_unicode_ci NOT NULL,
		`fullname` varchar(32) collate utf8_unicode_ci NOT NULL,
		`sex` tinyint(1) NOT NULL default '1',
		`birthday` date default NULL,
		`address` varchar(255) collate utf8_unicode_ci NOT NULL default '',
		`introduction` text collate utf8_unicode_ci NOT NULL,
		`avatar` varchar(255) collate utf8_unicode_ci NOT NULL,
		`email` varchar(40) collate utf8_unicode_ci NOT NULL default '',
		`group_id` int(10) NOT NULL,
		primary key (id_auto)
	); ";
	SELECT REPLACE( @sql_table_tmp, '{name_table}' , nametable ) INTO @sql_table_tmp;
	PREPARE dynamic_statement_create_table_tmp FROM @sql_table_tmp;
	EXECUTE dynamic_statement_create_table_tmp;
	DEALLOCATE PREPARE dynamic_statement_create_table_tmp;
	
	-- insert to table tml 
	set @sql_insert = "
			insert into `{name_table}`(id,username,`password`,fullname,sex,birthday,address,introduction,avatar,email,group_id)
			select `user`.id , `user`.username ,`user`.password ,`user`.fullname , `user`.sex , `user`.birthday, `user`.address,`user`.introduction,`user`.avatar,`user`.email,`user`.group_id
			from `user` 
			where `user`.id in 
				(
					select `user`.id from `user` where 
					`user`.id in  
					( 
						select `friend_relation`.user_id_to 
						from `user` inner join `friend_relation` 
						on `user`.id = `friend_relation`.user_id 
						where `friend_relation`.user_id = '{idC}'
					) 
					or
					`user`.id in 
					( 
						select `friend_relation`.user_id 
						from `user` inner join `friend_relation` 
						on `user`.id = `friend_relation`.user_id_to 
						where `friend_relation`.user_id_to = '{idC}'
					)
				)
			AND `user`.id not in ({idC})
			AND `user`.id in (
								select `user`.id 
								from `user` 
								where `user`.id in 
									(
										select `user`.id from `user` where 
										`user`.id in  
										( 
											select `friend_relation`.user_id_to 
											from `user` inner join `friend_relation` 
											on `user`.id = `friend_relation`.user_id 
											where `friend_relation`.user_id = '{idB}'
										) 
										or
										`user`.id in 
										( 
											select `friend_relation`.user_id 
											from `user` inner join `friend_relation` 
											on `user`.id = `friend_relation`.user_id_to 
											where `friend_relation`.user_id_to = '{idB}' 
										)
									)
								AND `user`.id not in ({idB}) 
							)
					
			AND is_friend(`user`.id, {idA}) = 0 
			AND `user`.id not in ( select `friend_request`.user_id_to from `friend_request` where `friend_request`.user_id = '{idA}' ); 
			";
	SELECT REPLACE( @sql_insert, '{name_table}' , nametable ) INTO @sql_insert;
	SELECT REPLACE( @sql_insert, '{idA}' , idA ) INTO @sql_insert;
	SELECT REPLACE( @sql_insert, '{idB}' , idB ) INTO @sql_insert;
	SELECT REPLACE( @sql_insert, '{idC}' , idC ) INTO @sql_insert;
	
	PREPARE dynamic_statement_insert_table_tmp FROM @sql_insert;
	EXECUTE dynamic_statement_insert_table_tmp;
	DEALLOCATE PREPARE dynamic_statement_insert_table_tmp;


END//
DELIMITER ;


-- Dumping structure for procedure minh_nhut_lession_3.insert_friend_of_friend
DELIMITER //
CREATE DEFINER=`btwn2`@`172.16.%.%` PROCEDURE `insert_friend_of_friend`(IN `idUserA` INT, IN `idUserB` INT, IN `nametable` VARCHAR(20))
    DETERMINISTIC
BEGIN
	set @sql_table_tmp =
	" create TEMPORARY table IF NOT EXISTS `{name_table}` (
		`id_auto` int(10) not null auto_increment,
		`id` int(10) NOT NULL,
		`username` varchar(40) collate utf8_unicode_ci NOT NULL,
		`password` varchar(32) collate utf8_unicode_ci NOT NULL,
		`fullname` varchar(32) collate utf8_unicode_ci NOT NULL,
		`sex` tinyint(1) NOT NULL default '1',
		`birthday` date default NULL,
		`address` varchar(255) collate utf8_unicode_ci NOT NULL default '',
		`introduction` text collate utf8_unicode_ci NOT NULL,
		`avatar` varchar(255) collate utf8_unicode_ci NOT NULL,
		`email` varchar(40) collate utf8_unicode_ci NOT NULL default '',
		`group_id` int(10) NOT NULL,
		
		primary key (id_auto)
	); ";
	
	-- create table tmp
	SELECT REPLACE( @sql_table_tmp, '{name_table}' , nametable ) INTO @sql_table_tmp;
	PREPARE dynamic_statement_create_table_tmp FROM @sql_table_tmp;
	EXECUTE dynamic_statement_create_table_tmp;
	DEALLOCATE PREPARE dynamic_statement_create_table_tmp;
	
	-- insert to table tml 
	set @sql_insert = "
			insert into `{name_table}`(id,username,`password`,fullname,sex,birthday,address,introduction,avatar,email,group_id)
			select `user`.id , `user`.username ,`user`.password ,`user`.fullname , `user`.sex , `user`.birthday, `user`.address,`user`.introduction,`user`.avatar,`user`.email,`user`.group_id
			from `user` 
			where `user`.id in 
				(
					select `user`.id from `user` where 
					`user`.id in  
					( 
						select `friend_relation`.user_id_to 
						from `user` inner join `friend_relation` 
						on `user`.id = `friend_relation`.user_id 
						where `friend_relation`.user_id = '{idB}'
					) 
					or
					`user`.id in 
					( 
						select `friend_relation`.user_id 
						from `user` inner join `friend_relation` 
						on `user`.id = `friend_relation`.user_id_to 
						where `friend_relation`.user_id_to = '{idB}'
					)
				)
			AND `user`.id not in ({idB})
			AND is_friend(`user`.id, {idA}) = 0 ;
			";
	SELECT REPLACE( @sql_insert, '{name_table}' , nametable ) INTO @sql_insert;
	SELECT REPLACE( @sql_insert, '{idA}' , idUserA ) INTO @sql_insert;
	SELECT REPLACE( @sql_insert, '{idB}' , idUserB ) INTO @sql_insert;
	
	PREPARE dynamic_statement_insert_table_tmp FROM @sql_insert;
	EXECUTE dynamic_statement_insert_table_tmp;
	DEALLOCATE PREPARE dynamic_statement_insert_table_tmp;
	
	-- insert all friend
	set @sql_insert = "
				insert into `{name_table}`(id,username,`password`,fullname,sex,birthday,address,introduction,avatar,email,group_id)
				 select `user`.id , `user`.username ,`user`.password ,`user`.fullname , `user`.sex , `user`.birthday, `user`.address,`user`.introduction,`user`.avatar,`user`.email,`user`.group_id from `user` where 
				`user`.id not in 
								(
									select `user`.id from `user` where 
										`user`.id in  
										( 
											select `friend_relation`.user_id_to 
											from `user` inner join `friend_relation` 
											on `user`.id = `friend_relation`.user_id 
											where `friend_relation`.user_id = '{idA}' 
										) 
										or
										`user`.id in 
										( 
											select `friend_relation`.user_id 
											from `user` inner join `friend_relation` 
											on `user`.id = `friend_relation`.user_id_to 
											where `friend_relation`.user_id_to = '{idA}' 
										)
								)
				AND
				`user`.id not in ( select `friend_request`.user_id_to from `friend_request` where `friend_request`.user_id = '{idA}' )
				AND
				`user`.id not in ({idA})
				ORDER BY `user`.id desc
	";
	SELECT REPLACE( @sql_insert, '{name_table}' , nametable ) INTO @sql_insert;
	SELECT REPLACE( @sql_insert, '{idA}' , idUserA ) INTO @sql_insert;
	
	PREPARE dynamic_statement_insert_F_table_tmp FROM @sql_insert;
	EXECUTE dynamic_statement_insert_F_table_tmp;
	DEALLOCATE PREPARE dynamic_statement_insert_F_table_tmp;

END//
DELIMITER ;


-- Dumping structure for function minh_nhut_lession_3.is_friend
DELIMITER //
CREATE DEFINER=`btwn2`@`172.16.%.%` FUNCTION `is_friend`(`idA` INT, `idB` INT) RETURNS tinyint(1)
    DETERMINISTIC
    COMMENT ' = 0 => NOT IS FRIEND  | != 0 => IS FRIEND'
BEGIN
	declare resuft tinyint(1) default 0;
	select count(*) into resuft 
	from `friend_relation` 
	where ( `friend_relation`.user_id = idA and `friend_relation`.user_id_to = idB ) or ( `friend_relation`.user_id_to = idA and `friend_relation`.user_id = idB );
	return resuft;
END//
DELIMITER ;


-- Dumping structure for table minh_nhut_lession_3.like
CREATE TABLE IF NOT EXISTS `like` (
  `id` int(10) NOT NULL auto_increment,
  `user_id` int(10) NOT NULL,
  `pictures_id` int(10) NOT NULL,
  `time_like` datetime NOT NULL,
  PRIMARY KEY  (`id`,`user_id`,`pictures_id`),
  KEY `FK_like_user` (`user_id`),
  KEY `FK_like_pictures` (`pictures_id`),
  CONSTRAINT `FK_like_pictures` FOREIGN KEY (`pictures_id`) REFERENCES `picture` (`id`),
  CONSTRAINT `FK_like_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.like: ~34 rows (approximately)
/*!40000 ALTER TABLE `like` DISABLE KEYS */;
INSERT INTO `like` (`id`, `user_id`, `pictures_id`, `time_like`) VALUES
	(66, 6, 124, '0000-00-00 00:00:00'),
	(67, 6, 113, '0000-00-00 00:00:00'),
	(68, 6, 114, '0000-00-00 00:00:00'),
	(69, 6, 115, '0000-00-00 00:00:00'),
	(70, 6, 119, '0000-00-00 00:00:00'),
	(71, 6, 118, '0000-00-00 00:00:00'),
	(72, 6, 117, '0000-00-00 00:00:00'),
	(75, 7, 138, '0000-00-00 00:00:00'),
	(81, 1, 133, '0000-00-00 00:00:00'),
	(82, 5, 125, '0000-00-00 00:00:00'),
	(83, 5, 128, '0000-00-00 00:00:00'),
	(84, 5, 126, '0000-00-00 00:00:00'),
	(85, 5, 127, '0000-00-00 00:00:00'),
	(122, 1, 136, '0000-00-00 00:00:00'),
	(123, 1, 137, '0000-00-00 00:00:00'),
	(124, 1, 138, '0000-00-00 00:00:00'),
	(125, 1, 140, '0000-00-00 00:00:00'),
	(126, 1, 142, '0000-00-00 00:00:00'),
	(127, 1, 141, '0000-00-00 00:00:00'),
	(128, 5, 137, '0000-00-00 00:00:00'),
	(129, 5, 138, '0000-00-00 00:00:00'),
	(130, 5, 142, '0000-00-00 00:00:00'),
	(131, 5, 141, '0000-00-00 00:00:00'),
	(132, 5, 140, '0000-00-00 00:00:00'),
	(139, 6, 123, '0000-00-00 00:00:00'),
	(142, 2, 199, '0000-00-00 00:00:00'),
	(143, 2, 207, '0000-00-00 00:00:00'),
	(144, 2, 208, '0000-00-00 00:00:00'),
	(145, 2, 200, '0000-00-00 00:00:00'),
	(146, 2, 204, '0000-00-00 00:00:00'),
	(164, 12, 152, '0000-00-00 00:00:00'),
	(165, 12, 151, '0000-00-00 00:00:00'),
	(168, 1, 100, '0000-00-00 00:00:00'),
	(171, 12, 146, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `like` ENABLE KEYS */;


-- Dumping structure for procedure minh_nhut_lession_3.log_add_friend
DELIMITER //
CREATE DEFINER=`btwn2`@`172.16.%.%` PROCEDURE `log_add_friend`(IN `id_user` INT, IN `id_user_to` INT)
    READS SQL DATA
    DETERMINISTIC
BEGIN
	 DECLARE v_finished INTEGER DEFAULT 0;
	 DECLARE id_follow_temp INTEGER;
	 DECLARE cur_follow CURSOR FOR SELECT follow.id FROM follow WHERE follow.user_id_to = id_user;
	
	 -- declare NOT FOUND handler
	 DECLARE CONTINUE HANDLER 
	        FOR NOT FOUND SET v_finished = 1;
	
		OPEN cur_follow;
		 
			 loop_follow: LOOP
			 
				 FETCH cur_follow INTO id_follow_temp;
				 
				 IF v_finished = 1 THEN 
				 	LEAVE loop_follow;
				 END IF;
				 
				 SET @action = ' Friend of ';
				 INSERT INTO follow_log ( follow_id,`action`,userid_to, regist_datetime )
				 					VALUES ( id_follow_temp, @action , id_user_to , NOW() );
				 	 
			 END LOOP loop_follow;
			 
		CLOSE cur_follow;
END//
DELIMITER ;


-- Dumping structure for procedure minh_nhut_lession_3.log_un_friend
DELIMITER //
CREATE DEFINER=`btwn2`@`172.16.%.%` PROCEDURE `log_un_friend`(IN `id_user` INT, IN `id_user_to` INT)
    DETERMINISTIC
BEGIN
	 DECLARE v_finished INTEGER DEFAULT 0;
	 DECLARE id_follow_temp INTEGER;
	 DECLARE cur_follow CURSOR FOR SELECT follow.id FROM follow WHERE follow.user_id_to = id_user;
	
	 -- declare NOT FOUND handler
	 DECLARE CONTINUE HANDLER 
	        FOR NOT FOUND SET v_finished = 1;
	
		OPEN cur_follow;
		 
			 loop_follow: LOOP
			 
				 FETCH cur_follow INTO id_follow_temp;
				 
				 IF v_finished = 1 THEN 
				 	LEAVE loop_follow;
				 END IF;
				 
				 SET @action = ' NOT friend of ';
				 INSERT INTO follow_log ( follow_id,`action`,userid_to, regist_datetime )
				 					VALUES ( id_follow_temp, @action , id_user_to , NOW() );
				 	 
			 END LOOP loop_follow;
			 
		CLOSE cur_follow;
END//
DELIMITER ;


-- Dumping structure for table minh_nhut_lession_3.message_log
CREATE TABLE IF NOT EXISTS `message_log` (
  `id` int(10) NOT NULL auto_increment,
  `user_id` int(10) NOT NULL,
  `user_id_to` int(10) NOT NULL,
  `regist_datetime` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_message_log_user` (`user_id`),
  KEY `FK_message_log_user_to` (`user_id_to`),
  CONSTRAINT `FK_message_log_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_message_log_user_to` FOREIGN KEY (`user_id_to`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.message_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `message_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_log` ENABLE KEYS */;


-- Dumping structure for table minh_nhut_lession_3.picture
CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(10) NOT NULL auto_increment,
  `url` text collate utf8_unicode_ci,
  `view` int(10) NOT NULL default '0',
  `like_number` int(10) NOT NULL default '0',
  `regist_datetime` datetime default NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_pictures_user` (`user_id`),
  CONSTRAINT `FK_pictures_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.picture: ~95 rows (approximately)
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` (`id`, `url`, `view`, `like_number`, `regist_datetime`, `user_id`) VALUES
	(100, '20150926131009_wPpZsOz1Hd5629dc18775df.jpg', 5, 1, '2015-10-23 02:04:56', 1),
	(102, '20150928150023_oQX6EEW7sC5629dc187a0e8.jpg', 0, 0, '2015-10-23 02:04:56', 1),
	(104, '20150928181611_Cu4ZXzxSGF5629dc187c800.jpg', 0, 0, '2015-10-23 02:04:56', 1),
	(105, '2Q==(1)562de5e700f07.jpg', 6, 0, '2015-10-26 03:35:51', 6),
	(106, '2Q==(2)562de5e702295.jpg', 1, 0, '2015-10-26 03:35:51', 6),
	(107, '2Q==(3)562de5e703239.jpg', 1, 0, '2015-10-26 03:35:51', 6),
	(108, '2Q==562de5e7045c8.jpg', 2, 0, '2015-10-26 03:35:51', 6),
	(109, '9k=(1)562de5e705951.jpg', 1, 0, '2015-10-26 03:35:51', 6),
	(110, '9k=(2)562de5e7068f5.jpg', 1, 0, '2015-10-26 03:35:51', 6),
	(111, '9k=(3)562de5e707c88.jpg', 1, 0, '2015-10-26 03:35:51', 6),
	(112, '9k=(4)562de5e709040.jpg', 2, 0, '2015-10-26 03:35:51', 6),
	(113, '9k=(5)562de5f138d80.jpg', 1, 1, '2015-10-26 03:36:01', 6),
	(114, '9k=(6)562de5f13d003.jpg', 3, 1, '2015-10-26 03:36:01', 6),
	(115, '9k=(7)562de5f13e3a7.jpg', 2, 1, '2015-10-26 03:36:01', 6),
	(116, '9k=(8)562de5f13fb16.jpg', 3, 0, '2015-10-26 03:36:01', 6),
	(117, '9k=562de5f1410e3.jpg', 2, 1, '2015-10-26 03:36:01', 6),
	(118, 'Z(1)562de5f14282b.jpg', 1, 1, '2015-10-26 03:36:01', 6),
	(119, 'Z(2)562de5f143d85.jpg', 1, 1, '2015-10-26 03:36:01', 6),
	(120, 'Z(3)562de5f1454fa.jpg', 0, 0, '2015-10-26 03:36:01', 6),
	(123, 'Z(6)562de5fb7cba0.jpg', 4, 1, '2015-10-26 03:36:11', 6),
	(124, 'Z562de5fb87b9e.jpg', 3, 1, '2015-10-26 03:36:11', 6),
	(125, 'son tung (1)562de6b646065.jpg', 0, 1, '2015-10-26 03:39:18', 3),
	(126, 'son tung (2)562de6b648399.jpg', 0, 1, '2015-10-26 03:39:18', 3),
	(127, 'son tung (3)562de6b649efa.jpg', 0, 1, '2015-10-26 03:39:18', 3),
	(128, 'son tung (4)562de6b657065.jpg', 0, 1, '2015-10-26 03:39:18', 3),
	(130, 'son tung (6)562de6b65a8e8.jpg', 1, 0, '2015-10-26 03:39:18', 3),
	(131, 'son tung (7)562de6b65cc77.jpg', 0, 0, '2015-10-26 03:39:18', 3),
	(132, 'son tung (8)562de6b65f75e.jpg', 0, 0, '2015-10-26 03:39:18', 3),
	(133, 'son tung (9)562de6d0b22ea.jpg', 0, 1, '2015-10-26 03:39:44', 3),
	(134, 'son tung (11)562de6d0b427d.jpg', 0, 0, '2015-10-26 03:39:44', 3),
	(136, 'hinh-khoi-my-13562f444e7c160.jpg', 4, 1, '2015-10-27 04:30:54', 5),
	(137, 'hinh-khoi-my-14562f444e7d5b1.jpg', 0, 2, '2015-10-27 04:30:54', 5),
	(138, 'hinh-khoi-my-15562f444e7ed28.jpg', 0, 3, '2015-10-27 04:30:54', 5),
	(140, 'hinh-khoi-my-17562f444e81836.jpg', 0, 2, '2015-10-27 04:30:54', 5),
	(141, 'khoi-my-33562f444e82fa5.jpg', 0, 2, '2015-10-27 04:30:54', 5),
	(142, 'khoi-my-34562f444e8471d.jpg', 0, 2, '2015-10-27 04:30:54', 5),
	(146, 'meo (4)563c70c7f2190.jpg', 0, 1, '2015-11-06 04:20:08', 12),
	(147, 'meo (5)563c70c801198.jpg', 0, 0, '2015-11-06 04:20:08', 12),
	(149, 'meo (7)563c70c803f2c.jpg', 0, 0, '2015-11-06 04:20:08', 12),
	(150, 'meo (8)563c70c805a1d.jpg', 0, 0, '2015-11-06 04:20:08', 12),
	(151, 'meo (9)563c70c806dfd.jpg', 0, 1, '2015-11-06 04:20:08', 12),
	(152, 'meo (10)563c70c808569.jpg', 0, 1, '2015-11-06 04:20:08', 12),
	(159, 'thehung (1)564006a496541.jpg', 0, 0, '2015-11-09 09:36:20', 10),
	(160, 'thehung (2)564006a4980ee.jpg', 0, 0, '2015-11-09 09:36:20', 10),
	(161, 'thehung (3)564006a499be9.jpg', 0, 0, '2015-11-09 09:36:20', 10),
	(162, 'thehung (4)564006a49c739.jpg', 0, 0, '2015-11-09 09:36:20', 10),
	(163, 'thehung (5)564006a49de9c.jpg', 0, 0, '2015-11-09 09:36:20', 10),
	(164, 'thehung (6)564006a49f9f4.jpg', 0, 0, '2015-11-09 09:36:20', 10),
	(165, 'thehung (7)564006a4a154f.jpg', 0, 0, '2015-11-09 09:36:20', 10),
	(166, 'thehung (8)564006a4a3469.jpg', 0, 0, '2015-11-09 09:36:20', 10),
	(167, 'thehung (9)564006a4a4bda.jpg', 0, 0, '2015-11-09 09:36:20', 10),
	(168, 'thehung (10)564006a4a675e.jpg', 0, 0, '2015-11-09 09:36:20', 10),
	(170, 'dantruong (2)564006fe2b206.jpg', 0, 0, '2015-11-09 09:37:50', 13),
	(171, 'dantruong (3)564006fe2cc25.jpg', 0, 0, '2015-11-09 09:37:50', 13),
	(172, 'dantruong (4)564006fe2e19c.jpg', 0, 0, '2015-11-09 09:37:50', 13),
	(173, 'dantruong (5)564006fe2f8aa.jpg', 0, 0, '2015-11-09 09:37:50', 13),
	(174, 'dantruong (6)564006fe30c34.jpg', 0, 0, '2015-11-09 09:37:50', 13),
	(175, 'dantruong (7)564006fe327a4.jpg', 0, 0, '2015-11-09 09:37:50', 13),
	(176, 'dantruong (8)564006fe33f19.jpg', 0, 0, '2015-11-09 09:37:50', 13),
	(177, 'dantruong (9)564006fe35e83.jpg', 0, 0, '2015-11-09 09:37:50', 13),
	(178, 'dantruong (10)564006fe375c0.jpg', 0, 0, '2015-11-09 09:37:50', 13),
	(179, 'lyhai (11)5640073152ed8.jpg', 0, 0, '2015-11-09 09:38:41', 11),
	(180, 'lyhai (12)5640073154649.jpg', 0, 0, '2015-11-09 09:38:41', 11),
	(181, 'lyhai (13)56400731559da.jpg', 0, 0, '2015-11-09 09:38:41', 11),
	(182, 'lyhai (14)564007315714e.jpg', 0, 0, '2015-11-09 09:38:41', 11),
	(183, 'lyhai (15)56400731588c7.jpg', 0, 0, '2015-11-09 09:38:41', 11),
	(184, 'lyhai (16)564007315a425.jpg', 0, 0, '2015-11-09 09:38:41', 11),
	(185, 'lyhai (17)564007315bba4.jpg', 0, 0, '2015-11-09 09:38:41', 11),
	(186, 'lyhai (18)564007315d701.jpg', 0, 0, '2015-11-09 09:38:41', 11),
	(187, 'lyhai (19)564007315ea8f.jpg', 0, 0, '2015-11-09 09:38:41', 11),
	(188, 'lyhai (20)5640073160dc2.jpg', 0, 0, '2015-11-09 09:38:41', 11),
	(190, '9k=(5)564036ca10674.jpg', 0, 0, '2015-11-09 01:01:46', 6),
	(191, '9k=(6)564036ca119e2.jpg', 0, 0, '2015-11-09 01:01:46', 6),
	(192, '9k=(7)564036ca12d58.jpg', 0, 0, '2015-11-09 01:01:46', 6),
	(193, '9k=(8)564036ca1400a.jpg', 0, 0, '2015-11-09 01:01:46', 6),
	(194, '9k=564036ca1fd23.jpg', 0, 0, '2015-11-09 01:01:46', 6),
	(195, 'Z(4)564036ca20e8d.jpg', 0, 0, '2015-11-09 01:01:46', 6),
	(196, 'Z(5)564036ca21e5c.jpg', 0, 0, '2015-11-09 01:01:46', 6),
	(197, 'Z(6)564036ca239a0.jpg', 0, 0, '2015-11-09 01:01:46', 6),
	(198, 'Z564036ca24d5a.jpg', 0, 0, '2015-11-09 01:01:46', 6),
	(199, 'lyhai (4)56403ecc2e1e3.jpg', 0, 1, '2015-11-09 01:35:56', 2),
	(200, 'tangthanhha56403ecc2fb42.jpg', 0, 1, '2015-11-09 01:35:56', 2),
	(201, 'lamhung56403ecc3cc8a.jpg', 0, 0, '2015-11-09 01:35:56', 2),
	(202, 'dantruong (32)56403ecc3e012.jpg', 0, 0, '2015-11-09 01:35:56', 2),
	(203, 'dantruong (24)56403ecc3f78d.jpg', 0, 0, '2015-11-09 01:35:56', 2),
	(204, 'Untitled56403ecc40b12.png', 0, 1, '2015-11-09 01:35:56', 2),
	(205, 'hanquoc (91)56403ecc42e45.jpg', 0, 0, '2015-11-09 01:35:56', 2),
	(206, 'hanquoc (92)56403ecc441ce.jpg', 0, 0, '2015-11-09 01:35:56', 2),
	(207, 'hanquoc (33)5640421772d73.jpg', 0, 1, '2015-11-09 01:49:59', 2),
	(208, 'hanquoc (45)5640421774101.jpg', 0, 1, '2015-11-09 01:49:59', 2),
	(209, 'hanquoc (47)564042177587a.jpg', 0, 0, '2015-11-09 01:49:59', 2),
	(214, '2015-11-10_0905135642e01312d7e.jpg', 0, 0, '2015-11-11 01:28:35', 1),
	(215, 'Capture5642e05d81bd7.PNG', 0, 0, '2015-11-11 01:29:49', 1),
	(216, '24315642e0972846a.jpg', 0, 0, '2015-11-11 01:30:47', 1),
	(217, 'Capture15642e0be98266.PNG', 0, 0, '2015-11-11 01:31:26', 1);
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;


-- Dumping structure for function minh_nhut_lession_3.totalCommonFriend
DELIMITER //
CREATE DEFINER=`btwn2`@`172.16.%.%` FUNCTION `totalCommonFriend`(`idA` INT, `idB` INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE total int default 1;
	set total = 50;
	select count(*) into total
	from `user` 
	where `user`.id in 
		(
			select `user`.id from `user` where 
			`user`.id in  
			( 
				select `friend_relation`.user_id_to 
				from `user` inner join `friend_relation` 
				on `user`.id = `friend_relation`.user_id 
				where `friend_relation`.user_id = idA
			) 
			or
			`user`.id in 
			( 
				select `friend_relation`.user_id 
				from `user` inner join `friend_relation` 
				on `user`.id = `friend_relation`.user_id_to 
				where `friend_relation`.user_id_to = idA
			)
		)
	AND `user`.id not in (idA)
	AND `user`.id in ( 
								select `user`.id 
								from `user` 
								where `user`.id in 
									(
										select `user`.id from `user` where 
										`user`.id in  
										( 
											select `friend_relation`.user_id_to 
											from `user` inner join `friend_relation` 
											on `user`.id = `friend_relation`.user_id 
											where `friend_relation`.user_id = idB
										) 
										or
										`user`.id in 
										( 
											select `friend_relation`.user_id 
											from `user` inner join `friend_relation` 
											on `user`.id = `friend_relation`.user_id_to 
											where `friend_relation`.user_id_to = idB 
										)
									)
								AND `user`.id not in (idB) 
							);
	return total;
END//
DELIMITER ;


-- Dumping structure for table minh_nhut_lession_3.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL auto_increment,
  `username` varchar(40) collate utf8_unicode_ci NOT NULL,
  `password` varchar(32) collate utf8_unicode_ci NOT NULL,
  `fullname` varchar(32) collate utf8_unicode_ci NOT NULL,
  `sex` tinyint(1) NOT NULL default '1',
  `birthday` date default NULL,
  `address` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `introduction` text collate utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) collate utf8_unicode_ci NOT NULL,
  `email` varchar(40) collate utf8_unicode_ci NOT NULL default '',
  `group_id` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `FK_user_group` (`group_id`),
  CONSTRAINT `FK_user_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.user: ~13 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `sex`, `birthday`, `address`, `introduction`, `avatar`, `email`, `group_id`) VALUES
	(1, 'comboyin', 'e10adc3949ba59abbe56e057f20f883e', '<input>', 1, '2015-07-05', '9/8/17 nguyen si co quan 8', 'asd asjnsdf dsajkfb dskafbsdjabf jksdabf kjsdbfk jbsdfkj bdsakjf bsdjkfabsjdka bfasdkj bfksjadfb askjdfb k\r\n\r\n<input>', '1410536171605642dfaedbe51.jpg', 'input1@gmail.com', 1),
	(2, 'comboyinA', 'e10adc3949ba59abbe56e057f20f883e', 'comboyin A', 1, '2015-10-23', 'Lý Thái Tổ, tp hồ chí minh', ' asd asd as fsdagdg afdg fdagfd gdfgg', 'dantruong (12)5640425086d7e.jpg', 'asdasdasdas@gmail.com', 2),
	(3, 'sontung', 'e10adc3949ba59abbe56e057f20f883e', 'Sơn Tùng MTP', 1, '1992-01-01', 'Thái Bình', 'jh sdfbjhasdv fjhdsvaf jhsadvfjhasv', '2015-10-26_154102562de70cc8fdd.jpg', 'sontung@gmail.com', 2),
	(4, 'camly', 'e10adc3949ba59abbe56e057f20f883e', 'Cẩm Ly', 0, '1980-01-01', 'tp cao lanh, tỉnh Đồng tháp', 'asdasdasd asdad asd a d asd a d asd a', 'cam-ly-2562de896830c8.jpg', 'camly@gmail.com', 2),
	(5, 'khoimy', 'e10adc3949ba59abbe56e057f20f883e', 'Khởi my', 0, '1991-03-03', 'Ở đâu', 'ádasdasdasdasda', 'Untitled562efd221261e.png', 'đâsdasđ@gmail.com', 2),
	(6, 'miule', 'e10adc3949ba59abbe56e057f20f883e', 'Miu lê', 0, '1981-10-26', 'An giang', 'ádasdaskbdaksjbdakjs', '2015-10-26_152632562de3a15ebe5.jpg', 'miule@gmail.com', 2),
	(7, 'hoailinh', 'e10adc3949ba59abbe56e057f20f883e', 'hoài linh', 1, '2015-10-27', 'miền tây', 'sfasfsdf sdafsd', 'hoailinh5632caa6ccb71.jpg', 'hoailinh@gmail.com', 2),
	(8, 'tangthanhha', 'e10adc3949ba59abbe56e057f20f883e', 'Tăng thanh hà', 1, '2015-11-09', 'Tiền giang', 'ajdksf bksjad bfksadj fbaksjd b', 'tangthanhha5640080612520.jpg', 'tangthanhha@gmail.com', 2),
	(9, 'lamhung', 'e10adc3949ba59abbe56e057f20f883e', 'lâm hùng', 1, '2015-10-27', 'Trần Hưng Đạo, tp hồ chí minh', 'ádasdasdasdasdasd', 'lamhung564007be5cc5a.jpg', 'lamhung@gmail.com', 2),
	(10, 'nguyenthehung', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thế Hùng', 1, '2015-10-27', 'Trần Hưng Đạo, tp hồ chí minh', 'ádasdasdasdasdasd', 'thehung (7)5640068a69b7a.jpg', 'nguyenthehung@gmail.com', 2),
	(11, 'lyhai', 'e10adc3949ba59abbe56e057f20f883e', 'lý hải', 1, '2015-10-27', 'nguyễn trãi, tp hồ chí minh', 'ádasdasdasdasdasd', 'lyhai (10)56403e1660620.jpg', 'lyhai@gmail.com', 2),
	(12, 'meo', 'e10adc3949ba59abbe56e057f20f883e', 'con mèo', 0, '2015-07-23', 'Ngô Quyền, Thọ Quang, Sơn Trà, Đà Nẵng, Vietnam', '<input type="text">', '2015-11-10_0900245642b8fbe1411.jpg', 'meomeo1@gmail.com', 2),
	(13, 'dantruong', 'e10adc3949ba59abbe56e057f20f883e', '<input>', 1, '1992-11-03', '61 Nguyễn Trãi, Phường 1, tp. Cao Lãnh, Đồng Tháp, Vietnam', 'ádasdasdasdasdasd', 'dantruong (13)5642ab48ee780.jpg', 'dantruong@gmail.com', 2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for trigger minh_nhut_lession_3.friend_relation_log_after_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `friend_relation_log_after_delete` AFTER DELETE ON `friend_relation` FOR EACH ROW BEGIN
 
  	CALL log_un_friend( OLD.user_id    , OLD.user_id_to );
	CALL log_un_friend( OLD.user_id_to , OLD.user_id );
	
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger minh_nhut_lession_3.friend_relation_log_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `friend_relation_log_before_insert` AFTER INSERT ON `friend_relation` FOR EACH ROW BEGIN
	CALL log_add_friend( NEW.user_id    , NEW.user_id_to );
	CALL log_add_friend( NEW.user_id_to , NEW.user_id    );
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger minh_nhut_lession_3.friend_request_log_follow_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `friend_request_log_follow_after_insert` AFTER INSERT ON `friend_request` FOR EACH ROW BEGIN
 DECLARE v_finished INTEGER DEFAULT 0;
 DECLARE id_follow_temp INTEGER;
 DECLARE cur_follow CURSOR FOR SELECT follow.id FROM follow WHERE follow.user_id_to = NEW.user_id;

 -- declare NOT FOUND handler
 DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET v_finished = 1;

	OPEN cur_follow;
	 
		 loop_follow: LOOP
		 
			 FETCH cur_follow INTO id_follow_temp;
			 
			 IF v_finished = 1 THEN 
			 	LEAVE loop_follow;
			 END IF;
			 
			 SET @action = ' Send request to ';
			 INSERT INTO follow_log ( follow_id,`action`,userid_to, regist_datetime )
			 					VALUES ( id_follow_temp, @action , NEW.user_id_to , NOW() );
			 	 
		 END LOOP loop_follow;
		 
	CLOSE cur_follow;
	
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger minh_nhut_lession_3.like_after_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `like_after_delete` AFTER DELETE ON `like` FOR EACH ROW BEGIN
	 
	 DECLARE v_finished INTEGER DEFAULT 0;
	 DECLARE id_follow_temp INTEGER;
	 DECLARE cur_follow CURSOR FOR SELECT follow.id FROM follow WHERE follow.user_id_to = OLD.user_id;
	 -- declare NOT FOUND handler
	 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
	 SELECT picture.user_id INTO @userid_to FROM picture WHERE picture.id = OLD.pictures_id   ;
	 SELECT picture.url     INTO @url_picture FROM picture WHERE picture.id = OLD.pictures_id ;
		
		OPEN cur_follow;
		 
			 loop_follow: LOOP
			 
				 FETCH cur_follow INTO id_follow_temp;
				 
				 IF v_finished = 1 THEN 
				 	LEAVE loop_follow;
				 END IF;
				 
				 SET @action = CONCAT(' unLike picture "', @url_picture , '" of ' );
				 INSERT INTO follow_log ( follow_id,`action`,userid_to, regist_datetime )
				 					VALUES ( id_follow_temp, @action , @userid_to , NOW() );
				 	 
			 END LOOP loop_follow;
			 
		CLOSE cur_follow;

	SET @id_picture = OLD.pictures_id;
	SELECT count(*) into @like_number FROM `like` WHERE `like`.pictures_id = @id_picture ;
	UPDATE picture set picture.like_number = @like_number WHERE picture.id = @id_picture;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger minh_nhut_lession_3.like_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `like_after_insert` AFTER INSERT ON `like` FOR EACH ROW BEGIN

 DECLARE v_finished INTEGER DEFAULT 0;
 DECLARE id_follow_temp INTEGER;
 DECLARE cur_follow CURSOR FOR SELECT follow.id FROM follow WHERE follow.user_id_to = NEW.user_id;
 -- declare NOT FOUND handler
 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
 SELECT picture.user_id INTO @userid_to FROM picture WHERE picture.id = NEW.pictures_id   ;
 SELECT picture.url     INTO @url_picture FROM picture WHERE picture.id = NEW.pictures_id ;
	OPEN cur_follow;
	 
		 loop_follow: LOOP
		 
			 FETCH cur_follow INTO id_follow_temp;
			 
			 IF v_finished = 1 THEN 
			 	LEAVE loop_follow;
			 END IF;
			 
			 SET @action = CONCAT(' Like picture "', @url_picture , '" of ' );
			 INSERT INTO follow_log ( follow_id,`action`,userid_to, regist_datetime )
			 					VALUES ( id_follow_temp, @action , @userid_to , NOW() );
			 	 
		 END LOOP loop_follow;
		 
	CLOSE cur_follow;
	
	
  SET @id_picture = NEW.pictures_id;
  SELECT count(*) into @like_number FROM `like` WHERE `like`.pictures_id = @id_picture ;
  UPDATE picture set picture.like_number = @like_number WHERE picture.id = @id_picture;

END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.favorite: ~0 rows (approximately)
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.follow: ~0 rows (approximately)
/*!40000 ALTER TABLE `follow` DISABLE KEYS */;
/*!40000 ALTER TABLE `follow` ENABLE KEYS */;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.friend_relation: ~0 rows (approximately)
/*!40000 ALTER TABLE `friend_relation` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.friend_request: ~0 rows (approximately)
/*!40000 ALTER TABLE `friend_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `friend_request` ENABLE KEYS */;


-- Dumping structure for table minh_nhut_lession_3.group
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) NOT NULL auto_increment,
  `level` tinyint(1) NOT NULL default '3',
  `name` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `regist_datetime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.group: ~1 rows (approximately)
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`id`, `level`, `name`, `regist_datetime`) VALUES
	(1, 1, 'Admin', '2015-10-15 10:23:31');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;


-- Dumping structure for table minh_nhut_lession_3.like
CREATE TABLE IF NOT EXISTS `like` (
  `id` int(10) NOT NULL auto_increment,
  `user_id` int(10) NOT NULL,
  `pictures_id` int(10) NOT NULL,
  PRIMARY KEY  (`id`,`user_id`,`pictures_id`),
  KEY `FK_like_user` (`user_id`),
  KEY `FK_like_pictures` (`pictures_id`),
  CONSTRAINT `FK_like_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_like_pictures` FOREIGN KEY (`pictures_id`) REFERENCES `pictures` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.like: ~0 rows (approximately)
/*!40000 ALTER TABLE `like` DISABLE KEYS */;
/*!40000 ALTER TABLE `like` ENABLE KEYS */;


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


-- Dumping structure for table minh_nhut_lession_3.pictures
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(10) NOT NULL auto_increment,
  `url` text collate utf8_unicode_ci,
  `view` int(10) NOT NULL default '0',
  `like_number` int(10) NOT NULL default '0',
  `regist_datetime` datetime default NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_pictures_user` (`user_id`),
  CONSTRAINT `FK_pictures_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.pictures: ~0 rows (approximately)
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;


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
  `email` varchar(40) collate utf8_unicode_ci NOT NULL default '',
  `group_id` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `FK_user_group` (`group_id`),
  CONSTRAINT `FK_user_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `sex`, `birthday`, `address`, `introduction`, `email`, `group_id`) VALUES
	(1, 'comboyin', 'e10adc3949ba59abbe56e057f20f883e', 'Tran Minh Nhut', 1, '2015-10-15', '61 nguyen trai', 'asd asjnsdf dsajkfb dskafbsdjabf jksdabf kjsdbfk jbsdfkj bdsakjf bsdjkfabsjdka bfasdkj bfksjadfb askjdfb k', 'comboyin1@gmail.com', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

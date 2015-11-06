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
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.favorite: ~5 rows (approximately)
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
INSERT INTO `favorite` (`id`, `user_id`, `user_id_to`, `regist_datetime`) VALUES
	(29, 7, 5, '2015-11-02 02:01:06'),
	(30, 7, 8, '2015-11-02 15:33:15'),
	(112, 1, 5, '2015-11-02 05:12:19'),
	(118, 5, 2, '2015-11-03 04:31:54'),
	(119, 8, 1, '2015-11-05 11:17:46');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.follow: ~5 rows (approximately)
/*!40000 ALTER TABLE `follow` DISABLE KEYS */;
INSERT INTO `follow` (`id`, `user_id`, `user_id_to`, `regist_datetime`) VALUES
	(1, 1, 4, '2015-11-03 09:32:00'),
	(2, 5, 1, '2015-11-03 09:32:24'),
	(3, 7, 1, '2015-11-03 11:13:47'),
	(4, 8, 1, '2015-11-05 11:17:43'),
	(5, 1, 5, '2015-11-06 09:36:12');
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
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- Dumping data for table minh_nhut_lession_3.follow_log: ~98 rows (approximately)
/*!40000 ALTER TABLE `follow_log` DISABLE KEYS */;
INSERT INTO `follow_log` (`id`, `follow_id`, `action`, `userid_to`, `status`, `regist_datetime`) VALUES
	(1, 2, ' Send request to ', 5, 1, '2015-11-03 11:12:48'),
	(2, 3, ' Send request to ', 5, 0, '2015-11-03 11:12:48'),
	(3, 2, ' Send request to ', 3, 1, '2015-11-03 11:14:14'),
	(4, 3, ' Send request to ', 3, 0, '2015-11-03 11:14:14'),
	(5, 2, ' Unrequest to ', 5, 1, '2015-11-03 11:12:48'),
	(6, 3, ' Unrequest to ', 5, 0, '2015-11-03 11:12:48'),
	(7, 2, ' Like picture khoi-my-34562f444e8471d.jpg of 5', 5, 1, '2015-11-03 11:43:19'),
	(8, 3, ' Like picture khoi-my-34562f444e8471d.jpg of 5', 5, 0, '2015-11-03 11:43:19'),
	(9, 2, ' Like picture son tung (1)562de6b646065.jpg of ', 3, 1, '2015-11-03 07:15:48'),
	(10, 3, ' Like picture son tung (1)562de6b646065.jpg of ', 3, 0, '2015-11-03 07:15:48'),
	(11, 2, ' unLike picture son tung (1)562de6b646065.jpg of ', 3, 1, '2015-11-03 07:18:25'),
	(12, 3, ' unLike picture son tung (1)562de6b646065.jpg of ', 3, 0, '2015-11-03 07:18:25'),
	(15, 2, ' Friend of ', 2, 1, '2015-11-03 09:05:50'),
	(16, 3, ' Friend of ', 2, 0, '2015-11-03 09:05:50'),
	(17, 2, ' NOT friend of ', 2, 1, '2015-11-03 09:14:17'),
	(18, 3, ' NOT friend of ', 2, 0, '2015-11-03 09:14:17'),
	(19, 2, ' unLike picture "khoi-my-34562f444e8471d.jpg" of ', 5, 1, '2015-11-03 09:21:44'),
	(20, 3, ' unLike picture "khoi-my-34562f444e8471d.jpg" of ', 5, 0, '2015-11-03 09:21:44'),
	(21, 2, ' Like picture "son tung (4)562de6b657065.jpg" of ', 3, 1, '2015-11-03 09:22:12'),
	(22, 3, ' Like picture "son tung (4)562de6b657065.jpg" of ', 3, 0, '2015-11-03 09:22:12'),
	(23, 2, ' unLike picture "son tung (4)562de6b657065.jpg" of ', 3, 1, '2015-11-03 09:22:52'),
	(24, 3, ' unLike picture "son tung (4)562de6b657065.jpg" of ', 3, 0, '2015-11-03 09:22:52'),
	(25, 1, ' Friend of ', 8, 1, '2015-11-03 10:51:10'),
	(26, 2, ' Send request to ', 8, 1, '2015-11-03 12:04:44'),
	(27, 3, ' Send request to ', 8, 0, '2015-11-03 12:04:44'),
	(28, 2, ' Friend of ', 6, 1, '2015-11-03 12:07:05'),
	(29, 3, ' Friend of ', 6, 0, '2015-11-03 12:07:05'),
	(30, 2, ' NOT friend of ', 7, 1, '2015-11-03 12:11:32'),
	(31, 3, ' NOT friend of ', 7, 0, '2015-11-03 12:11:32'),
	(32, 2, ' NOT friend of ', 8, 1, '2015-11-03 12:11:32'),
	(33, 3, ' NOT friend of ', 8, 0, '2015-11-03 12:11:32'),
	(34, 2, ' NOT friend of ', 5, 1, '2015-11-03 12:11:32'),
	(35, 3, ' NOT friend of ', 5, 0, '2015-11-03 12:11:32'),
	(36, 2, ' NOT friend of ', 6, 1, '2015-11-03 12:11:32'),
	(37, 3, ' NOT friend of ', 6, 0, '2015-11-03 12:11:32'),
	(38, 1, ' NOT friend of ', 8, 1, '2015-11-03 12:11:32'),
	(39, 2, ' Like picture "20150926131009_wPpZsOz1Hd5629ba408ca07.jpg" of ', 1, 1, '2015-11-03 12:55:49'),
	(40, 3, ' Like picture "20150926131009_wPpZsOz1Hd5629ba408ca07.jpg" of ', 1, 0, '2015-11-03 12:55:49'),
	(41, 2, ' unLike picture "20150926131009_wPpZsOz1Hd5629ba408ca07.jpg" of ', 1, 1, '2015-11-03 12:55:54'),
	(42, 3, ' unLike picture "20150926131009_wPpZsOz1Hd5629ba408ca07.jpg" of ', 1, 0, '2015-11-03 12:55:54'),
	(43, 2, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 1, '2015-11-03 12:55:57'),
	(44, 3, ' Like picture "20150609154933_ZaSEynrddh5629b984b51d0.jpg" of ', 1, 0, '2015-11-03 12:55:57'),
	(45, 1, ' Send request to ', 8, 1, '2015-11-04 03:25:52'),
	(46, 2, ' Friend of ', 2, 1, '2015-11-04 05:24:16'),
	(47, 3, ' Friend of ', 2, 0, '2015-11-04 05:24:16'),
	(48, 2, ' Friend of ', 5, 1, '2015-11-04 05:24:28'),
	(49, 3, ' Friend of ', 5, 0, '2015-11-04 05:24:28'),
	(50, 2, ' Friend of ', 8, 1, '2015-11-04 05:24:37'),
	(51, 3, ' Friend of ', 8, 0, '2015-11-04 05:24:37'),
	(52, 2, ' Friend of ', 3, 1, '2015-11-04 07:03:36'),
	(53, 3, ' Friend of ', 3, 0, '2015-11-04 07:03:36'),
	(54, 2, ' Friend of ', 3, 1, '2015-11-04 07:05:06'),
	(55, 3, ' Friend of ', 3, 0, '2015-11-04 07:05:06'),
	(56, 2, ' NOT friend of ', 8, 1, '2015-11-05 00:28:36'),
	(57, 3, ' NOT friend of ', 8, 0, '2015-11-05 00:28:36'),
	(58, 1, ' Friend of ', 8, 1, '2015-11-05 06:12:51'),
	(59, 1, ' NOT friend of ', 8, 1, '2015-11-05 06:13:31'),
	(60, 1, ' Send request to ', 1, 1, '2015-11-05 06:45:33'),
	(61, 1, ' Friend of ', 1, 1, '2015-11-05 06:45:42'),
	(62, 2, ' Friend of ', 4, 1, '2015-11-05 06:45:42'),
	(63, 3, ' Friend of ', 4, 0, '2015-11-05 06:45:42'),
	(64, 2, ' NOT friend of ', 5, 1, '2015-11-05 06:48:20'),
	(65, 3, ' NOT friend of ', 5, 0, '2015-11-05 06:48:20'),
	(66, 4, ' NOT friend of ', 5, 1, '2015-11-05 06:48:20'),
	(67, 2, ' Like picture "son tung (9)562de6d0b22ea.jpg" of ', 3, 1, '2015-11-05 12:31:29'),
	(68, 3, ' Like picture "son tung (9)562de6d0b22ea.jpg" of ', 3, 0, '2015-11-05 12:31:29'),
	(69, 4, ' Like picture "son tung (9)562de6d0b22ea.jpg" of ', 3, 0, '2015-11-05 12:31:29'),
	(70, 1, ' NOT friend of ', 1, 1, '2015-11-06 05:03:35'),
	(71, 2, ' NOT friend of ', 4, 1, '2015-11-06 05:03:35'),
	(72, 3, ' NOT friend of ', 4, 0, '2015-11-06 05:03:35'),
	(73, 4, ' NOT friend of ', 4, 0, '2015-11-06 05:03:35'),
	(74, 2, ' Send request to ', 4, 1, '2015-11-06 05:05:17'),
	(75, 3, ' Send request to ', 4, 0, '2015-11-06 05:05:17'),
	(76, 4, ' Send request to ', 4, 0, '2015-11-06 05:05:17'),
	(77, 2, ' Friend of ', 4, 1, '2015-11-06 05:05:25'),
	(78, 3, ' Friend of ', 4, 0, '2015-11-06 05:05:25'),
	(79, 4, ' Friend of ', 4, 0, '2015-11-06 05:05:25'),
	(80, 1, ' Friend of ', 1, 1, '2015-11-06 05:05:25'),
	(81, 5, ' Like picture "son tung (2)562de6b648399.jpg" of ', 3, 1, '2015-11-06 05:07:20'),
	(82, 5, ' Like picture "son tung (3)562de6b649efa.jpg" of ', 3, 1, '2015-11-06 05:07:23'),
	(83, 2, ' Like picture "20150610150935_v60K13tmTj5629b5388b34d.jpg" of ', 1, 1, '2015-11-06 07:19:04'),
	(84, 3, ' Like picture "20150610150935_v60K13tmTj5629b5388b34d.jpg" of ', 1, 0, '2015-11-06 07:19:04'),
	(85, 4, ' Like picture "20150610150935_v60K13tmTj5629b5388b34d.jpg" of ', 1, 0, '2015-11-06 07:19:04'),
	(86, 5, ' NOT friend of ', 3, 0, '2015-11-06 07:20:10'),
	(87, 5, ' Send request to ', 1, 0, '2015-11-06 07:20:19'),
	(88, 5, ' Friend of ', 1, 0, '2015-11-06 07:20:25'),
	(89, 2, ' Friend of ', 5, 1, '2015-11-06 07:20:25'),
	(90, 3, ' Friend of ', 5, 0, '2015-11-06 07:20:25'),
	(91, 4, ' Friend of ', 5, 0, '2015-11-06 07:20:25'),
	(92, 5, ' NOT friend of ', 8, 0, '2015-11-06 07:22:02'),
	(93, 5, ' NOT friend of ', 2, 0, '2015-11-06 07:22:04'),
	(94, 5, ' Send request to ', 8, 0, '2015-11-06 07:22:17'),
	(95, 5, ' Friend of ', 8, 0, '2015-11-06 07:22:46'),
	(96, 5, ' NOT friend of ', 8, 0, '2015-11-06 10:06:03'),
	(97, 5, ' Friend of ', 8, 0, '2015-11-06 10:08:18'),
	(98, 5, ' NOT friend of ', 8, 0, '2015-11-06 10:08:50'),
	(99, 5, ' Friend of ', 8, 0, '2015-11-06 10:11:47'),
	(100, 5, ' NOT friend of ', 8, 0, '2015-11-06 10:11:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.friend_relation: ~5 rows (approximately)
/*!40000 ALTER TABLE `friend_relation` DISABLE KEYS */;
INSERT INTO `friend_relation` (`id`, `user_id`, `user_id_to`, `regist_datetime`) VALUES
	(28, 1, 2, '2015-11-04 09:54:03'),
	(33, 1, 3, '2015-11-04 11:33:37'),
	(34, 2, 3, '2015-11-04 11:33:36'),
	(39, 1, 4, '2015-11-06 09:34:24'),
	(40, 5, 1, '2015-11-06 11:49:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.friend_request: ~0 rows (approximately)
/*!40000 ALTER TABLE `friend_request` DISABLE KEYS */;
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
		
		BLOCK3: begin
				DECLARE idUserFriend int;
				DECLARE no_more_rows3 bool default FALSE;
				DECLARE numberLoop3 integer default -1;
				DECLARE cursor3 CURSOR FOR
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
				declare continue handler for not found set no_more_rows3 = TRUE;
				open cursor3;
				LOOP3: loop
					fetch cursor3 into idUserFriend;
					if no_more_rows3 then
						close cursor3;
						leave LOOP3;
					end if;
					-- insert to tmp table
					call insert_friend_of_friend(idUser, idUserFriend, nameTableTemp);
				end loop LOOP3;
											
		end BLOCK3;
		
		
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
											`user`.id not in ( select `friend_request`.user_id from `friend_request` where `friend_request`.user_id_to = '{idA}' )
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
			AND is_friend(`user`.id, {idA}) = 0 ;
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
				`user`.id not in ( select `friend_request`.user_id from `friend_request` where `friend_request`.user_id_to = '{idA}' )
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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.like: ~20 rows (approximately)
/*!40000 ALTER TABLE `like` DISABLE KEYS */;
INSERT INTO `like` (`id`, `user_id`, `pictures_id`, `time_like`) VALUES
	(63, 6, 121, '0000-00-00 00:00:00'),
	(64, 6, 122, '0000-00-00 00:00:00'),
	(65, 6, 123, '0000-00-00 00:00:00'),
	(66, 6, 124, '0000-00-00 00:00:00'),
	(67, 6, 113, '0000-00-00 00:00:00'),
	(68, 6, 114, '0000-00-00 00:00:00'),
	(69, 6, 115, '0000-00-00 00:00:00'),
	(70, 6, 119, '0000-00-00 00:00:00'),
	(71, 6, 118, '0000-00-00 00:00:00'),
	(72, 6, 117, '0000-00-00 00:00:00'),
	(73, 5, 92, '0000-00-00 00:00:00'),
	(74, 5, 96, '0000-00-00 00:00:00'),
	(75, 7, 138, '0000-00-00 00:00:00'),
	(80, 1, 92, '0000-00-00 00:00:00'),
	(81, 1, 133, '0000-00-00 00:00:00'),
	(82, 5, 125, '0000-00-00 00:00:00'),
	(83, 5, 128, '0000-00-00 00:00:00'),
	(84, 5, 126, '0000-00-00 00:00:00'),
	(85, 5, 127, '0000-00-00 00:00:00'),
	(86, 1, 89, '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut_lession_3.picture: ~56 rows (approximately)
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` (`id`, `url`, `view`, `like_number`, `regist_datetime`, `user_id`) VALUES
	(89, '20150610150935_v60K13tmTj5629b5388b34d.jpg', 0, 1, '2015-10-23 11:19:04', 1),
	(92, '20150609154933_ZaSEynrddh5629b984b51d0.jpg', 1, 2, '2015-10-23 11:37:24', 1),
	(96, '20150926131009_wPpZsOz1Hd5629ba408ca07.jpg', 1, 1, '2015-10-23 11:40:32', 1),
	(99, '20150926122918_nv3r3lhqWn5629dc187624f.jpg', 0, 0, '2015-10-23 02:04:56', 1),
	(100, '20150926131009_wPpZsOz1Hd5629dc18775df.jpg', 0, 0, '2015-10-23 02:04:56', 1),
	(101, '20150928085512_BVCnzRU2iy5629dc1878965.jpg', 3, 0, '2015-10-23 02:04:56', 1),
	(102, '20150928150023_oQX6EEW7sC5629dc187a0e8.jpg', 0, 0, '2015-10-23 02:04:56', 1),
	(103, '20150928172425_im4tqkRmlj5629dc187b469.jpg', 0, 0, '2015-10-23 02:04:56', 1),
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
	(121, 'Z(4)562de5fb7a876.jpg', 4, 1, '2015-10-26 03:36:11', 6),
	(122, 'Z(5)562de5fb7b81a.jpg', 5, 1, '2015-10-26 03:36:11', 6),
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
	(136, 'hinh-khoi-my-13562f444e7c160.jpg', 0, 0, '2015-10-27 04:30:54', 5),
	(137, 'hinh-khoi-my-14562f444e7d5b1.jpg', 0, 0, '2015-10-27 04:30:54', 5),
	(138, 'hinh-khoi-my-15562f444e7ed28.jpg', 0, 1, '2015-10-27 04:30:54', 5),
	(140, 'hinh-khoi-my-17562f444e81836.jpg', 0, 0, '2015-10-27 04:30:54', 5),
	(141, 'khoi-my-33562f444e82fa5.jpg', 0, 0, '2015-10-27 04:30:54', 5),
	(142, 'khoi-my-34562f444e8471d.jpg', 0, 0, '2015-10-27 04:30:54', 5),
	(144, 'meo (2)563c70c7ee870.jpg', 0, 0, '2015-11-06 04:20:08', 12),
	(146, 'meo (4)563c70c7f2190.jpg', 0, 0, '2015-11-06 04:20:08', 12),
	(147, 'meo (5)563c70c801198.jpg', 0, 0, '2015-11-06 04:20:08', 12),
	(148, 'meo (6)563c70c80290f.jpg', 0, 0, '2015-11-06 04:20:08', 12),
	(149, 'meo (7)563c70c803f2c.jpg', 0, 0, '2015-11-06 04:20:08', 12),
	(150, 'meo (8)563c70c805a1d.jpg', 0, 0, '2015-11-06 04:20:08', 12),
	(151, 'meo (9)563c70c806dfd.jpg', 0, 0, '2015-11-06 04:20:08', 12),
	(152, 'meo (10)563c70c808569.jpg', 0, 0, '2015-11-06 04:20:08', 12),
	(154, 'meo (31)563c71e04ec46.jpg', 0, 0, '2015-11-06 04:24:48', 12),
	(156, 'meo (21)563c7b758ac12.jpg', 0, 0, '2015-11-06 05:05:41', 12),
	(157, 'meo (22)563c7b758c38b.jpg', 0, 0, '2015-11-06 05:05:41', 12),
	(158, 'meo (23)563c7b758def1.jpg', 0, 0, '2015-11-06 05:05:41', 12);
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

-- Dumping data for table minh_nhut_lession_3.user: ~12 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `sex`, `birthday`, `address`, `introduction`, `avatar`, `email`, `group_id`) VALUES
	(1, 'comboyin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 0, '1992-11-03', '61 nguyễn trãi, phường 1, tp cao lãnh, tỉnh đồng tháp', 'asd asjnsdf dsajkfb dskafbsdjabf jksdabf kjsdbfk jbsdfkj bdsakjf bsdjkfabsjdka bfasdkj bfksjadfb askjdfb k', 'administrator562df010ec4cd.png', 'admin@gmail.com', 1),
	(2, 'comboyinA', 'e10adc3949ba59abbe56e057f20f883e', 'Lê văn tám mươi chín', 1, '2015-10-23', 'asda sdas dasd', ' asd asd as fsdagdg afdg fdagfd gdfgg', '14321203052562a063dc2c6c.jpg', 'asdasdasdas@gmail.com', 2),
	(3, 'sontung', 'e10adc3949ba59abbe56e057f20f883e', 'Sơn Tùng MTP', 1, '1992-01-01', 'Thái Bình', 'jh sdfbjhasdv fjhdsvaf jhsadvfjhasv', '2015-10-26_154102562de70cc8fdd.jpg', 'sontung@gmail.com', 2),
	(4, 'camly', 'e10adc3949ba59abbe56e057f20f883e', 'Cẩm Ly', 0, '1980-01-01', 'tp cao lanh, tỉnh Đồng tháp', 'asdasdasd asdad asd a d asd a d asd a', 'cam-ly-2562de896830c8.jpg', 'camly@gmail.com', 2),
	(5, 'khoimy', 'e10adc3949ba59abbe56e057f20f883e', 'Khởi my', 0, '1991-03-03', 'Ở đâu', 'ádasdasdasdasda', 'Untitled562efd221261e.png', 'đâsdasđ@gmail.com', 2),
	(6, 'miule', 'e10adc3949ba59abbe56e057f20f883e', 'Miu lê', 0, '1981-10-26', 'An giang', 'ádasdaskbdaksjbdakjs', '2015-10-26_152632562de3a15ebe5.jpg', 'miule@gmail.com', 2),
	(7, 'hoailinh', 'e10adc3949ba59abbe56e057f20f883e', 'hoài linh', 1, '2015-10-27', 'miền tây', 'sfasfsdf sdafsd', 'hoailinh5632caa6ccb71.jpg', 'hoailinh@gmail.com', 2),
	(9, 'lamhung', 'e10adc3949ba59abbe56e057f20f883e', 'lâm hùng', 1, '2015-10-27', 'Trần Hưng Đạo, tp hồ chí minh', 'ádasdasdasdasdasd', '2015-10-27_113648562efdc6107c8.jpg', 'lamhung@gmail.com', 2),
	(10, 'nguyenthehung', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thế Hùng', 1, '2015-10-27', 'Trần Hưng Đạo, tp hồ chí minh', 'ádasdasdasdasdasd', '2015-10-27_113648562efdc6107c8.jpg', 'nguyenthehung@gmail.com', 2),
	(11, 'lyhai', 'e10adc3949ba59abbe56e057f20f883e', 'lý hải', 1, '2015-10-27', 'Trần Hưng Đạo, tp hồ chí minh', 'ádasdasdasdasdasd', '2015-10-27_113648562efdc6107c8.jpg', 'lyhai@gmail.com', 2),
	(12, 'meo', 'e10adc3949ba59abbe56e057f20f883e', 'meomeo', 1, '2015-10-27', 'Trần Hưng Đạo, tp hồ chí minh', 'Meo meo meo meo meo mèo mèo mèo mèo ', 'meo (33)563c707de726c.jpg', 'meomeo@gmail.com', 2),
	(13, 'dantruong', 'e10adc3949ba59abbe56e057f20f883e', 'Đan trường', 1, '2015-10-27', 'Trần Hưng Đạo, tp hồ chí minh', 'ádasdasdasdasdasd', '2015-10-27_113648562efdc6107c8.jpg', 'dantruong@gmail.com', 2);
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

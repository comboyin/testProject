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

-- Dumping structure for table minh_nhut.account
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) collate utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `lastname` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `password` varchar(64) collate utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` tinyint(1) NOT NULL default '0',
  `address` text collate utf8_unicode_ci NOT NULL,
  `avatar` text collate utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut.account: ~6 rows (approximately)
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`id`, `username`, `firstname`, `lastname`, `password`, `birthday`, `gender`, `address`, `avatar`, `type`) VALUES
	(1, 'comboyin', 'dầ dfadsfa', 'dsfasdsdafs', '202cb962ac59075b964b07152d234b70', '1948-06-06', 0, 'dsf asd fasfasd fas', '560c8942bef8dprofile.png', 1),
	(3, 'comboyin1', 'Tran Minh', 'Nhut', '202cb962ac59075b964b07152d234b70', '1992-11-03', 0, '61 nguyen trai', 'cat56113e6f487f5.jpg', 0),
	(4, 'comboyin3', 'Tran', 'Minh', 'a485da85aca70817b66e1859e17c2ae9', '1991-11-01', 1, '61 nguyen trai', 'cat5610eab1e9c4d.jpg', 0),
	(7, 'comboyin7', 'Tran', 'Minh nhut', 'a485da85aca70817b66e1859e17c2ae9', '1992-04-04', 0, '61 nguyen thuat', '20150609153157_Mi6MbSBz6W5611f4dee3ea0.jpg', 0),
	(8, 'comboyin14', 'Nhut', 'Tram', 'a485da85aca70817b66e1859e17c2ae9', '2015-10-05', 1, '61 nguyen trai', '20150613112323_x7sRvbvpXy5612205378e46.jpg', 0),
	(9, 'comboyin15', 'Tran Minh', 'Nhut', 'e10adc3949ba59abbe56e057f20f883e', '2015-10-04', 0, '61 nguyen trai', 'Untitled56123701def5b.png', 0);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;


-- Dumping structure for table minh_nhut.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `url` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `parent_id` int(11) default NULL,
  `sort_order` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut.category: ~4 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`, `url`, `parent_id`, `sort_order`) VALUES
	(1, 'Mỹ phẩm', '', NULL, 0),
	(2, 'Quần áo', '', NULL, 1),
	(3, 'Túi xách', '', NULL, 2),
	(4, 'Giày dép', '', NULL, 3);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


-- Dumping structure for table minh_nhut.order
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `phone` varchar(11) NOT NULL default '0',
  `totalprice` int(11) NOT NULL default '0',
  `createtime` datetime NOT NULL,
  `email` varchar(50) NOT NULL,
  `idorder` varchar(50) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `idorder` (`idorder`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- Dumping data for table minh_nhut.order: ~22 rows (approximately)
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` (`id`, `name`, `phone`, `totalprice`, `createtime`, `email`, `idorder`) VALUES
	(70, 'Tran Minh nhut', '01886222208', 200000, '2015-10-12 10:30:49', 'trannhut@gmail.com', 'MHD1'),
	(71, 'tran minh kkkk', '1886222209', 200000, '2015-10-12 09:10:00', '', 'MHD71'),
	(72, 'tran minh kkkk', '1886222209', 200000, '2015-10-12 09:10:00', 'trannhut031192@gmail.com', 'MHD72'),
	(73, 'Tran minh', '01886222209', 200000, '2015-10-12 01:18:09', 'trannhut031192@gmail.com', 'MHD73'),
	(74, 'Tran minh', '01886222209', 200000, '2015-10-12 01:18:16', 'trannhut031192@gmail.com', 'MHD74'),
	(75, 'Tran minh', '01886222209', 200000, '2015-10-12 01:19:16', 'trannhut031192@gmail.com', 'MHD75'),
	(76, 'Tran Minh Nhut', '01886222209', 460934, '2015-10-12 01:24:34', 'trannhut031192@gmail.com', 'MHD76'),
	(77, 'Tran minh nhut', '01886222209', 460934, '2015-10-12 01:27:59', 'trannhut031192@gmail.com', 'MHD77'),
	(78, 'djfnksjdbfkb', '01886222209', 460934, '2015-10-12 01:32:16', 'trannhut031192@gmail.co', 'MHD78'),
	(79, 'Tran Minh Nhut', '01886222209', 460934, '2015-10-12 01:39:09', 'trannhut031192@gmail.com', 'MHD79'),
	(80, 'Tran minh nhut', '01886222209', 460934, '2015-10-12 01:53:05', 'trannhut031192@gmail.com', 'MHD80'),
	(81, 'Tran minh nhut', '01886222209', 460934, '2015-10-12 01:59:03', 'trannhut031192@gmail.com', 'MHD81'),
	(82, 'Tran Minh Nhut', '01886222209', 460934, '2015-10-12 02:07:31', 'trannhut031192@gmail.com', 'MHD82'),
	(84, 'Tran minh nhut', '01886222209', 3600000, '2015-10-12 02:09:36', 'trannhut031192@gmail.com', 'MHD84'),
	(85, 'minh nhut', '01886222209', 3400000, '2015-10-12 03:34:16', 'trannhut031192@gmail.com', 'MHD85'),
	(86, 'Trần Minh', '01886222209', 615467, '2015-10-12 03:57:37', 'trannhut031192@gmail.com', 'MHD86'),
	(87, 'Tran minh', '01886222209', 1000000, '2015-10-12 04:03:10', 'trannhut031192@gmail.com', 'MHD87'),
	(88, 'sjfbsdjkfbak', '01886222209', 5467, '2015-10-12 04:14:24', 'trannhut031192@gmail.com', 'MHD88'),
	(89, 'asjnfjasbdkjsab', '01886222209', 4000000, '2015-10-12 04:19:32', 'trannhut031192@gmail.com', 'MHD89'),
	(90, 'huy quco', '9898881111', 10934, '2015-10-13 01:58:15', 'trannhut031192@gmail.com', 'MHD90'),
	(91, 'tran minh', '01886222209', 1840000, '2015-10-13 04:33:43', 'trannhut031192@gmail.com', 'MHD91'),
	(92, 'asda sdasd', '01886222209', 140000, '2015-10-13 04:36:42', 'trannhut031192@gmail.com', 'MHD92');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;


-- Dumping structure for table minh_nhut.orderproduct
CREATE TABLE IF NOT EXISTS `orderproduct` (
  `id` int(11) NOT NULL auto_increment,
  `quality` int(11) NOT NULL,
  `totalprice` int(11) NOT NULL default '0',
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_orderproduct_order` (`order_id`),
  KEY `FK_orderproduct_product` (`product_id`),
  CONSTRAINT `FK_orderproduct_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  CONSTRAINT `FK_orderproduct_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- Dumping data for table minh_nhut.orderproduct: ~41 rows (approximately)
/*!40000 ALTER TABLE `orderproduct` DISABLE KEYS */;
INSERT INTO `orderproduct` (`id`, `quality`, `totalprice`, `product_id`, `order_id`) VALUES
	(15, 1, 200000, 20, 70),
	(16, 1, 200000, 20, 73),
	(17, 1, 200000, 20, 74),
	(18, 1, 200000, 20, 75),
	(19, 1, 200000, 20, 76),
	(20, 1, 250000, 23, 76),
	(21, 2, 10934, 22, 76),
	(22, 1, 200000, 20, 77),
	(23, 1, 250000, 23, 77),
	(24, 2, 10934, 22, 77),
	(25, 1, 200000, 20, 78),
	(26, 1, 250000, 23, 78),
	(27, 2, 10934, 22, 78),
	(28, 1, 200000, 20, 79),
	(29, 1, 250000, 23, 79),
	(30, 2, 10934, 22, 79),
	(31, 1, 200000, 20, 80),
	(32, 1, 250000, 23, 80),
	(33, 2, 10934, 22, 80),
	(34, 1, 200000, 20, 81),
	(35, 1, 250000, 23, 81),
	(36, 2, 10934, 22, 81),
	(37, 1, 200000, 20, 82),
	(38, 1, 250000, 23, 82),
	(39, 2, 10934, 22, 82),
	(40, 5, 1000000, 20, 84),
	(41, 5, 2600000, 17, 84),
	(42, 10, 1400000, 16, 85),
	(43, 10, 2000000, 20, 85),
	(44, 3, 360000, 12, 86),
	(45, 1, 250000, 23, 86),
	(46, 1, 5467, 22, 86),
	(47, 1, 200000, 20, 87),
	(48, 1, 520000, 17, 87),
	(49, 2, 280000, 16, 87),
	(50, 1, 5467, 22, 88),
	(51, 20, 4000000, 20, 89),
	(52, 2, 10934, 22, 90),
	(53, 2, 280000, 16, 91),
	(54, 3, 1560000, 17, 91),
	(55, 1, 140000, 16, 92);
/*!40000 ALTER TABLE `orderproduct` ENABLE KEYS */;


-- Dumping structure for table minh_nhut.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `price` int(11) NOT NULL default '0',
  `image_link` varchar(100) collate utf8_unicode_ci NOT NULL,
  `create` datetime NOT NULL,
  `update` datetime default NULL,
  `hot` tinyint(1) NOT NULL default '0',
  `best` tinyint(1) NOT NULL default '0',
  `category_id` int(11) NOT NULL,
  `disable` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `FK_product_category` (`category_id`),
  CONSTRAINT `FK_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut.product: ~22 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `name`, `price`, `image_link`, `create`, `update`, `hot`, `best`, `category_id`, `disable`) VALUES
	(1, 'Áo sơ mi hồng A1', 275000, '20150609135540_HLUJIkcTRs560e0a6ee56de.jpg', '2015-10-02 11:39:10', NULL, 1, 0, 2, 1),
	(2, 'Áo sơ mi trắng A1', 250000, '20150609141314_uJjM0XN3f8560e0a9fd505b.jpg', '2015-10-02 11:39:59', NULL, 1, 0, 2, 1),
	(3, 'Áo sơ mi có chấm đen', 260000, '20150609141657_2ZgFlPbr33560e0ac90c3b7.jpg', '2015-10-02 11:40:41', NULL, 1, 0, 2, 1),
	(4, 'Áo sơ mi bình thường', 240000, '20150609143142_oXJbaiojHw560e0af7d71c0.jpg', '2015-10-02 11:41:27', NULL, 1, 0, 2, 0),
	(5, 'Áo sơ mi xanh da trời', 150000, '20150609143627_5im581PDzE560e0b23bbf27.jpg', '2015-10-02 11:42:11', NULL, 1, 0, 2, 0),
	(6, 'Áo sơ mi sọc sọc', 410000, '20150609144143_GeuYcZTVHh560e0b5d71383.jpg', '2015-10-02 11:43:09', NULL, 1, 0, 2, 0),
	(7, 'Áo sơ mi sọc caro 2', 210000, '20150609151218_390vOiDUmO560e0bacd1f25.jpg', '2015-10-02 11:44:28', NULL, 0, 1, 2, 0),
	(8, 'Áo thun nữ teen', 120000, '20150928145223_Ij4xYMLUTb560e0faa0df41.jpg', '2015-10-02 12:01:30', NULL, 0, 1, 2, 0),
	(9, 'Áo sơ mi xinh sắn', 240000, '20150609145516_jpHVjdAicJ560e0fe896518.jpg', '2015-10-02 12:02:32', NULL, 0, 1, 2, 0),
	(10, 'Áo thun hồng B1', 350000, '20150928173220_zQbT10D5x1560e1cffbec85.jpg', '2015-10-02 12:58:23', NULL, 0, 1, 2, 0),
	(11, 'Áo thun hồng b2', 240000, '20150921143702_TRniuQyOXu560e1d3f0b6d5.jpg', '2015-10-02 12:59:27', NULL, 0, 1, 2, 0),
	(12, 'Áo thun đỏ B1', 120000, '20150817190037_DMWRA9e9OC560e1d609aa3d.jpg', '2015-10-02 01:00:00', '2015-10-05 03:04:01', 1, 1, 2, 0),
	(13, 'Túi xách xyz', 500000, '142701399175611e5bbb1e21.jpg', '2015-10-05 09:51:39', NULL, 1, 0, 3, 0),
	(14, 'Túi LV xịn ', 1000000, '1427017908375611e61b728d5.jpg', '2015-10-05 09:53:15', '2015-10-05 09:53:41', 0, 1, 3, 0),
	(15, 'Mỹ phẩm x1', 400000, '20150613110649_Eeqjnqdu7X5611e9357a061.jpg', '2015-10-05 10:06:29', NULL, 0, 1, 1, 0),
	(16, 'Mỹ phẩm x2', 140000, '20150613111601_AeIHeYB6ZM5611e97010f44.jpg', '2015-10-05 10:07:28', NULL, 0, 0, 1, 0),
	(17, 'Mỹ phẩm ABC', 520000, '20150613111601_Fz85Uka6bc5611e99ca41bc.jpg', '2015-10-05 10:08:12', NULL, 0, 1, 1, 0),
	(18, 'Mỹ phẩm 123', 125000, '20150613111131_RpUh2BMFF256121c3ebb0c8.jpg', '2015-10-05 10:08:50', '2015-10-05 01:44:14', 0, 0, 1, 0),
	(19, 'Giay mau den', 1500000, '1G3nwTLZ5611eb6c49fc8.jpg', '2015-10-05 10:15:56', NULL, 0, 1, 4, 1),
	(20, 'giay dep 2', 200000, 'pvYBivGZ5611eb839ecaa.jpg', '2015-10-05 10:16:19', '2015-10-05 11:37:07', 1, 1, 4, 0),
	(22, 'Giay chat luong cuc tot', 5467, 'ymVVbh3j56121c0d16c00.jpg', '2015-10-05 01:43:25', '2015-10-05 03:55:43', 0, 0, 4, 0),
	(23, 'San pham qua hot', 250000, '20150817191212_cS4xAYtUJ4561740e027fd2.jpg', '2015-10-09 11:21:52', NULL, 1, 0, 2, 0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;


-- Dumping structure for table minh_nhut.productimg
CREATE TABLE IF NOT EXISTS `productimg` (
  `id` int(11) NOT NULL auto_increment,
  `image` varchar(50) collate utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_productimg_product` (`product_id`),
  CONSTRAINT `FK_productimg_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table minh_nhut.productimg: ~46 rows (approximately)
/*!40000 ALTER TABLE `productimg` DISABLE KEYS */;
INSERT INTO `productimg` (`id`, `image`, `product_id`) VALUES
	(82, '20150609135540_4It0VTjNI2560e0a6ee723c.jpg', 1),
	(83, '20150609141314_cu05cnSAZC560e0a9fe1f60.jpg', 2),
	(84, '20150609141657_mdHXCrK2nM560e0ac90db2c.jpg', 3),
	(85, '20150609141314_cu05cnSAZC560e0af7e34e2.jpg', 4),
	(86, '20150609143627_xoBCmiU6eX560e0b23bdde4.jpg', 5),
	(87, '20150609144143_fjntk1Ma6Z560e0b5d7ea56.jpg', 6),
	(88, '20150609151218_fHsdMtQcnA560e0bacd3e5b.jpg', 7),
	(89, '20150928145224_EjeKCuHA9h560e0faa0fa81.jpg', 8),
	(90, '20150609145516_3Y2oRavuEg560e0fe897c7d.jpg', 9),
	(91, '20150928172425_im4tqkRmlj560e1cffc032b.jpg', 10),
	(92, '20150921101233_cG2MNIfWI2560e1d3f0d5ad.jpg', 11),
	(93, '20150817190037_KgJ8uTImpB560e1d609c1af.jpg', 12),
	(94, '20150918190733_2dA0Dn0ahs560e4977c4b70.jpg', 12),
	(95, '20150911190107_h6zOAW2Jop560e498201825.jpg', 12),
	(96, '142701918315611e5bbbd99d.jpg', 13),
	(97, '143212030525611e5bbbed25.jpg', 13),
	(98, '1410536171605611e5bbc0c67.jpg', 13),
	(99, '1430886305925611e5bbc1fec.jpg', 13),
	(100, '1431599818445611e61b74036.jpg', 14),
	(101, '1431600619755611e61b7a5eb.jpg', 14),
	(102, '1431601428445611e61b7b96c.jpg', 14),
	(103, '1432120642745611e61b7ccf8.jpg', 14),
	(104, '20150613111131_RpUh2BMFF25611e93587777.jpg', 15),
	(105, '20150613111601_AeIHeYB6ZM5611e935892cc.jpg', 15),
	(106, '20150613112323_aoVmjDjnff5611e9358aa52.jpg', 15),
	(107, '20150613112323_x7sRvbvpXy5611e9358c1b3.jpg', 15),
	(108, '20150613112323_aoVmjDjnff5611e970127c3.jpg', 16),
	(109, '20150613112323_x7sRvbvpXy5611e97013f32.jpg', 16),
	(110, '20150613111131_RpUh2BMFF25611e99ca5811.jpg', 17),
	(111, '20150613111601_AeIHeYB6ZM5611e99cb0f93.jpg', 17),
	(112, '20150613110211_K100pr4Ukd5611e9c28ff43.jpg', 18),
	(113, '20150613111131_gZXl0Ju8oz5611e9c29b6d4.jpg', 18),
	(114, '20150613111601_AeIHeYB6ZM5611e9c29cf9f.jpg', 18),
	(116, 'HWt2o3L25611eb6c4c6d7.jpg', 19),
	(117, 'zrOZ9RcU5611eb6c4da5f.jpg', 19),
	(118, 'OrbpIoty5611eb839ff08.jpg', 20),
	(119, 'Pfwsdu7d5611eb83a1473.jpg', 20),
	(120, 'pvYBivGZ5611eb83a2adc.jpg', 20),
	(121, 'rEdqvNUS5611eb83a3d44.jpg', 20),
	(155, 'rEdqvNUS56121c0d183f2.jpg', 22),
	(156, 'sgUvBchC56121c0d19798.jpg', 22),
	(157, 'UhFtb5Mu56121c0d1aefb.jpg', 22),
	(158, 'kDGkXdb856121c2f86585.jpg', 22),
	(173, '143160142844561239280f82f.jpg', 19),
	(174, '1432120642745612392810b84.jpg', 19),
	(182, '20150817191212_RdmhGIO51s561740e034b26.jpg', 23);
/*!40000 ALTER TABLE `productimg` ENABLE KEYS */;


-- Dumping structure for trigger minh_nhut.new_tbl_test
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `new_tbl_test` BEFORE INSERT ON `order` FOR EACH ROW begin
SET @idt = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='order');
SET NEW.idorder = CONCAT('MHD',@idt);
end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

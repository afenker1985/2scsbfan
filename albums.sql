# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.21)
# Database: 2scsb
# Generation Time: 2014-12-12 16:23:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table albums
# ------------------------------------------------------------

DROP TABLE IF EXISTS `albums`;

CREATE TABLE `albums` (
  `album_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `sub_title` varchar(100) DEFAULT NULL,
  `artist` varchar(100) NOT NULL DEFAULT '',
  `tracks` int(11) NOT NULL,
  `copyright` year(4) NOT NULL,
  `label` varchar(100) NOT NULL DEFAULT '',
  `release_date` date NOT NULL,
  `total_length` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;

INSERT INTO `albums` (`album_id`, `slug`, `title`, `sub_title`, `artist`, `tracks`, `copyright`, `label`, `release_date`, `total_length`, `is_active`, `creation_date`, `last_modified`)
VALUES
	(1,'hardroad','Hard Road','Favorite Camp Songs of the Civil War','2nd South Carolina String Band',20,'2000','Palmetto Productions','1991-08-01',3710,0,'2014-12-05 18:21:01','2014-12-05 19:26:09'),
	(2,'southernsoldier','Southern Soldier',NULL,'2nd South Carolina String Band',19,'1997','Palmetto Productions','1996-07-04',4384,1,'2014-12-05 18:23:33','2014-12-05 18:23:33'),
	(3,'lightningjar','Lightning in a Jar','An Evening of Live Civil War Music','2nd South Carolina String Band',28,'2008','Palmetto Productions','2008-01-01',7935,0,'2014-12-05 18:25:14','2014-12-05 19:26:18'),
	(4,'duclemmelodies','Dulcem Melodies','Favorite Campfire Songs of the Civil War Era','2nd South Carolina String Band',16,'2006','Palmetto Productions','2006-07-19',3648,0,'2014-12-05 18:28:09','2014-12-05 19:26:25'),
	(5,'highcotton','In High Cotton','Favorite Camp Songs of the Civil War','2nd South Carolina String Band',16,'2002','Palmetto Productions','2002-09-15',3836,0,'2014-12-05 18:30:16','2014-12-05 19:26:32'),
	(6,'strikecamp','Strike the Tent','Civil War Songs & Campfire Melodies','2nd South Carolina String Band',20,'2013','Palmetto Productions','2013-07-04',3559,0,'2014-12-05 18:31:45','2014-12-05 19:26:36');

/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

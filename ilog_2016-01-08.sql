# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.9)
# Database: ilog
# Generation Time: 2016-01-08 03:56:11 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table il_city_destination
# ------------------------------------------------------------

DROP TABLE IF EXISTS `il_city_destination`;

CREATE TABLE `il_city_destination` (
  `idil_city_destination` int(11) NOT NULL AUTO_INCREMENT,
  `il_city_destination_Id` varchar(10) NOT NULL,
  `il_city_destination_desc` varchar(45) DEFAULT NULL,
  `il_city_destination_host` varchar(45) DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idil_city_destination`,`il_city_destination_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table il_company
# ------------------------------------------------------------

DROP TABLE IF EXISTS `il_company`;

CREATE TABLE `il_company` (
  `idil_company_Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `il_company_acc` varchar(10) NOT NULL,
  `il_company_name` varchar(45) DEFAULT NULL,
  `il_company_addr1` varchar(200) DEFAULT NULL,
  `il_company_addr2` varchar(200) DEFAULT NULL,
  `il_company_cityId` varchar(10) DEFAULT NULL,
  `il_company_post` varchar(45) DEFAULT NULL,
  `il_company_email` varchar(45) DEFAULT NULL,
  `il_company_phone` varchar(45) DEFAULT NULL,
  `il_company_contact` varchar(45) DEFAULT NULL,
  `il_company_fax` varchar(45) DEFAULT NULL,
  `il_company_notes` varchar(45) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idil_company_Id`,`il_company_acc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table il_host
# ------------------------------------------------------------

DROP TABLE IF EXISTS `il_host`;

CREATE TABLE `il_host` (
  `idil_host` int(11) NOT NULL AUTO_INCREMENT,
  `il_company_acc` varchar(10) NOT NULL,
  `il_host_Id` varchar(10) NOT NULL,
  `il_host_desc` varchar(45) DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idil_host`,`il_company_acc`,`il_host_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table il_service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `il_service`;

CREATE TABLE `il_service` (
  `idil_service` int(11) NOT NULL AUTO_INCREMENT,
  `il_company_acc` varchar(10) DEFAULT NULL,
  `il_service_uom_Id` varchar(10) NOT NULL,
  `il_service_uom_desc` varchar(45) DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idil_service`,`il_service_uom_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table il_uom
# ------------------------------------------------------------

DROP TABLE IF EXISTS `il_uom`;

CREATE TABLE `il_uom` (
  `idil_uom` int(11) NOT NULL AUTO_INCREMENT,
  `il_uom_Id` varchar(10) NOT NULL,
  `il_company_acc` varchar(10) NOT NULL,
  `il_uom_desc` varchar(45) DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idil_uom`,`il_uom_Id`,`il_company_acc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table il_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `il_user`;

CREATE TABLE `il_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` text NOT NULL,
  `api_key` varchar(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `il_company_acc` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `il_user` WRITE;
/*!40000 ALTER TABLE `il_user` DISABLE KEYS */;

INSERT INTO `il_user` (`id`, `name`, `email`, `password_hash`, `api_key`, `status`, `created_at`, `il_company_acc`)
VALUES
	(1,'Aris Ridwan','aris.ridwan@gmail.com','$2a$10$010d6c5b052f64323da34ulO.ZtSgquxxMovcLk91pgjnuXXko3gW','a23f00653ae56f36fd5924ca48549ced',1,'2015-12-23 19:58:51',NULL);

/*!40000 ALTER TABLE `il_user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

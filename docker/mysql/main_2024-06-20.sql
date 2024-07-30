# ************************************************************
# Sequel Ace SQL dump
# Version 20051
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.33)
# Database: main
# Generation Time: 2024-06-20 06:52:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table attributes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attributes`;

CREATE TABLE `attributes` (
  `attribute_id` int NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `attributes` WRITE;
/*!40000 ALTER TABLE `attributes` DISABLE KEYS */;

INSERT INTO `attributes` (`attribute_id`, `attribute_name`)
VALUES
	(1,'sizemb'),
	(2,'heightcm'),
	(3,'widthcm'),
	(4,'lengthcm'),
	(5,'weightkg');

/*!40000 ALTER TABLE `attributes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products_attributes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products_attributes`;

CREATE TABLE `products_attributes` (
  `product_id` int DEFAULT NULL,
  `attribute_id` int DEFAULT NULL,
  `attribute_value` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `productID` (`product_id`),
  KEY `attributeID` (`attribute_id`),
  CONSTRAINT `products_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products_main` (`product_id`),
  CONSTRAINT `products_attributes_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `products_attributes` WRITE;
/*!40000 ALTER TABLE `products_attributes` DISABLE KEYS */;

INSERT INTO `products_attributes` (`product_id`, `attribute_id`, `attribute_value`)
VALUES
	(1,1,'123'),
	(4,1,'123213'),
	(11,1,'123123'),
	(14,1,'111'),
	(15,1,'123123');

/*!40000 ALTER TABLE `products_attributes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products_main
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products_main`;

CREATE TABLE `products_main` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_sku` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double NOT NULL,
  `product_type` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `products_main` WRITE;
/*!40000 ALTER TABLE `products_main` DISABLE KEYS */;

INSERT INTO `products_main` (`product_id`, `product_sku`, `product_name`, `product_price`, `product_type`)
VALUES
	(1,'1','asdasd',212312,'dvd'),
	(4,'asdasda','asd',12.99,'dvd'),
	(11,'12312312312','asdad',123123,'dvd'),
	(14,'1111','asd2',1,'dvd'),
	(15,'111111','asd',12,'dvd');

/*!40000 ALTER TABLE `products_main` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

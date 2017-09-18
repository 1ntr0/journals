-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: ntr
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.17.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmarks` (
  `bookmark_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned NOT NULL,
  `journal_id` smallint(5) unsigned NOT NULL,
  `page` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`bookmark_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks`
--

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
INSERT INTO `bookmarks` VALUES (1,1,162,214);
/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journals`
--

DROP TABLE IF EXISTS `journals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journals` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `year` smallint(4) unsigned NOT NULL,
  `number` tinyint(3) unsigned NOT NULL,
  `kolvo` smallint(3) unsigned NOT NULL,
  `category` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journals`
--

LOCK TABLES `journals` WRITE;
/*!40000 ALTER TABLE `journals` DISABLE KEYS */;
INSERT INTO `journals` VALUES (1,'5Колесо',2016,1,134,'Авто'),(2,'5Колесо',2016,2,132,'Авто'),(3,'5Колесо',2016,3,132,'Авто'),(4,'Игромания',2016,1,148,'Компьютер'),(5,'MAXIM',2016,1,120,'Мужские'),(6,'PLAYBOY',2016,1,124,'Мужские'),(7,'МирПК',2016,1,68,'Компьютер'),(8,'МирПК',2016,2,71,'Компьютер'),(9,'МирПК',2016,3,70,'Компьютер'),(10,'МирПК',2016,4,74,'Компьютер'),(11,'МирПК',2016,5,80,'Компьютер'),(12,'PLAYBOY',2016,3,120,'Мужские'),(13,'PLAYBOY',2016,4,124,'Мужские'),(14,'Игромания',2016,2,148,'Компьютер'),(15,'Игромания',2016,3,144,'Компьютер'),(16,'5Колесо',2016,4,134,'Авто'),(17,'MAXIM',2016,2,110,'Мужские'),(18,'MAXIM',2016,3,124,'Мужские'),(19,'MAXIM',2016,4,124,'Мужские'),(20,'MAXIM',2016,5,132,'Мужские'),(21,'MensHealth',2016,1,138,'Мужские'),(22,'MensHealth',2016,2,128,'Мужские'),(23,'MensHealth',2016,3,129,'Мужские'),(24,'Chip',2016,1,82,'Компьютер'),(25,'Chip',2016,2,82,'Компьютер'),(26,'Chip',2016,3,82,'Компьютер'),(27,'Chip',2016,4,84,'Компьютер'),(28,'Chip',2016,5,84,'Компьютер'),(29,'MensHealth',2016,4,156,'Мужские'),(30,'PLAYBOY',2016,5,120,'Мужские'),(31,'Игромания',2016,4,144,'Компьютер'),(32,'Игромания',2016,5,144,'Компьютер'),(33,'Chip',2016,6,84,'Компьютер'),(34,'LinuxFormat',2016,1,116,'Компьютер'),(35,'LinuxFormat',2016,2,114,'Компьютер'),(36,'LinuxFormat',2016,3,116,'Компьютер'),(37,'LinuxFormat',2016,4,116,'Компьютер'),(38,'Зарулем',2016,1,169,'Авто'),(39,'Зарулем',2016,2,178,'Авто'),(40,'Зарулем',2016,3,170,'Авто'),(41,'Зарулем',2016,4,162,'Авто'),(42,'Зарулем',2016,5,163,'Авто'),(43,'QUATTRORUOTE',2016,1,120,'Авто'),(44,'QUATTRORUOTE',2016,3,115,'Авто'),(45,'QUATTRORUOTE',2016,4,117,'Авто'),(46,'QUATTRORUOTE',2016,5,117,'Авто'),(47,'5Колесо',2016,5,132,'Авто'),(48,'Vogue',2016,1,192,'Женские'),(49,'Vogue',2016,2,180,'Женские'),(50,'Vogue',2016,3,274,'Женские'),(51,'Vogue',2016,4,278,'Женские'),(52,'Vogue',2016,5,190,'Женские'),(53,'MAXIM',2016,6,124,'Мужские'),(54,'Игромания',2016,6,148,'Компьютер'),(55,'MAXIM',2016,7,124,'Мужские'),(56,'5Колесо',2016,6,132,'Авто'),(57,'QUATTRORUOTE',2016,6,148,'Авто'),(58,'Зарулем',2016,6,164,'Авто'),(59,'Vogue',2016,6,198,'Женские'),(60,'Chip',2016,7,84,'Компьютер'),(61,'LinuxFormat',2016,5,116,'Компьютер'),(62,'МирПК',2016,6,68,'Компьютер'),(63,'PLAYBOY',2016,6,124,'Мужские'),(64,'LinuxFormat',2016,6,115,'Компьютер'),(65,'MensHealth',2016,5,148,'Мужские'),(66,'5Колесо',2016,7,132,'Авто'),(67,'QUATTRORUOTE',2016,7,111,'Авто'),(68,'Зарулем',2016,7,164,'Авто'),(69,'MensHealth',2016,6,144,'Мужские'),(70,'Vogue',2016,7,158,'Женские'),(71,'LinuxFormat',2016,7,116,'Компьютер'),(72,'Игромания',2016,7,148,'Компьютер'),(73,'МирПК',2016,7,66,'Компьютер'),(74,'MensHealth',2016,7,124,'Мужские'),(75,'PLAYBOY',2016,7,124,'Мужские'),(76,'5Колесо',2016,8,132,'Авто'),(77,'QUATTRORUOTE',2016,9,150,'Авто'),(78,'Зарулем',2016,8,148,'Авто'),(79,'Vogue',2016,8,172,'Женские'),(80,'Chip',2016,8,84,'Компьютер'),(81,'LinuxFormat',2016,8,114,'Компьютер'),(82,'Игромания',2016,8,148,'Компьютер'),(83,'МирПК',2016,9,72,'Компьютер'),(84,'MAXIM',2016,8,124,'Мужские'),(85,'MensHealth',2016,8,124,'Мужские'),(86,'PLAYBOY',2016,9,140,'Мужские'),(87,'5Колесо',2016,9,132,'Авто'),(88,'Зарулем',2016,9,164,'Авто'),(89,'Vogue',2016,9,440,'Женские'),(90,'Chip',2016,9,84,'Компьютер'),(91,'LinuxFormat',2016,9,112,'Компьютер'),(92,'Игромания',2016,9,148,'Компьютер'),(93,'MAXIM',2016,9,132,'Мужские'),(94,'MensHealth',2016,9,172,'Мужские'),(95,'5Колесо',2016,10,132,'Авто'),(96,'QUATTRORUOTE',2016,10,148,'Авто'),(97,'Зарулем',2016,10,164,'Авто'),(98,'Vogue',2016,10,300,'Женские'),(99,'Chip',2016,10,84,'Компьютер'),(100,'LinuxFormat',2016,10,116,'Компьютер'),(101,'Игромания',2016,10,148,'Компьютер'),(102,'МирПК',2016,10,57,'Компьютер'),(103,'MAXIM',2016,10,132,'Мужские'),(104,'MensHealth',2016,10,174,'Мужские'),(105,'PLAYBOY',2016,10,124,'Мужские'),(106,'5Колесо',2016,11,134,'Авто'),(107,'QUATTRORUOTE',2016,11,147,'Авто'),(108,'Зарулем',2016,11,164,'Авто'),(109,'Vogue',2016,11,218,'Женские'),(110,'Chip',2016,11,84,'Компьютер'),(111,'LinuxFormat',2016,11,114,'Компьютер'),(112,'Игромания',2016,11,148,'Компьютер'),(113,'МирПК',2016,11,64,'Компьютер'),(114,'MAXIM',2016,11,112,'Мужские'),(115,'MensHealth',2016,11,168,'Мужские'),(116,'PLAYBOY',2016,11,124,'Мужские'),(117,'5Колесо',2016,12,132,'Авто'),(118,'QUATTRORUOTE',2016,12,150,'Авто'),(119,'Зарулем',2016,12,148,'Авто'),(120,'Vogue',2016,12,240,'Женские'),(121,'Chip',2016,12,84,'Компьютер'),(122,'LinuxFormat',2016,12,116,'Компьютер'),(123,'Игромания',2016,12,148,'Компьютер'),(124,'МирПК',2016,12,56,'Компьютер'),(125,'MAXIM',2016,12,148,'Мужские'),(126,'MensHealth',2016,12,168,'Мужские'),(127,'PLAYBOY',2016,12,124,'Мужские'),(128,'5Колесо',2017,1,100,'Авто'),(129,'QUATTRORUOTE',2017,1,144,'Авто'),(130,'Зарулем',2017,1,148,'Авто'),(131,'Vogue',2017,1,209,'Женские'),(132,'Chip',2017,1,84,'Компьютер'),(133,'LinuxFormat',2017,1,116,'Компьютер'),(134,'Игромания',2017,1,148,'Компьютер'),(135,'MAXIM',2017,1,124,'Мужские'),(136,'MensHealth',2017,1,142,'Мужские'),(137,'PLAYBOY',2017,1,124,'Мужские'),(138,'5Колесо',2017,2,116,'Авто'),(139,'QUATTRORUOTE',2017,3,124,'Авто'),(140,'Зарулем',2017,2,148,'Авто'),(141,'Vogue',2017,2,162,'Женские'),(142,'Chip',2017,2,84,'Компьютер'),(143,'Игромания',2017,2,148,'Компьютер'),(144,'MAXIM',2017,2,124,'Мужские'),(145,'MensHealth',2017,2,130,'Мужские'),(146,'5Колесо',2017,3,134,'Авто'),(147,'Зарулем',2017,3,148,'Авто'),(148,'Vogue',2017,3,276,'Женские'),(149,'Chip',2017,3,82,'Компьютер'),(150,'Игромания',2017,3,148,'Компьютер'),(151,'MAXIM',2017,3,114,'Мужские'),(152,'Vogue',2017,4,340,'Женские'),(153,'Chip',2017,4,84,'Компьютер'),(154,'MAXIM',2017,4,164,'Мужские'),(155,'5Колесо',2017,4,144,'Авто'),(156,'QUATTRORUOTE',2017,4,126,'Авто'),(157,'Зарулем',2017,4,148,'Авто'),(158,'Игромания',2017,4,148,'Компьютер'),(159,'MensHealth',2017,3,158,'Мужские'),(160,'MensHealth',2017,4,184,'Мужские'),(161,'PLAYBOY',2017,3,100,'Мужские'),(162,'Vogue',2017,5,214,'Женские'),(163,'Chip',2017,5,84,'Компьютер'),(164,'MAXIM',2017,5,114,'Мужские');
/*!40000 ALTER TABLE `journals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `read_table`
--

DROP TABLE IF EXISTS `read_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `read_table` (
  `read_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned NOT NULL,
  `journal_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`read_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `read_table`
--

LOCK TABLES `read_table` WRITE;
/*!40000 ALTER TABLE `read_table` DISABLE KEYS */;
INSERT INTO `read_table` VALUES (1,1,162);
/*!40000 ALTER TABLE `read_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'root','','29a8efa4418e20c17620933d30d86762',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-14  6:55:43

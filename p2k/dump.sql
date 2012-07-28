-- MySQL dump 10.13  Distrib 5.1.63, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: p2k
-- ------------------------------------------------------
-- Server version	5.1.63-0+squeeze1

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
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `home` varchar(50) NOT NULL,
  `away` varchar(50) NOT NULL,
  `home_score` int(11) NOT NULL DEFAULT '0',
  `away_score` int(11) NOT NULL DEFAULT '0',
  `get_result` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matches`
--

LOCK TABLES `matches` WRITE;
/*!40000 ALTER TABLE `matches` DISABLE KEYS */;
INSERT INTO `matches` VALUES (1,'2012-06-09 18:06:05','Польша','Греция',1,1,1),(2,'2012-06-09 18:06:35','Россия','Чехия',4,1,1),(3,'2012-06-09 16:00:00','Нидерланды','Дания',0,1,1),(4,'2012-06-09 18:45:00','Германия','Португалия',1,0,1),(5,'2012-06-10 16:00:00','Испания','Италия',1,1,1),(6,'2012-06-10 18:45:00','Ирландия','Хорватия',0,0,0),(7,'2012-06-11 16:00:00','Франция','Англия',0,0,0),(8,'2012-06-11 18:45:00','Украина','Швеция',0,0,0),(9,'2012-06-12 16:00:00','Греция','Чехия',0,0,0),(10,'2012-06-12 18:45:00','Польша','Россия',0,0,0),(11,'2012-06-13 16:00:00','Дания','Португалия',0,0,0),(12,'2012-06-13 18:45:00','Нидерланды','Германия',0,0,0),(13,'2012-06-14 16:00:40','Италия','Хорватия',0,0,0),(14,'2012-06-14 18:45:10','Испания','Ирландия',0,0,0),(15,'2012-06-15 16:00:00','Украина','Франция',0,0,0),(16,'2012-06-15 18:45:00','Швеция','Англия',0,0,0),(17,'2012-06-16 18:45:10','Греция','Россия',0,0,0),(18,'2012-06-16 18:45:10','Чехия','Польша',0,0,0),(19,'2012-06-17 18:45:10','Португалия','Нидерланды',0,0,0),(20,'2012-06-17 18:45:10','Дания','Германия',0,0,0),(21,'2012-06-18 18:45:10','Хорватия','Испания',0,0,0),(22,'2012-06-18 18:45:10','Италия','Ирландия',0,0,0),(23,'2012-06-19 18:45:10','Швеция','Франция',0,0,0),(24,'2012-06-19 18:45:10','Англия','Украина',0,0,0);
/*!40000 ALTER TABLE `matches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_matches`
--

DROP TABLE IF EXISTS `user_matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `bet` tinyint(1) NOT NULL,
  `result` tinyint(4) NOT NULL DEFAULT '0',
  `is_done` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_matches`
--

LOCK TABLES `user_matches` WRITE;
/*!40000 ALTER TABLE `user_matches` DISABLE KEYS */;
INSERT INTO `user_matches` VALUES (1,1,1,1,0,1),(2,2,2,1,0,1);
/*!40000 ALTER TABLE `user_matches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'????'),(2,'?????'),(3,'??????');
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

-- Dump completed on 2012-07-28 14:29:40

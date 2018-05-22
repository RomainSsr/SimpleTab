-- MySQL dump 10.13  Distrib 8.0.11, for Win64 (x86_64)
--
-- Host: localhost    Database: simpletab
-- ------------------------------------------------------
-- Server version	8.0.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `artists` (
  `idArtist` int(11) NOT NULL AUTO_INCREMENT,
  `nameArtist` varchar(45) NOT NULL,
  PRIMARY KEY (`idArtist`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `comments` (
  `idcomment` int(11) NOT NULL AUTO_INCREMENT,
  `contentComment` mediumtext,
  `tablatures_idTab` int(11) NOT NULL,
  `users_idUsers` int(11) NOT NULL,
  PRIMARY KEY (`idcomment`),
  KEY `fk_comments_tablatures1_idx` (`tablatures_idTab`),
  KEY `fk_comments_users1_idx` (`users_idUsers`),
  CONSTRAINT `fk_comments_tablatures1` FOREIGN KEY (`tablatures_idTab`) REFERENCES `tablatures` (`idtab`),
  CONSTRAINT `fk_comments_users1` FOREIGN KEY (`users_idUsers`) REFERENCES `users` (`idusers`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `rates` (
  `idrate` int(11) NOT NULL AUTO_INCREMENT,
  `rate` int(11) NOT NULL,
  `tablatures_idTab` int(11) NOT NULL,
  `users_idUsers` int(11) NOT NULL,
  PRIMARY KEY (`idrate`),
  KEY `fk_rate_tablatures1_idx` (`tablatures_idTab`),
  KEY `fk_rate_users1_idx` (`users_idUsers`),
  CONSTRAINT `fk_rate_tablatures1` FOREIGN KEY (`tablatures_idTab`) REFERENCES `tablatures` (`idtab`),
  CONSTRAINT `fk_rate_users1` FOREIGN KEY (`users_idUsers`) REFERENCES `users` (`idusers`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `roles` (
  `idrole` int(11) NOT NULL AUTO_INCREMENT,
  `captionRole` varchar(45) NOT NULL,
  PRIMARY KEY (`idrole`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablatures`
--

DROP TABLE IF EXISTS `tablatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tablatures` (
  `idTab` int(11) NOT NULL AUTO_INCREMENT,
  `titleTab` varchar(45) NOT NULL,
  `pathTab` varchar(50) NOT NULL,
  `rateTab` double DEFAULT '0',
  `lvlTab` int(11) NOT NULL,
  `ARTISTS_idArtist` int(11) NOT NULL,
  `users_idUsers` int(11) NOT NULL,
  `approuved` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`idTab`),
  KEY `fk_TABLATURES_ARTISTS1_idx` (`ARTISTS_idArtist`),
  KEY `fk_tablatures_users1_idx` (`users_idUsers`),
  CONSTRAINT `fk_TABLATURES_ARTISTS1` FOREIGN KEY (`ARTISTS_idArtist`) REFERENCES `artists` (`idartist`),
  CONSTRAINT `fk_tablatures_users1` FOREIGN KEY (`users_idUsers`) REFERENCES `users` (`idusers`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `nameUser` varchar(45) NOT NULL,
  `forenameUser` varchar(45) NOT NULL,
  `pwdUser` varchar(45) NOT NULL,
  `emailUser` varchar(45) NOT NULL,
  `pseudoUser` varchar(45) NOT NULL,
  `role_idrole` int(11) NOT NULL,
  PRIMARY KEY (`idUsers`),
  KEY `fk_users_role1_idx` (`role_idrole`),
  CONSTRAINT `fk_users_role1` FOREIGN KEY (`role_idrole`) REFERENCES `roles` (`idrole`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-22 16:35:59

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
  `idArtist` int(11) NOT NULL,
  `nameArtist` varchar(45) NOT NULL,
  PRIMARY KEY (`idArtist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (0,'Ed Sheeran'),(1,'Jeff Buckley'),(2,'Oasis'),(3,'John Legend'),(4,'Camila Cabello'),(5,'Calum Scott'),(6,'Passenger'),(7,'Eagles'),(8,'Jason Mraz'),(9,'Radiohead'),(10,'Adele'),(11,'The Cramberries'),(12,'Sam Smith'),(13,'Bruno Mars'),(14,'Imagine Dragons'),(15,'George Brassens');
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;

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
  `artists_idArtist` int(11) NOT NULL,
  PRIMARY KEY (`idcomment`),
  KEY `fk_comments_tablatures1_idx` (`tablatures_idTab`),
  KEY `fk_comments_artists1_idx` (`artists_idArtist`),
  CONSTRAINT `fk_comments_artists1` FOREIGN KEY (`artists_idArtist`) REFERENCES `artists` (`idartist`),
  CONSTRAINT `fk_comments_tablatures1` FOREIGN KEY (`tablatures_idTab`) REFERENCES `tablatures` (`idtab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `roles` (
  `idrole` int(11) NOT NULL,
  `captionRole` varchar(45) NOT NULL,
  PRIMARY KEY (`idrole`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (0,'utilisateur'),(1,'administrateur');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tablatures`
--

DROP TABLE IF EXISTS `tablatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tablatures` (
  `idTab` int(11) NOT NULL,
  `titleTab` varchar(45) NOT NULL,
  `pathTab` varchar(50) NOT NULL,
  `rateTab` double DEFAULT '0',
  `linkVideo` varchar(45) NOT NULL,
  `lvlTab` int(11) NOT NULL,
  `ARTISTS_idArtist` int(11) NOT NULL,
  `users_idUsers` int(11) NOT NULL,
  PRIMARY KEY (`idTab`),
  KEY `fk_TABLATURES_ARTISTS1_idx` (`ARTISTS_idArtist`),
  KEY `fk_tablatures_users1_idx` (`users_idUsers`),
  CONSTRAINT `fk_TABLATURES_ARTISTS1` FOREIGN KEY (`ARTISTS_idArtist`) REFERENCES `artists` (`idartist`),
  CONSTRAINT `fk_tablatures_users1` FOREIGN KEY (`users_idUsers`) REFERENCES `users` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tablatures`
--

LOCK TABLES `tablatures` WRITE;
/*!40000 ALTER TABLE `tablatures` DISABLE KEYS */;
INSERT INTO `tablatures` VALUES (0,'Perfect','perfect.xml',5,'https://www.youtube.com/watch?v=zSZBmRABm1c',1,0,0),(1,'Halleluja','halleluja.xml',5,'https://www.youtube.com/watch?v=qwFhT56gtek',0,1,2);
/*!40000 ALTER TABLE `tablatures` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'Sauser','Romain','toto','romain.ssr@eduge.ch','romainSsr',1),(1,'testNom','testPrenom','testPseudo','testEmail','testMdp',0),(2,'Croche','Sahra','titi','sahra.croche@gmail.com','SC',0),(3,'Croche','Sahra','titi','sahra.croche@gmail.com','SC',0),(4,'Tarrou','Jean','tata','jt@gmail.com','JT',0),(5,'xsac','dsadad','sa','asdasdas@gmail.com','asdasd',0),(6,'xsac','dsadad','sa','asdasdas@gmail.com','asdasd',0),(7,'asd','das','das','das@gmail.com','dsa',0),(8,'ds','sda','sa','sa@gmail.com','dadas',0),(9,'Sample Project Copy','Ronaldo','Super2012','Jean-Jaques.Patachon@gmail.com','RoRoDouch',0),(10,'Sample Project Copy','jk','kj','Jean-Jaques.Patachon@gmail.com','k',0),(11,'Sample Project Copy','xaxs','xs','Jean-Jaques.Patachon@gmail.com','xasxas',0);
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

-- Dump completed on 2018-05-16 16:32:04

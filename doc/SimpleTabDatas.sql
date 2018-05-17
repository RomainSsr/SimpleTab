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
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (0,'Ed Sheeran'),(1,'Jeff Buckley'),(2,'Oasis'),(3,'John Legend'),(4,'Camila Cabello'),(5,'Calum Scott'),(6,'Passenger'),(7,'Eagles'),(8,'Jason Mraz'),(9,'Radiohead'),(10,'Adele'),(11,'The Cramberries'),(12,'Sam Smith'),(13,'Bruno Mars'),(14,'Imagine Dragons'),(15,'George Brassens');
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (0,'utilisateur'),(1,'administrateur');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tablatures`
--

LOCK TABLES `tablatures` WRITE;
/*!40000 ALTER TABLE `tablatures` DISABLE KEYS */;
INSERT INTO `tablatures` VALUES (0,'Perfect','0.xml',5,'https://www.youtube.com/watch?v=zSZBmRABm1c',1,0,0),(1,'Halleluja','halleluja.xml',5,'https://www.youtube.com/watch?v=qwFhT56gtek',0,1,2);
/*!40000 ALTER TABLE `tablatures` ENABLE KEYS */;
UNLOCK TABLES;

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

-- Dump completed on 2018-05-17 16:09:16

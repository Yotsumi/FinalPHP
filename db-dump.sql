-- MySQL dump 10.16  Distrib 10.1.41-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Quotidiano
-- ------------------------------------------------------
-- Server version	10.1.41-MariaDB-0+deb9u1

DROP DATABASE IF EXISTS Quotidiano;
CREATE DATABASE Quotidiano;
USE Quotidiano;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articolo`
--

DROP TABLE IF EXISTS `articolo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articolo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(30) NOT NULL,
  `contenuto` varchar(200) NOT NULL,
  `autore` varchar(30) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titolo` (`titolo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articolo`
--

LOCK TABLES `articolo` WRITE;
/*!40000 ALTER TABLE `articolo` DISABLE KEYS */;
INSERT INTO `articolo` VALUES (3,'motivating','turpis integer aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien quis','Valli Conws','2019-11-20'),(4,'optimizing','volutpat erat quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero nam dui proin leo odio porttitor id','Uri Amor','2019-12-27'),(5,'Upgradable','ipsum aliquam non mauris morbi non lectus aliquam sit amet diam in magna','Ethan Lewendon','2019-12-31'),(6,'next generation','justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit amet sem fusce consequat','Kevin Bunclark','2019-12-28'),(7,'Secured','ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero','Zeke Obispo','2019-12-20'),(9,'value added','nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna','Lazar Newborn','2019-12-21'),(10,'Synergized','justo aliquam quis turpis eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed','Clair Weston','2018-12-22'),(12,'explicit','ac est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut','Isabeau Sothcott','2019-12-20'),(13,'even keeled','ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis a pede posuere','Alena Foffano','2019-12-20'),(15,'asymmetric','neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in','Andee Burvill','2019-12-23');
/*!40000 ALTER TABLE `articolo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utente` (
  `hashUtente` char(32) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `abilitato` tinyint(1) NOT NULL,
  PRIMARY KEY (`hashUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES ('00af7022a4786c2a0ca4ef69234593c7','Reese','rhuniwalldcmh1bml3YWxsZA==cmh1bml3YWxsZA==cmh1bml3YWxsZA==cm',0),('1f7ba58706f9d405023da32864d059c8','Tabor','tmaddaford5dG1hZGRhZm9yZDU=dG1hZGRhZm9yZDU=dG1hZGRhZm9yZDU=d',0),('21232f297a57a5a743894a0e4a801fc3','admin','$2y$12$W9dqHFDXaEzFrSqVeranfOE/waYerFOlBGFYjb6f65lO4tNq/NQ3y',1),('260ca9dd8a4577fc00b7bd5810298076','Barth','bmerringeYm1lcnJpbmdlYm1lcnJpbmdlYm1lcnJpbmdlYm1lcnJpbmdlYm1',1),('38efcfb912e701e8df050fc33d0d33c3','Frankie','fhubbucke4Zmh1YmJ1Y2tlNA==Zmh1YmJ1Y2tlNA==Zmh1YmJ1Y2tlNA==Zm',1),('45509ca3caf2ebb04f4b6f6b0be4e22d','Rouvin','rpibsworth6cnBpYnN3b3J0aDY=cnBpYnN3b3J0aDY=cnBpYnN3b3J0aDY=c',0),('5788784bc0e3ccf4e7997857d8ae3eaa','Tommie','talten3dGFsdGVuMw==dGFsdGVuMw==dGFsdGVuMw==dGFsdGVuMw==dGFsd',1),('74a5ac3c7f96bc89eb19dcfe4201cb0f','Trenton','tmeadscdG1lYWRzYw==dG1lYWRzYw==dG1lYWRzYw==dG1lYWRzYw==dG1lY',0);
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

DROP user if exists 'clientUser'@'localhost';
CREATE USER 'clientUser'@'localhost' IDENTIFIED BY '9pzp7SNXyZ1LK6hL/tT/X/eCYV2LL3oI';
GRANT SELECT ON Quotidiano.articolo TO 'clientUser'@'localhost';

DROP user if exists 'adminUser'@'localhost';
CREATE USER 'adminUser'@'localhost' IDENTIFIED BY 'b/UmDoDIZf8sYjUCsEx4YieVd0TZsFoH';
GRANT ALL PRIVILEGES ON Quotidiano. * TO 'adminUser'@'localhost';

-- Dump completed on 2019-12-14 19:51:47

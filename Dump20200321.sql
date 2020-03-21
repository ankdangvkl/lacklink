-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: lacklink
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL COMMENT 'user_name : name of user,\nname : name of user account,\naddress : the facebook url of user,\n',
  `name` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `directory` varchar(200) NOT NULL COMMENT 'Use for save the link to directory',
  `role` varchar(10) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','admin','https://www.facebook.com/','','ADMIN',1,'2020-02-25 20:26:12','ADMIN','2020-02-25 20:26:12','ADMIN'),(3,'user1','user1','`','https://www.facebook.com/','user1/','USER',1,'2020-02-25 20:26:12','ADMIN','2020-03-20 05:21:20','Admin'),(4,'user2','user2','`','https://www.facebook.com/','user2/','USER',1,'2020-02-25 20:26:12','ADMIN','2020-03-20 05:21:34','Admin'),(5,'user3','user3','`','https://www.facebook.com/','user3/','USER',1,'2020-03-20 02:04:47','ADMIN','2020-03-20 05:21:36','Admin'),(6,'a','a','a','a','a/','USER',1,'2020-03-20 04:39:25','ADMIN','2020-03-20 05:21:33','Admin'),(7,'b','b','b','b','b/','USER',1,'2020-03-20 05:21:45','ADMIN','2020-03-20 05:22:12','Admin'),(8,'c','c','c','https://www.facebook.com/123abc','c/','USER',1,'2020-03-20 05:23:03','ADMIN','2020-03-20 05:23:07','Admin'),(9,'d','d','d','https://www.facebook.com/125234523452345fudydydydhgvjv34523453453453fsdfv','d/','USER',1,'2020-03-20 05:23:22','ADMIN','2020-03-20 05:25:53','Admin'),(10,'e','e','e','https://www.facebook.com/125234523452345fudydydydhgvjv345234534534','e/','USER',1,'2020-03-20 05:23:48','ADMIN','2020-03-20 05:25:53','Admin');
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

-- Dump completed on 2020-03-21 10:45:33

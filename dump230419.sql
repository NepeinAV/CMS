-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: php
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_id1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (2,'azsdasdasdas','Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores tempora, doloribus vero consectetur deleniti commodi tempore debitis possimus amet ex voluptatem totam facere reiciendis tenetur nesciunt et? Id, veritatis fuga?\nLorem ipsum dolor sit amet consectetur adipisicing elit. Maiores tempora, doloribus vero consectetur deleniti commodi tempore debitis possimus amet ex voluptatem totam facere reiciendis tenetur nesciunt et? Id, veritatis fuga?\nLorem ipsum dolor sit amet consectetur adipisicing elit. Maiores tempora, doloribus vero consectetur deleniti commodi tempore debitis possimus amet ex voluptatem totam facere reiciendis tenetur nesciunt et? Id, veritatis fuga?\nLorem ipsum dolor sit amet consectetur adipisicing elit. Maiores tempora, doloribus vero consectetur deleniti commodi tempore debitis possimus amet ex voluptatem totam facere reiciendis tenetur nesciunt et? Id, veritatis fuga?\nLorem ipsum dolor sit amet consectetur adipisicing elit. Maiores tempora, doloribus vero consectetur deleniti commodi tempore debitis possimus amet ex voluptatem totam facere reiciendis tenetur nesciunt et? Id, veritatis fuga?\n',1,'2019-04-20 08:29:04',''),(3,'Новость','Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores tempora, doloribus vero consectetur deleniti commodi tempore debitis possimus amet ex voluptatem totam facere reiciendis tenetur nesciunt et? Id, veritatis fuga?\n',2,'2019-04-20 08:28:42',''),(4,'asdasdasdasdasdasdas','Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores tempora, doloribus vero consectetur deleniti commodi tempore debitis possimus amet ex voluptatem totam facere reiciendis tenetur nesciunt et? Id, veritatis fuga?\n',2,'2019-04-20 08:28:42',''),(5,'asdasdasdasdasdasdas','Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores tempora, doloribus vero consectetur deleniti commodi tempore debitis possimus amet ex voluptatem totam facere reiciendis tenetur nesciunt et? Id, veritatis fuga?\n',2,'2019-04-20 08:28:43',''),(6,'Asdasdasdasdasdas','Do you like Cheese Whiz? Spray tan? Fake eyelashes? That\'s what is Lorem Ipsum to many—it rubs them the wrong way, all the way. It\'s unreal, uncanny, makes you wonder if something is wrong, it seems to seek your attention for all the wrong reasons. Usually, we prefer the real thing, wine without sulfur based preservatives, real butter, not margarine, and so we\'d like our layouts and designs to be filled with real words, with thoughts that count, information that has value.\nThe toppings you may chose for that TV dinner pizza slice when you forgot to shop for foods, the paint you may slap on your face to impress the new boss is your business. But what about your daily bread? Design comps, layouts, wireframes—will your clients accept that you go about things the facile way? Authorities in our business will tell in no uncertain terms that Lorem Ipsum is that huge, huge no no to forswear forever. Not so fast, I\'d say, there are some redeeming factors in favor of greeking text, as its use is merely the symptom of a worse problem to take into consideration.',1,'2019-04-20 08:31:53',''),(7,'asdasdasasdasdasdasdasdasdas','<p>asdasdasdasdasdasdasdasdasdas</p>',2,'2019-04-23 08:51:17',''),(8,'asdasdasasdasdasdasdasdasdas','<p>asdasdasdasdasdasdasdasdasdas</p>',2,'2019-04-23 08:51:40',''),(9,'asdasdasasdasdasdasdasdasdas','<p>asdasdasdasdasdasdasdasdasdas</p>',2,'2019-04-23 08:51:45',''),(10,'asdasdasasdasdasdasdasdasdas','<p>asdasdasdasdasdasdasdasdasdas</p>',2,'2019-04-23 08:51:45',''),(11,'asdasdasasdasdasdasdasdasdas','<p>asdasdasdasdasdasdasdasdasdas</p>',2,'2019-04-23 08:51:45',''),(12,'asdasdasasdasdasdasdasdasdas','<p>asdasdasdasdasdasdasdasdasdas</p>',2,'2019-04-23 08:51:46',''),(13,'asdasdasasdasdasdasdasdasdas','<p>asdasdasdasdasdasdasdasdasdas</p>',2,'2019-04-23 08:51:46',''),(14,'asdasdasdasdasdasdas','<p>asdasdasdaasdas</p>',2,'2019-04-23 08:52:13',''),(15,'asdasdasdasdasdasdas','<p>asdasdasdaasdas</p>',2,'2019-04-23 08:52:59',''),(16,'asdasdasasdasdasd','<p>asdasdasdasdasdadasdas</p>',2,'2019-04-23 08:53:13',''),(17,'asdasdasdasdasdasdasdas','<p>asdasdasdasdasdasdas</p>',2,'2019-04-23 08:53:25',''),(18,'asdasdasdsadasdasdsa','<p>&lt;script&gt;alert(1);&lt;/script&gt;</p>',2,'2019-04-23 08:56:45',''),(19,'Alert code JS','&lt;h2&gt;Новость&lt;br&gt;&lt;pre&gt;alert(&quot;Hello&quot;)&lt;/pre&gt;&lt;/h2&gt;',2,'2019-04-23 08:59:21',''),(20,'1234567890','<h1>asdasdasas</h1><pre>alert(\"Hello\")</pre><p>asdasdasdasdasdasdas</p>',2,'2019-04-23 09:19:10',''),(21,'12312312312312312123','<p>&lt;script&gt;alert(1);&lt;/script&gt;</p><pre>&lt;script&gt;alert(1);&lt;/script&gt;<br></pre>',2,'2019-04-23 09:19:45',''),(22,'12312312312312312123','<p>&lt;script&gt;alert(1);&lt;/script&gt;</p><pre>&lt;script&gt;alert(1);&lt;/script&gt;<br></pre>',2,'2019-04-23 09:21:51',''),(23,'asdasdasdasdasdasdasdas','<p>asdasdasdsadasdasdasdasdasdsa</p>',2,'2019-04-23 09:27:07',''),(25,'asdasdasdasdasdasd','<p>asdasdasdasdsadasdasdas</p>',2,'2019-04-23 10:21:46','/img/upload/f64d991ef5434504f6e6a43470a8bf52.'),(26,'asdasdasdasdasdas','<p>asdasdasdasdasdasdasdasdasdas</p>',2,'2019-04-23 10:22:16','/img/upload/291f71f6bb45b486c33fde8eebed4f7e.'),(27,'asdasdasdasdasd','<p>asdasdasdasdasdasdasdas</p>',2,'2019-04-23 10:22:29','/img/upload/e0532d2a2d4b20a532e7c8bd5742cd7c.'),(28,'asdasdasdasdasd','<p>asdasdasdasdasdasdasdas</p>',2,'2019-04-23 10:23:17','/img/upload/789664663476d71a0666893dd1c3f9cb.jpg');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newscomments`
--

DROP TABLE IF EXISTS `newscomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newscomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newscomments`
--

LOCK TABLES `newscomments` WRITE;
/*!40000 ALTER TABLE `newscomments` DISABLE KEYS */;
INSERT INTO `newscomments` VALUES (5,'asd',2,'2019-04-16 18:24:40',2),(6,'123',2,'2019-04-16 18:45:24',2),(7,'321',2,'2019-04-16 18:45:27',2),(8,'12312312',2,'2019-04-16 18:46:29',2),(9,'12312312',2,'2019-04-16 18:46:33',2),(10,'123',2,'2019-04-16 20:06:36',5),(11,'321',2,'2019-04-16 20:07:32',5),(12,'312312',1,'2019-04-16 20:15:03',6),(13,'asd',1,'2019-04-16 20:15:06',6),(14,'asd',1,'2019-04-16 20:15:10',6),(15,'asd',1,'2019-04-16 20:15:11',6),(16,'asd',1,'2019-04-16 20:15:12',6),(17,'asd',1,'2019-04-16 20:15:14',6),(18,'asd',1,'2019-04-16 20:15:15',6),(19,'ads',1,'2019-04-16 20:15:17',6),(20,'asd',1,'2019-04-16 20:15:19',6),(21,'asd',1,'2019-04-16 20:15:21',6),(22,'asd',1,'2019-04-16 20:15:23',6),(23,'asd',1,'2019-04-16 20:15:25',6),(24,'vasya',3,'2019-04-16 20:50:31',6),(25,'ф',2,'2019-04-17 14:00:23',6),(26,'2',1,'2019-04-17 14:00:53',5),(27,'12312312',2,'2019-04-20 09:18:01',6),(28,'123',2,'2019-04-20 09:26:19',3),(29,'asd',2,'2019-04-23 08:33:42',6),(30,'<script>alert(1);</script>',2,'2019-04-23 09:29:43',22),(31,'hello',6,'2019-04-23 09:50:06',19),(32,'3',6,'2019-04-23 09:52:40',5);
/*!40000 ALTER TABLE `newscomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `permission` varchar(50) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`permission_id`,`permission`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES ('ADD_ARTICLES',1),('ADD_COMMENTS',2);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `index_id2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permissions`
--

LOCK TABLES `user_permissions` WRITE;
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;
INSERT INTO `user_permissions` VALUES (1,2,1),(2,2,2),(3,1,2),(4,6,2);
/*!40000 ALTER TABLE `user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` int(255) NOT NULL DEFAULT '1',
  `avatar_url` varchar(255) NOT NULL DEFAULT '/img/default_avatar.jpg',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Andrey',1,'/img/default_avatar.jpg','ec6a6536ca304edf844d1d248a4f08dc'),(2,'admin',1,'/img/default_avatar.jpg','ec6a6536ca304edf844d1d248a4f08dc'),(3,'vasya',1,'/img/default_avatar.jpg','4e40beaf133b47b8b0020881b20ad713'),(4,'petya',1,'/img/default_avatar.jpg','ec6a6536ca304edf844d1d248a4f08dc'),(6,'vasya',1,'/img/default_avatar.jpg','69a082be2e9089ad8e363ee8916e47bb');
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

-- Dump completed on 2019-04-23 13:28:30

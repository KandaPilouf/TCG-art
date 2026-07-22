-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tcg_card_art
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `artist`
--

DROP TABLE IF EXISTS `artist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_artist` (`artist`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist`
--

LOCK TABLES `artist` WRITE;
/*!40000 ALTER TABLE `artist` DISABLE KEYS */;
INSERT INTO `artist` VALUES (3,'aky CG Works'),(8,'Alessandra Pisano'),(5,'Brian Snõddy'),(23,'Chris Rahn'),(2,'Eric Velhagen'),(16,'Greg Rutkowski'),(7,'Ilya Kuvshinov'),(4,'Jeanne D\'Angelo'),(19,'John Avon'),(21,'Kekai Kotaki'),(22,'Raymond Swanland'),(18,'Rebecca Guay'),(6,'Rovina Cai'),(1,'Sami Khan'),(20,'Terese Nielsen'),(9,'Tianhua X'),(17,'Yoshitaka Amano');
/*!40000 ALTER TABLE `artist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk',
  `name` varchar(300) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `img` varchar(250) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `style_id` int(11) DEFAULT NULL COMMENT 'style fk',
  `universe_id` int(11) DEFAULT NULL COMMENT 'universe fk',
  `creation_date` date DEFAULT NULL COMMENT 'date of creation',
  `variant_id` int(11) DEFAULT NULL COMMENT 'variant fk',
  `primary_color_id` int(11) DEFAULT NULL COMMENT 'primary color fk',
  `artist_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `primary_color_id` (`primary_color_id`),
  KEY `style_id` (`style_id`),
  KEY `universe_id` (`universe_id`),
  KEY `variant_id` (`variant_id`),
  CONSTRAINT `card_ibfk_1` FOREIGN KEY (`primary_color_id`) REFERENCES `color` (`id`),
  CONSTRAINT `card_ibfk_2` FOREIGN KEY (`style_id`) REFERENCES `style` (`id`),
  CONSTRAINT `card_ibfk_4` FOREIGN KEY (`universe_id`) REFERENCES `universe` (`id`),
  CONSTRAINT `card_ibfk_5` FOREIGN KEY (`variant_id`) REFERENCES `variant` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` VALUES (3,'something cool','something_cool','https://cards.scryfall.io/large/front/5/b/5b11ec26-9e07-45e1-bcaa-5d44d1231586.jpg?1738356473https://cards.scryfall.io/large/front/5/b/5b11ec26-9e07-45e1-bcaa-5d44d1231586.jpg?1738356473',1,1,1,'2026-05-23',1,1,1),(4,'Scorching','scorching_dragonfire','https://cards.scryfall.io/large/front/3/b/3b74a806-ed74-458e-8903-d3d084e9f507.jpg?1636491470',0,1,1,'2026-05-23',3,1,2),(5,'Surfing Pika VMAX','surfing_pikachu_VMAX','https://limitlesstcg.nyc3.cdn.digitaloceanspaces.com/tpci/CEL/CEL_009_R_EN_LG.png',0,1,2,'2021-10-20',1,2,3),(10,'Island','island','https://cards.scryfall.io/large/front/c/4/c4555e99-7f95-4c76-914f-0a42d49975cd.jpg?1650293608',0,3,1,'2022-12-04',1,3,4),(11,'Granulate','granulate','https://cards.scryfall.io/large/front/e/1/e13798b8-689e-4f19-af10-b72d3fe19f3c.jpg?1657014395',0,2,3,'2004-06-04',2,1,5),(12,'Ephemerate','ephemerate','https://cards.scryfall.io/large/front/7/b/7be5092f-cd24-4aea-824e-67b9767019b2.jpg?1623592356',0,1,3,'2019-06-14',1,2,6),(13,'Jackie Welles — Ride or Die Choom','jackie_welles-ride-or-die','https://dstcynss47vun.cloudfront.net/prod/cyberpunk/portal/12d44604-ad7b-4e82-b517-9edb0be44427/render-mpvlnb2e.webp?Expires=1782511367&Key-Pair-Id=K3SGRHESIHQPEW&Signature=O8fo~TmHhkQA-Ip77rdZVD2EZUUTEWQb8~PeIrZGzhCJFxZpSTUpOksMzTZ5wziJ9Sun8tsqQjAP5',1,3,1,'2026-01-01',3,2,7),(14,'Jackie Welles — Ride or Die Choom','jackie-welles-ride-or-die','https://dstcynss47vun.cloudfront.net/prod/cyberpunk/portal/12d44604-ad7b-4e82-b517-9edb0be44427/render-mpvlnb2e.webp?Expires=1782511367&Key-Pair-Id=K3SGRHESIHQPEW&Signature=O8fo~TmHhkQA-Ip77rdZVD2EZUUTEWQb8~PeIrZGzhCJFxZpSTUpOksMzTZ5wziJ9Sun8tsqQjAP5',1,3,4,'2026-01-01',3,2,7),(15,'Jackie Welles — Ride or Die Choom','jackie-welles-ride-or-die','https://preview.redd.it/jackie-welles-ride-or-die-choom-updated-v0-c20wm3s6e96h1.jpeg?width=640&crop=smart&auto=webp&s=90112313be990870d0bb0389d6acbdb940fade59',0,3,4,'2026-01-01',3,2,7),(16,'Ancestors\' Aid','ancesstror_aid','https://cards.scryfall.io/large/front/b/c/bc49a9d1-9c5f-4a80-bab8-767f6d3b75e2.jpg?1781063294',1,1,3,'2023-01-27',2,1,8),(17,'Crow of Dark Tidings','crow-of-dark-tidings','https://cards.scryfall.io/display/front/1/4/14e4d1b5-72de-4062-9fdd-e9bfd655ee79.webp?1782712086',0,2,3,'2020-11-10',2,3,9);
/*!40000 ALTER TABLE `card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card_deck`
--

DROP TABLE IF EXISTS `card_deck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card_deck` (
  `id_card` int(11) NOT NULL COMMENT 'card id fk',
  `id_deck` int(11) NOT NULL COMMENT 'deck id fk',
  PRIMARY KEY (`id_card`,`id_deck`),
  KEY `id_deck` (`id_deck`),
  CONSTRAINT `card_deck_ibfk_1` FOREIGN KEY (`id_card`) REFERENCES `card` (`id`),
  CONSTRAINT `card_deck_ibfk_2` FOREIGN KEY (`id_deck`) REFERENCES `deck` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_deck`
--

LOCK TABLES `card_deck` WRITE;
/*!40000 ALTER TABLE `card_deck` DISABLE KEYS */;
INSERT INTO `card_deck` VALUES (4,1),(4,2),(5,2),(10,1),(12,1),(15,1),(15,2);
/*!40000 ALTER TABLE `card_deck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card_tag`
--

DROP TABLE IF EXISTS `card_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card_tag` (
  `id_card` int(11) NOT NULL COMMENT 'card id fk',
  `id_tag` int(11) NOT NULL COMMENT 'tag id fk',
  PRIMARY KEY (`id_card`,`id_tag`),
  KEY `id_card` (`id_card`),
  KEY `id_tag` (`id_tag`),
  CONSTRAINT `card_tag_ibfk_1` FOREIGN KEY (`id_card`) REFERENCES `card` (`id`),
  CONSTRAINT `card_tag_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_tag`
--

LOCK TABLES `card_tag` WRITE;
/*!40000 ALTER TABLE `card_tag` DISABLE KEYS */;
INSERT INTO `card_tag` VALUES (3,1),(10,3),(10,4),(10,5),(10,6),(10,7),(11,2),(11,6),(12,5),(13,2),(13,8),(13,9),(14,2),(14,8),(14,9),(15,2),(15,8),(15,9),(16,2),(16,7),(17,2),(17,4);
/*!40000 ALTER TABLE `card_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk',
  `color` varchar(100) NOT NULL COMMENT 'card primary color',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_color` (`color`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES (7,'Black'),(5,'Blue'),(16,'Brown'),(13,'Crimson'),(10,'Cyan'),(11,'Gold'),(6,'Green'),(4,'orange'),(9,'Pink'),(3,'Purple'),(1,'red'),(12,'Silver'),(14,'Teal'),(15,'Violet'),(8,'White'),(2,'Yellow');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deck`
--

DROP TABLE IF EXISTS `deck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deck` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk',
  `id_user` int(11) NOT NULL COMMENT 'user fk',
  `id_card_deck` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `deck_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deck`
--

LOCK TABLES `deck` WRITE;
/*!40000 ALTER TABLE `deck` DISABLE KEYS */;
INSERT INTO `deck` VALUES (1,1,0,'pokemon'),(2,1,0,'yellow cards');
/*!40000 ALTER TABLE `deck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk',
  `user_id` int(11) DEFAULT NULL COMMENT 'user fk',
  `card_id` int(11) NOT NULL COMMENT 'card fk',
  `mess` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'assigne/not assigned',
  PRIMARY KEY (`id`),
  KEY `card_id` (`card_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `card` (`id`),
  CONSTRAINT `message_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `style`
--

DROP TABLE IF EXISTS `style`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `style` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk',
  `style` varchar(100) NOT NULL COMMENT 'card primary style',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_style` (`style`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `style`
--

LOCK TABLES `style` WRITE;
/*!40000 ALTER TABLE `style` DISABLE KEYS */;
INSERT INTO `style` VALUES (16,'Anime/Manga'),(10,'Art nouveau'),(18,'Baroque'),(5,'Cel-shaded'),(15,'Comic/Western'),(14,'Concept art'),(19,'Cyberpunk'),(11,'Gothic'),(1,'High-fantasy'),(13,'Impressionism'),(9,'Ink/Sumi-e'),(17,'Minimalist'),(2,'Monster'),(7,'Oil painting'),(8,'Pixel art'),(3,'Psychedelic'),(4,'Realism'),(20,'Steampunk'),(12,'Surrealism'),(21,'Vaporwave'),(6,'Watercolor');
/*!40000 ALTER TABLE `style` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk',
  `tag` varchar(100) NOT NULL COMMENT 'card tag',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_tag` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (22,'angel'),(30,'armor'),(25,'battle'),(31,'beast'),(5,'Celestial'),(9,'Choom'),(1,'Crossbow'),(2,'cute'),(8,'cyberpunk'),(21,'demon'),(11,'dragon'),(3,'Dreamscape'),(15,'fire'),(13,'forest'),(16,'ice'),(24,'landscape'),(19,'mage'),(26,'magic'),(12,'mecha'),(7,'MinimalistFantasy'),(27,'nature'),(29,'neon'),(14,'ocean'),(23,'portrait'),(20,'rogue'),(34,'ruins'),(4,'SeaSerpents'),(28,'space'),(32,'spirit'),(6,'TrippyArt'),(17,'undead'),(18,'warrior'),(33,'weapon');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `universe`
--

DROP TABLE IF EXISTS `universe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `universe` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'is pk',
  `universe` varchar(100) NOT NULL COMMENT 'card primary universe',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_universe` (`universe`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `universe`
--

LOCK TABLES `universe` WRITE;
/*!40000 ALTER TABLE `universe` DISABLE KEYS */;
INSERT INTO `universe` VALUES (24,'Bloodborne'),(4,'Cyberpunk'),(7,'DC'),(20,'Diablo'),(17,'Dragon Ball'),(14,'Dune'),(23,'Elden Ring'),(12,'Elder Scrolls'),(10,'Final Fantasy'),(22,'Genshin Impact'),(19,'Hearthstone'),(8,'Lord of the Rings'),(3,'Magic'),(6,'Marvel'),(15,'Naruto'),(16,'One Piece'),(2,'Pokemon'),(1,'Runeterra'),(5,'Star Wars'),(11,'Warhammer 40k'),(13,'Witcher'),(21,'World of Warcraft'),(18,'Yu-Gi-Oh'),(9,'Zelda');
/*!40000 ALTER TABLE `universe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk id',
  `name` varchar(100) NOT NULL COMMENT 'user name',
  `email` varchar(300) NOT NULL COMMENT 'user email',
  `pass` varchar(100) NOT NULL COMMENT 'pass cryptic',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT (curdate()),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'sami','samikhan199758@gmail.com','$2y$10$WHS2JhuU1zwiy6Y3JwIaK.L61olsIP8GVoEnL1iLxY6E296hKkyxC',1,'2026-06-06'),(2,'hello','darkness@myoldfriend.com','$2y$10$lpBoBooMvM1SOK7Df..1M.sn40Pa3Z9V3/WgBJ/.7q3VokyM8V2Tu',0,'2026-07-05');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variant`
--

DROP TABLE IF EXISTS `variant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variant` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk',
  `variant` varchar(100) NOT NULL COMMENT 'card variation',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_variant` (`variant`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variant`
--

LOCK TABLES `variant` WRITE;
/*!40000 ALTER TABLE `variant` DISABLE KEYS */;
INSERT INTO `variant` VALUES (9,'Alternate Art'),(2,'Common'),(3,'Epic'),(13,'First Edition'),(11,'Foil'),(8,'Full Art'),(12,'Holographic'),(4,'Legendary'),(5,'Mythic'),(10,'Promo'),(14,'Prototype'),(1,'Rare'),(7,'Secret Rare'),(6,'Uncommon');
/*!40000 ALTER TABLE `variant` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-22 13:03:34

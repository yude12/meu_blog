CREATE DATABASE  IF NOT EXISTS `meu_blog` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `meu_blog`;
-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: meu_blog
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `publicacoes`
--

DROP TABLE IF EXISTS `publicacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publicacoes` (
  `id_publicacao` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `conteudo` text NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_publicacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_publicacao`),
  KEY `fk_publicacoes_usuario` (`id_usuario`),
  CONSTRAINT `fk_publicacoes_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacoes`
--

LOCK TABLES `publicacoes` WRITE;
/*!40000 ALTER TABLE `publicacoes` DISABLE KEYS */;
INSERT INTO `publicacoes` VALUES (1,2,'wertyuiop´]','2025-11-12 03:40:32','2025-11-12 09:35:58'),(2,2,'qwdefrghjukio','2025-11-12 03:49:23','2025-11-12 09:35:58'),(3,2,'wsedxrtfcgyhu8ji9ko','2025-11-12 03:49:26','2025-11-12 09:35:58'),(4,2,'qwdefrghjukio','2025-11-12 03:49:34','2025-11-12 09:35:58'),(5,2,'1234567890-=','2025-11-12 04:02:08','2025-11-12 09:35:58'),(6,2,'21323454656789','2025-11-12 04:23:28','2025-11-12 09:35:58'),(7,2,'qwertyuio','2025-11-12 08:21:59','2025-11-12 09:35:58'),(8,2,'qwertyujk','2025-11-12 08:35:13','2025-11-12 09:35:58'),(9,2,'oiuytrewsdfghjk','2025-11-12 08:43:13','2025-11-12 09:35:58'),(10,2,'wertyuio','2025-11-12 08:51:47','2025-11-12 09:35:58'),(11,2,'qwe567890-','2025-11-12 08:57:01','2025-11-12 09:35:58'),(12,2,'sdertyuiop´[','2025-11-12 09:18:26','2025-11-12 09:35:58'),(13,2,'qwsdefrgthyjklç','2025-11-12 09:28:32','2025-11-12 09:35:58'),(14,2,'teste','2025-11-12 10:25:32','2025-11-12 10:25:32'),(15,2,'qwertyuiop','2025-11-22 10:18:29','2025-11-22 10:18:29'),(16,2,'sdhjklç','2025-12-07 17:27:02','2025-12-07 17:27:02'),(17,2,'fghjklç~]','2025-12-07 17:27:28','2025-12-07 17:27:28'),(18,2,'ertyuioç','2025-12-07 17:27:32','2025-12-07 17:27:32');
/*!40000 ALTER TABLE `publicacoes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-07 19:35:57

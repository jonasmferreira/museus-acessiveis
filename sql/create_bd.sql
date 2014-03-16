CREATE DATABASE  IF NOT EXISTS `museus_acessiveis` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `museus_acessiveis`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: museus_acessiveis
-- ------------------------------------------------------
-- Server version	5.6.12-log

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
-- Table structure for table `tb_anunciante`
--

DROP TABLE IF EXISTS `tb_anunciante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_anunciante` (
  `anunciante_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `anunciante_dt` date NOT NULL,
  `anunciante_hr` time NOT NULL,
  `anunciante_nome` varchar(255) NOT NULL,
  `anunciante_tipo_banner` enum('FB','RE') NOT NULL,
  `anunciante_banner` varchar(255) NOT NULL,
  `anunciante_banner_desc` varchar(255) NOT NULL,
  `anunciante_dt_agenda` date NOT NULL,
  PRIMARY KEY (`anunciante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_anunciante`
--

LOCK TABLES `tb_anunciante` WRITE;
/*!40000 ALTER TABLE `tb_anunciante` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_anunciante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_anunciante_tag`
--

DROP TABLE IF EXISTS `tb_anunciante_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_anunciante_tag` (
  `anunciante_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`anunciante_id`,`tag_id`),
  KEY `fk_tb_anunciante_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_anunciante_has_tb_tag_tb_anunciante1_idx` (`anunciante_id`),
  CONSTRAINT `fk_tb_anunciante_has_tb_tag_tb_anunciante1` FOREIGN KEY (`anunciante_id`) REFERENCES `tb_anunciante` (`anunciante_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_anunciante_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_anunciante_tag`
--

LOCK TABLES `tb_anunciante_tag` WRITE;
/*!40000 ALTER TABLE `tb_anunciante_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_anunciante_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_configuracao`
--

DROP TABLE IF EXISTS `tb_configuracao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_configuracao` (
  `configuracao_id` int(10) unsigned NOT NULL,
  `configuracao_baseurl_ckfinder` varchar(255) NOT NULL,
  `configuracao_baseurl` varchar(255) NOT NULL,
  PRIMARY KEY (`configuracao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_configuracao`
--

LOCK TABLES `tb_configuracao` WRITE;
/*!40000 ALTER TABLE `tb_configuracao` DISABLE KEYS */;
INSERT INTO `tb_configuracao` VALUES (1,'http://localhost/museus-acessiveis/img_editor','http://localhost/museus-acessiveis/');
/*!40000 ALTER TABLE `tb_configuracao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_download`
--

DROP TABLE IF EXISTS `tb_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_download` (
  `download_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `download_titulo` varchar(255) NOT NULL,
  `download_tipo` int(2) NOT NULL,
  `download_tamanho` decimal(25,2) NOT NULL,
  `download_arquivo` varchar(255) NOT NULL,
  `download_dt` date NOT NULL,
  `download_hr` time NOT NULL,
  PRIMARY KEY (`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_download`
--

LOCK TABLES `tb_download` WRITE;
/*!40000 ALTER TABLE `tb_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_imprensa`
--

DROP TABLE IF EXISTS `tb_imprensa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_imprensa` (
  `imprensa_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `imprensa_titulo` varchar(255) NOT NULL,
  `imprensa_tipo` int(2) NOT NULL,
  `imprensa_tamanho` decimal(25,2) NOT NULL,
  `imprensa_arquivo` varchar(255) NOT NULL,
  `imprensa_dt` date NOT NULL,
  `imprensa_hr` time NOT NULL,
  PRIMARY KEY (`imprensa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_imprensa`
--

LOCK TABLES `tb_imprensa` WRITE;
/*!40000 ALTER TABLE `tb_imprensa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_imprensa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_novidade_360`
--

DROP TABLE IF EXISTS `tb_novidade_360`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_novidade_360` (
  `novidade_360_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `novidade_360_dt_agenda` date NOT NULL,
  `novidade_360_dt` date NOT NULL,
  `tb_novidade_360col` varchar(45) DEFAULT NULL,
  `novidade_360_hr` time NOT NULL,
  `novidade_360_titulo` varchar(255) NOT NULL,
  `novidade_360_resumo` text NOT NULL,
  `novidade_360_thumb` varchar(255) NOT NULL,
  `novidade_360_thumb_desc` varchar(255) NOT NULL,
  `novidade_360_fonte` varchar(255) NOT NULL,
  `novidade_360_url_fonte` varchar(255) NOT NULL,
  `novidade_360_conteudo` longtext NOT NULL,
  `novidade_360_exibir_banner` enum('S','N') NOT NULL,
  `novidade_360_banner` varchar(255) NOT NULL,
  `novidade_360_banner_desc` text NOT NULL,
  `novidade_360_exibir_destaque_home` enum('S','N') NOT NULL,
  `novidade_360_destaque_home` varchar(255) NOT NULL,
  `novidade_360_destaque_home_desc` text NOT NULL,
  `novidade_360_destaque_home_frase` text NOT NULL,
  PRIMARY KEY (`novidade_360_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_novidade_360`
--

LOCK TABLES `tb_novidade_360` WRITE;
/*!40000 ALTER TABLE `tb_novidade_360` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_novidade_360` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_novidade_360_tag`
--

DROP TABLE IF EXISTS `tb_novidade_360_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_novidade_360_tag` (
  `novidade_360_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`novidade_360_id`,`tag_id`),
  KEY `fk_tb_novidade_360_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_novidade_360_has_tb_tag_tb_novidade_360_idx` (`novidade_360_id`),
  CONSTRAINT `fk_tb_novidade_360_has_tb_tag_tb_novidade_360` FOREIGN KEY (`novidade_360_id`) REFERENCES `tb_novidade_360` (`novidade_360_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_novidade_360_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_novidade_360_tag`
--

LOCK TABLES `tb_novidade_360_tag` WRITE;
/*!40000 ALTER TABLE `tb_novidade_360_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_novidade_360_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tag`
--

DROP TABLE IF EXISTS `tb_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tag` (
  `tag_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag_titulo` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tag`
--

LOCK TABLES `tb_tag` WRITE;
/*!40000 ALTER TABLE `tb_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_texto`
--

DROP TABLE IF EXISTS `tb_texto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_texto` (
  `texto_id` int(10) unsigned NOT NULL,
  `texto_dt` date NOT NULL,
  `texto_hr` time NOT NULL,
  `texto_conteudo` longtext NOT NULL,
  PRIMARY KEY (`texto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_texto`
--

LOCK TABLES `tb_texto` WRITE;
/*!40000 ALTER TABLE `tb_texto` DISABLE KEYS */;
INSERT INTO `tb_texto` VALUES (1,'0000-00-00','00:00:00',''),(2,'0000-00-00','00:00:00','');
/*!40000 ALTER TABLE `tb_texto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_usuario` (
  `usuario_id` bigint(19) unsigned NOT NULL,
  `usuario_nome` varchar(255) NOT NULL,
  `usuario_login` varchar(255) NOT NULL,
  `usuario_senha` varchar(45) NOT NULL,
  `usuario_email` varchar(255) NOT NULL,
  `usuario_nivel` enum('AS','A','U') NOT NULL DEFAULT 'U',
  `usuario_status` enum('A','I') NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuario`
--

LOCK TABLES `tb_usuario` WRITE;
/*!40000 ALTER TABLE `tb_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'museus_acessiveis'
--

--
-- Dumping routines for database 'museus_acessiveis'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-03-16 16:36:17

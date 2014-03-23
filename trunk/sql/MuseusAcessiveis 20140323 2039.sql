-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.12-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema museus_acessiveis
--

CREATE DATABASE IF NOT EXISTS museus_acessiveis;
USE museus_acessiveis;

--
-- Definition of table `tb_agenda`
--

DROP TABLE IF EXISTS `tb_agenda`;
CREATE TABLE `tb_agenda` (
  `agenda_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `agenda_dt_cad` date NOT NULL,
  `agenda_hr_cad` time NOT NULL,
  `agenda_titulo` varchar(255) NOT NULL,
  `agenda_resumo` text NOT NULL,
  `agenda_dt` date NOT NULL,
  `agenda_img` varchar(255) NOT NULL,
  `agenda_img_desc` text NOT NULL,
  `agenda_fonte` varchar(255) NOT NULL,
  `agenda_link_fonte` varchar(255) NOT NULL,
  `agenda_conteudo` varchar(255) NOT NULL,
  `agenda_exibir` enum('S','N') NOT NULL,
  PRIMARY KEY (`agenda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_agenda`
--

/*!40000 ALTER TABLE `tb_agenda` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_agenda` ENABLE KEYS */;


--
-- Definition of table `tb_agenda_tag`
--

DROP TABLE IF EXISTS `tb_agenda_tag`;
CREATE TABLE `tb_agenda_tag` (
  `agenda_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`agenda_id`,`tag_id`),
  KEY `fk_tb_agenda_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_agenda_has_tb_tag_tb_agenda1_idx` (`agenda_id`),
  CONSTRAINT `fk_tb_agenda_has_tb_tag_tb_agenda1` FOREIGN KEY (`agenda_id`) REFERENCES `tb_agenda` (`agenda_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_agenda_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_agenda_tag`
--

/*!40000 ALTER TABLE `tb_agenda_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_agenda_tag` ENABLE KEYS */;


--
-- Definition of table `tb_anunciante`
--

DROP TABLE IF EXISTS `tb_anunciante`;
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

--
-- Dumping data for table `tb_anunciante`
--

/*!40000 ALTER TABLE `tb_anunciante` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_anunciante` ENABLE KEYS */;


--
-- Definition of table `tb_anunciante_tag`
--

DROP TABLE IF EXISTS `tb_anunciante_tag`;
CREATE TABLE `tb_anunciante_tag` (
  `anunciante_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`anunciante_id`,`tag_id`),
  KEY `fk_tb_anunciante_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_anunciante_has_tb_tag_tb_anunciante1_idx` (`anunciante_id`),
  CONSTRAINT `fk_tb_anunciante_has_tb_tag_tb_anunciante1` FOREIGN KEY (`anunciante_id`) REFERENCES `tb_anunciante` (`anunciante_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_anunciante_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_anunciante_tag`
--

/*!40000 ALTER TABLE `tb_anunciante_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_anunciante_tag` ENABLE KEYS */;


--
-- Definition of table `tb_configuracao`
--

DROP TABLE IF EXISTS `tb_configuracao`;
CREATE TABLE `tb_configuracao` (
  `configuracao_id` int(10) unsigned NOT NULL,
  `configuracao_baseurl_ckfinder` varchar(255) NOT NULL,
  `configuracao_baseurl` varchar(255) NOT NULL,
  PRIMARY KEY (`configuracao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_configuracao`
--

/*!40000 ALTER TABLE `tb_configuracao` DISABLE KEYS */;
INSERT INTO `tb_configuracao` (`configuracao_id`,`configuracao_baseurl_ckfinder`,`configuracao_baseurl`) VALUES 
 (1,'http://localhost/MuseusAcessiveis/imgs_rich/','http://localhost/MuseusAcessiveis/');
/*!40000 ALTER TABLE `tb_configuracao` ENABLE KEYS */;


--
-- Definition of table `tb_contato`
--

DROP TABLE IF EXISTS `tb_contato`;
CREATE TABLE `tb_contato` (
  `contato_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `contato_dt` date NOT NULL,
  `contato_hr` time NOT NULL,
  `contato_tipo_id` int(10) unsigned NOT NULL,
  `contato_nome` varchar(255) NOT NULL,
  `contato_link` varchar(255) NOT NULL,
  `contato_exibir` enum('S','N') NOT NULL,
  PRIMARY KEY (`contato_id`),
  KEY `FK_tb_contato_1` (`contato_tipo_id`),
  CONSTRAINT `FK_tb_contato_1` FOREIGN KEY (`contato_tipo_id`) REFERENCES `tb_contato_tipo` (`contato_tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_contato`
--

/*!40000 ALTER TABLE `tb_contato` DISABLE KEYS */;
INSERT INTO `tb_contato` (`contato_id`,`contato_dt`,`contato_hr`,`contato_tipo_id`,`contato_nome`,`contato_link`,`contato_exibir`) VALUES 
 (1,'2014-03-22','00:20:14',2,'11 99801-7147','','S'),
 (2,'2014-03-23','00:20:14',1,'www.facebook.com/josenilson.oliveira','https://www.facebook.com/josenilson.c.oliveira?ref=tn_tnmn','S'),
 (3,'2014-03-22','00:20:14',5,'joynilson@gmail.com','joynilson@gmail.com','S');
/*!40000 ALTER TABLE `tb_contato` ENABLE KEYS */;


--
-- Definition of table `tb_contato_tipo`
--

DROP TABLE IF EXISTS `tb_contato_tipo`;
CREATE TABLE `tb_contato_tipo` (
  `contato_tipo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contato_tipo` varchar(45) NOT NULL,
  `contato_tipo_status` enum('S','N') NOT NULL,
  `contato_tipo_icone` varchar(255) DEFAULT NULL,
  `contato_tipo_icone_contraste` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`contato_tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_contato_tipo`
--

/*!40000 ALTER TABLE `tb_contato_tipo` DISABLE KEYS */;
INSERT INTO `tb_contato_tipo` (`contato_tipo_id`,`contato_tipo`,`contato_tipo_status`,`contato_tipo_icone`,`contato_tipo_icone_contraste`) VALUES 
 (1,'Facebook','S','20140322185208_ico_facebook.png','20140322185208_ico_facebook_contrast.png'),
 (2,'Celular','S','20140322185232_ico_cel.png','20140322185232_ico_cel_contrast.png'),
 (3,'Skype','S','20140322185312_ico_skype.png','20140322185312_ico_skype_contrast.png'),
 (5,'E-mail','S','20140322194900_ico_cel.png','20140322194900_ico_cel_contrast.png'),
 (6,'Site','S','20140323150017_ico_skype.png','20140323150018_ico_skype_contrast.png'),
 (7,'Telefone','S','20140323150842_ico_cel.png','20140323150842_ico_cel_contrast.png');
/*!40000 ALTER TABLE `tb_contato_tipo` ENABLE KEYS */;


--
-- Definition of table `tb_curso`
--

DROP TABLE IF EXISTS `tb_curso`;
CREATE TABLE `tb_curso` (
  `curso_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `curso_dt_cad` date NOT NULL,
  `curso_hr_cad` time NOT NULL,
  `curso_dt_ini` date NOT NULL,
  `curso_dt_fim` date NOT NULL,
  `curso_sob_demanda` enum('S','N') NOT NULL,
  `curso_titulo` varchar(255) NOT NULL,
  `curso_resumo` text NOT NULL,
  `curso_thumb` varchar(255) NOT NULL,
  `curso_thumb_desc` text NOT NULL,
  `curso_fonte` varchar(255) NOT NULL,
  `curso_link_fonte` varchar(255) NOT NULL,
  `curso_conteudo` longtext NOT NULL,
  `curso_agenda` date NOT NULL,
  PRIMARY KEY (`curso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Dumping data for table `tb_curso`
--

/*!40000 ALTER TABLE `tb_curso` DISABLE KEYS */;
INSERT INTO `tb_curso` (`curso_id`,`curso_dt_cad`,`curso_hr_cad`,`curso_dt_ini`,`curso_dt_fim`,`curso_sob_demanda`,`curso_titulo`,`curso_resumo`,`curso_thumb`,`curso_thumb_desc`,`curso_fonte`,`curso_link_fonte`,`curso_conteudo`,`curso_agenda`) VALUES 
 (1,'2014-03-22','13:52:56','2014-03-23','2014-03-31','N','Acessibilidade online','Aqui vai o resumo do curso','20140322184409_novidades.jpg','Aqui vai o resumo do curso','Stocco Art & Design','http://stoccoartedesign.wix.com/stoccoartedesign','<p>\r\n	Aqui vai o conte&uacute;do do curso, inclusive com as imagens que eu vou colocar...</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://localhost/MuseusAcessiveis/imgs_rich/images/Calendario_Capa.jpg\" style=\"width: 270px; height: 350px; float: left;\" /></p>\r\n<p>\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	E depois mais texto ainda.</p>\r\n','2014-03-24'),
 (2,'2014-03-22','20:54:42','0000-00-00','0000-00-00','N','','','','','','','','0000-00-00');
/*!40000 ALTER TABLE `tb_curso` ENABLE KEYS */;


--
-- Definition of table `tb_curso_download`
--

DROP TABLE IF EXISTS `tb_curso_download`;
CREATE TABLE `tb_curso_download` (
  `curso_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`curso_id`,`download_id`),
  KEY `fk_tb_curso_has_tb_download_tb_download1_idx` (`download_id`),
  KEY `fk_tb_curso_has_tb_download_tb_curso1_idx` (`curso_id`),
  CONSTRAINT `fk_tb_curso_has_tb_download_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_curso_has_tb_download_tb_download1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_curso_download`
--

/*!40000 ALTER TABLE `tb_curso_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_curso_download` ENABLE KEYS */;


--
-- Definition of table `tb_curso_extra`
--

DROP TABLE IF EXISTS `tb_curso_extra`;
CREATE TABLE `tb_curso_extra` (
  `curso_id` bigint(19) unsigned NOT NULL,
  `extra_id` bigint(19) unsigned NOT NULL,
  `curso_extra_valor` text NOT NULL,
  PRIMARY KEY (`curso_id`,`extra_id`),
  KEY `fk_tb_curso_has_tb_extra_tb_extra1_idx` (`extra_id`),
  KEY `fk_tb_curso_has_tb_extra_tb_curso1_idx` (`curso_id`),
  CONSTRAINT `fk_tb_curso_has_tb_extra_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_curso_has_tb_extra_tb_extra1` FOREIGN KEY (`extra_id`) REFERENCES `tb_extra` (`extra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_curso_extra`
--

/*!40000 ALTER TABLE `tb_curso_extra` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_curso_extra` ENABLE KEYS */;


--
-- Definition of table `tb_curso_glossario`
--

DROP TABLE IF EXISTS `tb_curso_glossario`;
CREATE TABLE `tb_curso_glossario` (
  `glossario_id` bigint(19) unsigned NOT NULL,
  `curso_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`glossario_id`,`curso_id`),
  KEY `fk_tb_glossario_has_tb_curso_tb_curso1_idx` (`curso_id`),
  KEY `fk_tb_glossario_has_tb_curso_tb_glossario1_idx` (`glossario_id`),
  CONSTRAINT `fk_tb_glossario_has_tb_curso_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_glossario_has_tb_curso_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_curso_glossario`
--

/*!40000 ALTER TABLE `tb_curso_glossario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_curso_glossario` ENABLE KEYS */;


--
-- Definition of table `tb_curso_tag`
--

DROP TABLE IF EXISTS `tb_curso_tag`;
CREATE TABLE `tb_curso_tag` (
  `tag_id` bigint(20) NOT NULL,
  `curso_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`tag_id`,`curso_id`),
  KEY `fk_tb_tag_has_tb_curso_tb_curso1_idx` (`curso_id`),
  KEY `fk_tb_tag_has_tb_curso_tb_tag1_idx` (`tag_id`),
  CONSTRAINT `fk_tb_tag_has_tb_curso_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_tag_has_tb_curso_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_curso_tag`
--

/*!40000 ALTER TABLE `tb_curso_tag` DISABLE KEYS */;
INSERT INTO `tb_curso_tag` (`tag_id`,`curso_id`) VALUES 
 (1,1),
 (2,1),
 (5,1),
 (2,2),
 (3,2);
/*!40000 ALTER TABLE `tb_curso_tag` ENABLE KEYS */;


--
-- Definition of table `tb_download`
--

DROP TABLE IF EXISTS `tb_download`;
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

--
-- Dumping data for table `tb_download`
--

/*!40000 ALTER TABLE `tb_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_download` ENABLE KEYS */;


--
-- Definition of table `tb_extra`
--

DROP TABLE IF EXISTS `tb_extra`;
CREATE TABLE `tb_extra` (
  `extra_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `extra_nome_campo` varchar(255) NOT NULL,
  PRIMARY KEY (`extra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_extra`
--

/*!40000 ALTER TABLE `tb_extra` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_extra` ENABLE KEYS */;


--
-- Definition of table `tb_glossario`
--

DROP TABLE IF EXISTS `tb_glossario`;
CREATE TABLE `tb_glossario` (
  `glossario_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `glossario_dt` date NOT NULL,
  `glossario_hr` time NOT NULL,
  `glossario_palavra` varchar(255) NOT NULL,
  `glossario_definicao` text NOT NULL,
  `glossario_fonte` varchar(255) NOT NULL,
  `glossario_link_fonte` varchar(255) NOT NULL,
  `glossario_conteudo` longtext NOT NULL,
  `glossario_exibir` enum('S','N') NOT NULL,
  PRIMARY KEY (`glossario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_glossario`
--

/*!40000 ALTER TABLE `tb_glossario` DISABLE KEYS */;
INSERT INTO `tb_glossario` (`glossario_id`,`glossario_dt`,`glossario_hr`,`glossario_palavra`,`glossario_definicao`,`glossario_fonte`,`glossario_link_fonte`,`glossario_conteudo`,`glossario_exibir`) VALUES 
 (1,'2014-03-22','13:21:57','Acessibilidade','Aqui a gente explica rapidamente como funciona','Google','www.google.com.br','<p>\r\n	Aqui tem todo o detalhamento do termo do gloss&aacute;rio para ser exibido em algum lugar do site.</p>\r\n','S'),
 (2,'2014-03-22','13:24:28','ISO','Internation Standardization Organization','JoynilsonArt','http://joynilsonart.blogspot.com','<p>\r\n	Aqui descrevemos para que serve o ISO e colocamos uma imagem para testar....</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://localhost/MuseusAcessiveis/imgs_rich/images/Calendario_Capa.jpg\" style=\"width: 270px; height: 350px; border-width: 0px; border-style: solid; margin: 0px; float: left;\" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	No final mais um texto e outra imagem.</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://localhost/MuseusAcessiveis/imgs_rich/images/Superman_rough.jpg\" style=\"width: 60%; height: 60%; border-width: 0px; border-style: solid; margin: 0px; float: right;\" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Depois fim!</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n','S');
/*!40000 ALTER TABLE `tb_glossario` ENABLE KEYS */;


--
-- Definition of table `tb_glossario_relacionado`
--

DROP TABLE IF EXISTS `tb_glossario_relacionado`;
CREATE TABLE `tb_glossario_relacionado` (
  `glossario_id` bigint(19) unsigned NOT NULL,
  `glossario_id1` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`glossario_id`,`glossario_id1`),
  KEY `fk_tb_glossario_has_tb_glossario_tb_glossario2_idx` (`glossario_id1`),
  KEY `fk_tb_glossario_has_tb_glossario_tb_glossario1_idx` (`glossario_id`),
  CONSTRAINT `fk_tb_glossario_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_glossario_has_tb_glossario_tb_glossario2` FOREIGN KEY (`glossario_id1`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_glossario_relacionado`
--

/*!40000 ALTER TABLE `tb_glossario_relacionado` DISABLE KEYS */;
INSERT INTO `tb_glossario_relacionado` (`glossario_id`,`glossario_id1`) VALUES 
 (2,1);
/*!40000 ALTER TABLE `tb_glossario_relacionado` ENABLE KEYS */;


--
-- Definition of table `tb_glossario_tag`
--

DROP TABLE IF EXISTS `tb_glossario_tag`;
CREATE TABLE `tb_glossario_tag` (
  `tag_id` bigint(20) NOT NULL,
  `glossario_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`tag_id`,`glossario_id`),
  KEY `fk_tb_tag_has_tb_glossario_tb_glossario1_idx` (`glossario_id`),
  KEY `fk_tb_tag_has_tb_glossario_tb_tag1_idx` (`tag_id`),
  CONSTRAINT `fk_tb_tag_has_tb_glossario_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_tag_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_glossario_tag`
--

/*!40000 ALTER TABLE `tb_glossario_tag` DISABLE KEYS */;
INSERT INTO `tb_glossario_tag` (`tag_id`,`glossario_id`) VALUES 
 (1,1),
 (2,1),
 (5,1),
 (2,2),
 (3,2);
/*!40000 ALTER TABLE `tb_glossario_tag` ENABLE KEYS */;


--
-- Definition of table `tb_imprensa`
--

DROP TABLE IF EXISTS `tb_imprensa`;
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

--
-- Dumping data for table `tb_imprensa`
--

/*!40000 ALTER TABLE `tb_imprensa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_imprensa` ENABLE KEYS */;


--
-- Definition of table `tb_mailing`
--

DROP TABLE IF EXISTS `tb_mailing`;
CREATE TABLE `tb_mailing` (
  `mailing_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `mailing_nome` varchar(45) NOT NULL,
  `mailing_email` varchar(45) NOT NULL,
  `mailing_enviar` enum('S','N') NOT NULL,
  PRIMARY KEY (`mailing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_mailing`
--

/*!40000 ALTER TABLE `tb_mailing` DISABLE KEYS */;
INSERT INTO `tb_mailing` (`mailing_id`,`mailing_nome`,`mailing_email`,`mailing_enviar`) VALUES 
 (1,'Josenilson Oliveira','joynilson@gmail.com','S'),
 (2,'Josenilson Costa','joynilsonart@yahoo.com.br','N'),
 (3,'Lilian Stocco','naradub@yahoo.com.br','S'),
 (4,'JoÃ£o Batista','fessorjoao@gmail.com','S'),
 (5,'Jonas Mendes','inboxfox@gmail.com','S'),
 (6,'Uchiha Tchoi','uchihatchoi@gmail.com','N');
/*!40000 ALTER TABLE `tb_mailing` ENABLE KEYS */;


--
-- Definition of table `tb_novidade_360`
--

DROP TABLE IF EXISTS `tb_novidade_360`;
CREATE TABLE `tb_novidade_360` (
  `novidade_360_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `novidade_360_dt_agenda` date NOT NULL,
  `novidade_360_dt` date NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_novidade_360`
--

/*!40000 ALTER TABLE `tb_novidade_360` DISABLE KEYS */;
INSERT INTO `tb_novidade_360` (`novidade_360_id`,`novidade_360_dt_agenda`,`novidade_360_dt`,`novidade_360_hr`,`novidade_360_titulo`,`novidade_360_resumo`,`novidade_360_thumb`,`novidade_360_thumb_desc`,`novidade_360_fonte`,`novidade_360_url_fonte`,`novidade_360_conteudo`,`novidade_360_exibir_banner`,`novidade_360_banner`,`novidade_360_banner_desc`,`novidade_360_exibir_destaque_home`,`novidade_360_destaque_home`,`novidade_360_destaque_home_desc`,`novidade_360_destaque_home_frase`) VALUES 
 (1,'2014-03-24','2014-03-23','14:56:56','A primeira novidade','fasdfjksd sajfksdkf jskd','20140323000352_novidades.jpg','lalallala','Google','www.google.com.br','<p>\r\n	fasdf dfds</p>\r\n<p>\r\n	&nbsp;sdf</p>\r\n<p>\r\n	sdf</p>\r\n<p>\r\n	sdsd</p>\r\n<p>\r\n	fsd</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	s fsd</p>\r\n<p>\r\n	fsd</p>\r\n','S','20140323145656_outdoor_dest.jpg','','S','20140323145656_destaque.jpg','fasd h sdh fsd  skdhf sdjkaaaaa','frase de efeito final.'),
 (2,'2014-03-25','2014-03-23','23:06:41','Segunda novidade','um resumo','20140323141436_novidades.jpg','descriÃ§Ã£o do outdoor','Uol','www.uol.com.br','<p>\r\n	o conte&uacute;do da not&iacute;cia.</p>\r\n','S','20140323230641_outdoor_dest2.jpg','lelelelel','S','20140323141436_destaque.jpg','descriÃ§Ã£o da imagem de destaque','Uma frase bem legal para destacar'),
 (3,'2014-03-20','2014-03-23','23:07:20','Mais uma novidade','um resumo lalala','20140323201925_novidades.jpg','descriÃ§Ã£o do thumb lalal','Google','www.google.com.br','<p>\r\n	Aqui o texto completo...</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	fsa</p>\r\n<p>\r\n	fds</p>\r\n<p>\r\n	d</p>\r\n<p>\r\n	fd</p>\r\n<p>\r\n	fim.</p>\r\n','S','20140323230720_outdoor_dest4.jpg','lalalala ','S','20140323201925_destaque.jpg','destaque lalala','a frase final de efeito'),
 (4,'2014-03-17','2014-03-23','17:27:27','quarta novidade','quartanovidad dfasdfds','20140323202727_novidades.jpg','descriÃ§Ã£o da novidade','Uol','www.uol.com.br','<p>\r\n	vamos ver como &eacute; que funciona tudo.</p>\r\n','N','','','N','','',''),
 (5,'2014-03-12','2014-03-23','17:32:37','lalalala','lelelele','20140323203237_novidades.jpg','lliilii','hahahh','www.hahaha.com','<p>\r\n	llololocsd&nbsp; losdd lfosd&nbsp; skdfsdk&nbsp; sdkfdsk fsd</p>\r\n','N','','','N','','','');
/*!40000 ALTER TABLE `tb_novidade_360` ENABLE KEYS */;


--
-- Definition of table `tb_novidade_360_tag`
--

DROP TABLE IF EXISTS `tb_novidade_360_tag`;
CREATE TABLE `tb_novidade_360_tag` (
  `novidade_360_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`novidade_360_id`,`tag_id`),
  KEY `fk_tb_novidade_360_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_novidade_360_has_tb_tag_tb_novidade_360_idx` (`novidade_360_id`),
  CONSTRAINT `fk_tb_novidade_360_has_tb_tag_tb_novidade_360` FOREIGN KEY (`novidade_360_id`) REFERENCES `tb_novidade_360` (`novidade_360_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_novidade_360_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_novidade_360_tag`
--

/*!40000 ALTER TABLE `tb_novidade_360_tag` DISABLE KEYS */;
INSERT INTO `tb_novidade_360_tag` (`novidade_360_id`,`tag_id`) VALUES 
 (2,2),
 (3,2),
 (1,3),
 (2,3),
 (4,5);
/*!40000 ALTER TABLE `tb_novidade_360_tag` ENABLE KEYS */;


--
-- Definition of table `tb_projeto`
--

DROP TABLE IF EXISTS `tb_projeto`;
CREATE TABLE `tb_projeto` (
  `projeto_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `projeto_dt_cad` date NOT NULL,
  `projeto_hr_cad` time NOT NULL,
  `projeto_dt_ini` date NOT NULL,
  `projeto_dt_fim` date NOT NULL,
  `projeto_sob_demanda` enum('S','N') NOT NULL,
  `projeto_tipo` enum('A','R','EA') NOT NULL,
  `projeto_titulo` varchar(255) NOT NULL,
  `projeto_resumo` text NOT NULL,
  `projeto_thumb` varchar(255) NOT NULL,
  `projeto_thumb_desc` text NOT NULL,
  `projeto_fonte` varchar(255) NOT NULL,
  `projeto_link_fonte` varchar(255) NOT NULL,
  `projeto_agenda` date NOT NULL,
  `projeto_conteudo` longtext NOT NULL,
  PRIMARY KEY (`projeto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_projeto`
--

/*!40000 ALTER TABLE `tb_projeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_projeto` ENABLE KEYS */;


--
-- Definition of table `tb_projeto_download`
--

DROP TABLE IF EXISTS `tb_projeto_download`;
CREATE TABLE `tb_projeto_download` (
  `projeto_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`projeto_id`,`download_id`),
  KEY `fk_tb_projeto_has_tb_download_tb_download1_idx` (`download_id`),
  KEY `fk_tb_projeto_has_tb_download_tb_projeto1_idx` (`projeto_id`),
  CONSTRAINT `fk_tb_projeto_has_tb_download_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_projeto_has_tb_download_tb_download1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_projeto_download`
--

/*!40000 ALTER TABLE `tb_projeto_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_projeto_download` ENABLE KEYS */;


--
-- Definition of table `tb_projeto_extra`
--

DROP TABLE IF EXISTS `tb_projeto_extra`;
CREATE TABLE `tb_projeto_extra` (
  `projeto_id` bigint(19) unsigned NOT NULL,
  `extra_id` bigint(19) unsigned NOT NULL,
  `projeto_extra_valor` text NOT NULL,
  PRIMARY KEY (`projeto_id`,`extra_id`),
  KEY `fk_tb_projeto_has_tb_extra_tb_extra1_idx` (`extra_id`),
  KEY `fk_tb_projeto_has_tb_extra_tb_projeto1_idx` (`projeto_id`),
  CONSTRAINT `fk_tb_projeto_has_tb_extra_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_projeto_has_tb_extra_tb_extra1` FOREIGN KEY (`extra_id`) REFERENCES `tb_extra` (`extra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_projeto_extra`
--

/*!40000 ALTER TABLE `tb_projeto_extra` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_projeto_extra` ENABLE KEYS */;


--
-- Definition of table `tb_projeto_glossario`
--

DROP TABLE IF EXISTS `tb_projeto_glossario`;
CREATE TABLE `tb_projeto_glossario` (
  `projeto_id` bigint(19) unsigned NOT NULL,
  `glossario_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`projeto_id`,`glossario_id`),
  KEY `fk_tb_projeto_has_tb_glossario_tb_glossario1_idx` (`glossario_id`),
  KEY `fk_tb_projeto_has_tb_glossario_tb_projeto1_idx` (`projeto_id`),
  CONSTRAINT `fk_tb_projeto_has_tb_glossario_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_projeto_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_projeto_glossario`
--

/*!40000 ALTER TABLE `tb_projeto_glossario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_projeto_glossario` ENABLE KEYS */;


--
-- Definition of table `tb_projeto_tag`
--

DROP TABLE IF EXISTS `tb_projeto_tag`;
CREATE TABLE `tb_projeto_tag` (
  `projeto_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`projeto_id`,`tag_id`),
  KEY `fk_tb_projeto_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_projeto_has_tb_tag_tb_projeto1_idx` (`projeto_id`),
  CONSTRAINT `fk_tb_projeto_has_tb_tag_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_projeto_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_projeto_tag`
--

/*!40000 ALTER TABLE `tb_projeto_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_projeto_tag` ENABLE KEYS */;


--
-- Definition of table `tb_servico`
--

DROP TABLE IF EXISTS `tb_servico`;
CREATE TABLE `tb_servico` (
  `servico_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `servico_dt_cad` date NOT NULL,
  `servico_hr_cad` time NOT NULL,
  `servico_dt_ini` date NOT NULL,
  `servico_dt_fim` date NOT NULL,
  `servico_sob_demanda` enum('S','N') NOT NULL,
  `servico_titulo` varchar(255) NOT NULL,
  `servico_resumo` text NOT NULL,
  `servico_thumb` varchar(255) NOT NULL,
  `servico_thumb_desc` text NOT NULL,
  `servico_fonte` varchar(255) NOT NULL,
  `servico_link_fonte` varchar(255) NOT NULL,
  `servico_agenda` date NOT NULL,
  `servico_conteudo` longtext NOT NULL,
  PRIMARY KEY (`servico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_servico`
--

/*!40000 ALTER TABLE `tb_servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_servico` ENABLE KEYS */;


--
-- Definition of table `tb_servico_download`
--

DROP TABLE IF EXISTS `tb_servico_download`;
CREATE TABLE `tb_servico_download` (
  `servico_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`servico_id`,`download_id`),
  KEY `fk_tb_servico_has_tb_download_tb_download1_idx` (`download_id`),
  KEY `fk_tb_servico_has_tb_download_tb_servico1_idx` (`servico_id`),
  CONSTRAINT `fk_tb_servico_has_tb_download_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_servico_has_tb_download_tb_download1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_servico_download`
--

/*!40000 ALTER TABLE `tb_servico_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_servico_download` ENABLE KEYS */;


--
-- Definition of table `tb_servico_extra`
--

DROP TABLE IF EXISTS `tb_servico_extra`;
CREATE TABLE `tb_servico_extra` (
  `servico_id` bigint(19) unsigned NOT NULL,
  `extra_id` bigint(19) unsigned NOT NULL,
  `servico_extra_valor` text NOT NULL,
  PRIMARY KEY (`servico_id`,`extra_id`),
  KEY `fk_tb_servico_has_tb_extra_tb_extra1_idx` (`extra_id`),
  KEY `fk_tb_servico_has_tb_extra_tb_servico1_idx` (`servico_id`),
  CONSTRAINT `fk_tb_servico_has_tb_extra_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_servico_has_tb_extra_tb_extra1` FOREIGN KEY (`extra_id`) REFERENCES `tb_extra` (`extra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_servico_extra`
--

/*!40000 ALTER TABLE `tb_servico_extra` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_servico_extra` ENABLE KEYS */;


--
-- Definition of table `tb_servico_glossario`
--

DROP TABLE IF EXISTS `tb_servico_glossario`;
CREATE TABLE `tb_servico_glossario` (
  `servico_id` bigint(19) unsigned NOT NULL,
  `glossario_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`servico_id`,`glossario_id`),
  KEY `fk_tb_servico_has_tb_glossario_tb_glossario1_idx` (`glossario_id`),
  KEY `fk_tb_servico_has_tb_glossario_tb_servico1_idx` (`servico_id`),
  CONSTRAINT `fk_tb_servico_has_tb_glossario_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_servico_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_servico_glossario`
--

/*!40000 ALTER TABLE `tb_servico_glossario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_servico_glossario` ENABLE KEYS */;


--
-- Definition of table `tb_servico_tag`
--

DROP TABLE IF EXISTS `tb_servico_tag`;
CREATE TABLE `tb_servico_tag` (
  `tag_id` bigint(20) NOT NULL,
  `servico_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`tag_id`,`servico_id`),
  KEY `fk_tb_tag_has_tb_servico_tb_servico1_idx` (`servico_id`),
  KEY `fk_tb_tag_has_tb_servico_tb_tag1_idx` (`tag_id`),
  CONSTRAINT `fk_tb_tag_has_tb_servico_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_tag_has_tb_servico_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_servico_tag`
--

/*!40000 ALTER TABLE `tb_servico_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_servico_tag` ENABLE KEYS */;


--
-- Definition of table `tb_tag`
--

DROP TABLE IF EXISTS `tb_tag`;
CREATE TABLE `tb_tag` (
  `tag_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag_titulo` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_tag`
--

/*!40000 ALTER TABLE `tb_tag` DISABLE KEYS */;
INSERT INTO `tb_tag` (`tag_id`,`tag_titulo`) VALUES 
 (1,'Acessibilidade'),
 (2,'Cursos'),
 (3,'Projetos'),
 (5,'Evento'),
 (6,'Agenda');
/*!40000 ALTER TABLE `tb_tag` ENABLE KEYS */;


--
-- Definition of table `tb_texto`
--

DROP TABLE IF EXISTS `tb_texto`;
CREATE TABLE `tb_texto` (
  `texto_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `texto_dt` date NOT NULL,
  `texto_hr` time NOT NULL,
  `texto_conteudo` longtext NOT NULL,
  PRIMARY KEY (`texto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_texto`
--

/*!40000 ALTER TABLE `tb_texto` DISABLE KEYS */;
INSERT INTO `tb_texto` (`texto_id`,`texto_dt`,`texto_hr`,`texto_conteudo`) VALUES 
 (1,'2014-03-21','10:00:00','Conteúdo do Quem Somos'),
 (2,'2014-03-21','10:15:00','Conteúdo do Acessibilidade');
/*!40000 ALTER TABLE `tb_texto` ENABLE KEYS */;


--
-- Definition of table `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE `tb_usuario` (
  `usuario_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_nome` varchar(255) NOT NULL,
  `usuario_login` varchar(255) NOT NULL,
  `usuario_senha` varchar(45) NOT NULL,
  `usuario_email` varchar(255) NOT NULL,
  `usuario_nivel` enum('AS','A','U') NOT NULL DEFAULT 'U',
  `usuario_status` enum('A','I') NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_usuario`
--

/*!40000 ALTER TABLE `tb_usuario` DISABLE KEYS */;
INSERT INTO `tb_usuario` (`usuario_id`,`usuario_nome`,`usuario_login`,`usuario_senha`,`usuario_email`,`usuario_nivel`,`usuario_status`) VALUES 
 (1,'Jonas Mendes','tchoi','destino','inboxfox@gmail.com','AS','A'),
 (2,'Josenilson Oliveira','joynilson','winnie','joynilson@gmail.com','AS','A');
/*!40000 ALTER TABLE `tb_usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

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
/*!40000 ALTER TABLE `tb_configuracao` ENABLE KEYS */;


--
-- Definition of table `tb_contato`
--

DROP TABLE IF EXISTS `tb_contato`;
CREATE TABLE `tb_contato` (
  `contato_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `contato_dt` date NOT NULL,
  `contato_hr` time NOT NULL,
  `contato_tipo` int(2) NOT NULL,
  `contato_nome` varchar(255) NOT NULL,
  `contato_link` varchar(45) NOT NULL,
  `contato_exibir` enum('S','N') NOT NULL,
  PRIMARY KEY (`contato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_contato`
--

/*!40000 ALTER TABLE `tb_contato` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_contato` ENABLE KEYS */;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Dumping data for table `tb_curso`
--

/*!40000 ALTER TABLE `tb_curso` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_glossario`
--

/*!40000 ALTER TABLE `tb_glossario` DISABLE KEYS */;
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
-- Definition of table `tb_newsletter`
--

DROP TABLE IF EXISTS `tb_newsletter`;
CREATE TABLE `tb_newsletter` (
  `newsletter_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `newsletter_nome` varchar(45) NOT NULL,
  `newsletter_email` varchar(45) NOT NULL,
  `newsletter_receber_informacoes` enum('S','N') NOT NULL,
  PRIMARY KEY (`newsletter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_newsletter`
--

/*!40000 ALTER TABLE `tb_newsletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_newsletter` ENABLE KEYS */;


--
-- Definition of table `tb_novidade_360`
--

DROP TABLE IF EXISTS `tb_novidade_360`;
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

--
-- Dumping data for table `tb_novidade_360`
--

/*!40000 ALTER TABLE `tb_novidade_360` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_tag`
--

/*!40000 ALTER TABLE `tb_tag` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_texto`
--

/*!40000 ALTER TABLE `tb_texto` DISABLE KEYS */;
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

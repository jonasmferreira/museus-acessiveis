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
  `anuncianete_banner_link` varchar(255) DEFAULT NULL,
  `anunciante_dt_agenda` date NOT NULL,
  PRIMARY KEY (`anunciante_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_anunciante`
--

/*!40000 ALTER TABLE `tb_anunciante` DISABLE KEYS */;
INSERT INTO `tb_anunciante` (`anunciante_id`,`anunciante_dt`,`anunciante_hr`,`anunciante_nome`,`anunciante_tipo_banner`,`anunciante_banner`,`anunciante_banner_desc`,`anuncianete_banner_link`,`anunciante_dt_agenda`) VALUES 
 (1,'2014-06-08','12:04:44','Kenzo','FB','20140608120713_perfumekenzo.jpg','SÃ©rie de perfumes com estampas marcantes','https://www.kenzo.com/','2014-06-09'),
 (2,'2014-06-08','12:11:13','Side Walk','RE','20140608121113_side_walk.jpg','Sapato de couro da marca.','http://www.sidewalklojas.com.br/inverno-2014/','2014-06-10'),
 (3,'2014-06-08','12:13:34','Lolita Lempka','FB','20140608121334_lilitalempka.jpg','Modelo posando para o anuncio','http://www.sephora.com.br/lolita-lempicka/perfumes/feminino/lolita-lempicka-feminino-eau-de-toilette-1725','2014-06-13'),
 (4,'2014-06-08','12:16:01','Paco Rabanne','RE','20140608121601_perfume_1_million.jpg','Imagem promocional do perfume','http://www.sephora.com.br/lolita-lempicka/perfumes/feminino/lolita-lempicka-feminino-eau-de-toilette-1725','2014-06-13'),
 (6,'2014-06-08','14:33:01','Perfume Natura','RE','20140608143301_capimlimao.jpg','3 perfumes natura','http://www.natura.net/br/index.html','0000-00-00'),
 (7,'2014-06-08','14:35:21','Tintas Suvinil','FB','20140608143521_banner_suvinil.jpg','3 latas suvinil','http://www.natura.net/br/index.html','2014-06-03');
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
  `configuracao_meta_author` varchar(255) DEFAULT NULL,
  `configuracao_meta_keywords` text,
  `configuracao_meta_description` text,
  PRIMARY KEY (`configuracao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_configuracao`
--

/*!40000 ALTER TABLE `tb_configuracao` DISABLE KEYS */;
INSERT INTO `tb_configuracao` (`configuracao_id`,`configuracao_baseurl_ckfinder`,`configuracao_baseurl`,`configuracao_meta_author`,`configuracao_meta_keywords`,`configuracao_meta_description`) VALUES 
 (1,'http://localhost/MuseusAcessiveis/imgs_rich/','http://localhost/MuseusAcessiveis/','Mobile Studio, JoÃ£o Batista de Macedo Jr, Josenilson Oliveira, Jonas Mendes','acessibilidade, museus acessÃ­veis, inclusÃ£o digital','Site especializado em inclusÃ£o digital para deficientes visuais. Realizamos cursos e projetos, alÃ©m de oferecer diversos serviÃ§os de inclusÃ£o social para deficientes visuais.');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_contato`
--

/*!40000 ALTER TABLE `tb_contato` DISABLE KEYS */;
INSERT INTO `tb_contato` (`contato_id`,`contato_dt`,`contato_hr`,`contato_tipo_id`,`contato_nome`,`contato_link`,`contato_exibir`) VALUES 
 (1,'2014-04-15','00:20:14',2,'11 976313962','','S'),
 (2,'2014-04-15','00:20:14',1,'www.facebook.com/museusacessiveis','https://www.facebook.com/museus.acessiveis?fref=ts','S'),
 (3,'2014-04-15','00:20:14',5,'Viviane Panelli Sarraf','viviane@museusacessiveis.com.br','S');
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
  `tipo_curso_id` bigint(20) unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Dumping data for table `tb_curso`
--

/*!40000 ALTER TABLE `tb_curso` DISABLE KEYS */;
INSERT INTO `tb_curso` (`curso_id`,`tipo_curso_id`,`curso_dt_cad`,`curso_hr_cad`,`curso_dt_ini`,`curso_dt_fim`,`curso_sob_demanda`,`curso_titulo`,`curso_resumo`,`curso_thumb`,`curso_thumb_desc`,`curso_fonte`,`curso_link_fonte`,`curso_conteudo`,`curso_agenda`) VALUES 
 (1,1,'2014-03-22','13:52:56','2014-06-25','2014-03-28','N','Acessibilidade online','Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos, desde pinturas bizantinas atÃ© movimentos mais recentes como os impressionistas, modernistas e contemporÃ¢neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a histÃ³ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como Ã© o caso de algumas tribos indÃ­genas brasileiras e americanas.','20140608115544_acess_online.jpg','Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos, desde pinturas bizantinas atÃ© movimentos mais recentes como os impressionistas, modernistas e contemporÃ¢neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a histÃ³ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como Ã© o caso de algumas tribos indÃ­genas brasileiras e americanas.','Stocco Art & Design','http://stoccoartedesign.wix.com/stoccoartedesign','<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n','2014-06-25'),
 (5,2,'2014-06-08','14:42:13','0000-00-00','0000-00-00','S','Treinamentos in Company','Cursos, palestras e workshops para profissionais de espaÃ§os culturais e museus, guias de turismo, espaÃ§os de lazer e entretenimento, agÃªncias de comunicaÃ§Ã£o e empresas com os temas: \r\nâ€¢	Relacionamento e atendimento de pessoas com deficiÃªncia\r\nâ€¢	EliminaÃ§Ã£o de barreiras atitudinais \r\nâ€¢	AÃ§Ã£o educativa acessÃ­vel e visitas inclusivas\r\nâ€¢	AudiodescriÃ§Ã£o\r\nâ€¢	Acessibilidade cultural para pessoas com deficiÃªncia\r\n','20140608144213_treinamentoincompany.jpg','Cursos, palestras e workshops para profissionais de espaÃ§os culturais e museus, guias de turismo, espaÃ§os de lazer e entretenimento, agÃªncias de comunicaÃ§Ã£o e empresas com os temas: \\r\\nâ€¢	Relacionamento e atendimento de pessoas com deficiÃªncia\\r\\nâ€¢	EliminaÃ§Ã£o de barreiras atitudinais \\r\\nâ€¢	AÃ§Ã£o educativa acessÃ­vel e visitas inclusivas\\r\\nâ€¢	AudiodescriÃ§Ã£o\\r\\nâ€¢	Acessibilidade cultural para pessoas com deficiÃªncia\\r\\n','','','<p>\r\n	Cursos, palestras e workshops para profissionais de espa&ccedil;os culturais e museus, guias de turismo, espa&ccedil;os de lazer e entretenimento, ag&ecirc;ncias de comunica&ccedil;&atilde;o e empresas com os temas: \\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Relacionamento e atendimento de pessoas com defici&ecirc;ncia\\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Elimina&ccedil;&atilde;o de barreiras atitudinais \\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>A&ccedil;&atilde;o educativa acess&iacute;vel e visitas inclusivas\\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Audiodescri&ccedil;&atilde;o\\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Acessibilidade cultural para pessoas com defici&ecirc;ncia\\r\\nCursos, palestras e workshops para profissionais de espa&ccedil;os culturais e museus, guias de turismo, espa&ccedil;os de lazer e entretenimento, ag&ecirc;ncias de comunica&ccedil;&atilde;o e empresas com os temas: \\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space: pre;\"> </span>Relacionamento e atendimento de pessoas com defici&ecirc;ncia\\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space: pre;\"> </span>Elimina&ccedil;&atilde;o de barreiras atitudinais \\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space: pre;\"> </span>A&ccedil;&atilde;o educativa acess&iacute;vel e visitas inclusivas\\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space: pre;\"> </span>Audiodescri&ccedil;&atilde;o\\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space: pre;\"> </span>Acessibilidade cultural para pessoas com defici&ecirc;ncia\\r\\n</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Cursos, palestras e workshops para profissionais de espa&ccedil;os culturais e museus, guias de turismo, espa&ccedil;os de lazer e entretenimento, ag&ecirc;ncias de comunica&ccedil;&atilde;o e empresas com os temas: \\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Relacionamento e atendimento de pessoas com defici&ecirc;ncia\\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Elimina&ccedil;&atilde;o de barreiras atitudinais \\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>A&ccedil;&atilde;o educativa acess&iacute;vel e visitas inclusivas\\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Audiodescri&ccedil;&atilde;o\\r\\n&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Acessibilidade cultural para pessoas com defici&ecirc;ncia\\r\\n</p>\r\n','0000-00-00'),
 (6,1,'2014-06-08','14:54:59','0000-00-00','0000-00-00','S','Desenvolvimento de Materiais de ComunicaÃ§Ã£o Sensorial','\r\nâ€¢	Maquetes tÃ¡teis de construÃ§Ãµes e espaÃ§os fÃ­sicos \r\nâ€¢	RÃ©plicas tÃ¡teis de esculturas e objetos histÃ³ricos\r\nâ€¢	Desenhos, documentos e mapas tÃ¡teis\r\nâ€¢	Paisagens sonoras para ambientaÃ§Ã£o de espaÃ§os, audiolivros, audioguias e publicaÃ§Ãµes em Ã¡udio\r\nâ€¢	Assinatura olfativa para ambientaÃ§Ã£o de espaÃ§os de exposiÃ§Ã£o, obras de arte e instalaÃ§Ãµes multimÃ­dia\r\nâ€¢	CriaÃ§Ã£o de cardÃ¡pios de alimentaÃ§Ã£o temÃ¡ticos (seguindo propostas de curadoria de exposiÃ§Ãµes a acervos de museus)\r\nâ€¢	Material de apoio para visitas educativas, mediaÃ§Ã£o  e atividades culturais multissensorial\r\n','20140608145459_materialsensorial.jpg','\\r\\nâ€¢	Maquetes tÃ¡teis de construÃ§Ãµes e espaÃ§os fÃ­sicos \\r\\nâ€¢	RÃ©plicas tÃ¡teis de esculturas e objetos histÃ³ricos\\r\\nâ€¢	Desenhos, documentos e mapas tÃ¡teis\\r\\nâ€¢	Paisagens sonoras para ambientaÃ§Ã£o de espaÃ§os, audiolivros, audioguias e publicaÃ§Ãµes em Ã¡udio\\r\\nâ€¢	Assinatura olfativa para ambientaÃ§Ã£o de espaÃ§os de exposiÃ§Ã£o, obras de arte e instalaÃ§Ãµes multimÃ­dia\\r\\nâ€¢	CriaÃ§Ã£o de cardÃ¡pios de alimentaÃ§Ã£o temÃ¡ticos (seguindo propostas de curadoria de exposiÃ§Ãµes a acervos de museus)\\r\\nâ€¢	Material de apoio para visitas educativas, mediaÃ§Ã£o  e atividades culturais multissensorial\\r\\n','','','<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Maquetes t&aacute;teis de constru&ccedil;&otilde;es e espa&ccedil;os f&iacute;sicos&nbsp;</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>R&eacute;plicas t&aacute;teis de esculturas e objetos hist&oacute;ricos</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Desenhos, documentos e mapas t&aacute;teis</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Paisagens sonoras para ambienta&ccedil;&atilde;o de espa&ccedil;os, audiolivros, audioguias e publica&ccedil;&otilde;es em &aacute;udio</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Assinatura olfativa para ambienta&ccedil;&atilde;o de espa&ccedil;os de exposi&ccedil;&atilde;o, obras de arte e instala&ccedil;&otilde;es multim&iacute;dia</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Cria&ccedil;&atilde;o de card&aacute;pios de alimenta&ccedil;&atilde;o tem&aacute;ticos (seguindo propostas de curadoria de exposi&ccedil;&otilde;es a acervos de museus)</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Material de apoio para visitas educativas, media&ccedil;&atilde;o &nbsp;e atividades culturais multissensorial</div>\r\n<div>\r\n	&nbsp;</div>\r\n','0000-00-00'),
 (9,1,'2014-06-18','08:37:13','0000-00-00','0000-00-00','N','Curso de Libras','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.','20140618083713_libras.jpg','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.','','','<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.</span></p>\r\n','0000-00-00'),
 (10,1,'2014-06-18','08:37:33','0000-00-00','0000-00-00','N','Libras 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.','20140618083733_libras.jpg','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.','','','<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.</span></p>\r\n','0000-00-00'),
 (11,1,'2014-06-18','08:38:14','0000-00-00','0000-00-00','N','Libras 3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.','20140618083813_libras.jpg','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.','','','<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel ornare lorem, at ornare sapien. Fusce convallis dignissim dictum. Mauris aliquam adipiscing tempus. Vivamus vel semper purus. Integer venenatis dui sed urna posuere, sit amet rutrum turpis tempus. Curabitur et volutpat orci. Ut hendrerit bibendum arcu, ut ullamcorper nisl fermentum sit amet. Donec tristique, erat eu interdum tristique, dolor orci euismod erat, vitae pulvinar arcu libero at neque. Quisque iaculis bibendum est, at placerat arcu ultrices nec. Nulla id lorem risus. Donec sit amet est sodales velit luctus pellentesque at ac metus. Duis rhoncus auctor massa, ac condimentum justo ullamcorper sed. Fusce porttitor hendrerit neque, non condimentum ante accumsan tincidunt. Phasellus a fermentum magna. Quisque gravida metus mattis, hendrerit est eu, varius leo.</span></p>\r\n','0000-00-00');
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
INSERT INTO `tb_curso_extra` (`curso_id`,`extra_id`,`curso_extra_valor`) VALUES 
 (1,1,''),
 (1,2,''),
 (5,1,''),
 (5,2,''),
 (6,1,''),
 (6,2,''),
 (9,1,''),
 (9,2,''),
 (10,1,''),
 (10,2,''),
 (11,1,''),
 (11,2,'');
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
  CONSTRAINT `fk_tb_glossario_has_tb_curso_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_glossario_has_tb_curso_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_curso_glossario`
--

/*!40000 ALTER TABLE `tb_curso_glossario` DISABLE KEYS */;
INSERT INTO `tb_curso_glossario` (`glossario_id`,`curso_id`) VALUES 
 (3,1),
 (4,1);
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
  CONSTRAINT `fk_tb_tag_has_tb_curso_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_tag_has_tb_curso_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_curso_tag`
--

/*!40000 ALTER TABLE `tb_curso_tag` DISABLE KEYS */;
INSERT INTO `tb_curso_tag` (`tag_id`,`curso_id`) VALUES 
 (1,1),
 (2,1),
 (5,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_download`
--

/*!40000 ALTER TABLE `tb_download` DISABLE KEYS */;
INSERT INTO `tb_download` (`download_id`,`download_titulo`,`download_tipo`,`download_tamanho`,`download_arquivo`,`download_dt`,`download_hr`) VALUES 
 (1,'A ComunicaÃ§Ã£o dos Sentidos nos EspaÃ§os Culturais Brasileiros - Tese de Doutorado de Viviane Panelli Sarraf',1,'2554843.00','20140326143526_tesedigital.pdf','2014-03-26','14:35:26'),
 (2,'NoÃ§Ã£o de competÃªncia e a formaÃ§Ã£o do aluno trabalhador',1,'10189318.00','20140608134209_104329.pdf','2014-06-08','13:42:09');
/*!40000 ALTER TABLE `tb_download` ENABLE KEYS */;


--
-- Definition of table `tb_emailmkt`
--

DROP TABLE IF EXISTS `tb_emailmkt`;
CREATE TABLE `tb_emailmkt` (
  `emailmkt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emailmkt_titulo` varchar(255) NOT NULL,
  `emailmkt_qtde_enviada` int(11) NOT NULL,
  `emailmkt_dt_agendada` date NOT NULL,
  `emailmkt_hr_agendada` time NOT NULL,
  `emailmkt_dt_disparo` date DEFAULT NULL,
  `emailmkt_hr_disparo` time DEFAULT NULL,
  `emailmkt_status` enum('P','X','E','C') NOT NULL DEFAULT 'P',
  `emailmkt_servico_ids` text NOT NULL,
  `emailmkt_projeto_ids` text NOT NULL,
  `emailmkt_glossario_ids` text NOT NULL,
  `emailmkt_novidade360_id` bigint(20) NOT NULL,
  `emailmkt_novidade360_ids` text NOT NULL,
  `emailmkt_agenda_ids` text NOT NULL,
  `emailmkt_arq_fisico` text NOT NULL,
  `emailmkt_aqui_tem_titulo` text NOT NULL,
  `emailmkt_aqui_tem_resumo` text NOT NULL,
  `emailmkt_aqui_tem_thumb` text NOT NULL,
  `emailmkt_aqui_tem_url` text NOT NULL,
  `emailmkt_propaganda_img` text NOT NULL,
  PRIMARY KEY (`emailmkt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_emailmkt`
--

/*!40000 ALTER TABLE `tb_emailmkt` DISABLE KEYS */;
INSERT INTO `tb_emailmkt` (`emailmkt_id`,`emailmkt_titulo`,`emailmkt_qtde_enviada`,`emailmkt_dt_agendada`,`emailmkt_hr_agendada`,`emailmkt_dt_disparo`,`emailmkt_hr_disparo`,`emailmkt_status`,`emailmkt_servico_ids`,`emailmkt_projeto_ids`,`emailmkt_glossario_ids`,`emailmkt_novidade360_id`,`emailmkt_novidade360_ids`,`emailmkt_agenda_ids`,`emailmkt_arq_fisico`,`emailmkt_aqui_tem_titulo`,`emailmkt_aqui_tem_resumo`,`emailmkt_aqui_tem_thumb`,`emailmkt_aqui_tem_url`,`emailmkt_propaganda_img`) VALUES 
 (1,'Teste 01',0,'2014-08-16','00:00:00',NULL,NULL,'P','2,3','1,2','4,9',10,'13,9','8=>N,10=>N,1=>C','','Aqui tem teste','Aqui vai o resumo do Aqui tem fasdfsd fdsf ds sdf sdaf sd fsd lalala e fim de papo.','20140807023821_emkt_aquitem_imagem.jpg','http://www.uol.com.br','20140807023821_emkt_imagem.png');
/*!40000 ALTER TABLE `tb_emailmkt` ENABLE KEYS */;


--
-- Definition of table `tb_emailmkt_conferencia`
--

DROP TABLE IF EXISTS `tb_emailmkt_conferencia`;
CREATE TABLE `tb_emailmkt_conferencia` (
  `emailmkt_conferencia_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emailmkt_id` int(10) unsigned NOT NULL,
  `mailing_id` bigint(20) unsigned NOT NULL,
  `mailing_email` varchar(255) NOT NULL,
  `emailmkt_conferencia_dt_disparo` date DEFAULT NULL,
  `emailmkt_conferencia_hr_disparo` time DEFAULT NULL,
  `emailmkt_conferencia_dt_visualizacao` date DEFAULT NULL,
  `emailmkt_conferencia_hr_visualizacao` time DEFAULT NULL,
  PRIMARY KEY (`emailmkt_conferencia_id`),
  KEY `idx_emailmkt_conferencia_01` (`mailing_email`),
  KEY `fk_emailmkt_conferencia_01_idx` (`emailmkt_id`),
  KEY `fk_emailmkt_conferencia_02_idx` (`mailing_id`),
  CONSTRAINT `fk_emailmkt_conferencia_01` FOREIGN KEY (`emailmkt_id`) REFERENCES `tb_emailmkt` (`emailmkt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emailmkt_conferencia_02` FOREIGN KEY (`mailing_id`) REFERENCES `tb_mailing` (`mailing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_emailmkt_conferencia`
--

/*!40000 ALTER TABLE `tb_emailmkt_conferencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_emailmkt_conferencia` ENABLE KEYS */;


--
-- Definition of table `tb_extra`
--

DROP TABLE IF EXISTS `tb_extra`;
CREATE TABLE `tb_extra` (
  `extra_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `extra_nome_campo` varchar(255) NOT NULL,
  PRIMARY KEY (`extra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_extra`
--

/*!40000 ALTER TABLE `tb_extra` DISABLE KEYS */;
INSERT INTO `tb_extra` (`extra_id`,`extra_nome_campo`) VALUES 
 (1,'Um campo para testes'),
 (2,'LicitaÃ§Ãµes');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_glossario`
--

/*!40000 ALTER TABLE `tb_glossario` DISABLE KEYS */;
INSERT INTO `tb_glossario` (`glossario_id`,`glossario_dt`,`glossario_hr`,`glossario_palavra`,`glossario_definicao`,`glossario_fonte`,`glossario_link_fonte`,`glossario_conteudo`,`glossario_exibir`) VALUES 
 (1,'2014-03-22','13:21:57','Acessibilidade','Aqui a gente explica rapidamente como funciona','Google','www.google.com.br','<p>\r\n	Aqui tem todo o detalhamento do termo do gloss&aacute;rio para ser exibido em algum lugar do site.</p>\r\n','S'),
 (2,'2014-03-22','13:24:28','ISO','Internation Standardization Organization','JoynilsonArt','http://joynilsonart.blogspot.com','<p>\r\n	Aqui descrevemos para que serve o ISO e colocamos uma imagem para testar....</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://localhost/MuseusAcessiveis/imgs_rich/images/Calendario_Capa.jpg\" style=\"width: 270px; height: 350px; border-width: 0px; border-style: solid; margin: 0px; float: left;\" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	No final mais um texto e outra imagem.</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://localhost/MuseusAcessiveis/imgs_rich/images/Superman_rough.jpg\" style=\"width: 60%; height: 60%; border-width: 0px; border-style: solid; margin: 0px; float: right;\" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Depois fim!</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n','S'),
 (3,'2014-03-25','12:43:10','Piso tÃ¡til','Ã‰ o piso diferenciado com textura e cor sempre em destaque com o piso que estiver ao redor. Deve ser perceptÃ­vel por pessoas com deficiÃªncia visual e baixa visÃ£o.','Thais Frota','http://thaisfrota.wordpress.com/2009/08/05/o-que-e-piso-tatil/','','S'),
 (4,'2014-03-26','13:45:27','AudiodescriÃ§Ã£o','Recurso de acessibilidade que permite que as pessoas com deficiÃªncia visual possam assistir e entender melhor filmes, peÃ§as de teatro, programas de TV, exposiÃ§Ãµes, mostras, musicais, Ã³peras e demais manifestaÃ§Ãµes e recursos visuais, por meio da traduÃ§Ã£o de imagens em textos descritivos.','Wikipedia','http://pt.wikipedia.org/wiki/Braille','<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n','S'),
 (6,'2014-04-15','11:01:36','Barreiras atitudinais','Preconceitos, estigmas e estereÃ³tipos, que resultam em discriminaÃ§Ã£o das pessoas com deficiÃªncia.','WikipÃ©dia','http://pt.wikipedia.org/wiki/Braille','<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n','S'),
 (7,'2014-04-15','11:05:00','Desenho Universal','Ã‰ criaÃ§Ã£o de ambientes, produtos e serviÃ§os acessÃ­veis para todas as pessoas, independente de suas caracterÃ­sticas pessoais, idade, ou habilidades. O conceito de Desenho Universal defende que qualquer ambiente ou produto pode ser alcanÃ§ado, manipulado e usado, independentemente do tamanho do corpo do indivÃ­duo, sua postura ou sua mobilidade.\r\n','WikipÃ©dia','http://pt.wikipedia.org/wiki/Braille','<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n','S'),
 (8,'2014-06-08','11:37:23','Audiovisual','ComunicaÃ§Ã£o audiovisual Ã© todo meio de comunicaÃ§Ã£o expresso com a utilizaÃ§Ã£o conjunta de componentes visuais (signos, imagens, desenhos, grÃ¡ficos etc.) e sonoros (voz, mÃºsica, ruÃ­do, efeitos sonoros etc.), ou seja, tudo que pode ser ao mesmo tempo visto e ouvido.','WikipÃ©dia','http://pt.wikipedia.org/wiki/Comunica%C3%A7%C3%A3o_audiovisual','<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n','S'),
 (9,'2014-06-08','11:42:47','Braille','Braille ou braile1 Ã© um sistema de leitura com o tato para cegos inventado pelo francÃªs Louis Braille no ano de 1827 em Paris.\r\n\r\nO Braille Ã© um alfabeto convencional cujos caracteres se indicam por pontos em alto relevo. O deficiente visual distingue por meio do tato. A partir dos seis pontos relevantes, Ã© possÃ­vel fazer 63 combinaÃ§Ãµes que podem representar letras simples e acentuadas, pontuaÃ§Ãµes, nÃºmeros, sinais matemÃ¡ticos e notas musicais.','WikipÃ©dia','http://pt.wikipedia.org/wiki/Braille','<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n','S'),
 (10,'2014-06-19','15:17:10','fauna','teste\r\nteste\r\nteste','','','<p>\r\n	testeteste</p>\r\n','S');
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
 (2,1),
 (3,2);
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
  CONSTRAINT `fk_tb_tag_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_tag_has_tb_glossario_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
 (3,2),
 (3,3),
 (1,4),
 (2,4),
 (3,4),
 (5,4),
 (6,4);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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
 (6,'Uchiha Tchoi','uchihatchoi@gmail.com','N'),
 (7,'JoÃ£o Batista de Macedo JÃºnior','fessorjoao@gmail.com','N');
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
  `novidade_360_titulo_sintese` varchar(45) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_novidade_360`
--

/*!40000 ALTER TABLE `tb_novidade_360` DISABLE KEYS */;
INSERT INTO `tb_novidade_360` (`novidade_360_id`,`novidade_360_dt_agenda`,`novidade_360_dt`,`novidade_360_hr`,`novidade_360_titulo`,`novidade_360_titulo_sintese`,`novidade_360_resumo`,`novidade_360_thumb`,`novidade_360_thumb_desc`,`novidade_360_fonte`,`novidade_360_url_fonte`,`novidade_360_conteudo`,`novidade_360_exibir_banner`,`novidade_360_banner`,`novidade_360_banner_desc`,`novidade_360_exibir_destaque_home`,`novidade_360_destaque_home`,`novidade_360_destaque_home_desc`,`novidade_360_destaque_home_frase`) VALUES 
 (6,'2014-03-27','2014-06-19','15:41:29','Arquitetura acessÃ­vel na Linha Amarela do metro','Arquitetura AcessÃ­vel','Piso TÃ¡til Ã© o piso diferenciado com textura e cor sempre em destaque com o piso que estiver ao redor. Deve ser perceptÃ­vel por pessoas com deficiÃªncia visual e baixa visÃ£o.\r\n\r\nÃ‰ importante saber que o piso tÃ¡til tem a funÃ§Ã£o de orientar pessoas com deficiÃªncia visual ou com baixa visÃ£o.','20140325125058_thumb.jpg','Grupo de pessoas andando no piso tÃ¡til.','Ãšltimo Segundo','http://ultimosegundo.ig.com.br/brasil/sp/2014-06-06/tres-linhas-do-metro-estao-paralisadas-pelo-segundo-dia-em-sao-paulo.html','<p style=\"padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;\">\r\n	Piso t&aacute;til &eacute; o piso diferenciado com&nbsp;<strong style=\"padding: 0px; margin: 0px;\">textura</strong>&nbsp;e&nbsp;<strong style=\"padding: 0px; margin: 0px;\">cor</strong>&nbsp;sempre em destaque com o piso que estiver ao redor. Deve ser percept&iacute;vel por pessoas com defici&ecirc;ncia visual e baixa vis&atilde;o.</p>\r\n<p style=\"padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;\">\r\n	<img alt=\"\" src=\"http://www.museusacessiveis.com.br/sitenovo/imgs_rich/images/foto_exemplo_500x375.jpg\" style=\"width: 500px; height: 375px;\" /></p>\r\n<p style=\"padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;\">\r\n	&Eacute; importante saber que o piso t&aacute;til tem a fun&ccedil;&atilde;o de orientar pessoas com defici&ecirc;ncia visual ou com baixa vis&atilde;o.</p>\r\n<p style=\"padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;\">\r\n	&nbsp;</p>\r\n<p style=\"padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;\">\r\n	Pode parecer abstrato para as pessoas que enxergam, mas para o deficiente visual e a pessoa com baixa vis&atilde;o este piso &eacute; fundamental para dar autonomia e seguran&ccedil;a no dia a dia!</p>\r\n<p style=\"padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;\">\r\n	&nbsp;</p>\r\n<p style=\"padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;\">\r\n	Existem dois tipos de piso t&aacute;til: piso t&aacute;til de alerta e piso t&aacute;til direcional.O piso t&aacute;til de alerta &eacute; conhecido popularmente como &ldquo;piso de bolinha&rdquo;. Sua fun&ccedil;&atilde;o, como o pr&oacute;prio nome j&aacute; diz, &eacute;&nbsp;<strong style=\"padding: 0px; margin: 0px;\">alertar</strong>. Por isso &eacute; instalado em in&iacute;cio e t&eacute;rmino de escadas e rampas; em frente &agrave; porta de elevadores; em rampas de acesso &agrave;s cal&ccedil;adas ou mesmo para alertar quanto a um obst&aacute;culo que o deficiente visual n&atilde;o consiga rastrear com a bengala.</p>\r\n<p style=\"padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;\">\r\n	<img alt=\"\" src=\"http://www.museusacessiveis.com.br/sitenovo/imgs_rich/images/foto_exemplo_500x375.jpg\" style=\"width: 500px; height: 375px;\" /></p>\r\n','N','','','N','','',''),
 (7,'2014-06-26','2014-06-13','07:49:21','Curso Acessibilidade em Museus','Curso Legal','Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos.','20140608103931_acessibilidade.jpg','CrianÃ§a cega tocando rÃ©plica de animal na exposiÃ§Ã£o Ãgua na OCA.','Acessibilidade nos Museus','http://acessibilidadenosmuseus.blogspot.com.br/','<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n','S','20140608103931_acessibilidade_museus.jpg','','N','','',''),
 (8,'2014-04-15','2014-06-12','14:32:12','Manual de Acesibilidade em Museus, PatrimÃ´nio Cultural e Natural Ã© lanÃ§ado na Espanha','Manual de Acesibilidade em Museus','LanÃ§ado na Espanha o Manual de Acessibilidade e InclusÃ£o em Museus e PatrimÃ´nio Cultural e Natural.','20140608101529_feira_espanha.jpg','Capa do manual. Fundo bege com faixa verde na parte superior. No centro o tÃ­tulo do livro em letras azuis sem serifa e na parte inferior uma letra M formada por pontos e o sÃ­mbolo universal de acessibilidade: uma pessoa em cadeira de rodas de perfil amb','Vilamuseu - Ediciones Trea','www.trea.es','<p>\r\n	Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.&nbsp;Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.&nbsp;Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.&nbsp;Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.&nbsp;Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.&nbsp;Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.</p>\r\n','S','20140608101529_outdoor.jpg','Capa do manual. Fundo bege com faixa verde na parte superior. No centro o tÃ­tulo do livro em letras azuis sem serifa e na parte inferior uma letra M formada por pontos e o sÃ­mbolo universal de acessibilidade: uma pessoa em cadeira de rodas de perfil ambos na cor verde claro.','N','','','LanÃ§ado na Espanha o Manual de Acessibilidade e InclusÃ£o em Museus e PatrimÃ´nio Cultural e Natural.'),
 (9,'2014-06-24','2014-06-08','10:49:20','Curso de ExtensÃ£o Acessibilidade em Museus na USP',NULL,'Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos.','20140608104456_usp.jpg','Marca da Universidade de SÃ£o Paulo','Google','https://www.google.com.br/search?q=usp&es_sm=119&tbm=isch&source=lnms&sa=X&ei=VWiUU5-MIYrPsATSvIDoAg&ved=0CAgQ_AUoAw&biw=1403&bih=726&dpr=0.9','<div>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</div>\r\n','N','','','N','','',''),
 (10,'2014-05-18','2014-06-08','10:29:04','Dia Internacional dos Museus',NULL,'No dia 18 de maio Ã© comemorado o Dia Mundial do Museu. A data foi instituÃ­da pelo ComitÃª Internacional de Museus (ICOM) com o objetivo de chamar a atenÃ§Ã£o da sociedade e do pÃºblico para a importÃ¢ncia dos museus. Afinal, sÃ£o os museus os responsÃ¡veis por preservar a histÃ³ria e a cultura da humanidade.','20140608102904_dia_internacional.jpg','Marca do evento escrito com letras brancas e pretas.','Smartkids','http://www.smartkids.com.br/datas-comemorativas/18-maio-dia-mundial-dos-museus.html','<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n','N','','','N','','',''),
 (11,'2014-06-10','2014-06-08','09:22:42','Feira Reatech',NULL,'ComeÃ§ou nesta quinta-feira a 12Âª ediÃ§Ã£o da Feira Internacional de Tecnologias em ReabilitaÃ§Ã£o, InclusÃ£o e Acessibilidade (Reatech), a maior do setor no paÃ­s. Segundo dados do Instituto Brasileiro de Geografia e EstatÃ­stica (IBGE), o Brasil possui atualmente cerca de 45 milhÃµes de pessoas com algum tipo de deficiÃªncia ou mobilidade reduzida.','20140608092242_reatech.jpg','IlustraÃ§Ã£o de um coraÃ§Ã£o azul dividido em 4 partes. Cada parte tem um Ã­cone que representa cada deficiÃªncia fÃ­sica.\r\nSob esta ilustraÃ§Ã£o existe um retÃ¢ngulo amarelo.','Canaltech','http://corporate.canaltech.com.br/noticia/eventos/Reatech-Veja-novidades-tecnologicas-da-maior-feira-de-acessibilidade-do-Brasil/','<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial; font-size: 13px;\">Com foco nas principais inova&ccedil;&otilde;es tecnol&oacute;gicas do setor, o evento tamb&eacute;m traz novos produtos, servi&ccedil;os, palestras, semin&aacute;rios, desfiles e shows. Participam empresas dos setores automobil&iacute;stico, financeiro, ind&uacute;stria, turismo, lazer, animais treinados, equipamentos especiais e at&eacute; ag&ecirc;ncias de emprego, que re&uacute;nem mais de sete mil vagas voltadas &agrave;s pessoas com defici&ecirc;ncia e mobilidade reduzida.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial; font-size: 13px;\">Com foco nas principais inova&ccedil;&otilde;es tecnol&oacute;gicas do setor, o evento tamb&eacute;m traz novos produtos, servi&ccedil;os, palestras, semin&aacute;rios, desfiles e shows. Participam empresas dos setores automobil&iacute;stico, financeiro, ind&uacute;stria, turismo, lazer, animais treinados, equipamentos especiais e at&eacute; ag&ecirc;ncias de emprego, que re&uacute;nem mais de sete mil vagas voltadas &agrave;s pessoas com defici&ecirc;ncia e mobilidade reduzida.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial; font-size: 13px;\">Com foco nas principais inova&ccedil;&otilde;es tecnol&oacute;gicas do setor, o evento tamb&eacute;m traz novos produtos, servi&ccedil;os, palestras, semin&aacute;rios, desfiles e shows. Participam empresas dos setores automobil&iacute;stico, financeiro, ind&uacute;stria, turismo, lazer, animais treinados, equipamentos especiais e at&eacute; ag&ecirc;ncias de emprego, que re&uacute;nem mais de sete mil vagas voltadas &agrave;s pessoas com defici&ecirc;ncia e mobilidade reduzida.</span></p>\r\n','N','','','N','','',''),
 (12,'0000-00-00','2014-07-28','00:11:28','Hellen Kellen - Uma histÃ³ria impressionante...','Hellen Kellen','Tornou-se uma cÃ©lebre e prolÃ­fica escritora, filÃ³sofa e conferencista, uma personagem famosa pelo extenso trabalho que desenvolveu em favor das pessoas portadoras de deficiÃªncia. .. hjhjhjk','20140608125642_helenkeller_mini.jpg','A sorridente hellen keller....hjhjhjkhjkhjk','WIkipedia','http://pt.wikipedia.org/wiki/Helen_Keller','<p style=\"margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;\">\r\n	<b>Helen Adams Keller</b>&nbsp;(<a href=\"http://pt.wikipedia.org/wiki/Tuscumbia_(Alabama)\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"Tuscumbia (Alabama)\">Tuscumbia</a>,&nbsp;<a href=\"http://pt.wikipedia.org/wiki/27_de_junho\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"27 de junho\">27 de junho</a>&nbsp;de&nbsp;<a href=\"http://pt.wikipedia.org/wiki/1880\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"1880\">1880</a>&nbsp;&mdash;&nbsp;<a href=\"http://pt.wikipedia.org/wiki/Westport_(Connecticut)\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"Westport (Connecticut)\">Westport</a>,&nbsp;<a href=\"http://pt.wikipedia.org/wiki/1_de_junho\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"1 de junho\">1 de junho</a>&nbsp;de&nbsp;<a href=\"http://pt.wikipedia.org/wiki/1968\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"1968\">1968</a>) foi uma&nbsp;<a class=\"mw-redirect\" href=\"http://pt.wikipedia.org/wiki/Escritora\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"Escritora\">escritora</a>, conferencista e ativista social&nbsp;<a href=\"http://pt.wikipedia.org/wiki/Estados_Unidos\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"Estados Unidos\">estadunidense</a>. Foi a primeira pessoa surda a conquistar o bacharelado em artes....</p>\r\n<p style=\"margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;\">\r\n	A hist&oacute;ria sobre como sua professora, Anne Sullivan, conseguiu romper o isolamento imposto pela quase total falta de comunica&ccedil;&atilde;o, permitindo &agrave; menina florescer enquanto aprendia a se comunicar, tornou-se amplamente conhecida atrav&eacute;s do roteiro da pe&ccedil;a&nbsp;<a class=\"mw-redirect\" href=\"http://pt.wikipedia.org/wiki/The_Miracle_Worker\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"The Miracle Worker\">The Miracle Worker</a>&nbsp;que virou o filme&nbsp;<a href=\"http://pt.wikipedia.org/wiki/O_Milagre_de_Anne_Sullivan\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"O Milagre de Anne Sullivan\">O Milagre de Anne Sullivan</a>&nbsp;(1962), dirigido por Arthur Penn (em Portugal, O Milagre de Helen Keller). Seu anivers&aacute;rio em 27 de junho &eacute; comemorado como o Helen Keller Day no estado da Pennsylvania e foi autorizado em n&iacute;vel federal atrav&eacute;s a proclama&ccedil;&atilde;o presidencial de Jimmy Carter em 1980, no centen&aacute;rio de seu nascimento.</p>\r\n<p style=\"margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;\">\r\n	Tornou-se uma c&eacute;lebre e prol&iacute;fica escritora, fil&oacute;sofa e conferencista, uma personagem famosa pelo extenso trabalho que desenvolveu em favor das pessoas portadoras de&nbsp;<a href=\"http://pt.wikipedia.org/wiki/Defici%C3%AAncia\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"DeficiÃªncia\">defici&ecirc;ncia</a>. Keller viajou muito e expressava de forma contundente suas convic&ccedil;&otilde;es. Membro do Socialist Party of America e do Industrial Workers of the World, participou das campanhas pelo voto feminino, direitos trabalhistas, socialismo e outras causas de esquerda. Ela foi introduzida no Alabama Women&#39;s Hall of Fame em 1971.</p>\r\n<p style=\"margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;\">\r\n	<b>Helen Adams Keller</b>&nbsp;(<a href=\"http://pt.wikipedia.org/wiki/Tuscumbia_(Alabama)\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"Tuscumbia (Alabama)\">Tuscumbia</a>,&nbsp;<a href=\"http://pt.wikipedia.org/wiki/27_de_junho\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"27 de junho\">27 de junho</a>&nbsp;de&nbsp;<a href=\"http://pt.wikipedia.org/wiki/1880\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"1880\">1880</a>&nbsp;&mdash;&nbsp;<a href=\"http://pt.wikipedia.org/wiki/Westport_(Connecticut)\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"Westport (Connecticut)\">Westport</a>,&nbsp;<a href=\"http://pt.wikipedia.org/wiki/1_de_junho\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"1 de junho\">1 de junho</a>&nbsp;de&nbsp;<a href=\"http://pt.wikipedia.org/wiki/1968\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"1968\">1968</a>) foi uma&nbsp;<a class=\"mw-redirect\" href=\"http://pt.wikipedia.org/wiki/Escritora\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"Escritora\">escritora</a>, conferencista e ativista social&nbsp;<a href=\"http://pt.wikipedia.org/wiki/Estados_Unidos\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"Estados Unidos\">estadunidense</a>. Foi a primeira pessoa surda a conquistar o bacharelado em artes.</p>\r\n<p style=\"margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;\">\r\n	A hist&oacute;ria sobre como sua professora, Anne Sullivan, conseguiu romper o isolamento imposto pela quase total falta de comunica&ccedil;&atilde;o, permitindo &agrave; menina florescer enquanto aprendia a se comunicar, tornou-se amplamente conhecida atrav&eacute;s do roteiro da pe&ccedil;a&nbsp;<a class=\"mw-redirect\" href=\"http://pt.wikipedia.org/wiki/The_Miracle_Worker\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"The Miracle Worker\">The Miracle Worker</a>&nbsp;que virou o filme&nbsp;<a href=\"http://pt.wikipedia.org/wiki/O_Milagre_de_Anne_Sullivan\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"O Milagre de Anne Sullivan\">O Milagre de Anne Sullivan</a>&nbsp;(1962), dirigido por Arthur Penn (em Portugal, O Milagre de Helen Keller). Seu anivers&aacute;rio em 27 de junho &eacute; comemorado como o Helen Keller Day no estado da Pennsylvania e foi autorizado em n&iacute;vel federal atrav&eacute;s a proclama&ccedil;&atilde;o presidencial de Jimmy Carter em 1980, no centen&aacute;rio de seu nascimento.</p>\r\n<p style=\"margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;\">\r\n	Tornou-se uma c&eacute;lebre e prol&iacute;fica escritora, fil&oacute;sofa e conferencista, uma personagem famosa pelo extenso trabalho que desenvolveu em favor das pessoas portadoras de&nbsp;<a href=\"http://pt.wikipedia.org/wiki/Defici%C3%AAncia\" style=\"text-decoration: none; color: rgb(11, 0, 128); background: none;\" title=\"DeficiÃªncia\">defici&ecirc;ncia</a>. Keller viajou muito e expressava de forma contundente suas convic&ccedil;&otilde;es. Membro do Socialist Party of America e do Industrial Workers of the World, participou das campanhas pelo voto feminino, direitos trabalhistas, socialismo e outras causas de esquerda. Ela foi introduzida no Alabama Women&#39;s Hall of Fame em 1971.</p>\r\n','S','20140727234018_outdoor_dest.jpg','a descriÃ§Ã£o original fdsaf sdf sd fsd hdsfhasfhdsj agora sim.','N','20140608125424_helenkeller.jpg','Fotografia da sorridente helen keller','Ter pena de si prÃ³prio Ã© o seu pior inimigo, e se continuar nunca conseguira alcanÃ§ar nada no mundo.'),
 (13,'0000-00-00','2014-07-28','00:12:23','Dorina Nowill - Uma histÃ³ria impressionante','Dorina Nowill','Dorina de GouvÃªa Nowill faleceu em 29 de agosto de 2010, aos 91 anos de idade. Deixou ao Brasil e ao mundo uma instituiÃ§Ã£o reconhecida pela qualidade de seus livros acessÃ­veis e serviÃ§os de reabilitaÃ§Ã£o. Deixou Ã  pessoa com deficiÃªncia visual a oportunidade de viver com dignidade e Ã s pessoas que enxergam uma liÃ§Ã£o de vida.','20140608130501_dorinamini.jpg','Foto da sorridente dona dorina','FundaÃ§Ã£o Dorina Nowill para Cegos','http://www.fundacaodorina.org.br/quem-somos/dorina-de-gouvea-nowill/','<p class=\"olho02\" style=\"margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;\">\r\n	Dorina de Gouv&ecirc;a Nowill faleceu em 29 de agosto de 2010, aos 91 anos de idade. Deixou ao Brasil e ao mundo uma institui&ccedil;&atilde;o reconhecida pela qualidade de seus livros acess&iacute;veis e servi&ccedil;os de reabilita&ccedil;&atilde;o. Deixou &agrave; pessoa com defici&ecirc;ncia visual a oportunidade de viver com dignidade e &agrave;s pessoas que enxergam uma li&ccedil;&atilde;o de vida.</p>\r\n<p class=\"olho02\" style=\"margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;\">\r\n	&nbsp;</p>\r\n<p class=\"olho02\" style=\"margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;\">\r\n	<span style=\"font-size: 1.2em; line-height: 1.5em;\">Perseveran&ccedil;a, caridade, resigna&ccedil;&atilde;o e paci&ecirc;ncia s&atilde;o as li&ccedil;&otilde;es deixadas por esta paulista que enxergava o mundo com os olhos da alma. Cega aos 17 anos, Dorina Nowill foi criadora da funda&ccedil;&atilde;o que leva seu nome, onde exerceu at&eacute; a sua morte, o cargo de Presidente Em&eacute;rita e Vital&iacute;cia.</span></p>\r\n<p class=\"olho02\" style=\"margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;\">\r\n	&nbsp;</p>\r\n<p class=\"olho02\" style=\"margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;\">\r\n	<span style=\"font-size: 1.2em; line-height: 1.5em;\">Dorina de Gouv&ecirc;a Nowill faleceu em 29 de agosto de 2010, aos 91 anos de idade. Deixou ao Brasil e ao mundo uma institui&ccedil;&atilde;o reconhecida pela qualidade de seus livros acess&iacute;veis e servi&ccedil;os de reabilita&ccedil;&atilde;o. Deixou &agrave; pessoa com defici&ecirc;ncia visual a oportunidade de viver com dignidade e &agrave;s pessoas que enxergam uma li&ccedil;&atilde;o de vida.</span></p>\r\n<p class=\"olho02\" style=\"margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;\">\r\n	&nbsp;</p>\r\n<p class=\"olho02\" style=\"margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;\">\r\n	<span style=\"font-size: 1.2em; line-height: 1.5em;\">Perseveran&ccedil;a, caridade, resigna&ccedil;&atilde;o e paci&ecirc;ncia s&atilde;o as li&ccedil;&otilde;es deixadas por esta paulista que enxergava o mundo com os olhos da alma. Cega aos 17 anos, Dorina Nowill foi criadora da funda&ccedil;&atilde;o que leva seu nome, onde exerceu at&eacute; a sua morte, o cargo de Presidente Em&eacute;rita e Vital&iacute;cia.</span></p>\r\n','S','20140728001224_outdoor_dest3.jpg','hahahah','S','20140608130501_dorina_destaque.jpg','Foto da sorridente dona dorina','Dorina era uma das pessoas mais sensÃ­veis que jÃ¡ conheci. Todos temos muito que aprender com o exemplo de vida desta mulher que superou a sua deficiÃªncia e que sempre trabalhou muito para a inclusÃ£o social dos deficientes. (Gustavo Rosa)');
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
 (6,1),
 (7,1),
 (8,1),
 (7,2),
 (6,5),
 (7,5),
 (6,6),
 (6,7);
/*!40000 ALTER TABLE `tb_novidade_360_tag` ENABLE KEYS */;


--
-- Definition of table `tb_projeto`
--

DROP TABLE IF EXISTS `tb_projeto`;
CREATE TABLE `tb_projeto` (
  `projeto_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_projeto_id` bigint(20) unsigned DEFAULT NULL,
  `projeto_dt_cad` date NOT NULL,
  `projeto_hr_cad` time NOT NULL,
  `projeto_dt_ini` date NOT NULL,
  `projeto_dt_fim` date NOT NULL,
  `projeto_sob_demanda` enum('S','N') NOT NULL,
  `projeto_titulo` varchar(255) NOT NULL,
  `projeto_resumo` text NOT NULL,
  `projeto_thumb` varchar(255) NOT NULL,
  `projeto_thumb_desc` text NOT NULL,
  `projeto_fonte` varchar(255) NOT NULL,
  `projeto_link_fonte` varchar(255) NOT NULL,
  `projeto_agenda` date NOT NULL,
  `projeto_conteudo` longtext NOT NULL,
  PRIMARY KEY (`projeto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_projeto`
--

/*!40000 ALTER TABLE `tb_projeto` DISABLE KEYS */;
INSERT INTO `tb_projeto` (`projeto_id`,`tipo_projeto_id`,`projeto_dt_cad`,`projeto_hr_cad`,`projeto_dt_ini`,`projeto_dt_fim`,`projeto_sob_demanda`,`projeto_titulo`,`projeto_resumo`,`projeto_thumb`,`projeto_thumb_desc`,`projeto_fonte`,`projeto_link_fonte`,`projeto_agenda`,`projeto_conteudo`) VALUES 
 (1,2,'2014-06-08','11:02:48','0000-00-00','0000-00-00','N','Um nome de projeto qualquer','Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos, desde pinturas bizantinas atÃ© movimentos mais recentes como os impressionistas, modernistas e contemporÃ¢neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a histÃ³ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como Ã© o caso de algumas tribos indÃ­genas brasileiras e americanas.','20140608110248_livro_de_receitas_vegana.jpg','Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos, desde pinturas bizantinas atÃ© movimentos mais recentes como os impressionistas, modernistas e contemporÃ¢neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a histÃ³ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como Ã© o caso de algumas tribos indÃ­genas brasileiras e americanas.','Tudo Gostoso','http://www.tudogostoso.com.br/receita/66430-coxinha-vegan.html','0000-00-00','<p>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n'),
 (2,1,'2014-06-08','11:11:39','0000-00-00','0000-00-00','N','Outro nome de projeto bacana','A primeira ediÃ§Ã£o ocorreu em 1930 no Uruguai, cuja seleÃ§Ã£o que abrigou o evento saiu vencedora. E o nome da taÃ§a faz referÃªncia a Jules Rimet. A primeira ediÃ§Ã£o ocorreu em 1930 no Uruguai, cuja seleÃ§Ã£o que abrigou o evento saiu vencedora. E o nome da taÃ§a faz referÃªncia a Jules Rimet.','20140608111350_copa.jpg','A primeira ediÃ§Ã£o ocorreu em 1930 no Uruguai, cuja seleÃ§Ã£o que abrigou o evento saiu vencedora. E o nome da taÃ§a faz referÃªncia a Jules Rimet. A primeira ediÃ§Ã£o ocorreu em 1930 no Uruguai, cuja seleÃ§Ã£o que abrigou o evento saiu vencedora. E o nome da taÃ§a faz referÃªncia a Jules Rimet.','WikipÃ©dia','http://pt.wikipedia.org/wiki/Copa_do_Mundo_FIFA','0000-00-00','<p>\r\n	<span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">Copa do Mundo FIFA, tamb&eacute;m conhecida como Campeonato do Mundo de Futebol&nbsp;</span><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&eacute; uma&nbsp;</span><a class=\"mw-redirect\" href=\"http://pt.wikipedia.org/wiki/Competi%C3%A7%C3%A3o_esportiva\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"CompetiÃ§Ã£o esportiva\">competi&ccedil;&atilde;o</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;internacional de&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Futebol\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"Futebol\">futebol</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;que ocorre a cada quatro anos. Essa competi&ccedil;&atilde;o, criada em 1928 na&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Fran%C3%A7a\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"FranÃ§a\">Fran&ccedil;a</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">, sob a lideran&ccedil;a do presidente&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Jules_Rimet\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"Jules Rimet\">Jules Rimet</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">, est&aacute; aberta a todas as&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Federa%C3%A7%C3%A3o\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"FederaÃ§Ã£o\">federa&ccedil;&otilde;es</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;reconhecidas pela&nbsp;</span><a class=\"mw-redirect\" href=\"http://pt.wikipedia.org/wiki/FIFA\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"FIFA\">FIFA</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;(Federa&ccedil;&atilde;o Internacional de Futebol Associado, em&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/L%C3%ADngua_francesa\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"LÃ­ngua francesa\">franc&ecirc;s</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">: federa&ccedil;&atilde;o internacional de Football Association). A primeira edi&ccedil;&atilde;o ocorreu em 1930 no&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Uruguai\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"Uruguai\">Uruguai</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">, cuja sele&ccedil;&atilde;o que abrigou o evento saiu vencedora. E o nome da ta&ccedil;a faz refer&ecirc;ncia a Jules Rimet.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">Copa do Mundo FIFA, tamb&eacute;m conhecida como Campeonato do Mundo de Futebol&nbsp;</span><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&eacute; uma&nbsp;</span><a class=\"mw-redirect\" href=\"http://pt.wikipedia.org/wiki/Competi%C3%A7%C3%A3o_esportiva\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"CompetiÃ§Ã£o esportiva\">competi&ccedil;&atilde;o</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;internacional de&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Futebol\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"Futebol\">futebol</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;que ocorre a cada quatro anos. Essa competi&ccedil;&atilde;o, criada em 1928 na&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Fran%C3%A7a\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"FranÃ§a\">Fran&ccedil;a</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">, sob a lideran&ccedil;a do presidente&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Jules_Rimet\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"Jules Rimet\">Jules Rimet</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">, est&aacute; aberta a todas as&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Federa%C3%A7%C3%A3o\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"FederaÃ§Ã£o\">federa&ccedil;&otilde;es</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;reconhecidas pela&nbsp;</span><a class=\"mw-redirect\" href=\"http://pt.wikipedia.org/wiki/FIFA\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"FIFA\">FIFA</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;(Federa&ccedil;&atilde;o Internacional de Futebol Associado, em&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/L%C3%ADngua_francesa\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"LÃ­ngua francesa\">franc&ecirc;s</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">: federa&ccedil;&atilde;o internacional de Football Association). A primeira edi&ccedil;&atilde;o ocorreu em 1930 no&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Uruguai\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"Uruguai\">Uruguai</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">, cuja sele&ccedil;&atilde;o que abrigou o evento saiu vencedora. E o nome da ta&ccedil;a faz refer&ecirc;ncia a Jules Rimet.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">Copa do Mundo FIFA, tamb&eacute;m conhecida como Campeonato do Mundo de Futebol&nbsp;</span><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&eacute; uma&nbsp;</span><a class=\"mw-redirect\" href=\"http://pt.wikipedia.org/wiki/Competi%C3%A7%C3%A3o_esportiva\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"CompetiÃ§Ã£o esportiva\">competi&ccedil;&atilde;o</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;internacional de&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Futebol\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"Futebol\">futebol</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;que ocorre a cada quatro anos. Essa competi&ccedil;&atilde;o, criada em 1928 na&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Fran%C3%A7a\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"FranÃ§a\">Fran&ccedil;a</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">, sob a lideran&ccedil;a do presidente&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Jules_Rimet\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"Jules Rimet\">Jules Rimet</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">, est&aacute; aberta a todas as&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Federa%C3%A7%C3%A3o\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"FederaÃ§Ã£o\">federa&ccedil;&otilde;es</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;reconhecidas pela&nbsp;</span><a class=\"mw-redirect\" href=\"http://pt.wikipedia.org/wiki/FIFA\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"FIFA\">FIFA</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">&nbsp;(Federa&ccedil;&atilde;o Internacional de Futebol Associado, em&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/L%C3%ADngua_francesa\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"LÃ­ngua francesa\">franc&ecirc;s</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">: federa&ccedil;&atilde;o internacional de Football Association). A primeira edi&ccedil;&atilde;o ocorreu em 1930 no&nbsp;</span><a href=\"http://pt.wikipedia.org/wiki/Uruguai\" style=\"text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;\" title=\"Uruguai\">Uruguai</a><span style=\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;\">, cuja sele&ccedil;&atilde;o que abrigou o evento saiu vencedora. E o nome da ta&ccedil;a faz refer&ecirc;ncia a Jules Rimet.</span></p>\r\n');
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
  CONSTRAINT `fk_tb_projeto_has_tb_download_tb_download1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_projeto_has_tb_download_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_projeto_download`
--

/*!40000 ALTER TABLE `tb_projeto_download` DISABLE KEYS */;
INSERT INTO `tb_projeto_download` (`projeto_id`,`download_id`) VALUES 
 (1,1),
 (2,1);
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
  CONSTRAINT `fk_tb_projeto_has_tb_extra_tb_extra1` FOREIGN KEY (`extra_id`) REFERENCES `tb_extra` (`extra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_projeto_has_tb_extra_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_projeto_extra`
--

/*!40000 ALTER TABLE `tb_projeto_extra` DISABLE KEYS */;
INSERT INTO `tb_projeto_extra` (`projeto_id`,`extra_id`,`projeto_extra_valor`) VALUES 
 (1,1,'Aqui colocamos uma informaÃ§Ã£o extra para este projeto especÃ­fico'),
 (1,2,''),
 (2,1,'Agora outro teste\r\n\r\n123 afdfsdsdfsd'),
 (2,2,'lalaal 9877 fsafsdsd\r\ndsfasdf\r\nsda\r\nfim');
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
  CONSTRAINT `fk_tb_projeto_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_projeto_has_tb_glossario_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_projeto_glossario`
--

/*!40000 ALTER TABLE `tb_projeto_glossario` DISABLE KEYS */;
INSERT INTO `tb_projeto_glossario` (`projeto_id`,`glossario_id`) VALUES 
 (1,1),
 (1,3),
 (2,3);
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
INSERT INTO `tb_projeto_tag` (`projeto_id`,`tag_id`) VALUES 
 (1,2),
 (2,6);
/*!40000 ALTER TABLE `tb_projeto_tag` ENABLE KEYS */;


--
-- Definition of table `tb_serv_proj_cur_info`
--

DROP TABLE IF EXISTS `tb_serv_proj_cur_info`;
CREATE TABLE `tb_serv_proj_cur_info` (
  `serv_proj_cur_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `servico_descr` text COLLATE latin1_general_ci,
  `projeto_descr` text COLLATE latin1_general_ci,
  `curso_descr` text COLLATE latin1_general_ci,
  PRIMARY KEY (`serv_proj_cur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tb_serv_proj_cur_info`
--

/*!40000 ALTER TABLE `tb_serv_proj_cur_info` DISABLE KEYS */;
INSERT INTO `tb_serv_proj_cur_info` (`serv_proj_cur_id`,`servico_descr`,`projeto_descr`,`curso_descr`) VALUES 
 (1,'descrição para serviços','descrição para projetos','descrição para cursos');
/*!40000 ALTER TABLE `tb_serv_proj_cur_info` ENABLE KEYS */;


--
-- Definition of table `tb_servico`
--

DROP TABLE IF EXISTS `tb_servico`;
CREATE TABLE `tb_servico` (
  `servico_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_servico_id` bigint(20) unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_servico`
--

/*!40000 ALTER TABLE `tb_servico` DISABLE KEYS */;
INSERT INTO `tb_servico` (`servico_id`,`tipo_servico_id`,`servico_dt_cad`,`servico_hr_cad`,`servico_dt_ini`,`servico_dt_fim`,`servico_sob_demanda`,`servico_titulo`,`servico_resumo`,`servico_thumb`,`servico_thumb_desc`,`servico_fonte`,`servico_link_fonte`,`servico_agenda`,`servico_conteudo`) VALUES 
 (1,3,'2014-04-15','10:27:09','0000-00-00','0000-00-00','S','Expografia AcessÃ­vel ','A Museus AcessÃ­veis oferece o serviÃ§o de desenvolvimento de projetos de exposiÃ§Ã£o (eliminaÃ§Ã£o de barreiras fÃ­sicas, comunicaÃ§Ã£o visual, tÃ¡til e sonora, desenvolvimento, produÃ§Ã£o e instalaÃ§Ã£o de mobiliÃ¡rio, montagem de displays , obras e objetos, sinalizaÃ§Ã£o acessÃ­vel, iluminaÃ§Ã£o e planejamento de circulaÃ§Ã£o) com acessibilidade para pessoas com deficiÃªncia fÃ­sica, mobilidade reduzida  e deficiÃªncia visual respeitando a NBR 9050 e as normas internacionais de design de espaÃ§o cultural acessÃ­vel.','20140608112428_expografia_acesscÂ­vel.jpg','A Museus AcessÃ­veis oferece o serviÃ§o de desenvolvimento de projetos de exposiÃ§Ã£o (eliminaÃ§Ã£o de barreiras fÃ­sicas, comunicaÃ§Ã£o visual, tÃ¡til e sonora, desenvolvimento, produÃ§Ã£o e instalaÃ§Ã£o de mobiliÃ¡rio, montagem de displays , obras e objetos, sinalizaÃ§Ã£o acessÃ­vel, iluminaÃ§Ã£o e planejamento de circulaÃ§Ã£o) com acessibilidade para pessoas com deficiÃªncia fÃ­sica, mobilidade reduzida  e deficiÃªncia visual respeitando a NBR 9050 e as normas internacionais de design de espaÃ§o cultural acessÃ­vel.','Google','https://www.google.com.br/search?q=EXPOGRAFIA&espv=2&source=lnms&tbm=isch&sa=X&ei=1HGUU4uDPKfNsATy7oGgCQ&ved=0CAcQ_AUoAg&biw=1403&bih=726&dpr=0.9#facrc=_&imgdii=SnY6XGijexhikM%3A%3BoDCUxogiAtu_DM%3BSnY6XGijexhikM%3A&imgrc=SnY6XGijexhikM%253A%3BQ_dlbJqO5jd','0000-00-00','<p>\r\n	A Museus Acess&iacute;veis oferece o servi&ccedil;o de desenvolvimento de projetos de exposi&ccedil;&atilde;o (elimina&ccedil;&atilde;o de barreiras f&iacute;sicas, comunica&ccedil;&atilde;o visual, t&aacute;til e sonora, desenvolvimento, produ&ccedil;&atilde;o e instala&ccedil;&atilde;o de mobili&aacute;rio, montagem de displays , obras e objetos, sinaliza&ccedil;&atilde;o acess&iacute;vel, ilumina&ccedil;&atilde;o e planejamento de circula&ccedil;&atilde;o) com acessibilidade para pessoas com defici&ecirc;ncia f&iacute;sica, mobilidade reduzida &nbsp;e defici&ecirc;ncia visual respeitando a NBR 9050 e as normas internacionais de design de espa&ccedil;o cultural acess&iacute;vel.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	A Museus Acess&iacute;veis oferece o servi&ccedil;o de desenvolvimento de projetos de exposi&ccedil;&atilde;o (elimina&ccedil;&atilde;o de barreiras f&iacute;sicas, comunica&ccedil;&atilde;o visual, t&aacute;til e sonora, desenvolvimento, produ&ccedil;&atilde;o e instala&ccedil;&atilde;o de mobili&aacute;rio, montagem de displays , obras e objetos, sinaliza&ccedil;&atilde;o acess&iacute;vel, ilumina&ccedil;&atilde;o e planejamento de circula&ccedil;&atilde;o) com acessibilidade para pessoas com defici&ecirc;ncia f&iacute;sica, mobilidade reduzida &nbsp;e defici&ecirc;ncia visual respeitando a NBR 9050 e as normas internacionais de design de espa&ccedil;o cultural acess&iacute;vel.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	A Museus Acess&iacute;veis oferece o servi&ccedil;o de desenvolvimento de projetos de exposi&ccedil;&atilde;o (elimina&ccedil;&atilde;o de barreiras f&iacute;sicas, comunica&ccedil;&atilde;o visual, t&aacute;til e sonora, desenvolvimento, produ&ccedil;&atilde;o e instala&ccedil;&atilde;o de mobili&aacute;rio, montagem de displays , obras e objetos, sinaliza&ccedil;&atilde;o acess&iacute;vel, ilumina&ccedil;&atilde;o e planejamento de circula&ccedil;&atilde;o) com acessibilidade para pessoas com defici&ecirc;ncia f&iacute;sica, mobilidade reduzida &nbsp;e defici&ecirc;ncia visual respeitando a NBR 9050 e as normas internacionais de design de espa&ccedil;o cultural acess&iacute;vel.</p>\r\n'),
 (2,1,'2014-06-06','14:42:18','0000-00-00','0000-00-00','N','AdequaÃ§Ãµes fÃ­sicas de ambientes a norma 5090','Trata-se do cumprimento da lei acerca da adaptaÃ§Ã£o de ambientes coletivos Ã s normas de acessiblidade. A Museus AcessÃ­veis conta com arquitetos e profissionais especializados em acessibilidade para o desenvolvimento de projeto, sinalizaÃ§Ã£o e comunicaÃ§Ã£o visual, tÃ¡til e sonora para espaÃ§os fÃ­sicos jÃ¡ construÃ­dos, tombados ou em projeto cumprindo a NBR 9050, o Decreto 5296 e seguindo premissas das normas internacionais de acessibilidade fÃ­sica.','20140606144218_abnt.jpg','Trata-se do cumprimento da lei acerca da adaptaÃ§Ã£o de ambientes coletivos Ã s normas de acessiblidade. A Museus AcessÃ­veis conta com arquitetos e profissionais especializados em acessibilidade para o desenvolvimento de projeto, sinalizaÃ§Ã£o e comunicaÃ§Ã£o visual, tÃ¡til e sonora para espaÃ§os fÃ­sicos jÃ¡ construÃ­dos, tombados ou em projeto cumprindo a NBR 9050, o Decreto 5296 e seguindo premissas das normas internacionais de acessibilidade fÃ­sica.','','','0000-00-00','<p class=\"p1\">\r\n	A Muses Acess&iacute;veis conta com arquitetos e profissionais especializados em acessibilidade para o desenvolvimento de projeto, sinaliza&ccedil;&atilde;o e comunica&ccedil;&atilde;o visual, t&aacute;til e sonora para espa&ccedil;os f&iacute;sicos j&aacute; constru&iacute;dos, tombados ou em projeto cumprindo a NBR 9050, o Decreto 5296 e seguindo premissas das normas internacionais de acessibilidade f&iacute;sica.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	A Muses Acess&iacute;veis conta com arquitetos e profissionais especializados em acessibilidade para o desenvolvimento de projeto, sinaliza&ccedil;&atilde;o e comunica&ccedil;&atilde;o visual, t&aacute;til e sonora para espa&ccedil;os f&iacute;sicos j&aacute; constru&iacute;dos, tombados ou em projeto cumprindo a NBR 9050, o Decreto 5296 e seguindo premissas das normas internacionais de acessibilidade f&iacute;sica.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	A Muses Acess&iacute;veis conta com arquitetos e profissionais especializados em acessibilidade para o desenvolvimento de projeto, sinaliza&ccedil;&atilde;o e comunica&ccedil;&atilde;o visual, t&aacute;til e sonora para espa&ccedil;os f&iacute;sicos j&aacute; constru&iacute;dos, tombados ou em projeto cumprindo a NBR 9050, o Decreto 5296 e seguindo premissas das normas internacionais de acessibilidade f&iacute;sica.</p>\r\n'),
 (3,2,'2014-06-08','11:30:21','0000-00-00','0000-00-00','N','Alarme Audiovisual Sem Fio (Wireless) Para SanitÃ¡rio AcessÃ­vel ','Alarme audiovisual sem fio  para sanitÃ¡rio acessÃ­vel, visa disponibilizar que pessoas com deficiÃªncia, possam pedir auxÃ­lio em caso de necessidade e emergÃªncias. Alarme audiovisual sem fio  para sanitÃ¡rio acessÃ­vel, visa disponibilizar que pessoas com deficiÃªncia, possam pedir auxÃ­lio em caso de necessidade e emergÃªncias. Alarme audiovisual sem fio  para sanitÃ¡rio acessÃ­vel, visa disponibilizar que pessoas com deficiÃªncia, possam pedir auxÃ­lio em caso de necessidade e emergÃªncias.','20140608113021_alarme.jpg','Alarme audiovisual sem fio  para sanitÃ¡rio acessÃ­vel, visa disponibilizar que pessoas com deficiÃªncia, possam pedir auxÃ­lio em caso de necessidade e emergÃªncias. Alarme audiovisual sem fio  para sanitÃ¡rio acessÃ­vel, visa disponibilizar que pessoas com deficiÃªncia, possam pedir auxÃ­lio em caso de necessidade e emergÃªncias. Alarme audiovisual sem fio  para sanitÃ¡rio acessÃ­vel, visa disponibilizar que pessoas com deficiÃªncia, possam pedir auxÃ­lio em caso de necessidade e emergÃªncias.','Total Acessibilidade','http://www.totalacessibilidade.com.br/','0000-00-00','<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n'),
 (4,2,'2014-06-08','11:33:30','0000-00-00','0000-00-00','N','Desenvolvimento de CardÃ¡pio AcessÃ­vel','Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos, desde pinturas bizantinas atÃ© movimentos mais recentes como os impressionistas, modernistas e contemporÃ¢neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a histÃ³ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como Ã© o caso de algumas tribos indÃ­genas brasileiras e americanas.','20140608113330_cardapio.jpg','Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos, desde pinturas bizantinas atÃ© movimentos mais recentes como os impressionistas, modernistas e contemporÃ¢neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a histÃ³ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como Ã© o caso de algumas tribos indÃ­genas brasileiras e americanas.','Total Acessibilidade','http://www.totalacessibilidade.com.br/','0000-00-00','<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n'),
 (5,4,'2014-06-12','10:59:44','0000-00-00','0000-00-00','S','Desenvolvimento de materiais de mediaÃ§Ã£o sensoriais','â€¢ Maquetes tÃ¡teis de construÃ§Ãµes e espaÃ§os fÃ­sicos \r\nâ€¢ RÃ©plicas tÃ¡teis de esculturas e objetos histÃ³ricos\r\nâ€¢ Desenhos, documentos e mapas tÃ¡teis\r\nâ€¢ Paisagens sonoras para ambientaÃ§Ã£o de espaÃ§os, audiolivros, audioguias e publicaÃ§Ãµes em Ã¡udio\r\nâ€¢ Assinatura olfativa para ambientaÃ§Ã£o de espaÃ§os de exposiÃ§Ã£o, obras de arte e instalaÃ§Ãµes multimÃ­dia\r\nâ€¢ CriaÃ§Ã£o de cardÃ¡pios de alimentaÃ§Ã£o temÃ¡ticos (seguindo propostas de curadoria de exposiÃ§Ãµes a acervos de museus)\r\nâ€¢ Material de apoio para visitas educativas, mediaÃ§Ã£o  e atividades culturais multissensorial','20140612115320_libras.jpg','â€¢ Maquetes tÃ¡teis de construÃ§Ãµes e espaÃ§os fÃ­sicos \\r\\nâ€¢ RÃ©plicas tÃ¡teis de esculturas e objetos histÃ³ricos\\r\\nâ€¢ Desenhos, documentos e mapas tÃ¡teis\\r\\nâ€¢ Paisagens sonoras para ambientaÃ§Ã£o de espaÃ§os, audiolivros, audioguias e publicaÃ§Ãµes em Ã¡udio\\r\\nâ€¢ Assinatura olfativa para ambientaÃ§Ã£o de espaÃ§os de exposiÃ§Ã£o, obras de arte e instalaÃ§Ãµes multimÃ­dia\\r\\nâ€¢ CriaÃ§Ã£o de cardÃ¡pios de alimentaÃ§Ã£o temÃ¡ticos (seguindo propostas de curadoria de exposiÃ§Ãµes a acervos de museus)\\r\\nâ€¢ Material de apoio para visitas educativas, mediaÃ§Ã£o  e atividades culturais multissensorial','','','0000-00-00','<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Maquetes t&aacute;teis de constru&ccedil;&otilde;es e espa&ccedil;os f&iacute;sicos&nbsp;</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>R&eacute;plicas t&aacute;teis de esculturas e objetos hist&oacute;ricos</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Desenhos, documentos e mapas t&aacute;teis</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Paisagens sonoras para ambienta&ccedil;&atilde;o de espa&ccedil;os, audiolivros, audioguias e publica&ccedil;&otilde;es em &aacute;udio</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Assinatura olfativa para ambienta&ccedil;&atilde;o de espa&ccedil;os de exposi&ccedil;&atilde;o, obras de arte e instala&ccedil;&otilde;es multim&iacute;dia</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Cria&ccedil;&atilde;o de card&aacute;pios de alimenta&ccedil;&atilde;o tem&aacute;ticos (seguindo propostas de curadoria de exposi&ccedil;&otilde;es a acervos de museus)</div>\r\n<div>\r\n	&bull;<span class=\"Apple-tab-span\" style=\"white-space:pre\"> </span>Material de apoio para visitas educativas, media&ccedil;&atilde;o &nbsp;e atividades culturais multissensorial</div>\r\n<div>\r\n	&nbsp;</div>\r\n'),
 (7,3,'2014-06-12','11:29:31','0000-00-00','0000-00-00','N','Audioguias','Guias auditivos para visitaÃ§Ã£o autÃ´noma em museus, espaÃ§os culturais, exposiÃ§Ãµes, parques, aquÃ¡rios, feiras e eventos para pessoas com deficiÃªncia visual (com audiodescriÃ§Ã£o) e para pÃºblico geral (com opÃ§Ã£o de adequaÃ§Ã£o de linguagem para crianÃ§as,  jovens e adultos).','20140612112931_libras.jpg','Guias auditivos para visitaÃ§Ã£o autÃ´noma em museus, espaÃ§os culturais, exposiÃ§Ãµes, parques, aquÃ¡rios, feiras e eventos para pessoas com deficiÃªncia visual (com audiodescriÃ§Ã£o) e para pÃºblico geral (com opÃ§Ã£o de adequaÃ§Ã£o de linguagem para crianÃ§as,  jovens e adultos).','','','0000-00-00',''),
 (9,2,'2014-06-12','11:31:43','0000-00-00','0000-00-00','N','Videoguias em Libras','Guias visuais em LÃ­ngua Brasileira de Sinais para visitaÃ§Ã£o autÃ´noma em museus, espaÃ§os culturais, exposiÃ§Ãµes, parques, aquÃ¡rios, feiras e eventos para surdos e pessoas com deficiÃªncia auditiva.','20140612115738_libras.jpg','Guias visuais em LÃ­ngua Brasileira de Sinais para visitaÃ§Ã£o autÃ´noma em museus, espaÃ§os culturais, exposiÃ§Ãµes, parques, aquÃ¡rios, feiras e eventos para surdos e pessoas com deficiÃªncia auditiva.','','','0000-00-00',''),
 (10,1,'2014-06-12','11:32:26','0000-00-00','0000-00-00','N','AudiodescriÃ§Ã£o','Desenvolvimento de roteiro para descriÃ§Ã£o de imagens para produÃ§Ãµes audiovisuais (curtas, longas, documentÃ¡rios, programas de TV, vÃ­deos educativos),  materiais didÃ¡ticos e educativos e publicaÃ§Ãµes (livros, catÃ¡logos e revistas com ilustraÃ§Ãµes).','20140612115202_libras.jpg','Desenvolvimento de roteiro para descriÃ§Ã£o de imagens para produÃ§Ãµes audiovisuais (curtas, longas, documentÃ¡rios, programas de TV, vÃ­deos educativos),  materiais didÃ¡ticos e educativos e publicaÃ§Ãµes (livros, catÃ¡logos e revistas com ilustraÃ§Ãµes).','','','0000-00-00',''),
 (12,2,'2014-06-12','11:33:06','0000-00-00','0000-00-00','N','Desenvolvimento e adequaÃ§Ã£o de websites acessÃ­veis','Com adequaÃ§Ã£o para norma W3C e usabilidade de pessoas com deficiÃªncia visual e fÃ­sica.','20140612113306_libras.jpg','Com adequaÃ§Ã£o para norma W3C e usabilidade de pessoas com deficiÃªncia visual e fÃ­sica.','','','0000-00-00',''),
 (14,4,'2014-06-12','11:44:14','0000-00-00','0000-00-00','N','Desenvolvimento e criaÃ§Ã£o de publicaÃ§Ãµes e materiais informativos para pessoas com deficiÃªncia visual e auditiva','Folhetos, livros, catÃ¡logos e materiais de informaÃ§Ã£o virtual em braille, formato auditivo, Libras e com legenda Closed Caption.\r\n','20140612114414_libras.jpg','Folhetos, livros, catÃ¡logos e materiais de informaÃ§Ã£o virtual em braille, formato auditivo, Libras e com legenda Closed Caption.\\r\\n','','','0000-00-00','');
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
  CONSTRAINT `fk_tb_servico_has_tb_download_tb_download1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_servico_has_tb_download_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_servico_download`
--

/*!40000 ALTER TABLE `tb_servico_download` DISABLE KEYS */;
INSERT INTO `tb_servico_download` (`servico_id`,`download_id`) VALUES 
 (2,1),
 (1,2);
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
  CONSTRAINT `fk_tb_servico_has_tb_extra_tb_extra1` FOREIGN KEY (`extra_id`) REFERENCES `tb_extra` (`extra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_servico_has_tb_extra_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_servico_extra`
--

/*!40000 ALTER TABLE `tb_servico_extra` DISABLE KEYS */;
INSERT INTO `tb_servico_extra` (`servico_id`,`extra_id`,`servico_extra_valor`) VALUES 
 (1,1,''),
 (1,2,''),
 (2,1,'Primeiro teste'),
 (2,2,'SEgundo teste'),
 (3,1,''),
 (3,2,''),
 (4,1,''),
 (4,2,''),
 (5,1,''),
 (5,2,''),
 (7,1,''),
 (7,2,''),
 (9,1,''),
 (9,2,''),
 (10,1,''),
 (10,2,''),
 (12,1,''),
 (12,2,''),
 (14,1,''),
 (14,2,'');
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
  CONSTRAINT `fk_tb_servico_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_servico_has_tb_glossario_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_servico_glossario`
--

/*!40000 ALTER TABLE `tb_servico_glossario` DISABLE KEYS */;
INSERT INTO `tb_servico_glossario` (`servico_id`,`glossario_id`) VALUES 
 (2,1),
 (2,3),
 (2,4),
 (1,6),
 (1,7),
 (1,8);
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
  CONSTRAINT `fk_tb_tag_has_tb_servico_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_tag_has_tb_servico_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_servico_tag`
--

/*!40000 ALTER TABLE `tb_servico_tag` DISABLE KEYS */;
INSERT INTO `tb_servico_tag` (`tag_id`,`servico_id`) VALUES 
 (1,1),
 (2,1),
 (3,1),
 (1,2),
 (3,2),
 (7,2);
/*!40000 ALTER TABLE `tb_servico_tag` ENABLE KEYS */;


--
-- Definition of table `tb_tag`
--

DROP TABLE IF EXISTS `tb_tag`;
CREATE TABLE `tb_tag` (
  `tag_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag_titulo` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_tag`
--

/*!40000 ALTER TABLE `tb_tag` DISABLE KEYS */;
INSERT INTO `tb_tag` (`tag_id`,`tag_titulo`) VALUES 
 (1,'Acessibilidade'),
 (2,'Cursos'),
 (3,'Projetos'),
 (5,'Evento'),
 (6,'Agenda'),
 (7,'arquitetura');
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
 (1,'2014-06-12','12:05:31','<p class=\"p1\">\r\n	<a name=\"quemsomos\"><strong>Quem somos</strong></a></p>\r\n<p class=\"p1\">\r\n	A Museus Acess&iacute;veis &eacute; uma empresa social, que investe seu patrim&ocirc;nio e conquistas na melhoria da qualidade de vida das pessoas e na mudan&ccedil;a cultural do cen&aacute;rio da acessibilidade no Brasil. Nossa proposta &eacute; colaborar com a sociedade e com as institui&ccedil;&otilde;es ligadas a cultura, oferecendo orienta&ccedil;&atilde;o no desenvolvimento de produtos culturais acess&iacute;veis de qualidade e na forma&ccedil;&atilde;o de p&uacute;blico para suas a&ccedil;&otilde;es.<br />\r\n	<a href=\"#quemsomos\">topo</a></p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	<strong>Miss&atilde;o</strong></p>\r\n<p class=\"p1\">\r\n	Promover a amplia&ccedil;&atilde;o do acesso das pessoas com defici&ecirc;ncia ao patrim&ocirc;nio art&iacute;stico e cultural por meio do desenvolvimento de projetos e solu&ccedil;&otilde;es de acessibilidade, dissemina&ccedil;&atilde;o de conhecimentos e capacita&ccedil;&atilde;o para elimina&ccedil;&atilde;o de barreiras atitudinais.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	<strong>Vis&atilde;o</strong></p>\r\n<p class=\"p1\">\r\n	Promo&ccedil;&atilde;o do livre acesso a cultura para as pessoas com defici&ecirc;ncia.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	<strong>Valores</strong></p>\r\n<p class=\"p1\">\r\n	Acessibilidade para todos, Cultura de Livre Acesso, Qualidade, Aprimoramento T&eacute;cnico.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	<strong>Acessibilidade 360&ordm;</strong></p>\r\n<p class=\"p1\">\r\n	Promo&ccedil;&atilde;o de livre acesso para pessoas com defici&ecirc;ncia visual, f&iacute;sica, auditiva, intelectual e m&uacute;ltipla em todas as esferas sociais, culturais e humanas.</p>\r\n<p class=\"p1\">\r\n	A Museus Acess&iacute;veis promove a transforma&ccedil;&atilde;o dos espa&ccedil;os e produtos culturais, a partir de diagn&oacute;sticos e servi&ccedil;os especializados em acessibilidade, eliminando barreiras arquitet&ocirc;nicas, comunicacionais, atitudinais e disseminando informa&ccedil;&atilde;o e conhecimento.</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	<a name=\"historico\"><strong>Hist&oacute;rico</strong></a></p>\r\n<p class=\"p1\">\r\n	A Museus Acess&iacute;veis foi fundada por Viviane Sarraf, doutora em Comunica&ccedil;&atilde;o e Semi&oacute;tica pela PUC-SP, que dedicou sua vida acad&ecirc;mica e profissional ao desenvolvimento te&oacute;rico e pr&aacute;tico da acessibilidade cultural para pessoas com defici&ecirc;ncia. &nbsp;</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	Ap&oacute;s sua gradua&ccedil;&atilde;o em Licenciatura em Educa&ccedil;&atilde;o Art&iacute;stica pela FAAP e especializa&ccedil;&atilde;o em Museologia pela USP, Viviane ingressa em seu mestrado em Ci&ecirc;ncia da Informa&ccedil;&atilde;o na Escola de Comunica&ccedil;&otilde;es e Artes da USP, sempre envolvida com institui&ccedil;&otilde;es e iniciativas de promo&ccedil;&atilde;o e defesa dos direitos das pessoas com defici&ecirc;ncia.</p>\r\n<p class=\"p1\">\r\n	Empreendedora, engajada e preocupada com a crescente necessidade da melhoria no atendimento &agrave;s pessoas com defici&ecirc;ncia em museus e espa&ccedil;os culturais, em 2006 surge a Museus Acess&iacute;veis, empresa voltada ao desenvolvimento de solu&ccedil;&otilde;es culturais acess&iacute;veis.</p>\r\n<p class=\"p1\">\r\n	Ainda neste ano, cheia de novas ideias, informa&ccedil;&otilde;es e forma&ccedil;&otilde;es sobre empreendedorismo social, Viviane Sarraf inscreveu a rec&eacute;m-inaugurada Museus Acess&iacute;veis em uma oportunidade in&eacute;dita no pa&iacute;s, um dos programas pioneiros de empreendedorismo social e sustent&aacute;vel mundial: a Expedi&ccedil;&atilde;o Artemisia da Artemisia Foundation.</p>\r\n<p class=\"p1\">\r\n	Ap&oacute;s muitas etapas e sele&ccedil;&otilde;es com bancas formadas por grandes empreendedores, a Museus Acess&iacute;veis foi um dos 5 empreendimentos premiados com 2 anos de acompanhamento estrat&eacute;gico, jur&iacute;dico, financeiro, pessoal, apoio a equipe, desenvolvimento de perfil empreendedor e verba de start-up.</p>\r\n<p class=\"p1\">\r\n	Assim, a Museus Acess&iacute;veis se consolida no mercado brasileiro e forma a RINAM &ndash; Rede de Informa&ccedil;&atilde;o de Acessibilidade em Museus &ndash; plataforma de dissemina&ccedil;&atilde;o da informa&ccedil;&atilde;o sobre acessibilidade cultural.&nbsp; [www.rinam.com.br]</p>\r\n<p class=\"p1\">\r\n	Ao longo de sua trajet&oacute;ria, a Museus Acess&iacute;veis contou com o importante trabalho de profissionais, consultores, trainees e estagi&aacute;rios brasileiros e estrangeiros que contribu&iacute;ram fundamentalmente com a afirma&ccedil;&atilde;o do car&aacute;ter social e com o cumprimento de sua miss&atilde;o.</p>\r\n<p class=\"p1\">\r\n	Em sua estrutura atual a empresa conta com consultores com defici&ecirc;ncia para avalia&ccedil;&atilde;o e desenvolvimento de projetos e produtos culturais acess&iacute;veis, al&eacute;m de consultores t&eacute;cnicos especializados em arquitetura acess&iacute;vel, avalia&ccedil;&atilde;o de acessibilidade 360&ordm;, a&ccedil;&atilde;o educativa acess&iacute;vel, acessibilidade na web.</p>\r\n<p class=\"p1\">\r\n	A Museus Acess&iacute;veis conta com parcerias estrat&eacute;gicas de empresas e institui&ccedil;&otilde;es que desenvolvem produtos e servi&ccedil;os que apoiam suas a&ccedil;&otilde;es de acessibilidade, como: Funda&ccedil;&atilde;o Dorina Nowill para Cegos, Instituto Mara Gabrilli, Efeito Visual, Usina Maquetes, Voice Versa, Livre Acesso Braille, entre outros.<br />\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	<strong>Principais clientes</strong></p>\r\n<p class=\"p1\">\r\n	MAM &ndash; Museu de Arte Moderna de S&atilde;o Paulo</p>\r\n<p class=\"p1\">\r\n	Museu da L&iacute;ngua Portuguesa</p>\r\n<p class=\"p1\">\r\n	Catavento Cultural</p>\r\n<p class=\"p1\">\r\n	SESC &ndash; SP (unidades Itaquera, Campinas, Ipiranga, Taubat&eacute; e Centro de Pesquisa e Forma&ccedil;&atilde;o)</p>\r\n<p class=\"p1\">\r\n	Instituto Sangari</p>\r\n<p class=\"p1\">\r\n	Museu de Zoologia da USP</p>\r\n<p class=\"p1\">\r\n	Funda&ccedil;&atilde;o Dorina Nowill para Cegos &ndash; Centro de Mem&oacute;ria Dorina Nowill</p>\r\n<p class=\"p1\">\r\n	EMC Marketing Cultural</p>\r\n<p class=\"p1\">\r\n	Arte Impressa</p>\r\n<p class=\"p1\">\r\n	Instituto Ethos</p>\r\n<p class=\"p1\">\r\n	Instituto Mara Gabrilli</p>\r\n<p class=\"p1\">\r\n	Museu Nacional da Imigra&ccedil;&atilde;o e Coloniza&ccedil;&atilde;o de Joinvile &ndash; Funda&ccedil;&atilde;o Cultural de Joinvile</p>\r\n<p class=\"p1\">\r\n	Museu de Hist&oacute;ria da Medicina de Porto Alegre</p>\r\n<p class=\"p1\">\r\n	Universidade Federal de Ouro Preto</p>\r\n<p class=\"p1\">\r\n	Universidade Federal do Rio Grande do Sul</p>\r\n<p class=\"p1\">\r\n	Universidade Federal do Rio de Janeiro</p>\r\n<p class=\"p1\">\r\n	Funda&ccedil;&atilde;o Bienal</p>\r\n<p class=\"p1\">\r\n	Centro Cultural S&atilde;o Paulo</p>\r\n<p class=\"p1\">\r\n	The Hub SP</p>\r\n<p class=\"p1\">\r\n	Museu de Artes e Of&iacute;cios de Belo Horizonte</p>\r\n<p class=\"p1\">\r\n	Funda&ccedil;&atilde;o Iber&ecirc; Camargo</p>\r\n<p class=\"p1\">\r\n	Funda&ccedil;&atilde;o Joaquim Nabuco</p>\r\n<p class=\"p1\">\r\n	ECCO &ndash; Espa&ccedil;o Cultural Contempor&acirc;neo de Bras&iacute;lia</p>\r\n<p class=\"p1\">\r\n	Centro Cultural Banco do Brasil</p>\r\n<p class=\"p1\">\r\n	Natureza Produ&ccedil;&otilde;es Art&iacute;sticas</p>\r\n<p class=\"p1\">\r\n	Farearte</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	<strong>Algumas conquistas</strong></p>\r\n<p class=\"p1\">\r\n	Pr&ecirc;mio Rodrigo Melo Franco de Andrade 2013 | IPHAN, Men&ccedil;&atilde;o honrosa no pr&ecirc;mio Betinho Cidadania e Democracia 2013 | C&acirc;mara dos Vereadores de S&atilde;o Paulo, Pr&ecirc;mio Cultura e Sa&uacute;de, 2010 e 2008 | Minist&eacute;rio da Cultura, Men&ccedil;&atilde;o honrosa no pr&ecirc;mio Darcy Ribeiro 2008 | Minist&eacute;rio da Cultura &ndash;trabalhos desenvolvidos para o Centro de Mem&oacute;ria Dorina Nowill | Funda&ccedil;&atilde;o Dorina Nowill para Cegos.</p>\r\n<p class=\"p1\">\r\n	Desenvolvimento de audiodescri&ccedil;&atilde;o em todas as exposi&ccedil;&otilde;es do MAM - SP desde 2009. Considerado um dos espa&ccedil;os culturais mais acess&iacute;veis de S&atilde;o Paulo no Guia de Acessibilidade Cultural de S&atilde;o Paulo.</p>\r\n<p class=\"p1\">\r\n	Participa&ccedil;&atilde;o na concep&ccedil;&atilde;o e desenvolvimento do Curso de Fotografia &ldquo;Imagem e Percep&ccedil;&atilde;o&rdquo; do MAM SP, voltado para pessoas com defici&ecirc;ncia visual.</p>\r\n<p class=\"p1\">\r\n	Desenvolvimento de recursos de media&ccedil;&atilde;o acess&iacute;veis e forma&ccedil;&atilde;o de p&uacute;blico de pessoas com defici&ecirc;ncia para a exposi&ccedil;&atilde;o ENERGIA &ndash; SESC Itaquera. Considerada a unidade mais acess&iacute;vel do SESC de S&atilde;o Paulo pelo Guia de Acessibilidade Cultural de S&atilde;o Paulo.</p>\r\n<p class=\"p1\">\r\n	Desenvolvimento de recursos de media&ccedil;&atilde;o acess&iacute;veis e forma&ccedil;&atilde;o de p&uacute;blico de pessoas com defici&ecirc;ncia para a exposi&ccedil;&atilde;o &Aacute;GUA NA OCA &ndash; Parque do Ibirapuera - SP e Museu Hist&oacute;rico Nacional</p>\r\n<p class=\"p1\">\r\n	Consultoria, desenvolvimento de recursos de media&ccedil;&atilde;o acess&iacute;veis e forma&ccedil;&atilde;o de p&uacute;blico de pessoas com defici&ecirc;ncia visual para a exposi&ccedil;&atilde;o ROBERTO CARLOS &ndash; 50 Anos de M&uacute;sica: um dos maiores sucessos de p&uacute;blico de pessoas com defici&ecirc;ncia visual em exposi&ccedil;&otilde;es, viabilizado por meio da oferta de atendimento acess&iacute;vel, audioguia com audiodescri&ccedil;&atilde;o e maquete t&aacute;til e permiss&atilde;o para toque na cole&ccedil;&atilde;o de carros do cantor.</p>\r\n<p class=\"p1\">\r\n	Servi&ccedil;o educativo acess&iacute;vel na 30&ordf; BIENAL DE ARTE DE S&Atilde;O PAULO por meio de treinamento de educadores para atendimento de pessoas com defici&ecirc;ncia e desenvolvimento de roteiros de visitas audiodescritos.</p>\r\n<p class=\"p1\">\r\n	Inclus&atilde;o de programa&ccedil;&atilde;o sobre acessibilidade cultural no Festival de Inverno de Ouro Preto 2013, com palestra e oficina de acessibilidade cultural para alunos da Universidade Federal de Ouro Preto e profissionais de espa&ccedil;os culturais da cidade.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	<strong>Sobre Viviane Sarraf</strong></p>\r\n<p class=\"p1\">\r\n	Viviane Panelli Sarraf &eacute; doutora em Comunica&ccedil;&atilde;o e Semi&oacute;tica pela PUC-SP, mestre em Ci&ecirc;ncia da Informa&ccedil;&atilde;o pela Escola de Comunica&ccedil;&otilde;es e Artes da USP, especialista em Museologia pelo Museu de Arqueologia da USP e graduada em Licenciatura em Educa&ccedil;&atilde;o Art&iacute;stica pela FAAP.</p>\r\n<p class=\"p1\">\r\n	Diretora t&eacute;cnica e fundadora da Museus Acess&iacute;veis, criadora e coordenadora da RINAM &ndash; Rede de Informa&ccedil;&atilde;o de Acessibilidade em Museus, Professora do Curso de Especializa&ccedil;&atilde;o em Acessibilidade Cultural da Universidade Federal do Rio de Janeiro e do Curso de P&oacute;s- Gradua&ccedil;&atilde;o Lato Sensu em Arte Contempor&acirc;nea e Doc&ecirc;ncia no Ensino Superior da Universidade Camilo Castelo Branco &ndash; UNICASTELO, Pesquisadora do Centro Interdisciplinar de Semi&oacute;tica da Cultura e da M&iacute;dia &ndash; CISC da PUC-SP e Assessora Ad Hoc da FAPESP.</p>\r\n<p class=\"p1\">\r\n	O come&ccedil;o de sua trajet&oacute;ria profissional ocorreu no ano de 1998, na XXIV Bienal de Artes de S&atilde;o Paulo onde integrou a equipe do projeto Diversidade, proposta pioneira de atendimento de pessoas com defici&ecirc;ncia em situa&ccedil;&atilde;o de vulnerabilidade social no universo da arte e da cultura.</p>\r\n<p class=\"p1\">\r\n	Por meio dessa primeira oportunidade e de participa&ccedil;&otilde;es em outros projetos culturais e inclusivos come&ccedil;ou a desenvolver ideias e propostas de servi&ccedil;os e produtos para promo&ccedil;&atilde;o de acessibilidade cultural para pessoas com defici&ecirc;ncia e p&uacute;blicos n&atilde;o usuais de espa&ccedil;os culturais (crian&ccedil;as pequenas, idosos e visitantes de primeira viagem).</p>\r\n<p class=\"p1\">\r\n	Suas ideias foram bem recebidas em institui&ccedil;&otilde;es e projetos onde colaborou, como exposi&ccedil;&otilde;es tempor&aacute;rias, museus, espa&ccedil;os culturais, escolas e projetos.</p>\r\n<p class=\"p1\">\r\n	Foi agraciada com o pr&ecirc;mio internacional de empreendedorismo sustent&aacute;vel da Artemisia Foundation pela cria&ccedil;&atilde;o da empresa social Museus Acess&iacute;veis em 2007, que ofereceu s&oacute;lida forma&ccedil;&atilde;o nas &aacute;reas de empreendedorismo sustent&aacute;vel e impacto social e assessorou durante mais de 3 anos o desenvolvimento da empresa.</p>\r\n<p class=\"p1\">\r\n	2010 ganhou o Pr&ecirc;mio Pesquisador do Centro Cultural S&atilde;o Paulo &ndash; Secretaria Municipal de Cultura pela pesquisa &ldquo;Acessibilidade em Espa&ccedil;os Culturais: experi&ecirc;ncias art&iacute;sticas e programa&ccedil;&otilde;es culturais inclusivas promovidas em S&atilde;o Paulo&rdquo; produzida para o Arquivo Multimeios da institui&ccedil;&atilde;o e dispon&iacute;vel para consulta de relat&oacute;rio e materiais coletados na institui&ccedil;&atilde;o.</p>\r\n<p class=\"p1\">\r\n	Em 2012 recebeu o pr&ecirc;mio internacional &ldquo;CECA-ICOM Best Practice Award do Comit&ecirc; de Educa&ccedil;&atilde;o e A&ccedil;&atilde;o Cultural do Conselho Internacional de Museus - CECA ICOM, pelo trabalho de Educa&ccedil;&atilde;o e A&ccedil;&atilde;o Cultural que desenvolveu no Centro de Mem&oacute;ria Dorina Nowill. Nesse mesmo ano foi agraciada com a bolsa de viagem Young Support do ICOM International para participa&ccedil;&atilde;o na confer&ecirc;ncia e cerim&ocirc;nia de premia&ccedil;&atilde;o em Yerevan na Arm&ecirc;nia.</p>\r\n<p class=\"p1\">\r\n	Foi respons&aacute;vel pela cria&ccedil;&atilde;o, curadoria, plano museol&oacute;gico, museografia, a&ccedil;&atilde;o cultural e educativa e programa de extens&atilde;o do Centro de Mem&oacute;ria Dorina Nowill da Funda&ccedil;&atilde;o Dorina Nowill para Cegos. Sob sua responsabilidade entre os anos de 2002 e 2013 o projeto recebeu men&ccedil;&atilde;o honrosa no Pr&ecirc;mio Darcy Ribeiro do Minc em 2008 e Pr&ecirc;mio Betinho Cidadania e Democracia da C&acirc;mara dos Vereadores de S&atilde;o Paulo em 2013; ganhou os pr&ecirc;mios Cultura e Sa&uacute;de do Minc - edi&ccedil;&otilde;es 2008 e 2010 e Pr&ecirc;mio Rodrigo Melo Franco de Andrade do IPHAN, na categoria Patrim&ocirc;nio Material em 2013. Em 2011 o projeto de moderniza&ccedil;&atilde;o do espa&ccedil;o cultural foi aprovado pela Lei Municipal de Incentivo a Cultura de S&atilde;o Paulo e pode executar as a&ccedil;&otilde;es de constru&ccedil;&atilde;o de novos espa&ccedil;os de preserva&ccedil;&atilde;o e exposi&ccedil;&atilde;o, atualiza&ccedil;&atilde;o dos processos de documenta&ccedil;&atilde;o e pesquisa on-line, elabora&ccedil;&atilde;o de nova exposi&ccedil;&atilde;o e materiais de divulga&ccedil;&atilde;o com patroc&iacute;nios da TV Globo e Linx.</p>\r\n<p class=\"p1\">\r\n	Nesse per&iacute;odo o Centro de Mem&oacute;ria Dorina Nowill recebeu aproximadamente 12 mil visitantes e formou mais de 500 profissionais e estudantes por meio dos cursos de Acessibilidade Cultural e Audiodescri&ccedil;&atilde;o.</p>\r\n<p class=\"p1\">\r\n	Em 2008, organizou em parceria com o MAM-SP e com a Funda&ccedil;&atilde;o Dorina Nowill para Cegos o Encontro Regional de Acessibilidade em Museus, primeiro evento nacional que apresentou o um panorama das a&ccedil;&otilde;es e do pensamento cr&iacute;tico na &aacute;rea de acessibilidade cultural. O publico do evento foi superior a 200 participantes de diferentes estados e cidades brasileiros.</p>\r\n<p class=\"p1\">\r\n	Em sua trajet&oacute;ria profissional e acad&ecirc;mica proferiu palestras, oficinas e ministrou cursos em museus, espa&ccedil;os culturais e universidades de todo o pa&iacute;s, publicou artigos e cap&iacute;tulos de livros em revistas cient&iacute;ficas e livros das &aacute;reas de museologia, a&ccedil;&atilde;o educativa, acessibilidade, ci&ecirc;ncias sociais e comunica&ccedil;&atilde;o e publicou um livro com base em sua disserta&ccedil;&atilde;o de mestrado em l&iacute;ngua inglesa pela editora alem&atilde; VDM Verlag.</p>\r\n<p class=\"p1\">\r\n	Link para curr&iacute;culo lattes:&nbsp; http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=K4229502E0</p>\r\n<p class=\"p1\">\r\n	Tese de doutorado dispon&iacute;vel na Biblioteca Virtual Sapientia da PUC-SP</p>\r\n<p class=\"p1\">\r\n	Disserta&ccedil;&atilde;o de Mestrado dispon&iacute;vel na Biblioteca Digital de Teses da USP</p>\r\n<p class=\"p1\">\r\n	Na p&aacute;gina http://www.rinam.com.br/referencias.php#pb da RINAM &eacute; poss&iacute;vel consultar e baixar os principais trabalhos cient&iacute;ficos e artigos de Viviane Sarraf.</p>\r\n<p class=\"p2\">\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n'),
 (2,'2014-06-18','06:46:40','<p class=\"p1\">\r\n	Seguem algumas dicas para facilitar a navega&ccedil;&atilde;o:</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	TAB (navega entre os links)</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	CTRL+1 (barra de acessibilidade)</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	CTRL+2 (menu)</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	CTRL+3 (conte&uacute;do)</p>\r\n<p class=\"p1\">\r\n	&nbsp;</p>\r\n<p class=\"p1\">\r\n	CTRL+4 (contatos).</p>\r\n');
/*!40000 ALTER TABLE `tb_texto` ENABLE KEYS */;


--
-- Definition of table `tb_tipo_curso`
--

DROP TABLE IF EXISTS `tb_tipo_curso`;
CREATE TABLE `tb_tipo_curso` (
  `tipo_curso_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_curso_titulo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`tipo_curso_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tb_tipo_curso`
--

/*!40000 ALTER TABLE `tb_tipo_curso` DISABLE KEYS */;
INSERT INTO `tb_tipo_curso` (`tipo_curso_id`,`tipo_curso_titulo`) VALUES 
 (1,'IntroduÃ§Ã£o ao ConteÃºdo'),
 (2,'Cursos Modulares'),
 (3,'Oficinas PrÃ¡ticas'),
 (4,'VivÃªncias');
/*!40000 ALTER TABLE `tb_tipo_curso` ENABLE KEYS */;


--
-- Definition of table `tb_tipo_projeto`
--

DROP TABLE IF EXISTS `tb_tipo_projeto`;
CREATE TABLE `tb_tipo_projeto` (
  `tipo_projeto_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_projeto_titulo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`tipo_projeto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tb_tipo_projeto`
--

/*!40000 ALTER TABLE `tb_tipo_projeto` DISABLE KEYS */;
INSERT INTO `tb_tipo_projeto` (`tipo_projeto_id`,`tipo_projeto_titulo`) VALUES 
 (1,'Projetos abertos para captaÃ§Ã£o'),
 (2,'PortifÃ³lio de projetos realizados'),
 (3,'Projetos em andamento');
/*!40000 ALTER TABLE `tb_tipo_projeto` ENABLE KEYS */;


--
-- Definition of table `tb_tipo_servico`
--

DROP TABLE IF EXISTS `tb_tipo_servico`;
CREATE TABLE `tb_tipo_servico` (
  `tipo_servico_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_servico_titulo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`tipo_servico_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tb_tipo_servico`
--

/*!40000 ALTER TABLE `tb_tipo_servico` DISABLE KEYS */;
INSERT INTO `tb_tipo_servico` (`tipo_servico_id`,`tipo_servico_titulo`) VALUES 
 (1,'Atitude'),
 (2,'ComunicaÃ§Ã£o'),
 (3,'FÃ­sico'),
 (4,'InformaÃ§Ã£o'),
 (5,'teste');
/*!40000 ALTER TABLE `tb_tipo_servico` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_usuario`
--

/*!40000 ALTER TABLE `tb_usuario` DISABLE KEYS */;
INSERT INTO `tb_usuario` (`usuario_id`,`usuario_nome`,`usuario_login`,`usuario_senha`,`usuario_email`,`usuario_nivel`,`usuario_status`) VALUES 
 (1,'Jonas Mendes','tchoi','destino','inboxfox@gmail.com','AS','A'),
 (2,'Josenilson Oliveira','joynilson','winnie','joynilson@gmail.com','AS','A'),
 (4,'JoÃ£o Batista','joao','123','fessorjoao','A','A'),
 (5,'adm','adm','adm','fessorjoao@gmail.com','A','A');
/*!40000 ALTER TABLE `tb_usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

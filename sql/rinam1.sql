-- phpMyAdmin SQL Dump
-- version 3.3.10deb2
-- http://www.phpmyadmin.net
--
-- Servidor: 186.202.152.130
-- Tempo de Geração: Mar 28, 2014 as 10:57 AM
-- Versão do Servidor: 5.1.71
-- Versão do PHP: 5.3.3-7+squeeze18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



--
-- Banco de Dados: `rinam1`
--

CREATE SCHEMA rinam1;
USE rinam1;
-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_agenda`
--

DROP TABLE IF EXISTS `tb_agenda`;
CREATE TABLE IF NOT EXISTS `tb_agenda` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `tb_agenda`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_agenda_tag`
--

DROP TABLE IF EXISTS `tb_agenda_tag`;
CREATE TABLE IF NOT EXISTS `tb_agenda_tag` (
  `agenda_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`agenda_id`,`tag_id`),
  KEY `fk_tb_agenda_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_agenda_has_tb_tag_tb_agenda1_idx` (`agenda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_agenda_tag`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_anunciante`
--

DROP TABLE IF EXISTS `tb_anunciante`;
CREATE TABLE IF NOT EXISTS `tb_anunciante` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `tb_anunciante`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_anunciante_tag`
--

DROP TABLE IF EXISTS `tb_anunciante_tag`;
CREATE TABLE IF NOT EXISTS `tb_anunciante_tag` (
  `anunciante_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`anunciante_id`,`tag_id`),
  KEY `fk_tb_anunciante_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_anunciante_has_tb_tag_tb_anunciante1_idx` (`anunciante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_anunciante_tag`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_configuracao`
--

DROP TABLE IF EXISTS `tb_configuracao`;
CREATE TABLE IF NOT EXISTS `tb_configuracao` (
  `configuracao_id` int(10) unsigned NOT NULL,
  `configuracao_baseurl_ckfinder` varchar(255) NOT NULL,
  `configuracao_baseurl` varchar(255) NOT NULL,
  `configuracao_meta_author` varchar(255) DEFAULT NULL,
  `configuracao_meta_keywords` text,
  `configuracao_meta_description` text,
  PRIMARY KEY (`configuracao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_configuracao`
--

INSERT INTO `tb_configuracao` (`configuracao_id`, `configuracao_baseurl_ckfinder`, `configuracao_baseurl`, `configuracao_meta_author`, `configuracao_meta_keywords`, `configuracao_meta_description`) VALUES
(1, 'http://www.museusacessiveis.com.br/sitenovo/imgs_rich/', 'http://www.museusacessiveis.com.br/sitenovo/', 'Mobile Studio, JoÃ£o Batista de Macedo Jr, Josenilson Oliveira, Jonas Mendes', 'acessibilidade, museus acessÃ­veis, inclusÃ£o digital', 'Site especializado em inclusÃ£o digital para deficientes visuais. Realizamos cursos e projetos, alÃ©m de oferecer diversos serviÃ§os de inclusÃ£o social para deficientes visuais.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_contato`
--

DROP TABLE IF EXISTS `tb_contato`;
CREATE TABLE IF NOT EXISTS `tb_contato` (
  `contato_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `contato_dt` date NOT NULL,
  `contato_hr` time NOT NULL,
  `contato_tipo_id` int(10) unsigned NOT NULL,
  `contato_nome` varchar(255) NOT NULL,
  `contato_link` varchar(255) NOT NULL,
  `contato_exibir` enum('S','N') NOT NULL,
  PRIMARY KEY (`contato_id`),
  KEY `FK_tb_contato_1` (`contato_tipo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_contato`
--

INSERT INTO `tb_contato` (`contato_id`, `contato_dt`, `contato_hr`, `contato_tipo_id`, `contato_nome`, `contato_link`, `contato_exibir`) VALUES
(1, '2014-03-22', '00:20:14', 2, '11 99801-7147', '', 'S'),
(2, '2014-03-23', '00:20:14', 1, 'www.facebook.com/josenilson.oliveira', 'https://www.facebook.com/josenilson.c.oliveira?ref=tn_tnmn', 'S'),
(3, '2014-03-22', '00:20:14', 5, 'joynilson@gmail.com', 'joynilson@gmail.com', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_contato_tipo`
--

DROP TABLE IF EXISTS `tb_contato_tipo`;
CREATE TABLE IF NOT EXISTS `tb_contato_tipo` (
  `contato_tipo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contato_tipo` varchar(45) NOT NULL,
  `contato_tipo_status` enum('S','N') NOT NULL,
  `contato_tipo_icone` varchar(255) DEFAULT NULL,
  `contato_tipo_icone_contraste` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`contato_tipo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tb_contato_tipo`
--

INSERT INTO `tb_contato_tipo` (`contato_tipo_id`, `contato_tipo`, `contato_tipo_status`, `contato_tipo_icone`, `contato_tipo_icone_contraste`) VALUES
(1, 'Facebook', 'S', '20140322185208_ico_facebook.png', '20140322185208_ico_facebook_contrast.png'),
(2, 'Celular', 'S', '20140322185232_ico_cel.png', '20140322185232_ico_cel_contrast.png'),
(3, 'Skype', 'S', '20140322185312_ico_skype.png', '20140322185312_ico_skype_contrast.png'),
(5, 'E-mail', 'S', '20140322194900_ico_cel.png', '20140322194900_ico_cel_contrast.png'),
(6, 'Site', 'S', '20140323150017_ico_skype.png', '20140323150018_ico_skype_contrast.png'),
(7, 'Telefone', 'S', '20140323150842_ico_cel.png', '20140323150842_ico_cel_contrast.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_curso`
--

DROP TABLE IF EXISTS `tb_curso`;
CREATE TABLE IF NOT EXISTS `tb_curso` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='	' AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_curso`
--

INSERT INTO `tb_curso` (`curso_id`, `tipo_curso_id`, `curso_dt_cad`, `curso_hr_cad`, `curso_dt_ini`, `curso_dt_fim`, `curso_sob_demanda`, `curso_titulo`, `curso_resumo`, `curso_thumb`, `curso_thumb_desc`, `curso_fonte`, `curso_link_fonte`, `curso_conteudo`, `curso_agenda`) VALUES
(1, 1, '2014-03-22', '13:52:56', '2014-03-23', '2014-03-31', 'N', 'Acessibilidade online', 'Aqui vai o resumo do curso', '20140322184409_novidades.jpg', 'Aqui vai o resumo do curso', 'Stocco Art & Design', 'http://stoccoartedesign.wix.com/stoccoartedesign', '<p>\r\n	Aqui vai o conte&uacute;do do curso, inclusive com as imagens que eu vou colocar...</p>\r\n<p>\r\n	<img alt="" src="http://localhost/MuseusAcessiveis/imgs_rich/images/Calendario_Capa.jpg" style="width: 270px; height: 350px; float: left;" /></p>\r\n<p>\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	E depois mais texto ainda.</p>\r\n', '2014-03-24'),
(2, 1, '2014-03-22', '20:54:42', '0000-00-00', '0000-00-00', 'N', '', '', '', '', '', '', '', '0000-00-00'),
(3, 1, '2014-03-25', '13:10:35', '2014-03-31', '2014-04-30', 'N', 'teste', 'teste teste', '', 'teste teste', '', '', '<p>\r\n	teste</p>\r\n<p>\r\n	teste</p>\r\n<p>\r\n	teste</p>\r\n', '2014-03-31'),
(4, 1, '2014-03-25', '13:11:06', '0000-00-00', '0000-00-00', 'S', 'teste 01', 'czxcbvncxdfsgxchvjcgfdsaf', '', 'czxcbvncxdfsgxchvjcgfdsaf', '', '', '<p>\r\n	fcnvbxfzdgcvhghfdsadfgcvgfdsgc</p>\r\n', '2014-03-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_curso_download`
--

DROP TABLE IF EXISTS `tb_curso_download`;
CREATE TABLE IF NOT EXISTS `tb_curso_download` (
  `curso_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`curso_id`,`download_id`),
  KEY `fk_tb_curso_has_tb_download_tb_download1_idx` (`download_id`),
  KEY `fk_tb_curso_has_tb_download_tb_curso1_idx` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_curso_download`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_curso_extra`
--

DROP TABLE IF EXISTS `tb_curso_extra`;
CREATE TABLE IF NOT EXISTS `tb_curso_extra` (
  `curso_id` bigint(19) unsigned NOT NULL,
  `extra_id` bigint(19) unsigned NOT NULL,
  `curso_extra_valor` text NOT NULL,
  PRIMARY KEY (`curso_id`,`extra_id`),
  KEY `fk_tb_curso_has_tb_extra_tb_extra1_idx` (`extra_id`),
  KEY `fk_tb_curso_has_tb_extra_tb_curso1_idx` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_curso_extra`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_curso_glossario`
--

DROP TABLE IF EXISTS `tb_curso_glossario`;
CREATE TABLE IF NOT EXISTS `tb_curso_glossario` (
  `glossario_id` bigint(19) unsigned NOT NULL,
  `curso_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`glossario_id`,`curso_id`),
  KEY `fk_tb_glossario_has_tb_curso_tb_curso1_idx` (`curso_id`),
  KEY `fk_tb_glossario_has_tb_curso_tb_glossario1_idx` (`glossario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_curso_glossario`
--

INSERT INTO `tb_curso_glossario` (`glossario_id`, `curso_id`) VALUES
(3, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_curso_tag`
--

DROP TABLE IF EXISTS `tb_curso_tag`;
CREATE TABLE IF NOT EXISTS `tb_curso_tag` (
  `tag_id` bigint(20) NOT NULL,
  `curso_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`tag_id`,`curso_id`),
  KEY `fk_tb_tag_has_tb_curso_tb_curso1_idx` (`curso_id`),
  KEY `fk_tb_tag_has_tb_curso_tb_tag1_idx` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_curso_tag`
--

INSERT INTO `tb_curso_tag` (`tag_id`, `curso_id`) VALUES
(1, 1),
(2, 1),
(5, 1),
(2, 2),
(3, 2),
(2, 4),
(5, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_download`
--

DROP TABLE IF EXISTS `tb_download`;
CREATE TABLE IF NOT EXISTS `tb_download` (
  `download_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `download_titulo` varchar(255) NOT NULL,
  `download_tipo` int(2) NOT NULL,
  `download_tamanho` decimal(25,2) NOT NULL,
  `download_arquivo` varchar(255) NOT NULL,
  `download_dt` date NOT NULL,
  `download_hr` time NOT NULL,
  PRIMARY KEY (`download_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_download`
--

INSERT INTO `tb_download` (`download_id`, `download_titulo`, `download_tipo`, `download_tamanho`, `download_arquivo`, `download_dt`, `download_hr`) VALUES
(1, 'A ComunicaÃ§Ã£o dos Sentidos nos EspaÃ§os Culturais Brasileiros - Tese de Doutorado de Viviane Panelli Sarraf', 1, 2554843.00, '20140326143526_tesedigital.pdf', '2014-03-26', '14:35:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_extra`
--

DROP TABLE IF EXISTS `tb_extra`;
CREATE TABLE IF NOT EXISTS `tb_extra` (
  `extra_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `extra_nome_campo` varchar(255) NOT NULL,
  PRIMARY KEY (`extra_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_extra`
--

INSERT INTO `tb_extra` (`extra_id`, `extra_nome_campo`) VALUES
(1, 'testeeeeee');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_glossario`
--

DROP TABLE IF EXISTS `tb_glossario`;
CREATE TABLE IF NOT EXISTS `tb_glossario` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tb_glossario`
--

INSERT INTO `tb_glossario` (`glossario_id`, `glossario_dt`, `glossario_hr`, `glossario_palavra`, `glossario_definicao`, `glossario_fonte`, `glossario_link_fonte`, `glossario_conteudo`, `glossario_exibir`) VALUES
(1, '2014-03-22', '13:21:57', 'Acessibilidade', 'Aqui a gente explica rapidamente como funciona', 'Google', 'www.google.com.br', '<p>\r\n	Aqui tem todo o detalhamento do termo do gloss&aacute;rio para ser exibido em algum lugar do site.</p>\r\n', 'S'),
(2, '2014-03-22', '13:24:28', 'ISO', 'Internation Standardization Organization', 'JoynilsonArt', 'http://joynilsonart.blogspot.com', '<p>\r\n	Aqui descrevemos para que serve o ISO e colocamos uma imagem para testar....</p>\r\n<p>\r\n	<img alt="" src="http://localhost/MuseusAcessiveis/imgs_rich/images/Calendario_Capa.jpg" style="width: 270px; height: 350px; border-width: 0px; border-style: solid; margin: 0px; float: left;" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	No final mais um texto e outra imagem.</p>\r\n<p>\r\n	<img alt="" src="http://localhost/MuseusAcessiveis/imgs_rich/images/Superman_rough.jpg" style="width: 60%; height: 60%; border-width: 0px; border-style: solid; margin: 0px; float: right;" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Depois fim!</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 'S'),
(3, '2014-03-25', '12:43:10', 'Piso tÃ¡til', 'Ã‰ o piso diferenciado com textura e cor sempre em destaque com o piso que estiver ao redor. Deve ser perceptÃ­vel por pessoas com deficiÃªncia visual e baixa visÃ£o.', 'Thais Frota', 'http://thaisfrota.wordpress.com/2009/08/05/o-que-e-piso-tatil/', '', 'S'),
(4, '2014-03-26', '13:45:27', 'audiodescriÃ§Ã£o', 'Recurso de acessibilidade que permite que as pessoas com deficiÃªncia visual possam assistir e entender melhor filmes, peÃ§as de teatro, programas de TV, exposiÃ§Ãµes, mostras, musicais, Ã³peras e demais manifestaÃ§Ãµes e recursos visuais, por meio da traduÃ§Ã£o de imagens em textos descritivos.', '', '', '', 'S'),
(5, '2014-03-28', '10:12:37', 'camila', 'teste teste teste stes ', '', '', '', 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_glossario_relacionado`
--

DROP TABLE IF EXISTS `tb_glossario_relacionado`;
CREATE TABLE IF NOT EXISTS `tb_glossario_relacionado` (
  `glossario_id` bigint(19) unsigned NOT NULL,
  `glossario_id1` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`glossario_id`,`glossario_id1`),
  KEY `fk_tb_glossario_has_tb_glossario_tb_glossario2_idx` (`glossario_id1`),
  KEY `fk_tb_glossario_has_tb_glossario_tb_glossario1_idx` (`glossario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_glossario_relacionado`
--

INSERT INTO `tb_glossario_relacionado` (`glossario_id`, `glossario_id1`) VALUES
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_glossario_tag`
--

DROP TABLE IF EXISTS `tb_glossario_tag`;
CREATE TABLE IF NOT EXISTS `tb_glossario_tag` (
  `tag_id` bigint(20) NOT NULL,
  `glossario_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`tag_id`,`glossario_id`),
  KEY `fk_tb_tag_has_tb_glossario_tb_glossario1_idx` (`glossario_id`),
  KEY `fk_tb_tag_has_tb_glossario_tb_tag1_idx` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_glossario_tag`
--

INSERT INTO `tb_glossario_tag` (`tag_id`, `glossario_id`) VALUES
(1, 1),
(2, 1),
(5, 1),
(2, 2),
(3, 2),
(3, 3),
(1, 4),
(2, 4),
(3, 4),
(5, 4),
(6, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_imprensa`
--

DROP TABLE IF EXISTS `tb_imprensa`;
CREATE TABLE IF NOT EXISTS `tb_imprensa` (
  `imprensa_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `imprensa_titulo` varchar(255) NOT NULL,
  `imprensa_tipo` int(2) NOT NULL,
  `imprensa_tamanho` decimal(25,2) NOT NULL,
  `imprensa_arquivo` varchar(255) NOT NULL,
  `imprensa_dt` date NOT NULL,
  `imprensa_hr` time NOT NULL,
  PRIMARY KEY (`imprensa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `tb_imprensa`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mailing`
--

DROP TABLE IF EXISTS `tb_mailing`;
CREATE TABLE IF NOT EXISTS `tb_mailing` (
  `mailing_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `mailing_nome` varchar(45) NOT NULL,
  `mailing_email` varchar(45) NOT NULL,
  `mailing_enviar` enum('S','N') NOT NULL,
  PRIMARY KEY (`mailing_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `tb_mailing`
--

INSERT INTO `tb_mailing` (`mailing_id`, `mailing_nome`, `mailing_email`, `mailing_enviar`) VALUES
(1, 'Josenilson Oliveira', 'joynilson@gmail.com', 'S'),
(2, 'Josenilson Costa', 'joynilsonart@yahoo.com.br', 'N'),
(3, 'Lilian Stocco', 'naradub@yahoo.com.br', 'S'),
(4, 'JoÃ£o Batista', 'fessorjoao@gmail.com', 'S'),
(5, 'Jonas Mendes', 'inboxfox@gmail.com', 'S'),
(6, 'Uchiha Tchoi', 'uchihatchoi@gmail.com', 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_novidade_360`
--

DROP TABLE IF EXISTS `tb_novidade_360`;
CREATE TABLE IF NOT EXISTS `tb_novidade_360` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tb_novidade_360`
--

INSERT INTO `tb_novidade_360` (`novidade_360_id`, `novidade_360_dt_agenda`, `novidade_360_dt`, `novidade_360_hr`, `novidade_360_titulo`, `novidade_360_resumo`, `novidade_360_thumb`, `novidade_360_thumb_desc`, `novidade_360_fonte`, `novidade_360_url_fonte`, `novidade_360_conteudo`, `novidade_360_exibir_banner`, `novidade_360_banner`, `novidade_360_banner_desc`, `novidade_360_exibir_destaque_home`, `novidade_360_destaque_home`, `novidade_360_destaque_home_desc`, `novidade_360_destaque_home_frase`) VALUES
(1, '2014-03-24', '2014-03-23', '14:56:56', 'A primeira novidade', 'fasdfjksd sajfksdkf jskd', '20140323000352_novidades.jpg', 'lalallala', 'Google', 'www.google.com.br', '<p>\r\n	fasdf dfds</p>\r\n<p>\r\n	&nbsp;sdf</p>\r\n<p>\r\n	sdf</p>\r\n<p>\r\n	sdsd</p>\r\n<p>\r\n	fsd</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	s fsd</p>\r\n<p>\r\n	fsd</p>\r\n', 'S', '20140323145656_outdoor_dest.jpg', '', 'S', '20140323145656_destaque.jpg', 'fasd h sdh fsd  skdhf sdjkaaaaa', 'frase de efeito final.'),
(2, '2014-03-25', '2014-03-23', '23:06:41', 'Segunda novidade', 'um resumo', '20140323141436_novidades.jpg', 'descriÃ§Ã£o do outdoor', 'Uol', 'www.uol.com.br', '<p>\r\n	o conte&uacute;do da not&iacute;cia.</p>\r\n', 'S', '20140323230641_outdoor_dest2.jpg', 'lelelelel', 'S', '20140323141436_destaque.jpg', 'descriÃ§Ã£o da imagem de destaque', 'Uma frase bem legal para destacar'),
(3, '2014-03-20', '2014-03-23', '23:07:20', 'Mais uma novidade', 'um resumo lalala', '20140323201925_novidades.jpg', 'descriÃ§Ã£o do thumb lalal', 'Google', 'www.google.com.br', '<p>\r\n	Aqui o texto completo...</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	fsa</p>\r\n<p>\r\n	fds</p>\r\n<p>\r\n	d</p>\r\n<p>\r\n	fd</p>\r\n<p>\r\n	fim.</p>\r\n', 'S', '20140323230720_outdoor_dest4.jpg', 'lalalala ', 'S', '20140323201925_destaque.jpg', 'destaque lalala', 'a frase final de efeito'),
(4, '2014-03-17', '2014-03-23', '17:27:27', 'quarta novidade', 'quartanovidad dfasdfds', '20140323202727_novidades.jpg', 'descriÃ§Ã£o da novidade', 'Uol', 'www.uol.com.br', '<p>\r\n	vamos ver como &eacute; que funciona tudo.</p>\r\n', 'N', '', '', 'N', '', '', ''),
(5, '2014-03-12', '2014-03-23', '17:32:37', 'lalalala', 'lelelele', '20140323203237_novidades.jpg', 'lliilii', 'hahahh', 'www.hahaha.com', '<p>\r\n	llololocsd&nbsp; losdd lfosd&nbsp; skdfsdk&nbsp; sdkfdsk fsd</p>\r\n', 'N', '', '', 'N', '', '', ''),
(6, '2014-03-27', '2014-03-25', '12:50:58', 'Arquitetura acessÃ­vel na Linha Amarela do metro', 'Piso TÃ¡til Ã© o piso diferenciado com textura e cor sempre em destaque com o piso que estiver ao redor. Deve ser perceptÃ­vel por pessoas com deficiÃªncia visual e baixa visÃ£o.\r\n\r\nÃ‰ importante saber que o piso tÃ¡til tem a funÃ§Ã£o de orientar pessoas com deficiÃªncia visual ou com baixa visÃ£o.', '20140325125058_thumb.jpg', 'Grupo de pessoas andando no piso tÃ¡til.', '', '', '<p style="padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;">\r\n	Piso T&aacute;til &eacute; o piso diferenciado com&nbsp;<strong style="padding: 0px; margin: 0px;">textura</strong>&nbsp;e&nbsp;<strong style="padding: 0px; margin: 0px;">cor</strong>&nbsp;sempre em destaque com o piso que estiver ao redor. Deve ser percept&iacute;vel por pessoas com defici&ecirc;ncia visual e baixa vis&atilde;o.</p>\r\n<p style="padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;">\r\n	&Eacute; importante saber que o piso t&aacute;til tem a fun&ccedil;&atilde;o de orientar pessoas com defici&ecirc;ncia visual ou com baixa vis&atilde;o.</p>\r\n<p style="padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;">\r\n	Pode parecer abstrato para as pessoas que enxergam, mas para o deficiente visual e a pessoa com baixa vis&atilde;o este piso &eacute; fundamental para dar autonomia e seguran&ccedil;a no dia a dia!</p>\r\n<p style="padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;">\r\n	Existem dois tipos de piso t&aacute;til: piso t&aacute;til de alerta e piso t&aacute;til direcional.</p>\r\n<p style="padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;">\r\n	O piso t&aacute;til de alerta &eacute; conhecido popularmente como &ldquo;piso de bolinha&rdquo;.</p>\r\n<p style="padding: 0px; margin: 0.7em 0px; line-height: 19.45599937438965px; color: rgb(51, 51, 51); font-family: verdana, tahoma, arial, sans-serif;">\r\n	Sua fun&ccedil;&atilde;o, como o pr&oacute;prio nome j&aacute; diz, &eacute;&nbsp;<strong style="padding: 0px; margin: 0px;">alertar</strong>. Por isso &eacute; instalado em in&iacute;cio e t&eacute;rmino de escadas e rampas; em frente &agrave; porta de elevadores; em rampas de acesso &agrave;s cal&ccedil;adas ou mesmo para alertar quanto a um obst&aacute;culo que o deficiente visual n&atilde;o consiga rastrear com a bengala.</p>\r\n', 'N', '', '', 'N', '', '', ''),
(7, '2014-04-11', '2014-03-26', '14:04:13', 'Curso Acessibilidade em Museus', 'mononononononono', '20140326140413_dsc02290.jpg', 'CrianÃ§a cega tocando rÃ©plica de animal na exposiÃ§Ã£o Ãgua na OCA.', '', '', '<p>\r\n	o CURSO...........................</p>\r\n', 'S', '20140326140413_dsc01393.jpg', '', 'N', '', '', ''),
(8, '2014-03-06', '2014-03-28', '10:13:33', 'Super teste de texto', 'piso tÃ¡til Ã© super legal camila', '', '', '', '', '<p>\r\n	teste</p>\r\n', 'N', '', '', 'N', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_novidade_360_tag`
--

DROP TABLE IF EXISTS `tb_novidade_360_tag`;
CREATE TABLE IF NOT EXISTS `tb_novidade_360_tag` (
  `novidade_360_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`novidade_360_id`,`tag_id`),
  KEY `fk_tb_novidade_360_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_novidade_360_has_tb_tag_tb_novidade_360_idx` (`novidade_360_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_novidade_360_tag`
--

INSERT INTO `tb_novidade_360_tag` (`novidade_360_id`, `tag_id`) VALUES
(6, 1),
(7, 1),
(2, 2),
(3, 2),
(7, 2),
(1, 3),
(2, 3),
(8, 3),
(4, 5),
(6, 5),
(7, 5),
(6, 6),
(6, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_projeto`
--

DROP TABLE IF EXISTS `tb_projeto`;
CREATE TABLE IF NOT EXISTS `tb_projeto` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `tb_projeto`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_projeto_download`
--

DROP TABLE IF EXISTS `tb_projeto_download`;
CREATE TABLE IF NOT EXISTS `tb_projeto_download` (
  `projeto_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`projeto_id`,`download_id`),
  KEY `fk_tb_projeto_has_tb_download_tb_download1_idx` (`download_id`),
  KEY `fk_tb_projeto_has_tb_download_tb_projeto1_idx` (`projeto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_projeto_download`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_projeto_extra`
--

DROP TABLE IF EXISTS `tb_projeto_extra`;
CREATE TABLE IF NOT EXISTS `tb_projeto_extra` (
  `projeto_id` bigint(19) unsigned NOT NULL,
  `extra_id` bigint(19) unsigned NOT NULL,
  `projeto_extra_valor` text NOT NULL,
  PRIMARY KEY (`projeto_id`,`extra_id`),
  KEY `fk_tb_projeto_has_tb_extra_tb_extra1_idx` (`extra_id`),
  KEY `fk_tb_projeto_has_tb_extra_tb_projeto1_idx` (`projeto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_projeto_extra`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_projeto_glossario`
--

DROP TABLE IF EXISTS `tb_projeto_glossario`;
CREATE TABLE IF NOT EXISTS `tb_projeto_glossario` (
  `projeto_id` bigint(19) unsigned NOT NULL,
  `glossario_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`projeto_id`,`glossario_id`),
  KEY `fk_tb_projeto_has_tb_glossario_tb_glossario1_idx` (`glossario_id`),
  KEY `fk_tb_projeto_has_tb_glossario_tb_projeto1_idx` (`projeto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_projeto_glossario`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_projeto_tag`
--

DROP TABLE IF EXISTS `tb_projeto_tag`;
CREATE TABLE IF NOT EXISTS `tb_projeto_tag` (
  `projeto_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`projeto_id`,`tag_id`),
  KEY `fk_tb_projeto_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_projeto_has_tb_tag_tb_projeto1_idx` (`projeto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_projeto_tag`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_servico`
--

DROP TABLE IF EXISTS `tb_servico`;
CREATE TABLE IF NOT EXISTS `tb_servico` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `tb_servico`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_servico_download`
--

DROP TABLE IF EXISTS `tb_servico_download`;
CREATE TABLE IF NOT EXISTS `tb_servico_download` (
  `servico_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`servico_id`,`download_id`),
  KEY `fk_tb_servico_has_tb_download_tb_download1_idx` (`download_id`),
  KEY `fk_tb_servico_has_tb_download_tb_servico1_idx` (`servico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_servico_download`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_servico_extra`
--

DROP TABLE IF EXISTS `tb_servico_extra`;
CREATE TABLE IF NOT EXISTS `tb_servico_extra` (
  `servico_id` bigint(19) unsigned NOT NULL,
  `extra_id` bigint(19) unsigned NOT NULL,
  `servico_extra_valor` text NOT NULL,
  PRIMARY KEY (`servico_id`,`extra_id`),
  KEY `fk_tb_servico_has_tb_extra_tb_extra1_idx` (`extra_id`),
  KEY `fk_tb_servico_has_tb_extra_tb_servico1_idx` (`servico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_servico_extra`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_servico_glossario`
--

DROP TABLE IF EXISTS `tb_servico_glossario`;
CREATE TABLE IF NOT EXISTS `tb_servico_glossario` (
  `servico_id` bigint(19) unsigned NOT NULL,
  `glossario_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`servico_id`,`glossario_id`),
  KEY `fk_tb_servico_has_tb_glossario_tb_glossario1_idx` (`glossario_id`),
  KEY `fk_tb_servico_has_tb_glossario_tb_servico1_idx` (`servico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_servico_glossario`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_servico_tag`
--

DROP TABLE IF EXISTS `tb_servico_tag`;
CREATE TABLE IF NOT EXISTS `tb_servico_tag` (
  `tag_id` bigint(20) NOT NULL,
  `servico_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`tag_id`,`servico_id`),
  KEY `fk_tb_tag_has_tb_servico_tb_servico1_idx` (`servico_id`),
  KEY `fk_tb_tag_has_tb_servico_tb_tag1_idx` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_servico_tag`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tag`
--

DROP TABLE IF EXISTS `tb_tag`;
CREATE TABLE IF NOT EXISTS `tb_tag` (
  `tag_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag_titulo` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tb_tag`
--

INSERT INTO `tb_tag` (`tag_id`, `tag_titulo`) VALUES
(1, 'Acessibilidade'),
(2, 'Cursos'),
(3, 'Projetos'),
(5, 'Evento'),
(6, 'Agenda'),
(7, 'arquitetura');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_texto`
--

DROP TABLE IF EXISTS `tb_texto`;
CREATE TABLE IF NOT EXISTS `tb_texto` (
  `texto_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `texto_dt` date NOT NULL,
  `texto_hr` time NOT NULL,
  `texto_conteudo` longtext NOT NULL,
  PRIMARY KEY (`texto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_texto`
--

INSERT INTO `tb_texto` (`texto_id`, `texto_dt`, `texto_hr`, `texto_conteudo`) VALUES
(1, '2014-03-21', '10:00:00', 'Conteúdo do Quem Somos'),
(2, '2014-03-21', '10:15:00', 'Conteúdo do Acessibilidade');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_curso`
--

DROP TABLE IF EXISTS `tb_tipo_curso`;
CREATE TABLE IF NOT EXISTS `tb_tipo_curso` (
  `tipo_curso_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_curso_titulo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`tipo_curso_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_tipo_curso`
--

INSERT INTO `tb_tipo_curso` (`tipo_curso_id`, `tipo_curso_titulo`) VALUES
(1, 'Geral');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_servico`
--

DROP TABLE IF EXISTS `tb_tipo_servico`;
CREATE TABLE IF NOT EXISTS `tb_tipo_servico` (
  `tipo_servico_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_servico_titulo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`tipo_servico_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_tipo_servico`
--

INSERT INTO `tb_tipo_servico` (`tipo_servico_id`, `tipo_servico_titulo`) VALUES
(1, 'Geral');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `usuario_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_nome` varchar(255) NOT NULL,
  `usuario_login` varchar(255) NOT NULL,
  `usuario_senha` varchar(45) NOT NULL,
  `usuario_email` varchar(255) NOT NULL,
  `usuario_nivel` enum('AS','A','U') NOT NULL DEFAULT 'U',
  `usuario_status` enum('A','I') NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`usuario_id`, `usuario_nome`, `usuario_login`, `usuario_senha`, `usuario_email`, `usuario_nivel`, `usuario_status`) VALUES
(1, 'Jonas Mendes', 'tchoi', 'destino', 'inboxfox@gmail.com', 'AS', 'A'),
(2, 'Josenilson Oliveira', 'joynilson', 'winnie', 'joynilson@gmail.com', 'AS', 'A'),
(4, 'JoÃ£o Batista', 'joao', '123', 'fessorjoao', 'A', 'A'),
(5, 'adm', 'adm', 'adm', 'fessorjoao@gmail.com', 'A', 'A');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `tb_agenda_tag`
--
ALTER TABLE `tb_agenda_tag`
  ADD CONSTRAINT `fk_tb_agenda_has_tb_tag_tb_agenda1` FOREIGN KEY (`agenda_id`) REFERENCES `tb_agenda` (`agenda_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_agenda_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_anunciante_tag`
--
ALTER TABLE `tb_anunciante_tag`
  ADD CONSTRAINT `fk_tb_anunciante_has_tb_tag_tb_anunciante1` FOREIGN KEY (`anunciante_id`) REFERENCES `tb_anunciante` (`anunciante_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_anunciante_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_contato`
--
ALTER TABLE `tb_contato`
  ADD CONSTRAINT `FK_tb_contato_1` FOREIGN KEY (`contato_tipo_id`) REFERENCES `tb_contato_tipo` (`contato_tipo_id`);

--
-- Restrições para a tabela `tb_curso_download`
--
ALTER TABLE `tb_curso_download`
  ADD CONSTRAINT `fk_tb_curso_has_tb_download_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_curso_has_tb_download_tb_download1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_curso_extra`
--
ALTER TABLE `tb_curso_extra`
  ADD CONSTRAINT `fk_tb_curso_has_tb_extra_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_curso_has_tb_extra_tb_extra1` FOREIGN KEY (`extra_id`) REFERENCES `tb_extra` (`extra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_curso_glossario`
--
ALTER TABLE `tb_curso_glossario`
  ADD CONSTRAINT `fk_tb_glossario_has_tb_curso_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_glossario_has_tb_curso_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_curso_tag`
--
ALTER TABLE `tb_curso_tag`
  ADD CONSTRAINT `fk_tb_tag_has_tb_curso_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_tag_has_tb_curso_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_glossario_relacionado`
--
ALTER TABLE `tb_glossario_relacionado`
  ADD CONSTRAINT `fk_tb_glossario_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_glossario_has_tb_glossario_tb_glossario2` FOREIGN KEY (`glossario_id1`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_glossario_tag`
--
ALTER TABLE `tb_glossario_tag`
  ADD CONSTRAINT `fk_tb_tag_has_tb_glossario_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_tag_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_novidade_360_tag`
--
ALTER TABLE `tb_novidade_360_tag`
  ADD CONSTRAINT `fk_tb_novidade_360_has_tb_tag_tb_novidade_360` FOREIGN KEY (`novidade_360_id`) REFERENCES `tb_novidade_360` (`novidade_360_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_novidade_360_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_projeto_download`
--
ALTER TABLE `tb_projeto_download`
  ADD CONSTRAINT `fk_tb_projeto_has_tb_download_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_projeto_has_tb_download_tb_download1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_projeto_extra`
--
ALTER TABLE `tb_projeto_extra`
  ADD CONSTRAINT `fk_tb_projeto_has_tb_extra_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_projeto_has_tb_extra_tb_extra1` FOREIGN KEY (`extra_id`) REFERENCES `tb_extra` (`extra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_projeto_glossario`
--
ALTER TABLE `tb_projeto_glossario`
  ADD CONSTRAINT `fk_tb_projeto_has_tb_glossario_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_projeto_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_projeto_tag`
--
ALTER TABLE `tb_projeto_tag`
  ADD CONSTRAINT `fk_tb_projeto_has_tb_tag_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_projeto_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_servico_download`
--
ALTER TABLE `tb_servico_download`
  ADD CONSTRAINT `fk_tb_servico_has_tb_download_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_servico_has_tb_download_tb_download1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_servico_extra`
--
ALTER TABLE `tb_servico_extra`
  ADD CONSTRAINT `fk_tb_servico_has_tb_extra_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_servico_has_tb_extra_tb_extra1` FOREIGN KEY (`extra_id`) REFERENCES `tb_extra` (`extra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_servico_glossario`
--
ALTER TABLE `tb_servico_glossario`
  ADD CONSTRAINT `fk_tb_servico_has_tb_glossario_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_servico_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_servico_tag`
--
ALTER TABLE `tb_servico_tag`
  ADD CONSTRAINT `fk_tb_tag_has_tb_servico_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_tag_has_tb_servico_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

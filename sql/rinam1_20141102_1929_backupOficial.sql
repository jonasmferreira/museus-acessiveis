-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 186.202.152.130
-- Tempo de Geração: 02/11/2014 às 19:29:13
-- Versão do Servidor: 5.1.73
-- Versão do PHP: 5.3.3-7+squeeze18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `rinam1`
--

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
  PRIMARY KEY (`anunciante_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tb_anunciante`
--

INSERT INTO `tb_anunciante` (`anunciante_id`, `anunciante_dt`, `anunciante_hr`, `anunciante_nome`, `anunciante_tipo_banner`, `anunciante_banner`, `anunciante_banner_desc`, `anuncianete_banner_link`) VALUES
(1, '2014-06-08', '12:04:44', 'Kenzo', 'FB', '20140608120713_perfumekenzo.jpg', 'SÃ©rie de perfumes com estampas marcantes', 'https://www.kenzo.com/'),
(2, '2014-06-08', '12:11:13', 'Side Walk', 'RE', '20140608121113_side_walk.jpg', 'Sapato de couro da marca.', 'http://www.sidewalklojas.com.br/inverno-2014/'),
(3, '2014-06-08', '12:13:34', 'Lolita Lempka', 'FB', '20140608121334_lilitalempka.jpg', 'Modelo posando para o anuncio', 'http://www.sephora.com.br/lolita-lempicka/perfumes/feminino/lolita-lempicka-feminino-eau-de-toilette-1725'),
(4, '2014-06-08', '12:16:01', 'Paco Rabanne', 'RE', '20140608121601_perfume_1_million.jpg', 'Imagem promocional do perfume', 'http://www.sephora.com.br/lolita-lempicka/perfumes/feminino/lolita-lempicka-feminino-eau-de-toilette-1725'),
(6, '2014-06-08', '14:33:01', 'Perfume Natura', 'RE', '20140608143301_capimlimao.jpg', '3 perfumes natura', 'http://www.natura.net/br/index.html'),
(7, '2014-06-08', '14:35:21', 'Tintas Suvinil', 'FB', '20140608143521_banner_suvinil.jpg', '3 latas suvinil', 'http://www.natura.net/br/index.html');

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clipping`
--

DROP TABLE IF EXISTS `tb_clipping`;
CREATE TABLE IF NOT EXISTS `tb_clipping` (
  `clipping_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `clipping_dt_agenda` date NOT NULL,
  `clipping_exibir_listagem` enum('S','N') NOT NULL,
  `clipping_dt` date NOT NULL,
  `clipping_hr` time NOT NULL,
  `clipping_titulo` varchar(255) NOT NULL,
  `clipping_titulo_sintese` varchar(45) DEFAULT NULL,
  `clipping_resumo` text NOT NULL,
  `clipping_thumb` varchar(255) NOT NULL,
  `clipping_thumb_desc` varchar(255) NOT NULL,
  `clipping_fonte` varchar(255) NOT NULL,
  `clipping_url_fonte` varchar(255) NOT NULL,
  `clipping_conteudo` longtext NOT NULL,
  `clipping_exibir_banner` enum('S','N') NOT NULL,
  `clipping_banner` varchar(255) NOT NULL,
  `clipping_banner_desc` text NOT NULL,
  `clipping_exibir_destaque_home` enum('S','N') NOT NULL,
  `clipping_destaque_home` varchar(255) NOT NULL,
  `clipping_destaque_home_desc` text NOT NULL,
  `clipping_destaque_home_frase` text NOT NULL,
  PRIMARY KEY (`clipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clipping_download`
--

DROP TABLE IF EXISTS `tb_clipping_download`;
CREATE TABLE IF NOT EXISTS `tb_clipping_download` (
  `clipping_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`clipping_id`,`download_id`),
  KEY `FK_clipping_download_1` (`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clipping_tag`
--

DROP TABLE IF EXISTS `tb_clipping_tag`;
CREATE TABLE IF NOT EXISTS `tb_clipping_tag` (
  `clipping_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`clipping_id`,`tag_id`),
  KEY `fk_tb_clipping_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_clipping_has_tb_tag_tb_clipping_idx` (`clipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_contato`
--

INSERT INTO `tb_contato` (`contato_id`, `contato_dt`, `contato_hr`, `contato_tipo_id`, `contato_nome`, `contato_link`, `contato_exibir`) VALUES
(1, '2014-04-15', '00:20:14', 2, '11 976313962', '', 'S'),
(2, '2014-04-15', '00:20:14', 1, 'www.facebook.com/museusacessiveis', 'https://www.facebook.com/museus.acessiveis?fref=ts', 'S'),
(3, '2014-10-01', '00:20:14', 5, 'viviane@museusacessiveis.com.br', 'viviane@museusacessiveis.com.br', 'S');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='	' AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `tb_curso`
--

INSERT INTO `tb_curso` (`curso_id`, `tipo_curso_id`, `curso_dt_cad`, `curso_hr_cad`, `curso_dt_ini`, `curso_dt_fim`, `curso_sob_demanda`, `curso_titulo`, `curso_resumo`, `curso_thumb`, `curso_thumb_desc`, `curso_fonte`, `curso_link_fonte`, `curso_conteudo`, `curso_agenda`) VALUES
(13, 6, '2014-09-05', '14:59:12', '0000-00-00', '0000-00-00', 'S', 'AudiodescriÃ§Ã£o - roteiro e produÃ§Ã£o', 'Centrado na realizaÃ§Ã£o de trabalhos prÃ¡ticos de audiodescriÃ§Ã£o orientados por sÃ³lido embasamento teÃ³rico e anÃ¡lise de exemplos, o curso objetiva o desenvolvimento de roteiros de audiodescriÃ§Ã£o para produtos culturais audiovisuais. No decorrer do programa pretende-se desenvolver a capacidade crÃ­tica em relaÃ§Ã£o a acessibilidade para pessoas com deficiÃªncia visual em espaÃ§os culturais. Ao final do curso, grupos de alunos irÃ£o promover ofertas de audiodescriÃ§Ã£o em vÃ­deos institucionais e de artistas, performances de artistas e para materiais educativos do museu.', '20140905145912_nova_imagem.bmp', 'Centrado na realizaÃ§Ã£o de trabalhos prÃ¡ticos de audiodescriÃ§Ã£o orientados por sÃ³lido embasamento teÃ³rico e anÃ¡lise de exemplos, o curso objetiva o desenvolvimento de roteiros de audiodescriÃ§Ã£o para produtos culturais audiovisuais. No decorrer do programa pretende-se desenvolver a capacidade crÃ­tica em relaÃ§Ã£o a acessibilidade para pessoas com deficiÃªncia visual em espaÃ§os culturais. Ao final do curso, grupos de alunos irÃ£o promover ofertas de audiodescriÃ§Ã£o em vÃ­deos institucionais e de artistas, performances de artistas e para materiais educativos do museu.', '', '', '', '0000-00-00'),
(14, 6, '2014-09-05', '15:04:59', '0000-00-00', '0000-00-00', 'S', 'AudiodescriÃ§Ã£o para espaÃ§os culturais - audioguias e visitas educativas com audiodescriÃ§Ã£o', 'Centrado na realizaÃ§Ã£o de roteiros de audioguias e visitas educativas com audiodescriÃ§Ã£o orientados por sÃ³lido embasamento teÃ³rico e anÃ¡lise de exemplos, o curso objetiva o desenvolvimento de recursos educativos acessÃ­veis para pessoas com deficiÃªncia visual em espaÃ§os culturais. No decorrer do programa pretende-se desenvolver a capacidade crÃ­tica em relaÃ§Ã£o a acessibilidade para pessoas com deficiÃªncia visual em espaÃ§os culturais. Ao final do curso os alunos irÃ£o promover visitas educativas com audiodescriÃ§Ã£o e faixas de audiodescriÃ§Ã£o para o audioguias de espaÃ§os culturais e exposiÃ§Ãµes.', '20140905150459_vsitanteaudioguiatoque.jpg', 'Centrado na realizaÃ§Ã£o de roteiros de audioguias e visitas educativas com audiodescriÃ§Ã£o orientados por sÃ³lido embasamento teÃ³rico e anÃ¡lise de exemplos, o curso objetiva o desenvolvimento de recursos educativos acessÃ­veis para pessoas com deficiÃªncia visual em espaÃ§os culturais. No decorrer do programa pretende-se desenvolver a capacidade crÃ­tica em relaÃ§Ã£o a acessibilidade para pessoas com deficiÃªncia visual em espaÃ§os culturais. Ao final do curso os alunos irÃ£o promover visitas educativas com audiodescriÃ§Ã£o e faixas de audiodescriÃ§Ã£o para o audioguias de espaÃ§os culturais e exposiÃ§Ãµes.', '', '', '', '0000-00-00'),
(15, 3, '2014-09-05', '15:15:58', '0000-00-00', '0000-00-00', 'S', 'Acessibilidade em EspaÃ§os Culturais', 'O curso Acessibilidade em EspaÃ§os Culturais: MediaÃ§Ã£o e ComunicaÃ§Ã£o Sensorial tem como objetivo capacitar os \r\nparticipantes para propor e avaliar projetos e programas culturais acessÃ­veis para pessoas com deficiÃªncia e pÃºblicos nÃ£o usuais \r\nutilizando estratÃ©gias de mediaÃ§Ã£o e comunicaÃ§Ã£o sensoriais. \r\nO curso Ã© baseado em aulas teÃ³ricas, apresentaÃ§Ã£o de casos de sucesso, conversas com pessoas com deficiÃªncia, atividades de \r\nvivÃªncia e avaliaÃ§Ã£o de acessibilidade na prÃ¡tica. ', '20140905151558_nova_imagem_(82).jpg', 'O curso Acessibilidade em EspaÃ§os Culturais: MediaÃ§Ã£o e ComunicaÃ§Ã£o Sensorial tem como objetivo capacitar os \\r\\nparticipantes para propor e avaliar projetos e programas culturais acessÃ­veis para pessoas com deficiÃªncia e pÃºblicos nÃ£o usuais \\r\\nutilizando estratÃ©gias de mediaÃ§Ã£o e comunicaÃ§Ã£o sensoriais. \\r\\nO curso Ã© baseado em aulas teÃ³ricas, apresentaÃ§Ã£o de casos de sucesso, conversas com pessoas com deficiÃªncia, atividades de \\r\\nvivÃªncia e avaliaÃ§Ã£o de acessibilidade na prÃ¡tica. ', '', '', '', '0000-00-00'),
(16, 5, '2014-09-05', '15:21:56', '0000-00-00', '0000-00-00', 'S', 'EliminaÃ§Ã£o de Barreiras Atitudinais ', 'Esse curso trabalha prÃ¡ticas e conceitos para que os participantes tenham informaÃ§Ãµes e seguranÃ§a para lidar com pessoas com deficiÃªncia em situaÃ§Ãµes cotidianas respeitando seus direitos e sua dignidade.', '20140905152156_dsc03743.jpg', 'Esse curso trabalha prÃ¡ticas e conceitos para que os participantes tenham informaÃ§Ãµes e seguranÃ§a para lidar com pessoas com deficiÃªncia em situaÃ§Ãµes cotidianas respeitando seus direitos e sua dignidade.', '', '', '', '0000-00-00');

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

INSERT INTO `tb_curso_extra` (`curso_id`, `extra_id`, `curso_extra_valor`) VALUES
(13, 1, ''),
(13, 2, ''),
(13, 3, ''),
(13, 4, ''),
(14, 1, ''),
(14, 2, ''),
(14, 3, ''),
(14, 4, ''),
(15, 1, ''),
(15, 2, ''),
(15, 3, ''),
(15, 4, ''),
(16, 1, ''),
(16, 2, ''),
(16, 3, ''),
(16, 4, '');

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
(1, 13),
(4, 13),
(8, 13),
(1, 14),
(4, 14),
(1, 15),
(7, 15);

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
(1, 13),
(2, 13),
(1, 14),
(2, 14),
(1, 15),
(2, 15),
(3, 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_depoimento`
--

DROP TABLE IF EXISTS `tb_depoimento`;
CREATE TABLE IF NOT EXISTS `tb_depoimento` (
  `depoimento_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `depoimento_dt` date NOT NULL,
  `depoimento_conteudo` text NOT NULL,
  `depoimento_autor` varchar(255) NOT NULL,
  `depoimento_empresa` varchar(255) NOT NULL,
  PRIMARY KEY (`depoimento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_depoimento`
--

INSERT INTO `tb_depoimento` (`depoimento_id`, `depoimento_dt`, `depoimento_conteudo`, `depoimento_autor`, `depoimento_empresa`) VALUES
(1, '2014-08-05', 'Um teste de cadastro de depoimento, que o JoÃ£o vai apagar depois.', 'Josenilson', 'Mobile Estudio'),
(3, '0000-00-00', 'Visita sensorial - Marieta Boimel\r\n\r\nEmbora nÃ£o tivesse acesso a quase nenhum material de divulgaÃ§Ã£o da exposiÃ§Ã£o"PoÃ©tica da percepÃ§Ã£o", criei alguma expectativa pois aqui no Brasil, era a primeira vez que ouvira falar, embora vagamente, de uma exposiÃ§Ã£o em que o deficiente pudesse realizar a visita de forma totalmente autÃ´noma.Na minha concepÃ§Ã£o, autonomia significa que algum recurso estaria disponÃ­vel para que se concretizasse esta proposta.Pressupunha indicaÃ§Ã£o desde a entrada, atÃ© a informaÃ§Ã£o de como chegar ao local de maneira independente. Na auseÃªncia  destas referÃªncias, e por sorte estando acompanhada de videntes, que se incumbiram de suprir esta lacuna. SÃ³ entÃ£o, apresentou-se um responsÃ¡vel pelo nosso acompanhamento durante a visita.Contava, no mÃ­nimo, com alguÃ©m treinado na conduÃ§Ã£o de pessoa com dificuldade visual, o que nÃ£o foi a realidade. Uma mescla de sentimentos antagÃ´nicos num trajeto entre uma dose de decepÃ§Ã£o e a expectativa de se repetir uma experiÃªncia vivida quinze anos passados, quando todos estes requisitos estavam preenchidos, se repetisse agora.\r\n\r\nMarieta Boimel tem deficiÃªncia visual e Ã© consultora da Museus AcessÃ­veis\r\n', 'Marieta Boimel', 'Museus AcessÃ­veis');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_download`
--

DROP TABLE IF EXISTS `tb_download`;
CREATE TABLE IF NOT EXISTS `tb_download` (
  `download_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `download_titulo` varchar(255) NOT NULL,
  `download_tipo` int(2) NOT NULL,
  `download_tipo_desc` varchar(255) NOT NULL,
  `download_categoria_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `download_tamanho` decimal(25,2) NOT NULL,
  `download_arquivo` varchar(255) NOT NULL,
  `download_dt` date NOT NULL,
  `download_hr` time NOT NULL,
  PRIMARY KEY (`download_id`),
  KEY `idx_down_cat` (`download_categoria_id`),
  KEY `FK_tb_download_cat` (`download_categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_download`
--

INSERT INTO `tb_download` (`download_id`, `download_titulo`, `download_tipo`, `download_tipo_desc`, `download_categoria_id`, `download_tamanho`, `download_arquivo`, `download_dt`, `download_hr`) VALUES
(1, 'A ComunicaÃ§Ã£o dos Sentidos nos EspaÃ§os Culturais Brasileiros - Tese de Doutorado de Viviane Panelli Sarraf', 1, 'PDF', 2, '2554843.00', '20140326143526_tesedigital.pdf', '2014-03-26', '14:35:26'),
(2, 'NoÃ§Ã£o de competÃªncia e a formaÃ§Ã£o do aluno trabalhador', 1, '', 1, '10189318.00', '20140608134209_104329.pdf', '2014-06-08', '13:42:09'),
(3, 'ARTIGO - MidiatizaÃ§Ã£o da Escola', 1, '', 1, '1093859.00', '20140728101248_a_midiatizacÂ§cÂ£o_das_companhias_oficiais_de_dancÂ§a_no_brasil_ecos_de_comunicacÂ§cÂ£o_entre_pcÂºblico_e_privado.pdf', '2014-07-28', '10:12:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_download_categoria`
--

DROP TABLE IF EXISTS `tb_download_categoria`;
CREATE TABLE IF NOT EXISTS `tb_download_categoria` (
  `download_categoria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `download_categoria_titulo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`download_categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_download_categoria`
--

INSERT INTO `tb_download_categoria` (`download_categoria_id`, `download_categoria_titulo`) VALUES
(1, 'Geral'),
(2, 'Teses e artigos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_emailmkt`
--

DROP TABLE IF EXISTS `tb_emailmkt`;
CREATE TABLE IF NOT EXISTS `tb_emailmkt` (
  `emailmkt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emailmkt_titulo` varchar(255) NOT NULL,
  `emailmkt_qtde_enviada` int(11) NOT NULL,
  `emailmkt_dt_agendada` date NOT NULL,
  `emailmkt_hr_agendada` time NOT NULL,
  `emailmkt_dt_disparo` date DEFAULT NULL,
  `emailmkt_hr_disparo` time DEFAULT NULL,
  `emailmkt_status` enum('P','X','E','C','L') NOT NULL DEFAULT 'P',
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
  `emailmkt_propaganda_url` text,
  PRIMARY KEY (`emailmkt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_emailmkt`
--

INSERT INTO `tb_emailmkt` (`emailmkt_id`, `emailmkt_titulo`, `emailmkt_qtde_enviada`, `emailmkt_dt_agendada`, `emailmkt_hr_agendada`, `emailmkt_dt_disparo`, `emailmkt_hr_disparo`, `emailmkt_status`, `emailmkt_servico_ids`, `emailmkt_projeto_ids`, `emailmkt_glossario_ids`, `emailmkt_novidade360_id`, `emailmkt_novidade360_ids`, `emailmkt_agenda_ids`, `emailmkt_arq_fisico`, `emailmkt_aqui_tem_titulo`, `emailmkt_aqui_tem_resumo`, `emailmkt_aqui_tem_thumb`, `emailmkt_aqui_tem_url`, `emailmkt_propaganda_img`, `emailmkt_propaganda_url`) VALUES
(1, 'Teste final de emkt', 0, '2014-08-27', '00:00:00', NULL, NULL, 'P', '', '2', '6', 9, '6,13', '10=>N,11=>N,7=>N', '', 'A sessÃ£o do aqui tem', 'Um texto de resumo para ficar ao lado da imagem. Depois colocamos algo definitivo.', '20140808192309_emkt_aquitem_imagem.jpg', 'www.comicartcommunity.com/gallery', '20140808192309_emkt_imagem.png', 'http://www.ig.com.br'),
(2, 'Email teste 02', 0, '2014-08-10', '00:00:00', NULL, NULL, 'P', '1,2', '1', '8', 13, '13,8,10,11', '11=>N,9=>N,7=>N', '', 'Conheca mais sobre o Museu da InclusÃ£o', ' teste   teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste  teste ', '', 'http://www.memorialdainclusao.sp.gov.br/br/home/index.shtml', '', NULL),
(3, 'teste', 0, '2014-08-13', '00:00:00', NULL, NULL, 'P', '5', '1', '7', 13, '7,6,15,14', '8=>N,10=>N,11=>N', '', 'teste', 'dasfghjk', '', 'http://freakshare.com/files/675tz0yo/PNT00005.7z.html', '', 'http://freakshare.com/files/675tz0yo/PNT00005.7z.html'),
(4, 'TESTE', 0, '2014-08-20', '12:00:00', NULL, NULL, 'P', '2', '1', '1', 12, '9,6,15', '8=>N,10=>N,9=>N', '', 'teste', 'teste', '', 'www.uol.com.br', '', 'www.uo.com.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_emailmkt_conferencia`
--

DROP TABLE IF EXISTS `tb_emailmkt_conferencia`;
CREATE TABLE IF NOT EXISTS `tb_emailmkt_conferencia` (
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
  KEY `fk_emailmkt_conferencia_02_idx` (`mailing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_extra`
--

DROP TABLE IF EXISTS `tb_extra`;
CREATE TABLE IF NOT EXISTS `tb_extra` (
  `extra_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `extra_nome_campo` varchar(255) NOT NULL,
  PRIMARY KEY (`extra_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_extra`
--

INSERT INTO `tb_extra` (`extra_id`, `extra_nome_campo`) VALUES
(1, 'testeeeeee'),
(2, 'LicitaÃ§Ãµes'),
(3, 'PreÃ§o'),
(4, 'Dados especÃ­ficos de cada curso');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `tb_glossario`
--

INSERT INTO `tb_glossario` (`glossario_id`, `glossario_dt`, `glossario_hr`, `glossario_palavra`, `glossario_definicao`, `glossario_fonte`, `glossario_link_fonte`, `glossario_conteudo`, `glossario_exibir`) VALUES
(1, '2014-03-22', '13:21:57', 'Acessibilidade', 'Aqui a gente explica rapidamente como funciona a acessibilidade', 'Google', 'www.google.com.br', '<p>\r\n	Aqui tem todo o detalhamento do termo do gloss&aacute;rio para ser exibido em algum lugar do site. Acessibilidade.</p>\r\n', 'S'),
(2, '2014-03-22', '13:24:28', 'ISO', 'Internation Standardization Organization', 'JoynilsonArt', 'http://joynilsonart.blogspot.com', '<p>\r\n	Aqui descrevemos para que serve o ISO e colocamos uma imagem para testar....</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<img alt="" src="http://localhost/MuseusAcessiveis/imgs_rich/images/Calendario_Capa.jpg" style="width: 270px; height: 350px; border-width: 0px; border-style: solid; margin: 0px; float: left;" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	No final mais um texto e outra imagem.</p>\r\n<p>\r\n	<img alt="" src="http://localhost/MuseusAcessiveis/imgs_rich/images/Superman_rough.jpg" style="width: 60%; height: 60%; border-width: 0px; border-style: solid; margin: 0px; float: right;" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Depois fim!</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 'S'),
(3, '2014-03-25', '12:43:10', 'Piso tÃ¡til', 'Ã‰ o piso diferenciado com textura e cor sempre em destaque com o piso que estiver ao redor. Deve ser perceptÃ­vel por pessoas com deficiÃªncia visual e baixa visÃ£o.', 'Thais Frota', 'http://thaisfrota.wordpress.com/2009/08/05/o-que-e-piso-tatil/', '', 'S'),
(4, '2014-03-26', '13:45:27', 'AudiodescriÃ§Ã£o', 'Recurso de acessibilidade que permite que as pessoas com deficiÃªncia visual possam assistir e entender melhor filmes, peÃ§as de teatro, programas de TV, exposiÃ§Ãµes, mostras, musicais, Ã³peras e demais manifestaÃ§Ãµes e recursos visuais, por meio da traduÃ§Ã£o de imagens em textos descritivos.\r\n', 'Viviane Sarraf', '', '', 'S'),
(6, '2014-04-15', '11:01:36', 'Barreiras atitudinais', 'Preconceitos, estigmas e estereÃ³tipos, que resultam em discriminaÃ§Ã£o das pessoas com deficiÃªncia.', 'Viviane Sarraf', '', '', 'S'),
(7, '2014-04-15', '11:05:00', 'Desenho Universal', 'Ã‰ a criaÃ§Ã£o de ambientes, produtos e serviÃ§os acessÃ­veis para todas as \r\npessoas, independente de suas caracterÃ­sticas pessoais, idade, ou habilidades. O conceito de Desenho Universal defende que qualquer ambiente ou produto pode ser alcanÃ§ado, manipulado e usado, independentemente do tamanho do corpo do indivÃ­duo, sua postura ou sua mobilidade.\r\n\r\n', 'Viviane Sarraf', '', '', 'S'),
(8, '2014-06-08', '11:37:23', 'Audiovisual', 'ComunicaÃ§Ã£o audiovisual Ã© todo meio de comunicaÃ§Ã£o expresso com a utilizaÃ§Ã£o conjunta de componentes visuais (signos, imagens, desenhos, grÃ¡ficos etc.) e sonoros (voz, mÃºsica, ruÃ­do, efeitos sonoros etc.), ou seja, tudo que pode ser ao mesmo tempo visto e ouvido.', 'WikipÃ©dia', 'http://pt.wikipedia.org/wiki/Comunica%C3%A7%C3%A3o_audiovisual', '<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n', 'S'),
(9, '2014-06-08', '11:42:47', 'Braille', 'Braille ou braile1 Ã© um sistema de leitura com o tato para cegos inventado pelo francÃªs Louis Braille no ano de 1827 em Paris.\r\n\r\nO Braille Ã© um alfabeto convencional cujos caracteres se indicam por pontos em alto relevo. O deficiente visual distingue por meio do tato. A partir dos seis pontos relevantes, Ã© possÃ­vel fazer 63 combinaÃ§Ãµes que podem representar letras simples e acentuadas, pontuaÃ§Ãµes, nÃºmeros, sinais matemÃ¡ticos e notas musicais.', 'WikipÃ©dia', 'http://pt.wikipedia.org/wiki/Braille', '<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n', 'S'),
(11, '2014-07-28', '10:04:36', 'Daisy', 'Reconhecido internacionalmente como um dos mais modernos recursos de acessibilidade de leitura, o formato Daisy (Digital Accessible Information System) serÃ¡ foco do Congresso Internacional Daisy realizado ', 'Daisy Consortium', 'http://www.acessibilidadeinclusiva.com.br/brasil-sedia-congresso-internacional-de-livros-digitais-daisy/', '<p>\r\n	<span style="color: rgb(85, 85, 85); font-family: Tahoma, ''century gothic'', Arial, verdana, sans-serif; font-size: 13px; line-height: 20px; text-align: justify;">Reconhecido internacionalmente como um dos mais modernos recursos de acessibilidade de leitura, o formato Daisy (Digital Accessible Information System) ser&aacute; foco do Congresso Internacional Daisy realizado&nbsp;</span></p>\r\n<p>\r\n	<span style="color: rgb(85, 85, 85); font-family: Tahoma, ''century gothic'', Arial, verdana, sans-serif; font-size: 13px; line-height: 20px; text-align: justify;">Reconhecido internacionalmente como um dos mais modernos recursos de acessibilidade de leitura, o formato Daisy (Digital Accessible Information System) ser&aacute; foco do Congresso Internacional Daisy realizado&nbsp;</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="color: rgb(85, 85, 85); font-family: Tahoma, ''century gothic'', Arial, verdana, sans-serif; font-size: 13px; line-height: 20px; text-align: justify;">Reconhecido internacionalmente como um dos mais modernos recursos de acessibilidade de leitura, o formato Daisy (Digital Accessible Information System) ser&aacute; foco do Congresso Internacional Daisy realizado&nbsp;</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="color: rgb(85, 85, 85); font-family: Tahoma, ''century gothic'', Arial, verdana, sans-serif; font-size: 13px; line-height: 20px; text-align: justify;">Reconhecido internacionalmente como um dos mais modernos recursos de acessibilidade de leitura, o formato Daisy (Digital Accessible Information System) ser&aacute; foco do Congresso Internacional Daisy realizado&nbsp;</span></p>\r\n', 'S'),
(14, '2014-09-08', '15:57:24', 'Piso PodotÃ¡til', 'Piso com textura diferenciada de em relaÃ§Ã£o ao piso original da edificaÃ§Ã£o destinado a sinalizar alerta ou linha guia para pessoas com deficiÃªncia visual.  ', 'Viviane Sarraf', '', '', 'S');

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
(7, 1),
(3, 2),
(14, 7);

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
(3, 2),
(5, 2),
(3, 3),
(5, 4),
(1, 7),
(7, 7),
(1, 14),
(7, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_imprensa`
--

DROP TABLE IF EXISTS `tb_imprensa`;
CREATE TABLE IF NOT EXISTS `tb_imprensa` (
  `imprensa_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imprensa_assessoria_nome` varchar(255) NOT NULL,
  `imprensa_assessoria_telefone` varchar(255) NOT NULL,
  `imprensa_assessoria_email` varchar(255) NOT NULL,
  `novidade_360_id` bigint(20) unsigned NOT NULL,
  `imprensa_nossos_numeros` text NOT NULL,
  PRIMARY KEY (`imprensa_id`),
  KEY `FK_tb_imprensa_1` (`novidade_360_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_imprensa`
--

INSERT INTO `tb_imprensa` (`imprensa_id`, `imprensa_assessoria_nome`, `imprensa_assessoria_telefone`, `imprensa_assessoria_email`, `novidade_360_id`, `imprensa_nossos_numeros`) VALUES
(1, 'Adriana Kravchenkooo', '55 11 00000 0000', 'contato@museusacesseiveis.com.br', 16, '<p>\r\n	Algumas informa&ccedil;&otilde;es num&eacute;ricas.</p>\r\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_imprensa_OLD`
--

DROP TABLE IF EXISTS `tb_imprensa_OLD`;
CREATE TABLE IF NOT EXISTS `tb_imprensa_OLD` (
  `imprensa_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `imprensa_titulo` varchar(255) NOT NULL,
  `imprensa_tipo` int(2) NOT NULL,
  `imprensa_tamanho` decimal(25,2) NOT NULL,
  `imprensa_arquivo` varchar(255) NOT NULL,
  `imprensa_dt` date NOT NULL,
  `imprensa_hr` time NOT NULL,
  PRIMARY KEY (`imprensa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_imprensa_OLD`
--

INSERT INTO `tb_imprensa_OLD` (`imprensa_id`, `imprensa_titulo`, `imprensa_tipo`, `imprensa_tamanho`, `imprensa_arquivo`, `imprensa_dt`, `imprensa_hr`) VALUES
(1, 'Material para Imprensa - Abertura Bem estar', 6, '1289033.00', '20140728101438_abertura_bem_estar.mp4', '2014-07-28', '10:14:38');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `tb_mailing`
--

INSERT INTO `tb_mailing` (`mailing_id`, `mailing_nome`, `mailing_email`, `mailing_enviar`) VALUES
(1, 'Josenilson Oliveira', 'joynilson@gmail.com', 'S'),
(2, 'Josenilson Costa', 'joynilsonart@yahoo.com.br', 'N'),
(3, 'Lilian Stocco', 'naradub@yahoo.com.br', 'S'),
(4, 'JoÃ£o Batista', 'fessorjoao@gmail.com', 'S'),
(5, 'Jonas Mendes', 'inboxfox@gmail.com', 'S'),
(6, 'Uchiha Tchoi', 'uchihatchoi@gmail.com', 'N'),
(7, 'JoÃ£o Batista de Macedo JÃºnior', 'fessorjoao@gmail.com', 'N'),
(8, 'JoÃ£o Batista de Macedo', 'carambavil@hotmail.com', 'N'),
(9, 'Thais', 'Thamayumi@hotmail.com', 'N'),
(10, 'JoÃ£o', 'joao@jocoso.com.br', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_novidade_360`
--

DROP TABLE IF EXISTS `tb_novidade_360`;
CREATE TABLE IF NOT EXISTS `tb_novidade_360` (
  `novidade_360_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `novidade_360_dt_agenda` date NOT NULL,
  `novidade_360_exibir_listagem` enum('S','N') NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `tb_novidade_360`
--

INSERT INTO `tb_novidade_360` (`novidade_360_id`, `novidade_360_dt_agenda`, `novidade_360_exibir_listagem`, `novidade_360_dt`, `novidade_360_hr`, `novidade_360_titulo`, `novidade_360_titulo_sintese`, `novidade_360_resumo`, `novidade_360_thumb`, `novidade_360_thumb_desc`, `novidade_360_fonte`, `novidade_360_url_fonte`, `novidade_360_conteudo`, `novidade_360_exibir_banner`, `novidade_360_banner`, `novidade_360_banner_desc`, `novidade_360_exibir_destaque_home`, `novidade_360_destaque_home`, `novidade_360_destaque_home_desc`, `novidade_360_destaque_home_frase`) VALUES
(6, '2014-07-28', 'S', '2014-08-09', '19:39:55', 'Dia da Arquitetura acessÃ­vel na Linha Amarela do metro', 'Arquitetura AcessÃ­vel', 'Piso TÃ¡til Ã© o piso diferenciado com textura e cor sempre em destaque com o piso que estiver ao redor. Deve ser perceptÃ­vel por pessoas com deficiÃªncia visual e baixa visÃ£o.\r\n\r\nÃ‰ importante saber que o piso tÃ¡til tem a funÃ§Ã£o de orientar pessoas com deficiÃªncia visual ou com baixa visÃ£o.', '20140325125058_thumb.jpg', 'Grupo de pessoas andando no piso tÃ¡til.', 'Ãšltimo Segundo', 'http://ultimosegundo.ig.com.br/brasil/sp/2014-06-06/tres-linhas-do-metro-estao-paralisadas-pelo-segundo-dia-em-sao-paulo.html', '<p>\r\n	Piso t&aacute;til &eacute; o piso diferenciado com&nbsp;<strong style="padding: 0px; margin: 0px;">textura</strong>&nbsp;e&nbsp;<strong style="padding: 0px; margin: 0px;">cor</strong>&nbsp;sempre em destaque com o piso que estiver ao redor. Deve ser percept&iacute;vel por pessoas com defici&ecirc;ncia visual e baixa vis&atilde;o.</p>\r\n<p>\r\n	<img alt="" src="http://www.museusacessiveis.com.br/sitenovo/imgs_rich/images/foto_exemplo_500x375.jpg" style="width: 500px; height: 375px;" /></p>\r\n<p>\r\n	&Eacute; importante saber que o piso t&aacute;til tem a fun&ccedil;&atilde;o de orientar pessoas com defici&ecirc;ncia visual ou com baixa vis&atilde;o.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Pode parecer abstrato para as pessoas que enxergam, mas para o deficiente visual e a pessoa com baixa vis&atilde;o este piso &eacute; fundamental para dar autonomia e seguran&ccedil;a no dia a dia!</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Existem dois tipos de piso t&aacute;til: piso t&aacute;til de alerta e piso t&aacute;til direcional.O piso t&aacute;til de alerta &eacute; conhecido popularmente como &ldquo;piso de bolinha&rdquo;. Sua fun&ccedil;&atilde;o, como o pr&oacute;prio nome j&aacute; diz, &eacute;&nbsp;<strong style="padding: 0px; margin: 0px;">alertar</strong>. Por isso &eacute; instalado em in&iacute;cio e t&eacute;rmino de escadas e rampas; em frente &agrave; porta de elevadores; em rampas de acesso &agrave;s cal&ccedil;adas ou mesmo para alertar quanto a um obst&aacute;culo que o deficiente visual n&atilde;o consiga rastrear com a bengala.</p>\r\n<p>\r\n	<img alt="" src="http://www.museusacessiveis.com.br/sitenovo/imgs_rich/images/foto_exemplo_500x375.jpg" style="width: 500px; height: 375px;" /></p>\r\n', 'N', '', '', 'N', '', '', ''),
(7, '2014-06-26', 'S', '2014-06-13', '07:49:21', 'Curso Acessibilidade em Museus', 'Curso Legal', 'Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos.', '20140608103931_acessibilidade.jpg', 'CrianÃ§a cega tocando rÃ©plica de animal na exposiÃ§Ã£o Ãgua na OCA.', 'Acessibilidade nos Museus', 'http://acessibilidadenosmuseus.blogspot.com.br/', '<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n', 'S', '20140608103931_acessibilidade_museus.jpg', '', 'N', '', '', ''),
(8, '2014-04-15', 'S', '2014-08-12', '02:07:04', 'Manual de Acesibilidade em Museus, PatrimÃ´nio Cultural e Natural Ã© lanÃ§ado na Espanha', 'Manual de Acesibilidade em Museus', 'LanÃ§ado na Espanha o Manual de Acessibilidade e InclusÃ£o em Museus e PatrimÃ´nio Cultural e Natural.', '20140608101529_feira_espanha.jpg', 'Capa do manual. Fundo bege com faixa verde na parte superior. No centro o tÃ­tulo do livro em letras azuis sem serifa e na parte inferior uma letra M formada por pontos e o sÃ­mbolo universal de acessibilidade: uma pessoa em cadeira de rodas de perfil amb', 'Vilamuseu - Ediciones Trea', 'www.trea.es', '<p>\r\n	Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.&nbsp;Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.&nbsp;Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.&nbsp;Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.&nbsp;Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.&nbsp;Lan&ccedil;ado na Espanha o Manual de Acessibilidade e Inclus&atilde;o em Museus e Patrim&ocirc;nio Cultural e Natural, com coordena&ccedil;&atilde;o editorial de Antonio Espinosa Ruiz e Carmina Bonmat&iacute; Lled&oacute; do Vilamuseu de Vila Joiosa no qual sou co-autora. A venda no site da editora impresso e PDF.</p>\r\n', 'S', '20140608101529_outdoor.jpg', 'Capa do manual. Fundo bege com faixa verde na parte superior. No centro o tÃ­tulo do livro em letras azuis sem serifa e na parte inferior uma letra M formada por pontos e o sÃ­mbolo universal de acessibilidade: uma pessoa em cadeira de rodas de perfil ambos na cor verde claro.zxfasdfasdfasdfa', 'N', '', '', 'LanÃ§ado na Espanha o Manual de Acessibilidade e InclusÃ£o em Museus e PatrimÃ´nio Cultural e Natural.'),
(9, '2014-06-24', 'S', '2014-06-08', '10:49:20', 'Curso de ExtensÃ£o Acessibilidade em Museus na USP', NULL, 'Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos.', '20140608104456_usp.jpg', 'Marca da Universidade de SÃ£o Paulo', 'Google', 'https://www.google.com.br/search?q=usp&es_sm=119&tbm=isch&source=lnms&sa=X&ei=VWiUU5-MIYrPsATSvIDoAg&ved=0CAgQ_AUoAw&biw=1403&bih=726&dpr=0.9', '<div>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</div>\r\n', 'N', '', '', 'N', '', '', ''),
(10, '2014-05-18', 'S', '2014-06-08', '10:29:04', 'Dia Internacional dos Museus', NULL, 'No dia 18 de maio Ã© comemorado o Dia Mundial do Museu. A data foi instituÃ­da pelo ComitÃª Internacional de Museus (ICOM) com o objetivo de chamar a atenÃ§Ã£o da sociedade e do pÃºblico para a importÃ¢ncia dos museus. Afinal, sÃ£o os museus os responsÃ¡veis por preservar a histÃ³ria e a cultura da humanidade.', '20140608102904_dia_internacional.jpg', 'Marca do evento escrito com letras brancas e pretas.', 'Smartkids', 'http://www.smartkids.com.br/datas-comemorativas/18-maio-dia-mundial-dos-museus.html', '<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n', 'N', '', '', 'N', '', '', ''),
(11, '2014-06-10', 'S', '2014-06-08', '09:22:42', 'Feira Reatech', NULL, 'ComeÃ§ou nesta quinta-feira a 12Âª ediÃ§Ã£o da Feira Internacional de Tecnologias em ReabilitaÃ§Ã£o, InclusÃ£o e Acessibilidade (Reatech), a maior do setor no paÃ­s. Segundo dados do Instituto Brasileiro de Geografia e EstatÃ­stica (IBGE), o Brasil possui atualmente cerca de 45 milhÃµes de pessoas com algum tipo de deficiÃªncia ou mobilidade reduzida.', '20140608092242_reatech.jpg', 'IlustraÃ§Ã£o de um coraÃ§Ã£o azul dividido em 4 partes. Cada parte tem um Ã­cone que representa cada deficiÃªncia fÃ­sica.\r\nSob esta ilustraÃ§Ã£o existe um retÃ¢ngulo amarelo.', 'Canaltech', 'http://corporate.canaltech.com.br/noticia/eventos/Reatech-Veja-novidades-tecnologicas-da-maior-feira-de-acessibilidade-do-Brasil/', '<p>\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial; font-size: 13px;">Com foco nas principais inova&ccedil;&otilde;es tecnol&oacute;gicas do setor, o evento tamb&eacute;m traz novos produtos, servi&ccedil;os, palestras, semin&aacute;rios, desfiles e shows. Participam empresas dos setores automobil&iacute;stico, financeiro, ind&uacute;stria, turismo, lazer, animais treinados, equipamentos especiais e at&eacute; ag&ecirc;ncias de emprego, que re&uacute;nem mais de sete mil vagas voltadas &agrave;s pessoas com defici&ecirc;ncia e mobilidade reduzida.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial; font-size: 13px;">Com foco nas principais inova&ccedil;&otilde;es tecnol&oacute;gicas do setor, o evento tamb&eacute;m traz novos produtos, servi&ccedil;os, palestras, semin&aacute;rios, desfiles e shows. Participam empresas dos setores automobil&iacute;stico, financeiro, ind&uacute;stria, turismo, lazer, animais treinados, equipamentos especiais e at&eacute; ag&ecirc;ncias de emprego, que re&uacute;nem mais de sete mil vagas voltadas &agrave;s pessoas com defici&ecirc;ncia e mobilidade reduzida.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial; font-size: 13px;">Com foco nas principais inova&ccedil;&otilde;es tecnol&oacute;gicas do setor, o evento tamb&eacute;m traz novos produtos, servi&ccedil;os, palestras, semin&aacute;rios, desfiles e shows. Participam empresas dos setores automobil&iacute;stico, financeiro, ind&uacute;stria, turismo, lazer, animais treinados, equipamentos especiais e at&eacute; ag&ecirc;ncias de emprego, que re&uacute;nem mais de sete mil vagas voltadas &agrave;s pessoas com defici&ecirc;ncia e mobilidade reduzida.</span></p>\r\n', 'N', '', '', 'N', '', '', ''),
(12, '0000-00-00', 'S', '2014-08-12', '02:08:54', 'Hellen Kellen - Uma histÃ³ria impressionante...', 'Hellen Kellen', 'Tornou-se uma cÃ©lebre e prolÃ­fica escritora, filÃ³sofa e conferencista, uma personagem famosa pelo extenso trabalho que desenvolveu em favor das pessoas portadoras de deficiÃªncia. ..', '20140608125642_helenkeller_mini.jpg', 'A sorridente hellen keller....xfsdfsdfsd', 'WIkipedia', 'http://pt.wikipedia.org/wiki/Helen_Keller', '<p style="margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">\r\n	<b>Helen Adams Keller</b>&nbsp;(<a href="http://pt.wikipedia.org/wiki/Tuscumbia_(Alabama)" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Tuscumbia (Alabama)">Tuscumbia</a>,&nbsp;<a href="http://pt.wikipedia.org/wiki/27_de_junho" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="27 de junho">27 de junho</a>&nbsp;de&nbsp;<a href="http://pt.wikipedia.org/wiki/1880" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="1880">1880</a>&nbsp;&mdash;&nbsp;<a href="http://pt.wikipedia.org/wiki/Westport_(Connecticut)" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Westport (Connecticut)">Westport</a>,&nbsp;<a href="http://pt.wikipedia.org/wiki/1_de_junho" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="1 de junho">1 de junho</a>&nbsp;de&nbsp;<a href="http://pt.wikipedia.org/wiki/1968" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="1968">1968</a>) foi uma&nbsp;<a class="mw-redirect" href="http://pt.wikipedia.org/wiki/Escritora" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Escritora">escritora</a>, conferencista e ativista social&nbsp;<a href="http://pt.wikipedia.org/wiki/Estados_Unidos" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Estados Unidos">estadunidense</a>. Foi a primeira pessoa surda a conquistar o bacharelado em artes....</p>\r\n<p style="margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">\r\n	A hist&oacute;ria sobre como sua professora, Anne Sullivan, conseguiu romper o isolamento imposto pela quase total falta de comunica&ccedil;&atilde;o, permitindo &agrave; menina florescer enquanto aprendia a se comunicar, tornou-se amplamente conhecida atrav&eacute;s do roteiro da pe&ccedil;a&nbsp;<a class="mw-redirect" href="http://pt.wikipedia.org/wiki/The_Miracle_Worker" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="The Miracle Worker">The Miracle Worker</a>&nbsp;que virou o filme&nbsp;<a href="http://pt.wikipedia.org/wiki/O_Milagre_de_Anne_Sullivan" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="O Milagre de Anne Sullivan">O Milagre de Anne Sullivan</a>&nbsp;(1962), dirigido por Arthur Penn (em Portugal, O Milagre de Helen Keller). Seu anivers&aacute;rio em 27 de junho &eacute; comemorado como o Helen Keller Day no estado da Pennsylvania e foi autorizado em n&iacute;vel federal atrav&eacute;s a proclama&ccedil;&atilde;o presidencial de Jimmy Carter em 1980, no centen&aacute;rio de seu nascimento.</p>\r\n<p style="margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">\r\n	Tornou-se uma c&eacute;lebre e prol&iacute;fica escritora, fil&oacute;sofa e conferencista, uma personagem famosa pelo extenso trabalho que desenvolveu em favor das pessoas portadoras de&nbsp;<a href="http://pt.wikipedia.org/wiki/Defici%C3%AAncia" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="DeficiÃªncia">defici&ecirc;ncia</a>. Keller viajou muito e expressava de forma contundente suas convic&ccedil;&otilde;es. Membro do Socialist Party of America e do Industrial Workers of the World, participou das campanhas pelo voto feminino, direitos trabalhistas, socialismo e outras causas de esquerda. Ela foi introduzida no Alabama Women&#39;s Hall of Fame em 1971.</p>\r\n<p style="margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">\r\n	<b>Helen Adams Keller</b>&nbsp;(<a href="http://pt.wikipedia.org/wiki/Tuscumbia_(Alabama)" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Tuscumbia (Alabama)">Tuscumbia</a>,&nbsp;<a href="http://pt.wikipedia.org/wiki/27_de_junho" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="27 de junho">27 de junho</a>&nbsp;de&nbsp;<a href="http://pt.wikipedia.org/wiki/1880" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="1880">1880</a>&nbsp;&mdash;&nbsp;<a href="http://pt.wikipedia.org/wiki/Westport_(Connecticut)" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Westport (Connecticut)">Westport</a>,&nbsp;<a href="http://pt.wikipedia.org/wiki/1_de_junho" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="1 de junho">1 de junho</a>&nbsp;de&nbsp;<a href="http://pt.wikipedia.org/wiki/1968" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="1968">1968</a>) foi uma&nbsp;<a class="mw-redirect" href="http://pt.wikipedia.org/wiki/Escritora" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Escritora">escritora</a>, conferencista e ativista social&nbsp;<a href="http://pt.wikipedia.org/wiki/Estados_Unidos" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Estados Unidos">estadunidense</a>. Foi a primeira pessoa surda a conquistar o bacharelado em artes.</p>\r\n<p style="margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">\r\n	A hist&oacute;ria sobre como sua professora, Anne Sullivan, conseguiu romper o isolamento imposto pela quase total falta de comunica&ccedil;&atilde;o, permitindo &agrave; menina florescer enquanto aprendia a se comunicar, tornou-se amplamente conhecida atrav&eacute;s do roteiro da pe&ccedil;a&nbsp;<a class="mw-redirect" href="http://pt.wikipedia.org/wiki/The_Miracle_Worker" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="The Miracle Worker">The Miracle Worker</a>&nbsp;que virou o filme&nbsp;<a href="http://pt.wikipedia.org/wiki/O_Milagre_de_Anne_Sullivan" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="O Milagre de Anne Sullivan">O Milagre de Anne Sullivan</a>&nbsp;(1962), dirigido por Arthur Penn (em Portugal, O Milagre de Helen Keller). Seu anivers&aacute;rio em 27 de junho &eacute; comemorado como o Helen Keller Day no estado da Pennsylvania e foi autorizado em n&iacute;vel federal atrav&eacute;s a proclama&ccedil;&atilde;o presidencial de Jimmy Carter em 1980, no centen&aacute;rio de seu nascimento.</p>\r\n<p style="margin: 0.5em 0px; line-height: 22.399999618530273px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">\r\n	Tornou-se uma c&eacute;lebre e prol&iacute;fica escritora, fil&oacute;sofa e conferencista, uma personagem famosa pelo extenso trabalho que desenvolveu em favor das pessoas portadoras de&nbsp;<a href="http://pt.wikipedia.org/wiki/Defici%C3%AAncia" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="DeficiÃªncia">defici&ecirc;ncia</a>. Keller viajou muito e expressava de forma contundente suas convic&ccedil;&otilde;es. Membro do Socialist Party of America e do Industrial Workers of the World, participou das campanhas pelo voto feminino, direitos trabalhistas, socialismo e outras causas de esquerda. Ela foi introduzida no Alabama Women&#39;s Hall of Fame em 1971.</p>\r\n', 'N', '', '', 'S', '20140608125424_helenkeller.jpg', 'Fotografia da sorridente helen keller', 'Ter pena de si prÃ³prio Ã© o seu pior inimigo, e se continuar nunca conseguira alcanÃ§ar nada no mundo....'),
(13, '0000-00-00', 'S', '2014-06-12', '14:31:38', 'Dorina Nowill - Uma histÃ³ria impressionante', 'Dorina Nowill', 'Dorina de GouvÃªa Nowill faleceu em 29 de agosto de 2010, aos 91 anos de idade. Deixou ao Brasil e ao mundo uma instituiÃ§Ã£o reconhecida pela qualidade de seus livros acessÃ­veis e serviÃ§os de reabilitaÃ§Ã£o. Deixou Ã  pessoa com deficiÃªncia visual a oportunidade de viver com dignidade e Ã s pessoas que enxergam uma liÃ§Ã£o de vida.', '20140608130501_dorinamini.jpg', 'Foto da sorridente dona dorina', 'FundaÃ§Ã£o Dorina Nowill para Cegos', 'http://www.fundacaodorina.org.br/quem-somos/dorina-de-gouvea-nowill/', '<p class="olho02" style="margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;">\r\n	Dorina de Gouv&ecirc;a Nowill faleceu em 29 de agosto de 2010, aos 91 anos de idade. Deixou ao Brasil e ao mundo uma institui&ccedil;&atilde;o reconhecida pela qualidade de seus livros acess&iacute;veis e servi&ccedil;os de reabilita&ccedil;&atilde;o. Deixou &agrave; pessoa com defici&ecirc;ncia visual a oportunidade de viver com dignidade e &agrave;s pessoas que enxergam uma li&ccedil;&atilde;o de vida.</p>\r\n<p class="olho02" style="margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;">\r\n	&nbsp;</p>\r\n<p class="olho02" style="margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;">\r\n	<span style="font-size: 1.2em; line-height: 1.5em;">Perseveran&ccedil;a, caridade, resigna&ccedil;&atilde;o e paci&ecirc;ncia s&atilde;o as li&ccedil;&otilde;es deixadas por esta paulista que enxergava o mundo com os olhos da alma. Cega aos 17 anos, Dorina Nowill foi criadora da funda&ccedil;&atilde;o que leva seu nome, onde exerceu at&eacute; a sua morte, o cargo de Presidente Em&eacute;rita e Vital&iacute;cia.</span></p>\r\n<p class="olho02" style="margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;">\r\n	&nbsp;</p>\r\n<p class="olho02" style="margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;">\r\n	<span style="font-size: 1.2em; line-height: 1.5em;">Dorina de Gouv&ecirc;a Nowill faleceu em 29 de agosto de 2010, aos 91 anos de idade. Deixou ao Brasil e ao mundo uma institui&ccedil;&atilde;o reconhecida pela qualidade de seus livros acess&iacute;veis e servi&ccedil;os de reabilita&ccedil;&atilde;o. Deixou &agrave; pessoa com defici&ecirc;ncia visual a oportunidade de viver com dignidade e &agrave;s pessoas que enxergam uma li&ccedil;&atilde;o de vida.</span></p>\r\n<p class="olho02" style="margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;">\r\n	&nbsp;</p>\r\n<p class="olho02" style="margin: 0px 0px 1.8em; padding: 0px; font-size: 1.2em; line-height: 1.5em; color: rgb(136, 136, 136); font-family: arial, tahoma, verdana;">\r\n	<span style="font-size: 1.2em; line-height: 1.5em;">Perseveran&ccedil;a, caridade, resigna&ccedil;&atilde;o e paci&ecirc;ncia s&atilde;o as li&ccedil;&otilde;es deixadas por esta paulista que enxergava o mundo com os olhos da alma. Cega aos 17 anos, Dorina Nowill foi criadora da funda&ccedil;&atilde;o que leva seu nome, onde exerceu at&eacute; a sua morte, o cargo de Presidente Em&eacute;rita e Vital&iacute;cia.</span></p>\r\n', 'N', '', '', 'S', '20140608130501_dorina_destaque.jpg', 'Foto da sorridente dona dorina', 'Dorina era uma das pessoas mais sensÃ­veis que jÃ¡ conheci. Todos temos muito que aprender com o exemplo de vida desta mulher que superou a sua deficiÃªncia e que sempre trabalhou muito para a inclusÃ£o social dos deficientes. (Gustavo Rosa)'),
(14, '2014-08-22', 'S', '2014-08-10', '17:14:42', 'Dia da Bengala Branca', 'fdgh', 'dsfghj', '', '', '', '', '', 'N', '', '', 'N', '', '', ''),
(16, '2014-09-26', 'S', '2014-09-08', '16:04:38', 'Dia Nacional do Surdo', 'Dia Nacional do Surdo', 'Durante todo o mÃªs setembro sÃ£o realizados diversos eventos, tais como: festas dos alunos surdos, seminÃ¡rios, palestras, apresentaÃ§Ãµes teatrais, passeatas, audiÃªncias pÃºblicas, exposiÃ§Ãµes, caminhada, encontro dos Surdos etc. em todas as cidades do Brasil. A Comunidade Surda chama de "Setembro Azul", a data para a comemoraÃ§Ã£o do Dia do Surdo Ã© dia 26 de setembro, foi reconhecido e assinado pelo Ex-Presidente do Brasil Luis InÃ¡cio Lula da Silva com o nÃºmero de Lei NÂº 11.796 de 29 de outubro de 2008.', '', '', 'Revista ReaÃ§Ã£o', 'http://www.revistareacao.com.br/', '', 'N', '', '', 'S', '', '', ''),
(17, '2014-09-21', 'S', '2014-09-08', '16:19:53', 'Dia Nacional de Luta da Pessoa com DeficiÃªncia', 'Dia Nacional de Luta da Pessoa com DeficiÃªnc', 'O Dia Nacional de Luta das Pessoas Deficientes foi instituÃ­do pelo movimento social em Encontro Nacional, em 1982, com todas as entidades nacionais. Foi escolhido o dia 21 de setembro pela proximidade com a primavera e o dia da Ã¡rvore numa representaÃ§Ã£o do nascimento das reivindicaÃ§Ãµes de cidadania e participaÃ§Ã£o plena em igualdade de condiÃ§Ãµes. A data foi oficializada atravÃ©s da Lei Federal nÂº 11.133, de 14 de julho de 2005. ', '', '', '', 'http://www.drsandro.org/', '', 'N', '', '', 'N', '', '', ''),
(18, '2014-10-02', 'S', '2014-10-01', '07:31:18', 'Setembro Azul', 'Setembro Azul serÃ¡ comemorado com eventos es', 'As atividades da Semana Setembro Azul 2014 ocorerrÃ£o no MAM-SP, ItaÃº Cultural, Pinacoteca do Estado, Museu Afro Brasil e em diversas EMEBS da capital paulista.', '20140908162912_download.jpg', 'Logotipo do Dia Nacional do Surdo. Desenho de duas silhuetas de mÃ£os espalmadas azuis com uma fita azul formando um laÃ§o sobre elas. Frase: Dia Nacional do Surdo 26 de setembro.', 'Cultura Surda', 'culturasurda.net', '<p>\r\n	As atividades da Semana Setembro Azul 2014 ocorerr&atilde;o no MAM-SP, Ita&uacute; Cultural, Pinacoteca do Estado, Museu Afro Brasil e em diversas EMEBS da capital paulista.</p>\r\n', 'N', '', '', 'N', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_novidade_360_download`
--

DROP TABLE IF EXISTS `tb_novidade_360_download`;
CREATE TABLE IF NOT EXISTS `tb_novidade_360_download` (
  `novidade_360_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`novidade_360_id`,`download_id`),
  KEY `FK_tb_novidade_360_download_1` (`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(8, 1),
(7, 2),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_projeto`
--

INSERT INTO `tb_projeto` (`projeto_id`, `tipo_projeto_id`, `projeto_dt_cad`, `projeto_hr_cad`, `projeto_dt_ini`, `projeto_dt_fim`, `projeto_sob_demanda`, `projeto_titulo`, `projeto_resumo`, `projeto_thumb`, `projeto_thumb_desc`, `projeto_fonte`, `projeto_link_fonte`, `projeto_agenda`, `projeto_conteudo`) VALUES
(1, 1, '2014-06-08', '11:02:48', '0000-00-00', '0000-00-00', 'S', 'Desenvolvimento de Livro de Receitas Veganas AcessÃ­vel', 'Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos, desde pinturas bizantinas atÃ© movimentos mais recentes como os impressionistas, modernistas e contemporÃ¢neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a histÃ³ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como Ã© o caso de algumas tribos indÃ­genas brasileiras e americanas.', '20140608110248_livro_de_receitas_vegana.jpg', 'Museu de histÃ³ria natural: preservam a fauna e a flora. Em alguns Ã© possÃ­vel conhecer os animais prÃ©-histÃ³ricos, extintos hÃ¡ milhÃµes de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos artÃ­sticos, desde pinturas bizantinas atÃ© movimentos mais recentes como os impressionistas, modernistas e contemporÃ¢neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a histÃ³ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como Ã© o caso de algumas tribos indÃ­genas brasileiras e americanas.', 'Tudo Gostoso', 'http://www.tudogostoso.com.br/receita/66430-coxinha-vegan.html', '0000-00-00', '<p>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n<p>\r\n	Museu de hist&oacute;ria natural: preservam a fauna e a flora. Em alguns &eacute; poss&iacute;vel conhecer os animais pr&eacute;-hist&oacute;ricos, extintos h&aacute; milh&otilde;es de anos! Uma viagem fascinante!Museu de arte: podem conter obras de diversos movimentos art&iacute;sticos, desde pinturas bizantinas at&eacute; movimentos mais recentes como os impressionistas, modernistas e contempor&acirc;neos.Museu sobre etnias: existem diversos tipos de museus que contam e preservam a hist&oacute;ria e cultura de diversos povos. Muitas vezes, algumas etnias nem existem mais, como &eacute; o caso de algumas tribos ind&iacute;genas brasileiras e americanas.</p>\r\n'),
(2, 1, '2014-06-08', '11:11:39', '0000-00-00', '0000-00-00', 'N', 'SinalizaÃ§Ã£o Acessivel para a Copa', 'A primeira ediÃ§Ã£o ocorreu em 1930 no Uruguai, cuja seleÃ§Ã£o que abrigou o evento saiu vencedora. E o nome da taÃ§a faz referÃªncia a Jules Rimet. A primeira ediÃ§Ã£o ocorreu em 1930 no Uruguai, cuja seleÃ§Ã£o que abrigou o evento saiu vencedora. E o nome da taÃ§a faz referÃªncia a Jules Rimet.', '20140608111350_copa.jpg', 'A primeira ediÃ§Ã£o ocorreu em 1930 no Uruguai, cuja seleÃ§Ã£o que abrigou o evento saiu vencedora. E o nome da taÃ§a faz referÃªncia a Jules Rimet. A primeira ediÃ§Ã£o ocorreu em 1930 no Uruguai, cuja seleÃ§Ã£o que abrigou o evento saiu vencedora. E o nome da taÃ§a faz referÃªncia a Jules Rimet.', 'WikipÃ©dia', 'http://pt.wikipedia.org/wiki/Copa_do_Mundo_FIFA', '0000-00-00', '<p>\r\n	<span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">Copa do Mundo FIFA, tamb&eacute;m conhecida como Campeonato do Mundo de Futebol&nbsp;</span><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&eacute; uma&nbsp;</span><a class="mw-redirect" href="http://pt.wikipedia.org/wiki/Competi%C3%A7%C3%A3o_esportiva" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="CompetiÃ§Ã£o esportiva">competi&ccedil;&atilde;o</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;internacional de&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Futebol" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="Futebol">futebol</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;que ocorre a cada quatro anos. Essa competi&ccedil;&atilde;o, criada em 1928 na&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Fran%C3%A7a" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="FranÃ§a">Fran&ccedil;a</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">, sob a lideran&ccedil;a do presidente&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Jules_Rimet" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="Jules Rimet">Jules Rimet</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">, est&aacute; aberta a todas as&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Federa%C3%A7%C3%A3o" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="FederaÃ§Ã£o">federa&ccedil;&otilde;es</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;reconhecidas pela&nbsp;</span><a class="mw-redirect" href="http://pt.wikipedia.org/wiki/FIFA" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="FIFA">FIFA</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;(Federa&ccedil;&atilde;o Internacional de Futebol Associado, em&nbsp;</span><a href="http://pt.wikipedia.org/wiki/L%C3%ADngua_francesa" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="LÃ­ngua francesa">franc&ecirc;s</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">: federa&ccedil;&atilde;o internacional de Football Association). A primeira edi&ccedil;&atilde;o ocorreu em 1930 no&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Uruguai" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="Uruguai">Uruguai</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">, cuja sele&ccedil;&atilde;o que abrigou o evento saiu vencedora. E o nome da ta&ccedil;a faz refer&ecirc;ncia a Jules Rimet.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">Copa do Mundo FIFA, tamb&eacute;m conhecida como Campeonato do Mundo de Futebol&nbsp;</span><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&eacute; uma&nbsp;</span><a class="mw-redirect" href="http://pt.wikipedia.org/wiki/Competi%C3%A7%C3%A3o_esportiva" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="CompetiÃ§Ã£o esportiva">competi&ccedil;&atilde;o</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;internacional de&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Futebol" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="Futebol">futebol</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;que ocorre a cada quatro anos. Essa competi&ccedil;&atilde;o, criada em 1928 na&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Fran%C3%A7a" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="FranÃ§a">Fran&ccedil;a</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">, sob a lideran&ccedil;a do presidente&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Jules_Rimet" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="Jules Rimet">Jules Rimet</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">, est&aacute; aberta a todas as&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Federa%C3%A7%C3%A3o" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="FederaÃ§Ã£o">federa&ccedil;&otilde;es</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;reconhecidas pela&nbsp;</span><a class="mw-redirect" href="http://pt.wikipedia.org/wiki/FIFA" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="FIFA">FIFA</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;(Federa&ccedil;&atilde;o Internacional de Futebol Associado, em&nbsp;</span><a href="http://pt.wikipedia.org/wiki/L%C3%ADngua_francesa" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="LÃ­ngua francesa">franc&ecirc;s</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">: federa&ccedil;&atilde;o internacional de Football Association). A primeira edi&ccedil;&atilde;o ocorreu em 1930 no&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Uruguai" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="Uruguai">Uruguai</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">, cuja sele&ccedil;&atilde;o que abrigou o evento saiu vencedora. E o nome da ta&ccedil;a faz refer&ecirc;ncia a Jules Rimet.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">Copa do Mundo FIFA, tamb&eacute;m conhecida como Campeonato do Mundo de Futebol&nbsp;</span><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&eacute; uma&nbsp;</span><a class="mw-redirect" href="http://pt.wikipedia.org/wiki/Competi%C3%A7%C3%A3o_esportiva" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="CompetiÃ§Ã£o esportiva">competi&ccedil;&atilde;o</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;internacional de&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Futebol" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="Futebol">futebol</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;que ocorre a cada quatro anos. Essa competi&ccedil;&atilde;o, criada em 1928 na&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Fran%C3%A7a" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="FranÃ§a">Fran&ccedil;a</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">, sob a lideran&ccedil;a do presidente&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Jules_Rimet" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="Jules Rimet">Jules Rimet</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">, est&aacute; aberta a todas as&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Federa%C3%A7%C3%A3o" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="FederaÃ§Ã£o">federa&ccedil;&otilde;es</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;reconhecidas pela&nbsp;</span><a class="mw-redirect" href="http://pt.wikipedia.org/wiki/FIFA" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="FIFA">FIFA</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">&nbsp;(Federa&ccedil;&atilde;o Internacional de Futebol Associado, em&nbsp;</span><a href="http://pt.wikipedia.org/wiki/L%C3%ADngua_francesa" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="LÃ­ngua francesa">franc&ecirc;s</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">: federa&ccedil;&atilde;o internacional de Football Association). A primeira edi&ccedil;&atilde;o ocorreu em 1930 no&nbsp;</span><a href="http://pt.wikipedia.org/wiki/Uruguai" style="text-decoration: none; color: rgb(11, 0, 128); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px; background-image: none; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;" title="Uruguai">Uruguai</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">, cuja sele&ccedil;&atilde;o que abrigou o evento saiu vencedora. E o nome da ta&ccedil;a faz refer&ecirc;ncia a Jules Rimet.</span></p>\r\n');

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

INSERT INTO `tb_projeto_download` (`projeto_id`, `download_id`) VALUES
(2, 1),
(1, 2),
(1, 3);

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

INSERT INTO `tb_projeto_extra` (`projeto_id`, `extra_id`, `projeto_extra_valor`) VALUES
(1, 1, ''),
(1, 2, ''),
(1, 3, '100 REAIS'),
(2, 1, ''),
(2, 2, 'em licitaÃ§Ã£o'),
(2, 3, '');

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

INSERT INTO `tb_projeto_glossario` (`projeto_id`, `glossario_id`) VALUES
(1, 2),
(1, 3);

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_quemsomos`
--

DROP TABLE IF EXISTS `tb_quemsomos`;
CREATE TABLE IF NOT EXISTS `tb_quemsomos` (
  `quemsomos_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quemsomos_titulo` varchar(255) NOT NULL,
  `quemsomos_conteudo` text NOT NULL,
  `quemsomos_dt_cadastro` datetime NOT NULL,
  `quemsomos_exibir` enum('S','N') NOT NULL,
  PRIMARY KEY (`quemsomos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `tb_quemsomos`
--

INSERT INTO `tb_quemsomos` (`quemsomos_id`, `quemsomos_titulo`, `quemsomos_conteudo`, `quemsomos_dt_cadastro`, `quemsomos_exibir`) VALUES
(1, 'ConheÃ§a-nos', '<p>\r\n	A Museus Acess&iacute;veis &eacute; uma empresa social, que investe seu patrim&ocirc;nio e conquistas na melhoria da qualidade de vida das pessoas e na mudan&ccedil;a cultural do cen&aacute;rio da acessibilidade no Brasil. Nossa proposta &eacute; colaborar com a sociedade e com as institui&ccedil;&otilde;es ligadas a cultura, oferecendo orienta&ccedil;&atilde;o no desenvolvimento de produtos culturais acess&iacute;veis de qualidade e na forma&ccedil;&atilde;o de p&uacute;blico para suas a&ccedil;&otilde;es.</p>\r\n', '0000-00-00 00:00:00', 'S'),
(2, 'MissÃ£o', '<p>\r\n	Promover a amplia&ccedil;&atilde;o do acesso das pessoas com defici&ecirc;ncia ao patrim&ocirc;nio art&iacute;stico e cultural por meio do desenvolvimento de projetos e solu&ccedil;&otilde;es de acessibilidade, dissemina&ccedil;&atilde;o de conhecimentos e capacita&ccedil;&atilde;o para elimina&ccedil;&atilde;o de barreiras atitudinais.</p>\r\n', '2014-08-10 00:00:00', 'S'),
(3, 'VisÃ£o', '<p>\r\n	Promo&ccedil;&atilde;o do livre acesso a cultura para as pessoas com defici&ecirc;ncia.</p>\r\n', '2014-08-10 00:00:00', 'S'),
(4, 'Valores', '<p>\r\n	Acessibilidade para todos, Cultura de Livre Acesso, Qualidade, Aprimoramento T&eacute;cnico.</p>\r\n', '2014-08-10 00:00:00', 'S'),
(5, 'Acessibilidade 360Âº', '<p class="p1">\r\n	Promo&ccedil;&atilde;o de livre acesso para pessoas com defici&ecirc;ncia visual, f&iacute;sica, auditiva, intelectual e m&uacute;ltipla em todas as esferas sociais, culturais e humanas.</p>\r\n<p class="p1">\r\n	A Museus Acess&iacute;veis promove a transforma&ccedil;&atilde;o dos espa&ccedil;os e produtos culturais, a partir de diagn&oacute;sticos e servi&ccedil;os especializados em acessibilidade, eliminando barreiras arquitet&ocirc;nicas, comunicacionais, atitudinais e disseminando informa&ccedil;&atilde;o e conhecimento.</p>\r\n', '2014-08-10 00:00:00', 'S'),
(6, 'HistÃ³rico', '<p class="p1">\r\n	A Museus Acess&iacute;veis foi fundada por Viviane Sarraf, doutora em Comunica&ccedil;&atilde;o e Semi&oacute;tica pela PUC-SP, que dedicou sua vida acad&ecirc;mica e profissional ao desenvolvimento te&oacute;rico e pr&aacute;tico da acessibilidade cultural para pessoas com defici&ecirc;ncia. &nbsp;</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Ap&oacute;s sua gradua&ccedil;&atilde;o em Licenciatura em Educa&ccedil;&atilde;o Art&iacute;stica pela FAAP e especializa&ccedil;&atilde;o em Museologia pela USP, Viviane ingressa em seu mestrado em Ci&ecirc;ncia da Informa&ccedil;&atilde;o na Escola de Comunica&ccedil;&otilde;es e Artes da USP, sempre envolvida com institui&ccedil;&otilde;es e iniciativas de promo&ccedil;&atilde;o e defesa dos direitos das pessoas com defici&ecirc;ncia.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Empreendedora, engajada e preocupada com a crescente necessidade da melhoria no atendimento &agrave;s pessoas com defici&ecirc;ncia em museus e espa&ccedil;os culturais, em 2006 surge a Museus Acess&iacute;veis, empresa voltada ao desenvolvimento de solu&ccedil;&otilde;es culturais acess&iacute;veis.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Ainda neste ano, cheia de novas ideias, informa&ccedil;&otilde;es e forma&ccedil;&otilde;es sobre empreendedorismo social, Viviane Sarraf inscreveu a rec&eacute;m-inaugurada Museus Acess&iacute;veis em uma oportunidade in&eacute;dita no pa&iacute;s, um dos programas pioneiros de empreendedorismo social e sustent&aacute;vel mundial: a Expedi&ccedil;&atilde;o Artemisia da Artemisia Foundation.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Ap&oacute;s muitas etapas e sele&ccedil;&otilde;es com bancas formadas por grandes empreendedores, a Museus Acess&iacute;veis foi um dos 5 empreendimentos premiados com 2 anos de acompanhamento estrat&eacute;gico, jur&iacute;dico, financeiro, pessoal, apoio a equipe, desenvolvimento de perfil empreendedor e verba de start-up.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Assim, a Museus Acess&iacute;veis se consolida no mercado brasileiro e forma a RINAM &ndash; Rede de Informa&ccedil;&atilde;o de Acessibilidade em Museus &ndash; plataforma de dissemina&ccedil;&atilde;o da informa&ccedil;&atilde;o sobre acessibilidade cultural.&nbsp; [www.rinam.com.br]</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Ao longo de sua trajet&oacute;ria, a Museus Acess&iacute;veis contou com o importante trabalho de profissionais, consultores, trainees e estagi&aacute;rios brasileiros e estrangeiros que contribu&iacute;ram fundamentalmente com a afirma&ccedil;&atilde;o do car&aacute;ter social e com o cumprimento de sua miss&atilde;o.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Em sua estrutura atual a empresa conta com consultores com defici&ecirc;ncia para avalia&ccedil;&atilde;o e desenvolvimento de projetos e produtos culturais acess&iacute;veis, al&eacute;m de consultores t&eacute;cnicos especializados em arquitetura acess&iacute;vel, avalia&ccedil;&atilde;o de acessibilidade 360&ordm;, a&ccedil;&atilde;o educativa acess&iacute;vel, acessibilidade na web.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p>\r\n	A Museus Acess&iacute;veis conta com parcerias estrat&eacute;gicas de empresas e institui&ccedil;&otilde;es que desenvolvem produtos e servi&ccedil;os que apoiam suas a&ccedil;&otilde;es de acessibilidade, como: Funda&ccedil;&atilde;o Dorina Nowill para Cegos, Instituto Mara Gabrilli, Efeito Visual, Usina Maquetes, Voice Versa, Livre Acesso Braille, entre outros.</p>\r\n', '2014-08-10 00:00:00', 'S'),
(7, 'Principais Clientes', '<p class="p1">\r\n	MAM &ndash; Museu de Arte Moderna de S&atilde;o Paulo</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu da L&iacute;ngua Portuguesa</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Catavento Cultural</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	SESC &ndash; SP (unidades Itaquera, Campinas, Ipiranga, Taubat&eacute; e Centro de Pesquisa e Forma&ccedil;&atilde;o)</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Instituto Sangari</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de Zoologia da USP</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Funda&ccedil;&atilde;o Dorina Nowill para Cegos &ndash; Centro de Mem&oacute;ria Dorina Nowill</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	EMC Marketing Cultural</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Arte Impressa</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Instituto Ethos</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Instituto Mara Gabrilli</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu Nacional da Imigra&ccedil;&atilde;o e Coloniza&ccedil;&atilde;o de Joinvile &ndash; Funda&ccedil;&atilde;o Cultural de Joinvile</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de Hist&oacute;ria da Medicina de Porto Alegre</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Universidade Federal de Ouro Preto</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Universidade Federal do Rio Grande do Sul</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Universidade Federal do Rio de Janeiro</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Funda&ccedil;&atilde;o Bienal</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Centro Cultural S&atilde;o Paulo</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	The Hub SP</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de Artes e Of&iacute;cios de Belo Horizonte</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Funda&ccedil;&atilde;o Iber&ecirc; Camargo</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Funda&ccedil;&atilde;o Joaquim Nabuco</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	ECCO &ndash; Espa&ccedil;o Cultural Contempor&acirc;neo de Bras&iacute;lia</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Centro Cultural Banco do Brasil</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Natureza Produ&ccedil;&otilde;es Art&iacute;sticas</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Farearte</p>\r\n', '2014-08-10 00:00:00', 'S'),
(8, 'Algumas Conquistas', '<p class="p1">\r\n	Pr&ecirc;mio Rodrigo Melo Franco de Andrade 2013 | IPHAN, Men&ccedil;&atilde;o honrosa no pr&ecirc;mio Betinho Cidadania e Democracia 2013 | C&acirc;mara dos Vereadores de S&atilde;o Paulo, Pr&ecirc;mio Cultura e Sa&uacute;de, 2010 e 2008 | Minist&eacute;rio da Cultura, Men&ccedil;&atilde;o honrosa no pr&ecirc;mio Darcy Ribeiro 2008 | Minist&eacute;rio da Cultura &ndash;trabalhos desenvolvidos para o Centro de Mem&oacute;ria Dorina Nowill | Funda&ccedil;&atilde;o Dorina Nowill para Cegos.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Desenvolvimento de audiodescri&ccedil;&atilde;o em todas as exposi&ccedil;&otilde;es do MAM - SP desde 2009. Considerado um dos espa&ccedil;os culturais mais acess&iacute;veis de S&atilde;o Paulo no Guia de Acessibilidade Cultural de S&atilde;o Paulo.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Participa&ccedil;&atilde;o na concep&ccedil;&atilde;o e desenvolvimento do Curso de Fotografia &ldquo;Imagem e Percep&ccedil;&atilde;o&rdquo; do MAM SP, voltado para pessoas com defici&ecirc;ncia visual.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Desenvolvimento de recursos de media&ccedil;&atilde;o acess&iacute;veis e forma&ccedil;&atilde;o de p&uacute;blico de pessoas com defici&ecirc;ncia para a exposi&ccedil;&atilde;o ENERGIA &ndash; SESC Itaquera. Considerada a unidade mais acess&iacute;vel do SESC de S&atilde;o Paulo pelo Guia de Acessibilidade Cultural de S&atilde;o Paulo.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Desenvolvimento de recursos de media&ccedil;&atilde;o acess&iacute;veis e forma&ccedil;&atilde;o de p&uacute;blico de pessoas com defici&ecirc;ncia para a exposi&ccedil;&atilde;o &Aacute;GUA NA OCA &ndash; Parque do Ibirapuera - SP e Museu Hist&oacute;rico Nacional.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Consultoria, desenvolvimento de recursos de media&ccedil;&atilde;o acess&iacute;veis e forma&ccedil;&atilde;o de p&uacute;blico de pessoas com defici&ecirc;ncia visual para a exposi&ccedil;&atilde;o ROBERTO CARLOS &ndash; 50 Anos de M&uacute;sica: um dos maiores sucessos de p&uacute;blico de pessoas com defici&ecirc;ncia visual em exposi&ccedil;&otilde;es, viabilizado por meio da oferta de atendimento acess&iacute;vel, audioguia com audiodescri&ccedil;&atilde;o e maquete t&aacute;til e permiss&atilde;o para toque na cole&ccedil;&atilde;o de carros do cantor.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Servi&ccedil;o educativo acess&iacute;vel na 30&ordf; BIENAL DE ARTE DE S&Atilde;O PAULO por meio de treinamento de educadores para atendimento de pessoas com defici&ecirc;ncia e desenvolvimento de roteiros de visitas audiodescritos.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Inclus&atilde;o de programa&ccedil;&atilde;o sobre acessibilidade cultural no Festival de Inverno de Ouro Preto 2013, com palestra e oficina de acessibilidade cultural para alunos da Universidade Federal de Ouro Preto e profissionais de espa&ccedil;os culturais da cidade.</p>\r\n', '2014-08-10 00:00:00', 'S'),
(9, 'Sobre Viviane Sarraf', '<p class="p1">\r\n	Viviane Panelli Sarraf &eacute; doutora em Comunica&ccedil;&atilde;o e Semi&oacute;tica pela PUC-SP, mestre em Ci&ecirc;ncia da Informa&ccedil;&atilde;o pela Escola de Comunica&ccedil;&otilde;es e Artes da USP, especialista em Museologia pelo Museu de Arqueologia da USP e graduada em Licenciatura em Educa&ccedil;&atilde;o Art&iacute;stica pela FAAP.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Diretora t&eacute;cnica e fundadora da Museus Acess&iacute;veis, criadora e coordenadora da RINAM &ndash; Rede de Informa&ccedil;&atilde;o de Acessibilidade em Museus, Professora do Curso de Especializa&ccedil;&atilde;o em Acessibilidade Cultural da Universidade Federal do Rio de Janeiro e do Curso de P&oacute;s- Gradua&ccedil;&atilde;o Lato Sensu em Arte Contempor&acirc;nea e Doc&ecirc;ncia no Ensino Superior da Universidade Camilo Castelo Branco &ndash; UNICASTELO, Pesquisadora do Centro Interdisciplinar de Semi&oacute;tica da Cultura e da M&iacute;dia &ndash; CISC da PUC-SP e Assessora Ad Hoc da FAPESP.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	O come&ccedil;o de sua trajet&oacute;ria profissional ocorreu no ano de 1998, na XXIV Bienal de Artes de S&atilde;o Paulo onde integrou a equipe do projeto Diversidade, proposta pioneira de atendimento de pessoas com defici&ecirc;ncia em situa&ccedil;&atilde;o de vulnerabilidade social no universo da arte e da cultura.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Por meio dessa primeira oportunidade e de participa&ccedil;&otilde;es em outros projetos culturais e inclusivos come&ccedil;ou a desenvolver ideias e propostas de servi&ccedil;os e produtos para promo&ccedil;&atilde;o de acessibilidade cultural para pessoas com defici&ecirc;ncia e p&uacute;blicos n&atilde;o usuais de espa&ccedil;os culturais (crian&ccedil;as pequenas, idosos e visitantes de primeira viagem).</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Suas ideias foram bem recebidas em institui&ccedil;&otilde;es e projetos onde colaborou, como exposi&ccedil;&otilde;es tempor&aacute;rias, museus, espa&ccedil;os culturais, escolas e projetos.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Foi agraciada com o pr&ecirc;mio internacional de empreendedorismo sustent&aacute;vel da Artemisia Foundation pela cria&ccedil;&atilde;o da empresa social Museus Acess&iacute;veis em 2007, que ofereceu s&oacute;lida forma&ccedil;&atilde;o nas &aacute;reas de empreendedorismo sustent&aacute;vel e impacto social e assessorou durante mais de 3 anos o desenvolvimento da empresa.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	2010 ganhou o Pr&ecirc;mio Pesquisador do Centro Cultural S&atilde;o Paulo &ndash; Secretaria Municipal de Cultura pela pesquisa &ldquo;Acessibilidade em Espa&ccedil;os Culturais: experi&ecirc;ncias art&iacute;sticas e programa&ccedil;&otilde;es culturais inclusivas promovidas em S&atilde;o Paulo&rdquo; produzida para o Arquivo Multimeios da institui&ccedil;&atilde;o e dispon&iacute;vel para consulta de relat&oacute;rio e materiais coletados na institui&ccedil;&atilde;o.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Em 2012 recebeu o pr&ecirc;mio internacional &ldquo;CECA-ICOM Best Practice Award do Comit&ecirc; de Educa&ccedil;&atilde;o e A&ccedil;&atilde;o Cultural do Conselho Internacional de Museus - CECA ICOM, pelo trabalho de Educa&ccedil;&atilde;o e A&ccedil;&atilde;o Cultural que desenvolveu no Centro de Mem&oacute;ria Dorina Nowill. Nesse mesmo ano foi agraciada com a bolsa de viagem Young Support do ICOM International para participa&ccedil;&atilde;o na confer&ecirc;ncia e cerim&ocirc;nia de premia&ccedil;&atilde;o em Yerevan na Arm&ecirc;nia.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Foi respons&aacute;vel pela cria&ccedil;&atilde;o, curadoria, plano museol&oacute;gico, museografia, a&ccedil;&atilde;o cultural e educativa e programa de extens&atilde;o do Centro de Mem&oacute;ria Dorina Nowill da Funda&ccedil;&atilde;o Dorina Nowill para Cegos. Sob sua responsabilidade entre os anos de 2002 e 2013 o projeto recebeu men&ccedil;&atilde;o honrosa no Pr&ecirc;mio Darcy Ribeiro do Minc em 2008 e Pr&ecirc;mio Betinho Cidadania e Democracia da C&acirc;mara dos Vereadores de S&atilde;o Paulo em 2013; ganhou os pr&ecirc;mios Cultura e Sa&uacute;de do Minc - edi&ccedil;&otilde;es 2008 e 2010 e Pr&ecirc;mio Rodrigo Melo Franco de Andrade do IPHAN, na categoria Patrim&ocirc;nio Material em 2013. Em 2011 o projeto de moderniza&ccedil;&atilde;o do espa&ccedil;o cultural foi aprovado pela Lei Municipal de Incentivo a Cultura de S&atilde;o Paulo e pode executar as a&ccedil;&otilde;es de constru&ccedil;&atilde;o de novos espa&ccedil;os de preserva&ccedil;&atilde;o e exposi&ccedil;&atilde;o, atualiza&ccedil;&atilde;o dos processos de documenta&ccedil;&atilde;o e pesquisa on-line, elabora&ccedil;&atilde;o de nova exposi&ccedil;&atilde;o e materiais de divulga&ccedil;&atilde;o com patroc&iacute;nios da TV Globo e Linx.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Nesse per&iacute;odo o Centro de Mem&oacute;ria Dorina Nowill recebeu aproximadamente 12 mil visitantes e formou mais de 500 profissionais e estudantes por meio dos cursos de Acessibilidade Cultural e Audiodescri&ccedil;&atilde;o.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Em 2008, organizou em parceria com o MAM-SP e com a Funda&ccedil;&atilde;o Dorina Nowill para Cegos o Encontro Regional de Acessibilidade em Museus, primeiro evento nacional que apresentou o um panorama das a&ccedil;&otilde;es e do pensamento cr&iacute;tico na &aacute;rea de acessibilidade cultural. O publico do evento foi superior a 200 participantes de diferentes estados e cidades brasileiros.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Em sua trajet&oacute;ria profissional e acad&ecirc;mica proferiu palestras, oficinas e ministrou cursos em museus, espa&ccedil;os culturais e universidades de todo o pa&iacute;s, publicou artigos e cap&iacute;tulos de livros em revistas cient&iacute;ficas e livros das &aacute;reas de museologia, a&ccedil;&atilde;o educativa, acessibilidade, ci&ecirc;ncias sociais e comunica&ccedil;&atilde;o e publicou um livro com base em sua disserta&ccedil;&atilde;o de mestrado em l&iacute;ngua inglesa pela editora alem&atilde; VDM Verlag.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Link para curr&iacute;culo lattes:&nbsp; <a href="http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=K4229502E0">http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=K4229502E0</a></p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Tese de doutorado dispon&iacute;vel na Biblioteca Virtual Sapientia da PUC-SP</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Disserta&ccedil;&atilde;o de Mestrado dispon&iacute;vel na Biblioteca Digital de Teses da USP</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Na p&aacute;gina <a href="http://www.rinam.com.br/referencias.php#pb">http://www.rinam.com.br/referencias.php#pb</a> da RINAM &eacute; poss&iacute;vel consultar e baixar os principais trabalhos cient&iacute;ficos e artigos de Viviane Sarraf.</p>\r\n', '2014-08-10 00:00:00', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_release`
--

DROP TABLE IF EXISTS `tb_release`;
CREATE TABLE IF NOT EXISTS `tb_release` (
  `release_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `release_dt_agenda` date NOT NULL,
  `release_exibir_listagem` enum('S','N') NOT NULL,
  `release_dt` date NOT NULL,
  `release_hr` time NOT NULL,
  `release_titulo` varchar(255) NOT NULL,
  `release_titulo_sintese` varchar(45) DEFAULT NULL,
  `release_resumo` text NOT NULL,
  `release_thumb` varchar(255) NOT NULL,
  `release_thumb_desc` varchar(255) NOT NULL,
  `release_fonte` varchar(255) NOT NULL,
  `release_url_fonte` varchar(255) NOT NULL,
  `release_conteudo` longtext NOT NULL,
  `release_exibir_banner` enum('S','N') NOT NULL,
  `release_banner` varchar(255) NOT NULL,
  `release_banner_desc` text NOT NULL,
  `release_exibir_destaque_home` enum('S','N') NOT NULL,
  `release_destaque_home` varchar(255) NOT NULL,
  `release_destaque_home_desc` text NOT NULL,
  `release_destaque_home_frase` text NOT NULL,
  PRIMARY KEY (`release_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_release_download`
--

DROP TABLE IF EXISTS `tb_release_download`;
CREATE TABLE IF NOT EXISTS `tb_release_download` (
  `release_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`release_id`,`download_id`),
  KEY `FK_release_download_1` (`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_release_tag`
--

DROP TABLE IF EXISTS `tb_release_tag`;
CREATE TABLE IF NOT EXISTS `tb_release_tag` (
  `release_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`release_id`,`tag_id`),
  KEY `fk_tb_release_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_release_has_tb_tag_tb_release_idx` (`release_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `tb_servico`
--

INSERT INTO `tb_servico` (`servico_id`, `tipo_servico_id`, `servico_dt_cad`, `servico_hr_cad`, `servico_dt_ini`, `servico_dt_fim`, `servico_sob_demanda`, `servico_titulo`, `servico_resumo`, `servico_thumb`, `servico_thumb_desc`, `servico_fonte`, `servico_link_fonte`, `servico_agenda`, `servico_conteudo`) VALUES
(1, 3, '2014-04-15', '10:27:09', '0000-00-00', '0000-00-00', 'S', 'Expografia AcessÃ­vel ', 'A Museus AcessÃ­veis oferece o serviÃ§o de desenvolvimento de projetos de exposiÃ§Ã£o (eliminaÃ§Ã£o de barreiras fÃ­sicas, comunicaÃ§Ã£o visual, tÃ¡til e sonora, desenvolvimento, produÃ§Ã£o e instalaÃ§Ã£o de mobiliÃ¡rio, montagem de displays , obras e objetos, sinalizaÃ§Ã£o acessÃ­vel, iluminaÃ§Ã£o e planejamento de circulaÃ§Ã£o) com acessibilidade para pessoas com deficiÃªncia fÃ­sica, mobilidade reduzida  e deficiÃªncia visual respeitando a NBR 9050 e as normas internacionais de design de espaÃ§o cultural acessÃ­vel.', '20140608112428_expografia_acesscÂ­vel.jpg', 'A Museus AcessÃ­veis oferece o serviÃ§o de desenvolvimento de projetos de exposiÃ§Ã£o (eliminaÃ§Ã£o de barreiras fÃ­sicas, comunicaÃ§Ã£o visual, tÃ¡til e sonora, desenvolvimento, produÃ§Ã£o e instalaÃ§Ã£o de mobiliÃ¡rio, montagem de displays , obras e objetos, sinalizaÃ§Ã£o acessÃ­vel, iluminaÃ§Ã£o e planejamento de circulaÃ§Ã£o) com acessibilidade para pessoas com deficiÃªncia fÃ­sica, mobilidade reduzida  e deficiÃªncia visual respeitando a NBR 9050 e as normas internacionais de design de espaÃ§o cultural acessÃ­vel.', 'Google', 'https://www.google.com.br/search?q=EXPOGRAFIA&espv=2&source=lnms&tbm=isch&sa=X&ei=1HGUU4uDPKfNsATy7oGgCQ&ved=0CAcQ_AUoAg&biw=1403&bih=726&dpr=0.9#facrc=_&imgdii=SnY6XGijexhikM%3A%3BoDCUxogiAtu_DM%3BSnY6XGijexhikM%3A&imgrc=SnY6XGijexhikM%253A%3BQ_dlbJqO5jd', '0000-00-00', '<p>\r\n	A Museus Acess&iacute;veis oferece o servi&ccedil;o de desenvolvimento de projetos de exposi&ccedil;&atilde;o (elimina&ccedil;&atilde;o de barreiras f&iacute;sicas, comunica&ccedil;&atilde;o visual, t&aacute;til e sonora, desenvolvimento, produ&ccedil;&atilde;o e instala&ccedil;&atilde;o de mobili&aacute;rio, montagem de displays , obras e objetos, sinaliza&ccedil;&atilde;o acess&iacute;vel, ilumina&ccedil;&atilde;o e planejamento de circula&ccedil;&atilde;o) com acessibilidade para pessoas com defici&ecirc;ncia f&iacute;sica, mobilidade reduzida &nbsp;e defici&ecirc;ncia visual respeitando a NBR 9050 e as normas internacionais de design de espa&ccedil;o cultural acess&iacute;vel.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	A Museus Acess&iacute;veis oferece o servi&ccedil;o de desenvolvimento de projetos de exposi&ccedil;&atilde;o (elimina&ccedil;&atilde;o de barreiras f&iacute;sicas, comunica&ccedil;&atilde;o visual, t&aacute;til e sonora, desenvolvimento, produ&ccedil;&atilde;o e instala&ccedil;&atilde;o de mobili&aacute;rio, montagem de displays , obras e objetos, sinaliza&ccedil;&atilde;o acess&iacute;vel, ilumina&ccedil;&atilde;o e planejamento de circula&ccedil;&atilde;o) com acessibilidade para pessoas com defici&ecirc;ncia f&iacute;sica, mobilidade reduzida &nbsp;e defici&ecirc;ncia visual respeitando a NBR 9050 e as normas internacionais de design de espa&ccedil;o cultural acess&iacute;vel.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	A Museus Acess&iacute;veis oferece o servi&ccedil;o de desenvolvimento de projetos de exposi&ccedil;&atilde;o (elimina&ccedil;&atilde;o de barreiras f&iacute;sicas, comunica&ccedil;&atilde;o visual, t&aacute;til e sonora, desenvolvimento, produ&ccedil;&atilde;o e instala&ccedil;&atilde;o de mobili&aacute;rio, montagem de displays , obras e objetos, sinaliza&ccedil;&atilde;o acess&iacute;vel, ilumina&ccedil;&atilde;o e planejamento de circula&ccedil;&atilde;o) com acessibilidade para pessoas com defici&ecirc;ncia f&iacute;sica, mobilidade reduzida &nbsp;e defici&ecirc;ncia visual respeitando a NBR 9050 e as normas internacionais de design de espa&ccedil;o cultural acess&iacute;vel.</p>\r\n'),
(2, 3, '2014-06-06', '14:42:18', '0000-00-00', '0000-00-00', 'N', 'AdequaÃ§Ãµes fÃ­sicas de ambientes a norma 5090', 'Trata-se do cumprimento da lei acerca da adaptaÃ§Ã£o de ambientes coletivos Ã s normas de acessiblidade. A Museus AcessÃ­veis conta com arquitetos e profissionais especializados em acessibilidade para o desenvolvimento de projeto, sinalizaÃ§Ã£o e comunicaÃ§Ã£o visual, tÃ¡til e sonora para espaÃ§os fÃ­sicos jÃ¡ construÃ­dos, tombados ou em projeto cumprindo a NBR 9050, o Decreto 5296 e seguindo premissas das normas internacionais de acessibilidade fÃ­sica.', '20140905144108_memorial_dorina_nowill_0036.jpg', 'Trata-se do cumprimento da lei acerca da adaptaÃ§Ã£o de ambientes coletivos Ã s normas de acessiblidade. A Museus AcessÃ­veis conta com arquitetos e profissionais especializados em acessibilidade para o desenvolvimento de projeto, sinalizaÃ§Ã£o e comunicaÃ§Ã£o visual, tÃ¡til e sonora para espaÃ§os fÃ­sicos jÃ¡ construÃ­dos, tombados ou em projeto cumprindo a NBR 9050, o Decreto 5296 e seguindo premissas das normas internacionais de acessibilidade fÃ­sica.', '', '', '0000-00-00', '<p class="p1">\r\n	A Muses Acess&iacute;veis conta com arquitetos e profissionais especializados em acessibilidade para o desenvolvimento de projeto, sinaliza&ccedil;&atilde;o e comunica&ccedil;&atilde;o visual, t&aacute;til e sonora para espa&ccedil;os f&iacute;sicos j&aacute; constru&iacute;dos, tombados ou em projeto cumprindo a NBR 9050, o Decreto 5296 e seguindo premissas das normas internacionais de acessibilidade f&iacute;sica.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	A Muses Acess&iacute;veis conta com arquitetos e profissionais especializados em acessibilidade para o desenvolvimento de projeto, sinaliza&ccedil;&atilde;o e comunica&ccedil;&atilde;o visual, t&aacute;til e sonora para espa&ccedil;os f&iacute;sicos j&aacute; constru&iacute;dos, tombados ou em projeto cumprindo a NBR 9050, o Decreto 5296 e seguindo premissas das normas internacionais de acessibilidade f&iacute;sica.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	A Muses Acess&iacute;veis conta com arquitetos e profissionais especializados em acessibilidade para o desenvolvimento de projeto, sinaliza&ccedil;&atilde;o e comunica&ccedil;&atilde;o visual, t&aacute;til e sonora para espa&ccedil;os f&iacute;sicos j&aacute; constru&iacute;dos, tombados ou em projeto cumprindo a NBR 9050, o Decreto 5296 e seguindo premissas das normas internacionais de acessibilidade f&iacute;sica.</p>\r\n'),
(5, 4, '2014-06-12', '10:59:44', '0000-00-00', '0000-00-00', 'S', 'Desenvolvimento de materiais de mediaÃ§Ã£o sensoriais', 'â€¢ Maquetes tÃ¡teis de construÃ§Ãµes e espaÃ§os fÃ­sicos \r\nâ€¢ RÃ©plicas tÃ¡teis de esculturas e objetos histÃ³ricos\r\nâ€¢ Desenhos, documentos e mapas tÃ¡teis\r\nâ€¢ Paisagens sonoras para ambientaÃ§Ã£o de espaÃ§os, audiolivros, audioguias e publicaÃ§Ãµes em Ã¡udio\r\nâ€¢ Assinatura olfativa para ambientaÃ§Ã£o de espaÃ§os de exposiÃ§Ã£o, obras de arte e instalaÃ§Ãµes multimÃ­dia\r\nâ€¢ CriaÃ§Ã£o de cardÃ¡pios de alimentaÃ§Ã£o temÃ¡ticos (seguindo propostas de curadoria de exposiÃ§Ãµes a acervos de museus)\r\nâ€¢ Material de apoio para visitas educativas, mediaÃ§Ã£o  e atividades culturais multissensorial', '20140612115320_libras.jpg', 'â€¢ Maquetes tÃ¡teis de construÃ§Ãµes e espaÃ§os fÃ­sicos \\r\\nâ€¢ RÃ©plicas tÃ¡teis de esculturas e objetos histÃ³ricos\\r\\nâ€¢ Desenhos, documentos e mapas tÃ¡teis\\r\\nâ€¢ Paisagens sonoras para ambientaÃ§Ã£o de espaÃ§os, audiolivros, audioguias e publicaÃ§Ãµes em Ã¡udio\\r\\nâ€¢ Assinatura olfativa para ambientaÃ§Ã£o de espaÃ§os de exposiÃ§Ã£o, obras de arte e instalaÃ§Ãµes multimÃ­dia\\r\\nâ€¢ CriaÃ§Ã£o de cardÃ¡pios de alimentaÃ§Ã£o temÃ¡ticos (seguindo propostas de curadoria de exposiÃ§Ãµes a acervos de museus)\\r\\nâ€¢ Material de apoio para visitas educativas, mediaÃ§Ã£o  e atividades culturais multissensorial', '', '', '0000-00-00', '<div>\r\n	&bull;<span class="Apple-tab-span" style="white-space:pre"> </span>Maquetes t&aacute;teis de constru&ccedil;&otilde;es e espa&ccedil;os f&iacute;sicos&nbsp;</div>\r\n<div>\r\n	&bull;<span class="Apple-tab-span" style="white-space:pre"> </span>R&eacute;plicas t&aacute;teis de esculturas e objetos hist&oacute;ricos</div>\r\n<div>\r\n	&bull;<span class="Apple-tab-span" style="white-space:pre"> </span>Desenhos, documentos e mapas t&aacute;teis</div>\r\n<div>\r\n	&bull;<span class="Apple-tab-span" style="white-space:pre"> </span>Paisagens sonoras para ambienta&ccedil;&atilde;o de espa&ccedil;os, audiolivros, audioguias e publica&ccedil;&otilde;es em &aacute;udio</div>\r\n<div>\r\n	&bull;<span class="Apple-tab-span" style="white-space:pre"> </span>Assinatura olfativa para ambienta&ccedil;&atilde;o de espa&ccedil;os de exposi&ccedil;&atilde;o, obras de arte e instala&ccedil;&otilde;es multim&iacute;dia</div>\r\n<div>\r\n	&bull;<span class="Apple-tab-span" style="white-space:pre"> </span>Cria&ccedil;&atilde;o de card&aacute;pios de alimenta&ccedil;&atilde;o tem&aacute;ticos (seguindo propostas de curadoria de exposi&ccedil;&otilde;es a acervos de museus)</div>\r\n<div>\r\n	&bull;<span class="Apple-tab-span" style="white-space:pre"> </span>Material de apoio para visitas educativas, media&ccedil;&atilde;o &nbsp;e atividades culturais multissensorial</div>\r\n<div>\r\n	&nbsp;</div>\r\n'),
(7, 3, '2014-06-12', '11:29:31', '0000-00-00', '0000-00-00', 'N', 'Audioguias', 'Guias auditivos para visitaÃ§Ã£o autÃ´noma em museus, espaÃ§os culturais, exposiÃ§Ãµes, parques, aquÃ¡rios, feiras e eventos para pessoas com deficiÃªncia visual (com audiodescriÃ§Ã£o) e para pÃºblico geral (com opÃ§Ã£o de adequaÃ§Ã£o de linguagem para crianÃ§as,  jovens e adultos).', '20140612112931_libras.jpg', 'Guias auditivos para visitaÃ§Ã£o autÃ´noma em museus, espaÃ§os culturais, exposiÃ§Ãµes, parques, aquÃ¡rios, feiras e eventos para pessoas com deficiÃªncia visual (com audiodescriÃ§Ã£o) e para pÃºblico geral (com opÃ§Ã£o de adequaÃ§Ã£o de linguagem para crianÃ§as,  jovens e adultos).', '', '', '0000-00-00', ''),
(9, 2, '2014-06-12', '11:31:43', '0000-00-00', '0000-00-00', 'N', 'Videoguias em Libras', 'Guias visuais em LÃ­ngua Brasileira de Sinais para visitaÃ§Ã£o autÃ´noma em museus, espaÃ§os culturais, exposiÃ§Ãµes, parques, aquÃ¡rios, feiras e eventos para surdos e pessoas com deficiÃªncia auditiva.', '20140612115738_libras.jpg', 'Guias visuais em LÃ­ngua Brasileira de Sinais para visitaÃ§Ã£o autÃ´noma em museus, espaÃ§os culturais, exposiÃ§Ãµes, parques, aquÃ¡rios, feiras e eventos para surdos e pessoas com deficiÃªncia auditiva.', '', '', '0000-00-00', ''),
(10, 2, '2014-06-12', '11:32:26', '0000-00-00', '0000-00-00', 'N', 'AudiodescriÃ§Ã£o', 'Desenvolvimento de roteiro para descriÃ§Ã£o de imagens para produÃ§Ãµes audiovisuais (curtas, longas, documentÃ¡rios, programas de TV, vÃ­deos educativos),  materiais didÃ¡ticos e educativos e publicaÃ§Ãµes (livros, catÃ¡logos e revistas com ilustraÃ§Ãµes).', '20140905143630_vsitanteaudioguiatoque.jpg', 'Desenvolvimento de roteiro para descriÃ§Ã£o de imagens para produÃ§Ãµes audiovisuais (curtas, longas, documentÃ¡rios, programas de TV, vÃ­deos educativos),  materiais didÃ¡ticos e educativos e publicaÃ§Ãµes (livros, catÃ¡logos e revistas com ilustraÃ§Ãµes).', '', '', '0000-00-00', ''),
(12, 2, '2014-06-12', '11:33:06', '0000-00-00', '0000-00-00', 'N', 'Desenvolvimento e adequaÃ§Ã£o de websites acessÃ­veis', 'Com adequaÃ§Ã£o para norma W3C e usabilidade de pessoas com deficiÃªncia visual e fÃ­sica.', '20140612113306_libras.jpg', 'Com adequaÃ§Ã£o para norma W3C e usabilidade de pessoas com deficiÃªncia visual e fÃ­sica.', '', '', '0000-00-00', ''),
(14, 4, '2014-06-12', '11:44:14', '0000-00-00', '0000-00-00', 'N', 'Desenvolvimento e criaÃ§Ã£o de publicaÃ§Ãµes e materiais informativos para pessoas com deficiÃªncia visual e auditiva', 'Folhetos, livros, catÃ¡logos e materiais de informaÃ§Ã£o virtual em braille, formato auditivo, Libras e com legenda Closed Caption.\r\n', '20140612114414_libras.jpg', 'Folhetos, livros, catÃ¡logos e materiais de informaÃ§Ã£o virtual em braille, formato auditivo, Libras e com legenda Closed Caption.\\r\\n', '', '', '0000-00-00', '');

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

INSERT INTO `tb_servico_download` (`servico_id`, `download_id`) VALUES
(1, 2),
(2, 2);

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

INSERT INTO `tb_servico_extra` (`servico_id`, `extra_id`, `servico_extra_valor`) VALUES
(1, 1, ''),
(1, 2, ''),
(2, 1, ''),
(2, 2, 'teste'),
(2, 3, ''),
(2, 4, ''),
(5, 1, ''),
(5, 2, ''),
(7, 1, ''),
(7, 2, ''),
(9, 1, ''),
(9, 2, ''),
(10, 1, ''),
(10, 2, ''),
(10, 3, ''),
(10, 4, ''),
(12, 1, ''),
(12, 2, ''),
(14, 1, ''),
(14, 2, '');

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

INSERT INTO `tb_servico_glossario` (`servico_id`, `glossario_id`) VALUES
(2, 1),
(2, 3),
(10, 4),
(1, 6),
(1, 7),
(2, 7),
(1, 8);

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

INSERT INTO `tb_servico_tag` (`tag_id`, `servico_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(1, 2),
(3, 2),
(7, 2),
(1, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_serv_proj_cur_info`
--

DROP TABLE IF EXISTS `tb_serv_proj_cur_info`;
CREATE TABLE IF NOT EXISTS `tb_serv_proj_cur_info` (
  `serv_proj_cur_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `servico_descr` text COLLATE latin1_general_ci,
  `projeto_descr` text COLLATE latin1_general_ci,
  `curso_descr` text COLLATE latin1_general_ci,
  PRIMARY KEY (`serv_proj_cur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_serv_proj_cur_info`
--

INSERT INTO `tb_serv_proj_cur_info` (`serv_proj_cur_id`, `servico_descr`, `projeto_descr`, `curso_descr`) VALUES
(1, 'ACESSIBILIDADE EM TODOS OS SENTIDOS\r\n\r\nO trabalho de consultoria em acessibilidade cultural desenvolvido pela Museus AcessÃ­veis engloba diagnÃ³stico e avaliaÃ§Ã£o 360Âº, ou seja, aborda toda a esfera da acessibilidade: incluindo serviÃ§os de adequaÃ§Ãµes de espaÃ§os, comunicaÃ§Ã£o, acesso a informaÃ§Ã£o e treinamento de colaboradores para transformar os ambientes, produtos e serviÃ§os culturais acessÃ­veis Ã s pessoas com deficiÃªncia visual, auditiva, fÃ­sica, intelectual, mÃºltipla, pessoas com mobilidade reduzida, idosos e crianÃ§as.\r\n', 'Projetos culturais acessÃ­veis desenvolvidos pela empresa para captaÃ§Ã£o de recursos.\r\nProjetos de clientes na Ã¡rea de acessibilidade cultural apoiados pela Museus AcessÃ­veis.\r\nApoio a redaÃ§Ã£o e qualificaÃ§Ã£o de projetos culturais com garantia de acessibilidade 360Âº\r\n', 'Cursos, palestras e workshops para equipes de espaÃ§os culturais e museus, guias de turismo, espaÃ§os de lazer e entretenimento, agÃªncias de comunicaÃ§Ã£o e empresas com os temas: \r\n\r\n- Relacionamento e atendimento de pessoas com deficiÃªncia - eliminaÃ§Ã£o de barreiras atitudinais, \r\n- AÃ§Ã£o educativa acessÃ­vel e visitas inclusivas,\r\n- AudiodescriÃ§Ã£o,\r\n- Acessibilidade cultural para pessoas com deficiÃªncia.\r\n\r\n\r\n');

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
(1, '2014-07-27', '16:32:01', '<p class="p1">\r\n	<a name="quemsomos"><strong>Quem somos</strong></a></p>\r\n<p class="p1">\r\n	A Museus Acess&iacute;veis &eacute; uma empresa social, que investe seu patrim&ocirc;nio e conquistas na melhoria da qualidade de vida das pessoas e na mudan&ccedil;a cultural do cen&aacute;rio da acessibilidade no Brasil. Nossa proposta &eacute; colaborar com a sociedade e com as institui&ccedil;&otilde;es ligadas a cultura, oferecendo orienta&ccedil;&atilde;o no desenvolvimento de produtos culturais acess&iacute;veis de qualidade e na forma&ccedil;&atilde;o de p&uacute;blico para suas a&ccedil;&otilde;es.<br />\r\n	<a href="#quemsomos">topo</a></p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	<strong>Miss&atilde;o</strong></p>\r\n<p class="p1">\r\n	Promover a amplia&ccedil;&atilde;o do acesso das pessoas com defici&ecirc;ncia ao patrim&ocirc;nio art&iacute;stico e cultural por meio do desenvolvimento de projetos e solu&ccedil;&otilde;es de acessibilidade, dissemina&ccedil;&atilde;o de conhecimentos e capacita&ccedil;&atilde;o para elimina&ccedil;&atilde;o de barreiras atitudinais.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	<strong>Vis&atilde;o</strong></p>\r\n<p class="p1">\r\n	Promo&ccedil;&atilde;o do livre acesso a cultura para as pessoas com defici&ecirc;ncia.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	<strong>Valores</strong></p>\r\n<p class="p1">\r\n	Acessibilidade para todos, Cultura de Livre Acesso, Qualidade, Aprimoramento T&eacute;cnico.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	<strong>Acessibilidade 360&ordm;</strong></p>\r\n<p class="p1">\r\n	Promo&ccedil;&atilde;o de livre acesso para pessoas com defici&ecirc;ncia visual, f&iacute;sica, auditiva, intelectual e m&uacute;ltipla em todas as esferas sociais, culturais e humanas.</p>\r\n<p class="p1">\r\n	A Museus Acess&iacute;veis promove a transforma&ccedil;&atilde;o dos espa&ccedil;os e produtos culturais, a partir de diagn&oacute;sticos e servi&ccedil;os especializados em acessibilidade, eliminando barreiras arquitet&ocirc;nicas, comunicacionais, atitudinais e disseminando informa&ccedil;&atilde;o e conhecimento.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	<a name="historico"><strong>Hist&oacute;rico</strong></a></p>\r\n<p class="p1">\r\n	A Museus Acess&iacute;veis foi fundada por Viviane Sarraf, doutora em Comunica&ccedil;&atilde;o e Semi&oacute;tica pela PUC-SP, que dedicou sua vida acad&ecirc;mica e profissional ao desenvolvimento te&oacute;rico e pr&aacute;tico da acessibilidade cultural para pessoas com defici&ecirc;ncia. &nbsp;</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Ap&oacute;s sua gradua&ccedil;&atilde;o em Licenciatura em Educa&ccedil;&atilde;o Art&iacute;stica pela FAAP e especializa&ccedil;&atilde;o em Museologia pela USP, Viviane ingressa em seu mestrado em Ci&ecirc;ncia da Informa&ccedil;&atilde;o na Escola de Comunica&ccedil;&otilde;es e Artes da USP, sempre envolvida com institui&ccedil;&otilde;es e iniciativas de promo&ccedil;&atilde;o e defesa dos direitos das pessoas com defici&ecirc;ncia.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Empreendedora, engajada e preocupada com a crescente necessidade da melhoria no atendimento &agrave;s pessoas com defici&ecirc;ncia em museus e espa&ccedil;os culturais, em 2006 surge a Museus Acess&iacute;veis, empresa voltada ao desenvolvimento de solu&ccedil;&otilde;es culturais acess&iacute;veis.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Ainda neste ano, cheia de novas ideias, informa&ccedil;&otilde;es e forma&ccedil;&otilde;es sobre empreendedorismo social, Viviane Sarraf inscreveu a rec&eacute;m-inaugurada Museus Acess&iacute;veis em uma oportunidade in&eacute;dita no pa&iacute;s, um dos programas pioneiros de empreendedorismo social e sustent&aacute;vel mundial: a Expedi&ccedil;&atilde;o Artemisia da Artemisia Foundation.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Ap&oacute;s muitas etapas e sele&ccedil;&otilde;es com bancas formadas por grandes empreendedores, a Museus Acess&iacute;veis foi um dos 5 empreendimentos premiados com 2 anos de acompanhamento estrat&eacute;gico, jur&iacute;dico, financeiro, pessoal, apoio a equipe, desenvolvimento de perfil empreendedor e verba de start-up.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Assim, a Museus Acess&iacute;veis se consolida no mercado brasileiro e forma a RINAM &ndash; Rede de Informa&ccedil;&atilde;o de Acessibilidade em Museus &ndash; plataforma de dissemina&ccedil;&atilde;o da informa&ccedil;&atilde;o sobre acessibilidade cultural.&nbsp; [www.rinam.com.br]</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Ao longo de sua trajet&oacute;ria, a Museus Acess&iacute;veis contou com o importante trabalho de profissionais, consultores, trainees e estagi&aacute;rios brasileiros e estrangeiros que contribu&iacute;ram fundamentalmente com a afirma&ccedil;&atilde;o do car&aacute;ter social e com o cumprimento de sua miss&atilde;o.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Em sua estrutura atual a empresa conta com consultores com defici&ecirc;ncia para avalia&ccedil;&atilde;o e desenvolvimento de projetos e produtos culturais acess&iacute;veis, al&eacute;m de consultores t&eacute;cnicos especializados em arquitetura acess&iacute;vel, avalia&ccedil;&atilde;o de acessibilidade 360&ordm;, a&ccedil;&atilde;o educativa acess&iacute;vel, acessibilidade na web.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	A Museus Acess&iacute;veis conta com parcerias estrat&eacute;gicas de empresas e institui&ccedil;&otilde;es que desenvolvem produtos e servi&ccedil;os que apoiam suas a&ccedil;&otilde;es de acessibilidade, como: Funda&ccedil;&atilde;o Dorina Nowill para Cegos, Instituto Mara Gabrilli, Efeito Visual, Usina Maquetes, Voice Versa, Livre Acesso Braille, entre outros.<br />\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	<strong>Principais clientes</strong></p>\r\n<p class="p1">\r\n	MAM &ndash; Museu de Arte Moderna de S&atilde;o Paulo</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu da L&iacute;ngua Portuguesa</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Catavento Cultural</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	SESC &ndash; SP (unidades Itaquera, Campinas, Ipiranga, Taubat&eacute; e Centro de Pesquisa e Forma&ccedil;&atilde;o)</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Instituto Sangari</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de Zoologia da USP</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Funda&ccedil;&atilde;o Dorina Nowill para Cegos &ndash; Centro de Mem&oacute;ria Dorina Nowill</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	EMC Marketing Cultural</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Arte Impressa</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Instituto Ethos</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Instituto Mara Gabrilli</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu Nacional da Imigra&ccedil;&atilde;o e Coloniza&ccedil;&atilde;o de Joinvile &ndash; Funda&ccedil;&atilde;o Cultural de Joinvile</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de Hist&oacute;ria da Medicina de Porto Alegre</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Universidade Federal de Ouro Preto</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Universidade Federal do Rio Grande do Sul</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Universidade Federal do Rio de Janeiro</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Funda&ccedil;&atilde;o Bienal</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Centro Cultural S&atilde;o Paulo</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	The Hub SP</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Museu de Artes e Of&iacute;cios de Belo Horizonte</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Funda&ccedil;&atilde;o Iber&ecirc; Camargo</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Funda&ccedil;&atilde;o Joaquim Nabuco</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	ECCO &ndash; Espa&ccedil;o Cultural Contempor&acirc;neo de Bras&iacute;lia</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Centro Cultural Banco do Brasil</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Natureza Produ&ccedil;&otilde;es Art&iacute;sticas</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Farearte</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	<strong>Algumas conquistas</strong></p>\r\n<p class="p1">\r\n	Pr&ecirc;mio Rodrigo Melo Franco de Andrade 2013 | IPHAN, Men&ccedil;&atilde;o honrosa no pr&ecirc;mio Betinho Cidadania e Democracia 2013 | C&acirc;mara dos Vereadores de S&atilde;o Paulo, Pr&ecirc;mio Cultura e Sa&uacute;de, 2010 e 2008 | Minist&eacute;rio da Cultura, Men&ccedil;&atilde;o honrosa no pr&ecirc;mio Darcy Ribeiro 2008 | Minist&eacute;rio da Cultura &ndash;trabalhos desenvolvidos para o Centro de Mem&oacute;ria Dorina Nowill | Funda&ccedil;&atilde;o Dorina Nowill para Cegos.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Desenvolvimento de audiodescri&ccedil;&atilde;o em todas as exposi&ccedil;&otilde;es do MAM - SP desde 2009. Considerado um dos espa&ccedil;os culturais mais acess&iacute;veis de S&atilde;o Paulo no Guia de Acessibilidade Cultural de S&atilde;o Paulo.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Participa&ccedil;&atilde;o na concep&ccedil;&atilde;o e desenvolvimento do Curso de Fotografia &ldquo;Imagem e Percep&ccedil;&atilde;o&rdquo; do MAM SP, voltado para pessoas com defici&ecirc;ncia visual.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Desenvolvimento de recursos de media&ccedil;&atilde;o acess&iacute;veis e forma&ccedil;&atilde;o de p&uacute;blico de pessoas com defici&ecirc;ncia para a exposi&ccedil;&atilde;o ENERGIA &ndash; SESC Itaquera. Considerada a unidade mais acess&iacute;vel do SESC de S&atilde;o Paulo pelo Guia de Acessibilidade Cultural de S&atilde;o Paulo.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Desenvolvimento de recursos de media&ccedil;&atilde;o acess&iacute;veis e forma&ccedil;&atilde;o de p&uacute;blico de pessoas com defici&ecirc;ncia para a exposi&ccedil;&atilde;o &Aacute;GUA NA OCA &ndash; Parque do Ibirapuera - SP e Museu Hist&oacute;rico Nacional.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Consultoria, desenvolvimento de recursos de media&ccedil;&atilde;o acess&iacute;veis e forma&ccedil;&atilde;o de p&uacute;blico de pessoas com defici&ecirc;ncia visual para a exposi&ccedil;&atilde;o ROBERTO CARLOS &ndash; 50 Anos de M&uacute;sica: um dos maiores sucessos de p&uacute;blico de pessoas com defici&ecirc;ncia visual em exposi&ccedil;&otilde;es, viabilizado por meio da oferta de atendimento acess&iacute;vel, audioguia com audiodescri&ccedil;&atilde;o e maquete t&aacute;til e permiss&atilde;o para toque na cole&ccedil;&atilde;o de carros do cantor.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Servi&ccedil;o educativo acess&iacute;vel na 30&ordf; BIENAL DE ARTE DE S&Atilde;O PAULO por meio de treinamento de educadores para atendimento de pessoas com defici&ecirc;ncia e desenvolvimento de roteiros de visitas audiodescritos.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Inclus&atilde;o de programa&ccedil;&atilde;o sobre acessibilidade cultural no Festival de Inverno de Ouro Preto 2013, com palestra e oficina de acessibilidade cultural para alunos da Universidade Federal de Ouro Preto e profissionais de espa&ccedil;os culturais da cidade.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	<strong>Sobre Viviane Sarraf</strong></p>\r\n<p class="p1">\r\n	Viviane Panelli Sarraf &eacute; doutora em Comunica&ccedil;&atilde;o e Semi&oacute;tica pela PUC-SP, mestre em Ci&ecirc;ncia da Informa&ccedil;&atilde;o pela Escola de Comunica&ccedil;&otilde;es e Artes da USP, especialista em Museologia pelo Museu de Arqueologia da USP e graduada em Licenciatura em Educa&ccedil;&atilde;o Art&iacute;stica pela FAAP.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Diretora t&eacute;cnica e fundadora da Museus Acess&iacute;veis, criadora e coordenadora da RINAM &ndash; Rede de Informa&ccedil;&atilde;o de Acessibilidade em Museus, Professora do Curso de Especializa&ccedil;&atilde;o em Acessibilidade Cultural da Universidade Federal do Rio de Janeiro e do Curso de P&oacute;s- Gradua&ccedil;&atilde;o Lato Sensu em Arte Contempor&acirc;nea e Doc&ecirc;ncia no Ensino Superior da Universidade Camilo Castelo Branco &ndash; UNICASTELO, Pesquisadora do Centro Interdisciplinar de Semi&oacute;tica da Cultura e da M&iacute;dia &ndash; CISC da PUC-SP e Assessora Ad Hoc da FAPESP.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	O come&ccedil;o de sua trajet&oacute;ria profissional ocorreu no ano de 1998, na XXIV Bienal de Artes de S&atilde;o Paulo onde integrou a equipe do projeto Diversidade, proposta pioneira de atendimento de pessoas com defici&ecirc;ncia em situa&ccedil;&atilde;o de vulnerabilidade social no universo da arte e da cultura.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Por meio dessa primeira oportunidade e de participa&ccedil;&otilde;es em outros projetos culturais e inclusivos come&ccedil;ou a desenvolver ideias e propostas de servi&ccedil;os e produtos para promo&ccedil;&atilde;o de acessibilidade cultural para pessoas com defici&ecirc;ncia e p&uacute;blicos n&atilde;o usuais de espa&ccedil;os culturais (crian&ccedil;as pequenas, idosos e visitantes de primeira viagem).</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Suas ideias foram bem recebidas em institui&ccedil;&otilde;es e projetos onde colaborou, como exposi&ccedil;&otilde;es tempor&aacute;rias, museus, espa&ccedil;os culturais, escolas e projetos.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Foi agraciada com o pr&ecirc;mio internacional de empreendedorismo sustent&aacute;vel da Artemisia Foundation pela cria&ccedil;&atilde;o da empresa social Museus Acess&iacute;veis em 2007, que ofereceu s&oacute;lida forma&ccedil;&atilde;o nas &aacute;reas de empreendedorismo sustent&aacute;vel e impacto social e assessorou durante mais de 3 anos o desenvolvimento da empresa.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	2010 ganhou o Pr&ecirc;mio Pesquisador do Centro Cultural S&atilde;o Paulo &ndash; Secretaria Municipal de Cultura pela pesquisa &ldquo;Acessibilidade em Espa&ccedil;os Culturais: experi&ecirc;ncias art&iacute;sticas e programa&ccedil;&otilde;es culturais inclusivas promovidas em S&atilde;o Paulo&rdquo; produzida para o Arquivo Multimeios da institui&ccedil;&atilde;o e dispon&iacute;vel para consulta de relat&oacute;rio e materiais coletados na institui&ccedil;&atilde;o.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Em 2012 recebeu o pr&ecirc;mio internacional &ldquo;CECA-ICOM Best Practice Award do Comit&ecirc; de Educa&ccedil;&atilde;o e A&ccedil;&atilde;o Cultural do Conselho Internacional de Museus - CECA ICOM, pelo trabalho de Educa&ccedil;&atilde;o e A&ccedil;&atilde;o Cultural que desenvolveu no Centro de Mem&oacute;ria Dorina Nowill. Nesse mesmo ano foi agraciada com a bolsa de viagem Young Support do ICOM International para participa&ccedil;&atilde;o na confer&ecirc;ncia e cerim&ocirc;nia de premia&ccedil;&atilde;o em Yerevan na Arm&ecirc;nia.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Foi respons&aacute;vel pela cria&ccedil;&atilde;o, curadoria, plano museol&oacute;gico, museografia, a&ccedil;&atilde;o cultural e educativa e programa de extens&atilde;o do Centro de Mem&oacute;ria Dorina Nowill da Funda&ccedil;&atilde;o Dorina Nowill para Cegos. Sob sua responsabilidade entre os anos de 2002 e 2013 o projeto recebeu men&ccedil;&atilde;o honrosa no Pr&ecirc;mio Darcy Ribeiro do Minc em 2008 e Pr&ecirc;mio Betinho Cidadania e Democracia da C&acirc;mara dos Vereadores de S&atilde;o Paulo em 2013; ganhou os pr&ecirc;mios Cultura e Sa&uacute;de do Minc - edi&ccedil;&otilde;es 2008 e 2010 e Pr&ecirc;mio Rodrigo Melo Franco de Andrade do IPHAN, na categoria Patrim&ocirc;nio Material em 2013. Em 2011 o projeto de moderniza&ccedil;&atilde;o do espa&ccedil;o cultural foi aprovado pela Lei Municipal de Incentivo a Cultura de S&atilde;o Paulo e pode executar as a&ccedil;&otilde;es de constru&ccedil;&atilde;o de novos espa&ccedil;os de preserva&ccedil;&atilde;o e exposi&ccedil;&atilde;o, atualiza&ccedil;&atilde;o dos processos de documenta&ccedil;&atilde;o e pesquisa on-line, elabora&ccedil;&atilde;o de nova exposi&ccedil;&atilde;o e materiais de divulga&ccedil;&atilde;o com patroc&iacute;nios da TV Globo e Linx.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Nesse per&iacute;odo o Centro de Mem&oacute;ria Dorina Nowill recebeu aproximadamente 12 mil visitantes e formou mais de 500 profissionais e estudantes por meio dos cursos de Acessibilidade Cultural e Audiodescri&ccedil;&atilde;o.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Em 2008, organizou em parceria com o MAM-SP e com a Funda&ccedil;&atilde;o Dorina Nowill para Cegos o Encontro Regional de Acessibilidade em Museus, primeiro evento nacional que apresentou o um panorama das a&ccedil;&otilde;es e do pensamento cr&iacute;tico na &aacute;rea de acessibilidade cultural. O publico do evento foi superior a 200 participantes de diferentes estados e cidades brasileiros.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Em sua trajet&oacute;ria profissional e acad&ecirc;mica proferiu palestras, oficinas e ministrou cursos em museus, espa&ccedil;os culturais e universidades de todo o pa&iacute;s, publicou artigos e cap&iacute;tulos de livros em revistas cient&iacute;ficas e livros das &aacute;reas de museologia, a&ccedil;&atilde;o educativa, acessibilidade, ci&ecirc;ncias sociais e comunica&ccedil;&atilde;o e publicou um livro com base em sua disserta&ccedil;&atilde;o de mestrado em l&iacute;ngua inglesa pela editora alem&atilde; VDM Verlag.</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Link para curr&iacute;culo lattes:&nbsp; <a href="http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=K4229502E0">http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=K4229502E0</a></p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Tese de doutorado dispon&iacute;vel na Biblioteca Virtual Sapientia da PUC-SP</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Disserta&ccedil;&atilde;o de Mestrado dispon&iacute;vel na Biblioteca Digital de Teses da USP</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	Na p&aacute;gina <a href="http://www.rinam.com.br/referencias.php#pb">http://www.rinam.com.br/referencias.php#pb</a> da RINAM &eacute; poss&iacute;vel consultar e baixar os principais trabalhos cient&iacute;ficos e artigos de Viviane Sarraf.</p>\r\n<p class="p2">\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n'),
(2, '2014-06-18', '06:46:40', '<p class="p1">\r\n	Seguem algumas dicas para facilitar a navega&ccedil;&atilde;o:</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	TAB (navega entre os links)</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	CTRL+1 (barra de acessibilidade)</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	CTRL+2 (menu)</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	CTRL+3 (conte&uacute;do)</p>\r\n<p class="p1">\r\n	&nbsp;</p>\r\n<p class="p1">\r\n	CTRL+4 (contatos).</p>\r\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_curso`
--

DROP TABLE IF EXISTS `tb_tipo_curso`;
CREATE TABLE IF NOT EXISTS `tb_tipo_curso` (
  `tipo_curso_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_curso_titulo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`tipo_curso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tb_tipo_curso`
--

INSERT INTO `tb_tipo_curso` (`tipo_curso_id`, `tipo_curso_titulo`) VALUES
(1, 'IntroduÃ§Ã£o ao ConteÃºdo'),
(2, 'Cursos Modulares'),
(3, 'Oficinas PrÃ¡ticas'),
(4, 'VivÃªncias'),
(5, 'Atitudinal'),
(6, 'Comunicacional'),
(7, 'FÃ­sico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_projeto`
--

DROP TABLE IF EXISTS `tb_tipo_projeto`;
CREATE TABLE IF NOT EXISTS `tb_tipo_projeto` (
  `tipo_projeto_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_projeto_titulo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`tipo_projeto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_tipo_projeto`
--

INSERT INTO `tb_tipo_projeto` (`tipo_projeto_id`, `tipo_projeto_titulo`) VALUES
(1, 'Projetos abertos para captaÃ§Ã£o'),
(2, 'PortifÃ³lio de projetos realizados'),
(3, 'Projetos em andamento'),
(4, 'Novo tipo de projeto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_servico`
--

DROP TABLE IF EXISTS `tb_tipo_servico`;
CREATE TABLE IF NOT EXISTS `tb_tipo_servico` (
  `tipo_servico_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_servico_titulo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`tipo_servico_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `tb_tipo_servico`
--

INSERT INTO `tb_tipo_servico` (`tipo_servico_id`, `tipo_servico_titulo`) VALUES
(1, 'Atitude'),
(2, 'ComunicaÃ§Ã£o'),
(3, 'FÃ­sico'),
(4, 'InformaÃ§Ã£o'),
(5, 'teste'),
(6, 'novo tipo de serviÃ§o');

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
-- Restrições para a tabela `tb_clipping_download`
--
ALTER TABLE `tb_clipping_download`
  ADD CONSTRAINT `FK_tb_clipping_download_1` FOREIGN KEY (`clipping_id`) REFERENCES `tb_clipping` (`clipping_id`),
  ADD CONSTRAINT `FK_tb_clipping_download_2` FOREIGN KEY (`clipping_id`) REFERENCES `tb_download` (`download_id`);

--
-- Restrições para a tabela `tb_clipping_tag`
--
ALTER TABLE `tb_clipping_tag`
  ADD CONSTRAINT `fk_tb_clipping_has_tb_tag_tb_clipping` FOREIGN KEY (`clipping_id`) REFERENCES `tb_clipping` (`clipping_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_clipping_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tb_glossario_has_tb_curso_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_glossario_has_tb_curso_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_curso_tag`
--
ALTER TABLE `tb_curso_tag`
  ADD CONSTRAINT `fk_tb_tag_has_tb_curso_tb_curso1` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_tag_has_tb_curso_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_download`
--
ALTER TABLE `tb_download`
  ADD CONSTRAINT `FK_tb_download_cat` FOREIGN KEY (`download_categoria_id`) REFERENCES `tb_download_categoria` (`download_categoria_id`);

--
-- Restrições para a tabela `tb_emailmkt_conferencia`
--
ALTER TABLE `tb_emailmkt_conferencia`
  ADD CONSTRAINT `fk_emailmkt_conferencia_01` FOREIGN KEY (`emailmkt_id`) REFERENCES `tb_emailmkt` (`emailmkt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emailmkt_conferencia_02` FOREIGN KEY (`mailing_id`) REFERENCES `tb_mailing` (`mailing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tb_tag_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_tag_has_tb_glossario_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_imprensa`
--
ALTER TABLE `tb_imprensa`
  ADD CONSTRAINT `FK_tb_imprensa_1` FOREIGN KEY (`novidade_360_id`) REFERENCES `tb_novidade_360` (`novidade_360_id`);

--
-- Restrições para a tabela `tb_novidade_360_download`
--
ALTER TABLE `tb_novidade_360_download`
  ADD CONSTRAINT `FK_tb_novidade_360_download_1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`),
  ADD CONSTRAINT `FK_tb_novidade_360_download_2` FOREIGN KEY (`novidade_360_id`) REFERENCES `tb_novidade_360` (`novidade_360_id`);

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
  ADD CONSTRAINT `fk_tb_projeto_has_tb_download_tb_download1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_projeto_has_tb_download_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_projeto_extra`
--
ALTER TABLE `tb_projeto_extra`
  ADD CONSTRAINT `fk_tb_projeto_has_tb_extra_tb_extra1` FOREIGN KEY (`extra_id`) REFERENCES `tb_extra` (`extra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_projeto_has_tb_extra_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_projeto_glossario`
--
ALTER TABLE `tb_projeto_glossario`
  ADD CONSTRAINT `fk_tb_projeto_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_projeto_has_tb_glossario_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_projeto_tag`
--
ALTER TABLE `tb_projeto_tag`
  ADD CONSTRAINT `fk_tb_projeto_has_tb_tag_tb_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_projeto_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_release_download`
--
ALTER TABLE `tb_release_download`
  ADD CONSTRAINT `FK_tb_release_download_1` FOREIGN KEY (`release_id`) REFERENCES `tb_release` (`release_id`),
  ADD CONSTRAINT `FK_tb_release_download_2` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`);

--
-- Restrições para a tabela `tb_release_tag`
--
ALTER TABLE `tb_release_tag`
  ADD CONSTRAINT `fk_tb_relase_has_tb_tag_tb_release` FOREIGN KEY (`release_id`) REFERENCES `tb_release` (`release_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_release_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_servico_download`
--
ALTER TABLE `tb_servico_download`
  ADD CONSTRAINT `fk_tb_servico_has_tb_download_tb_download1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_servico_has_tb_download_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_servico_extra`
--
ALTER TABLE `tb_servico_extra`
  ADD CONSTRAINT `fk_tb_servico_has_tb_extra_tb_extra1` FOREIGN KEY (`extra_id`) REFERENCES `tb_extra` (`extra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_servico_has_tb_extra_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_servico_glossario`
--
ALTER TABLE `tb_servico_glossario`
  ADD CONSTRAINT `fk_tb_servico_has_tb_glossario_tb_glossario1` FOREIGN KEY (`glossario_id`) REFERENCES `tb_glossario` (`glossario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_servico_has_tb_glossario_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `tb_servico_tag`
--
ALTER TABLE `tb_servico_tag`
  ADD CONSTRAINT `fk_tb_tag_has_tb_servico_tb_servico1` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_tag_has_tb_servico_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

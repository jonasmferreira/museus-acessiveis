DROP TABLE IF EXISTS `tb_emkt_noticia`;
CREATE TABLE  `tb_emkt_noticia` (
  `emkt_noticia_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `emkt_noticia_dt` date NOT NULL,
  `emkt_noticia_hr` time NOT NULL,
  `emkt_noticia_titulo` varchar(255) NOT NULL,
  `emkt_noticia_titulo_sintese` varchar(45) DEFAULT NULL,
  `emkt_noticia_resumo` text NOT NULL,
  `emkt_noticia_thumb` varchar(255) NOT NULL,
  `emkt_noticia_thumb_desc` varchar(255) NOT NULL,
  `emkt_noticia_fonte` varchar(255) NOT NULL,
  `emkt_noticia_url_fonte` varchar(255) NOT NULL,
  `emkt_noticia_conteudo` longtext NOT NULL,
  PRIMARY KEY (`emkt_noticia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
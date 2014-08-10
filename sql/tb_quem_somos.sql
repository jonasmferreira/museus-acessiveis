DROP TABLE IF EXISTS `tb_quemsomos`;
CREATE TABLE  `tb_quemsomos` (
  `quemsomos_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quemsomos_titulo` varchar(255) NOT NULL,
  `quemsomos_conteudo` text NOT NULL,
  `quemsomos_dt_cadastro` datetime NOT NULL,
  `quemsomos_exibir` enum('S','N') NOT NULL,
  PRIMARY KEY (`quemsomos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

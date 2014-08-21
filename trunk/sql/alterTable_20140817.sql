ALTER TABLE `tb_novidade_360`
  ADD COLUMN `novidade_360_exibir_listagem` ENUM('S','N') NOT NULL AFTER `novidade_360_dt_agenda`;

UPDATE tb_novidade_360
	SET novidade_360_exibir_listagem = 'S';


ALTER TABLE `tb_anunciante` DROP COLUMN `anunciante_dt_agenda`;

ALTER TABLE `tb_tipo_curso` ENGINE = InnoDB;
ALTER TABLE `tb_tipo_servico` ENGINE = InnoDB;

DROP TABLE IF EXISTS `tb_download_categoria`;
CREATE TABLE  `tb_download_categoria` (
  `download_categoria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `download_categoria_titulo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`download_categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO tb_download_categoria
	SET download_categoria_titulo = 1;

ALTER TABLE `tb_download` 
	ADD COLUMN `download_categoria_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT 1 AFTER `download_tipo_desc`,
	ADD CONSTRAINT `FK_tb_download_cat` FOREIGN KEY `FK_tb_download_cat` (`download_categoria_id`)
		REFERENCES `tb_download_categoria` (`download_categoria_id`)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
	, ROW_FORMAT = DYNAMIC;

DROP TABLE IF EXISTS `tb_depoimento`;
CREATE TABLE  `tb_depoimento` (
  `depoimento_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `depoimento_dt` date NOT NULL,
  `depoimento_conteudo` text NOT NULL,
  `depoimento_autor` varchar(255) NOT NULL,
  `depoimento_empresa` varchar(255) NOT NULL,
  PRIMARY KEY (`depoimento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tb_novidade_360_download`;
CREATE TABLE  `tb_novidade_360_download` (
  `novidade_360_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`novidade_360_id`,`download_id`),
  KEY `FK_tb_novidade_360_download_1` (`download_id`),
  CONSTRAINT `FK_tb_novidade_360_download_1` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`),
  CONSTRAINT `FK_tb_novidade_360_download_2` FOREIGN KEY (`novidade_360_id`) REFERENCES `tb_novidade_360` (`novidade_360_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



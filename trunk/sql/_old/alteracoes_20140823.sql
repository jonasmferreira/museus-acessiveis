ALTER TABLE `tb_imprensa` RENAME TO `tb_imprensa_OLD`;

DROP TABLE IF EXISTS `tb_imprensa`;
CREATE TABLE `tb_imprensa` (
  `imprensa_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `imprensa_assessoria_nome` VARCHAR(255) NOT NULL,
  `imprensa_assessoria_telefone` VARCHAR(255) NOT NULL,
  `imprensa_assessoria_email` VARCHAR(255) NOT NULL,
  `novidade_360_id` BIGINT(20) UNSIGNED NOT NULL,
  `imprensa_nossos_numeros` TEXT NOT NULL,
  PRIMARY KEY (`imprensa_id`),
  CONSTRAINT `FK_tb_imprensa_1` FOREIGN KEY `FK_tb_imprensa_1` (`novidade_360_id`)
    REFERENCES `tb_novidade_360` (`novidade_360_id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
)
ENGINE = InnoDB;


DROP TABLE IF EXISTS `tb_release`;
CREATE TABLE  `tb_release` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tb_clipping`;
CREATE TABLE  `tb_clipping` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tb_release_download`;
CREATE TABLE  `tb_release_download` (
  `release_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`release_id`,`download_id`),
  KEY `FK_release_download_1` (`download_id`),
  CONSTRAINT `FK_tb_release_download_1` FOREIGN KEY (`release_id`) REFERENCES `tb_release` (`release_id`),
  CONSTRAINT `FK_tb_release_download_2` FOREIGN KEY (`download_id`) REFERENCES `tb_download` (`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tb_clipping_download`;
CREATE TABLE  `tb_clipping_download` (
  `clipping_id` bigint(19) unsigned NOT NULL,
  `download_id` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`clipping_id`,`download_id`),
  KEY `FK_clipping_download_1` (`download_id`),
  CONSTRAINT `FK_tb_clipping_download_1` FOREIGN KEY (`clipping_id`) REFERENCES `tb_clipping` (`clipping_id`),
  CONSTRAINT `FK_tb_clipping_download_2` FOREIGN KEY (`clipping_id`) REFERENCES `tb_download` (`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tb_release_tag`;
CREATE TABLE  `tb_release_tag` (
  `release_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`release_id`,`tag_id`),
  KEY `fk_tb_release_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_release_has_tb_tag_tb_release_idx` (`release_id`),
  CONSTRAINT `fk_tb_relase_has_tb_tag_tb_release` FOREIGN KEY (`release_id`) REFERENCES `tb_release` (`release_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_release_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `tb_clipping_tag`;
CREATE TABLE  `tb_clipping_tag` (
  `clipping_id` bigint(19) unsigned NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`clipping_id`,`tag_id`),
  KEY `fk_tb_clipping_has_tb_tag_tb_tag1_idx` (`tag_id`),
  KEY `fk_tb_clipping_has_tb_tag_tb_clipping_idx` (`clipping_id`),
  CONSTRAINT `fk_tb_clipping_has_tb_tag_tb_clipping` FOREIGN KEY (`clipping_id`) REFERENCES `tb_clipping` (`clipping_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_clipping_has_tb_tag_tb_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tb_tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;








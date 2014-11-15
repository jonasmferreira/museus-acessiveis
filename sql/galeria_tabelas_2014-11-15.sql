ALTER TABLE `tb_novidade_360_galeria` CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS `tb_clipping_galeria`;
CREATE TABLE  `tb_clipping_galeria` (
  `clipping_galeria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `clipping_id` bigint(19) unsigned NOT NULL,
  `galeria_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`clipping_galeria_id`),
  KEY `FK_tb_clipping_galeria_1` (`galeria_id`),
  KEY `FK_tb_clipping_galeria_2` (`clipping_id`),
  CONSTRAINT `FK_tb_clipping_galeria_1` FOREIGN KEY (`galeria_id`) REFERENCES `tb_galeria` (`galeria_id`),
  CONSTRAINT `FK_tb_clipping_galeria_2` FOREIGN KEY (`clipping_id`) REFERENCES `tb_clipping` (`clipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tb_release_galeria`;
CREATE TABLE  `tb_release_galeria` (
  `release_galeria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `release_id` bigint(19) unsigned NOT NULL,
  `galeria_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`release_galeria_id`),
  KEY `FK_tb_release_galeria_1` (`galeria_id`),
  KEY `FK_tb_release_galeria_2` (`release_id`),
  CONSTRAINT `FK_tb_release_galeria_1` FOREIGN KEY (`galeria_id`) REFERENCES `tb_galeria` (`galeria_id`),
  CONSTRAINT `FK_tb_release_galeria_2` FOREIGN KEY (`release_id`) REFERENCES `tb_release` (`release_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tb_projeto_galeria`;
CREATE TABLE  `tb_projeto_galeria` (
  `projeto_galeria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `projeto_id` bigint(19) unsigned NOT NULL,
  `galeria_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`projeto_galeria_id`),
  KEY `FK_tb_projeto_galeria_1` (`galeria_id`),
  KEY `FK_tb_projeto_galeria_2` (`projeto_id`),
  CONSTRAINT `FK_tb_projeto_galeria_1` FOREIGN KEY (`galeria_id`) REFERENCES `tb_galeria` (`galeria_id`),
  CONSTRAINT `FK_tb_projeto_galeria_2` FOREIGN KEY (`projeto_id`) REFERENCES `tb_projeto` (`projeto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tb_curso_galeria`;
CREATE TABLE  `tb_curso_galeria` (
  `curso_galeria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `curso_id` bigint(19) unsigned NOT NULL,
  `galeria_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`curso_galeria_id`),
  KEY `FK_tb_curso_galeria_1` (`galeria_id`),
  KEY `FK_tb_curso_galeria_2` (`curso_id`),
  CONSTRAINT `FK_tb_curso_galeria_1` FOREIGN KEY (`galeria_id`) REFERENCES `tb_galeria` (`galeria_id`),
  CONSTRAINT `FK_tb_curso_galeria_2` FOREIGN KEY (`curso_id`) REFERENCES `tb_curso` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `tb_servico_galeria`;
CREATE TABLE  `tb_servico_galeria` (
  `servico_galeria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `servico_id` bigint(19) unsigned NOT NULL,
  `galeria_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`servico_galeria_id`),
  KEY `FK_tb_servico_galeria_1` (`galeria_id`),
  KEY `FK_tb_servico_galeria_2` (`servico_id`),
  CONSTRAINT `FK_tb_servico_galeria_1` FOREIGN KEY (`galeria_id`) REFERENCES `tb_galeria` (`galeria_id`),
  CONSTRAINT `FK_tb_servico_galeria_2` FOREIGN KEY (`servico_id`) REFERENCES `tb_servico` (`servico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `tb_novidade_360_galeria` (
  `novidade_galeria_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `novidade_360_id` BIGINT(19) UNSIGNED NOT NULL,
  `galeria_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`novidade_galeria_id`),
  CONSTRAINT `FK_tb_novidade_360_galeria_1` FOREIGN KEY `FK_tb_novidade_360_galeria_1` (`galeria_id`)
    REFERENCES `tb_galeria` (`galeria_id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `FK_tb_novidade_360_galeria_2` FOREIGN KEY `FK_tb_novidade_360_galeria_2` (`novidade_360_id`)
    REFERENCES `tb_novidade_360` (`novidade_360_id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
)
ENGINE = InnoDB;

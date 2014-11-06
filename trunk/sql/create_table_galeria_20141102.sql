DROP TABLE IF EXISTS `tb_galeria_imagem`;
DROP TABLE IF EXISTS `tb_galeria`;

CREATE TABLE IF NOT EXISTS `tb_galeria` (
  `galeria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `galeria_titulo` varchar(255) NOT NULL,
  `galeria_descricao` text NOT NULL,
  `galeria_resumo` text NOT NULL,
  PRIMARY KEY (`galeria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tb_galeria_imagem` (
  `galeria_imagem_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `galeria_id` BIGINT UNSIGNED NOT NULL,
  `galeria_imagem_arq` TEXT NOT NULL,
  `galeria_imagem_titulo` VARCHAR(255) DEFAULT NULL,
  `galeria_imagem_descricao` TEXT DEFAULT NULL,
  PRIMARY KEY (`galeria_imagem_id`),
  INDEX `fk_galeria_imagem_01_idx` (`galeria_id` ASC),
  CONSTRAINT `fk_galeria_imagem_01`
    FOREIGN KEY (`galeria_id`)
    REFERENCES `museus_acessiveis`.`tb_galeria` (`galeria_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


DROP TABLE IF EXISTS `tb_tipo_projeto`;
CREATE TABLE  `tb_tipo_projeto` (
  `tipo_projeto_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_projeto_titulo` VARCHAR(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`tipo_projeto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `tb_tipo_projeto` (`tipo_projeto_id`,`tipo_projeto_titulo`) VALUES 
 (1,'Projetos abertos para captação'),
 (2,'Portifólio de projetos realizados'),
 (3,'Projetos em andamento');

ALTER TABLE `tb_projeto` 
ADD COLUMN `tipo_projeto_id` BIGINT(20) UNSIGNED DEFAULT NULL AFTER `projeto_id`;

UPDATE tb_projeto
SET tipo_projeto_id = 1
WHERE projeto_tipo = 'A';

UPDATE tb_projeto
SET tipo_projeto_id = 2
WHERE projeto_tipo = 'R';

UPDATE tb_projeto
SET tipo_projeto_id = 3
WHERE projeto_tipo = 'EA';

ALTER TABLE `tb_projeto` 
DROP COLUMN `projeto_tipo_id`;

ALTER TABLE `tb_projeto` 
DROP COLUMN `projeto_tipo`;






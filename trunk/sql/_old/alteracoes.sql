CREATE TABLE `tb_tipo_servico` (
`tipo_servico_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
`tipo_servico_titulo` VARCHAR(255) NOT NULL ,
PRIMARY KEY (`tipo_servico_id`) );

CREATE TABLE `tb_tipo_curso` (
`tipo_curso_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
`tipo_curso_titulo` VARCHAR(255) NOT NULL ,
PRIMARY KEY (`tipo_curso_id`) );


INSERT INTO `tb_tipo_curso` (`tipo_curso_id`, `tipo_curso_titulo`) VALUES ('1', 'Geral');
INSERT INTO `tb_tipo_servico` (`tipo_servico_id`, `tipo_servico_titulo`) VALUES ('1', 'Geral');

ALTER TABLE `tb_curso` ADD COLUMN `tipo_curso_id` BIGINT UNSIGNED NOT NULL AFTER `curso_id` ;
ALTER TABLE `tb_servico` ADD COLUMN `tipo_servico_id` BIGINT UNSIGNED NOT NULL AFTER `servico_id` ;

UPDATE `tb_curso` SET tipo_curso_id = '1';
UPDATE `tb_servico` SET tipo_servico_id = '1';

ALTER TABLE `tb_curso`
ADD CONSTRAINT `fk_tb_curso_1`
FOREIGN KEY (`tipo_curso_id` )
REFERENCES `tb_tipo_curso` (`tipo_curso_id` )
ON DELETE NO ACTION
ON UPDATE NO ACTION
, ADD INDEX `fk_tb_curso_1_idx` (`tipo_curso_id` ASC) ;


ALTER TABLE `tb_servico`
ADD CONSTRAINT `fk_tb_servico_1`
FOREIGN KEY (`tipo_servico_id` )
REFERENCES `tb_tipo_servico` (`tipo_servico_id` )
ON DELETE NO ACTION
ON UPDATE NO ACTION
, ADD INDEX `fk_tb_servico_1_idx` (`tipo_servico_id` ASC) ;

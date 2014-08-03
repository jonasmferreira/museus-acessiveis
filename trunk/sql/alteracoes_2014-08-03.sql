DROP TABLE IF EXISTS `tb_emailmkt`;
CREATE TABLE IF NOT EXISTS `tb_emailmkt` (
  `emailmkt_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `emailmkt_titulo` VARCHAR(255) NOT NULL,
  `emailmkt_qtde_enviada` INT NOT NULL,
  `emailmkt_dt_agendada` DATE NOT NULL,
  `emailmkt_hr_agendada` TIME NOT NULL,
  `emailmkt_dt_disparo` DATE NULL,
  `emailmkt_hr_disparo` TIME NULL,
  `emailmkt_status` ENUM('P','X','E','C') NOT NULL DEFAULT 'P',
  `emailmkt_servico_ids` TEXT NOT NULL,
  `emailmkt_projeto_ids` TEXT NOT NULL,
  `emailmkt_glossario_ids` TEXT NOT NULL,
  `emailmkt_novidade360_id` BIGINT NOT NULL,
  `emailmkt_novidade360_ids` TEXT NOT NULL,
  `emailmkt_agenda_ids` TEXT NOT NULL,
  
  `emailmkt_arq_fisico` TEXT NOT NULL,
  
  `emailmkt_aqui_tem_titulo` TEXT NOT NULL,
  `emailmkt_aqui_tem_resumo` TEXT NOT NULL,
  `emailmkt_aqui_tem_thumb` TEXT NOT NULL,
  `emailmkt_aqui_tem_url` TEXT NOT NULL,
  `emailmkt_propaganda_img` TEXT NOT NULL,
  
  PRIMARY KEY (`emailmkt_id`));

DROP TABLE IF EXISTS `tb_emailmkt_conferencia`;
CREATE TABLE IF NOT EXISTS `tb_emailmkt_conferencia` (
  `emailmkt_conferencia_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `emailmkt_id` INT UNSIGNED NOT NULL,
  `mailing_id` BIGINT UNSIGNED NOT NULL,
  `mailing_email` varchar(255) NOT NULL,
  `emailmkt_conferencia_dt_disparo` DATE NULL,
  `emailmkt_conferencia_hr_disparo` TIME NULL,
  `emailmkt_conferencia_dt_visualizacao` DATE NULL,
  `emailmkt_conferencia_hr_visualizacao` TIME NULL,
  PRIMARY KEY (`emailmkt_conferencia_id`));
  
  
ALTER TABLE `museus_acessiveis`.`tb_emailmkt_conferencia` 
ADD INDEX `idx_emailmkt_conferencia_01` (`mailing_email` ASC),
ADD INDEX `fk_emailmkt_conferencia_01_idx` (`emailmkt_id` ASC),
ADD INDEX `fk_emailmkt_conferencia_02_idx` (`mailing_id` ASC);
ALTER TABLE `museus_acessiveis`.`tb_emailmkt_conferencia` 
ADD CONSTRAINT `fk_emailmkt_conferencia_01`
  FOREIGN KEY (`emailmkt_id`)
  REFERENCES `museus_acessiveis`.`tb_emailmkt` (`emailmkt_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_emailmkt_conferencia_02`
  FOREIGN KEY (`mailing_id`)
  REFERENCES `museus_acessiveis`.`tb_mailing` (`mailing_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


  
   
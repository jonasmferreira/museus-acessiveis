DROP TABLE IF EXISTS `tb_emailmkt`;
CREATE TABLE  `tb_emailmkt` (
  `emailmkt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emailmkt_titulo` varchar(255) NOT NULL,
  `emailmkt_qtde_enviada` int(11) NOT NULL,
  `emailmkt_dt_agendada` date NOT NULL,
  `emailmkt_hr_agendada` time NOT NULL,
  `emailmkt_dt_disparo` date DEFAULT NULL,
  `emailmkt_hr_disparo` time DEFAULT NULL,
  `emailmkt_status` enum('P','X','E','C','L') NOT NULL DEFAULT 'P',
  `emailmkt_noticia_ids` text NOT NULL,
  `emailmkt_glossario_ids` text NOT NULL,
  `emailmkt_novidade360_id` bigint(20) NOT NULL,
  `emailmkt_novidade360_ids` text NOT NULL,
  `emailmkt_agenda_ids` text NOT NULL,
  `emailmkt_arq_fisico` text NOT NULL,
  `emailmkt_aqui_tem_titulo` text NOT NULL,
  `emailmkt_aqui_tem_resumo` text NOT NULL,
  `emailmkt_aqui_tem_thumb` text NOT NULL,
  `emailmkt_aqui_tem_url` text NOT NULL,
  `emailmkt_propaganda_img` text NOT NULL,
  `emailmkt_propaganda_url` text,
  PRIMARY KEY (`emailmkt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




ALTER TABLE `tb_emailmkt` 
	DROP COLUMN `emailmkt_servico_ids`,
	DROP COLUMN `emailmkt_projeto_ids`,
	ADD COLUMN `emailmkt_noticia_ids` TEXT DEFAULT NULL AFTER `emailmkt_status`;

ALTER TABLE `tb_emailmkt` 
	DROP COLUMN `emailmkt_servico_ids`,
	CHANGE COLUMN `emailmkt_projeto_ids` `emailmkt_noticia_ids` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;




ALTER TABLE `tb_emailmkt` 
	ADD COLUMN `emailmkt_exibe_noticia` ENUM('S','N') NOT NULL AFTER `emailmkt_noticia_ids`,
	ADD COLUMN `emailmkt_exibe_glossario` ENUM('S','N') NOT NULL AFTER `emailmkt_glossario_ids`,
	ADD COLUMN `emailmkt_exibe_novidade360` ENUM('S','N') NOT NULL AFTER `emailmkt_novidade360_ids`,
	ADD COLUMN `emailmkt_exibe_agenda` ENUM('S','N') NOT NULL AFTER `emailmkt_agenda_ids`,
	ADD COLUMN `emailmkt_exibe_arquivo` ENUM('S','N') NOT NULL AFTER `emailmkt_arq_fisico`,
	ADD COLUMN `emailmkt_exibe_aquitem` ENUM('S','N') NOT NULL AFTER `emailmkt_aqui_tem_url`,
	ADD COLUMN `emailmkt_exibe_propaganda` ENUM('S','N') NOT NULL AFTER `emailmkt_propaganda_url`;




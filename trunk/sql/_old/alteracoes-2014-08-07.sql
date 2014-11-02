ALTER TABLE `tb_emailmkt` 
CHANGE COLUMN `emailmkt_status` `emailmkt_status` ENUM('P','X','E','C','L') NOT NULL DEFAULT 'P' ;

DROP TABLE IF EXISTS `tb_emailmkt_conferencia`;
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
  `emailmkt_servico_ids` text NOT NULL,
  `emailmkt_projeto_ids` text NOT NULL,
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
  PRIMARY KEY (`emailmkt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE  `tb_emailmkt_conferencia` (
  `emailmkt_conferencia_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emailmkt_id` int(10) unsigned NOT NULL,
  `mailing_id` bigint(20) unsigned NOT NULL,
  `mailing_email` varchar(255) NOT NULL,
  `emailmkt_conferencia_dt_disparo` date DEFAULT NULL,
  `emailmkt_conferencia_hr_disparo` time DEFAULT NULL,
  `emailmkt_conferencia_dt_visualizacao` date DEFAULT NULL,
  `emailmkt_conferencia_hr_visualizacao` time DEFAULT NULL,
  PRIMARY KEY (`emailmkt_conferencia_id`),
  KEY `idx_emailmkt_conferencia_01` (`mailing_email`),
  KEY `fk_emailmkt_conferencia_01_idx` (`emailmkt_id`),
  KEY `fk_emailmkt_conferencia_02_idx` (`mailing_id`),
  CONSTRAINT `fk_emailmkt_conferencia_01` FOREIGN KEY (`emailmkt_id`) REFERENCES `tb_emailmkt` (`emailmkt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emailmkt_conferencia_02` FOREIGN KEY (`mailing_id`) REFERENCES `tb_mailing` (`mailing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



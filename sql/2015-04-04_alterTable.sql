ALTER TABLE `tb_emailmkt` 
	ADD COLUMN `emailmkt_propaganda_descr` TEXT DEFAULT NULL AFTER `emailmkt_propaganda_img`;

ALTER TABLE `tb_emailmkt` 
	MODIFY COLUMN `emailmkt_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `tb_mailing` 
	ADD COLUMN `mailing_disparo_teste` ENUM('S','N') NOT NULL DEFAULT 'N' AFTER `mailing_enviar`;






ALTER TABLE `tb_emailmkt` 
	ADD COLUMN `emailmkt_contato_img` TEXT NOT NULL AFTER `emailmkt_exibe_agenda`,
	ADD COLUMN `emailmkt_contato_email` VARCHAR(255) NOT NULL AFTER `emailmkt_contato_img`;

ALTER TABLE `tb_emailmkt` 
	MODIFY COLUMN `emailmkt_contato_email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'emkt_contact_bt.png';
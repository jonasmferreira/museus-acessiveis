ALTER TABLE `tb_emailmkt` 
CHANGE COLUMN `emailmkt_status` `emailmkt_status` ENUM('P','X','E','C','L') NOT NULL DEFAULT 'P' ;


ALTER TABLE `tb_servico` 
    MODIFY COLUMN `servico_dt_ini` DATE DEFAULT NULL,
    MODIFY COLUMN `servico_dt_fim` DATE DEFAULT NULL,
    MODIFY COLUMN `servico_sob_demanda` ENUM('S','N') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL;

ALTER TABLE `tb_servico` 
    DROP COLUMN `servico_dt_ini`,
    DROP COLUMN `servico_dt_fim`,
    DROP COLUMN `servico_sob_demanda`;





DROP TABLE `tb_serv_proj_cur_info`;
CREATE TABLE `tb_serv_proj_cur_info` (
  `serv_proj_cur_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `servico_descr` TEXT DEFAULT NULL,
  `projeto_descr` TEXT DEFAULT NULL,
  `curso_descr` TEXT DEFAULT NULL,
  PRIMARY KEY (`serv_proj_cur_id`)
)
ENGINE = InnoDB;

INSERT INTO tb_serv_proj_cur_info
SET		servico_descr = 'descrição para serviços'
		,projeto_descr = 'descrição para projetos'
		,curso_descr = 'descrição para cursos';

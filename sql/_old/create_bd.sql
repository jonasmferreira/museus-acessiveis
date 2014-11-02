SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `museus_acessiveis` ;
CREATE SCHEMA IF NOT EXISTS `museus_acessiveis` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `museus_acessiveis` ;

-- -----------------------------------------------------
-- Table `tb_configuracao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_configuracao` ;

CREATE  TABLE IF NOT EXISTS `tb_configuracao` (
  `configuracao_id` INT UNSIGNED NOT NULL ,
  `configuracao_baseurl_ckfinder` VARCHAR(255) NOT NULL ,
  `configuracao_baseurl` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`configuracao_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_usuario` ;

CREATE  TABLE IF NOT EXISTS `tb_usuario` (
  `usuario_id` BIGINT UNSIGNED NOT NULL ,
  `usuario_nome` VARCHAR(255) NOT NULL ,
  `usuario_login` VARCHAR(255) NOT NULL ,
  `usuario_senha` VARCHAR(45) NOT NULL ,
  `usuario_email` VARCHAR(255) NOT NULL ,
  `usuario_nivel` ENUM('AS','A','U') NOT NULL DEFAULT 'U' ,
  `usuario_status` ENUM('A','I') NOT NULL ,
  PRIMARY KEY (`usuario_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_texto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_texto` ;

CREATE  TABLE IF NOT EXISTS `tb_texto` (
  `texto_id` INT UNSIGNED NOT NULL ,
  `texto_dt` DATE NOT NULL ,
  `texto_hr` TIME NOT NULL ,
  `texto_conteudo` LONGTEXT NOT NULL ,
  PRIMARY KEY (`texto_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_download`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_download` ;

CREATE  TABLE IF NOT EXISTS `tb_download` (
  `download_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `download_titulo` VARCHAR(255) NOT NULL ,
  `download_tipo` INT(2) NOT NULL ,
  `download_tamanho` DECIMAL(25,2) NOT NULL ,
  `download_arquivo` VARCHAR(255) NOT NULL ,
  `download_dt` DATE NOT NULL ,
  `download_hr` TIME NOT NULL ,
  PRIMARY KEY (`download_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_imprensa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_imprensa` ;

CREATE  TABLE IF NOT EXISTS `tb_imprensa` (
  `imprensa_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `imprensa_titulo` VARCHAR(255) NOT NULL ,
  `imprensa_tipo` INT(2) NOT NULL ,
  `imprensa_tamanho` DECIMAL(25,2) NOT NULL ,
  `imprensa_arquivo` VARCHAR(255) NOT NULL ,
  `imprensa_dt` DATE NOT NULL ,
  `imprensa_hr` TIME NOT NULL ,
  PRIMARY KEY (`imprensa_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_novidade_360`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_novidade_360` ;

CREATE  TABLE IF NOT EXISTS `tb_novidade_360` (
  `novidade_360_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `novidade_360_dt_agenda` DATE NOT NULL ,
  `novidade_360_dt` DATE NOT NULL ,
  `tb_novidade_360col` VARCHAR(45) NULL ,
  `novidade_360_hr` TIME NOT NULL ,
  `novidade_360_titulo` VARCHAR(255) NOT NULL ,
  `novidade_360_resumo` TEXT NOT NULL ,
  `novidade_360_thumb` VARCHAR(255) NOT NULL ,
  `novidade_360_thumb_desc` VARCHAR(255) NOT NULL ,
  `novidade_360_fonte` VARCHAR(255) NOT NULL ,
  `novidade_360_url_fonte` VARCHAR(255) NOT NULL ,
  `novidade_360_conteudo` LONGTEXT NOT NULL ,
  `novidade_360_exibir_banner` ENUM('S','N') NOT NULL ,
  `novidade_360_banner` VARCHAR(255) NOT NULL ,
  `novidade_360_banner_desc` TEXT NOT NULL ,
  `novidade_360_exibir_destaque_home` ENUM('S','N') NOT NULL ,
  `novidade_360_destaque_home` VARCHAR(255) NOT NULL ,
  `novidade_360_destaque_home_desc` TEXT NOT NULL ,
  `novidade_360_destaque_home_frase` TEXT NOT NULL ,
  PRIMARY KEY (`novidade_360_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_tag` ;

CREATE  TABLE IF NOT EXISTS `tb_tag` (
  `tag_id` BIGINT NOT NULL AUTO_INCREMENT ,
  `tag_titulo` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`tag_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_novidade_360_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_novidade_360_tag` ;

CREATE  TABLE IF NOT EXISTS `tb_novidade_360_tag` (
  `novidade_360_id` BIGINT UNSIGNED NOT NULL ,
  `tag_id` BIGINT NOT NULL ,
  PRIMARY KEY (`novidade_360_id`, `tag_id`) ,
  INDEX `fk_tb_novidade_360_has_tb_tag_tb_tag1_idx` (`tag_id` ASC) ,
  INDEX `fk_tb_novidade_360_has_tb_tag_tb_novidade_360_idx` (`novidade_360_id` ASC) ,
  CONSTRAINT `fk_tb_novidade_360_has_tb_tag_tb_novidade_360`
    FOREIGN KEY (`novidade_360_id` )
    REFERENCES `tb_novidade_360` (`novidade_360_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_novidade_360_has_tb_tag_tb_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `tb_tag` (`tag_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_anunciante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_anunciante` ;

CREATE  TABLE IF NOT EXISTS `tb_anunciante` (
  `anunciante_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `anunciante_dt` DATE NOT NULL ,
  `anunciante_hr` TIME NOT NULL ,
  `anunciante_nome` VARCHAR(255) NOT NULL ,
  `anunciante_tipo_banner` ENUM('FB','RE') NOT NULL ,
  `anunciante_banner` VARCHAR(255) NOT NULL ,
  `anunciante_banner_desc` VARCHAR(255) NOT NULL ,
  `anunciante_dt_agenda` DATE NOT NULL ,
  PRIMARY KEY (`anunciante_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_anunciante_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_anunciante_tag` ;

CREATE  TABLE IF NOT EXISTS `tb_anunciante_tag` (
  `anunciante_id` BIGINT UNSIGNED NOT NULL ,
  `tag_id` BIGINT NOT NULL ,
  PRIMARY KEY (`anunciante_id`, `tag_id`) ,
  INDEX `fk_tb_anunciante_has_tb_tag_tb_tag1_idx` (`tag_id` ASC) ,
  INDEX `fk_tb_anunciante_has_tb_tag_tb_anunciante1_idx` (`anunciante_id` ASC) ,
  CONSTRAINT `fk_tb_anunciante_has_tb_tag_tb_anunciante1`
    FOREIGN KEY (`anunciante_id` )
    REFERENCES `tb_anunciante` (`anunciante_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_anunciante_has_tb_tag_tb_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `tb_tag` (`tag_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_contato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_contato` ;

CREATE  TABLE IF NOT EXISTS `tb_contato` (
  `contato_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `contato_dt` DATE NOT NULL ,
  `contato_hr` TIME NOT NULL ,
  `contato_tipo` INT(2) NOT NULL ,
  `contato_nome` VARCHAR(255) NOT NULL ,
  `contato_link` VARCHAR(45) NOT NULL ,
  `contato_exibir` ENUM('S','N') NOT NULL ,
  PRIMARY KEY (`contato_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_agenda`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_agenda` ;

CREATE  TABLE IF NOT EXISTS `tb_agenda` (
  `agenda_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `agenda_dt_cad` DATE NOT NULL ,
  `agenda_hr_cad` TIME NOT NULL ,
  `agenda_titulo` VARCHAR(255) NOT NULL ,
  `agenda_resumo` TEXT NOT NULL ,
  `agenda_dt` DATE NOT NULL ,
  `agenda_img` VARCHAR(255) NOT NULL ,
  `agenda_img_desc` TEXT NOT NULL ,
  `agenda_fonte` VARCHAR(255) NOT NULL ,
  `agenda_link_fonte` VARCHAR(255) NOT NULL ,
  `agenda_conteudo` VARCHAR(255) NOT NULL ,
  `agenda_exibir` ENUM('S','N') NOT NULL ,
  PRIMARY KEY (`agenda_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_agenda_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_agenda_tag` ;

CREATE  TABLE IF NOT EXISTS `tb_agenda_tag` (
  `agenda_id` BIGINT UNSIGNED NOT NULL ,
  `tag_id` BIGINT NOT NULL ,
  PRIMARY KEY (`agenda_id`, `tag_id`) ,
  INDEX `fk_tb_agenda_has_tb_tag_tb_tag1_idx` (`tag_id` ASC) ,
  INDEX `fk_tb_agenda_has_tb_tag_tb_agenda1_idx` (`agenda_id` ASC) ,
  CONSTRAINT `fk_tb_agenda_has_tb_tag_tb_agenda1`
    FOREIGN KEY (`agenda_id` )
    REFERENCES `tb_agenda` (`agenda_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_agenda_has_tb_tag_tb_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `tb_tag` (`tag_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_newsletter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_newsletter` ;

CREATE  TABLE IF NOT EXISTS `tb_newsletter` (
  `newsletter_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `newsletter_nome` VARCHAR(45) NOT NULL ,
  `newsletter_email` VARCHAR(45) NOT NULL ,
  `newsletter_receber_informacoes` ENUM('S','N') NOT NULL ,
  PRIMARY KEY (`newsletter_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_glossario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_glossario` ;

CREATE  TABLE IF NOT EXISTS `tb_glossario` (
  `glossario_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `glossario_dt` DATE NOT NULL ,
  `glossario_hr` TIME NOT NULL ,
  `glossario_palavra` VARCHAR(255) NOT NULL ,
  `glossario_definicao` TEXT NOT NULL ,
  `glossario_fonte` VARCHAR(255) NOT NULL ,
  `glossario_link_fonte` VARCHAR(255) NOT NULL ,
  `glossario_conteudo` LONGTEXT NOT NULL ,
  `glossario_exibir` ENUM('S','N') NOT NULL ,
  PRIMARY KEY (`glossario_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_glossario_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_glossario_tag` ;

CREATE  TABLE IF NOT EXISTS `tb_glossario_tag` (
  `tag_id` BIGINT NOT NULL ,
  `glossario_id` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`tag_id`, `glossario_id`) ,
  INDEX `fk_tb_tag_has_tb_glossario_tb_glossario1_idx` (`glossario_id` ASC) ,
  INDEX `fk_tb_tag_has_tb_glossario_tb_tag1_idx` (`tag_id` ASC) ,
  CONSTRAINT `fk_tb_tag_has_tb_glossario_tb_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `tb_tag` (`tag_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_tag_has_tb_glossario_tb_glossario1`
    FOREIGN KEY (`glossario_id` )
    REFERENCES `tb_glossario` (`glossario_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_glossario_relacionado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_glossario_relacionado` ;

CREATE  TABLE IF NOT EXISTS `tb_glossario_relacionado` (
  `glossario_id` BIGINT UNSIGNED NOT NULL ,
  `glossario_id1` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`glossario_id`, `glossario_id1`) ,
  INDEX `fk_tb_glossario_has_tb_glossario_tb_glossario2_idx` (`glossario_id1` ASC) ,
  INDEX `fk_tb_glossario_has_tb_glossario_tb_glossario1_idx` (`glossario_id` ASC) ,
  CONSTRAINT `fk_tb_glossario_has_tb_glossario_tb_glossario1`
    FOREIGN KEY (`glossario_id` )
    REFERENCES `tb_glossario` (`glossario_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_glossario_has_tb_glossario_tb_glossario2`
    FOREIGN KEY (`glossario_id1` )
    REFERENCES `tb_glossario` (`glossario_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_extra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_extra` ;

CREATE  TABLE IF NOT EXISTS `tb_extra` (
  `extra_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `extra_nome_campo` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`extra_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_curso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_curso` ;

CREATE  TABLE IF NOT EXISTS `tb_curso` (
  `curso_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `curso_dt_cad` DATE NOT NULL ,
  `curso_hr_cad` TIME NOT NULL ,
  `curso_dt_ini` DATE NOT NULL ,
  `curso_dt_fim` DATE NOT NULL ,
  `curso_sob_demanda` ENUM('S','N') NOT NULL ,
  `curso_titulo` VARCHAR(255) NOT NULL ,
  `curso_resumo` TEXT NOT NULL ,
  `curso_thumb` VARCHAR(255) NOT NULL ,
  `curso_thumb_desc` TEXT NOT NULL ,
  `curso_fonte` VARCHAR(255) NOT NULL ,
  `curso_link_fonte` VARCHAR(255) NOT NULL ,
  `curso_conteudo` LONGTEXT NOT NULL ,
  `curso_agenda` DATE NOT NULL ,
  PRIMARY KEY (`curso_id`) )
ENGINE = InnoDB
COMMENT = '	';


-- -----------------------------------------------------
-- Table `tb_curso_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_curso_tag` ;

CREATE  TABLE IF NOT EXISTS `tb_curso_tag` (
  `tag_id` BIGINT NOT NULL ,
  `curso_id` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`tag_id`, `curso_id`) ,
  INDEX `fk_tb_tag_has_tb_curso_tb_curso1_idx` (`curso_id` ASC) ,
  INDEX `fk_tb_tag_has_tb_curso_tb_tag1_idx` (`tag_id` ASC) ,
  CONSTRAINT `fk_tb_tag_has_tb_curso_tb_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `tb_tag` (`tag_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_tag_has_tb_curso_tb_curso1`
    FOREIGN KEY (`curso_id` )
    REFERENCES `tb_curso` (`curso_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_curso_glossario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_curso_glossario` ;

CREATE  TABLE IF NOT EXISTS `tb_curso_glossario` (
  `glossario_id` BIGINT UNSIGNED NOT NULL ,
  `curso_id` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`glossario_id`, `curso_id`) ,
  INDEX `fk_tb_glossario_has_tb_curso_tb_curso1_idx` (`curso_id` ASC) ,
  INDEX `fk_tb_glossario_has_tb_curso_tb_glossario1_idx` (`glossario_id` ASC) ,
  CONSTRAINT `fk_tb_glossario_has_tb_curso_tb_glossario1`
    FOREIGN KEY (`glossario_id` )
    REFERENCES `tb_glossario` (`glossario_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_glossario_has_tb_curso_tb_curso1`
    FOREIGN KEY (`curso_id` )
    REFERENCES `tb_curso` (`curso_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_curso_download`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_curso_download` ;

CREATE  TABLE IF NOT EXISTS `tb_curso_download` (
  `curso_id` BIGINT UNSIGNED NOT NULL ,
  `download_id` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`curso_id`, `download_id`) ,
  INDEX `fk_tb_curso_has_tb_download_tb_download1_idx` (`download_id` ASC) ,
  INDEX `fk_tb_curso_has_tb_download_tb_curso1_idx` (`curso_id` ASC) ,
  CONSTRAINT `fk_tb_curso_has_tb_download_tb_curso1`
    FOREIGN KEY (`curso_id` )
    REFERENCES `tb_curso` (`curso_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_curso_has_tb_download_tb_download1`
    FOREIGN KEY (`download_id` )
    REFERENCES `tb_download` (`download_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_curso_extra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_curso_extra` ;

CREATE  TABLE IF NOT EXISTS `tb_curso_extra` (
  `curso_id` BIGINT UNSIGNED NOT NULL ,
  `extra_id` BIGINT UNSIGNED NOT NULL ,
  `curso_extra_valor` TEXT NOT NULL ,
  PRIMARY KEY (`curso_id`, `extra_id`) ,
  INDEX `fk_tb_curso_has_tb_extra_tb_extra1_idx` (`extra_id` ASC) ,
  INDEX `fk_tb_curso_has_tb_extra_tb_curso1_idx` (`curso_id` ASC) ,
  CONSTRAINT `fk_tb_curso_has_tb_extra_tb_curso1`
    FOREIGN KEY (`curso_id` )
    REFERENCES `tb_curso` (`curso_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_curso_has_tb_extra_tb_extra1`
    FOREIGN KEY (`extra_id` )
    REFERENCES `tb_extra` (`extra_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_servico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_servico` ;

CREATE  TABLE IF NOT EXISTS `tb_servico` (
  `servico_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `servico_dt_cad` DATE NOT NULL ,
  `servico_hr_cad` TIME NOT NULL ,
  `servico_dt_ini` DATE NOT NULL ,
  `servico_dt_fim` DATE NOT NULL ,
  `servico_sob_demanda` ENUM('S','N') NOT NULL ,
  `servico_titulo` VARCHAR(255) NOT NULL ,
  `servico_resumo` TEXT NOT NULL ,
  `servico_thumb` VARCHAR(255) NOT NULL ,
  `servico_thumb_desc` TEXT NOT NULL ,
  `servico_fonte` VARCHAR(255) NOT NULL ,
  `servico_link_fonte` VARCHAR(255) NOT NULL ,
  `servico_agenda` DATE NOT NULL ,
  PRIMARY KEY (`servico_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_servico_download`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_servico_download` ;

CREATE  TABLE IF NOT EXISTS `tb_servico_download` (
  `servico_id` BIGINT UNSIGNED NOT NULL ,
  `download_id` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`servico_id`, `download_id`) ,
  INDEX `fk_tb_servico_has_tb_download_tb_download1_idx` (`download_id` ASC) ,
  INDEX `fk_tb_servico_has_tb_download_tb_servico1_idx` (`servico_id` ASC) ,
  CONSTRAINT `fk_tb_servico_has_tb_download_tb_servico1`
    FOREIGN KEY (`servico_id` )
    REFERENCES `tb_servico` (`servico_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_servico_has_tb_download_tb_download1`
    FOREIGN KEY (`download_id` )
    REFERENCES `tb_download` (`download_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_servico_glossario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_servico_glossario` ;

CREATE  TABLE IF NOT EXISTS `tb_servico_glossario` (
  `servico_id` BIGINT UNSIGNED NOT NULL ,
  `glossario_id` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`servico_id`, `glossario_id`) ,
  INDEX `fk_tb_servico_has_tb_glossario_tb_glossario1_idx` (`glossario_id` ASC) ,
  INDEX `fk_tb_servico_has_tb_glossario_tb_servico1_idx` (`servico_id` ASC) ,
  CONSTRAINT `fk_tb_servico_has_tb_glossario_tb_servico1`
    FOREIGN KEY (`servico_id` )
    REFERENCES `tb_servico` (`servico_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_servico_has_tb_glossario_tb_glossario1`
    FOREIGN KEY (`glossario_id` )
    REFERENCES `tb_glossario` (`glossario_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_servico_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_servico_tag` ;

CREATE  TABLE IF NOT EXISTS `tb_servico_tag` (
  `tag_id` BIGINT NOT NULL ,
  `servico_id` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`tag_id`, `servico_id`) ,
  INDEX `fk_tb_tag_has_tb_servico_tb_servico1_idx` (`servico_id` ASC) ,
  INDEX `fk_tb_tag_has_tb_servico_tb_tag1_idx` (`tag_id` ASC) ,
  CONSTRAINT `fk_tb_tag_has_tb_servico_tb_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `tb_tag` (`tag_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_tag_has_tb_servico_tb_servico1`
    FOREIGN KEY (`servico_id` )
    REFERENCES `tb_servico` (`servico_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_servico_extra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_servico_extra` ;

CREATE  TABLE IF NOT EXISTS `tb_servico_extra` (
  `servico_id` BIGINT UNSIGNED NOT NULL ,
  `extra_id` BIGINT UNSIGNED NOT NULL ,
  `servico_extra_valor` TEXT NOT NULL ,
  PRIMARY KEY (`servico_id`, `extra_id`) ,
  INDEX `fk_tb_servico_has_tb_extra_tb_extra1_idx` (`extra_id` ASC) ,
  INDEX `fk_tb_servico_has_tb_extra_tb_servico1_idx` (`servico_id` ASC) ,
  CONSTRAINT `fk_tb_servico_has_tb_extra_tb_servico1`
    FOREIGN KEY (`servico_id` )
    REFERENCES `tb_servico` (`servico_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_servico_has_tb_extra_tb_extra1`
    FOREIGN KEY (`extra_id` )
    REFERENCES `tb_extra` (`extra_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_projeto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_projeto` ;

CREATE  TABLE IF NOT EXISTS `tb_projeto` (
  `projeto_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `projeto_dt_cad` DATE NOT NULL ,
  `projeto_hr_cad` TIME NOT NULL ,
  `projeto_dt_ini` DATE NOT NULL ,
  `projeto_dt_fim` DATE NOT NULL ,
  `projeto_sob_demanda` ENUM('S','N') NOT NULL ,
  `projeto_tipo` ENUM('A','R','EA') NOT NULL ,
  `projeto_titulo` VARCHAR(255) NOT NULL ,
  `projeto_resumo` TEXT NOT NULL ,
  `projeto_thumb` VARCHAR(255) NOT NULL ,
  `projeto_thumb_desc` TEXT NOT NULL ,
  `projeto_fonte` VARCHAR(255) NOT NULL ,
  `projeto_link_fonte` VARCHAR(255) NOT NULL ,
  `projeto_agenda` DATE NOT NULL ,
  PRIMARY KEY (`projeto_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_projeto_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_projeto_tag` ;

CREATE  TABLE IF NOT EXISTS `tb_projeto_tag` (
  `projeto_id` BIGINT UNSIGNED NOT NULL ,
  `tag_id` BIGINT NOT NULL ,
  PRIMARY KEY (`projeto_id`, `tag_id`) ,
  INDEX `fk_tb_projeto_has_tb_tag_tb_tag1_idx` (`tag_id` ASC) ,
  INDEX `fk_tb_projeto_has_tb_tag_tb_projeto1_idx` (`projeto_id` ASC) ,
  CONSTRAINT `fk_tb_projeto_has_tb_tag_tb_projeto1`
    FOREIGN KEY (`projeto_id` )
    REFERENCES `tb_projeto` (`projeto_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_projeto_has_tb_tag_tb_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `tb_tag` (`tag_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_projeto_glossario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_projeto_glossario` ;

CREATE  TABLE IF NOT EXISTS `tb_projeto_glossario` (
  `projeto_id` BIGINT UNSIGNED NOT NULL ,
  `glossario_id` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`projeto_id`, `glossario_id`) ,
  INDEX `fk_tb_projeto_has_tb_glossario_tb_glossario1_idx` (`glossario_id` ASC) ,
  INDEX `fk_tb_projeto_has_tb_glossario_tb_projeto1_idx` (`projeto_id` ASC) ,
  CONSTRAINT `fk_tb_projeto_has_tb_glossario_tb_projeto1`
    FOREIGN KEY (`projeto_id` )
    REFERENCES `tb_projeto` (`projeto_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_projeto_has_tb_glossario_tb_glossario1`
    FOREIGN KEY (`glossario_id` )
    REFERENCES `tb_glossario` (`glossario_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_projeto_download`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_projeto_download` ;

CREATE  TABLE IF NOT EXISTS `tb_projeto_download` (
  `projeto_id` BIGINT UNSIGNED NOT NULL ,
  `download_id` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`projeto_id`, `download_id`) ,
  INDEX `fk_tb_projeto_has_tb_download_tb_download1_idx` (`download_id` ASC) ,
  INDEX `fk_tb_projeto_has_tb_download_tb_projeto1_idx` (`projeto_id` ASC) ,
  CONSTRAINT `fk_tb_projeto_has_tb_download_tb_projeto1`
    FOREIGN KEY (`projeto_id` )
    REFERENCES `tb_projeto` (`projeto_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_projeto_has_tb_download_tb_download1`
    FOREIGN KEY (`download_id` )
    REFERENCES `tb_download` (`download_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_projeto_extra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tb_projeto_extra` ;

CREATE  TABLE IF NOT EXISTS `tb_projeto_extra` (
  `projeto_id` BIGINT UNSIGNED NOT NULL ,
  `extra_id` BIGINT UNSIGNED NOT NULL ,
  `projeto_extra_valor` TEXT NOT NULL ,
  PRIMARY KEY (`projeto_id`, `extra_id`) ,
  INDEX `fk_tb_projeto_has_tb_extra_tb_extra1_idx` (`extra_id` ASC) ,
  INDEX `fk_tb_projeto_has_tb_extra_tb_projeto1_idx` (`projeto_id` ASC) ,
  CONSTRAINT `fk_tb_projeto_has_tb_extra_tb_projeto1`
    FOREIGN KEY (`projeto_id` )
    REFERENCES `tb_projeto` (`projeto_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_projeto_has_tb_extra_tb_extra1`
    FOREIGN KEY (`extra_id` )
    REFERENCES `tb_extra` (`extra_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `museus_acessiveis` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

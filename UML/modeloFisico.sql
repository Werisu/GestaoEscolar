-- MySQL Workbench Synchronization
-- Generated: 2017-11-29 15:15
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Wellysson

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `gestao_escolar` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Turma` (
  `id` INT(11) NOT NULL,
  `turno` VARCHAR(45) NULL DEFAULT NULL,
  `sala_idsala` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `sala_idsala`),
  INDEX `fk_Turma_sala_idx` (`sala_idsala` ASC),
  CONSTRAINT `fk_Turma_sala`
    FOREIGN KEY (`sala_idsala`)
    REFERENCES `gestao_escolar`.`Sala` (`idsala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Sala` (
  `idsala` INT(11) NOT NULL,
  `numero` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idsala`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Aluno` (
  `matricula` INT(11) NOT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `cpf` VARCHAR(45) NULL DEFAULT NULL,
  `rg` VARCHAR(45) NULL DEFAULT NULL,
  `contato` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `data_nasc` VARCHAR(45) NULL DEFAULT NULL,
  `sexo` VARCHAR(45) NULL DEFAULT NULL,
  `bairro` VARCHAR(45) NULL DEFAULT NULL,
  `logadouro` VARCHAR(45) NULL DEFAULT NULL,
  `Turma_id` INT(11) NOT NULL,
  `Turma_sala_idsala` INT(11) NOT NULL,
  PRIMARY KEY (`matricula`, `Turma_id`, `Turma_sala_idsala`),
  INDEX `fk_Aluno_Turma1_idx` (`Turma_id` ASC, `Turma_sala_idsala` ASC),
  CONSTRAINT `fk_Aluno_Turma1`
    FOREIGN KEY (`Turma_id` , `Turma_sala_idsala`)
    REFERENCES `gestao_escolar`.`Turma` (`id` , `sala_idsala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Disciplina` (
  `id` INT(11) NOT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Disciplina_has_Turma` (
  `Disciplina_id` INT(11) NOT NULL,
  `Turma_id` INT(11) NOT NULL,
  `Turma_sala_idsala` INT(11) NOT NULL,
  PRIMARY KEY (`Disciplina_id`, `Turma_id`, `Turma_sala_idsala`),
  INDEX `fk_Disciplina_has_Turma_Turma1_idx` (`Turma_id` ASC, `Turma_sala_idsala` ASC),
  INDEX `fk_Disciplina_has_Turma_Disciplina1_idx` (`Disciplina_id` ASC),
  CONSTRAINT `fk_Disciplina_has_Turma_Disciplina1`
    FOREIGN KEY (`Disciplina_id`)
    REFERENCES `gestao_escolar`.`Disciplina` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Disciplina_has_Turma_Turma1`
    FOREIGN KEY (`Turma_id` , `Turma_sala_idsala`)
    REFERENCES `gestao_escolar`.`Turma` (`id` , `sala_idsala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Docente` (
  `registro` INT(11) NOT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `cpf` VARCHAR(45) NULL DEFAULT NULL,
  `rg` VARCHAR(45) NULL DEFAULT NULL,
  `logadouro` VARCHAR(45) NULL DEFAULT NULL,
  `bairro` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `sexo` VARCHAR(45) NULL DEFAULT NULL,
  `estato_civil` VARCHAR(45) NULL DEFAULT NULL,
  `formacao` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`registro`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Disciplina_has_Docente` (
  `Disciplina_id` INT(11) NOT NULL,
  `Docente_registro` INT(11) NOT NULL,
  PRIMARY KEY (`Disciplina_id`, `Docente_registro`),
  INDEX `fk_Disciplina_has_Docente_Docente1_idx` (`Docente_registro` ASC),
  INDEX `fk_Disciplina_has_Docente_Disciplina1_idx` (`Disciplina_id` ASC),
  CONSTRAINT `fk_Disciplina_has_Docente_Disciplina1`
    FOREIGN KEY (`Disciplina_id`)
    REFERENCES `gestao_escolar`.`Disciplina` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Disciplina_has_Docente_Docente1`
    FOREIGN KEY (`Docente_registro`)
    REFERENCES `gestao_escolar`.`Docente` (`registro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Atividade` (
  `id` INT(11) NOT NULL,
  `titulo` VARCHAR(45) NULL DEFAULT NULL,
  `descricao` VARCHAR(45) NULL DEFAULT NULL,
  `data_inicio` VARCHAR(45) NULL DEFAULT NULL,
  `data_final` VARCHAR(45) NULL DEFAULT NULL,
  `situacao` VARCHAR(45) NULL DEFAULT NULL,
  `Docente_registro` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `Docente_registro`),
  INDEX `fk_Atividade_Docente1_idx` (`Docente_registro` ASC),
  CONSTRAINT `fk_Atividade_Docente1`
    FOREIGN KEY (`Docente_registro`)
    REFERENCES `gestao_escolar`.`Docente` (`registro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Atividade_has_Aluno` (
  `Atividade_id` INT(11) NOT NULL,
  `Atividade_Docente_registro` INT(11) NOT NULL,
  `Aluno_matricula` INT(11) NOT NULL,
  `Aluno_Turma_id` INT(11) NOT NULL,
  `Aluno_Turma_sala_idsala` INT(11) NOT NULL,
  PRIMARY KEY (`Atividade_id`, `Atividade_Docente_registro`, `Aluno_matricula`, `Aluno_Turma_id`, `Aluno_Turma_sala_idsala`),
  INDEX `fk_Atividade_has_Aluno_Aluno1_idx` (`Aluno_matricula` ASC, `Aluno_Turma_id` ASC, `Aluno_Turma_sala_idsala` ASC),
  INDEX `fk_Atividade_has_Aluno_Atividade1_idx` (`Atividade_id` ASC, `Atividade_Docente_registro` ASC),
  CONSTRAINT `fk_Atividade_has_Aluno_Atividade1`
    FOREIGN KEY (`Atividade_id` , `Atividade_Docente_registro`)
    REFERENCES `gestao_escolar`.`Atividade` (`id` , `Docente_registro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Atividade_has_Aluno_Aluno1`
    FOREIGN KEY (`Aluno_matricula` , `Aluno_Turma_id` , `Aluno_Turma_sala_idsala`)
    REFERENCES `gestao_escolar`.`Aluno` (`matricula` , `Turma_id` , `Turma_sala_idsala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

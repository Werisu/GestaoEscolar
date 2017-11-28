-- MySQL Workbench Synchronization
-- Generated: 2017-11-28 17:15
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Wellysson

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `gestao_escolar` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Aluno` (
  `Matricula` VARCHAR(20) NOT NULL,
  `Nome` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NULL DEFAULT NULL,
  `rg` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `data_nasc` VARCHAR(45) NULL DEFAULT NULL,
  `sexo` VARCHAR(45) NULL DEFAULT NULL,
  `bairro` VARCHAR(45) NULL DEFAULT NULL,
  `logadouro` VARCHAR(45) NULL DEFAULT NULL,
  `turma_id` INT(11) NOT NULL,
  PRIMARY KEY (`Matricula`, `turma_id`),
  INDEX `fk_Aluno_turma1_idx` (`turma_id` ASC),
  CONSTRAINT `fk_Aluno_turma1`
    FOREIGN KEY (`turma_id`)
    REFERENCES `gestao_escolar`.`turma` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`telefone` (
  `Aluno_Matricula` VARCHAR(20) NOT NULL,
  `telefone` VARCHAR(12) NULL DEFAULT NULL,
  `Docente_cpf` INT(11) NOT NULL,
  PRIMARY KEY (`Aluno_Matricula`, `Docente_cpf`),
  INDEX `fk_telefone_Docente1_idx` (`Docente_cpf` ASC),
  CONSTRAINT `fk_telefone_Aluno`
    FOREIGN KEY (`Aluno_Matricula`)
    REFERENCES `gestao_escolar`.`Aluno` (`Matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_telefone_Docente1`
    FOREIGN KEY (`Docente_cpf`)
    REFERENCES `gestao_escolar`.`Docente` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`turma` (
  `id` INT(11) NOT NULL,
  `turno` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`tem` (
  `id` INT(11) NOT NULL,
  `hora` VARCHAR(10) NULL DEFAULT NULL,
  `turma_id` INT(11) NOT NULL,
  `Disciplina_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `turma_id`, `Disciplina_id`),
  INDEX `fk_tem_turma1_idx` (`turma_id` ASC),
  INDEX `fk_tem_Disciplina1_idx` (`Disciplina_id` ASC),
  CONSTRAINT `fk_tem_turma1`
    FOREIGN KEY (`turma_id`)
    REFERENCES `gestao_escolar`.`turma` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tem_Disciplina1`
    FOREIGN KEY (`Disciplina_id`)
    REFERENCES `gestao_escolar`.`Disciplina` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Disciplina` (
  `id` INT(11) NOT NULL,
  `Titulo` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Docente` (
  `cpf` INT(11) NOT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `rg` VARCHAR(45) NULL DEFAULT NULL,
  `logadouro` VARCHAR(45) NULL DEFAULT NULL,
  `bairro` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `sexo` VARCHAR(45) NULL DEFAULT NULL,
  `estato_civil` VARCHAR(45) NULL DEFAULT NULL,
  `formacao` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`cpf`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Ministra` (
  `Docente_cpf` INT(11) NOT NULL,
  `Disciplina_id` INT(11) NOT NULL,
  PRIMARY KEY (`Docente_cpf`, `Disciplina_id`),
  INDEX `fk_Ministra_Disciplina1_idx` (`Disciplina_id` ASC),
  CONSTRAINT `fk_Ministra_Docente1`
    FOREIGN KEY (`Docente_cpf`)
    REFERENCES `gestao_escolar`.`Docente` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ministra_Disciplina1`
    FOREIGN KEY (`Disciplina_id`)
    REFERENCES `gestao_escolar`.`Disciplina` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Atividade` (
  `Docente_cpf` INT(11) NOT NULL,
  `Aluno_Matricula` VARCHAR(20) NOT NULL,
  `Aluno_turma_id` INT(11) NOT NULL,
  `id` VARCHAR(45) NOT NULL,
  `titulo` VARCHAR(45) NULL DEFAULT NULL,
  `descricao` VARCHAR(999) NULL DEFAULT NULL,
  `data_inicio` VARCHAR(45) NULL DEFAULT NULL,
  `data_final` VARCHAR(45) NULL DEFAULT NULL,
  `situacao` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`Aluno_Matricula`, `Aluno_turma_id`, `id`, `Docente_cpf`),
  INDEX `fk_Atividade_Aluno1_idx` (`Aluno_Matricula` ASC, `Aluno_turma_id` ASC),
  CONSTRAINT `fk_Atividade_Docente1`
    FOREIGN KEY (`Docente_cpf`)
    REFERENCES `gestao_escolar`.`Docente` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Atividade_Aluno1`
    FOREIGN KEY (`Aluno_Matricula` , `Aluno_turma_id`)
    REFERENCES `gestao_escolar`.`Aluno` (`Matricula` , `turma_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Tem` (
  `idTem` INT(11) NOT NULL,
  `Sala_idSala` INT(11) NOT NULL,
  `turma_id` INT(11) NOT NULL,
  PRIMARY KEY (`idTem`, `Sala_idSala`, `turma_id`),
  INDEX `fk_Tem_Sala1_idx` (`Sala_idSala` ASC),
  INDEX `fk_Tem_turma1_idx` (`turma_id` ASC),
  CONSTRAINT `fk_Tem_Sala1`
    FOREIGN KEY (`Sala_idSala`)
    REFERENCES `gestao_escolar`.`Sala` (`idSala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tem_turma1`
    FOREIGN KEY (`turma_id`)
    REFERENCES `gestao_escolar`.`turma` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gestao_escolar`.`Sala` (
  `idSala` INT(11) NOT NULL,
  PRIMARY KEY (`idSala`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Placeholder table for view `gestao_escolar`.`view1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao_escolar`.`view1` (`id` INT);


USE `gestao_escolar`;

-- -----------------------------------------------------
-- View `gestao_escolar`.`view1`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestao_escolar`.`view1`;
USE `gestao_escolar`;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

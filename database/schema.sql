-- MySQL Script generated by MySQL Workbench
-- Tue Oct 31 09:15:04 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema uffsscheduler
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `uffsscheduler` ;

-- -----------------------------------------------------
-- Schema uffsscheduler
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `uffsscheduler` DEFAULT CHARACTER SET utf8 ;
USE `uffsscheduler` ;

-- -----------------------------------------------------
-- Table `uffsscheduler`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `uffsscheduler`.`roles` ;

CREATE TABLE IF NOT EXISTS `uffsscheduler`.`roles` (
  `uid` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uffsscheduler`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `uffsscheduler`.`users` ;

CREATE TABLE IF NOT EXISTS `uffsscheduler`.`users` (
  `uid` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) NOT NULL,
  `password` VARCHAR(20) NOT NULL,
  `first_name` VARCHAR(20) NOT NULL,
  `last_name` VARCHAR(20) NOT NULL,
  `enrollment` BIGINT NOT NULL,
  `email` VARCHAR(40) NOT NULL,
  `registry_date` DATE NOT NULL,
  `ban_status` TINYINT(1) NOT NULL,
  `user_role_uid` INT NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `enrollment_UNIQUE` (`enrollment` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `users_role_uid_idx` (`user_role_uid` ASC),
  CONSTRAINT `users_role_uid`
    FOREIGN KEY (`user_role_uid`)
    REFERENCES `uffsscheduler`.`roles` (`uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uffsscheduler`.`classes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `uffsscheduler`.`classes` ;

CREATE TABLE IF NOT EXISTS `uffsscheduler`.`classes` (
  `uid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `year` INT NOT NULL,
  `semester` INT NOT NULL,
  `shift` VARCHAR(20) NOT NULL,
  `period` INT NOT NULL,
  `registry_date` DATE NOT NULL,
  PRIMARY KEY (`uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uffsscheduler`.`ccrs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `uffsscheduler`.`ccrs` ;

CREATE TABLE IF NOT EXISTS `uffsscheduler`.`ccrs` (
  `uid` INT NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(6) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `registry_date` DATE NOT NULL,
  `class_uid` INT NOT NULL,
  PRIMARY KEY (`uid`),
  INDEX `ccrs_class_uid_idx` (`class_uid` ASC),
  CONSTRAINT `ccrs_class_uid`
    FOREIGN KEY (`class_uid`)
    REFERENCES `uffsscheduler`.`classes` (`uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `uffsscheduler`.`roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `uffsscheduler`;
INSERT INTO `uffsscheduler`.`roles` (`uid`, `role`) VALUES (1, 'Administrador');
INSERT INTO `uffsscheduler`.`roles` (`uid`, `role`) VALUES (2, 'Estudante');
INSERT INTO `uffsscheduler`.`roles` (`uid`, `role`) VALUES (3, 'Professor');

COMMIT;


-- -----------------------------------------------------
-- Data for table `uffsscheduler`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `uffsscheduler`;
INSERT INTO `uffsscheduler`.`users` (`uid`, `username`, `password`, `first_name`, `last_name`, `enrollment`, `email`, `registry_date`, `ban_status`, `user_role_uid`) VALUES (1, 'JotaCampagnolo', 'JotaCampagnolo123', 'Joao Marcos', 'Campagnolo', 1221101017, 'jota.campagnolo@gmail.com', '2017-10-31', 0, 1);
INSERT INTO `uffsscheduler`.`users` (`uid`, `username`, `password`, `first_name`, `last_name`, `enrollment`, `email`, `registry_date`, `ban_status`, `user_role_uid`) VALUES (2, 'JardelAnton', 'JardelAnton123', 'Jardel', 'Anton', 1311100022, 'jardellanton@gmail.com', '2017-10-31', 0, 1);
INSERT INTO `uffsscheduler`.`users` (`uid`, `username`, `password`, `first_name`, `last_name`, `enrollment`, `email`, `registry_date`, `ban_status`, `user_role_uid`) VALUES (3, 'DuanPedroso', 'DuanPedroso123', 'Duan', 'Pedroso da Silva', 1311100006, 'duan.ps@gmail.com', '2017-10-31', 0, 1);
INSERT INTO `uffsscheduler`.`users` (`uid`, `username`, `password`, `first_name`, `last_name`, `enrollment`, `email`, `registry_date`, `ban_status`, `user_role_uid`) VALUES (4, 'VitorForbrig', 'VitorForbrig123', 'Vitor Guilherme', 'Forbrig', 1411100045, 'vitorforbrig@gmail.com', '2017-10-31', 0, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `uffsscheduler`.`classes`
-- -----------------------------------------------------
START TRANSACTION;
USE `uffsscheduler`;
INSERT INTO `uffsscheduler`.`classes` (`uid`, `name`, `year`, `semester`, `shift`, `period`, `registry_date`) VALUES (1, 'CC - 4 Fase - Matutino - 2016/1', 2016, 1, 'Matutino', 4, '2017-10-31');
INSERT INTO `uffsscheduler`.`classes` (`uid`, `name`, `year`, `semester`, `shift`, `period`, `registry_date`) VALUES (2, 'CC - 3 Fase - Noturno - 2016/2', 2016, 2, 'Noturno', 3, '2017-10-31');
INSERT INTO `uffsscheduler`.`classes` (`uid`, `name`, `year`, `semester`, `shift`, `period`, `registry_date`) VALUES (3, 'CC - 2 Fase - Vespertino - 2017/1', 2017, 1, 'Vespertino', 2, '2017-10-31');
INSERT INTO `uffsscheduler`.`classes` (`uid`, `name`, `year`, `semester`, `shift`, `period`, `registry_date`) VALUES (4, 'CC - 1 Fase - Noturno - 2017/2', 2017, 2, 'Notruno', 1, '2017-10-31');

COMMIT;


-- -----------------------------------------------------
-- Data for table `uffsscheduler`.`ccrs`
-- -----------------------------------------------------
START TRANSACTION;
USE `uffsscheduler`;
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (1, 'GEX090', 'Banco de Dados 1', '2017-10-31', 1);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (2, 'GEX099', 'Programacao 2', '2017-10-31', 1);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (3, 'GEX036', 'Calculo Numerico', '2017-10-31', 1);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (4, 'GCH011', 'Introducao ao Pensamento Social', '2017-10-31', 1);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (5, 'GEX104', 'Teoria da Computacao', '2017-10-31', 1);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (6, 'GEN039', 'Grafos', '2017-10-31', 1);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (7, 'GEX093', 'Matematica Discreta', '2017-10-31', 2);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (8, 'GEX092', 'Estrutura de Dados 2', '2017-10-31', 2);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (9, 'GEX098', 'Programacao 1', '2017-10-31', 2);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (10, 'GEX012', 'Algebra Linear', '2017-10-31', 2);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (11, 'GEX009', 'Calculo 1', '2017-10-31', 2);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (12, 'GEX006', 'Estatistica Basica', '2017-10-31', 3);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (13, 'GLA004', 'Leitura e Producao Textual 2', '2017-10-31', 3);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (14, 'GEX015', 'Estrutura de Dados 1', '2017-10-31', 3);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (15, 'GEX016', 'Sistemas Digitais', '2017-10-31', 3);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (16, 'GEX009', 'Calculo 1', '2017-10-31', 3);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (17, 'GEX012', 'Algebra Linear', '2017-10-31', 3);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (18, 'GEX002', 'Introducao a Informatica', '2017-10-31', 4);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (19, 'GEX001', 'Matematica Instrumental', '2017-10-31', 4);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (20, 'GLA001', 'Leitura e Producao Textual 1', '2017-10-31', 4);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (21, 'GEX003', 'Algoritmos e Programacao', '2017-10-31', 4);
INSERT INTO `uffsscheduler`.`ccrs` (`uid`, `code`, `name`, `registry_date`, `class_uid`) VALUES (22, 'GEN001', 'Circuitos Digitais', '2017-10-31', 4);

COMMIT;


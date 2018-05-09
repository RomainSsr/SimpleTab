-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema simpletab
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema simpletab
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `simpletab` DEFAULT CHARACTER SET utf8 ;
USE `simpletab` ;

-- -----------------------------------------------------
-- Table `simpletab`.`artists`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simpletab`.`artists` (
  `idArtist` INT(11) NOT NULL,
  `nameArtist` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idArtist`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simpletab`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simpletab`.`users` (
  `idUsers` INT(11) NOT NULL,
  `nameUser` VARCHAR(45) NOT NULL,
  `forenameUser` VARCHAR(45) NOT NULL,
  `pwdUser` VARCHAR(45) NOT NULL,
  `emailUser` VARCHAR(45) NOT NULL,
  `pseudoUser` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUsers`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simpletab`.`tablatures`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simpletab`.`tablatures` (
  `idTab` INT(11) NOT NULL,
  `titleTab` VARCHAR(45) NOT NULL,
  `pathTab` VARCHAR(50) NOT NULL,
  `rateTab` DOUBLE NULL DEFAULT '0',
  `commentTab` MEDIUMTEXT NULL DEFAULT NULL,
  `linkVideo` VARCHAR(45) NULL,
  `USERS_idUsers` INT(11) NOT NULL,
  `ARTISTS_idArtist` INT(11) NOT NULL,
  PRIMARY KEY (`idTab`),
  INDEX `fk_TABLATURES_USERS_idx` (`USERS_idUsers` ASC),
  INDEX `fk_TABLATURES_ARTISTS1_idx` (`ARTISTS_idArtist` ASC),
  CONSTRAINT `fk_TABLATURES_ARTISTS1`
    FOREIGN KEY (`ARTISTS_idArtist`)
    REFERENCES `simpletab`.`artists` (`idArtist`),
  CONSTRAINT `fk_TABLATURES_USERS`
    FOREIGN KEY (`USERS_idUsers`)
    REFERENCES `simpletab`.`users` (`idUsers`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

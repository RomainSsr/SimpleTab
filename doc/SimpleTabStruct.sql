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
-- Table `simpletab`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simpletab`.`roles` (
  `idrole` INT(11) NOT NULL,
  `captionRole` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idrole`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simpletab`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simpletab`.`users` (
  `idUsers` INT(11) NOT NULL AUTO_INCREMENT,
  `nameUser` VARCHAR(45) NOT NULL,
  `forenameUser` VARCHAR(45) NOT NULL,
  `pwdUser` VARCHAR(45) NOT NULL,
  `emailUser` VARCHAR(45) NOT NULL,
  `pseudoUser` VARCHAR(45) NOT NULL,
  `role_idrole` INT(11) NOT NULL,
  PRIMARY KEY (`idUsers`),
  INDEX `fk_users_role1_idx` (`role_idrole` ASC),
  CONSTRAINT `fk_users_role1`
    FOREIGN KEY (`role_idrole`)
    REFERENCES `simpletab`.`roles` (`idrole`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simpletab`.`tablatures`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simpletab`.`tablatures` (
  `idTab` INT(11) NOT NULL,
  `titleTab` VARCHAR(45) NOT NULL,
  `pathTab` VARCHAR(50) NOT NULL,
  `rateTab` DOUBLE NULL DEFAULT '0',
  `linkVideo` VARCHAR(45) NOT NULL,
  `lvlTab` INT(11) NOT NULL,
  `ARTISTS_idArtist` INT(11) NOT NULL,
  `users_idUsers` INT(11) NOT NULL,
  PRIMARY KEY (`idTab`),
  INDEX `fk_TABLATURES_ARTISTS1_idx` (`ARTISTS_idArtist` ASC),
  INDEX `fk_tablatures_users1_idx` (`users_idUsers` ASC),
  CONSTRAINT `fk_TABLATURES_ARTISTS1`
    FOREIGN KEY (`ARTISTS_idArtist`)
    REFERENCES `simpletab`.`artists` (`idArtist`),
  CONSTRAINT `fk_tablatures_users1`
    FOREIGN KEY (`users_idUsers`)
    REFERENCES `simpletab`.`users` (`idUsers`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simpletab`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simpletab`.`comments` (
  `idcomment` INT(11) NOT NULL AUTO_INCREMENT,
  `contentComment` MEDIUMTEXT NULL DEFAULT NULL,
  `tablatures_idTab` INT(11) NOT NULL,
  `artists_idArtist` INT(11) NOT NULL,
  PRIMARY KEY (`idcomment`),
  INDEX `fk_comments_tablatures1_idx` (`tablatures_idTab` ASC),
  INDEX `fk_comments_artists1_idx` (`artists_idArtist` ASC),
  CONSTRAINT `fk_comments_artists1`
    FOREIGN KEY (`artists_idArtist`)
    REFERENCES `simpletab`.`artists` (`idArtist`),
  CONSTRAINT `fk_comments_tablatures1`
    FOREIGN KEY (`tablatures_idTab`)
    REFERENCES `simpletab`.`tablatures` (`idTab`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

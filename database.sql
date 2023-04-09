-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema UniversityMarks
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema UniversityMarks
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `UniversityMarks` DEFAULT CHARACTER SET utf8 ;
USE `UniversityMarks` ;

-- -----------------------------------------------------
-- Table `UniversityMarks`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `UniversityMarks`.`student` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `password` VARCHAR(4000) NOT NULL,
  `birth_date` DATETIME NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `UniversityMarks`.`marks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `UniversityMarks`.`marks` (
  `idmarks` INT NOT NULL AUTO_INCREMENT,
  `student_id` INT NOT NULL,
  `mark` DECIMAL(7,3) NOT NULL,
  PRIMARY KEY (`idmarks`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

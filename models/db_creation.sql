-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema anteproyectos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema anteproyectos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `anteproyectos` DEFAULT CHARACTER SET latin1 ;
USE `anteproyectos` ;

-- -----------------------------------------------------
-- Table `anteproyectos`.`project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anteproyectos`.`project` (
  `idprojects` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(400) NOT NULL,
  `abstract` TEXT NULL,
  `problem_statement` TEXT NULL,
  `objectives` TEXT NULL,
  `pdf_url` VARCHAR(400) NOT NULL,
  `state` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idprojects`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anteproyectos`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anteproyectos`.`student` (
  `idstudent` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NULL,
  `fullname` VARCHAR(45) NULL,
  `profilepic` VARCHAR(400) NULL,
  `email` VARCHAR(400) NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`idstudent`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anteproyectos`.`professor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anteproyectos`.`professor` (
  `idprofessor` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NULL,
  `fullname` VARCHAR(45) NULL,
  `profilepic` VARCHAR(400) NULL,
  `email` VARCHAR(400) NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`idprofessor`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anteproyectos`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anteproyectos`.`admin` (
  `idadmin` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `fullname` VARCHAR(45) NULL,
  `profilepic` VARCHAR(400) NULL,
  `email` VARCHAR(400) NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`idadmin`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anteproyectos`.`project_x_student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anteproyectos`.`project_x_student` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `student` INT NOT NULL,
  `project` INT NOT NULL,
  `role` TINYINT NOT NULL,
  PRIMARY KEY (`id`, `student`, `project`),
  INDEX `fk_student_has_project_project1_idx` (`project` ASC) ,
  INDEX `fk_student_has_project_student1_idx` (`student` ASC) ,
  CONSTRAINT `fk_student_has_project_student1`
    FOREIGN KEY (`student`)
    REFERENCES `anteproyectos`.`student` (`idstudent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_project_project1`
    FOREIGN KEY (`project`)
    REFERENCES `anteproyectos`.`project` (`idprojects`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anteproyectos`.`project_x_professor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anteproyectos`.`project_x_professor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `professor` INT NOT NULL,
  `project` INT NOT NULL,
  `role` TINYINT NOT NULL,
  PRIMARY KEY (`id`, `professor`, `project`),
  INDEX `fk_project_has_professor_professor1_idx` (`professor` ASC) ,
  INDEX `fk_project_has_professor_project1_idx` (`project` ASC) ,
  CONSTRAINT `fk_project_has_professor_project1`
    FOREIGN KEY (`project`)
    REFERENCES `anteproyectos`.`project` (`idprojects`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_has_professor_professor1`
    FOREIGN KEY (`professor`)
    REFERENCES `anteproyectos`.`professor` (`idprofessor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anteproyectos`.`history`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anteproyectos`.`history` (
  `idhistory` INT NOT NULL AUTO_INCREMENT,
  `event_type` INT NOT NULL,
  `id_responsible` INT NOT NULL,
  `id_affected` INT NOT NULL,
  `timestamp` TIMESTAMP NOT NULL,
  `message` TEXT NULL,
  PRIMARY KEY (`idhistory`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anteproyectos`.`tag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anteproyectos`.`tag` (
  `idtag` INT NOT NULL AUTO_INCREMENT,
  `project` INT NOT NULL,
  PRIMARY KEY (`idtag`, `project`),
  INDEX `fk_keywords_project1_idx` (`project` ASC) ,
  CONSTRAINT `fk_keywords_project1`
    FOREIGN KEY (`project`)
    REFERENCES `anteproyectos`.`project` (`idprojects`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anteproyectos`.`program`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anteproyectos`.`program` (
  `idprogram` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`idprogram`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anteproyectos`.`student_x_program`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anteproyectos`.`student_x_program` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `student` INT NOT NULL,
  `program` INT NOT NULL,
  PRIMARY KEY (`id`, `student`, `program`),
  INDEX `fk_student_has_program_program1_idx` (`program` ASC) ,
  INDEX `fk_student_has_program_student1_idx` (`student` ASC) ,
  CONSTRAINT `fk_student_has_program_student1`
    FOREIGN KEY (`student`)
    REFERENCES `anteproyectos`.`student` (`idstudent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_program_program1`
    FOREIGN KEY (`program`)
    REFERENCES `anteproyectos`.`program` (`idprogram`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anteproyectos`.`professor_x_program`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anteproyectos`.`professor_x_program` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `professor` INT NOT NULL,
  `program` INT NOT NULL,
  PRIMARY KEY (`id`, `professor`, `program`),
  INDEX `fk_professor_has_program_program1_idx` (`program` ASC) ,
  INDEX `fk_professor_has_program_professor1_idx` (`professor` ASC) ,
  CONSTRAINT `fk_professor_has_program_professor1`
    FOREIGN KEY (`professor`)
    REFERENCES `anteproyectos`.`professor` (`idprofessor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_has_program_program1`
    FOREIGN KEY (`program`)
    REFERENCES `anteproyectos`.`program` (`idprogram`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

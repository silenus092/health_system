-- MySQL Script generated by MySQL Workbench
-- 09/06/15 02:24:24
-- Model: New Model    Version: 1.0
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema health_it2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `health_it2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `health_it2` ;

-- -----------------------------------------------------
-- Table `health_it2`.`persons`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `health_it2`.`persons` (
  `person_id` INT NOT NULL AUTO_INCREMENT,
  `person_first_name` VARCHAR(45) NULL,
  `person_last_name` VARCHAR(45) NULL,
  `person_age` INT NULL,
  `person_birth_date` DATETIME NULL,
  `person_citizenID` VARCHAR(45) NULL,
  `person_house_num` VARCHAR(45) NULL,
  `person_soi` VARCHAR(45) NULL,
  `person_road` VARCHAR(45) NULL,
  `person_tumbon` VARCHAR(45) NULL,
  `person_amphur` VARCHAR(45) NULL,
  `person_province` VARCHAR(45) NULL,
  `person_post_code` INT NULL,
  `person_mobile_phone` VARCHAR(45) NULL,
  `person_phone` VARCHAR(45) NULL,
  `person_sex` VARCHAR(45) NULL,
  `person_mooh_num` VARCHAR(45) NULL,
  PRIMARY KEY (`person_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `health_it2`.`disease_forms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `health_it2`.`disease_forms` (
  `question_id` INT NOT NULL,
  `disease_types` VARCHAR(45) NULL,
  PRIMARY KEY (`question_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `health_it2`.`disease_1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `health_it2`.`disease_1` (
  `symptom_1_1` VARCHAR(45) NULL,
  `symptom_1_2` VARCHAR(45) NULL,
  `symptom_1_3` VARCHAR(45) NULL,
  `symptom_2` VARCHAR(45) NULL,
  `symptom_3` VARCHAR(45) NULL,
  `symptom_4_1` VARCHAR(45) NULL,
  `symptom_4_2` VARCHAR(45) NULL,
  `symptom_4_3` VARCHAR(45) NULL,
  `symptom_4_4` VARCHAR(45) NULL,
  `symptom_5` VARCHAR(45) NULL,
  `symptom_5_date` DATE NULL,
  `symptom_5_result` VARCHAR(100) NULL,
  `symptom_6` VARCHAR(45) NULL,
  `symptom_6_date` DATE NULL,
  `symptom_6_result` VARCHAR(100) NULL,
  `symptom_7_1` VARCHAR(45) NULL,
  `symptom_7_1_result` VARCHAR(45) NULL,
  `symptom_7_2` VARCHAR(45) NULL,
  `symptom_7_2_result` VARCHAR(45) NULL,
  `symptom_7_3` VARCHAR(45) NULL,
  `symptom_7_3_result` VARCHAR(45) NULL,
  `symptom_8` VARCHAR(45) NULL,
  `symptom_9_male` INT NULL,
  `symptom_9_female` INT NULL,
  `symptom_10_2_female` INT NULL,
  `symptom_10_2_male` INT NULL,
  `symptom_10_1` VARCHAR(45) NULL,
  `symptom_10_1_male` VARCHAR(45) NULL,
  `questions_id` INT NOT NULL,
  PRIMARY KEY (`questions_id`),
  CONSTRAINT `fk_question_questions1`
    FOREIGN KEY (`questions_id`)
    REFERENCES `health_it2`.`disease_forms` (`question_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `health_it2`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `health_it2`.`roles` (
  `role_id` INT NOT NULL AUTO_INCREMENT,
  `role_description` VARCHAR(45) NULL,
  PRIMARY KEY (`role_id`))
ENGINE = InnoDB
COMMENT = 'eg Father , Son ,Husban , Wife';


-- -----------------------------------------------------
-- Table `health_it2`.`relationship_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `health_it2`.`relationship_type` (
  `relationship_type_id` INT NOT NULL AUTO_INCREMENT,
  `relationship_type_description` VARCHAR(45) NULL,
  PRIMARY KEY (`relationship_type_id`))
ENGINE = InnoDB
COMMENT = 'eg  Parent ,Child , Married';


-- -----------------------------------------------------
-- Table `health_it2`.`relationship`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `health_it2`.`relationship` (
  `relationship_id` INT NOT NULL AUTO_INCREMENT,
  `person_1_id` INT NOT NULL,
  `role_1_id` INT NOT NULL,
  `relationship_type_id` INT NOT NULL,
  `person_2_id` INT NOT NULL,
  `role_2_id` INT NOT NULL,
  PRIMARY KEY (`relationship_id`),
  INDEX `fk_relationships_person1_idx` (`person_1_id` ASC),
  INDEX `fk_relationships_roles1_idx` (`role_1_id` ASC),
  INDEX `fk_relationships_relationship_type1_idx` (`relationship_type_id` ASC),
  INDEX `fk_relationship_persons1_idx` (`person_2_id` ASC),
  INDEX `fk_relationship_roles1_idx` (`role_2_id` ASC),
  CONSTRAINT `fk_relationships_person1`
    FOREIGN KEY (`person_1_id`)
    REFERENCES `health_it2`.`persons` (`person_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relationships_roles1`
    FOREIGN KEY (`role_1_id`)
    REFERENCES `health_it2`.`roles` (`role_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relationships_relationship_type1`
    FOREIGN KEY (`relationship_type_id`)
    REFERENCES `health_it2`.`relationship_type` (`relationship_type_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relationship_persons1`
    FOREIGN KEY (`person_2_id`)
    REFERENCES `health_it2`.`persons` (`person_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relationship_roles1`
    FOREIGN KEY (`role_2_id`)
    REFERENCES `health_it2`.`roles` (`role_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'The relationship uses to identify role and relationship  between two people';


-- -----------------------------------------------------
-- Table `health_it2`.`doctors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `health_it2`.`doctors` (
  `doctor_id` INT NOT NULL AUTO_INCREMENT,
  `doctor_name` VARCHAR(45) NULL,
  `doctor_mobile_phone` VARCHAR(45) NULL,
  `doctor_phone` VARCHAR(45) NULL,
  `hospital` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`doctor_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `health_it2`.`patients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `health_it2`.`patients` (
  `patient_id` INT NOT NULL,
  `doctor_id` INT NOT NULL,
  `registration_date` DATE NULL,
  `person_id` INT NOT NULL,
  PRIMARY KEY (`patient_id`),
  INDEX `fk_patients_doctors1_idx` (`doctor_id` ASC),
  INDEX `fk_patients_persons1_idx` (`person_id` ASC),
  CONSTRAINT `fk_patients_doctors1`
    FOREIGN KEY (`doctor_id`)
    REFERENCES `health_it2`.`doctors` (`doctor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_patients_persons1`
    FOREIGN KEY (`person_id`)
    REFERENCES `health_it2`.`persons` (`person_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `health_it2`.` patients_disease_forms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `health_it2`.` patients_disease_forms` (
  `patients_do_questions_id` INT NOT NULL,
  `question_id` INT NOT NULL,
  `registration_date` DATE NULL,
  `patient_id` INT NOT NULL,
  PRIMARY KEY (`patients_do_questions_id`),
  INDEX `fk_patients_do_questions_questions1_idx` (`question_id` ASC),
  INDEX `fk_patients_do_questions_patients1_idx` (`patient_id` ASC),
  CONSTRAINT `fk_patients_do_questions_questions1`
    FOREIGN KEY (`question_id`)
    REFERENCES `health_it2`.`disease_forms` (`question_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_patients_do_questions_patients1`
    FOREIGN KEY (`patient_id`)
    REFERENCES `health_it2`.`patients` (`patient_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `category` ;

CREATE TABLE IF NOT EXISTS `category` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Category ID',
  `parent` INT NULL COMMENT 'Category parent ID',
  `name` VARCHAR(100) NOT NULL COMMENT 'Category name',
  `webname` VARCHAR(100) NOT NULL COMMENT 'Category url name',
  `active` SMALLINT NOT NULL DEFAULT 1 COMMENT 'Category flag',
  `order` SMALLINT NOT NULL COMMENT 'Category created',
  `created` TIMESTAMP NOT NULL DEFAULT now() COMMENT 'Created date',
  `modified` TIMESTAMP NULL COMMENT 'Modified date',
  `deleted` TIMESTAMP NULL COMMENT 'Deleted date',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_unique` (`name` ASC),
  INDEX `parent_index` (`parent` ASC),
  CONSTRAINT `category_parent_key`
    FOREIGN KEY (`parent`)
    REFERENCES `category` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Categories table';


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user` ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'User ID',
  `login` VARCHAR(100) NOT NULL COMMENT 'User login',
  `password` CHAR(60) NOT NULL COMMENT 'User bcrypt pass',
  `role` VARCHAR(100) NOT NULL COMMENT 'User role',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'Users table\n';


-- -----------------------------------------------------
-- Table `file_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `file_type` ;

CREATE TABLE IF NOT EXISTS `file_type` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'File type ID',
  `name` VARCHAR(50) NOT NULL COMMENT 'Name of file',
  `direcotry` VARCHAR(150) NOT NULL COMMENT 'Direcotry in file structure',
  `width` INT NULL COMMENT 'Image witdh',
  `height` INT NULL COMMENT 'Image height',
  `isimage` TINYINT(1) NOT NULL DEFAULT true COMMENT 'Is file image',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'Type of files';


-- -----------------------------------------------------
-- Table `file`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `file` ;

CREATE TABLE IF NOT EXISTS `file` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'File ID',
  `filename` VARCHAR(150) NOT NULL COMMENT 'File name',
  `file_type_id` INT NOT NULL COMMENT 'File type ID',
  `created` TIMESTAMP NOT NULL DEFAULT now() COMMENT 'Created date',
  `modified` TIMESTAMP NULL COMMENT 'Modified date',
  `deleted` TIMESTAMP NULL COMMENT 'Deleted date',
  PRIMARY KEY (`id`),
  INDEX `a_idx` (`file_type_id` ASC),
  CONSTRAINT `file_type_key`
    FOREIGN KEY (`file_type_id`)
    REFERENCES `file_type` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Files storage';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

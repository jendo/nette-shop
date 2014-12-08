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
  `directory` VARCHAR(150) NOT NULL COMMENT 'Direcotry in file structure',
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
  `main` INT NOT NULL DEFAULT 0 COMMENT 'Is main product file ?',
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


-- -----------------------------------------------------
-- Table `product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `product` ;

CREATE TABLE IF NOT EXISTS `product` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Product ID',
  `name` VARCHAR(150) NOT NULL COMMENT 'Product name',
  `webname` VARCHAR(150) NOT NULL COMMENT 'Name in URL',
  `price` DECIMAL(10,4) NOT NULL COMMENT 'Price without DPH',
  `description` TEXT NULL COMMENT 'Product description',
  `created` DATETIME NULL DEFAULT now() COMMENT 'Created date',
  `modified` DATETIME NULL COMMENT 'Last modified date',
  `deleted` DATETIME NULL COMMENT 'Deteled date',
  `new` TINYINT NOT NULL DEFAULT 0 COMMENT 'Is product new ?',
  `top` TINYINT NOT NULL DEFAULT 0 COMMENT 'Is top product ?',
  `avaible` TINYINT NOT NULL DEFAULT 1 COMMENT 'Is avaible ?',
  `active` TINYINT NOT NULL DEFAULT 1 COMMENT 'Is active ?',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'Products table';


-- -----------------------------------------------------
-- Table `product_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `product_category` ;

CREATE TABLE IF NOT EXISTS `product_category` (
  `product_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`product_id`, `category_id`),
  INDEX `b_idx` (`category_id` ASC),
  CONSTRAINT `fk_product`
    FOREIGN KEY (`product_id`)
    REFERENCES `product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_category`
    FOREIGN KEY (`category_id`)
    REFERENCES `category` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `file_product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `file_product` ;

CREATE TABLE IF NOT EXISTS `file_product` (
  `product_id` INT NOT NULL COMMENT 'Product ID',
  `file_id` INT NOT NULL COMMENT 'File ID',
  PRIMARY KEY (`product_id`, `file_id`),
  INDEX `b_idx` (`file_id` ASC),
  CONSTRAINT `fk_product_file_product`
    FOREIGN KEY (`product_id`)
    REFERENCES `product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_product_file_file`
    FOREIGN KEY (`file_id`)
    REFERENCES `file` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

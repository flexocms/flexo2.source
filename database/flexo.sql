SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `flexo` ;
CREATE SCHEMA IF NOT EXISTS `flexo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `flexo` ;

-- -----------------------------------------------------
-- Table `flexo`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NULL ,
  `email` VARCHAR(255) NULL ,
  `login` VARCHAR(40) NULL ,
  `password` VARCHAR(40) NULL ,
  `salt` VARCHAR(45) NULL ,
  `language` VARCHAR(5) NULL ,
  `created_on` DATETIME NULL ,
  `created_by_id` INT NULL ,
  `updated_by_id` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flexo`.`permission`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`permission` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(25) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flexo`.`user_permission`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`user_permission` (
  `user_id` INT NULL ,
  `permission_id` INT NULL ,
  INDEX `fk_user_permission_1_idx` (`user_id` ASC) ,
  INDEX `fk_user_permission_2_idx` (`permission_id` ASC) ,
  CONSTRAINT `fk_user_permission_1`
    FOREIGN KEY (`user_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_permission_2`
    FOREIGN KEY (`permission_id` )
    REFERENCES `flexo`.`permission` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flexo`.`theme`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`theme` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NULL ,
  `is_active` ENUM('1','0') NULL DEFAULT '0' ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `created_by_id` INT NULL ,
  `updated_by_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_theme_1_idx` (`created_by_id` ASC) ,
  INDEX `fk_theme_2_idx` (`updated_by_id` ASC) ,
  CONSTRAINT `fk_theme_1`
    FOREIGN KEY (`created_by_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_theme_2`
    FOREIGN KEY (`updated_by_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flexo`.`layout`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`layout` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NULL ,
  `content_type` VARCHAR(40) NULL ,
  `filter` VARCHAR(25) NULL ,
  `content` LONGTEXT NULL ,
  `content_html` LONGTEXT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `theme_id` INT NOT NULL ,
  `created_by_id` INT NULL ,
  `updated_by_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_layout_1_idx` (`theme_id` ASC) ,
  INDEX `fk_layout_2_idx` (`created_by_id` ASC) ,
  INDEX `fk_layout_3_idx` (`updated_by_id` ASC) ,
  CONSTRAINT `fk_layout_1`
    FOREIGN KEY (`theme_id` )
    REFERENCES `flexo`.`theme` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_layout_2`
    FOREIGN KEY (`created_by_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_layout_3`
    FOREIGN KEY (`updated_by_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flexo`.`page`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`page` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NULL ,
  `slug` VARCHAR(100) NULL ,
  `breadcrumb` VARCHAR(160) NULL ,
  `keywords` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `parent_id` INT NULL ,
  `layout_id` INT NULL ,
  `behavior` VARCHAR(25) NULL ,
  `status` INT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `published_on` DATETIME NULL ,
  `position` INT NULL ,
  `created_by_id` INT NULL ,
  `updated_by_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_page_1_idx` (`created_by_id` ASC) ,
  INDEX `fk_page_2_idx` (`updated_by_id` ASC) ,
  INDEX `fk_page_3_idx` (`layout_id` ASC) ,
  INDEX `fk_page_page_1_idx` (`parent_id` ASC) ,
  CONSTRAINT `fk_page_user_1`
    FOREIGN KEY (`created_by_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_page_user_2`
    FOREIGN KEY (`updated_by_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_page_layout`
    FOREIGN KEY (`layout_id` )
    REFERENCES `flexo`.`layout` (`id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_page_page_1`
    FOREIGN KEY (`parent_id` )
    REFERENCES `flexo`.`page` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flexo`.`javascript`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`javascript` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `content` LONGTEXT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `theme_id` INT NOT NULL ,
  `created_by_id` INT NULL ,
  `updated_by_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_javascript_1_idx` (`created_by_id` ASC) ,
  INDEX `fk_javascript_2_idx` (`updated_by_id` ASC) ,
  INDEX `fk_javascript_3_idx` (`theme_id` ASC) ,
  CONSTRAINT `fk_javascript_1`
    FOREIGN KEY (`created_by_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_javascript_2`
    FOREIGN KEY (`updated_by_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_javascript_3`
    FOREIGN KEY (`theme_id` )
    REFERENCES `flexo`.`theme` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flexo`.`stylesheet`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`stylesheet` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `content` LONGTEXT NULL ,
  `media_type` INT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `theme_id` INT NOT NULL ,
  `created_by_id` INT NULL ,
  `updated_by_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_stylesheet_1_idx` (`created_by_id` ASC) ,
  INDEX `fk_stylesheet_2_idx` (`updated_by_id` ASC) ,
  INDEX `fk_stylesheet_3_idx` (`theme_id` ASC) ,
  CONSTRAINT `fk_stylesheet_1`
    FOREIGN KEY (`created_by_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE SET NULL,
  CONSTRAINT `fk_stylesheet_2`
    FOREIGN KEY (`updated_by_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE SET NULL,
  CONSTRAINT `fk_stylesheet_3`
    FOREIGN KEY (`theme_id` )
    REFERENCES `flexo`.`theme` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flexo`.`layout_javascript`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`layout_javascript` (
  `layout_id` INT NULL ,
  `javascript_id` INT NULL ,
  INDEX `fk_layout_javascript_1_idx` (`layout_id` ASC) ,
  INDEX `fk_layout_javascript_2_idx` (`javascript_id` ASC) ,
  CONSTRAINT `fk_layout_javascript_1`
    FOREIGN KEY (`layout_id` )
    REFERENCES `flexo`.`layout` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_layout_javascript_2`
    FOREIGN KEY (`javascript_id` )
    REFERENCES `flexo`.`javascript` (`id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flexo`.`layout_stylesheet`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`layout_stylesheet` (
  `layout_id` INT NULL ,
  `stylesheet_id` INT NULL ,
  INDEX `fk_layout_stylesheet_1_idx` (`layout_id` ASC) ,
  INDEX `fk_layout_stylesheet_2_idx` (`stylesheet_id` ASC) ,
  CONSTRAINT `fk_layout_stylesheet_1`
    FOREIGN KEY (`layout_id` )
    REFERENCES `flexo`.`layout` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_layout_stylesheet_2`
    FOREIGN KEY (`stylesheet_id` )
    REFERENCES `flexo`.`stylesheet` (`id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flexo`.`page_part`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`page_part` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NULL ,
  `filter` VARCHAR(25) NULL ,
  `content` LONGTEXT NULL ,
  `content_html` LONGTEXT NULL ,
  `page_id` INT NULL ,
  `is_protected` ENUM('1','0') NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_page_part_1_idx` (`page_id` ASC) ,
  CONSTRAINT `fk_page_part_1`
    FOREIGN KEY (`page_id` )
    REFERENCES `flexo`.`page` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flexo`.`snippet`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `flexo`.`snippet` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `slug` VARCHAR(100) NULL ,
  `filter` VARCHAR(25) NULL ,
  `content` LONGTEXT NULL ,
  `content_html` LONGTEXT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `created_on_id` INT NULL ,
  `updated_on_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_snippet_1_idx` (`created_on_id` ASC) ,
  INDEX `fk_snippet_2_idx` (`updated_on_id` ASC) ,
  CONSTRAINT `fk_snippet_1`
    FOREIGN KEY (`created_on_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_snippet_2`
    FOREIGN KEY (`updated_on_id` )
    REFERENCES `flexo`.`user` (`id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

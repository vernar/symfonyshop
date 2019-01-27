create DATABASE `les_symfonyshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
use `les_symfonyshop`;

CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`product` (
  `product_id` INT NOT NULL AUTO_INCREMENT ,
  `enable` BOOLEAN NOT NULL ,
  `sku` VARCHAR(100) NOT NULL ,
  `name` VARCHAR(200) NOT NULL ,
  `price` FLOAT NOT NULL ,
  `special_price` FLOAT NOT NULL ,
  `attributeset` INT NOT NULL ,
  `create_date` DATE NOT NULL ,
  `description` TEXT NOT NULL ,
  `url_key` VARCHAR(200) NOT NULL ,
  `weight` INT NOT NULL ,
  `image` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`product_id`),
  UNIQUE (`sku`)) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`category` (
  `category_id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(200) NOT NULL ,
  `sort_order` INT DEFAULT 0,
  PRIMARY KEY (`category_id`)) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`eav_product_category` (
  `product_id` INT NOT NULL ,
  `category_id` INT NOT NULL ) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`attribute` (
  `attribute_id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(200) NOT NULL ,
  `type` VARCHAR(50) NOT NULL ,
  `default_value_id` INT NOT NULL ,
  PRIMARY KEY (`attribute_id`)) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`eav_attribute_values` (
  `product_id` INT NOT NULL ,
  `attribute_id` INT NOT NULL ,
  `value` VARCHAR(50) NOT NULL) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`attributeset` (
  `attributeset_id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`attributeset_id`)) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`eav_attributeset_values` (
  `product_id` INT NOT NULL ,
  `attributeset_id` INT NOT NULL) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`customer` (
  `customer_id` INT NOT NULL AUTO_INCREMENT ,
  `is_confirmed` BOOLEAN NOT NULL ,
  `name` VARCHAR(200) NOT NULL ,
  `password` VARCHAR(50) NOT NULL ,
  `email` VARCHAR(200) NOT NULL ,
  `address` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`customer_id`)) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`order` (
  `order_id` INT NOT NULL AUTO_INCREMENT ,
  `customer_id` INT NOT NULL,
  `status` VARCHAR(100) NOT NULL ,
  `create_date` DATE NOT NULL ,
  `price` FLOAT NOT NULL ,
  `discount` FLOAT NOT NULL ,
  `shipping_price` FLOAT NOT NULL ,
  `total_price` FLOAT NOT NULL ,
  PRIMARY KEY (`order_id`)) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`order_item` (
  `order_item_id` INT NOT NULL AUTO_INCREMENT ,
  `order_id` INT NOT NULL ,
  `product_id` INT NOT NULL ,
  `sku` VARCHAR(100) NOT NULL ,
  `product_name` VARCHAR(200) NOT NULL ,
  `original_price` FLOAT NOT NULL ,
  `discount` FLOAT NOT NULL ,
  `total_price` FLOAT NOT NULL ,
  `quantity` INT NOT NULL ,
  PRIMARY KEY (`order_item_id`)) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`adminuser` (
  `adminuser_id` INT NOT NULL AUTO_INCREMENT ,
  `password` VARCHAR(50) NOT NULL ,
  `email` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`adminuser_id`)) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `les_symfonyshop`.`newslatter` (
  `newslatter_id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(200) NOT NULL ,
  `customer_id` INT DEFAULT 0,
  `is_confirmed` BOOLEAN NOT NULL ,
  PRIMARY KEY (`newslatter_id`)) ENGINE = InnoDB;

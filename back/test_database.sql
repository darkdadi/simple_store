-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `test_database`;
CREATE DATABASE `test_database` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test_database`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `sample_module`;
CREATE TABLE `sample_module` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `generated_id` varchar(8) NOT NULL,
  `item_name` varchar(25) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `generated_id` (`generated_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` varchar(10) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(60) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 - active, 0 - inactive',
  `row_id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2020-09-30 13:15:03

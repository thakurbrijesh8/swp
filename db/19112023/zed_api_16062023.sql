-- Adminer 4.8.1 MySQL 5.5.5-10.4.17-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `business`;
CREATE TABLE `business` (
  `business_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `udyam_number` varchar(30) NOT NULL,
  `certificate_number` varchar(30) NOT NULL,
  `zed_api_id` int(11) NOT NULL,
  `unit_name` text NOT NULL,
  `unit_address` text NOT NULL,
  `unit_pin` varchar(10) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `district_name` varchar(100) NOT NULL,
  `district_code` int(11) NOT NULL,
  `certification_date` varchar(10) NOT NULL,
  `expiry_date` varchar(10) NOT NULL,
  `is_bronze_certified` varchar(3) NOT NULL,
  `is_silver_certified` varchar(3) NOT NULL,
  `is_gold_certified` varchar(3) NOT NULL,
  `certification_fees` decimal(10,2) NOT NULL,
  `subsidy_amount` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`business_id`),
  KEY `udyam_number` (`udyam_number`),
  KEY `certificate_number` (`certificate_number`),
  KEY `unit_name` (`unit_name`(1024)),
  KEY `unit_address` (`unit_address`(1024)),
  KEY `unit_pin` (`unit_pin`),
  KEY `state_name` (`state_name`),
  KEY `district_name` (`district_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `zed_api`;
CREATE TABLE `zed_api` (
  `zed_api_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `udyam_number` varchar(30) NOT NULL,
  `certificate_number` varchar(30) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `zed_status` tinyint(1) NOT NULL,
  `zed_message` text NOT NULL,
  `zed_response` text NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`zed_api_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2023-06-16 17:59:56
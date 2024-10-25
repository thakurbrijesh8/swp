-- Adminer 4.8.1 MySQL 10.4.32-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `pan`;
CREATE TABLE `pan` (
  `pan_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pan_api_id` int(11) NOT NULL,
  `pan_number` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `father_name` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`pan_id`),
  KEY `user_id` (`user_id`),
  KEY `pan_api_id` (`pan_api_id`),
  KEY `pan_number` (`pan_number`),
  KEY `is_delete` (`is_delete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `pan_api`;
CREATE TABLE `pan_api` (
  `pan_api_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `h_records_counts` tinyint(1) NOT NULL,
  `h_request_time` datetime NOT NULL,
  `h_transaction_id` varchar(40) NOT NULL,
  `h_version` tinyint(1) NOT NULL,
  `p_pan_data` text NOT NULL,
  `p_signature` text NOT NULL,
  `api_status` tinyint(1) NOT NULL,
  `api_message` varchar(200) NOT NULL,
  `response_code` tinyint(1) NOT NULL,
  `response_data` text NOT NULL,
  `response_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`pan_api_id`),
  KEY `user_id` (`user_id`),
  KEY `response_code` (`response_code`),
  KEY `is_delete` (`is_delete`),
  CONSTRAINT `pan_api_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `pan_api_rd`;
CREATE TABLE `pan_api_rd` (
  `pan_api_rd_id` int(11) NOT NULL AUTO_INCREMENT,
  `pan_api_id` int(11) NOT NULL,
  `pan_number` varchar(10) NOT NULL,
  `pan_status` varchar(2) NOT NULL,
  `name` varchar(1) NOT NULL,
  `father_name` varchar(1) NOT NULL,
  `dob` varchar(1) NOT NULL,
  `seeding_status` varchar(2) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`pan_api_rd_id`),
  KEY `pan_api_id` (`pan_api_id`),
  KEY `is_delete` (`is_delete`),
  CONSTRAINT `pan_api_rd_ibfk_1` FOREIGN KEY (`pan_api_id`) REFERENCES `pan_api` (`pan_api_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- 2024-10-25 10:36:44
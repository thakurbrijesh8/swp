-- Adminer 4.8.1 MySQL 5.5.5-10.4.17-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `fees_payment_dv`;
CREATE TABLE `fees_payment_dv` (
  `fees_payment_dv_id` int(11) NOT NULL AUTO_INCREMENT,
  `fees_payment_id` int(11) NOT NULL,
  `dv_type` tinyint(1) NOT NULL,
  `dv_start_datetime` datetime NOT NULL,
  `dv_end_datetime` datetime NOT NULL,
  `dv_return` text NOT NULL,
  `dv_reference_id` tinytext NOT NULL,
  `dv_status` tinyint(1) NOT NULL,
  `dv_pg_status` tinyint(1) NOT NULL,
  `dv_order_number` text NOT NULL,
  `dv_amount` decimal(10,0) NOT NULL,
  `dv_message` varchar(200) NOT NULL,
  `dv_bank_code` varchar(20) NOT NULL,
  `dv_bank_ref_number` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`fees_payment_dv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- 2022-05-03 15:51:46
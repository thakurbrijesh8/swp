-- Adminer 4.8.1 MySQL 5.5.5-10.4.17-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `nil_certificate`;
CREATE TABLE `nil_certificate` (
  `nil_certificate_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `village_dmc_ward` int(11) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `applicant_name` varchar(200) NOT NULL,
  `applicant_address` varchar(200) NOT NULL,
  `applicant_mobile_number` varchar(10) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `property_detail` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`nil_certificate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP VIEW IF EXISTS `view_get_ds_wise_nil_certificate_count`;
CREATE TABLE `view_get_ds_wise_nil_certificate_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_nil_certificate_count`;
CREATE TABLE `view_get_status_wise_nil_certificate_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP TABLE IF EXISTS `view_get_ds_wise_nil_certificate_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_nil_certificate_count` AS select `nil_certificate`.`district` AS `district`,`nil_certificate`.`user_id` AS `user_id`,`nil_certificate`.`query_status` AS `query_status`,`nil_certificate`.`status` AS `status`,count(`nil_certificate`.`nil_certificate_id`) AS `total_records`,sum(`nil_certificate`.`processing_days`) AS `total_processing_days`,`nil_certificate`.`processing_days` AS `processing_days` from `nil_certificate` where `nil_certificate`.`is_delete` <> 1 and `nil_certificate`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `nil_certificate`.`district`,`nil_certificate`.`user_id`,`nil_certificate`.`query_status`,`nil_certificate`.`status`,`nil_certificate`.`processing_days`;

DROP TABLE IF EXISTS `view_get_status_wise_nil_certificate_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_nil_certificate_count` AS select `nil_certificate`.`status` AS `status`,count(`nil_certificate`.`nil_certificate_id`) AS `total_records`,sum(`nil_certificate`.`processing_days`) AS `total_processing_days`,`nil_certificate`.`processing_days` AS `processing_days` from `nil_certificate` where `nil_certificate`.`is_delete` <> 1 and `nil_certificate`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `nil_certificate`.`status`,`nil_certificate`.`processing_days` order by count(`nil_certificate`.`nil_certificate_id`) desc;

-- 2022-11-22 11:06:36
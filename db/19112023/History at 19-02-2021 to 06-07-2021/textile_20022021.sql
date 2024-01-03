SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `textile`;
CREATE TABLE `textile` (
  `textile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `enterprise_name` varchar(200) NOT NULL,
  `office_address` varchar(200) NOT NULL,
  `factory_address` varchar(200) NOT NULL,
  `office_contact_number` varchar(20) NOT NULL,
  `factory_contact_number` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `cellphone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `constitution` tinyint(1) NOT NULL,
  `promoter_name` varchar(200) NOT NULL,
  `promoter_designation` varchar(200) NOT NULL,
  `promoter_contact_number` varchar(20) NOT NULL,
  `promoter_email` varchar(100) NOT NULL,
  `social_status` varchar(20) NOT NULL,
  `ap_name` varchar(200) NOT NULL,
  `ap_designation` varchar(200) NOT NULL,
  `ap_contact_number` varchar(20) NOT NULL,
  `ap_email` varchar(100) NOT NULL,
  `unit_type` tinyint(1) NOT NULL,
  `application_form_file` varchar(100) NOT NULL,
  `doc_1` varchar(100) NOT NULL,
  `doc_2` varchar(100) NOT NULL,
  `doc_3` varchar(100) NOT NULL,
  `doc_4` varchar(100) NOT NULL,
  `doc_5` varchar(100) NOT NULL,
  `doc_6` varchar(100) NOT NULL,
  `doc_7` varchar(100) NOT NULL,
  `doc_8` varchar(100) NOT NULL,
  `doc_9` varchar(100) NOT NULL,
  `doc_10` varchar(100) NOT NULL,
  `doc_11` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`textile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE OR REPLACE VIEW `view_get_ds_wise_textile_count` AS
select `swpdddgo_swpdb`.`textile`.`district` AS `district`,`swpdddgo_swpdb`.`textile`.`status` AS `status`,
count(`swpdddgo_swpdb`.`textile`.`textile_id`) AS `total_records`
from `textile` where `swpdddgo_swpdb`.`textile`.`is_delete` <> 1
group by `swpdddgo_swpdb`.`textile`.`district`,`swpdddgo_swpdb`.`textile`.`status`
order by count(`swpdddgo_swpdb`.`textile`.`textile_id`) desc;


CREATE OR REPLACE VIEW `view_get_status_wise_textile_count` AS
select `textile`.`status` AS `status`,count(`textile`.`textile_id`) AS `total_records`,
sum(`textile`.`processing_days`) AS `total_processing_days`,`textile`.`processing_days` AS `processing_days`
from `textile` where `textile`.`is_delete` <> 1
group by `textile`.`status`,`textile`.`processing_days`
order by count(`textile`.`textile_id`) desc;


ALTER TABLE `textile`
ADD `form_application_checklist` varchar(50) COLLATE 'utf8_general_ci' NOT NULL AFTER `unit_type`,
ADD `doc_12` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_11`,
ADD `doc_13` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_12`,
ADD `doc_14` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_13`,
ADD `doc_15` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_14`,
ADD `doc_16` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_15`,
ADD `doc_17` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_16`;
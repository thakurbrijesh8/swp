-- Adminer 4.8.1 MySQL 5.5.5-10.4.17-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ips`;
CREATE TABLE `ips` (
  `ips_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `owner_category` tinyint(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `aadhar_no` varchar(12) NOT NULL,
  `pan_no` varchar(15) NOT NULL,
  `caste_category` tinyint(1) NOT NULL,
  `ap_name` varchar(100) NOT NULL,
  `ap_designation` varchar(100) NOT NULL,
  `ap_contact_number` varchar(10) NOT NULL,
  `ap_email` varchar(100) NOT NULL,
  `ap_mobile` varchar(10) NOT NULL,
  `udhyam_registration` varchar(100) NOT NULL,
  `regi_details` varchar(100) NOT NULL,
  `roc_registration` varchar(100) NOT NULL,
  `cin_registration` varchar(100) NOT NULL,
  `manu_name` varchar(100) NOT NULL,
  `main_plant_address` varchar(100) NOT NULL,
  `office_address` varchar(100) NOT NULL,
  `constitution` tinyint(1) NOT NULL,
  `other_constitution` varchar(100) NOT NULL,
  `unit_category` tinyint(1) NOT NULL,
  `msme_category` tinyint(1) NOT NULL,
  `unit_doc` varchar(100) NOT NULL,
  `non_msme_doc` varchar(100) NOT NULL,
  `entrepreneur_category` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `birth_doc` varchar(100) NOT NULL,
  `unit_type` varchar(50) NOT NULL,
  `manufacuring_unit` varchar(100) NOT NULL,
  `diversification_unit` varchar(100) NOT NULL,
  `service_unit` varchar(100) NOT NULL,
  `diversification_service` varchar(100) NOT NULL,
  `sector_category` tinyint(1) NOT NULL,
  `thrust_sectors` varchar(100) NOT NULL,
  `commencement_date` date NOT NULL,
  `gfc_investment` varchar(100) NOT NULL,
  `udyam_regi_doc` varchar(100) NOT NULL,
  `partnership_deed_doc` varchar(100) NOT NULL,
  `enterprise_doc` varchar(100) NOT NULL,
  `ent_leased_doc` varchar(100) NOT NULL,
  `electricity_doc` varchar(100) NOT NULL,
  `authorization_doc` varchar(100) NOT NULL,
  `pcc_doc` varchar(100) NOT NULL,
  `factory_license_doc` varchar(100) NOT NULL,
  `clearnces_doc` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`ips_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ips_incentive`;
CREATE TABLE `ips_incentive` (
  `ips_incentive_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ips_id` int(11) NOT NULL,
  `scheme_type` tinyint(4) NOT NULL,
  `scheme` tinyint(4) NOT NULL,
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
  PRIMARY KEY (`ips_incentive_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ips_incentive_doc`;
CREATE TABLE `ips_incentive_doc` (
  `ips_incentive_doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `ips_incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ips_id` int(11) NOT NULL,
  `doc_id` tinyint(4) NOT NULL,
  `doc_name` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`ips_incentive_doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP VIEW IF EXISTS `view_get_ds_wise_ips_incentive_count`;
CREATE TABLE `view_get_ds_wise_ips_incentive_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));

DROP VIEW IF EXISTS `view_get_status_wise_ips_incentive_count`;
CREATE TABLE `view_get_status_wise_ips_incentive_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP TABLE IF EXISTS `view_get_ds_wise_ips_incentive_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_ips_incentive_count` AS select `i`.`district` AS `district`,`ii`.`user_id` AS `user_id`,`ii`.`query_status` AS `query_status`,`ii`.`status` AS `status`,count(`ii`.`ips_incentive_id`) AS `total_records`,sum(`ii`.`processing_days`) AS `total_processing_days`,`ii`.`processing_days` AS `processing_days` from (`ips_incentive` `ii` join `ips` `i` on(`i`.`ips_id` = `ii`.`ips_id`)) where `ii`.`is_delete` <> 1 group by `i`.`district`,`ii`.`user_id`,`ii`.`query_status`,`ii`.`status`,`ii`.`processing_days`;

DROP TABLE IF EXISTS `view_get_status_wise_ips_incentive_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_ips_incentive_count` AS select `ips_incentive`.`status` AS `status`,count(`ips_incentive`.`ips_incentive_id`) AS `total_records`,sum(`ips_incentive`.`processing_days`) AS `total_processing_days`,`ips_incentive`.`processing_days` AS `processing_days` from `ips_incentive` where `ips_incentive`.`is_delete` <> 1 group by `ips_incentive`.`status`,`ips_incentive`.`processing_days` order by count(`ips_incentive`.`ips_incentive_id`) desc;

-- 2022-09-15 09:02:51


--03-10-2022

ALTER TABLE `ips`
DROP `ap_contact_number`;

ALTER TABLE `ips`
CHANGE `udhyam_registration` `udyam_registration` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `ap_mobile`;

ALTER TABLE `ips`
DROP `cin_registration`;

ALTER TABLE `ips`
DROP `roc_registration`;

ALTER TABLE `ips`
ADD `ur_cin_no` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `regi_details`,
ADD `ur_cin_doc` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `ur_cin_no`,
ADD `ur_tin_no` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `ur_cin_doc`,
ADD `ur_tin_doc` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `ur_tin_no`,
ADD `ur_pan_no` varchar(10) COLLATE 'utf8_general_ci' NOT NULL AFTER `ur_tin_doc`,
ADD `ur_pan_doc` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `ur_pan_no`,
ADD `ur_gst_no` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `ur_pan_doc`,
ADD `ur_gst_doc` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `ur_gst_no`,
ADD `ur_other_reg_no` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `ur_gst_doc`,
ADD `ur_other_doc` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `ur_other_reg_no`;

DROP TABLE IF EXISTS `swp_admin_sessions`;
CREATE TABLE `swp_admin_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `swp_sessions`;
CREATE TABLE `swp_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
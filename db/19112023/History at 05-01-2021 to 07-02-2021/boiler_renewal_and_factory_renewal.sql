-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `boileract_renewal`;
CREATE TABLE `boileract_renewal` (
  `boiler_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `boiler_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `situation_of_boiler` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `ut` varchar(255) NOT NULL,
  `boiler_type` varchar(255) NOT NULL,
  `working_pressure` int(11) NOT NULL,
  `max_pressure` int(11) NOT NULL,
  `heating_surface_area` int(11) NOT NULL,
  `length_of_pipes` int(11) NOT NULL,
  `max_evaporation` varchar(255) NOT NULL,
  `place_of_manufacture` varchar(255) NOT NULL,
  `year_of_manufacture` int(11) NOT NULL,
  `name_of_manufacture` varchar(255) CHARACTER SET latin1 NOT NULL,
  `manufacture_address` varchar(255) CHARACTER SET latin1 NOT NULL,
  `hydraulically_tested_on` date NOT NULL,
  `hydraulically_tested_to` varchar(255) CHARACTER SET latin1 NOT NULL,
  `repairs` varchar(255) CHARACTER SET latin1 NOT NULL,
  `remarks` varchar(255) CHARACTER SET latin1 NOT NULL,
  `company_letter_head` varchar(255) CHARACTER SET latin1 NOT NULL,
  `copy_of_challan` varchar(255) CHARACTER SET latin1 NOT NULL,
  `last_boiler_license` varchar(255) CHARACTER SET latin1 NOT NULL,
  `sign_of_applicant` varchar(255) CHARACTER SET latin1 NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remark` varchar(255) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `processing_days` tinyint(1) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`boiler_renewal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `factorylicence_renewal`;
CREATE TABLE `factorylicence_renewal` (
  `factorylicence_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `factorylicence_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `name_of_factory` varchar(255) NOT NULL,
  `factory_address` varchar(255) NOT NULL,
  `factory_postal_address` varchar(255) NOT NULL,
  `max_no_of_worker_year` int(11) NOT NULL,
  `max_power_to_be_used` int(11) NOT NULL,
  `fee_paid_ammount` int(11) NOT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `receipt_date` date NOT NULL,
  `manager_detail` varchar(255) NOT NULL,
  `occupier_detail` varchar(255) NOT NULL,
  `sign_of_manager` varchar(255) NOT NULL,
  `sign_of_occupier` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` datetime NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `payment_type` tinyint(4) NOT NULL,
  `user_payment_type` tinyint(4) NOT NULL,
  `query_status` tinyint(4) NOT NULL,
  `processing_days` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`factorylicence_renewal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2020-12-30 14:00:55
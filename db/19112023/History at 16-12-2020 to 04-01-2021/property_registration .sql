-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `property_registration`;
CREATE TABLE `property_registration` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `party_type` tinyint(1) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `application_date` date NOT NULL,
  `date` date NOT NULL,
  `party_name` varchar(255) NOT NULL,
  `party_address` varchar(255) NOT NULL,
  `digit_mobile_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pan` tinyint(1) NOT NULL,
  `pan_card` varchar(255) NOT NULL,
  `aadhaar_card` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `set_appointment_date` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `property_registration` (`property_id`, `user_id`, `party_type`, `document_type`, `application_date`, `date`, `party_name`, `party_address`, `digit_mobile_number`, `email`, `pan`, `pan_card`, `aadhaar_card`, `document`, `set_appointment_date`, `signature`, `status`, `status_datetime`, `submitted_datetime`, `processing_days`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `admin_registration_number`, `valid_upto`, `remarks`, `query_status`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1,	1,	2,	'Mortgage_Deed',	'2020-12-16',	'2020-12-16',	'gfgdf',	'dfgfd',	'dfgdf',	'dfgdf',	0,	'property_3321139211608031635.png',	'property_7365595771608031635.png',	'property_2905724391608031635.pdf',	'',	'',	1,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	0,	'',	'0000-00-00 00:00:00',	'',	'0000-00-00 00:00:00',	'',	'0000-00-00',	'',	0,	1,	'2020-12-16 15:30:07',	1,	'2020-12-16 15:30:07',	0);

-- 2020-12-16 10:05:54
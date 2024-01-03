-- Date : 10/12/2020

ALTER TABLE `hotel_renewal`
ADD `challan_number` varchar(100) NOT NULL AFTER `challan_updated_date`;

ALTER TABLE `travelagent_renewal`
ADD `challan_number` varchar(100) NOT NULL AFTER `challan_updated_date`;

-- Date : 08/12/2020
-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `tourismevent`;
CREATE TABLE `tourismevent` (
  `tourismevent_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_person` varchar(100) NOT NULL,
  `location_of_event` varchar(100) NOT NULL,
  `date_of_event` date NOT NULL,
  `time_of_event` varchar(10) NOT NULL,
  `duration_of_event` varchar(100) NOT NULL,
  `proposal_details_document` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`tourismevent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2020-12-08 06:35:30

-- Date : 05/12/2020
ALTER TABLE `travelagent`
ADD `last_valid_upto` date NOT NULL AFTER `valid_upto`;

-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `travelagent_renewal`;
CREATE TABLE `travelagent_renewal` (
  `travelagent_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `travelagent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_travel_agency` varchar(100) NOT NULL,
  `address_of_agency` varchar(200) NOT NULL,
  `name_of_proprietor` varchar(100) NOT NULL,
  `fees` varchar(10) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `last_valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`travelagent_renewal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2020-12-05 06:54:01


-- Date : 04/12/20
ALTER TABLE `hotel_renewal`
ADD `fees` varchar(10) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `new_employees_details`;

ALTER TABLE `travelagent`
ADD `fees` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `area_of_agency`;

-- Date : 02/12/20
ALTER TABLE `hotel`
ADD `last_valid_upto` date NOT NULL AFTER `valid_upto`;

-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `hotel_renewal`;
CREATE TABLE `hotel_renewal` (
  `hotel_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `hotelregi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_hotel` varchar(100) NOT NULL,
  `name_of_proprietor` varchar(100) NOT NULL,
  `new_employees_details` varchar(200) NOT NULL,
  `noc_fire` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `last_valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`hotel_renewal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2020-12-02 12:59:40
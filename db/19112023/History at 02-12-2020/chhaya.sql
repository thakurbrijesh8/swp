-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `travelagent`;
CREATE TABLE `travelagent` (
  `travelagent_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_person` varchar(100) NOT NULL,
  `name_of_travel_agency` varchar(100) NOT NULL,
  `address_of_agency` varchar(100) NOT NULL,
  `area_of_agency` varchar(100) NOT NULL,
  `copy_of_registration` varchar(100) NOT NULL,
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
  PRIMARY KEY (`travelagent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2020-11-28 11:40:01

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE `hotel` (
  `hotelregi_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_hotel` varchar(100) NOT NULL,
  `name_of_person` varchar(100) NOT NULL,
  `full_address` varchar(100) NOT NULL,
  `name_of_tourist_area` varchar(100) NOT NULL,
  `name_of_proprietor` varchar(100) NOT NULL,
  `category_of_hotel` varchar(100) CHARACTER SET utf8 NOT NULL,
  `fees` varchar(10) CHARACTER SET utf8 NOT NULL,
  `name_of_manager` varchar(100) NOT NULL,
  `manager_permanent_address` varchar(100) NOT NULL,
  `name_of_agent` text NOT NULL,
  `permanent_resident_of_ut` tinyint(1) NOT NULL,
  `other_business_of_applicant` tinyint(1) NOT NULL,
  `hotel_rented_or_leased` tinyint(1) NOT NULL,
  `leased_date` date NOT NULL,
  `site_plan` varchar(100) NOT NULL,
  `construction_plan` varchar(100) NOT NULL,
  `occupancy_certificate` varchar(100) NOT NULL,
  `noc_medical` varchar(100) NOT NULL,
  `noc_concerned` varchar(100) NOT NULL,
  `noc_electricity` varchar(100) NOT NULL,
  `aadhar_card_homestay` varchar(100) NOT NULL,
  `form_xiv_homestay` varchar(100) NOT NULL,
  `site_plan_homestay` varchar(100) NOT NULL,
  `na_order_homestay` varchar(100) NOT NULL,
  `completion_certificate_homestay` varchar(100) NOT NULL,
  `house_tax_receipt_homestay` varchar(100) NOT NULL,
  `electricity_bill_homestay` varchar(100) NOT NULL,
  `noc_fire` varchar(100) NOT NULL,
  `police_clearance_certificate` varchar(100) NOT NULL,
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
  PRIMARY KEY (`hotelregi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2020-11-28 05:34:07
-- ALTER TABLE `hotel`
-- ADD `site_plan_homestay` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `form_xiv_homestay`;
-- 
-- ALTER TABLE `hotel`
-- CHANGE `name_of_hotel` `name_of_hotel` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `user_id`,
-- CHANGE `name_of_person` `name_of_person` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `name_of_hotel`,
-- CHANGE `full_address` `full_address` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `name_of_person`,
-- CHANGE `name_of_tourist_area` `name_of_tourist_area` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `full_address`,
-- CHANGE `name_of_proprietor` `name_of_proprietor` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `name_of_tourist_area`,
-- CHANGE `category_of_accommodation` `category_of_hotel` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `name_of_proprietor`,
-- ADD `fees` varchar(10) COLLATE 'utf8_general_ci' NOT NULL AFTER `category_of_hotel`;
-- 
-- ALTER TABLE `hotel`
-- DROP `application_form`,
-- CHANGE `copies_of_form` `construction_plan` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `site_plan`,
-- DROP `sale_deed_purchase`,
-- CHANGE `noc_medical` `noc_medical` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `occupancy_certificate`,
-- CHANGE `noc_concerned` `noc_concerned` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `noc_medical`,
-- CHANGE `noc_electricity` `noc_electricity` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `noc_concerned`,
-- ADD `aadhar_card_homestay` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `noc_electricity`,
-- ADD `form_xiv_homestay` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `aadhar_card_homestay`,
-- ADD `na_order_homestay` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `form_xiv_homestay`,
-- ADD `completion_certificate_homestay` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `na_order_homestay`,
-- ADD `house_tax_receipt_homestay` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `completion_certificate_homestay`,
-- ADD `electricity_bill_homestay` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `house_tax_receipt_homestay`,
-- CHANGE `noc_fire` `noc_fire` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `electricity_bill_homestay`,
-- CHANGE `police_clearance_certificate` `police_clearance_certificate` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `noc_fire`;

-- ALTER TABLE `hotel`
-- CHANGE `police_verification_report` `police_clearance_certificate` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `noc_electricity`;

ALTER TABLE `hotel`
ADD `application_form` varchar(100) NOT NULL AFTER `leased_date`;

ALTER TABLE `hotel`
ADD `site_plan` varchar(100) NOT NULL AFTER `leased_date`,
ADD `copies_of_form` varchar(100) NOT NULL AFTER `site_plan`,
ADD `occupancy_certificate` varchar(100) NOT NULL AFTER `copies_of_form`,
ADD `sale_deed_purchase` varchar(100) NOT NULL AFTER `occupancy_certificate`,
ADD `noc_fire` varchar(100) NOT NULL AFTER `sale_deed_purchase`,
ADD `noc_medical` varchar(100) NOT NULL AFTER `noc_fire`,
ADD `noc_concerned` varchar(100) NOT NULL AFTER `noc_medical`,
ADD `noc_electricity` varchar(100) NOT NULL AFTER `noc_concerned`,
ADD `police_verification_report` varchar(100) NOT NULL AFTER `noc_electricity`;

ALTER TABLE `hotel`
ADD `category_of_accommodation` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `user_id`;

ALTER TABLE `hotel`
ADD `submitted_datetime` datetime NOT NULL AFTER `signature`;

ALTER TABLE `cinema`
ADD `submitted_datetime` datetime NOT NULL AFTER `signature`;

ALTER TABLE `wc`
ADD `submitted_datetime` datetime NOT NULL AFTER `signature`;

ALTER TABLE `cinema`
ADD `query_status` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `hotel`
ADD `query_status` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `wc`
ADD `query_status` tinyint(1) NOT NULL AFTER `remarks`;
-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `wc`;
CREATE TABLE `wc` (
  `wc_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `house_no` varchar(100) NOT NULL,
  `ward_no` varchar(100) NOT NULL,
  `village` varchar(100) NOT NULL,
  `panchayat_or_dmc` varchar(100) NOT NULL,
  `application_category` varchar(100) NOT NULL,
  `receipt_of_last_years_house_tax` varchar(100) NOT NULL,
  `house_ownership` varchar(100) NOT NULL,
  `wc_type` varchar(100) NOT NULL,
  `diameter_service_connection` varchar(100) NOT NULL,
  `water_meter` varchar(100) NOT NULL,
  `id_proof` varchar(100) NOT NULL,
  `electricity_bill` varchar(100) NOT NULL,
  `declaration` tinyint(1) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`wc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cinema`;
CREATE TABLE `cinema` (
  `cinema_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) CHARACTER SET utf8 NOT NULL,
  `father_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `dob` date NOT NULL,
  `permanent_address` text CHARACTER SET utf8 NOT NULL,
  `temporary_address` text CHARACTER SET utf8 NOT NULL,
  `video_cassette_recorder` varchar(100) CHARACTER SET utf8 NOT NULL,
  `is_case_of_building` tinyint(1) NOT NULL,
  `plan_of_building_document` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name_of_building` varchar(100) CHARACTER SET utf8 NOT NULL,
  `place_of_building` varchar(100) CHARACTER SET utf8 NOT NULL,
  `distance_of_building` varchar(100) CHARACTER SET utf8 NOT NULL,
  `character_licence_certificate` varchar(100) CHARACTER SET utf8 NOT NULL,
  `photo_state_copy` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ownership_document` varchar(100) CHARACTER SET utf8 NOT NULL,
  `motor_vehicles_document` varchar(100) CHARACTER SET utf8 NOT NULL,
  `business_trade_authority_license` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tb_license_affected` varchar(100) CHARACTER SET utf8 NOT NULL,
  `building_as` varchar(100) CHARACTER SET utf8 NOT NULL,
  `auditorium_as` varchar(100) CHARACTER SET utf8 NOT NULL,
  `passages_and_gangways_as` varchar(100) CHARACTER SET utf8 NOT NULL,
  `urinals_and_wc_as` varchar(100) CHARACTER SET utf8 NOT NULL,
  `time_schedule_film` varchar(100) CHARACTER SET utf8 NOT NULL,
  `screen_width` varchar(100) CHARACTER SET utf8 NOT NULL,
  `signature` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `challan` varchar(100) CHARACTER SET utf8 NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) CHARACTER SET utf8 NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) CHARACTER SET utf8 NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) CHARACTER SET utf8 NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`cinema_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_esperanto_ci;


-- 2020-09-29 07:15:32

-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE `hotel` (
  `hotelregi_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_hotel` varchar(100) NOT NULL,
  `name_of_person` varchar(100) NOT NULL,
  `full_address` varchar(100) NOT NULL,
  `name_of_tourist_area` varchar(100) NOT NULL,
  `name_of_proprietor` varchar(100) NOT NULL,
  `name_of_manager` varchar(100) NOT NULL,
  `manager_permanent_address` varchar(100) NOT NULL,
  `name_of_agent` text NOT NULL,
  `permanent_resident_of_ut` tinyint(1) NOT NULL,
  `other_business_of_applicant` tinyint(1) NOT NULL,
  `hotel_rented_or_leased` tinyint(1) NOT NULL,
  `leased_date` date NOT NULL,
  `signature` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`hotelregi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2020-10-26 06:16:02
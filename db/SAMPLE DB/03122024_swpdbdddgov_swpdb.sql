-- Adminer 4.8.1 MySQL 10.4.32-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `all_villages`;
CREATE TABLE `all_villages` (
  `all_village_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_code` tinyint(4) NOT NULL,
  `district_code` int(11) NOT NULL,
  `village_code` int(11) NOT NULL,
  `village_version` tinyint(1) NOT NULL,
  `village_name` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`all_village_id`),
  KEY `state_code` (`state_code`),
  KEY `district_code` (`district_code`),
  KEY `village_code` (`village_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `appli_licence`;
CREATE TABLE `appli_licence` (
  `aplicence_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `contractor_name` varchar(100) NOT NULL,
  `contractor_fathername` varchar(100) NOT NULL,
  `contractor_address` varchar(255) NOT NULL,
  `contractor_contact` varchar(50) NOT NULL,
  `contractor_email` varchar(100) NOT NULL,
  `establi_name` varchar(100) NOT NULL,
  `establi_address` varchar(255) NOT NULL,
  `no_of_certificate` varchar(100) NOT NULL,
  `date_of_certificate` date NOT NULL,
  `employer_name` varchar(100) NOT NULL,
  `employer_address` varchar(100) NOT NULL,
  `nature_of_process_for_establi` varchar(255) NOT NULL,
  `nature_of_process_for_labour` varchar(255) NOT NULL,
  `duration_of_work` varchar(100) NOT NULL,
  `name_of_agent` varchar(100) NOT NULL,
  `address_of_agent` varchar(255) NOT NULL,
  `max_no_of_empl` varchar(100) NOT NULL,
  `if_contractor_work_other_place` tinyint(1) NOT NULL,
  `detail_of_other_work` varchar(255) NOT NULL,
  `estimeted_value` varchar(100) NOT NULL,
  `formv_doc` varchar(255) NOT NULL,
  `formiv_doc` varchar(255) NOT NULL,
  `register_certification_doc` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `fees` int(5) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`aplicence_id`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `contractor_name` (`contractor_name`),
  KEY `nature_of_process_for_establi` (`nature_of_process_for_establi`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`),
  KEY `district` (`district`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `appli_licence_renewal`;
CREATE TABLE `appli_licence_renewal` (
  `aplicence_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `aplicence_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `license_number` varchar(100) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `contractor_name` varchar(100) NOT NULL,
  `contractor_address` varchar(255) NOT NULL,
  `contractor_contact` varchar(50) NOT NULL,
  `contractor_email` varchar(100) NOT NULL,
  `no_of_certificate` varchar(100) NOT NULL,
  `date_of_certificate` date NOT NULL,
  `expiry_date_of_prev_licence` date NOT NULL,
  `max_no_of_empl` varchar(100) NOT NULL,
  `licence_status` varchar(255) NOT NULL,
  `duration_of_work` varchar(100) NOT NULL,
  `establi_name` varchar(100) NOT NULL,
  `establi_address` varchar(100) NOT NULL,
  `formvii_doc` varchar(255) NOT NULL,
  `challan_copy` varchar(255) NOT NULL,
  `register_certification_doc` varchar(255) NOT NULL,
  `application_date` date NOT NULL,
  `signature` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `fees` int(5) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`aplicence_renewal_id`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `contractor_name` (`contractor_name`),
  KEY `establi_name` (`establi_name`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`),
  KEY `district` (`district`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `appointment_date` varchar(255) NOT NULL,
  `select_time` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `bocw`;
CREATE TABLE `bocw` (
  `bocw_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_location_of_est` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `postal_address_of_est` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name_address_of_est` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name_address_of_manager` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nature_of_building` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `max_num_building_workers` int(11) NOT NULL,
  `estimated_date_of_commencement` date NOT NULL,
  `estimated_date_of_completion` date NOT NULL,
  `workorder_copy` varchar(255) NOT NULL,
  `sign_of_principal_employee` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `is_labour_dept` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`bocw_id`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_location_of_est` (`name_location_of_est`),
  KEY `nature_of_building` (`nature_of_building`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`),
  KEY `district` (`district`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `boileract`;
CREATE TABLE `boileract` (
  `boiler_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `situation_of_boiler` varchar(255) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `ut` varchar(255) NOT NULL,
  `boiler_type` varchar(255) NOT NULL,
  `working_pressure` int(11) NOT NULL,
  `max_pressure` int(11) NOT NULL,
  `heating_surface_area` int(11) NOT NULL,
  `length_of_pipes` int(11) NOT NULL,
  `max_evaporation` varchar(255) NOT NULL,
  `place_of_manufacture` varchar(255) NOT NULL,
  `year_of_manufacture` int(11) NOT NULL,
  `name_of_manufacture` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `manufacture_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hydraulically_tested_on` date NOT NULL,
  `hydraulically_tested_to` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `repairs` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `remarks` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `company_letter_head` varchar(255) NOT NULL,
  `pipe_line_deawing` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `copy_of_challan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ibr_document` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sign_of_applicant` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`boiler_id`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `owner_name` (`owner_name`),
  KEY `boiler_type` (`boiler_type`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`),
  KEY `district` (`district`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `boileract_renewal`;
CREATE TABLE `boileract_renewal` (
  `boiler_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `boiler_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `situation_of_boiler` varchar(255) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `ut` varchar(255) NOT NULL,
  `boiler_type` varchar(255) NOT NULL,
  `working_pressure` int(11) NOT NULL,
  `max_pressure` int(11) NOT NULL,
  `heating_surface_area` int(11) NOT NULL,
  `length_of_pipes` int(11) NOT NULL,
  `max_evaporation` varchar(255) NOT NULL,
  `place_of_manufacture` varchar(255) NOT NULL,
  `year_of_manufacture` int(11) NOT NULL,
  `name_of_manufacture` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `manufacture_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hydraulically_tested_on` date NOT NULL,
  `hydraulically_tested_to` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `repairs` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `remarks` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `company_letter_head` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `copy_of_challan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `last_boiler_license` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sign_of_applicant` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `processing_days` tinyint(1) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`boiler_renewal_id`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `owner_name` (`owner_name`),
  KEY `boiler_type` (`boiler_type`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`),
  KEY `district` (`district`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `boilermanufactures`;
CREATE TABLE `boilermanufactures` (
  `boilermanufacture_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_firm` varchar(255) NOT NULL,
  `address_of_workshop` varchar(255) NOT NULL,
  `address_of_communication` varchar(255) NOT NULL,
  `type_of_jobs` varchar(255) NOT NULL,
  `tools_and_tackles` varchar(255) NOT NULL,
  `technical_personnel_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `welders_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `standard_of_work` varchar(255) NOT NULL,
  `is_full_work_done` tinyint(4) NOT NULL,
  `controversial_issue` varchar(255) NOT NULL,
  `is_internal_quality_control` tinyint(4) NOT NULL,
  `quality_control_detail` varchar(255) NOT NULL,
  `power_sanction` varchar(255) NOT NULL,
  `copy_of_noc` varchar(255) NOT NULL,
  `conversant_with_boiler` varchar(255) NOT NULL,
  `plan_of_workshop` varchar(255) NOT NULL,
  `is_instruments_calibrated` tinyint(4) NOT NULL,
  `instruments_calibrate_detail` varchar(255) NOT NULL,
  `testing_facility` varchar(255) NOT NULL,
  `recording_system` varchar(255) NOT NULL,
  `occupancy_certificate_copy` varchar(255) NOT NULL,
  `factory_license_copy` varchar(255) NOT NULL,
  `machinery_layout_copy` varchar(255) NOT NULL,
  `qualification_detail` varchar(255) NOT NULL,
  `shop_photograph_copy` varchar(255) NOT NULL,
  `signature_and_seal` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  PRIMARY KEY (`boilermanufacture_id`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_firm` (`name_of_firm`),
  KEY `address_of_workshop` (`address_of_workshop`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`),
  KEY `district` (`district`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `buildingplan`;
CREATE TABLE `buildingplan` (
  `buildingplan_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `applicant_phoneno` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `applicant_address` varchar(255) NOT NULL,
  `purpose_of_land_to_be_sold` varchar(255) NOT NULL,
  `factory_name` varchar(255) NOT NULL,
  `factory_building` varchar(255) NOT NULL,
  `factory_streetno` varchar(100) NOT NULL,
  `factory_city` varchar(255) NOT NULL,
  `factory_pincode` int(11) NOT NULL,
  `factory_district` varchar(255) NOT NULL,
  `factory_town` varchar(255) NOT NULL,
  `nearest_police_station` varchar(255) NOT NULL,
  `nrearest_railway_station` varchar(255) NOT NULL,
  `particulars_of_plant` varchar(255) NOT NULL,
  `date_of_application` date NOT NULL,
  `building_drawing_plans` varchar(255) NOT NULL,
  `provisional_registration` varchar(255) NOT NULL,
  `project_report` varchar(255) NOT NULL,
  `mode_of_storage` varchar(255) NOT NULL,
  `drawing_of_treatment_plant` varchar(255) NOT NULL,
  `machinery_layout` varchar(255) NOT NULL,
  `questionnaire_copy` varchar(255) NOT NULL,
  `upload_flow_chart` varchar(255) NOT NULL,
  `upload_site_plan` varchar(255) NOT NULL,
  `upload_elevation_document` varchar(255) NOT NULL,
  `sign_of_applicant` varchar(255) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`buildingplan_id`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `factory_name` (`factory_name`),
  KEY `factory_building` (`factory_building`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`),
  KEY `district` (`district`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `cfr`;
CREATE TABLE `cfr` (
  `cfr_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `landline_number` varchar(15) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `feedback` text NOT NULL,
  `logs_data` text NOT NULL,
  `created_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`cfr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `cinema`;
CREATE TABLE `cinema` (
  `cinema_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `permanent_address` text NOT NULL,
  `temporary_address` text NOT NULL,
  `video_cassette_recorder` varchar(100) NOT NULL,
  `is_case_of_building` tinyint(1) NOT NULL,
  `plan_of_building_document` varchar(100) NOT NULL,
  `name_of_building` varchar(100) NOT NULL,
  `place_of_building` varchar(100) NOT NULL,
  `distance_of_building` varchar(100) NOT NULL,
  `character_licence_certificate` varchar(100) NOT NULL,
  `photo_state_copy` varchar(100) NOT NULL,
  `ownership_document` varchar(100) NOT NULL,
  `motor_vehicles_document` varchar(100) NOT NULL,
  `business_trade_authority_license` varchar(100) NOT NULL,
  `tb_license_affected` varchar(100) NOT NULL,
  `building_as` varchar(100) NOT NULL,
  `auditorium_as` varchar(100) NOT NULL,
  `passages_and_gangways_as` varchar(100) NOT NULL,
  `urinals_and_wc_as` varchar(100) NOT NULL,
  `time_schedule_film` varchar(100) NOT NULL,
  `screen_width` varchar(100) NOT NULL,
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
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`cinema_id`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_applicant` (`name_of_applicant`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`),
  KEY `district` (`district`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `company_survey`;
CREATE TABLE `company_survey` (
  `company_survey_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `entrepreneur_name` varchar(200) NOT NULL,
  `estate_name` varchar(200) NOT NULL,
  `estate_details` tinyint(1) NOT NULL,
  `udyog_aadhar_memorandum` varchar(100) NOT NULL,
  `pan_number` varchar(10) NOT NULL,
  `official_address` varchar(200) NOT NULL,
  `authorized_person_name` varchar(255) NOT NULL,
  `authorized_person_contactno` varchar(12) NOT NULL,
  `authorized_person_email` varchar(255) NOT NULL,
  `turnover` varchar(100) NOT NULL,
  `industry_type` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `major_activity` tinyint(1) NOT NULL,
  `nature_activity` tinyint(1) NOT NULL,
  `social_category` tinyint(1) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `differently_abled` tinyint(1) NOT NULL,
  `organization_type` tinyint(1) NOT NULL,
  `other_organization` varchar(200) NOT NULL,
  `pcc_category` tinyint(1) NOT NULL,
  `total_employment` varchar(10) NOT NULL,
  `skilled_employment` varchar(10) NOT NULL,
  `semi_skilled_employment` varchar(10) NOT NULL,
  `unskilled_employment` varchar(10) NOT NULL,
  `managerial_employment` varchar(10) NOT NULL,
  `lcc_employment` varchar(10) NOT NULL,
  `emp_tlc` tinyint(1) NOT NULL,
  `skilled_local_pe` varchar(10) NOT NULL,
  `semi_skilled_local_pe` varchar(10) NOT NULL,
  `unskilled_local_pe` varchar(10) NOT NULL,
  `state_wise_pe` text NOT NULL,
  `emp_pf` varchar(10) NOT NULL,
  `emp_is` varchar(10) NOT NULL,
  `emp_ois` varchar(10) NOT NULL,
  `investment` varchar(100) NOT NULL,
  `pe` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ipc` text NOT NULL,
  `raw_material` varchar(150) NOT NULL,
  `major_product` varchar(150) NOT NULL,
  `industrial_process` text NOT NULL,
  `past_year_turnover` varchar(100) NOT NULL,
  `intial_production_year` varchar(10) NOT NULL,
  `expansion_year` varchar(10) NOT NULL,
  `proposed_expansion_year` varchar(10) NOT NULL,
  `skill_requirement` varchar(100) NOT NULL,
  `loan_outstanding` varchar(50) NOT NULL,
  `interest_outstanding_loan` varchar(50) NOT NULL,
  `subsidy` varchar(50) NOT NULL,
  `grants` varchar(50) NOT NULL,
  `foreign_direct_investment` varchar(50) NOT NULL,
  `registered_number` varchar(50) NOT NULL,
  `is_gstin` tinyint(1) NOT NULL,
  `gstin_number` varchar(30) NOT NULL,
  `social_distancing` tinyint(1) NOT NULL,
  `thermal_screening` tinyint(1) NOT NULL,
  `mask_availability` tinyint(1) NOT NULL,
  `face_shield` tinyint(1) NOT NULL,
  `washing_hands` tinyint(1) NOT NULL,
  `avoiding_water` tinyint(1) NOT NULL,
  `phsw` varchar(200) NOT NULL,
  `cleanliness` varchar(200) NOT NULL,
  `overcrowding` varchar(200) NOT NULL,
  `arrangements` tinyint(1) NOT NULL,
  `fire_saftey_measures` varchar(100) NOT NULL,
  `washing_facilities` tinyint(1) NOT NULL,
  `first_aid_appliances` varchar(100) NOT NULL,
  `workers_quarters` tinyint(1) NOT NULL,
  `quarters_number` int(11) NOT NULL,
  `canteen` tinyint(1) NOT NULL,
  `commu_fiber` varchar(200) NOT NULL,
  `srl` tinyint(1) NOT NULL,
  `connectivity` varchar(10) NOT NULL,
  `creches` varchar(100) NOT NULL,
  `apprenticeship` varchar(100) NOT NULL,
  `saftey_measures` text NOT NULL,
  `pollution_control_measures` text NOT NULL,
  `air_pcm` varchar(200) NOT NULL,
  `etmc` varchar(10) NOT NULL,
  `liquid_waste` varchar(200) NOT NULL,
  `solid_waste` varchar(200) NOT NULL,
  `hazardous_waste` varchar(200) NOT NULL,
  `e_waste` varchar(200) NOT NULL,
  `liquor_waste` varchar(200) NOT NULL,
  `wpit` tinyint(1) NOT NULL,
  `unit_status` tinyint(1) NOT NULL,
  `tax_due_ppy` varchar(200) NOT NULL,
  `date_of_survey` date NOT NULL,
  `date_of_submission` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`company_survey_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `construction`;
CREATE TABLE `construction` (
  `construction_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_owner` varchar(255) NOT NULL,
  `address_of_owner` varchar(255) NOT NULL,
  `building_no` varchar(100) NOT NULL,
  `plot_no` varchar(100) NOT NULL,
  `revenue_no` varchar(100) NOT NULL,
  `cts_no` varchar(100) NOT NULL,
  `road_street` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `license_no` varchar(100) NOT NULL,
  `application_date` date NOT NULL,
  `valid_upto_date` date NOT NULL,
  `annexure_III` varchar(255) NOT NULL,
  `annexure_IV` varchar(255) NOT NULL,
  `annexureV` tinyint(1) NOT NULL,
  `annexure_V` varchar(255) NOT NULL,
  `annexureVI` tinyint(1) NOT NULL,
  `annexure_VI` varchar(255) NOT NULL,
  `layoutplan` tinyint(1) NOT NULL,
  `layout_plan` varchar(255) NOT NULL,
  `copy_of_na` varchar(255) NOT NULL,
  `original_certified_map` varchar(255) NOT NULL,
  `I_and_XIV_nakal` varchar(255) NOT NULL,
  `building_plan_dcr` varchar(255) NOT NULL,
  `cost_estimate` varchar(255) NOT NULL,
  `noc_coast_guard` varchar(255) NOT NULL,
  `provisional_noc` tinyint(1) NOT NULL,
  `provisional_noc_fire` varchar(255) NOT NULL,
  `crz_clearance` tinyint(1) NOT NULL,
  `crz_clearance_certificate` varchar(255) NOT NULL,
  `sub_division` tinyint(1) NOT NULL,
  `sub_division_order` varchar(255) NOT NULL,
  `amalgamation` tinyint(1) NOT NULL,
  `amalgamation_order` varchar(255) NOT NULL,
  `occupancy` tinyint(1) NOT NULL,
  `occupancy_certificate` varchar(255) NOT NULL,
  `certificate_land` tinyint(1) NOT NULL,
  `certificate_land_acquisition` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `licensed_engineer_signature` varchar(255) NOT NULL,
  `labour_cess` varchar(255) NOT NULL,
  `undertaking` varchar(255) NOT NULL,
  `fire_noc` varchar(255) NOT NULL,
  `owner_signature` varchar(255) NOT NULL,
  `certificate_file` varchar(255) NOT NULL,
  `final_certificate` varchar(255) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`construction_id`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_owner` (`name_of_owner`),
  KEY `address_of_owner` (`address_of_owner`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`),
  KEY `district` (`district`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `c_inspections`;
CREATE TABLE `c_inspections` (
  `c_inspection_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` smallint(6) NOT NULL,
  `inspection_date` date NOT NULL,
  `cb_name` varchar(200) NOT NULL,
  `cb_address` varchar(200) NOT NULL,
  `cb_type` tinyint(1) NOT NULL,
  `inspection_details` text NOT NULL,
  `remarks` text NOT NULL,
  `inspection_under_act` varchar(200) NOT NULL,
  `officer_ids` text NOT NULL,
  `ir_remarks` text NOT NULL,
  `inspection_report` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `is_lock` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`c_inspection_id`),
  KEY `department_id` (`department_id`),
  KEY `cb_name` (`cb_name`),
  KEY `cb_address` (`cb_address`),
  KEY `cb_type` (`cb_type`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `department_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `district` tinyint(1) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `department_address` varchar(200) NOT NULL,
  `landline_number` varchar(100) NOT NULL,
  `hod_designation` varchar(100) NOT NULL,
  `hof_designation` varchar(100) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `dept_fd`;
CREATE TABLE `dept_fd` (
  `dept_fd_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_type` tinyint(4) NOT NULL,
  `description` varchar(100) NOT NULL,
  `daman_pao_code` varchar(10) NOT NULL,
  `daman_ddo_code` varchar(10) NOT NULL,
  `daman_grant_number` varchar(10) NOT NULL,
  `daman_full_head` varchar(20) NOT NULL,
  `daman_major_head` varchar(10) NOT NULL,
  `daman_sub_major_head` varchar(10) NOT NULL,
  `daman_minor_head` varchar(10) NOT NULL,
  `daman_sub_head` varchar(10) NOT NULL,
  `daman_detailed_head` varchar(20) NOT NULL,
  `daman_object` varchar(10) NOT NULL,
  `daman_category` varchar(10) NOT NULL,
  `diu_pao_code` varchar(10) NOT NULL,
  `diu_ddo_code` varchar(10) NOT NULL,
  `diu_grant_number` varchar(10) NOT NULL,
  `diu_full_head` varchar(20) NOT NULL,
  `diu_major_head` varchar(10) NOT NULL,
  `diu_sub_major_head` varchar(10) NOT NULL,
  `diu_minor_head` varchar(10) NOT NULL,
  `diu_sub_head` varchar(10) NOT NULL,
  `diu_detailed_head` varchar(20) NOT NULL,
  `diu_object` varchar(10) NOT NULL,
  `diu_category` varchar(10) NOT NULL,
  `dnh_pao_code` varchar(10) NOT NULL,
  `dnh_ddo_code` varchar(10) NOT NULL,
  `dnh_grant_number` varchar(10) NOT NULL,
  `dnh_full_head` varchar(20) NOT NULL,
  `dnh_major_head` varchar(10) NOT NULL,
  `dnh_sub_major_head` varchar(10) NOT NULL,
  `dnh_minor_head` varchar(10) NOT NULL,
  `dnh_sub_head` varchar(10) NOT NULL,
  `dnh_detailed_head` varchar(20) NOT NULL,
  `dnh_object` varchar(10) NOT NULL,
  `dnh_category` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`dept_fd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `district`;
CREATE TABLE `district` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_code` tinyint(4) NOT NULL,
  `district_code` int(11) NOT NULL,
  `district_version` tinyint(4) NOT NULL,
  `district_name` varchar(100) NOT NULL,
  `cencus_code_2001` int(11) NOT NULL,
  `cencus_code_2011` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `state_code` (`state_code`),
  KEY `district_code` (`district_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` smallint(6) NOT NULL,
  `employee_name` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `roles` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `pin` text NOT NULL,
  `spacimen_signature` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `establishment`;
CREATE TABLE `establishment` (
  `establishment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `establishment_name` varchar(200) NOT NULL,
  `establishment_location` varchar(200) NOT NULL,
  `establishment_postel_address` varchar(200) NOT NULL,
  `nature_of_work` varchar(200) NOT NULL,
  `pe_full_name` varchar(200) NOT NULL,
  `pe_address` varchar(200) NOT NULL,
  `pe_email_id` varchar(100) NOT NULL,
  `pe_mobile_number` varchar(10) NOT NULL,
  `mp_full_name` varchar(200) NOT NULL,
  `mp_address` varchar(200) NOT NULL,
  `mp_mobile_number` varchar(10) NOT NULL,
  `mp_email_id` varchar(100) NOT NULL,
  `seal_and_stamp` varchar(100) NOT NULL,
  `declaration` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`establishment_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `establishment_name` (`establishment_name`),
  KEY `nature_of_work` (`nature_of_work`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `establishment_contractor`;
CREATE TABLE `establishment_contractor` (
  `establishment_contractor_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `establishment_id` int(11) NOT NULL,
  `contractor_proprietor_name` varchar(200) NOT NULL,
  `contractor_name` varchar(200) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `contractor_address` varchar(200) NOT NULL,
  `nature_of_work` varchar(200) NOT NULL,
  `contractor_labour` varchar(10) NOT NULL,
  `contractor_start_date` date NOT NULL,
  `contractor_termination_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`establishment_contractor_id`),
  KEY `establishment_id` (`establishment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `factorylicence`;
CREATE TABLE `factorylicence` (
  `factorylicence_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_factory` varchar(255) NOT NULL,
  `factory_license_no` varchar(255) NOT NULL,
  `factory_address` varchar(255) NOT NULL,
  `factory_postal_address` varchar(255) NOT NULL,
  `is_factory_exists` tinyint(1) NOT NULL,
  `nature_of_work` varchar(255) NOT NULL,
  `work_carried` varchar(255) NOT NULL,
  `max_no_of_worker_year` int(11) NOT NULL,
  `max_no_of_worker_month` int(4) NOT NULL,
  `no_of_ordinarily_emp` int(11) NOT NULL,
  `total_power_install` varchar(200) NOT NULL,
  `total_power_used` varchar(200) NOT NULL,
  `max_power_to_be_used` varchar(200) NOT NULL,
  `manager_detail` varchar(255) NOT NULL,
  `occupier_detail` varchar(255) NOT NULL,
  `proprietor_of_factory` varchar(255) NOT NULL,
  `share_holders` varchar(255) NOT NULL,
  `chief_head` varchar(255) NOT NULL,
  `owner_detail` varchar(255) NOT NULL,
  `factory_extend` tinyint(4) NOT NULL,
  `reference_no` int(11) NOT NULL,
  `date_of_approval` date NOT NULL,
  `disposal_waste` varchar(255) NOT NULL,
  `name_of_authority` varchar(255) NOT NULL,
  `sign_of_occupier` varchar(255) NOT NULL,
  `director_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `managing_director_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `product_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `form_two_copy` varchar(255) NOT NULL,
  `occupancy_certificate` varchar(255) NOT NULL,
  `stability_certificate` varchar(255) NOT NULL,
  `safety_equipments_list` varchar(255) NOT NULL,
  `machinery_layout` varchar(255) NOT NULL,
  `approved_plan_copy` varchar(255) NOT NULL,
  `safety_provision` varchar(255) NOT NULL,
  `copy_of_site_plans` varchar(255) NOT NULL,
  `plan_approval` varchar(255) NOT NULL,
  `self_certificate` varchar(255) NOT NULL,
  `project_report` varchar(255) NOT NULL,
  `land_document_copy` varchar(255) NOT NULL,
  `ssi_registration_copy` varchar(255) NOT NULL,
  `detail_of_etp` varchar(255) NOT NULL,
  `questionnaire_copy` varchar(255) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`factorylicence_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_factory` (`name_of_factory`),
  KEY `work_carried` (`work_carried`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `factorylicence_renewal`;
CREATE TABLE `factorylicence_renewal` (
  `factorylicence_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `factorylicence_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `name_of_factory` varchar(255) NOT NULL,
  `factory_address` varchar(255) NOT NULL,
  `factory_postal_address` varchar(255) NOT NULL,
  `max_no_of_worker_year` int(11) NOT NULL,
  `max_power_to_be_used` varchar(100) NOT NULL,
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
  `certificate_file` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `final_certificate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `payment_type` tinyint(4) NOT NULL,
  `user_payment_type` tinyint(4) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(4) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `processing_days` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`factorylicence_renewal_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_factory` (`name_of_factory`),
  KEY `factory_address` (`factory_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `fees_bifurcation`;
CREATE TABLE `fees_bifurcation` (
  `fees_bifurcation_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_type` tinyint(4) NOT NULL,
  `module_id` int(11) NOT NULL,
  `dept_fd_id` int(11) NOT NULL,
  `fee_description` varchar(100) NOT NULL,
  `fee` decimal(6,0) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`fees_bifurcation_id`),
  KEY `module_type` (`module_type`),
  KEY `module_id` (`module_id`),
  KEY `dept_fd_id` (`dept_fd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `fees_payment`;
CREATE TABLE `fees_payment` (
  `fees_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(200) NOT NULL,
  `reference_id` tinytext NOT NULL,
  `district` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_type` tinyint(1) NOT NULL,
  `module_id` int(11) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `op_other_details` text NOT NULL,
  `op_order_number` text NOT NULL,
  `op_enct` text NOT NULL,
  `op_mt` text NOT NULL,
  `fees_payment_dv_id` int(11) NOT NULL,
  `op_status` tinyint(1) NOT NULL,
  `op_og_status` tinyint(1) NOT NULL,
  `is_auto_dv_done` tinyint(1) NOT NULL,
  `op_message` text NOT NULL,
  `op_og_message` text NOT NULL,
  `op_start_datetime` datetime NOT NULL,
  `op_end_datetime` datetime NOT NULL,
  `op_return` text NOT NULL,
  `op_bank_code` varchar(10) NOT NULL,
  `op_bank_reference_number` varchar(50) NOT NULL,
  `op_transaction_datetime` datetime NOT NULL,
  `op_mid` varchar(10) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`fees_payment_id`),
  KEY `reference_number` (`reference_number`),
  KEY `module_type` (`module_type`),
  KEY `module_id` (`module_id`),
  KEY `op_status` (`op_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


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
  PRIMARY KEY (`fees_payment_dv_id`),
  KEY `fees_payment_id` (`fees_payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `filmshooting`;
CREATE TABLE `filmshooting` (
  `filmshooting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `production_house` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `production_manager` varchar(255) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `director_cast` varchar(255) NOT NULL,
  `film_title` varchar(255) NOT NULL,
  `film_synopsis` varchar(255) NOT NULL,
  `film_shooting_days` int(11) NOT NULL,
  `shooting_location` varchar(255) NOT NULL,
  `shooting_date_time` datetime NOT NULL,
  `defense_installation` varchar(255) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `declaration` varchar(255) NOT NULL,
  `producer_signature` varchar(255) NOT NULL,
  `authorized_representative_sign` varchar(255) NOT NULL,
  `seal_of_company` varchar(255) NOT NULL,
  `undersigned` varchar(255) NOT NULL,
  `aged` int(11) NOT NULL,
  `resident` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `witness_one_name` varchar(255) NOT NULL,
  `witness_one_sign` varchar(255) NOT NULL,
  `witness_two_name` varchar(255) NOT NULL,
  `witness_two_sign` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `query_status` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`filmshooting_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `production_manager` (`production_manager`),
  KEY `production_house` (`production_house`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `holidaylist`;
CREATE TABLE `holidaylist` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday_date` date NOT NULL,
  `holiday_desc` varchar(255) NOT NULL,
  `fdw_ess` tinyint(1) NOT NULL,
  `fdw` tinyint(1) NOT NULL,
  `sdw` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `hotel`;
CREATE TABLE `hotel` (
  `hotelregi_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_hotel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name_of_person` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `full_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name_of_tourist_area` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_proprietor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_of_hotel` varchar(100) NOT NULL,
  `fees` varchar(10) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
  `name_of_manager` varchar(100) NOT NULL,
  `manager_permanent_address` varchar(100) NOT NULL,
  `name_of_agent` text NOT NULL,
  `permanent_resident_of_ut` tinyint(1) NOT NULL,
  `other_business_of_applicant` tinyint(1) NOT NULL,
  `hotel_rented_or_leased` tinyint(1) NOT NULL,
  `leased_date` date NOT NULL,
  `site_plan` varchar(100) NOT NULL,
  `construction_plan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `occupancy_certificate` varchar(100) NOT NULL,
  `noc_medical` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `noc_concerned` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `noc_electricity` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `aadhar_card_homestay` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `form_xiv_homestay` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_plan_homestay` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `na_order_homestay` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `completion_certificate_homestay` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `house_tax_receipt_homestay` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `electricity_bill_homestay` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `noc_fire` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `police_clearance_certificate` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
  `remarks` text NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`hotelregi_id`),
  KEY `name_of_tourist_area` (`name_of_tourist_area`),
  KEY `name_of_hotel` (`name_of_hotel`),
  KEY `category_of_hotel` (`category_of_hotel`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `hotel_renewal`;
CREATE TABLE `hotel_renewal` (
  `hotel_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `hotelregi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_hotel` varchar(100) NOT NULL,
  `name_of_proprietor` varchar(100) NOT NULL,
  `new_employees_details` varchar(200) NOT NULL,
  `fees` varchar(10) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
  `name_of_tourist_area` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `noc_fire` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `challan_number` varchar(100) NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `last_valid_upto` date NOT NULL,
  `remarks` text NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`hotel_renewal_id`),
  KEY `name_of_tourist_area` (`name_of_tourist_area`),
  KEY `name_of_hotel` (`name_of_hotel`),
  KEY `name_of_proprietor` (`name_of_proprietor`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `incentive_generalform`;
CREATE TABLE `incentive_generalform` (
  `incentive_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(200) NOT NULL,
  `office_address` varchar(200) NOT NULL,
  `factory_address` varchar(200) NOT NULL,
  `office_contactno` varchar(20) NOT NULL,
  `factory_contactno` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `cellphone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `constitution` tinyint(1) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `promoters_details` varchar(200) NOT NULL,
  `othorized_person_detail` varchar(200) NOT NULL,
  `is_women_entrepreneur` tinyint(1) NOT NULL,
  `women_entrepreneur` varchar(200) NOT NULL,
  `is_sc_st_entrepreneur` tinyint(1) NOT NULL,
  `sc_st_entrepreneur` varchar(200) NOT NULL,
  `is_physically_entrepreneur` tinyint(1) NOT NULL,
  `physically_entrepreneur` varchar(200) NOT NULL,
  `is_transgender_entrepreneur` tinyint(1) NOT NULL,
  `transgender_entrepreneur` varchar(200) NOT NULL,
  `is_other_entrepreneur` tinyint(1) NOT NULL,
  `other_entrepreneur` varchar(200) NOT NULL,
  `proprietor_share_details` text NOT NULL,
  `unit_type` tinyint(1) NOT NULL,
  `category` tinyint(1) NOT NULL,
  `emno_part1` varchar(100) NOT NULL,
  `emdate_part1` date NOT NULL,
  `emno_part2` varchar(50) NOT NULL,
  `emdate_part2` date NOT NULL,
  `manufacturing_items` varchar(200) NOT NULL,
  `annual_capacity` varchar(20) NOT NULL,
  `approval_no` varchar(100) NOT NULL,
  `pccno_date` date NOT NULL,
  `pccno_validupto_date` date NOT NULL,
  `factory_registration_no` varchar(100) NOT NULL,
  `establishment_date` date NOT NULL,
  `establishment_validupto_date` date NOT NULL,
  `commencement_date` date NOT NULL,
  `turnover` varchar(100) NOT NULL,
  `annual_turnover` varchar(50) NOT NULL,
  `annual_turnover_one` varchar(50) NOT NULL,
  `annual_turnover_two` varchar(50) NOT NULL,
  `annual_turnover_three` varchar(50) NOT NULL,
  `annual_turnover_four` varchar(50) NOT NULL,
  `financial_assistance` tinyint(1) NOT NULL,
  `financial_assistance_upload` varchar(200) NOT NULL,
  `govt_dues` tinyint(1) NOT NULL,
  `govt_dues_upload` varchar(200) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `ifsc_no` varchar(20) NOT NULL,
  `bankbranch_no` varchar(50) NOT NULL,
  `pancard_no` varchar(15) NOT NULL,
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
  PRIMARY KEY (`incentive_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `incentive_generalform_textile`;
CREATE TABLE `incentive_generalform_textile` (
  `incentive_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(255) NOT NULL,
  `office_address` varchar(255) NOT NULL,
  `office_contactno` varchar(11) NOT NULL,
  `factory_address` varchar(255) NOT NULL,
  `factory_contactno` varchar(11) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `cellphone` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `constitution` varchar(255) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `promoters_details` varchar(255) NOT NULL,
  `othorized_person_detail` varchar(255) NOT NULL,
  `is_women_entrepreneur` int(11) NOT NULL,
  `women_entrepreneur` varchar(255) NOT NULL,
  `is_sc_st_entrepreneur` int(11) NOT NULL,
  `sc_st_entrepreneur` varchar(255) NOT NULL,
  `is_physically_entrepreneur` int(11) NOT NULL,
  `physically_entrepreneur` varchar(255) NOT NULL,
  `is_transgender_entrepreneur` int(11) NOT NULL,
  `transgender_entrepreneur` varchar(255) NOT NULL,
  `is_other_entrepreneur` int(11) NOT NULL,
  `other_entrepreneur` varchar(255) NOT NULL,
  `proprietor_share_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `unit_type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `emno_part1` int(11) NOT NULL,
  `emdate_part1` date NOT NULL,
  `emno_part2` int(11) NOT NULL,
  `emdate_part2` date NOT NULL,
  `manufacturing_items` varchar(255) NOT NULL,
  `annual_capacity` int(11) NOT NULL,
  `approval_no` varchar(255) NOT NULL,
  `pccno_date` date NOT NULL,
  `pccno_validupto_date` date NOT NULL,
  `factory_registration_no` varchar(255) NOT NULL,
  `establishment_date` date NOT NULL,
  `establishment_validupto_date` date NOT NULL,
  `commencement_date` date NOT NULL,
  `turnover` int(11) NOT NULL,
  `annual_turnover` int(11) NOT NULL,
  `annual_turnover_one` int(11) NOT NULL,
  `annual_turnover_two` int(11) NOT NULL,
  `annual_turnover_three` int(11) NOT NULL,
  `annual_turnover_four` int(11) NOT NULL,
  `financial_assistance` varchar(255) NOT NULL,
  `financial_assistance_upload` varchar(255) NOT NULL,
  `govt_dues` varchar(255) NOT NULL,
  `govt_dues_upload` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_no` int(11) NOT NULL,
  `ifsc_no` varchar(255) NOT NULL,
  `bankbranch_no` varchar(255) NOT NULL,
  `pancard_no` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `query_status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` text NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`incentive_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `incentive_parta`;
CREATE TABLE `incentive_parta` (
  `incentive_parta_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(200) NOT NULL,
  `enterprise_category` tinyint(1) NOT NULL,
  `investment` varchar(100) NOT NULL,
  `machinery_units` varchar(50) NOT NULL,
  `new_investment` varchar(50) NOT NULL,
  `investment_percentage` varchar(10) NOT NULL,
  `contribution` varchar(50) NOT NULL,
  `term_loan` varchar(50) NOT NULL,
  `unsecured_loan` varchar(50) NOT NULL,
  `accruals` varchar(50) NOT NULL,
  `finance_total` varchar(100) NOT NULL,
  `financial_data_info` text NOT NULL,
  `term_loan_date` date NOT NULL,
  `loan_accountno` varchar(100) NOT NULL,
  `capital_subsidy` varchar(100) NOT NULL,
  `anum` varchar(100) NOT NULL,
  `cliam_amount_total` varchar(50) NOT NULL,
  `commencement_date` date NOT NULL,
  `disbursement_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`incentive_parta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `incentive_partb`;
CREATE TABLE `incentive_partb` (
  `incentive_partb_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `features` varchar(200) NOT NULL,
  `iso_agency_name` varchar(200) NOT NULL,
  `iso_certificate_no` varchar(200) NOT NULL,
  `iso_certificate_date` date NOT NULL,
  `iso_product_detail` varchar(200) NOT NULL,
  `isi_agency_name` varchar(200) NOT NULL,
  `isi_certificate_no` varchar(200) NOT NULL,
  `isi_certificate_date` date NOT NULL,
  `isi_product_detail` varchar(200) NOT NULL,
  `expenditure` varchar(20) NOT NULL,
  `capital_cost` varchar(20) NOT NULL,
  `consutancy_fees` varchar(20) NOT NULL,
  `certification_charges` varchar(20) NOT NULL,
  `testing_equipments` varchar(20) NOT NULL,
  `cliam_amount_total` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`incentive_partb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `incentive_partc`;
CREATE TABLE `incentive_partc` (
  `incentive_partc_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_no` varchar(100) NOT NULL,
  `registration_date` date NOT NULL,
  `patent_name` varchar(200) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `patent_expenditure` varchar(20) NOT NULL,
  `claim_amount` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`incentive_partc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `incentive_partd`;
CREATE TABLE `incentive_partd` (
  `incentive_partd_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `consultant_name` varchar(200) NOT NULL,
  `suggestion` varchar(200) NOT NULL,
  `result_benefit` varchar(200) NOT NULL,
  `total_expenditure` varchar(20) NOT NULL,
  `equipment_info` text NOT NULL,
  `audit_fees` varchar(10) NOT NULL,
  `equipment_cost` varchar(20) NOT NULL,
  `cliam_amount_total` varchar(20) NOT NULL,
  `audit_report` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`incentive_partd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `incentive_parte`;
CREATE TABLE `incentive_parte` (
  `incentive_parte_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `newly_requit_emp` varchar(20) NOT NULL,
  `emp_total_expenditure` varchar(20) NOT NULL,
  `assclaim_amount` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`incentive_parte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `incentive_partf`;
CREATE TABLE `incentive_partf` (
  `incentive_partf_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(255) NOT NULL,
  `enterprise_category` varchar(255) NOT NULL,
  `investment` varchar(255) NOT NULL,
  `machinery_units` varchar(255) NOT NULL,
  `new_investment` varchar(255) NOT NULL,
  `investment_percentage` int(11) NOT NULL,
  `contribution` varchar(255) NOT NULL,
  `term_loan` varchar(255) NOT NULL,
  `unsecured_loan` varchar(255) NOT NULL,
  `accruals` varchar(255) NOT NULL,
  `finance_total` int(11) NOT NULL,
  `financial_data_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `term_loan_date` date NOT NULL,
  `loan_accountno` int(11) NOT NULL,
  `project_profile_uploader` varchar(255) NOT NULL,
  `details_uploader` varchar(255) NOT NULL,
  `investment_uploader` varchar(255) NOT NULL,
  `interest_subsidy` varchar(255) NOT NULL,
  `other_info` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`incentive_partf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `incentive_partg`;
CREATE TABLE `incentive_partg` (
  `incentive_partg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(255) NOT NULL,
  `enterprise_category` varchar(255) NOT NULL,
  `sector_textile` varchar(255) NOT NULL,
  `investment` varchar(255) NOT NULL,
  `machinery_units` varchar(255) NOT NULL,
  `new_investment` varchar(255) NOT NULL,
  `investment_percentage` varchar(255) NOT NULL,
  `contribution` varchar(255) NOT NULL,
  `term_loan` varchar(255) NOT NULL,
  `unsecured_loan` int(11) NOT NULL,
  `accruals` varchar(255) NOT NULL,
  `finance_total` int(11) NOT NULL,
  `financial_data_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `term_loan_date` date NOT NULL,
  `loan_accountno` int(11) NOT NULL,
  `project_profile_uploader` varchar(255) NOT NULL,
  `details_uploader` varchar(255) NOT NULL,
  `investment_uploader` varchar(255) NOT NULL,
  `interest_subsidy` varchar(255) NOT NULL,
  `other_info` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`incentive_partg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `incentive_parth`;
CREATE TABLE `incentive_parth` (
  `incentive_parth_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(255) NOT NULL,
  `technology_purpose` varchar(255) NOT NULL,
  `sector_textile` varchar(255) NOT NULL,
  `enterprise_accqu` varchar(255) NOT NULL,
  `justification` varchar(255) NOT NULL,
  `process_detail` varchar(255) NOT NULL,
  `name_address` varchar(255) NOT NULL,
  `arrangement_uploader` varchar(255) NOT NULL,
  `mou_uploader` varchar(255) NOT NULL,
  `commencement_date` varchar(255) NOT NULL,
  `purchase` varchar(255) NOT NULL,
  `technology_fees` int(11) NOT NULL,
  `other_detail` varchar(255) NOT NULL,
  `upgradation_total` int(11) NOT NULL,
  `contribution` varchar(255) NOT NULL,
  `term_loan` int(11) NOT NULL,
  `unsecured_loan` int(11) NOT NULL,
  `accruals` varchar(255) NOT NULL,
  `finance_total` int(11) NOT NULL,
  `financial_data_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `term_loan_date` date NOT NULL,
  `loan_accountno` int(11) NOT NULL,
  `project_profile_uploader` varchar(255) NOT NULL,
  `details_uploader` varchar(255) NOT NULL,
  `investment_uploader` varchar(255) NOT NULL,
  `annual_production_uploader` varchar(255) NOT NULL,
  `power_consumption_uploader` varchar(255) NOT NULL,
  `impact_uploader` varchar(255) NOT NULL,
  `interest_subsidy` int(11) NOT NULL,
  `other_info` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`incentive_parth_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `incentive_scheme`;
CREATE TABLE `incentive_scheme` (
  `incentive_scheme_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parta_form` int(11) NOT NULL,
  `partb_form` int(11) NOT NULL,
  `partc_form` int(11) NOT NULL,
  `partd_form` int(11) NOT NULL,
  `parte_form` int(11) NOT NULL,
  `partf_form` int(11) NOT NULL,
  `partg_form` int(11) NOT NULL,
  `parth_form` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`incentive_scheme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `inspection`;
CREATE TABLE `inspection` (
  `inspection_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `application_date` date NOT NULL,
  `plinth_column` varchar(100) NOT NULL,
  `plot_no` varchar(100) NOT NULL,
  `zone` varchar(100) NOT NULL,
  `road` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `industrial_area` varchar(255) NOT NULL,
  `communication_number` varchar(100) NOT NULL,
  `dated` date NOT NULL,
  `declaration` int(11) NOT NULL,
  `name_licensed` varchar(255) NOT NULL,
  `registration_no` varchar(100) NOT NULL,
  `certificate_file` varchar(255) NOT NULL,
  `final_certificate` varchar(255) NOT NULL,
  `valid_upto_date` date NOT NULL,
  `signature_architecture` varchar(255) NOT NULL,
  `sign_seal` varchar(255) NOT NULL,
  `approved_license` varchar(255) NOT NULL,
  `annexure_9` varchar(255) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `village` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `query_status` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`inspection_id`),
  KEY `name_of_applicant` (`name_of_applicant`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
  `ap_email` varchar(100) NOT NULL,
  `ap_mobile` varchar(10) NOT NULL,
  `udyam_registration` varchar(100) NOT NULL,
  `regi_details` varchar(100) NOT NULL,
  `ur_cin_no` varchar(100) NOT NULL,
  `ur_cin_doc` varchar(100) NOT NULL,
  `ur_tin_no` varchar(100) NOT NULL,
  `ur_tin_doc` varchar(100) NOT NULL,
  `ur_pan_no` varchar(10) NOT NULL,
  `ur_pan_doc` varchar(100) NOT NULL,
  `ur_gst_no` varchar(100) NOT NULL,
  `ur_gst_doc` varchar(100) NOT NULL,
  `ur_other_reg_no` varchar(100) NOT NULL,
  `ur_other_doc` varchar(100) NOT NULL,
  `manu_name` varchar(100) NOT NULL,
  `main_plant_address` varchar(100) NOT NULL,
  `office_address` varchar(100) NOT NULL,
  `latitude` decimal(12,6) NOT NULL,
  `longitude` decimal(12,6) NOT NULL,
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
  `undertaking_doc` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`ips_id`),
  KEY `district` (`district`),
  KEY `owner_name` (`owner_name`),
  KEY `email` (`email`),
  KEY `mobile_no` (`mobile_no`),
  KEY `manu_name` (`manu_name`),
  KEY `main_plant_address` (`main_plant_address`),
  KEY `office_address` (`office_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


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
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`ips_incentive_id`),
  KEY `ips_id` (`ips_id`),
  KEY `scheme_type` (`scheme_type`),
  KEY `scheme` (`scheme`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


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
  PRIMARY KEY (`ips_incentive_doc_id`),
  KEY `ips_incentive_id` (`ips_incentive_id`),
  KEY `ips_id` (`ips_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `ips_incentive_od`;
CREATE TABLE `ips_incentive_od` (
  `ips_incentive_od_id` int(11) NOT NULL AUTO_INCREMENT,
  `ips_incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ips_id` int(11) NOT NULL,
  `doc_name` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`ips_incentive_od_id`),
  KEY `ips_incentive_id` (`ips_incentive_id`),
  KEY `ips_id` (`ips_id`),
  KEY `is_delete` (`is_delete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `ismw`;
CREATE TABLE `ismw` (
  `ismw_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `name` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `aadhaar_no` varchar(12) NOT NULL,
  `p_state` varchar(100) NOT NULL,
  `p_dist` varchar(100) NOT NULL,
  `p_block_no` varchar(100) NOT NULL,
  `p_village` varchar(100) NOT NULL,
  `p_house_no` varchar(100) NOT NULL,
  `p_pincode` varchar(100) NOT NULL,
  `ee_state` varchar(100) NOT NULL,
  `ee_dist` varchar(100) NOT NULL,
  `ee_occuption` varchar(100) NOT NULL,
  `ee_nature` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`ismw_id`),
  KEY `district` (`district`),
  KEY `name` (`name`),
  KEY `mobile_no` (`mobile_no`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `land_allotment`;
CREATE TABLE `land_allotment` (
  `landallotment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `applicant_address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telehpone_no` varchar(50) NOT NULL,
  `application_date` date NOT NULL,
  `village` varchar(100) NOT NULL,
  `plot_no` varchar(100) NOT NULL,
  `govt_industrial_estate_area` varchar(100) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `bio_data_doc` varchar(255) NOT NULL,
  `constitution_artical` varchar(100) NOT NULL,
  `constitution_artical_doc` varchar(255) NOT NULL,
  `expansion_industry` varchar(100) NOT NULL,
  `nature_of_industry` varchar(255) NOT NULL,
  `possession_of_industry_plot` varchar(255) NOT NULL,
  `industrial_license_necessary` tinyint(1) NOT NULL,
  `obtained_letter_of_intent` tinyint(1) NOT NULL,
  `obtained_letter_of_intent_doc` varchar(255) NOT NULL,
  `regist_letter_msme` tinyint(1) NOT NULL,
  `regist_letter_msme_doc` varchar(255) NOT NULL,
  `if_project_collaboration` tinyint(1) NOT NULL,
  `project_collaboration` varchar(255) NOT NULL,
  `if_project_requires_import` tinyint(1) NOT NULL,
  `project_requires_import` varchar(255) NOT NULL,
  `detailed_project_report_doc` varchar(255) NOT NULL,
  `proposed_finance_terms_doc` varchar(255) NOT NULL,
  `no_of_persons_likely_emp` tinyint(1) NOT NULL,
  `no_of_persons_likely_emp_no` varchar(100) NOT NULL,
  `no_of_persons_likely_emp_unskilled` tinyint(1) NOT NULL,
  `no_of_persons_likely_emp_no_unskilled` varchar(100) NOT NULL,
  `no_of_persons_likely_emp_staff` tinyint(1) NOT NULL,
  `no_of_persons_likely_emp_no_staff` varchar(100) NOT NULL,
  `details_of_manufacturing_doc` varchar(255) NOT NULL,
  `if_backward_class_bac` tinyint(1) NOT NULL,
  `if_backward_class_bac_doc` varchar(255) NOT NULL,
  `if_backward_class_scst` tinyint(1) NOT NULL,
  `if_backward_class_scst_doc` varchar(255) NOT NULL,
  `if_backward_class_ex_serv` tinyint(1) NOT NULL,
  `if_backward_class_ex_serv_doc` varchar(255) NOT NULL,
  `if_backward_class_wm` tinyint(1) NOT NULL,
  `if_backward_class_wm_doc` varchar(255) NOT NULL,
  `if_backward_class_ph` tinyint(1) NOT NULL,
  `if_backward_class_ph_doc` varchar(255) NOT NULL,
  `if_belonging_transg` tinyint(1) NOT NULL,
  `if_belonging_transg_doc` varchar(255) NOT NULL,
  `if_belonging_other` tinyint(1) NOT NULL,
  `if_bonafide` tinyint(1) NOT NULL,
  `bonafide_of_dnh_doc` varchar(255) NOT NULL,
  `ifnot_state_particular_place` tinyint(1) NOT NULL,
  `state_particular_place` varchar(255) NOT NULL,
  `information_raw_materials_doc` varchar(255) NOT NULL,
  `detail_of_space` varchar(255) NOT NULL,
  `infrastructure_requirement_doc` varchar(255) NOT NULL,
  `treatment_indicate` varchar(255) NOT NULL,
  `effluent_teratment_doc` varchar(255) NOT NULL,
  `detail_of_emission_of_gases` varchar(255) NOT NULL,
  `emission_of_gases_doc` varchar(255) NOT NULL,
  `copy_authority_letter_doc` varchar(255) NOT NULL,
  `copy_project_profile_doc` varchar(255) NOT NULL,
  `demand_of_deposit_draft` varchar(255) NOT NULL,
  `copy_proposed_land_doc` varchar(255) NOT NULL,
  `copy_of_partnership_deed_doc` varchar(255) NOT NULL,
  `relevant_experience_doc` varchar(255) NOT NULL,
  `if_promotion_council` tinyint(1) NOT NULL,
  `certy_by_direc_indus_doc` varchar(255) NOT NULL,
  `other_relevant_doc` varchar(255) NOT NULL,
  `declaration` tinyint(1) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`landallotment_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_applicant` (`name_of_applicant`),
  KEY `applicant_address` (`applicant_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `lease_seller`;
CREATE TABLE `lease_seller` (
  `seller_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `application_date` date NOT NULL,
  `state` varchar(100) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `taluka` varchar(100) NOT NULL,
  `village` varchar(100) NOT NULL,
  `plot_no` varchar(100) NOT NULL,
  `survey_no` varchar(100) NOT NULL,
  `admeasuring_square_metre` varchar(100) NOT NULL,
  `govt_industrial_estate_area` varchar(100) NOT NULL,
  `reason_of_transfer` varchar(100) NOT NULL,
  `transferer_name` varchar(100) NOT NULL,
  `name_of_servicing` varchar(100) NOT NULL,
  `udyog_aadhar_memo_no` varchar(100) NOT NULL,
  `pan_no` varchar(100) NOT NULL,
  `gst_no` varchar(100) NOT NULL,
  `trans_account_no` varchar(100) NOT NULL,
  `request_letter_reason` tinyint(1) NOT NULL,
  `request_letter_reason_doc` varchar(255) NOT NULL,
  `original_extract` tinyint(1) NOT NULL,
  `original_extract_doc` varchar(255) NOT NULL,
  `nodue_from_mamlatdar` tinyint(1) NOT NULL,
  `nodue_from_mamlatdar_doc` varchar(255) NOT NULL,
  `nodue_from_electricity` tinyint(1) NOT NULL,
  `nodue_from_electricity_doc` varchar(255) NOT NULL,
  `nodue_from_bank` tinyint(1) NOT NULL,
  `nodue_from_bank_doc` varchar(255) NOT NULL,
  `nodues_from_grampanchayat` tinyint(1) NOT NULL,
  `nodues_from_grampanchayat_doc` varchar(255) NOT NULL,
  `challan_of_lease` tinyint(1) NOT NULL,
  `challan_of_lease_doc` varchar(255) NOT NULL,
  `occupancy_certy` tinyint(1) NOT NULL,
  `occupancy_certy_doc` varchar(255) NOT NULL,
  `nodue_from_excise` tinyint(1) NOT NULL,
  `nodue_from_excise_doc` varchar(255) NOT NULL,
  `sign_behalf_lessee` tinyint(1) NOT NULL,
  `sign_behalf_lessee_doc` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `logs_change_pin`;
CREATE TABLE `logs_change_pin` (
  `logs_change_pin_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `old_pin` text NOT NULL,
  `new_pin` text NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`logs_change_pin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `logs_crone`;
CREATE TABLE `logs_crone` (
  `logs_crone_id` int(11) NOT NULL AUTO_INCREMENT,
  `crone_type` tinyint(1) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `logs_data` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `message` text NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`logs_crone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `logs_email`;
CREATE TABLE `logs_email` (
  `email_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `email_type` tinyint(1) NOT NULL,
  `module_type` tinyint(4) NOT NULL,
  `module_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`email_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `logs_login_details`;
CREATE TABLE `logs_login_details` (
  `logs_login_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `login_timestamp` int(11) NOT NULL,
  `logout_timestamp` int(11) NOT NULL,
  `logs_data` text NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`logs_login_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `logs_sms`;
CREATE TABLE `logs_sms` (
  `logs_sms_id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_type` tinyint(1) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `ErrorCode` tinyint(4) NOT NULL,
  `ErrorMessage` text NOT NULL,
  `JobId` varchar(100) NOT NULL,
  `MessageData` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`logs_sms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `migrantcontractors`;
CREATE TABLE `migrantcontractors` (
  `mc_id` int(11) NOT NULL AUTO_INCREMENT,
  `mw_id` int(11) NOT NULL,
  `mc_proprietor_name` varchar(100) NOT NULL,
  `mc_name` varchar(100) NOT NULL,
  `mc_address` text NOT NULL,
  `mc_nature_of_work` varchar(200) NOT NULL,
  `mc_maximum_no_of_workers` int(5) NOT NULL,
  `mc_date_of_commencement` date NOT NULL,
  `mc_date_of_termination` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`mc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `migrantworkers`;
CREATE TABLE `migrantworkers` (
  `mw_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mw_registration_no` varchar(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `mw_name_of_establishment` varchar(100) NOT NULL,
  `mw_location_of_establishment` text NOT NULL,
  `mw_postal_address_of_establishment` text NOT NULL,
  `mw_principal_employer_name` varchar(100) NOT NULL,
  `mw_principal_employer_address` text NOT NULL,
  `mw_directors_or_partners_name` varchar(100) NOT NULL,
  `mw_directors_or_partners_address` text NOT NULL,
  `mw_manager_or_persons_name` varchar(100) NOT NULL,
  `mw_manager_or_persons_address` text NOT NULL,
  `mw_nature_of_work_of_establishment` varchar(200) NOT NULL,
  `mw_name_of_bank` text NOT NULL,
  `mw_amount` decimal(10,2) NOT NULL,
  `mw_challan_no` varchar(100) NOT NULL,
  `mw_challan_date` date NOT NULL,
  `mw_certificate_expiry_date` date NOT NULL,
  `mw_declaration` tinyint(1) NOT NULL,
  `mw_sign_of_principal_employer` varchar(50) NOT NULL,
  `mw_remark` text NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`mw_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `mw_name_of_establishment` (`mw_name_of_establishment`),
  KEY `mw_nature_of_work_of_establishment` (`mw_nature_of_work_of_establishment`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `migrantworkers_renewal`;
CREATE TABLE `migrantworkers_renewal` (
  `migrantworkers_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `mw_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_number` varchar(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_establishment` varchar(100) NOT NULL,
  `location_of_establishment` text NOT NULL,
  `postal_address_of_establishment` text NOT NULL,
  `principal_employer_name` varchar(100) NOT NULL,
  `principal_employer_address` text NOT NULL,
  `directors_or_partners_name` varchar(100) NOT NULL,
  `directors_or_partners_address` text NOT NULL,
  `manager_or_persons_name` varchar(100) NOT NULL,
  `manager_or_persons_address` text NOT NULL,
  `nature_of_work_of_establishment` varchar(200) NOT NULL,
  `contractor_details` text NOT NULL,
  `name_of_bank` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `challan_no` varchar(100) NOT NULL,
  `challan_date` date NOT NULL,
  `valid_upto` date NOT NULL,
  `last_valid_upto` date NOT NULL,
  `signature` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`migrantworkers_renewal_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_establishment` (`name_of_establishment`),
  KEY `nature_of_work_of_establishment` (`nature_of_work_of_establishment`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `module_documents`;
CREATE TABLE `module_documents` (
  `module_documents_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_type` tinyint(4) NOT NULL,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doc_id` tinyint(4) NOT NULL,
  `doc_name` varchar(200) NOT NULL,
  `doc_path` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`module_documents_id`),
  KEY `module_type` (`module_type`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `module_other_documents`;
CREATE TABLE `module_other_documents` (
  `module_other_documents_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_type` tinyint(4) NOT NULL,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_doc_name` varchar(200) NOT NULL,
  `other_doc` varchar(200) NOT NULL,
  `other_doc_path` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`module_other_documents_id`),
  KEY `module_type` (`module_type`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `msme`;
CREATE TABLE `msme` (
  `msme_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
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
  `form_application_checklist` varchar(50) NOT NULL,
  `declaration_file` varchar(100) NOT NULL,
  `application_form_file` varchar(100) NOT NULL,
  `ci_is_file` varchar(100) NOT NULL,
  `afqc_file` varchar(100) NOT NULL,
  `afpr_file` varchar(100) NOT NULL,
  `afscew_file` varchar(100) NOT NULL,
  `ifle_file` varchar(100) NOT NULL,
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
  `doc_12` varchar(100) NOT NULL,
  `doc_13` varchar(100) NOT NULL,
  `doc_14` varchar(100) NOT NULL,
  `doc_15` varchar(100) NOT NULL,
  `doc_16` varchar(100) NOT NULL,
  `doc_17` varchar(100) NOT NULL,
  `doc_18` varchar(100) NOT NULL,
  `doc_19` varchar(100) NOT NULL,
  `doc_20` varchar(100) NOT NULL,
  `doc_21` varchar(100) NOT NULL,
  `doc_22` varchar(100) NOT NULL,
  `doc_23` varchar(100) NOT NULL,
  `doc_24` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`msme_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `enterprise_name` (`enterprise_name`),
  KEY `office_address` (`office_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `msme_checklist`;
CREATE TABLE `msme_checklist` (
  `checklist_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_capital_investment` int(11) NOT NULL,
  `is_intrest_subsidy` int(11) NOT NULL,
  `entrepreneur_memorandum_uploader` varchar(255) NOT NULL,
  `partnership_deed_uploader` varchar(255) NOT NULL,
  `lease_agreement_uploader` varchar(255) NOT NULL,
  `loan_sanction_uploader` varchar(255) NOT NULL,
  `power_release_order_uploader` varchar(255) NOT NULL,
  `invoice_copy_uploader` varchar(255) NOT NULL,
  `ca_prescribed_uploader` varchar(255) NOT NULL,
  `certificate_commencement_uploader` varchar(255) NOT NULL,
  `engineer_certificate_uploader` varchar(255) NOT NULL,
  `expenses_certificate_uploader` varchar(255) NOT NULL,
  `stamped_receipt_uploader` varchar(255) NOT NULL,
  `sale_invoice_uploader` varchar(255) NOT NULL,
  `additional_document_uploader` varchar(255) NOT NULL,
  `factorylicence_copy_uploader` varchar(255) NOT NULL,
  `pcc_copy_uploader` varchar(255) NOT NULL,
  `expansion_date_uploader` varchar(255) NOT NULL,
  `production_turnover_uploader` varchar(255) NOT NULL,
  `fix_assets_value_uploader` varchar(255) NOT NULL,
  `production_capacity_uploader` varchar(255) NOT NULL,
  `patent_registration_uploader` varchar(255) NOT NULL,
  `energy_water_uploader` varchar(255) NOT NULL,
  `quality_certificate_uploader` varchar(255) NOT NULL,
  `resident_certificate_uploader` varchar(255) NOT NULL,
  `bank_total_interest_uploader` varchar(255) NOT NULL,
  `bank_statement_uploader` varchar(255) NOT NULL,
  `annexure3_declaration_uploader` varchar(255) NOT NULL,
  `interest_subsidy_cal_uploader` varchar(255) NOT NULL,
  `year_annual_prod_uploader` varchar(255) NOT NULL,
  `year_bank_statement_uploader` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`checklist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `msme_declaration`;
CREATE TABLE `msme_declaration` (
  `declaration_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sign_seal` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`declaration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `na`;
CREATE TABLE `na` (
  `na_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `multiple_applicant` text NOT NULL,
  `agri_purpose_a` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `non_agri_purpose_b` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `non_agri_purpose_c` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rel_condition_c` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pre_non_agri_c` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `certified_copy` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sketch_layout` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `written_consent` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `postel_address` varchar(100) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `village` varchar(100) NOT NULL,
  `survey_no` varchar(100) NOT NULL,
  `area_assessment` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `area_of_site_used` varchar(100) NOT NULL,
  `occupant_class` varchar(100) NOT NULL,
  `present_use_land` varchar(100) NOT NULL,
  `situated_land` varchar(100) NOT NULL,
  `electrical_distance_land` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `acquisition_under_land` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accessible_land` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `site_access_land` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rejected_land` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `form_land_document` varchar(100) NOT NULL,
  `site_plan_document` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` varchar(100) NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `final_certificate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`na_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_applicant` (`name_of_applicant`),
  KEY `occupation` (`occupation`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


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
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`nil_certificate_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `applicant_name` (`applicant_name`),
  KEY `applicant_address` (`applicant_address`),
  KEY `applicant_mobile_number` (`applicant_mobile_number`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `noc`;
CREATE TABLE `noc` (
  `noc_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `application_date` date NOT NULL,
  `state` varchar(100) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `taluka` varchar(50) NOT NULL,
  `village` varchar(50) NOT NULL,
  `loan_amount` varchar(100) NOT NULL,
  `plot_no` varchar(100) NOT NULL,
  `survey_no` varchar(100) NOT NULL,
  `admeasuring_square_metre` varchar(100) NOT NULL,
  `govt_industrial_estate_area` varchar(100) NOT NULL,
  `purpose_of_lease` varchar(100) NOT NULL,
  `loan_from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `ac_number` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `ifsc_code` varchar(100) NOT NULL,
  `reason_of_loan_from_bank` tinyint(1) NOT NULL,
  `reason_of_loan_doc` varchar(255) NOT NULL,
  `request_letter_of_bank` tinyint(1) NOT NULL,
  `request_letter_doc` varchar(255) NOT NULL,
  `behalf_of_lessee` tinyint(1) NOT NULL,
  `behalf_of_lessee_doc` varchar(255) NOT NULL,
  `public_undertaking` tinyint(1) NOT NULL,
  `public_undertaking_doc` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `declaration` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`noc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `occupancy_certificate`;
CREATE TABLE `occupancy_certificate` (
  `occupancy_certificate_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `survey_no` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `plot_no` varchar(200) NOT NULL,
  `zone` varchar(200) NOT NULL,
  `situated_at` varchar(200) NOT NULL,
  `license_no` varchar(200) NOT NULL,
  `completed_on` date NOT NULL,
  `licensed_engineer_name` varchar(200) NOT NULL,
  `licensed_engineer_signature` varchar(200) NOT NULL,
  `owner_signature` varchar(200) NOT NULL,
  `owner_name` varchar(200) NOT NULL,
  `occupancy_registration_no` varchar(200) NOT NULL,
  `occupancy_valid_upto` date NOT NULL,
  `address` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `copy_of_construction_permission` varchar(200) NOT NULL,
  `copy_of_building_plan` varchar(200) NOT NULL,
  `stability_certificate` varchar(200) NOT NULL,
  `building_height_noc` varchar(200) NOT NULL,
  `fire_noc` varchar(200) NOT NULL,
  `copy_of_water_harvesting` varchar(200) NOT NULL,
  `existing_building_plan` varchar(200) NOT NULL,
  `form_of_indemnity` varchar(200) NOT NULL,
  `annexure_sixteen` varchar(200) NOT NULL,
  `is_fire_noc` int(11) NOT NULL,
  `is_existing_building_plan` int(11) NOT NULL,
  `is_form_of_indemnity` int(11) NOT NULL,
  `is_stability_certificate` int(11) NOT NULL,
  `annexure_14` varchar(200) NOT NULL,
  `oc_part_oc` varchar(200) NOT NULL,
  `fire_emergency` varchar(200) NOT NULL,
  `building_plan` varchar(200) NOT NULL,
  `stability_certificate_dnh` varchar(200) NOT NULL,
  `is_occupancy_certificate_dnh` int(11) NOT NULL,
  `occupancy_certificate_dnh` varchar(200) NOT NULL,
  `existing_cp` varchar(200) NOT NULL,
  `labour_cess_certificate` varchar(200) NOT NULL,
  `valuation_certificate` varchar(200) NOT NULL,
  `bank_deposit_sleep` varchar(200) NOT NULL,
  `deviation_photographs` varchar(200) NOT NULL,
  `copy_7_12` varchar(200) NOT NULL,
  `certificate_map` varchar(200) NOT NULL,
  `certificate_file` varchar(200) NOT NULL,
  `final_certificate` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `query_status` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`occupancy_certificate_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `licensed_engineer_name` (`licensed_engineer_name`),
  KEY `situated_at` (`situated_at`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `officer`;
CREATE TABLE `officer` (
  `officer_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `officer_name` varchar(200) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`officer_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `otp`;
CREATE TABLE `otp` (
  `otp_id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile_number` varchar(10) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `otp_type` tinyint(1) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_expired` tinyint(1) NOT NULL,
  PRIMARY KEY (`otp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


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


DROP TABLE IF EXISTS `periodicalreturn`;
CREATE TABLE `periodicalreturn` (
  `periodicalreturn_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `application_category` varchar(100) NOT NULL,
  `name_of_applicant` varchar(200) NOT NULL,
  `application_date` datetime NOT NULL,
  `applicant_address` varchar(200) NOT NULL,
  `applicant_licence_no` varchar(200) NOT NULL,
  `applicant_licence_date` date NOT NULL,
  `description_wm` varchar(200) NOT NULL,
  `period_validity_licence` varchar(200) NOT NULL,
  `suspending_revoke` varchar(200) NOT NULL,
  `category_of_wm` varchar(200) NOT NULL,
  `proprietor_details` longtext NOT NULL,
  `other_details` longtext NOT NULL,
  `manufacturer_details` longtext NOT NULL,
  `manufacturertwo_details` longtext NOT NULL,
  `repairer_details` longtext NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `admin_registration_number` int(11) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`periodicalreturn_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_applicant` (`name_of_applicant`),
  KEY `applicant_address` (`applicant_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `plot_numbers`;
CREATE TABLE `plot_numbers` (
  `plot_id` int(11) NOT NULL AUTO_INCREMENT,
  `village_id` int(11) NOT NULL,
  `plot_no` varchar(100) NOT NULL,
  `is_vacant` tinyint(1) NOT NULL,
  `area` varchar(10) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`plot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `property_registration`;
CREATE TABLE `property_registration` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `party_type` tinyint(1) NOT NULL,
  `document_type` varchar(200) NOT NULL,
  `application_date` date NOT NULL,
  `party_name` varchar(200) NOT NULL,
  `party_address` varchar(200) NOT NULL,
  `digit_mobile_number` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pan` tinyint(1) NOT NULL,
  `pancard_all_parties` tinyint(1) NOT NULL,
  `pan_card` varchar(200) NOT NULL,
  `aadhaar_card` varchar(200) NOT NULL,
  `document` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `set_appointment_date` date NOT NULL,
  `signature` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `psf_registration`;
CREATE TABLE `psf_registration` (
  `psfregistration_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `firm_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `principal_address` varchar(200) NOT NULL,
  `other_address` varchar(200) NOT NULL,
  `firm_duration` varchar(50) NOT NULL,
  `import_from_outside` varchar(200) NOT NULL,
  `application_of_firm_document` varchar(200) NOT NULL,
  `formII_document` varchar(200) NOT NULL,
  `partnership_deed` varchar(200) NOT NULL,
  `aadharcard_all_parties` tinyint(1) NOT NULL,
  `aadharcard` varchar(200) NOT NULL,
  `pancard_all_parties` tinyint(1) NOT NULL,
  `pancard` varchar(200) NOT NULL,
  `alteration_name_firm` tinyint(1) NOT NULL,
  `alteration_name_firm_doc` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `import_from_outside_ret` varchar(200) NOT NULL,
  `retirement_form` varchar(200) NOT NULL,
  `signature` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(200) NOT NULL,
  `final_certificate` varchar(200) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`psfregistration_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `firm_name` (`firm_name`),
  KEY `principal_address` (`principal_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `query`;
CREATE TABLE `query` (
  `query_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_type` tinyint(1) NOT NULL,
  `module_id` int(11) NOT NULL,
  `query_type` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `query_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`query_id`),
  KEY `module_type` (`module_type`),
  KEY `module_id` (`module_id`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `query_document`;
CREATE TABLE `query_document` (
  `query_document_id` int(11) NOT NULL AUTO_INCREMENT,
  `query_id` int(11) NOT NULL,
  `doc_name` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`query_document_id`),
  KEY `query_id` (`query_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `query_grievance`;
CREATE TABLE `query_grievance` (
  `query_grievance_id` int(11) NOT NULL AUTO_INCREMENT,
  `query_reference_number` varchar(255) NOT NULL,
  `district` int(11) NOT NULL,
  `issue_category` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `other_department` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `industry_classification` int(11) NOT NULL,
  `mobile_no` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `application_no` varchar(255) NOT NULL,
  `query` varchar(500) NOT NULL,
  `query_response` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`query_grievance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `questionary`;
CREATE TABLE `questionary` (
  `questionary_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`questionary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `rii`;
CREATE TABLE `rii` (
  `rii_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `district` int(11) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `address` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `trade` int(11) NOT NULL,
  `reporting` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `is_labour_dept` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`rii_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `sa_logs_change_password`;
CREATE TABLE `sa_logs_change_password` (
  `sa_logs_change_password_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sa_user_id` bigint(20) NOT NULL,
  `old_password` text NOT NULL,
  `new_password` text NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`sa_logs_change_password_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `sa_logs_login_details`;
CREATE TABLE `sa_logs_login_details` (
  `sa_logs_login_details_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sa_user_id` bigint(20) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `login_timestamp` int(11) NOT NULL,
  `logout_timestamp` int(11) NOT NULL,
  `logs_data` text NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`sa_logs_login_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `sa_users`;
CREATE TABLE `sa_users` (
  `sa_user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `is_deactive` tinyint(1) NOT NULL,
  `is_npp` tinyint(1) NOT NULL,
  `npp_datetime` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`sa_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `sa_user_type`;
CREATE TABLE `sa_user_type` (
  `sa_user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`sa_user_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `sc_inspections`;
CREATE TABLE `sc_inspections` (
  `sc_inspection_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` smallint(6) NOT NULL,
  `inspection_date` date NOT NULL,
  `inspection_under_act` varchar(200) NOT NULL,
  `inspection_type` tinyint(1) NOT NULL,
  `complainant_name` varchar(200) NOT NULL,
  `complainant_mobile_number` varchar(20) NOT NULL,
  `complainant_email` varchar(100) NOT NULL,
  `complainant_address` varchar(200) NOT NULL,
  `cb_name` varchar(200) NOT NULL,
  `cb_address` varchar(200) NOT NULL,
  `cb_type` tinyint(1) NOT NULL,
  `inspection_details` text NOT NULL,
  `remarks` text NOT NULL,
  `ir_remarks` text NOT NULL,
  `inspection_report` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`sc_inspection_id`),
  KEY `inspection_type` (`inspection_type`),
  KEY `cb_name` (`cb_name`),
  KEY `cb_address` (`cb_address`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `daman_district` tinyint(1) NOT NULL,
  `daman_department_id` int(11) NOT NULL,
  `diu_district` tinyint(1) NOT NULL,
  `diu_department_id` int(11) NOT NULL,
  `dnh_district` tinyint(1) NOT NULL,
  `dnh_department_id` int(11) NOT NULL,
  `service_name` varchar(200) NOT NULL,
  `risk_category` varchar(50) NOT NULL,
  `size_of_firm` varchar(50) NOT NULL,
  `foreign_domestic_investor` varchar(50) NOT NULL,
  `business_location` varchar(50) NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `timeline` varchar(50) NOT NULL,
  `competent_authority` varchar(200) NOT NULL,
  `first_aagr` varchar(200) NOT NULL,
  `second_aagr` varchar(200) NOT NULL,
  `apply_url` varchar(200) NOT NULL,
  `fees_details` text NOT NULL,
  `document_checklist` text NOT NULL,
  `procedure` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `s_registration_no` varchar(100) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `regi_category` varchar(50) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_door_no` varchar(25) NOT NULL,
  `s_street_name` varchar(100) NOT NULL,
  `s_location` text NOT NULL,
  `s_postal_address` text NOT NULL,
  `s_different_location` tinyint(1) NOT NULL,
  `s_different_location_office` varchar(100) NOT NULL,
  `s_different_location_store_room` varchar(100) NOT NULL,
  `s_different_location_godown` varchar(100) NOT NULL,
  `s_different_location_warehouse` varchar(100) NOT NULL,
  `s_employer_name` varchar(100) NOT NULL,
  `s_employer_mobile_no` varchar(10) NOT NULL,
  `s_employer_residential_address` text NOT NULL,
  `s_manager_name` varchar(100) NOT NULL,
  `s_manager_residential_address` text NOT NULL,
  `multiple_partner` text NOT NULL,
  `s_category` varchar(100) NOT NULL,
  `s_nature_of_business` varchar(100) NOT NULL,
  `s_commencement_of_business_date` date NOT NULL,
  `s_employers_family_details` text NOT NULL,
  `s_employees_details` text NOT NULL,
  `s_name_of_treasury` varchar(100) NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `lease_agreement_document` varchar(100) NOT NULL,
  `house_tax_copy` varchar(100) NOT NULL,
  `photo_of_shop` varchar(100) NOT NULL,
  `aadhar_card` varchar(100) NOT NULL,
  `pan_card` varchar(100) NOT NULL,
  `gst` varchar(100) NOT NULL,
  `s_sign_of_employer` varchar(100) NOT NULL,
  `certificate_tourism` varchar(100) NOT NULL,
  `license_health` varchar(100) NOT NULL,
  `noc_health` varchar(100) NOT NULL,
  `security_license` varchar(100) NOT NULL,
  `s_declaration` tinyint(1) NOT NULL,
  `s_certificate_expiry_date` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `s_remark` text NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `s_name` (`s_name`),
  KEY `regi_category` (`regi_category`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `shop_renewal`;
CREATE TABLE `shop_renewal` (
  `shop_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_shop` varchar(100) NOT NULL,
  `door_no` varchar(25) NOT NULL,
  `street_name` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `total_employees` varchar(100) NOT NULL,
  `employer_name` varchar(100) NOT NULL,
  `employer_mobile_no` varchar(10) NOT NULL,
  `employer_residential_address` text NOT NULL,
  `manager_name` varchar(100) NOT NULL,
  `manager_residential_address` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `nature_of_business` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `challan_number` varchar(100) NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `last_valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`shop_renewal_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_shop` (`name_of_shop`),
  KEY `category` (`category`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `singlereturn`;
CREATE TABLE `singlereturn` (
  `singlereturn_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `esta_name` varchar(200) NOT NULL,
  `esta_address` varchar(200) NOT NULL,
  `esta_tel_no` varchar(11) NOT NULL,
  `esta_mob_no` varchar(11) NOT NULL,
  `esta_fax_no` int(11) NOT NULL,
  `esta_email_id` varchar(200) NOT NULL,
  `emp_name` varchar(200) NOT NULL,
  `emp_address` varchar(200) NOT NULL,
  `emp_tel_no` varchar(11) NOT NULL,
  `emp_mob_no` varchar(11) NOT NULL,
  `emp_fax_no` int(11) NOT NULL,
  `emp_email_id` varchar(200) NOT NULL,
  `manager_name` varchar(200) NOT NULL,
  `manager_address` varchar(200) NOT NULL,
  `manager_tel_no` varchar(11) NOT NULL,
  `manager_mob_no` varchar(11) NOT NULL,
  `manager_fax_no` int(11) NOT NULL,
  `manager_email_id` varchar(200) NOT NULL,
  `registration_no` varchar(200) NOT NULL,
  `license_no` varchar(200) NOT NULL,
  `commencement_date` date NOT NULL,
  `industry_nature` varchar(200) NOT NULL,
  `direct_unskilled` int(11) NOT NULL,
  `direct_semiskilled` int(11) NOT NULL,
  `direct_skilled` int(11) NOT NULL,
  `direct_total` int(11) NOT NULL,
  `direct_male` int(11) NOT NULL,
  `direct_female` int(11) NOT NULL,
  `contractor_unskilled` int(11) NOT NULL,
  `contractor_semiskilled` int(11) NOT NULL,
  `contractor_skilled` int(11) NOT NULL,
  `contractor_total` int(11) NOT NULL,
  `contractor_male` int(11) NOT NULL,
  `contractor_female` int(11) NOT NULL,
  `total_unskilled` int(11) NOT NULL,
  `total_semiskilled` int(11) NOT NULL,
  `total_skilled` int(11) NOT NULL,
  `total_total` int(11) NOT NULL,
  `total_male` int(11) NOT NULL,
  `total_female` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`singlereturn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `singlereturn_parta`;
CREATE TABLE `singlereturn_parta` (
  `singlereturn_parta_id` int(11) NOT NULL AUTO_INCREMENT,
  `singlereturn_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `worked_days` int(11) NOT NULL,
  `man_worked_days` int(11) NOT NULL,
  `average_emp` int(11) NOT NULL,
  `male_wages` int(11) NOT NULL,
  `female_wages` int(11) NOT NULL,
  `total_fine` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`singlereturn_parta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `singlereturn_partb`;
CREATE TABLE `singlereturn_partb` (
  `singlereturn_partb_id` int(11) NOT NULL AUTO_INCREMENT,
  `singlereturn_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `percentage_of_bonus` int(11) NOT NULL,
  `no_of_baneficiaries` int(11) NOT NULL,
  `total_bonus_paid` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `not_paid_reason` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`singlereturn_partb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `singlereturn_partc`;
CREATE TABLE `singlereturn_partc` (
  `singlereturn_partc_id` int(11) NOT NULL AUTO_INCREMENT,
  `singlereturn_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contractor_name` varchar(200) NOT NULL,
  `contractor_address` varchar(200) NOT NULL,
  `contractor_nature` varchar(200) NOT NULL,
  `total_employed_labour` int(11) NOT NULL,
  `total_worked_days_by_labour` int(11) NOT NULL,
  `total_employed_direct_labour` int(11) NOT NULL,
  `total_worked_days_by_direct_labour` int(11) NOT NULL,
  `change_management_details` varchar(200) NOT NULL,
  `duration_of_contract` int(11) NOT NULL,
  `no_of_contract_labour` int(11) NOT NULL,
  `working_hours` varchar(200) NOT NULL,
  `overtime_work` varchar(200) NOT NULL,
  `weekly_holiday` varchar(200) NOT NULL,
  `spread_over` varchar(200) NOT NULL,
  `male_worked_days` int(11) NOT NULL,
  `female_worked_days` int(11) NOT NULL,
  `total_worked_days` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `amount_deduction` int(11) NOT NULL,
  `is_paid_weekly_holiday` int(11) NOT NULL,
  `is_provide_canteen` int(11) NOT NULL,
  `is_provide_restroom` int(11) NOT NULL,
  `is_provide_drinking_water` int(11) NOT NULL,
  `is_provide_creches` int(11) NOT NULL,
  `is_provide_firstaid` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`singlereturn_partc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `singlereturn_partd`;
CREATE TABLE `singlereturn_partd` (
  `singlereturn_partd_id` int(11) NOT NULL AUTO_INCREMENT,
  `singlereturn_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fin` int(11) NOT NULL,
  `nic_code` int(11) NOT NULL,
  `sector` int(11) NOT NULL,
  `registration_section` int(11) NOT NULL,
  `registration_no` varchar(200) NOT NULL,
  `license_no` varchar(200) NOT NULL,
  `license_workers` varchar(200) NOT NULL,
  `license_hp` varchar(200) NOT NULL,
  `license_renewal_year` varchar(200) NOT NULL,
  `license_submitted_year` varchar(200) NOT NULL,
  `plan_approval_no` varchar(200) NOT NULL,
  `plan_approval_date` date NOT NULL,
  `certificate_obtain_on_date` date NOT NULL,
  `certificate_submitted_on_date` date NOT NULL,
  `finished_product` varchar(200) NOT NULL,
  `intermediates` varchar(200) NOT NULL,
  `raw_materials` varchar(200) NOT NULL,
  `male_average_workers` int(11) NOT NULL,
  `female_average_workers` int(11) NOT NULL,
  `factory_worked_days` int(11) NOT NULL,
  `adult_men_worked_days` int(11) NOT NULL,
  `adult_women_worked_days` int(11) NOT NULL,
  `adult_total_worked_days` int(11) NOT NULL,
  `adolescent_men_worked_days` int(11) NOT NULL,
  `adolescent_women_worked_days` int(11) NOT NULL,
  `adolescent_total_worked_days` int(11) NOT NULL,
  `adult_men_workers_employed` int(11) NOT NULL,
  `adult_women_workers_employed` int(11) NOT NULL,
  `adult_total_workers_employed` int(11) NOT NULL,
  `adolescent_men_workers_employed` int(11) NOT NULL,
  `adolescent_women_workers_employed` int(11) NOT NULL,
  `adolescent_total_workers_employed` int(11) NOT NULL,
  `adult_men_work_hours` int(11) NOT NULL,
  `adult_women_work_hours` int(11) NOT NULL,
  `adult_total_work_hours` int(11) NOT NULL,
  `adolescent_men_work_hours` int(11) NOT NULL,
  `adolescent_women_work_hours` int(11) NOT NULL,
  `adolescent_total_work_hours` int(11) NOT NULL,
  `is_dust_generated` int(11) NOT NULL,
  `is_provide_drinking_water` int(11) NOT NULL,
  `is_provide_washroom` int(11) NOT NULL,
  `washroom_for_men` int(11) NOT NULL,
  `washroom_for_women` int(11) NOT NULL,
  `retainer_ship` int(11) NOT NULL,
  `is_health_record_maintain` int(11) NOT NULL,
  `is_provide_health_center` int(11) NOT NULL,
  `is_provide_medical_officer` int(11) NOT NULL,
  `no_of_hyginists_employed` int(11) NOT NULL,
  `safety_provision` varchar(200) NOT NULL,
  `is_provide_safe_access` int(11) NOT NULL,
  `is_provide_fire_exits` int(11) NOT NULL,
  `fighting_equipments_details` varchar(200) NOT NULL,
  `is_devices_certified` int(11) NOT NULL,
  `is_pressure_vessels_certified` int(11) NOT NULL,
  `personal_equipments_details` varchar(200) NOT NULL,
  `safety_officers_detail` varchar(200) NOT NULL,
  `is_functioning_safety_committee` int(11) NOT NULL,
  `is_provision_of_chapteriva` int(11) NOT NULL,
  `no_of_safety_programs` int(11) NOT NULL,
  `no_of_worker_trained` int(11) NOT NULL,
  `amended_date` date NOT NULL,
  `rehearsals_date` date NOT NULL,
  `safety_policy_detail` varchar(200) NOT NULL,
  `is_action_taken` int(11) NOT NULL,
  `is_firstaid_provide` int(11) NOT NULL,
  `is_ambulance_room_provide` int(11) NOT NULL,
  `is_provide_canteen` int(11) NOT NULL,
  `canteen_managed_by` int(11) NOT NULL,
  `is_provide_rest_room` int(11) NOT NULL,
  `is_provide_creche` int(11) NOT NULL,
  `is_welfare_officer_apponyed` int(11) NOT NULL,
  `working_hours_for_adults` int(11) NOT NULL,
  `is_disply_period_of_work` int(11) NOT NULL,
  `working_hours_for_women` int(11) NOT NULL,
  `is_obtain_fitness_certificate` int(11) NOT NULL,
  `is_leave_with_wages` int(11) NOT NULL,
  `no_of_worker_dismissed` int(11) NOT NULL,
  `no_of_paid_leave_worker` int(11) NOT NULL,
  `adult_men_workers_employed_year` int(11) NOT NULL,
  `adult_women_workers_employed_year` int(11) NOT NULL,
  `adult_total_workers_employed_year` int(11) NOT NULL,
  `adolescent_men_workers_employed_year` int(11) NOT NULL,
  `adolescent_women_workers_employed_year` int(11) NOT NULL,
  `adolescent_total_workers_employed_year` int(11) NOT NULL,
  `adult_men_leave_with_wages` int(11) NOT NULL,
  `adult_women_leave_with_wages` int(11) NOT NULL,
  `adult_total_leave_with_wages` int(11) NOT NULL,
  `adolescent_men_leave_with_wages` int(11) NOT NULL,
  `adolescent_women_leave_with_wages` int(11) NOT NULL,
  `adolescent_total_leave_with_wages` int(11) NOT NULL,
  `adult_men_annual_leave_with_wages` int(11) NOT NULL,
  `adult_women_annual_leave_with_wages` int(11) NOT NULL,
  `adult_total_annual_leave_with_wages` int(11) NOT NULL,
  `adolescent_men_annual_leave_with_wages` int(11) NOT NULL,
  `adolescent_women_annual_leave_with_wages` int(11) NOT NULL,
  `adolescent_total_annual_leave_with_wages` int(11) NOT NULL,
  `is_report_accident` int(11) NOT NULL,
  `no_of_non_fatal_injuries` int(11) NOT NULL,
  `no_of_non_fatal_lost_injuries` int(11) NOT NULL,
  `no_of_return_non_fatal_injuries` int(11) NOT NULL,
  `no_of_return_non_fatal_lost_injuries` int(11) NOT NULL,
  `nonfatal_dangerous_major_accidents` int(11) NOT NULL,
  `nonfatal_dangerous_major_accidents_inside` int(11) NOT NULL,
  `nonfatal_dangerous_major_accidents_outside` int(11) NOT NULL,
  `fatal_dangerous_major_accidents` int(11) NOT NULL,
  `fatal_dangerous_major_accidents_inside` int(11) NOT NULL,
  `fatal_dangerous_major_accidents_outside` int(11) NOT NULL,
  `fatal_dangerous_major_accidents_killed_inside` int(11) NOT NULL,
  `fatal_dangerous_major_accidents_killed_outside` int(11) NOT NULL,
  `nonfatal_nondangerous_accidents` int(11) NOT NULL,
  `nonfatal_nondangerous_accidents_inside` int(11) NOT NULL,
  `nonfatal_nondangerous_accidents_outside` int(11) NOT NULL,
  `fatal_nondangerous_accidents` int(11) NOT NULL,
  `fatal_nondangerous_accidents_inside` int(11) NOT NULL,
  `fatal_nondangerous_accidents_outside` int(11) NOT NULL,
  `fatal_nondangerous_accidents_killed_inside` int(11) NOT NULL,
  `fatal_nondangerous_accidents_killed_outside` int(11) NOT NULL,
  `nonfatal_dangerous_accidents` int(11) NOT NULL,
  `nonfatal_dangerous_accidents_inside` int(11) NOT NULL,
  `nonfatal_dangerous_accidents_outside` int(11) NOT NULL,
  `fatal_dangerous_accidents` int(11) NOT NULL,
  `fatal_dangerous_accidents_inside` int(11) NOT NULL,
  `fatal_dangerous_accidents_outside` int(11) NOT NULL,
  `fatal_dangerous_accidents_killed_inside` int(11) NOT NULL,
  `fatal_dangerous_accidents_killed_outside` int(11) NOT NULL,
  `nonfatal_major_accidents` int(11) NOT NULL,
  `nonfatal_major_accidents_inside` int(11) NOT NULL,
  `nonfatal_major_accidents_outside` int(11) NOT NULL,
  `fatal_major_accidents` int(11) NOT NULL,
  `fatal_major_accidents_inside` int(11) NOT NULL,
  `fatal_major_accidents_outside` int(11) NOT NULL,
  `fatal_major_accidents_killed_inside` int(11) NOT NULL,
  `fatal_major_accidents_killed_outside` int(11) NOT NULL,
  `nonfatal_nonmajor_accidents` int(11) NOT NULL,
  `nonfatal_nonmajor_accidents_inside` int(11) NOT NULL,
  `nonfatal_nonmajor_accidents_outside` int(11) NOT NULL,
  `fatal_nonmajor_accidents` int(11) NOT NULL,
  `fatal_nonmajor_accidents_inside` int(11) NOT NULL,
  `fatal_nonmajor_accidents_outside` int(11) NOT NULL,
  `fatal_nonmajor_accidents_killed_inside` int(11) NOT NULL,
  `fatal_nonmajor_accidents_killed_outside` int(11) NOT NULL,
  `hazardous_accidents` int(11) NOT NULL,
  `hazardous_fatal_injured` int(11) NOT NULL,
  `hazardous_nonfatal_injured` int(11) NOT NULL,
  `dangerous_accidents` int(11) NOT NULL,
  `dangerous_fatal_injured` int(11) NOT NULL,
  `dangerous_nonfatal_injured` int(11) NOT NULL,
  `other_accidents` int(11) NOT NULL,
  `other_fatal_injured` int(11) NOT NULL,
  `other_nonfatal_injured` int(11) NOT NULL,
  `dangerous_process_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `hazardous_process_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`singlereturn_partd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `singlereturn_parte`;
CREATE TABLE `singlereturn_parte` (
  `singlereturn_parte_id` int(11) NOT NULL AUTO_INCREMENT,
  `singlereturn_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `respect_of_fines` varchar(200) NOT NULL,
  `adult_worked_days` int(11) NOT NULL,
  `young_person_worked_days` int(11) NOT NULL,
  `adult_workers_employed` int(11) NOT NULL,
  `young_peson_workers_employed` int(11) NOT NULL,
  `basic_wages` int(11) NOT NULL,
  `dearness_allowances` int(11) NOT NULL,
  `composite_wages` int(11) NOT NULL,
  `overtime_wages` int(11) NOT NULL,
  `nonprofit_bonus` int(11) NOT NULL,
  `other_bonus` int(11) NOT NULL,
  `other_amount` int(11) NOT NULL,
  `arrears_of_pat` varchar(200) NOT NULL,
  `total_wages` int(11) NOT NULL,
  `year_total_wages` int(11) NOT NULL,
  `year_paid_bonus` int(11) NOT NULL,
  `commision_amount` int(11) NOT NULL,
  `realized_amount` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`singlereturn_parte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `singlereturn_partf`;
CREATE TABLE `singlereturn_partf` (
  `singlereturn_partf_id` int(11) NOT NULL AUTO_INCREMENT,
  `singlereturn_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_of_female_workers` int(11) NOT NULL,
  `no_of_maternity_women_workers` int(11) NOT NULL,
  `medical_bonus_case` int(11) NOT NULL,
  `miscarriage_leave_case` int(11) NOT NULL,
  `additional_leave_case` int(11) NOT NULL,
  `maternity_benefit_amount` int(11) NOT NULL,
  `is_nursing_breaks` int(11) NOT NULL,
  `is_dismissed_service` int(11) NOT NULL,
  `no_of_dismissed_women` int(11) NOT NULL,
  `dismissed_reason` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`singlereturn_partf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `singlereturn_partg`;
CREATE TABLE `singlereturn_partg` (
  `singlereturn_partg_id` int(11) NOT NULL AUTO_INCREMENT,
  `singlereturn_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_of_employed_workers` int(11) NOT NULL,
  `no_of_handicapped_employed` int(11) NOT NULL,
  `is_surgeon_obtain` int(11) NOT NULL,
  `is_handicapped_recuited` int(11) NOT NULL,
  `is_record_physically_handicapped` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`singlereturn_partg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `site_elevation`;
CREATE TABLE `site_elevation` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `name_of_applicant` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `application_date` date NOT NULL,
  `pts_no` varchar(200) NOT NULL,
  `survey_no` varchar(50) NOT NULL,
  `village` varchar(200) NOT NULL,
  `site_plan` varchar(200) NOT NULL,
  `I_XIV_nakal` varchar(200) NOT NULL,
  `plot_area` varchar(200) NOT NULL,
  `fees` varchar(10) NOT NULL,
  `signature` varchar(200) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(22) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `query_status` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `sj_inspections`;
CREATE TABLE `sj_inspections` (
  `sj_inspection_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` smallint(6) NOT NULL,
  `inspection_date` date NOT NULL,
  `inspection_under_act` varchar(200) NOT NULL,
  `cb_name` varchar(200) NOT NULL,
  `cb_address` varchar(200) NOT NULL,
  `cb_type` tinyint(1) NOT NULL,
  `inspection_details` text NOT NULL,
  `remarks` text NOT NULL,
  `ir_remarks` text NOT NULL,
  `inspection_report` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`sj_inspection_id`),
  KEY `cb_type` (`cb_type`),
  KEY `cb_name` (`cb_name`),
  KEY `cb_address` (`cb_address`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `smv_transport`;
CREATE TABLE `smv_transport` (
  `smv_transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `smv_act` varchar(50) NOT NULL,
  `smv_description` text NOT NULL,
  `smv_tw` int(11) NOT NULL,
  `smv_lmgpv` varchar(200) NOT NULL,
  `smv_ov` varchar(200) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`smv_transport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `smv_watgst`;
CREATE TABLE `smv_watgst` (
  `smv_watgst_id` int(11) NOT NULL AUTO_INCREMENT,
  `smv_act` varchar(100) NOT NULL,
  `smv_act_desc` varchar(200) NOT NULL,
  `smv_description` text NOT NULL,
  `smv_op` text NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`smv_watgst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `society_registration`;
CREATE TABLE `society_registration` (
  `society_registration_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `applicant_name` varchar(200) NOT NULL,
  `applicant_address` varchar(200) NOT NULL,
  `applicant_mobile_number` varchar(10) NOT NULL,
  `society_name` varchar(200) NOT NULL,
  `society_address` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `letter_remarks` varchar(200) NOT NULL,
  `letter` varchar(200) NOT NULL,
  `letter_updated_date` datetime NOT NULL,
  `letter_status` tinyint(1) NOT NULL,
  `passbook` varchar(200) NOT NULL,
  `passbook_updated_date` datetime NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`society_registration_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `applicant_name` (`applicant_name`),
  KEY `applicant_address` (`applicant_address`),
  KEY `applicant_mobile_number` (`applicant_mobile_number`),
  KEY `society_name` (`society_name`),
  KEY `society_address` (`society_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `state`;
CREATE TABLE `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_code` tinyint(4) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`state_id`),
  KEY `state_code` (`state_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `sub_lessee`;
CREATE TABLE `sub_lessee` (
  `sublessee_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `state` varchar(200) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `taluka` varchar(200) NOT NULL,
  `village` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `plot_no` varchar(200) NOT NULL,
  `survey_no` varchar(200) NOT NULL,
  `admeasuring` varchar(200) NOT NULL,
  `govt_industrial_estate_area` varchar(200) NOT NULL,
  `name_of_manufacturing` varchar(200) NOT NULL,
  `request_letter` tinyint(1) NOT NULL,
  `request_letter_manufacture` varchar(200) NOT NULL,
  `detail_project` tinyint(1) NOT NULL,
  `detail_project_report` varchar(200) NOT NULL,
  `partnership_deed` tinyint(1) NOT NULL,
  `memorandum_partnership_deed` varchar(200) NOT NULL,
  `sign_sublessee` tinyint(1) NOT NULL,
  `behalf_sign_sublessee` varchar(200) NOT NULL,
  `signature` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`sublessee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `sub_letting`;
CREATE TABLE `sub_letting` (
  `subletting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `state` varchar(200) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `taluka` varchar(200) NOT NULL,
  `village` varchar(200) NOT NULL,
  `application_date` varchar(200) NOT NULL,
  `plot_no` varchar(200) NOT NULL,
  `survey_no` varchar(200) NOT NULL,
  `admeasuring` varchar(200) NOT NULL,
  `govt_industrial_estate_area` varchar(200) NOT NULL,
  `name_of_manufacturing` varchar(200) NOT NULL,
  `request_letter` tinyint(1) NOT NULL,
  `request_letter_premises` varchar(200) NOT NULL,
  `original_extract` tinyint(1) NOT NULL,
  `original_extract_certificate` varchar(200) NOT NULL,
  `land_revenue` tinyint(1) NOT NULL,
  `land_revenue_certificate` varchar(200) NOT NULL,
  `electricity_bill` tinyint(1) NOT NULL,
  `electricity_bill_certificate` varchar(200) NOT NULL,
  `bank_loan` tinyint(1) NOT NULL,
  `bank_loan_certificate` varchar(200) NOT NULL,
  `panchayat_tax` tinyint(1) NOT NULL,
  `panchayat_tax_certificate` varchar(200) NOT NULL,
  `challan_of_lease` tinyint(1) NOT NULL,
  `challan_of_lease_rent` varchar(200) NOT NULL,
  `occupancy` tinyint(1) NOT NULL,
  `occupancy_certificate` varchar(200) NOT NULL,
  `central_excise` tinyint(1) NOT NULL,
  `central_excise_certificate` varchar(200) NOT NULL,
  `authorization_sign` tinyint(1) NOT NULL,
  `authorization_sign_lessee` varchar(200) NOT NULL,
  `signature` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`subletting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `swp_admin_sessions`;
CREATE TABLE `swp_admin_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `swp_sessions`;
CREATE TABLE `swp_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `textile`;
CREATE TABLE `textile` (
  `textile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
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
  `form_application_checklist` varchar(50) NOT NULL,
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
  `doc_12` varchar(100) NOT NULL,
  `doc_13` varchar(100) NOT NULL,
  `doc_14` varchar(100) NOT NULL,
  `doc_15` varchar(100) NOT NULL,
  `doc_16` varchar(100) NOT NULL,
  `doc_17` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`textile_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `enterprise_name` (`enterprise_name`),
  KEY `office_address` (`office_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `textile_checklist`;
CREATE TABLE `textile_checklist` (
  `checklist_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_capital_investment` int(11) NOT NULL,
  `is_intrest_subsidy` int(11) NOT NULL,
  `entrepreneur_memorandum_uploader` varchar(200) NOT NULL,
  `partnership_deed_uploader` varchar(200) NOT NULL,
  `lease_agreement_uploader` varchar(200) NOT NULL,
  `loan_sanction_uploader` varchar(200) NOT NULL,
  `power_release_order_uploader` varchar(200) NOT NULL,
  `invoice_copy_uploader` varchar(200) NOT NULL,
  `ca_prescribed_uploader` varchar(200) NOT NULL,
  `certificate_commencement_uploader` varchar(200) NOT NULL,
  `engineer_certificate_uploader` varchar(200) NOT NULL,
  `expenses_certificate_uploader` varchar(200) NOT NULL,
  `stamped_receipt_uploader` varchar(200) NOT NULL,
  `sale_invoice_uploader` varchar(200) NOT NULL,
  `additional_document_uploader` varchar(200) NOT NULL,
  `factorylicence_copy_uploader` varchar(200) NOT NULL,
  `pcc_copy_uploader` varchar(200) NOT NULL,
  `expansion_date_uploader` varchar(200) NOT NULL,
  `production_turnover_uploader` varchar(200) NOT NULL,
  `fix_assets_value_uploader` varchar(200) NOT NULL,
  `production_capacity_uploader` varchar(200) NOT NULL,
  `patent_registration_uploader` varchar(200) NOT NULL,
  `energy_water_uploader` varchar(200) NOT NULL,
  `quality_certificate_uploader` varchar(200) NOT NULL,
  `resident_certificate_uploader` varchar(200) NOT NULL,
  `bank_total_interest_uploader` varchar(200) NOT NULL,
  `bank_statement_uploader` varchar(200) NOT NULL,
  `annexure3_declaration_uploader` varchar(200) NOT NULL,
  `interest_subsidy_cal_uploader` varchar(200) NOT NULL,
  `year_annual_prod_uploader` varchar(200) NOT NULL,
  `year_bank_statement_uploader` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`checklist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `textile_declaration`;
CREATE TABLE `textile_declaration` (
  `declaration_id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sign_seal` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`declaration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `tourismevent`;
CREATE TABLE `tourismevent` (
  `tourismevent_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_person` varchar(100) NOT NULL,
  `name_of_event` varchar(100) NOT NULL,
  `location_of_event` varchar(100) NOT NULL,
  `date_of_event` date NOT NULL,
  `time_of_event` varchar(10) NOT NULL,
  `duration_of_event` varchar(100) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
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
  `remarks` text NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`tourismevent_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_person` (`name_of_person`),
  KEY `name_of_event` (`name_of_event`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `transfer`;
CREATE TABLE `transfer` (
  `transfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `application_date` date NOT NULL,
  `state` varchar(100) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `taluka` varchar(100) NOT NULL,
  `village` varchar(20) NOT NULL,
  `plot_no` varchar(100) NOT NULL,
  `survey_no` varchar(100) NOT NULL,
  `admeasuring_square_metre` varchar(10) NOT NULL,
  `govt_industrial_estate_area` varchar(100) NOT NULL,
  `reason_of_transfer` varchar(100) NOT NULL,
  `transferer_name` varchar(100) NOT NULL,
  `name_of_servicing` varchar(100) NOT NULL,
  `other_services` varchar(100) NOT NULL,
  `aadhar_no` varchar(200) NOT NULL,
  `pan_no` varchar(200) NOT NULL,
  `gst_no` varchar(200) NOT NULL,
  `account_no` varchar(200) NOT NULL,
  `request_letter` varchar(200) NOT NULL,
  `request_letter_upload` varchar(200) NOT NULL,
  `project_report` varchar(200) NOT NULL,
  `project_report_upload` varchar(200) NOT NULL,
  `constitution_project` varchar(200) NOT NULL,
  `constitution_project_upload` varchar(200) NOT NULL,
  `valid_authorization` varchar(200) NOT NULL,
  `valid_authorization_upload` varchar(200) NOT NULL,
  `sign_seal` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`transfer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transfer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `travelagent`;
CREATE TABLE `travelagent` (
  `travelagent_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_person` varchar(100) NOT NULL,
  `name_of_travel_agency` varchar(100) NOT NULL,
  `address_of_agency` varchar(100) NOT NULL,
  `area_of_agency` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `fees` varchar(100) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
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
  `last_valid_upto` date NOT NULL,
  `remarks` text NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`travelagent_id`),
  KEY `area_of_agency` (`area_of_agency`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_person` (`name_of_person`),
  KEY `name_of_travel_agency` (`name_of_travel_agency`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `travelagent_renewal`;
CREATE TABLE `travelagent_renewal` (
  `travelagent_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `travelagent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_travel_agency` varchar(100) NOT NULL,
  `address_of_agency` varchar(200) NOT NULL,
  `name_of_proprietor` varchar(100) NOT NULL,
  `fees` varchar(10) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
  `area_of_agency` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `challan_number` varchar(100) NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `last_valid_upto` date NOT NULL,
  `remarks` text NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`travelagent_renewal_id`),
  KEY `area_of_agency` (`area_of_agency`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_travel_agency` (`name_of_travel_agency`),
  KEY `address_of_agency` (`address_of_agency`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `tree_cutting`;
CREATE TABLE `tree_cutting` (
  `tree_cutting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `village_dmc_ward` tinyint(4) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `applicant_name` varchar(200) NOT NULL,
  `applicant_address` varchar(200) NOT NULL,
  `applicant_mobile_number` varchar(10) NOT NULL,
  `owner_name` varchar(200) NOT NULL,
  `owner_address` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `certificate_file` varchar(100) NOT NULL,
  `final_certificate` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`tree_cutting_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `applicant_name` (`applicant_name`),
  KEY `applicant_address` (`applicant_address`),
  KEY `applicant_mobile_number` (`applicant_mobile_number`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_name` varchar(100) NOT NULL,
  `applicant_address` varchar(200) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `pin` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_verify_mobile` tinyint(1) NOT NULL,
  `verify_mobile_datetime` datetime NOT NULL,
  `is_verify_email` tinyint(1) NOT NULL,
  `verify_email_datetime` datetime NOT NULL,
  `temp_access_token` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `applicant_name` (`applicant_name`),
  KEY `mobile_number` (`mobile_number`),
  KEY `email` (`email`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `vc`;
CREATE TABLE `vc` (
  `vc_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_applicant` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `trade` tinyint(1) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `sub_type` tinyint(1) NOT NULL,
  `capacity` int(5) NOT NULL,
  `capacity_type` tinyint(1) NOT NULL,
  `class` tinyint(1) NOT NULL,
  `make` varchar(200) NOT NULL,
  `model_no` varchar(100) NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `verification_at` tinyint(1) NOT NULL,
  `quantity_units` tinyint(1) NOT NULL,
  `invoice_doc` varchar(200) NOT NULL,
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
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`vc_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_applicant` (`name_of_applicant`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP VIEW IF EXISTS `view_get_ds_wise_appli_licence_count`;
CREATE TABLE `view_get_ds_wise_appli_licence_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_appli_licence_renewal_count`;
CREATE TABLE `view_get_ds_wise_appli_licence_renewal_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_bocw_count`;
CREATE TABLE `view_get_ds_wise_bocw_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_boileract_count`;
CREATE TABLE `view_get_ds_wise_boileract_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_boileract_renewal_count`;
CREATE TABLE `view_get_ds_wise_boileract_renewal_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(25,0), `processing_days` tinyint(1));


DROP VIEW IF EXISTS `view_get_ds_wise_boilermanufactures_count`;
CREATE TABLE `view_get_ds_wise_boilermanufactures_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_buildingplan_count`;
CREATE TABLE `view_get_ds_wise_buildingplan_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_cinema_count`;
CREATE TABLE `view_get_ds_wise_cinema_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_construction_count`;
CREATE TABLE `view_get_ds_wise_construction_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_establishment_count`;
CREATE TABLE `view_get_ds_wise_establishment_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_factorylicence_count`;
CREATE TABLE `view_get_ds_wise_factorylicence_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_factorylicence_renewal_count`;
CREATE TABLE `view_get_ds_wise_factorylicence_renewal_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(4), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(25,0), `processing_days` tinyint(4));


DROP VIEW IF EXISTS `view_get_ds_wise_filmshooting_count`;
CREATE TABLE `view_get_ds_wise_filmshooting_count` (`district` tinyint(1), `user_id` int(11), `query_status` int(11), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_hotel_count`;
CREATE TABLE `view_get_ds_wise_hotel_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_hotel_renewal_count`;
CREATE TABLE `view_get_ds_wise_hotel_renewal_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_inspection_count`;
CREATE TABLE `view_get_ds_wise_inspection_count` (`district` tinyint(1), `user_id` int(11), `query_status` int(11), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_ips_incentive_count`;
CREATE TABLE `view_get_ds_wise_ips_incentive_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_land_allotment_count`;
CREATE TABLE `view_get_ds_wise_land_allotment_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_lease_seller_count`;
CREATE TABLE `view_get_ds_wise_lease_seller_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_migrantworkers_count`;
CREATE TABLE `view_get_ds_wise_migrantworkers_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_migrantworkers_renewal_count`;
CREATE TABLE `view_get_ds_wise_migrantworkers_renewal_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_msme_count`;
CREATE TABLE `view_get_ds_wise_msme_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_na_count`;
CREATE TABLE `view_get_ds_wise_na_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_nil_certificate_count`;
CREATE TABLE `view_get_ds_wise_nil_certificate_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_noc_count`;
CREATE TABLE `view_get_ds_wise_noc_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_occupancy_certificate_count`;
CREATE TABLE `view_get_ds_wise_occupancy_certificate_count` (`district` tinyint(1), `user_id` int(11), `query_status` int(11), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_periodicalreturn_count`;
CREATE TABLE `view_get_ds_wise_periodicalreturn_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_property_registration_count`;
CREATE TABLE `view_get_ds_wise_property_registration_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_psf_registration_count`;
CREATE TABLE `view_get_ds_wise_psf_registration_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_rii_count`;
CREATE TABLE `view_get_ds_wise_rii_count` (`district` int(11), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_shop_count`;
CREATE TABLE `view_get_ds_wise_shop_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_shop_renewal_count`;
CREATE TABLE `view_get_ds_wise_shop_renewal_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_singlereturn_count`;
CREATE TABLE `view_get_ds_wise_singlereturn_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_site_elevation_count`;
CREATE TABLE `view_get_ds_wise_site_elevation_count` (`district` tinyint(1), `user_id` int(11), `query_status` varchar(200), `status` tinyint(2), `total_records` bigint(21), `total_processing_days` decimal(43,0), `processing_days` int(22));


DROP VIEW IF EXISTS `view_get_ds_wise_society_registration_count`;
CREATE TABLE `view_get_ds_wise_society_registration_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_sub_lessee_count`;
CREATE TABLE `view_get_ds_wise_sub_lessee_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_sub_letting_count`;
CREATE TABLE `view_get_ds_wise_sub_letting_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_textile_count`;
CREATE TABLE `view_get_ds_wise_textile_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_tourismevent_count`;
CREATE TABLE `view_get_ds_wise_tourismevent_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_transfer_count`;
CREATE TABLE `view_get_ds_wise_transfer_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_travelagent_count`;
CREATE TABLE `view_get_ds_wise_travelagent_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_travelagent_renewal_count`;
CREATE TABLE `view_get_ds_wise_travelagent_renewal_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_tree_cutting_count`;
CREATE TABLE `view_get_ds_wise_tree_cutting_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_vc_count`;
CREATE TABLE `view_get_ds_wise_vc_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_wc_count`;
CREATE TABLE `view_get_ds_wise_wc_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_wm_dealer_count`;
CREATE TABLE `view_get_ds_wise_wm_dealer_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(4), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_wm_dealer_renewal_count`;
CREATE TABLE `view_get_ds_wise_wm_dealer_renewal_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(4), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_wm_manufacturer_count`;
CREATE TABLE `view_get_ds_wise_wm_manufacturer_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(4), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_wm_manufacturer_renewal_count`;
CREATE TABLE `view_get_ds_wise_wm_manufacturer_renewal_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(4), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_wm_registration_count`;
CREATE TABLE `view_get_ds_wise_wm_registration_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_wm_repairer_count`;
CREATE TABLE `view_get_ds_wise_wm_repairer_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_wm_repairer_renewal_count`;
CREATE TABLE `view_get_ds_wise_wm_repairer_renewal_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_ds_wise_zone_information_count`;
CREATE TABLE `view_get_ds_wise_zone_information_count` (`district` tinyint(1), `user_id` int(11), `query_status` varchar(200), `status` tinyint(2), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_appli_licence_count`;
CREATE TABLE `view_get_status_wise_appli_licence_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_appli_licence_renewal_count`;
CREATE TABLE `view_get_status_wise_appli_licence_renewal_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_bocw_count`;
CREATE TABLE `view_get_status_wise_bocw_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_boileract_count`;
CREATE TABLE `view_get_status_wise_boileract_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_boileract_renewal_count`;
CREATE TABLE `view_get_status_wise_boileract_renewal_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(25,0), `processing_days` tinyint(1));


DROP VIEW IF EXISTS `view_get_status_wise_boilermanufactures_count`;
CREATE TABLE `view_get_status_wise_boilermanufactures_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_buildingplan_count`;
CREATE TABLE `view_get_status_wise_buildingplan_count` (`status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_cinema_count`;
CREATE TABLE `view_get_status_wise_cinema_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_construction_count`;
CREATE TABLE `view_get_status_wise_construction_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_establishment_count`;
CREATE TABLE `view_get_status_wise_establishment_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_factorylicence_count`;
CREATE TABLE `view_get_status_wise_factorylicence_count` (`status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_factorylicence_renewal_count`;
CREATE TABLE `view_get_status_wise_factorylicence_renewal_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(25,0), `processing_days` tinyint(4));


DROP VIEW IF EXISTS `view_get_status_wise_filmshooting_count`;
CREATE TABLE `view_get_status_wise_filmshooting_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_hotel_count`;
CREATE TABLE `view_get_status_wise_hotel_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_hotel_renewal_count`;
CREATE TABLE `view_get_status_wise_hotel_renewal_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_incentive_generalform_count`;
CREATE TABLE `view_get_status_wise_incentive_generalform_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_incentive_generalform_textile_count`;
CREATE TABLE `view_get_status_wise_incentive_generalform_textile_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_inspection_count`;
CREATE TABLE `view_get_status_wise_inspection_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_ips_incentive_count`;
CREATE TABLE `view_get_status_wise_ips_incentive_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_land_allotment_count`;
CREATE TABLE `view_get_status_wise_land_allotment_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_lease_seller_count`;
CREATE TABLE `view_get_status_wise_lease_seller_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_migrantworkers_count`;
CREATE TABLE `view_get_status_wise_migrantworkers_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_migrantworkers_renewal_count`;
CREATE TABLE `view_get_status_wise_migrantworkers_renewal_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_msme_count`;
CREATE TABLE `view_get_status_wise_msme_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_na_count`;
CREATE TABLE `view_get_status_wise_na_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_nil_certificate_count`;
CREATE TABLE `view_get_status_wise_nil_certificate_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_noc_count`;
CREATE TABLE `view_get_status_wise_noc_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_occupancy_certificate_count`;
CREATE TABLE `view_get_status_wise_occupancy_certificate_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_periodicalreturn_count`;
CREATE TABLE `view_get_status_wise_periodicalreturn_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_property_registration_count`;
CREATE TABLE `view_get_status_wise_property_registration_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_psf_registration_count`;
CREATE TABLE `view_get_status_wise_psf_registration_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_query_grievance_count`;
CREATE TABLE `view_get_status_wise_query_grievance_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11), `industry_classification` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_rii_count`;
CREATE TABLE `view_get_status_wise_rii_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_shop_count`;
CREATE TABLE `view_get_status_wise_shop_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_shop_renewal_count`;
CREATE TABLE `view_get_status_wise_shop_renewal_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_singlereturn_count`;
CREATE TABLE `view_get_status_wise_singlereturn_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_site_elevation_count`;
CREATE TABLE `view_get_status_wise_site_elevation_count` (`status` tinyint(2), `total_records` bigint(21), `total_processing_days` decimal(43,0), `processing_days` int(22));


DROP VIEW IF EXISTS `view_get_status_wise_society_registration_count`;
CREATE TABLE `view_get_status_wise_society_registration_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_sub_lessee_count`;
CREATE TABLE `view_get_status_wise_sub_lessee_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_sub_letting_count`;
CREATE TABLE `view_get_status_wise_sub_letting_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_textile_count`;
CREATE TABLE `view_get_status_wise_textile_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_tourismevent_count`;
CREATE TABLE `view_get_status_wise_tourismevent_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_transfer_count`;
CREATE TABLE `view_get_status_wise_transfer_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_travelagent_count`;
CREATE TABLE `view_get_status_wise_travelagent_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_travelagent_renewal_count`;
CREATE TABLE `view_get_status_wise_travelagent_renewal_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_tree_cutting_count`;
CREATE TABLE `view_get_status_wise_tree_cutting_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_vc_count`;
CREATE TABLE `view_get_status_wise_vc_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wc_count`;
CREATE TABLE `view_get_status_wise_wc_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_dealer_count`;
CREATE TABLE `view_get_status_wise_wm_dealer_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_dealer_renewal_count`;
CREATE TABLE `view_get_status_wise_wm_dealer_renewal_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_manufacturer_count`;
CREATE TABLE `view_get_status_wise_wm_manufacturer_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_manufacturer_renewal_count`;
CREATE TABLE `view_get_status_wise_wm_manufacturer_renewal_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_registration_count`;
CREATE TABLE `view_get_status_wise_wm_registration_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_repairer_count`;
CREATE TABLE `view_get_status_wise_wm_repairer_count` (`status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_repairer_renewal_count`;
CREATE TABLE `view_get_status_wise_wm_repairer_renewal_count` (`status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_zone_information_count`;
CREATE TABLE `view_get_status_wise_zone_information_count` (`status` tinyint(2), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP TABLE IF EXISTS `villages`;
CREATE TABLE `villages` (
  `village_id` int(11) NOT NULL AUTO_INCREMENT,
  `village_name` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`village_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


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
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `id_proof` varchar(100) NOT NULL,
  `electricity_bill` varchar(100) NOT NULL,
  `declaration` tinyint(1) NOT NULL,
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
  `withdrawal_remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`wc_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_applicant` (`name_of_applicant`),
  KEY `wc_type` (`wc_type`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `wm_dealer`;
CREATE TABLE `wm_dealer` (
  `dealer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_dealer` varchar(200) NOT NULL,
  `complete_address` varchar(200) NOT NULL,
  `dealer_license_no` varchar(200) NOT NULL,
  `establishment_date` date NOT NULL,
  `is_limited_company` int(11) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_date` date NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `categories_sold` varchar(200) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(200) NOT NULL,
  `any_previous_application` varchar(200) NOT NULL,
  `license_application_date` varchar(200) NOT NULL,
  `license_application_result` varchar(200) NOT NULL,
  `import_from_outside` varchar(200) NOT NULL,
  `registration_of_importer` varchar(200) NOT NULL,
  `model_approval_certificate` varchar(200) NOT NULL,
  `proof_of_ownership` varchar(200) NOT NULL,
  `gst_certificate` varchar(200) NOT NULL,
  `partnership_deed` varchar(200) NOT NULL,
  `memorandum_of_association` varchar(200) NOT NULL,
  `list_of_raw_material` varchar(200) NOT NULL,
  `list_of_machinery` varchar(200) NOT NULL,
  `list_of_wm` varchar(200) NOT NULL,
  `list_of_directors` varchar(200) NOT NULL,
  `date_of_application` date NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `signature` varchar(200) NOT NULL,
  `import_model` varchar(200) NOT NULL,
  `query_status` tinyint(4) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`dealer_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_dealer` (`name_of_dealer`),
  KEY `complete_address` (`complete_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `wm_dealer_renewal`;
CREATE TABLE `wm_dealer_renewal` (
  `dealer_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `dealer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_dealer` varchar(200) NOT NULL,
  `complete_address` varchar(200) NOT NULL,
  `license_number` varchar(200) NOT NULL,
  `dealer_license_no` varchar(200) NOT NULL,
  `establishment_date` date NOT NULL,
  `is_limited_company` int(11) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_date` date NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `categories_sold` varchar(200) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(200) NOT NULL,
  `any_previous_application` varchar(200) NOT NULL,
  `license_application_date` varchar(200) NOT NULL,
  `license_application_result` varchar(200) NOT NULL,
  `import_from_outside` varchar(200) NOT NULL,
  `registration_of_importer` varchar(200) NOT NULL,
  `original_licence` varchar(200) NOT NULL,
  `renewed_licence` varchar(200) NOT NULL,
  `periodical_return` varchar(200) NOT NULL,
  `verification_certificate` varchar(200) NOT NULL,
  `date_of_application` date NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `signature` varchar(200) NOT NULL,
  `import_model` varchar(200) NOT NULL,
  `query_status` tinyint(4) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`dealer_renewal_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_dealer` (`name_of_dealer`),
  KEY `complete_address` (`complete_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `wm_manufacturer`;
CREATE TABLE `wm_manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_manufacturer` varchar(200) NOT NULL,
  `complete_address` varchar(200) NOT NULL,
  `premises_status` int(11) NOT NULL,
  `establishment_date` date NOT NULL,
  `is_limited_company` int(11) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_date` date NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `manufacturing_activity` varchar(200) NOT NULL,
  `weights_type` varchar(200) NOT NULL,
  `measures_type` varchar(200) NOT NULL,
  `weighing_instruments_type` varchar(200) NOT NULL,
  `measuring_instruments_type` varchar(200) NOT NULL,
  `no_of_skilled` int(11) NOT NULL,
  `no_of_semiskilled` int(11) NOT NULL,
  `no_of_unskilled` int(11) NOT NULL,
  `no_of_specialist` int(11) NOT NULL,
  `details_of_personnel` varchar(200) NOT NULL,
  `details_of_machinery` varchar(200) NOT NULL,
  `details_of_foundry` varchar(200) NOT NULL,
  `steel_casting_facility` varchar(200) NOT NULL,
  `electric_energy_availability` varchar(200) NOT NULL,
  `details_of_loan` varchar(200) NOT NULL,
  `banker_names` varchar(200) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(200) NOT NULL,
  `any_previous_application` varchar(200) NOT NULL,
  `license_application_date` date NOT NULL,
  `license_application_result` varchar(200) NOT NULL,
  `location_of_selling` varchar(200) NOT NULL,
  `model_approval_detail` varchar(200) NOT NULL,
  `inspection_sample_date` date NOT NULL,
  `date_of_application` date NOT NULL,
  `signature` varchar(200) NOT NULL,
  `support_document` varchar(200) NOT NULL,
  `monogram_uploader` varchar(200) NOT NULL,
  `model_approval_certificate` varchar(200) NOT NULL,
  `proof_of_ownership` varchar(200) NOT NULL,
  `gst_certificate` varchar(200) NOT NULL,
  `partnership_deed` varchar(200) NOT NULL,
  `memorandum_of_association` varchar(200) NOT NULL,
  `list_of_raw_material` varchar(200) NOT NULL,
  `list_of_machinery` varchar(200) NOT NULL,
  `list_of_wm` varchar(200) NOT NULL,
  `list_of_directors` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `query_status` tinyint(4) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`manufacturer_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_manufacturer` (`name_of_manufacturer`),
  KEY `complete_address` (`complete_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `wm_manufacturer_renewal`;
CREATE TABLE `wm_manufacturer_renewal` (
  `manufacturer_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_manufacturer` varchar(200) NOT NULL,
  `complete_address` varchar(200) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(200) NOT NULL,
  `license_number` varchar(200) NOT NULL,
  `premises_status` int(11) NOT NULL,
  `is_limited_company` int(11) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_date` date NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `weights_type` varchar(200) NOT NULL,
  `propose_change` varchar(200) NOT NULL,
  `production_sales` varchar(200) NOT NULL,
  `details_of_foundry` varchar(200) NOT NULL,
  `date_of_application` date NOT NULL,
  `signature` varchar(200) NOT NULL,
  `monogram_uploader` varchar(200) NOT NULL,
  `original_licence` varchar(200) NOT NULL,
  `renewed_licence` varchar(200) NOT NULL,
  `periodical_return` varchar(200) NOT NULL,
  `verification_certificate` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `query_status` tinyint(4) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`manufacturer_renewal_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_manufacturer` (`name_of_manufacturer`),
  KEY `complete_address` (`complete_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `wm_registration`;
CREATE TABLE `wm_registration` (
  `wmregistration_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_applicant` varchar(200) NOT NULL,
  `application_category` varchar(200) NOT NULL,
  `item_detail` varchar(200) NOT NULL,
  `branches` varchar(200) NOT NULL,
  `location_of_factory` varchar(200) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `trade_licence` varchar(200) NOT NULL,
  `proof_of_ownership` varchar(200) NOT NULL,
  `gst_certificate` varchar(200) NOT NULL,
  `partnership_deed` varchar(200) NOT NULL,
  `memorandum_articles` varchar(200) NOT NULL,
  `item_to_be_packed` varchar(200) NOT NULL,
  `list_of_directors` varchar(200) NOT NULL,
  `code_certificate` varchar(200) NOT NULL,
  `signature` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`wmregistration_id`),
  KEY `name_of_applicant` (`name_of_applicant`),
  KEY `application_category` (`application_category`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`),
  KEY `entity_establishment_type` (`entity_establishment_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `wm_repairer`;
CREATE TABLE `wm_repairer` (
  `repairer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_repairer` varchar(200) NOT NULL,
  `complete_address` varchar(200) NOT NULL,
  `premises_status` int(11) NOT NULL,
  `establishment_date` date NOT NULL,
  `is_limited_company` tinyint(4) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_date` date NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(200) NOT NULL,
  `weights_type` varchar(200) NOT NULL,
  `area_operate` varchar(200) NOT NULL,
  `previous_experience` varchar(200) NOT NULL,
  `no_of_skilled` int(11) NOT NULL,
  `no_of_semiskilled` int(11) NOT NULL,
  `no_of_unskilled` int(11) NOT NULL,
  `no_of_specialist` int(11) NOT NULL,
  `details_of_personnel` varchar(200) NOT NULL,
  `details_of_machinery` varchar(200) NOT NULL,
  `electric_energy_availability` varchar(200) NOT NULL,
  `sufficient_stock` varchar(200) NOT NULL,
  `stock_details` varchar(200) NOT NULL,
  `any_previous_application` varchar(200) NOT NULL,
  `license_application_date` varchar(200) NOT NULL,
  `license_application_result` varchar(200) NOT NULL,
  `proof_of_ownership` varchar(200) NOT NULL,
  `gst_certificate` varchar(200) NOT NULL,
  `education_qualification` varchar(200) NOT NULL,
  `experience_certificate` varchar(200) NOT NULL,
  `partnership_deed` varchar(200) NOT NULL,
  `memorandum_of_association` varchar(200) NOT NULL,
  `list_of_raw_material` varchar(200) NOT NULL,
  `list_of_machinery` varchar(200) NOT NULL,
  `list_of_wm` varchar(200) NOT NULL,
  `list_of_directors` varchar(200) NOT NULL,
  `date_of_application` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `signature` varchar(200) NOT NULL,
  `support_document` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  PRIMARY KEY (`repairer_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_repairer` (`name_of_repairer`),
  KEY `premises_status` (`premises_status`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `wm_repairer_renewal`;
CREATE TABLE `wm_repairer_renewal` (
  `repairer_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `repairer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `entity_establishment_type` tinyint(1) NOT NULL,
  `name_of_repairer` varchar(200) NOT NULL,
  `complete_address` varchar(200) NOT NULL,
  `license_number` varchar(200) NOT NULL,
  `is_limited_company` tinyint(4) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_date` date NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(200) NOT NULL,
  `weights_type` varchar(200) NOT NULL,
  `propose_change` varchar(200) NOT NULL,
  `area_operate` varchar(200) NOT NULL,
  `sufficient_stock` varchar(200) NOT NULL,
  `stock_details` varchar(200) NOT NULL,
  `original_licence` varchar(200) NOT NULL,
  `renewed_licence` varchar(200) NOT NULL,
  `periodical_return` varchar(200) NOT NULL,
  `verification_certificate` varchar(200) NOT NULL,
  `date_of_application` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `withdrawal_remarks` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `total_fees` decimal(10,0) NOT NULL,
  `last_op_reference_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `signature` varchar(200) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `feedback` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fr_datetime` datetime NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  PRIMARY KEY (`repairer_renewal_id`),
  KEY `district` (`district`),
  KEY `entity_establishment_type` (`entity_establishment_type`),
  KEY `name_of_repairer` (`name_of_repairer`),
  KEY `complete_address` (`complete_address`),
  KEY `status` (`status`),
  KEY `query_status` (`query_status`),
  KEY `last_op_reference_number` (`last_op_reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `zone_information`;
CREATE TABLE `zone_information` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `name_of_applicant` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `application_date` date NOT NULL,
  `pts_no` varchar(200) NOT NULL,
  `survey_no` varchar(50) NOT NULL,
  `village` varchar(200) NOT NULL,
  `site_plan` varchar(200) NOT NULL,
  `I_XIV_nakal` varchar(200) NOT NULL,
  `signature` varchar(200) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(200) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(200) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(200) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `query_status` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `view_get_ds_wise_appli_licence_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_appli_licence_count` AS select `appli_licence`.`district` AS `district`,`appli_licence`.`user_id` AS `user_id`,`appli_licence`.`query_status` AS `query_status`,`appli_licence`.`status` AS `status`,count(`appli_licence`.`aplicence_id`) AS `total_records`,sum(`appli_licence`.`processing_days`) AS `total_processing_days`,`appli_licence`.`processing_days` AS `processing_days` from `appli_licence` where `appli_licence`.`is_delete` <> 1 group by `appli_licence`.`district`,`appli_licence`.`user_id`,`appli_licence`.`query_status`,`appli_licence`.`status`,`appli_licence`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_appli_licence_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_appli_licence_renewal_count` AS select `appli_licence_renewal`.`district` AS `district`,`appli_licence_renewal`.`user_id` AS `user_id`,`appli_licence_renewal`.`query_status` AS `query_status`,`appli_licence_renewal`.`status` AS `status`,count(`appli_licence_renewal`.`aplicence_renewal_id`) AS `total_records`,sum(`appli_licence_renewal`.`processing_days`) AS `total_processing_days`,`appli_licence_renewal`.`processing_days` AS `processing_days` from `appli_licence_renewal` where `appli_licence_renewal`.`is_delete` <> 1 group by `appli_licence_renewal`.`district`,`appli_licence_renewal`.`user_id`,`appli_licence_renewal`.`query_status`,`appli_licence_renewal`.`status`,`appli_licence_renewal`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_bocw_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_bocw_count` AS select `bocw`.`district` AS `district`,`bocw`.`user_id` AS `user_id`,`bocw`.`query_status` AS `query_status`,`bocw`.`status` AS `status`,count(`bocw`.`bocw_id`) AS `total_records`,sum(`bocw`.`processing_days`) AS `total_processing_days`,`bocw`.`processing_days` AS `processing_days` from `bocw` where `bocw`.`is_delete` <> 1 group by `bocw`.`district`,`bocw`.`user_id`,`bocw`.`query_status`,`bocw`.`status`,`bocw`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_boileract_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_boileract_count` AS select `boileract`.`district` AS `district`,`boileract`.`user_id` AS `user_id`,`boileract`.`query_status` AS `query_status`,`boileract`.`status` AS `status`,count(`boileract`.`boiler_id`) AS `total_records`,sum(`boileract`.`processing_days`) AS `total_processing_days`,`boileract`.`processing_days` AS `processing_days` from `boileract` where `boileract`.`is_delete` <> 1 group by `boileract`.`district`,`boileract`.`user_id`,`boileract`.`query_status`,`boileract`.`status`,`boileract`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_boileract_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_boileract_renewal_count` AS select `boileract_renewal`.`district` AS `district`,`boileract_renewal`.`user_id` AS `user_id`,`boileract_renewal`.`query_status` AS `query_status`,`boileract_renewal`.`status` AS `status`,count(`boileract_renewal`.`boiler_renewal_id`) AS `total_records`,sum(`boileract_renewal`.`processing_days`) AS `total_processing_days`,`boileract_renewal`.`processing_days` AS `processing_days` from `boileract_renewal` where `boileract_renewal`.`is_delete` <> 1 group by `boileract_renewal`.`district`,`boileract_renewal`.`user_id`,`boileract_renewal`.`query_status`,`boileract_renewal`.`status`,`boileract_renewal`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_boilermanufactures_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_boilermanufactures_count` AS select `boilermanufactures`.`district` AS `district`,`boilermanufactures`.`user_id` AS `user_id`,`boilermanufactures`.`query_status` AS `query_status`,`boilermanufactures`.`status` AS `status`,count(`boilermanufactures`.`boilermanufacture_id`) AS `total_records`,sum(`boilermanufactures`.`processing_days`) AS `total_processing_days`,`boilermanufactures`.`processing_days` AS `processing_days` from `boilermanufactures` where `boilermanufactures`.`is_delete` <> 1 group by `boilermanufactures`.`district`,`boilermanufactures`.`user_id`,`boilermanufactures`.`query_status`,`boilermanufactures`.`status`,`boilermanufactures`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_buildingplan_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_buildingplan_count` AS select `buildingplan`.`district` AS `district`,`buildingplan`.`user_id` AS `user_id`,`buildingplan`.`query_status` AS `query_status`,`buildingplan`.`status` AS `status`,count(`buildingplan`.`buildingplan_id`) AS `total_records`,sum(`buildingplan`.`processing_days`) AS `total_processing_days`,`buildingplan`.`processing_days` AS `processing_days` from `buildingplan` where `buildingplan`.`is_delete` <> 1 group by `buildingplan`.`district`,`buildingplan`.`user_id`,`buildingplan`.`query_status`,`buildingplan`.`status`,`buildingplan`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_cinema_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_cinema_count` AS select `cinema`.`district` AS `district`,`cinema`.`user_id` AS `user_id`,`cinema`.`query_status` AS `query_status`,`cinema`.`status` AS `status`,count(`cinema`.`cinema_id`) AS `total_records`,sum(`cinema`.`processing_days`) AS `total_processing_days`,`cinema`.`processing_days` AS `processing_days` from `cinema` where `cinema`.`is_delete` <> 1 group by `cinema`.`district`,`cinema`.`user_id`,`cinema`.`query_status`,`cinema`.`status`,`cinema`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_construction_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_construction_count` AS select `construction`.`district` AS `district`,`construction`.`user_id` AS `user_id`,`construction`.`query_status` AS `query_status`,`construction`.`status` AS `status`,count(`construction`.`construction_id`) AS `total_records`,sum(`construction`.`processing_days`) AS `total_processing_days`,`construction`.`processing_days` AS `processing_days` from `construction` where `construction`.`is_delete` <> 1 group by `construction`.`district`,`construction`.`user_id`,`construction`.`query_status`,`construction`.`status`,`construction`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_establishment_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_establishment_count` AS select `establishment`.`district` AS `district`,`establishment`.`user_id` AS `user_id`,`establishment`.`query_status` AS `query_status`,`establishment`.`status` AS `status`,count(`establishment`.`establishment_id`) AS `total_records`,sum(`establishment`.`processing_days`) AS `total_processing_days`,`establishment`.`processing_days` AS `processing_days` from `establishment` where `establishment`.`is_delete` <> 1 group by `establishment`.`district`,`establishment`.`user_id`,`establishment`.`query_status`,`establishment`.`status`,`establishment`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_factorylicence_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_factorylicence_count` AS select `factorylicence`.`district` AS `district`,`factorylicence`.`user_id` AS `user_id`,`factorylicence`.`query_status` AS `query_status`,`factorylicence`.`status` AS `status`,count(`factorylicence`.`factorylicence_id`) AS `total_records`,sum(`factorylicence`.`processing_days`) AS `total_processing_days`,`factorylicence`.`processing_days` AS `processing_days` from `factorylicence` where `factorylicence`.`is_delete` <> 1 group by `factorylicence`.`district`,`factorylicence`.`user_id`,`factorylicence`.`query_status`,`factorylicence`.`status`,`factorylicence`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_factorylicence_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_factorylicence_renewal_count` AS select `factorylicence_renewal`.`district` AS `district`,`factorylicence_renewal`.`user_id` AS `user_id`,`factorylicence_renewal`.`query_status` AS `query_status`,`factorylicence_renewal`.`status` AS `status`,count(`factorylicence_renewal`.`factorylicence_renewal_id`) AS `total_records`,sum(`factorylicence_renewal`.`processing_days`) AS `total_processing_days`,`factorylicence_renewal`.`processing_days` AS `processing_days` from `factorylicence_renewal` where `factorylicence_renewal`.`is_delete` <> 1 group by `factorylicence_renewal`.`district`,`factorylicence_renewal`.`user_id`,`factorylicence_renewal`.`query_status`,`factorylicence_renewal`.`status`,`factorylicence_renewal`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_filmshooting_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_filmshooting_count` AS select `filmshooting`.`district` AS `district`,`filmshooting`.`user_id` AS `user_id`,`filmshooting`.`query_status` AS `query_status`,`filmshooting`.`status` AS `status`,count(`filmshooting`.`filmshooting_id`) AS `total_records`,sum(`filmshooting`.`processing_days`) AS `total_processing_days`,`filmshooting`.`processing_days` AS `processing_days` from `filmshooting` where `filmshooting`.`is_delete` <> 1 group by `filmshooting`.`district`,`filmshooting`.`user_id`,`filmshooting`.`query_status`,`filmshooting`.`status`,`filmshooting`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_hotel_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_hotel_count` AS select `hotel`.`name_of_tourist_area` AS `district`,`hotel`.`user_id` AS `user_id`,`hotel`.`query_status` AS `query_status`,`hotel`.`status` AS `status`,count(`hotel`.`hotelregi_id`) AS `total_records`,sum(`hotel`.`processing_days`) AS `total_processing_days`,`hotel`.`processing_days` AS `processing_days` from `hotel` where `hotel`.`is_delete` <> 1 group by `hotel`.`name_of_tourist_area`,`hotel`.`user_id`,`hotel`.`query_status`,`hotel`.`status`,`hotel`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_hotel_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_hotel_renewal_count` AS select `hotel_renewal`.`name_of_tourist_area` AS `district`,`hotel_renewal`.`user_id` AS `user_id`,`hotel_renewal`.`query_status` AS `query_status`,`hotel_renewal`.`status` AS `status`,count(`hotel_renewal`.`hotel_renewal_id`) AS `total_records`,sum(`hotel_renewal`.`processing_days`) AS `total_processing_days`,`hotel_renewal`.`processing_days` AS `processing_days` from `hotel_renewal` where `hotel_renewal`.`is_delete` <> 1 group by `hotel_renewal`.`name_of_tourist_area`,`hotel_renewal`.`user_id`,`hotel_renewal`.`query_status`,`hotel_renewal`.`status`,`hotel_renewal`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_inspection_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_inspection_count` AS select `inspection`.`district` AS `district`,`inspection`.`user_id` AS `user_id`,`inspection`.`query_status` AS `query_status`,`inspection`.`status` AS `status`,count(`inspection`.`inspection_id`) AS `total_records`,sum(`inspection`.`processing_days`) AS `total_processing_days`,`inspection`.`processing_days` AS `processing_days` from `inspection` where `inspection`.`is_delete` <> 1 group by `inspection`.`district`,`inspection`.`user_id`,`inspection`.`query_status`,`inspection`.`status`,`inspection`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_ips_incentive_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_ips_incentive_count` AS select `i`.`district` AS `district`,`ii`.`user_id` AS `user_id`,`ii`.`query_status` AS `query_status`,`ii`.`status` AS `status`,count(`ii`.`ips_incentive_id`) AS `total_records`,sum(`ii`.`processing_days`) AS `total_processing_days`,`ii`.`processing_days` AS `processing_days` from (`ips_incentive` `ii` join `ips` `i` on(`i`.`ips_id` = `ii`.`ips_id`)) where `ii`.`is_delete` <> 1 group by `i`.`district`,`ii`.`user_id`,`ii`.`query_status`,`ii`.`status`,`ii`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_land_allotment_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_land_allotment_count` AS select `land_allotment`.`district` AS `district`,`land_allotment`.`user_id` AS `user_id`,`land_allotment`.`query_status` AS `query_status`,`land_allotment`.`status` AS `status`,count(`land_allotment`.`landallotment_id`) AS `total_records`,sum(`land_allotment`.`processing_days`) AS `total_processing_days`,`land_allotment`.`processing_days` AS `processing_days` from `land_allotment` where `land_allotment`.`is_delete` <> 1 group by `land_allotment`.`district`,`land_allotment`.`user_id`,`land_allotment`.`query_status`,`land_allotment`.`status`,`land_allotment`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_lease_seller_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_lease_seller_count` AS select `lease_seller`.`district` AS `district`,`lease_seller`.`user_id` AS `user_id`,`lease_seller`.`query_status` AS `query_status`,`lease_seller`.`status` AS `status`,count(`lease_seller`.`seller_id`) AS `total_records`,sum(`lease_seller`.`processing_days`) AS `total_processing_days`,`lease_seller`.`processing_days` AS `processing_days` from `lease_seller` where `lease_seller`.`is_delete` <> 1 group by `lease_seller`.`district`,`lease_seller`.`user_id`,`lease_seller`.`query_status`,`lease_seller`.`status`,`lease_seller`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_migrantworkers_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_migrantworkers_count` AS select `migrantworkers`.`district` AS `district`,`migrantworkers`.`user_id` AS `user_id`,`migrantworkers`.`query_status` AS `query_status`,`migrantworkers`.`status` AS `status`,count(`migrantworkers`.`mw_id`) AS `total_records`,sum(`migrantworkers`.`processing_days`) AS `total_processing_days`,`migrantworkers`.`processing_days` AS `processing_days` from `migrantworkers` where `migrantworkers`.`is_delete` <> 1 group by `migrantworkers`.`district`,`migrantworkers`.`user_id`,`migrantworkers`.`query_status`,`migrantworkers`.`status`,`migrantworkers`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_migrantworkers_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_migrantworkers_renewal_count` AS select `migrantworkers_renewal`.`district` AS `district`,`migrantworkers_renewal`.`user_id` AS `user_id`,`migrantworkers_renewal`.`query_status` AS `query_status`,`migrantworkers_renewal`.`status` AS `status`,count(`migrantworkers_renewal`.`migrantworkers_renewal_id`) AS `total_records`,sum(`migrantworkers_renewal`.`processing_days`) AS `total_processing_days`,`migrantworkers_renewal`.`processing_days` AS `processing_days` from `migrantworkers_renewal` where `migrantworkers_renewal`.`is_delete` <> 1 group by `migrantworkers_renewal`.`district`,`migrantworkers_renewal`.`user_id`,`migrantworkers_renewal`.`query_status`,`migrantworkers_renewal`.`status`,`migrantworkers_renewal`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_msme_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_msme_count` AS select `msme`.`district` AS `district`,`msme`.`user_id` AS `user_id`,`msme`.`query_status` AS `query_status`,`msme`.`status` AS `status`,count(`msme`.`msme_id`) AS `total_records`,sum(`msme`.`processing_days`) AS `total_processing_days`,`msme`.`processing_days` AS `processing_days` from `msme` where `msme`.`is_delete` <> 1 group by `msme`.`district`,`msme`.`user_id`,`msme`.`query_status`,`msme`.`status`,`msme`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_na_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_na_count` AS select `na`.`district` AS `district`,`na`.`user_id` AS `user_id`,`na`.`query_status` AS `query_status`,`na`.`status` AS `status`,count(`na`.`na_id`) AS `total_records`,sum(`na`.`processing_days`) AS `total_processing_days`,`na`.`processing_days` AS `processing_days` from `na` where `na`.`is_delete` <> 1 group by `na`.`district`,`na`.`user_id`,`na`.`query_status`,`na`.`status`,`na`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_nil_certificate_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_nil_certificate_count` AS select `nil_certificate`.`district` AS `district`,`nil_certificate`.`user_id` AS `user_id`,`nil_certificate`.`query_status` AS `query_status`,`nil_certificate`.`status` AS `status`,count(`nil_certificate`.`nil_certificate_id`) AS `total_records`,sum(`nil_certificate`.`processing_days`) AS `total_processing_days`,`nil_certificate`.`processing_days` AS `processing_days` from `nil_certificate` where `nil_certificate`.`is_delete` <> 1 and `nil_certificate`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `nil_certificate`.`district`,`nil_certificate`.`user_id`,`nil_certificate`.`query_status`,`nil_certificate`.`status`,`nil_certificate`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_noc_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_noc_count` AS select `noc`.`district` AS `district`,`noc`.`user_id` AS `user_id`,`noc`.`query_status` AS `query_status`,`noc`.`status` AS `status`,count(`noc`.`noc_id`) AS `total_records`,sum(`noc`.`processing_days`) AS `total_processing_days`,`noc`.`processing_days` AS `processing_days` from `noc` where `noc`.`is_delete` <> 1 group by `noc`.`district`,`noc`.`user_id`,`noc`.`query_status`,`noc`.`status`,`noc`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_occupancy_certificate_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_occupancy_certificate_count` AS select `occupancy_certificate`.`district` AS `district`,`occupancy_certificate`.`user_id` AS `user_id`,`occupancy_certificate`.`query_status` AS `query_status`,`occupancy_certificate`.`status` AS `status`,count(`occupancy_certificate`.`occupancy_certificate_id`) AS `total_records`,sum(`occupancy_certificate`.`processing_days`) AS `total_processing_days`,`occupancy_certificate`.`processing_days` AS `processing_days` from `occupancy_certificate` where `occupancy_certificate`.`is_delete` <> 1 group by `occupancy_certificate`.`district`,`occupancy_certificate`.`user_id`,`occupancy_certificate`.`query_status`,`occupancy_certificate`.`status`,`occupancy_certificate`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_periodicalreturn_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_periodicalreturn_count` AS select `periodicalreturn`.`district` AS `district`,`periodicalreturn`.`user_id` AS `user_id`,`periodicalreturn`.`query_status` AS `query_status`,`periodicalreturn`.`status` AS `status`,count(`periodicalreturn`.`periodicalreturn_id`) AS `total_records`,sum(`periodicalreturn`.`processing_days`) AS `total_processing_days`,`periodicalreturn`.`processing_days` AS `processing_days` from `periodicalreturn` where `periodicalreturn`.`is_delete` <> 1 group by `periodicalreturn`.`district`,`periodicalreturn`.`user_id`,`periodicalreturn`.`query_status`,`periodicalreturn`.`status`,`periodicalreturn`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_property_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_property_registration_count` AS select `property_registration`.`district` AS `district`,`property_registration`.`user_id` AS `user_id`,`property_registration`.`query_status` AS `query_status`,`property_registration`.`status` AS `status`,count(`property_registration`.`property_id`) AS `total_records`,sum(`property_registration`.`processing_days`) AS `total_processing_days`,`property_registration`.`processing_days` AS `processing_days` from `property_registration` where `property_registration`.`is_delete` <> 1 group by `property_registration`.`district`,`property_registration`.`user_id`,`property_registration`.`query_status`,`property_registration`.`status`,`property_registration`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_psf_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_psf_registration_count` AS select `psf_registration`.`district` AS `district`,`psf_registration`.`user_id` AS `user_id`,`psf_registration`.`query_status` AS `query_status`,`psf_registration`.`status` AS `status`,count(`psf_registration`.`psfregistration_id`) AS `total_records`,sum(`psf_registration`.`processing_days`) AS `total_processing_days`,`psf_registration`.`processing_days` AS `processing_days` from `psf_registration` where `psf_registration`.`is_delete` <> 1 group by `psf_registration`.`district`,`psf_registration`.`user_id`,`psf_registration`.`query_status`,`psf_registration`.`status`,`psf_registration`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_rii_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_rii_count` AS select `rii`.`district` AS `district`,`rii`.`user_id` AS `user_id`,`rii`.`query_status` AS `query_status`,`rii`.`status` AS `status`,count(`rii`.`rii_id`) AS `total_records`,sum(`rii`.`processing_days`) AS `total_processing_days`,`rii`.`processing_days` AS `processing_days` from `rii` where `rii`.`is_delete` <> 1 group by `rii`.`district`,`rii`.`user_id`,`rii`.`query_status`,`rii`.`status`,`rii`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_shop_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_shop_count` AS select `shop`.`district` AS `district`,`shop`.`user_id` AS `user_id`,`shop`.`query_status` AS `query_status`,`shop`.`status` AS `status`,count(`shop`.`s_id`) AS `total_records`,sum(`shop`.`processing_days`) AS `total_processing_days`,`shop`.`processing_days` AS `processing_days` from `shop` where `shop`.`is_delete` <> 1 group by `shop`.`district`,`shop`.`user_id`,`shop`.`query_status`,`shop`.`status`,`shop`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_shop_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_shop_renewal_count` AS select `shop_renewal`.`district` AS `district`,`shop_renewal`.`user_id` AS `user_id`,`shop_renewal`.`query_status` AS `query_status`,`shop_renewal`.`status` AS `status`,count(`shop_renewal`.`shop_renewal_id`) AS `total_records`,sum(`shop_renewal`.`processing_days`) AS `total_processing_days`,`shop_renewal`.`processing_days` AS `processing_days` from `shop_renewal` where `shop_renewal`.`is_delete` <> 1 group by `shop_renewal`.`district`,`shop_renewal`.`user_id`,`shop_renewal`.`query_status`,`shop_renewal`.`status`,`shop_renewal`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_singlereturn_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_singlereturn_count` AS select `singlereturn`.`district` AS `district`,`singlereturn`.`user_id` AS `user_id`,`singlereturn`.`query_status` AS `query_status`,`singlereturn`.`status` AS `status`,count(`singlereturn`.`singlereturn_id`) AS `total_records`,sum(`singlereturn`.`processing_days`) AS `total_processing_days`,`singlereturn`.`processing_days` AS `processing_days` from `singlereturn` where `singlereturn`.`is_delete` <> 1 group by `singlereturn`.`district`,`singlereturn`.`user_id`,`singlereturn`.`query_status`,`singlereturn`.`status`,`singlereturn`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_site_elevation_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_site_elevation_count` AS select `site_elevation`.`district` AS `district`,`site_elevation`.`user_id` AS `user_id`,`site_elevation`.`query_status` AS `query_status`,`site_elevation`.`status` AS `status`,count(`site_elevation`.`site_id`) AS `total_records`,sum(`site_elevation`.`processing_days`) AS `total_processing_days`,`site_elevation`.`processing_days` AS `processing_days` from `site_elevation` where `site_elevation`.`is_delete` <> 1 group by `site_elevation`.`district`,`site_elevation`.`user_id`,`site_elevation`.`query_status`,`site_elevation`.`status`,`site_elevation`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_society_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_society_registration_count` AS select `society_registration`.`district` AS `district`,`society_registration`.`user_id` AS `user_id`,`society_registration`.`query_status` AS `query_status`,`society_registration`.`status` AS `status`,count(`society_registration`.`society_registration_id`) AS `total_records`,sum(`society_registration`.`processing_days`) AS `total_processing_days`,`society_registration`.`processing_days` AS `processing_days` from `society_registration` where `society_registration`.`is_delete` <> 1 group by `society_registration`.`district`,`society_registration`.`user_id`,`society_registration`.`query_status`,`society_registration`.`status`,`society_registration`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_sub_lessee_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_sub_lessee_count` AS select `sub_lessee`.`district` AS `district`,`sub_lessee`.`user_id` AS `user_id`,`sub_lessee`.`query_status` AS `query_status`,`sub_lessee`.`status` AS `status`,count(`sub_lessee`.`sublessee_id`) AS `total_records`,sum(`sub_lessee`.`processing_days`) AS `total_processing_days`,`sub_lessee`.`processing_days` AS `processing_days` from `sub_lessee` where `sub_lessee`.`is_delete` <> 1 group by `sub_lessee`.`district`,`sub_lessee`.`user_id`,`sub_lessee`.`query_status`,`sub_lessee`.`status`,`sub_lessee`.`processing_days` order by count(`sub_lessee`.`sublessee_id`) desc;

DROP TABLE IF EXISTS `view_get_ds_wise_sub_letting_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_sub_letting_count` AS select `sub_letting`.`district` AS `district`,`sub_letting`.`user_id` AS `user_id`,`sub_letting`.`query_status` AS `query_status`,`sub_letting`.`status` AS `status`,count(`sub_letting`.`subletting_id`) AS `total_records`,sum(`sub_letting`.`processing_days`) AS `total_processing_days`,`sub_letting`.`processing_days` AS `processing_days` from `sub_letting` where `sub_letting`.`is_delete` <> 1 group by `sub_letting`.`district`,`sub_letting`.`user_id`,`sub_letting`.`query_status`,`sub_letting`.`status`,`sub_letting`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_textile_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_textile_count` AS select `textile`.`district` AS `district`,`textile`.`user_id` AS `user_id`,`textile`.`query_status` AS `query_status`,`textile`.`status` AS `status`,count(`textile`.`textile_id`) AS `total_records`,sum(`textile`.`processing_days`) AS `total_processing_days`,`textile`.`processing_days` AS `processing_days` from `textile` where `textile`.`is_delete` <> 1 group by `textile`.`district`,`textile`.`user_id`,`textile`.`query_status`,`textile`.`status`,`textile`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_tourismevent_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_tourismevent_count` AS select `tourismevent`.`district` AS `district`,`tourismevent`.`user_id` AS `user_id`,`tourismevent`.`query_status` AS `query_status`,`tourismevent`.`status` AS `status`,count(`tourismevent`.`tourismevent_id`) AS `total_records`,sum(`tourismevent`.`processing_days`) AS `total_processing_days`,`tourismevent`.`processing_days` AS `processing_days` from `tourismevent` where `tourismevent`.`is_delete` <> 1 group by `tourismevent`.`district`,`tourismevent`.`user_id`,`tourismevent`.`query_status`,`tourismevent`.`status`,`tourismevent`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_transfer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_transfer_count` AS select `transfer`.`district` AS `district`,`transfer`.`user_id` AS `user_id`,`transfer`.`query_status` AS `query_status`,`transfer`.`status` AS `status`,count(`transfer`.`transfer_id`) AS `total_records`,sum(`transfer`.`processing_days`) AS `total_processing_days`,`transfer`.`processing_days` AS `processing_days` from `transfer` where `transfer`.`is_delete` <> 1 group by `transfer`.`district`,`transfer`.`user_id`,`transfer`.`query_status`,`transfer`.`status`,`transfer`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_travelagent_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_travelagent_count` AS select `travelagent`.`area_of_agency` AS `district`,`travelagent`.`user_id` AS `user_id`,`travelagent`.`query_status` AS `query_status`,`travelagent`.`status` AS `status`,count(`travelagent`.`travelagent_id`) AS `total_records`,sum(`travelagent`.`processing_days`) AS `total_processing_days`,`travelagent`.`processing_days` AS `processing_days` from `travelagent` where `travelagent`.`is_delete` <> 1 group by `travelagent`.`area_of_agency`,`travelagent`.`user_id`,`travelagent`.`query_status`,`travelagent`.`status`,`travelagent`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_travelagent_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_travelagent_renewal_count` AS select `travelagent_renewal`.`area_of_agency` AS `district`,`travelagent_renewal`.`user_id` AS `user_id`,`travelagent_renewal`.`query_status` AS `query_status`,`travelagent_renewal`.`status` AS `status`,count(`travelagent_renewal`.`travelagent_renewal_id`) AS `total_records`,sum(`travelagent_renewal`.`processing_days`) AS `total_processing_days`,`travelagent_renewal`.`processing_days` AS `processing_days` from `travelagent_renewal` where `travelagent_renewal`.`is_delete` <> 1 group by `travelagent_renewal`.`area_of_agency`,`travelagent_renewal`.`user_id`,`travelagent_renewal`.`query_status`,`travelagent_renewal`.`status`,`travelagent_renewal`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_tree_cutting_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_tree_cutting_count` AS select `tree_cutting`.`district` AS `district`,`tree_cutting`.`user_id` AS `user_id`,`tree_cutting`.`query_status` AS `query_status`,`tree_cutting`.`status` AS `status`,count(`tree_cutting`.`tree_cutting_id`) AS `total_records`,sum(`tree_cutting`.`processing_days`) AS `total_processing_days`,`tree_cutting`.`processing_days` AS `processing_days` from `tree_cutting` where `tree_cutting`.`is_delete` <> 1 group by `tree_cutting`.`district`,`tree_cutting`.`user_id`,`tree_cutting`.`query_status`,`tree_cutting`.`status`,`tree_cutting`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_vc_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_vc_count` AS select `vc`.`district` AS `district`,`vc`.`user_id` AS `user_id`,`vc`.`query_status` AS `query_status`,`vc`.`status` AS `status`,count(`vc`.`vc_id`) AS `total_records`,sum(`vc`.`processing_days`) AS `total_processing_days`,`vc`.`processing_days` AS `processing_days` from `vc` where `vc`.`is_delete` <> 1 group by `vc`.`district`,`vc`.`user_id`,`vc`.`query_status`,`vc`.`status`,`vc`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_wc_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_wc_count` AS select `wc`.`district` AS `district`,`wc`.`user_id` AS `user_id`,`wc`.`query_status` AS `query_status`,`wc`.`status` AS `status`,count(`wc`.`wc_id`) AS `total_records`,sum(`wc`.`processing_days`) AS `total_processing_days`,`wc`.`processing_days` AS `processing_days` from `wc` where `wc`.`is_delete` <> 1 group by `wc`.`district`,`wc`.`user_id`,`wc`.`query_status`,`wc`.`status`,`wc`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_wm_dealer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_wm_dealer_count` AS select `wm_dealer`.`district` AS `district`,`wm_dealer`.`user_id` AS `user_id`,`wm_dealer`.`query_status` AS `query_status`,`wm_dealer`.`status` AS `status`,count(`wm_dealer`.`dealer_id`) AS `total_records`,sum(`wm_dealer`.`processing_days`) AS `total_processing_days`,`wm_dealer`.`processing_days` AS `processing_days` from `wm_dealer` where `wm_dealer`.`is_delete` <> 1 group by `wm_dealer`.`district`,`wm_dealer`.`user_id`,`wm_dealer`.`query_status`,`wm_dealer`.`status`,`wm_dealer`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_wm_dealer_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_wm_dealer_renewal_count` AS select `wm_dealer_renewal`.`district` AS `district`,`wm_dealer_renewal`.`user_id` AS `user_id`,`wm_dealer_renewal`.`query_status` AS `query_status`,`wm_dealer_renewal`.`status` AS `status`,count(`wm_dealer_renewal`.`dealer_renewal_id`) AS `total_records`,sum(`wm_dealer_renewal`.`processing_days`) AS `total_processing_days`,`wm_dealer_renewal`.`processing_days` AS `processing_days` from `wm_dealer_renewal` where `wm_dealer_renewal`.`is_delete` <> 1 group by `wm_dealer_renewal`.`district`,`wm_dealer_renewal`.`user_id`,`wm_dealer_renewal`.`query_status`,`wm_dealer_renewal`.`status`,`wm_dealer_renewal`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_wm_manufacturer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_wm_manufacturer_count` AS select `wm_manufacturer`.`district` AS `district`,`wm_manufacturer`.`user_id` AS `user_id`,`wm_manufacturer`.`query_status` AS `query_status`,`wm_manufacturer`.`status` AS `status`,count(`wm_manufacturer`.`manufacturer_id`) AS `total_records`,sum(`wm_manufacturer`.`processing_days`) AS `total_processing_days`,`wm_manufacturer`.`processing_days` AS `processing_days` from `wm_manufacturer` where `wm_manufacturer`.`is_delete` <> 1 group by `wm_manufacturer`.`district`,`wm_manufacturer`.`user_id`,`wm_manufacturer`.`query_status`,`wm_manufacturer`.`status`,`wm_manufacturer`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_wm_manufacturer_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_wm_manufacturer_renewal_count` AS select `wm_manufacturer_renewal`.`district` AS `district`,`wm_manufacturer_renewal`.`user_id` AS `user_id`,`wm_manufacturer_renewal`.`query_status` AS `query_status`,`wm_manufacturer_renewal`.`status` AS `status`,count(`wm_manufacturer_renewal`.`manufacturer_renewal_id`) AS `total_records`,sum(`wm_manufacturer_renewal`.`processing_days`) AS `total_processing_days`,`wm_manufacturer_renewal`.`processing_days` AS `processing_days` from `wm_manufacturer_renewal` where `wm_manufacturer_renewal`.`is_delete` <> 1 group by `wm_manufacturer_renewal`.`district`,`wm_manufacturer_renewal`.`user_id`,`wm_manufacturer_renewal`.`query_status`,`wm_manufacturer_renewal`.`status`,`wm_manufacturer_renewal`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_wm_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_wm_registration_count` AS select `wm_registration`.`district` AS `district`,`wm_registration`.`user_id` AS `user_id`,`wm_registration`.`query_status` AS `query_status`,`wm_registration`.`status` AS `status`,count(`wm_registration`.`wmregistration_id`) AS `total_records`,sum(`wm_registration`.`processing_days`) AS `total_processing_days`,`wm_registration`.`processing_days` AS `processing_days` from `wm_registration` where `wm_registration`.`is_delete` <> 1 group by `wm_registration`.`district`,`wm_registration`.`user_id`,`wm_registration`.`query_status`,`wm_registration`.`status`,`wm_registration`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_wm_repairer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_wm_repairer_count` AS select `wm_repairer`.`district` AS `district`,`wm_repairer`.`user_id` AS `user_id`,`wm_repairer`.`query_status` AS `query_status`,`wm_repairer`.`status` AS `status`,count(`wm_repairer`.`repairer_id`) AS `total_records`,sum(`wm_repairer`.`processing_days`) AS `total_processing_days`,`wm_repairer`.`processing_days` AS `processing_days` from `wm_repairer` where `wm_repairer`.`is_delete` <> 1 group by `wm_repairer`.`district`,`wm_repairer`.`user_id`,`wm_repairer`.`query_status`,`wm_repairer`.`status`,`wm_repairer`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_wm_repairer_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_wm_repairer_renewal_count` AS select `wm_repairer_renewal`.`district` AS `district`,`wm_repairer_renewal`.`user_id` AS `user_id`,`wm_repairer_renewal`.`query_status` AS `query_status`,`wm_repairer_renewal`.`status` AS `status`,count(`wm_repairer_renewal`.`repairer_renewal_id`) AS `total_records`,sum(`wm_repairer_renewal`.`processing_days`) AS `total_processing_days`,`wm_repairer_renewal`.`processing_days` AS `processing_days` from `wm_repairer_renewal` where `wm_repairer_renewal`.`is_delete` <> 1 group by `wm_repairer_renewal`.`district`,`wm_repairer_renewal`.`user_id`,`wm_repairer_renewal`.`query_status`,`wm_repairer_renewal`.`status`,`wm_repairer_renewal`.`processing_days`;

DROP TABLE IF EXISTS `view_get_ds_wise_zone_information_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_zone_information_count` AS select `zone_information`.`district` AS `district`,`zone_information`.`user_id` AS `user_id`,`zone_information`.`query_status` AS `query_status`,`zone_information`.`status` AS `status`,count(`zone_information`.`zone_id`) AS `total_records`,sum(`zone_information`.`processing_days`) AS `total_processing_days`,`zone_information`.`processing_days` AS `processing_days` from `zone_information` where `zone_information`.`is_delete` <> 1 group by `zone_information`.`district`,`zone_information`.`user_id`,`zone_information`.`query_status`,`zone_information`.`status`,`zone_information`.`processing_days`;

DROP TABLE IF EXISTS `view_get_status_wise_appli_licence_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_appli_licence_count` AS select `appli_licence`.`status` AS `status`,count(`appli_licence`.`aplicence_id`) AS `total_records`,sum(`appli_licence`.`processing_days`) AS `total_processing_days`,`appli_licence`.`processing_days` AS `processing_days` from `appli_licence` where `appli_licence`.`is_delete` <> 1 and `appli_licence`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `appli_licence`.`status`,`appli_licence`.`processing_days` order by count(`appli_licence`.`aplicence_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_appli_licence_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_appli_licence_renewal_count` AS select `appli_licence_renewal`.`status` AS `status`,count(`appli_licence_renewal`.`aplicence_renewal_id`) AS `total_records`,sum(`appli_licence_renewal`.`processing_days`) AS `total_processing_days`,`appli_licence_renewal`.`processing_days` AS `processing_days` from `appli_licence_renewal` where `appli_licence_renewal`.`is_delete` <> 1 and `appli_licence_renewal`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `appli_licence_renewal`.`status`,`appli_licence_renewal`.`processing_days` order by count(`appli_licence_renewal`.`aplicence_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_bocw_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_bocw_count` AS select `bocw`.`status` AS `status`,count(`bocw`.`bocw_id`) AS `total_records`,sum(`bocw`.`processing_days`) AS `total_processing_days`,`bocw`.`processing_days` AS `processing_days` from `bocw` where `bocw`.`is_delete` <> 1 and `bocw`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `bocw`.`status`,`bocw`.`processing_days` order by count(`bocw`.`bocw_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_boileract_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_boileract_count` AS select `boileract`.`status` AS `status`,count(`boileract`.`boiler_id`) AS `total_records`,sum(`boileract`.`processing_days`) AS `total_processing_days`,`boileract`.`processing_days` AS `processing_days` from `boileract` where `boileract`.`is_delete` <> 1 and `boileract`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `boileract`.`status`,`boileract`.`processing_days` order by count(`boileract`.`boiler_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_boileract_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_boileract_renewal_count` AS select `boileract_renewal`.`status` AS `status`,count(`boileract_renewal`.`boiler_renewal_id`) AS `total_records`,sum(`boileract_renewal`.`processing_days`) AS `total_processing_days`,`boileract_renewal`.`processing_days` AS `processing_days` from `boileract_renewal` where `boileract_renewal`.`is_delete` <> 1 and `boileract_renewal`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `boileract_renewal`.`status`,`boileract_renewal`.`processing_days` order by count(`boileract_renewal`.`boiler_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_boilermanufactures_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_boilermanufactures_count` AS select `boilermanufactures`.`status` AS `status`,count(`boilermanufactures`.`boilermanufacture_id`) AS `total_records`,sum(`boilermanufactures`.`processing_days`) AS `total_processing_days`,`boilermanufactures`.`processing_days` AS `processing_days` from `boilermanufactures` where `boilermanufactures`.`is_delete` <> 1 and `boilermanufactures`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `boilermanufactures`.`status`,`boilermanufactures`.`processing_days` order by count(`boilermanufactures`.`boilermanufacture_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_buildingplan_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_buildingplan_count` AS select `buildingplan`.`status` AS `status`,count(`buildingplan`.`buildingplan_id`) AS `total_records`,sum(`buildingplan`.`processing_days`) AS `total_processing_days`,`buildingplan`.`processing_days` AS `processing_days` from `buildingplan` where `buildingplan`.`is_delete` <> 1 and `buildingplan`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `buildingplan`.`status`,`buildingplan`.`processing_days` order by count(`buildingplan`.`buildingplan_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_cinema_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_cinema_count` AS select `cinema`.`status` AS `status`,count(`cinema`.`cinema_id`) AS `total_records`,sum(`cinema`.`processing_days`) AS `total_processing_days`,`cinema`.`processing_days` AS `processing_days` from `cinema` where `cinema`.`is_delete` <> 1 and `cinema`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `cinema`.`status`,`cinema`.`processing_days` order by count(`cinema`.`cinema_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_construction_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_construction_count` AS select `construction`.`status` AS `status`,count(`construction`.`construction_id`) AS `total_records`,sum(`construction`.`processing_days`) AS `total_processing_days`,`construction`.`processing_days` AS `processing_days` from `construction` where `construction`.`is_delete` <> 1 and `construction`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `construction`.`status`,`construction`.`processing_days` order by count(`construction`.`construction_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_establishment_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_establishment_count` AS select `establishment`.`status` AS `status`,count(`establishment`.`establishment_id`) AS `total_records`,sum(`establishment`.`processing_days`) AS `total_processing_days`,`establishment`.`processing_days` AS `processing_days` from `establishment` where `establishment`.`is_delete` <> 1 and `establishment`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `establishment`.`status`,`establishment`.`processing_days` order by count(`establishment`.`establishment_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_factorylicence_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_factorylicence_count` AS select `factorylicence`.`status` AS `status`,count(`factorylicence`.`factorylicence_id`) AS `total_records`,sum(`factorylicence`.`processing_days`) AS `total_processing_days`,`factorylicence`.`processing_days` AS `processing_days` from `factorylicence` where `factorylicence`.`is_delete` <> 1 and `factorylicence`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `factorylicence`.`status`,`factorylicence`.`processing_days` order by count(`factorylicence`.`factorylicence_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_factorylicence_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_factorylicence_renewal_count` AS select `factorylicence_renewal`.`status` AS `status`,count(`factorylicence_renewal`.`factorylicence_renewal_id`) AS `total_records`,sum(`factorylicence_renewal`.`processing_days`) AS `total_processing_days`,`factorylicence_renewal`.`processing_days` AS `processing_days` from `factorylicence_renewal` where `factorylicence_renewal`.`is_delete` <> 1 and `factorylicence_renewal`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `factorylicence_renewal`.`status`,`factorylicence_renewal`.`processing_days` order by count(`factorylicence_renewal`.`factorylicence_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_filmshooting_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_filmshooting_count` AS select `filmshooting`.`status` AS `status`,count(`filmshooting`.`filmshooting_id`) AS `total_records`,sum(`filmshooting`.`processing_days`) AS `total_processing_days`,`filmshooting`.`processing_days` AS `processing_days` from `filmshooting` where `filmshooting`.`is_delete` <> 1 and `filmshooting`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `filmshooting`.`status`,`filmshooting`.`processing_days` order by count(`filmshooting`.`filmshooting_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_hotel_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_hotel_count` AS select `hotel`.`status` AS `status`,count(`hotel`.`hotelregi_id`) AS `total_records`,sum(`hotel`.`processing_days`) AS `total_processing_days`,`hotel`.`processing_days` AS `processing_days` from `hotel` where `hotel`.`is_delete` <> 1 and `hotel`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `hotel`.`status`,`hotel`.`processing_days` order by count(`hotel`.`hotelregi_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_hotel_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_hotel_renewal_count` AS select `hotel_renewal`.`status` AS `status`,count(`hotel_renewal`.`hotel_renewal_id`) AS `total_records`,sum(`hotel_renewal`.`processing_days`) AS `total_processing_days`,`hotel_renewal`.`processing_days` AS `processing_days` from `hotel_renewal` where `hotel_renewal`.`is_delete` <> 1 and `hotel_renewal`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `hotel_renewal`.`status`,`hotel_renewal`.`processing_days` order by count(`hotel_renewal`.`hotel_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_incentive_generalform_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_incentive_generalform_count` AS select `incentive_generalform`.`status` AS `status`,count(`incentive_generalform`.`incentive_id`) AS `total_records`,sum(`incentive_generalform`.`processing_days`) AS `total_processing_days`,`incentive_generalform`.`processing_days` AS `processing_days` from `incentive_generalform` where `incentive_generalform`.`is_delete` <> 1 and `incentive_generalform`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `incentive_generalform`.`status`,`incentive_generalform`.`processing_days` order by count(`incentive_generalform`.`incentive_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_incentive_generalform_textile_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_incentive_generalform_textile_count` AS select `incentive_generalform_textile`.`status` AS `status`,count(`incentive_generalform_textile`.`incentive_id`) AS `total_records`,sum(`incentive_generalform_textile`.`processing_days`) AS `total_processing_days`,`incentive_generalform_textile`.`processing_days` AS `processing_days` from `incentive_generalform_textile` where `incentive_generalform_textile`.`is_delete` <> 1 and `incentive_generalform_textile`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `incentive_generalform_textile`.`status`,`incentive_generalform_textile`.`processing_days` order by count(`incentive_generalform_textile`.`incentive_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_inspection_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_inspection_count` AS select `inspection`.`status` AS `status`,count(`inspection`.`inspection_id`) AS `total_records`,sum(`inspection`.`processing_days`) AS `total_processing_days`,`inspection`.`processing_days` AS `processing_days` from `inspection` where `inspection`.`is_delete` <> 1 and `inspection`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `inspection`.`status`,`inspection`.`processing_days` order by count(`inspection`.`inspection_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_ips_incentive_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_ips_incentive_count` AS select `ips_incentive`.`status` AS `status`,count(`ips_incentive`.`ips_incentive_id`) AS `total_records`,sum(`ips_incentive`.`processing_days`) AS `total_processing_days`,`ips_incentive`.`processing_days` AS `processing_days` from `ips_incentive` where `ips_incentive`.`is_delete` <> 1 and `ips_incentive`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `ips_incentive`.`status`,`ips_incentive`.`processing_days` order by count(`ips_incentive`.`ips_incentive_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_land_allotment_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_land_allotment_count` AS select `land_allotment`.`status` AS `status`,count(`land_allotment`.`landallotment_id`) AS `total_records`,sum(`land_allotment`.`processing_days`) AS `total_processing_days`,`land_allotment`.`processing_days` AS `processing_days` from `land_allotment` where `land_allotment`.`is_delete` <> 1 and `land_allotment`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `land_allotment`.`status`,`land_allotment`.`processing_days` order by count(`land_allotment`.`landallotment_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_lease_seller_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_lease_seller_count` AS select `lease_seller`.`status` AS `status`,count(`lease_seller`.`seller_id`) AS `total_records`,sum(`lease_seller`.`processing_days`) AS `total_processing_days`,`lease_seller`.`processing_days` AS `processing_days` from `lease_seller` where `lease_seller`.`is_delete` <> 1 and `lease_seller`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `lease_seller`.`status`,`lease_seller`.`processing_days` order by count(`lease_seller`.`seller_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_migrantworkers_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_migrantworkers_count` AS select `migrantworkers`.`status` AS `status`,count(`migrantworkers`.`mw_id`) AS `total_records`,sum(`migrantworkers`.`processing_days`) AS `total_processing_days`,`migrantworkers`.`processing_days` AS `processing_days` from `migrantworkers` where `migrantworkers`.`is_delete` <> 1 and `migrantworkers`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `migrantworkers`.`status`,`migrantworkers`.`processing_days` order by count(`migrantworkers`.`mw_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_migrantworkers_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_migrantworkers_renewal_count` AS select `migrantworkers_renewal`.`status` AS `status`,count(`migrantworkers_renewal`.`migrantworkers_renewal_id`) AS `total_records`,sum(`migrantworkers_renewal`.`processing_days`) AS `total_processing_days`,`migrantworkers_renewal`.`processing_days` AS `processing_days` from `migrantworkers_renewal` where `migrantworkers_renewal`.`is_delete` <> 1 and `migrantworkers_renewal`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `migrantworkers_renewal`.`status`,`migrantworkers_renewal`.`processing_days` order by count(`migrantworkers_renewal`.`migrantworkers_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_msme_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_msme_count` AS select `msme`.`status` AS `status`,count(`msme`.`msme_id`) AS `total_records`,sum(`msme`.`processing_days`) AS `total_processing_days`,`msme`.`processing_days` AS `processing_days` from `msme` where `msme`.`is_delete` <> 1 and `msme`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `msme`.`status`,`msme`.`processing_days` order by count(`msme`.`msme_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_na_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_na_count` AS select `na`.`status` AS `status`,count(`na`.`na_id`) AS `total_records`,sum(`na`.`processing_days`) AS `total_processing_days`,`na`.`processing_days` AS `processing_days` from `na` where `na`.`is_delete` <> 1 and `na`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `na`.`status`,`na`.`processing_days` order by count(`na`.`na_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_nil_certificate_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_nil_certificate_count` AS select `nil_certificate`.`status` AS `status`,count(`nil_certificate`.`nil_certificate_id`) AS `total_records`,sum(`nil_certificate`.`processing_days`) AS `total_processing_days`,`nil_certificate`.`processing_days` AS `processing_days` from `nil_certificate` where `nil_certificate`.`is_delete` <> 1 and `nil_certificate`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `nil_certificate`.`status`,`nil_certificate`.`processing_days` order by count(`nil_certificate`.`nil_certificate_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_noc_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_noc_count` AS select `noc`.`status` AS `status`,count(`noc`.`noc_id`) AS `total_records`,sum(`noc`.`processing_days`) AS `total_processing_days`,`noc`.`processing_days` AS `processing_days` from `noc` where `noc`.`is_delete` <> 1 and `noc`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `noc`.`status`,`noc`.`processing_days` order by count(`noc`.`noc_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_occupancy_certificate_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_occupancy_certificate_count` AS select `occupancy_certificate`.`status` AS `status`,count(`occupancy_certificate`.`occupancy_certificate_id`) AS `total_records`,sum(`occupancy_certificate`.`processing_days`) AS `total_processing_days`,`occupancy_certificate`.`processing_days` AS `processing_days` from `occupancy_certificate` where `occupancy_certificate`.`is_delete` <> 1 and `occupancy_certificate`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `occupancy_certificate`.`status`,`occupancy_certificate`.`processing_days` order by count(`occupancy_certificate`.`occupancy_certificate_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_periodicalreturn_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_periodicalreturn_count` AS select `periodicalreturn`.`status` AS `status`,count(`periodicalreturn`.`periodicalreturn_id`) AS `total_records`,sum(`periodicalreturn`.`processing_days`) AS `total_processing_days`,`periodicalreturn`.`processing_days` AS `processing_days` from `periodicalreturn` where `periodicalreturn`.`is_delete` <> 1 and `periodicalreturn`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `periodicalreturn`.`status`,`periodicalreturn`.`processing_days` order by count(`periodicalreturn`.`periodicalreturn_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_property_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_property_registration_count` AS select `property_registration`.`status` AS `status`,count(`property_registration`.`property_id`) AS `total_records`,sum(`property_registration`.`processing_days`) AS `total_processing_days`,`property_registration`.`processing_days` AS `processing_days` from `property_registration` where `property_registration`.`is_delete` <> 1 and `property_registration`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `property_registration`.`status`,`property_registration`.`processing_days` order by count(`property_registration`.`property_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_psf_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_psf_registration_count` AS select `psf_registration`.`status` AS `status`,count(`psf_registration`.`psfregistration_id`) AS `total_records`,sum(`psf_registration`.`processing_days`) AS `total_processing_days`,`psf_registration`.`processing_days` AS `processing_days` from `psf_registration` where `psf_registration`.`is_delete` <> 1 and `psf_registration`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `psf_registration`.`status`,`psf_registration`.`processing_days` order by count(`psf_registration`.`psfregistration_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_query_grievance_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_query_grievance_count` AS select `query_grievance`.`status` AS `status`,count(`query_grievance`.`query_grievance_id`) AS `total_records`,sum(`query_grievance`.`processing_days`) AS `total_processing_days`,`query_grievance`.`processing_days` AS `processing_days`,`query_grievance`.`industry_classification` AS `industry_classification` from `query_grievance` where `query_grievance`.`is_delete` <> 1 and `query_grievance`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `query_grievance`.`status`,`query_grievance`.`processing_days`,`query_grievance`.`industry_classification` order by count(`query_grievance`.`query_grievance_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_rii_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_rii_count` AS select `rii`.`status` AS `status`,count(`rii`.`rii_id`) AS `total_records`,sum(`rii`.`processing_days`) AS `total_processing_days`,`rii`.`processing_days` AS `processing_days` from `rii` where `rii`.`is_delete` <> 1 and `rii`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `rii`.`status`,`rii`.`processing_days` order by count(`rii`.`rii_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_shop_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_shop_count` AS select `shop`.`status` AS `status`,count(`shop`.`s_id`) AS `total_records`,sum(`shop`.`processing_days`) AS `total_processing_days`,`shop`.`processing_days` AS `processing_days` from `shop` where `shop`.`is_delete` <> 1 and `shop`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `shop`.`status`,`shop`.`processing_days` order by count(`shop`.`s_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_shop_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_shop_renewal_count` AS select `shop_renewal`.`status` AS `status`,count(`shop_renewal`.`shop_renewal_id`) AS `total_records`,sum(`shop_renewal`.`processing_days`) AS `total_processing_days`,`shop_renewal`.`processing_days` AS `processing_days` from `shop_renewal` where `shop_renewal`.`is_delete` <> 1 and `shop_renewal`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `shop_renewal`.`status`,`shop_renewal`.`processing_days` order by count(`shop_renewal`.`shop_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_singlereturn_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_singlereturn_count` AS select `singlereturn`.`status` AS `status`,count(`singlereturn`.`singlereturn_id`) AS `total_records`,sum(`singlereturn`.`processing_days`) AS `total_processing_days`,`singlereturn`.`processing_days` AS `processing_days` from `singlereturn` where `singlereturn`.`is_delete` <> 1 and `singlereturn`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `singlereturn`.`status`,`singlereturn`.`processing_days` order by count(`singlereturn`.`singlereturn_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_site_elevation_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_site_elevation_count` AS select `site_elevation`.`status` AS `status`,count(`site_elevation`.`site_id`) AS `total_records`,sum(`site_elevation`.`processing_days`) AS `total_processing_days`,`site_elevation`.`processing_days` AS `processing_days` from `site_elevation` where `site_elevation`.`is_delete` <> 1 and `site_elevation`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `site_elevation`.`status`,`site_elevation`.`processing_days` order by count(`site_elevation`.`site_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_society_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_society_registration_count` AS select `society_registration`.`status` AS `status`,count(`society_registration`.`society_registration_id`) AS `total_records`,sum(`society_registration`.`processing_days`) AS `total_processing_days`,`society_registration`.`processing_days` AS `processing_days` from `society_registration` where `society_registration`.`is_delete` <> 1 and `society_registration`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `society_registration`.`status`,`society_registration`.`processing_days` order by count(`society_registration`.`society_registration_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_sub_lessee_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_sub_lessee_count` AS select `sub_lessee`.`status` AS `status`,count(`sub_lessee`.`sublessee_id`) AS `total_records`,sum(`sub_lessee`.`processing_days`) AS `total_processing_days`,`sub_lessee`.`processing_days` AS `processing_days` from `sub_lessee` where `sub_lessee`.`is_delete` <> 1 and `sub_lessee`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `sub_lessee`.`status`,`sub_lessee`.`processing_days` order by count(`sub_lessee`.`sublessee_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_sub_letting_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_sub_letting_count` AS select `sub_letting`.`status` AS `status`,count(`sub_letting`.`subletting_id`) AS `total_records`,sum(`sub_letting`.`processing_days`) AS `total_processing_days`,`sub_letting`.`processing_days` AS `processing_days` from `sub_letting` where `sub_letting`.`is_delete` <> 1 and `sub_letting`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `sub_letting`.`status`,`sub_letting`.`processing_days` order by count(`sub_letting`.`subletting_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_textile_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_textile_count` AS select `textile`.`status` AS `status`,count(`textile`.`textile_id`) AS `total_records`,sum(`textile`.`processing_days`) AS `total_processing_days`,`textile`.`processing_days` AS `processing_days` from `textile` where `textile`.`is_delete` <> 1 and `textile`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `textile`.`status`,`textile`.`processing_days` order by count(`textile`.`textile_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_tourismevent_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_tourismevent_count` AS select `tourismevent`.`status` AS `status`,count(`tourismevent`.`tourismevent_id`) AS `total_records`,sum(`tourismevent`.`processing_days`) AS `total_processing_days`,`tourismevent`.`processing_days` AS `processing_days` from `tourismevent` where `tourismevent`.`is_delete` <> 1 and `tourismevent`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `tourismevent`.`status`,`tourismevent`.`processing_days` order by count(`tourismevent`.`tourismevent_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_transfer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_transfer_count` AS select `transfer`.`status` AS `status`,count(`transfer`.`transfer_id`) AS `total_records`,sum(`transfer`.`processing_days`) AS `total_processing_days`,`transfer`.`processing_days` AS `processing_days` from `transfer` where `transfer`.`is_delete` <> 1 and `transfer`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `transfer`.`status`,`transfer`.`processing_days` order by count(`transfer`.`transfer_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_travelagent_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_travelagent_count` AS select `travelagent`.`status` AS `status`,count(`travelagent`.`travelagent_id`) AS `total_records`,sum(`travelagent`.`processing_days`) AS `total_processing_days`,`travelagent`.`processing_days` AS `processing_days` from `travelagent` where `travelagent`.`is_delete` <> 1 and `travelagent`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `travelagent`.`status`,`travelagent`.`processing_days` order by count(`travelagent`.`travelagent_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_travelagent_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_travelagent_renewal_count` AS select `travelagent_renewal`.`status` AS `status`,count(`travelagent_renewal`.`travelagent_renewal_id`) AS `total_records`,sum(`travelagent_renewal`.`processing_days`) AS `total_processing_days`,`travelagent_renewal`.`processing_days` AS `processing_days` from `travelagent_renewal` where `travelagent_renewal`.`is_delete` <> 1 and `travelagent_renewal`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `travelagent_renewal`.`status`,`travelagent_renewal`.`processing_days` order by count(`travelagent_renewal`.`travelagent_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_tree_cutting_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_tree_cutting_count` AS select `tree_cutting`.`status` AS `status`,count(`tree_cutting`.`tree_cutting_id`) AS `total_records`,sum(`tree_cutting`.`processing_days`) AS `total_processing_days`,`tree_cutting`.`processing_days` AS `processing_days` from `tree_cutting` where `tree_cutting`.`is_delete` <> 1 and `tree_cutting`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `tree_cutting`.`status`,`tree_cutting`.`processing_days` order by count(`tree_cutting`.`tree_cutting_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_vc_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_vc_count` AS select `vc`.`status` AS `status`,count(`vc`.`vc_id`) AS `total_records`,sum(`vc`.`processing_days`) AS `total_processing_days`,`vc`.`processing_days` AS `processing_days` from `vc` where `vc`.`is_delete` <> 1 and `vc`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `vc`.`status`,`vc`.`processing_days` order by count(`vc`.`vc_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wc_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wc_count` AS select `wc`.`status` AS `status`,count(`wc`.`wc_id`) AS `total_records`,sum(`wc`.`processing_days`) AS `total_processing_days`,`wc`.`processing_days` AS `processing_days` from `wc` where `wc`.`is_delete` <> 1 and `wc`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `wc`.`status`,`wc`.`processing_days` order by count(`wc`.`wc_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_dealer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_dealer_count` AS select `wm_dealer`.`status` AS `status`,count(`wm_dealer`.`dealer_id`) AS `total_records`,sum(`wm_dealer`.`processing_days`) AS `total_processing_days`,`wm_dealer`.`processing_days` AS `processing_days` from `wm_dealer` where `wm_dealer`.`is_delete` <> 1 and `wm_dealer`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `wm_dealer`.`status`,`wm_dealer`.`processing_days` order by count(`wm_dealer`.`dealer_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_dealer_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_dealer_renewal_count` AS select `wm_dealer_renewal`.`status` AS `status`,count(`wm_dealer_renewal`.`dealer_renewal_id`) AS `total_records`,sum(`wm_dealer_renewal`.`processing_days`) AS `total_processing_days`,`wm_dealer_renewal`.`processing_days` AS `processing_days` from `wm_dealer_renewal` where `wm_dealer_renewal`.`is_delete` <> 1 and `wm_dealer_renewal`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `wm_dealer_renewal`.`status`,`wm_dealer_renewal`.`processing_days` order by count(`wm_dealer_renewal`.`dealer_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_manufacturer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_manufacturer_count` AS select `wm_manufacturer`.`status` AS `status`,count(`wm_manufacturer`.`manufacturer_id`) AS `total_records`,sum(`wm_manufacturer`.`processing_days`) AS `total_processing_days`,`wm_manufacturer`.`processing_days` AS `processing_days` from `wm_manufacturer` where `wm_manufacturer`.`is_delete` <> 1 and `wm_manufacturer`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `wm_manufacturer`.`status`,`wm_manufacturer`.`processing_days` order by count(`wm_manufacturer`.`manufacturer_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_manufacturer_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_manufacturer_renewal_count` AS select `wm_manufacturer_renewal`.`status` AS `status`,count(`wm_manufacturer_renewal`.`manufacturer_renewal_id`) AS `total_records`,sum(`wm_manufacturer_renewal`.`processing_days`) AS `total_processing_days`,`wm_manufacturer_renewal`.`processing_days` AS `processing_days` from `wm_manufacturer_renewal` where `wm_manufacturer_renewal`.`is_delete` <> 1 and `wm_manufacturer_renewal`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `wm_manufacturer_renewal`.`status`,`wm_manufacturer_renewal`.`processing_days` order by count(`wm_manufacturer_renewal`.`manufacturer_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_registration_count` AS select `wm_registration`.`status` AS `status`,count(`wm_registration`.`wmregistration_id`) AS `total_records`,sum(`wm_registration`.`processing_days`) AS `total_processing_days`,`wm_registration`.`processing_days` AS `processing_days` from `wm_registration` where `wm_registration`.`is_delete` <> 1 and `wm_registration`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `wm_registration`.`status`,`wm_registration`.`processing_days` order by count(`wm_registration`.`wmregistration_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_repairer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_repairer_count` AS select `wm_repairer`.`status` AS `status`,count(`wm_repairer`.`repairer_id`) AS `total_records`,sum(`wm_repairer`.`processing_days`) AS `total_processing_days`,`wm_repairer`.`processing_days` AS `processing_days` from `wm_repairer` where `wm_repairer`.`is_delete` <> 1 and `wm_repairer`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `wm_repairer`.`status`,`wm_repairer`.`processing_days` order by count(`wm_repairer`.`repairer_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_repairer_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_repairer_renewal_count` AS select `wm_repairer_renewal`.`status` AS `status`,count(`wm_repairer_renewal`.`repairer_renewal_id`) AS `total_records`,sum(`wm_repairer_renewal`.`processing_days`) AS `total_processing_days`,`wm_repairer_renewal`.`processing_days` AS `processing_days` from `wm_repairer_renewal` where `wm_repairer_renewal`.`is_delete` <> 1 and `wm_repairer_renewal`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `wm_repairer_renewal`.`status`,`wm_repairer_renewal`.`processing_days` order by count(`wm_repairer_renewal`.`repairer_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_zone_information_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_zone_information_count` AS select `zone_information`.`status` AS `status`,count(`zone_information`.`zone_id`) AS `total_records`,sum(`zone_information`.`processing_days`) AS `total_processing_days`,`zone_information`.`processing_days` AS `processing_days` from `zone_information` where `zone_information`.`is_delete` <> 1 and `zone_information`.`submitted_datetime` >= '2022-01-01 00:00:00' group by `zone_information`.`status`,`zone_information`.`processing_days` order by count(`zone_information`.`zone_id`) desc;

-- 2024-12-03 07:08:21

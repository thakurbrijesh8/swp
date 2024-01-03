-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `cinema`;
CREATE TABLE `cinema` (
  `cinema_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
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
  PRIMARY KEY (`cinema_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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


DROP TABLE IF EXISTS `logs_change_pin`;
CREATE TABLE `logs_change_pin` (
  `logs_change_pin_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `old_pin` text NOT NULL,
  `new_pin` text NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`logs_change_pin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `logs_email`;
CREATE TABLE `logs_email` (
  `email_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `email_type` tinyint(1) NOT NULL,
  `status` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`email_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `otp`;
CREATE TABLE `otp` (
  `otp_id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile_number` varchar(10) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `otp_type` tinyint(1) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_expired` tinyint(1) NOT NULL,
  PRIMARY KEY (`otp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `psf_registration`;
CREATE TABLE `psf_registration` (
  `psfregistration_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firm_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `principal_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firm_duration` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `import_from_outside` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apploication_of_firm_document` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `formII_document` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partnership_deed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aadharcard` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pancard` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `import_from_outside_ret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retirement_form` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
  PRIMARY KEY (`query_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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
  PRIMARY KEY (`query_document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `sa_logs_change_password`;
CREATE TABLE `sa_logs_change_password` (
  `sa_logs_change_password_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sa_user_id` bigint(20) NOT NULL,
  `old_password` text NOT NULL,
  `new_password` text NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`sa_logs_change_password_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `sa_users`;
CREATE TABLE `sa_users` (
  `sa_user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `is_deactive` tinyint(1) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`sa_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sa_users` (`sa_user_id`, `name`, `username`, `password`, `user_type`, `district`, `is_deactive`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1,	'Admin',	'admin',	'f6e1823488b1bd4e72127c4b3005cf0862396666366436393539326636656236353437636264623065383461323334653363316339653864303632666264613634333965346439623931383036366334400b37037b94f4452462',	1,	0,	0,	1,	'2020-03-25 17:20:00',	1,	'2020-09-02 10:38:55',	0),
(2,	'Labour Dept. Daman',	'labour.daman',	'60b4146f3f0e97ee65b449db8804357065623639336461313831386434623336303066313363343837656535313437666233303337363135613861373765336130383339346163633738653864633038041c2cdd9127b548df70',	2,	1,	0,	1,	'2020-08-28 13:44:06',	1,	'2020-09-09 16:22:57',	0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sa_user_type` (`sa_user_type_id`, `type`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1,	'Admin',	1,	'2020-03-25 13:54:00',	0,	'0000-00-00 00:00:00',	0),
(2,	'Labour Department',	1,	'2020-08-28 11:28:00',	0,	'0000-00-00 00:00:00',	0);

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
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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


DROP TABLE IF EXISTS `wm_dealer`;
CREATE TABLE `wm_dealer` (
  `dealer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_dealer` varchar(255) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `dealer_license_no` varchar(255) NOT NULL,
  `establishment_date` date NOT NULL,
  `is_limited_company` int(11) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `registration_date` date NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `categories_sold` varchar(255) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(255) NOT NULL,
  `any_previous_application` varchar(255) NOT NULL,
  `license_application_date` varchar(255) NOT NULL,
  `license_application_result` varchar(255) NOT NULL,
  `import_from_outside` varchar(255) NOT NULL,
  `registration_of_importer` varchar(255) NOT NULL,
  `date_of_application` date NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `signature` varchar(255) NOT NULL,
  `import_model` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`dealer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `wm_manufacturer`;
CREATE TABLE `wm_manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_manufacturer` varchar(255) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `premises_status` int(11) NOT NULL,
  `establishment_date` date NOT NULL,
  `is_limited_company` int(11) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `registration_date` date NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `manufacturing_activity` varchar(255) NOT NULL,
  `weights_type` varchar(255) NOT NULL,
  `measures_type` varchar(255) NOT NULL,
  `weighing_instruments_type` varchar(255) NOT NULL,
  `measuring_instruments_type` varchar(255) NOT NULL,
  `no_of_skilled` int(11) NOT NULL,
  `no_of_semiskilled` int(11) NOT NULL,
  `no_of_unskilled` int(11) NOT NULL,
  `no_of_specialist` int(11) NOT NULL,
  `details_of_personnel` varchar(255) NOT NULL,
  `details_of_machinery` varchar(255) NOT NULL,
  `details_of_foundry` varchar(255) NOT NULL,
  `steel_casting_facility` varchar(255) NOT NULL,
  `electric_energy_availability` varchar(255) NOT NULL,
  `details_of_loan` varchar(255) NOT NULL,
  `banker_names` varchar(255) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(255) NOT NULL,
  `any_previous_application` varchar(255) NOT NULL,
  `license_application_date` date NOT NULL,
  `license_application_result` varchar(255) NOT NULL,
  `location_of_selling` varchar(255) NOT NULL,
  `model_approval_detail` varchar(255) NOT NULL,
  `inspection_sample_date` date NOT NULL,
  `date_of_application` date NOT NULL,
  `signature` varchar(255) NOT NULL,
  `support_document` varchar(255) NOT NULL,
  `monogram_uploader` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `wm_registration`;
CREATE TABLE `wm_registration` (
  `wmregistration_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(255) NOT NULL,
  `application_category` varchar(255) NOT NULL,
  `branches` varchar(255) NOT NULL,
  `location_of_factory` varchar(255) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `signature` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`wmregistration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `wm_repairer`;
CREATE TABLE `wm_repairer` (
  `repairer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_repairer` varchar(255) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `premises_status` int(11) NOT NULL,
  `establishment_date` date NOT NULL,
  `is_limited_company` tinyint(4) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `registration_date` date NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(255) NOT NULL,
  `weights_type` varchar(255) NOT NULL,
  `area_operate` varchar(255) NOT NULL,
  `previous_experience` varchar(255) NOT NULL,
  `no_of_skilled` int(11) NOT NULL,
  `no_of_semiskilled` int(11) NOT NULL,
  `no_of_unskilled` int(11) NOT NULL,
  `no_of_specialist` int(11) NOT NULL,
  `details_of_personnel` varchar(255) NOT NULL,
  `details_of_machinery` varchar(255) NOT NULL,
  `electric_energy_availability` varchar(255) NOT NULL,
  `sufficient_stock` varchar(255) NOT NULL,
  `stock_details` varchar(255) NOT NULL,
  `any_previous_application` varchar(255) NOT NULL,
  `license_application_date` varchar(255) NOT NULL,
  `license_application_result` varchar(255) NOT NULL,
  `date_of_application` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `signature` varchar(255) NOT NULL,
  `support_document` varchar(255) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  PRIMARY KEY (`repairer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2020-10-29 06:44:49

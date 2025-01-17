CREATE TABLE `wm_dealer_renewal` (
  `dealer_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `dealer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_dealer` varchar(255) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `dealer_license_no` varchar(255) NOT NULL,
  `establishment_date` date NOT NULL,
  `is_limited_company` int(11) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
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
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `import_model` varchar(255) NOT NULL,
  `query_status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`dealer_renewal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `wm_manufacturer_renewal` (
  `manufacturer_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_manufacturer` varchar(255) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `premises_status` int(11) NOT NULL,
  `is_limited_company` int(11) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_date` date NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `weights_type` varchar(255) NOT NULL,
  `propose_change` varchar(255) NOT NULL,
  `production_sales` varchar(255) NOT NULL,
  `details_of_foundry` varchar(255) NOT NULL,
  `date_of_application` date NOT NULL,
  `signature` varchar(255) NOT NULL,
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
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `query_status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`manufacturer_renewal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `wm_repairer_renewal` (
  `repairer_renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `repairer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_repairer` varchar(255) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `is_limited_company` tinyint(4) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`proprietor_details`)),
  `registration_date` date NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(255) NOT NULL,
  `weights_type` varchar(255) NOT NULL,
  `propose_change` varchar(255) NOT NULL,
  `area_operate` varchar(255) NOT NULL,
  `sufficient_stock` varchar(255) NOT NULL,
  `stock_details` varchar(255) NOT NULL,
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
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  PRIMARY KEY (`repairer_renewal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
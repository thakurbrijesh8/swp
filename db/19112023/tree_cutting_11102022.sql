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
  PRIMARY KEY (`module_documents_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `module_other_documents`;
CREATE TABLE `module_other_documents` (
  `module_other_documents_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_type` tinyint(4) NOT NULL,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_doc_name` varchar(200) NOT NULL,
  `other_doc_path` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`module_other_documents_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`tree_cutting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP VIEW IF EXISTS `view_get_ds_wise_tree_cutting_count`;
CREATE TABLE `view_get_ds_wise_tree_cutting_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));

DROP VIEW IF EXISTS `view_get_status_wise_tree_cutting_count`;
CREATE TABLE `view_get_status_wise_tree_cutting_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));

DROP TABLE IF EXISTS `view_get_ds_wise_tree_cutting_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_tree_cutting_count` AS select `tree_cutting`.`district` AS `district`,`tree_cutting`.`user_id` AS `user_id`,`tree_cutting`.`query_status` AS `query_status`,`tree_cutting`.`status` AS `status`,count(`tree_cutting`.`tree_cutting_id`) AS `total_records`,sum(`tree_cutting`.`processing_days`) AS `total_processing_days`,`tree_cutting`.`processing_days` AS `processing_days` from `tree_cutting` where `tree_cutting`.`is_delete` <> 1 group by `tree_cutting`.`district`,`tree_cutting`.`user_id`,`tree_cutting`.`query_status`,`tree_cutting`.`status`,`tree_cutting`.`processing_days`;

DROP TABLE IF EXISTS `view_get_status_wise_tree_cutting_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_tree_cutting_count` AS select `tree_cutting`.`status` AS `status`,count(`tree_cutting`.`tree_cutting_id`) AS `total_records`,sum(`tree_cutting`.`processing_days`) AS `total_processing_days`,`tree_cutting`.`processing_days` AS `processing_days` from `tree_cutting` where `tree_cutting`.`is_delete` <> 1 group by `tree_cutting`.`status`,`tree_cutting`.`processing_days` order by count(`tree_cutting`.`tree_cutting_id`) desc;
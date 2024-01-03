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
  PRIMARY KEY (`society_registration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP VIEW IF EXISTS `view_get_ds_wise_society_registration_count`;
CREATE TABLE `view_get_ds_wise_society_registration_count` (`district` tinyint(1), `user_id` int(11), `query_status` tinyint(1), `status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));

DROP VIEW IF EXISTS `view_get_status_wise_society_registration_count`;
CREATE TABLE `view_get_status_wise_society_registration_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));

DROP TABLE IF EXISTS `view_get_ds_wise_society_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_ds_wise_society_registration_count` AS select `society_registration`.`district` AS `district`,`society_registration`.`user_id` AS `user_id`,`society_registration`.`query_status` AS `query_status`,`society_registration`.`status` AS `status`,count(`society_registration`.`society_registration_id`) AS `total_records`,sum(`society_registration`.`processing_days`) AS `total_processing_days`,`society_registration`.`processing_days` AS `processing_days` from `society_registration` where `society_registration`.`is_delete` <> 1 group by `society_registration`.`district`,`society_registration`.`user_id`,`society_registration`.`query_status`,`society_registration`.`status`,`society_registration`.`processing_days`;

DROP TABLE IF EXISTS `view_get_status_wise_society_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_society_registration_count` AS select `society_registration`.`status` AS `status`,count(`society_registration`.`society_registration_id`) AS `total_records`,sum(`society_registration`.`processing_days`) AS `total_processing_days`,`society_registration`.`processing_days` AS `processing_days` from `society_registration` where `society_registration`.`is_delete` <> 1 group by `society_registration`.`status`,`society_registration`.`processing_days` order by count(`society_registration`.`society_registration_id`) desc;
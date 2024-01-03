CREATE TABLE `view_get_ds_wise_vc_count` (
  `district` tinyint(1) NOT NULL,
  `status` int NOT NULL,
  `total_records` bigint(21) NOT NULL
);

DROP TABLE IF EXISTS `vc`;
CREATE TABLE `vc` (
  `vc_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
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
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`vc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


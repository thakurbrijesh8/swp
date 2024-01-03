CREATE TABLE `fees_bifurcation` (
  `fees_bifurcation_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_type` tinyint(4) NOT NULL,
  `module_id` int(11) NOT NULL,
  `fee_description` varchar(100) NOT NULL,
  `fee` decimal(6,0) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`fees_bifurcation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `fees_payment`;
CREATE TABLE `fees_payment` (
  `fees_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` text NOT NULL,
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
  PRIMARY KEY (`fees_payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`fees_payment_dv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `appli_licence`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `appli_licence_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `bocw`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `boileract`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `boileract_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `boilermanufactures`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `buildingplan`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `cinema`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `construction`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `establishment`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `factorylicence`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `factorylicence_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `filmshooting`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `hotel`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `hotel_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `land_allotment`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `migrantworkers`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `migrantworkers_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `msme`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `na`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `occupancy_certificate`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `periodicalreturn`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `property_registration`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `psf_registration`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `rii`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `shop`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `shop_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `singlereturn`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `textile`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `travelagent`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `travelagent_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `vc`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wc`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_dealer`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_dealer_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_manufacturer`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_manufacturer_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_registration`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_repairer`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_repairer_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`,
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;
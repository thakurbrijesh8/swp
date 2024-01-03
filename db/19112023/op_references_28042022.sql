ALTER TABLE `property_registration`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

-- New 

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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

ALTER TABLE `msme`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_registration`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_repairer`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_repairer_renewal`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_dealer`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_dealer_renewal`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_manufacturer`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wm_manufacturer_renewal`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `rii`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `vc`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `wc`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `hotel`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `hotel_renewal`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `travelagent`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `travelagent_renewal`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `cinema`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `filmshooting`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `na`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `textile`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `land_allotment`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `construction`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `occupancy_certificate`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `shop`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `shop_renewal`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `establishment`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `bocw`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `migrantworkers`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `migrantworkers_renewal`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `singlereturn`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `appli_licence`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `appli_licence_renewal`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `boileract`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `boileract_renewal`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `boilermanufactures`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `buildingplan`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `factorylicence`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `factorylicence_renewal`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `psf_registration`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;

ALTER TABLE `property_registration`
ADD `last_op_reference_number` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `total_fees`;
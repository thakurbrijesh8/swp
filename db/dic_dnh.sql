ALTER TABLE `noc` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `user_id`;

ALTER TABLE `noc` ADD `withdrawal_remarks` VARCHAR(200) NOT NULL AFTER `remarks`;

ALTER TABLE `noc` ADD `rating` TINYINT(1) NOT NULL AFTER `query_status`;

ALTER TABLE `noc` ADD `feedback` VARCHAR(200) NOT NULL AFTER `rating`;

ALTER TABLE `noc` ADD `fr_datetime` DATETIME NOT NULL AFTER `feedback`;

ALTER TABLE `noc` ADD `payment_type` TINYINT(1) NOT NULL AFTER `processing_days`, ADD `user_payment_type` TINYINT(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `noc` ADD `total_fees` DECIMAL NOT NULL AFTER `user_payment_type`;

ALTER TABLE `noc` ADD `last_op_reference_number` VARCHAR(100) NOT NULL AFTER `total_fees`;

ALTER TABLE `lease_seller` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `user_id`;

ALTER TABLE `lease_seller` ADD `withdrawal_remarks` VARCHAR(200) NOT NULL AFTER `remarks`;

ALTER TABLE `lease_seller` ADD `rating` TINYINT(1) NOT NULL AFTER `query_status`;

ALTER TABLE `lease_seller` ADD `feedback` VARCHAR(200) NOT NULL AFTER `rating`;

ALTER TABLE `lease_seller` ADD `fr_datetime` DATETIME NOT NULL AFTER `feedback`;

ALTER TABLE `lease_seller` ADD `payment_type` TINYINT(1) NOT NULL AFTER `processing_days`, ADD `user_payment_type` TINYINT(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `lease_seller` ADD `total_fees` DECIMAL NOT NULL AFTER `user_payment_type`;

ALTER TABLE `lease_seller` ADD `last_op_reference_number` VARCHAR(100) NOT NULL AFTER `total_fees`;

ALTER TABLE `transfer` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `user_id`;

ALTER TABLE `transfer` ADD `withdrawal_remarks` VARCHAR(200) NOT NULL AFTER `remarks`;

ALTER TABLE `transfer` ADD `rating` TINYINT(1) NOT NULL AFTER `query_status`;

ALTER TABLE `transfer` ADD `feedback` VARCHAR(200) NOT NULL AFTER `rating`;

ALTER TABLE `transfer` ADD `fr_datetime` DATETIME NOT NULL AFTER `feedback`;

ALTER TABLE `transfer` ADD `payment_type` TINYINT(1) NOT NULL AFTER `processing_days`, ADD `user_payment_type` TINYINT(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `transfer` ADD `total_fees` DECIMAL NOT NULL AFTER `user_payment_type`;

ALTER TABLE `transfer` ADD `last_op_reference_number` VARCHAR(100) NOT NULL AFTER `total_fees`;

ALTER TABLE `sub_letting` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `user_id`;

ALTER TABLE `sub_letting` ADD `withdrawal_remarks` VARCHAR(200) NOT NULL AFTER `remarks`;

ALTER TABLE `sub_letting` ADD `rating` TINYINT(1) NOT NULL AFTER `query_status`;

ALTER TABLE `sub_letting` ADD `feedback` VARCHAR(200) NOT NULL AFTER `rating`;

ALTER TABLE `sub_letting` ADD `fr_datetime` DATETIME NOT NULL AFTER `feedback`;

ALTER TABLE `sub_letting` ADD `payment_type` TINYINT(1) NOT NULL AFTER `processing_days`, ADD `user_payment_type` TINYINT(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `sub_letting` ADD `total_fees` DECIMAL NOT NULL AFTER `user_payment_type`;

ALTER TABLE `sub_letting` ADD `last_op_reference_number` VARCHAR(100) NOT NULL AFTER `total_fees`;






















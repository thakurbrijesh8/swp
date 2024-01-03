ALTER TABLE `appli_licence_renewal`
ADD `parent_id` int(11) NOT NULL AFTER `aplicence_id`;

ALTER TABLE `appli_licence_renewal`
ADD `fees` int(5) NOT NULL AFTER `valid_upto`;

ALTER TABLE `appli_licence_renewal`
ADD `duration_of_work` varchar(100) COLLATE 'utf8_unicode_ci' NOT NULL AFTER `licence_status`,
ADD `establi_name` varchar(100) COLLATE 'utf8_unicode_ci' NOT NULL AFTER `duration_of_work`,
ADD `establi_address` varchar(100) COLLATE 'utf8_unicode_ci' NOT NULL AFTER `establi_name`,
DROP `treasury_receipt_no`,
DROP `date_treasury_receipt`;

ALTER TABLE `appli_licence`
DROP `treasury_receipt_no`,
DROP `date_treasury_receipt`,
DROP `place`,
DROP `application_date`,
ADD `fees` int(5) NOT NULL AFTER `valid_upto`;

ALTER TABLE `appli_licence_renewal`
ADD `max_no_of_empl` varchar(100) NOT NULL AFTER `expiry_date_of_prev_licence`;
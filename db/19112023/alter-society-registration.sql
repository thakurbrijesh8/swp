ALTER TABLE `society_registration`
ADD `letter_remarks` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `query_status`,
ADD `letter` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `letter_remarks`,
ADD `letter_updated_date` datetime NOT NULL AFTER `letter`;

ALTER TABLE `society_registration`
ADD `letter_status` tinyint(1) NOT NULL AFTER `letter_updated_date`;

ALTER TABLE `society_registration`
ADD `passbook` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `letter_status`,
ADD `passbook_updated_date` datetime NOT NULL AFTER `passbook`;
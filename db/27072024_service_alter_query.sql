ALTER TABLE `service`
ADD `risk_category` tinyint(1) NOT NULL AFTER `service_name`,
ADD `size_of_firm` tinyint(1) NOT NULL AFTER `risk_category`,
ADD `foreign_domestic_investor` tinyint(1) NOT NULL AFTER `size_of_firm`;


ALTER TABLE `service`
CHANGE `risk_category` `risk_category` varchar(50) COLLATE 'utf8_general_ci' NOT NULL AFTER `service_name`,
CHANGE `size_of_firm` `size_of_firm` varchar(50) COLLATE 'utf8_general_ci' NOT NULL AFTER `risk_category`;

UPDATE `service` SET `risk_category` = '' WHERE risk_category = 0;
UPDATE `service` SET `size_of_firm` = '' WHERE size_of_firm = 0;


ALTER TABLE `service`
CHANGE `foreign_domestic_investor` `foreign_domestic_investor` varchar(50) COLLATE 'utf8_general_ci' NOT NULL AFTER `size_of_firm`,
CHANGE `service_type` `service_type` varchar(50) COLLATE 'utf8_general_ci' NOT NULL AFTER `foreign_domestic_investor`;

UPDATE `service` SET `foreign_domestic_investor` = '' WHERE foreign_domestic_investor = 0;
UPDATE `service` SET `service_type` = '' WHERE service_type = 0;
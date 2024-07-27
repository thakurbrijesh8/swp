ALTER TABLE `service`
ADD `risk_category` tinyint(1) NOT NULL AFTER `service_name`,
ADD `size_of_firm` tinyint(1) NOT NULL AFTER `risk_category`,
ADD `foreign_domestic_investor` tinyint(1) NOT NULL AFTER `size_of_firm`;
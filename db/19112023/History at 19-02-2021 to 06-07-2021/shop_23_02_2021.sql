ALTER TABLE `shop`
CHANGE `s_sign_of_employer` `s_sign_of_employer` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `gst`,
ADD `certificate_tourism` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `s_sign_of_employer`,
ADD `license_health` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `certificate_tourism`,
ADD `noc_health` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `license_health`;
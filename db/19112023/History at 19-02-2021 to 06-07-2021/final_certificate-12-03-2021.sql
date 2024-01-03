ALTER TABLE `shop`
ADD `certificate_file` varchar(100) NOT NULL AFTER `s_certificate_expiry_date`,
ADD `final_certificate` varchar(100) NOT NULL AFTER `certificate_file`;

ALTER TABLE `shop_renewal`
ADD `certificate_file` varchar(100) NOT NULL AFTER `last_valid_upto`,
ADD `final_certificate` varchar(100) NOT NULL AFTER `certificate_file`;

ALTER TABLE `bocw`
ADD `certificate_file` varchar(100) NOT NULL AFTER `valid_upto`,
ADD `final_certificate` varchar(100) NOT NULL AFTER `certificate_file`;

ALTER TABLE `appli_licence`
ADD `certificate_file` varchar(100) NOT NULL AFTER `valid_upto`,
ADD `final_certificate` varchar(100) NOT NULL AFTER `certificate_file`;

ALTER TABLE `appli_licence_renewal`
ADD `certificate_file` varchar(100) NOT NULL AFTER `valid_upto`,
ADD `final_certificate` varchar(100) NOT NULL AFTER `certificate_file`;
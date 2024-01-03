ALTER TABLE `na`
ADD `certificate_file` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `valid_upto`,
ADD `final_certificate` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `certificate_file`;

ALTER TABLE `msme`
ADD `certificate_file` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `valid_upto`,
ADD `final_certificate` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `certificate_file`;

ALTER TABLE `textile`
ADD `certificate_file` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `valid_upto`,
ADD `final_certificate` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `certificate_file`;
ALTER TABLE `boileract_renewal`
ADD `certificate_file` varchar(100) NOT NULL AFTER `valid_upto`,
ADD `final_certificate` varchar(100) NOT NULL AFTER `certificate_file`;

ALTER TABLE `boileract`
ADD `certificate_file` varchar(100) NOT NULL AFTER `valid_upto`,
ADD `final_certificate` varchar(100) NOT NULL AFTER `certificate_file`;
ALTER TABLE `psf_registration`
ADD `certificate_file` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `valid_upto`,
ADD `final_certificate` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `certificate_file`;
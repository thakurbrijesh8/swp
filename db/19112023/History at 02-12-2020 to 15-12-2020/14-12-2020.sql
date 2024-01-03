ALTER TABLE `psf_registration`
ADD `alteration_name_firm` tinyint(1) NOT NULL AFTER `pancard`,
ADD `alteration_name_firm_doc` varchar(255) COLLATE 'utf8_unicode_ci' NOT NULL AFTER `alteration_name_firm`;

ALTER TABLE `plot_numbers`
ADD `is_vacant` tinyint(1) NOT NULL AFTER `plot_no`;
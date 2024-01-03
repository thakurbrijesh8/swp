ALTER TABLE `psf_registration`
CHANGE `apploication_of_firm_document` `application_of_firm_document` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `import_from_outside`;
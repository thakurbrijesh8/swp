ALTER TABLE `land_allotment`
ADD `emission_of_gases_doc` varchar(255) COLLATE 'utf8_unicode_ci' NOT NULL AFTER `detail_of_emission_of_gases`,
ADD `if_promotion_council` tinyint(1) NOT NULL AFTER `relevant_experience_doc`;
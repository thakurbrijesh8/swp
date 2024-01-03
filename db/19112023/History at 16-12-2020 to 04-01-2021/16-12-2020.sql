ALTER TABLE `land_allotment`
ADD `if_belonging_transg` tinyint(1) NOT NULL AFTER `if_backward_class_ph_doc`,
ADD `if_belonging_transg_doc` varchar(255) COLLATE 'utf8_unicode_ci' NOT NULL AFTER `if_belonging_transg`,
ADD `if_belonging_other` tinyint(1) NOT NULL AFTER `if_belonging_transg_doc`,
ADD `if_belonging_other_doc` varchar(255) COLLATE 'utf8_unicode_ci' NOT NULL AFTER `if_belonging_other`;



ALTER TABLE `land_allotment`
DROP `is_allotment_plot`;
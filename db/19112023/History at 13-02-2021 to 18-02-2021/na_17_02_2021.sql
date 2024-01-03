ALTER TABLE `na`
ADD `area_assessment` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `survey_no`,
CHANGE `electrical_distance_land` `electrical_distance_land` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `situated_land`,
CHANGE `acquisition_under_land` `acquisition_under_land` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `electrical_distance_land`,
CHANGE `accessible_land` `accessible_land` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `acquisition_under_land`,
CHANGE `site_access_land` `site_access_land` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `accessible_land`,
CHANGE `rejected_land` `rejected_land` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `site_access_land`;

ALTER TABLE `na`
ADD `multiple_applicant` text NOT NULL AFTER `user_id`;

ALTER TABLE `na`
ADD `certified_copy` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `multiple_applicant`,
ADD `sketch_layout` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `certified_copy`,
ADD `written_consent` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `sketch_layout`;

ALTER TABLE `na`
ADD `agri_purpose_a` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `multiple_applicant`,
ADD `non_agri_purpose_b` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `agri_purpose_a`,
ADD `non_agri_purpose_c` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `non_agri_purpose_b`,
ADD `rel_condition_c` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `non_agri_purpose_c`,
ADD `pre_non_agri_c` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rel_condition_c`;
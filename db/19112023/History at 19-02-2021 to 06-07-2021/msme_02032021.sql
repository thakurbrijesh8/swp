ALTER TABLE `msme`
ADD `doc_19` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_18`,
ADD `doc_20` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_19`,
ADD `doc_21` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_20`,
ADD `doc_22` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_21`,
ADD `doc_23` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_22`,
ADD `doc_24` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `doc_23`;

ALTER TABLE `msme`
ADD `form_application_checklist` varchar(50) COLLATE 'utf8_general_ci' NOT NULL AFTER `unit_type`;
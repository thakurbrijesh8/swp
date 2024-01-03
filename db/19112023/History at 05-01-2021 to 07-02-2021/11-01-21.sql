ALTER TABLE `hotel`
ADD `mob_no` varchar(10) COLLATE 'utf8_general_ci' NOT NULL AFTER `fees`;

ALTER TABLE `travelagent`
ADD `mob_no` varchar(10) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `fees`;

ALTER TABLE `tourismevent`
ADD `mob_no` varchar(10) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `duration_of_event`;

ALTER TABLE `hotel_renewal`
ADD `mob_no` varchar(10) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `fees`;

ALTER TABLE `travelagent_renewal`
ADD `mob_no` varchar(10) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `fees`;
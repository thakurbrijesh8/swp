ALTER TABLE `travelagent`
CHANGE `remarks` `remarks` text COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `last_valid_upto`;

ALTER TABLE `hotel`
CHANGE `remarks` `remarks` text COLLATE 'utf8_general_ci' NOT NULL AFTER `last_valid_upto`;

ALTER TABLE `hotel_renewal`
CHANGE `remarks` `remarks` text COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `last_valid_upto`;

ALTER TABLE `travelagent_renewal`
CHANGE `remarks` `remarks` text COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `last_valid_upto`;

ALTER TABLE `tourismevent`
CHANGE `remarks` `remarks` text COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `valid_upto`;
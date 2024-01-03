ALTER TABLE `wm_dealer`
ADD `submitted_datetime` datetime NOT NULL AFTER `status_datetime`;

ALTER TABLE `wm_manufacturer`
ADD `submitted_datetime` datetime NOT NULL AFTER `status_datetime`;

ALTER TABLE `wm_registration`
ADD `submitted_datetime` datetime NOT NULL AFTER `status_datetime`;

ALTER TABLE `wm_repairer`
ADD `submitted_datetime` datetime NOT NULL AFTER `status_datetime`;
ALTER TABLE `factorylicence`
ADD `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `factorylicence_renewal`
ADD `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `buildingplan`
ADD `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `boileract`
CHANGE `district` `district` tinyint(1) NOT NULL AFTER `situation_of_boiler`;

ALTER TABLE `boileract_renewal`
CHANGE `district` `district` tinyint(1) NOT NULL AFTER `situation_of_boiler`;

ALTER TABLE `boilermanufactures`
ADD `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `factorylicence`
ADD `submitted_datetime` datetime NOT NULL AFTER `status_datetime`;

ALTER TABLE `buildingplan`
ADD `submitted_datetime` datetime NOT NULL AFTER `status_datetime`;

ALTER TABLE `boileract`
ADD `submitted_datetime` datetime NOT NULL AFTER `status_datetime`;

ALTER TABLE `boilermanufactures`
ADD `submitted_datetime` datetime NOT NULL AFTER `status_datetime`;
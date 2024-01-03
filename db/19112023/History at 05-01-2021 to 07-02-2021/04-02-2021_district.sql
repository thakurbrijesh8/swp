ALTER TABLE `wc`
ADD `district` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `water_meter`;

ALTER TABLE `wc`
CHANGE `district` `district` tinyint(1) NOT NULL AFTER `water_meter`;

ALTER TABLE `hotel`
CHANGE `name_of_tourist_area` `name_of_tourist_area` tinyint(1) NOT NULL AFTER `full_address`;

ALTER TABLE `hotel_renewal`
ADD `name_of_tourist_area` tinyint(1) NOT NULL AFTER `mob_no`;

ALTER TABLE `travelagent`
CHANGE `area_of_agency` `area_of_agency` tinyint(1) NOT NULL AFTER `address_of_agency`;

ALTER TABLE `travelagent_renewal`
ADD `area_of_agency` tinyint(1) NOT NULL AFTER `mob_no`;

ALTER TABLE `tourismevent`
ADD `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `cinema`
ADD `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `shop`
ADD `district` tinyint(1) NOT NULL AFTER `s_registration_no`;

ALTER TABLE `shop_renewal`
ADD `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `establishment`
ADD `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `bocw`
ADD `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `migrantworkers`
ADD `district` tinyint(1) NOT NULL AFTER `mw_registration_no`;

ALTER TABLE `migrantworkers_renewal`
ADD `district` tinyint(1) NOT NULL AFTER `registration_number`;

ALTER TABLE `appli_licence`
ADD `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `appli_licence_renewal`
ADD `district` tinyint(1) NOT NULL AFTER `license_number`;

ALTER TABLE `singlereturn`
ADD `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `na`
CHANGE `district` `district` tinyint(1) NOT NULL AFTER `occupation`;

----------------------------------- Submitted -----------------
ALTER TABLE `shop`
ADD `submitted_datetime` datetime NOT NULL AFTER `s_remark`;

ALTER TABLE `migrantworkers`
ADD `submitted_datetime` datetime NOT NULL AFTER `fees_paid_challan_updated_date`;

ALTER TABLE `establishment`
ADD `submitted_datetime` datetime NOT NULL AFTER `valid_upto`;
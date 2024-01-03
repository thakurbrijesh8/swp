ALTER TABLE `property_registration`
ADD `district` varchar(50) NOT NULL AFTER `user_id`;

ALTER TABLE `site_elevation`
ADD `district` varchar(50) NOT NULL AFTER `user_id`;

ALTER TABLE `zone_information`
ADD `district` varchar(50) NOT NULL AFTER `user_id`;


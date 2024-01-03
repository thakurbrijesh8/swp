

ALTER TABLE `construction`
ADD `district` varchar(50) NOT NULL AFTER `user_id`

ALTER TABLE `occupancy_certificate` CHANGE `completion_date` `completion_date` VARCHAR(255) NOT NULL;

ALTER TABLE `occupancy_certificate`  ADD `district` VARCHAR(50) NOT NULL  AFTER `user_id`;
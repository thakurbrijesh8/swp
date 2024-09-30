ALTER TABLE `wc` ADD `applying_for` TINYINT(1) NOT NULL AFTER `user_id`;

ALTER TABLE `wc` ADD `reason_of_rejection` VARCHAR(100) NOT NULL AFTER `query_status`, 
ADD `certificate_of_rejection` VARCHAR(100) NOT NULL AFTER `reason_of_rejection`;
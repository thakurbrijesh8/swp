ALTER TABLE `logs_email`
ADD `module_type` tinyint NOT NULL AFTER `email_type`,
ADD `module_id` int NOT NULL AFTER `module_type`;
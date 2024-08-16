ALTER TABLE `sa_users`
ADD `is_npp` tinyint(1) NOT NULL AFTER `is_deactive`,
ADD `npp_datetime` datetime NOT NULL AFTER `is_npp`;
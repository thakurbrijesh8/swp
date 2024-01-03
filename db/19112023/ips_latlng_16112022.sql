ALTER TABLE `ips`
ADD `latitude` decimal(12,6) NOT NULL AFTER `office_address`,
ADD `longitude` decimal(12,6) NOT NULL AFTER `latitude`;
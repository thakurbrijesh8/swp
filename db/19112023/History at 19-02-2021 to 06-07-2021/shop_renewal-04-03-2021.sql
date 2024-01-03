ALTER TABLE `shop_renewal`
ADD `parent_id` int(11) NOT NULL AFTER `shop_id`;

ALTER TABLE `shop_renewal`
ADD `door_no` varchar(25) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `name_of_shop`,
ADD `street_name` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `door_no`,
ADD `location` text COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `street_name`,
ADD `nature_of_business` varchar(100) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `category`;
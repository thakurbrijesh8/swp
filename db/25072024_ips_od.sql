DROP TABLE IF EXISTS `ips_incentive_od`;
CREATE TABLE `ips_incentive_od` (
  `ips_incentive_od_id` int(11) NOT NULL AUTO_INCREMENT,
  `ips_incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ips_id` int(11) NOT NULL,
  `doc_name` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`ips_incentive_od_id`),
  KEY `ips_incentive_id` (`ips_incentive_id`),
  KEY `ips_id` (`ips_id`),
  KEY `is_delete` (`is_delete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
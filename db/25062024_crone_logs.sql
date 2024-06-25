DROP TABLE IF EXISTS `logs_crone`;
CREATE TABLE `logs_crone` (
  `logs_crone_id` int(11) NOT NULL AUTO_INCREMENT,
  `crone_type` tinyint(1) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `logs_data` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `message` text NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`logs_crone_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
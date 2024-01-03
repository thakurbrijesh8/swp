DROP TABLE IF EXISTS `cfr`;
CREATE TABLE `cfr` (
  `cfr_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `landline_number` varchar(15) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `feedback` text NOT NULL,
  `logs_data` text NOT NULL,
  `created_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`cfr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
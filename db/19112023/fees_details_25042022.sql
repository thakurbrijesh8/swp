CREATE TABLE `fees_bifurcation` (
  `fees_bifurcation_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_type` tinyint(4) NOT NULL,
  `module_id` int(11) NOT NULL,
  `fee_description` varchar(100) NOT NULL,
  `fee` decimal(6,0) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`fees_bifurcation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `establishment`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
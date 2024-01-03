ALTER TABLE `c_inspections`
ADD `officer_ids` text COLLATE 'utf8_general_ci' NOT NULL AFTER `inspection_under_act`;
ALTER TABLE `c_inspections`
ADD `is_lock` tinyint(1) NOT NULL AFTER `status_datetime`;

CREATE TABLE `officer` (
  `officer_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `officer_name` varchar(200) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`officer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
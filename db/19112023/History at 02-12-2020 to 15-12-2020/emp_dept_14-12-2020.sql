DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `department_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `district` tinyint(1) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `department_address` varchar(200) NOT NULL,
  `landline_number` varchar(100) NOT NULL,
  `hod_designation` varchar(100) NOT NULL,
  `hof_designation` varchar(100) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` smallint(6) NOT NULL,
  `employee_name` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `roles` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `pin` text NOT NULL,
  `spacimen_signature` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
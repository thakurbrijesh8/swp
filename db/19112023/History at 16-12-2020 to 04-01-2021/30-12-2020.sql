DROP TABLE IF EXISTS `questionary`;
CREATE TABLE `questionary` (
  `questionary_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `answer` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`questionary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `district` tinyint(1) NOT NULL,
  `department_id` int(11) NOT NULL,
  `service_name` varchar(200) NOT NULL,
  `service_type` tinyint(1) NOT NULL,
  `timeline` varchar(50) NOT NULL,
  `competent_authority` varchar(200) NOT NULL,
  `deemed_approval_authority` varchar(200) NOT NULL,
  `apply_url` varchar(200) NOT NULL,
  `fees_details` varchar(200) NOT NULL,
  `document_checklist` text NOT NULL,
  `procedure` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

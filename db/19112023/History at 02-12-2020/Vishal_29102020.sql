ALTER TABLE `wm_registration`
ADD `query_status` tinyint(1) NOT NULL AFTER `status_datetime`;

ALTER TABLE `wm_repairer`
ADD `query_status` tinyint(1) NOT NULL AFTER `support_document`;

CREATE TABLE `query` (
  `query_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_type` tinyint(1) NOT NULL,
  `module_id` int(11) NOT NULL,
  `query_type` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `query_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`query_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `query_document` (
  `query_document_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `query_id` int NOT NULL,
  `doc_name` varchar(200) COLLATE 'utf8_general_ci' NOT NULL,
  `document` varchar(200) COLLATE 'utf8_general_ci' NOT NULL,
  `created_by` int NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE='InnoDB' COLLATE 'utf8_general_ci';
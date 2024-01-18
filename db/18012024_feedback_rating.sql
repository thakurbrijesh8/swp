SET SQL_MODE='ALLOW_INVALID_DATES';

ALTER TABLE `wm_registration`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `wm_repairer`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `wm_repairer_renewal`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `wm_dealer`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;
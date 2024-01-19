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

ALTER TABLE `wm_dealer_renewal`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `wm_manufacturer`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `wm_manufacturer_renewal`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `rii`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `vc`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `periodicalreturn`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `wc`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `hotel`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `hotel_renewal`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `travelagent`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `travelagent_renewal`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `tourismevent`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `psf_registration`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `cinema`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;

ALTER TABLE `filmshooting`
ADD `rating` tinyint(1) NOT NULL AFTER `query_status`,
ADD `feedback` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `rating`,
ADD `fr_datetime` datetime NOT NULL AFTER `feedback`;
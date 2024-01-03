ALTER TABLE `wm_registration`  ADD `district` TINYINT(1) NOT NULL  AFTER `user_id`;

ALTER TABLE `wm_repairer`  ADD `district` TINYINT(1) NOT NULL  AFTER `user_id`;


ALTER TABLE `wm_repairer_renewal`  ADD `district` TINYINT(1) NOT NULL  AFTER `user_id`;


ALTER TABLE `wm_dealer`  ADD `district` TINYINT(1) NOT NULL  AFTER `user_id`;

ALTER TABLE `wm_dealer_renewal`  ADD `district` TINYINT(1) NOT NULL  AFTER `user_id`;



ALTER TABLE `wm_manufacturer_renewal`  ADD `district` TINYINT(1) NOT NULL  AFTER `user_id`;

ALTER TABLE `wm_manufacturer`  ADD `district` TINYINT(1) NOT NULL  AFTER `user_id`;
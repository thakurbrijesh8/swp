ALTER TABLE `wm_repairer_renewal`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `wm_repairer_renewal`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `wm_dealer`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `wm_dealer`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;


ALTER TABLE `wm_dealer_renewal`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `wm_dealer_renewal`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;


ALTER TABLE `wm_manufacturer_renewal`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `wm_manufacturer_renewal`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;



ALTER TABLE `filmshooting`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `filmshooting`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `incentive_generalform`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `incentive_generalform`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `incentive_generalform_textile`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `incentive_generalform_textile`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `occupancy_certificate`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `occupancy_certificate`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;



ALTER TABLE `boileract`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `boileract`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `boilermanufactures`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `boilermanufactures`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `buildingplan`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `buildingplan`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `factorylicence`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `factorylicence`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;


ALTER TABLE `land_allotment`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `land_allotment`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;


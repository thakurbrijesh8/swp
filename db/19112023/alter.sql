ALTER TABLE `wm_registration`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;

ALTER TABLE `wm_repairer`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;

ALTER TABLE `wm_repairer_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `wm_dealer`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `wm_dealer_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `wm_manufacturer`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `wm_manufacturer_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;

ALTER TABLE `periodicalreturn`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `rii`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `vc`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;

ALTER TABLE `wc`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;


ALTER TABLE `hotel`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `hotel_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `travelagent`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `travelagent_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;

ALTER TABLE `property_registration`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `psf_registration`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;


ALTER TABLE `cinema`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `filmshooting`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `na`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;


ALTER TABLE `land_allotment`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `msme`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `textile`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;

ALTER TABLE `construction`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `occupancy_certificate`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;


ALTER TABLE `bocw`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `shop`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `shop_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `appli_licence`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `appli_licence_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `migrantworkers`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `migrantworkers_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `singlereturn`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;


ALTER TABLE `boileract`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `boileract_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `boilermanufactures`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `buildingplan`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `factorylicence`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
ALTER TABLE `factorylicence_renewal`
ADD `total_fees` decimal(10,0) NOT NULL AFTER `user_payment_type`;
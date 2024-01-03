ALTER TABLE `wm_registration`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `wm_registration`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `wm_repairer`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `wm_repairer`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `wm_manufacturer`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `wm_manufacturer`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `psf_registration`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `psf_registration`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;


ALTER TABLE `zone_information`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `zone_information`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `construction`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `construction`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `inspection`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `inspection`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `site_elevation`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `site_elevation`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `bocw`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `bocw`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `establishment`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `establishment`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `migrantworkers`
ADD `payment_type` tinyint(1) NOT NULL AFTER `mw_remark`;

ALTER TABLE `migrantworkers`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `shop`
ADD `payment_type` tinyint(1) NOT NULL AFTER `s_remark`;

ALTER TABLE `shop`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `singlereturn`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `singlereturn`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;


ALTER TABLE `wc`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `wc`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `hotel`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `hotel`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `hotel_renewal`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `hotel_renewal`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `travelagent`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `travelagent`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `travelagent_renewal`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `travelagent_renewal`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

ALTER TABLE `cinema`
ADD `payment_type` tinyint(1) NOT NULL AFTER `remarks`;

ALTER TABLE `cinema`
ADD `user_payment_type` tinyint(1) NOT NULL AFTER `payment_type`;

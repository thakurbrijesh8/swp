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

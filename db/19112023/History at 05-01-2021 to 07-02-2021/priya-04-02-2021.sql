ALTER TABLE `psf_registration`
CHANGE `district` `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `land_allotment`
CHANGE `district` `district` tinyint(1) NOT NULL AFTER `user_id`;

ALTER TABLE `noc`
CHANGE `district` `district` tinyint(1) NOT NULL AFTER `state`;

ALTER TABLE `lease_seller`
CHANGE `district` `district` tinyint(1) NOT NULL AFTER `state`;
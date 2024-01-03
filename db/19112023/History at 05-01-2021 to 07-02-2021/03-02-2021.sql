ALTER TABLE `psf_registration`
ADD `district` varchar(50) NOT NULL AFTER `user_id`;

ALTER TABLE `land_allotment`
ADD `district` varchar(50) NOT NULL AFTER `user_id`;
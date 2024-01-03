ALTER TABLE `wc`
ADD `processing_days` int NOT NULL AFTER `status_datetime`;

ALTER TABLE `cinema`
ADD `processing_days` int NOT NULL AFTER `status_datetime`;

ALTER TABLE `hotel`
ADD `processing_days` int NOT NULL AFTER `status_datetime`;

ALTER TABLE `psf_registration`
ADD `processing_days` int NOT NULL AFTER `status_datetime`;

ALTER TABLE `wm_dealer`
ADD `processing_days` int NOT NULL AFTER `status_datetime`;

ALTER TABLE `wm_manufacturer`
ADD `processing_days` int NOT NULL AFTER `status_datetime`;

ALTER TABLE `wm_registration`
ADD `processing_days` int NOT NULL AFTER `status_datetime`;

ALTER TABLE `wm_repairer`
ADD `processing_days` int NOT NULL AFTER `status_datetime`;

CREATE OR REPLACE VIEW `view_get_status_wise_wc_count` AS
select `wc`.`status` AS `status`,count(`wc`.`wc_id`) AS `total_records`,
sum(`wc`.`processing_days`) AS `total_processing_days`,`wc`.`processing_days` AS `processing_days`
from `wc` where `wc`.`is_delete` <> 1 group by `wc`.`status`,`wc`.`processing_days`
order by count(`wc`.`wc_id`) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_wm_registration_count` AS
select `wm_registration`.`status` AS `status`,count(`wm_registration`.`wmregistration_id`) AS `total_records`,
sum(`wm_registration`.`processing_days`) AS `total_processing_days`,
`wm_registration`.`processing_days` AS `processing_days`
from `wm_registration` where `wm_registration`.`is_delete` <> 1
group by `wm_registration`.`status`,`wm_registration`.`processing_days`
order by count(`wm_registration`.`wmregistration_id`) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_wm_repairer_count` AS
select `wm_repairer`.`status` AS `status`,count(`wm_repairer`.`repairer_id`) AS `total_records`,
sum(`wm_repairer`.`processing_days`) AS `total_processing_days`,`wm_repairer`.`processing_days` AS `processing_days`
from `wm_repairer` where `wm_repairer`.`is_delete` <> 1
group by `wm_repairer`.`status`,`wm_repairer`.`processing_days`
order by count(`wm_repairer`.`repairer_id`) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_wm_dealer_count` AS
select `wm_dealer`.`status` AS `status`,count(`wm_dealer`.`dealer_id`) AS `total_records`,
sum(`wm_dealer`.`processing_days`) AS `total_processing_days`,`wm_dealer`.`processing_days` AS `processing_days`
from `wm_dealer` where `wm_dealer`.`is_delete` <> 1
group by `wm_dealer`.`status`,`wm_dealer`.`processing_days`
order by count(`wm_dealer`.`dealer_id`) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_wm_manufacturer_count` AS
select `wm_manufacturer`.`status` AS `status`,count(`wm_manufacturer`.`manufacturer_id`) AS `total_records`,
sum(`wm_manufacturer`.`processing_days`) AS `total_processing_days`,`wm_manufacturer`.`processing_days` AS `processing_days`
from `wm_manufacturer` where `wm_manufacturer`.`is_delete` <> 1
group by `wm_manufacturer`.`status`,`wm_manufacturer`.`processing_days`
order by count(`wm_manufacturer`.`manufacturer_id`) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_hotel_count` AS
select `hotel`.`status` AS `status`,count(`hotel`.`hotelregi_id`) AS `total_records`,
sum(`hotel`.`processing_days`) AS `total_processing_days`,`hotel`.`processing_days` AS `processing_days`
from `hotel` where `hotel`.`is_delete` <> 1 group by `hotel`.`status`,`hotel`.`processing_days`
order by count(`hotel`.`hotelregi_id`) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_psf_registration_count` AS
select `psf_registration`.`status` AS `status`,count(`psf_registration`.`psfregistration_id`) AS `total_records`,
sum(`psf_registration`.`processing_days`) AS `total_processing_days`,`psf_registration`.`processing_days` AS `processing_days`
from `psf_registration` where `psf_registration`.`is_delete` <> 1
group by `psf_registration`.`status`,`psf_registration`.`processing_days`
order by count(`psf_registration`.`psfregistration_id`) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_cinema_count` AS
select `cinema`.`status` AS `status`,count(`cinema`.`cinema_id`) AS `total_records`,
sum(`cinema`.`processing_days`) AS `total_processing_days`,`cinema`.`processing_days` AS `processing_days`
from `cinema` where `cinema`.`is_delete` <> 1
group by `cinema`.`status`,`cinema`.`processing_days`
order by count(`cinema`.`cinema_id`) desc;
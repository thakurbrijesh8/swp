CREATE OR REPLACE VIEW `view_get_ds_wise_appli_licence_count` AS
select district, user_id, query_status, status, count(aplicence_id) AS total_records,
sum(processing_days) AS total_processing_days, processing_days
from appli_licence where is_delete <> 1
group by district, user_id, query_status, status, processing_days;

CREATE OR REPLACE VIEW `view_get_ds_wise_appli_licence_renewal_count` AS
select district, user_id, query_status,`appli_licence_renewal`.`status` AS `status`,count(`appli_licence_renewal`.`aplicence_renewal_id`) AS `total_records`,sum(`appli_licence_renewal`.`processing_days`) AS `total_processing_days`,`appli_licence_renewal`.`processing_days` AS `processing_days` from `appli_licence_renewal` where `appli_licence_renewal`.`is_delete` <> 1 group by district, user_id, query_status,`appli_licence_renewal`.`status`,`appli_licence_renewal`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_bocw_count` AS
select district, user_id, query_status,`bocw`.`status` AS `status`,count(`bocw`.`bocw_id`) AS `total_records`,sum(`bocw`.`processing_days`) AS `total_processing_days`,`bocw`.`processing_days` AS `processing_days` from `bocw` where `bocw`.`is_delete` <> 1 group by district, user_id, query_status,`bocw`.`status`,`bocw`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_boileract_count` AS
select district, user_id, query_status,`boileract`.`status` AS `status`,count(`boileract`.`boiler_id`) AS `total_records`,sum(`boileract`.`processing_days`) AS `total_processing_days`,`boileract`.`processing_days` AS `processing_days` from `boileract` where `boileract`.`is_delete` <> 1 group by district, user_id, query_status,`boileract`.`status`,`boileract`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_boileract_renewal_count` AS
select district, user_id, query_status,`boileract_renewal`.`status` AS `status`,count(`boileract_renewal`.`boiler_renewal_id`) AS `total_records`,sum(`boileract_renewal`.`processing_days`) AS `total_processing_days`,`boileract_renewal`.`processing_days` AS `processing_days` from `boileract_renewal` where `boileract_renewal`.`is_delete` <> 1 group by district, user_id, query_status,`boileract_renewal`.`status`,`boileract_renewal`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_boilermanufactures_count` AS
select district, user_id, query_status,`boilermanufactures`.`status` AS `status`,count(`boilermanufactures`.`boilermanufacture_id`) AS `total_records`,sum(`boilermanufactures`.`processing_days`) AS `total_processing_days`,`boilermanufactures`.`processing_days` AS `processing_days` from `boilermanufactures` where `boilermanufactures`.`is_delete` <> 1 group by district, user_id, query_status,`boilermanufactures`.`status`,`boilermanufactures`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_buildingplan_count` AS
select district, user_id, query_status,`buildingplan`.`status` AS `status`,count(`buildingplan`.`buildingplan_id`) AS `total_records`,sum(`buildingplan`.`processing_days`) AS `total_processing_days`,`buildingplan`.`processing_days` AS `processing_days` from `buildingplan` where `buildingplan`.`is_delete` <> 1 group by district, user_id, query_status, `buildingplan`.`status`,`buildingplan`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_cinema_count` AS
select district, user_id, query_status,`cinema`.`status` AS `status`,count(`cinema`.`cinema_id`) AS `total_records`,sum(`cinema`.`processing_days`) AS `total_processing_days`,`cinema`.`processing_days` AS `processing_days` from `cinema` where `cinema`.`is_delete` <> 1 group by district, user_id, query_status,`cinema`.`status`,`cinema`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_construction_count` AS
select district, user_id, query_status,`construction`.`status` AS `status`,count(`construction`.`construction_id`) AS `total_records`,sum(`construction`.`processing_days`) AS `total_processing_days`,`construction`.`processing_days` AS `processing_days` from `construction` where `construction`.`is_delete` <> 1 group by district, user_id, query_status,`construction`.`status`,`construction`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_establishment_count` AS
select district, user_id, query_status,`establishment`.`status` AS `status`,count(`establishment`.`establishment_id`) AS `total_records`,sum(`establishment`.`processing_days`) AS `total_processing_days`,`establishment`.`processing_days` AS `processing_days` from `establishment` where `establishment`.`is_delete` <> 1 group by district, user_id, query_status,`establishment`.`status`,`establishment`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_factorylicence_count` AS
select district, user_id, query_status,`factorylicence`.`status` AS `status`,count(`factorylicence`.`factorylicence_id`) AS `total_records`,sum(`factorylicence`.`processing_days`) AS `total_processing_days`,`factorylicence`.`processing_days` AS `processing_days` from `factorylicence` where `factorylicence`.`is_delete` <> 1 group by district, user_id, query_status,`factorylicence`.`status`,`factorylicence`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_factorylicence_renewal_count` AS
select district, user_id, query_status,`factorylicence_renewal`.`status` AS `status`,count(`factorylicence_renewal`.`factorylicence_renewal_id`) AS `total_records`,sum(`factorylicence_renewal`.`processing_days`) AS `total_processing_days`,`factorylicence_renewal`.`processing_days` AS `processing_days` from `factorylicence_renewal` where `factorylicence_renewal`.`is_delete` <> 1 group by district, user_id, query_status,`factorylicence_renewal`.`status`,`factorylicence_renewal`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_filmshooting_count` AS
select district, user_id, query_status,`filmshooting`.`status` AS `status`,count(`filmshooting`.`filmshooting_id`) AS `total_records`,sum(`filmshooting`.`processing_days`) AS `total_processing_days`,`filmshooting`.`processing_days` AS `processing_days` from `filmshooting` where `filmshooting`.`is_delete` <> 1 group by district, user_id, query_status,`filmshooting`.`status`,`filmshooting`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_hotel_count` AS
select name_of_tourist_area AS district, user_id, query_status,`hotel`.`status` AS `status`,count(`hotel`.`hotelregi_id`) AS `total_records`,sum(`hotel`.`processing_days`) AS `total_processing_days`,`hotel`.`processing_days` AS `processing_days` from `hotel` where `hotel`.`is_delete` <> 1 group by name_of_tourist_area, user_id ,query_status,`hotel`.`status`,`hotel`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_hotel_renewal_count` AS
select name_of_tourist_area AS district, user_id, query_status,`hotel_renewal`.`status` AS `status`,count(`hotel_renewal`.`hotel_renewal_id`) AS `total_records`,sum(`hotel_renewal`.`processing_days`) AS `total_processing_days`,`hotel_renewal`.`processing_days` AS `processing_days` from `hotel_renewal` where `hotel_renewal`.`is_delete` <> 1 group by name_of_tourist_area, user_id,query_status,`hotel_renewal`.`status`,`hotel_renewal`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_inspection_count` AS
select district, user_id, query_status,`inspection`.`status` AS `status`,count(`inspection`.`inspection_id`) AS `total_records`,sum(`inspection`.`processing_days`) AS `total_processing_days`,`inspection`.`processing_days` AS `processing_days` from `inspection` where `inspection`.`is_delete` <> 1 group by district, user_id, query_status,`inspection`.`status`,`inspection`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_land_allotment_count` AS
select district, user_id, query_status,`land_allotment`.`status` AS `status`,count(`land_allotment`.`landallotment_id`) AS `total_records`,sum(`land_allotment`.`processing_days`) AS `total_processing_days`,`land_allotment`.`processing_days` AS `processing_days` from `land_allotment` where `land_allotment`.`is_delete` <> 1 group by district, user_id, query_status,`land_allotment`.`status`,`land_allotment`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_lease_seller_count` AS
select district, user_id, query_status,`lease_seller`.`status` AS `status`,count(`lease_seller`.`seller_id`) AS `total_records`,sum(`lease_seller`.`processing_days`) AS `total_processing_days`,`lease_seller`.`processing_days` AS `processing_days` from `lease_seller` where `lease_seller`.`is_delete` <> 1 group by district, user_id, query_status,`lease_seller`.`status`,`lease_seller`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_migrantworkers_count` AS
select district, user_id, query_status,`migrantworkers`.`status` AS `status`,count(`migrantworkers`.`mw_id`) AS `total_records`,sum(`migrantworkers`.`processing_days`) AS `total_processing_days`,`migrantworkers`.`processing_days` AS `processing_days` from `migrantworkers` where `migrantworkers`.`is_delete` <> 1 group by district, user_id, query_status,`migrantworkers`.`status`,`migrantworkers`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_migrantworkers_renewal_count` AS
select district, user_id, query_status,`migrantworkers_renewal`.`status` AS `status`,count(`migrantworkers_renewal`.`migrantworkers_renewal_id`) AS `total_records`,sum(`migrantworkers_renewal`.`processing_days`) AS `total_processing_days`,`migrantworkers_renewal`.`processing_days` AS `processing_days` from `migrantworkers_renewal` where `migrantworkers_renewal`.`is_delete` <> 1 group by district, user_id, query_status,`migrantworkers_renewal`.`status`,`migrantworkers_renewal`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_msme_count` AS
select district, user_id, query_status,`msme`.`status` AS `status`,count(`msme`.`msme_id`) AS `total_records`,sum(`msme`.`processing_days`) AS `total_processing_days`,`msme`.`processing_days` AS `processing_days` from `msme` where `msme`.`is_delete` <> 1 group by district, user_id, query_status,`msme`.`status`,`msme`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_na_count` AS
select district, user_id, query_status,`na`.`status` AS `status`,count(`na`.`na_id`) AS `total_records`,sum(`na`.`processing_days`) AS `total_processing_days`,`na`.`processing_days` AS `processing_days` from `na` where `na`.`is_delete` <> 1 group by district, user_id, query_status,`na`.`status`,`na`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_noc_count` AS
select district, user_id, query_status,`noc`.`status` AS `status`,count(`noc`.`noc_id`) AS `total_records`,sum(`noc`.`processing_days`) AS `total_processing_days`,`noc`.`processing_days` AS `processing_days` from `noc` where `noc`.`is_delete` <> 1 group by district, user_id, query_status,`noc`.`status`,`noc`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_occupancy_certificate_count` AS
select district, user_id, query_status,`occupancy_certificate`.`status` AS `status`,count(`occupancy_certificate`.`occupancy_certificate_id`) AS `total_records`,sum(`occupancy_certificate`.`processing_days`) AS `total_processing_days`,`occupancy_certificate`.`processing_days` AS `processing_days` from `occupancy_certificate` where `occupancy_certificate`.`is_delete` <> 1 group by district, user_id, query_status,`occupancy_certificate`.`status`,`occupancy_certificate`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_property_registration_count` AS
select district, user_id, query_status,`property_registration`.`status` AS `status`,count(`property_registration`.`property_id`) AS `total_records`,sum(`property_registration`.`processing_days`) AS `total_processing_days`,`property_registration`.`processing_days` AS `processing_days` from `property_registration` where `property_registration`.`is_delete` <> 1 group by district, user_id, query_status,`property_registration`.`status`,`property_registration`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_psf_registration_count` AS
select district, user_id, query_status,`psf_registration`.`status` AS `status`,count(`psf_registration`.`psfregistration_id`) AS `total_records`,sum(`psf_registration`.`processing_days`) AS `total_processing_days`,`psf_registration`.`processing_days` AS `processing_days` from `psf_registration` where `psf_registration`.`is_delete` <> 1 group by district, user_id, query_status,`psf_registration`.`status`,`psf_registration`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_shop_count` AS
select district, user_id, query_status,`shop`.`status` AS `status`,count(`shop`.`s_id`) AS `total_records`,sum(`shop`.`processing_days`) AS `total_processing_days`,`shop`.`processing_days` AS `processing_days` from `shop` where `shop`.`is_delete` <> 1 group by district, user_id, query_status,`shop`.`status`,`shop`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_shop_renewal_count` AS
select district, user_id, query_status,`shop_renewal`.`status` AS `status`,count(`shop_renewal`.`shop_renewal_id`) AS `total_records`,sum(`shop_renewal`.`processing_days`) AS `total_processing_days`,`shop_renewal`.`processing_days` AS `processing_days` from `shop_renewal` where `shop_renewal`.`is_delete` <> 1 group by district, user_id, query_status,`shop_renewal`.`status`,`shop_renewal`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_singlereturn_count` AS
select district, user_id, query_status,`singlereturn`.`status` AS `status`,count(`singlereturn`.`singlereturn_id`) AS `total_records`,sum(`singlereturn`.`processing_days`) AS `total_processing_days`,`singlereturn`.`processing_days` AS `processing_days` from `singlereturn` where `singlereturn`.`is_delete` <> 1 group by district, user_id, query_status,`singlereturn`.`status`,`singlereturn`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_site_elevation_count` AS
select district, user_id, query_status,`site_elevation`.`status` AS `status`,count(`site_elevation`.`site_id`) AS `total_records`,sum(`site_elevation`.`processing_days`) AS `total_processing_days`,`site_elevation`.`processing_days` AS `processing_days` from `site_elevation` where `site_elevation`.`is_delete` <> 1 group by district, user_id, query_status,`site_elevation`.`status`,`site_elevation`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_sub_lessee_count` AS
select district, user_id, query_status,`sub_lessee`.`status` AS `status`,count(`sub_lessee`.`sublessee_id`) AS `total_records`,sum(`sub_lessee`.`processing_days`) AS `total_processing_days`,`sub_lessee`.`processing_days` AS `processing_days` from `sub_lessee` where `sub_lessee`.`is_delete` <> 1 group by district, user_id, query_status,`sub_lessee`.`status`,`sub_lessee`.`processing_days` order by count(`sub_lessee`.`sublessee_id`) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_sub_letting_count` AS
select district, user_id, query_status,`sub_letting`.`status` AS `status`,count(`sub_letting`.`subletting_id`) AS `total_records`,sum(`sub_letting`.`processing_days`) AS `total_processing_days`,`sub_letting`.`processing_days` AS `processing_days` from `sub_letting` where `sub_letting`.`is_delete` <> 1 group by district, user_id, query_status,`sub_letting`.`status`,`sub_letting`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_textile_count` AS
select district, user_id, query_status,`textile`.`status` AS `status`,count(`textile`.`textile_id`) AS `total_records`,sum(`textile`.`processing_days`) AS `total_processing_days`,`textile`.`processing_days` AS `processing_days` from `textile` where `textile`.`is_delete` <> 1 group by district, user_id, query_status,`textile`.`status`,`textile`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_tourismevent_count` AS
select district, user_id, query_status,`tourismevent`.`status` AS `status`,count(`tourismevent`.`tourismevent_id`) AS `total_records`,sum(`tourismevent`.`processing_days`) AS `total_processing_days`,`tourismevent`.`processing_days` AS `processing_days` from `tourismevent` where `tourismevent`.`is_delete` <> 1 group by district, user_id, query_status,`tourismevent`.`status`,`tourismevent`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_transfer_count` AS
select district, user_id, query_status,`transfer`.`status` AS `status`,count(`transfer`.`transfer_id`) AS `total_records`,sum(`transfer`.`processing_days`) AS `total_processing_days`,`transfer`.`processing_days` AS `processing_days` from `transfer` where `transfer`.`is_delete` <> 1 group by district, user_id, query_status,`transfer`.`status`,`transfer`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_travelagent_count` AS
select area_of_agency AS district, user_id, query_status,`travelagent`.`status` AS `status`,count(`travelagent`.`travelagent_id`) AS `total_records`,sum(`travelagent`.`processing_days`) AS `total_processing_days`,`travelagent`.`processing_days` AS `processing_days` from `travelagent` where `travelagent`.`is_delete` <> 1 group by area_of_agency,user_id,query_status,`travelagent`.`status`,`travelagent`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_travelagent_renewal_count` AS
select area_of_agency AS district, user_id, query_status,`travelagent_renewal`.`status` AS `status`,count(`travelagent_renewal`.`travelagent_renewal_id`) AS `total_records`,sum(`travelagent_renewal`.`processing_days`) AS `total_processing_days`,`travelagent_renewal`.`processing_days` AS `processing_days` from `travelagent_renewal` where `travelagent_renewal`.`is_delete` <> 1 group by area_of_agency,user_id,query_status, `travelagent_renewal`.`status`,`travelagent_renewal`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_wc_count` AS
select district, user_id, query_status,`wc`.`status` AS `status`,count(`wc`.`wc_id`) AS `total_records`,sum(`wc`.`processing_days`) AS `total_processing_days`,`wc`.`processing_days` AS `processing_days` from `wc` where `wc`.`is_delete` <> 1 group by district, user_id, query_status,`wc`.`status`,`wc`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_dealer_count` AS
select district, user_id, query_status,`wm_dealer`.`status` AS `status`,count(`wm_dealer`.`dealer_id`) AS `total_records`,sum(`wm_dealer`.`processing_days`) AS `total_processing_days`,`wm_dealer`.`processing_days` AS `processing_days` from `wm_dealer` where `wm_dealer`.`is_delete` <> 1 group by district, user_id, query_status,`wm_dealer`.`status`,`wm_dealer`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_dealer_renewal_count` AS
select district, user_id, query_status,`wm_dealer_renewal`.`status` AS `status`,count(`wm_dealer_renewal`.`dealer_renewal_id`) AS `total_records`,sum(`wm_dealer_renewal`.`processing_days`) AS `total_processing_days`,`wm_dealer_renewal`.`processing_days` AS `processing_days` from `wm_dealer_renewal` where `wm_dealer_renewal`.`is_delete` <> 1 group by district, user_id, query_status,`wm_dealer_renewal`.`status`,`wm_dealer_renewal`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_manufacturer_count` AS
select district, user_id, query_status,`wm_manufacturer`.`status` AS `status`,count(`wm_manufacturer`.`manufacturer_id`) AS `total_records`,sum(`wm_manufacturer`.`processing_days`) AS `total_processing_days`,`wm_manufacturer`.`processing_days` AS `processing_days` from `wm_manufacturer` where `wm_manufacturer`.`is_delete` <> 1 group by district, user_id, query_status,`wm_manufacturer`.`status`,`wm_manufacturer`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_manufacturer_renewal_count` AS
select district, user_id, query_status,`wm_manufacturer_renewal`.`status` AS `status`,count(`wm_manufacturer_renewal`.`manufacturer_renewal_id`) AS `total_records`,sum(`wm_manufacturer_renewal`.`processing_days`) AS `total_processing_days`,`wm_manufacturer_renewal`.`processing_days` AS `processing_days` from `wm_manufacturer_renewal` where `wm_manufacturer_renewal`.`is_delete` <> 1 group by district, user_id, query_status,`wm_manufacturer_renewal`.`status`,`wm_manufacturer_renewal`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_registration_count` AS
select district, user_id, query_status,`wm_registration`.`status` AS `status`,count(`wm_registration`.`wmregistration_id`) AS `total_records`,sum(`wm_registration`.`processing_days`) AS `total_processing_days`,`wm_registration`.`processing_days` AS `processing_days` from `wm_registration` where `wm_registration`.`is_delete` <> 1 group by district, user_id, query_status,`wm_registration`.`status`,`wm_registration`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_repairer_count` AS
select district, user_id, query_status,`wm_repairer`.`status` AS `status`,count(`wm_repairer`.`repairer_id`) AS `total_records`,sum(`wm_repairer`.`processing_days`) AS `total_processing_days`,`wm_repairer`.`processing_days` AS `processing_days` from `wm_repairer` where `wm_repairer`.`is_delete` <> 1 group by district, user_id, query_status,`wm_repairer`.`status`,`wm_repairer`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_repairer_renewal_count` AS
select district, user_id, query_status,`wm_repairer_renewal`.`status` AS `status`,count(`wm_repairer_renewal`.`repairer_renewal_id`) AS `total_records`,sum(`wm_repairer_renewal`.`processing_days`) AS `total_processing_days`,`wm_repairer_renewal`.`processing_days` AS `processing_days` from `wm_repairer_renewal` where `wm_repairer_renewal`.`is_delete` <> 1 group by district, user_id, query_status,`wm_repairer_renewal`.`status`,`wm_repairer_renewal`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_zone_information_count` AS
select district, user_id, query_status,`zone_information`.`status` AS `status`,count(`zone_information`.`zone_id`) AS `total_records`,sum(`zone_information`.`processing_days`) AS `total_processing_days`,`zone_information`.`processing_days` AS `processing_days` from `zone_information` where `zone_information`.`is_delete` <> 1 group by district, user_id, query_status,`zone_information`.`status`,`zone_information`.`processing_days`;

DROP VIEW `view_get_ds_wise_incentive_generalform_count`, `view_get_ds_wise_incentive_generalform_textile_count`;

CREATE OR REPLACE VIEW `view_get_ds_wise_vc_count` AS
select `vc`.`district` AS `district`,`vc`.`user_id` AS `user_id`,`vc`.`query_status` AS `query_status`,`vc`.`status` AS `status`,count(`vc`.`vc_id`) AS `total_records`,sum(`vc`.`processing_days`) AS `total_processing_days`,`vc`.`processing_days` AS `processing_days` from `vc` where (`vc`.`is_delete` <> 1) group by `vc`.`district`,`vc`.`user_id`,`vc`.`query_status`,`vc`.`status`,`vc`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_periodicalreturn_count` AS
select district, user_id, query_status,`periodicalreturn`.`status` AS `status`,count(`periodicalreturn`.`periodicalreturn_id`) AS `total_records`,sum(`periodicalreturn`.`processing_days`) AS `total_processing_days`,`periodicalreturn`.`processing_days` AS `processing_days` from `periodicalreturn` where `periodicalreturn`.`is_delete` <> 1 group by district, user_id, query_status,`periodicalreturn`.`status`,`periodicalreturn`.`processing_days`;

CREATE OR REPLACE VIEW `view_get_ds_wise_rii_count` AS
select district, user_id, query_status,`rii`.`status` AS `status`,count(`rii`.`rii_id`) AS `total_records`,sum(`rii`.`processing_days`) AS `total_processing_days`,`rii`.`processing_days` AS `processing_days` from `rii` where `rii`.`is_delete` <> 1 group by district, user_id, query_status,`rii`.`status`,`rii`.`processing_days`;

ALTER TABLE `rii`
ADD `processing_days` int NOT NULL AFTER `status_datetime`;

CREATE OR REPLACE VIEW `view_get_status_wise_vc_count` AS
select `vc`.`status` AS `status`,count(`vc`.`vc_id`) AS `total_records`,sum(`vc`.`processing_days`) AS `total_processing_days`,`vc`.`processing_days` AS `processing_days` from `vc` where (`vc`.`is_delete` <> 1) group by `vc`.`status`,`vc`.`processing_days` order by count(`vc`.`vc_id`) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_periodicalreturn_count` AS
select `periodicalreturn`.`status` AS `status`,count(`periodicalreturn`.`periodicalreturn_id`) AS `total_records`,sum(`periodicalreturn`.`processing_days`) AS `total_processing_days`,`periodicalreturn`.`processing_days` AS `processing_days` from `periodicalreturn` where (`periodicalreturn`.`is_delete` <> 1) group by `periodicalreturn`.`status`,`periodicalreturn`.`processing_days` order by count(`periodicalreturn`.`periodicalreturn_id`) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_rii_count` AS
select `rii`.`status` AS `status`,count(`rii`.`rii_id`) AS `total_records`,sum(`rii`.`processing_days`) AS `total_processing_days`,`rii`.`processing_days` AS `processing_days` from `rii` where (`rii`.`is_delete` <> 1) group by `rii`.`status`,`rii`.`processing_days` order by count(`rii`.`rii_id`) desc;
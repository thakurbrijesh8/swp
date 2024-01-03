-- Adminer 4.8.1 MySQL 5.5.5-10.4.17-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP VIEW IF EXISTS `view_get_status_wise_appli_licence_count`;
CREATE TABLE `view_get_status_wise_appli_licence_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_appli_licence_renewal_count`;
CREATE TABLE `view_get_status_wise_appli_licence_renewal_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_bocw_count`;
CREATE TABLE `view_get_status_wise_bocw_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_boileract_count`;
CREATE TABLE `view_get_status_wise_boileract_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_boileract_renewal_count`;
CREATE TABLE `view_get_status_wise_boileract_renewal_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(25,0), `processing_days` tinyint(1));


DROP VIEW IF EXISTS `view_get_status_wise_boilermanufactures_count`;
CREATE TABLE `view_get_status_wise_boilermanufactures_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_buildingplan_count`;
CREATE TABLE `view_get_status_wise_buildingplan_count` (`status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_cinema_count`;
CREATE TABLE `view_get_status_wise_cinema_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_construction_count`;
CREATE TABLE `view_get_status_wise_construction_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_establishment_count`;
CREATE TABLE `view_get_status_wise_establishment_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_factorylicence_count`;
CREATE TABLE `view_get_status_wise_factorylicence_count` (`status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_factorylicence_renewal_count`;
CREATE TABLE `view_get_status_wise_factorylicence_renewal_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(25,0), `processing_days` tinyint(4));


DROP VIEW IF EXISTS `view_get_status_wise_filmshooting_count`;
CREATE TABLE `view_get_status_wise_filmshooting_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_hotel_count`;
CREATE TABLE `view_get_status_wise_hotel_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_hotel_renewal_count`;
CREATE TABLE `view_get_status_wise_hotel_renewal_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_incentive_generalform_count`;
CREATE TABLE `view_get_status_wise_incentive_generalform_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_incentive_generalform_textile_count`;
CREATE TABLE `view_get_status_wise_incentive_generalform_textile_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_inspection_count`;
CREATE TABLE `view_get_status_wise_inspection_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_ips_incentive_count`;
CREATE TABLE `view_get_status_wise_ips_incentive_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_land_allotment_count`;
CREATE TABLE `view_get_status_wise_land_allotment_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_lease_seller_count`;
CREATE TABLE `view_get_status_wise_lease_seller_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_migrantworkers_count`;
CREATE TABLE `view_get_status_wise_migrantworkers_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_migrantworkers_renewal_count`;
CREATE TABLE `view_get_status_wise_migrantworkers_renewal_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_msme_count`;
CREATE TABLE `view_get_status_wise_msme_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_na_count`;
CREATE TABLE `view_get_status_wise_na_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_noc_count`;
CREATE TABLE `view_get_status_wise_noc_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_occupancy_certificate_count`;
CREATE TABLE `view_get_status_wise_occupancy_certificate_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_periodicalreturn_count`;
CREATE TABLE `view_get_status_wise_periodicalreturn_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_property_registration_count`;
CREATE TABLE `view_get_status_wise_property_registration_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_psf_registration_count`;
CREATE TABLE `view_get_status_wise_psf_registration_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_query_grievance_count`;
CREATE TABLE `view_get_status_wise_query_grievance_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11), `industry_classification` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_rii_count`;
CREATE TABLE `view_get_status_wise_rii_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_shop_count`;
CREATE TABLE `view_get_status_wise_shop_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_shop_renewal_count`;
CREATE TABLE `view_get_status_wise_shop_renewal_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_singlereturn_count`;
CREATE TABLE `view_get_status_wise_singlereturn_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_site_elevation_count`;
CREATE TABLE `view_get_status_wise_site_elevation_count` (`status` tinyint(2), `total_records` bigint(21), `total_processing_days` decimal(43,0), `processing_days` int(22));


DROP VIEW IF EXISTS `view_get_status_wise_society_registration_count`;
CREATE TABLE `view_get_status_wise_society_registration_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_sub_lessee_count`;
CREATE TABLE `view_get_status_wise_sub_lessee_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_sub_letting_count`;
CREATE TABLE `view_get_status_wise_sub_letting_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_textile_count`;
CREATE TABLE `view_get_status_wise_textile_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_tourismevent_count`;
CREATE TABLE `view_get_status_wise_tourismevent_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_transfer_count`;
CREATE TABLE `view_get_status_wise_transfer_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_travelagent_count`;
CREATE TABLE `view_get_status_wise_travelagent_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_travelagent_renewal_count`;
CREATE TABLE `view_get_status_wise_travelagent_renewal_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_tree_cutting_count`;
CREATE TABLE `view_get_status_wise_tree_cutting_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_vc_count`;
CREATE TABLE `view_get_status_wise_vc_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wc_count`;
CREATE TABLE `view_get_status_wise_wc_count` (`status` tinyint(1), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_dealer_count`;
CREATE TABLE `view_get_status_wise_wm_dealer_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_dealer_renewal_count`;
CREATE TABLE `view_get_status_wise_wm_dealer_renewal_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_manufacturer_count`;
CREATE TABLE `view_get_status_wise_wm_manufacturer_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_manufacturer_renewal_count`;
CREATE TABLE `view_get_status_wise_wm_manufacturer_renewal_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_registration_count`;
CREATE TABLE `view_get_status_wise_wm_registration_count` (`status` int(11), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_repairer_count`;
CREATE TABLE `view_get_status_wise_wm_repairer_count` (`status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_wm_repairer_renewal_count`;
CREATE TABLE `view_get_status_wise_wm_repairer_renewal_count` (`status` tinyint(4), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP VIEW IF EXISTS `view_get_status_wise_zone_information_count`;
CREATE TABLE `view_get_status_wise_zone_information_count` (`status` tinyint(2), `total_records` bigint(21), `total_processing_days` decimal(32,0), `processing_days` int(11));


DROP TABLE IF EXISTS `view_get_status_wise_appli_licence_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_appli_licence_count` AS select `appli_licence`.`status` AS `status`,count(`appli_licence`.`aplicence_id`) AS `total_records`,sum(`appli_licence`.`processing_days`) AS `total_processing_days`,`appli_licence`.`processing_days` AS `processing_days` from `appli_licence` where `appli_licence`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `appli_licence`.`status`,`appli_licence`.`processing_days` order by count(`appli_licence`.`aplicence_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_appli_licence_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_appli_licence_renewal_count` AS select `appli_licence_renewal`.`status` AS `status`,count(`appli_licence_renewal`.`aplicence_renewal_id`) AS `total_records`,sum(`appli_licence_renewal`.`processing_days`) AS `total_processing_days`,`appli_licence_renewal`.`processing_days` AS `processing_days` from `appli_licence_renewal` where `appli_licence_renewal`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `appli_licence_renewal`.`status`,`appli_licence_renewal`.`processing_days` order by count(`appli_licence_renewal`.`aplicence_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_bocw_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_bocw_count` AS select `bocw`.`status` AS `status`,count(`bocw`.`bocw_id`) AS `total_records`,sum(`bocw`.`processing_days`) AS `total_processing_days`,`bocw`.`processing_days` AS `processing_days` from `bocw` where `bocw`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `bocw`.`status`,`bocw`.`processing_days` order by count(`bocw`.`bocw_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_boileract_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_boileract_count` AS select `boileract`.`status` AS `status`,count(`boileract`.`boiler_id`) AS `total_records`,sum(`boileract`.`processing_days`) AS `total_processing_days`,`boileract`.`processing_days` AS `processing_days` from `boileract` where `boileract`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `boileract`.`status`,`boileract`.`processing_days` order by count(`boileract`.`boiler_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_boileract_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_boileract_renewal_count` AS select `boileract_renewal`.`status` AS `status`,count(`boileract_renewal`.`boiler_renewal_id`) AS `total_records`,sum(`boileract_renewal`.`processing_days`) AS `total_processing_days`,`boileract_renewal`.`processing_days` AS `processing_days` from `boileract_renewal` where `boileract_renewal`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `boileract_renewal`.`status`,`boileract_renewal`.`processing_days` order by count(`boileract_renewal`.`boiler_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_boilermanufactures_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_boilermanufactures_count` AS select `boilermanufactures`.`status` AS `status`,count(`boilermanufactures`.`boilermanufacture_id`) AS `total_records`,sum(`boilermanufactures`.`processing_days`) AS `total_processing_days`,`boilermanufactures`.`processing_days` AS `processing_days` from `boilermanufactures` where `boilermanufactures`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `boilermanufactures`.`status`,`boilermanufactures`.`processing_days` order by count(`boilermanufactures`.`boilermanufacture_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_buildingplan_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_buildingplan_count` AS select `buildingplan`.`status` AS `status`,count(`buildingplan`.`buildingplan_id`) AS `total_records`,sum(`buildingplan`.`processing_days`) AS `total_processing_days`,`buildingplan`.`processing_days` AS `processing_days` from `buildingplan` where `buildingplan`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `buildingplan`.`status`,`buildingplan`.`processing_days` order by count(`buildingplan`.`buildingplan_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_cinema_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_cinema_count` AS select `cinema`.`status` AS `status`,count(`cinema`.`cinema_id`) AS `total_records`,sum(`cinema`.`processing_days`) AS `total_processing_days`,`cinema`.`processing_days` AS `processing_days` from `cinema` where `cinema`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `cinema`.`status`,`cinema`.`processing_days` order by count(`cinema`.`cinema_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_construction_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_construction_count` AS select `construction`.`status` AS `status`,count(`construction`.`construction_id`) AS `total_records`,sum(`construction`.`processing_days`) AS `total_processing_days`,`construction`.`processing_days` AS `processing_days` from `construction` where `construction`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `construction`.`status`,`construction`.`processing_days` order by count(`construction`.`construction_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_establishment_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_establishment_count` AS select `establishment`.`status` AS `status`,count(`establishment`.`establishment_id`) AS `total_records`,sum(`establishment`.`processing_days`) AS `total_processing_days`,`establishment`.`processing_days` AS `processing_days` from `establishment` where `establishment`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `establishment`.`status`,`establishment`.`processing_days` order by count(`establishment`.`establishment_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_factorylicence_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_factorylicence_count` AS select `factorylicence`.`status` AS `status`,count(`factorylicence`.`factorylicence_id`) AS `total_records`,sum(`factorylicence`.`processing_days`) AS `total_processing_days`,`factorylicence`.`processing_days` AS `processing_days` from `factorylicence` where `factorylicence`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `factorylicence`.`status`,`factorylicence`.`processing_days` order by count(`factorylicence`.`factorylicence_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_factorylicence_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_factorylicence_renewal_count` AS select `factorylicence_renewal`.`status` AS `status`,count(`factorylicence_renewal`.`factorylicence_renewal_id`) AS `total_records`,sum(`factorylicence_renewal`.`processing_days`) AS `total_processing_days`,`factorylicence_renewal`.`processing_days` AS `processing_days` from `factorylicence_renewal` where `factorylicence_renewal`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `factorylicence_renewal`.`status`,`factorylicence_renewal`.`processing_days` order by count(`factorylicence_renewal`.`factorylicence_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_filmshooting_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_filmshooting_count` AS select `filmshooting`.`status` AS `status`,count(`filmshooting`.`filmshooting_id`) AS `total_records`,sum(`filmshooting`.`processing_days`) AS `total_processing_days`,`filmshooting`.`processing_days` AS `processing_days` from `filmshooting` where `filmshooting`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `filmshooting`.`status`,`filmshooting`.`processing_days` order by count(`filmshooting`.`filmshooting_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_hotel_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_hotel_count` AS select `hotel`.`status` AS `status`,count(`hotel`.`hotelregi_id`) AS `total_records`,sum(`hotel`.`processing_days`) AS `total_processing_days`,`hotel`.`processing_days` AS `processing_days` from `hotel` where `hotel`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `hotel`.`status`,`hotel`.`processing_days` order by count(`hotel`.`hotelregi_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_hotel_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_hotel_renewal_count` AS select `hotel_renewal`.`status` AS `status`,count(`hotel_renewal`.`hotel_renewal_id`) AS `total_records`,sum(`hotel_renewal`.`processing_days`) AS `total_processing_days`,`hotel_renewal`.`processing_days` AS `processing_days` from `hotel_renewal` where `hotel_renewal`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `hotel_renewal`.`status`,`hotel_renewal`.`processing_days` order by count(`hotel_renewal`.`hotel_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_incentive_generalform_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_incentive_generalform_count` AS select `incentive_generalform`.`status` AS `status`,count(`incentive_generalform`.`incentive_id`) AS `total_records`,sum(`incentive_generalform`.`processing_days`) AS `total_processing_days`,`incentive_generalform`.`processing_days` AS `processing_days` from `incentive_generalform` where `incentive_generalform`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `incentive_generalform`.`status`,`incentive_generalform`.`processing_days` order by count(`incentive_generalform`.`incentive_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_incentive_generalform_textile_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_incentive_generalform_textile_count` AS select `incentive_generalform_textile`.`status` AS `status`,count(`incentive_generalform_textile`.`incentive_id`) AS `total_records`,sum(`incentive_generalform_textile`.`processing_days`) AS `total_processing_days`,`incentive_generalform_textile`.`processing_days` AS `processing_days` from `incentive_generalform_textile` where `incentive_generalform_textile`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `incentive_generalform_textile`.`status`,`incentive_generalform_textile`.`processing_days` order by count(`incentive_generalform_textile`.`incentive_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_inspection_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_inspection_count` AS select `inspection`.`status` AS `status`,count(`inspection`.`inspection_id`) AS `total_records`,sum(`inspection`.`processing_days`) AS `total_processing_days`,`inspection`.`processing_days` AS `processing_days` from `inspection` where `inspection`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `inspection`.`status`,`inspection`.`processing_days` order by count(`inspection`.`inspection_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_ips_incentive_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_ips_incentive_count` AS select `ips_incentive`.`status` AS `status`,count(`ips_incentive`.`ips_incentive_id`) AS `total_records`,sum(`ips_incentive`.`processing_days`) AS `total_processing_days`,`ips_incentive`.`processing_days` AS `processing_days` from `ips_incentive` where `ips_incentive`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `ips_incentive`.`status`,`ips_incentive`.`processing_days` order by count(`ips_incentive`.`ips_incentive_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_land_allotment_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_land_allotment_count` AS select `land_allotment`.`status` AS `status`,count(`land_allotment`.`landallotment_id`) AS `total_records`,sum(`land_allotment`.`processing_days`) AS `total_processing_days`,`land_allotment`.`processing_days` AS `processing_days` from `land_allotment` where `land_allotment`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `land_allotment`.`status`,`land_allotment`.`processing_days` order by count(`land_allotment`.`landallotment_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_lease_seller_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_lease_seller_count` AS select `lease_seller`.`status` AS `status`,count(`lease_seller`.`seller_id`) AS `total_records`,sum(`lease_seller`.`processing_days`) AS `total_processing_days`,`lease_seller`.`processing_days` AS `processing_days` from `lease_seller` where `lease_seller`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `lease_seller`.`status`,`lease_seller`.`processing_days` order by count(`lease_seller`.`seller_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_migrantworkers_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_migrantworkers_count` AS select `migrantworkers`.`status` AS `status`,count(`migrantworkers`.`mw_id`) AS `total_records`,sum(`migrantworkers`.`processing_days`) AS `total_processing_days`,`migrantworkers`.`processing_days` AS `processing_days` from `migrantworkers` where `migrantworkers`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `migrantworkers`.`status`,`migrantworkers`.`processing_days` order by count(`migrantworkers`.`mw_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_migrantworkers_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_migrantworkers_renewal_count` AS select `migrantworkers_renewal`.`status` AS `status`,count(`migrantworkers_renewal`.`migrantworkers_renewal_id`) AS `total_records`,sum(`migrantworkers_renewal`.`processing_days`) AS `total_processing_days`,`migrantworkers_renewal`.`processing_days` AS `processing_days` from `migrantworkers_renewal` where `migrantworkers_renewal`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `migrantworkers_renewal`.`status`,`migrantworkers_renewal`.`processing_days` order by count(`migrantworkers_renewal`.`migrantworkers_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_msme_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_msme_count` AS select `msme`.`status` AS `status`,count(`msme`.`msme_id`) AS `total_records`,sum(`msme`.`processing_days`) AS `total_processing_days`,`msme`.`processing_days` AS `processing_days` from `msme` where `msme`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `msme`.`status`,`msme`.`processing_days` order by count(`msme`.`msme_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_na_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_na_count` AS select `na`.`status` AS `status`,count(`na`.`na_id`) AS `total_records`,sum(`na`.`processing_days`) AS `total_processing_days`,`na`.`processing_days` AS `processing_days` from `na` where `na`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `na`.`status`,`na`.`processing_days` order by count(`na`.`na_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_noc_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_noc_count` AS select `noc`.`status` AS `status`,count(`noc`.`noc_id`) AS `total_records`,sum(`noc`.`processing_days`) AS `total_processing_days`,`noc`.`processing_days` AS `processing_days` from `noc` where `noc`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `noc`.`status`,`noc`.`processing_days` order by count(`noc`.`noc_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_occupancy_certificate_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_occupancy_certificate_count` AS select `occupancy_certificate`.`status` AS `status`,count(`occupancy_certificate`.`occupancy_certificate_id`) AS `total_records`,sum(`occupancy_certificate`.`processing_days`) AS `total_processing_days`,`occupancy_certificate`.`processing_days` AS `processing_days` from `occupancy_certificate` where `occupancy_certificate`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `occupancy_certificate`.`status`,`occupancy_certificate`.`processing_days` order by count(`occupancy_certificate`.`occupancy_certificate_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_periodicalreturn_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_periodicalreturn_count` AS select `periodicalreturn`.`status` AS `status`,count(`periodicalreturn`.`periodicalreturn_id`) AS `total_records`,sum(`periodicalreturn`.`processing_days`) AS `total_processing_days`,`periodicalreturn`.`processing_days` AS `processing_days` from `periodicalreturn` where `periodicalreturn`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `periodicalreturn`.`status`,`periodicalreturn`.`processing_days` order by count(`periodicalreturn`.`periodicalreturn_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_property_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_property_registration_count` AS select `property_registration`.`status` AS `status`,count(`property_registration`.`property_id`) AS `total_records`,sum(`property_registration`.`processing_days`) AS `total_processing_days`,`property_registration`.`processing_days` AS `processing_days` from `property_registration` where `property_registration`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `property_registration`.`status`,`property_registration`.`processing_days` order by count(`property_registration`.`property_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_psf_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_psf_registration_count` AS select `psf_registration`.`status` AS `status`,count(`psf_registration`.`psfregistration_id`) AS `total_records`,sum(`psf_registration`.`processing_days`) AS `total_processing_days`,`psf_registration`.`processing_days` AS `processing_days` from `psf_registration` where `psf_registration`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `psf_registration`.`status`,`psf_registration`.`processing_days` order by count(`psf_registration`.`psfregistration_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_query_grievance_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_query_grievance_count` AS select `query_grievance`.`status` AS `status`,count(`query_grievance`.`query_grievance_id`) AS `total_records`,sum(`query_grievance`.`processing_days`) AS `total_processing_days`,`query_grievance`.`processing_days` AS `processing_days`,`query_grievance`.`industry_classification` AS `industry_classification` from `query_grievance` where `query_grievance`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `query_grievance`.`status`,`query_grievance`.`processing_days`,`query_grievance`.`industry_classification` order by count(`query_grievance`.`query_grievance_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_rii_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_rii_count` AS select `rii`.`status` AS `status`,count(`rii`.`rii_id`) AS `total_records`,sum(`rii`.`processing_days`) AS `total_processing_days`,`rii`.`processing_days` AS `processing_days` from `rii` where `rii`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `rii`.`status`,`rii`.`processing_days` order by count(`rii`.`rii_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_shop_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_shop_count` AS select `shop`.`status` AS `status`,count(`shop`.`s_id`) AS `total_records`,sum(`shop`.`processing_days`) AS `total_processing_days`,`shop`.`processing_days` AS `processing_days` from `shop` where `shop`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `shop`.`status`,`shop`.`processing_days` order by count(`shop`.`s_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_shop_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_shop_renewal_count` AS select `shop_renewal`.`status` AS `status`,count(`shop_renewal`.`shop_renewal_id`) AS `total_records`,sum(`shop_renewal`.`processing_days`) AS `total_processing_days`,`shop_renewal`.`processing_days` AS `processing_days` from `shop_renewal` where `shop_renewal`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `shop_renewal`.`status`,`shop_renewal`.`processing_days` order by count(`shop_renewal`.`shop_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_singlereturn_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_singlereturn_count` AS select `singlereturn`.`status` AS `status`,count(`singlereturn`.`singlereturn_id`) AS `total_records`,sum(`singlereturn`.`processing_days`) AS `total_processing_days`,`singlereturn`.`processing_days` AS `processing_days` from `singlereturn` where `singlereturn`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `singlereturn`.`status`,`singlereturn`.`processing_days` order by count(`singlereturn`.`singlereturn_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_site_elevation_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_site_elevation_count` AS select `site_elevation`.`status` AS `status`,count(`site_elevation`.`site_id`) AS `total_records`,sum(`site_elevation`.`processing_days`) AS `total_processing_days`,`site_elevation`.`processing_days` AS `processing_days` from `site_elevation` where `site_elevation`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `site_elevation`.`status`,`site_elevation`.`processing_days` order by count(`site_elevation`.`site_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_society_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_society_registration_count` AS select `society_registration`.`status` AS `status`,count(`society_registration`.`society_registration_id`) AS `total_records`,sum(`society_registration`.`processing_days`) AS `total_processing_days`,`society_registration`.`processing_days` AS `processing_days` from `society_registration` where `society_registration`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `society_registration`.`status`,`society_registration`.`processing_days` order by count(`society_registration`.`society_registration_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_sub_lessee_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_sub_lessee_count` AS select `sub_lessee`.`status` AS `status`,count(`sub_lessee`.`sublessee_id`) AS `total_records`,sum(`sub_lessee`.`processing_days`) AS `total_processing_days`,`sub_lessee`.`processing_days` AS `processing_days` from `sub_lessee` where `sub_lessee`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `sub_lessee`.`status`,`sub_lessee`.`processing_days` order by count(`sub_lessee`.`sublessee_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_sub_letting_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_sub_letting_count` AS select `sub_letting`.`status` AS `status`,count(`sub_letting`.`subletting_id`) AS `total_records`,sum(`sub_letting`.`processing_days`) AS `total_processing_days`,`sub_letting`.`processing_days` AS `processing_days` from `sub_letting` where `sub_letting`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `sub_letting`.`status`,`sub_letting`.`processing_days` order by count(`sub_letting`.`subletting_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_textile_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_textile_count` AS select `textile`.`status` AS `status`,count(`textile`.`textile_id`) AS `total_records`,sum(`textile`.`processing_days`) AS `total_processing_days`,`textile`.`processing_days` AS `processing_days` from `textile` where `textile`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `textile`.`status`,`textile`.`processing_days` order by count(`textile`.`textile_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_tourismevent_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_tourismevent_count` AS select `tourismevent`.`status` AS `status`,count(`tourismevent`.`tourismevent_id`) AS `total_records`,sum(`tourismevent`.`processing_days`) AS `total_processing_days`,`tourismevent`.`processing_days` AS `processing_days` from `tourismevent` where `tourismevent`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `tourismevent`.`status`,`tourismevent`.`processing_days` order by count(`tourismevent`.`tourismevent_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_transfer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_transfer_count` AS select `transfer`.`status` AS `status`,count(`transfer`.`transfer_id`) AS `total_records`,sum(`transfer`.`processing_days`) AS `total_processing_days`,`transfer`.`processing_days` AS `processing_days` from `transfer` where `transfer`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `transfer`.`status`,`transfer`.`processing_days` order by count(`transfer`.`transfer_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_travelagent_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_travelagent_count` AS select `travelagent`.`status` AS `status`,count(`travelagent`.`travelagent_id`) AS `total_records`,sum(`travelagent`.`processing_days`) AS `total_processing_days`,`travelagent`.`processing_days` AS `processing_days` from `travelagent` where `travelagent`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `travelagent`.`status`,`travelagent`.`processing_days` order by count(`travelagent`.`travelagent_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_travelagent_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_travelagent_renewal_count` AS select `travelagent_renewal`.`status` AS `status`,count(`travelagent_renewal`.`travelagent_renewal_id`) AS `total_records`,sum(`travelagent_renewal`.`processing_days`) AS `total_processing_days`,`travelagent_renewal`.`processing_days` AS `processing_days` from `travelagent_renewal` where `travelagent_renewal`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `travelagent_renewal`.`status`,`travelagent_renewal`.`processing_days` order by count(`travelagent_renewal`.`travelagent_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_tree_cutting_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_tree_cutting_count` AS select `tree_cutting`.`status` AS `status`,count(`tree_cutting`.`tree_cutting_id`) AS `total_records`,sum(`tree_cutting`.`processing_days`) AS `total_processing_days`,`tree_cutting`.`processing_days` AS `processing_days` from `tree_cutting` where `tree_cutting`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `tree_cutting`.`status`,`tree_cutting`.`processing_days` order by count(`tree_cutting`.`tree_cutting_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_vc_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_vc_count` AS select `vc`.`status` AS `status`,count(`vc`.`vc_id`) AS `total_records`,sum(`vc`.`processing_days`) AS `total_processing_days`,`vc`.`processing_days` AS `processing_days` from `vc` where `vc`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `vc`.`status`,`vc`.`processing_days` order by count(`vc`.`vc_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wc_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wc_count` AS select `wc`.`status` AS `status`,count(`wc`.`wc_id`) AS `total_records`,sum(`wc`.`processing_days`) AS `total_processing_days`,`wc`.`processing_days` AS `processing_days` from `wc` where `wc`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `wc`.`status`,`wc`.`processing_days` order by count(`wc`.`wc_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_dealer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_dealer_count` AS select `wm_dealer`.`status` AS `status`,count(`wm_dealer`.`dealer_id`) AS `total_records`,sum(`wm_dealer`.`processing_days`) AS `total_processing_days`,`wm_dealer`.`processing_days` AS `processing_days` from `wm_dealer` where `wm_dealer`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `wm_dealer`.`status`,`wm_dealer`.`processing_days` order by count(`wm_dealer`.`dealer_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_dealer_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_dealer_renewal_count` AS select `wm_dealer_renewal`.`status` AS `status`,count(`wm_dealer_renewal`.`dealer_renewal_id`) AS `total_records`,sum(`wm_dealer_renewal`.`processing_days`) AS `total_processing_days`,`wm_dealer_renewal`.`processing_days` AS `processing_days` from `wm_dealer_renewal` where `wm_dealer_renewal`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `wm_dealer_renewal`.`status`,`wm_dealer_renewal`.`processing_days` order by count(`wm_dealer_renewal`.`dealer_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_manufacturer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_manufacturer_count` AS select `wm_manufacturer`.`status` AS `status`,count(`wm_manufacturer`.`manufacturer_id`) AS `total_records`,sum(`wm_manufacturer`.`processing_days`) AS `total_processing_days`,`wm_manufacturer`.`processing_days` AS `processing_days` from `wm_manufacturer` where `wm_manufacturer`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `wm_manufacturer`.`status`,`wm_manufacturer`.`processing_days` order by count(`wm_manufacturer`.`manufacturer_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_manufacturer_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_manufacturer_renewal_count` AS select `wm_manufacturer_renewal`.`status` AS `status`,count(`wm_manufacturer_renewal`.`manufacturer_renewal_id`) AS `total_records`,sum(`wm_manufacturer_renewal`.`processing_days`) AS `total_processing_days`,`wm_manufacturer_renewal`.`processing_days` AS `processing_days` from `wm_manufacturer_renewal` where `wm_manufacturer_renewal`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `wm_manufacturer_renewal`.`status`,`wm_manufacturer_renewal`.`processing_days` order by count(`wm_manufacturer_renewal`.`manufacturer_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_registration_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_registration_count` AS select `wm_registration`.`status` AS `status`,count(`wm_registration`.`wmregistration_id`) AS `total_records`,sum(`wm_registration`.`processing_days`) AS `total_processing_days`,`wm_registration`.`processing_days` AS `processing_days` from `wm_registration` where `wm_registration`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `wm_registration`.`status`,`wm_registration`.`processing_days` order by count(`wm_registration`.`wmregistration_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_repairer_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_repairer_count` AS select `wm_repairer`.`status` AS `status`,count(`wm_repairer`.`repairer_id`) AS `total_records`,sum(`wm_repairer`.`processing_days`) AS `total_processing_days`,`wm_repairer`.`processing_days` AS `processing_days` from `wm_repairer` where `wm_repairer`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `wm_repairer`.`status`,`wm_repairer`.`processing_days` order by count(`wm_repairer`.`repairer_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_wm_repairer_renewal_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_wm_repairer_renewal_count` AS select `wm_repairer_renewal`.`status` AS `status`,count(`wm_repairer_renewal`.`repairer_renewal_id`) AS `total_records`,sum(`wm_repairer_renewal`.`processing_days`) AS `total_processing_days`,`wm_repairer_renewal`.`processing_days` AS `processing_days` from `wm_repairer_renewal` where `wm_repairer_renewal`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `wm_repairer_renewal`.`status`,`wm_repairer_renewal`.`processing_days` order by count(`wm_repairer_renewal`.`repairer_renewal_id`) desc;

DROP TABLE IF EXISTS `view_get_status_wise_zone_information_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_get_status_wise_zone_information_count` AS select `zone_information`.`status` AS `status`,count(`zone_information`.`zone_id`) AS `total_records`,sum(`zone_information`.`processing_days`) AS `total_processing_days`,`zone_information`.`processing_days` AS `processing_days` from `zone_information` where `zone_information`.`is_delete` <> 1 AND submitted_datetime >= '2022-01-01 00:00:00' group by `zone_information`.`status`,`zone_information`.`processing_days` order by count(`zone_information`.`zone_id`) desc;

-- 2022-11-22 10:10:43
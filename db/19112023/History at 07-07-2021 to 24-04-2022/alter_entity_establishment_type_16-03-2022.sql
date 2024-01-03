ALTER TABLE `wm_registration` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;


ALTER TABLE `wm_dealer` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `wm_dealer_renewal` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `wm_manufacturer` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `wm_manufacturer_renewal` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `wm_repairer` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `wm_repairer_renewal` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;



ALTER TABLE `periodicalreturn` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `rii` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `vc` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `psf_registration` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `property_registration` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `na` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `cinema` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `filmshooting` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;

ALTER TABLE `land_allotment` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `msme` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `textile` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;

ALTER TABLE `construction` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `inspection` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `occupancy_certificate` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;

ALTER TABLE `boileract` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `boileract_renewal` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `boilermanufactures` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `buildingplan` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `factorylicence` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;
ALTER TABLE `factorylicence_renewal` ADD `entity_establishment_type` TINYINT(1) NOT NULL AFTER `district`;

ALTER TABLE `wc` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `district`;

ALTER TABLE `hotel` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `name_of_tourist_area`;
ALTER TABLE `hotel_renewal` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `name_of_tourist_area`;
ALTER TABLE `travelagent` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `area_of_agency`;
ALTER TABLE `travelagent_renewal` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `area_of_agency`;
ALTER TABLE `tourismevent` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `district`;

ALTER TABLE `shop` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `district`;
ALTER TABLE `shop_renewal` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `district`;
ALTER TABLE `establishment` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `district`;
ALTER TABLE `bocw` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `district`;
ALTER TABLE `migrantworkers` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `district`;
ALTER TABLE `migrantworkers_renewal` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `district`;
ALTER TABLE `appli_licence` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `district`;
ALTER TABLE `appli_licence_renewal` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `district`;
ALTER TABLE `singlereturn` ADD `entity_establishment_type` tinyint(1) NOT NULL AFTER `district`;
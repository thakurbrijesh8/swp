ALTER TABLE `all_villages`
ADD INDEX `state_code` (`state_code`),
ADD INDEX `district_code` (`district_code`),
ADD INDEX `village_code` (`village_code`);

ALTER TABLE `appli_licence`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `contractor_name` (`contractor_name`),
ADD INDEX `nature_of_process_for_establi` (`nature_of_process_for_establi`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `appli_licence_renewal`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `contractor_name` (`contractor_name`),
ADD INDEX `establi_name` (`establi_name`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `bocw`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_location_of_est` (`name_location_of_est`),
ADD INDEX `nature_of_building` (`nature_of_building`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `boileract`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `owner_name` (`owner_name`),
ADD INDEX `boiler_type` (`boiler_type`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `boileract_renewal`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `owner_name` (`owner_name`),
ADD INDEX `boiler_type` (`boiler_type`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `boilermanufactures`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_firm` (`name_of_firm`),
ADD INDEX `address_of_workshop` (`address_of_workshop`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `buildingplan`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `factory_name` (`factory_name`),
ADD INDEX `factory_building` (`factory_building`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `cinema`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_applicant` (`name_of_applicant`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `construction`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_owner` (`name_of_owner`),
ADD INDEX `address_of_owner` (`address_of_owner`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `c_inspections`
ADD INDEX `department_id` (`department_id`),
ADD INDEX `cb_name` (`cb_name`),
ADD INDEX `cb_address` (`cb_address`),
ADD INDEX `cb_type` (`cb_type`),
ADD INDEX `status` (`status`);

ALTER TABLE `district`
ADD INDEX `state_code` (`state_code`),
ADD INDEX `district_code` (`district_code`);

ALTER TABLE `establishment`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `establishment_name` (`establishment_name`),
ADD INDEX `nature_of_work` (`nature_of_work`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `establishment_contractor`
ADD INDEX `establishment_id` (`establishment_id`);

ALTER TABLE `factorylicence`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_factory` (`name_of_factory`),
ADD INDEX `work_carried` (`work_carried`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `factorylicence_renewal`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_factory` (`name_of_factory`),
ADD INDEX `factory_address` (`factory_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `fees_bifurcation`
ADD INDEX `module_type` (`module_type`),
ADD INDEX `module_id` (`module_id`),
ADD INDEX `dept_fd_id` (`dept_fd_id`);

ALTER TABLE `fees_payment`
CHANGE `reference_number` `reference_number` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `fees_payment_id`;

ALTER TABLE `fees_payment`
ADD INDEX `reference_number` (`reference_number`),
ADD INDEX `module_type` (`module_type`),
ADD INDEX `module_id` (`module_id`),
ADD INDEX `op_status` (`op_status`);

ALTER TABLE `fees_payment_dv`
ADD INDEX `fees_payment_id` (`fees_payment_id`);

ALTER TABLE `filmshooting`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `production_manager` (`production_manager`),
ADD INDEX `production_house` (`production_house`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `hotel`
ADD INDEX `name_of_tourist_area` (`name_of_tourist_area`),
ADD INDEX `name_of_hotel` (`name_of_hotel`),
ADD INDEX `category_of_hotel` (`category_of_hotel`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `hotel_renewal`
ADD INDEX `name_of_tourist_area` (`name_of_tourist_area`),
ADD INDEX `name_of_hotel` (`name_of_hotel`),
ADD INDEX `name_of_proprietor` (`name_of_proprietor`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `inspection`
ADD INDEX `name_of_applicant` (`name_of_applicant`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`);

ALTER TABLE `ips`
ADD INDEX `district` (`district`),
ADD INDEX `owner_name` (`owner_name`),
ADD INDEX `email` (`email`),
ADD INDEX `mobile_no` (`mobile_no`),
ADD INDEX `manu_name` (`manu_name`),
ADD INDEX `main_plant_address` (`main_plant_address`),
ADD INDEX `office_address` (`office_address`);

ALTER TABLE `ips_incentive`
ADD INDEX `ips_id` (`ips_id`),
ADD INDEX `scheme_type` (`scheme_type`),
ADD INDEX `scheme` (`scheme`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `ips_incentive_doc`
ADD INDEX `ips_incentive_id` (`ips_incentive_id`),
ADD INDEX `ips_id` (`ips_id`);

ALTER TABLE `ismw`
ADD INDEX `district` (`district`),
ADD INDEX `name` (`name`),
ADD INDEX `mobile_no` (`mobile_no`),
ADD INDEX `status` (`status`);

ALTER TABLE `land_allotment`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_applicant` (`name_of_applicant`),
ADD INDEX `applicant_address` (`applicant_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `migrantworkers`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `mw_name_of_establishment` (`mw_name_of_establishment`),
ADD INDEX `mw_nature_of_work_of_establishment` (`mw_nature_of_work_of_establishment`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `migrantworkers_renewal`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_establishment` (`name_of_establishment`),
ADD INDEX `nature_of_work_of_establishment` (`nature_of_work_of_establishment`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `module_documents`
ADD INDEX `module_type` (`module_type`),
ADD INDEX `module_id` (`module_id`);

ALTER TABLE `module_other_documents`
ADD INDEX `module_type` (`module_type`),
ADD INDEX `module_id` (`module_id`);

ALTER TABLE `msme`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `enterprise_name` (`enterprise_name`),
ADD INDEX `office_address` (`office_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `na`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_applicant` (`name_of_applicant`),
ADD INDEX `occupation` (`occupation`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `nil_certificate`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `applicant_name` (`applicant_name`),
ADD INDEX `applicant_address` (`applicant_address`),
ADD INDEX `applicant_mobile_number` (`applicant_mobile_number`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `occupancy_certificate`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `licensed_engineer_name` (`licensed_engineer_name`),
ADD INDEX `situated_at` (`situated_at`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `officer`
ADD INDEX `department_id` (`department_id`);

ALTER TABLE `periodicalreturn`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_applicant` (`name_of_applicant`),
ADD INDEX `applicant_address` (`applicant_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `psf_registration`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `firm_name` (`firm_name`),
ADD INDEX `principal_address` (`principal_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `query`
ADD INDEX `module_type` (`module_type`),
ADD INDEX `module_id` (`module_id`),
ADD INDEX `query_type` (`query_type`),
ADD INDEX `user_id` (`user_id`),
ADD INDEX `status` (`status`);

ALTER TABLE `query_document`
ADD INDEX `query_id` (`query_id`);

ALTER TABLE `sc_inspections`
ADD INDEX `inspection_type` (`inspection_type`),
ADD INDEX `cb_name` (`cb_name`),
ADD INDEX `cb_address` (`cb_address`),
ADD INDEX `status` (`status`);

ALTER TABLE `shop`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `s_name` (`s_name`),
ADD INDEX `regi_category` (`regi_category`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `shop_renewal`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_shop` (`name_of_shop`),
ADD INDEX `category` (`category`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `sj_inspections`
ADD INDEX `cb_type` (`cb_type`),
ADD INDEX `cb_name` (`cb_name`),
ADD INDEX `cb_address` (`cb_address`),
ADD INDEX `status` (`status`);

ALTER TABLE `society_registration`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `applicant_name` (`applicant_name`),
ADD INDEX `applicant_address` (`applicant_address`),
ADD INDEX `applicant_mobile_number` (`applicant_mobile_number`),
ADD INDEX `society_name` (`society_name`),
ADD INDEX `society_address` (`society_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `state`
ADD INDEX `state_code` (`state_code`);

ALTER TABLE `textile`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `enterprise_name` (`enterprise_name`),
ADD INDEX `office_address` (`office_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `tourismevent`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_person` (`name_of_person`),
ADD INDEX `name_of_event` (`name_of_event`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`);

ALTER TABLE `travelagent`
ADD INDEX `area_of_agency` (`area_of_agency`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_person` (`name_of_person`),
ADD INDEX `name_of_travel_agency` (`name_of_travel_agency`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `travelagent_renewal`
ADD INDEX `area_of_agency` (`area_of_agency`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_travel_agency` (`name_of_travel_agency`),
ADD INDEX `address_of_agency` (`address_of_agency`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `tree_cutting`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `applicant_name` (`applicant_name`),
ADD INDEX `applicant_address` (`applicant_address`),
ADD INDEX `applicant_mobile_number` (`applicant_mobile_number`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `users`
ADD INDEX `applicant_name` (`applicant_name`),
ADD INDEX `mobile_number` (`mobile_number`),
ADD INDEX `email` (`email`),
ADD INDEX `is_active` (`is_active`);

ALTER TABLE `vc`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_applicant` (`name_of_applicant`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `wc`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_applicant` (`name_of_applicant`),
ADD INDEX `wc_type` (`wc_type`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `wm_dealer`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_dealer` (`name_of_dealer`),
ADD INDEX `complete_address` (`complete_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `wm_dealer_renewal`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_dealer` (`name_of_dealer`),
ADD INDEX `complete_address` (`complete_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `wm_manufacturer`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_manufacturer` (`name_of_manufacturer`),
ADD INDEX `complete_address` (`complete_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `wm_manufacturer_renewal`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_manufacturer` (`name_of_manufacturer`),
ADD INDEX `complete_address` (`complete_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `wm_registration`
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_applicant` (`name_of_applicant`),
ADD INDEX `application_category` (`application_category`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `wm_repairer`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_repairer` (`name_of_repairer`),
ADD INDEX `premises_status` (`premises_status`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);

ALTER TABLE `wm_repairer_renewal`
ADD INDEX `district` (`district`),
ADD INDEX `entity_establishment_type` (`entity_establishment_type`),
ADD INDEX `name_of_repairer` (`name_of_repairer`),
ADD INDEX `complete_address` (`complete_address`),
ADD INDEX `status` (`status`),
ADD INDEX `query_status` (`query_status`),
ADD INDEX `last_op_reference_number` (`last_op_reference_number`);
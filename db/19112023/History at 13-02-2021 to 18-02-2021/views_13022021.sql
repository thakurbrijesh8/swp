CREATE OR REPLACE VIEW `view_get_ds_wise_appli_licence_count` AS
select district,status,count(aplicence_id) AS total_records
from appli_licence where is_delete <> 1
group by district,status
order by count(aplicence_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_appli_licence_renewal_count` AS
select district,status,count(aplicence_renewal_id) AS total_records
from appli_licence_renewal where is_delete <> 1
group by district,status
order by count(aplicence_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_bocw_count` AS
select district,status,count(bocw_id) AS total_records
from bocw where is_delete <> 1
group by district,status
order by count(bocw_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_boileract_count` AS
select district,status,count(boiler_id) AS total_records
from boileract where is_delete <> 1
group by district,status
order by count(boiler_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_boileract_renewal_count` AS
select district,status,count(boiler_renewal_id) AS total_records
from boileract_renewal where is_delete <> 1
group by district,status
order by count(boiler_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_boilermanufactures_count` AS
select district,status,count(boilermanufacture_id) AS total_records
from boilermanufactures where is_delete <> 1
group by district,status
order by count(boilermanufacture_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_buildingplan_count` AS
select district,status,count(buildingplan_id) AS total_records
from buildingplan where is_delete <> 1
group by district,status
order by count(buildingplan_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_cinema_count` AS
select district,status,count(cinema_id) AS total_records
from cinema where is_delete <> 1
group by district,status
order by count(cinema_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_construction_count` AS
select district,status,count(construction_id) AS total_records
from construction where is_delete <> 1
group by district,status
order by count(construction_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_establishment_count` AS
select district,status,count(establishment_id) AS total_records
from establishment where is_delete <> 1
group by district,status
order by count(establishment_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_factorylicence_count` AS
select district,status,count(factorylicence_id) AS total_records
from factorylicence where is_delete <> 1
group by district,status
order by count(factorylicence_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_factorylicence_renewal_count` AS
select district,status,count(factorylicence_renewal_id) AS total_records
from factorylicence_renewal where is_delete <> 1
group by district,status
order by count(factorylicence_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_filmshooting_count` AS
select district,status,count(filmshooting_id) AS total_records
from filmshooting where is_delete <> 1
group by district,status
order by count(filmshooting_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_hotel_count` AS
select name_of_tourist_area AS district,status,count(hotelregi_id) AS total_records
from hotel where is_delete <> 1
group by district,status
order by count(hotelregi_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_hotel_renewal_count` AS
select name_of_tourist_area AS district,status,count(hotel_renewal_id) AS total_records
from hotel_renewal where is_delete <> 1
group by district,status
order by count(hotel_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_incentive_generalform_count` AS
select district,status,count(incentive_id) AS total_records
from incentive_generalform where is_delete <> 1
group by district,status
order by count(incentive_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_incentive_generalform_textile_count` AS
select district,status,count(incentive_id) AS total_records
from incentive_generalform_textile where is_delete <> 1
group by district,status
order by count(incentive_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_inspection_count` AS
select district,status,count(inspection_id) AS total_records
from inspection where is_delete <> 1
group by district,status
order by count(inspection_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_land_allotment_count` AS
select district,status,count(landallotment_id) AS total_records
from land_allotment where is_delete <> 1
group by district,status
order by count(landallotment_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_lease_seller_count` AS
select district,status,count(seller_id) AS total_records
from lease_seller where is_delete <> 1
group by district,status
order by count(seller_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_migrantworkers_count` AS
select district,status,count(mw_id) AS total_records
from migrantworkers where is_delete <> 1
group by district,status
order by count(mw_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_migrantworkers_renewal_count` AS
select district,status,count(migrantworkers_renewal_id) AS total_records
from migrantworkers_renewal where is_delete <> 1
group by district,status
order by count(migrantworkers_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_na_count` AS
select district,status,count(na_id) AS total_records
from na where is_delete <> 1
group by district,status
order by count(na_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_noc_count` AS
select district,status,count(noc_id) AS total_records
from noc where is_delete <> 1
group by district,status
order by count(noc_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_occupancy_certificate_count` AS
select district,status,count(occupancy_certificate_id) AS total_records
from occupancy_certificate where is_delete <> 1
group by district,status
order by count(occupancy_certificate_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_property_registration_count` AS
select district,status,count(property_id) AS total_records
from property_registration where is_delete <> 1
group by district,status
order by count(property_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_psf_registration_count` AS
select district,status,count(psfregistration_id) AS total_records
from psf_registration where is_delete <> 1
group by district,status
order by count(psfregistration_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_shop_count` AS
select district,status,count(s_id) AS total_records
from shop where is_delete <> 1
group by district,status
order by count(s_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_shop_renewal_count` AS
select district,status,count(shop_renewal_id) AS total_records
from shop_renewal where is_delete <> 1
group by district,status
order by count(shop_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_singlereturn_count` AS
select district,status,count(singlereturn_id) AS total_records
from singlereturn where is_delete <> 1
group by district,status
order by count(singlereturn_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_site_elevation_count` AS
select district,status,count(site_id) AS total_records
from site_elevation where is_delete <> 1
group by district,status
order by count(site_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_sub_lessee_count` AS
select district,status,count(sublessee_id) AS total_records
from sub_lessee where is_delete <> 1
group by district,status
order by count(sublessee_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_sub_letting_count` AS
select district,status,count(subletting_id) AS total_records
from sub_letting where is_delete <> 1
group by district,status
order by count(subletting_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_tourismevent_count` AS
select district,status,count(tourismevent_id) AS total_records
from tourismevent where is_delete <> 1
group by district,status
order by count(tourismevent_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_transfer_count` AS
select district,status,count(transfer_id) AS total_records
from transfer where is_delete <> 1
group by district,status
order by count(transfer_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_travelagent_count` AS
select area_of_agency AS district,status,count(travelagent_id) AS total_records
from travelagent where is_delete <> 1
group by district,status
order by count(travelagent_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_travelagent_renewal_count` AS
select area_of_agency AS district,status,count(travelagent_renewal_id) AS total_records
from travelagent_renewal where is_delete <> 1
group by district,status
order by count(travelagent_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_wc_count` AS
select district,status,count(wc_id) AS total_records
from wc where is_delete <> 1
group by district,status
order by count(wc_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_dealer_count` AS
select district,status,count(dealer_id) AS total_records
from wm_dealer where is_delete <> 1
group by district,status
order by count(dealer_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_dealer_renewal_count` AS
select district,status,count(dealer_renewal_id) AS total_records
from wm_dealer_renewal where is_delete <> 1
group by district,status
order by count(dealer_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_manufacturer_count` AS
select district,status,count(manufacturer_id) AS total_records
from wm_manufacturer where is_delete <> 1
group by district,status
order by count(manufacturer_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_manufacturer_renewal_count` AS
select district,status,count(manufacturer_renewal_id) AS total_records
from wm_manufacturer_renewal where is_delete <> 1
group by district,status
order by count(manufacturer_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_registration_count` AS
select district,status,count(wmregistration_id) AS total_records
from wm_registration where is_delete <> 1
group by district,status
order by count(wmregistration_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_repairer_count` AS
select district,status,count(repairer_id) AS total_records
from wm_repairer where is_delete <> 1
group by district,status
order by count(repairer_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_wm_repairer_renewal_count` AS
select district,status,count(repairer_renewal_id) AS total_records
from wm_repairer_renewal where is_delete <> 1
group by district,status
order by count(repairer_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_ds_wise_zone_information_count` AS
select district,status,count(zone_id) AS total_records
from zone_information where is_delete <> 1
group by district,status
order by count(zone_id) desc;
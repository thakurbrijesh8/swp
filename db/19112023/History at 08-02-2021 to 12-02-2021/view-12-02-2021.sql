CREATE OR REPLACE VIEW `view_get_status_wise_shop_count` AS
select status,count(s_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from shop where is_delete <> 1
group by status,processing_days
order by count(s_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_shop_renewal_count` AS
select status,count(shop_renewal_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from shop_renewal where is_delete <> 1
group by status,processing_days
order by count(shop_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_bocw_count` AS
select status,count(bocw_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from bocw where is_delete <> 1
group by status,processing_days
order by count(bocw_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_migrantworkers_count` AS
select status,count(mw_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from migrantworkers where is_delete <> 1
group by status,processing_days
order by count(mw_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_migrantworkers_renewal_count` AS
select status,count(migrantworkers_renewal_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from migrantworkers_renewal where is_delete <> 1
group by status,processing_days
order by count(migrantworkers_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_establishment_count` AS
select status,count(establishment_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from establishment where is_delete <> 1
group by status,processing_days
order by count(establishment_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_appli_licence_count` AS
select status,count(aplicence_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from appli_licence where is_delete <> 1
group by status,processing_days
order by count(aplicence_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_appli_licence_renewal_count` AS
select status,count(aplicence_renewal_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from appli_licence_renewal where is_delete <> 1
group by status,processing_days
order by count(aplicence_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_singlereturn_count` AS
select status,count(singlereturn_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from singlereturn where is_delete <> 1
group by status,processing_days
order by count(singlereturn_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_land_allotment_count` AS
select status,count(landallotment_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from land_allotment where is_delete <> 1
group by status,processing_days
order by count(landallotment_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_factorylicence_count` AS
select status,count(factorylicence_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from factorylicence where is_delete <> 1
group by status,processing_days
order by count(factorylicence_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_factorylicence_renewal_count` AS
select status,count(factorylicence_renewal_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from factorylicence_renewal where is_delete <> 1
group by status,processing_days
order by count(factorylicence_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_buildingplan_count` AS
select status,count(buildingplan_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from buildingplan where is_delete <> 1
group by status,processing_days
order by count(buildingplan_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_boileract_count` AS
select status,count(boiler_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from boileract where is_delete <> 1
group by status,processing_days
order by count(boiler_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_boileract_renewal_count` AS
select status,count(boiler_renewal_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from boileract_renewal where is_delete <> 1
group by status,processing_days
order by count(boiler_renewal_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_boilermanufactures_count` AS
select status,count(boilermanufacture_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from boilermanufactures where is_delete <> 1
group by status,processing_days
order by count(boilermanufacture_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_na_count` AS
select status,count(na_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from na where is_delete <> 1
group by status,processing_days
order by count(na_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_property_registration_count` AS
select status,count(property_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from property_registration where is_delete <> 1
group by status,processing_days
order by count(property_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_construction_count` AS
select status,count(construction_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from construction where is_delete <> 1
group by status,processing_days
order by count(construction_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_occupancy_certificate_count` AS
select status,count(occupancy_certificate_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from occupancy_certificate where is_delete <> 1
group by status,processing_days
order by count(occupancy_certificate_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_inspection_count` AS
select status,count(inspection_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from inspection where is_delete <> 1
group by status,processing_days
order by count(inspection_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_site_elevation_count` AS
select status,count(site_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from site_elevation where is_delete <> 1
group by status,processing_days
order by count(site_id) desc;

CREATE OR REPLACE VIEW `view_get_status_wise_zone_information_count` AS
select status,count(zone_id) AS total_records, sum(processing_days) AS total_processing_days,processing_days
from zone_information where is_delete <> 1
group by status,processing_days
order by count(zone_id) desc;
CREATE VIEW `view_get_status_wise_noc_count` AS
SELECT status AS status, COUNT(noc_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM noc WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(noc_id) DESC;

CREATE VIEW `view_get_status_wise_lease_seller_count` AS
SELECT status AS status, COUNT(seller_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM lease_seller WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(seller_id) DESC;

CREATE VIEW `view_get_status_wise_transfer_count` AS
SELECT status AS status, COUNT(transfer_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM transfer WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(transfer_id) DESC;

CREATE VIEW `view_get_status_wise_sub_letting_count` AS
SELECT status AS status, COUNT(subletting_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM sub_letting WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(subletting_id) DESC;

CREATE VIEW `view_get_status_wise_sub_lessee_count` AS
SELECT status AS status, COUNT(sublessee_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM sub_lessee WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(sublessee_id) DESC;

CREATE VIEW `view_get_status_wise_incentive_generalform_count` AS
SELECT status AS status, COUNT(incentive_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM incentive_generalform WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(incentive_id) DESC;

CREATE VIEW `view_get_status_wise_incentive_generalform_textile_count` AS
SELECT status AS status, COUNT(incentive_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM incentive_generalform_textile WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(incentive_id) DESC;

CREATE VIEW `view_get_status_wise_wm_repairer_renewal_count` AS
SELECT status AS status, COUNT(repairer_renewal_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM wm_repairer_renewal WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(repairer_renewal_id) DESC;

CREATE VIEW `view_get_status_wise_wm_dealer_renewal_count` AS
SELECT status AS status, COUNT(dealer_renewal_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM wm_dealer_renewal WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(dealer_renewal_id) DESC;

CREATE VIEW `view_get_status_wise_wm_manufacturer_renewal_count` AS
SELECT status AS status, COUNT(manufacturer_renewal_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM wm_manufacturer_renewal WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(manufacturer_renewal_id) DESC;

CREATE VIEW `view_get_status_wise_hotel_renewal_count` AS
SELECT status AS status, COUNT(hotel_renewal_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM hotel_renewal WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(hotel_renewal_id) DESC;

CREATE VIEW `view_get_status_wise_travelagent_count` AS
SELECT status AS status, COUNT(travelagent_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM travelagent WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(travelagent_id) DESC;

CREATE VIEW `view_get_status_wise_travelagent_renewal_count` AS
SELECT status AS status, COUNT(travelagent_renewal_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM travelagent_renewal WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(travelagent_renewal_id) DESC;

CREATE VIEW `view_get_status_wise_tourismevent_count` AS
SELECT status AS status, COUNT(tourismevent_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM tourismevent WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(tourismevent_id) DESC;

CREATE VIEW `view_get_status_wise_filmshooting_count` AS
SELECT status AS status, COUNT(filmshooting_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days
FROM filmshooting WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(filmshooting_id) DESC;
ALTER TABLE `query_grievance` ADD `industry_classification` INT NOT NULL AFTER `business_name`;

ALTER TABLE `query_grievance` ADD `submitted_datetime` DATETIME NOT NULL AFTER `status`, ADD `status_datetime` DATETIME NOT NULL AFTER `submitted_datetime`, ADD `processing_days` INT NOT NULL AFTER `status_datetime`;


-- CREATE VIEW `view_get_status_wise_query_grievance_count` AS
-- SELECT status AS status, 
-- COUNT(if(industry_classification=1,1,NULL)) AS total_records_micro, 
-- COUNT(if(industry_classification=2,2,NULL)) AS total_records_small, 
-- COUNT(if(industry_classification=3,3,NULL)) AS total_records_medium, 
-- COUNT(if(industry_classification=4,4,NULL)) AS total_records_large, 
-- SUM(processing_days) AS total_processing_days, processing_days AS processing_days,industry_classification
-- FROM query_grievance WHERE is_delete <> 1 GROUP BY status,processing_days ORDER BY COUNT(query_grievance_id) DESC;



CREATE VIEW `view_get_status_wise_query_grievance_count` AS
SELECT status AS status, COUNT(query_grievance_id) AS total_records, SUM(processing_days) AS total_processing_days, processing_days AS processing_days,industry_classification
FROM query_grievance WHERE is_delete <> 1 GROUP BY status,processing_days,industry_classification ORDER BY COUNT(query_grievance_id) DESC;
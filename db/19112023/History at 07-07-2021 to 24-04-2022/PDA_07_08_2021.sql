ALTER TABLE `construction`  ADD `certificate_file` VARCHAR(255) NOT NULL  AFTER `licensed_engineer_signature`,  ADD `final_certificate` VARCHAR(255) NOT NULL  AFTER `certificate_file`;

ALTER TABLE `occupancy_certificate`  ADD `certificate_file` VARCHAR(255) NOT NULL  AFTER `is_stability_certificate`,  ADD `final_certificate` VARCHAR(255) NOT NULL  AFTER `certificate_file`;

ALTER TABLE `inspection`  ADD `certificate_file` VARCHAR(255) NOT NULL  AFTER `registration_no`,  ADD `final_certificate` VARCHAR(255) NOT NULL  AFTER `certificate_file`;
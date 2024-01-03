ALTER TABLE `incentive_generalform` ADD `annual_turnover` INT NOT NULL AFTER `turnover`, ADD `annual_turnover_one` INT NOT NULL AFTER `annual_turnover`, ADD `annual_turnover_two` INT NOT NULL AFTER `annual_turnover_one`, ADD `annual_turnover_three` INT NOT NULL AFTER `annual_turnover_two`, ADD `annual_turnover_four` INT NOT NULL AFTER `annual_turnover_three`;


ALTER TABLE `query_grievance` ADD `other_department` VARCHAR(255) NOT NULL AFTER `department`;


ALTER TABLE `incentive_generalform_textile` ADD `annual_turnover` INT NOT NULL AFTER `turnover`, ADD `annual_turnover_one` INT NOT NULL AFTER `annual_turnover`, ADD `annual_turnover_two` INT NOT NULL AFTER `annual_turnover_one`, ADD `annual_turnover_three` INT NOT NULL AFTER `annual_turnover_two`, ADD `annual_turnover_four` INT NOT NULL AFTER `annual_turnover_three`;
ALTER TABLE `service`
DROP `district`,
CHANGE `department_id` `daman_department_id` int(11) NOT NULL AFTER `service_id`,
ADD `diu_department_id` int(11) NOT NULL AFTER `daman_department_id`,
ADD `dnh_department_id` int(11) NOT NULL AFTER `diu_department_id`;

ALTER TABLE `questionary`
DROP `department_id`;

ALTER TABLE `service`
ADD `daman_district` tinyint(1) NOT NULL AFTER `service_id`,
ADD `diu_district` tinyint(1) NOT NULL AFTER `daman_department_id`,
ADD `dnh_district` tinyint(1) NOT NULL AFTER `diu_department_id`;
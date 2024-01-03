ALTER TABLE `bocw`
DROP `particulars_of_demand_draft`,
DROP `amount`,
DROP `demand_draft_no`,
DROP `deman_draf_date`,
DROP `form_one`,
DROP `copy_of_challan`;

ALTER TABLE `shop`
DROP `s_partners_name`,
CHANGE `s_partners_residential_address` `multiple_partner` text COLLATE 'utf8_general_ci' NOT NULL AFTER `s_manager_residential_address`;

ALTER TABLE `shop`
ADD `regi_category` varchar(50) NOT NULL AFTER `district`;
ALTER TABLE `factorylicence_renewal`
CHANGE `max_power_to_be_used` `max_power_to_be_used` varchar(100) NOT NULL AFTER `max_no_of_worker_year`;

ALTER TABLE `factorylicence`
CHANGE `total_power_install` `total_power_install` varchar(200) NOT NULL AFTER `no_of_ordinarily_emp`,
CHANGE `total_power_used` `total_power_used` varchar(200) NOT NULL AFTER `total_power_install`,
CHANGE `max_power_to_be_used` `max_power_to_be_used` varchar(200) NOT NULL AFTER `total_power_used`;
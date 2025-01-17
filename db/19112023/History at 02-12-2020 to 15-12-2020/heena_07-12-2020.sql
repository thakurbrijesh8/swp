CREATE TABLE `filmshooting` (
  `filmshooting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `production_house` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `production_manager` varchar(255) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `director_cast` varchar(255) NOT NULL,
  `film_title` varchar(255) NOT NULL,
  `film_synopsis` varchar(255) NOT NULL,
  `film_shooting_days` int(11) NOT NULL,
  `shooting_location` varchar(255) NOT NULL,
  `shooting_date_time` datetime NOT NULL,
  `defense_installation` varchar(255) NOT NULL,
  `declaration` varchar(255) NOT NULL,
  `producer_signature` varchar(255) NOT NULL,
  `authorized_representative_sign` varchar(255) NOT NULL,
  `seal_of_company` varchar(255) NOT NULL,
  `undersigned` varchar(255) NOT NULL,
  `aged` int(11) NOT NULL,
  `resident` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `witness_one_name` varchar(255) NOT NULL,
  `witness_one_sign` varchar(255) NOT NULL,
  `witness_two_name` varchar(255) NOT NULL,
  `witness_two_sign` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `query_status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`filmshooting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
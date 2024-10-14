-- Adminer 4.8.1 MySQL 10.4.32-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `smv_transport`;
CREATE TABLE `smv_transport` (
  `smv_transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `smv_act` varchar(50) NOT NULL,
  `smv_description` text NOT NULL,
  `smv_tw` int(11) NOT NULL,
  `smv_lmgpv` varchar(200) NOT NULL,
  `smv_ov` varchar(200) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`smv_transport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `smv_transport` (`smv_transport_id`, `smv_act`, `smv_description`, `smv_tw`, `smv_lmgpv`, `smv_ov`, `is_delete`) VALUES
(1,	'177',	'General provision for punishment of offences (first offence)',	500,	'500',	'500',	0),
(2,	'177',	'(Second offence)',	1,	'1,000',	'1,000',	0),
(3,	'178(1)',	'Travelling without Pass or Ticket',	0,	'500',	'500',	0),
(4,	'178(2)',	'Dereliction of duty on the part of conductor of_ Stage Carriage',	0,	'500',	'500',	0),
(5,	'178(3)(a)',	'Refusal to ply or to carry the passengers by the drivel or permit holder of two or three wheeled vehicle',	50,	'50',	'NA',	0),
(6,	'178(3)(b)',	'Refusal to ply or to carry. the passenger by the driver or permit holder of motor vehicle other than · two & three wheeled',	0,	'500',	'500',	0),
(7,	'179(1)',	'Disobedience of directions or obstruction in discharge of functions',	500,	'1000',	'2000',	0),
(8,	'179(2)',	'Willful withholding of information or giving false or untrue information',	2000,	'2000',	'2000',	0),
(9,	'180',	'Allowing unauthorized person drive',	5000,	'5000',	'5000',	0),
(10,	'181',	'Driving in contravention of Section 3 OR Section 4 (driving without licence and driving vehicle without authorisation)',	5000,	'5000',	'5000',	0),
(11,	'182(1)',	'Driving or obtaining license when disqualified for holding or obtaining a license.',	5000,	'7000',	'10000',	0),
(12,	'182(2)',	'Acting as conductor without license and obtaining a conductors license being disqualified',	0,	'5000',	'5000',	0),
(13,	'182A(l)',	'Violations by manufactures, importer or dealer',	1,	'1 Lakh per Vehicle',	'1 Lakh per Vehicle',	0),
(14,	'182A(3)',	'Selling or offering to sell not complying vehicles or components',	1,	'1 Lakh per Component',	'1 Lakh per Component',	0),
(15,	'182A(4)',	'Alternation or retro-fitting by owner',	5000,	'5000 per alernation',	'5000 per alernation',	0),
(16,	'182B',	'Contravention of section 62A',	0,	'10,000',	'10,000',	0),
(17,	'183(1)(ii)',	'Driving at excessive speed MGV, MPV, HGV HPV (First and Second offence)',	0,	'NA',	'4,000',	0),
(18,	'184',	'Driving dangerously (Use of handheld communication devices while driving).',	2,	'3,000',	'5,000',	0),
(19,	'184',	'(Sub sequent offence )',	2,	'6,000',	'10,000',	0),
(20,	'186',	'Driving when mentally or physically unfit to drive. (First offence)',	500,	'1000 (Except Three Wheeler Fine Rs 500)',	'1,000',	0),
(21,	'186',	'(Subsequent offence)',	1,	'2,000',	'2,000',	0),
(22,	'189',	'Racing and trials of speed . (First offence)',	5,	'5,000',	'5,000',	0),
(23,	'189',	'(Second offence)',	10,	'10,000',	'10,000',	0),
(24,	'190(2)',	'Violation of standards prescribed for road safety, noise and air pollution. (First offence)',	1,	'3,000 (Three Wheeler Rs 2,000/-)',	'5000 U/s. Driving Licence to be disqualified for 3 months',	0),
(25,	'190(2)',	'(Second Offence)',	1,	'3,000 (Three Wheeler Rs 2,000/-)',	'7,000',	0),
(26,	'190(2)',	'(Third Offence)',	1,	'3,000 (Three Wheeler Rs 2000/-)',	'10,000',	0),
(27,	'190(2)',	'(Fourth Offence)',	10,	'10,000',	'10,000',	0),
(28,	'192',	'Vehicle using without registration (First offence)',	2,	'3000',	'5000',	0),
(29,	'192',	'(Subsequent offence)',	0,	'Vehicle to be detained & Registration to be done with penalty',	'Vehicle to be detained & Registration to be done with penalty',	0),
(30,	'192(A)',	'Using vehicle without Pertmit (First Offence)',	10,	'10,000',	'10,000',	0),
(31,	'192(A)',	'Subsequent offence',	10,	'10,000',	'10,000',	0),
(32,	'194 (1)',	'Driving exceeding weight',	0,	'20,000 and additional 2000 per ton of excess weight',	'20,000 and additional 2,000 per ton of excess weight',	0),
(33,	'194(1A)',	'Whoever vehicle drives a motor or causes or allows a motor vehicle to be driven when such a manner that the load or any part thereof or anything extends laterally beyond the side of the body or to the front or to the rear or in height beyond the permissible limit.',	0,	'20,000 with charges of loading',	'20,000 with charges of loading',	0),
(34,	'194(2)',	'Refusal to stop and submit vehicle for weighing',	0,	'15000',	'40000',	0),
(35,	'194(A)',	'Carriage of excess passenger',	0,	'200 per excess passenger',	'200 per excess passenger',	0),
(36,	'194 (B) (1)',	'Driver of passenger without wearing safety belts',	0,	'1000',	'1000',	0),
(37,	'194 (B) (2)',	'Driving Vehicle with a chile ( not having attained 14 years) not secured by safety belt or chile restraint system',	0,	'1000',	'1000',	0),
(38,	'194 (C)',	'Driving Motor Cycle in contravention of Section -128 (Safety measure for drivers and pillion riders) (whoever drives a motor cycle or causes or allows a moter cycle to be driven carrying on more than one person in addition to himself)',	1000,	'NA',	'NA',	0),
(39,	'194 (D)',	'Driving Motor Cycle in contravention of Section 129 (wearing of protective head gear)',	1000,	'NA',	'NA',	0),
(40,	'194 (E)',	'Failure to allow free passage to emergency vehicles (Fire Service Vehicle or Ambulance or other· Emergency Vehicles)',	10,	'10,000',	'10,000',	0),
(41,	'194(F) (a &b)',	'(i)Sound the horn needlessly or continuously or more than necessary to ensure safety. (First offence)',	1,	'1,000',	'1,000',	0),
(42,	'194(F) (a &b)',	'(Second offence)',	2,	'2,000',	'2,000',	0),
(43,	'196',	'Driving uninsured vehicle (First offence)',	2,	'2,000',	'2,000',	0),
(44,	'196',	'(Subsequent offence)',	4,	'4,000',	'4,000',	0),
(45,	'198',	'Un-authorized interference with vehicles',	1,	'1,000',	'1,000',	0);

DROP TABLE IF EXISTS `smv_watgst`;
CREATE TABLE `smv_watgst` (
  `smv_watgst_id` int(11) NOT NULL AUTO_INCREMENT,
  `smv_act` varchar(100) NOT NULL,
  `smv_act_desc` varchar(200) NOT NULL,
  `smv_description` text NOT NULL,
  `smv_op` text NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`smv_watgst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `smv_watgst` (`smv_watgst_id`, `smv_act`, `smv_act_desc`, `smv_description`, `smv_op`, `is_delete`) VALUES
(1,	'2005 - Rule 12',	'Dadra and Nagar Haveli and Daman and Diu VAT Regulation, 2005 Rule 12 of Daman and Diu VAT Rules',	'As per Section 86(3)  Where a person, who is required to be registered under  this Regulation, has failed to apply for grant of certificate of  registration within one month from the day on which his liability  to register arose, the person shall be liable to pay, by way of  penalty, an amount equal to one thousand rupees for each day  during which such failure continues or one lakh rupees,  whichever is less.',	'There is no provision for Criminal Punishment.',	0),
(2,	'2005 - Rule 15',	'Dadra and Nagar Haveli and Daman and Diu VAT Regulation, 2005 - Rule 15 of Daman and Diu VAT Rules',	'As per Section 86(4)    If, a registered dealer fails to comply with the provisions  of sub-section (1) of section 21',	'Such dealer shall be liable to  pay, by way of penalty, a sum of one hundred rupees for each  day during which such failure continues or five thousand rupees,  whichever is less.',	0),
(3,	'2005 - Rule 16',	'Dadra and Nagar Haveli and Daman and Diu VAT Regulation, 2005 - Rule 16 of Daman and Diu VAT Rules',	'As per Section 86(5)    (5) If a registered dealer –  (a) fails to comply with the provisions of sub-section (2)  of section 22; or  (b) fails to surrender his certificate of registration as  provided in sub-section (7) of section 22.',	'Such dealer shall be liable to pay, by way of penalty, a sum  equal to one hundred rupees for each day during which such  71  failure continues or five thousand rupees, whichever is less.',	0),
(4,	'2005 - Rule 27',	'Dadra and Nagar Haveli and Daman and Diu VAT Regulation, 2005 - Rule 27 of Daman and Diu VAT Rules',	'As per Section 86(8)    (8) If a person required to furnish a return under the  provisions of Chapter V –  (a) fails to furnish any return by the prescribed date; or  (b) fails to furnish alongwith the return any document that  is required to be furnished alongwith the return; or  (c) being required to revise a return already furnished, fails  to furnish the revised return by the prescribed date.',	'Such person shall be liable to pay, by way of penalty, a sum of  one hundred rupees for each day during which such failure  continues or ten thousand rupees, whichever is less.',	0),
(5,	'2005 - Rule 31',	'Dadra and Nagar Haveli and Daman and Diu VAT Regulation, 2005 - Rule 31 of Daman and Diu VAT Rules',	'As per Section 36    36. Every person, liable to pay tax, interest, penalty or any other  amount under this Regulation, shall pay the amount to the  Government Treasury of Dadra and Nagar Haveli (52) [and  Daman and Diu], or a branch in Dadra and Nagar Haveli (53) [and  Daman and Diu] of a bank which may be prescribed, or at such  other place or in such other manner as may be prescribed.',	'Not Defined',	0),
(6,	'2005 - Central Sales Tax (Registration and Turnover) ',	'Dadra and Nagar Haveli and Daman and Diu VAT Regulation, 2005. - Central Sales Tax (Registration and Turnover) Rules, 1957',	'PROVIDED that no prosecution an offence under Section 10 of Central Sales tax, Act 1956 shall be instituted in respect of the same facts on which penalty has been imposed under this section',	'Not Defined',	0);

-- 2024-10-08 06:41:22
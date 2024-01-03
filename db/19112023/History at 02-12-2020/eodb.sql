-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2020 at 07:11 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cinema`
--

CREATE TABLE `cinema` (
  `cinema_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `permanent_address` text NOT NULL,
  `temporary_address` text NOT NULL,
  `video_cassette_recorder` varchar(100) NOT NULL,
  `is_case_of_building` tinyint(1) NOT NULL,
  `plan_of_building_document` varchar(100) NOT NULL,
  `name_of_building` varchar(100) NOT NULL,
  `place_of_building` varchar(100) NOT NULL,
  `distance_of_building` varchar(100) NOT NULL,
  `character_licence_certificate` varchar(100) NOT NULL,
  `photo_state_copy` varchar(100) NOT NULL,
  `ownership_document` varchar(100) NOT NULL,
  `motor_vehicles_document` varchar(100) NOT NULL,
  `business_trade_authority_license` varchar(100) NOT NULL,
  `tb_license_affected` varchar(100) NOT NULL,
  `building_as` varchar(100) NOT NULL,
  `auditorium_as` varchar(100) NOT NULL,
  `passages_and_gangways_as` varchar(100) NOT NULL,
  `urinals_and_wc_as` varchar(100) NOT NULL,
  `time_schedule_film` varchar(100) NOT NULL,
  `screen_width` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cinema`
--

INSERT INTO `cinema` (`cinema_id`, `user_id`, `name_of_applicant`, `father_name`, `dob`, `permanent_address`, `temporary_address`, `video_cassette_recorder`, `is_case_of_building`, `plan_of_building_document`, `name_of_building`, `place_of_building`, `distance_of_building`, `character_licence_certificate`, `photo_state_copy`, `ownership_document`, `motor_vehicles_document`, `business_trade_authority_license`, `tb_license_affected`, `building_as`, `auditorium_as`, `passages_and_gangways_as`, `urinals_and_wc_as`, `time_schedule_film`, `screen_width`, `signature`, `status`, `status_datetime`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `registration_number`, `valid_upto`, `remarks`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 2, 'Devin R Patel', 'Ramesh G Patel', '1990-10-20', 'Daman', 'Daman', 'http://youtube.com', 1, 'plan_of_building_document_5802340901603195075.png', 'Ankit Residency', 'Daman', '20km', 'character_licence_certificate_7159692241603195044.png', 'photo_state_copy_1910678851603195044.png', 'ownership_document_4105021431603195044.png', 'motor_vehicles_document_4383173061603195044.png', 'business_trade_authority_license_7586550291603195044.png', 'No', '20 sq', '15 sq', '10 sq', '15 sq', '9 to 5 mon - fri & 9 to 1 sat - sun', 'yes', 'signature_5279459601603195044.png', 5, '2020-10-20 17:39:04', 'challan_9399529861603195594.png', '2020-10-20 17:36:34', 'fees_paid_challan_6022215401603195704.png', '2020-10-20 17:38:24', 'LE/LI/CINEMA/0001', '2020-10-20', 'ok', 1, '2020-10-20 17:35:26', 1, '2020-10-20 17:39:04', 0),
(2, 1, 'Prilantee Patel', 'Rajendrabhai', '1990-04-10', 'Daman', 'Daman', 'xyx', 0, '', '', '', '', '', '', '', '', 'business_trade_authority_license_4663456781603447787.pdf', 'abc', 'daman', 'abc', 'xyz', 'abc', '10 AM', 'abc', 'signature_3758491141603447787.pdf', 5, '2020-10-23 16:15:49', 'challan_2840041541603449694.pdf', '2020-10-23 16:11:34', 'fees_paid_challan_3919103801603449756.pdf', '2020-10-23 16:12:36', '12', '2020-10-24', 'Approve', 1, '2020-10-23 15:41:19', 1, '2020-10-23 16:15:49', 0),
(3, 1, 'test', 'test', '2020-10-26', 'test', 'test', 'dd', 0, '', '', '', '', '', '', '', '', 'business_trade_authority_license_8713471611603693350.pdf', 'abc', 'daman', 'abc', 'xyz', 'abc', '10 AM', 'abc', 'signature_4622604851603693350.png', 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00', '', 1, '2020-10-26 11:52:30', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lbe_master`
--

CREATE TABLE `lbe_master` (
  `lbe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `permanent_address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lbe_master`
--

INSERT INTO `lbe_master` (`lbe_id`, `user_id`, `name_of_applicant`, `father_name`, `dob`, `permanent_address`, `mobile_no`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 1, 'demo', 'demo', '2016-04-04', 'dd', '5556565666', 1, '2020-10-24 16:31:38', 0, '0000-00-00 00:00:00', 0),
(2, 1, 'priya', 'test', '2011-04-13', 'dd', '5675756565', 1, '2020-10-26 10:24:42', 0, '0000-00-00 00:00:00', 0),
(3, 1, 'abc', 'abc', '2016-02-03', 'dd', '667677', 1, '2020-10-26 10:30:58', 0, '0000-00-00 00:00:00', 0),
(4, 1, 'sdsddssdd', 'dsds', '2020-10-26', 'sdd', '5556565666', 1, '2020-10-26 10:43:13', 0, '0000-00-00 00:00:00', 0),
(5, 1, 'a', 'a', '2020-10-12', 'a', '667677', 1, '2020-10-26 11:08:59', 0, '0000-00-00 00:00:00', 0),
(6, 1, 'ssss', 'ss', '2015-01-05', 'ss', '656565656', 1, '2020-10-26 11:33:00', 0, '0000-00-00 00:00:00', 0),
(7, 1, 'ASAS', 'axas', '2020-10-26', 'sdwsd', '54554', 1, '2020-10-26 11:35:28', 0, '0000-00-00 00:00:00', 0),
(8, 1, 't', 't', '2020-10-26', 't', '745875', 1, '2020-10-26 11:44:42', 0, '0000-00-00 00:00:00', 0),
(9, 1, 'd', 'h', '2020-10-26', 'h', '8787', 1, '2020-10-26 12:43:52', 0, '0000-00-00 00:00:00', 0),
(10, 1, 'q', 'q', '2020-10-26', 'q', '67876788', 1, '2020-10-26 13:10:25', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs_change_pin`
--

CREATE TABLE `logs_change_pin` (
  `logs_change_pin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `old_pin` text NOT NULL,
  `new_pin` text NOT NULL,
  `created_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs_change_pin`
--

INSERT INTO `logs_change_pin` (`logs_change_pin_id`, `user_id`, `old_pin`, `new_pin`, `created_time`) VALUES
(1, 1, '149d4bf49992174e876744ac9f99e3043337353539643830376634396235316630633736356133616135346362633837613362353230653563316631356238376262613936313163346334653362313252dbbb25a8c5', '924b46c604265ff342bf85864174a41962653832366634353361653032663765666265346339323066616663303338616133336132303537356533656633356536333965323737343831353737376134c568dd134537', '2020-09-09 11:11:44'),
(2, 1, '924b46c604265ff342bf85864174a41962653832366634353361653032663765666265346339323066616663303338616133336132303537356533656633356536333965323737343831353737376134c568dd134537', '0591a0864c5fcf62fc12c5bed141b907383736623662306635613537643661303162353236666631616361646638626162383131366537346430303535333662373366353966353732653862656264306da8c90906fb', '2020-09-09 11:12:33'),
(3, 1, '0591a0864c5fcf62fc12c5bed141b907383736623662306635613537643661303162353236666631616361646638626162383131366537346430303535333662373366353966353732653862656264306da8c90906fb', '2a7f8788ade728524d64d4298d2ea0b734623130353563383563373233393138636536303438306462646464643061363861363433623038343630376434393436383161383061656232306338326364f39c3ff0b79e', '2020-09-09 11:12:50'),
(4, 1, '2a7f8788ade728524d64d4298d2ea0b734623130353563383563373233393138636536303438306462646464643061363861363433623038343630376434393436383161383061656232306338326364f39c3ff0b79e', '09284a9d9c32b61e35343616de53145f36353561613866336634646135363261366630613962356230653438373239323731383730343830393839306438373764353630656539396239656239333763dd60912624d0', '2020-09-09 11:13:12'),
(5, 2, '09284a9d9c32b61e35343616de53145f36353561613866336634646135363261366630613962356230653438373239323731383730343830393839306438373764353630656539396239656239333763dd60912624d0', 'bcd705317c44fe21f65a7bfaabd0de0161386235656538306338633238376333363231323233323533636232656265643435656138396566643331363433303134386435303864373030333861323538ba4be96d127e', '2020-09-09 17:28:17'),
(6, 3, 'f0f09087154374653d9d2a5d976c667f30643333383064333665363437653639356533303161393263343731636365346363643734623532656536353766313561646239633036333864376538363763a83b3b6e9879', '1a09dd4206414ed55d7d2e76923246fe61313931643534656533343235386336393636353036613361653163323632653664363163623133656136663964656561613232613337363762396438656165ce417167f6f2', '2020-10-21 15:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `logs_email`
--

CREATE TABLE `logs_email` (
  `email_log_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `email_type` tinyint(1) NOT NULL,
  `status` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs_email`
--

INSERT INTO `logs_email` (`email_log_id`, `email`, `email_type`, `status`, `message`, `created_by`, `created_time`, `is_delete`) VALUES
(1, 'v.a.solanki0000@gmail.com', 1, 'success', '', 3, '2020-10-20 18:01:41', 0),
(2, 'v.a.solanki0000@gmail.com', 2, 'success', '', 3, '2020-10-21 15:01:59', 0),
(3, 'v.a.solanki0000@gmail.com', 3, 'success', '', 3, '2020-10-21 15:02:24', 0),
(4, 'prilanteepatel1090@gmail.com', 1, 'fail', 'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Fri, 23 Oct 2020 12:11:49 +0530\nFrom: &quot;District Industries Center - Daman &amp; Diu&quot; &lt;noreply@nicdemo.in&gt;\nReturn-Path: &lt;noreply@nicdemo.in&gt;\nReply-To: &lt;noreply@nicdemo.in&gt;\nUser-Agent: CodeIgniter\nX-Sender: noreply@nicdemo.in\nX-Mailer: CodeIgniter\nX-Priority: 3 (Normal)\nMessage-ID: &lt;5f927b2d63f68@nicdemo.in&gt;\nMime-Version: 1.0\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_5f927b2d63fa8&quot;\n=?UTF-8?Q?Account=20Confirmation?=\nThis is a multi-part message in MIME format.\nYour email application may not support this format.\n\n--B_ALT_5f927b2d63fa8\nContent-Type: text/plain; charset=UTF-8\nContent-Transfer-Encoding: 8bit\n\nhttp://localhost/eodb_sws/confirmation?q=9BgOcnnHweUhbM4WrrbsIKtseY3mOYvrv21eFDceqnYFtekzS4\n\n\n--B_ALT_5f927b2d63fa8\nContent-Type: text/html; charset=UTF-8\nContent-Transfer-Encoding: quoted-printable\n\nhttp://localhost/eodb=5Fsws/confirmation?q=3D9BgOcnnHweUhbM4WrrbsIKtseY3mOY=\nvrv21eFDceqnYFtekzS4\n\n--B_ALT_5f927b2d63fa8--</pre>', 4, '2020-10-23 12:11:51', 0),
(5, 'prilanteepatel1090@gmail.com', 2, 'fail', 'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Fri, 23 Oct 2020 12:15:59 +0530\nFrom: &quot;District Industries Center - Daman &amp; Diu&quot; &lt;noreply@nicdemo.in&gt;\nReturn-Path: &lt;noreply@nicdemo.in&gt;\nReply-To: &lt;noreply@nicdemo.in&gt;\nUser-Agent: CodeIgniter\nX-Sender: noreply@nicdemo.in\nX-Mailer: CodeIgniter\nX-Priority: 3 (Normal)\nMessage-ID: &lt;5f927c275d3be@nicdemo.in&gt;\nMime-Version: 1.0\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_5f927c275d3c9&quot;\n=?UTF-8?Q?Login=20Credentials?=\nThis is a multi-part message in MIME format.\nYour email application may not support this format.\n\n--B_ALT_5f927c275d3c9\nContent-Type: text/plain; charset=UTF-8\nContent-Transfer-Encoding: 8bit\n\nYour Login Credentials is Mobile Number : 7567204909 and Your PIN is :\n756720\n\n\n--B_ALT_5f927c275d3c9\nContent-Type: text/html; charset=UTF-8\nContent-Transfer-Encoding: quoted-printable\n\nYour Login Credentials is Mobile Number : 7567204909 and Your PIN is : 7567=\n20\n\n--B_ALT_5f927c275d3c9--</pre>', 4, '2020-10-23 12:16:01', 0),
(6, 'prilanteepatel1090@gmail.com', 1, 'fail', 'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Fri, 23 Oct 2020 12:30:49 +0530\nFrom: &quot;District Industries Center - Daman &amp; Diu&quot; &lt;noreply@nicdemo.in&gt;\nReturn-Path: &lt;noreply@nicdemo.in&gt;\nReply-To: &lt;noreply@nicdemo.in&gt;\nUser-Agent: CodeIgniter\nX-Sender: noreply@nicdemo.in\nX-Mailer: CodeIgniter\nX-Priority: 3 (Normal)\nMessage-ID: &lt;5f927fa1c17a1@nicdemo.in&gt;\nMime-Version: 1.0\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_5f927fa1c17ac&quot;\n=?UTF-8?Q?Account=20Confirmation?=\nThis is a multi-part message in MIME format.\nYour email application may not support this format.\n\n--B_ALT_5f927fa1c17ac\nContent-Type: text/plain; charset=UTF-8\nContent-Transfer-Encoding: 8bit\n\nhttp://localhost/eodb_sws/confirmation?q=JIHxUa0cYQUBYNHR9tlgdJruuOGesnBwlNUwtG7uAMLDHGpoym\n\n\n--B_ALT_5f927fa1c17ac\nContent-Type: text/html; charset=UTF-8\nContent-Transfer-Encoding: quoted-printable\n\nhttp://localhost/eodb=5Fsws/confirmation?q=3DJIHxUa0cYQUBYNHR9tlgdJruuOGesn=\nBwlNUwtG7uAMLDHGpoym\n\n--B_ALT_5f927fa1c17ac--</pre>', 5, '2020-10-23 12:30:51', 0),
(7, 'prilanteepatel1090@gmail.com', 1, 'fail', 'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Fri, 23 Oct 2020 12:38:25 +0530\nFrom: &quot;District Industries Center - Daman &amp; Diu&quot; &lt;noreply@nicdemo.in&gt;\nReturn-Path: &lt;noreply@nicdemo.in&gt;\nReply-To: &lt;noreply@nicdemo.in&gt;\nUser-Agent: CodeIgniter\nX-Sender: noreply@nicdemo.in\nX-Mailer: CodeIgniter\nX-Priority: 3 (Normal)\nMessage-ID: &lt;5f92816930c38@nicdemo.in&gt;\nMime-Version: 1.0\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_5f92816930c48&quot;\n=?UTF-8?Q?Account=20Confirmation?=\nThis is a multi-part message in MIME format.\nYour email application may not support this format.\n\n--B_ALT_5f92816930c48\nContent-Type: text/plain; charset=UTF-8\nContent-Transfer-Encoding: 8bit\n\nhttp://localhost/eodb_sws/confirmation?q=q6paH1YzlSJAbpatN0vLPLUDzsvg76lVzYvSowZo1plQ3zyxrY\n\n\n--B_ALT_5f92816930c48\nContent-Type: text/html; charset=UTF-8\nContent-Transfer-Encoding: quoted-printable\n\nhttp://localhost/eodb=5Fsws/confirmation?q=3Dq6paH1YzlSJAbpatN0vLPLUDzsvg76=\nlVzYvSowZo1plQ3zyxrY\n\n--B_ALT_5f92816930c48--</pre>', 1, '2020-10-23 12:38:27', 0),
(8, 'prilanteepatel1090@gmail.com', 1, 'fail', 'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Fri, 23 Oct 2020 12:40:47 +0530\nFrom: &quot;District Industries Center - Daman &amp; Diu&quot; &lt;noreply@nicdemo.in&gt;\nReturn-Path: &lt;noreply@nicdemo.in&gt;\nReply-To: &lt;noreply@nicdemo.in&gt;\nUser-Agent: CodeIgniter\nX-Sender: noreply@nicdemo.in\nX-Mailer: CodeIgniter\nX-Priority: 3 (Normal)\nMessage-ID: &lt;5f9281f7e718e@nicdemo.in&gt;\nMime-Version: 1.0\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_5f9281f7e7199&quot;\n=?UTF-8?Q?Account=20Confirmation?=\nThis is a multi-part message in MIME format.\nYour email application may not support this format.\n\n--B_ALT_5f9281f7e7199\nContent-Type: text/plain; charset=UTF-8\nContent-Transfer-Encoding: 8bit\n\nhttp://localhost/eodb_sws/confirmation?q=WOLfRy9TS3ysSLpJfi7gGM8zXl3fQ7Ch1A6J9c02Y7uvXVYbO2\n\n\n--B_ALT_5f9281f7e7199\nContent-Type: text/html; charset=UTF-8\nContent-Transfer-Encoding: quoted-printable\n\nhttp://localhost/eodb=5Fsws/confirmation?q=3DWOLfRy9TS3ysSLpJfi7gGM8zXl3fQ7=\nCh1A6J9c02Y7uvXVYbO2\n\n--B_ALT_5f9281f7e7199--</pre>', 1, '2020-10-23 12:40:49', 0),
(9, 'prilanteepatel1090@gmail.com', 1, 'fail', 'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Fri, 23 Oct 2020 12:47:53 +0530\nFrom: &quot;District Industries Center - Daman &amp; Diu&quot; &lt;noreply@nicdemo.in&gt;\nReturn-Path: &lt;noreply@nicdemo.in&gt;\nReply-To: &lt;noreply@nicdemo.in&gt;\nUser-Agent: CodeIgniter\nX-Sender: noreply@nicdemo.in\nX-Mailer: CodeIgniter\nX-Priority: 3 (Normal)\nMessage-ID: &lt;5f9283a1b58e4@nicdemo.in&gt;\nMime-Version: 1.0\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_5f9283a1b58f7&quot;\n=?UTF-8?Q?Account=20Confirmation?=\nThis is a multi-part message in MIME format.\nYour email application may not support this format.\n\n--B_ALT_5f9283a1b58f7\nContent-Type: text/plain; charset=UTF-8\nContent-Transfer-Encoding: 8bit\n\nhttp://localhost/eodb_sws/confirmation?q=sSaGOWn1eSualLJfzl0SX3nPdpCUyPShVs72EIzh62mw5sXcgC\n\n\n--B_ALT_5f9283a1b58f7\nContent-Type: text/html; charset=UTF-8\nContent-Transfer-Encoding: quoted-printable\n\nhttp://localhost/eodb=5Fsws/confirmation?q=3DsSaGOWn1eSualLJfzl0SX3nPdpCUyP=\nShVs72EIzh62mw5sXcgC\n\n--B_ALT_5f9283a1b58f7--</pre>', 1, '2020-10-23 12:47:55', 0),
(10, 'prilanteepatel1090@gmail.com', 1, 'fail', 'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Fri, 23 Oct 2020 12:53:04 +0530\nFrom: &quot;District Industries Center - Daman &amp; Diu&quot; &lt;noreply@nicdemo.in&gt;\nReturn-Path: &lt;noreply@nicdemo.in&gt;\nReply-To: &lt;noreply@nicdemo.in&gt;\nUser-Agent: CodeIgniter\nX-Sender: noreply@nicdemo.in\nX-Mailer: CodeIgniter\nX-Priority: 3 (Normal)\nMessage-ID: &lt;5f9284d829a12@nicdemo.in&gt;\nMime-Version: 1.0\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_5f9284d829a36&quot;\n=?UTF-8?Q?Account=20Confirmation?=\nThis is a multi-part message in MIME format.\nYour email application may not support this format.\n\n--B_ALT_5f9284d829a36\nContent-Type: text/plain; charset=UTF-8\nContent-Transfer-Encoding: 8bit\n\nhttp://localhost/eodb_sws/confirmation?q=Q8i7YAr0khJPEqtXhXLPzvIrGSqEst3hEq04An7VmQpN4kMWqZ\n\n\n--B_ALT_5f9284d829a36\nContent-Type: text/html; charset=UTF-8\nContent-Transfer-Encoding: quoted-printable\n\nhttp://localhost/eodb=5Fsws/confirmation?q=3DQ8i7YAr0khJPEqtXhXLPzvIrGSqEst=\n3hEq04An7VmQpN4kMWqZ\n\n--B_ALT_5f9284d829a36--</pre>', 1, '2020-10-23 12:53:09', 0),
(11, 'prilanteepatel1090@gmail.com', 1, 'success', '', 1, '2020-10-23 13:01:26', 0),
(12, 'prilanteepatel1090@gmail.com', 2, 'success', '', 1, '2020-10-23 13:02:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs_login_details`
--

CREATE TABLE `logs_login_details` (
  `logs_login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `login_timestamp` int(11) NOT NULL,
  `logout_timestamp` int(11) NOT NULL,
  `logs_data` text NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs_login_details`
--

INSERT INTO `logs_login_details` (`logs_login_details_id`, `user_id`, `ip_address`, `login_timestamp`, `logout_timestamp`, `logs_data`, `created_time`, `updated_time`) VALUES
(1, 1, '::1', 1599475904, 1599475909, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/84.0.4147.135 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-07 16:21:44', '2020-09-07 16:21:49'),
(2, 1, '::1', 1599477272, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/84.0.4147.135 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-07 16:44:32', '0000-00-00 00:00:00'),
(3, 1, '::1', 1599546291, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/84.0.4147.135 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-08 11:54:51', '0000-00-00 00:00:00'),
(4, 1, '::1', 1599550439, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/84.0.4147.135 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-08 13:03:59', '0000-00-00 00:00:00'),
(5, 1, '::1', 1599558416, 1599562639, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/84.0.4147.135 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-08 15:16:56', '2020-09-08 16:27:19'),
(6, 1, '::1', 1599578372, 1599578395, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/84.0.4147.135 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-08 20:49:32', '2020-09-08 20:49:55'),
(7, 1, '::1', 1599578399, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/84.0.4147.135 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-08 20:49:59', '0000-00-00 00:00:00'),
(8, 1, '::1', 1599628344, 1599629092, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 10:42:24', '2020-09-09 10:54:52'),
(9, 1, '::1', 1599629098, 1599630157, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 10:54:58', '2020-09-09 11:12:37'),
(10, 1, '::1', 1599630161, 1599630172, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 11:12:41', '2020-09-09 11:12:52'),
(11, 1, '::1', 1599630181, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 11:13:01', '0000-00-00 00:00:00'),
(12, 1, '::1', 1599641686, 1599642830, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 14:24:46', '2020-09-09 14:43:50'),
(13, 1, '::1', 1599643361, 1599643367, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 14:52:41', '2020-09-09 14:52:47'),
(14, 1, '::1', 1599647410, 1599647439, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 16:00:10', '2020-09-09 16:00:39'),
(15, 1, '::1', 1599647646, 1599647683, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 16:04:06', '2020-09-09 16:04:43'),
(16, 1, '::1', 1599650543, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 16:52:23', '0000-00-00 00:00:00'),
(17, 1, '::1', 1599652475, 1599652541, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 17:24:35', '2020-09-09 17:25:41'),
(18, 1, '::1', 1599652562, 1599652572, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 17:26:02', '2020-09-09 17:26:12'),
(19, 2, '::1', 1599652690, 1599652699, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 17:28:10', '2020-09-09 17:28:19'),
(20, 2, '::1', 1599652702, 1599652707, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 17:28:22', '2020-09-09 17:28:27'),
(21, 2, '::1', 1599711549, 1599711577, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-10 09:49:09', '2020-09-10 09:49:37'),
(22, 2, '::1', 1599711593, 1599729256, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-10 09:49:53', '2020-09-10 14:44:16'),
(23, 2, '::1', 1599729280, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-10 14:44:40', '0000-00-00 00:00:00'),
(24, 2, '::1', 1599792212, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-11 08:13:32', '0000-00-00 00:00:00'),
(25, 2, '::1', 1599807544, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-11 12:29:04', '0000-00-00 00:00:00'),
(26, 2, '::1', 1599810111, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko\\/20100101 Firefox\\/80.0\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-11 13:11:51', '0000-00-00 00:00:00'),
(27, 2, '::1', 1599885301, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-12 10:05:01', '0000-00-00 00:00:00'),
(28, 2, '::1', 1599901903, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-12 14:41:43', '0000-00-00 00:00:00'),
(29, 2, '::1', 1600056775, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-14 09:42:55', '0000-00-00 00:00:00'),
(30, 2, '::1', 1600142518, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-15 09:31:58', '0000-00-00 00:00:00'),
(31, 2, '::1', 1600229618, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-16 09:43:38', '0000-00-00 00:00:00'),
(32, 2, '::1', 1600322043, 1600331239, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-17 11:24:03', '2020-09-17 13:57:19'),
(33, 2, '::1', 1600331554, 1600339235, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-17 14:02:34', '2020-09-17 16:10:35'),
(34, 2, '::1', 1600339259, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-17 16:10:59', '0000-00-00 00:00:00'),
(35, 2, '::1', 1600493345, 1600493702, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-19 10:59:05', '2020-09-19 11:05:02'),
(36, 2, '::1', 1600493711, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-19 11:05:11', '0000-00-00 00:00:00'),
(37, 2, '::1', 1600660658, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-21 09:27:38', '0000-00-00 00:00:00'),
(38, 2, '::1', 1600673800, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-21 13:06:40', '0000-00-00 00:00:00'),
(39, 2, '::1', 1600748457, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-22 09:50:57', '0000-00-00 00:00:00'),
(40, 2, '::1', 1600766904, 1600774272, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-22 14:58:24', '2020-09-22 17:01:12'),
(41, 2, '::1', 1600774279, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-22 17:01:19', '0000-00-00 00:00:00'),
(42, 2, '::1', 1600845392, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-23 12:46:32', '0000-00-00 00:00:00'),
(43, 2, '::1', 1600872498, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-23 20:18:18', '0000-00-00 00:00:00'),
(44, 2, '::1', 1600918155, 1600935510, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-24 08:59:15', '2020-09-24 13:48:30'),
(45, 2, '::1', 1600935525, 1600937448, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-24 13:48:45', '2020-09-24 14:20:48'),
(46, 2, '::1', 1600937456, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-24 14:20:56', '0000-00-00 00:00:00'),
(47, 2, '::1', 1600940252, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-24 15:07:32', '0000-00-00 00:00:00'),
(48, 2, '::1', 1601006782, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 09:36:22', '0000-00-00 00:00:00'),
(49, 2, '::1', 1601027364, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 15:19:24', '0000-00-00 00:00:00'),
(50, 2, '::1', 1601028514, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 15:38:34', '0000-00-00 00:00:00'),
(51, 2, '::1', 1601034028, 1601034438, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 17:10:28', '2020-09-25 17:17:18'),
(52, 2, '::1', 1601035387, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 17:33:07', '0000-00-00 00:00:00'),
(53, 2, '::1', 1601094588, 1601101092, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-26 09:59:48', '2020-09-26 11:48:12'),
(54, 2, '::1', 1601103827, 1601104277, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-26 12:33:47', '2020-09-26 12:41:17'),
(55, 2, '::1', 1601104950, 1601106071, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-26 12:52:30', '2020-09-26 13:11:11'),
(56, 2, '::1', 1601109942, 1601116795, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-26 14:15:42', '2020-09-26 16:09:55'),
(57, 2, '::1', 1601266107, 1601267032, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-28 09:38:27', '2020-09-28 09:53:52'),
(58, 2, '::1', 1601267152, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-28 09:55:52', '0000-00-00 00:00:00'),
(59, 2, '106.66.58.58', 1601964259, 1601965044, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"106.66.58.58\"}', '2020-10-06 11:34:19', '2020-10-06 11:47:24'),
(60, 2, '106.66.58.58', 1601965075, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"106.66.58.58\"}', '2020-10-06 11:47:55', '0000-00-00 00:00:00'),
(61, 2, '103.66.115.30', 1601968774, 1601970541, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.66.115.30\"}', '2020-10-06 12:49:34', '2020-10-06 13:19:01'),
(62, 2, '103.66.115.30', 1601970554, 1601973882, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.66.115.30\"}', '2020-10-06 13:19:14', '2020-10-06 14:14:42'),
(63, 2, '103.66.115.30', 1601973892, 1601978675, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.66.115.30\"}', '2020-10-06 14:14:52', '2020-10-06 15:34:35'),
(64, 1, '103.240.76.3', 1601978141, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.240.76.3\"}', '2020-10-06 15:25:41', '0000-00-00 00:00:00'),
(65, 2, '103.66.115.30', 1601978687, 1601979009, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.66.115.30\"}', '2020-10-06 15:34:47', '2020-10-06 15:40:09'),
(66, 2, '103.66.115.30', 1601979018, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.66.115.30\"}', '2020-10-06 15:40:18', '0000-00-00 00:00:00'),
(67, 2, '1.38.160.114', 1603194345, 1603198468, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"1.38.160.114\"}', '2020-10-20 17:15:45', '2020-10-20 18:24:28'),
(68, 2, '1.38.160.114', 1603198493, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"1.38.160.114\"}', '2020-10-20 18:24:53', '0000-00-00 00:00:00'),
(69, 2, '103.36.82.21', 1603199788, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.36.82.21\"}', '2020-10-20 18:46:28', '0000-00-00 00:00:00'),
(70, 2, '164.100.212.187', 1603201192, 1603201414, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"164.100.212.187\"}', '2020-10-20 19:09:52', '2020-10-20 19:13:34'),
(71, 2, '106.77.69.195', 1603254351, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"106.77.69.195\"}', '2020-10-21 09:55:51', '0000-00-00 00:00:00'),
(72, 2, '164.100.212.187', 1603258967, 1603259135, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"164.100.212.187\"}', '2020-10-21 11:12:47', '2020-10-21 11:15:35'),
(73, 3, '103.251.19.163', 1603272772, 1603272775, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.251.19.163\"}', '2020-10-21 15:02:52', '2020-10-21 15:02:55'),
(74, 4, '::1', 1603435644, 1603436352, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 12:17:24', '2020-10-23 12:29:12'),
(75, 1, '::1', 1603438428, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 13:03:48', '0000-00-00 00:00:00'),
(76, 1, '::1', 1603445679, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 15:04:39', '0000-00-00 00:00:00'),
(77, 1, '::1', 1603446114, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 15:11:54', '0000-00-00 00:00:00'),
(78, 1, '::1', 1603449326, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 16:05:26', '0000-00-00 00:00:00'),
(79, 1, '::1', 1603449720, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 16:12:00', '0000-00-00 00:00:00'),
(80, 1, '::1', 1603450050, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 16:17:30', '0000-00-00 00:00:00'),
(81, 1, '::1', 1603450496, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 16:24:56', '0000-00-00 00:00:00'),
(82, 1, '::1', 1603451638, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 16:43:58', '0000-00-00 00:00:00'),
(83, 1, '::1', 1603452774, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 17:02:54', '0000-00-00 00:00:00'),
(84, 1, '::1', 1603453225, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 17:10:25', '0000-00-00 00:00:00'),
(85, 1, '::1', 1603454921, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 17:38:41', '0000-00-00 00:00:00'),
(86, 1, '::1', 1603516381, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-24 10:43:01', '0000-00-00 00:00:00'),
(87, 1, '::1', 1603525239, 1603532585, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-24 13:10:39', '2020-10-24 15:13:05'),
(88, 1, '::1', 1603532599, 1603532720, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-24 15:13:19', '2020-10-24 15:15:20'),
(89, 1, '::1', 1603533668, 1603535178, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-24 15:31:08', '2020-10-24 15:56:18'),
(90, 1, '::1', 1603535219, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-24 15:56:59', '0000-00-00 00:00:00'),
(91, 1, '::1', 1603687623, 1603687653, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 10:17:03', '2020-10-26 10:17:33'),
(92, 1, '::1', 1603687666, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 10:17:46', '0000-00-00 00:00:00'),
(93, 1, '::1', 1603689106, 1603690639, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 10:41:46', '2020-10-26 11:07:19'),
(94, 1, '::1', 1603690656, 1603691631, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 11:07:36', '2020-10-26 11:23:51'),
(95, 1, '::1', 1603691653, 1603693220, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 11:24:13', '2020-10-26 11:50:20'),
(96, 1, '::1', 1603693240, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 11:50:40', '0000-00-00 00:00:00'),
(97, 1, '::1', 1603695982, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 12:36:22', '0000-00-00 00:00:00'),
(98, 1, '::1', 1603696398, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 12:43:18', '0000-00-00 00:00:00'),
(99, 1, '::1', 1603707423, 1603716428, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 15:47:03', '2020-10-26 18:17:08'),
(100, 1, '::1', 1603773259, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-27 10:04:19', '0000-00-00 00:00:00'),
(101, 1, '::1', 1603774812, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-27 10:30:12', '0000-00-00 00:00:00'),
(102, 1, '::1', 1603792416, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-27 15:23:36', '0000-00-00 00:00:00'),
(103, 1, '::1', 1603794364, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-27 15:56:04', '0000-00-00 00:00:00'),
(104, 1, '::1', 1603802059, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-27 18:04:19', '0000-00-00 00:00:00'),
(105, 1, '::1', 1603802143, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-27 18:05:43', '0000-00-00 00:00:00'),
(106, 1, '::1', 1603859771, 1603861365, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-28 10:06:11', '2020-10-28 10:32:45'),
(107, 1, '::1', 1603861375, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-28 10:32:55', '0000-00-00 00:00:00'),
(108, 1, '::1', 1603868369, 1603869008, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-28 12:29:29', '2020-10-28 12:40:08'),
(109, 1, '::1', 1603869022, 1603888754, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-28 12:40:22', '2020-10-28 18:09:14'),
(110, 1, '::1', 1603945636, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-29 09:57:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `logs_sms`
--

CREATE TABLE `logs_sms` (
  `logs_sms_id` int(11) NOT NULL,
  `sms_type` tinyint(1) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `ErrorCode` tinyint(4) NOT NULL,
  `ErrorMessage` text NOT NULL,
  `JobId` varchar(100) NOT NULL,
  `MessageData` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `otp_id` int(11) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `otp_type` tinyint(1) NOT NULL,
  `created_time` datetime NOT NULL,
  `is_expired` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`otp_id`, `mobile_number`, `otp`, `otp_type`, `created_time`, `is_expired`) VALUES
(1, '7878447897', '523842', 1, '2020-10-21 15:01:54', 1),
(2, '7567204909', '125675', 1, '2020-10-23 12:15:47', 1),
(3, '7567204909', '446690', 1, '2020-10-23 13:01:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `psf_registration`
--

CREATE TABLE `psf_registration` (
  `psfregistration_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firm_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `principal_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firm_duration` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `import_from_outside` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apploication_of_firm_document` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `formII_document` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partnership_deed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aadharcard` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pancard` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `import_from_outside_ret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retirement_form` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `psf_registration`
--

INSERT INTO `psf_registration` (`psfregistration_id`, `user_id`, `firm_name`, `email`, `principal_address`, `other_address`, `firm_duration`, `import_from_outside`, `apploication_of_firm_document`, `formII_document`, `partnership_deed`, `aadharcard`, `pancard`, `import_from_outside_ret`, `retirement_form`, `signature`, `status`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `admin_registration_number`, `valid_upto`, `remarks`, `status_datetime`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 1, 'test', 'test@gmail.com', 'test', 'test', '1 year', '1', 'psfregistration_2480924111603949154.png', 'psfregistration_6987057511603949154.png', 'psfregistration_1512285151603949154.png', 'psfregistration_9222318641603949154.png', 'psfregistration_9488648731603949154.png', '1', 'psfregistration_4411534951603949236.png', 'psfregistration_9337884361603949236.png', 5, 'challan_5257726041603949300.png', '2020-10-29 10:58:20', 'fees_paid_challan_1079338761603949335.pdf', '2020-10-29 10:58:55', '123', '2020-10-29', 'ok', '2020-10-29 10:59:17', 1, '2020-10-29 10:57:53', 1, '2020-10-29 10:59:17', 0),
(2, 1, 'sdcdscd', 'demo@gmail.com', 'dd', '', '1 year', '', 'psfregistration_8114156001603949198.png', 'psfregistration_4418827091603949198.png', 'psfregistration_7294234971603949198.png', 'psfregistration_6195797581603949198.png', 'psfregistration_6402028781603949198.png', '', '', 'psfregistration_6609749431603949198.png', 6, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00', 'no', '2020-10-29 11:00:25', 1, '2020-10-29 10:57:37', 1, '2020-10-29 11:00:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sa_logs_change_password`
--

CREATE TABLE `sa_logs_change_password` (
  `sa_logs_change_password_id` bigint(20) NOT NULL,
  `sa_user_id` bigint(20) NOT NULL,
  `old_password` text NOT NULL,
  `new_password` text NOT NULL,
  `created_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sa_logs_login_details`
--

CREATE TABLE `sa_logs_login_details` (
  `sa_logs_login_details_id` bigint(20) NOT NULL,
  `sa_user_id` bigint(20) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `login_timestamp` int(11) NOT NULL,
  `logout_timestamp` int(11) NOT NULL,
  `logs_data` text NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sa_logs_login_details`
--

INSERT INTO `sa_logs_login_details` (`sa_logs_login_details_id`, `sa_user_id`, `ip_address`, `login_timestamp`, `logout_timestamp`, `logs_data`, `created_time`, `updated_time`) VALUES
(1, 1, '::1', 1599648545, 1599648974, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 16:19:05', '2020-09-09 16:26:14'),
(2, 1, '::1', 1599648981, 1599648987, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 16:26:21', '2020-09-09 16:26:27'),
(3, 2, '::1', 1599648992, 1599649007, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 16:26:32', '2020-09-09 16:26:47'),
(4, 1, '::1', 1599652357, 1599652435, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 17:22:37', '2020-09-09 17:23:55'),
(5, 2, '::1', 1599652384, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 17:23:04', '0000-00-00 00:00:00'),
(6, 1, '::1', 1599652451, 1599652454, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-09 17:24:11', '2020-09-09 17:24:14'),
(7, 1, '::1', 1599807433, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-11 12:27:13', '0000-00-00 00:00:00'),
(8, 1, '::1', 1599808891, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-11 12:51:31', '0000-00-00 00:00:00'),
(9, 1, '::1', 1599810568, 1599829097, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.83 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-11 13:19:28', '2020-09-11 18:28:17'),
(10, 1, '::1', 1599889187, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-12 11:09:47', '0000-00-00 00:00:00'),
(11, 1, '::1', 1600063402, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-14 11:33:22', '0000-00-00 00:00:00'),
(12, 1, '::1', 1600142651, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-15 09:34:11', '0000-00-00 00:00:00'),
(13, 1, '::1', 1600152309, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-15 12:15:09', '0000-00-00 00:00:00'),
(14, 1, '::1', 1600172052, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-15 17:44:12', '0000-00-00 00:00:00'),
(15, 1, '::1', 1600236750, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-16 11:42:30', '0000-00-00 00:00:00'),
(16, 1, '::1', 1600319540, 1600331227, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-17 10:42:20', '2020-09-17 13:57:07'),
(17, 1, '::1', 1600331384, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-17 13:59:44', '0000-00-00 00:00:00'),
(18, 1, '::1', 1600689835, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-21 17:33:55', '0000-00-00 00:00:00'),
(19, 1, '::1', 1600690991, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-21 17:53:11', '0000-00-00 00:00:00'),
(20, 1, '::1', 1600751963, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-22 10:49:23', '0000-00-00 00:00:00'),
(21, 1, '::1', 1600767018, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.102 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-22 15:00:18', '0000-00-00 00:00:00'),
(22, 1, '::1', 1601015099, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 11:54:59', '0000-00-00 00:00:00'),
(23, 1, '::1', 1601027677, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 15:24:37', '0000-00-00 00:00:00'),
(24, 1, '::1', 1601031256, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 16:24:16', '0000-00-00 00:00:00'),
(25, 1, '::1', 1601032057, 1601033125, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 16:37:37', '2020-09-25 16:55:25'),
(26, 1, '::1', 1601033135, 1601033212, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 16:55:35', '2020-09-25 16:56:52'),
(27, 1, '::1', 1601033700, 1601034015, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 17:05:00', '2020-09-25 17:10:15'),
(28, 1, '::1', 1601034445, 1601035370, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-25 17:17:25', '2020-09-25 17:32:50'),
(29, 1, '::1', 1601101125, 1601103808, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-26 11:48:45', '2020-09-26 12:33:28'),
(30, 1, '::1', 1601104285, 1601104943, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-26 12:41:25', '2020-09-26 12:52:23'),
(31, 1, '::1', 1601106078, 1601109931, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-26 13:11:18', '2020-09-26 14:15:31'),
(32, 1, '::1', 1601267046, 1601267130, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-09-28 09:54:06', '2020-09-28 09:55:30'),
(33, 1, '103.240.76.3', 1601961868, 1601962002, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.240.76.3\"}', '2020-10-06 10:54:28', '2020-10-06 10:56:42'),
(34, 1, '106.66.58.58', 1601966811, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"106.66.58.58\"}', '2020-10-06 12:16:51', '0000-00-00 00:00:00'),
(35, 1, '103.66.115.30', 1601968959, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.66.115.30\"}', '2020-10-06 12:52:39', '0000-00-00 00:00:00'),
(36, 1, '103.240.76.3', 1601978318, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.240.76.3\"}', '2020-10-06 15:28:38', '0000-00-00 00:00:00'),
(37, 1, '164.100.212.187', 1602156448, 1602162632, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/85.0.4183.121 Safari\\/537.36\",\"REMOTE_ADDR\":\"164.100.212.187\"}', '2020-10-08 16:57:28', '2020-10-08 18:40:32'),
(38, 1, '146.112.51.209', 1602853352, 1602853465, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"146.112.51.209\"}', '2020-10-16 18:32:32', '2020-10-16 18:34:25'),
(39, 1, '1.38.160.114', 1603195146, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"1.38.160.114\"}', '2020-10-20 17:29:06', '0000-00-00 00:00:00'),
(40, 1, '164.100.212.187', 1603198197, 1603201119, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"164.100.212.187\"}', '2020-10-20 18:19:57', '2020-10-20 19:08:39'),
(41, 1, '103.240.79.202', 1603198542, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.240.79.202\"}', '2020-10-20 18:25:42', '0000-00-00 00:00:00'),
(42, 1, '103.36.82.21', 1603198791, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"103.36.82.21\"}', '2020-10-20 18:29:51', '0000-00-00 00:00:00'),
(43, 1, '164.100.212.187', 1603259189, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.75 Safari\\/537.36\",\"REMOTE_ADDR\":\"164.100.212.187\"}', '2020-10-21 11:16:29', '0000-00-00 00:00:00'),
(44, 1, '::1', 1603432057, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 11:17:37', '0000-00-00 00:00:00'),
(45, 1, '::1', 1603439196, 1603440012, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 13:16:36', '2020-10-23 13:30:12'),
(46, 1, '::1', 1603445211, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 14:56:51', '0000-00-00 00:00:00'),
(47, 1, '::1', 1603446006, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 15:10:06', '0000-00-00 00:00:00'),
(48, 1, '::1', 1603448858, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 15:57:38', '0000-00-00 00:00:00'),
(49, 1, '::1', 1603449679, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 16:11:19', '0000-00-00 00:00:00'),
(50, 1, '::1', 1603449867, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 16:14:27', '0000-00-00 00:00:00'),
(51, 1, '::1', 1603450088, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 16:18:08', '0000-00-00 00:00:00'),
(52, 1, '::1', 1603451616, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 16:43:36', '0000-00-00 00:00:00'),
(53, 1, '::1', 1603451759, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 16:45:59', '0000-00-00 00:00:00'),
(54, 1, '::1', 1603453139, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 17:08:59', '0000-00-00 00:00:00'),
(55, 1, '::1', 1603453264, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 17:11:04', '0000-00-00 00:00:00'),
(56, 1, '::1', 1603454971, 1603457064, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-23 17:39:31', '2020-10-23 18:14:24'),
(57, 1, '::1', 1603516360, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-24 10:42:40', '0000-00-00 00:00:00'),
(58, 1, '::1', 1603687569, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 10:16:09', '0000-00-00 00:00:00'),
(59, 1, '::1', 1603694058, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 12:04:18', '0000-00-00 00:00:00'),
(60, 1, '::1', 1603696113, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-26 12:38:33', '0000-00-00 00:00:00'),
(61, 1, '::1', 1603793968, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-27 15:49:28', '0000-00-00 00:00:00'),
(62, 1, '::1', 1603794579, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-27 15:59:39', '0000-00-00 00:00:00'),
(63, 1, '::1', 1603802081, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-27 18:04:41', '0000-00-00 00:00:00'),
(64, 1, '::1', 1603802211, 1603802249, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-27 18:06:51', '2020-10-27 18:07:29'),
(65, 1, '::1', 1603859785, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-28 10:06:25', '0000-00-00 00:00:00'),
(66, 1, '::1', 1603885731, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-28 17:18:51', '0000-00-00 00:00:00'),
(67, 1, '::1', 1603945622, 0, '{\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/86.0.4240.111 Safari\\/537.36\",\"REMOTE_ADDR\":\"::1\"}', '2020-10-29 09:57:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sa_users`
--

CREATE TABLE `sa_users` (
  `sa_user_id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `is_deactive` tinyint(1) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sa_users`
--

INSERT INTO `sa_users` (`sa_user_id`, `name`, `username`, `password`, `user_type`, `district`, `is_deactive`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 'Admin', 'admin', 'f6e1823488b1bd4e72127c4b3005cf0862396666366436393539326636656236353437636264623065383461323334653363316339653864303632666264613634333965346439623931383036366334400b37037b94f4452462', 1, 0, 0, 1, '2020-03-25 17:20:00', 1, '2020-09-02 10:38:55', 0),
(2, 'Labour Dept. Daman', 'labour.daman', '60b4146f3f0e97ee65b449db8804357065623639336461313831386434623336303066313363343837656535313437666233303337363135613861373765336130383339346163633738653864633038041c2cdd9127b548df70', 2, 1, 0, 1, '2020-08-28 13:44:06', 1, '2020-09-09 16:22:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sa_user_type`
--

CREATE TABLE `sa_user_type` (
  `sa_user_type_id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sa_user_type`
--

INSERT INTO `sa_user_type` (`sa_user_type_id`, `type`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 'Admin', 1, '2020-03-25 13:54:00', 0, '0000-00-00 00:00:00', 0),
(2, 'Labour Department', 1, '2020-08-28 11:28:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `applicant_name` varchar(100) NOT NULL,
  `applicant_address` varchar(200) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `pin` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_verify_mobile` tinyint(1) NOT NULL,
  `verify_mobile_datetime` datetime NOT NULL,
  `is_verify_email` tinyint(1) NOT NULL,
  `verify_email_datetime` datetime NOT NULL,
  `temp_access_token` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `applicant_name`, `applicant_address`, `mobile_number`, `pin`, `email`, `is_verify_mobile`, `verify_mobile_datetime`, `is_verify_email`, `verify_email_datetime`, `temp_access_token`, `is_active`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 'Prilantee Patel', 'Daman', '7567204909', '3e72abc4de48ae11abe76da49be85ba1333136653864316534623439346465653063396665383634383932303831633338323236633630663561386166363761653063636363306261396635383463626c2872c06126', 'prilanteepatel1090@gmail.com', 1, '2020-10-23 13:02:48', 1, '2020-10-23 13:01:37', '', 1, 0, '2020-10-23 13:01:19', 1, '2020-10-23 13:02:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wc`
--

CREATE TABLE `wc` (
  `wc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `house_no` varchar(100) NOT NULL,
  `ward_no` varchar(100) NOT NULL,
  `village` varchar(100) NOT NULL,
  `panchayat_or_dmc` varchar(100) NOT NULL,
  `application_category` varchar(100) NOT NULL,
  `receipt_of_last_years_house_tax` varchar(100) NOT NULL,
  `house_ownership` varchar(100) NOT NULL,
  `wc_type` varchar(100) NOT NULL,
  `diameter_service_connection` varchar(100) NOT NULL,
  `water_meter` varchar(100) NOT NULL,
  `id_proof` varchar(100) NOT NULL,
  `electricity_bill` varchar(100) NOT NULL,
  `declaration` tinyint(1) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `challan` varchar(100) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(100) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc`
--

INSERT INTO `wc` (`wc_id`, `user_id`, `name_of_applicant`, `house_no`, `ward_no`, `village`, `panchayat_or_dmc`, `application_category`, `receipt_of_last_years_house_tax`, `house_ownership`, `wc_type`, `diameter_service_connection`, `water_meter`, `id_proof`, `electricity_bill`, `declaration`, `signature`, `status`, `status_datetime`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `registration_number`, `valid_upto`, `remarks`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 2, 'Chhaya Yadav', '223', '3', 'Daman', 'DMC', 'New', 'wc_2823308031601966546.png', 'Own', 'Own', 'Yes1', '1024554545', 'wc_4064597011601966546.png', 'wc_6729407651601966546.png', 1, 'wc_6611995321601966666.png', 5, '2020-10-06 12:43:20', 'challan_9999137131601967850.png', '2020-10-06 12:34:10', 'fees_paid_challan_6006706091601968212.png', '2020-10-06 12:40:12', '148578787', '2020-10-06', 'ok', 1, '2020-10-06 12:29:06', 1, '2020-10-06 12:43:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wm_dealer`
--

CREATE TABLE `wm_dealer` (
  `dealer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_dealer` varchar(255) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `dealer_license_no` varchar(255) NOT NULL,
  `establishment_date` date NOT NULL,
  `is_limited_company` int(11) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_date` date NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `categories_sold` varchar(255) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(255) NOT NULL,
  `any_previous_application` varchar(255) NOT NULL,
  `license_application_date` varchar(255) NOT NULL,
  `license_application_result` varchar(255) NOT NULL,
  `import_from_outside` varchar(255) NOT NULL,
  `registration_of_importer` varchar(255) NOT NULL,
  `date_of_application` date NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `signature` varchar(255) NOT NULL,
  `import_model` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wm_dealer`
--

INSERT INTO `wm_dealer` (`dealer_id`, `user_id`, `name_of_dealer`, `complete_address`, `dealer_license_no`, `establishment_date`, `is_limited_company`, `proprietor_details`, `registration_date`, `registration_number`, `categories_sold`, `identity_choice`, `identity_number`, `any_previous_application`, `license_application_date`, `license_application_result`, `import_from_outside`, `registration_of_importer`, `date_of_application`, `status`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `admin_registration_number`, `valid_upto`, `remarks`, `status_datetime`, `signature`, `import_model`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 2, 'test', 'test', '', '2020-10-06', 1, '[{\"occupier_name\":\"jhkjh\",\"address\":\"jkjj\"}]', '2020-10-06', '5666', 'test', 2, '15465', '1', '2020-10-06', 'khk', '1', 'jhkjhjk', '0000-00-00', 5, 'challan_9426309911601977695.jpg', '2020-10-06 15:18:15', 'fees_paid_challan_3473941331601977740.jpg', '2020-10-06 15:19:00', '56768', '2020-10-06', 'm,nkj', '2020-10-06 15:19:33', 'dealer_9747195801601977428.png', 'dealer_6286739551601977428.jpg', 2, '2020-10-06 15:14:34', 1, '2020-10-06 15:19:33', 0),
(2, 1, 'Demo', 'DD', '', '2020-10-24', 1, '[{\"occupier_name\":\"Vijeta\",\"address\":\"Nani Daman\"}]', '2020-10-24', '1234', 'xyz', 1, '123', '1', '2015-01-05', 'null', '1', '123', '0000-00-00', 5, 'challan_3260615931603520815.pdf', '2020-10-24 11:56:55', 'fees_paid_challan_5643358791603520832.pdf', '2020-10-24 11:57:12', '123', '2022-08-24', 'ok', '2020-10-24 11:58:44', 'dealer_3339361601603520662.png', 'dealer_3288119821603520662.pdf', 1, '2020-10-24 11:54:52', 1, '2020-10-24 11:58:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wm_manufacturer`
--

CREATE TABLE `wm_manufacturer` (
  `manufacturer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_manufacturer` varchar(255) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `premises_status` int(11) NOT NULL,
  `establishment_date` date NOT NULL,
  `is_limited_company` int(11) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_date` date NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `manufacturing_activity` varchar(255) NOT NULL,
  `weights_type` varchar(255) NOT NULL,
  `measures_type` varchar(255) NOT NULL,
  `weighing_instruments_type` varchar(255) NOT NULL,
  `measuring_instruments_type` varchar(255) NOT NULL,
  `no_of_skilled` int(11) NOT NULL,
  `no_of_semiskilled` int(11) NOT NULL,
  `no_of_unskilled` int(11) NOT NULL,
  `no_of_specialist` int(11) NOT NULL,
  `details_of_personnel` varchar(255) NOT NULL,
  `details_of_machinery` varchar(255) NOT NULL,
  `details_of_foundry` varchar(255) NOT NULL,
  `steel_casting_facility` varchar(255) NOT NULL,
  `electric_energy_availability` varchar(255) NOT NULL,
  `details_of_loan` varchar(255) NOT NULL,
  `banker_names` varchar(255) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(255) NOT NULL,
  `any_previous_application` varchar(255) NOT NULL,
  `license_application_date` date NOT NULL,
  `license_application_result` varchar(255) NOT NULL,
  `location_of_selling` varchar(255) NOT NULL,
  `model_approval_detail` varchar(255) NOT NULL,
  `inspection_sample_date` date NOT NULL,
  `date_of_application` date NOT NULL,
  `signature` varchar(255) NOT NULL,
  `support_document` varchar(255) NOT NULL,
  `monogram_uploader` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wm_manufacturer`
--

INSERT INTO `wm_manufacturer` (`manufacturer_id`, `user_id`, `name_of_manufacturer`, `complete_address`, `premises_status`, `establishment_date`, `is_limited_company`, `proprietor_details`, `registration_date`, `registration_number`, `manufacturing_activity`, `weights_type`, `measures_type`, `weighing_instruments_type`, `measuring_instruments_type`, `no_of_skilled`, `no_of_semiskilled`, `no_of_unskilled`, `no_of_specialist`, `details_of_personnel`, `details_of_machinery`, `details_of_foundry`, `steel_casting_facility`, `electric_energy_availability`, `details_of_loan`, `banker_names`, `identity_choice`, `identity_number`, `any_previous_application`, `license_application_date`, `license_application_result`, `location_of_selling`, `model_approval_detail`, `inspection_sample_date`, `date_of_application`, `signature`, `support_document`, `monogram_uploader`, `status`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `admin_registration_number`, `valid_upto`, `remarks`, `status_datetime`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 2, 'test', 'test', 1, '2020-10-06', 1, '[{\"occupier_name\":\"jkhkj\",\"father_name\":\"gjkgkj\",\"address\":\"jkg\"}]', '2020-10-06', '86798', 'm,jhjkh', 'kjhkjhkjh', 'kjhk', 'hk', 'hk', 545, 45, 5, 555, 'm,hkjhk', '.khk', 'hkj', 'gkjg', 'kj', 'gkj', 'gkj', 2, 'kjg', '', '0000-00-00', '', '2', 'gkj', '2020-10-06', '0000-00-00', 'manufacturer_5327929591601979999.png', 'manufacturer_9162698831601979999.jpg', 'manufacturer_1443410961601979999.jpg', 2, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 1, '2020-10-06 16:06:52', 1, '2020-10-06 16:06:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wm_registration`
--

CREATE TABLE `wm_registration` (
  `wmregistration_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(255) NOT NULL,
  `application_category` varchar(255) NOT NULL,
  `branches` varchar(255) NOT NULL,
  `location_of_factory` varchar(255) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `signature` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wm_registration`
--

INSERT INTO `wm_registration` (`wmregistration_id`, `user_id`, `name_of_applicant`, `application_category`, `branches`, `location_of_factory`, `proprietor_details`, `signature`, `status`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `admin_registration_number`, `valid_upto`, `remarks`, `status_datetime`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 2, 'test', 'Packed', 'test', 'htest', '[{\"occupier_name\":\"test\",\"father_name\":\"test\",\"address\":\"test\"}]', 'wmregistration_6024258371601968881.png', 5, 'challan_4374493651601970162.jpg', '2020-10-06 13:12:42', 'fees_paid_challan_1495681101601970573.jpg', '2020-10-06 13:19:33', '456123', '2020-10-06', 'jgj', '2020-10-06 13:20:01', 1, '2020-10-06 13:08:33', 1, '2020-10-06 13:20:01', 0),
(2, 1, 'Priya Patel', 'Manufactured', 'Daman', 'Fort Area, Moti Daman', '[{\"occupier_name\":\"Vijeta\",\"father_name\":\"Kepalkumar\",\"address\":\"Nani Daman\"}]', 'wmregistration_9387024531603448603.pdf', 6, 'challan_1438670891603448941.pdf', '2020-10-23 15:59:01', '', '0000-00-00 00:00:00', '', '0000-00-00', 'Form is not valid', '2020-10-23 16:04:57', 1, '2020-10-23 15:54:02', 1, '2020-10-23 16:04:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wm_repairer`
--

CREATE TABLE `wm_repairer` (
  `repairer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_repairer` varchar(255) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `premises_status` int(11) NOT NULL,
  `establishment_date` date NOT NULL,
  `is_limited_company` tinyint(4) NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_date` date NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `identity_choice` int(11) NOT NULL,
  `identity_number` varchar(255) NOT NULL,
  `weights_type` varchar(255) NOT NULL,
  `area_operate` varchar(255) NOT NULL,
  `previous_experience` varchar(255) NOT NULL,
  `no_of_skilled` int(11) NOT NULL,
  `no_of_semiskilled` int(11) NOT NULL,
  `no_of_unskilled` int(11) NOT NULL,
  `no_of_specialist` int(11) NOT NULL,
  `details_of_personnel` varchar(255) NOT NULL,
  `details_of_machinery` varchar(255) NOT NULL,
  `electric_energy_availability` varchar(255) NOT NULL,
  `sufficient_stock` varchar(255) NOT NULL,
  `stock_details` varchar(255) NOT NULL,
  `any_previous_application` varchar(255) NOT NULL,
  `license_application_date` varchar(255) NOT NULL,
  `license_application_result` varchar(255) NOT NULL,
  `date_of_application` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `signature` varchar(255) NOT NULL,
  `support_document` varchar(255) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wm_repairer`
--

INSERT INTO `wm_repairer` (`repairer_id`, `user_id`, `name_of_repairer`, `complete_address`, `premises_status`, `establishment_date`, `is_limited_company`, `proprietor_details`, `registration_date`, `registration_number`, `identity_choice`, `identity_number`, `weights_type`, `area_operate`, `previous_experience`, `no_of_skilled`, `no_of_semiskilled`, `no_of_unskilled`, `no_of_specialist`, `details_of_personnel`, `details_of_machinery`, `electric_energy_availability`, `sufficient_stock`, `stock_details`, `any_previous_application`, `license_application_date`, `license_application_result`, `date_of_application`, `status`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `admin_registration_number`, `valid_upto`, `remarks`, `status_datetime`, `signature`, `support_document`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 2, 'test', 'test', 2, '2020-10-06', 1, '[{\"occupier_name\":\"mjgkj\",\"father_name\":\"gkjgkj\",\"address\":\"gkjgkj\"}]', '2020-10-06', '455662', 2, '87879', 'jgjh', 'gjgjhgjh', 'gjhgjhgjhghj', 78, 785, 455, 455, '455', '54', 'hjgjh', '1', 'test', '1', '2020-10-06', 'test', '0000-00-00', 5, 'challan_4290118801601970882.jpg', '2020-10-06 13:24:42', 'fees_paid_challan_9408909441601970909.jpg', '2020-10-06 13:25:09', '58\\8\\9', '2020-10-06', 'mnjbjh', '2020-10-06 13:25:30', 'repairer_8834822471601970791.png', 'repairer_5211279111601970791.jpg', 1, '2020-10-06 13:24:22', 1, '2020-10-06 13:25:30', 0),
(2, 1, 'Priya', 'Daman', 1, '2020-10-23', 0, NULL, '2020-10-23', '1234', 1, '123', 'xyz', 'Moti Daman', '-', 10, 1, 1, 2, 'null', 'null', 'null', '', '', '', '23-10-2020', '', '0000-00-00', 4, 'challan_5121554851603453202.pdf', '2020-10-23 17:10:02', 'fees_paid_challan_2876235821603453246.pdf', '2020-10-23 17:10:46', '', '0000-00-00', '', '0000-00-00 00:00:00', 'repairer_3613364381603453118.pdf', 'repairer_4992767891603453118.pdf', 1, '2020-10-23 17:08:38', 1, '2020-10-23 17:10:46', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`cinema_id`);

--
-- Indexes for table `lbe_master`
--
ALTER TABLE `lbe_master`
  ADD PRIMARY KEY (`lbe_id`);

--
-- Indexes for table `logs_change_pin`
--
ALTER TABLE `logs_change_pin`
  ADD PRIMARY KEY (`logs_change_pin_id`);

--
-- Indexes for table `logs_email`
--
ALTER TABLE `logs_email`
  ADD PRIMARY KEY (`email_log_id`);

--
-- Indexes for table `logs_login_details`
--
ALTER TABLE `logs_login_details`
  ADD PRIMARY KEY (`logs_login_details_id`);

--
-- Indexes for table `logs_sms`
--
ALTER TABLE `logs_sms`
  ADD PRIMARY KEY (`logs_sms_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `psf_registration`
--
ALTER TABLE `psf_registration`
  ADD PRIMARY KEY (`psfregistration_id`);

--
-- Indexes for table `sa_logs_change_password`
--
ALTER TABLE `sa_logs_change_password`
  ADD PRIMARY KEY (`sa_logs_change_password_id`);

--
-- Indexes for table `sa_logs_login_details`
--
ALTER TABLE `sa_logs_login_details`
  ADD PRIMARY KEY (`sa_logs_login_details_id`);

--
-- Indexes for table `sa_users`
--
ALTER TABLE `sa_users`
  ADD PRIMARY KEY (`sa_user_id`);

--
-- Indexes for table `sa_user_type`
--
ALTER TABLE `sa_user_type`
  ADD PRIMARY KEY (`sa_user_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wc`
--
ALTER TABLE `wc`
  ADD PRIMARY KEY (`wc_id`);

--
-- Indexes for table `wm_dealer`
--
ALTER TABLE `wm_dealer`
  ADD PRIMARY KEY (`dealer_id`);

--
-- Indexes for table `wm_manufacturer`
--
ALTER TABLE `wm_manufacturer`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `wm_registration`
--
ALTER TABLE `wm_registration`
  ADD PRIMARY KEY (`wmregistration_id`);

--
-- Indexes for table `wm_repairer`
--
ALTER TABLE `wm_repairer`
  ADD PRIMARY KEY (`repairer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cinema`
--
ALTER TABLE `cinema`
  MODIFY `cinema_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lbe_master`
--
ALTER TABLE `lbe_master`
  MODIFY `lbe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `logs_change_pin`
--
ALTER TABLE `logs_change_pin`
  MODIFY `logs_change_pin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logs_email`
--
ALTER TABLE `logs_email`
  MODIFY `email_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `logs_login_details`
--
ALTER TABLE `logs_login_details`
  MODIFY `logs_login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `logs_sms`
--
ALTER TABLE `logs_sms`
  MODIFY `logs_sms_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `psf_registration`
--
ALTER TABLE `psf_registration`
  MODIFY `psfregistration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sa_logs_change_password`
--
ALTER TABLE `sa_logs_change_password`
  MODIFY `sa_logs_change_password_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sa_logs_login_details`
--
ALTER TABLE `sa_logs_login_details`
  MODIFY `sa_logs_login_details_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `sa_users`
--
ALTER TABLE `sa_users`
  MODIFY `sa_user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sa_user_type`
--
ALTER TABLE `sa_user_type`
  MODIFY `sa_user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wc`
--
ALTER TABLE `wc`
  MODIFY `wc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wm_dealer`
--
ALTER TABLE `wm_dealer`
  MODIFY `dealer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wm_manufacturer`
--
ALTER TABLE `wm_manufacturer`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wm_registration`
--
ALTER TABLE `wm_registration`
  MODIFY `wmregistration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wm_repairer`
--
ALTER TABLE `wm_repairer`
  MODIFY `repairer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

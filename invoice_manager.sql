-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 02, 2022 at 10:22 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Greenspring Schools', 'ict.anthony@greenspringsschool.com', '+234 908 717 1700', 'Greensprings School,<br />\r\n32, Olatunde Ayoola Avenue,<br />\r\nAnthony,<br />\r\nLagos, Nigeria<br />\r\nP O Box 4801K Ikeja Headquarters, Ikeja, Lagos', '2017-04-25 14:11:48', '2017-04-25 14:11:48'),
(2, 'Oyo State Government', 'ict@oyostate.gov.ng', '08030986193', 'MIC Building , Governor\'s Office, Oyo State Government Secretariat, Agodi, Ibadan.', '2017-04-26 16:04:53', '2017-04-26 16:04:53'),
(3, 'Sao Associates', 'saosamuel@yahoo.co.uk', '08033138695', 'G85, Igosun Road<br />\r\nOff Galadima Road,<br />\r\nUngwan Sunday,<br />\r\nKaduna South,<br />\r\nKaduna State,<br />\r\nNigeria', '2017-05-15 03:45:34', '2017-05-15 03:45:34'),
(4, 'NIFES LAUTECH Alumni Association ', 'dearnifes@yahoo.com', '', '', '2017-05-17 00:11:00', '2017-05-17 00:11:00'),
(5, 'SquareStudio', 'sojiolotu@yahoo.com', '08036300553 ', 'H371, Ikota Shopping Complex,<br />\r\nAjah, Lagos', '2017-05-17 01:05:52', '2017-05-17 01:05:52'),
(6, 'LEM Contracting ', 'o.dada@lambertelectromec.com', '', '', '2017-05-18 22:03:45', '2017-07-14 21:31:32'),
(8, 'Quickfix Repairs', 'gboye.abiosun@quickfixrepairs.com', '08066251776', '', '2017-07-07 17:45:08', '2017-07-07 17:45:08'),
(9, 'Outnet Limited', 'outnetltd@gmail.com', '08171926857', '', '2017-07-26 02:39:51', '2017-07-26 02:40:44'),
(10, 'Mrs. Jumoke Bankole', 'temi_f@yahoo.com', '08155575886', '', '2017-08-02 12:51:53', '2017-08-02 12:51:53'),
(11, 'Jesom Technologies Limited', 'segun@jesomtech.com', '08122588493', '', '2017-08-08 18:02:00', '2017-08-08 18:02:00'),
(12, 'Oyo State Operation Coordinating Unit (OYSOCU)', 'socu.oyostate@gmail.com', '09034843009', 'Oyo State Operation Coordinating Unit, Quater 847, Opposite Association of Family  & Reproductive Health (ARFH), Ikolaba, Agodi GRA, Ibadan.', '2017-08-31 16:53:48', '2017-08-31 16:53:48'),
(13, 'Ministry of Youth and Sports (Oyo State Government)', 'yakins66@yahoo.com', '', '', '2017-09-12 23:27:34', '2017-09-12 23:27:34'),
(14, 'Ministry of Youth and Sports (Oyo State Government)', 'abayomi.oke@oyostate.gov.ng', '08066868666', 'Ministry of Youth and Sports, Oyo State Government Secretariat Agodi, Ibadan.', '2017-09-12 23:43:40', '2017-09-12 23:43:40'),
(15, 'Barnawa Baptist Church', 'saosamuel@saoassociates.org', '', '', '2017-10-05 14:03:57', '2017-10-05 14:03:57'),
(16, 'Prof. Oluwasegun Adetokunbo Adekunle (SA Agric)', 'oluwasegun.adekunle@oyostate.gov.ng', '', 'Ministry of Agriculture, Natural Resources & Rural Development<br />\r\nOyo State Secretariat Ibadan', '2017-10-05 16:48:29', '2017-10-05 16:48:29'),
(17, 'Routelink', 'brian@routelinksys.com', '07012929148', '', '2017-10-12 19:14:51', '2017-10-12 19:14:51'),
(18, 'Salvic', 'salvic@salvic.com', '080', '', '2017-10-28 18:12:49', '2017-10-28 18:12:49'),
(19, 'Crosswalk', 'crosswalkng@yahooo.com', '', '', '2017-11-01 20:33:03', '2017-11-01 20:33:03'),
(21, 'Office Everything', 'kingnpalace@gmail.com', '', '', '2017-12-13 16:03:57', '2017-12-13 16:03:57'),
(22, 'BAYSHORE TECHNOLOGIES', 'omotoyosijames@gmail.com', '08092298029', '274 AJOSE ADEOGUN, VIVTORIA ISLAND LAGOS', '2017-12-19 00:13:21', '2017-12-19 00:13:21'),
(23, 'Agency for Youth Development', 'sumbosango2013@yahoo.com', '08062953396', 'Ground Floor, Ministry of Finance Building, Secretariat Ibadan.', '2018-01-09 23:14:11', '2018-01-09 23:14:11'),
(24, 'Idofel Technologies Ltd', 'info@idofeltechnologiesltd.com', '', '', '2018-01-19 21:33:35', '2018-01-19 21:46:28'),
(25, 'Lighthouse Baptist Church ', 'lamideh@hotmail.com', '', '', '2018-02-10 20:35:19', '2018-02-10 20:35:19'),
(26, 'OYO SOCU', 'socu.oyostate@gmsil.com', '08071015244', 'Room 110, Ministry of Establishment, Oyo State Government Ibadan', '2021-04-08 07:24:36', '2021-04-08 07:24:36'),
(27, 'Mustard Capital Ltd', 'aolumide@mustardcapltd.com', '+234 805 650 1269', '', '2021-04-27 07:54:58', '2021-04-27 07:54:58'),
(28, 'SCS', 'paolof.scs@gmail.com', '09061237153', '', '2021-05-06 08:59:01', '2021-05-06 08:59:01'),
(29, 'Daleji properties', 'daleji@yahoo.com', '080', 'Titanium Building', '2021-05-06 10:29:16', '2021-05-06 10:29:16'),
(30, 'OEPS', 'theresa.ike@oeps.net', '080', '', '2021-06-07 13:35:52', '2021-06-07 13:35:52'),
(31, 'Mr. Ade', 'adedehin1@gmail.com', '080', '', '2021-07-23 10:28:21', '2021-07-23 10:28:21'),
(32, 'New Heights Baptist Church', 'media@nhbc-ng.com', '080', '', '2021-07-27 22:35:24', '2021-07-27 22:35:24'),
(33, 'Mr. Emmanuel - Home', 'customer@customer.com', '080', '', '2022-06-27 09:57:55', '2022-06-27 09:57:55'),
(34, 'Global Oceon', 'customer@customer.com', '07062022188', '', '2022-07-01 14:18:06', '2022-07-01 14:18:06'),
(35, 'Lambert - GTB Ikate', 'R.aboumrad@Lambertelectromec.com', '+234 906 280 8764', '', '2022-07-05 22:31:13', '2022-07-05 22:31:13'),
(37, 'Quickfix', 'gbenga.kehinde@quickfixrepairs.com', '+234 802 354 7251', '', '2022-07-12 21:00:06', '2022-07-12 21:00:06'),
(38, 'Makon Engineering', 'customer@customer.com', '08129451845', '', '2022-07-19 06:51:28', '2022-07-19 06:51:28'),
(39, 'Panek Global', 'sales@panekglobal.org', '080', '', '2022-09-25 18:07:14', '2022-09-25 18:07:14'),
(40, 'Lagos Bus Service Limited', 'orevaoghene.pius@lbsl.ng', '080', '', '2022-10-20 10:04:55', '2022-10-20 10:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `po` text COLLATE utf8_unicode_ci,
  `usepo` int(11) DEFAULT NULL,
  `paid` smallint(6) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `d_type` int(11) DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `vat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_invoice_id_unique` (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_id`, `amount`, `po`, `usepo`, `paid`, `created_by`, `client_id`, `due_date`, `created_at`, `updated_at`, `discount`, `d_type`, `title`, `vat`) VALUES
(1, '#1010170425', 30000, NULL, NULL, 0, 1, 1, '2017-05-25', '2017-04-25 14:13:51', '2017-04-25 14:13:51', 0, 0, '', NULL),
(2, '#2020170426', 147000, NULL, NULL, 1, 2, 2, '2017-05-03', '2017-04-26 16:09:08', '2017-04-26 17:43:22', 0, 0, '', NULL),
(3, '#3020170426', 155400, NULL, NULL, 0, 2, 2, '2017-06-12', '2017-04-26 20:52:39', '2017-08-16 19:23:04', 0, 0, 'OYSAI Website', NULL),
(4, '#4030170514', 20000, NULL, NULL, 0, 1, 3, '2017-06-15', '2017-05-15 03:47:05', '2017-05-15 03:48:08', 0, 0, '', NULL),
(5, '#5040170516', 20000, NULL, NULL, 1, 1, 4, '2017-06-12', '2017-05-17 00:13:53', '2017-05-17 00:22:05', 0, 0, '', NULL),
(6, '#6050170517', 90000, NULL, NULL, 0, 1, 5, '2017-05-18', '2017-05-18 01:21:27', '2017-05-18 01:21:27', 0, 0, '', NULL),
(8, '#8060170518', 44000, NULL, NULL, 0, 1, 6, '2017-05-19', '2017-05-19 04:02:10', '2017-05-19 04:02:10', 0, 0, '', NULL),
(13, '#1308017077', 50000, NULL, NULL, 0, 1, 8, '2017-07-07', '2017-07-07 17:49:16', '2017-07-07 17:49:16', 0, 0, 'Electric Fence Maintenance', NULL),
(14, '#14060170714', 245000, NULL, NULL, 0, 1, 6, '2017-07-21', '2017-07-14 21:37:32', '2017-07-14 21:37:32', 0, 0, 'Replacement of 4 Lines on GTB Electric Fence', NULL),
(15, '#15080170721', 90000, NULL, NULL, 0, 1, 8, '2017-08-21', '2017-07-21 15:18:56', '2017-07-21 15:18:56', 0, 0, 'Preventive Maintenance on Electric Fence', NULL),
(16, '#16090170725', 25000, NULL, NULL, -1, 1, 9, '2017-08-09', '2017-07-26 03:39:31', '2017-07-26 03:41:06', 0, 0, 'Company Profile', NULL),
(17, '#17010017082', 227000, NULL, NULL, 0, 1, 10, '2017-09-02', '2017-08-02 12:55:47', '2017-08-02 12:55:47', 0, 0, 'CCTV Installation', NULL),
(18, '#1801017087', 50000, NULL, NULL, 0, 1, 1, '2017-09-07', '2017-08-07 15:52:53', '2017-08-07 16:16:27', 0, 0, 'Access Control System', NULL),
(19, '#19011017088', 25000, NULL, NULL, 1, 1, 11, '2017-08-15', '2017-08-08 18:05:02', '2017-08-09 22:53:30', 0, 0, 'Email Solution and Renewal of Domain name/Hosting Plan', NULL),
(20, '#20011017089', 25000, NULL, NULL, 1, 1, 11, '2017-08-14', '2017-08-09 22:57:49', '2017-08-09 22:58:16', 0, 0, 'Domain name and webhost Renewal For Jesomtech.com', NULL),
(21, '#21020170816', 89250, NULL, NULL, 0, 2, 2, '2017-08-15', '2017-08-16 19:25:53', '2017-08-16 19:25:53', 0, 0, 'OYSAI Website', NULL),
(22, '#220100170824', 316000, NULL, NULL, 0, 1, 10, '2017-09-24', '2017-08-24 18:36:18', '2017-08-24 18:36:18', 0, 0, 'CCTV System', NULL),
(23, '#230120170831', 70100, NULL, NULL, 0, 2, 12, '2017-08-10', '2017-08-31 17:03:59', '2017-08-31 17:17:28', 0, 0, 'HouseHold ID Card Printing', NULL),
(24, '#240130170912', 250000, NULL, NULL, 0, 2, 14, '2017-09-13', '2017-09-12 23:32:17', '2017-09-13 21:56:49', 0, 1, 'Procurement of Desktop Computer System', NULL),
(25, '#25080170929', 10000, NULL, NULL, 1, 1, 8, '2017-09-29', '2017-09-29 19:15:10', '2017-09-29 19:15:24', 0, 0, 'Electric Fence Maintenance', NULL),
(26, '#2605017105', 25000, NULL, NULL, 0, 1, 5, '2017-10-18', '2017-10-05 14:01:06', '2017-10-05 14:01:30', 0, 0, 'Website Renewal', NULL),
(27, '#2701017105', 25000, NULL, NULL, 0, 1, 15, '2017-11-01', '2017-10-05 14:06:28', '2017-10-05 14:07:56', 0, 0, 'Website Renewal', NULL),
(28, '#28016017105', 160000, NULL, NULL, 0, 2, 16, '2017-09-13', '2017-10-05 16:51:37', '2017-10-05 16:59:01', 0, 1, 'Printing of Banners', NULL),
(29, '#290170171012', 1250000, NULL, NULL, -1, 1, 17, '2017-11-13', '2017-10-12 19:22:00', '2017-11-20 01:15:07', 0, 0, 'CCTV Installation for Inlaks', NULL),
(30, '#300170171018', 280900, NULL, NULL, 0, 1, 17, '2017-11-18', '2017-10-18 15:57:30', '2019-12-08 17:38:03', 0, 0, 'ZK Teco Access Control with Biometric Readers', NULL),
(31, '#310170171018', 281400, NULL, NULL, 0, 1, 17, '2017-11-18', '2017-10-18 16:04:54', '2017-10-18 16:04:54', 0, 0, 'ZK Teco Access Control with Card Reader', NULL),
(32, '#320170171018', 926760, NULL, NULL, 0, 1, 17, '2017-11-18', '2017-10-18 16:11:37', '2020-02-26 14:24:24', 0, 0, 'Suprema Biometric Access Control', 46338),
(38, '#3805017126', 40000, NULL, NULL, 0, 1, 5, '2018-01-05', '2017-12-06 16:09:34', '2017-12-06 16:09:34', 0, 0, 'Internet Connectivity For CCTV', NULL),
(41, '#410220171219', 1200000, NULL, NULL, 0, 2, 22, '2018-01-24', '2017-12-19 20:24:47', '2017-12-20 00:23:44', 0, 0, 'Coorperate Social Media Compaign', NULL),
(44, '#4408018022', 7000, NULL, NULL, 0, 1, 8, '2018-02-02', '2018-02-02 16:29:49', '2018-02-02 16:29:49', 0, 0, 'Electric Fence', NULL),
(45, '#45-8-190824', 408000, NULL, NULL, -1, 1, 8, '2019-09-24', '2019-08-24 00:58:14', '2020-02-01 13:41:41', NULL, NULL, 'Wireless Camera Solution', NULL),
(47, '#47-1-191117', 1773000, NULL, NULL, 1, 1, 1, '2019-11-23', '2019-11-16 23:55:55', '2019-11-17 00:16:05', NULL, NULL, 'Test with Title and useas', NULL),
(48, '#48-1-191123', 9237570, 'GS12098', 1, 1, 1, 1, NULL, '2019-11-23 20:39:17', '2020-02-01 16:15:16', NULL, NULL, 'Panek Global (GS12098)', NULL),
(49, '5049', 353000, 'JB1029920', 0, 1, 1, 10, '2020-02-13', '2020-02-01 17:41:02', '2021-04-08 07:12:00', NULL, NULL, 'Checking Service Unit Item (JB1029920) (JB1029920) (JB1029920) (JB1029920) (JB1029920)', NULL),
(50, '5050', 75000, NULL, NULL, NULL, 1, 26, '2021-04-03', '2021-04-08 07:31:01', '2021-04-08 07:31:01', NULL, NULL, 'Purchase of Bulk SMS units', 0),
(51, '5051', 326700, NULL, NULL, NULL, 1, 27, '2021-04-30', '2021-04-27 08:16:02', '2021-04-27 08:16:02', NULL, NULL, 'Upgrade Options: Google Workspace Business Starter', 0),
(52, '5052', 20000, NULL, NULL, NULL, 1, 28, '2021-05-10', '2021-05-06 09:00:21', '2021-05-06 09:00:21', NULL, NULL, 'Villa Adeola - Electric Fence Callout', 0),
(53, '5053', 600000, 'TY7809', NULL, 1, 1, 29, NULL, '2021-05-06 10:36:24', '2021-09-14 21:03:55', NULL, NULL, 'Fire Alarm Maintenance', 0),
(54, '5054', 10000, NULL, NULL, NULL, 1, 30, '2021-04-30', '2021-06-07 13:37:28', '2021-06-07 13:37:28', NULL, NULL, 'Callout - LAN Maintenance', 0),
(55, '5055', 42000, NULL, NULL, NULL, 1, 11, '2021-07-29', '2021-07-22 21:29:49', '2021-07-22 21:29:49', NULL, NULL, 'Website Service Renewal', 0),
(56, '5056', 270000, NULL, NULL, NULL, 1, 31, '2021-08-13', '2021-07-23 10:29:45', '2021-07-23 11:44:41', NULL, NULL, 'Biometric Access Control System', 0),
(57, '5057', 25000, NULL, NULL, NULL, 1, 32, '2021-08-04', '2021-07-27 22:36:14', '2021-07-27 22:36:14', NULL, NULL, 'Website Service Renewal', 0),
(58, '5058', 38800, NULL, NULL, NULL, 1, 8, '2021-08-10', '2021-08-28 14:10:11', '2021-08-28 14:10:11', NULL, NULL, 'Web Design - Gerald Technologies', 2910),
(59, '5059', 273000, NULL, NULL, NULL, 1, 28, '2022-02-24', '2021-09-10 08:16:04', '2022-02-24 10:15:03', NULL, NULL, 'Electric Fence Maintenance', 0),
(60, '5060', 61000, NULL, NULL, NULL, 1, 8, '2021-09-22', '2021-09-14 18:43:41', '2021-09-14 18:43:42', NULL, NULL, 'PO for Flour Mills', 4575),
(61, '5061', 55000, NULL, NULL, NULL, 1, 5, '2022-10-20', '2021-09-15 06:37:17', '2022-10-09 12:28:47', NULL, NULL, 'Web Host and Domain Name Renewal', 0),
(62, '5062', 37000, NULL, NULL, NULL, 1, 25, '2022-02-05', '2022-01-11 07:21:34', '2022-01-11 07:21:34', NULL, NULL, 'Web hosting Renewal', 0),
(63, '5063', 1495000, NULL, NULL, 1, 1, 28, '2022-03-10', '2022-02-24 10:20:20', '2022-05-30 14:19:38', NULL, NULL, 'CCTV Revamp - IP System Alternative', 0),
(64, '5064', 605000, NULL, NULL, NULL, 1, 28, '2022-06-13', '2022-05-30 14:28:29', '2022-05-30 14:28:29', NULL, NULL, 'CCTV Installation at SCS Yard', 0),
(65, '5065', 35000, NULL, NULL, NULL, 1, 3, '2022-06-16', '2022-06-05 21:30:14', '2022-06-05 21:30:33', NULL, NULL, 'Web Services Renewal', 0),
(66, '5066', 45000, NULL, NULL, NULL, 1, 11, '2022-07-08', '2022-06-13 20:36:41', '2022-06-13 20:36:41', NULL, NULL, 'Webservices Renewal', 0),
(67, '5067', 30000, NULL, NULL, NULL, 1, 32, '2022-06-22', '2022-06-14 09:49:32', '2022-06-14 09:49:32', NULL, NULL, 'Web Service Renewal', 0),
(68, '5068', 644000, NULL, NULL, -1, 1, 33, '2021-12-09', '2022-06-27 10:06:38', '2022-06-27 10:08:01', NULL, NULL, 'CCTV for Residence', 0),
(69, '5069', 344000, NULL, NULL, NULL, 1, 34, '2022-07-08', '2022-07-01 14:27:08', '2022-07-01 14:27:09', NULL, NULL, 'Access Control Additional Readers', 0),
(70, '5070', 324000, NULL, NULL, NULL, 1, 35, '2022-07-13', '2022-07-05 22:39:29', '2022-07-05 22:39:29', NULL, NULL, 'Corrective Maintenance for Electric Fence', 0),
(71, '5071', 632000, NULL, NULL, NULL, 1, 35, '2022-07-13', '2022-07-05 23:00:52', '2022-07-05 23:00:52', NULL, NULL, '[OPTIONAL] Addition of 1 Extra Panel for Back and Left Side', 0),
(72, '5072', 20000, NULL, NULL, NULL, 1, 37, NULL, '2022-07-12 20:38:22', '2022-07-12 21:04:15', NULL, NULL, 'Callout - Total Building', 0),
(73, '5073', 913000, NULL, NULL, NULL, 1, 38, '2022-08-30', '2022-07-19 07:13:13', '2022-08-23 13:13:01', NULL, NULL, 'Access Control', 0),
(74, '5074', 860000, NULL, NULL, NULL, 1, 38, '2022-08-30', '2022-07-19 07:22:14', '2022-08-24 09:55:13', NULL, NULL, 'CCTV', 0),
(75, '5075', 913000, NULL, NULL, NULL, 1, 38, '2022-08-30', '2022-08-23 12:57:05', '2022-08-23 12:57:05', NULL, NULL, 'Access Control', 0),
(76, '5076', 913000, NULL, NULL, NULL, 1, 38, '2022-08-30', '2022-08-23 13:03:27', '2022-08-23 13:03:28', NULL, NULL, 'Access Control', 0),
(77, '5077', 913000, NULL, NULL, NULL, 1, 38, '2022-08-30', '2022-08-23 13:04:36', '2022-08-23 13:04:37', NULL, NULL, 'Access Control', 0),
(78, '5078', 913000, NULL, NULL, NULL, 1, 38, '2022-08-23', '2022-08-23 13:05:03', '2022-08-23 13:05:03', NULL, NULL, 'Access Control', 0),
(79, '5079', 200000, NULL, NULL, NULL, 1, 38, '2022-09-30', '2022-09-22 12:55:07', '2022-09-26 14:22:02', NULL, NULL, 'Access Control - Addition', 0),
(80, '5080', 50000, NULL, NULL, NULL, 1, 39, '2022-10-05', '2022-09-25 18:08:51', '2022-09-25 18:08:52', NULL, NULL, 'Renewal of Subscription', 0),
(81, '5081', 120000, NULL, NULL, NULL, 1, 40, '2022-10-28', '2022-10-20 10:13:46', '2022-10-20 10:13:47', NULL, NULL, 'CCTV Maintenance Service', 0),
(82, '5082', 785000, NULL, NULL, NULL, 1, 11, '2022-11-30', '2022-11-01 12:33:37', '2022-11-01 12:33:37', NULL, NULL, 'CCTV Project', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_product`
--

DROP TABLE IF EXISTS `invoice_product`;
CREATE TABLE IF NOT EXISTS `invoice_product` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `vat` int(11) DEFAULT NULL,
  `useas` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_product`
--

INSERT INTO `invoice_product` (`id`, `invoice_id`, `product_id`, `service_id`, `price`, `qty`, `discount`, `vat`, `useas`, `created_at`, `updated_at`) VALUES
(18, 60, '11', NULL, 100000, 1, 0, 5000, NULL, '2019-08-22 15:57:41', '2019-08-22 15:57:41'),
(17, 60, '12', NULL, 100000, 1, 20000, 4000, NULL, '2019-08-22 15:57:41', '2019-08-22 15:57:41'),
(26, 45, '1', NULL, 0, 1, 0, 0, NULL, '2019-08-23 08:19:05', '2019-08-23 08:19:05'),
(27, 45, '3', NULL, 100, 1, 0, 5, NULL, '2019-08-23 08:19:05', '2019-08-23 08:19:05'),
(28, 45, '4', NULL, 50, 1, 0, 2, NULL, '2019-08-23 08:19:05', '2019-08-23 08:19:05'),
(29, 45, '5', NULL, 20, 1, 0, 1, NULL, '2019-08-23 08:19:05', '2019-08-23 08:19:05'),
(30, 45, '8', NULL, 100, 1, 0, 5, NULL, '2019-08-23 08:19:05', '2019-08-23 08:19:05'),
(31, 45, '11', NULL, 100000, 1, 0, 5000, NULL, '2019-08-23 08:19:05', '2019-08-23 08:19:05'),
(61, 45, '44', NULL, 8000, 1, 0, 400, NULL, '2019-08-24 00:58:14', '2019-08-24 00:58:14'),
(60, 45, '46', NULL, 0, 1, 0, 0, NULL, '2019-08-24 00:58:14', '2019-08-24 00:58:14'),
(59, 45, '45', NULL, 200000, 2, 0, 10000, NULL, '2019-08-24 00:58:14', '2019-08-24 00:58:14'),
(62, 47, '52', NULL, 45000, 1, 0, 2250, '', '2019-11-16 23:55:55', '2019-11-16 23:55:55'),
(63, 47, '50', NULL, 0, 1, 0, 0, 'title', '2019-11-16 23:55:55', '2019-11-16 23:55:55'),
(64, 47, '54', NULL, 120000, 1, 0, 6000, '', '2019-11-16 23:55:55', '2019-11-16 23:55:55'),
(65, 47, '53', NULL, 1100000, 1, 0, 55000, '', '2019-11-16 23:55:55', '2019-11-16 23:55:55'),
(66, 47, '44', NULL, 8000, 1, 0, 400, 'item', '2019-11-16 23:55:55', '2019-11-16 23:55:55'),
(87, 48, '51', NULL, 0, 1, 0, 0, 'title', '2019-12-14 21:38:21', '2019-12-14 21:38:21'),
(86, 48, '52', NULL, 45000, 10, 2250, 2138, '', '2019-12-14 21:38:21', '2019-12-14 21:38:21'),
(85, 48, '54', NULL, 120000, 5, 0, 6000, '', '2019-12-14 21:38:21', '2019-12-14 21:38:21'),
(91, 50, '55', NULL, 3, 25000, 0, 0, '', '2021-04-08 07:31:01', '2021-04-08 07:31:01'),
(90, 49, '45', NULL, 200000, 1, 0, 10000, '', '2020-02-01 17:41:02', '2020-02-01 17:41:02'),
(89, 49, '52', NULL, 45000, 1, 0, 2250, '', '2020-02-01 17:41:02', '2020-02-01 17:41:02'),
(88, 48, '44', NULL, 8000, 20, 0, 400, 'item', '2019-12-14 21:38:21', '2019-12-14 21:38:21'),
(84, 48, '53', NULL, 1100000, 7, 99990, 50000, '', '2019-12-14 21:38:21', '2019-12-14 21:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_01_30_115335_add_extra_fields', 1),
('2017_02_05_205704_create_invoices_table', 1),
('2017_02_05_211602_create_services_table', 1),
('2017_02_05_214250_create_clients_table', 1),
('2017_02_20_071520_Receipts_table', 1),
('2019_08_03_161446_create_products_table', 2),
('2019_08_18_005651_create_invoice_product_table', 3),
('2019_11_24_155322_create_waybills_table', 4),
('2019_12_08_185537_create_product_waybill_table', 5),
('2019_12_13_110905_create_service_waybill_table', 6),
('2020_05_25_111502_create_sysconfigs_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED DEFAULT '0',
  `part_no` text COLLATE utf8mb4_unicode_ci,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `_lft`, `_rgt`, `parent_id`, `part_no`, `name`, `unit`, `description`, `price`) VALUES
(54, '2019-11-03 13:57:15', '2019-12-26 19:41:05', 9, 10, 50, 'HK-PTZ', 'Hikvision PTZ Camera', 'Pcs', NULL, 120000),
(53, '2019-11-03 13:56:45', '2019-12-26 19:41:05', 7, 8, 50, 'SEP-pel-PTZ', 'Pelco Ptz camera', 'Pcs', NULL, 1100000),
(47, '2019-08-24 15:32:43', '2019-12-26 15:46:20', 14, 15, 44, NULL, 'Cat 6 Cable', 'Rolls', NULL, 40000),
(48, '2019-08-25 19:53:38', '2019-12-26 15:46:20', 16, 19, 44, NULL, 'Power Cable', 'Rolls', NULL, 27000),
(49, '2019-08-25 19:56:07', '2019-12-26 15:46:20', 17, 18, 48, 'P-01', '2.5mm 3 core power cable', 'Rolls', NULL, 20000),
(50, '2019-10-27 16:04:13', '2019-12-26 19:41:05', 6, 11, 43, NULL, 'PTZ camreas', 'Pcs', NULL, NULL),
(51, '2019-10-27 16:05:00', '2019-12-26 15:45:20', 21, 24, NULL, NULL, 'Switches', 'Pcs', NULL, 400000),
(52, '2019-10-27 16:05:51', '2019-12-26 15:45:20', 22, 23, 51, 'TL-8208', 'Dlink Switch, 8 ports POE', 'Pcs', NULL, 45000),
(43, '2019-08-24 00:53:53', '2019-12-26 19:41:05', 1, 12, NULL, NULL, 'CCTV', 'Pcs', NULL, 5000),
(44, '2019-08-24 00:54:04', '2019-12-26 15:46:20', 13, 20, NULL, NULL, 'cables', 'Rolls', NULL, 8000),
(45, '2019-08-24 00:54:36', '2019-08-24 00:54:36', 2, 3, 43, NULL, 'dome camera', NULL, NULL, 200000),
(46, '2019-08-24 00:55:13', '2019-12-26 19:41:05', 4, 5, 43, NULL, 'bullet camera', 'Pcs', NULL, NULL),
(55, '2021-04-08 07:28:40', '2021-04-08 07:31:43', 25, 26, NULL, NULL, 'Bulk SMS units', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_waybill`
--

DROP TABLE IF EXISTS `product_waybill`;
CREATE TABLE IF NOT EXISTS `product_waybill` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `waybill_id` int(11) NOT NULL,
  `product_id` text COLLATE utf8mb4_unicode_ci,
  `invoice_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_waybill`
--

INSERT INTO `product_waybill` (`id`, `created_at`, `updated_at`, `waybill_id`, `product_id`, `invoice_id`, `qty`) VALUES
(23, '2020-05-24 20:39:57', '2020-05-24 20:39:57', 7, '53', 48, 7),
(22, '2020-05-24 20:39:57', '2020-05-24 20:39:57', 7, '44', 48, 10),
(21, '2020-05-24 20:39:57', '2020-05-24 20:39:57', 7, '54', 48, 2),
(20, '2020-05-24 20:39:57', '2020-05-24 20:39:57', 7, '52', 48, 7),
(25, '2020-05-24 20:55:18', '2020-05-24 20:55:18', 8, '44', 48, 5),
(24, '2020-05-24 20:55:18', '2020-05-24 20:55:18', 8, '52', 48, 2);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

DROP TABLE IF EXISTS `receipts`;
CREATE TABLE IF NOT EXISTS `receipts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `receipt_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_id` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `balance` int(11) DEFAULT NULL,
  `approved_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `receipts_receipt_id_unique` (`receipt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `receipt_id`, `invoice_id`, `paid`, `balance`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, '#1020170426101', 2, 147000, 0, 2, '2017-04-26 17:43:22', '2017-04-26 17:43:22'),
(2, '#2050170516101', 5, 20000, 0, 1, '2017-05-17 00:22:05', '2017-05-17 00:22:05'),
(3, '#30160170725-101', 16, 5000, 20000, 1, '2017-07-26 03:41:06', '2017-07-26 03:41:06'),
(4, '#4019017089101', 19, 25000, 0, 1, '2017-08-09 22:53:30', '2017-08-09 22:53:30'),
(5, '#5020017089101', 20, 25000, 0, 1, '2017-08-09 22:58:16', '2017-08-09 22:58:16'),
(6, '#60250170929101', 25, 10000, 0, 1, '2017-09-29 19:15:24', '2017-09-29 19:15:24'),
(7, '#70290171119-101', 29, 500000, 750000, 1, '2017-11-20 01:15:07', '2017-11-20 01:15:07'),
(8, '#80290171120-102', 29, 500000, 250000, 1, '2017-11-20 18:37:19', '2017-11-20 18:37:19'),
(10, '#R10-47-191117101', 47, 1773000, NULL, 1, '2019-11-17 00:16:05', '2019-11-17 00:16:05'),
(11, '#R11-48-191215101', 48, 9237570, NULL, 1, '2019-12-15 12:52:32', '2019-12-15 12:52:32'),
(12, 'R1-45', 45, 200000, 208000, 1, '2020-02-01 13:41:41', '2020-02-01 13:41:41'),
(13, 'R2-#45-8-190824', 45, 100000, 108000, 1, '2020-02-01 13:44:05', '2020-02-01 13:44:05'),
(14, 'R1-5049', 49, 353000, NULL, 1, '2020-02-01 17:41:31', '2020-02-01 17:41:31'),
(15, 'R1-5053', 53, 600000, NULL, 1, '2021-09-14 20:59:53', '2021-09-14 20:59:53'),
(16, 'R1-5063', 63, 1495000, NULL, 1, '2022-05-30 14:19:38', '2022-05-30 14:19:38'),
(17, 'R1-5068', 68, 500000, 144000, 1, '2022-06-27 10:08:01', '2022-06-27 10:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `service` text COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=413 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `invoice_id`, `service`, `price`, `discount`, `qty`, `unit`, `vat`, `created_at`, `updated_at`) VALUES
(1, 1, 'Electromagnetic Lock, 12V', 25000, NULL, 1, NULL, NULL, '2017-04-25 14:13:51', '2017-04-25 14:13:51'),
(2, 1, 'Installation', 5000, NULL, 1, NULL, NULL, '2017-04-25 14:13:51', '2017-04-25 14:13:51'),
(3, 2, 'Domain Name Renewal with Mentainance', 20000, NULL, 1, NULL, NULL, '2017-04-26 16:09:08', '2017-04-26 17:10:23'),
(4, 2, 'Monthly Subscription for Hosting', 10000, NULL, 12, NULL, NULL, '2017-04-26 16:09:08', '2017-04-26 16:09:08'),
(5, 3, 'Domain Name Renewal with Mentainance', 28000, NULL, 1, NULL, NULL, '2017-04-26 20:52:39', '2017-08-16 19:23:04'),
(6, 3, 'Monthly Subscription for Web Hosting', 10000, NULL, 12, NULL, NULL, '2017-04-26 20:52:39', '2017-08-16 19:23:04'),
(7, 4, 'Domain and Web Host Resubscription', 20000, NULL, 1, NULL, NULL, '2017-05-15 03:47:05', '2017-05-15 03:47:05'),
(8, 5, 'Website domain name and hosting renewal for nifeslautechalumni.org', 20000, NULL, 1, NULL, NULL, '2017-05-17 00:13:53', '2017-05-17 00:13:53'),
(9, 6, 'Bullet analogue Camera', 20000, NULL, 2, NULL, NULL, '2017-05-18 01:21:27', '2017-05-18 01:21:27'),
(10, 6, 'RG6 Coaxial Cable (roll) ', 18000, NULL, 1, NULL, NULL, '2017-05-18 01:21:27', '2017-05-18 01:21:27'),
(11, 6, 'Cat 3 utp cable (roll) ', 5000, NULL, 1, NULL, NULL, '2017-05-18 01:21:27', '2017-05-18 01:21:27'),
(12, 6, 'Connectors and accessories ', 7000, NULL, 1, NULL, NULL, '2017-05-18 01:21:27', '2017-05-18 01:21:27'),
(13, 6, 'Installation ', 20000, NULL, 1, NULL, NULL, '2017-05-18 01:21:27', '2017-05-18 01:21:27'),
(15, 8, 'Magnetic Switch', 4000, NULL, 1, NULL, NULL, '2017-05-19 04:02:10', '2017-05-19 04:02:10'),
(16, 8, 'Siren', 3000, NULL, 1, NULL, NULL, '2017-05-19 04:02:10', '2017-05-19 04:02:10'),
(17, 8, 'Strobe', 3500, NULL, 1, NULL, NULL, '2017-05-19 04:02:10', '2017-05-19 04:02:10'),
(18, 8, 'Battery', 8500, NULL, 1, NULL, NULL, '2017-05-19 04:02:10', '2017-05-19 04:02:10'),
(19, 8, 'Cat3 cable', 5000, NULL, 1, NULL, NULL, '2017-05-19 04:02:10', '2017-05-19 04:02:10'),
(20, 8, 'Labour', 20000, NULL, 1, NULL, NULL, '2017-05-19 04:02:10', '2017-05-19 04:02:10'),
(37, 13, 'Compression Spring', 15000, NULL, 1, NULL, NULL, '2017-07-07 17:49:16', '2017-07-07 17:49:16'),
(38, 13, 'Ferrules', 5000, NULL, 1, NULL, NULL, '2017-07-07 17:49:16', '2017-07-07 17:49:16'),
(39, 13, 'Cleanup of Insulators and general maintenance', 30000, NULL, 1, NULL, NULL, '2017-07-07 17:49:16', '2017-07-07 17:49:16'),
(40, 14, 'Aluminium Fence wire', 30000, NULL, 3, NULL, NULL, '2017-07-14 21:37:32', '2017-07-14 21:37:32'),
(41, 14, 'Compression spring', 15000, NULL, 2, NULL, NULL, '2017-07-14 21:37:32', '2017-07-14 21:37:32'),
(42, 14, 'Large tail hook', 5000, NULL, 2, NULL, NULL, '2017-07-14 21:37:32', '2017-07-14 21:37:32'),
(43, 14, 'Ferrules', 5000, NULL, 5, NULL, NULL, '2017-07-14 21:37:32', '2017-07-14 21:37:32'),
(44, 14, 'HT Cable', 20000, NULL, 1, NULL, NULL, '2017-07-14 21:37:32', '2017-07-14 21:37:32'),
(45, 14, 'Installation', 70000, NULL, 1, NULL, NULL, '2017-07-14 21:37:32', '2017-07-14 21:37:32'),
(46, 15, 'HT Cable', 20000, NULL, 1, NULL, NULL, '2017-07-21 15:18:56', '2017-07-21 15:18:56'),
(47, 15, 'Compression spring', 15000, NULL, 1, NULL, NULL, '2017-07-21 15:18:56', '2017-07-21 15:18:56'),
(48, 15, 'Ferrules', 5000, NULL, 1, NULL, NULL, '2017-07-21 15:18:56', '2017-07-21 15:18:56'),
(49, 15, 'Service Charge', 50000, NULL, 1, NULL, NULL, '2017-07-21 15:18:56', '2017-07-21 15:18:56'),
(50, 16, 'Content Development for Profile', 15000, NULL, 1, NULL, NULL, '2017-07-26 03:39:31', '2017-07-26 03:39:31'),
(51, 16, 'Profile Graphics Design', 10000, NULL, 1, NULL, NULL, '2017-07-26 03:39:31', '2017-07-26 03:39:31'),
(52, 17, 'Analogue Cameras', 10000, NULL, 8, NULL, NULL, '2017-08-02 12:55:47', '2017-08-02 12:55:47'),
(53, 17, '8 Channel DVR', 40000, NULL, 1, NULL, NULL, '2017-08-02 12:55:47', '2017-08-02 12:55:47'),
(54, 17, 'Cables (RG6 and Power cable)', 30000, NULL, 1, NULL, NULL, '2017-08-02 12:55:47', '2017-08-02 12:55:47'),
(55, 17, '1 TB Hard disk drive', 25000, NULL, 1, NULL, NULL, '2017-08-02 12:55:47', '2017-08-02 12:55:47'),
(56, 17, '12V Power supply unit', 12000, NULL, 1, NULL, NULL, '2017-08-02 12:55:47', '2017-08-02 12:55:47'),
(57, 17, 'Installation, Logistics and Accessories', 40000, NULL, 1, NULL, NULL, '2017-08-02 12:55:47', '2017-08-02 12:55:47'),
(58, 18, 'Troubleshooting and Reporting of faults on malfunctioning devices in Anthony and Lekki Campus', 50000, NULL, 1, NULL, NULL, '2017-08-07 15:52:53', '2017-08-07 15:52:53'),
(59, 19, '20GB web hosting and Domain name Renewal (1 Year)', 25000, NULL, 1, NULL, NULL, '2017-08-08 18:05:02', '2017-08-08 18:05:02'),
(60, 19, '5 emails x 12 months (25GB per account)', 1140, NULL, 60, NULL, NULL, '2017-08-08 20:19:49', '2017-08-08 20:19:49'),
(61, 20, '20GB web hosting and Domain name Renewal (1 Year)', 25000, NULL, 1, NULL, NULL, '2017-08-09 22:57:49', '2017-08-09 22:57:49'),
(62, 21, 'Data Mining and Data Processing', 85000, NULL, 1, NULL, NULL, '2017-08-16 19:25:53', '2017-08-16 19:25:53'),
(63, 22, 'Cameras', 10000, NULL, 8, NULL, NULL, '2017-08-24 18:36:18', '2017-08-24 18:36:18'),
(64, 22, '8 Channel DVR', 40000, NULL, 1, NULL, NULL, '2017-08-24 18:36:18', '2017-08-24 18:36:18'),
(65, 22, '1 TB Hard Disk Drive', 25000, NULL, 1, NULL, NULL, '2017-08-24 18:36:18', '2017-08-24 18:36:18'),
(66, 22, '12V Power Supply Unit', 16000, NULL, 1, NULL, NULL, '2017-08-24 18:36:18', '2017-08-24 18:36:18'),
(67, 22, '32\" Led TV', 75000, NULL, 1, NULL, NULL, '2017-08-24 18:36:18', '2017-08-24 18:36:18'),
(68, 22, 'Coaxial and Power Cable', 30000, NULL, 1, NULL, NULL, '2017-08-24 18:36:18', '2017-08-24 18:36:18'),
(69, 22, 'Installation, Logistics and Accessories', 50000, NULL, 1, NULL, NULL, '2017-08-24 18:36:18', '2017-08-24 18:36:18'),
(70, 23, 'ID Card Design & Layout', 1150, NULL, 1, NULL, NULL, '2017-08-31 17:03:59', '2017-08-31 17:06:24'),
(71, 23, 'Color Seperation & Plate Setting', 350, NULL, 5, NULL, NULL, '2017-08-31 17:03:59', '2017-08-31 17:03:59'),
(72, 23, 'Card Printing', 8, NULL, 8400, NULL, NULL, '2017-08-31 17:03:59', '2017-08-31 17:03:59'),
(73, 24, 'Branded HP Desktop System (4GB RAM, 18.5\'\' Monitor, 500GB HDD)', 225000, NULL, 1, NULL, NULL, '2017-09-12 23:32:22', '2017-09-13 21:56:49'),
(74, 24, 'Mercucy (660VA) UPS', 25000, NULL, 1, NULL, NULL, '2017-09-13 21:56:49', '2017-09-13 21:56:49'),
(75, 25, 'Call-out Charge', 10000, NULL, 1, NULL, NULL, '2017-09-29 19:15:10', '2017-09-29 19:15:10'),
(76, 26, 'Domain name (square-studio.com)', 6000, NULL, 1, NULL, NULL, '2017-10-05 14:01:06', '2017-10-05 14:01:06'),
(77, 26, 'Web hosting ', 19000, NULL, 1, NULL, NULL, '2017-10-05 14:01:06', '2017-10-05 14:01:06'),
(78, 27, 'Domain name (barnawabaptistchurch.org)', 6000, NULL, 1, NULL, NULL, '2017-10-05 14:06:28', '2017-10-05 14:06:28'),
(79, 27, 'Web host (1 year)', 19000, NULL, 1, NULL, NULL, '2017-10-05 14:06:28', '2017-10-05 14:06:28'),
(80, 28, '\"10 by 20\" Banner', 80000, NULL, 2, NULL, NULL, '2017-10-05 16:51:37', '2017-10-05 16:51:37'),
(81, 29, 'DS-2CD2022-I - 2MP Bullet Camera', 32000, NULL, 9, NULL, NULL, '2017-10-12 19:22:00', '2017-11-20 01:04:07'),
(82, 29, 'DS-2CD2122FWD-I - 2MP Dome Camera', 32000, NULL, 6, NULL, NULL, '2017-10-12 19:22:00', '2017-11-20 01:04:07'),
(83, 29, 'Ds-2CD2135FWD-I- 3MP Dome Camera (Reception)', 34000, NULL, 1, NULL, NULL, '2017-10-12 19:22:00', '2017-11-20 01:04:07'),
(84, 29, '32 Channel NVR with 16 POE', 180000, NULL, 1, NULL, NULL, '2017-10-12 19:22:00', '2017-11-20 01:04:07'),
(85, 29, '4TB HDD', 54000, NULL, 2, NULL, NULL, '2017-10-12 19:22:00', '2017-11-20 01:04:07'),
(86, 29, '32\" Monitors', 71000, NULL, 1, NULL, NULL, '2017-10-12 19:22:00', '2017-11-20 01:04:07'),
(89, 29, 'Cat6 Cable 300m', 54000, NULL, 2, NULL, NULL, '2017-10-12 19:22:00', '2017-11-20 01:04:07'),
(90, 29, 'Accessories (PVC pipes, Boxes, screws, fittings etc)', 59000, NULL, 1, NULL, NULL, '2017-10-12 19:22:00', '2017-11-20 01:04:07'),
(91, 29, 'Installation & Configuration', 210000, NULL, 1, NULL, NULL, '2017-10-12 19:22:00', '2017-11-20 01:04:07'),
(111, 33, 'Xpass Card Reader', 299663, NULL, 2, NULL, NULL, '2017-10-18 16:51:57', '2017-10-18 16:51:57'),
(112, 33, 'Secure i/o (optional for added security)', 153000, NULL, 2, NULL, NULL, '2017-10-18 16:51:57', '2017-10-18 16:51:57'),
(113, 33, 'Request to Exit', 2500, NULL, 2, NULL, NULL, '2017-10-18 16:51:57', '2017-10-18 16:51:57'),
(114, 33, 'Maglock', 25000, NULL, 2, NULL, NULL, '2017-10-18 16:51:57', '2017-10-18 16:51:57'),
(115, 33, '13.5MHz Mifare card', 1500, NULL, 50, NULL, NULL, '2017-10-18 16:51:57', '2017-10-18 16:51:57'),
(116, 33, '12V Power Supply', 5200, NULL, 2, NULL, NULL, '2017-10-18 16:51:57', '2017-10-18 16:51:57'),
(117, 33, 'Accessories', 10000, NULL, 1, NULL, NULL, '2017-10-18 16:51:57', '2017-10-18 16:51:57'),
(118, 34, 'DS-7716ni-e4 16-user license 160Mbps Bit Rate Input Max (upto 16-ch IP Video) 4 Sata Interfaces, 16 POE', 156000, NULL, 1, NULL, NULL, '2017-11-01 20:49:15', '2017-11-01 20:49:15'),
(119, 34, '4TB Sata Hard drive', 65000, NULL, 4, NULL, NULL, '2017-11-01 20:49:15', '2017-11-01 20:49:15'),
(120, 34, 'Cat 6e Schneider cable, roll of 306m', 58500, NULL, 1, NULL, NULL, '2017-11-01 20:49:15', '2017-11-01 20:49:15'),
(121, 34, '6U Benign Rack with 6 port PDU', 37000, NULL, 1, NULL, NULL, '2017-11-01 20:49:15', '2017-11-01 20:49:15'),
(124, 36, 'Core i5, 8GB RAM, 2GB Dedicated Graphics card', 400000, NULL, 1, NULL, NULL, '2017-11-28 03:06:16', '2017-11-28 03:06:16'),
(125, 37, '8 Channel DVR', 50000, NULL, 1, NULL, NULL, '2017-12-06 04:56:37', '2017-12-11 06:18:20'),
(126, 37, 'Smile Router', 40000, NULL, 1, NULL, NULL, '2017-12-06 04:56:37', '2017-12-11 06:18:20'),
(127, 37, 'Video Door Phone indoor and outdoor unit', 50000, NULL, 1, NULL, NULL, '2017-12-06 04:56:37', '2017-12-11 06:18:20'),
(128, 37, '24\" TV', 55000, NULL, 1, NULL, NULL, '2017-12-06 04:56:37', '2017-12-11 06:39:14'),
(129, 37, 'Installation and Clean up', 30000, NULL, 1, NULL, NULL, '2017-12-06 05:12:16', '2017-12-06 05:12:16'),
(130, 38, 'Smile Router', 40000, NULL, 1, NULL, NULL, '2017-12-06 16:09:34', '2017-12-06 16:09:34'),
(131, 39, 'Installation and configuration of two Sensormatic EAS Antenna ', 80000, NULL, 1, NULL, NULL, '2017-12-13 16:06:08', '2017-12-13 16:06:08'),
(132, 39, 'Accessories', 10000, NULL, 1, NULL, NULL, '2017-12-13 16:06:08', '2017-12-13 16:06:08'),
(133, 40, '10\" X 7\" Flex Banner', 30000, NULL, 2, NULL, NULL, '2017-12-19 18:59:03', '2017-12-19 18:59:03'),
(134, 40, 'Official Envelops (50 Copies)', 10000, NULL, 1, NULL, NULL, '2017-12-19 18:59:03', '2017-12-19 18:59:03'),
(135, 40, 'Seal and Stamp ', 20000, NULL, 1, NULL, NULL, '2017-12-19 18:59:03', '2017-12-19 18:59:03'),
(136, 40, 'Rubber Stamp', 25000, NULL, 1, NULL, NULL, '2017-12-19 18:59:03', '2017-12-19 18:59:03'),
(137, 41, 'Social Media Campaign (per month)   Facebook,  Twitter,  Instagram,  WhatsApp', 200000, NULL, 6, NULL, NULL, '2017-12-19 20:24:47', '2017-12-19 20:24:47'),
(138, 42, '7\" X 5\" Flex Banner', 20000, NULL, 3, NULL, NULL, '2018-01-09 23:16:03', '2018-01-09 23:16:03'),
(140, 44, 'Repair of Fault on fence line', 7000, NULL, 1, NULL, NULL, '2018-02-02 16:29:49', '2018-02-02 16:29:49'),
(141, 45, 'QNAP TS-451+-2G/24TB-IW', 780000, NULL, 1, NULL, NULL, '2018-02-08 00:00:51', '2018-02-09 03:14:43'),
(142, 45, 'QNAP TS-653A-4G/48TB-SIW 6 BAY NAS', 1430000, NULL, 1, NULL, NULL, '2018-02-08 00:00:51', '2018-02-09 03:14:43'),
(143, 45, 'Installation', 50000, NULL, 1, NULL, NULL, '2018-02-08 00:03:58', '2018-02-08 00:03:58'),
(151, 60, 'Dome Camera', 30000, 5000, 1, NULL, 0, '2019-08-22 15:57:41', '2019-08-22 15:57:41'),
(152, 60, 'NVR', 75000, 7500, 1, NULL, 0, '2019-08-22 15:57:41', '2019-08-22 15:57:41'),
(156, 47, 'Installation and Configuration', 500000, 0, 1, NULL, 0, '2019-11-16 23:55:55', '2019-11-16 23:55:55'),
(157, 30, 'Biometric Finger print Reader', 103000, 0, 2, NULL, 0, '2019-12-08 17:38:04', '2019-12-08 17:38:04'),
(158, 30, 'Maglock', 25000, 0, 2, NULL, 0, '2019-12-08 17:38:04', '2019-12-08 17:38:04'),
(159, 30, 'Request to Exit', 2500, 250, 2, NULL, 0, '2019-12-08 17:38:04', '2019-12-08 17:38:04'),
(160, 30, 'Power Supply', 5200, 0, 2, NULL, 0, '2019-12-08 17:38:04', '2019-12-08 17:38:04'),
(161, 30, 'Accessories', 10000, 0, 1, NULL, 0, '2019-12-08 17:38:04', '2019-12-08 17:38:04'),
(162, 48, '60watt solar panel with12V  40AH  battery', 50000, 0, 5, NULL, 0, '2019-12-14 21:38:21', '2019-12-14 21:38:21'),
(163, 48, 'Installation and Configuration', 800000, 0, 1, NULL, 0, '2019-12-14 21:38:21', '2019-12-14 21:38:21'),
(164, 49, 'Nokia 6.1 plus', 58000, 0, 1, 'Pcs', 0, '2020-02-01 17:41:02', '2020-02-01 17:41:02'),
(165, 49, 'Travel Adaptor', 5000, 0, 2, 'Pcs', 0, '2020-02-01 17:41:03', '2020-02-01 17:41:03'),
(166, 49, 'Cat 6 cable', 40000, 0, 1, 'roll', 0, '2020-02-01 17:41:03', '2020-02-01 17:41:03'),
(167, 31, 'Card Reaer', 78000, 0, 2, NULL, 5850, '2020-02-26 13:19:54', '2020-02-26 13:19:54'),
(168, 31, 'Maglock', 25000, 0, 2, NULL, 1875, '2020-02-26 13:19:54', '2020-02-26 13:19:54'),
(169, 31, 'Request to Exit', 2500, 0, 2, NULL, 188, '2020-02-26 13:19:54', '2020-02-26 13:19:54'),
(170, 31, 'Mifare Card', 1000, 0, 50, NULL, 75, '2020-02-26 13:19:54', '2020-02-26 13:19:54'),
(171, 31, 'Power Supply', 5200, 0, 2, NULL, 390, '2020-02-26 13:19:54', '2020-02-26 13:19:54'),
(172, 31, 'Accessories', 10000, 0, 1, NULL, 750, '2020-02-26 13:19:54', '2020-02-26 13:19:54'),
(191, 32, 'Bioentry plus Finger print biometric and Card Reader', 388180, 0, 2, NULL, 19409, '2020-02-26 14:24:24', '2020-02-26 14:24:24'),
(192, 32, 'Request to Exit', 2500, 0, 2, NULL, 125, '2020-02-26 14:24:24', '2020-02-26 14:24:24'),
(193, 32, 'Maglock', 25000, 0, 2, NULL, 1250, '2020-02-26 14:24:24', '2020-02-26 14:24:24'),
(194, 32, '13.5MHz mifare card (optional when using as card reader)', 1500, 0, 50, NULL, 75, '2020-02-26 14:24:24', '2020-02-26 14:24:24'),
(195, 32, '12V Power supply', 5200, 0, 2, NULL, 260, '2020-02-26 14:24:24', '2020-02-26 14:24:24'),
(196, 32, 'Accessories', 10000, 0, 1, NULL, 500, '2020-02-26 14:24:24', '2020-02-26 14:24:24'),
(197, 51, 'mustardcapltd.com - Upgrade from 2 to 5 emails (3,300 per user x 3) - Expires 22/01/2024', 9900, 0, 33, 'Months', 0, '2021-04-27 08:16:02', '2021-04-27 08:16:02'),
(198, 52, 'Call out - Rectification of fault on Panel', 20000, 0, 1, NULL, 0, '2021-05-06 09:00:21', '2021-05-06 09:00:21'),
(199, 53, 'BLOCK B Looping process indication', 200000, 0, 1, 'Lot', 0, '2021-05-06 10:36:24', '2021-05-06 10:36:24'),
(200, 53, 'BLOCK A Looping process indication', 200000, 0, 1, 'lot', 0, '2021-05-06 10:36:24', '2021-05-06 10:36:24'),
(201, 53, 'BLOCK (AAND A) Fire Alarm Panel Controller (Reprogramming Addressing Loop Cable)', 200000, 0, 1, 'lot', 0, '2021-05-06 10:36:24', '2021-05-06 10:36:24'),
(202, 54, 'Resolution of internet browsing issue', 10000, 0, 1, NULL, 0, '2021-06-07 13:37:28', '2021-06-07 13:37:28'),
(203, 55, 'Shared Web Host - 60GB allocation', 35000, 0, 1, 'Each', 0, '2021-07-22 21:29:49', '2021-07-22 21:29:49'),
(204, 55, 'Domain Name - jesomtech.com', 7000, 0, 1, 'Each', 0, '2021-07-22 21:29:49', '2021-07-22 21:29:49'),
(208, 56, 'EP30 Biometric Reader and Power supply', 70000, 0, 3, NULL, 0, '2021-07-23 11:44:41', '2021-07-23 11:44:41'),
(209, 56, 'Installation', 60000, 0, 1, NULL, 0, '2021-07-23 11:44:41', '2021-07-23 11:44:41'),
(210, 57, 'Website hosting and domain name Renewal', 25000, 0, 1, 'Each', 0, '2021-07-27 22:36:14', '2021-07-27 22:36:14'),
(211, 58, 'Web hosting service', 20000, 0, 1, 'each', 1500, '2021-08-28 14:10:11', '2021-08-28 14:10:11'),
(212, 58, 'Domain Name', 7400, 0, 2, 'each', 555, '2021-08-28 14:10:11', '2021-08-28 14:10:11'),
(213, 58, 'SSL Configuration', 2000, 0, 2, 'each', 150, '2021-08-28 14:10:11', '2021-08-28 14:10:11'),
(220, 60, 'Lamp Stand', 1000, 0, 1, 'Each', 75, '2021-09-14 18:43:42', '2021-09-14 18:43:42'),
(221, 60, 'Female Plug', 100, 0, 200, 'Each', 8, '2021-09-14 18:43:42', '2021-09-14 18:43:42'),
(222, 60, 'Stranded Aluminum fence cable', 20000, 0, 2, '1000m/Roll', 1500, '2021-09-14 18:43:42', '2021-09-14 18:43:42'),
(229, 62, 'Web hosting', 20000, 0, 1, 'Each', 0, '2022-01-11 07:21:34', '2022-01-11 07:21:34'),
(230, 62, 'Domain Name - lighthousebc-ng.org', 10000, 0, 1, 'Each', 0, '2022-01-11 07:21:34', '2022-01-11 07:21:34'),
(231, 62, 'Certum Commercial SSL - For basic site security with https', 7000, 0, 1, 'Each', 0, '2022-01-11 07:21:34', '2022-01-11 07:21:34'),
(238, 59, 'Stranded Aluminum fence cable', 20000, 0, 1, NULL, 0, '2022-02-24 10:15:03', '2022-02-24 10:15:03'),
(239, 59, 'Ferrules', 4000, 0, 2, NULL, 0, '2022-02-24 10:15:03', '2022-02-24 10:15:03'),
(240, 59, 'HYBRID COMPRESSION SPRING 2', 14000, 0, 1, NULL, 0, '2022-02-24 10:15:03', '2022-02-24 10:15:03'),
(241, 59, 'Spring Hook', 3000, 0, 2, NULL, 0, '2022-02-24 10:15:03', '2022-02-24 10:15:03'),
(242, 59, 'Batteries', 15000, 0, 2, NULL, 0, '2022-02-24 10:15:03', '2022-02-24 10:15:03'),
(243, 59, 'Double pole lightening protection', 30000, 0, 3, NULL, 0, '2022-02-24 10:15:03', '2022-02-24 10:15:03'),
(244, 59, '1 core HT cable', 25000, 0, 1, NULL, 0, '2022-02-24 10:15:03', '2022-02-24 10:15:03'),
(245, 59, 'Installation', 80000, 0, 1, NULL, 0, '2022-02-24 10:15:03', '2022-02-24 10:15:03'),
(246, 63, '4mp Bullet camera', 70000, 0, 14, NULL, 0, '2022-02-24 10:20:20', '2022-02-24 10:20:20'),
(247, 63, '16 channel NVR', 165000, 0, 1, NULL, 0, '2022-02-24 10:20:20', '2022-02-24 10:20:20'),
(248, 63, '4TB Hard disk drive', 50000, 0, 2, NULL, 0, '2022-02-24 10:20:20', '2022-02-24 10:20:20'),
(249, 63, 'Accessories', 50000, 0, 1, NULL, 0, '2022-02-24 10:20:20', '2022-02-24 10:20:20'),
(250, 63, 'Installation and Configuration', 200000, 0, 1, NULL, 0, '2022-02-24 10:20:20', '2022-02-24 10:20:20'),
(251, 64, '4mp Bullet Camera', 70000, 0, 4, 'Each', 0, '2022-05-30 14:28:29', '2022-05-30 14:28:29'),
(252, 64, 'Outdoor Cat 6 Cable', 70000, 0, 1, 'Roll', 0, '2022-05-30 14:28:29', '2022-05-30 14:28:29'),
(253, 64, '8 Channel NVR POE', 100000, 0, 1, 'Each', 0, '2022-05-30 14:28:29', '2022-05-30 14:28:29'),
(254, 64, '4TB Hard Disk', 45000, 0, 1, 'Each', 0, '2022-05-30 14:28:29', '2022-05-30 14:28:29'),
(255, 64, 'Cable duct', 400, 0, 50, 'Meters', 0, '2022-05-30 14:28:29', '2022-05-30 14:28:29'),
(256, 64, 'Installation Accessories', 20000, 0, 1, 'Lots', 0, '2022-05-30 14:28:29', '2022-05-30 14:28:29'),
(257, 64, 'Installation', 70000, 0, 1, 'Lots', 0, '2022-05-30 14:28:29', '2022-05-30 14:28:29'),
(260, 65, 'Domain name renewal - saoassociates.org:', 10000, 0, 1, NULL, 0, '2022-06-05 21:30:33', '2022-06-05 21:30:33'),
(261, 65, 'Web hosting service renewal', 25000, 0, 1, NULL, 0, '2022-06-05 21:30:33', '2022-06-05 21:30:33'),
(262, 66, 'Domain name renewal - Jesomtech.com', 10000, 0, 1, 'Each', 0, '2022-06-13 20:36:41', '2022-06-13 20:36:41'),
(263, 66, 'Webhost renewal', 35000, 0, 1, 'Each', 0, '2022-06-13 20:36:41', '2022-06-13 20:36:41'),
(264, 67, 'Domain name renewal - nhbc-ng.org', 10000, 0, 1, 'Each', 0, '2022-06-14 09:49:32', '2022-06-14 09:49:32'),
(265, 67, 'Webhost renewal', 20000, 0, 1, 'Each', 0, '2022-06-14 09:49:32', '2022-06-14 09:49:32'),
(266, 67, 'DV SSL Certificate', 5000, 5000, 1, 'Each', 0, '2022-06-14 09:49:32', '2022-06-14 09:49:32'),
(267, 68, '2mp Bullet camera', 32000, 0, 2, 'Each', 0, '2022-06-27 10:06:38', '2022-06-27 10:06:38'),
(268, 68, '2mp Dome Camera', 35000, 0, 6, 'Each', 0, '2022-06-27 10:06:38', '2022-06-27 10:06:38'),
(269, 68, '8 Channel NVR', 85000, 0, 1, 'Each', 0, '2022-06-27 10:06:38', '2022-06-27 10:06:38'),
(270, 68, '8TB Hard Disk', 45000, 0, 1, 'Each', 0, '2022-06-27 10:06:38', '2022-06-27 10:06:38'),
(271, 68, 'Cat6 Cable', 60000, 0, 2, 'Each', 0, '2022-06-27 10:06:38', '2022-06-27 10:06:38'),
(272, 68, 'PVC Pipes, Trunks and boxes', 20000, 0, 1, 'Lot', 0, '2022-06-27 10:06:38', '2022-06-27 10:06:38'),
(273, 68, 'Accessories', 20000, 0, 1, 'Lot', 0, '2022-06-27 10:06:38', '2022-06-27 10:06:38'),
(274, 68, 'Installation', 80000, 0, 1, 'Lot', 0, '2022-06-27 10:06:38', '2022-06-27 10:06:38'),
(275, 69, 'In01a Zkteco Biometric Reader', 140000, 0, 2, 'Each', 0, '2022-07-01 14:27:09', '2022-07-01 14:27:09'),
(276, 69, '5 port Network Switch', 7000, 0, 2, 'Each', 0, '2022-07-01 14:27:09', '2022-07-01 14:27:09'),
(277, 69, 'Installation accessories', 10000, 0, 1, 'Each', 0, '2022-07-01 14:27:09', '2022-07-01 14:27:09'),
(278, 69, 'Installation and configuration', 20000, 0, 2, 'Each', 0, '2022-07-01 14:27:09', '2022-07-01 14:27:09'),
(279, 70, 'Aluminium 1.6 mm stranded wire', 32000, 0, 1, 'Roll', 0, '2022-07-05 22:39:29', '2022-07-05 22:39:29'),
(280, 70, 'Ferrules - 6mm Aluminium (100 pack)', 4000, 0, 2, 'Pack', 0, '2022-07-05 22:39:29', '2022-07-05 22:39:29'),
(281, 70, 'Hybrid Compression Spring', 8000, 0, 1, 'Pack', 0, '2022-07-05 22:39:29', '2022-07-05 22:39:29'),
(282, 70, 'Single core HT Cable', 26000, 0, 1, 'Roll', 0, '2022-07-05 22:39:29', '2022-07-05 22:39:29'),
(283, 70, 'Spring Hook stainless steel', 4000, 0, 2, 'Pack', 0, '2022-07-05 22:39:29', '2022-07-05 22:39:29'),
(284, 70, 'Warning Sign', 600, 0, 20, 'Each', 0, '2022-07-05 22:39:29', '2022-07-05 22:39:29'),
(285, 70, 'Double Pole lightning Protection', 40000, 0, 2, 'Each', 0, '2022-07-05 22:39:29', '2022-07-05 22:39:29'),
(286, 70, 'Installation', 150000, 0, 1, 'Lot', 0, '2022-07-05 22:39:29', '2022-07-05 22:39:29'),
(287, 71, 'DRUID 25 Energizer', 230000, 0, 1, 'Each', 0, '2022-07-05 23:00:52', '2022-07-05 23:00:52'),
(288, 71, '3core HT Cable - 100m', 90000, 0, 2, 'Rolls', 0, '2022-07-05 23:00:52', '2022-07-05 23:00:52'),
(289, 71, 'Strobe light', 4000, 0, 2, 'Each', 0, '2022-07-05 23:00:52', '2022-07-05 23:00:52'),
(290, 71, 'Siren 15W 12 VDC', 4000, 0, 1, 'Each', 0, '2022-07-05 23:00:52', '2022-07-05 23:00:52'),
(291, 71, 'Double Pole lightning Protection', 40000, 0, 2, 'Each', 0, '2022-07-05 23:00:52', '2022-07-05 23:00:52'),
(292, 71, 'Installation Accessories', 30000, 0, 1, 'Lot', 0, '2022-07-05 23:00:52', '2022-07-05 23:00:52'),
(293, 71, 'Installation and Commissioning', 100000, 0, 1, 'Lot', 0, '2022-07-05 23:00:52', '2022-07-05 23:00:52'),
(295, 72, 'Electric Fence Corrective Maintenance', 20000, 0, 1, NULL, 0, '2022-07-12 21:04:15', '2022-07-12 21:04:15'),
(370, 73, 'Biometric card readers', 80000, 0, 6, NULL, 0, '2022-08-23 13:13:01', '2022-08-23 13:13:01'),
(371, 73, 'IP Video Door Phone', 150000, 0, 1, NULL, 0, '2022-08-23 13:13:01', '2022-08-23 13:13:01'),
(372, 73, 'Maglock with ZL bracket', 25000, 0, 4, NULL, 0, '2022-08-23 13:13:01', '2022-08-23 13:13:01'),
(373, 73, 'Ulock for frameless glass door', 10000, 0, 1, NULL, 0, '2022-08-23 13:13:01', '2022-08-23 13:13:01'),
(374, 73, 'Push Button', 6000, 0, 3, NULL, 0, '2022-08-23 13:13:01', '2022-08-23 13:13:01'),
(375, 73, 'Power Supply Unit', 10000, 0, 4, NULL, 0, '2022-08-23 13:13:01', '2022-08-23 13:13:01'),
(376, 73, 'Power Cable', 15000, 0, 1, NULL, 0, '2022-08-23 13:13:01', '2022-08-23 13:13:01'),
(377, 73, 'Accessories', 20000, 0, 1, NULL, 0, '2022-08-23 13:13:01', '2022-08-23 13:13:01'),
(378, 73, 'Installation', 25000, 5000, 4, NULL, 0, '2022-08-23 13:13:01', '2022-08-23 13:13:01'),
(385, 74, '2mp Dome Camera', 35000, 0, 11, NULL, 0, '2022-08-24 09:55:13', '2022-08-24 09:55:13'),
(386, 74, '4TB Hard disk', 45000, 0, 2, NULL, 0, '2022-08-24 09:55:13', '2022-08-24 09:55:13'),
(387, 74, '16 Channel NVR', 180000, 0, 1, NULL, 0, '2022-08-24 09:55:13', '2022-08-24 09:55:13'),
(388, 74, 'Cat 6 Cable', 75000, 0, 1, NULL, 0, '2022-08-24 09:55:13', '2022-08-24 09:55:13'),
(389, 74, 'Accessories', 30000, 0, 1, NULL, 0, '2022-08-24 09:55:13', '2022-08-24 09:55:13'),
(390, 74, 'Installation and Configuration', 150000, 50000, 1, NULL, 0, '2022-08-24 09:55:13', '2022-08-24 09:55:13'),
(397, 80, 'Web Application Hosting and Domain name', 50000, 0, 1, 'Each', 0, '2022-09-25 18:08:52', '2022-09-25 18:08:52'),
(398, 79, 'Biometric Fingerprint and Card reader', 60000, 0, 2, NULL, 0, '2022-09-26 14:22:02', '2022-09-26 14:22:02'),
(399, 79, 'Mifare Cards', 1000, 0, 80, NULL, 0, '2022-09-26 14:22:02', '2022-09-26 14:22:02'),
(404, 61, 'Website Host', 25000, 0, 1, NULL, 0, '2022-10-09 12:28:47', '2022-10-09 12:28:47'),
(405, 61, 'Domain Name renewal - square-studio.com', 10000, 0, 1, NULL, 0, '2022-10-09 12:28:47', '2022-10-09 12:28:47'),
(406, 61, 'Domain Name renewal - squareatelier.com', 10000, 0, 1, NULL, 0, '2022-10-09 12:28:47', '2022-10-09 12:28:47'),
(407, 61, 'SSL Certificate', 10000, 0, 1, NULL, 0, '2022-10-09 12:28:47', '2022-10-09 12:28:47'),
(408, 81, 'Troubleshooting of CCTV Infrastructure', 120000, 0, 1, 'Each', 0, '2022-10-20 10:13:47', '2022-10-20 10:13:47'),
(409, 82, '8 Channel NVR with POE', 100000, 0, 2, 'Each', 0, '2022-11-01 12:33:38', '2022-11-01 12:33:38'),
(410, 82, 'Bullet IP cameras', 35000, 2000, 5, 'Each', 0, '2022-11-01 12:33:38', '2022-11-01 12:33:38'),
(411, 82, 'Cat 6 cable', 75000, 0, 5, 'Roll', 0, '2022-11-01 12:33:38', '2022-11-01 12:33:38'),
(412, 82, 'Hard disk drive', 45000, 0, 1, 'Each', 0, '2022-11-01 12:33:38', '2022-11-01 12:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `service_waybill`
--

DROP TABLE IF EXISTS `service_waybill`;
CREATE TABLE IF NOT EXISTS `service_waybill` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `waybill_id` int(11) NOT NULL,
  `service_id` text COLLATE utf8mb4_unicode_ci,
  `invoice_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_waybill`
--

INSERT INTO `service_waybill` (`id`, `created_at`, `updated_at`, `waybill_id`, `service_id`, `invoice_id`, `qty`) VALUES
(5, '2020-05-24 20:39:57', '2020-05-24 20:39:57', 7, '162', 48, 2),
(6, '2020-05-24 20:39:57', '2020-05-24 20:39:57', 7, '163', 48, 1),
(7, '2021-09-14 21:02:39', '2021-09-14 21:02:39', 9, '199', 53, 1),
(8, '2021-09-14 21:02:39', '2021-09-14 21:02:39', 9, '200', 53, 1),
(9, '2021-09-14 21:02:39', '2021-09-14 21:02:39', 9, '201', 53, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sysconfigs`
--

DROP TABLE IF EXISTS `sysconfigs`;
CREATE TABLE IF NOT EXISTS `sysconfigs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `app_logo` text COLLATE utf8mb4_unicode_ci,
  `report_logo` text COLLATE utf8mb4_unicode_ci,
  `signatory` text COLLATE utf8mb4_unicode_ci,
  `signature` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sysconfigs_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sysconfigs`
--

INSERT INTO `sysconfigs` (`id`, `name`, `email`, `phone`, `address`, `description`, `app_logo`, `report_logo`, `signatory`, `signature`, `created_at`, `updated_at`) VALUES
(1, 'Jerion Technologies', 'biolajamez@gmail.com', '08182125134', 'Ajagunjeun Complex, Bode-Olude, Via FHE Elega, Abeokuta', 'Supply and Installation', 'logos/Lp90uMF5J9g72x0IVPGalCXJRFLzpFLWe86vWfVC.jpeg', 'logos/y9SNH5OH2KO6kXeiFul6aLGtLcfb6UvbNUImGmhZ.jpeg', 'Ope Babatunde, Managing Director', 'logos/H8gLBcXnIt76PuJADCMNEtOXPxDEwgS1kEF41inH.jpeg', '2020-06-27 18:50:41', '2020-06-27 18:50:41'),
(3, 'Jesom Technologies Ltd', 'segun@jesomtech.com', NULL, 'Oshodi, Lagos', 'IT specialist, Procurement', 'logos/BXhkKVdGJ41p7QTqSEfI3gccllhHdNzJfGiYU5Ap.png', 'logos/CrrmaxrKIjooG4qvStfRdt7L3vHCLVv6aJMEeqEW.png', 'Segun Ogundana', NULL, '2020-07-17 10:57:22', '2020-07-17 13:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `pass_code`) VALUES
(1, 'Appsolutions', 'admin@appsolutn.com', '$2y$10$Sk.J2RMaA8JpVgU0n8AJ5eNJ04q83L2mSDcSZO85tM5QQmHCgFGZy', 'MrcX6jJhqFHoOyU7GuQgpz42KY1d3Wy0M3oM6OnYZf20QWXeKTbmSlNtPgws', '2017-04-25 14:09:23', '2017-05-15 03:42:17', 'Appsolutions', ''),
(2, 'Fijabi Isaac Obayemi', 'fijabiisaaco@gmail.com', '$2y$10$TjeTxZleyK7eA/uXrs2kQuaMeKCzusPVOad.b3S17Pu59Q8CIh/Bq', 'yp4p8eJ1vdB91D2jyX1gCbhxm0mqxUvnpJiGfZUsUHXCAHIyqmCvO3ymmi78', '2017-04-26 15:54:05', '2018-02-05 14:19:41', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `waybills`
--

DROP TABLE IF EXISTS `waybills`;
CREATE TABLE IF NOT EXISTS `waybills` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `invoice_id` int(11) NOT NULL,
  `waybill_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issued_by` int(11) NOT NULL,
  `delivered_to` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `waybills`
--

INSERT INTO `waybills` (`id`, `created_at`, `updated_at`, `invoice_id`, `waybill_no`, `issued_by`, `delivered_to`) VALUES
(7, '2020-05-24 20:39:57', '2020-05-24 20:39:57', 48, 'W2-#48-1-191123', 1, NULL),
(8, '2020-05-24 20:55:18', '2020-05-24 20:55:18', 48, 'W2-#48-1-191123', 1, NULL),
(9, '2021-09-14 21:02:39', '2021-09-14 21:02:39', 53, 'W1-5053', 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

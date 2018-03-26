-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2018 at 12:36 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webkape`
--
DROP DATABASE IF EXISTS `webkape`;
CREATE DATABASE IF NOT EXISTS `webkape` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `webkape`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `a_id` int(11) NOT NULL,
  `a_address` varchar(140) NOT NULL,
  `ac_id` int(11) NOT NULL,
  `a_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `address`
--

TRUNCATE TABLE `address`;
--
-- Dumping data for table `address`
--

INSERT INTO `address` (`a_id`, `a_address`, `ac_id`, `a_created`) VALUES
(1, 'Unit 130 Kravia Bldg., Oceania Blvd.', 40, '2018-03-19 10:18:21'),
(2, 'Unit 23 Boul-le-Vard', 55, '2018-03-19 10:38:04'),
(3, 'Hashi-Hashi Bldg., Doroteo St.', 2, '2018-03-19 11:04:48'),
(4, 'Aria Bldg., Mizu Ave.', 42, '2018-03-19 11:08:07'),
(5, 'Unit 20 Kolor Bldg., Hawt St.', 56, '2018-03-19 11:10:20'),
(6, 'Corbin Roastery, Barabaza Street, Narra Subdivision', 90, '2018-03-20 06:08:51'),
(8, '146 Boliney Street', 2, '2018-03-21 03:35:12'),
(10, 'Marimba Street, Aria Avenue', 1, '2018-03-21 06:39:07'),
(11, '143 Baler Street, Macapagal Avenue', 4, '2018-03-21 06:47:21'),
(12, 'Sapphire Factory, Ramos Avenue', 5, '2018-03-21 06:50:14'),
(13, 'Bill\'s Packaging Aklan branch, Honorado Boulevard', 68, '2018-03-21 07:09:37'),
(14, 'Acongaua Street, Boliney Avenue', 110, '2018-03-21 08:52:01'),
(15, 'Meridian Packaging, Dela Rosa Street, Marianas Boulevard', 51, '2018-03-21 11:27:38'),
(16, 'Meridian Packaging, Dela Rosa Street, Marianas Boulevard', 51, '2018-03-21 11:31:19'),
(17, 'Block 2 Lot 1, Barangay Handaan', 54, '2018-03-21 12:21:27');

-- --------------------------------------------------------

--
-- Table structure for table `address_city`
--

DROP TABLE IF EXISTS `address_city`;
CREATE TABLE `address_city` (
  `ac_id` int(11) NOT NULL,
  `a_city` varchar(45) NOT NULL,
  `a_province` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `address_city`
--

TRUNCATE TABLE `address_city`;
--
-- Dumping data for table `address_city`
--

INSERT INTO `address_city` (`ac_id`, `a_city`, `a_province`) VALUES
(1, 'Bangued', 'Abra'),
(2, 'Boliney', 'Abra'),
(3, 'Bucay', 'Abra'),
(4, 'Bucloc', 'Abra'),
(5, 'Daguioman', 'Abra'),
(6, 'Danglas', 'Abra'),
(7, 'Dolores', 'Abra'),
(8, 'La Paz', 'Abra'),
(9, 'Lacub', 'Abra'),
(10, 'Lagangilang', 'Abra'),
(11, 'Lagayan', 'Abra'),
(12, 'Langiden', 'Abra'),
(13, 'Licuan-Baay (Licuan)', 'Abra'),
(14, 'Luba', 'Abra'),
(15, 'Malibcong', 'Abra'),
(16, 'Manabo', 'Abra'),
(17, 'Peñarrubia', 'Abra'),
(18, 'Pidigan', 'Abra'),
(19, 'Pilar', 'Abra'),
(20, 'Sallapadan', 'Abra'),
(21, 'San Isidro', 'Abra'),
(22, 'San Juan', 'Abra'),
(23, 'San Quintin', 'Abra'),
(24, 'Tayum', 'Abra'),
(25, 'Tineg', 'Abra'),
(26, 'Tubo', 'Abra'),
(27, 'Villaviciosa', 'Abra'),
(28, 'Buenavista', 'Agusan del Norte'),
(29, 'Butuan', 'Agusan del Norte'),
(30, 'Cabadbaran', 'Agusan del Norte'),
(31, 'Carmen', 'Agusan del Norte'),
(32, 'Jabonga', 'Agusan del Norte'),
(33, 'Kitcharao', 'Agusan del Norte'),
(34, 'Las Nieves', 'Agusan del Norte'),
(35, 'Magallanes', 'Agusan del Norte'),
(36, 'Nasipit', 'Agusan del Norte'),
(37, 'Remedios T. Romualdez', 'Agusan del Norte'),
(38, 'Santiago', 'Agusan del Norte'),
(39, 'Tubay', 'Agusan del Norte'),
(40, 'Bayugan', 'Agusan del Sur'),
(41, 'Bunawan', 'Agusan del Sur'),
(42, 'Esperanza', 'Agusan del Sur'),
(43, 'La Paz', 'Agusan del Sur'),
(44, 'Loreto', 'Agusan del Sur'),
(45, 'Prosperidad', 'Agusan del Sur'),
(46, 'Rosario', 'Agusan del Sur'),
(47, 'San Francisco', 'Agusan del Sur'),
(48, 'San Luis', 'Agusan del Sur'),
(49, 'Santa Josefa', 'Agusan del Sur'),
(50, 'Sibagat', 'Agusan del Sur'),
(51, 'Talacogon', 'Agusan del Sur'),
(52, 'Trento', 'Agusan del Sur'),
(53, 'Veruela', 'Agusan del Sur'),
(54, 'Altavas', 'Aklan'),
(55, 'Balete', 'Aklan'),
(56, 'Banga', 'Aklan'),
(57, 'Batan', 'Aklan'),
(58, 'Buruanga', 'Aklan'),
(59, 'Ibajay', 'Aklan'),
(60, 'Kalibo', 'Aklan'),
(61, 'Lezo', 'Aklan'),
(62, 'Libacao', 'Aklan'),
(63, 'Madalag', 'Aklan'),
(64, 'Makato', 'Aklan'),
(65, 'Malay', 'Aklan'),
(66, 'Malinao', 'Aklan'),
(67, 'Nabas', 'Aklan'),
(68, 'New Washington', 'Aklan'),
(69, 'Numancia', 'Aklan'),
(70, 'Tangalan', 'Aklan'),
(71, 'Bacacay', 'Albay'),
(72, 'Camalig', 'Albay'),
(73, 'Daraga (Locsin)', 'Albay'),
(74, 'Guinobatan', 'Albay'),
(75, 'Jovellar', 'Albay'),
(76, 'Legazpi', 'Albay'),
(77, 'Libon', 'Albay'),
(78, 'Ligao', 'Albay'),
(79, 'Malilipot', 'Albay'),
(80, 'Malinao', 'Albay'),
(81, 'Manito', 'Albay'),
(82, 'Oas', 'Albay'),
(83, 'Pio Duran (Malacbalac)', 'Albay'),
(84, 'Polangui', 'Albay'),
(85, 'Rapu-Rapu', 'Albay'),
(86, 'Santo Domingo (Libog)', 'Albay'),
(87, 'Tabaco', 'Albay'),
(88, 'Tiwi', 'Albay'),
(89, 'Anini-y', 'Antique'),
(90, 'Barbaza', 'Antique'),
(91, 'Belison', 'Antique'),
(92, 'Bugasong', 'Antique'),
(93, 'Caluya', 'Antique'),
(94, 'Culasi', 'Antique'),
(95, 'Hamtic', 'Antique'),
(96, 'Laua-an', 'Antique'),
(97, 'Libertad', 'Antique'),
(98, 'Pandan', 'Antique'),
(99, 'Patnongon', 'Antique'),
(100, 'San Jose de Buenavista', 'Antique'),
(101, 'San Remigio', 'Antique'),
(102, 'Sebaste', 'Antique'),
(103, 'Sibalom', 'Antique'),
(104, 'Tibiao', 'Antique'),
(105, 'Tobias Fornier (Dao)', 'Antique'),
(106, 'Valderrama', 'Antique'),
(107, 'Calanasan (Bayag)', 'Apayao'),
(108, 'Conner', 'Apayao'),
(109, 'Flora', 'Apayao'),
(110, 'Kabugao', 'Apayao'),
(111, 'Luna', 'Apayao'),
(112, 'Pudtol', 'Apayao'),
(113, 'Santa Marcela', 'Apayao'),
(114, 'Baler', 'Aurora'),
(115, 'Casiguran', 'Aurora'),
(116, 'Dilasag', 'Aurora'),
(117, 'Dinalungan', 'Aurora'),
(118, 'Dingalan', 'Aurora'),
(119, 'Dipaculao', 'Aurora'),
(120, 'Maria Aurora', 'Aurora'),
(121, 'San Luis', 'Aurora');

-- --------------------------------------------------------

--
-- Table structure for table `beans`
--

DROP TABLE IF EXISTS `beans`;
CREATE TABLE `beans` (
  `b_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `b_roast` varchar(45) NOT NULL,
  `b_desc` text NOT NULL,
  `b_open` tinyint(1) NOT NULL,
  `b_roastdate` date NOT NULL,
  `b_origin` varchar(45) NOT NULL,
  `b_unitprice` decimal(9,2) NOT NULL,
  `b_deliverfrom` int(11) NOT NULL,
  `b_orderdays` int(11) NOT NULL,
  `b_minqty` decimal(9,2) NOT NULL,
  `b_created` datetime NOT NULL,
  `b_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `beans`
--

TRUNCATE TABLE `beans`;
--
-- Dumping data for table `beans`
--

INSERT INTO `beans` (`b_id`, `s_id`, `b_roast`, `b_desc`, `b_open`, `b_roastdate`, `b_origin`, `b_unitprice`, `b_deliverfrom`, `b_orderdays`, `b_minqty`, `b_created`, `b_updated`) VALUES
(1, 1, 'Medium', 'A rare blend that brings bittersweetness and fruitiness to your palate. Exclusive to House of Cosbys, this is made with local ingredients to ensure availability!', 1, '2018-03-12', 'Canada', '173.99', 2, 4, '160.00', '2018-03-19 10:38:04', '2018-03-19 10:38:04'),
(2, 3, 'Medium', 'Grab freshly roasted coffee beans right from our store! We make sure it\'s fresh for up to two weeks! It\'ll be a discount if so.', 1, '2018-03-12', '146 Boliney Street, Boliney, Abra', '153.78', 8, 2, '0.75', '2018-03-21 04:53:49', '2018-03-21 04:53:49');

-- --------------------------------------------------------

--
-- Table structure for table `beans_additions`
--

DROP TABLE IF EXISTS `beans_additions`;
CREATE TABLE `beans_additions` (
  `b_additionsid` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `b_additions` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `beans_additions`
--

TRUNCATE TABLE `beans_additions`;
--
-- Dumping data for table `beans_additions`
--

INSERT INTO `beans_additions` (`b_additionsid`, `b_id`, `b_additions`) VALUES
(1, 1, 'cherry extract'),
(2, 1, 'ampalaya extract'),
(3, 1, 'orange zest'),
(4, 2, 'mangosteen');

-- --------------------------------------------------------

--
-- Table structure for table `beans_roast_list`
--

DROP TABLE IF EXISTS `beans_roast_list`;
CREATE TABLE `beans_roast_list` (
  `b_roast` varchar(45) NOT NULL,
  `br_desc` varchar(280) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `beans_roast_list`
--

TRUNCATE TABLE `beans_roast_list`;
--
-- Dumping data for table `beans_roast_list`
--

INSERT INTO `beans_roast_list` (`b_roast`, `br_desc`) VALUES
('Black', 'The black bean has a shiny surface with the most burnt bitter tones.'),
('Dark', 'The deep-brownish, almost black bean has a shiny surface with spots of oil. Acidity is muted, caffeine is minimal, and there is bittersweetness with hints of roasted wood.'),
('Green', 'Unroasted coffee is usually prepared with slimming formulas, where additional ingredients are abundant.'),
('Light', 'Heated for a short period of time, the roast brings an earthy, grainy, and acidic flavor. It also contains more caffeine than other roasts.'),
('Medium', 'This roast has a more \'balanced\' acidity with a \'fuller\' body. The medium-brown bean should have no oil at its surface.'),
('Medium-dark', 'The rich brown bean has droplets of oil on its surface. There is a bit of bittersweetness from the roast, while its acidity is muted with a heavier body.'),
('Medium-light', 'Green coffee is distinguishable here, where the bean surface is dry with a moderately light brown color. It brings a sweet and bright acidity to the cup.'),
('Very dark', 'The black bean is covered brightly with oil, where bitter tones are more prominent than sweet ones. Nothing about the green bean flavor is kept in its thin body.');

-- --------------------------------------------------------

--
-- Table structure for table `beans_species`
--

DROP TABLE IF EXISTS `beans_species`;
CREATE TABLE `beans_species` (
  `b_speciesid` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `b_species` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `beans_species`
--

TRUNCATE TABLE `beans_species`;
--
-- Dumping data for table `beans_species`
--

INSERT INTO `beans_species` (`b_speciesid`, `b_id`, `b_species`) VALUES
(1, 1, 'Excelsa'),
(2, 1, 'Liberica'),
(3, 2, 'Arabica');

-- --------------------------------------------------------

--
-- Table structure for table `beans_species_list`
--

DROP TABLE IF EXISTS `beans_species_list`;
CREATE TABLE `beans_species_list` (
  `b_species` varchar(45) NOT NULL,
  `bs_desc` varchar(280) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `beans_species_list`
--

TRUNCATE TABLE `beans_species_list`;
--
-- Dumping data for table `beans_species_list`
--

INSERT INTO `beans_species_list` (`b_species`, `bs_desc`) VALUES
('Arabica', 'Used by specialty coffee shops for their taste and aroma. Needs special characteristics in its soil to grow. Cultivated in the highlands, it can grow only in colder temperatures and is particularly vulnerable to the drier months.'),
('Excelsa', 'A distant relative of Liberica, it instead offers a fruity flavor with almost no caffeine.'),
('Liberica', 'Bitter taste and aroma are powerful in this species, hence the label, \"Kapeng Barako.\" This species serves a niche market in the country.'),
('Robusta', 'Has high tolerance against disease and pests. The national standard for commercial or instant coffee. Thrives in warm climates and low precipitation, especially during colder months.');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `m_id` int(11) NOT NULL,
  `m_fname` varchar(45) NOT NULL,
  `m_mname` varchar(45) NOT NULL,
  `m_lname` varchar(45) NOT NULL,
  `m_cellno` varchar(11) NOT NULL,
  `m_telno` varchar(7) NOT NULL DEFAULT '0',
  `m_email` varchar(512) NOT NULL DEFAULT '',
  `m_created` datetime NOT NULL,
  `m_updated` datetime NOT NULL,
  `m_office` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `member`
--

TRUNCATE TABLE `member`;
--
-- Dumping data for table `member`
--

INSERT INTO `member` (`m_id`, `m_fname`, `m_mname`, `m_lname`, `m_cellno`, `m_telno`, `m_email`, `m_created`, `m_updated`, `m_office`) VALUES
(1, 'Mitchell', 'Billy', 'Jones', '', '0', '', '2018-03-19 10:18:21', '2018-03-19 10:18:21', 1),
(2, 'Maria', 'Abalos', 'Guimaras', '', '0', '', '2018-03-19 11:10:20', '2018-03-19 11:10:20', 5),
(4, 'Patrick', 'Jerome', 'Mata', '', '0', '', '2018-03-21 03:35:12', '2018-03-21 03:35:12', 8);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `msg_subject` varchar(140) NOT NULL,
  `msg_body` text NOT NULL,
  `msg_read` tinyint(1) NOT NULL,
  `msg_sender` int(11) NOT NULL,
  `msg_recipient` int(11) NOT NULL,
  `msg_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `message`
--

TRUNCATE TABLE `message`;
-- --------------------------------------------------------

--
-- Table structure for table `message_attach`
--

DROP TABLE IF EXISTS `message_attach`;
CREATE TABLE `message_attach` (
  `msga_id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `msga_slug` varchar(280) NOT NULL,
  `msga_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `message_attach`
--

TRUNCATE TABLE `message_attach`;
-- --------------------------------------------------------

--
-- Table structure for table `message_attach_type`
--

DROP TABLE IF EXISTS `message_attach_type`;
CREATE TABLE `message_attach_type` (
  `msga_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `message_attach_type`
--

TRUNCATE TABLE `message_attach_type`;
--
-- Dumping data for table `message_attach_type`
--

INSERT INTO `message_attach_type` (`msga_type`) VALUES
('document'),
('picture');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `n_id` int(11) NOT NULL,
  `n_type` varchar(45) NOT NULL,
  `n_ticker` varchar(45) NOT NULL,
  `n_recipient` int(11) NOT NULL,
  `n_slug` varchar(280) NOT NULL,
  `n_read` tinyint(1) NOT NULL,
  `n_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `notification`
--

TRUNCATE TABLE `notification`;
--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`n_id`, `n_type`, `n_ticker`, `n_recipient`, `n_slug`, `n_read`, `n_created`) VALUES
(1, 'request', 'Added new request', 1, 'orders/pack/Maria+House_of_Cosbys+2', 0, '2018-03-19 11:15:29'),
(2, 'request', 'Added new request', 1, 'orders/proc/Maria+House_of_Cosbys+1', 0, '2018-03-19 11:18:09'),
(3, 'request', 'Placed new order', 2, 'orders/proc/Maria+House_of_Cosbys+1', 0, '2018-03-19 11:28:46'),
(4, 'request', 'Delivery ongoing', 2, 'orders/proc/Maria+House_of_Cosbys+1', 0, '2018-03-19 11:29:29'),
(5, 'request', 'Received order', 1, 'orders/proc/Maria+House_of_Cosbys+1', 0, '2018-03-19 11:30:09'),
(6, 'request', 'Completed order', 2, 'orders/proc/Maria+House_of_Cosbys+1', 0, '2018-03-19 11:30:44'),
(7, 'request', 'Negotiation ongoing', 2, 'orders/pack/Maria+House_of_Cosbys+2', 0, '2018-03-19 11:31:56'),
(8, 'request', 'Placed new order', 1, 'orders/pack/Maria+House_of_Cosbys+2', 0, '2018-03-19 11:32:52'),
(9, 'request', 'Delivery ongoing', 2, 'orders/pack/Maria+House_of_Cosbys+2', 0, '2018-03-19 11:33:58'),
(10, 'request', 'Received order', 1, 'orders/pack/Maria+House_of_Cosbys+2', 0, '2018-03-19 11:34:24'),
(11, 'request', 'Completed order', 2, 'orders/pack/Maria+House_of_Cosbys+2', 0, '2018-03-19 11:34:47'),
(12, 'request', 'Added new request', 1, 'orders/roast/Maria+House_of_Cosbys+1', 0, '2018-03-20 06:13:00'),
(13, 'request', 'Rejected order', 2, 'orders/roast/Maria+House_of_Cosbys+1', 0, '2018-03-20 06:16:18'),
(14, 'request', 'Added new request', 1, 'orders/roast/Maria+House_of_Cosbys+2', 0, '2018-03-20 06:17:02'),
(15, 'request', 'Added new request', 1, 'orders/roast/Maria+House_of_Cosbys+3', 0, '2018-03-20 06:33:23'),
(33, 'request', 'Added new request', 1, 'orders/roast/Maria+House_of_Cosbys+21', 0, '2018-03-20 07:04:00'),
(34, 'request', 'Added new request', 1, 'orders/roast/Maria+House_of_Cosbys+22', 0, '2018-03-20 07:05:50'),
(35, 'request', 'Rejected order', 2, 'orders/roast/Maria+House_of_Cosbys+22', 0, '2018-03-20 13:26:36'),
(46, 'request', 'Added new request', 1, 'orders/beans/Patrick+House_of_Cosbys+11', 0, '2018-03-21 08:48:52'),
(47, 'request', 'Added new request', 1, 'orders/beans/Patrick+House_of_Cosbys+12', 0, '2018-03-21 08:52:01'),
(52, 'request', 'Negotiation ongoing', 1, 'orders/beans/Patrick+House_of_Cosbys+12', 0, '2018-03-21 09:38:13'),
(53, 'request', 'Placed new order', 4, 'orders/beans/Patrick+House_of_Cosbys+12', 0, '2018-03-21 09:40:56'),
(54, 'request', 'Delivery ongoing', 4, 'orders/beans/Patrick+House_of_Cosbys+12', 0, '2018-03-21 09:43:16'),
(55, 'request', 'Delivery ongoing', 4, 'orders/beans/Patrick+House_of_Cosbys+12', 0, '2018-03-21 09:44:52'),
(56, 'request', 'Received order', 1, 'orders/beans/Patrick+House_of_Cosbys+12', 0, '2018-03-21 09:50:17'),
(57, 'request', 'Received order', 1, 'orders/beans/Patrick+House_of_Cosbys+12', 0, '2018-03-21 09:53:19'),
(58, 'request', 'Completed order', 4, 'orders/beans/Patrick+House_of_Cosbys+12', 0, '2018-03-21 09:53:39'),
(59, 'request', 'Added new request', 4, 'orders/beans/Mitchell+Mabuhay_Cafe+13', 0, '2018-03-21 09:58:57'),
(60, 'request', 'Negotiation ongoing', 1, 'orders/beans/Mitchell+Mabuhay_Cafe+13', 0, '2018-03-21 10:01:35'),
(61, 'request', 'Negotiation ongoing', 1, 'orders/beans/Mitchell+Mabuhay_Cafe+13', 0, '2018-03-21 10:03:30'),
(62, 'request', 'Placed new order', 4, 'orders/beans/Mitchell+Mabuhay_Cafe+13', 0, '2018-03-21 10:09:53'),
(63, 'request', 'Delivery ongoing', 1, 'orders/beans/Mitchell+Mabuhay_Cafe+13', 0, '2018-03-21 10:12:31'),
(64, 'request', 'Received order', 4, 'orders/beans/Mitchell+Mabuhay_Cafe+13', 0, '2018-03-21 10:14:56'),
(65, 'request', 'Completed order', 1, 'orders/beans/Mitchell+Mabuhay_Cafe+13', 0, '2018-03-21 10:15:51'),
(66, 'request', 'Added new request', 4, 'orders/pack/Maria+Mabuhay_Cafe+3', 0, '2018-03-21 10:54:47'),
(67, 'request', 'Negotiation ongoing', 2, 'orders/pack/Maria+Mabuhay_Cafe+3', 0, '2018-03-21 11:00:26'),
(68, 'request', 'Rejected order', 4, 'orders/beans/Patrick+House_of_Cosbys+11', 0, '2018-03-21 11:01:08'),
(69, 'request', 'Placed new order', 4, 'orders/pack/Maria+Mabuhay_Cafe+3', 0, '2018-03-21 11:02:23'),
(70, 'request', 'Delivery ongoing', 2, 'orders/pack/Maria+Mabuhay_Cafe+3', 0, '2018-03-21 11:12:05'),
(71, 'request', 'Received order', 4, 'orders/pack/Maria+Mabuhay_Cafe+3', 0, '2018-03-21 11:13:21'),
(72, 'request', 'Completed order', 2, 'orders/pack/Maria+Mabuhay_Cafe+3', 0, '2018-03-21 11:13:47'),
(74, 'request', 'Added new request', 4, 'orders/roast/Mitchell+Mabuhay_Cafe+24', 0, '2018-03-21 11:31:19'),
(75, 'request', 'Negotiation ongoing', 1, 'orders/roast/Mitchell+Mabuhay_Cafe+24', 0, '2018-03-21 11:42:15'),
(76, 'request', 'Negotiation ongoing', 4, 'orders/roast/Mitchell+Mabuhay_Cafe+24', 0, '2018-03-21 11:45:54'),
(77, 'request', 'Placed new order', 1, 'orders/roast/Mitchell+Mabuhay_Cafe+24', 0, '2018-03-21 11:47:01'),
(78, 'request', 'Delivery ongoing', 1, 'orders/roast/Mitchell+Mabuhay_Cafe+24', 0, '2018-03-21 11:47:53'),
(79, 'request', 'Received order', 4, 'orders/roast/Mitchell+Mabuhay_Cafe+24', 0, '2018-03-21 11:48:19'),
(80, 'request', 'Completed order', 1, 'orders/roast/Mitchell+Mabuhay_Cafe+24', 0, '2018-03-21 11:48:49'),
(81, 'request', 'Added new request', 4, 'orders/proc/Maria+Mabuhay_Cafe+2', 0, '2018-03-21 12:21:27'),
(82, 'request', 'Negotiation ongoing', 2, 'orders/proc/Maria+Mabuhay_Cafe+2', 0, '2018-03-21 12:25:14'),
(83, 'request', 'Placed new order', 4, 'orders/proc/Maria+Mabuhay_Cafe+2', 0, '2018-03-21 12:25:49'),
(84, 'request', 'Delivery ongoing', 2, 'orders/proc/Maria+Mabuhay_Cafe+2', 0, '2018-03-21 12:27:01'),
(85, 'request', 'Received order', 4, 'orders/proc/Maria+Mabuhay_Cafe+2', 0, '2018-03-21 12:27:22'),
(86, 'request', 'Completed order', 2, 'orders/proc/Maria+Mabuhay_Cafe+2', 0, '2018-03-21 12:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `notification_type`
--

DROP TABLE IF EXISTS `notification_type`;
CREATE TABLE `notification_type` (
  `n_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `notification_type`
--

TRUNCATE TABLE `notification_type`;
--
-- Dumping data for table `notification_type`
--

INSERT INTO `notification_type` (`n_type`) VALUES
('message'),
('request');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
CREATE TABLE `package` (
  `pk_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `pk_desc` text NOT NULL,
  `pk_type` varchar(45) NOT NULL,
  `pk_material` varchar(45) NOT NULL,
  `pk_capacity` decimal(9,2) NOT NULL,
  `pk_color` varchar(45) NOT NULL,
  `pk_unitprice` decimal(9,2) NOT NULL,
  `pk_qtyperunit` int(9) NOT NULL,
  `pk_open` tinyint(1) NOT NULL,
  `pk_address` int(11) NOT NULL,
  `pk_orderdays` int(11) NOT NULL,
  `pk_minqty` int(9) NOT NULL,
  `pk_created` datetime NOT NULL,
  `pk_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `package`
--

TRUNCATE TABLE `package`;
--
-- Dumping data for table `package`
--

INSERT INTO `package` (`pk_id`, `s_id`, `pk_desc`, `pk_type`, `pk_material`, `pk_capacity`, `pk_color`, `pk_unitprice`, `pk_qtyperunit`, `pk_open`, `pk_address`, `pk_orderdays`, `pk_minqty`, `pk_created`, `pk_updated`) VALUES
(1, 1, 'Low-cost packages that pose a striking color that helps you stand out of the shelf!\r\nWe accept custom-color designs on every order.', 'Doypack', 'Polyethylene (PET)', '500.00', 'Blue', '59.99', 12, 1, 3, 3, 1, '2018-03-19 11:04:48', '2018-03-19 11:04:48'),
(3, 3, 'The quality of our bags is guaranteed to seal freshness like that of metallized silver, but with a silver color that provides a premium-looking option for less.\r\n[This product already comes with gas-release valve.]', 'Flat-bottom bag', 'Polyethylene (PET)', '450.00', 'Silver', '400.00', 6, 1, 10, 2, 0, '2018-03-21 06:39:07', '2018-03-21 06:39:07'),
(4, 1, 'Courtesy of Bill\'s Packaging, the Cosbys bring you: a premium packaging for single-serving customers. And yes, you may inquire for a free sample!', 'Quad seal bag', 'Aluminum foil (Foil)', '600.00', 'Matte black', '134.22', 3, 1, 13, 4, 0, '2018-03-21 07:09:37', '2018-03-21 07:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `package_material_list`
--

DROP TABLE IF EXISTS `package_material_list`;
CREATE TABLE `package_material_list` (
  `pk_material` varchar(45) NOT NULL,
  `pkmat_desc` varchar(280) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `package_material_list`
--

TRUNCATE TABLE `package_material_list`;
--
-- Dumping data for table `package_material_list`
--

INSERT INTO `package_material_list` (`pk_material`, `pkmat_desc`) VALUES
('Aluminum foil (Foil)', 'Contains the best barrier properties for keeping coffee fresh, it is also the most expensive.'),
('Custom', 'Can\'t describe it? Just put it in the description.'),
('Metallized silver (VMPET)', 'Not as secure as foil when it comes to freshness, it makes up for it with its ability to return back to shape.'),
('Polyethylene (PET)', 'An inexpensive, common plastic that offers moderate sealing of freshness.');

-- --------------------------------------------------------

--
-- Table structure for table `package_option`
--

DROP TABLE IF EXISTS `package_option`;
CREATE TABLE `package_option` (
  `pk_optionid` int(11) NOT NULL,
  `pk_id` int(11) NOT NULL,
  `pk_option` varchar(45) NOT NULL,
  `pkopt_price` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `package_option`
--

TRUNCATE TABLE `package_option`;
--
-- Dumping data for table `package_option`
--

INSERT INTO `package_option` (`pk_optionid`, `pk_id`, `pk_option`, `pkopt_price`) VALUES
(1, 1, 'Fill with beans', '0.00'),
(2, 1, 'Gas release valve', '5.00'),
(3, 1, 'Hang hole', '0.00'),
(4, 3, 'Fill with beans', '0.00'),
(5, 3, 'Ties or tape', '0.00'),
(6, 4, 'Fill with beans', '0.00'),
(7, 4, 'Gas release valve', '0.00'),
(8, 4, 'Nitrogen gas-flushing', '0.00'),
(9, 4, 'Ties or tape', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `package_option_list`
--

DROP TABLE IF EXISTS `package_option_list`;
CREATE TABLE `package_option_list` (
  `pk_option` varchar(45) NOT NULL,
  `pkopt_desc` varchar(280) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `package_option_list`
--

TRUNCATE TABLE `package_option_list`;
--
-- Dumping data for table `package_option_list`
--

INSERT INTO `package_option_list` (`pk_option`, `pkopt_desc`) VALUES
('Fill with beans', 'The supplier providing the package can fill it with the beans you provide, which should be confirmed before the order is considered \'sent\'.'),
('Gas release valve', 'A valve that keeps certain air chemicals out of the bag, while keeping the ones that retain moisture and aroma. Commonly used option for regular customers.'),
('Hang hole', 'Used in stores and even homes to set the pouches on display.'),
('Nitrogen gas-flushing', 'A method that effectively preserves coffee for use through a really long period of time. It is ideal for those who drink coffee less frequently.'),
('Ties or tape', 'An even simpler way to seal freshness for any kind of pouch, in case zippers cannot be used.'),
('Zippers/ziplock', 'A secure way to keep freshness intact after the first use.');

-- --------------------------------------------------------

--
-- Table structure for table `package_type_list`
--

DROP TABLE IF EXISTS `package_type_list`;
CREATE TABLE `package_type_list` (
  `pk_type` varchar(45) NOT NULL,
  `pktype_desc` varchar(280) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `package_type_list`
--

TRUNCATE TABLE `package_type_list`;
--
-- Dumping data for table `package_type_list`
--

INSERT INTO `package_type_list` (`pk_type`, `pktype_desc`) VALUES
('Bag-in-bag', 'An unconventional packaging format where smaller bags of coffee go in a bigger one. It is best to explain their dimensions in your description.'),
('Doypack', 'A traditional packaging format that leads quality through its appearance, while requiring premade pouch-filling equipment.'),
('Flat-bottom bag', 'A brick-shaped, standing bag with the top folded and sealed.'),
('Pillow bag', 'A small package used for single-serving coffee products, which is also the least costly to produce.'),
('Quad seal bag', 'A standing bag with side seals and support for heavier capacities of coffee.');

-- --------------------------------------------------------

--
-- Table structure for table `processing`
--

DROP TABLE IF EXISTS `processing`;
CREATE TABLE `processing` (
  `proc_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `proc_desc` text NOT NULL,
  `proc_activity` varchar(45) NOT NULL,
  `proc_unitprice` decimal(9,2) NOT NULL,
  `proc_open` tinyint(1) NOT NULL,
  `proc_address` int(11) NOT NULL,
  `proc_orderdays` int(11) NOT NULL,
  `proc_minqty` decimal(9,2) NOT NULL,
  `proc_created` datetime NOT NULL,
  `proc_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `processing`
--

TRUNCATE TABLE `processing`;
--
-- Dumping data for table `processing`
--

INSERT INTO `processing` (`proc_id`, `s_id`, `proc_desc`, `proc_activity`, `proc_unitprice`, `proc_open`, `proc_address`, `proc_orderdays`, `proc_minqty`, `proc_created`, `proc_updated`) VALUES
(1, 1, 'Our service in Esperanza is best for handling specialty beans like Arabica, because we ensure following the standards of fully washing coffee beans.\r\nFor proof, see our certificates sections at [http://cosbyscoffee.com/awards].', 'Full washing', '34.99', 1, 4, 3, '100.00', '2018-03-19 11:08:07', '2018-03-19 11:08:07'),
(2, 3, 'Our partnering cooperative offers some of the fastest washing processors available, even in larger volumes.', 'Semi-washing', '67.89', 1, 12, 2, '0.00', '2018-03-21 06:50:14', '2018-03-21 06:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `processing_activity`
--

DROP TABLE IF EXISTS `processing_activity`;
CREATE TABLE `processing_activity` (
  `proc_activity` varchar(45) NOT NULL,
  `procact_desc` varchar(280) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `processing_activity`
--

TRUNCATE TABLE `processing_activity`;
--
-- Dumping data for table `processing_activity`
--

INSERT INTO `processing_activity` (`proc_activity`, `procact_desc`) VALUES
('Full washing', 'Coffee cherry pulp and mucilage are thoroughly washed away, utilizing fermentation first for the latter. This process best preserves coffee bean flavor.'),
('Hulling and milling', 'Optional step in processing where the parchment of the dried coffee is removed.'),
('Natural drying', 'Picked coffee cherries are left to dry under the heat of the sun. It brings a fruity characteristic to the coffee.'),
('Semi-washing', 'Coffee cherry pulp is removed in water, while mucilage is removed directly. With less time spent, the coffee bean is then put to dry.');

-- --------------------------------------------------------

--
-- Table structure for table `request_beans`
--

DROP TABLE IF EXISTS `request_beans`;
CREATE TABLE `request_beans` (
  `rb_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `rb_quantity` decimal(9,2) NOT NULL,
  `rb_duedate` date NOT NULL,
  `rb_deliverto` int(11) NOT NULL,
  `rb_delivernotes` text NOT NULL,
  `s_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `rb_status` tinyint(1) NOT NULL,
  `rb_refund` decimal(3,2) NOT NULL,
  `rb_created` datetime NOT NULL,
  `rb_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_beans`
--

TRUNCATE TABLE `request_beans`;
--
-- Dumping data for table `request_beans`
--

INSERT INTO `request_beans` (`rb_id`, `b_id`, `rb_quantity`, `rb_duedate`, `rb_deliverto`, `rb_delivernotes`, `s_id`, `m_id`, `rb_status`, `rb_refund`, `rb_created`, `rb_updated`) VALUES
(11, 1, '200.00', '2018-03-27', 8, '', 1, 4, 6, '0.00', '2018-03-21 08:48:52', '2018-03-21 11:01:08'),
(12, 1, '190.00', '2018-03-26', 14, '', 1, 4, 5, '0.00', '2018-03-21 08:52:01', '2018-03-21 09:53:39'),
(13, 2, '3.75', '2018-03-25', 1, '', 3, 1, 5, '0.00', '2018-03-21 09:58:57', '2018-03-21 10:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `request_beans_shipping`
--

DROP TABLE IF EXISTS `request_beans_shipping`;
CREATE TABLE `request_beans_shipping` (
  `rbsh_id` int(11) NOT NULL,
  `rb_id` int(11) NOT NULL,
  `rbsh_courier` varchar(90) NOT NULL,
  `rbsh_trackno` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_beans_shipping`
--

TRUNCATE TABLE `request_beans_shipping`;
--
-- Dumping data for table `request_beans_shipping`
--

INSERT INTO `request_beans_shipping` (`rbsh_id`, `rb_id`, `rbsh_courier`, `rbsh_trackno`) VALUES
(1, 12, 'LBC', 'T00H4WTTOH3NDL'),
(2, 12, 'LBC', 'T00H4WTTOH3NDL'),
(3, 13, 'Own courier', '0');

-- --------------------------------------------------------

--
-- Table structure for table `request_beans_status`
--

DROP TABLE IF EXISTS `request_beans_status`;
CREATE TABLE `request_beans_status` (
  `rb_status` tinyint(1) NOT NULL,
  `rbs_mdesc` varchar(140) NOT NULL,
  `rbs_sdesc` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_beans_status`
--

TRUNCATE TABLE `request_beans_status`;
--
-- Dumping data for table `request_beans_status`
--

INSERT INTO `request_beans_status` (`rb_status`, `rbs_mdesc`, `rbs_sdesc`) VALUES
(0, 'Waiting for evaluation', 'For your evaluation'),
(1, 'For your evaluation', 'Waiting for evaluation'),
(2, 'Order being made', 'Order pending'),
(3, 'Awaiting delivery', 'Order being delivered'),
(4, 'Payment needed', 'Awaiting payment'),
(5, 'Order completed', 'Order completed'),
(6, 'Order rejected', 'Order rejected'),
(7, 'Order canceled', 'Order canceled'),
(8, 'Order returning', 'Awaiting return'),
(9, 'Order returned', 'Order returned');

-- --------------------------------------------------------

--
-- Table structure for table `request_history`
--

DROP TABLE IF EXISTS `request_history`;
CREATE TABLE `request_history` (
  `rh_id` int(11) NOT NULL,
  `rh_reqid` int(11) NOT NULL,
  `rh_type` varchar(45) NOT NULL,
  `rh_changecol` varchar(255) NOT NULL,
  `rh_changeval` varchar(255) NOT NULL,
  `rh_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_history`
--

TRUNCATE TABLE `request_history`;
--
-- Dumping data for table `request_history`
--

INSERT INTO `request_history` (`rh_id`, `rh_reqid`, `rh_type`, `rh_changecol`, `rh_changeval`, `rh_created`) VALUES
(2, 2, 'pack', 'pk_id', '1', '2018-03-19 11:15:29'),
(3, 2, 'pack', 'rpk_quantity', '5', '2018-03-19 11:15:29'),
(4, 2, 'pack', 'rpk_packnotes', 'Print the label I will send you.', '2018-03-19 11:15:29'),
(5, 2, 'pack', 'rpk_duedate', '2018-03-23', '2018-03-19 11:15:29'),
(6, 2, 'pack', 'rpk_deliverto', '5', '2018-03-19 11:15:29'),
(7, 2, 'pack', 'rpk_delivernotes', 'Do not place on the floor; wait for instructions from our personnel as you arrive.', '2018-03-19 11:15:29'),
(8, 2, 'pack', 's_id', '1', '2018-03-19 11:15:29'),
(9, 2, 'pack', 'm_id', '2', '2018-03-19 11:15:29'),
(10, 2, 'pack', 'rpk_status', '0', '2018-03-19 11:15:29'),
(11, 2, 'pack', 'rpk_refund', '0', '2018-03-19 11:15:29'),
(12, 2, 'pack', 'rpk_created', '2018-03-19 11:15:29', '2018-03-19 11:15:29'),
(13, 2, 'pack', 'rpk_updated', '2018-03-19 11:15:29', '2018-03-19 11:15:29'),
(14, 2, 'pack', 'rpk_option', 'Fill with beans, Hang hole', '2018-03-19 11:15:29'),
(15, 2, 'pack', 'pk_desc', 'Low-cost packages that pose a striking color that helps you stand out of the shelf!\r\nWe accept custom-color designs on every order.', '2018-03-19 11:15:29'),
(16, 2, 'pack', 'pk_type', 'Doypack', '2018-03-19 11:15:29'),
(17, 2, 'pack', 'pk_material', 'Polyethylene (PET)', '2018-03-19 11:15:29'),
(18, 2, 'pack', 'pk_capacity', '500.00', '2018-03-19 11:15:29'),
(19, 2, 'pack', 'pk_color', 'Blue', '2018-03-19 11:15:29'),
(20, 2, 'pack', 'pk_unitprice', '59.99', '2018-03-19 11:15:29'),
(21, 2, 'pack', 'pk_qtyperunit', '12', '2018-03-19 11:15:29'),
(22, 2, 'pack', 'pk_open', '1', '2018-03-19 11:15:29'),
(23, 2, 'pack', 'pk_address', '3', '2018-03-19 11:15:29'),
(24, 2, 'pack', 'pk_orderdays', '3', '2018-03-19 11:15:29'),
(25, 2, 'pack', 'pk_minqty', '1', '2018-03-19 11:15:29'),
(26, 2, 'pack', 'pk_created', '2018-03-19 11:04:48', '2018-03-19 11:15:29'),
(27, 2, 'pack', 'pk_updated', '2018-03-19 11:04:48', '2018-03-19 11:15:29'),
(28, 2, 'pack', 's_editdays', '3', '2018-03-19 11:15:29'),
(29, 2, 'pack', 's_returndays', '30', '2018-03-19 11:15:29'),
(30, 2, 'pack', 'a_id', '5', '2018-03-19 11:15:29'),
(31, 2, 'pack', 'a_address', 'Unit 20 Kolor Bldg., Hawt St.', '2018-03-19 11:15:29'),
(32, 2, 'pack', 'ac_id', '56', '2018-03-19 11:15:29'),
(33, 2, 'pack', 'a_created', '2018-03-19 11:10:20', '2018-03-19 11:15:29'),
(34, 1, 'proc', 'proc_id', '1', '2018-03-19 11:18:09'),
(35, 1, 'proc', 'rproc_procnotes', '', '2018-03-19 11:18:09'),
(36, 1, 'proc', 'rproc_quantity', '130.00', '2018-03-19 11:18:09'),
(37, 1, 'proc', 'rproc_duedate', '2018-03-26', '2018-03-19 11:18:09'),
(38, 1, 'proc', 'rproc_deliverto', '5', '2018-03-19 11:18:09'),
(39, 1, 'proc', 'rproc_delivernotes', '', '2018-03-19 11:18:09'),
(40, 1, 'proc', 's_id', '1', '2018-03-19 11:18:09'),
(41, 1, 'proc', 'm_id', '2', '2018-03-19 11:18:09'),
(42, 1, 'proc', 'rproc_status', '0', '2018-03-19 11:18:09'),
(43, 1, 'proc', 'rproc_refund', '0', '2018-03-19 11:18:09'),
(44, 1, 'proc', 'rproc_created', '2018-03-19 11:18:09', '2018-03-19 11:18:09'),
(45, 1, 'proc', 'rproc_updated', '2018-03-19 11:18:09', '2018-03-19 11:18:09'),
(46, 1, 'proc', 'proc_desc', 'Our service in Esperanza is best for handling specialty beans like Arabica, because we ensure following the standards of fully washing coffee beans.\r\nFor proof, see our certificates sections at [http://cosbyscoffee.com/awards].', '2018-03-19 11:18:09'),
(47, 1, 'proc', 'proc_activity', 'Full washing', '2018-03-19 11:18:09'),
(48, 1, 'proc', 'proc_unitprice', '34.99', '2018-03-19 11:18:09'),
(49, 1, 'proc', 'proc_open', '1', '2018-03-19 11:18:09'),
(50, 1, 'proc', 'proc_address', '4', '2018-03-19 11:18:09'),
(51, 1, 'proc', 'proc_orderdays', '3', '2018-03-19 11:18:09'),
(52, 1, 'proc', 'proc_minqty', '100.00', '2018-03-19 11:18:09'),
(53, 1, 'proc', 'proc_created', '2018-03-19 11:08:07', '2018-03-19 11:18:09'),
(54, 1, 'proc', 'proc_updated', '2018-03-19 11:08:07', '2018-03-19 11:18:09'),
(55, 1, 'proc', 's_editdays', '3', '2018-03-19 11:18:09'),
(56, 1, 'proc', 's_returndays', '30', '2018-03-19 11:18:09'),
(57, 1, 'proc', 'a_id', '5', '2018-03-19 11:18:09'),
(58, 1, 'proc', 'a_address', 'Unit 20 Kolor Bldg., Hawt St.', '2018-03-19 11:18:09'),
(59, 1, 'proc', 'ac_id', '56', '2018-03-19 11:18:09'),
(60, 1, 'proc', 'a_created', '2018-03-19 11:10:20', '2018-03-19 11:18:09'),
(61, 1, 'proc', 'rproc_status', '2', '2018-03-19 11:28:46'),
(62, 1, 'proc', 'rproc_updated', '2018-03-19 11:28:46', '2018-03-19 11:28:46'),
(63, 1, 'proc', 'rproc_id', '1', '2018-03-19 11:29:29'),
(64, 1, 'proc', 'rprocsh_courier', 'Own courier', '2018-03-19 11:29:29'),
(65, 1, 'proc', 'rprocsh_trackno', '0', '2018-03-19 11:29:29'),
(66, 1, 'proc', 'rproc_status', '3', '2018-03-19 11:29:29'),
(67, 1, 'proc', 'rproc_updated', '2018-03-19 11:29:29', '2018-03-19 11:29:29'),
(68, 1, 'proc', 'rproc_status', '4', '2018-03-19 11:30:09'),
(69, 1, 'proc', 'rproc_updated', '2018-03-19 11:30:09', '2018-03-19 11:30:09'),
(70, 1, 'proc', 'rproc_status', '5', '2018-03-19 11:30:44'),
(71, 1, 'proc', 'rproc_updated', '2018-03-19 11:30:44', '2018-03-19 11:30:44'),
(72, 2, 'pack', 'rpk_quantity', '5', '2018-03-19 11:31:56'),
(73, 2, 'pack', 'rpk_packnotes', 'Print the label I will send you.\r\n- Would you like to send it via email? [ord-fulfill@cosbyscoffee.com]', '2018-03-19 11:31:56'),
(74, 2, 'pack', 'rpk_duedate', '2018-03-23', '2018-03-19 11:31:56'),
(75, 2, 'pack', 'rpk_deliverto', '5', '2018-03-19 11:31:56'),
(76, 2, 'pack', 'rpk_delivernotes', 'Do not place on the floor; wait for instructions from our personnel as you arrive.', '2018-03-19 11:31:56'),
(77, 2, 'pack', 'rpk_status', '1', '2018-03-19 11:31:56'),
(78, 2, 'pack', 'rpk_updated', '2018-03-19 11:31:56', '2018-03-19 11:31:56'),
(79, 2, 'pack', 'rpk_option', 'Fill with beans, Hang hole', '2018-03-19 11:31:56'),
(80, 2, 'pack', 'a_id', '5', '2018-03-19 11:31:56'),
(81, 2, 'pack', 'a_address', 'Unit 20 Kolor Bldg., Hawt St.', '2018-03-19 11:31:56'),
(82, 2, 'pack', 'ac_id', '56', '2018-03-19 11:31:56'),
(83, 2, 'pack', 'a_created', '2018-03-19 11:10:20', '2018-03-19 11:31:56'),
(84, 2, 'pack', 'rpk_status', '2', '2018-03-19 11:32:52'),
(85, 2, 'pack', 'rpk_updated', '2018-03-19 11:32:52', '2018-03-19 11:32:52'),
(86, 2, 'pack', 'rpk_id', '2', '2018-03-19 11:33:58'),
(87, 2, 'pack', 'rpksh_courier', 'DHL', '2018-03-19 11:33:58'),
(88, 2, 'pack', 'rpksh_trackno', 'DR0P1TLK31TSH0T', '2018-03-19 11:33:58'),
(89, 2, 'pack', 'rpk_status', '3', '2018-03-19 11:33:58'),
(90, 2, 'pack', 'rpk_updated', '2018-03-19 11:33:58', '2018-03-19 11:33:58'),
(91, 2, 'pack', 'rpk_status', '4', '2018-03-19 11:34:24'),
(92, 2, 'pack', 'rpk_updated', '2018-03-19 11:34:24', '2018-03-19 11:34:24'),
(93, 2, 'pack', 'rpk_status', '5', '2018-03-19 11:34:47'),
(94, 2, 'pack', 'rpk_updated', '2018-03-19 11:34:47', '2018-03-19 11:34:47'),
(95, 1, 'roast', 'ro_id', '1', '2018-03-20 06:13:00'),
(96, 1, 'roast', 'rro_roast', 'Dark', '2018-03-20 06:13:00'),
(97, 1, 'roast', 'rro_quantity', '120.00', '2018-03-20 06:13:00'),
(98, 1, 'roast', 'rro_roastnotes', '', '2018-03-20 06:13:00'),
(99, 1, 'roast', 'rro_duedate', '2018-03-24', '2018-03-20 06:13:00'),
(100, 1, 'roast', 'rro_deliverto', '5', '2018-03-20 06:13:00'),
(101, 1, 'roast', 'rro_delivernotes', '', '2018-03-20 06:13:00'),
(102, 1, 'roast', 's_id', '1', '2018-03-20 06:13:00'),
(103, 1, 'roast', 'm_id', '2', '2018-03-20 06:13:00'),
(104, 1, 'roast', 'rro_status', '0', '2018-03-20 06:13:00'),
(105, 1, 'roast', 'rro_refund', '0', '2018-03-20 06:13:00'),
(106, 1, 'roast', 'rro_created', '2018-03-20 06:13:00', '2018-03-20 06:13:00'),
(107, 1, 'roast', 'rro_updated', '2018-03-20 06:13:00', '2018-03-20 06:13:00'),
(108, 1, 'roast', 'ro_desc', 'You may roast, or just burn. We do it with the best standards available.', '2018-03-20 06:13:00'),
(109, 1, 'roast', 'ro_open', '1', '2018-03-20 06:13:00'),
(110, 1, 'roast', 'ro_unitprice', '44.99', '2018-03-20 06:13:00'),
(111, 1, 'roast', 'ro_address', '6', '2018-03-20 06:13:00'),
(112, 1, 'roast', 'ro_orderdays', '3', '2018-03-20 06:13:00'),
(113, 1, 'roast', 'ro_minqty', '60.00', '2018-03-20 06:13:00'),
(114, 1, 'roast', 'ro_created', '2018-03-20 06:08:51', '2018-03-20 06:13:00'),
(115, 1, 'roast', 'ro_updated', '2018-03-20 06:08:51', '2018-03-20 06:13:00'),
(116, 1, 'roast', 's_editdays', '3', '2018-03-20 06:13:00'),
(117, 1, 'roast', 's_returndays', '30', '2018-03-20 06:13:00'),
(118, 1, 'roast', 'a_id', '5', '2018-03-20 06:13:00'),
(119, 1, 'roast', 'a_address', 'Unit 20 Kolor Bldg., Hawt St.', '2018-03-20 06:13:00'),
(120, 1, 'roast', 'ac_id', '56', '2018-03-20 06:13:00'),
(121, 1, 'roast', 'a_created', '2018-03-19 11:10:20', '2018-03-20 06:13:00'),
(122, 1, 'roast', 'rro_status', '6', '2018-03-20 06:16:18'),
(123, 1, 'roast', 'rro_updated', '2018-03-20 06:16:18', '2018-03-20 06:16:18'),
(124, 2, 'roast', 'ro_id', '1', '2018-03-20 06:17:02'),
(125, 2, 'roast', 'rro_roast', 'Dark', '2018-03-20 06:17:02'),
(126, 2, 'roast', 'rro_quantity', '120.00', '2018-03-20 06:17:02'),
(127, 2, 'roast', 'rro_roastnotes', '', '2018-03-20 06:17:02'),
(128, 2, 'roast', 'rro_duedate', '2018-03-24', '2018-03-20 06:17:02'),
(129, 2, 'roast', 'rro_deliverto', '5', '2018-03-20 06:17:02'),
(130, 2, 'roast', 'rro_delivernotes', '', '2018-03-20 06:17:02'),
(131, 2, 'roast', 's_id', '1', '2018-03-20 06:17:02'),
(132, 2, 'roast', 'm_id', '2', '2018-03-20 06:17:02'),
(133, 2, 'roast', 'rro_status', '0', '2018-03-20 06:17:02'),
(134, 2, 'roast', 'rro_refund', '0', '2018-03-20 06:17:02'),
(135, 2, 'roast', 'rro_created', '2018-03-20 06:17:02', '2018-03-20 06:17:02'),
(136, 2, 'roast', 'rro_updated', '2018-03-20 06:17:02', '2018-03-20 06:17:02'),
(137, 2, 'roast', 'ro_desc', 'You may roast, or just burn. We do it with the best standards available.', '2018-03-20 06:17:02'),
(138, 2, 'roast', 'ro_open', '1', '2018-03-20 06:17:02'),
(139, 2, 'roast', 'ro_unitprice', '44.99', '2018-03-20 06:17:02'),
(140, 2, 'roast', 'ro_address', '6', '2018-03-20 06:17:02'),
(141, 2, 'roast', 'ro_orderdays', '3', '2018-03-20 06:17:02'),
(142, 2, 'roast', 'ro_minqty', '60.00', '2018-03-20 06:17:02'),
(143, 2, 'roast', 'ro_created', '2018-03-20 06:08:51', '2018-03-20 06:17:02'),
(144, 2, 'roast', 'ro_updated', '2018-03-20 06:08:51', '2018-03-20 06:17:02'),
(145, 2, 'roast', 's_editdays', '3', '2018-03-20 06:17:02'),
(146, 2, 'roast', 's_returndays', '30', '2018-03-20 06:17:02'),
(147, 2, 'roast', 'a_id', '5', '2018-03-20 06:17:02'),
(148, 2, 'roast', 'a_address', 'Unit 20 Kolor Bldg., Hawt St.', '2018-03-20 06:17:02'),
(149, 2, 'roast', 'ac_id', '56', '2018-03-20 06:17:02'),
(150, 2, 'roast', 'a_created', '2018-03-19 11:10:20', '2018-03-20 06:17:02'),
(151, 3, 'roast', 'ro_id', '1', '2018-03-20 06:33:23'),
(152, 3, 'roast', 'rro_roast', 'Dark', '2018-03-20 06:33:23'),
(153, 3, 'roast', 'rro_quantity', '120.00', '2018-03-20 06:33:23'),
(154, 3, 'roast', 'rro_roastnotes', '', '2018-03-20 06:33:23'),
(155, 3, 'roast', 'rro_duedate', '2018-03-24', '2018-03-20 06:33:23'),
(156, 3, 'roast', 'rro_deliverto', '5', '2018-03-20 06:33:23'),
(157, 3, 'roast', 'rro_delivernotes', '', '2018-03-20 06:33:23'),
(158, 3, 'roast', 's_id', '1', '2018-03-20 06:33:23'),
(159, 3, 'roast', 'm_id', '2', '2018-03-20 06:33:23'),
(160, 3, 'roast', 'rro_status', '0', '2018-03-20 06:33:23'),
(161, 3, 'roast', 'rro_refund', '0', '2018-03-20 06:33:23'),
(162, 3, 'roast', 'rro_created', '2018-03-20 06:33:23', '2018-03-20 06:33:23'),
(163, 3, 'roast', 'rro_updated', '2018-03-20 06:33:23', '2018-03-20 06:33:23'),
(164, 3, 'roast', 'ro_desc', 'You may roast, or just burn. We do it with the best standards available.', '2018-03-20 06:33:23'),
(165, 3, 'roast', 'ro_open', '1', '2018-03-20 06:33:23'),
(166, 3, 'roast', 'ro_unitprice', '44.99', '2018-03-20 06:33:23'),
(167, 3, 'roast', 'ro_address', '6', '2018-03-20 06:33:23'),
(168, 3, 'roast', 'ro_orderdays', '3', '2018-03-20 06:33:23'),
(169, 3, 'roast', 'ro_minqty', '60.00', '2018-03-20 06:33:23'),
(170, 3, 'roast', 'ro_created', '2018-03-20 06:08:51', '2018-03-20 06:33:23'),
(171, 3, 'roast', 'ro_updated', '2018-03-20 06:08:51', '2018-03-20 06:33:23'),
(172, 3, 'roast', 's_editdays', '3', '2018-03-20 06:33:23'),
(173, 3, 'roast', 's_returndays', '30', '2018-03-20 06:33:23'),
(174, 3, 'roast', 'a_id', '5', '2018-03-20 06:33:23'),
(175, 3, 'roast', 'a_address', 'Unit 20 Kolor Bldg., Hawt St.', '2018-03-20 06:33:23'),
(176, 3, 'roast', 'ac_id', '56', '2018-03-20 06:33:23'),
(177, 3, 'roast', 'a_created', '2018-03-19 11:10:20', '2018-03-20 06:33:23'),
(637, 21, 'roast', 'ro_id', '1', '2018-03-20 07:04:00'),
(638, 21, 'roast', 'rro_roast', 'Dark', '2018-03-20 07:04:00'),
(639, 21, 'roast', 'rro_quantity', '120.00', '2018-03-20 07:04:00'),
(640, 21, 'roast', 'rro_roastnotes', '', '2018-03-20 07:04:00'),
(641, 21, 'roast', 'rro_duedate', '2018-03-24', '2018-03-20 07:04:00'),
(642, 21, 'roast', 'rro_deliverto', '5', '2018-03-20 07:04:00'),
(643, 21, 'roast', 'rro_delivernotes', '', '2018-03-20 07:04:00'),
(644, 21, 'roast', 's_id', '1', '2018-03-20 07:04:00'),
(645, 21, 'roast', 'm_id', '2', '2018-03-20 07:04:00'),
(646, 21, 'roast', 'rro_status', '0', '2018-03-20 07:04:00'),
(647, 21, 'roast', 'rro_refund', '0', '2018-03-20 07:04:00'),
(648, 21, 'roast', 'rro_created', '2018-03-20 07:04:00', '2018-03-20 07:04:00'),
(649, 21, 'roast', 'rro_updated', '2018-03-20 07:04:00', '2018-03-20 07:04:00'),
(650, 21, 'roast', 'ro_desc', 'You may roast, or just burn. We do it with the best standards available.', '2018-03-20 07:04:00'),
(651, 21, 'roast', 'ro_open', '1', '2018-03-20 07:04:00'),
(652, 21, 'roast', 'ro_unitprice', '44.99', '2018-03-20 07:04:00'),
(653, 21, 'roast', 'ro_address', '6', '2018-03-20 07:04:00'),
(654, 21, 'roast', 'ro_orderdays', '3', '2018-03-20 07:04:00'),
(655, 21, 'roast', 'ro_minqty', '60.00', '2018-03-20 07:04:00'),
(656, 21, 'roast', 'ro_created', '2018-03-20 06:08:51', '2018-03-20 07:04:00'),
(657, 21, 'roast', 'ro_updated', '2018-03-20 06:08:51', '2018-03-20 07:04:00'),
(658, 21, 'roast', 's_editdays', '3', '2018-03-20 07:04:00'),
(659, 21, 'roast', 's_returndays', '30', '2018-03-20 07:04:00'),
(660, 21, 'roast', 'a_id', '5', '2018-03-20 07:04:00'),
(661, 21, 'roast', 'a_address', 'Unit 20 Kolor Bldg., Hawt St.', '2018-03-20 07:04:00'),
(662, 21, 'roast', 'ac_id', '56', '2018-03-20 07:04:00'),
(663, 21, 'roast', 'a_created', '2018-03-19 11:10:20', '2018-03-20 07:04:00'),
(664, 22, 'roast', 'ro_id', '1', '2018-03-20 07:05:50'),
(665, 22, 'roast', 'rro_roast', 'Dark', '2018-03-20 07:05:50'),
(666, 22, 'roast', 'rro_quantity', '120.00', '2018-03-20 07:05:50'),
(667, 22, 'roast', 'rro_roastnotes', '', '2018-03-20 07:05:50'),
(668, 22, 'roast', 'rro_duedate', '2018-03-24', '2018-03-20 07:05:50'),
(669, 22, 'roast', 'rro_deliverto', '5', '2018-03-20 07:05:50'),
(670, 22, 'roast', 'rro_delivernotes', '', '2018-03-20 07:05:50'),
(671, 22, 'roast', 's_id', '1', '2018-03-20 07:05:50'),
(672, 22, 'roast', 'm_id', '2', '2018-03-20 07:05:50'),
(673, 22, 'roast', 'rro_status', '0', '2018-03-20 07:05:50'),
(674, 22, 'roast', 'rro_refund', '0', '2018-03-20 07:05:50'),
(675, 22, 'roast', 'rro_created', '2018-03-20 07:05:50', '2018-03-20 07:05:50'),
(676, 22, 'roast', 'rro_updated', '2018-03-20 07:05:50', '2018-03-20 07:05:50'),
(677, 22, 'roast', 'ro_desc', 'You may roast, or just burn. We do it with the best standards available.', '2018-03-20 07:05:50'),
(678, 22, 'roast', 'ro_open', '1', '2018-03-20 07:05:50'),
(679, 22, 'roast', 'ro_unitprice', '44.99', '2018-03-20 07:05:50'),
(680, 22, 'roast', 'ro_address', '6', '2018-03-20 07:05:50'),
(681, 22, 'roast', 'ro_orderdays', '3', '2018-03-20 07:05:50'),
(682, 22, 'roast', 'ro_minqty', '60.00', '2018-03-20 07:05:50'),
(683, 22, 'roast', 'ro_created', '2018-03-20 06:08:51', '2018-03-20 07:05:50'),
(684, 22, 'roast', 'ro_updated', '2018-03-20 06:08:51', '2018-03-20 07:05:50'),
(685, 22, 'roast', 's_editdays', '3', '2018-03-20 07:05:50'),
(686, 22, 'roast', 's_returndays', '30', '2018-03-20 07:05:50'),
(687, 22, 'roast', 'a_id', '5', '2018-03-20 07:05:50'),
(688, 22, 'roast', 'a_address', 'Unit 20 Kolor Bldg., Hawt St.', '2018-03-20 07:05:50'),
(689, 22, 'roast', 'ac_id', '56', '2018-03-20 07:05:50'),
(690, 22, 'roast', 'a_created', '2018-03-19 11:10:20', '2018-03-20 07:05:50'),
(691, 22, 'roast', 'rro_status', '6', '2018-03-20 13:26:36'),
(692, 22, 'roast', 'rro_updated', '2018-03-20 13:26:36', '2018-03-20 13:26:36'),
(993, 11, 'beans', 'b_id', '1', '2018-03-21 08:48:52'),
(994, 11, 'beans', 'rb_quantity', '200.00', '2018-03-21 08:48:52'),
(995, 11, 'beans', 'rb_duedate', '2018-03-27', '2018-03-21 08:48:52'),
(996, 11, 'beans', 'rb_deliverto', '8', '2018-03-21 08:48:52'),
(997, 11, 'beans', 'rb_delivernotes', '', '2018-03-21 08:48:52'),
(998, 11, 'beans', 's_id', '1', '2018-03-21 08:48:52'),
(999, 11, 'beans', 'm_id', '4', '2018-03-21 08:48:52'),
(1000, 11, 'beans', 'rb_status', '0', '2018-03-21 08:48:52'),
(1001, 11, 'beans', 'rb_refund', '0', '2018-03-21 08:48:52'),
(1002, 11, 'beans', 'rb_created', '2018-03-21 08:48:52', '2018-03-21 08:48:52'),
(1003, 11, 'beans', 'rb_updated', '2018-03-21 08:48:52', '2018-03-21 08:48:52'),
(1004, 11, 'beans', 'b_roast', 'Medium', '2018-03-21 08:48:52'),
(1005, 11, 'beans', 'b_desc', 'A rare blend that brings bittersweetness and fruitiness to your palate. Exclusive to House of Cosbys, this is made with local ingredients to ensure availability!', '2018-03-21 08:48:52'),
(1006, 11, 'beans', 'b_open', '1', '2018-03-21 08:48:52'),
(1007, 11, 'beans', 'b_roastdate', '2018-03-12', '2018-03-21 08:48:52'),
(1008, 11, 'beans', 'b_origin', 'Canada', '2018-03-21 08:48:52'),
(1009, 11, 'beans', 'b_unitprice', '173.99', '2018-03-21 08:48:52'),
(1010, 11, 'beans', 'b_deliverfrom', '2', '2018-03-21 08:48:52'),
(1011, 11, 'beans', 'b_orderdays', '4', '2018-03-21 08:48:52'),
(1012, 11, 'beans', 'b_minqty', '160.00', '2018-03-21 08:48:52'),
(1013, 11, 'beans', 'b_created', '2018-03-19 10:38:04', '2018-03-21 08:48:52'),
(1014, 11, 'beans', 'b_updated', '2018-03-19 10:38:04', '2018-03-21 08:48:52'),
(1015, 11, 'beans', 'b_species', 'Excelsa-Liberica', '2018-03-21 08:48:52'),
(1016, 11, 'beans', 'b_additions', 'cherry extract, ampalaya extract, orange zest', '2018-03-21 08:48:52'),
(1017, 11, 'beans', 's_editdays', '3', '2018-03-21 08:48:52'),
(1018, 11, 'beans', 's_returndays', '30', '2018-03-21 08:48:52'),
(1019, 11, 'beans', 'a_id', '8', '2018-03-21 08:48:52'),
(1020, 11, 'beans', 'a_address', '146 Boliney Street', '2018-03-21 08:48:52'),
(1021, 11, 'beans', 'ac_id', '2', '2018-03-21 08:48:52'),
(1022, 11, 'beans', 'a_created', '2018-03-21 03:35:12', '2018-03-21 08:48:52'),
(1023, 12, 'beans', 'b_id', '1', '2018-03-21 08:52:01'),
(1024, 12, 'beans', 'rb_quantity', '2000.00', '2018-03-21 08:52:01'),
(1025, 12, 'beans', 'rb_duedate', '2018-03-28', '2018-03-21 08:52:01'),
(1026, 12, 'beans', 'rb_deliverto', '14', '2018-03-21 08:52:01'),
(1027, 12, 'beans', 'rb_delivernotes', '', '2018-03-21 08:52:01'),
(1028, 12, 'beans', 's_id', '1', '2018-03-21 08:52:01'),
(1029, 12, 'beans', 'm_id', '4', '2018-03-21 08:52:01'),
(1030, 12, 'beans', 'rb_status', '0', '2018-03-21 08:52:01'),
(1031, 12, 'beans', 'rb_refund', '0', '2018-03-21 08:52:01'),
(1032, 12, 'beans', 'rb_created', '2018-03-21 08:52:01', '2018-03-21 08:52:01'),
(1033, 12, 'beans', 'rb_updated', '2018-03-21 08:52:01', '2018-03-21 08:52:01'),
(1034, 12, 'beans', 'b_roast', 'Medium', '2018-03-21 08:52:01'),
(1035, 12, 'beans', 'b_desc', 'A rare blend that brings bittersweetness and fruitiness to your palate. Exclusive to House of Cosbys, this is made with local ingredients to ensure availability!', '2018-03-21 08:52:01'),
(1036, 12, 'beans', 'b_open', '1', '2018-03-21 08:52:01'),
(1037, 12, 'beans', 'b_roastdate', '2018-03-12', '2018-03-21 08:52:01'),
(1038, 12, 'beans', 'b_origin', 'Canada', '2018-03-21 08:52:01'),
(1039, 12, 'beans', 'b_unitprice', '173.99', '2018-03-21 08:52:01'),
(1040, 12, 'beans', 'b_deliverfrom', '2', '2018-03-21 08:52:01'),
(1041, 12, 'beans', 'b_orderdays', '4', '2018-03-21 08:52:01'),
(1042, 12, 'beans', 'b_minqty', '160.00', '2018-03-21 08:52:01'),
(1043, 12, 'beans', 'b_created', '2018-03-19 10:38:04', '2018-03-21 08:52:01'),
(1044, 12, 'beans', 'b_updated', '2018-03-19 10:38:04', '2018-03-21 08:52:01'),
(1045, 12, 'beans', 'b_species', 'Excelsa-Liberica', '2018-03-21 08:52:01'),
(1046, 12, 'beans', 'b_additions', 'cherry extract, ampalaya extract, orange zest', '2018-03-21 08:52:01'),
(1047, 12, 'beans', 's_editdays', '3', '2018-03-21 08:52:01'),
(1048, 12, 'beans', 's_returndays', '30', '2018-03-21 08:52:01'),
(1049, 12, 'beans', 'ac_id', '110', '2018-03-21 08:52:01'),
(1050, 12, 'beans', 'a_address', 'Acongaua Street, Boliney Avenue', '2018-03-21 08:52:01'),
(1051, 12, 'beans', 'a_id', '14', '2018-03-21 08:52:01'),
(1052, 12, 'beans', 'rb_quantity', '140.00', '2018-03-21 09:06:37'),
(1053, 12, 'beans', 'rb_duedate', '2018-03-28', '2018-03-21 09:06:37'),
(1054, 12, 'beans', 'rb_deliverto', '14', '2018-03-21 09:06:37'),
(1055, 12, 'beans', 'rb_delivernotes', '', '2018-03-21 09:06:37'),
(1056, 12, 'beans', 'rb_status', '0', '2018-03-21 09:06:37'),
(1057, 12, 'beans', 'rb_updated', '2018-03-21 09:06:37', '2018-03-21 09:06:37'),
(1058, 12, 'beans', 'a_id', '14', '2018-03-21 09:06:37'),
(1059, 12, 'beans', 'a_address', 'Acongaua Street, Boliney Avenue', '2018-03-21 09:06:37'),
(1060, 12, 'beans', 'ac_id', '110', '2018-03-21 09:06:37'),
(1061, 12, 'beans', 'a_created', '2018-03-21 08:52:01', '2018-03-21 09:06:37'),
(1062, 12, 'beans', 'rb_quantity', '140.00', '2018-03-21 09:08:24'),
(1063, 12, 'beans', 'rb_duedate', '2018-03-28', '2018-03-21 09:08:24'),
(1064, 12, 'beans', 'rb_deliverto', '14', '2018-03-21 09:08:24'),
(1065, 12, 'beans', 'rb_delivernotes', '', '2018-03-21 09:08:24'),
(1066, 12, 'beans', 'rb_status', '0', '2018-03-21 09:08:24'),
(1067, 12, 'beans', 'rb_updated', '2018-03-21 09:08:24', '2018-03-21 09:08:24'),
(1068, 12, 'beans', 'a_id', '14', '2018-03-21 09:08:24'),
(1069, 12, 'beans', 'a_address', 'Acongaua Street, Boliney Avenue', '2018-03-21 09:08:24'),
(1070, 12, 'beans', 'ac_id', '110', '2018-03-21 09:08:24'),
(1071, 12, 'beans', 'a_created', '2018-03-21 08:52:01', '2018-03-21 09:08:24'),
(1072, 12, 'beans', 'rb_quantity', '2000.00', '2018-03-21 09:09:54'),
(1073, 12, 'beans', 'rb_duedate', '2018-03-28', '2018-03-21 09:09:54'),
(1074, 12, 'beans', 'rb_deliverto', '14', '2018-03-21 09:09:54'),
(1075, 12, 'beans', 'rb_delivernotes', '', '2018-03-21 09:09:54'),
(1076, 12, 'beans', 'rb_status', '0', '2018-03-21 09:09:54'),
(1077, 12, 'beans', 'rb_updated', '2018-03-21 09:09:54', '2018-03-21 09:09:54'),
(1078, 12, 'beans', 'a_id', '14', '2018-03-21 09:09:54'),
(1079, 12, 'beans', 'a_address', 'Acongaua Street, Boliney Avenue', '2018-03-21 09:09:54'),
(1080, 12, 'beans', 'ac_id', '110', '2018-03-21 09:09:54'),
(1081, 12, 'beans', 'a_created', '2018-03-21 08:52:01', '2018-03-21 09:09:54'),
(1082, 12, 'beans', 'rb_quantity', '190.00', '2018-03-21 09:10:32'),
(1083, 12, 'beans', 'rb_duedate', '2018-04-10', '2018-03-21 09:10:32'),
(1084, 12, 'beans', 'rb_deliverto', '14', '2018-03-21 09:10:32'),
(1085, 12, 'beans', 'rb_delivernotes', '', '2018-03-21 09:10:32'),
(1086, 12, 'beans', 'rb_status', '0', '2018-03-21 09:10:32'),
(1087, 12, 'beans', 'rb_updated', '2018-03-21 09:10:32', '2018-03-21 09:10:32'),
(1088, 12, 'beans', 'a_id', '14', '2018-03-21 09:10:32'),
(1089, 12, 'beans', 'a_address', 'Acongaua Street, Boliney Avenue', '2018-03-21 09:10:32'),
(1090, 12, 'beans', 'ac_id', '110', '2018-03-21 09:10:32'),
(1091, 12, 'beans', 'a_created', '2018-03-21 08:52:01', '2018-03-21 09:10:32'),
(1092, 12, 'beans', 'rb_quantity', '190.00', '2018-03-21 09:38:13'),
(1093, 12, 'beans', 'rb_duedate', '2018-03-26', '2018-03-21 09:38:13'),
(1094, 12, 'beans', 'rb_deliverto', '14', '2018-03-21 09:38:13'),
(1095, 12, 'beans', 'rb_delivernotes', '', '2018-03-21 09:38:13'),
(1096, 12, 'beans', 'rb_status', '0', '2018-03-21 09:38:13'),
(1097, 12, 'beans', 'rb_updated', '2018-03-21 09:38:13', '2018-03-21 09:38:13'),
(1098, 12, 'beans', 'a_id', '14', '2018-03-21 09:38:13'),
(1099, 12, 'beans', 'a_address', 'Acongaua Street, Boliney Avenue', '2018-03-21 09:38:13'),
(1100, 12, 'beans', 'ac_id', '110', '2018-03-21 09:38:13'),
(1101, 12, 'beans', 'a_created', '2018-03-21 08:52:01', '2018-03-21 09:38:13'),
(1102, 12, 'beans', 'rb_status', '2', '2018-03-21 09:40:56'),
(1103, 12, 'beans', 'rb_updated', '2018-03-21 09:40:56', '2018-03-21 09:40:56'),
(1104, 12, 'beans', 'rb_id', '12', '2018-03-21 09:43:16'),
(1105, 12, 'beans', 'rbsh_courier', 'LBC', '2018-03-21 09:43:16'),
(1106, 12, 'beans', 'rbsh_trackno', 'T00H4WTTOH3NDL', '2018-03-21 09:43:16'),
(1107, 12, 'beans', 'rb_status', '3', '2018-03-21 09:43:16'),
(1108, 12, 'beans', 'rb_updated', '2018-03-21 09:43:16', '2018-03-21 09:43:16'),
(1109, 12, 'beans', 'rb_id', '12', '2018-03-21 09:44:52'),
(1110, 12, 'beans', 'rbsh_courier', 'LBC', '2018-03-21 09:44:52'),
(1111, 12, 'beans', 'rbsh_trackno', 'T00H4WTTOH3NDL', '2018-03-21 09:44:52'),
(1112, 12, 'beans', 'rb_status', '3', '2018-03-21 09:44:52'),
(1113, 12, 'beans', 'rb_updated', '2018-03-21 09:44:52', '2018-03-21 09:44:52'),
(1114, 12, 'beans', 'rb_status', '4', '2018-03-21 09:50:17'),
(1115, 12, 'beans', 'rb_updated', '2018-03-21 09:50:17', '2018-03-21 09:50:17'),
(1116, 12, 'beans', 'rb_status', '4', '2018-03-21 09:53:19'),
(1117, 12, 'beans', 'rb_updated', '2018-03-21 09:53:19', '2018-03-21 09:53:19'),
(1118, 12, 'beans', 'rb_status', '5', '2018-03-21 09:53:39'),
(1119, 12, 'beans', 'rb_updated', '2018-03-21 09:53:39', '2018-03-21 09:53:39'),
(1120, 13, 'beans', 'b_id', '2', '2018-03-21 09:58:57'),
(1121, 13, 'beans', 'rb_quantity', '3.75', '2018-03-21 09:58:57'),
(1122, 13, 'beans', 'rb_duedate', '2018-03-24', '2018-03-21 09:58:57'),
(1123, 13, 'beans', 'rb_deliverto', '1', '2018-03-21 09:58:57'),
(1124, 13, 'beans', 'rb_delivernotes', '', '2018-03-21 09:58:57'),
(1125, 13, 'beans', 's_id', '3', '2018-03-21 09:58:57'),
(1126, 13, 'beans', 'm_id', '1', '2018-03-21 09:58:57'),
(1127, 13, 'beans', 'rb_status', '0', '2018-03-21 09:58:57'),
(1128, 13, 'beans', 'rb_refund', '0', '2018-03-21 09:58:57'),
(1129, 13, 'beans', 'rb_created', '2018-03-21 09:58:57', '2018-03-21 09:58:57'),
(1130, 13, 'beans', 'rb_updated', '2018-03-21 09:58:57', '2018-03-21 09:58:57'),
(1131, 13, 'beans', 'b_roast', 'Medium', '2018-03-21 09:58:57'),
(1132, 13, 'beans', 'b_desc', 'Grab freshly roasted coffee beans right from our store! We make sure it\'s fresh for up to two weeks! It\'ll be a discount if so.', '2018-03-21 09:58:57'),
(1133, 13, 'beans', 'b_open', '1', '2018-03-21 09:58:57'),
(1134, 13, 'beans', 'b_roastdate', '2018-03-12', '2018-03-21 09:58:57'),
(1135, 13, 'beans', 'b_origin', '146 Boliney Street, Boliney, Abra', '2018-03-21 09:58:57'),
(1136, 13, 'beans', 'b_unitprice', '153.78', '2018-03-21 09:58:57'),
(1137, 13, 'beans', 'b_deliverfrom', '8', '2018-03-21 09:58:57'),
(1138, 13, 'beans', 'b_orderdays', '2', '2018-03-21 09:58:57'),
(1139, 13, 'beans', 'b_minqty', '0.75', '2018-03-21 09:58:57'),
(1140, 13, 'beans', 'b_created', '2018-03-21 04:53:49', '2018-03-21 09:58:57'),
(1141, 13, 'beans', 'b_updated', '2018-03-21 04:53:49', '2018-03-21 09:58:57'),
(1142, 13, 'beans', 'b_species', 'Arabica', '2018-03-21 09:58:57'),
(1143, 13, 'beans', 'b_additions', 'mangosteen', '2018-03-21 09:58:57'),
(1144, 13, 'beans', 's_editdays', '1', '2018-03-21 09:58:57'),
(1145, 13, 'beans', 's_returndays', '15', '2018-03-21 09:58:57'),
(1146, 13, 'beans', 'a_id', '1', '2018-03-21 09:58:57'),
(1147, 13, 'beans', 'a_address', 'Unit 130 Kravia Bldg., Oceania Blvd.', '2018-03-21 09:58:57'),
(1148, 13, 'beans', 'ac_id', '40', '2018-03-21 09:58:57'),
(1149, 13, 'beans', 'a_created', '2018-03-19 10:18:21', '2018-03-21 09:58:57'),
(1150, 13, 'beans', 'rb_quantity', '3.75', '2018-03-21 10:01:35'),
(1151, 13, 'beans', 'rb_duedate', '2018-03-25', '2018-03-21 10:01:35'),
(1152, 13, 'beans', 'rb_deliverto', '1', '2018-03-21 10:01:35'),
(1153, 13, 'beans', 'rb_delivernotes', '', '2018-03-21 10:01:35'),
(1154, 13, 'beans', 'rb_status', '1', '2018-03-21 10:01:35'),
(1155, 13, 'beans', 'rb_updated', '2018-03-21 10:01:35', '2018-03-21 10:01:35'),
(1156, 13, 'beans', 'a_id', '1', '2018-03-21 10:01:35'),
(1157, 13, 'beans', 'a_address', 'Unit 130 Kravia Bldg., Oceania Blvd.', '2018-03-21 10:01:35'),
(1158, 13, 'beans', 'ac_id', '40', '2018-03-21 10:01:35'),
(1159, 13, 'beans', 'a_created', '2018-03-19 10:18:21', '2018-03-21 10:01:35'),
(1160, 13, 'beans', 'rb_quantity', '3.75', '2018-03-21 10:03:30'),
(1161, 13, 'beans', 'rb_duedate', '2018-03-25', '2018-03-21 10:03:30'),
(1162, 13, 'beans', 'rb_deliverto', '1', '2018-03-21 10:03:30'),
(1163, 13, 'beans', 'rb_delivernotes', '', '2018-03-21 10:03:30'),
(1164, 13, 'beans', 'rb_status', '1', '2018-03-21 10:03:30'),
(1165, 13, 'beans', 'rb_updated', '2018-03-21 10:03:30', '2018-03-21 10:03:30'),
(1166, 13, 'beans', 'a_id', '1', '2018-03-21 10:03:30'),
(1167, 13, 'beans', 'a_address', 'Unit 130 Kravia Bldg., Oceania Blvd.', '2018-03-21 10:03:30'),
(1168, 13, 'beans', 'ac_id', '40', '2018-03-21 10:03:30'),
(1169, 13, 'beans', 'a_created', '2018-03-19 10:18:21', '2018-03-21 10:03:30'),
(1170, 13, 'beans', 'rb_status', '2', '2018-03-21 10:09:53'),
(1171, 13, 'beans', 'rb_updated', '2018-03-21 10:09:53', '2018-03-21 10:09:53'),
(1172, 13, 'beans', 'rb_id', '13', '2018-03-21 10:12:31'),
(1173, 13, 'beans', 'rbsh_courier', 'Own courier', '2018-03-21 10:12:31'),
(1174, 13, 'beans', 'rbsh_trackno', '0', '2018-03-21 10:12:31'),
(1175, 13, 'beans', 'rb_status', '3', '2018-03-21 10:12:31'),
(1176, 13, 'beans', 'rb_updated', '2018-03-21 10:12:31', '2018-03-21 10:12:31'),
(1177, 13, 'beans', 'rb_status', '4', '2018-03-21 10:14:56'),
(1178, 13, 'beans', 'rb_updated', '2018-03-21 10:14:56', '2018-03-21 10:14:56'),
(1179, 13, 'beans', 'rb_status', '5', '2018-03-21 10:15:51'),
(1180, 13, 'beans', 'rb_updated', '2018-03-21 10:15:51', '2018-03-21 10:15:51'),
(1181, 3, 'pack', 'pk_id', '3', '2018-03-21 10:54:47'),
(1182, 3, 'pack', 'rpk_quantity', '10', '2018-03-21 10:54:47'),
(1183, 3, 'pack', 'rpk_packnotes', 'Put the logo I will send you on the pack and the tape as well.', '2018-03-21 10:54:47'),
(1184, 3, 'pack', 'rpk_duedate', '2018-03-24', '2018-03-21 10:54:47'),
(1185, 3, 'pack', 'rpk_deliverto', '5', '2018-03-21 10:54:47'),
(1186, 3, 'pack', 'rpk_delivernotes', '', '2018-03-21 10:54:47'),
(1187, 3, 'pack', 's_id', '3', '2018-03-21 10:54:47'),
(1188, 3, 'pack', 'm_id', '2', '2018-03-21 10:54:47'),
(1189, 3, 'pack', 'rpk_status', '0', '2018-03-21 10:54:47'),
(1190, 3, 'pack', 'rpk_refund', '0', '2018-03-21 10:54:47'),
(1191, 3, 'pack', 'rpk_created', '2018-03-21 10:54:47', '2018-03-21 10:54:47'),
(1192, 3, 'pack', 'rpk_updated', '2018-03-21 10:54:47', '2018-03-21 10:54:47'),
(1193, 3, 'pack', 'rpk_option', 'Fill with beans, Ties or tape', '2018-03-21 10:54:47'),
(1194, 3, 'pack', 'pk_desc', 'The quality of our bags is guaranteed to seal freshness like that of metallized silver, but with a silver color that provides a premium-looking option for less.\r\n[This product already comes with gas-release valve.]', '2018-03-21 10:54:47'),
(1195, 3, 'pack', 'pk_type', 'Flat-bottom bag', '2018-03-21 10:54:47'),
(1196, 3, 'pack', 'pk_material', 'Polyethylene (PET)', '2018-03-21 10:54:47'),
(1197, 3, 'pack', 'pk_capacity', '450.00', '2018-03-21 10:54:47'),
(1198, 3, 'pack', 'pk_color', 'Silver', '2018-03-21 10:54:47'),
(1199, 3, 'pack', 'pk_unitprice', '400.00', '2018-03-21 10:54:47'),
(1200, 3, 'pack', 'pk_qtyperunit', '6', '2018-03-21 10:54:47'),
(1201, 3, 'pack', 'pk_open', '1', '2018-03-21 10:54:47'),
(1202, 3, 'pack', 'pk_address', '10', '2018-03-21 10:54:47'),
(1203, 3, 'pack', 'pk_orderdays', '2', '2018-03-21 10:54:47'),
(1204, 3, 'pack', 'pk_minqty', '0', '2018-03-21 10:54:47'),
(1205, 3, 'pack', 'pk_created', '2018-03-21 06:39:07', '2018-03-21 10:54:47'),
(1206, 3, 'pack', 'pk_updated', '2018-03-21 06:39:07', '2018-03-21 10:54:47'),
(1207, 3, 'pack', 's_editdays', '1', '2018-03-21 10:54:47'),
(1208, 3, 'pack', 's_returndays', '15', '2018-03-21 10:54:47'),
(1209, 3, 'pack', 'a_id', '5', '2018-03-21 10:54:47'),
(1210, 3, 'pack', 'a_address', 'Unit 20 Kolor Bldg., Hawt St.', '2018-03-21 10:54:47'),
(1211, 3, 'pack', 'ac_id', '56', '2018-03-21 10:54:47'),
(1212, 3, 'pack', 'a_created', '2018-03-19 11:10:20', '2018-03-21 10:54:47'),
(1213, 3, 'pack', 'rpk_quantity', '10', '2018-03-21 11:00:26'),
(1214, 3, 'pack', 'rpk_packnotes', 'Put the logo I will send you on the pack and the tape as well.\r\n- Email for Mabuhay Cafe orders needs this Order ID for you:  #09387 [orders@mabuhaycafe.com.ph]', '2018-03-21 11:00:26'),
(1215, 3, 'pack', 'rpk_duedate', '2018-03-24', '2018-03-21 11:00:26'),
(1216, 3, 'pack', 'rpk_deliverto', '5', '2018-03-21 11:00:26'),
(1217, 3, 'pack', 'rpk_delivernotes', '', '2018-03-21 11:00:26'),
(1218, 3, 'pack', 'rpk_status', '1', '2018-03-21 11:00:26'),
(1219, 3, 'pack', 'rpk_updated', '2018-03-21 11:00:26', '2018-03-21 11:00:26'),
(1220, 3, 'pack', 'rpk_option', 'Fill with beans, Ties or tape', '2018-03-21 11:00:26'),
(1221, 3, 'pack', 'a_id', '5', '2018-03-21 11:00:26'),
(1222, 3, 'pack', 'a_address', 'Unit 20 Kolor Bldg., Hawt St.', '2018-03-21 11:00:26'),
(1223, 3, 'pack', 'ac_id', '56', '2018-03-21 11:00:26'),
(1224, 3, 'pack', 'a_created', '2018-03-19 11:10:20', '2018-03-21 11:00:26'),
(1225, 11, 'beans', 'rb_status', '6', '2018-03-21 11:01:08'),
(1226, 11, 'beans', 'rb_updated', '2018-03-21 11:01:08', '2018-03-21 11:01:08'),
(1227, 3, 'pack', 'rpk_status', '2', '2018-03-21 11:02:23'),
(1228, 3, 'pack', 'rpk_updated', '2018-03-21 11:02:23', '2018-03-21 11:02:23'),
(1229, 3, 'pack', 'rpk_id', '3', '2018-03-21 11:12:05'),
(1230, 3, 'pack', 'rpksh_courier', 'Air21', '2018-03-21 11:12:05'),
(1231, 3, 'pack', 'rpksh_trackno', 'T7689YUE7TKL321', '2018-03-21 11:12:05'),
(1232, 3, 'pack', 'rpk_status', '3', '2018-03-21 11:12:05'),
(1233, 3, 'pack', 'rpk_updated', '2018-03-21 11:12:05', '2018-03-21 11:12:05'),
(1234, 3, 'pack', 'rpk_status', '4', '2018-03-21 11:13:21'),
(1235, 3, 'pack', 'rpk_updated', '2018-03-21 11:13:21', '2018-03-21 11:13:21'),
(1236, 3, 'pack', 'rpk_status', '5', '2018-03-21 11:13:47'),
(1237, 3, 'pack', 'rpk_updated', '2018-03-21 11:13:47', '2018-03-21 11:13:47'),
(1264, 24, 'roast', 'ro_id', '2', '2018-03-21 11:31:19'),
(1265, 24, 'roast', 'rro_roast', 'Light', '2018-03-21 11:31:19'),
(1266, 24, 'roast', 'rro_quantity', '600.00', '2018-03-21 11:31:19'),
(1267, 24, 'roast', 'rro_roastnotes', 'Add some cinnamon to taste, if you have any.', '2018-03-21 11:31:19'),
(1268, 24, 'roast', 'rro_duedate', '2018-03-24', '2018-03-21 11:31:19'),
(1269, 24, 'roast', 'rro_deliverto', '16', '2018-03-21 11:31:19'),
(1270, 24, 'roast', 'rro_delivernotes', 'You will need to contact Eric (09448376255) to get past through the gate. Show Eric this order and he&#039;ll guide you through placing the delivery.', '2018-03-21 11:31:19'),
(1271, 24, 'roast', 's_id', '3', '2018-03-21 11:31:19'),
(1272, 24, 'roast', 'm_id', '1', '2018-03-21 11:31:19'),
(1273, 24, 'roast', 'rro_status', '0', '2018-03-21 11:31:19'),
(1274, 24, 'roast', 'rro_refund', '0', '2018-03-21 11:31:19'),
(1275, 24, 'roast', 'rro_created', '2018-03-21 11:31:19', '2018-03-21 11:31:19'),
(1276, 24, 'roast', 'rro_updated', '2018-03-21 11:31:19', '2018-03-21 11:31:19'),
(1277, 24, 'roast', 'ro_desc', '', '2018-03-21 11:31:19'),
(1278, 24, 'roast', 'ro_open', '1', '2018-03-21 11:31:19'),
(1279, 24, 'roast', 'ro_unitprice', '35.89', '2018-03-21 11:31:19'),
(1280, 24, 'roast', 'ro_address', '11', '2018-03-21 11:31:19'),
(1281, 24, 'roast', 'ro_orderdays', '2', '2018-03-21 11:31:19'),
(1282, 24, 'roast', 'ro_minqty', '0.00', '2018-03-21 11:31:19'),
(1283, 24, 'roast', 'ro_created', '2018-03-21 06:47:21', '2018-03-21 11:31:19'),
(1284, 24, 'roast', 'ro_updated', '2018-03-21 06:47:21', '2018-03-21 11:31:19'),
(1285, 24, 'roast', 's_editdays', '1', '2018-03-21 11:31:19'),
(1286, 24, 'roast', 's_returndays', '15', '2018-03-21 11:31:19'),
(1287, 24, 'roast', 'ac_id', '51', '2018-03-21 11:31:19'),
(1288, 24, 'roast', 'a_address', 'Meridian Packaging, Dela Rosa Street, Marianas Boulevard', '2018-03-21 11:31:19'),
(1289, 24, 'roast', 'a_id', '16', '2018-03-21 11:31:19'),
(1290, 24, 'roast', 'rro_roast', 'Light', '2018-03-21 11:42:15'),
(1291, 24, 'roast', 'rro_quantity', '600.00', '2018-03-21 11:42:15'),
(1292, 24, 'roast', 'rro_roastnotes', 'Add some cinnamon to taste, if you have any.\r\n- We do not have cinnamon, but is Muscovado OK?', '2018-03-21 11:42:15'),
(1293, 24, 'roast', 'rro_duedate', '2018-03-24', '2018-03-21 11:42:15'),
(1294, 24, 'roast', 'rro_deliverto', '16', '2018-03-21 11:42:15'),
(1295, 24, 'roast', 'rro_delivernotes', 'You will need to contact Eric (09448376255) to get past through the gate. Show Eric this order and he&#039;ll guide you through placing the delivery.', '2018-03-21 11:42:15'),
(1296, 24, 'roast', 'rro_status', '1', '2018-03-21 11:42:15'),
(1297, 24, 'roast', 'rro_updated', '2018-03-21 11:42:15', '2018-03-21 11:42:15'),
(1298, 24, 'roast', 'a_id', '16', '2018-03-21 11:42:15'),
(1299, 24, 'roast', 'a_address', 'Meridian Packaging, Dela Rosa Street, Marianas Boulevard', '2018-03-21 11:42:15'),
(1300, 24, 'roast', 'ac_id', '51', '2018-03-21 11:42:15'),
(1301, 24, 'roast', 'a_created', '2018-03-21 11:31:19', '2018-03-21 11:42:15'),
(1302, 24, 'roast', 'rro_roast', 'Light', '2018-03-21 11:45:54'),
(1303, 24, 'roast', 'rro_quantity', '600.00', '2018-03-21 11:45:54'),
(1304, 24, 'roast', 'rro_roastnotes', 'Add some cinnamon to taste, if you have any.\r\n- We do not have cinnamon, but is Muscovado OK?\r\n- Yes; use about 15%.', '2018-03-21 11:45:54'),
(1305, 24, 'roast', 'rro_duedate', '2018-03-24', '2018-03-21 11:45:54'),
(1306, 24, 'roast', 'rro_deliverto', '16', '2018-03-21 11:45:54'),
(1307, 24, 'roast', 'rro_delivernotes', 'You will need to contact Eric (09448376255) to get past through the gate. Show Eric this order and he&#039;ll guide you through placing the delivery.', '2018-03-21 11:45:54'),
(1308, 24, 'roast', 'rro_status', '0', '2018-03-21 11:45:54'),
(1309, 24, 'roast', 'rro_updated', '2018-03-21 11:45:54', '2018-03-21 11:45:54'),
(1310, 24, 'roast', 'a_id', '16', '2018-03-21 11:45:54'),
(1311, 24, 'roast', 'a_address', 'Meridian Packaging, Dela Rosa Street, Marianas Boulevard', '2018-03-21 11:45:54'),
(1312, 24, 'roast', 'ac_id', '51', '2018-03-21 11:45:54'),
(1313, 24, 'roast', 'a_created', '2018-03-21 11:31:19', '2018-03-21 11:45:54'),
(1314, 24, 'roast', 'rro_status', '2', '2018-03-21 11:47:01'),
(1315, 24, 'roast', 'rro_updated', '2018-03-21 11:47:01', '2018-03-21 11:47:01'),
(1316, 24, 'roast', 'rro_id', '24', '2018-03-21 11:47:53'),
(1317, 24, 'roast', 'rrosh_courier', 'LBC', '2018-03-21 11:47:53'),
(1318, 24, 'roast', 'rrosh_trackno', 'Q89TY34HBFY76UU', '2018-03-21 11:47:53'),
(1319, 24, 'roast', 'rro_status', '3', '2018-03-21 11:47:53'),
(1320, 24, 'roast', 'rro_updated', '2018-03-21 11:47:53', '2018-03-21 11:47:53'),
(1321, 24, 'roast', 'rro_status', '4', '2018-03-21 11:48:19'),
(1322, 24, 'roast', 'rro_updated', '2018-03-21 11:48:19', '2018-03-21 11:48:19'),
(1323, 24, 'roast', 'rro_status', '5', '2018-03-21 11:48:49'),
(1324, 24, 'roast', 'rro_updated', '2018-03-21 11:48:49', '2018-03-21 11:48:49'),
(1325, 2, 'proc', 'proc_id', '2', '2018-03-21 12:21:27'),
(1326, 2, 'proc', 'rproc_procnotes', 'Would you care to keep the amount of coffee cherry pulp washed in a separate delivery?', '2018-03-21 12:21:27'),
(1327, 2, 'proc', 'rproc_quantity', '350.00', '2018-03-21 12:21:27'),
(1328, 2, 'proc', 'rproc_duedate', '2018-03-26', '2018-03-21 12:21:27'),
(1329, 2, 'proc', 'rproc_deliverto', '17', '2018-03-21 12:21:27'),
(1330, 2, 'proc', 'rproc_delivernotes', 'Do not put on the floor upon arrival, and wait for instructions from the personnel.', '2018-03-21 12:21:27'),
(1331, 2, 'proc', 's_id', '3', '2018-03-21 12:21:27'),
(1332, 2, 'proc', 'm_id', '2', '2018-03-21 12:21:27'),
(1333, 2, 'proc', 'rproc_status', '0', '2018-03-21 12:21:27'),
(1334, 2, 'proc', 'rproc_refund', '0', '2018-03-21 12:21:27'),
(1335, 2, 'proc', 'rproc_created', '2018-03-21 12:21:27', '2018-03-21 12:21:27'),
(1336, 2, 'proc', 'rproc_updated', '2018-03-21 12:21:27', '2018-03-21 12:21:27'),
(1337, 2, 'proc', 'proc_desc', 'Our partnering cooperative offers some of the fastest washing processors available, even in larger volumes.', '2018-03-21 12:21:27'),
(1338, 2, 'proc', 'proc_activity', 'Semi-washing', '2018-03-21 12:21:27'),
(1339, 2, 'proc', 'proc_unitprice', '67.89', '2018-03-21 12:21:27'),
(1340, 2, 'proc', 'proc_open', '1', '2018-03-21 12:21:27'),
(1341, 2, 'proc', 'proc_address', '12', '2018-03-21 12:21:27'),
(1342, 2, 'proc', 'proc_orderdays', '2', '2018-03-21 12:21:27'),
(1343, 2, 'proc', 'proc_minqty', '0.00', '2018-03-21 12:21:27'),
(1344, 2, 'proc', 'proc_created', '2018-03-21 06:50:14', '2018-03-21 12:21:27'),
(1345, 2, 'proc', 'proc_updated', '2018-03-21 06:50:14', '2018-03-21 12:21:27'),
(1346, 2, 'proc', 's_editdays', '1', '2018-03-21 12:21:27'),
(1347, 2, 'proc', 's_returndays', '15', '2018-03-21 12:21:27'),
(1348, 2, 'proc', 'ac_id', '54', '2018-03-21 12:21:27'),
(1349, 2, 'proc', 'a_address', 'Block 2 Lot 1, Barangay Handaan', '2018-03-21 12:21:27'),
(1350, 2, 'proc', 'a_id', '17', '2018-03-21 12:21:27'),
(1351, 2, 'proc', 'rproc_procnotes', 'Would you care to keep the amount of coffee cherry pulp washed in a separate delivery?\r\n- We will put it in a separate delivery truck. It will cost you an extra 35.00 per kg for delivery.', '2018-03-21 12:25:14'),
(1352, 2, 'proc', 'rproc_quantity', '350.00', '2018-03-21 12:25:14'),
(1353, 2, 'proc', 'rproc_duedate', '2018-03-26', '2018-03-21 12:25:14'),
(1354, 2, 'proc', 'rproc_deliverto', '17', '2018-03-21 12:25:14'),
(1355, 2, 'proc', 'rproc_delivernotes', 'Do not put on the floor upon arrival, and wait for instructions from the personnel.', '2018-03-21 12:25:14'),
(1356, 2, 'proc', 'rproc_status', '1', '2018-03-21 12:25:14'),
(1357, 2, 'proc', 'rproc_updated', '2018-03-21 12:25:14', '2018-03-21 12:25:14'),
(1358, 2, 'proc', 'a_id', '17', '2018-03-21 12:25:14'),
(1359, 2, 'proc', 'a_address', 'Block 2 Lot 1, Barangay Handaan', '2018-03-21 12:25:14'),
(1360, 2, 'proc', 'ac_id', '54', '2018-03-21 12:25:14'),
(1361, 2, 'proc', 'a_created', '2018-03-21 12:21:27', '2018-03-21 12:25:14'),
(1362, 2, 'proc', 'rproc_status', '2', '2018-03-21 12:25:49'),
(1363, 2, 'proc', 'rproc_updated', '2018-03-21 12:25:49', '2018-03-21 12:25:49'),
(1364, 2, 'proc', 'rproc_id', '2', '2018-03-21 12:27:01'),
(1365, 2, 'proc', 'rprocsh_courier', 'Own courier', '2018-03-21 12:27:01'),
(1366, 2, 'proc', 'rprocsh_trackno', '0', '2018-03-21 12:27:01'),
(1367, 2, 'proc', 'rproc_status', '3', '2018-03-21 12:27:01'),
(1368, 2, 'proc', 'rproc_updated', '2018-03-21 12:27:01', '2018-03-21 12:27:01'),
(1369, 2, 'proc', 'rproc_status', '4', '2018-03-21 12:27:22'),
(1370, 2, 'proc', 'rproc_updated', '2018-03-21 12:27:22', '2018-03-21 12:27:22'),
(1371, 2, 'proc', 'rproc_status', '5', '2018-03-21 12:27:56'),
(1372, 2, 'proc', 'rproc_updated', '2018-03-21 12:27:56', '2018-03-21 12:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `request_history_type`
--

DROP TABLE IF EXISTS `request_history_type`;
CREATE TABLE `request_history_type` (
  `rh_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_history_type`
--

TRUNCATE TABLE `request_history_type`;
--
-- Dumping data for table `request_history_type`
--

INSERT INTO `request_history_type` (`rh_type`) VALUES
('beans'),
('pack'),
('proc'),
('roast');

-- --------------------------------------------------------

--
-- Table structure for table `request_packaging`
--

DROP TABLE IF EXISTS `request_packaging`;
CREATE TABLE `request_packaging` (
  `rpk_id` int(11) NOT NULL,
  `pk_id` int(11) NOT NULL,
  `rpk_quantity` int(9) NOT NULL,
  `rpk_packnotes` text NOT NULL,
  `rpk_duedate` date NOT NULL,
  `rpk_deliverto` int(11) NOT NULL,
  `rpk_delivernotes` text NOT NULL,
  `s_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `rpk_status` tinyint(1) NOT NULL,
  `rpk_refund` decimal(3,2) NOT NULL,
  `rpk_created` datetime NOT NULL,
  `rpk_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_packaging`
--

TRUNCATE TABLE `request_packaging`;
--
-- Dumping data for table `request_packaging`
--

INSERT INTO `request_packaging` (`rpk_id`, `pk_id`, `rpk_quantity`, `rpk_packnotes`, `rpk_duedate`, `rpk_deliverto`, `rpk_delivernotes`, `s_id`, `m_id`, `rpk_status`, `rpk_refund`, `rpk_created`, `rpk_updated`) VALUES
(2, 1, 5, 'Print the label I will send you.\r\n- Would you like to send it via email? [ord-fulfill@cosbyscoffee.com]', '2018-03-23', 5, 'Do not place on the floor; wait for instructions from our personnel as you arrive.', 1, 2, 5, '0.00', '2018-03-19 11:15:29', '2018-03-19 11:34:47'),
(3, 3, 10, 'Put the logo I will send you on the pack and the tape as well.\r\n- Email for Mabuhay Cafe orders needs this Order ID for you:  #09387 [orders@mabuhaycafe.com.ph]', '2018-03-24', 5, '', 3, 2, 5, '0.00', '2018-03-21 10:54:47', '2018-03-21 11:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `request_packaging_attach`
--

DROP TABLE IF EXISTS `request_packaging_attach`;
CREATE TABLE `request_packaging_attach` (
  `rpka_id` int(11) NOT NULL,
  `rpk_id` int(11) NOT NULL,
  `rpka_slug` varchar(280) NOT NULL,
  `rpka_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_packaging_attach`
--

TRUNCATE TABLE `request_packaging_attach`;
-- --------------------------------------------------------

--
-- Table structure for table `request_packaging_attach_type`
--

DROP TABLE IF EXISTS `request_packaging_attach_type`;
CREATE TABLE `request_packaging_attach_type` (
  `rpka_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_packaging_attach_type`
--

TRUNCATE TABLE `request_packaging_attach_type`;
--
-- Dumping data for table `request_packaging_attach_type`
--

INSERT INTO `request_packaging_attach_type` (`rpka_type`) VALUES
('document'),
('picture');

-- --------------------------------------------------------

--
-- Table structure for table `request_packaging_option`
--

DROP TABLE IF EXISTS `request_packaging_option`;
CREATE TABLE `request_packaging_option` (
  `rpkopt_id` int(11) NOT NULL,
  `rpk_id` int(11) NOT NULL,
  `rpk_option` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_packaging_option`
--

TRUNCATE TABLE `request_packaging_option`;
--
-- Dumping data for table `request_packaging_option`
--

INSERT INTO `request_packaging_option` (`rpkopt_id`, `rpk_id`, `rpk_option`) VALUES
(5, 2, 'Fill with beans'),
(6, 2, 'Hang hole'),
(9, 3, 'Fill with beans'),
(10, 3, 'Ties or tape');

-- --------------------------------------------------------

--
-- Table structure for table `request_packaging_shipping`
--

DROP TABLE IF EXISTS `request_packaging_shipping`;
CREATE TABLE `request_packaging_shipping` (
  `rpksh_id` int(11) NOT NULL,
  `rpk_id` int(11) NOT NULL,
  `rpksh_courier` varchar(90) NOT NULL,
  `rpksh_trackno` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_packaging_shipping`
--

TRUNCATE TABLE `request_packaging_shipping`;
--
-- Dumping data for table `request_packaging_shipping`
--

INSERT INTO `request_packaging_shipping` (`rpksh_id`, `rpk_id`, `rpksh_courier`, `rpksh_trackno`) VALUES
(1, 2, 'DHL', 'DR0P1TLK31TSH0T'),
(2, 3, 'Air21', 'T7689YUE7TKL321');

-- --------------------------------------------------------

--
-- Table structure for table `request_packaging_status`
--

DROP TABLE IF EXISTS `request_packaging_status`;
CREATE TABLE `request_packaging_status` (
  `rpk_status` tinyint(1) NOT NULL,
  `rpk_mdesc` varchar(140) NOT NULL,
  `rpk_sdesc` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_packaging_status`
--

TRUNCATE TABLE `request_packaging_status`;
--
-- Dumping data for table `request_packaging_status`
--

INSERT INTO `request_packaging_status` (`rpk_status`, `rpk_mdesc`, `rpk_sdesc`) VALUES
(0, 'Waiting for evaluation', 'For your evaluation'),
(1, 'For your evaluation', 'Waiting for evaluation'),
(2, 'Order being made', 'Order pending'),
(3, 'Awaiting delivery', 'Order being delivered'),
(4, 'Payment needed', 'Awaiting payment'),
(5, 'Order completed', 'Order completed'),
(6, 'Order rejected', 'Order rejected'),
(7, 'Order canceled', 'Order canceled'),
(8, 'Order returning', 'Awaiting return'),
(9, 'Order returned', 'Order returned');

-- --------------------------------------------------------

--
-- Table structure for table `request_processing`
--

DROP TABLE IF EXISTS `request_processing`;
CREATE TABLE `request_processing` (
  `rproc_id` int(11) NOT NULL,
  `proc_id` int(11) NOT NULL,
  `rproc_quantity` decimal(9,2) NOT NULL,
  `rproc_procnotes` text NOT NULL,
  `rproc_duedate` date NOT NULL,
  `rproc_deliverto` int(11) NOT NULL,
  `rproc_delivernotes` text NOT NULL,
  `s_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `rproc_status` tinyint(1) NOT NULL,
  `rproc_refund` decimal(3,2) NOT NULL,
  `rproc_created` datetime NOT NULL,
  `rproc_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_processing`
--

TRUNCATE TABLE `request_processing`;
--
-- Dumping data for table `request_processing`
--

INSERT INTO `request_processing` (`rproc_id`, `proc_id`, `rproc_quantity`, `rproc_procnotes`, `rproc_duedate`, `rproc_deliverto`, `rproc_delivernotes`, `s_id`, `m_id`, `rproc_status`, `rproc_refund`, `rproc_created`, `rproc_updated`) VALUES
(1, 1, '130.00', '', '2018-03-26', 5, '', 1, 2, 5, '0.00', '2018-03-19 11:18:09', '2018-03-19 11:30:44'),
(2, 2, '350.00', 'Would you care to keep the amount of coffee cherry pulp washed in a separate delivery?\r\n- We will put it in a separate delivery truck. It will cost you an extra 35.00 per kg for delivery.', '2018-03-26', 17, 'Do not put on the floor upon arrival, and wait for instructions from the personnel.', 3, 2, 5, '0.00', '2018-03-21 12:21:27', '2018-03-21 12:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `request_processing_shipping`
--

DROP TABLE IF EXISTS `request_processing_shipping`;
CREATE TABLE `request_processing_shipping` (
  `rprocsh_id` int(11) NOT NULL,
  `rproc_id` int(11) NOT NULL,
  `rprocsh_courier` varchar(90) NOT NULL,
  `rprocsh_trackno` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_processing_shipping`
--

TRUNCATE TABLE `request_processing_shipping`;
--
-- Dumping data for table `request_processing_shipping`
--

INSERT INTO `request_processing_shipping` (`rprocsh_id`, `rproc_id`, `rprocsh_courier`, `rprocsh_trackno`) VALUES
(1, 1, 'Own courier', '0'),
(2, 2, 'Own courier', '0');

-- --------------------------------------------------------

--
-- Table structure for table `request_processing_status`
--

DROP TABLE IF EXISTS `request_processing_status`;
CREATE TABLE `request_processing_status` (
  `rproc_status` tinyint(1) NOT NULL,
  `rproc_mdesc` varchar(140) NOT NULL,
  `rproc_sdesc` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_processing_status`
--

TRUNCATE TABLE `request_processing_status`;
--
-- Dumping data for table `request_processing_status`
--

INSERT INTO `request_processing_status` (`rproc_status`, `rproc_mdesc`, `rproc_sdesc`) VALUES
(0, 'Waiting for evaluation', 'For your evaluation'),
(1, 'For your evaluation', 'Waiting for evaluation'),
(2, 'Order being made', 'Order pending'),
(3, 'Awaiting delivery', 'Order being delivered'),
(4, 'Payment needed', 'Awaiting payment'),
(5, 'Order completed', 'Order completed'),
(6, 'Order rejected', 'Order rejected'),
(7, 'Order canceled', 'Order canceled');

-- --------------------------------------------------------

--
-- Table structure for table `request_roast`
--

DROP TABLE IF EXISTS `request_roast`;
CREATE TABLE `request_roast` (
  `rro_id` int(11) NOT NULL,
  `ro_id` int(11) NOT NULL,
  `rro_roast` varchar(45) NOT NULL,
  `rro_quantity` decimal(9,2) NOT NULL,
  `rro_roastnotes` text NOT NULL,
  `rro_duedate` date NOT NULL,
  `rro_deliverto` int(11) NOT NULL,
  `rro_delivernotes` text NOT NULL,
  `s_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `rro_status` tinyint(1) NOT NULL,
  `rro_refund` decimal(3,2) NOT NULL,
  `rro_created` datetime NOT NULL,
  `rro_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_roast`
--

TRUNCATE TABLE `request_roast`;
--
-- Dumping data for table `request_roast`
--

INSERT INTO `request_roast` (`rro_id`, `ro_id`, `rro_roast`, `rro_quantity`, `rro_roastnotes`, `rro_duedate`, `rro_deliverto`, `rro_delivernotes`, `s_id`, `m_id`, `rro_status`, `rro_refund`, `rro_created`, `rro_updated`) VALUES
(1, 1, 'Dark', '120.00', '', '2018-03-24', 5, '', 1, 2, 6, '0.00', '2018-03-20 06:13:00', '2018-03-20 06:16:18'),
(2, 1, 'Dark', '120.00', '', '2018-03-24', 5, '', 1, 2, 0, '0.00', '2018-03-20 06:17:02', '2018-03-20 06:17:02'),
(3, 1, 'Dark', '120.00', '', '2018-03-24', 5, '', 1, 2, 0, '0.00', '2018-03-20 06:33:23', '2018-03-20 06:33:23'),
(21, 1, 'Dark', '120.00', '', '2018-03-24', 5, '', 1, 2, 0, '0.00', '2018-03-20 07:04:00', '2018-03-20 07:04:00'),
(22, 1, 'Dark', '120.00', '', '2018-03-24', 5, '', 1, 2, 6, '0.00', '2018-03-20 07:05:50', '2018-03-20 13:26:36'),
(24, 2, 'Light', '600.00', 'Add some cinnamon to taste, if you have any.\r\n- We do not have cinnamon, but is Muscovado OK?\r\n- Yes; use about 15%.', '2018-03-24', 16, 'You will need to contact Eric (09448376255) to get past through the gate. Show Eric this order and he&#039;ll guide you through placing the delivery.', 3, 1, 5, '0.00', '2018-03-21 11:31:19', '2018-03-21 11:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `request_roast_shipping`
--

DROP TABLE IF EXISTS `request_roast_shipping`;
CREATE TABLE `request_roast_shipping` (
  `rrosh_id` int(11) NOT NULL,
  `rro_id` int(11) NOT NULL,
  `rrosh_courier` varchar(90) NOT NULL,
  `rrosh_trackno` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_roast_shipping`
--

TRUNCATE TABLE `request_roast_shipping`;
--
-- Dumping data for table `request_roast_shipping`
--

INSERT INTO `request_roast_shipping` (`rrosh_id`, `rro_id`, `rrosh_courier`, `rrosh_trackno`) VALUES
(1, 24, 'LBC', 'Q89TY34HBFY76UU');

-- --------------------------------------------------------

--
-- Table structure for table `request_roast_status`
--

DROP TABLE IF EXISTS `request_roast_status`;
CREATE TABLE `request_roast_status` (
  `rro_status` tinyint(1) NOT NULL,
  `rros_mdesc` varchar(140) NOT NULL,
  `rros_sdesc` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `request_roast_status`
--

TRUNCATE TABLE `request_roast_status`;
--
-- Dumping data for table `request_roast_status`
--

INSERT INTO `request_roast_status` (`rro_status`, `rros_mdesc`, `rros_sdesc`) VALUES
(0, 'Waiting for evaluation', 'For your evaluation'),
(1, 'For your evaluation', 'Waiting for evaluation'),
(2, 'Order being made', 'Order pending'),
(3, 'Awaiting delivery', 'Order being delivered'),
(4, 'Payment needed', 'Awaiting payment'),
(5, 'Order completed', 'Order completed'),
(6, 'Order rejected', 'Order rejected'),
(7, 'Order canceled', 'Order canceled');

-- --------------------------------------------------------

--
-- Table structure for table `roast`
--

DROP TABLE IF EXISTS `roast`;
CREATE TABLE `roast` (
  `ro_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `ro_desc` text NOT NULL,
  `ro_open` tinyint(1) NOT NULL,
  `ro_unitprice` decimal(9,2) NOT NULL,
  `ro_address` int(11) NOT NULL,
  `ro_orderdays` int(11) NOT NULL,
  `ro_minqty` decimal(9,2) NOT NULL,
  `ro_created` datetime NOT NULL,
  `ro_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `roast`
--

TRUNCATE TABLE `roast`;
--
-- Dumping data for table `roast`
--

INSERT INTO `roast` (`ro_id`, `s_id`, `ro_desc`, `ro_open`, `ro_unitprice`, `ro_address`, `ro_orderdays`, `ro_minqty`, `ro_created`, `ro_updated`) VALUES
(1, 1, 'You may roast, or just burn. We do it with the best standards available.', 1, '44.99', 6, 3, '60.00', '2018-03-20 06:08:51', '2018-03-20 06:08:51'),
(2, 3, '', 1, '35.89', 11, 2, '0.00', '2018-03-21 06:47:21', '2018-03-21 06:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `roast_support`
--

DROP TABLE IF EXISTS `roast_support`;
CREATE TABLE `roast_support` (
  `ro_supportid` int(11) NOT NULL,
  `ro_id` int(11) NOT NULL,
  `b_roast` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `roast_support`
--

TRUNCATE TABLE `roast_support`;
--
-- Dumping data for table `roast_support`
--

INSERT INTO `roast_support` (`ro_supportid`, `ro_id`, `b_roast`) VALUES
(1, 1, 'Black'),
(2, 1, 'Dark'),
(3, 1, 'Medium'),
(4, 2, 'Dark'),
(5, 2, 'Light');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE `store` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(45) NOT NULL,
  `m_id` int(11) NOT NULL,
  `s_address` int(11) NOT NULL,
  `s_open` tinyint(1) NOT NULL,
  `s_desc` text NOT NULL,
  `s_orderdays` int(11) NOT NULL,
  `s_editdays` int(11) NOT NULL,
  `s_returndays` int(11) NOT NULL,
  `s_rules` text NOT NULL,
  `s_created` datetime NOT NULL,
  `s_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `store`
--

TRUNCATE TABLE `store`;
--
-- Dumping data for table `store`
--

INSERT INTO `store` (`s_id`, `s_name`, `m_id`, `s_address`, `s_open`, `s_desc`, `s_orderdays`, `s_editdays`, `s_returndays`, `s_rules`, `s_created`, `s_updated`) VALUES
(1, 'House of Cosbys', 1, 1, 0, '', 3, 3, 30, '', '2018-03-19 10:29:30', '2018-03-19 10:29:30'),
(3, 'Mabuhay Cafe', 4, 8, 0, 'All tourists are welcome here!', 2, 1, 15, '', '2018-03-21 04:39:07', '2018-03-21 04:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `m_id` int(11) NOT NULL,
  `u_name` varchar(45) NOT NULL,
  `u_pw` varchar(45) NOT NULL,
  `u_cellno` varchar(11) NOT NULL,
  `u_telno` varchar(7) NOT NULL DEFAULT '0',
  `u_email` varchar(512) NOT NULL DEFAULT '',
  `u_created` datetime NOT NULL,
  `u_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `user`
--

TRUNCATE TABLE `user`;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`m_id`, `u_name`, `u_pw`, `u_cellno`, `u_telno`, `u_email`, `u_created`, `u_updated`) VALUES
(1, 'mitch-jones', 'billcosbys', '09395668637', '0', '', '2018-03-19 10:18:21', '2018-03-19 10:18:21'),
(2, 'maria-gui', 'makiling', '09152140060', '0', '', '2018-03-19 11:10:20', '2018-03-19 11:10:20'),
(4, 'patrick_o87', 'bacon pancakes', '09152140060', '0', '', '2018-03-21 03:35:12', '2018-03-21 03:35:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `fk_address_address_city1_idx` (`ac_id`);

--
-- Indexes for table `address_city`
--
ALTER TABLE `address_city`
  ADD PRIMARY KEY (`ac_id`);

--
-- Indexes for table `beans`
--
ALTER TABLE `beans`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `fk_beans_store1_idx` (`s_id`),
  ADD KEY `fk_beans_address1_idx` (`b_deliverfrom`),
  ADD KEY `fk_beans_beans_roast1_idx` (`b_roast`);

--
-- Indexes for table `beans_additions`
--
ALTER TABLE `beans_additions`
  ADD PRIMARY KEY (`b_additionsid`),
  ADD KEY `fk_bean_additions_beans1_idx` (`b_id`);

--
-- Indexes for table `beans_roast_list`
--
ALTER TABLE `beans_roast_list`
  ADD PRIMARY KEY (`b_roast`);

--
-- Indexes for table `beans_species`
--
ALTER TABLE `beans_species`
  ADD PRIMARY KEY (`b_speciesid`),
  ADD KEY `fk_bean_species_beans_species_ref1_idx` (`b_species`),
  ADD KEY `fk_bean_species_beans1_idx` (`b_id`);

--
-- Indexes for table `beans_species_list`
--
ALTER TABLE `beans_species_list`
  ADD PRIMARY KEY (`b_species`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `fk_member_address1_idx` (`m_office`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `fk_messaging_member1_idx` (`msg_sender`),
  ADD KEY `fk_messaging_member2_idx` (`msg_recipient`);

--
-- Indexes for table `message_attach`
--
ALTER TABLE `message_attach`
  ADD PRIMARY KEY (`msga_id`),
  ADD KEY `fk_message_attach_msg_attach_type1_idx` (`msga_type`),
  ADD KEY `fk_message_attach_message1` (`msg_id`);

--
-- Indexes for table `message_attach_type`
--
ALTER TABLE `message_attach_type`
  ADD PRIMARY KEY (`msga_type`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`n_id`),
  ADD KEY `fk_notification_notification_type1_idx` (`n_type`);

--
-- Indexes for table `notification_type`
--
ALTER TABLE `notification_type`
  ADD PRIMARY KEY (`n_type`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`pk_id`),
  ADD KEY `fk_package_store1_idx` (`s_id`),
  ADD KEY `fk_package_address1_idx` (`pk_address`),
  ADD KEY `fk_package_package_material_list1_idx` (`pk_material`),
  ADD KEY `fk_package_package_type_list1_idx` (`pk_type`);

--
-- Indexes for table `package_material_list`
--
ALTER TABLE `package_material_list`
  ADD PRIMARY KEY (`pk_material`);

--
-- Indexes for table `package_option`
--
ALTER TABLE `package_option`
  ADD PRIMARY KEY (`pk_optionid`),
  ADD KEY `fk_package_ezoptions_package1_idx` (`pk_id`),
  ADD KEY `fk_package_option_package_option_list1_idx` (`pk_option`);

--
-- Indexes for table `package_option_list`
--
ALTER TABLE `package_option_list`
  ADD PRIMARY KEY (`pk_option`);

--
-- Indexes for table `package_type_list`
--
ALTER TABLE `package_type_list`
  ADD PRIMARY KEY (`pk_type`);

--
-- Indexes for table `processing`
--
ALTER TABLE `processing`
  ADD PRIMARY KEY (`proc_id`),
  ADD KEY `fk_processing_store1_idx` (`s_id`),
  ADD KEY `fk_processing_address1_idx` (`proc_address`),
  ADD KEY `fk_processing_processing_activity1_idx` (`proc_activity`);

--
-- Indexes for table `processing_activity`
--
ALTER TABLE `processing_activity`
  ADD PRIMARY KEY (`proc_activity`);

--
-- Indexes for table `request_beans`
--
ALTER TABLE `request_beans`
  ADD PRIMARY KEY (`rb_id`),
  ADD KEY `fk_request_beans_address1_idx` (`rb_deliverto`),
  ADD KEY `fk_request_beans_store1_idx` (`s_id`),
  ADD KEY `fk_request_beans_member1_idx` (`m_id`),
  ADD KEY `fk_request_beans_beans1_idx` (`b_id`),
  ADD KEY `fk_request_beans_request_beans_status1_idx` (`rb_status`);

--
-- Indexes for table `request_beans_shipping`
--
ALTER TABLE `request_beans_shipping`
  ADD PRIMARY KEY (`rbsh_id`),
  ADD KEY `fk_request_beans_shipping_request_beans1_idx` (`rb_id`);

--
-- Indexes for table `request_beans_status`
--
ALTER TABLE `request_beans_status`
  ADD PRIMARY KEY (`rb_status`);

--
-- Indexes for table `request_history`
--
ALTER TABLE `request_history`
  ADD PRIMARY KEY (`rh_id`),
  ADD KEY `fk_request_history_request_history_type1_idx` (`rh_type`);

--
-- Indexes for table `request_history_type`
--
ALTER TABLE `request_history_type`
  ADD PRIMARY KEY (`rh_type`);

--
-- Indexes for table `request_packaging`
--
ALTER TABLE `request_packaging`
  ADD PRIMARY KEY (`rpk_id`),
  ADD KEY `fk_request_packaging_package1_idx` (`pk_id`),
  ADD KEY `fk_request_packaging_address1_idx` (`rpk_deliverto`),
  ADD KEY `fk_request_packaging_store1_idx` (`s_id`),
  ADD KEY `fk_request_packaging_member1_idx` (`m_id`),
  ADD KEY `fk_request_packaging_request_packaging_status1_idx` (`rpk_status`);

--
-- Indexes for table `request_packaging_attach`
--
ALTER TABLE `request_packaging_attach`
  ADD PRIMARY KEY (`rpka_id`),
  ADD KEY `fk_request_packaging_attach_request_packaging_attach_type1_idx` (`rpka_type`),
  ADD KEY `fk_request_packaging_attach_request_packaging1` (`rpk_id`);

--
-- Indexes for table `request_packaging_attach_type`
--
ALTER TABLE `request_packaging_attach_type`
  ADD PRIMARY KEY (`rpka_type`);

--
-- Indexes for table `request_packaging_option`
--
ALTER TABLE `request_packaging_option`
  ADD PRIMARY KEY (`rpkopt_id`),
  ADD KEY `fk_request_packaging_options_request_packaging1_idx` (`rpk_id`);

--
-- Indexes for table `request_packaging_shipping`
--
ALTER TABLE `request_packaging_shipping`
  ADD PRIMARY KEY (`rpksh_id`),
  ADD KEY `fk_request_packaging_shipping_request_packaging1_idx` (`rpk_id`);

--
-- Indexes for table `request_packaging_status`
--
ALTER TABLE `request_packaging_status`
  ADD PRIMARY KEY (`rpk_status`);

--
-- Indexes for table `request_processing`
--
ALTER TABLE `request_processing`
  ADD PRIMARY KEY (`rproc_id`),
  ADD KEY `fk_request_processing_store1_idx` (`s_id`),
  ADD KEY `fk_request_processing_member1_idx` (`m_id`),
  ADD KEY `fk_request_processing_address1_idx` (`rproc_deliverto`),
  ADD KEY `fk_request_processing_request_processing_status1_idx` (`rproc_status`),
  ADD KEY `fk_request_processing_processing1_idx` (`proc_id`);

--
-- Indexes for table `request_processing_shipping`
--
ALTER TABLE `request_processing_shipping`
  ADD PRIMARY KEY (`rprocsh_id`),
  ADD KEY `fk_request_processing_shipping_request_processing1_idx` (`rproc_id`);

--
-- Indexes for table `request_processing_status`
--
ALTER TABLE `request_processing_status`
  ADD PRIMARY KEY (`rproc_status`);

--
-- Indexes for table `request_roast`
--
ALTER TABLE `request_roast`
  ADD PRIMARY KEY (`rro_id`),
  ADD KEY `fk_request_roaster_roaster1_idx` (`ro_id`),
  ADD KEY `fk_request_roaster_address1_idx` (`rro_deliverto`),
  ADD KEY `fk_request_roaster_store1_idx` (`s_id`),
  ADD KEY `fk_request_roaster_member1_idx` (`m_id`),
  ADD KEY `fk_request_roaster_request_roaster_status1_idx` (`rro_status`);

--
-- Indexes for table `request_roast_shipping`
--
ALTER TABLE `request_roast_shipping`
  ADD PRIMARY KEY (`rrosh_id`),
  ADD KEY `fk_request_roast_shipping_request_roast1_idx` (`rro_id`);

--
-- Indexes for table `request_roast_status`
--
ALTER TABLE `request_roast_status`
  ADD PRIMARY KEY (`rro_status`);

--
-- Indexes for table `roast`
--
ALTER TABLE `roast`
  ADD PRIMARY KEY (`ro_id`),
  ADD KEY `fk_roaster_store1_idx` (`s_id`),
  ADD KEY `fk_roaster_address1_idx` (`ro_address`);

--
-- Indexes for table `roast_support`
--
ALTER TABLE `roast_support`
  ADD PRIMARY KEY (`ro_supportid`),
  ADD KEY `fk_roaster_has_beans_roast_list_beans_roast_list1_idx` (`b_roast`),
  ADD KEY `fk_roaster_has_beans_roast_list_roaster1_idx` (`ro_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `fk_store_member1_idx` (`m_id`),
  ADD KEY `fk_store_address1_idx` (`s_address`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`m_id`),
  ADD UNIQUE KEY `u_name_UNIQUE` (`u_name`),
  ADD KEY `fk_user_member1_idx` (`m_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `address_city`
--
ALTER TABLE `address_city`
  MODIFY `ac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `beans`
--
ALTER TABLE `beans`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `beans_additions`
--
ALTER TABLE `beans_additions`
  MODIFY `b_additionsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `beans_species`
--
ALTER TABLE `beans_species`
  MODIFY `b_speciesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message_attach`
--
ALTER TABLE `message_attach`
  MODIFY `msga_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package_option`
--
ALTER TABLE `package_option`
  MODIFY `pk_optionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `processing`
--
ALTER TABLE `processing`
  MODIFY `proc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_beans`
--
ALTER TABLE `request_beans`
  MODIFY `rb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `request_beans_shipping`
--
ALTER TABLE `request_beans_shipping`
  MODIFY `rbsh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_history`
--
ALTER TABLE `request_history`
  MODIFY `rh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1373;

--
-- AUTO_INCREMENT for table `request_packaging`
--
ALTER TABLE `request_packaging`
  MODIFY `rpk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_packaging_attach`
--
ALTER TABLE `request_packaging_attach`
  MODIFY `rpka_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_packaging_option`
--
ALTER TABLE `request_packaging_option`
  MODIFY `rpkopt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request_packaging_shipping`
--
ALTER TABLE `request_packaging_shipping`
  MODIFY `rpksh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_processing`
--
ALTER TABLE `request_processing`
  MODIFY `rproc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_processing_shipping`
--
ALTER TABLE `request_processing_shipping`
  MODIFY `rprocsh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_roast`
--
ALTER TABLE `request_roast`
  MODIFY `rro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `request_roast_shipping`
--
ALTER TABLE `request_roast_shipping`
  MODIFY `rrosh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roast`
--
ALTER TABLE `roast`
  MODIFY `ro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roast_support`
--
ALTER TABLE `roast_support`
  MODIFY `ro_supportid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_address_address_city1` FOREIGN KEY (`ac_id`) REFERENCES `address_city` (`ac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `beans`
--
ALTER TABLE `beans`
  ADD CONSTRAINT `fk_beans_address1` FOREIGN KEY (`b_deliverfrom`) REFERENCES `address` (`a_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_beans_beans_roast1` FOREIGN KEY (`b_roast`) REFERENCES `beans_roast_list` (`b_roast`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_beans_store1` FOREIGN KEY (`s_id`) REFERENCES `store` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `beans_additions`
--
ALTER TABLE `beans_additions`
  ADD CONSTRAINT `fk_bean_additions_beans1` FOREIGN KEY (`b_id`) REFERENCES `beans` (`b_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `beans_species`
--
ALTER TABLE `beans_species`
  ADD CONSTRAINT `fk_bean_species_beans1` FOREIGN KEY (`b_id`) REFERENCES `beans` (`b_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bean_species_beans_species_ref1` FOREIGN KEY (`b_species`) REFERENCES `beans_species_list` (`b_species`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `fk_member_address1` FOREIGN KEY (`m_office`) REFERENCES `address` (`a_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_messaging_member1` FOREIGN KEY (`msg_sender`) REFERENCES `member` (`m_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_messaging_member2` FOREIGN KEY (`msg_recipient`) REFERENCES `member` (`m_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message_attach`
--
ALTER TABLE `message_attach`
  ADD CONSTRAINT `fk_message_attach_message1` FOREIGN KEY (`msg_id`) REFERENCES `message` (`msg_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_message_attach_msg_attach_type1` FOREIGN KEY (`msga_type`) REFERENCES `message_attach_type` (`msga_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_notification_notification_type1` FOREIGN KEY (`n_type`) REFERENCES `notification_type` (`n_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `fk_package_address1` FOREIGN KEY (`pk_address`) REFERENCES `address` (`a_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_package_package_material_list1` FOREIGN KEY (`pk_material`) REFERENCES `package_material_list` (`pk_material`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_package_package_type_list1` FOREIGN KEY (`pk_type`) REFERENCES `package_type_list` (`pk_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_package_store1` FOREIGN KEY (`s_id`) REFERENCES `store` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `package_option`
--
ALTER TABLE `package_option`
  ADD CONSTRAINT `fk_package_ezoptions_package1` FOREIGN KEY (`pk_id`) REFERENCES `package` (`pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_package_option_package_option_list1` FOREIGN KEY (`pk_option`) REFERENCES `package_option_list` (`pk_option`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `processing`
--
ALTER TABLE `processing`
  ADD CONSTRAINT `fk_processing_address1` FOREIGN KEY (`proc_address`) REFERENCES `address` (`a_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_processing_processing_activity1` FOREIGN KEY (`proc_activity`) REFERENCES `processing_activity` (`proc_activity`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_processing_store1` FOREIGN KEY (`s_id`) REFERENCES `store` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request_beans`
--
ALTER TABLE `request_beans`
  ADD CONSTRAINT `fk_request_beans_address1` FOREIGN KEY (`rb_deliverto`) REFERENCES `address` (`a_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_beans_beans1` FOREIGN KEY (`b_id`) REFERENCES `beans` (`b_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_beans_member1` FOREIGN KEY (`m_id`) REFERENCES `member` (`m_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_beans_request_beans_status1` FOREIGN KEY (`rb_status`) REFERENCES `request_beans_status` (`rb_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_beans_store1` FOREIGN KEY (`s_id`) REFERENCES `store` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request_beans_shipping`
--
ALTER TABLE `request_beans_shipping`
  ADD CONSTRAINT `fk_request_beans_shipping_request_beans1` FOREIGN KEY (`rb_id`) REFERENCES `request_beans` (`rb_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request_history`
--
ALTER TABLE `request_history`
  ADD CONSTRAINT `fk_request_history_request_history_type1` FOREIGN KEY (`rh_type`) REFERENCES `request_history_type` (`rh_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request_packaging`
--
ALTER TABLE `request_packaging`
  ADD CONSTRAINT `fk_request_packaging_address1` FOREIGN KEY (`rpk_deliverto`) REFERENCES `address` (`a_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_packaging_member1` FOREIGN KEY (`m_id`) REFERENCES `member` (`m_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_packaging_package1` FOREIGN KEY (`pk_id`) REFERENCES `package` (`pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_packaging_request_packaging_status1` FOREIGN KEY (`rpk_status`) REFERENCES `request_packaging_status` (`rpk_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_packaging_store1` FOREIGN KEY (`s_id`) REFERENCES `store` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request_packaging_attach`
--
ALTER TABLE `request_packaging_attach`
  ADD CONSTRAINT `fk_request_packaging_attach_request_packaging1` FOREIGN KEY (`rpk_id`) REFERENCES `request_packaging` (`rpk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_packaging_attach_request_packaging_attach_type1` FOREIGN KEY (`rpka_type`) REFERENCES `request_packaging_attach_type` (`rpka_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request_packaging_option`
--
ALTER TABLE `request_packaging_option`
  ADD CONSTRAINT `fk_request_packaging_options_request_packaging1` FOREIGN KEY (`rpk_id`) REFERENCES `request_packaging` (`rpk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request_packaging_shipping`
--
ALTER TABLE `request_packaging_shipping`
  ADD CONSTRAINT `fk_request_packaging_shipping_request_packaging1` FOREIGN KEY (`rpk_id`) REFERENCES `request_packaging` (`rpk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request_processing`
--
ALTER TABLE `request_processing`
  ADD CONSTRAINT `fk_request_processing_address1` FOREIGN KEY (`rproc_deliverto`) REFERENCES `address` (`a_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_processing_member1` FOREIGN KEY (`m_id`) REFERENCES `member` (`m_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_processing_processing1` FOREIGN KEY (`proc_id`) REFERENCES `processing` (`proc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_processing_request_processing_status1` FOREIGN KEY (`rproc_status`) REFERENCES `request_processing_status` (`rproc_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_processing_store1` FOREIGN KEY (`s_id`) REFERENCES `store` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request_processing_shipping`
--
ALTER TABLE `request_processing_shipping`
  ADD CONSTRAINT `fk_request_processing_shipping_request_processing1` FOREIGN KEY (`rproc_id`) REFERENCES `request_processing` (`rproc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request_roast`
--
ALTER TABLE `request_roast`
  ADD CONSTRAINT `fk_request_roaster_address1` FOREIGN KEY (`rro_deliverto`) REFERENCES `address` (`a_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_roaster_member1` FOREIGN KEY (`m_id`) REFERENCES `member` (`m_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_roaster_request_roaster_status1` FOREIGN KEY (`rro_status`) REFERENCES `request_roast_status` (`rro_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_roaster_roaster1` FOREIGN KEY (`ro_id`) REFERENCES `roast` (`ro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_roaster_store1` FOREIGN KEY (`s_id`) REFERENCES `store` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request_roast_shipping`
--
ALTER TABLE `request_roast_shipping`
  ADD CONSTRAINT `fk_request_roast_shipping_request_roast1` FOREIGN KEY (`rro_id`) REFERENCES `request_roast` (`rro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `roast`
--
ALTER TABLE `roast`
  ADD CONSTRAINT `fk_roaster_address1` FOREIGN KEY (`ro_address`) REFERENCES `address` (`a_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_roaster_store1` FOREIGN KEY (`s_id`) REFERENCES `store` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `roast_support`
--
ALTER TABLE `roast_support`
  ADD CONSTRAINT `fk_roaster_has_beans_roast_list_beans_roast_list1` FOREIGN KEY (`b_roast`) REFERENCES `beans_roast_list` (`b_roast`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_roaster_has_beans_roast_list_roaster1` FOREIGN KEY (`ro_id`) REFERENCES `roast` (`ro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `fk_store_address1` FOREIGN KEY (`s_address`) REFERENCES `address` (`a_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_store_member1` FOREIGN KEY (`m_id`) REFERENCES `member` (`m_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_member1` FOREIGN KEY (`m_id`) REFERENCES `member` (`m_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2013 at 04:15 PM
-- Server version: 5.5.34-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bill`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE IF NOT EXISTS `bill_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `unit` decimal(10,2) DEFAULT NULL,
  `at_rate` varchar(255) DEFAULT NULL,
  `per` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`id`, `bill_id`, `item_id`, `rate`, `amount`, `remarks`, `unit`, `at_rate`, `per`) VALUES
(1, 1, NULL, 657.00, 44019.00, NULL, NULL, NULL, NULL),
(2, 2, NULL, 55.00, 275.00, NULL, NULL, NULL, NULL),
(3, 2, NULL, 5.00, 25.00, NULL, NULL, NULL, NULL),
(4, 3, 3, 25.00, 1375.00, NULL, NULL, NULL, NULL),
(5, 3, 2, 25.00, 625.00, NULL, NULL, NULL, NULL),
(6, 6, 3, 55.00, 3025.00, NULL, NULL, NULL, NULL),
(7, 7, 3, 200.00, 200.00, 'bnbcv', 100.00, '100.00', '30'),
(8, 8, 3, 500.00, 166.67, 'good', 10.00, '30.00', ''),
(9, 9, 1, 500.00, 166.67, 'godd', 10.00, '30.00', ''),
(10, 10, 3, 100.00, 33.33, '', 10.00, '30.00', '30'),
(11, 10, 1, 100.00, 38.46, '', 10.00, '26.00', '25'),
(27, 11, 1, 5610.00, 38838.46, '', 180.00, '26', 'DAYS&8hrs'),
(28, 11, 3, 5010.00, 8960.19, '', 46.50, '26', 'DAYS&12HRS'),
(29, 11, 2, 7515.00, 31312.50, '', 125.00, '30', 'MONTHLY');

-- --------------------------------------------------------

--
-- Table structure for table `bill_master`
--

CREATE TABLE IF NOT EXISTS `bill_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `party_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `service_charge_per` decimal(10,2) DEFAULT NULL,
  `service_charge` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `net_amount` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_party_id` (`party_id`),
  KEY `fk_session_id` (`session_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `bill_master`
--

INSERT INTO `bill_master` (`id`, `party_id`, `session_id`, `name`, `total_amount`, `tax`, `service_charge_per`, `service_charge`, `grand_total`, `net_amount`, `date`) VALUES
(1, 1, NULL, '1', 45339.57, 3.00, NULL, NULL, NULL, NULL, NULL),
(2, 3, NULL, '343', 309.00, 3.00, NULL, NULL, NULL, NULL, NULL),
(3, 1, NULL, '232', 2060.00, 3.00, NULL, NULL, NULL, NULL, NULL),
(4, 4, NULL, 'qw', 0.00, 0.00, NULL, NULL, NULL, NULL, NULL),
(5, 4, NULL, '12', 0.00, 0.00, NULL, NULL, NULL, NULL, NULL),
(6, 1, NULL, '11', 3025.00, 0.00, NULL, NULL, NULL, NULL, NULL),
(7, 1, NULL, '1', 200.00, 12.36, 10.00, 20.00, 220.00, 222.20, NULL),
(8, 3, NULL, '1', 166.67, 3.00, 10.00, 16.67, 183.33, 185.17, NULL),
(9, 2, NULL, '1', 166.67, 12.36, 10.00, 16.67, 183.33, 185.17, '2013-11-20'),
(10, 4, NULL, '1', 71.79, 3.00, 10.00, 7.18, 78.97, 79.76, '2013-11-20'),
(11, 5, NULL, '11', 79111.15, 12.36, 10.00, 7911.12, 87022.27, 87892.49, '2013-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `filestore_file`
--

CREATE TABLE IF NOT EXISTS `filestore_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filestore_type_id` int(11) NOT NULL DEFAULT '0',
  `filestore_volume_id` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `original_filename` varchar(255) DEFAULT NULL,
  `filesize` int(11) NOT NULL DEFAULT '0',
  `filenum` int(11) NOT NULL DEFAULT '0',
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `filestore_image`
--

CREATE TABLE IF NOT EXISTS `filestore_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `original_file_id` int(11) NOT NULL DEFAULT '0',
  `thumb_file_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `filestore_type`
--

CREATE TABLE IF NOT EXISTS `filestore_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mime_type` varchar(64) NOT NULL DEFAULT '',
  `extension` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `filestore_type`
--

INSERT INTO `filestore_type` (`id`, `name`, `mime_type`, `extension`) VALUES
(1, 'jpg', 'image/jpeg', 'jpg'),
(2, 'jpeg', 'image/jpeg', 'jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `filestore_volume`
--

CREATE TABLE IF NOT EXISTS `filestore_volume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `dirname` varchar(255) NOT NULL DEFAULT '',
  `total_space` bigint(20) NOT NULL DEFAULT '0',
  `used_space` bigint(20) NOT NULL DEFAULT '0',
  `stored_files_cnt` int(11) NOT NULL DEFAULT '0',
  `enabled` enum('Y','N') DEFAULT 'Y',
  `last_filenum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `filestore_volume`
--

INSERT INTO `filestore_volume` (`id`, `name`, `dirname`, `total_space`, `used_space`, `stored_files_cnt`, `enabled`, `last_filenum`) VALUES
(1, 'upload', 'upload', 1000000000, 0, 2, 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`) VALUES
(1, 'Security Guard'),
(2, 'Lady Guard'),
(3, 'GUN MAN'),
(4, 'Office Staff');

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE IF NOT EXISTS `party` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`id`, `name`, `address`) VALUES
(1, 'Gowrav', NULL),
(2, 'Khushbu', NULL),
(3, 'Shishir', NULL),
(4, 'test Party1', 'address'),
(5, 'MEWAR POLYTEX LTD', 'M.I.A. MADRI UDAIPUR');

-- --------------------------------------------------------

--
-- Table structure for table `paymentreceived`
--

CREATE TABLE IF NOT EXISTS `paymentreceived` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) DEFAULT NULL,
  `on_date` date DEFAULT NULL,
  `amount_submitted` int(11) DEFAULT NULL,
  `bank_details` varchar(255) DEFAULT NULL,
  `cheque_no` varchar(255) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bill_id` (`bill_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `paymentreceived`
--

INSERT INTO `paymentreceived` (`id`, `bill_id`, `on_date`, `amount_submitted`, `bank_details`, `cheque_no`, `cheque_date`) VALUES
(1, 1, '2013-10-03', 46700, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `h_no_a` varchar(255) DEFAULT NULL,
  `area_a` varchar(255) DEFAULT NULL,
  `pin_a` varchar(255) DEFAULT NULL,
  `ph_no_a` varchar(255) DEFAULT NULL,
  `r_no_a` varchar(255) DEFAULT NULL,
  `city_a` varchar(255) DEFAULT NULL,
  `distt_a` varchar(255) DEFAULT NULL,
  `state_a` varchar(255) DEFAULT NULL,
  `mobile_no_a` varchar(255) DEFAULT NULL,
  `h_no_b` varchar(255) DEFAULT NULL,
  `area_b` varchar(255) DEFAULT NULL,
  `pin_b` varchar(255) DEFAULT NULL,
  `ph_no_b` varchar(255) DEFAULT NULL,
  `r_no_b` varchar(255) DEFAULT NULL,
  `city_b` varchar(255) DEFAULT NULL,
  `distt_b` varchar(255) DEFAULT NULL,
  `state_b` varchar(255) DEFAULT NULL,
  `mobile_no_b` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `edu_examination_1` varchar(255) DEFAULT NULL,
  `edu_examination_2` varchar(255) DEFAULT NULL,
  `edu_examination_3` varchar(255) DEFAULT NULL,
  `experience1` varchar(255) DEFAULT NULL,
  `experience2` varchar(255) DEFAULT NULL,
  `experience3` varchar(255) DEFAULT NULL,
  `designation_for_applied` varchar(255) DEFAULT NULL,
  `g1name` varchar(255) DEFAULT NULL,
  `g1father_name` varchar(255) DEFAULT NULL,
  `g1designation` varchar(255) DEFAULT NULL,
  `g1address` varchar(255) DEFAULT NULL,
  `g1guarantor_sig` varchar(255) DEFAULT NULL,
  `g2name` varchar(255) DEFAULT NULL,
  `g2father_name` varchar(255) DEFAULT NULL,
  `g2address` varchar(255) DEFAULT NULL,
  `g2guarantor_sig` varchar(255) DEFAULT NULL,
  `i_we` varchar(255) DEFAULT NULL,
  `aff_father_name` varchar(255) DEFAULT NULL,
  `aff_religion` varchar(255) DEFAULT NULL,
  `police_station_a` varchar(255) DEFAULT NULL,
  `police_station_b` varchar(255) DEFAULT NULL,
  `edu_board_university_1` varchar(255) DEFAULT NULL,
  `edu_subject_1` varchar(255) DEFAULT NULL,
  `edu_year_1` varchar(255) DEFAULT NULL,
  `edu_div_1` varchar(255) DEFAULT NULL,
  `edu_remarks_1` varchar(255) DEFAULT NULL,
  `edu_subject_2` varchar(255) DEFAULT NULL,
  `edu_board_university_2` varchar(255) DEFAULT NULL,
  `edu_year_2` varchar(255) DEFAULT NULL,
  `edu_div_2` varchar(255) DEFAULT NULL,
  `edu_remarks_2` varchar(255) DEFAULT NULL,
  `edu_subject_3` varchar(255) DEFAULT NULL,
  `edu_board_university_3` varchar(255) DEFAULT NULL,
  `edu_year_3` varchar(255) DEFAULT NULL,
  `edu_div_3` varchar(255) DEFAULT NULL,
  `edu_remarks_3` varchar(255) DEFAULT NULL,
  `comp_examination_1` varchar(255) DEFAULT NULL,
  `comp_institute_name_1` varchar(255) DEFAULT NULL,
  `remarks_about_course_1` varchar(255) DEFAULT NULL,
  `comp_examination_2` varchar(255) DEFAULT NULL,
  `comp_institute_name_2` varchar(255) DEFAULT NULL,
  `remarks_about_course_2` varchar(255) DEFAULT NULL,
  `comp_examination_3` varchar(255) DEFAULT NULL,
  `comp_institute_name_3` varchar(255) DEFAULT NULL,
  `remarks_about_course_3` varchar(255) DEFAULT NULL,
  `personal_name_with_introduce_concern` varchar(255) DEFAULT NULL,
  `document1_id` int(11) DEFAULT NULL,
  `document2_id` int(11) DEFAULT NULL,
  `aff_occupation` varchar(255) DEFAULT NULL,
  `aff_address` varchar(255) DEFAULT NULL,
  `g2designation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_document1_id` (`document1_id`),
  KEY `fk_document2_id` (`document2_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `father_name`, `religion`, `dob`, `occupation`, `h_no_a`, `area_a`, `pin_a`, `ph_no_a`, `r_no_a`, `city_a`, `distt_a`, `state_a`, `mobile_no_a`, `h_no_b`, `area_b`, `pin_b`, `ph_no_b`, `r_no_b`, `city_b`, `distt_b`, `state_b`, `mobile_no_b`, `email`, `edu_examination_1`, `edu_examination_2`, `edu_examination_3`, `experience1`, `experience2`, `experience3`, `designation_for_applied`, `g1name`, `g1father_name`, `g1designation`, `g1address`, `g1guarantor_sig`, `g2name`, `g2father_name`, `g2address`, `g2guarantor_sig`, `i_we`, `aff_father_name`, `aff_religion`, `police_station_a`, `police_station_b`, `edu_board_university_1`, `edu_subject_1`, `edu_year_1`, `edu_div_1`, `edu_remarks_1`, `edu_subject_2`, `edu_board_university_2`, `edu_year_2`, `edu_div_2`, `edu_remarks_2`, `edu_subject_3`, `edu_board_university_3`, `edu_year_3`, `edu_div_3`, `edu_remarks_3`, `comp_examination_1`, `comp_institute_name_1`, `remarks_about_course_1`, `comp_examination_2`, `comp_institute_name_2`, `remarks_about_course_2`, `comp_examination_3`, `comp_institute_name_3`, `remarks_about_course_3`, `personal_name_with_introduce_concern`, `document1_id`, `document2_id`, `aff_occupation`, `aff_address`, `g2designation`) VALUES
(1, 'k', NULL, 'k', NULL, 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL),
(2, 'kLlL', NULL, 'l', NULL, 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'k', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'l', 'l', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL),
(3, '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL),
(4, '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL),
(5, '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL),
(6, '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL),
(7, '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL),
(8, '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL),
(9, 'sdfsdf', NULL, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_current` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

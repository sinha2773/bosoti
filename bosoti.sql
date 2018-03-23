-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2018 at 09:33 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bosoti`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_account`
--

CREATE TABLE IF NOT EXISTS `tbl_bank_account` (
`bank_acc_id` int(11) NOT NULL,
  `bank_name` varchar(80) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `acc_name` varchar(60) NOT NULL,
  `acc_number` varchar(30) NOT NULL,
  `balance` double NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bank_account`
--

INSERT INTO `tbl_bank_account` (`bank_acc_id`, `bank_name`, `branch_name`, `acc_name`, `acc_number`, `balance`, `created`, `updated`, `status`) VALUES
(11, 'Dutch Bangla Bank Limited', 'Dhanmondi', 'Bosoti Sonchoy', '105.102.863254', 5000, '2018-03-20 13:18:30', '2018-03-23 20:32:34', 1),
(12, 'Brac Bank', 'Khailgaoh', 'Bosoti', '105.236.12589', 500, '2018-03-21 19:33:00', '2018-03-21 19:33:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_histories`
--

CREATE TABLE IF NOT EXISTS `tbl_client_histories` (
`history_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `meta_key` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `added_by` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

CREATE TABLE IF NOT EXISTS `tbl_expenses` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '8',
  `invoice` varchar(20) NOT NULL,
  `extype_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  `payment_to` varchar(60) DEFAULT NULL,
  `expense_date` date NOT NULL,
  `remark` text NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `bank_acc_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_expenses`
--

INSERT INTO `tbl_expenses` (`id`, `user_id`, `invoice`, `extype_id`, `amount`, `payment_method`, `payment_to`, `expense_date`, `remark`, `status`, `created`, `updated`, `bank_acc_id`) VALUES
(1, 8, 'bsrds_20180324_02322', 1, '1000.00', 'cheque', 'test', '2018-03-24', 'tett', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11),
(2, 8, 'bsrds_20180324_02323', 1, '40.00', 'cash', 'asdasdasd', '2018-03-24', 'asdasdad', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_types`
--

CREATE TABLE IF NOT EXISTS `tbl_expense_types` (
`id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_expense_types`
--

INSERT INTO `tbl_expense_types` (`id`, `parent_id`, `title`, `slug`, `order_id`, `status`, `created`, `updated`) VALUES
(1, 0, 'bill', 'bill', 0, 1, '2018-03-24 02:32:20', '2018-03-24 02:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_final_amount`
--

CREATE TABLE IF NOT EXISTS `tbl_final_amount` (
`final_amount_id` int(11) NOT NULL,
  `total_amount` double NOT NULL DEFAULT '0',
  `cashbook_amount` double NOT NULL DEFAULT '0',
  `bank_amount` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_final_amount`
--

INSERT INTO `tbl_final_amount` (`final_amount_id`, `total_amount`, `cashbook_amount`, `bank_amount`) VALUES
(1, 0, 49900, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_incomes`
--

CREATE TABLE IF NOT EXISTS `tbl_incomes` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '8',
  `invoice` varchar(20) NOT NULL,
  `intype_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  `payment_from` varchar(60) DEFAULT NULL,
  `income_date` date NOT NULL,
  `remark` text NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `bank_acc_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_incomes`
--

INSERT INTO `tbl_incomes` (`id`, `user_id`, `invoice`, `intype_id`, `amount`, `payment_method`, `payment_from`, `income_date`, `remark`, `status`, `created`, `updated`, `bank_acc_id`) VALUES
(1, 8, 'bsrds_20180324_01443', 1, '5009.00', 'cash', 'Test', '2018-03-24', 'hello', 1, '2018-03-24 01:44:53', '2018-03-24 01:44:53', 0),
(2, 8, 'bsrds_20180324_02214', 1, '23.00', 'cash', 'aaa', '2018-03-24', 'asdasd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 8, 'bsrds_20180324_02222', 1, '23.00', 'cash', 'aaa', '2018-03-24', 'asdasd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 8, 'bsrds_20180324_02232', 1, '4.00', 'cash', 'asdasd', '2018-03-24', 'asdasd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_income_types`
--

CREATE TABLE IF NOT EXISTS `tbl_income_types` (
`id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_income_types`
--

INSERT INTO `tbl_income_types` (`id`, `parent_id`, `title`, `slug`, `order_id`, `status`, `created`, `updated`) VALUES
(1, 0, 'Test', 'test', 0, 1, '2018-03-24 01:44:36', '2018-03-24 01:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medias`
--

CREATE TABLE IF NOT EXISTS `tbl_medias` (
`id` int(11) NOT NULL,
  `media_type` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `image` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_medias`
--

INSERT INTO `tbl_medias` (`id`, `media_type`, `name`, `image`, `status`, `created`, `updated`) VALUES
(4, 'user', 'Reporter', '2017010414834786062842.png', 1, '2017-01-04 03:23:26', '2017-01-04 03:23:26'),
(5, 'member', 'Unknown', '3_1520672425.jpg', 1, '2018-03-10 15:00:24', '2018-03-10 15:00:24'),
(6, 'member', 'Unknown', 'pro_1520672723.jpg', 1, '2018-03-10 15:05:23', '2018-03-10 15:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE IF NOT EXISTS `tbl_members` (
`id` int(11) NOT NULL,
  `client_id` varchar(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `fathername` varchar(100) DEFAULT NULL,
  `mothername` varchar(100) DEFAULT NULL,
  `spousename` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nid` varchar(20) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `permanent_address` varchar(100) DEFAULT NULL,
  `village` varchar(100) DEFAULT NULL,
  `post_office` varchar(50) DEFAULT NULL,
  `police_station` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `present_address` varchar(100) DEFAULT NULL,
  `p_village` varchar(100) DEFAULT NULL,
  `p_post_office` varchar(50) DEFAULT NULL,
  `p_police_station` varchar(50) DEFAULT NULL,
  `p_district` varchar(50) DEFAULT NULL,
  `nominee_identity` varchar(100) DEFAULT NULL,
  `n_name` varchar(100) DEFAULT NULL,
  `n_fathername` varchar(100) DEFAULT NULL,
  `n_mothername` varchar(100) DEFAULT NULL,
  `n_date_of_birth` date DEFAULT NULL,
  `n_nid` varchar(20) DEFAULT NULL,
  `n_permanent_address` varchar(100) DEFAULT NULL,
  `n_village` varchar(100) DEFAULT NULL,
  `n_post_office` varchar(50) DEFAULT NULL,
  `n_police_station` varchar(50) DEFAULT NULL,
  `n_district` varchar(50) DEFAULT NULL,
  `n_present_address` varchar(50) DEFAULT NULL,
  `np_village` varchar(50) DEFAULT NULL,
  `np_post_office` varchar(50) DEFAULT NULL,
  `np_police_station` varchar(50) DEFAULT NULL,
  `np_district` varchar(50) DEFAULT NULL,
  `nominee_relationship` varchar(100) DEFAULT NULL,
  `summary` varchar(255) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `media_id2` int(11) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `membership_type` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`id`, `client_id`, `name`, `mobile`, `email`, `gender`, `fathername`, `mothername`, `spousename`, `date_of_birth`, `nid`, `occupation`, `education`, `religion`, `nationality`, `admission_date`, `blood_group`, `permanent_address`, `village`, `post_office`, `police_station`, `district`, `present_address`, `p_village`, `p_post_office`, `p_police_station`, `p_district`, `nominee_identity`, `n_name`, `n_fathername`, `n_mothername`, `n_date_of_birth`, `n_nid`, `n_permanent_address`, `n_village`, `n_post_office`, `n_police_station`, `n_district`, `n_present_address`, `np_village`, `np_post_office`, `np_police_station`, `np_district`, `nominee_relationship`, `summary`, `media_id`, `media_id2`, `added_by`, `status`, `created`, `updated`, `membership_type`) VALUES
(2, 'BOSOTI_1', 'aaa', 'aaa', NULL, 0, 'aaa', 'aaa', '', '2018-03-14', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', 0, 0, 8, 1, '2018-03-03 13:56:23', '2018-03-23 19:09:47', 2),
(3, '', 'Test Member Ahmed', 'BOSOTI_2', NULL, 0, 'A', 'B', 'B', '2018-03-13', 'asdasdasd', 'sdasd', 'asda', 'dasd', 'asdas', '2018-03-13', 'asdasd', NULL, 'asdas', 'dasd', 'asdasd', 'asd', NULL, 'asda', 'sdas', 'sdasd', 'da', NULL, 'asda', 'sda', 'asdas', '2018-03-06', 'asdasd', NULL, 'asdas', 'dasd', 'asd', 'asd', NULL, 'asdas', 'dasd', 'sdasd', 'asda', 'asdasd', '', 0, 0, 0, 1, '2018-03-22 19:39:39', '2018-03-22 19:39:39', 0),
(4, '', 'member 3', 'BOSOTI_3', NULL, 0, 'asda', 'sdas', 'asdas', '2018-03-12', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', 0, 0, 0, 1, '2018-03-22 20:11:18', '2018-03-22 20:11:18', 0),
(5, '', 'asdasd', 'BOSOTI_2', NULL, 0, 'asdas', 'dasd', 'asdasd', '2018-03-13', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', 0, 0, 0, 1, '2018-03-22 20:15:27', '2018-03-22 20:15:27', 0),
(6, 'BOSOTI_2', 'asdasd', '015', NULL, 0, 'asdasd', 'asdasd', 'asdasd', '2018-03-13', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '2018-03-13', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', 0, 0, 0, 1, '2018-03-22 20:17:17', '2018-03-22 20:17:17', 0),
(7, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 0, 1, '2018-03-23 07:48:41', '2018-03-23 07:48:41', 0),
(8, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 0, 1, '2018-03-23 07:48:59', '2018-03-23 07:48:59', 0),
(9, 'BOSOTI_4', 'Ref', '234234', NULL, 0, 'RRR', 'RRR', '', '2018-03-07', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', 0, 0, 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(10, 'BOSOTI_5', 'Ref 2 ', '123123', NULL, 0, '1232', '1233', '', '2018-03-21', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', 0, 0, 8, 1, '2018-03-23 18:49:44', '2018-03-23 18:50:21', 2),
(11, 'BOSOTI_6', 'Test 5', '123123', NULL, 0, '12312', '31231', '', '2018-03-20', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', 0, 0, 8, 1, '2018-03-23 18:59:38', '2018-03-23 18:59:38', 1),
(12, 'BOSOTI_7', 'Hello', '1234567', NULL, 0, 'MR W', 'MRS Q', '', '2018-03-15', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', 0, 0, 8, 1, '2018-03-23 19:20:24', '2018-03-23 19:20:24', 1),
(13, 'BOSOTI_8', 'qqq', 'qqq', NULL, 0, 'qqq', 'qqq', '', '2018-03-13', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', 0, 0, 8, 1, '2018-03-23 19:32:53', '2018-03-23 19:32:53', 1),
(14, 'BOSOTI_9', 'erwe', 'rwer', NULL, 0, 'werwer', 'werw', 'rwerwer', '2018-03-15', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', NULL, 0, 8, 1, '2018-03-23 19:42:43', '2018-03-23 19:42:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE IF NOT EXISTS `tbl_messages` (
`message_id` int(11) NOT NULL,
  `m_from` varchar(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notes`
--

CREATE TABLE IF NOT EXISTS `tbl_notes` (
`id` int(11) NOT NULL,
  `note_type` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE IF NOT EXISTS `tbl_payments` (
`id` bigint(20) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `bill` decimal(10,2) NOT NULL,
  `billing_date` date NOT NULL,
  `payment_date` date NOT NULL,
  `payment_day` tinyint(4) NOT NULL,
  `payment_month` tinyint(4) NOT NULL,
  `payment_year` int(4) NOT NULL,
  `added_by` int(11) NOT NULL,
  `book_no` varchar(20) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `bill_status` tinyint(1) NOT NULL,
  `client_status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `client_id`, `amount`, `payment_type`, `discount`, `bill`, `billing_date`, `payment_date`, `payment_day`, `payment_month`, `payment_year`, `added_by`, `book_no`, `summary`, `bill_status`, `client_status`, `created`, `updated`) VALUES
(1, 2, '200.00', '', '0.00', '0.00', '0000-00-00', '2018-03-10', 10, 3, 2018, 8, '', 'test', 0, 0, '2018-03-10 18:31:34', '2018-03-10 12:31:34'),
(2, 2, '300.00', '', '0.00', '0.00', '0000-00-00', '2018-03-17', 17, 3, 2018, 8, '', '', 0, 0, '2018-03-17 16:37:52', '2018-03-17 10:37:52'),
(3, 2, '599.00', '', '0.00', '0.00', '0000-00-00', '2018-03-19', 19, 3, 2018, 8, '', '', 0, 0, '2018-03-19 18:57:24', '2018-03-19 12:57:24'),
(4, 2, '11.00', '', '0.00', '0.00', '0000-00-00', '2018-03-16', 16, 3, 2018, 8, '', '', 0, 0, '2018-03-19 20:27:35', '2018-03-19 14:27:35'),
(5, 2, '500.00', 'Deposit', '0.00', '0.00', '0000-00-00', '2018-03-22', 22, 3, 2018, 8, '', 'test ', 0, 0, '2018-03-23 00:07:57', '2018-03-22 18:07:57'),
(6, 2, '5000.00', 'Profit Distribution', '0.00', '0.00', '0000-00-00', '2018-03-22', 22, 3, 2018, 8, '', 'cash', 0, 0, '2018-03-23 00:08:35', '2018-03-22 18:08:35'),
(7, 2, '1000.00', 'Credit Adjust', '0.00', '0.00', '0000-00-00', '2018-03-22', 22, 3, 2018, 8, '', '', 0, 0, '2018-03-23 00:09:01', '2018-03-22 18:09:01'),
(8, 2, '2000.00', 'Debit Adjust', '0.00', '0.00', '0000-00-00', '2018-03-22', 22, 3, 2018, 8, '', 'tsttst', 0, 0, '2018-03-23 00:09:25', '2018-03-22 18:09:25'),
(9, 2, '2000.00', 'Profit Distribution', '0.00', '0.00', '0000-00-00', '2018-03-23', 23, 3, 2018, 8, '', 'test', 0, 0, '2018-03-23 00:34:53', '2018-03-22 18:34:53'),
(10, 2, '610.00', 'Debit Adjust', '0.00', '0.00', '0000-00-00', '2018-03-23', 23, 3, 2018, 8, '', 'test', 0, 0, '2018-03-23 01:12:14', '2018-03-22 19:12:14'),
(11, 3, '500.00', 'Profit Distribution', '0.00', '0.00', '0000-00-00', '2018-03-23', 23, 3, 2018, 8, '', 'asdasd', 0, 0, '2018-03-23 01:39:54', '2018-03-22 19:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reference_history`
--

CREATE TABLE IF NOT EXISTS `tbl_reference_history` (
  `ref_id` int(11) NOT NULL,
  `client_id` varchar(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `fathername` varchar(100) DEFAULT NULL,
  `mothername` varchar(100) DEFAULT NULL,
  `spousename` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nid` varchar(20) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `permanent_address` varchar(100) DEFAULT NULL,
  `village` varchar(100) DEFAULT NULL,
  `post_office` varchar(50) DEFAULT NULL,
  `police_station` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `present_address` varchar(100) DEFAULT NULL,
  `p_village` varchar(100) DEFAULT NULL,
  `p_post_office` varchar(50) DEFAULT NULL,
  `p_police_station` varchar(50) DEFAULT NULL,
  `p_district` varchar(50) DEFAULT NULL,
  `nominee_identity` varchar(100) DEFAULT NULL,
  `n_name` varchar(100) DEFAULT NULL,
  `n_fathername` varchar(100) DEFAULT NULL,
  `n_mothername` varchar(100) DEFAULT NULL,
  `n_date_of_birth` date DEFAULT NULL,
  `n_nid` varchar(20) DEFAULT NULL,
  `n_permanent_address` varchar(100) DEFAULT NULL,
  `n_village` varchar(100) DEFAULT NULL,
  `n_post_office` varchar(50) DEFAULT NULL,
  `n_police_station` varchar(50) DEFAULT NULL,
  `n_district` varchar(50) DEFAULT NULL,
  `n_present_address` varchar(50) DEFAULT NULL,
  `np_village` varchar(50) DEFAULT NULL,
  `np_post_office` varchar(50) DEFAULT NULL,
  `np_police_station` varchar(50) DEFAULT NULL,
  `np_district` varchar(50) DEFAULT NULL,
  `nominee_relationship` varchar(100) DEFAULT NULL,
  `summary` varchar(255) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `media_id2` int(11) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `membership_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_reference_history`
--

INSERT INTO `tbl_reference_history` (`ref_id`, `client_id`, `name`, `mobile`, `email`, `gender`, `fathername`, `mothername`, `spousename`, `date_of_birth`, `nid`, `occupation`, `education`, `religion`, `nationality`, `admission_date`, `blood_group`, `permanent_address`, `village`, `post_office`, `police_station`, `district`, `present_address`, `p_village`, `p_post_office`, `p_police_station`, `p_district`, `nominee_identity`, `n_name`, `n_fathername`, `n_mothername`, `n_date_of_birth`, `n_nid`, `n_permanent_address`, `n_village`, `n_post_office`, `n_police_station`, `n_district`, `n_present_address`, `np_village`, `np_post_office`, `np_police_station`, `np_district`, `nominee_relationship`, `summary`, `media_id`, `media_id2`, `added_by`, `status`, `created`, `updated`, `membership_type`) VALUES
(9, 'BOSOTI_3', 'Test', '123123', NULL, 0, 'AAA', 'BBB', '', '2018-03-21', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', 0, 0, 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(10, 'BOSOTI_5', 'Test Again', '32123123', NULL, 0, '123', '122', '', '2018-03-15', '', '', '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', NULL, '', '', '', '0000-00-00', '', NULL, '', '', '', '', NULL, '', '', '', '', '', '', 0, 0, 8, 1, '2018-03-23 18:49:44', '2018-03-23 18:49:44', 1),
(2, 'BOSOTI_1', 'Rahim uddin', '12345678999', NULL, 0, 'Jone Due', 'Mon Name', 'Husband name', '2018-03-07', '1222333444445555', 'Teacher', 'Msc', 'Other', 'Bangladesh', '2018-03-13', 'Ab', NULL, 'villagename', 'postoffice', 'policestation', 'dhaka', NULL, 'villpresent', 'postpresent', 'Dhakapresent', 'districtpresent', NULL, 'Nominee name', 'nominee father', 'nominee mother', '2018-03-22', '3338888282882828282', NULL, 'npermanenetadd', 'nomepost', 'nomPolice', 'nom Dis', NULL, 'no vill', 'no post', 'no police', 'no dis', 'nomiee relationship', '', 5, 6, 0, 1, '2018-03-03 13:56:23', '2018-03-10 09:05:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
`id` int(11) NOT NULL,
  `meta_key` varchar(60) NOT NULL,
  `meta_value` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=755 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `meta_key`, `meta_value`) VALUES
(748, 'app_title', 'Bosoti Sonchoy & Rin Dan Somiti'),
(749, 'full_address', '69 (6th flor) Shahali Plaza, Kafrul, Mirpur, Dhaka-1216'),
(750, 'app_email', 'sinha2773@gmail.com'),
(751, 'default_date', '2017-01-01'),
(752, 'date_format', ''),
(753, 'invoice_prefix', 'bsrds_'),
(754, 'currency', 'TK');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_history`
--

CREATE TABLE IF NOT EXISTS `tbl_transaction_history` (
`transaction_id` int(11) NOT NULL,
  `transaction_through` varchar(30) NOT NULL,
  `amount` double NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `bank_acc_id` int(11) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `note` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `transection_type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_transaction_history`
--

INSERT INTO `tbl_transaction_history` (`transaction_id`, `transaction_through`, `amount`, `member_id`, `bank_acc_id`, `payment_date`, `note`, `date_created`, `date_updated`, `added_by`, `status`, `transection_type`) VALUES
(1, 'Bankbook', 5000, NULL, 11, '2018-03-22', '', '2018-03-21 19:28:18', '2018-03-21 19:28:18', 8, 1, 'Transferred'),
(2, 'Bankbook', 1000, NULL, 11, '2018-03-22', '', '2018-03-21 19:30:26', '2018-03-21 19:30:26', 8, 1, 'Transferred'),
(3, 'Bankbook', 500, NULL, 12, '2018-03-22', 'hello transfer', '2018-03-21 19:33:23', '2018-03-21 19:33:23', 8, 1, 'Transferred');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
`id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `user_role_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `email`, `mobile`, `username`, `password`, `name`, `surname`, `gender`, `media_id`, `user_role_id`, `status`, `created`, `updated`) VALUES
(8, 'info@sinhabd.com', '01738050950', 'bakulsinha', '$2y$11$Ev1aOsKdLt9r99tbVJyGtuAdU2pI1gN.xd0CMlh2TutbkaYvolhce', 'Super', 'Admin', 'male', 0, 1, 1, '0000-00-00 00:00:00', '2017-07-25 17:52:11'),
(11, 'ziaulkhan7@gmail.com', '01552386124', 'ziaulkhan', '$2y$11$jGvzis5iHmr9p5GRcqXpGO2O0/oeU3V3Y.jjBuMthMOYog8OzrtOS', 'ziaul', 'khan', 'male', 0, 1, 1, '2017-03-13 18:45:11', '2017-04-26 21:59:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_user_roles` (
`user_role_id` int(11) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_roles`
--

INSERT INTO `tbl_user_roles` (`user_role_id`, `name`, `permission`) VALUES
(1, 'Admin', 'a:2:{s:6:"access";a:21:{i:0;s:17:"super_admin_power";i:1;s:13:"manager_power";i:2;s:14:"dashboard_info";i:3;s:13:"manage_member";i:4;s:14:"manage_payment";i:5;s:11:"save_income";i:6;s:10:"add_income";i:7;s:15:"add_income_type";i:8;s:15:"see_income_list";i:9;s:17:"see_income_report";i:10;s:12:"save_expense";i:11;s:11:"add_expense";i:12;s:16:"add_expense_type";i:13;s:16:"see_expense_list";i:14;s:18:"see_expense_report";i:15;s:14:"account_access";i:16;s:8:"add_user";i:17;s:11:"update_user";i:18;s:13:"see_user_list";i:19;s:16:"access_user_role";i:20;s:8:"settings";}s:6:"modify";a:1:{i:0;s:8:"add_user";}}'),
(2, 'Manager', 'a:2:{s:6:"access";a:23:{i:0;s:13:"manager_power";i:1;s:14:"dashboard_info";i:2;s:14:"access_package";i:3;s:19:"client_registration";i:4;s:15:"see_client_list";i:5;s:13:"update_client";i:6;s:20:"update_client_status";i:7;s:27:"update_client_status_active";i:8;s:20:"see_client_statement";i:9;s:8:"add_bill";i:10;s:11:"see_duelist";i:11;s:12:"see_paidlist";i:12;s:15:"see_bill_report";i:13;s:7:"see_log";i:14;s:17:"see_employee_list";i:15;s:10:"pay_salary";i:16;s:10:"add_income";i:17;s:11:"add_expense";i:18;s:16:"see_expense_list";i:19;s:18:"see_expense_report";i:20;s:14:"account_access";i:21;s:12:"send_message";i:22;s:15:"message_history";}s:6:"modify";N;}'),
(3, 'User', 'a:2:{s:6:"access";a:2:{i:0;s:20:"see_client_statement";i:1;s:11:"see_duelist";}s:6:"modify";N;}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bank_account`
--
ALTER TABLE `tbl_bank_account`
 ADD PRIMARY KEY (`bank_acc_id`), ADD UNIQUE KEY `acc_number` (`acc_number`);

--
-- Indexes for table `tbl_client_histories`
--
ALTER TABLE `tbl_client_histories`
 ADD PRIMARY KEY (`history_id`), ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_expense_types`
--
ALTER TABLE `tbl_expense_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_final_amount`
--
ALTER TABLE `tbl_final_amount`
 ADD PRIMARY KEY (`final_amount_id`);

--
-- Indexes for table `tbl_incomes`
--
ALTER TABLE `tbl_incomes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_income_types`
--
ALTER TABLE `tbl_income_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_medias`
--
ALTER TABLE `tbl_medias`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
 ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
 ADD PRIMARY KEY (`id`), ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaction_history`
--
ALTER TABLE `tbl_transaction_history`
 ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
 ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bank_account`
--
ALTER TABLE `tbl_bank_account`
MODIFY `bank_acc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_client_histories`
--
ALTER TABLE `tbl_client_histories`
MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_expense_types`
--
ALTER TABLE `tbl_expense_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_final_amount`
--
ALTER TABLE `tbl_final_amount`
MODIFY `final_amount_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_incomes`
--
ALTER TABLE `tbl_incomes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_income_types`
--
ALTER TABLE `tbl_income_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_medias`
--
ALTER TABLE `tbl_medias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=755;
--
-- AUTO_INCREMENT for table `tbl_transaction_history`
--
ALTER TABLE `tbl_transaction_history`
MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
MODIFY `user_role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

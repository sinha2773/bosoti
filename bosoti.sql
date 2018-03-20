-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2018 at 01:10 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bosoti`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_account`
--

CREATE TABLE `tbl_bank_account` (
  `bank_acc_id` int(11) NOT NULL,
  `bank_name` varchar(80) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `acc_name` varchar(60) NOT NULL,
  `acc_number` varchar(30) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_histories`
--

CREATE TABLE `tbl_client_histories` (
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

CREATE TABLE `tbl_expenses` (
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
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_types`
--

CREATE TABLE `tbl_expense_types` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_incomes`
--

CREATE TABLE `tbl_incomes` (
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
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_income_types`
--

CREATE TABLE `tbl_income_types` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medias`
--

CREATE TABLE `tbl_medias` (
  `id` int(11) NOT NULL,
  `media_type` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `image` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `tbl_members` (
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
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`id`, `client_id`, `name`, `mobile`, `email`, `gender`, `fathername`, `mothername`, `spousename`, `date_of_birth`, `nid`, `occupation`, `education`, `religion`, `nationality`, `admission_date`, `blood_group`, `permanent_address`, `village`, `post_office`, `police_station`, `district`, `present_address`, `p_village`, `p_post_office`, `p_police_station`, `p_district`, `nominee_identity`, `n_name`, `n_fathername`, `n_mothername`, `n_date_of_birth`, `n_nid`, `n_permanent_address`, `n_village`, `n_post_office`, `n_police_station`, `n_district`, `n_present_address`, `np_village`, `np_post_office`, `np_police_station`, `np_district`, `nominee_relationship`, `summary`, `media_id`, `media_id2`, `added_by`, `status`, `created`, `updated`) VALUES
(2, 'BOSOTI_1', 'Rahim uddin', '12345678999', NULL, 0, 'Jone Due', 'Mon Name', 'Husband name', '2018-03-07', '1222333444445555', 'Teacher', 'Msc', 'Other', 'Bangladesh', '2018-03-13', 'Ab', NULL, 'villagename', 'postoffice', 'policestation', 'dhaka', NULL, 'villpresent', 'postpresent', 'Dhakapresent', 'districtpresent', NULL, 'Nominee name', 'nominee father', 'nominee mother', '2018-03-22', '3338888282882828282', NULL, 'npermanenetadd', 'nomepost', 'nomPolice', 'nom Dis', NULL, 'no vill', 'no post', 'no police', 'no dis', 'nomiee relationship', '', 5, 6, 0, 1, '2018-03-03 19:56:23', '2018-03-10 15:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
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

CREATE TABLE `tbl_notes` (
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

CREATE TABLE `tbl_payments` (
  `id` bigint(20) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `client_id`, `amount`, `discount`, `bill`, `billing_date`, `payment_date`, `payment_day`, `payment_month`, `payment_year`, `added_by`, `book_no`, `summary`, `bill_status`, `client_status`, `created`, `updated`) VALUES
(1, 2, '200.00', '0.00', '0.00', '0000-00-00', '2018-03-10', 10, 3, 2018, 8, '', 'test', 0, 0, '2018-03-10 18:31:34', '2018-03-10 12:31:34'),
(2, 2, '300.00', '0.00', '0.00', '0000-00-00', '2018-03-17', 17, 3, 2018, 8, '', '', 0, 0, '2018-03-17 16:37:52', '2018-03-17 10:37:52'),
(3, 2, '599.00', '0.00', '0.00', '0000-00-00', '2018-03-19', 19, 3, 2018, 8, '', '', 0, 0, '2018-03-19 18:57:24', '2018-03-19 12:57:24'),
(4, 2, '11.00', '0.00', '0.00', '0000-00-00', '2018-03-16', 16, 3, 2018, 8, '', '', 0, 0, '2018-03-19 20:27:35', '2018-03-19 14:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `meta_key` varchar(60) NOT NULL,
  `meta_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

CREATE TABLE `tbl_user_roles` (
  `user_role_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD PRIMARY KEY (`bank_acc_id`);

--
-- Indexes for table `tbl_client_histories`
--
ALTER TABLE `tbl_client_histories`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `client_id` (`client_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `bank_acc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_client_histories`
--
ALTER TABLE `tbl_client_histories`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_expense_types`
--
ALTER TABLE `tbl_expense_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_incomes`
--
ALTER TABLE `tbl_incomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_income_types`
--
ALTER TABLE `tbl_income_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_medias`
--
ALTER TABLE `tbl_medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=755;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
  MODIFY `user_role_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

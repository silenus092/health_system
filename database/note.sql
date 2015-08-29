-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2015 at 03:57 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `health_it2`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
`doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(45) DEFAULT NULL,
  `doctor_mobile_phone` varchar(45) DEFAULT NULL,
  `doctor_phone` varchar(45) DEFAULT NULL,
  `hospital` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
`patient_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `symptom_1_1` varchar(45) DEFAULT NULL,
  `symptom_1_2` varchar(45) DEFAULT NULL,
  `symptom_1_3` varchar(45) DEFAULT NULL,
  `symptom_2` varchar(45) DEFAULT NULL,
  `symptom_3` varchar(45) DEFAULT NULL,
  `symptom_4_1` varchar(45) DEFAULT NULL,
  `symptom_4_2` varchar(45) DEFAULT NULL,
  `symptom_4_3` varchar(45) DEFAULT NULL,
  `symptom_4_4` varchar(45) DEFAULT NULL,
  `symptom_5` varchar(45) DEFAULT NULL,
  `symptom_5_date` date DEFAULT NULL,
  `symptom_5_result` varchar(100) DEFAULT NULL,
  `symptom_6` varchar(45) DEFAULT NULL,
  `symptom_6_date` date DEFAULT NULL,
  `symptom_6_result` varchar(100) DEFAULT NULL,
  `symptom_7_1` varchar(45) DEFAULT NULL,
  `symptom_7_1_result` varchar(45) DEFAULT NULL,
  `symptom_7_2` varchar(45) DEFAULT NULL,
  `symptom_7_2_result` varchar(45) DEFAULT NULL,
  `symptom_7_3` varchar(45) DEFAULT NULL,
  `symptom_7_3_result` varchar(45) DEFAULT NULL,
  `symptom_8` varchar(45) DEFAULT NULL,
  `symptom_9_male` int(11) DEFAULT NULL,
  `symptom_9_female` int(11) DEFAULT NULL,
  `symptom_10_2_female` int(11) DEFAULT NULL,
  `symptom_10_2_male` int(11) DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `regis_date` date DEFAULT NULL,
  `symptom_10_1` varchar(45) DEFAULT NULL,
  `symptom_10_1_male` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
`person_id` int(11) NOT NULL,
  `person_first_name` varchar(45) DEFAULT NULL,
  `person_last_name` varchar(45) DEFAULT NULL,
  `person_age` int(11) DEFAULT NULL,
  `person_birth_date` datetime DEFAULT NULL,
  `person_citizenID` varchar(45) DEFAULT NULL,
  `person_house_num` varchar(45) DEFAULT NULL,
  `person_soi` varchar(45) DEFAULT NULL,
  `person_road` varchar(45) DEFAULT NULL,
  `person_tumbon` varchar(45) DEFAULT NULL,
  `person_amphur` varchar(45) DEFAULT NULL,
  `person_province` varchar(45) DEFAULT NULL,
  `person_post_code` int(11) DEFAULT NULL,
  `person_mobile_phone` varchar(45) DEFAULT NULL,
  `person_phone` varchar(45) DEFAULT NULL,
  `person_sex` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE IF NOT EXISTS `relationships` (
`relationships_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `relationship_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `relationship_type`
--

CREATE TABLE IF NOT EXISTS `relationship_type` (
`relationship_type_id` int(11) NOT NULL,
  `relationship_type_description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`role_id` int(11) NOT NULL,
  `role_description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `staff_type` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `staff_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'kunaphas kongkitimanon', 'kunaphas.kon@gmail.com', '$2y$10$fwbx11nAenOapuCuHFv2uu4wRAQr0oAACQSbSIgkHdTAxPPToJHGy', '', 'okx5lQekbxa1yYO8w8sx6hZHUKC5wevNqsuL0UXHYSOnIKtTnwxdPafQ9tyt', '2015-08-12 00:12:21', '2015-08-16 08:31:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
 ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
 ADD PRIMARY KEY (`patient_id`,`doctor_id`), ADD KEY `fk_patient_person_idx` (`person_id`), ADD KEY `fk_patient_doctor1_idx` (`doctor_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
 ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
 ADD PRIMARY KEY (`relationships_id`), ADD KEY `fk_relationships_person1_idx` (`person_id`), ADD KEY `fk_relationships_roles1_idx` (`role_id`), ADD KEY `fk_relationships_relationship_type1_idx` (`relationship_type_id`);

--
-- Indexes for table `relationship_type`
--
ALTER TABLE `relationship_type`
 ADD PRIMARY KEY (`relationship_type_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
MODIFY `relationships_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `relationship_type`
--
ALTER TABLE `relationship_type`
MODIFY `relationship_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
ADD CONSTRAINT `fk_patient_doctor1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_patient_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `relationships`
--
ALTER TABLE `relationships`
ADD CONSTRAINT `fk_relationships_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_relationships_relationship_type1` FOREIGN KEY (`relationship_type_id`) REFERENCES `relationship_type` (`relationship_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_relationships_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

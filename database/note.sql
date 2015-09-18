-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2015 at 11:59 AM
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
-- Table structure for table `disease_1`
--

CREATE TABLE IF NOT EXISTS `disease_1` (
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
  `symptom_10_1` varchar(45) DEFAULT NULL,
  `symptom_10_1_number` varchar(45) DEFAULT NULL,
  `symptom_10_1_check` varchar(45) DEFAULT NULL,
  `questions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disease_1`
--

INSERT INTO `disease_1` (`symptom_1_1`, `symptom_1_2`, `symptom_1_3`, `symptom_2`, `symptom_3`, `symptom_4_1`, `symptom_4_2`, `symptom_4_3`, `symptom_4_4`, `symptom_5`, `symptom_5_date`, `symptom_5_result`, `symptom_6`, `symptom_6_date`, `symptom_6_result`, `symptom_7_1`, `symptom_7_1_result`, `symptom_7_2`, `symptom_7_2_result`, `symptom_7_3`, `symptom_7_3_result`, `symptom_8`, `symptom_9_male`, `symptom_9_female`, `symptom_10_2_female`, `symptom_10_2_male`, `symptom_10_1`, `symptom_10_1_number`, `symptom_10_1_check`, `questions_id`) VALUES
('ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', '0', '0', 'ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', 'มี', '2015-09-08', 'ปลอดภัยดี', 'ตรวจ', '2015-09-09', 'ปลอดภัยดี', 'ปกติ', 'ปลอดภัยดี', 'ไม่เป็น', 'ปลอดภัยดี', 'ปกติ', 'ปลอดภัยดี', 'ไม่รู้', 0, 0, 1, 3, 'มี', '0', NULL, 55),
('ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', '0', '0', 'ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', 'ไม่มี', '2015-09-08', 'ปลอดภัยดี', 'ไม่ได้ตรวจ', '2015-09-09', 'ปลอดภัยดี', 'ปกติ', 'ปลอดภัยดี', 'ไม่เป็น', 'ปลอดภัยดี', 'ปกติ', 'ปลอดภัยดี', 'เป็นพาหะ', 0, 0, 1, 3, 'ไม่มี', '0', NULL, 56),
('ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', '0', '0', 'ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', 'ไม่มี', '2015-09-08', 'ปลอดภัยดี', 'ไม่ได้ตรวจ', '2015-09-09', 'ปลอดภัยดี', 'ปกติ', 'ปลอดภัยดี', 'ไม่เป็น', 'ปลอดภัยดี', 'ปกติ', 'ปลอดภัยดี', 'เป็นพาหะ', 0, 0, 1, 3, 'ไม่มี', '0', NULL, 57),
('ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', '0', '0', 'ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', 'ไม่เป็น', 'ไม่มี', '2015-09-08', 'ปลอดภัยดี', 'ไม่ได้ตรวจ', '2015-09-09', 'ปลอดภัยดี', 'ปกติ', 'ปลอดภัยดี', 'ไม่เป็น', 'ปลอดภัยดี', 'ปกติ', 'ปลอดภัยดี', 'เป็นพาหะ', 0, 0, 1, 3, 'ไม่มี', '0', NULL, 58);

-- --------------------------------------------------------

--
-- Table structure for table `disease_forms`
--

CREATE TABLE IF NOT EXISTS `disease_forms` (
`question_id` int(11) NOT NULL,
  `disease_type_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `disease_forms`
--

INSERT INTO `disease_forms` (`question_id`, `disease_type_id`) VALUES
(55, 1),
(56, 1),
(57, 1),
(58, 1);

-- --------------------------------------------------------

--
-- Table structure for table `disease_types`
--

CREATE TABLE IF NOT EXISTS `disease_types` (
`disease_type_id` int(11) NOT NULL,
  `disease_type_name_th` varchar(45) DEFAULT NULL,
  `disease_type_name_en` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `disease_types`
--

INSERT INTO `disease_types` (`disease_type_id`, `disease_type_name_th`, `disease_type_name_en`) VALUES
(1, 'ดูเชน', 'Duchenne muscular dystrophy, DMD'),
(2, 'พร่องเอนไซม์ G6PD', 'Glucose-6-phosphate dehydrogenase deficiency'),
(3, 'เบาหวาน', ' Diabetes mellitus (DM)');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
`doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(45) DEFAULT NULL,
  `doctor_mobile_phone` varchar(45) DEFAULT NULL,
  `doctor_phone` varchar(45) DEFAULT NULL,
  `hospital` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `doctor_name`, `doctor_mobile_phone`, `doctor_phone`, `hospital`, `email`) VALUES
(55, 'ใหม่ ดาวิกา', '0840919392', '027416163', 'สมิติเวช', 'mai.davi@gmail.com'),
(56, 'ใหม่ ดาวิกา', '0840919392', '027416163', 'สมิติเวช', 'mai.davi@gmail.com'),
(57, 'ใหม่ ดาวิกา', '0840919392', '027416163', 'สมิติเวช', 'mai.davi@gmail.com'),
(58, 'ใหม่ ดาวิกา', '0840919392', '027416163', 'สมิติเวช', 'mai.davi@gmail.com');

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
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
`patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `registration_date` date DEFAULT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `doctor_id`, `registration_date`, `person_id`) VALUES
(55, 55, '2015-09-15', 65),
(56, 56, '2015-09-15', 67),
(57, 57, '2015-09-15', 69),
(58, 58, '2015-09-15', 71);

-- --------------------------------------------------------

--
-- Table structure for table `patients_disease_forms`
--

CREATE TABLE IF NOT EXISTS `patients_disease_forms` (
`patients_do_questions_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `registration_date` date DEFAULT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `patients_disease_forms`
--

INSERT INTO `patients_disease_forms` (`patients_do_questions_id`, `question_id`, `registration_date`, `patient_id`) VALUES
(55, 55, '2015-09-18', 55),
(56, 56, '2015-09-18', 56),
(57, 57, '2015-09-18', 57),
(58, 58, '2015-09-18', 58);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
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
  `person_sex` varchar(45) DEFAULT NULL,
  `person_mooh_num` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`person_id`, `person_first_name`, `person_last_name`, `person_age`, `person_birth_date`, `person_citizenID`, `person_house_num`, `person_soi`, `person_road`, `person_tumbon`, `person_amphur`, `person_province`, `person_post_code`, `person_mobile_phone`, `person_phone`, `person_sex`, `person_mooh_num`) VALUES
(65, 'คุณาภาส ', 'คงกิติมานนท์', 24, '1991-11-29 00:00:00', '1103300053746', '137/5', 'สุขุมวิท 60/1', 'สุขุมวิท ', 'บางจาก', 'เขตพระโขนง', 'กรุงเทพ', 10260, '027416163', '0840919392', 'male', '-'),
(66, 'ทศพล', 'คงกิติมานนท์', 80, NULL, '11560002352', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'male', NULL),
(67, 'สุนันท์', 'คงกิติมานนท์', 24, '1991-11-29 00:00:00', '1103300053748', '137/5', 'สุขุมวิท 60/1', 'สุขุมวิท ', 'บางจาก', 'เขตพระโขนง', 'กรุงเทพ', 10260, '027416163', '0840919392', 'female', '-'),
(68, 'ณัฐพล', 'คงกิติมานนท์', 80, NULL, '11560002353', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'male', NULL),
(69, 'พลอย', 'เฌอมาลย์', 24, '1991-11-29 00:00:00', '1103300053747', '137/5', 'สุขุมวิท 60/1', 'สุขุมวิท ', 'บางจาก', 'เขตพระโขนง', 'กรุงเทพ', 10260, '027416163', '0840919392', 'female', '-'),
(71, 'ได', 'ไดอาน่า', 24, '1991-11-29 00:00:00', '1103300053749', '137/5', 'สุขุมวิท 60/1', 'สุขุมวิท ', 'บางจาก', 'เขตพระโขนง', 'กรุงเทพ', 10260, '027416163', '0840919392', 'female', '-'),
(72, 'สามารถ', 'กมลรัต', 80, NULL, '11560002354', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'male', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE IF NOT EXISTS `relationship` (
`relationship_id` int(11) NOT NULL,
  `person_1_id` int(11) NOT NULL,
  `role_1_id` int(11) NOT NULL,
  `relationship_type_id` int(11) NOT NULL,
  `person_2_id` int(11) NOT NULL,
  `role_2_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='The relationship uses to identify role and relationship  between two people' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`relationship_id`, `person_1_id`, `role_1_id`, `relationship_type_id`, `person_2_id`, `role_2_id`) VALUES
(3, 65, 23, 4, 69, 22),
(4, 65, 19, 3, 66, 1),
(5, 65, 19, 3, 67, 2);

-- --------------------------------------------------------

--
-- Table structure for table `relationship_type`
--

CREATE TABLE IF NOT EXISTS `relationship_type` (
`relationship_type_id` int(11) NOT NULL,
  `relationship_type_description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='eg  Parent ,Child , Married' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `relationship_type`
--

INSERT INTO `relationship_type` (`relationship_type_id`, `relationship_type_description`) VALUES
(1, 'ญาติ'),
(2, 'พี่น้อง'),
(3, 'พ่อเเม่'),
(4, 'คู่สมรส'),
(5, 'ลูก');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`role_id` int(11) NOT NULL,
  `role_description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='eg Father , Son ,Husban , Wife' AUTO_INCREMENT=26 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_description`) VALUES
(1, 'พ่อ'),
(2, 'เเม่'),
(3, 'พี่ชาย'),
(4, 'พี่สาว'),
(5, 'น้องชาย'),
(6, 'น้องสาว'),
(7, 'ปู่ทวด'),
(8, 'ย่าทวด'),
(9, 'ตา'),
(10, 'ยาย'),
(11, 'ปู่'),
(12, 'ย่า'),
(13, 'ลุง'),
(14, 'ป้า'),
(15, 'อา'),
(16, 'น้า'),
(17, 'หลานชาย'),
(18, 'หลานสาว'),
(19, 'ลูกชาย'),
(20, 'ลูกสาว'),
(21, 'ระบุสถานะไม่ได้'),
(22, 'ภรรยา'),
(23, 'สามี'),
(24, 'เหลนชาย'),
(25, 'เหลนสาว');

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
-- Indexes for table `disease_1`
--
ALTER TABLE `disease_1`
 ADD PRIMARY KEY (`questions_id`);

--
-- Indexes for table `disease_forms`
--
ALTER TABLE `disease_forms`
 ADD PRIMARY KEY (`question_id`,`disease_type_id`), ADD KEY `fk_disease_forms_disease_types1_idx` (`disease_type_id`);

--
-- Indexes for table `disease_types`
--
ALTER TABLE `disease_types`
 ADD PRIMARY KEY (`disease_type_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
 ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
 ADD PRIMARY KEY (`patient_id`), ADD KEY `fk_patients_doctors1_idx` (`doctor_id`), ADD KEY `fk_patients_persons1_idx` (`person_id`);

--
-- Indexes for table `patients_disease_forms`
--
ALTER TABLE `patients_disease_forms`
 ADD PRIMARY KEY (`patients_do_questions_id`), ADD KEY `fk_patients_do_questions_questions1_idx` (`question_id`), ADD KEY `fk_patients_do_questions_patients1_idx` (`patient_id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
 ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
 ADD PRIMARY KEY (`relationship_id`), ADD KEY `fk_relationships_person1_idx` (`person_1_id`), ADD KEY `fk_relationships_roles1_idx` (`role_1_id`), ADD KEY `fk_relationships_relationship_type1_idx` (`relationship_type_id`), ADD KEY `fk_relationship_persons1_idx` (`person_2_id`), ADD KEY `fk_relationship_roles1_idx` (`role_2_id`);

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
-- AUTO_INCREMENT for table `disease_forms`
--
ALTER TABLE `disease_forms`
MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `disease_types`
--
ALTER TABLE `disease_types`
MODIFY `disease_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `patients_disease_forms`
--
ALTER TABLE `patients_disease_forms`
MODIFY `patients_do_questions_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `relationship`
--
ALTER TABLE `relationship`
MODIFY `relationship_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `relationship_type`
--
ALTER TABLE `relationship_type`
MODIFY `relationship_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `disease_1`
--
ALTER TABLE `disease_1`
ADD CONSTRAINT `fk_question_questions1` FOREIGN KEY (`questions_id`) REFERENCES `disease_forms` (`question_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `disease_forms`
--
ALTER TABLE `disease_forms`
ADD CONSTRAINT `fk_disease_forms_disease_types1` FOREIGN KEY (`disease_type_id`) REFERENCES `disease_types` (`disease_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
ADD CONSTRAINT `fk_patients_doctors1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_patients_persons1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `patients_disease_forms`
--
ALTER TABLE `patients_disease_forms`
ADD CONSTRAINT `fk_patients_do_questions_patients1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_patients_do_questions_questions1` FOREIGN KEY (`question_id`) REFERENCES `disease_forms` (`question_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `relationship`
--
ALTER TABLE `relationship`
ADD CONSTRAINT `fk_relationship_persons1` FOREIGN KEY (`person_2_id`) REFERENCES `persons` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_relationship_roles1` FOREIGN KEY (`role_2_id`) REFERENCES `roles` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_relationships_person1` FOREIGN KEY (`person_1_id`) REFERENCES `persons` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_relationships_relationship_type1` FOREIGN KEY (`relationship_type_id`) REFERENCES `relationship_type` (`relationship_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_relationships_roles1` FOREIGN KEY (`role_1_id`) REFERENCES `roles` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

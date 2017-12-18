CREATE DATABASE  IF NOT EXISTS `agedb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `agedb`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: agedb
-- ------------------------------------------------------
-- Server version	5.7.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `address` varchar(150) NOT NULL,
  `district` varchar(55) NOT NULL,
  `city` varchar(65) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postal_code` varchar(15) NOT NULL,
  `number` varchar(45) DEFAULT NULL,
  `complement` varchar(150) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_address_created_by_idx` (`created_by`),
  KEY `fk_address_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrative_file`
--

DROP TABLE IF EXISTS `administrative_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrative_file` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `image` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_adm_file_created_by_idx` (`created_by`),
  KEY `fk_adm_file_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrative_file`
--

LOCK TABLES `administrative_file` WRITE;
/*!40000 ALTER TABLE `administrative_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrative_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bill` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` longtext NOT NULL,
  `description` varchar(450) NOT NULL,
  `image` longtext NOT NULL,
  `user` bigint(20) NOT NULL,
  `value` double NOT NULL,
  `tax` bigint(20) NOT NULL,
  `pay_day` datetime NOT NULL,
  `status` varchar(45) NOT NULL,
  `observations` varchar(450) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bill_user_idx` (`user`),
  KEY `fk_bill_tax_idx` (`tax`),
  KEY `fk_bill_created_by_idx` (`created_by`),
  KEY `fk_bill_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  `observations` varchar(450) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description_UNIQUE` (`description`),
  KEY `fk_event_created_by_idx` (`created_by`),
  KEY `fk_event_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_image`
--

DROP TABLE IF EXISTS `event_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_image` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `image` longtext NOT NULL,
  `event` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evt_img_event_idx` (`event`),
  KEY `fk_evt_img_created_by_idx` (`created_by`),
  KEY `fk_evt_img_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_image`
--

LOCK TABLES `event_image` WRITE;
/*!40000 ALTER TABLE `event_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercise`
--

DROP TABLE IF EXISTS `exercise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exercise` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(450) NOT NULL,
  `type` varchar(45) NOT NULL,
  `team` bigint(20) NOT NULL,
  `matter` bigint(20) NOT NULL,
  `deadline` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exercise_team_idx` (`team`),
  KEY `fk_exercise_matter_idx` (`matter`),
  KEY `fk_exercise_created_by_idx` (`created_by`),
  KEY `fk_exercise_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercise`
--

LOCK TABLES `exercise` WRITE;
/*!40000 ALTER TABLE `exercise` DISABLE KEYS */;
/*!40000 ALTER TABLE `exercise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercise_file`
--

DROP TABLE IF EXISTS `exercise_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exercise_file` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `exercise` bigint(20) NOT NULL,
  `image` longtext NOT NULL,
  `done_image` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exe_file_exercise_idx` (`exercise`),
  KEY `fk_exe_file_created_by_idx` (`created_by`),
  KEY `fk_exe_file_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercise_file`
--

LOCK TABLES `exercise_file` WRITE;
/*!40000 ALTER TABLE `exercise_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `exercise_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grade` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `matter` bigint(20) NOT NULL,
  `position` bigint(20) NOT NULL,
  `student` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grade_matter_idx` (`matter`),
  KEY `fk_grade_position_idx` (`position`),
  KEY `fk_grade_student_idx` (`student`),
  KEY `fk_grade_created_by_idx` (`created_by`),
  KEY `fk_grade_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grade`
--

LOCK TABLES `grade` WRITE;
/*!40000 ALTER TABLE `grade` DISABLE KEYS */;
/*!40000 ALTER TABLE `grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matter`
--

DROP TABLE IF EXISTS `matter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matter` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `teacher` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_matter_teacher_idx` (`teacher`),
  KEY `fk_matter_created_by_idx` (`created_by`),
  KEY `fk_matter_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matter`
--

LOCK TABLES `matter` WRITE;
/*!40000 ALTER TABLE `matter` DISABLE KEYS */;
/*!40000 ALTER TABLE `matter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `more_information`
--

DROP TABLE IF EXISTS `more_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `more_information` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user` bigint(20) NOT NULL,
  `address` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_more_info_user_idx` (`user`),
  KEY `fk_more_info_address_idx` (`address`),
  KEY `fk_more_info_created_by_idx` (`created_by`),
  KEY `fk_more_info_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `more_information`
--

LOCK TABLES `more_information` WRITE;
/*!40000 ALTER TABLE `more_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `more_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `rules` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'Administrador','Administrador'),(2,'Aluno','Aluno'),(3,'Professor','Professor');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `position` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  `description` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `position_UNIQUE` (`position`),
  UNIQUE KEY `description_UNIQUE` (`description`),
  KEY `fk_position_created_by_idx` (`created_by`),
  KEY `fk_position_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_check_list`
--

DROP TABLE IF EXISTS `student_check_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_check_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(150) NOT NULL,
  `value` double NOT NULL,
  `status` varchar(45) NOT NULL,
  `student` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description_UNIQUE` (`description`),
  KEY `fk_cl_student_idx` (`student`),
  KEY `fk_cl_created_by_idx` (`created_by`),
  KEY `fk_cl_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_check_list`
--

LOCK TABLES `student_check_list` WRITE;
/*!40000 ALTER TABLE `student_check_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_check_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_in_team`
--

DROP TABLE IF EXISTS `student_in_team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_in_team` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student` bigint(20) NOT NULL,
  `team` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_UNIQUE` (`student`),
  KEY `fk_sit_team_idx` (`team`),
  KEY `fk_sit_created_by_idx` (`created_by`),
  KEY `fk_sit_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_in_team`
--

LOCK TABLES `student_in_team` WRITE;
/*!40000 ALTER TABLE `student_in_team` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_in_team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax`
--

DROP TABLE IF EXISTS `tax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `day_assessment` double NOT NULL,
  `month_assessment` double NOT NULL,
  `year_assessment` double NOT NULL,
  `description` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description_UNIQUE` (`description`),
  KEY `fk_tax_created_by_idx` (`created_by`),
  KEY `fk_tax_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax`
--

LOCK TABLES `tax` WRITE;
/*!40000 ALTER TABLE `tax` DISABLE KEYS */;
/*!40000 ALTER TABLE `tax` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `degree` int(11) NOT NULL,
  `round` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_team_created_by_idx` (`created_by`),
  KEY `fk_team_updated_by_idx` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone1` varchar(45) DEFAULT NULL,
  `phone2` varchar(45) DEFAULT NULL,
  `foto` longtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_access` datetime NOT NULL,
  `permission` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_user_permission_idx` (`permission`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Administrador','JDUkcm91bmRzPTUwMDAkY3J5cHRpbmdhbGxzdHJpbiRId25TYjA5S08ualAvaDYxdkpDY0pJdkJrRUgudk9mVXVDd0xrTm5saFUy','douglasf.filho@gmail.com','81996729491','81988874815',NULL,'2017-12-16 18:00:00','2017-12-16 18:00:00','2017-12-16 18:00:00',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'agedb'
--

--
-- Dumping routines for database 'agedb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-17 22:45:43

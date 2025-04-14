/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.7.2-MariaDB, for debian-linux-gnu (aarch64)
--
-- Host: localhost    Database: office_reservation_system
-- ------------------------------------------------------
-- Server version	11.7.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `Approvals`
--

DROP TABLE IF EXISTS `Approvals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Approvals` (
  `approval_id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `approver_id` int(11) NOT NULL,
  `decision` enum('Approved','Rejected') NOT NULL,
  `notes` text DEFAULT NULL,
  `decided_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`approval_id`),
  KEY `reservation_id` (`reservation_id`),
  KEY `approver_id` (`approver_id`),
  CONSTRAINT `Approvals_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `Reservations` (`reservation_id`),
  CONSTRAINT `Approvals_ibfk_2` FOREIGN KEY (`approver_id`) REFERENCES `Users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Approvals`
--

LOCK TABLES `Approvals` WRITE;
/*!40000 ALTER TABLE `Approvals` DISABLE KEYS */;
INSERT INTO `Approvals` VALUES
(1,1,2,'Approved','Standard meeting request','2025-04-04 15:12:19'),
(2,2,5,'Approved','Approved with AV support','2025-04-04 15:12:19'),
(3,3,2,'Approved','Regular cafeteria use','2025-04-04 15:12:19'),
(4,4,5,'Rejected','Conflict with maintenance','2025-04-04 15:12:19'),
(5,5,2,'Approved','Approved before cancellation','2025-04-04 15:12:19');
/*!40000 ALTER TABLE `Approvals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuthenticationUsers`
--

DROP TABLE IF EXISTS `AuthenticationUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `AuthenticationUsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `otp_code` varchar(45) NOT NULL,
  `expired_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthenticationUsers`
--

LOCK TABLES `AuthenticationUsers` WRITE;
/*!40000 ALTER TABLE `AuthenticationUsers` DISABLE KEYS */;
INSERT INTO `AuthenticationUsers` VALUES
(1,'brown@gmail.com','','2025-04-05 00:30:00');
/*!40000 ALTER TABLE `AuthenticationUsers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Buildings`
--

DROP TABLE IF EXISTS `Buildings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Buildings` (
  `building_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `floors` int(11) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Buildings`
--

LOCK TABLES `Buildings` WRITE;
/*!40000 ALTER TABLE `Buildings` DISABLE KEYS */;
INSERT INTO `Buildings` VALUES
(1,'Tower A','123 Business Park',10,'John Doe'),
(2,'Tower B','456 Corporate Center',8,'Jane Smith'),
(3,'Annex Building','789 Office Plaza',5,'Bob Johnson'),
(4,'Main Campus','101 Education Road',15,'Alice Brown'),
(5,'Innovation Hub','202 Tech Valley',12,'Charlie Lee');
/*!40000 ALTER TABLE `Buildings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Facilities`
--

DROP TABLE IF EXISTS `Facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Facilities` (
  `facility_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `facility_type_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `status` enum('Available','Under Maintenance') DEFAULT 'Available',
  PRIMARY KEY (`facility_id`),
  KEY `facility_type_id` (`facility_type_id`),
  KEY `building_id` (`building_id`),
  CONSTRAINT `Facilities_ibfk_1` FOREIGN KEY (`facility_type_id`) REFERENCES `FacilityTypes` (`facility_type_id`),
  CONSTRAINT `Facilities_ibfk_2` FOREIGN KEY (`building_id`) REFERENCES `Buildings` (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Facilities`
--

LOCK TABLES `Facilities` WRITE;
/*!40000 ALTER TABLE `Facilities` DISABLE KEYS */;
INSERT INTO `Facilities` VALUES
(1,'Ruby Room','Small meeting room',8,'Tower A Lv.3',1,1,'Available'),
(2,'Grand Hall','Main auditorium',200,'Tower B Lv.1',2,2,'Available'),
(3,'Fitness Center','Gym with cardio machines',20,'Annex Lv.2',3,3,'Under Maintenance'),
(4,'Food Court','Main dining area',100,'Main Campus Lv.1',4,4,'Available'),
(5,'Maker Lab','Workshop with tools',15,'Innovation Hub Lv.3',5,5,'Available');
/*!40000 ALTER TABLE `Facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FacilityTypes`
--

DROP TABLE IF EXISTS `FacilityTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `FacilityTypes` (
  `facility_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`facility_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FacilityTypes`
--

LOCK TABLES `FacilityTypes` WRITE;
/*!40000 ALTER TABLE `FacilityTypes` DISABLE KEYS */;
INSERT INTO `FacilityTypes` VALUES
(1,'Meeting Room','Spaces for team discussions'),
(2,'Auditorium','Large event spaces'),
(3,'Gym','Fitness area with equipment'),
(4,'Cafeteria','Dining and lounge area'),
(5,'Workshop Room','Hands-on activity spaces');
/*!40000 ALTER TABLE `FacilityTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Feedbacks`
--

DROP TABLE IF EXISTS `Feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Feedbacks` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`feedback_id`),
  KEY `reservation_id` (`reservation_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `Feedbacks_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `Reservations` (`reservation_id`),
  CONSTRAINT `Feedbacks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Feedbacks`
--

LOCK TABLES `Feedbacks` WRITE;
/*!40000 ALTER TABLE `Feedbacks` DISABLE KEYS */;
INSERT INTO `Feedbacks` VALUES
(1,1,3,5,'Excellent room setup','2025-04-04 15:12:19'),
(2,2,4,4,'Great space but AC was too cold','2025-04-04 15:12:19'),
(3,3,3,3,'Food quality could be better','2025-04-04 15:12:19'),
(4,4,5,1,'Very disappointed with rejection','2025-04-04 15:12:19'),
(5,5,1,2,'Had to cancel last minute','2025-04-04 15:12:19');
/*!40000 ALTER TABLE `Feedbacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notifications`
--

DROP TABLE IF EXISTS `Notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `type` enum('Booking Confirmation','Cancellation','Reminder') NOT NULL,
  `sent_at` timestamp NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`notification_id`),
  KEY `user_id` (`user_id`),
  KEY `reservation_id` (`reservation_id`),
  CONSTRAINT `Notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  CONSTRAINT `Notifications_ibfk_2` FOREIGN KEY (`reservation_id`) REFERENCES `Reservations` (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notifications`
--

LOCK TABLES `Notifications` WRITE;
/*!40000 ALTER TABLE `Notifications` DISABLE KEYS */;
INSERT INTO `Notifications` VALUES
(1,3,1,'Your reservation for Ruby Room has been approved','Booking Confirmation','2025-04-04 15:12:19',1),
(2,4,2,'Reminder: Your event at Grand Hall starts in 1 hour','Reminder','2025-04-04 15:12:19',0),
(3,5,4,'Your workshop request was rejected due to maintenance','Cancellation','2025-04-04 15:12:19',1),
(4,1,5,'Your reservation has been cancelled successfully','Cancellation','2025-04-04 15:12:19',1),
(5,3,3,'Thank you for using our cafeteria services','Booking Confirmation','2025-04-04 15:12:19',0);
/*!40000 ALTER TABLE `Notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reservations`
--

DROP TABLE IF EXISTS `Reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Reservations` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` enum('Pending','Approved','Rejected','Cancelled') DEFAULT 'Pending',
  `purpose` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`reservation_id`),
  KEY `user_id` (`user_id`),
  KEY `facility_id` (`facility_id`),
  CONSTRAINT `Reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  CONSTRAINT `Reservations_ibfk_2` FOREIGN KEY (`facility_id`) REFERENCES `Facilities` (`facility_id`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`end_time` > `start_time`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reservations`
--

LOCK TABLES `Reservations` WRITE;
/*!40000 ALTER TABLE `Reservations` DISABLE KEYS */;
INSERT INTO `Reservations` VALUES
(1,3,1,'2023-11-15 10:00:00','2023-11-15 11:30:00','Approved','Team meeting','2025-04-04 15:12:19'),
(2,4,2,'2023-11-16 14:00:00','2023-11-16 17:00:00','Pending','Product launch','2025-04-04 15:12:19'),
(3,3,4,'2023-11-17 12:00:00','2023-11-17 13:00:00','Approved','Lunch gathering','2025-04-04 15:12:19'),
(4,5,5,'2023-11-18 09:00:00','2023-11-18 12:00:00','Rejected','Workshop session','2025-04-04 15:12:19'),
(5,1,1,'2023-11-20 13:00:00','2023-11-20 14:00:00','Cancelled','Client presentation','2025-04-04 15:12:19');
/*!40000 ALTER TABLE `Reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Schedules`
--

DROP TABLE IF EXISTS `Schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Schedules` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `opening_time` time NOT NULL,
  `closing_time` time NOT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`schedule_id`),
  KEY `facility_id` (`facility_id`),
  CONSTRAINT `Schedules_ibfk_1` FOREIGN KEY (`facility_id`) REFERENCES `Facilities` (`facility_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Schedules`
--

LOCK TABLES `Schedules` WRITE;
/*!40000 ALTER TABLE `Schedules` DISABLE KEYS */;
INSERT INTO `Schedules` VALUES
(1,1,'Monday','08:00:00','18:00:00',1),
(2,1,'Tuesday','08:00:00','18:00:00',1),
(3,2,'Wednesday','09:00:00','21:00:00',1),
(4,3,'Friday','06:00:00','22:00:00',0),
(5,4,'Saturday','07:00:00','15:00:00',1);
/*!40000 ALTER TABLE `Schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UsageLogs`
--

DROP TABLE IF EXISTS `UsageLogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `UsageLogs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `check_in_time` datetime NOT NULL,
  `check_out_time` datetime DEFAULT NULL,
  `actual_usage` int(11) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `facility_id` (`facility_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `UsageLogs_ibfk_1` FOREIGN KEY (`facility_id`) REFERENCES `Facilities` (`facility_id`),
  CONSTRAINT `UsageLogs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`check_out_time` is null or `check_out_time` > `check_in_time`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsageLogs`
--

LOCK TABLES `UsageLogs` WRITE;
/*!40000 ALTER TABLE `UsageLogs` DISABLE KEYS */;
INSERT INTO `UsageLogs` VALUES
(1,1,3,'2023-11-15 09:55:00','2023-11-15 11:35:00',100),
(2,2,4,'2023-11-16 13:45:00','2023-11-16 16:50:00',185),
(3,4,3,'2023-11-17 11:55:00','2023-11-17 13:10:00',75),
(4,5,5,'2023-11-18 08:30:00',NULL,NULL),
(5,1,1,'2023-11-20 12:45:00','2023-11-20 13:00:00',15);
/*!40000 ALTER TABLE `UsageLogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Facility Manager','Regular User') NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES
(1,'John Doe','john@example.com','hashed123','Admin','08123456789','2025-04-04 15:12:19','2025-04-04 15:15:26',NULL),
(2,'Jane Smith','jane@example.com','hashed456','Facility Manager','08234567890','2025-04-04 15:12:19','2025-04-04 15:15:26',NULL),
(3,'Bob Johnson','bob@example.com','hashed789','Regular User','08345678901','2025-04-04 15:12:19','2025-04-04 15:15:26',NULL),
(4,'Alice Brown','alice@example.com','hashed101','Regular User','08456789012','2025-04-04 15:12:19','2025-04-04 15:15:26',NULL),
(5,'Charlie Lee','charlie@example.com','hashed112','Facility Manager','08567890123','2025-04-04 15:12:19','2025-04-04 15:15:26',NULL),
(6,'Brown','brown@gmail.com','$2y$10$Y/RFIAVaJo/szFW/iAAWxOMco1DvWZMPqXOQRQn.ZXAGdk2xxWy9K','Admin',NULL,'2025-04-04 17:03:04','2025-04-04 17:03:04',1);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-04-04 17:47:59

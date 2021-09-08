/*
 Navicat Premium Data Transfer

 Source Server         : OFFICE MYSQL 82
 Source Server Type    : MySQL
 Source Server Version : 80026
 Source Host           : 197.232.82.136:3309
 Source Schema         : ushauri_dod

 Target Server Type    : MySQL
 Target Server Version : 80026
 File Encoding         : 65001

 Date: 08/09/2021 15:36:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(0) NOT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for il_messages
-- ----------------------------
DROP TABLE IF EXISTS `il_messages`;
CREATE TABLE `il_messages`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(0) UNSIGNED NOT NULL,
  `reserved_at` int(0) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(0) UNSIGNED NOT NULL,
  `created_at` int(0) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date_added` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `time_stamp` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `processed` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Handles IL Messages' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for send_log
-- ----------------------------
DROP TABLE IF EXISTS `send_log`;
CREATE TABLE `send_log`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `statusCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `messageId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cost` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for sender_status
-- ----------------------------
DROP TABLE IF EXISTS `sender_status`;
CREATE TABLE `sender_status`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `phone_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cost` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl__logs_copy
-- ----------------------------
DROP TABLE IF EXISTS `tbl__logs_copy`;
CREATE TABLE `tbl__logs_copy`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'Primary key ',
  `group_id` int(0) NULL DEFAULT NULL COMMENT 'Foreign key to table group',
  `language_id` int(0) NULL DEFAULT NULL COMMENT 'Foreign key to table language',
  `facility_id` int(0) NULL DEFAULT NULL,
  `clinic_number` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'used to form the  compound key for each client',
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `f_name` varchar(244) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `m_name` varchar(244) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `l_name` varchar(244) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dob` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_status` enum('ART','On Care','Pre ART','No Condition') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `txt_frequency` int(0) NULL DEFAULT 168 COMMENT 'how frequenct should we check up on our client by default it\'s 168 ( whic is 1 week) ',
  `txt_time` int(0) NULL DEFAULT NULL COMMENT 'foreign key to table time',
  `phone_no` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'phone used to text the client',
  `alt_phone_no` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shared_no_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smsenable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'conent field for either client has accepted to receive messages ',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `status` enum('Active','Dead','Disabled','Deceased','Self Transfer','Transfer Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `partner_id` int(0) NULL DEFAULT NULL,
  `mfl_code` int(0) NULL DEFAULT NULL COMMENT 'foreign key to the master facility table ',
  `gender` int(0) NULL DEFAULT NULL,
  `marital` int(0) NULL DEFAULT NULL,
  `enrollment_date` datetime(0) NULL DEFAULT NULL,
  `art_date` datetime(0) NULL DEFAULT NULL,
  `wellness_enable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `motivational_enable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_type` enum('New','Transfer','Self Transfer','Transfer In','Transfer Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `age_group` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `birth_date` date NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `prev_clinic` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `transfer_date` date NULL DEFAULT NULL,
  `entry_point` enum('Web','Mobile','EMR','ADT','IL') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `welcome_sent` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `stable` enum('Yes','No','Stable','Un Stable') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Yes',
  `physical_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `consent_date` date NULL DEFAULT NULL,
  `GODS_NUMBER` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `DEATH_DATE` date NULL DEFAULT NULL,
  `PATIENT_SOURCE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SENDING_APPLICATION` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clnd_dob` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clinic_id` int(0) NULL DEFAULT NULL COMMENT 'foreign key for table clinic',
  `national_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `buddy_phone_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_deceased` date NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `locator_county` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_sub_county` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_ward` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_village` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_location` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `clinic_number_2`(`clinic_number`, `mfl_code`, `f_name`, `m_name`, `l_name`) USING BTREE,
  UNIQUE INDEX `clinic_number`(`clinic_number`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE,
  INDEX `language_id`(`language_id`) USING BTREE,
  INDEX `gender`(`gender`) USING BTREE,
  INDEX `marital`(`marital`) USING BTREE,
  INDEX `date_added`(`created_at`) USING BTREE,
  INDEX `mfl_code`(`mfl_code`) USING BTREE,
  INDEX `clinic_id`(`clinic_id`) USING BTREE,
  CONSTRAINT `tbl__logs_copy_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `tbl_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl__logs_copy_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl__logs_copy_ibfk_3` FOREIGN KEY (`gender`) REFERENCES `tbl_gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl__logs_copy_ibfk_4` FOREIGN KEY (`marital`) REFERENCES `tbl_marital_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl__logs_copy_ibfk_5` FOREIGN KEY (`mfl_code`) REFERENCES `tbl_master_facility` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl__logs_copy_ibfk_6` FOREIGN KEY (`clinic_id`) REFERENCES `tbl_clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Client detials table' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_access_level
-- ----------------------------
DROP TABLE IF EXISTS `tbl_access_level`;
CREATE TABLE `tbl_access_level`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'primary key column',
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'source of data during migration : ushauri or t4a',
  `ushauri_id` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Access level table' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_appointment
-- ----------------------------
DROP TABLE IF EXISTS `tbl_appointment`;
CREATE TABLE `tbl_appointment`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'primary column for table appointment',
  `client_id` int(0) NULL DEFAULT NULL COMMENT 'Foreign key to table client',
  `appntmnt_date` date NULL DEFAULT NULL,
  `appntmnt_status` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `app_type_1` int(0) NULL DEFAULT 6 COMMENT 'Foreign key to table appointment types',
  `app_type_2` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `expln_app` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `custom_txt` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `app_status` enum('Booked','Notified','Missed','Defaulted','LTFU') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Booked',
  `sent_flag` enum('1','0') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `group_id` int(0) NULL DEFAULT NULL,
  `message_type_id` int(0) NULL DEFAULT NULL,
  `language_id` int(0) NULL DEFAULT NULL,
  `app_msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `notified` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sent_status` enum('Booked Sent','Notified Sent','Missed Sent','Default Sent','Not Sent','LTFU Sent','Sent','Missed Updated') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `entry_point` enum('Mobile','Web') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `appointment_kept` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `active_app` enum('1','0') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1',
  `reason` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `no_calls` int(0) NULL DEFAULT 0,
  `no_msgs` int(0) NULL DEFAULT 0,
  `home_visits` int(0) NULL DEFAULT 0,
  `fnl_trcing_outocme` int(0) NULL DEFAULT NULL,
  `fnl_outcome_dte` datetime(0) NULL DEFAULT NULL,
  `other_trcing_outcome` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `visit_type` enum('Scheduled','Un-Scheduled','Re-Scheduled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `unscheduled_date` date NULL DEFAULT NULL,
  `tracer_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_attended` date NULL DEFAULT NULL,
  `ENTITY_NUMBER` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ENTITY` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `APPOINTMENT_REASON` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `APPOINTMENT_LOCATION` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fnl_trcing_outcome` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Data source  from Ushauri or T4A',
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `t4a_id` int(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tbl_appointment_UN`(`client_id`, `appntmnt_date`, `app_type_1`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE,
  INDEX `message_type_id`(`message_type_id`) USING BTREE,
  INDEX `language_id`(`language_id`) USING BTREE,
  INDEX `client_id`(`client_id`) USING BTREE,
  INDEX `active_app`(`active_app`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE,
  INDEX `app_type_1`(`app_type_1`) USING BTREE,
  INDEX `created_at`(`created_at`) USING BTREE,
  CONSTRAINT `tbl_appointment_ibfk_2` FOREIGN KEY (`app_type_1`) REFERENCES `tbl_appointment_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_appointment_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 201 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_appointment_copy1
-- ----------------------------
DROP TABLE IF EXISTS `tbl_appointment_copy1`;
CREATE TABLE `tbl_appointment_copy1`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'primary column for table appointment',
  `client_id` int(0) NULL DEFAULT NULL COMMENT 'Foreign key to table client',
  `appntmnt_date` date NULL DEFAULT NULL,
  `appntmnt_status` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `app_type_1` int(0) NULL DEFAULT 6 COMMENT 'Foreign key to table appointment types',
  `app_type_2` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `expln_app` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `custom_txt` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `app_status` enum('Booked','Notified','Missed','Defaulted','LTFU') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Booked',
  `sent_flag` enum('1','0') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `group_id` int(0) NULL DEFAULT NULL,
  `message_type_id` int(0) NULL DEFAULT NULL,
  `language_id` int(0) NULL DEFAULT NULL,
  `app_msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `notified` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sent_status` enum('Booked Sent','Notified Sent','Missed Sent','Default Sent','Not Sent','LTFU Sent','Sent','Missed Updated') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `entry_point` enum('Mobile','Web') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `appointment_kept` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `active_app` enum('1','0') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1',
  `reason` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `no_calls` int(0) NULL DEFAULT 0,
  `no_msgs` int(0) NULL DEFAULT 0,
  `home_visits` int(0) NULL DEFAULT 0,
  `fnl_trcing_outocme` int(0) NULL DEFAULT NULL,
  `fnl_outcome_dte` datetime(0) NULL DEFAULT NULL,
  `other_trcing_outcome` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `visit_type` enum('Scheduled','Un-Scheduled','Re-Scheduled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `unscheduled_date` date NULL DEFAULT NULL,
  `tracer_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_attended` date NULL DEFAULT NULL,
  `ENTITY_NUMBER` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ENTITY` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `APPOINTMENT_REASON` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `APPOINTMENT_LOCATION` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fnl_trcing_outcome` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Data source  from Ushauri or T4A',
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `t4a_id` int(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tbl_appointment_UN`(`client_id`, `appntmnt_date`, `app_type_1`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE,
  INDEX `message_type_id`(`message_type_id`) USING BTREE,
  INDEX `language_id`(`language_id`) USING BTREE,
  INDEX `client_id`(`client_id`) USING BTREE,
  INDEX `active_app`(`active_app`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE,
  INDEX `app_type_1`(`app_type_1`) USING BTREE,
  INDEX `created_at`(`created_at`) USING BTREE,
  CONSTRAINT `tbl_appointment_copy1_ibfk_1` FOREIGN KEY (`app_type_1`) REFERENCES `tbl_appointment_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_appointment_copy1_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_appointment_msgs
-- ----------------------------
DROP TABLE IF EXISTS `tbl_appointment_msgs`;
CREATE TABLE `tbl_appointment_msgs`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'Primary key ',
  `msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `appointment_id` int(0) NULL DEFAULT NULL,
  `client_id` int(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_appointment_types
-- ----------------------------
DROP TABLE IF EXISTS `tbl_appointment_types`;
CREATE TABLE `tbl_appointment_types`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'primary key for table appointment types',
  `name` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Data source for the  Ushauri or T4A',
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_broadcast
-- ----------------------------
DROP TABLE IF EXISTS `tbl_broadcast`;
CREATE TABLE `tbl_broadcast`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'Primiary key',
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `is_approved` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `mfl_code` int(0) NULL DEFAULT NULL,
  `partner_id` int(0) NULL DEFAULT NULL,
  `message` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `broadcast_date` date NULL DEFAULT NULL,
  `county_id` int(0) NULL DEFAULT NULL,
  `sub_county_id` int(0) NULL DEFAULT NULL,
  `reason` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `target_group` int(0) NULL DEFAULT NULL,
  `group_id` int(0) NULL DEFAULT NULL,
  `time_id` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Database source ushauri or t4a',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `MFL Code`(`mfl_code`) USING BTREE,
  INDEX `Partner ID`(`partner_id`) USING BTREE,
  INDEX `County ID`(`county_id`) USING BTREE,
  INDEX `Sub County ID`(`sub_county_id`) USING BTREE,
  INDEX `Group ID`(`group_id`) USING BTREE,
  INDEX `Time ID`(`time_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Main broadcast table ' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_caregiver_not_on_care
-- ----------------------------
DROP TABLE IF EXISTS `tbl_caregiver_not_on_care`;
CREATE TABLE `tbl_caregiver_not_on_care`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'care giver not on care for HEIs',
  `care_giver_fname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `care_giver_mname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `care_giver_lname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `care_giver_gender` int(0) NULL DEFAULT NULL,
  `care_giver_phone_number` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hei_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `care_giver_gender`(`care_giver_gender`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE,
  INDEX `hei_no`(`hei_no`) USING BTREE,
  CONSTRAINT `tbl_caregiver_not_on_care_ibfk_1` FOREIGN KEY (`care_giver_gender`) REFERENCES `tbl_gender` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_caregiver_not_on_care_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_caregiver_not_on_care_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_client
-- ----------------------------
DROP TABLE IF EXISTS `tbl_client`;
CREATE TABLE `tbl_client`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'Primary key ',
  `group_id` int(0) NULL DEFAULT NULL COMMENT 'Foreign key to table group',
  `language_id` int(0) NULL DEFAULT 1 COMMENT 'Foreign key to table language',
  `facility_id` int(0) NULL DEFAULT NULL,
  `clinic_number` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'used to form the  compound key for each client',
  `db_source` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `f_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `m_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `l_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_status` enum('ART','On Care','Pre-ART','No Condition') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'ART',
  `txt_frequency` int(0) NULL DEFAULT 168 COMMENT 'how frequenct should we check up on our client by default it\'s 168 ( whic is 1 week) ',
  `txt_time` int(0) NULL DEFAULT NULL COMMENT 'foreign key to table time',
  `phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'phone used to text the client',
  `alt_phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shared_no_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smsenable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'conent field for either client has accepted to receive messages ',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `status` enum('Active','Dead','Disabled','Deceased','Self Transfer','Transfer Out','LTFU') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `partner_id` int(0) NULL DEFAULT NULL,
  `mfl_code` int(0) NULL DEFAULT NULL COMMENT 'foreign key to the master facility table ',
  `gender` int(0) NULL DEFAULT NULL,
  `marital` int(0) NULL DEFAULT NULL,
  `enrollment_date` datetime(0) NULL DEFAULT NULL,
  `art_date` datetime(0) NULL DEFAULT NULL,
  `wellness_enable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `motivational_enable` enum('Yes','No','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_type` enum('New','Transfer','Self Transfer','Transfer In','Transfer Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `age_group` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `birth_date` date NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `prev_clinic` int(0) NULL DEFAULT NULL,
  `transfer_date` date NULL DEFAULT NULL,
  `entry_point` enum('Web','Mobile','EMR','ADT','IL','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `welcome_sent` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `stable` enum('Yes','No','Stable','Un Stable') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Yes',
  `physical_address` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `consent_date` date NULL DEFAULT NULL,
  `GODS_NUMBER` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `DEATH_DATE` date NULL DEFAULT NULL,
  `PATIENT_SOURCE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SENDING_APPLICATION` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clnd_dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clinic_id` int(0) NULL DEFAULT 1 COMMENT 'foreign key for table clinic',
  `national_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `buddy_phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_deceased` date NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `unit_id` int(0) NULL DEFAULT NULL,
  `hei_no` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rank_id` int(0) NULL DEFAULT NULL COMMENT 'foreign key for table rank',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `clinic_number`(`clinic_number`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE,
  INDEX `language_id`(`language_id`) USING BTREE,
  INDEX `gender`(`gender`) USING BTREE,
  INDEX `marital`(`marital`) USING BTREE,
  INDEX `date_added`(`created_at`) USING BTREE,
  INDEX `mfl_code`(`mfl_code`) USING BTREE,
  INDEX `clinic_id`(`clinic_id`) USING BTREE,
  INDEX `tbl_client_partner`(`partner_id`) USING BTREE,
  INDEX `created_at`(`created_at`) USING BTREE,
  INDEX `hei_no`(`hei_no`) USING BTREE,
  INDEX `unit_id`(`unit_id`) USING BTREE,
  INDEX `rank_id`(`rank_id`) USING BTREE,
  CONSTRAINT `tbl_client_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `tbl_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_ibfk_3` FOREIGN KEY (`gender`) REFERENCES `tbl_gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_ibfk_4` FOREIGN KEY (`marital`) REFERENCES `tbl_marital_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_ibfk_5` FOREIGN KEY (`mfl_code`) REFERENCES `tbl_master_facility` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_ibfk_6` FOREIGN KEY (`clinic_id`) REFERENCES `tbl_clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_ibfk_7` FOREIGN KEY (`hei_no`) REFERENCES `tbl_pmtct` (`hei_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_ibfk_8` FOREIGN KEY (`unit_id`) REFERENCES `tbl_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_partner` FOREIGN KEY (`partner_id`) REFERENCES `tbl_partner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 252300 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Client detials table' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_client_backup
-- ----------------------------
DROP TABLE IF EXISTS `tbl_client_backup`;
CREATE TABLE `tbl_client_backup`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'Primary key ',
  `group_id` int(0) NULL DEFAULT NULL COMMENT 'Foreign key to table group',
  `language_id` int(0) NULL DEFAULT 1 COMMENT 'Foreign key to table language',
  `facility_id` int(0) NULL DEFAULT NULL,
  `clinic_number` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'used to form the  compound key for each client',
  `db_source` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `f_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `m_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `l_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_status` enum('ART','On Care','Pre-ART','No Condition') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'ART',
  `txt_frequency` int(0) NULL DEFAULT 168 COMMENT 'how frequenct should we check up on our client by default it\'s 168 ( whic is 1 week) ',
  `txt_time` int(0) NULL DEFAULT NULL COMMENT 'foreign key to table time',
  `phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'phone used to text the client',
  `alt_phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shared_no_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smsenable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'conent field for either client has accepted to receive messages ',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `status` enum('Active','Dead','Disabled','Deceased','Self Transfer','Transfer Out','LTFU') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `partner_id` int(0) NULL DEFAULT NULL,
  `mfl_code` int(0) NULL DEFAULT NULL COMMENT 'foreign key to the master facility table ',
  `gender` int(0) NULL DEFAULT NULL,
  `marital` int(0) NULL DEFAULT NULL,
  `enrollment_date` datetime(0) NULL DEFAULT NULL,
  `art_date` datetime(0) NULL DEFAULT NULL,
  `wellness_enable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `motivational_enable` enum('Yes','No','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_type` enum('New','Transfer','Self Transfer','Transfer In','Transfer Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `age_group` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `birth_date` date NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `prev_clinic` int(0) NULL DEFAULT NULL,
  `transfer_date` date NULL DEFAULT NULL,
  `entry_point` enum('Web','Mobile','EMR','ADT','IL','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `welcome_sent` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `stable` enum('Yes','No','Stable','Un Stable') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Yes',
  `physical_address` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `consent_date` date NULL DEFAULT NULL,
  `GODS_NUMBER` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `DEATH_DATE` date NULL DEFAULT NULL,
  `PATIENT_SOURCE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SENDING_APPLICATION` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clnd_dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clinic_id` int(0) NULL DEFAULT 1 COMMENT 'foreign key for table clinic',
  `national_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `buddy_phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_deceased` date NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `locator_county` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_sub_county` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_ward` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_village` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_location` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hei_no` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gender_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `group_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `marital_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `clinic_number`(`clinic_number`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE,
  INDEX `language_id`(`language_id`) USING BTREE,
  INDEX `gender`(`gender`) USING BTREE,
  INDEX `marital`(`marital`) USING BTREE,
  INDEX `date_added`(`created_at`) USING BTREE,
  INDEX `mfl_code`(`mfl_code`) USING BTREE,
  INDEX `clinic_id`(`clinic_id`) USING BTREE,
  INDEX `tbl_client_partner`(`partner_id`) USING BTREE,
  INDEX `created_at`(`created_at`) USING BTREE,
  INDEX `hei_no`(`hei_no`) USING BTREE,
  CONSTRAINT `tbl_client_backup_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `tbl_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_backup_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_backup_ibfk_3` FOREIGN KEY (`gender`) REFERENCES `tbl_gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_backup_ibfk_4` FOREIGN KEY (`marital`) REFERENCES `tbl_marital_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_backup_ibfk_5` FOREIGN KEY (`mfl_code`) REFERENCES `tbl_master_facility` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_backup_ibfk_6` FOREIGN KEY (`clinic_id`) REFERENCES `tbl_clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_backup_ibfk_7` FOREIGN KEY (`hei_no`) REFERENCES `tbl_pmtct` (`hei_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_backup_ibfk_8` FOREIGN KEY (`partner_id`) REFERENCES `tbl_partner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Client detials table' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_client_copy
-- ----------------------------
DROP TABLE IF EXISTS `tbl_client_copy`;
CREATE TABLE `tbl_client_copy`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'Primary key ',
  `group_id` int(0) NULL DEFAULT NULL COMMENT 'Foreign key to table group',
  `language_id` int(0) NULL DEFAULT 1 COMMENT 'Foreign key to table language',
  `facility_id` int(0) NULL DEFAULT NULL,
  `clinic_number` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'used to form the  compound key for each client',
  `db_source` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `f_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `m_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `l_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_status` enum('ART','On Care','Pre-ART','No Condition') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'ART',
  `txt_frequency` int(0) NULL DEFAULT 168 COMMENT 'how frequenct should we check up on our client by default it\'s 168 ( whic is 1 week) ',
  `txt_time` int(0) NULL DEFAULT NULL COMMENT 'foreign key to table time',
  `phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'phone used to text the client',
  `alt_phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shared_no_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smsenable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'conent field for either client has accepted to receive messages ',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `status` enum('Active','Dead','Disabled','Deceased','Self Transfer','Transfer Out','LTFU') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `partner_id` int(0) NULL DEFAULT NULL,
  `mfl_code` int(0) NULL DEFAULT NULL COMMENT 'foreign key to the master facility table ',
  `gender` int(0) NULL DEFAULT NULL,
  `marital` int(0) NULL DEFAULT NULL,
  `enrollment_date` datetime(0) NULL DEFAULT NULL,
  `art_date` datetime(0) NULL DEFAULT NULL,
  `wellness_enable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `motivational_enable` enum('Yes','No','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_type` enum('New','Transfer','Self Transfer','Transfer In','Transfer Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `age_group` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `birth_date` date NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `prev_clinic` int(0) NULL DEFAULT NULL,
  `transfer_date` date NULL DEFAULT NULL,
  `entry_point` enum('Web','Mobile','EMR','ADT','IL','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `welcome_sent` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `stable` enum('Yes','No','Stable','Un Stable') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Yes',
  `physical_address` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `consent_date` date NULL DEFAULT NULL,
  `GODS_NUMBER` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `DEATH_DATE` date NULL DEFAULT NULL,
  `PATIENT_SOURCE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SENDING_APPLICATION` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clnd_dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clinic_id` int(0) NULL DEFAULT 1 COMMENT 'foreign key for table clinic',
  `national_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `buddy_phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_deceased` date NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `locator_county` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_sub_county` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_ward` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_village` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_location` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hei_no` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `clinic_number`(`clinic_number`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE,
  INDEX `language_id`(`language_id`) USING BTREE,
  INDEX `gender`(`gender`) USING BTREE,
  INDEX `marital`(`marital`) USING BTREE,
  INDEX `date_added`(`created_at`) USING BTREE,
  INDEX `mfl_code`(`mfl_code`) USING BTREE,
  INDEX `clinic_id`(`clinic_id`) USING BTREE,
  INDEX `tbl_client_partner`(`partner_id`) USING BTREE,
  INDEX `created_at`(`created_at`) USING BTREE,
  INDEX `hei_no`(`hei_no`) USING BTREE,
  CONSTRAINT `tbl_client_c_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `tbl_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_c_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_c_ibfk_3` FOREIGN KEY (`gender`) REFERENCES `tbl_gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_c_ibfk_4` FOREIGN KEY (`marital`) REFERENCES `tbl_marital_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_c_ibfk_5` FOREIGN KEY (`mfl_code`) REFERENCES `tbl_master_facility` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_c_ibfk_6` FOREIGN KEY (`clinic_id`) REFERENCES `tbl_clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_c_ibfk_7` FOREIGN KEY (`hei_no`) REFERENCES `tbl_pmtct` (`hei_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_c_partner` FOREIGN KEY (`partner_id`) REFERENCES `tbl_partner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Client detials table' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_client_copy1
-- ----------------------------
DROP TABLE IF EXISTS `tbl_client_copy1`;
CREATE TABLE `tbl_client_copy1`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'Primary key ',
  `group_id` int(0) NULL DEFAULT NULL COMMENT 'Foreign key to table group',
  `language_id` int(0) NULL DEFAULT 1 COMMENT 'Foreign key to table language',
  `facility_id` int(0) NULL DEFAULT NULL,
  `clinic_number` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'used to form the  compound key for each client',
  `db_source` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `f_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `m_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `l_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_status` enum('ART','On Care','Pre-ART','No Condition') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'ART',
  `txt_frequency` int(0) NULL DEFAULT 168 COMMENT 'how frequenct should we check up on our client by default it\'s 168 ( whic is 1 week) ',
  `txt_time` int(0) NULL DEFAULT NULL COMMENT 'foreign key to table time',
  `phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'phone used to text the client',
  `alt_phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shared_no_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smsenable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'conent field for either client has accepted to receive messages ',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `status` enum('Active','Dead','Disabled','Deceased','Self Transfer','Transfer Out','LTFU') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `partner_id` int(0) NULL DEFAULT NULL,
  `mfl_code` int(0) NULL DEFAULT NULL COMMENT 'foreign key to the master facility table ',
  `gender` int(0) NULL DEFAULT NULL,
  `marital` int(0) NULL DEFAULT NULL,
  `enrollment_date` datetime(0) NULL DEFAULT NULL,
  `art_date` datetime(0) NULL DEFAULT NULL,
  `wellness_enable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `motivational_enable` enum('Yes','No','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_type` enum('New','Transfer','Self Transfer','Transfer In','Transfer Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `age_group` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `birth_date` date NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `prev_clinic` int(0) NULL DEFAULT NULL,
  `transfer_date` date NULL DEFAULT NULL,
  `entry_point` enum('Web','Mobile','EMR','ADT','IL','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `welcome_sent` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `stable` enum('Yes','No','Stable','Un Stable') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Yes',
  `physical_address` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `consent_date` date NULL DEFAULT NULL,
  `GODS_NUMBER` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `DEATH_DATE` date NULL DEFAULT NULL,
  `PATIENT_SOURCE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SENDING_APPLICATION` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clnd_dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clinic_id` int(0) NULL DEFAULT 1 COMMENT 'foreign key for table clinic',
  `national_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `buddy_phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_deceased` date NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `locator_county` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_sub_county` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_ward` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_village` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_location` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hei_no` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `clinic_number`(`clinic_number`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE,
  INDEX `language_id`(`language_id`) USING BTREE,
  INDEX `gender`(`gender`) USING BTREE,
  INDEX `marital`(`marital`) USING BTREE,
  INDEX `date_added`(`created_at`) USING BTREE,
  INDEX `mfl_code`(`mfl_code`) USING BTREE,
  INDEX `clinic_id`(`clinic_id`) USING BTREE,
  INDEX `tbl_client_partner`(`partner_id`) USING BTREE,
  INDEX `created_at`(`created_at`) USING BTREE,
  INDEX `hei_no`(`hei_no`) USING BTREE,
  CONSTRAINT `tbl_client_copy1_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `tbl_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_copy1_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_copy1_ibfk_3` FOREIGN KEY (`gender`) REFERENCES `tbl_gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_copy1_ibfk_4` FOREIGN KEY (`marital`) REFERENCES `tbl_marital_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_copy1_ibfk_5` FOREIGN KEY (`mfl_code`) REFERENCES `tbl_master_facility` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_copy1_ibfk_6` FOREIGN KEY (`clinic_id`) REFERENCES `tbl_clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_copy1_ibfk_7` FOREIGN KEY (`hei_no`) REFERENCES `tbl_pmtct` (`hei_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_copy1_ibfk_8` FOREIGN KEY (`partner_id`) REFERENCES `tbl_partner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Client detials table' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_client_list_new
-- ----------------------------
DROP TABLE IF EXISTS `tbl_client_list_new`;
CREATE TABLE `tbl_client_list_new`  (
  `client_name` varchar(62) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `group_name` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `f_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `m_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `l_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `group_id` int(0) NOT NULL DEFAULT 0,
  `gender_id` int(0) NOT NULL DEFAULT 0,
  `gender_name` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `language_name` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `partner_id` int(0) NULL DEFAULT NULL,
  `language_id` int(0) NOT NULL DEFAULT 0,
  `marital_status` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `marital_id` int(0) NOT NULL DEFAULT 0,
  `dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Dead','Disabled','Deceased','Self Transfer','Transfer Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'phone used to text the client',
  `mfl_code` int(0) NULL DEFAULT NULL COMMENT 'foreign key to the master facility table ',
  `clinic_number` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'used to form the  compound key for each client',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `enrollment_date` datetime(0) NULL DEFAULT NULL,
  `art_date` datetime(0) NULL DEFAULT NULL,
  `client_id` int(0) NOT NULL DEFAULT 0 COMMENT 'Primary key ',
  `client_status` enum('ART','On Care','Pre-ART','No Condition') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'ART',
  `txt_frequency` int(0) NULL DEFAULT NULL COMMENT 'how frequenct should we check up on our client by default it\'s 168 ( whic is 1 week) ',
  `txt_time` int(0) NULL DEFAULT NULL COMMENT 'foreign key to table time',
  `alt_phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shared_no_name` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smsenable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'conent field for either client has accepted to receive messages ',
  INDEX `group`(`group_id`) USING BTREE,
  INDEX `gender`(`gender_id`) USING BTREE,
  INDEX `language`(`language_id`) USING BTREE,
  INDEX `mariage`(`marital_id`) USING BTREE,
  CONSTRAINT `gender` FOREIGN KEY (`gender_id`) REFERENCES `tbl_gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group` FOREIGN KEY (`group_id`) REFERENCES `tbl_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `language` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mariage` FOREIGN KEY (`marital_id`) REFERENCES `tbl_marital_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_client_restore
-- ----------------------------
DROP TABLE IF EXISTS `tbl_client_restore`;
CREATE TABLE `tbl_client_restore`  (
  `id` int(0) NOT NULL DEFAULT 0 COMMENT 'Primary key ',
  `group_id` int(0) NULL DEFAULT NULL COMMENT 'Foreign key to table group',
  `language_id` int(0) NULL DEFAULT 1 COMMENT 'Foreign key to table language',
  `facility_id` int(0) NULL DEFAULT NULL,
  `clinic_number` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'used to form the  compound key for each client',
  `db_source` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `f_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `m_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `l_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_status` enum('ART','On Care','Pre-ART','No Condition') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'ART',
  `txt_frequency` int(0) NULL DEFAULT 168 COMMENT 'how frequenct should we check up on our client by default it\'s 168 ( whic is 1 week) ',
  `txt_time` int(0) NULL DEFAULT NULL COMMENT 'foreign key to table time',
  `phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'phone used to text the client',
  `alt_phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shared_no_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smsenable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'conent field for either client has accepted to receive messages ',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `status` enum('Active','Dead','Disabled','Deceased','Self Transfer','Transfer Out','LTFU') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `partner_id` int(0) NULL DEFAULT NULL,
  `mfl_code` int(0) NULL DEFAULT NULL COMMENT 'foreign key to the master facility table ',
  `gender` int(0) NULL DEFAULT NULL,
  `marital` int(0) NULL DEFAULT NULL,
  `enrollment_date` datetime(0) NULL DEFAULT NULL,
  `art_date` datetime(0) NULL DEFAULT NULL,
  `wellness_enable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `motivational_enable` enum('Yes','No','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_type` enum('New','Transfer','Self Transfer','Transfer In','Transfer Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `age_group` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `birth_date` date NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `prev_clinic` int(0) NULL DEFAULT NULL,
  `transfer_date` date NULL DEFAULT NULL,
  `entry_point` enum('Web','Mobile','EMR','ADT','IL','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `welcome_sent` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `stable` enum('Yes','No','Stable','Un Stable') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Yes',
  `physical_address` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `consent_date` date NULL DEFAULT NULL,
  `GODS_NUMBER` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `DEATH_DATE` date NULL DEFAULT NULL,
  `PATIENT_SOURCE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SENDING_APPLICATION` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clnd_dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clinic_id` int(0) NULL DEFAULT 1 COMMENT 'foreign key for table clinic',
  `national_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `buddy_phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_deceased` date NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `locator_county` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_sub_county` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_ward` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_village` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `locator_location` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hei_no` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_client_type
-- ----------------------------
DROP TABLE IF EXISTS `tbl_client_type`;
CREATE TABLE `tbl_client_type`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE,
  CONSTRAINT `tbl_client_type_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_client_type_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Client Type table' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_clinic
-- ----------------------------
DROP TABLE IF EXISTS `tbl_clinic`;
CREATE TABLE `tbl_clinic`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `status` enum('Active','In Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_clnt_outcome
-- ----------------------------
DROP TABLE IF EXISTS `tbl_clnt_outcome`;
CREATE TABLE `tbl_clnt_outcome`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `client_id` int(0) NULL DEFAULT NULL,
  `appointment_id` int(0) NULL DEFAULT NULL,
  `outcome` int(0) NULL DEFAULT NULL,
  `tracer_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `tracing_type` int(0) UNSIGNED NULL DEFAULT NULL,
  `tracing_date` date NULL DEFAULT NULL,
  `app_status` enum('Missed','Defaulted','LTFU','Notified') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fnl_outcome` int(0) NULL DEFAULT NULL,
  `return_date` datetime(0) NULL DEFAULT NULL,
  `tracing_cost` double(11, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `outcome`(`outcome`) USING BTREE,
  INDEX `tracing_type`(`tracing_type`) USING BTREE,
  INDEX `client_id`(`client_id`) USING BTREE,
  INDEX `appointment_id`(`appointment_id`) USING BTREE,
  CONSTRAINT `appointment` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `client` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_clnt_outcome_ibfk_1` FOREIGN KEY (`outcome`) REFERENCES `tbl_outcome` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_clnt_outgoing
-- ----------------------------
DROP TABLE IF EXISTS `tbl_clnt_outgoing`;
CREATE TABLE `tbl_clnt_outgoing`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `destination` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `source` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `msg` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `status` enum('Sent','Not Sent') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `responded` enum('Yes','No','Other') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `message_type_id` int(0) NULL DEFAULT NULL,
  `content_id` int(0) NULL DEFAULT NULL,
  `recepient_type` enum('Client','User') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `is_deleted` enum('1','0') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `clnt_usr_id` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `messageId` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `message_type_id`(`message_type_id`) USING BTREE,
  INDEX `content_id`(`content_id`) USING BTREE,
  INDEX `recepient_type`(`recepient_type`) USING BTREE,
  INDEX `status`(`status`) USING BTREE,
  INDEX `time_stamp`(`updated_at`) USING BTREE,
  INDEX `msg`(`msg`) USING BTREE,
  INDEX `destination`(`destination`) USING BTREE,
  INDEX `source`(`source`) USING BTREE,
  INDEX `clnt_usr_id`(`clnt_usr_id`) USING BTREE,
  INDEX `date_added`(`created_at`) USING BTREE,
  CONSTRAINT `tbl_clnt_outgoing_ibfk_2` FOREIGN KEY (`message_type_id`) REFERENCES `tbl_message_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_clnt_ushauri
-- ----------------------------
DROP TABLE IF EXISTS `tbl_clnt_ushauri`;
CREATE TABLE `tbl_clnt_ushauri`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `client_id` int(0) NULL DEFAULT NULL,
  `message_id` int(0) NULL DEFAULT NULL,
  `week` int(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `day_week` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `year` year NULL DEFAULT NULL,
  `logic_flow_id` int(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `Client ID`(`client_id`) USING BTREE,
  INDEX `Message ID`(`message_id`) USING BTREE,
  INDEX `Logic Flow ID`(`logic_flow_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_community_model
-- ----------------------------
DROP TABLE IF EXISTS `tbl_community_model`;
CREATE TABLE `tbl_community_model`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_condition
-- ----------------------------
DROP TABLE IF EXISTS `tbl_condition`;
CREATE TABLE `tbl_condition`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_consituency
-- ----------------------------
DROP TABLE IF EXISTS `tbl_consituency`;
CREATE TABLE `tbl_consituency`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_content
-- ----------------------------
DROP TABLE IF EXISTS `tbl_content`;
CREATE TABLE `tbl_content`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `message_type_id` int(0) NULL DEFAULT NULL,
  `language_id` int(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `identifier` int(0) NULL DEFAULT NULL,
  `group_id` int(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `logic_flow` int(0) NOT NULL DEFAULT 0,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gender_id` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `message_type_id`(`message_type_id`) USING BTREE,
  INDEX `language_id`(`language_id`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE,
  INDEX `identifier`(`identifier`) USING BTREE,
  INDEX `gender_id`(`gender_id`) USING BTREE,
  CONSTRAINT `tbl_content_ibfk_1` FOREIGN KEY (`message_type_id`) REFERENCES `tbl_message_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_content_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_content_ibfk_4` FOREIGN KEY (`identifier`) REFERENCES `tbl_notification_flow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_content_ibfk_5` FOREIGN KEY (`group_id`) REFERENCES `tbl_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_content_ibfk_6` FOREIGN KEY (`gender_id`) REFERENCES `tbl_gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_county
-- ----------------------------
DROP TABLE IF EXISTS `tbl_county`;
CREATE TABLE `tbl_county`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `code` int(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `lat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lng` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_dfc_module
-- ----------------------------
DROP TABLE IF EXISTS `tbl_dfc_module`;
CREATE TABLE `tbl_dfc_module`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `client_id` int(0) NOT NULL,
  `duration_less` enum('Well','Advanced') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `duration_more` enum('Stable','Unstable') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stability_status` enum('DCM','NotDCM') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `facility_based` int(0) NULL DEFAULT NULL,
  `community_based` int(0) NULL DEFAULT NULL,
  `refill_date` date NULL DEFAULT NULL,
  `clinical_visit_date` date NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(0) NOT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `appointment_id` int(0) NULL DEFAULT NULL,
  `appointment_id_two` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `client_id`(`client_id`) USING BTREE,
  INDEX `facility_based`(`facility_based`) USING BTREE,
  INDEX `community_based`(`community_based`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE,
  INDEX `appointment_id`(`appointment_id`) USING BTREE,
  INDEX `appointment_id_two`(`appointment_id_two`) USING BTREE,
  CONSTRAINT `tbl_dfc_module_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_dfc_module_ibfk_2` FOREIGN KEY (`facility_based`) REFERENCES `tbl_facility_based` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_dfc_module_ibfk_3` FOREIGN KEY (`community_based`) REFERENCES `tbl_community_model` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_dfc_module_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_dfc_module_ibfk_5` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_dfc_module_ibfk_6` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_dfc_module_ibfk_7` FOREIGN KEY (`appointment_id_two`) REFERENCES `tbl_appointment` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_disabled_clients
-- ----------------------------
DROP TABLE IF EXISTS `tbl_disabled_clients`;
CREATE TABLE `tbl_disabled_clients`  (
  `client_name` varchar(62) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `group_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `f_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `m_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `l_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `group_id` int(0) NOT NULL DEFAULT 0,
  `gender_id` int(0) NOT NULL DEFAULT 0,
  `gender_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `language_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `partner_id` int(0) NULL DEFAULT NULL,
  `language_id` int(0) NOT NULL DEFAULT 0,
  `marital_status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `marital_id` int(0) NOT NULL DEFAULT 0,
  `county_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sub_county` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `facility_name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Dead','Disabled','Deceased','Self Transfer','Transfer Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'phone used to text the client',
  `mfl_code` int(0) NULL DEFAULT NULL COMMENT 'foreign key to the master facility table ',
  `clinic_number` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'used to form the  compound key for each client',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `enrollment_date` datetime(0) NULL DEFAULT NULL,
  `art_date` datetime(0) NULL DEFAULT NULL,
  `client_id` int(0) NOT NULL DEFAULT 0 COMMENT 'Primary key ',
  `client_status` enum('ART','On Care','Pre-ART','No Condition') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `txt_frequency` int(0) NULL DEFAULT NULL COMMENT 'how frequenct should we check up on our client by default it\'s 168 ( whic is 1 week) ',
  `txt_time` int(0) NULL DEFAULT NULL COMMENT 'foreign key to table time',
  `alt_phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shared_no_name` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smsenable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'conent field for either client has accepted to receive messages '
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_donor
-- ----------------------------
DROP TABLE IF EXISTS `tbl_donor`;
CREATE TABLE `tbl_donor`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `e_mail` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `donor_logo` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_email
-- ----------------------------
DROP TABLE IF EXISTS `tbl_email`;
CREATE TABLE `tbl_email`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `from` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `to` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sent` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_email_debugger
-- ----------------------------
DROP TABLE IF EXISTS `tbl_email_debugger`;
CREATE TABLE `tbl_email_debugger`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_entry_point
-- ----------------------------
DROP TABLE IF EXISTS `tbl_entry_point`;
CREATE TABLE `tbl_entry_point`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE,
  CONSTRAINT `tbl_entry_point_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_entry_point_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Entry Point for clients and appointments' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_faces_report
-- ----------------------------
DROP TABLE IF EXISTS `tbl_faces_report`;
CREATE TABLE `tbl_faces_report`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `ccc_number` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `appointment_date` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `appointment_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `appointment_status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tracer_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tracer_date` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `outcomes` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `final_outcome` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `other_outcomes` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mfl_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_facility_based
-- ----------------------------
DROP TABLE IF EXISTS `tbl_facility_based`;
CREATE TABLE `tbl_facility_based`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_final_outcome
-- ----------------------------
DROP TABLE IF EXISTS `tbl_final_outcome`;
CREATE TABLE `tbl_final_outcome`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','In Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_frequency
-- ----------------------------
DROP TABLE IF EXISTS `tbl_frequency`;
CREATE TABLE `tbl_frequency`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_future_appointments_query
-- ----------------------------
DROP TABLE IF EXISTS `tbl_future_appointments_query`;
CREATE TABLE `tbl_future_appointments_query`  (
  `file_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `group_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `group_id` int(0) NOT NULL DEFAULT 0,
  `language_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `app_type_1` int(0) NULL DEFAULT NULL COMMENT 'Foreign key to table appointment types',
  `appointment_types_id` int(0) NOT NULL DEFAULT 0 COMMENT 'primary key for table appointment types',
  `appointment_types` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `language_id` int(0) NOT NULL DEFAULT 0,
  `f_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `m_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `l_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `STATUS` enum('Active','Dead','Disabled','Deceased','Self Transfer','Transfer Out','LTFU') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mfl_code` int(0) NULL DEFAULT NULL COMMENT 'foreign key to the master facility table ',
  `phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'phone used to text the client',
  `clinic_number` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'used to form the  compound key for each client',
  `enrollment_date` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `client_id` int(0) NOT NULL DEFAULT 0 COMMENT 'Primary key ',
  `client_status` enum('ART','On Care','Pre-ART','No Condition') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `txt_frequency` int(0) NULL DEFAULT NULL COMMENT 'how frequenct should we check up on our client by default it\'s 168 ( whic is 1 week) ',
  `txt_time` int(0) NULL DEFAULT NULL COMMENT 'foreign key to table time',
  `alt_phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shared_no_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smsenable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'conent field for either client has accepted to receive messages ',
  `appntmnt_date` date NULL DEFAULT NULL,
  `app_msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_gender
-- ----------------------------
DROP TABLE IF EXISTS `tbl_gender`;
CREATE TABLE `tbl_gender`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_groups
-- ----------------------------
DROP TABLE IF EXISTS `tbl_groups`;
CREATE TABLE `tbl_groups`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `group_type` enum('Primary','Secondary') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Secondary',
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_incoming
-- ----------------------------
DROP TABLE IF EXISTS `tbl_incoming`;
CREATE TABLE `tbl_incoming`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `destination` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `msg` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `senttime` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `receivedtime` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `reference` varbinary(255) NULL DEFAULT NULL,
  `processed` enum('Processed','Not Processed') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Not Processed',
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `linkId` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `msg_id` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `source_2`(`source`, `msg`) USING BTREE,
  INDEX `source`(`source`) USING BTREE,
  INDEX `destination`(`destination`) USING BTREE,
  INDEX `msg`(`msg`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_incoming_arch
-- ----------------------------
DROP TABLE IF EXISTS `tbl_incoming_arch`;
CREATE TABLE `tbl_incoming_arch`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `destination` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_language
-- ----------------------------
DROP TABLE IF EXISTS `tbl_language`;
CREATE TABLE `tbl_language`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_marital_status
-- ----------------------------
DROP TABLE IF EXISTS `tbl_marital_status`;
CREATE TABLE `tbl_marital_status`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `marital` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_master_facility
-- ----------------------------
DROP TABLE IF EXISTS `tbl_master_facility`;
CREATE TABLE `tbl_master_facility`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'Table PK',
  `code` int(0) NULL DEFAULT NULL,
  `name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `reg_number` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keph_level` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `facility_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `owner` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `regulatory_body` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `beds` int(0) NULL DEFAULT NULL,
  `cots` int(0) NULL DEFAULT NULL,
  `unit_id` int(0) NULL DEFAULT NULL,
  `consituency_id` int(0) NULL DEFAULT NULL,
  `Sub_County_ID` int(0) NULL DEFAULT NULL,
  `Ward_id` int(0) NULL DEFAULT NULL,
  `operational_status` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Open_whole_day` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Open_public_holidays` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Open_weekends` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Open_late_night` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Service_names` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Approved` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Public_visible` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Closed` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `assigned` enum('1','0') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `lat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lng` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `code`(`code`) USING BTREE,
  INDEX `facility_type`(`facility_type`) USING BTREE,
  INDEX `Sub_County_ID`(`Sub_County_ID`) USING BTREE,
  INDEX `Ward_id`(`Ward_id`) USING BTREE,
  INDEX `Approved`(`Approved`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE,
  INDEX `assigned`(`assigned`) USING BTREE,
  INDEX `consituency_id`(`consituency_id`) USING BTREE,
  INDEX `unit_id`(`unit_id`) USING BTREE,
  CONSTRAINT `tbl_master_facility_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `tbl_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_master_facility_ibfk_2` FOREIGN KEY (`consituency_id`) REFERENCES `tbl_consituency` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_master_facility_ibfk_3` FOREIGN KEY (`Sub_County_ID`) REFERENCES `tbl_sub_county` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_master_facility_ibfk_4` FOREIGN KEY (`Ward_id`) REFERENCES `tbl_ward` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_message_grouping
-- ----------------------------
DROP TABLE IF EXISTS `tbl_message_grouping`;
CREATE TABLE `tbl_message_grouping`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_message_types
-- ----------------------------
DROP TABLE IF EXISTS `tbl_message_types`;
CREATE TABLE `tbl_message_types`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_messages
-- ----------------------------
DROP TABLE IF EXISTS `tbl_messages`;
CREATE TABLE `tbl_messages`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `target_group` enum('All','Adult','Adolescent','Male','Female') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `message_type_id` int(0) NULL DEFAULT NULL,
  `logic_flow` int(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `language_id` int(0) NULL DEFAULT NULL,
  `message_group_id` int(0) NULL DEFAULT NULL,
  `status` enum('Active','In Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `identifier` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `message_type_id`(`message_type_id`) USING BTREE,
  INDEX `language_id`(`language_id`) USING BTREE,
  INDEX `message_group_id`(`message_group_id`) USING BTREE,
  CONSTRAINT `tbl_messages_ibfk_1` FOREIGN KEY (`message_type_id`) REFERENCES `tbl_message_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_messages_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_messages_ibfk_3` FOREIGN KEY (`message_group_id`) REFERENCES `tbl_message_grouping` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_module
-- ----------------------------
DROP TABLE IF EXISTS `tbl_module`;
CREATE TABLE `tbl_module`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level` int(0) NOT NULL,
  `order` int(0) NULL DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `function` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `span_class` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon_class` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `partner_id` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `level`(`level`) USING BTREE,
  INDEX `order`(`order`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_motivational_enable
-- ----------------------------
DROP TABLE IF EXISTS `tbl_motivational_enable`;
CREATE TABLE `tbl_motivational_enable`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE,
  CONSTRAINT `tbl_motivational_enable_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_motivational_enable_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Motivational enable for enabling motivational messages' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_not_ok
-- ----------------------------
DROP TABLE IF EXISTS `tbl_not_ok`;
CREATE TABLE `tbl_not_ok`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `msg` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `destination` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_id` int(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `response_id` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `response_id`(`response_id`) USING BTREE,
  INDEX `client_id`(`client_id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_notfiable_time
-- ----------------------------
DROP TABLE IF EXISTS `tbl_notfiable_time`;
CREATE TABLE `tbl_notfiable_time`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `time` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_notification_flow
-- ----------------------------
DROP TABLE IF EXISTS `tbl_notification_flow`;
CREATE TABLE `tbl_notification_flow`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `notification_type` enum('Booked','Notified','Missed','Defaulted','Other','LTFU','STOP') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `days` int(0) NULL DEFAULT NULL,
  `based_on` enum('Appointment Date','Booking Date','Treatment','Medication','Motivational','Other') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `partner_id` int(0) NULL DEFAULT NULL,
  `value` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `partner_id`(`partner_id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_ok
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ok`;
CREATE TABLE `tbl_ok`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `msg` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `destination` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_id` int(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `response_id` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `client_id`(`client_id`) USING BTREE,
  CONSTRAINT `tbl_ok_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tbl__logs_copy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_oru
-- ----------------------------
DROP TABLE IF EXISTS `tbl_oru`;
CREATE TABLE `tbl_oru`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `CCC_NUMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OBSERVATION_IDENTIFIER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OBSERVATION_SUB_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CODING_SYSTEM` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `VALUE_TYPE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OBSERVATION_VALUE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `UNITS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OBSERVATION_RESULT_STATUS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OBSERVATION_DATETIME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ABNORMAL_FLAGS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `created_by` int(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `updated_by` int(0) NOT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_other_appointment_types
-- ----------------------------
DROP TABLE IF EXISTS `tbl_other_appointment_types`;
CREATE TABLE `tbl_other_appointment_types`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `appointment_id` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `appointments`(`appointment_id`) USING BTREE,
  CONSTRAINT `appointment_id` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_other_final_outcome
-- ----------------------------
DROP TABLE IF EXISTS `tbl_other_final_outcome`;
CREATE TABLE `tbl_other_final_outcome`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `outcome` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `client_outcome_id` int(0) NULL DEFAULT NULL,
  `appointment_id` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `app`(`appointment_id`) USING BTREE,
  INDEX `cln`(`client_outcome_id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  CONSTRAINT `app` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cln` FOREIGN KEY (`client_outcome_id`) REFERENCES `tbl_clnt_outcome` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_otp
-- ----------------------------
DROP TABLE IF EXISTS `tbl_otp`;
CREATE TABLE `tbl_otp`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `client_ip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `public_ip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `verified` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `user_id` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `tbl_otp_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_outcome
-- ----------------------------
DROP TABLE IF EXISTS `tbl_outcome`;
CREATE TABLE `tbl_outcome`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_outcome_report_raw
-- ----------------------------
DROP TABLE IF EXISTS `tbl_outcome_report_raw`;
CREATE TABLE `tbl_outcome_report_raw`  (
  `Partner` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `County` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `partner_id` int(0) NULL DEFAULT NULL,
  `county_id` int(0) NULL DEFAULT NULL,
  `sub_county_id` int(0) NULL DEFAULT NULL,
  `Sub_County` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mfl_code` int(0) NULL DEFAULT NULL,
  `Facility` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `MFL` int(0) NULL DEFAULT NULL,
  `UPN` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'used to form the  compound key for each client',
  `Client_St` enum('Active','Dead','Disabled','Deceased','Self Transfer','Transfer Out','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Art_Start_Date` datetime(0) NULL DEFAULT NULL,
  `Gender` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Marital_Status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Languages` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Phone_NO` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'phone used to text the client',
  `Consented` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'conent field for either client has accepted to receive messages ',
  `DoB` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Outcome_ID` int(0) NOT NULL DEFAULT 0,
  `Appointment_ID` int(0) NOT NULL DEFAULT 0 COMMENT 'primary column for table appointment',
  `Visit_Type` enum('Scheduled','Un-Scheduled','Re-Scheduled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Unscheduled_Date` date NULL DEFAULT NULL,
  `Date_Came` date NULL DEFAULT NULL,
  `Age` int(0) NULL DEFAULT NULL,
  `Days_Defaulted` int(0) NULL DEFAULT NULL,
  `Appointment_Date` date NULL DEFAULT NULL,
  `Appointment_Types` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Appointment_Status` varchar(9) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Tracer` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Tracing_Date` date NULL DEFAULT NULL,
  `Outcome` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Final_Outcome` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Other_Outcome` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_partner
-- ----------------------------
DROP TABLE IF EXISTS `tbl_partner`;
CREATE TABLE `tbl_partner`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `partner_type_id` int(0) NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `phone_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `location` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `e_mail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `partner_logo` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `donor_id` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `partner_type_id`(`partner_type_id`) USING BTREE,
  INDEX `donor_id`(`donor_id`) USING BTREE,
  CONSTRAINT `tbl_partner_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `tbl_donor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_partner_facility
-- ----------------------------
DROP TABLE IF EXISTS `tbl_partner_facility`;
CREATE TABLE `tbl_partner_facility`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `mfl_code` int(0) NULL DEFAULT 0,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `partner_id` int(0) NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `sub_county_id` int(0) NULL DEFAULT NULL,
  `county_id` int(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `is_approved` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `reason` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `avg_clients` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `master_facility_id` int(0) NULL DEFAULT NULL,
  `unit_id` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `mfl_code`(`mfl_code`) USING BTREE,
  INDEX `partner_id`(`partner_id`) USING BTREE,
  INDEX `sub_county_id`(`sub_county_id`) USING BTREE,
  INDEX `county_id`(`county_id`) USING BTREE,
  INDEX `unit_id`(`unit_id`) USING BTREE,
  CONSTRAINT `tbl_partner_facility_ibfk_2` FOREIGN KEY (`sub_county_id`) REFERENCES `tbl_sub_county` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_partner_facility_ibfk_3` FOREIGN KEY (`county_id`) REFERENCES `tbl_county` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_partner_facility_ibfk_4` FOREIGN KEY (`mfl_code`) REFERENCES `tbl_master_facility` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_partner_facility_ibfk_5` FOREIGN KEY (`unit_id`) REFERENCES `tbl_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tbl_partner_type
-- ----------------------------
DROP TABLE IF EXISTS `tbl_partner_type`;
CREATE TABLE `tbl_partner_type`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_pmtct
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pmtct`;
CREATE TABLE `tbl_pmtct`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `client_id` int(0) NULL DEFAULT NULL,
  `hei_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `type_of_care` enum('Yes','No','Pregnant') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hei_gender` int(0) NULL DEFAULT NULL,
  `hei_dob` date NULL DEFAULT NULL,
  `hei_first_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hei_middle_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hei_last_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pcr_week6` date NULL DEFAULT NULL,
  `pcr_month6` date NULL DEFAULT NULL,
  `pcr_month12` date NULL DEFAULT NULL,
  `appointment_date` date NULL DEFAULT NULL,
  `created_by` int(0) NOT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `appointment_id` int(0) NULL DEFAULT NULL,
  `care_giver_id` int(0) NULL DEFAULT NULL,
  `date_confirmed_positive` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `hei_no`(`hei_no`) USING BTREE,
  INDEX `hei_gender`(`hei_gender`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE,
  INDEX `appointment_id`(`appointment_id`) USING BTREE,
  INDEX `care_giver_id`(`care_giver_id`) USING BTREE,
  INDEX `tbl_pmtct_ibfk_1`(`client_id`) USING BTREE,
  CONSTRAINT `tbl_pmtct_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_pmtct_ibfk_2` FOREIGN KEY (`hei_gender`) REFERENCES `tbl_gender` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_pmtct_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_pmtct_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_pmtct_ibfk_5` FOREIGN KEY (`care_giver_id`) REFERENCES `tbl_caregiver_not_on_care` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_rank
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rank`;
CREATE TABLE `tbl_rank`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `status` enum('Active','Disabled') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_regimen
-- ----------------------------
DROP TABLE IF EXISTS `tbl_regimen`;
CREATE TABLE `tbl_regimen`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_responses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_responses`;
CREATE TABLE `tbl_responses`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `source` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `destination` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `group_id` int(0) NULL DEFAULT NULL,
  `msg_type` int(0) NULL DEFAULT NULL,
  `language_id` int(0) NULL DEFAULT NULL,
  `msg_datetime` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `qstn_id` int(0) NULL DEFAULT NULL,
  `incoming_id` int(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `user_type` enum('Client','User','Other') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Used to identify if responder exists in the system',
  `recognised` enum('UnRecognised','Recognised') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `processed` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `incoming_id`(`incoming_id`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE,
  INDEX `language_id`(`language_id`) USING BTREE,
  INDEX `qstn_id`(`qstn_id`) USING BTREE,
  INDEX `recognised`(`recognised`) USING BTREE,
  CONSTRAINT `tbl_responses_ibfk_1` FOREIGN KEY (`incoming_id`) REFERENCES `tbl_incoming` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_role
-- ----------------------------
DROP TABLE IF EXISTS `tbl_role`;
CREATE TABLE `tbl_role`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `access_level` enum('Donor','Admin','Partner','Facility','County','Sub County') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_role_module
-- ----------------------------
DROP TABLE IF EXISTS `tbl_role_module`;
CREATE TABLE `tbl_role_module`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `role_id` int(0) NULL DEFAULT NULL,
  `module_id` int(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `Role_ID`(`role_id`) USING BTREE,
  INDEX `Module_ID`(`module_id`) USING BTREE,
  INDEX `Created_BY`(`created_by`) USING BTREE,
  INDEX `Updated_BY`(`updated_by`) USING BTREE,
  CONSTRAINT `tbl_role_module_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_secondary_grouping
-- ----------------------------
DROP TABLE IF EXISTS `tbl_secondary_grouping`;
CREATE TABLE `tbl_secondary_grouping`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for tbl_secondary_grouping',
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','In Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_sender
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sender`;
CREATE TABLE `tbl_sender`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `partner_id` int(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_sent_logs
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sent_logs`;
CREATE TABLE `tbl_sent_logs`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `messageId` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `destination` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `groupId` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `groupName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `smsCount` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `message_type_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clnt_usr_id` int(0) NULL DEFAULT NULL,
  `recepient_type` enum('Client','User') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_sent_status
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sent_status`;
CREATE TABLE `tbl_sent_status`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_sessions
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sessions`;
CREATE TABLE `tbl_sessions`  (
  `id` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `timestamp` int(0) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ci_sessions_timestamp`(`timestamp`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_sms_checkin
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sms_checkin`;
CREATE TABLE `tbl_sms_checkin`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `client_id` int(0) NULL DEFAULT NULL,
  `msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `destination` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `response_type` enum('Positive','Negative','Ohter','Other') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `response_id` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `response_id`(`response_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_sms_queue
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sms_queue`;
CREATE TABLE `tbl_sms_queue`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `destination` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sms_datetime` datetime(0) NULL DEFAULT NULL,
  `sms_status` enum('Not Sent','Sent') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `time_id` int(0) NULL DEFAULT NULL,
  `broadcast_date` datetime(0) NULL DEFAULT NULL,
  `broadcast_id` int(0) NULL DEFAULT NULL,
  `clnt_usr_id` int(0) NULL DEFAULT NULL,
  `recepient_type` enum('Client','User') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `mfl_code` int(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `broadcast_id`(`broadcast_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_status
-- ----------------------------
DROP TABLE IF EXISTS `tbl_status`;
CREATE TABLE `tbl_status`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_stop_alerts
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stop_alerts`;
CREATE TABLE `tbl_stop_alerts`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `clnt_usr_id` int(0) NULL DEFAULT NULL,
  `source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `destination` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `recepient_type` enum('Client','User') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `clnt_usr_id`(`clnt_usr_id`) USING BTREE,
  INDEX `recepient_type`(`recepient_type`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_sub_county
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sub_county`;
CREATE TABLE `tbl_sub_county`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `county_id` int(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `county_id`(`county_id`) USING BTREE,
  CONSTRAINT `tbl_sub_county_ibfk_1` FOREIGN KEY (`county_id`) REFERENCES `tbl_county` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_sys_logs
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sys_logs`;
CREATE TABLE `tbl_sys_logs`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `user_id` int(0) NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_target_client
-- ----------------------------
DROP TABLE IF EXISTS `tbl_target_client`;
CREATE TABLE `tbl_target_client`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_target_county
-- ----------------------------
DROP TABLE IF EXISTS `tbl_target_county`;
CREATE TABLE `tbl_target_county`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `status` enum('Active','In Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `county_id` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_target_facility
-- ----------------------------
DROP TABLE IF EXISTS `tbl_target_facility`;
CREATE TABLE `tbl_target_facility`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mfl_code` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_time
-- ----------------------------
DROP TABLE IF EXISTS `tbl_time`;
CREATE TABLE `tbl_time`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_todays_appointment
-- ----------------------------
DROP TABLE IF EXISTS `tbl_todays_appointment`;
CREATE TABLE `tbl_todays_appointment`  (
  `clinic_id` int(0) NULL DEFAULT 1 COMMENT 'foreign key for table clinic',
  `appointment_id` int(0) NOT NULL DEFAULT 0 COMMENT 'primary column for table appointment',
  `clinic_no` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'used to form the  compound key for each client',
  `client_name` varchar(152) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `appointment_kept` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_phone_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'phone used to text the client',
  `appointment_type` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `appntmnt_date` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `file_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `buddy_phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `facility_id` int(0) NULL DEFAULT 0,
  `mfl_code` int(0) NULL DEFAULT NULL COMMENT 'foreign key to the master facility table ',
  `user_phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id` int(0) NOT NULL DEFAULT 0 COMMENT 'Primary key of the table',
  `user_clinic` int(0) NULL DEFAULT 5
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_tracer_client
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tracer_client`;
CREATE TABLE `tbl_tracer_client`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `tracer_id` int(0) NOT NULL,
  `client_id` int(0) NOT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `is_assigned` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `app_id` int(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tbl_tracer_client_ibfk_1`(`tracer_id`) USING BTREE,
  INDEX `tbl_tracer_client_ibfk_2`(`client_id`) USING BTREE,
  INDEX `tbl_tracer_client_ibfk_3`(`created_by`) USING BTREE,
  INDEX `tbl_tracer_client_ibfk_4`(`updated_by`) USING BTREE,
  INDEX `tbl_tracer_client_ibfk_5`(`app_id`) USING BTREE,
  CONSTRAINT `tbl_tracer_client_ibfk_1` FOREIGN KEY (`tracer_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `tbl_tracer_client_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `tbl_tracer_client_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_tracer_client_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_tracer_client_ibfk_5` FOREIGN KEY (`app_id`) REFERENCES `tbl_appointment` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_tracers
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tracers`;
CREATE TABLE `tbl_tracers`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `user_id` int(0) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE,
  CONSTRAINT `tbl_tracers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `tbl_tracers_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_tracers_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_tracing_type
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tracing_type`;
CREATE TABLE `tbl_tracing_type`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_transit_app
-- ----------------------------
DROP TABLE IF EXISTS `tbl_transit_app`;
CREATE TABLE `tbl_transit_app`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ccc_number` decimal(10, 0) NULL DEFAULT NULL,
  `client_id` int(0) NULL DEFAULT NULL,
  `client_id_number` int(0) NULL DEFAULT NULL,
  `appointment_type_id` int(0) NULL DEFAULT NULL,
  `transit_facility` decimal(10, 0) NULL DEFAULT NULL,
  `no_of_drugs` int(0) NULL DEFAULT NULL,
  `drugs_duration` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `processed` enum('No','Yes') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `other` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_trcing_outcome
-- ----------------------------
DROP TABLE IF EXISTS `tbl_trcing_outcome`;
CREATE TABLE `tbl_trcing_outcome`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `value` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_unit
-- ----------------------------
DROP TABLE IF EXISTS `tbl_unit`;
CREATE TABLE `tbl_unit`  (
  `id` int(0) NOT NULL,
  `service_id` int(0) NOT NULL,
  `unit_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `service_id`(`service_id`) USING BTREE,
  CONSTRAINT `tbl_unit_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `tbl_partner` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_unrecognised
-- ----------------------------
DROP TABLE IF EXISTS `tbl_unrecognised`;
CREATE TABLE `tbl_unrecognised`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `msg` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('Active','In Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `destination` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_id` int(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `response_id` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `response_id`(`response_id`) USING BTREE,
  INDEX `client_id`(`client_id`) USING BTREE,
  CONSTRAINT `tbl_unrecognised_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `tbl__logs_copy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_user_permission
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_permission`;
CREATE TABLE `tbl_user_permission`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `user_id` int(0) NOT NULL,
  `module_id` int(0) NOT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `role_id` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `User_ID`(`user_id`) USING BTREE,
  INDEX `Module_ID`(`module_id`) USING BTREE,
  INDEX `Role_ID`(`role_id`) USING BTREE,
  CONSTRAINT `tbl_user_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of the table',
  `f_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `m_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `l_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dob` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone_no` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `e_mail` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `partner_id` int(0) NULL DEFAULT 0,
  `facility_id` int(0) NULL DEFAULT 0,
  `donor_id` int(0) NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `password` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `first_access` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Yes',
  `access_level` enum('Admin','Partner','Facility','Donor','County','Sub County') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sms_enable` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `county_id` int(0) NULL DEFAULT NULL,
  `daily_report` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `weekly_report` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `monthly_report` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `month3_report` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `month6_report` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `Yearly_report` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `last_pass_change` date NULL DEFAULT NULL,
  `view_client` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `subcounty_id` int(0) NULL DEFAULT NULL,
  `rcv_app_list` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `role_id` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clinic_id` int(0) NULL DEFAULT 5,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `email` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `phone_no`(`phone_no`) USING BTREE,
  INDEX `partner_id`(`partner_id`) USING BTREE,
  INDEX `facility_id`(`facility_id`) USING BTREE,
  INDEX `donor_id`(`donor_id`) USING BTREE,
  INDEX `county_id`(`county_id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE,
  CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_usr_outgoing
-- ----------------------------
DROP TABLE IF EXISTS `tbl_usr_outgoing`;
CREATE TABLE `tbl_usr_outgoing`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `destination` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `source` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `msg` varchar(3000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `status` enum('Sent','Not Sent') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `responded` enum('Yes','No','Other') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `message_type_id` int(0) NULL DEFAULT NULL,
  `content_id` int(0) NULL DEFAULT NULL,
  `clnt_usr_id` int(0) NULL DEFAULT NULL,
  `recepient_type` enum('Client','User') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `is_deleted` enum('1','0') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `outgoing_id` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` int(0) NULL DEFAULT NULL,
  `messageId` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `message_type_id`(`message_type_id`) USING BTREE,
  INDEX `content_id`(`content_id`) USING BTREE,
  INDEX `clnt_usr_id`(`clnt_usr_id`) USING BTREE,
  INDEX `recepient_type`(`recepient_type`) USING BTREE,
  INDEX `status`(`status`) USING BTREE,
  INDEX `time_stamp`(`updated_at`) USING BTREE,
  INDEX `msg`(`msg`(767)) USING BTREE,
  INDEX `destination`(`destination`) USING BTREE,
  INDEX `source`(`source`) USING BTREE,
  CONSTRAINT `tbl_usr_outgoing_ibfk_1` FOREIGN KEY (`message_type_id`) REFERENCES `tbl_message_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tbl_ward
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ward`;
CREATE TABLE `tbl_ward`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Active','Disabled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tbl_wellness_enable
-- ----------------------------
DROP TABLE IF EXISTS `tbl_wellness_enable`;
CREATE TABLE `tbl_wellness_enable`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_by` int(0) NULL DEFAULT NULL,
  `ushauri_id` int(0) NULL DEFAULT NULL,
  `db_source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `updated_by`(`updated_by`) USING BTREE,
  CONSTRAINT `tbl_wellness_enable_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_wellness_enable_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Wellnes enable module for sending Wellenss Messages' ROW_FORMAT = COMPACT;

-- ----------------------------
-- View structure for LTFU_Clients
-- ----------------------------
DROP VIEW IF EXISTS `LTFU_Clients`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `LTFU_Clients` AS select 'Total No LTFU ' AS `label`,`tbl_partner`.`name` AS `partner`,`tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) then `tbl_appointment`.`client_id` end)) AS `0-9`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then `tbl_appointment`.`client_id` end)) AS `10-14`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then `tbl_appointment`.`client_id` end)) AS `15-19`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then `tbl_appointment`.`client_id` end)) AS `20-24`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) then `tbl_appointment`.`client_id` end)) AS `25+`,count(distinct `tbl_appointment`.`client_id`) AS `TOTAL`,count(distinct (case when (`tbl_client`.`gender` = '1') then `tbl_client`.`id` end)) AS `Total_Female`,count(distinct (case when (`tbl_client`.`gender` = '2') then `tbl_client`.`id` end)) AS `Total_Male`,count(distinct (case when (`tbl_client`.`gender` = '3') then `tbl_client`.`id` end)) AS `Total_Transgender`,count(distinct (case when (`tbl_client`.`gender` = '5') then `tbl_client`.`id` end)) AS `Total_Not_Provided` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) where (((to_days(`tbl_appointment`.`date_attended`) - to_days(`tbl_appointment`.`appntmnt_date`)) >= 30) and (`tbl_appointment`.`app_status` = 'LTFU')) group by year(`tbl_appointment`.`appntmnt_date`),month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for Not_traced_clients
-- ----------------------------
DROP VIEW IF EXISTS `Not_traced_clients`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `Not_traced_clients` AS select 'Total No not traced  ' AS `label`,`tbl_partner`.`name` AS `partner`,`tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 0) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)),`tbl_appointment`.`id`,0)) AS `0-9`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)),`tbl_appointment`.`id`,0)) AS `10-14`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)),`tbl_appointment`.`id`,0)) AS `15-19`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)),`tbl_appointment`.`id`,0)) AS `20-24`,count(distinct if(((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25),`tbl_appointment`.`id`,0)) AS `25+` from ((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) where ((`tbl_appointment`.`active_app` = '1') and (cast(`tbl_appointment`.`appntmnt_date` as date) < curdate()) and (`tbl_appointment`.`fnl_trcing_outocme` is null) and `tbl_appointment`.`id` in (select `tbl_clnt_outcome`.`appointment_id` from `tbl_clnt_outcome`) is false) group by month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for VW_SCHEDULED_VISITS_ATTENDED
-- ----------------------------
DROP VIEW IF EXISTS `VW_SCHEDULED_VISITS_ATTENDED`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `VW_SCHEDULED_VISITS_ATTENDED` AS select `tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((0 <> 1) and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`appointment_kept` = 'Yes') and (`tbl_appointment`.`active_app` = '0') and (`tbl_appointment`.`appntmnt_date` <= curdate())) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for VW_UNSCHEDULED_REFILLS
-- ----------------------------
DROP VIEW IF EXISTS `VW_UNSCHEDULED_REFILLS`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `VW_UNSCHEDULED_REFILLS` AS select `tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Un-Scheduled') and (`tbl_appointment`.`app_type_1` = 'Re-Fill')) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for all_system_msgs
-- ----------------------------
DROP VIEW IF EXISTS `all_system_msgs`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `all_system_msgs` AS select `tbl_clnt_outgoing`.`id` AS `id`,`tbl_clnt_outgoing`.`message_type_id` AS `message_type_id`,`tbl_clnt_outgoing`.`recepient_type` AS `recepient_type`,`tbl_message_types`.`name` AS `name`,date_format(`tbl_clnt_outgoing`.`created_at`,'%M %Y') AS `month_year`,`tbl_clnt_outgoing`.`created_at` AS `created_at` from (`tbl_clnt_outgoing` join `tbl_message_types` on((`tbl_message_types`.`id` = `tbl_clnt_outgoing`.`message_type_id`))) order by `tbl_clnt_outgoing`.`created_at`;

-- ----------------------------
-- View structure for appointment_counts
-- ----------------------------
DROP VIEW IF EXISTS `appointment_counts`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `appointment_counts` AS select count(distinct `tbl_appointment`.`id`) AS `Total_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`active_app` = '0') and (`tbl_appointment`.`visit_type` = 'Scheduled')) then 1 else 0 end)) AS `Kept_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `Defaulted_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `Missed_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `LTFU_Appointments` from (`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`)));

-- ----------------------------
-- View structure for cdcdata
-- ----------------------------
DROP VIEW IF EXISTS `cdcdata`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `cdcdata` AS select 'No of Clients Booked ' AS `label`,`tbl_partner`.`name` AS `partner`,`tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`created_at`,'%M %Y') AS `month-year`,sum((case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) then 1 else 0 end)) AS `0-9`,sum((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then 1 else 0 end)) AS `10-14`,sum((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then 1 else 0 end)) AS `15-19`,sum((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then 1 else 0 end)) AS `20-24`,sum((case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) then 1 else 0 end)) AS `25+`,count(distinct `tbl_appointment`.`id`) AS `TOTAL`,sum((case when (`tbl_client`.`gender` = 1) then 1 else 0 end)) AS `Total_Female`,sum((case when (`tbl_client`.`gender` = 2) then 1 else 0 end)) AS `Total_Male`,sum((case when (`tbl_client`.`gender` = 3) then 1 else 0 end)) AS `Total_Transgender`,sum((case when (`tbl_client`.`gender` = 4) then 1 else 0 end)) AS `Total_Not_Provided` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) group by month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for cdcdata1
-- ----------------------------
DROP VIEW IF EXISTS `cdcdata1`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `cdcdata1` AS select `tbl_partner`.`name` AS `partner`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`created_at`,'%M %Y') AS `month-year`,sum((case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) then 1 else 0 end)) AS `0-9`,sum((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then 1 else 0 end)) AS `10-14`,sum((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then 1 else 0 end)) AS `15-19`,sum((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then 1 else 0 end)) AS `20-24`,sum((case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) then 1 else 0 end)) AS `25+`,count(distinct `tbl_appointment`.`id`) AS `TOTAL`,sum((case when (`tbl_client`.`gender` = 1) then 1 else 0 end)) AS `Total_Female`,sum((case when (`tbl_client`.`gender` = 2) then 1 else 0 end)) AS `Total_Male`,sum((case when (`tbl_client`.`gender` = 3) then 1 else 0 end)) AS `Total_Transgender`,sum((case when (`tbl_client`.`gender` = 4) then 1 else 0 end)) AS `Total_Not_Provided` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) group by month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for cdcdata2
-- ----------------------------
DROP VIEW IF EXISTS `cdcdata2`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `cdcdata2` AS select `tbl_partner`.`name` AS `partner`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`created_at`,'%M %Y') AS `month-year`,count(distinct `tbl_appointment`.`id`) AS `TOTAL CREATED APPOINTMENTS` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) group by month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for cdcdata3
-- ----------------------------
DROP VIEW IF EXISTS `cdcdata3`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `cdcdata3` AS select `tbl_partner`.`name` AS `partner`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`created_at`,'%M %Y') AS `month-year`,count(distinct `tbl_appointment`.`id`) AS `TOTAL CREATED APPOINTMENTS` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) group by date_format(`tbl_appointment`.`created_at`,'%M %Y'),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for client_appointment_report
-- ----------------------------
DROP VIEW IF EXISTS `client_appointment_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `client_appointment_report` AS select `tbl_appointment`.`id` AS `appointment_id`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_gender`.`name` AS `gender`,`tbl_groups`.`name` AS `group_name`,`tbl_marital_status`.`marital` AS `marital`,`tbl_appointment`.`created_at` AS `created_at`,`tbl_appointment_types`.`name` AS `appointment_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month_year`,(case when ((`tbl_appointment`.`app_status` = 'Booked') or ((`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`appntmnt_date` < curdate()) and (`tbl_appointment`.`appointment_kept` = 'Yes'))) then 'Appointment Kept' when ((`tbl_appointment`.`appointment_kept` = 'No') and (`tbl_appointment`.`active_app` = '0')) then 'Appointment Not Kept' when ((`tbl_appointment`.`appointment_kept` = 'Yes') and (`tbl_appointment`.`active_app` = '0')) then 'Appointment Kept' when ((`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then 'Missed' when ((`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then 'Defaulted' when ((`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then 'LTFU' else 'Appointment Kept' end) AS `appp_status`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner`.`name` AS `partner_name`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id` from ((((((((((((`tbl_client` join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_time` on((`tbl_time`.`id` = `tbl_client`.`txt_time`))) join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) where (`tbl_appointment`.`appntmnt_date` < curdate()) group by `tbl_appointment`.`id` order by `tbl_client`.`created_at`;

-- ----------------------------
-- View structure for client_list
-- ----------------------------
DROP VIEW IF EXISTS `client_list`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `client_list` AS select concat(`tbl_client`.`f_name`,' ',`tbl_client`.`m_name`,' ',`tbl_client`.`l_name`) AS `client_name`,`tbl_client`.`file_no` AS `file_no`,`tbl_groups`.`name` AS `group_name`,`tbl_client`.`f_name` AS `f_name`,`tbl_client`.`m_name` AS `m_name`,`tbl_client`.`l_name` AS `l_name`,`tbl_groups`.`id` AS `group_id`,`tbl_gender`.`id` AS `gender_id`,`tbl_gender`.`name` AS `gender_name`,`tbl_language`.`name` AS `language_name`,`tbl_client`.`partner_id` AS `partner_id`,`tbl_language`.`id` AS `language_id`,`tbl_marital_status`.`marital` AS `marital_status`,`tbl_marital_status`.`id` AS `marital_id`,`tbl_client`.`dob` AS `dob`,`tbl_client`.`status` AS `status`,`tbl_client`.`phone_no` AS `phone_no`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`created_at` AS `created_at`,`tbl_client`.`enrollment_date` AS `enrollment_date`,`tbl_client`.`art_date` AS `art_date`,`tbl_client`.`id` AS `client_id`,`tbl_client`.`client_status` AS `client_status`,`tbl_client`.`txt_frequency` AS `txt_frequency`,`tbl_client`.`txt_time` AS `txt_time`,`tbl_client`.`alt_phone_no` AS `alt_phone_no`,`tbl_client`.`shared_no_name` AS `shared_no_name`,`tbl_client`.`smsenable` AS `smsenable` from ((((`tbl_client` join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) where (`tbl_client`.`status` = 'Active');

-- ----------------------------
-- View structure for client_message_report
-- ----------------------------
DROP VIEW IF EXISTS `client_message_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `client_message_report` AS select `tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_gender`.`name` AS `gender`,`tbl_groups`.`name` AS `group_name`,`tbl_marital_status`.`marital` AS `marital`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner`.`name` AS `partner_name`,`tbl_client`.`created_at` AS `created_at`,date_format(`tbl_client`.`created_at`,'%M %Y') AS `month_year`,`tbl_language`.`name` AS `language`,`tbl_message_types`.`name` AS `message_type`,`tbl_clnt_outgoing`.`msg` AS `msg`,`tbl_client`.`language_id` AS `language_id`,`tbl_client`.`txt_time` AS `preferred_time`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_sub_county`.`id` AS `sub_county_id` from ((((((((((((`tbl_client` join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_time` on((`tbl_time`.`id` = `tbl_client`.`txt_time`))) join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_clnt_outgoing` on((`tbl_clnt_outgoing`.`clnt_usr_id` = `tbl_client`.`id`))) join `tbl_message_types` on((`tbl_message_types`.`id` = `tbl_clnt_outgoing`.`message_type_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) group by `tbl_client`.`id` order by `tbl_client`.`created_at`;

-- ----------------------------
-- View structure for client_report
-- ----------------------------
DROP VIEW IF EXISTS `client_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `client_report` AS select `tbl_client`.`id` AS `id`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_gender`.`name` AS `gender`,`tbl_groups`.`name` AS `group_name`,`tbl_marital_status`.`marital` AS `marital`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner`.`name` AS `partner_name`,`tbl_client`.`db_source` AS `db_source`,`tbl_client`.`created_at` AS `created_at`,date_format(`tbl_client`.`created_at`,'%M %Y') AS `month_year`,`tbl_language`.`name` AS `LANGUAGE`,`tbl_client`.`smsenable` AS `consented`,`tbl_time`.`name` AS `txt_time`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_client`.`status` AS `status` from ((((((((((`tbl_client` join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) left join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) left join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) left join `tbl_time` on((`tbl_time`.`id` = `tbl_client`.`txt_time`))) left join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) group by `tbl_client`.`id` order by `tbl_client`.`created_at`;

-- ----------------------------
-- View structure for client_ushauri_mssges
-- ----------------------------
DROP VIEW IF EXISTS `client_ushauri_mssges`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `client_ushauri_mssges` AS select `tbl_client`.`clinic_number` AS `clinic_number`,`tbl_gender`.`name` AS `gender`,`tbl_marital_status`.`marital` AS `marital`,`tbl_groups`.`name` AS `group_name`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_partner`.`name` AS `partner_name`,`tbl_message_types`.`name` AS `message_type`,count(`tbl_clnt_outgoing`.`msg`) AS `no_of_msgs`,date_format(`tbl_client`.`created_at`,'%M %Y') AS `client_register_month`,date_format(`tbl_clnt_outgoing`.`created_at`,'%M %Y') AS `message_sent_month` from ((((((((((`tbl_clnt_outgoing` join `tbl_client` on((`tbl_client`.`id` = `tbl_clnt_outgoing`.`clnt_usr_id`))) join `tbl_message_types` on((`tbl_message_types`.`id` = `tbl_clnt_outgoing`.`message_type_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) where (`tbl_clnt_outgoing`.`recepient_type` = 'Client') group by `tbl_client`.`id`,`tbl_message_types`.`id`,date_format(`tbl_clnt_outgoing`.`created_at`,'%M %Y') order by `tbl_clnt_outgoing`.`created_at`;

-- ----------------------------
-- View structure for clients_booked
-- ----------------------------
DROP VIEW IF EXISTS `clients_booked`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `clients_booked` AS select 'No of Clients Booked ' AS `label`,`tbl_partner`.`name` AS `partner`,`tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) then `tbl_appointment`.`client_id` end)) AS `0-9`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then `tbl_appointment`.`client_id` end)) AS `10-14`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then `tbl_appointment`.`client_id` end)) AS `15-19`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then `tbl_appointment`.`client_id` end)) AS `20-24`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) then `tbl_appointment`.`client_id` end)) AS `25+`,count(distinct `tbl_appointment`.`client_id`) AS `TOTAL`,count(distinct (case when (`tbl_client`.`gender` = '1') then `tbl_client`.`id` end)) AS `Total_Female`,count(distinct (case when (`tbl_client`.`gender` = '2') then `tbl_client`.`id` end)) AS `Total_Male`,count(distinct (case when (`tbl_client`.`gender` = '3') then `tbl_client`.`id` end)) AS `Total_Transgender`,count(distinct (case when (`tbl_client`.`gender` = '5') then `tbl_client`.`id` end)) AS `Total_Not_Provided` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) group by year(`tbl_appointment`.`appntmnt_date`),month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for clients_defaulted
-- ----------------------------
DROP VIEW IF EXISTS `clients_defaulted`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `clients_defaulted` AS select 'No of Defaulted Clients in the  clinic ' AS `label`,`tbl_partner`.`name` AS `partner`,`tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) then `tbl_appointment`.`client_id` end)) AS `0-9`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then `tbl_appointment`.`client_id` end)) AS `10-14`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then `tbl_appointment`.`client_id` end)) AS `15-19`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then `tbl_appointment`.`client_id` end)) AS `20-24`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) then `tbl_appointment`.`client_id` end)) AS `25+`,count(distinct `tbl_appointment`.`client_id`) AS `TOTAL`,count(distinct (case when (`tbl_client`.`gender` = '1') then `tbl_client`.`id` end)) AS `Total_Female`,count(distinct (case when (`tbl_client`.`gender` = '2') then `tbl_client`.`id` end)) AS `Total_Male`,count(distinct (case when (`tbl_client`.`gender` = '3') then `tbl_client`.`id` end)) AS `Total_Transgender`,count(distinct (case when (`tbl_client`.`gender` = '5') then `tbl_client`.`id` end)) AS `Total_Not_Provided` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) where (((to_days(`tbl_appointment`.`date_attended`) - to_days(`tbl_appointment`.`appntmnt_date`)) <= 30) and (`tbl_appointment`.`app_status` = 'Defaulted')) group by year(`tbl_appointment`.`appntmnt_date`),month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for dead_clients
-- ----------------------------
DROP VIEW IF EXISTS `dead_clients`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `dead_clients` AS select 'Total No confirmed Dead ' AS `label`,`tbl_partner`.`id` AS `partner_id`,`tbl_partner`.`name` AS `partner`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 0) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)),`tbl_client`.`id`,0)) AS `0-9`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)),`tbl_client`.`id`,0)) AS `10-14`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)),`tbl_appointment`.`id`,0)) AS `15-19`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)),`tbl_client`.`id`,0)) AS `20-24`,count(distinct if(((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25),`tbl_client`.`id`,0)) AS `25+` from ((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) where ((`tbl_client`.`status` = 'Deceased') and (cast(`tbl_appointment`.`appntmnt_date` as date) < curdate())) group by month(`tbl_client`.`updated_at`),`tbl_client`.`mfl_code` order by `tbl_client`.`clinic_number`;

-- ----------------------------
-- View structure for defaulted_clients
-- ----------------------------
DROP VIEW IF EXISTS `defaulted_clients`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `defaulted_clients` AS select 'No of Defaulted Clients in the  clinic  ' AS `label`,`tbl_partner`.`id` AS `partner_id`,`tbl_partner`.`name` AS `partner`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 0) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)),`tbl_appointment`.`id`,0)) AS `0-9`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)),`tbl_appointment`.`id`,0)) AS `10-14`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)),`tbl_appointment`.`id`,0)) AS `15-19`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)),`tbl_appointment`.`id`,0)) AS `20-24`,count(distinct if(((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25),`tbl_appointment`.`id`,0)) AS `25+` from ((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) where ((`tbl_appointment`.`app_status` = 'Defaulted') and (cast(`tbl_appointment`.`appntmnt_date` as date) < curdate())) group by month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for defaulted_query
-- ----------------------------
DROP VIEW IF EXISTS `defaulted_query`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `defaulted_query` AS select `tbl_client`.`mfl_code` AS `mfl_code`,`tbl_client`.`file_no` AS `file_no`,`tbl_groups`.`name` AS `group_name`,`tbl_groups`.`id` AS `group_id`,`tbl_language`.`name` AS `language_name`,`tbl_language`.`id` AS `language_id`,`tbl_client`.`f_name` AS `f_name`,`tbl_client`.`m_name` AS `m_name`,`tbl_client`.`l_name` AS `l_name`,`tbl_client`.`dob` AS `dob`,`tbl_client`.`status` AS `STATUS`,`tbl_client`.`phone_no` AS `phone_no`,`tbl_client`.`created_at` AS `created_at`,`tbl_client`.`enrollment_date` AS `enrollment_date`,`tbl_client`.`art_date` AS `art_date`,`tbl_client`.`id` AS `client_id`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`client_status` AS `client_status`,`tbl_client`.`txt_frequency` AS `txt_frequency`,`tbl_client`.`txt_time` AS `txt_time`,`tbl_client`.`alt_phone_no` AS `alt_phone_no`,`tbl_client`.`shared_no_name` AS `shared_no_name`,`tbl_client`.`smsenable` AS `smsenable`,`tbl_appointment`.`appntmnt_date` AS `appntmnt_date`,`tbl_appointment`.`app_msg` AS `app_msg`,`tbl_appointment`.`updated_at` AS `updated_at`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_appointment`.`fnl_trcing_outocme` AS `fnl_trcing_outocme`,`tbl_appointment`.`no_calls` AS `no_calls`,`tbl_appointment`.`no_msgs` AS `no_msgs`,`tbl_appointment`.`home_visits` AS `home_visits`,`tbl_appointment`.`fnl_outcome_dte` AS `fnl_outcome_dte`,`tbl_appointment`.`id` AS `appointment_id`,`tbl_appointment_types`.`id` AS `appointment_type_id`,`tbl_appointment_types`.`name` AS `appointment_type_name` from ((((`tbl_client` join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) where ((`tbl_client`.`status` = 'Active') and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`appntmnt_date` < curdate()) and (`tbl_appointment`.`active_app` = '1')) order by `tbl_appointment`.`appntmnt_date` desc;

-- ----------------------------
-- View structure for defaulted_returned
-- ----------------------------
DROP VIEW IF EXISTS `defaulted_returned`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `defaulted_returned` AS select 'No of Deafulters returning to care ' AS `label`,`tbl_partner`.`id` AS `partner_id`,`tbl_partner`.`name` AS `partner`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 0) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)),`tbl_appointment`.`id`,0)) AS `0-9`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)),`tbl_appointment`.`id`,0)) AS `10-14`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)),`tbl_appointment`.`id`,0)) AS `15-19`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)),`tbl_appointment`.`id`,0)) AS `20-24`,count(distinct if(((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25),`tbl_appointment`.`id`,0)) AS `25+` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_final_outcome` on((`tbl_final_outcome`.`id` = `tbl_appointment`.`fnl_trcing_outocme`))) where ((`tbl_appointment`.`app_status` = 'Defaulted') and (cast(`tbl_appointment`.`appntmnt_date` as date) < curdate()) and (`tbl_final_outcome`.`id` = '5')) group by month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for disabled_clients
-- ----------------------------
DROP VIEW IF EXISTS `disabled_clients`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `disabled_clients` AS select concat(`tbl_client`.`f_name`,' ',`tbl_client`.`m_name`,' ',`tbl_client`.`l_name`) AS `client_name`,`tbl_client`.`file_no` AS `file_no`,`tbl_groups`.`name` AS `group_name`,`tbl_client`.`f_name` AS `f_name`,`tbl_client`.`m_name` AS `m_name`,`tbl_client`.`l_name` AS `l_name`,`tbl_groups`.`id` AS `group_id`,`tbl_gender`.`id` AS `gender_id`,`tbl_gender`.`name` AS `gender_name`,`tbl_language`.`name` AS `language_name`,`tbl_client`.`partner_id` AS `partner_id`,`tbl_language`.`id` AS `language_id`,`tbl_marital_status`.`marital` AS `marital_status`,`tbl_marital_status`.`id` AS `marital_id`,`tbl_county`.`name` AS `county_name`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_client`.`dob` AS `dob`,`tbl_client`.`status` AS `status`,`tbl_client`.`phone_no` AS `phone_no`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`created_at` AS `created_at`,`tbl_client`.`enrollment_date` AS `enrollment_date`,`tbl_client`.`art_date` AS `art_date`,`tbl_client`.`id` AS `client_id`,`tbl_client`.`client_status` AS `client_status`,`tbl_client`.`txt_frequency` AS `txt_frequency`,`tbl_client`.`txt_time` AS `txt_time`,`tbl_client`.`alt_phone_no` AS `alt_phone_no`,`tbl_client`.`shared_no_name` AS `shared_no_name`,`tbl_client`.`smsenable` AS `smsenable` from ((((((((`tbl_client` join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) where (`tbl_client`.`status` = 'Disabled');

-- ----------------------------
-- View structure for duplicate_active_apps
-- ----------------------------
DROP VIEW IF EXISTS `duplicate_active_apps`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `duplicate_active_apps` AS select max(`t1`.`id`) AS `latest`,`t1`.`client_id` AS `client_id` from `tbl_appointment` `t1` where `t1`.`client_id` in (select `tbl_appointment`.`client_id` from `tbl_appointment` where (`tbl_appointment`.`active_app` = 1) group by `tbl_appointment`.`client_id` having (count(`tbl_appointment`.`id`) > 1)) group by `t1`.`client_id`;

-- ----------------------------
-- View structure for errors_on_unscheduled
-- ----------------------------
DROP VIEW IF EXISTS `errors_on_unscheduled`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `errors_on_unscheduled` AS select max(`tbl_appointment`.`id`) AS `app_id`,`tbl_appointment`.`client_id` AS `client_id`,`tbl_appointment`.`appntmnt_date` AS `appntmnt_date`,`tbl_appointment`.`created_at` AS `created_at`,`tbl_appointment`.`updated_at` AS `updated_at`,`tbl_appointment`.`app_status` AS `app_status`,`tbl_appointment`.`appointment_kept` AS `appointment_kept`,`tbl_appointment`.`active_app` AS `active_app`,`tbl_appointment`.`visit_type` AS `visit_type`,`tbl_appointment`.`date_attended` AS `date_attended` from `tbl_appointment` where ((`tbl_appointment`.`visit_type` = 'Un-Scheduled') and (`tbl_appointment`.`active_app` = '0') and (`tbl_appointment`.`appointment_kept` = 'Yes') and `tbl_appointment`.`client_id` in (select `tbl_appointment`.`client_id` from `tbl_appointment` where ((cast(`tbl_appointment`.`appntmnt_date` as date) > curdate()) and (`tbl_appointment`.`active_app` = '1'))) is false) group by `tbl_appointment`.`client_id` order by `tbl_appointment`.`appntmnt_date` desc;

-- ----------------------------
-- View structure for future_appointments_query
-- ----------------------------
DROP VIEW IF EXISTS `future_appointments_query`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `future_appointments_query` AS select `tbl_client`.`file_no` AS `file_no`,`tbl_groups`.`name` AS `group_name`,`tbl_groups`.`id` AS `group_id`,`tbl_language`.`name` AS `language_name`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_appointment_types`.`id` AS `appointment_types_id`,`tbl_appointment_types`.`name` AS `appointment_types`,`tbl_language`.`id` AS `language_id`,`tbl_client`.`f_name` AS `f_name`,`tbl_client`.`m_name` AS `m_name`,`tbl_client`.`l_name` AS `l_name`,`tbl_client`.`dob` AS `dob`,`tbl_client`.`status` AS `STATUS`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_client`.`phone_no` AS `phone_no`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`created_at` AS `enrollment_date`,`tbl_client`.`id` AS `client_id`,`tbl_client`.`client_status` AS `client_status`,`tbl_client`.`txt_frequency` AS `txt_frequency`,`tbl_client`.`txt_time` AS `txt_time`,`tbl_client`.`alt_phone_no` AS `alt_phone_no`,`tbl_client`.`shared_no_name` AS `shared_no_name`,`tbl_client`.`smsenable` AS `smsenable`,`tbl_appointment`.`appntmnt_date` AS `appntmnt_date`,`tbl_appointment`.`app_msg` AS `app_msg`,`tbl_appointment`.`updated_at` AS `updated_at` from ((((((`tbl_client` join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) where ((`tbl_client`.`status` = 'Active') and (cast(`tbl_appointment`.`appntmnt_date` as date) >= curdate()) and (`tbl_appointment`.`active_app` = '1'));

-- ----------------------------
-- View structure for inactive_clients
-- ----------------------------
DROP VIEW IF EXISTS `inactive_clients`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `inactive_clients` AS select 'Clients Not Active in the Facily ' AS `label`,`tbl_partner`.`name` AS `partner`,`tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_client`.`created_at`,'%M %Y') AS `month-year`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) then `tbl_client`.`id` end)) AS `0-9`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then `tbl_client`.`id` end)) AS `10-14`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then `tbl_client`.`id` end)) AS `15-19`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then `tbl_client`.`id` end)) AS `20-24`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) then `tbl_client`.`id` end)) AS `25+`,count(distinct `tbl_client`.`id`) AS `TOTAL`,count(distinct (case when (`tbl_client`.`gender` = '1') then `tbl_client`.`id` end)) AS `Total_Female`,count(distinct (case when (`tbl_client`.`gender` = '2') then `tbl_client`.`id` end)) AS `Total_Male`,count(distinct (case when (`tbl_client`.`gender` = '3') then `tbl_client`.`id` end)) AS `Total_Transgender`,count(distinct (case when (`tbl_client`.`gender` = '4') then `tbl_client`.`id` end)) AS `Total_Not_Provided` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) where (`tbl_client`.`status` <> 'Active') group by year(`tbl_client`.`created_at`),month(`tbl_client`.`created_at`),`tbl_client`.`mfl_code` order by `tbl_client`.`created_at`;

-- ----------------------------
-- View structure for kept_appointments
-- ----------------------------
DROP VIEW IF EXISTS `kept_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `kept_appointments` AS select 'No of Clients who kept Appointments ' AS `label`,`tbl_partner`.`name` AS `partner`,`tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) then `tbl_appointment`.`client_id` end)) AS `0-9`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then `tbl_appointment`.`client_id` end)) AS `10-14`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then `tbl_appointment`.`client_id` end)) AS `15-19`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then `tbl_appointment`.`client_id` end)) AS `20-24`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) then `tbl_appointment`.`client_id` end)) AS `25+`,count(distinct `tbl_appointment`.`client_id`) AS `TOTAL`,count(distinct (case when (`tbl_client`.`gender` = '1') then `tbl_client`.`id` end)) AS `Total_Female`,count(distinct (case when (`tbl_client`.`gender` = '2') then `tbl_client`.`id` end)) AS `Total_Male`,count(distinct (case when (`tbl_client`.`gender` = '3') then `tbl_client`.`id` end)) AS `Total_Transgender`,count(distinct (case when (`tbl_client`.`gender` = '5') then `tbl_client`.`id` end)) AS `Total_Not_Provided` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) where (`tbl_appointment`.`date_attended` = `tbl_appointment`.`appntmnt_date`) group by year(`tbl_appointment`.`appntmnt_date`),month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for lates_appointments
-- ----------------------------
DROP VIEW IF EXISTS `lates_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `lates_appointments` AS select max(`tbl_appointment`.`id`) AS `id` from `tbl_appointment` group by `tbl_appointment`.`client_id`;

-- ----------------------------
-- View structure for lost_query
-- ----------------------------
DROP VIEW IF EXISTS `lost_query`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `lost_query` AS select `tbl_client`.`mfl_code` AS `mfl_code`,`tbl_client`.`file_no` AS `file_no`,`tbl_groups`.`name` AS `group_name`,`tbl_groups`.`id` AS `group_id`,`tbl_language`.`name` AS `language_name`,`tbl_language`.`id` AS `language_id`,`tbl_client`.`f_name` AS `f_name`,`tbl_client`.`m_name` AS `m_name`,`tbl_client`.`l_name` AS `l_name`,`tbl_client`.`dob` AS `dob`,`tbl_client`.`status` AS `STATUS`,`tbl_client`.`phone_no` AS `phone_no`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`created_at` AS `created_at`,`tbl_client`.`enrollment_date` AS `enrollment_date`,`tbl_client`.`art_date` AS `art_date`,`tbl_client`.`id` AS `client_id`,`tbl_client`.`client_status` AS `client_status`,`tbl_client`.`txt_frequency` AS `txt_frequency`,`tbl_client`.`txt_time` AS `txt_time`,`tbl_client`.`alt_phone_no` AS `alt_phone_no`,`tbl_client`.`shared_no_name` AS `shared_no_name`,`tbl_client`.`smsenable` AS `smsenable`,`tbl_appointment`.`appntmnt_date` AS `appntmnt_date`,`tbl_appointment`.`app_msg` AS `app_msg`,`tbl_appointment`.`updated_at` AS `updated_at`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_appointment`.`fnl_trcing_outocme` AS `fnl_trcing_outocme`,`tbl_appointment`.`no_calls` AS `no_calls`,`tbl_appointment`.`no_msgs` AS `no_msgs`,`tbl_appointment`.`home_visits` AS `home_visits`,`tbl_appointment`.`fnl_outcome_dte` AS `fnl_outcome_dte`,`tbl_appointment`.`id` AS `appointment_id`,`tbl_appointment_types`.`id` AS `appointment_type_id`,`tbl_appointment_types`.`name` AS `appointment_type_name` from ((((`tbl_client` join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) where ((`tbl_client`.`status` = 'Active') and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`appntmnt_date` < curdate()) and (`tbl_appointment`.`active_app` = '1')) order by `tbl_appointment`.`appntmnt_date` desc;

-- ----------------------------
-- View structure for missed_clients
-- ----------------------------
DROP VIEW IF EXISTS `missed_clients`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `missed_clients` AS select 'No of Missed Clients in the  clinic ' AS `label`,`tbl_partner`.`name` AS `partner`,`tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) then `tbl_appointment`.`client_id` end)) AS `0-9`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then `tbl_appointment`.`client_id` end)) AS `10-14`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then `tbl_appointment`.`client_id` end)) AS `15-19`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then `tbl_appointment`.`client_id` end)) AS `20-24`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) then `tbl_appointment`.`client_id` end)) AS `25+`,count(distinct `tbl_appointment`.`client_id`) AS `TOTAL`,count(distinct (case when (`tbl_client`.`gender` = '1') then `tbl_client`.`id` end)) AS `Total_Female`,count(distinct (case when (`tbl_client`.`gender` = '2') then `tbl_client`.`id` end)) AS `Total_Male`,count(distinct (case when (`tbl_client`.`gender` = '3') then `tbl_client`.`id` end)) AS `Total_Transgender`,count(distinct (case when (`tbl_client`.`gender` = '5') then `tbl_client`.`id` end)) AS `Total_Not_Provided` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) where (((to_days(`tbl_appointment`.`date_attended`) - to_days(`tbl_appointment`.`appntmnt_date`)) <= 4) and (`tbl_appointment`.`app_status` = 'Missed')) group by year(`tbl_appointment`.`appntmnt_date`),month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for missed_clinical_appointments
-- ----------------------------
DROP VIEW IF EXISTS `missed_clinical_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `missed_clinical_appointments` AS select `tbl_appointment`.`app_status` AS `app_status`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`app_status` in ('Missed','Defaulted','LTFU')) and (`tbl_appointment`.`app_type_1` = 'Clinical Review') and (`tbl_appointment`.`appntmnt_date` <= curdate())) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for missed_query
-- ----------------------------
DROP VIEW IF EXISTS `missed_query`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `missed_query` AS select `tbl_client`.`file_no` AS `file_no`,`tbl_groups`.`name` AS `group_name`,`tbl_groups`.`id` AS `group_id`,`tbl_language`.`name` AS `language_name`,`tbl_language`.`id` AS `language_id`,`tbl_client`.`f_name` AS `f_name`,`tbl_client`.`m_name` AS `m_name`,`tbl_client`.`l_name` AS `l_name`,`tbl_client`.`dob` AS `dob`,`tbl_client`.`status` AS `STATUS`,`tbl_client`.`phone_no` AS `phone_no`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`created_at` AS `created_at`,`tbl_client`.`enrollment_date` AS `enrollment_date`,`tbl_client`.`art_date` AS `art_date`,`tbl_client`.`id` AS `client_id`,`tbl_client`.`client_status` AS `client_status`,`tbl_client`.`txt_frequency` AS `txt_frequency`,`tbl_client`.`txt_time` AS `txt_time`,`tbl_client`.`alt_phone_no` AS `alt_phone_no`,`tbl_client`.`shared_no_name` AS `shared_no_name`,`tbl_client`.`smsenable` AS `smsenable`,`tbl_appointment`.`appntmnt_date` AS `appntmnt_date`,`tbl_appointment`.`app_msg` AS `app_msg`,`tbl_appointment`.`updated_at` AS `updated_at`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_appointment`.`fnl_trcing_outocme` AS `fnl_trcing_outocme`,`tbl_appointment`.`no_calls` AS `no_calls`,`tbl_appointment`.`no_msgs` AS `no_msgs`,`tbl_appointment`.`home_visits` AS `home_visits`,`tbl_appointment`.`fnl_outcome_dte` AS `fnl_outcome_dte`,`tbl_appointment`.`id` AS `appointment_id`,`tbl_appointment_types`.`id` AS `appointment_type_id`,`tbl_appointment_types`.`name` AS `appointment_type_name` from ((((`tbl_client` join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) where ((`tbl_client`.`status` = 'Active') and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`appntmnt_date` < curdate()) and (`tbl_appointment`.`active_app` = '1')) order by `tbl_appointment`.`appntmnt_date` desc;

-- ----------------------------
-- View structure for multiple_active_apps
-- ----------------------------
DROP VIEW IF EXISTS `multiple_active_apps`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `multiple_active_apps` AS select max(`tbl_appointment`.`id`) AS `id` from `tbl_appointment` where (`tbl_appointment`.`active_app` = 1) group by `tbl_appointment`.`client_id` having (count(`tbl_appointment`.`client_id`) > 1);

-- ----------------------------
-- View structure for not_traced_clients
-- ----------------------------
DROP VIEW IF EXISTS `not_traced_clients`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `not_traced_clients` AS select 'Total No not traced  ' AS `label`,`tbl_partner`.`name` AS `partner`,`tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 0) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)),`tbl_appointment`.`id`,0)) AS `0-9`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)),`tbl_appointment`.`id`,0)) AS `10-14`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)),`tbl_appointment`.`id`,0)) AS `15-19`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)),`tbl_appointment`.`id`,0)) AS `20-24`,count(distinct if(((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25),`tbl_appointment`.`id`,0)) AS `25+` from ((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) where ((`tbl_appointment`.`active_app` = '1') and (cast(`tbl_appointment`.`appntmnt_date` as date) < curdate()) and (`tbl_appointment`.`fnl_trcing_outocme` is null) and `tbl_appointment`.`id` in (select `tbl_clnt_outcome`.`appointment_id` from `tbl_clnt_outcome`) is false) group by month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for outcome_report
-- ----------------------------
DROP VIEW IF EXISTS `outcome_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `outcome_report` AS select `tbl_partner`.`name` AS `Partner`,`tbl_county`.`name` AS `County`,`tbl_sub_county`.`name` AS `Sub_County`,`tbl_master_facility`.`name` AS `Facility`,`tbl_master_facility`.`code` AS `MFL`,`tbl_client`.`clinic_number` AS `UPN`,`tbl_client`.`status` AS `Client_St`,`tbl_client`.`file_no` AS `File_Number`,`tbl_gender`.`name` AS `Gender`,`tbl_marital_status`.`marital` AS `Marital_Status`,`tbl_language`.`name` AS `Languages`,`tbl_client`.`phone_no` AS `Phone_NO`,`tbl_client`.`smsenable` AS `Consented`,`tbl_client`.`dob` AS `DoB`,`tbl_appointment`.`visit_type` AS `Visit_Type`,`tbl_appointment`.`unscheduled_date` AS `Unscheduled_Date`,`tbl_appointment`.`date_attended` AS `Date_Came`,(year(curdate()) - year(`tbl_client`.`dob`)) AS `Age`,(to_days(`tbl_appointment`.`date_attended`) - to_days(`tbl_appointment`.`appntmnt_date`)) AS `Days_Defaulted`,group_concat(distinct `tbl_appointment`.`appntmnt_date` separator ',') AS `Appointment_Date`,group_concat(distinct `tbl_appointment_types`.`name` separator ',') AS `Appointment_Types`,group_concat(distinct (case when (`tbl_appointment`.`appointment_kept` = 'Yes') then 'Kept' else `tbl_appointment`.`app_status` end) separator ',') AS `Appointment_Status`,group_concat(`tbl_clnt_outcome`.`tracer_name` separator ',') AS `Tracer`,group_concat(`tbl_clnt_outcome`.`tracing_date` separator ',') AS `Tracing_Date`,group_concat(`tbl_outcome`.`name` separator ',') AS `Outcome`,group_concat(`tbl_final_outcome`.`name` separator ',') AS `Final_Outcome`,group_concat(`tbl_other_final_outcome`.`outcome` separator ',') AS `Other_Outcome` from ((((((((((((((`tbl_client` left join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_master_facility`.`code`))) left join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) left join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) left join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) left join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) left join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) left join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) left join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) left join `tbl_clnt_outcome` on((`tbl_clnt_outcome`.`appointment_id` = `tbl_appointment`.`id`))) left join `tbl_outcome` on((`tbl_outcome`.`id` = `tbl_clnt_outcome`.`outcome`))) left join `tbl_final_outcome` on((`tbl_final_outcome`.`id` = `tbl_clnt_outcome`.`fnl_outcome`))) left join `tbl_other_final_outcome` on((`tbl_other_final_outcome`.`client_outcome_id` = `tbl_clnt_outcome`.`id`))) where ((`tbl_appointment`.`app_status` = 'Missed') or (`tbl_appointment`.`app_status` = 'Defaulted')) group by `tbl_client`.`clinic_number`,`tbl_appointment`.`appntmnt_date`,`tbl_appointment`.`app_type_1`;

-- ----------------------------
-- View structure for partner_outcome_report
-- ----------------------------
DROP VIEW IF EXISTS `partner_outcome_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `partner_outcome_report` AS select `tbl_partner`.`name` AS `Partner`,`tbl_county`.`name` AS `County`,`tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `Sub_County`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `Facility`,`tbl_master_facility`.`code` AS `MFL`,`tbl_client`.`clinic_number` AS `UPN`,`tbl_client`.`status` AS `Client_St`,`tbl_client`.`art_date` AS `Art_Start_Date`,`tbl_gender`.`name` AS `Gender`,`tbl_marital_status`.`marital` AS `Marital_Status`,`tbl_language`.`name` AS `Languages`,`tbl_client`.`phone_no` AS `Phone_NO`,`tbl_client`.`smsenable` AS `Consented`,`tbl_client`.`dob` AS `DoB`,`tbl_clnt_outcome`.`id` AS `Outcome_ID`,`tbl_appointment`.`id` AS `Appointment_ID`,`tbl_appointment`.`visit_type` AS `Visit_Type`,`tbl_appointment`.`unscheduled_date` AS `Unscheduled_Date`,`tbl_appointment`.`date_attended` AS `Date_Came`,(year(curdate()) - year(`tbl_client`.`dob`)) AS `Age`,(case when (`tbl_appointment`.`date_attended` is null) then (to_days(curdate()) - to_days(`tbl_appointment`.`appntmnt_date`)) else (to_days(`tbl_appointment`.`date_attended`) - to_days(`tbl_appointment`.`appntmnt_date`)) end) AS `Days_Defaulted`,`tbl_appointment`.`appntmnt_date` AS `Appointment_Date`,`tbl_appointment_types`.`name` AS `Appointment_Types`,(case when ((`tbl_appointment`.`appointment_kept` = 'Yes') and (`tbl_appointment`.`active_app` = '0') and (`tbl_appointment`.`app_status` = 'Notified')) then 'Kept' else `tbl_appointment`.`app_status` end) AS `Appointment_Status`,`tbl_clnt_outcome`.`tracer_name` AS `Tracer`,`tbl_clnt_outcome`.`tracing_date` AS `Tracing_Date`,`tbl_outcome`.`name` AS `Outcome`,`tbl_final_outcome`.`name` AS `Final_Outcome`,`tbl_other_final_outcome`.`outcome` AS `Other_Outcome` from ((((((((((((((`tbl_clnt_outcome` join `tbl_client` on((`tbl_clnt_outcome`.`client_id` = `tbl_client`.`id`))) join `tbl_appointment` on((`tbl_appointment`.`id` = `tbl_clnt_outcome`.`appointment_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_master_facility`.`code`))) left join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) left join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) left join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) left join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) left join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) left join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) left join `tbl_outcome` on((`tbl_outcome`.`id` = `tbl_clnt_outcome`.`outcome`))) left join `tbl_final_outcome` on((`tbl_final_outcome`.`id` = `tbl_clnt_outcome`.`fnl_outcome`))) left join `tbl_other_final_outcome` on((`tbl_other_final_outcome`.`client_outcome_id` = `tbl_clnt_outcome`.`id`))) where `tbl_clnt_outcome`.`id` in (select max(`tbl_clnt_outcome`.`id`) from `tbl_clnt_outcome` group by `tbl_clnt_outcome`.`client_id`);

-- ----------------------------
-- View structure for past_appointments_view
-- ----------------------------
DROP VIEW IF EXISTS `past_appointments_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `past_appointments_view` AS select `tbl_client`.`clinic_id` AS `clinic_id`,`tbl_users`.`clinic_id` AS `user_clinic`,`tbl_appointment`.`id` AS `appointment_id`,`tbl_client`.`clinic_number` AS `clinic_no`,`tbl_client`.`id` AS `client_id`,concat(`tbl_client`.`f_name`,' ',`tbl_client`.`l_name`) AS `client_name`,`tbl_client`.`phone_no` AS `client_phone_no`,`tbl_appointment_types`.`name` AS `appointment_type`,date_format(`tbl_appointment`.`appntmnt_date`,'%d/%m/%Y') AS `appntmnt_date`,`tbl_appointment`.`created_at` AS `created_at`,`tbl_client`.`file_no` AS `file_no`,`tbl_client`.`buddy_phone_no` AS `buddy_phone_no`,`tbl_users`.`facility_id` AS `facility_id`,`tbl_users`.`phone_no` AS `user_phone_no`,`tbl_users`.`id` AS `id`,`tbl_other_appointment_types`.`name` AS `other_appointment_type` from ((((((`tbl_client` join `tbl_appointment` on(((`tbl_appointment`.`client_id` = `tbl_client`.`id`) and (`tbl_client`.`status` = 'Active')))) join `tbl_appointment_types` on(((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`) and (`tbl_appointment`.`active_app` = '1') and (`tbl_appointment`.`appntmnt_date` < curdate())))) join `tbl_users` on(((`tbl_client`.`mfl_code` = `tbl_users`.`facility_id`) and (`tbl_users`.`access_level` = 'Facility') and (`tbl_users`.`rcv_app_list` = 'Yes') and (`tbl_users`.`status` = 'Active')))) join `tbl_role` on(((`tbl_role`.`id` = `tbl_users`.`role_id`) and (`tbl_role`.`name` like '%Facility%')))) join `tbl_clinic` on(((`tbl_clinic`.`id` = `tbl_client`.`clinic_id`) and (`tbl_users`.`clinic_id` = `tbl_client`.`clinic_id`)))) left join `tbl_other_appointment_types` on((`tbl_other_appointment_types`.`appointment_id` = `tbl_appointment`.`id`))) group by `tbl_appointment`.`id`;

-- ----------------------------
-- View structure for tableau_sync
-- ----------------------------
DROP VIEW IF EXISTS `tableau_sync`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tableau_sync` AS select (case when (`tbl_partner_facility`.`avg_clients` is null) then 0 else `tbl_partner_facility`.`avg_clients` end) AS `no_current_active_clients`,`tbl_client`.`id` AS `client_key`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`f_name` AS `first_name`,`tbl_client`.`m_name` AS `middle_name`,`tbl_client`.`l_name` AS `last_name`,(case when (`tbl_client`.`phone_no` is null) then 'No Phone Number' else `tbl_client`.`phone_no` end) AS `mobile_no`,(case when (`tbl_client`.`dob` is null) then NULL else `tbl_client`.`dob` end) AS `clnd_dob`,(case when (`tbl_client`.`enrollment_date` is null) then 'No Enrollment Date' else `tbl_client`.`enrollment_date` end) AS `enrollment_date`,(case when (`tbl_gender`.`name` is null) then 'No Gender' else `tbl_gender`.`name` end) AS `gender`,timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) AS `age`,(case when ((timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) >= '0') and (timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) <= '0')) then '<1' when ((timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) >= '1') and (timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) <= '9')) then '1-9' when ((timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) >= '10') and (timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) <= '14')) then '10-14' when ((timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) >= '15') and (timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) <= '19')) then '15-19' when ((timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) >= '20') and (timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) <= '24')) then '20-24' else '25 +' end) AS `age_bracket`,`tbl_groups`.`name` AS `client_group_name`,`tbl_language`.`name` AS `client_language`,`tbl_client`.`client_status` AS `client_status`,(case when (`tbl_client`.`txt_frequency` is null) then '168' else `tbl_client`.`txt_frequency` end) AS `txt_frequency`,`tbl_client`.`txt_time` AS `txt_time`,`tbl_time`.`name` AS `text_time`,(case when (`tbl_client`.`smsenable` is null) then 'No' else `tbl_client`.`smsenable` end) AS `smsenable`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,(case when (`tbl_master_facility`.`owner` is null) then 'No Owner' else `tbl_master_facility`.`owner` end) AS `facility_owner`,(case when (`tbl_master_facility`.`keph_level` is null) then 'No Level' else `tbl_master_facility`.`keph_level` end) AS `facility_level`,(case when (`tbl_client`.`marital` is null) then '0' else `tbl_client`.`marital` end) AS `marital`,(case when (`tbl_marital_status`.`marital` is null) then 'No' else `tbl_marital_status`.`marital` end) AS `marital_status`,(case when (`tbl_client`.`wellness_enable` is null) then 'No' else `tbl_client`.`wellness_enable` end) AS `wellness_enable`,(case when (`tbl_client`.`motivational_enable` is null) then 'No' else `tbl_client`.`motivational_enable` end) AS `motivational_enable`,(case when (`tbl_client`.`client_type` is null) then 'New' else `tbl_client`.`client_type` end) AS `client_type`,`tbl_client`.`prev_clinic` AS `prev_clinic`,`tbl_client`.`transfer_date` AS `transfer_date`,(case when (`tbl_client`.`entry_point` is null) then 'Empty' else `tbl_client`.`entry_point` end) AS `entry_point`,(case when (`tbl_client`.`welcome_sent` is null) then 'No' else `tbl_client`.`welcome_sent` end) AS `welcome_sent`,`tbl_client`.`consent_date` AS `consent_date`,`tbl_client`.`stable` AS `stable`,`tbl_client`.`physical_address` AS `physical_address`,`tbl_client`.`partner_id` AS `partner_id`,`tbl_client`.`status` AS `status`,`tbl_partner`.`name` AS `partner_name`,(case when (`tbl_donor`.`name` is null) then 'No Donor' else `tbl_donor`.`name` end) AS `donor_name`,(case when (`tbl_donor`.`id` is null) then 'No Donor ID' else `tbl_donor`.`id` end) AS `donor_id`,(case when (`tbl_county`.`id` is null) then '0' else `tbl_county`.`id` end) AS `county_id`,(case when (`tbl_county`.`name` is null) then 'No County' else `tbl_county`.`name` end) AS `county`,(case when (`tbl_sub_county`.`name` is null) then 'No Sub County' else `tbl_sub_county`.`name` end) AS `sb_cnty`,(case when (`tbl_sub_county`.`id` is null) then '0' else `tbl_sub_county`.`id` end) AS `sb_cnty_id`,`tbl_client`.`created_at` AS `created_at`,`tbl_client`.`updated_at` AS `updated_at`,`tbl_client`.`art_date` AS `art_date`,`tbl_client`.`created_by` AS `created_by`,`tbl_client`.`updated_by` AS `updated_by`,`tbl_appointment`.`id` AS `appntmnt_id`,`tbl_appointment`.`appntmnt_date` AS `appntmnt_date`,`tbl_appointment_types`.`name` AS `appointment_type`,`tbl_appointment`.`app_type_1` AS `appointment_type_id`,(case when (`tbl_appointment`.`appntmnt_date` = curdate()) then 'Today Appointment' when ((`tbl_appointment`.`appntmnt_date` > curdate()) and (`tbl_appointment`.`active_app` = '1')) then 'Future Appointment' when ((`tbl_appointment`.`appntmnt_date` < curdate()) and (`tbl_appointment`.`active_app` = '0')) then 'Past Appointment' end) AS `appointment_status`,(case when ((`tbl_appointment`.`appointment_kept` = 'Yes') and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`active_app` = '0') and (`tbl_appointment`.`appntmnt_date` < curdate())) then 'Appointment Kept' when ((`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`appntmnt_date` < curdate())) then 'Missed' when ((`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`appntmnt_date` < curdate())) then 'Defaulted' when ((`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`appntmnt_date` < curdate())) then 'LTFU' when ((`tbl_appointment`.`app_status` = 'Booked') and (`tbl_appointment`.`appntmnt_date` > curdate())) then 'Booked' end) AS `appointment_open_status`,`tbl_appointment`.`created_at` AS `apt_created_at`,`tbl_appointment`.`created_by` AS `apt_created_by`,`tbl_appointment`.`updated_at` AS `apt_updated_at`,`tbl_appointment`.`updated_by` AS `apt_updated_by`,`tbl_clnt_outgoing`.`destination` AS `destination`,`tbl_clnt_outgoing`.`source` AS `source`,`tbl_clnt_outgoing`.`msg` AS `msg`,`tbl_clnt_outgoing`.`created_at` AS `outgoing_created_at`,`tbl_clnt_outgoing`.`updated_at` AS `outgoing_updated_at`,`tbl_clnt_outgoing`.`status` AS `clnt_outgoing_status`,`tbl_clnt_outgoing`.`message_type_id` AS `message_type_id`,`tbl_message_types`.`name` AS `message_type`,`tbl_clnt_outgoing`.`id` AS `outgoing_id` from (((((((((((((((`tbl_county` join `tbl_sub_county` on((`tbl_sub_county`.`county_id` = `tbl_county`.`id`))) join `tbl_master_facility` on((`tbl_master_facility`.`Sub_County_ID` = `tbl_sub_county`.`id`))) left join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_master_facility`.`code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) left join `tbl_client` on((`tbl_client`.`mfl_code` = `tbl_master_facility`.`code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) left join `tbl_time` on((`tbl_time`.`id` = `tbl_client`.`txt_time`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) left join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) join `tbl_clnt_outgoing` on((`tbl_clnt_outgoing`.`clnt_usr_id` = `tbl_client`.`id`))) join `tbl_message_types` on((`tbl_message_types`.`id` = `tbl_clnt_outgoing`.`message_type_id`))) left join `tbl_donor` on((`tbl_donor`.`id` = `tbl_partner`.`donor_id`))) where ((not((`tbl_partner`.`name` like '%Test%'))) and (not((`tbl_partner`.`name` like '%Training%')))) group by `tbl_appointment`.`id` order by `tbl_client`.`id` desc;

-- ----------------------------
-- View structure for tableau_sync_new
-- ----------------------------
DROP VIEW IF EXISTS `tableau_sync_new`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tableau_sync_new` AS select (case when (`tbl_partner_facility`.`avg_clients` is null) then 0 else `tbl_partner_facility`.`avg_clients` end) AS `no_current_active_clients`,`tbl_client`.`id` AS `client_key`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`f_name` AS `first_name`,`tbl_client`.`m_name` AS `middle_name`,`tbl_client`.`l_name` AS `last_name`,(case when (`tbl_client`.`phone_no` is null) then 'No Phone Number' else `tbl_client`.`phone_no` end) AS `mobile_no`,(case when (`tbl_client`.`dob` is null) then NULL else `tbl_client`.`dob` end) AS `clnd_dob`,(case when (`tbl_client`.`enrollment_date` is null) then 'No Enrollment Date' else `tbl_client`.`enrollment_date` end) AS `enrollment_date`,(case when (`tbl_client`.`gender` is null) then 'No Gender' else `tbl_client`.`gender` end) AS `gender`,timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) AS `age`,(case when ((timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) >= '0') and (timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) <= '0')) then '<1' when ((timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) >= '1') and (timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) <= '9')) then '1-9' when ((timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) >= '10') and (timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) <= '14')) then '10-14' when ((timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) >= '15') and (timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) <= '19')) then '15-19' when ((timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) >= '20') and (timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) <= '24')) then '20-24' else '25 +' end) AS `age_bracket`,`tbl_groups`.`name` AS `client_group_name`,`tbl_language`.`name` AS `client_language`,`tbl_client`.`client_status` AS `client_status`,(case when (`tbl_client`.`txt_frequency` is null) then '168' else `tbl_client`.`txt_frequency` end) AS `txt_frequency`,`tbl_client`.`txt_time` AS `txt_time`,`tbl_time`.`name` AS `text_time`,(case when (`tbl_client`.`smsenable` is null) then 'No' else `tbl_client`.`smsenable` end) AS `smsenable`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,(case when (`tbl_master_facility`.`owner` is null) then 'No Owner' else `tbl_master_facility`.`owner` end) AS `facility_owner`,(case when (`tbl_master_facility`.`keph_level` is null) then 'No Level' else `tbl_master_facility`.`keph_level` end) AS `facility_level`,(case when (`tbl_client`.`marital` is null) then '0' else `tbl_client`.`marital` end) AS `marital`,(case when (`tbl_marital_status`.`marital` is null) then 'No' else `tbl_marital_status`.`marital` end) AS `marital_status`,(case when (`tbl_client`.`wellness_enable` is null) then 'No' else `tbl_client`.`wellness_enable` end) AS `wellness_enable`,(case when (`tbl_client`.`motivational_enable` is null) then 'No' else `tbl_client`.`motivational_enable` end) AS `motivational_enable`,(case when (`tbl_client`.`client_type` is null) then 'New' else `tbl_client`.`client_type` end) AS `client_type`,`tbl_client`.`prev_clinic` AS `prev_clinic`,`tbl_client`.`transfer_date` AS `transfer_date`,(case when (`tbl_client`.`entry_point` is null) then 'Empty' else `tbl_client`.`entry_point` end) AS `entry_point`,(case when (`tbl_client`.`welcome_sent` is null) then 'No' else `tbl_client`.`welcome_sent` end) AS `welcome_sent`,`tbl_client`.`consent_date` AS `consent_date`,`tbl_client`.`stable` AS `stable`,`tbl_client`.`physical_address` AS `physical_address`,`tbl_client`.`partner_id` AS `partner_id`,`tbl_client`.`status` AS `status`,`tbl_partner`.`name` AS `partner_name`,(case when (`tbl_donor`.`name` is null) then 'No Donor' else `tbl_donor`.`name` end) AS `donor_name`,(case when (`tbl_donor`.`id` is null) then 'No Donor ID' else `tbl_donor`.`id` end) AS `donor_id`,(case when (`tbl_county`.`id` is null) then '0' else `tbl_county`.`id` end) AS `county_id`,(case when (`tbl_county`.`name` is null) then 'No County' else `tbl_county`.`name` end) AS `county`,(case when (`tbl_sub_county`.`name` is null) then 'No Sub County' else `tbl_sub_county`.`name` end) AS `sb_cnty`,(case when (`tbl_sub_county`.`id` is null) then '0' else `tbl_sub_county`.`id` end) AS `sb_cnty_id`,`tbl_client`.`created_at` AS `created_at`,`tbl_client`.`updated_at` AS `updated_at`,`tbl_client`.`art_date` AS `art_date`,`tbl_client`.`created_by` AS `created_by`,`tbl_client`.`updated_by` AS `updated_by`,`tbl_appointment`.`id` AS `appntmnt_id`,`tbl_appointment`.`appntmnt_date` AS `appntmnt_date`,`tbl_appointment_types`.`name` AS `appointment_type`,`tbl_appointment`.`app_type_1` AS `appointment_type_id`,(case when (`tbl_appointment`.`appntmnt_date` = curdate()) then 'Today Appointment' when ((`tbl_appointment`.`appntmnt_date` > curdate()) and (`tbl_appointment`.`active_app` = '1')) then 'Future Appointment' when ((`tbl_appointment`.`appntmnt_date` < curdate()) and (`tbl_appointment`.`active_app` = '0')) then 'Past Appointment' end) AS `appointment_status`,(case when ((`tbl_appointment`.`appointment_kept` = 'Yes') and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`active_app` = '0') and (`tbl_appointment`.`appntmnt_date` < curdate())) then 'Appointment Kept' when ((`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`appntmnt_date` < curdate())) then 'Missed' when ((`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`appntmnt_date` < curdate())) then 'Defaulted' when ((`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`appntmnt_date` < curdate())) then 'LTFU' when ((`tbl_appointment`.`app_status` = 'Booked') and (`tbl_appointment`.`appntmnt_date` > curdate())) then 'Booked' end) AS `appointment_open_status`,`tbl_appointment`.`created_at` AS `apt_created_at`,`tbl_appointment`.`created_by` AS `apt_created_by`,`tbl_appointment`.`updated_at` AS `apt_updated_at`,`tbl_appointment`.`updated_by` AS `apt_updated_by`,`tbl_clnt_outgoing`.`destination` AS `destination`,`tbl_clnt_outgoing`.`source` AS `source`,`tbl_clnt_outgoing`.`msg` AS `msg`,`tbl_clnt_outgoing`.`created_at` AS `outgoing_created_at`,`tbl_clnt_outgoing`.`updated_at` AS `outgoing_updated_at`,`tbl_clnt_outgoing`.`status` AS `clnt_outgoing_status`,`tbl_clnt_outgoing`.`message_type_id` AS `message_type_id`,`tbl_message_types`.`name` AS `message_type`,`tbl_clnt_outgoing`.`id` AS `outgoing_id` from (((((((((((((((`tbl_county` join `tbl_sub_county` on((`tbl_sub_county`.`county_id` = `tbl_county`.`id`))) join `tbl_master_facility` on((`tbl_master_facility`.`Sub_County_ID` = `tbl_sub_county`.`id`))) left join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_master_facility`.`code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_client` on((`tbl_client`.`mfl_code` = `tbl_master_facility`.`code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) left join `tbl_time` on((`tbl_time`.`id` = `tbl_client`.`txt_time`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) left join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) join `tbl_clnt_outgoing` on((`tbl_clnt_outgoing`.`clnt_usr_id` = `tbl_client`.`id`))) join `tbl_message_types` on((`tbl_message_types`.`id` = `tbl_clnt_outgoing`.`message_type_id`))) left join `tbl_donor` on((`tbl_donor`.`id` = `tbl_partner`.`donor_id`))) group by `tbl_appointment`.`id`;

-- ----------------------------
-- View structure for tbl_age_distinction
-- ----------------------------
DROP VIEW IF EXISTS `tbl_age_distinction`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_age_distinction` AS select `tbl_unit`.`id` AS `unit_id`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_partner`.`id` AS `partner_id`,count(`tbl_client`.`id`) AS `clients`,count(distinct (case when (`tbl_client`.`smsenable` = 'Yes') then `tbl_client`.`id` end)) AS `consented`,round(((count(distinct (case when (`tbl_client`.`smsenable` = 'Yes') then `tbl_client`.`id` end)) / count(`tbl_client`.`id`)) * 100),0) AS `total_percentage`,count((case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) then `tbl_client`.`id` end)) AS `ToNineregistered`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then `tbl_client`.`id` end)) AS `ToFourteenregistered`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then `tbl_client`.`id` end)) AS `ToNineteenregistered`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then `tbl_client`.`id` end)) AS `ToTwentyFourregistered`,count((case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) then `tbl_client`.`id` end)) AS `Overtwentyfiveregistered`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10)) then `tbl_client`.`id` end)) AS `ToNineconsented`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then `tbl_client`.`id` end)) AS `ToFourteenconsented`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then `tbl_client`.`id` end)) AS `ToNineteenconsented`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then `tbl_client`.`id` end)) AS `ToTwentyFourconsented`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25)) then `tbl_client`.`id` end)) AS `TwentyFiveconsented`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10)) then `tbl_client`.`id` end)) / count((case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) then `tbl_client`.`id` end))) * 100),0) AS `ToNinepercentconsent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then `tbl_client`.`id` end)) / count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then `tbl_client`.`id` end))) * 100),0) AS `ToFourteenpercentconsent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then `tbl_client`.`id` end)) / count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then `tbl_client`.`id` end))) * 100),0) AS `ToNineteenpercentconsent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then `tbl_client`.`id` end)) / count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then `tbl_client`.`id` end))) * 100),0) AS `ToTwentyFourpercentconsent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25)) then `tbl_client`.`id` end)) / count((case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) then `tbl_client`.`id` end))) * 100),0) AS `TwentyFivepercentconsent` from (((`tbl_client` join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_unit` on((`tbl_unit`.`id` = `tbl_master_facility`.`unit_id`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) group by `tbl_master_facility`.`code`;

-- ----------------------------
-- View structure for tbl_appoinments_to_edit
-- ----------------------------
DROP VIEW IF EXISTS `tbl_appoinments_to_edit`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_appoinments_to_edit` AS select `tbl_appointment`.`id` AS `id`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_appointment`.`appntmnt_date` AS `appntmnt_date`,`tbl_appointment_types`.`name` AS `appointment_type`,`tbl_appointment`.`created_at` AS `created_at`,`tbl_users`.`f_name` AS `created_by`,`tbl_client`.`partner_id` AS `partner_id`,`tbl_client`.`mfl_code` AS `mfl_code` from (((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) left join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) join `tbl_users` on((`tbl_users`.`id` = `tbl_appointment`.`created_by`))) where ((cast(`tbl_appointment`.`appntmnt_date` as date) >= (curdate() + interval 8 day)) and (`tbl_client`.`status` = 'Active')) order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for tbl_appointment_dashboard
-- ----------------------------
DROP VIEW IF EXISTS `tbl_appointment_dashboard`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_appointment_dashboard` AS select `tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_master_facility`.`code` AS `mfl_code`,count(distinct `tbl_appointment`.`id`) AS `Total_Appointments`,cast(`tbl_appointment`.`created_at` as date) AS `created_at`,sum((case when ((`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then 1 else 0 end)) AS `Kept_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `Defaulted_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `Missed_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `LTFU_Appointments`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `to_nine_kept`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `to_fourteen_kept`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `to_nineteen_kept`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `to_twenty_four_kept`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `plus_twenty_five_kept`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_nine_defaulted`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_fourteen_defaulted`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_nineteen_defaulted`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_twenty_four_defaulted`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `plus_twenty_five_defaulted`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_nine_missed`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_fourteen_missed`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_nineteen_missed`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_twenty_four_missed`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `plus_twenty_five_missed`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_nine_ltfu`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_fourteen_ltfu`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_nineteen_ltfu`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `to_twenty_four_ltfu`,count((case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `plus_twenty_five_ltfu` from (((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) group by cast(`tbl_appointment`.`created_at` as date),`tbl_master_facility`.`code`;

-- ----------------------------
-- View structure for tbl_appointment_marriage_dashboard
-- ----------------------------
DROP VIEW IF EXISTS `tbl_appointment_marriage_dashboard`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_appointment_marriage_dashboard` AS select `tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_master_facility`.`code` AS `mfl_code`,count(distinct `tbl_appointment`.`id`) AS `Total_Appointments`,cast(`tbl_appointment`.`created_at` as date) AS `created_at`,sum((case when ((`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then 1 else 0 end)) AS `Kept_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `Defaulted_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `Missed_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `LTFU_Appointments`,count((case when ((`tbl_client`.`marital` = 1) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `single_kept`,count((case when ((`tbl_client`.`marital` = 2) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `married_monogamous_kept`,count((case when ((`tbl_client`.`marital` = 3) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `divorced_kept`,count((case when ((`tbl_client`.`marital` = 4) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `widowed_kept`,count((case when ((`tbl_client`.`marital` = 5) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `cohabiting_kept`,count((case when (((`tbl_client`.`marital` = 6) or (`tbl_client`.`marital` is null)) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `unavailable_kept`,count((case when ((`tbl_client`.`marital` = 8) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `maried_polygamous_kept`,count((case when ((`tbl_client`.`marital` = 7) and (`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then `tbl_appointment`.`id` end)) AS `unapplicable_kept`,count((case when ((`tbl_client`.`marital` = 1) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `single_defaulted`,count((case when ((`tbl_client`.`marital` = 2) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `married_monogamous_defaulted`,count((case when ((`tbl_client`.`marital` = 3) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `divorced_defaulted`,count((case when ((`tbl_client`.`marital` = 4) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `widowed_defaulted`,count((case when ((`tbl_client`.`marital` = 5) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `cohabiting_defaulted`,count((case when (((`tbl_client`.`marital` = 6) or (`tbl_client`.`marital` is null)) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `unavailable_defaulted`,count((case when ((`tbl_client`.`marital` = 8) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `maried_polygamous_defaulted`,count((case when ((`tbl_client`.`marital` = 7) and (`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `unapplicable_defaulted`,count((case when ((`tbl_client`.`marital` = 1) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `single_missed`,count((case when ((`tbl_client`.`marital` = 2) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `married_monogamous_missed`,count((case when ((`tbl_client`.`marital` = 3) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `divorced_missed`,count((case when ((`tbl_client`.`marital` = 4) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `widowed_missed`,count((case when ((`tbl_client`.`marital` = 5) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `cohabiting_missed`,count((case when (((`tbl_client`.`marital` = 6) or (`tbl_client`.`marital` is null)) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `unavailable_missed`,count((case when ((`tbl_client`.`marital` = 8) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `maried_polygamous_missed`,count((case when ((`tbl_client`.`marital` = 7) and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `unapplicable_missed`,count((case when ((`tbl_client`.`marital` = 1) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `single_ltfu`,count((case when ((`tbl_client`.`marital` = 2) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `married_monogamous_ltfu`,count((case when ((`tbl_client`.`marital` = 3) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `divorced_ltfu`,count((case when ((`tbl_client`.`marital` = 4) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `widowed_ltfu`,count((case when ((`tbl_client`.`marital` = 5) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `cohabiting_ltfu`,count((case when (((`tbl_client`.`marital` = 6) or (`tbl_client`.`marital` is null)) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `unavailable_ltfu`,count((case when ((`tbl_client`.`marital` = 8) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `maried_polygamous_ltfu`,count((case when ((`tbl_client`.`marital` = 7) and (`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then `tbl_appointment`.`id` end)) AS `unapplicable_ltfu` from (((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) group by cast(`tbl_appointment`.`created_at` as date),`tbl_master_facility`.`code`;

-- ----------------------------
-- View structure for tbl_client_appointment_report
-- ----------------------------
DROP VIEW IF EXISTS `tbl_client_appointment_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_client_appointment_report` AS select `tbl_appointment`.`id` AS `appointment_id`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_gender`.`name` AS `gender`,`tbl_groups`.`name` AS `group_name`,`tbl_marital_status`.`marital` AS `marital`,`tbl_appointment`.`created_at` AS `created_at`,`tbl_appointment`.`appntmnt_date` AS `appointment_date`,`tbl_appointment_types`.`name` AS `appointment_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month_year`,(case when ((`tbl_appointment`.`app_status` = 'Booked') or ((`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`appntmnt_date` < curdate()) and (`tbl_appointment`.`appointment_kept` = 'Yes'))) then 'Appointment Kept' when ((`tbl_appointment`.`appointment_kept` = 'No') and (`tbl_appointment`.`active_app` = '0')) then 'Appointment Not Kept' when ((`tbl_appointment`.`appointment_kept` = 'Yes') and (`tbl_appointment`.`active_app` = '0')) then 'Appointment Kept' when ((`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then 'Missed' when ((`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then 'Defaulted' when ((`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then 'LTFU' else 'Appointment Kept' end) AS `app_status`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner`.`name` AS `partner_name`,`tbl_county`.`name` AS `county_name`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id` from ((((((((((((`tbl_client` join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_time` on((`tbl_time`.`id` = `tbl_client`.`txt_time`))) join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) where (`tbl_appointment`.`appntmnt_date` < curdate()) group by `tbl_appointment`.`id` order by `tbl_client`.`created_at`;

-- ----------------------------
-- View structure for tbl_client_message_report
-- ----------------------------
DROP VIEW IF EXISTS `tbl_client_message_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_client_message_report` AS select `tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_gender`.`name` AS `gender`,`tbl_groups`.`name` AS `group_name`,`tbl_marital_status`.`marital` AS `marital`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner`.`name` AS `partner_name`,`tbl_clnt_outgoing`.`created_at` AS `created_at`,date_format(`tbl_clnt_outgoing`.`created_at`,'%M %Y') AS `month_year`,`tbl_language`.`name` AS `LANGUAGE`,`tbl_time`.`name` AS `txt_time`,`tbl_message_types`.`name` AS `message_type`,`tbl_clnt_outgoing`.`msg` AS `msg`,`tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_county`.`name` AS `county_name`,`tbl_sub_county`.`name` AS `sub_county` from ((((((((((((`tbl_client` join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_time` on((`tbl_time`.`id` = `tbl_client`.`txt_time`))) join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_clnt_outgoing` on((`tbl_clnt_outgoing`.`clnt_usr_id` = `tbl_client`.`id`))) join `tbl_message_types` on((`tbl_message_types`.`id` = `tbl_clnt_outgoing`.`message_type_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) group by `tbl_client`.`id` order by `tbl_client`.`created_at`;

-- ----------------------------
-- View structure for tbl_client_raw_report
-- ----------------------------
DROP VIEW IF EXISTS `tbl_client_raw_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_client_raw_report` AS select `tbl_client`.`file_no` AS `file_no`,`tbl_groups`.`name` AS `group_name`,`tbl_groups`.`id` AS `group_id`,`tbl_language`.`name` AS `language_name`,`tbl_language`.`id` AS `language_id`,`tbl_client`.`f_name` AS `f_name`,`tbl_client`.`m_name` AS `m_name`,`tbl_client`.`l_name` AS `l_name`,`tbl_client`.`dob` AS `dob`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_client`.`status` AS `STATUS`,`tbl_client`.`partner_id` AS `partner_id`,`tbl_client`.`phone_no` AS `phone_no`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`national_id` AS `national_id`,`tbl_client`.`client_status` AS `client_status`,concat(`tbl_client`.`f_name`,`tbl_client`.`m_name`,`tbl_client`.`l_name`) AS `client_name`,`tbl_client`.`created_at` AS `created_at`,`tbl_client`.`enrollment_date` AS `enrollment_date`,`tbl_client`.`art_date` AS `art_date`,`tbl_client`.`updated_at` AS `updated_at`,`tbl_client`.`id` AS `client_id`,`tbl_gender`.`name` AS `gender_name`,`tbl_marital_status`.`marital` AS `marital`,`tbl_clinic`.`name` AS `clinic_name`,`tbl_clinic`.`id` AS `clinic_id`,`tbl_gender`.`id` AS `gender_id`,`tbl_marital_status`.`id` AS `marital_id` from (((((`tbl_client` join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_clinic` on((`tbl_clinic`.`id` = `tbl_client`.`clinic_id`))) where ((`tbl_client`.`status` = 'Active') or (`tbl_client`.`status` = 'Transfer')) order by `tbl_client`.`enrollment_date` desc;

-- ----------------------------
-- View structure for tbl_client_report
-- ----------------------------
DROP VIEW IF EXISTS `tbl_client_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_client_report` AS select `tbl_client`.`clinic_number` AS `clinic_number`,`tbl_gender`.`name` AS `gender`,`tbl_groups`.`name` AS `group_name`,`tbl_marital_status`.`marital` AS `marital`,`tbl_client`.`created_at` AS `created_at`,date_format(`tbl_client`.`created_at`,'%M %Y') AS `month_year`,`tbl_language`.`name` AS `LANGUAGE`,`tbl_time`.`name` AS `txt_time`,`tbl_client`.`enrollment_date` AS `enrollment_date`,`tbl_client`.`art_date` AS `art_date`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner`.`name` AS `partner_name`,`tbl_county`.`name` AS `county_name`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_client`.`smsenable` AS `smsenable`,`tbl_client`.`consent_date` AS `consent_date`,`tbl_client`.`motivational_enable` AS `motivational_enable`,`tbl_client`.`wellness_enable` AS `wellness_enable`,`tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id` from ((((((((((`tbl_client` join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_time` on((`tbl_time`.`id` = `tbl_client`.`txt_time`))) join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) group by `tbl_client`.`id` order by `tbl_client`.`created_at`;

-- ----------------------------
-- View structure for tbl_condition_report
-- ----------------------------
DROP VIEW IF EXISTS `tbl_condition_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_condition_report` AS select `tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_partner`.`id` AS `partner_id`,count(`tbl_client`.`id`) AS `clients`,count(distinct (case when (`tbl_client`.`smsenable` = 'Yes') then `tbl_client`.`id` end)) AS `consented`,round(((count(distinct (case when (`tbl_client`.`smsenable` = 'Yes') then `tbl_client`.`id` end)) / count(`tbl_client`.`id`)) * 100),0) AS `total_percentage`,count(distinct (case when (`tbl_client`.`client_status` = 'ART') then `tbl_client`.`id` end)) AS `art`,count(distinct (case when (`tbl_client`.`client_status` = 'On Care') then `tbl_client`.`id` end)) AS `on_care`,count(distinct (case when (`tbl_client`.`client_status` = 'Pre-ART') then `tbl_client`.`id` end)) AS `pre_art`,count(distinct (case when (`tbl_client`.`client_status` = 'No Condition') then `tbl_client`.`id` end)) AS `no_condition`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`client_status` = 'ART')) then `tbl_client`.`id` end)) AS `art_consent`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`client_status` = 'On Care')) then `tbl_client`.`id` end)) AS `on_care_consent`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`client_status` = 'Pre-ART')) then `tbl_client`.`id` end)) AS `pre_art_consent`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`client_status` = 'No Condition')) then `tbl_client`.`id` end)) AS `not_condition_consent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`client_status` = 'ART')) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`client_status` = 'ART') then `tbl_client`.`id` end))) * 100),0) AS `art_percent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`client_status` = 'On Care')) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`client_status` = 'On Care') then `tbl_client`.`id` end))) * 100),0) AS `on_care_percent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`client_status` = 'Pre-ART')) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`client_status` = 'Pre-ART') then `tbl_client`.`id` end))) * 100),0) AS `pre_art_percent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`client_status` = 'No Condition')) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`client_status` = 'No Condition') then `tbl_client`.`id` end))) * 100),0) AS `no_condition_percent` from ((((`tbl_client` join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) group by `tbl_master_facility`.`code`;

-- ----------------------------
-- View structure for tbl_gender_report
-- ----------------------------
DROP VIEW IF EXISTS `tbl_gender_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_gender_report` AS select `tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_partner`.`id` AS `partner_id`,count(`tbl_client`.`id`) AS `clients`,count(distinct (case when (`tbl_client`.`smsenable` = 'Yes') then `tbl_client`.`id` end)) AS `consented`,round(((count(distinct (case when (`tbl_client`.`smsenable` = 'Yes') then `tbl_client`.`id` end)) / count(`tbl_client`.`id`)) * 100),0) AS `total_percentage`,count(distinct (case when (`tbl_client`.`gender` = '1') then `tbl_client`.`id` end)) AS `female`,count(distinct (case when (`tbl_client`.`gender` = '2') then `tbl_client`.`id` end)) AS `male`,count(distinct (case when (`tbl_client`.`gender` = '3') then `tbl_client`.`id` end)) AS `trans_gender`,count(distinct (case when (`tbl_client`.`gender` is null) then `tbl_client`.`id` end)) AS `not_specified_gender`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`gender` = '1')) then `tbl_client`.`id` end)) AS `female_consent`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`gender` = '2')) then `tbl_client`.`id` end)) AS `male_consent`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`gender` = '3')) then `tbl_client`.`id` end)) AS `trans_gender_consent`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`gender` is null)) then `tbl_client`.`id` end)) AS `not_specified_gender_consent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`gender` = '1')) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`gender` = '1') then `tbl_client`.`id` end))) * 100),0) AS `female_percent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`gender` = '2')) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`gender` = '2') then `tbl_client`.`id` end))) * 100),0) AS `male_percent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`gender` = '3')) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`gender` = '3') then `tbl_client`.`id` end))) * 100),0) AS `trans_gender_percent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`gender` is null)) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`gender` is null) then `tbl_client`.`id` end))) * 100),0) AS `Name_exp_19` from ((((`tbl_client` join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) group by `tbl_master_facility`.`code`;

-- ----------------------------
-- View structure for tbl_main_bar_appointments_aggregate
-- ----------------------------
DROP VIEW IF EXISTS `tbl_main_bar_appointments_aggregate`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_main_bar_appointments_aggregate` AS select date_format(`c`.`created_at`,'%Y-%m') AS `MONTH`,count(distinct `c`.`id`) AS `appointments`,`tbl_client`.`partner_id` AS `partner_id`,`tbl_sub_county`.`county_id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_client`.`mfl_code` AS `mfl_code` from (((`tbl_appointment` `c` join `tbl_client` on((`tbl_client`.`id` = `c`.`client_id`))) left join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) group by date_format(`c`.`created_at`,'%Y-%m'),`tbl_client`.`mfl_code`;

-- ----------------------------
-- View structure for tbl_main_bar_clients_aggregate
-- ----------------------------
DROP VIEW IF EXISTS `tbl_main_bar_clients_aggregate`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_main_bar_clients_aggregate` AS select date_format(`c`.`created_at`,'%Y-%m') AS `MONTH`,count(distinct `c`.`id`) AS `clients`,count(distinct (case when (`c`.`smsenable` = 'Yes') then `c`.`id` end)) AS `consented`,`c`.`partner_id` AS `partner_id`,`tbl_sub_county`.`county_id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id`,`c`.`mfl_code` AS `mfl_code` from ((`tbl_client` `c` left join `tbl_master_facility` on((`tbl_master_facility`.`code` = `c`.`mfl_code`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) group by date_format(`c`.`created_at`,'%Y-%m'),`c`.`mfl_code`;

-- ----------------------------
-- View structure for tbl_mariage_distribution
-- ----------------------------
DROP VIEW IF EXISTS `tbl_mariage_distribution`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_mariage_distribution` AS select `tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_partner`.`id` AS `partner_id`,count(`tbl_client`.`id`) AS `clients`,count(distinct (case when (`tbl_client`.`smsenable` = 'Yes') then `tbl_client`.`id` end)) AS `consented`,round(((count(distinct (case when (`tbl_client`.`smsenable` = 'Yes') then `tbl_client`.`id` end)) / count(`tbl_client`.`id`)) * 100),0) AS `total_percentage`,count((case when (`tbl_client`.`marital` = 1) then `tbl_client`.`id` end)) AS `single`,count((case when (`tbl_client`.`marital` = 2) then `tbl_client`.`id` end)) AS `married_monogamous`,count((case when (`tbl_client`.`marital` = 3) then `tbl_client`.`id` end)) AS `divorced`,count((case when (`tbl_client`.`marital` = 4) then `tbl_client`.`id` end)) AS `widowed`,count((case when (`tbl_client`.`marital` = 5) then `tbl_client`.`id` end)) AS `cohabiting`,count((case when ((`tbl_client`.`marital` = 6) or (`tbl_client`.`marital` is null)) then `tbl_client`.`id` end)) AS `unavailable`,count((case when (`tbl_client`.`marital` = 8) then `tbl_client`.`id` end)) AS `maried_polygamous`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 1)) then `tbl_client`.`id` end)) AS `single_consent`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 2)) then `tbl_client`.`id` end)) AS `married_monogamous_consent`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 3)) then `tbl_client`.`id` end)) AS `divorced_consented`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 4)) then `tbl_client`.`id` end)) AS `widowed_consented`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 5)) then `tbl_client`.`id` end)) AS `cohabiting_consented`,count(distinct (case when (((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 6)) or (`tbl_client`.`marital` is null)) then `tbl_client`.`id` end)) AS `unavailable_consented`,count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 8)) then `tbl_client`.`id` end)) AS `married_polygomous_consented`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 1)) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`marital` = 1) then `tbl_client`.`id` end))) * 100),0) AS `single_percent_consent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 2)) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`marital` = 2) then `tbl_client`.`id` end))) * 100),0) AS `married_monogamous_percent_consent`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 3)) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`marital` = 3) then `tbl_client`.`id` end))) * 100),0) AS `divorced_percent_consented`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 4)) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`marital` = 4) then `tbl_client`.`id` end))) * 100),0) AS `widowed_percent_consented`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 5)) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`marital` = 5) then `tbl_client`.`id` end))) * 100),0) AS `cohabiting_percent_consented`,round(((count(distinct (case when (((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 6)) or (`tbl_client`.`marital` is null)) then `tbl_client`.`id` end)) / count((case when ((`tbl_client`.`marital` = 6) or (`tbl_client`.`marital` is null)) then `tbl_client`.`id` end))) * 100),0) AS `unavailable_percent_consented`,round(((count(distinct (case when ((`tbl_client`.`smsenable` = 'Yes') and (`tbl_client`.`marital` = 8)) then `tbl_client`.`id` end)) / count((case when (`tbl_client`.`marital` = 8) then `tbl_client`.`id` end))) * 100),0) AS `married_polygamous_percent_consented` from ((((`tbl_client` join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) group by `tbl_master_facility`.`code`;

-- ----------------------------
-- View structure for tbl_national_dashboard
-- ----------------------------
DROP VIEW IF EXISTS `tbl_national_dashboard`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_national_dashboard` AS select `tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id`,count(distinct `tbl_client`.`id`) AS `Clients`,sum(distinct `tbl_partner_facility`.`avg_clients`) AS `Target_Clients`,floor(((count(distinct `tbl_client`.`id`) * 100) / sum(distinct `tbl_partner_facility`.`avg_clients`))) AS `Percentage_Uptake`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_partner`.`id` AS `partner_id`,count(distinct (case when (`tbl_client`.`gender` = '1') then `tbl_client`.`id` end)) AS `Female`,count(distinct (case when (`tbl_client`.`gender` = '2') then `tbl_client`.`id` end)) AS `Male`,count(distinct (case when (`tbl_client`.`gender` = '3') then `tbl_client`.`id` end)) AS `Trans_Gender`,count(distinct (case when (`tbl_client`.`gender` is null) then `tbl_client`.`id` end)) AS `Not_Specified_Gender`,count(distinct (case when (`tbl_client`.`smsenable` = 'Yes') then `tbl_client`.`id` end)) AS `Consented`,count(distinct (case when (`tbl_client`.`smsenable` = 'No') then `tbl_client`.`id` end)) AS `Not_Consented`,count(distinct (case when (`tbl_client`.`smsenable` is null) then `tbl_client`.`id` end)) AS `Null_On_Consented`,count(distinct (case when ((`tbl_appointment`.`appntmnt_date` > curdate()) and (`tbl_appointment`.`active_app` = 1)) then `tbl_appointment`.`id` end)) AS `Future_Appointments` from ((((((`tbl_client` left join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) left join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) left join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) left join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) where (`tbl_partner`.`id` is not null) group by `tbl_master_facility`.`code`;

-- ----------------------------
-- View structure for tbl_trend_appointments
-- ----------------------------
DROP VIEW IF EXISTS `tbl_trend_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tbl_trend_appointments` AS select `tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_master_facility`.`code` AS `mfl_code`,count(distinct `tbl_appointment`.`id`) AS `Total_Appointments`,date_format(`tbl_appointment`.`created_at`,'%M, %Y') AS `month_year`,sum((case when ((`tbl_appointment`.`app_status` = 'Notified') and (`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`active_app` = '0')) then 1 else 0 end)) AS `Kept_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'Defaulted') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `Defaulted_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `Missed_Appointments`,sum((case when ((`tbl_appointment`.`app_status` = 'LTFU') and (`tbl_appointment`.`active_app` = '1')) then 1 else 0 end)) AS `LTFU_Appointments` from (((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) group by `tbl_master_facility`.`code`,year(`tbl_appointment`.`created_at`),month(`tbl_appointment`.`created_at`) order by `tbl_appointment`.`created_at`;

-- ----------------------------
-- View structure for todays_appointment_query
-- ----------------------------
DROP VIEW IF EXISTS `todays_appointment_query`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `todays_appointment_query` AS select `tbl_client`.`file_no` AS `file_no`,`tbl_groups`.`name` AS `group_name`,`tbl_groups`.`id` AS `group_id`,`tbl_language`.`name` AS `language_name`,`tbl_language`.`id` AS `language_id`,`tbl_client`.`f_name` AS `f_name`,`tbl_client`.`m_name` AS `m_name`,`tbl_client`.`l_name` AS `l_name`,`tbl_client`.`dob` AS `dob`,`tbl_client`.`status` AS `STATUS`,`tbl_client`.`phone_no` AS `phone_no`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`created_at` AS `created_at`,`tbl_client`.`enrollment_date` AS `enrollment_date`,`tbl_client`.`art_date` AS `art_date`,`tbl_client`.`id` AS `client_id`,`tbl_client`.`client_status` AS `client_status`,`tbl_client`.`txt_frequency` AS `txt_frequency`,`tbl_client`.`txt_time` AS `txt_time`,`tbl_client`.`alt_phone_no` AS `alt_phone_no`,`tbl_client`.`shared_no_name` AS `shared_no_name`,`tbl_client`.`smsenable` AS `smsenable`,`tbl_appointment`.`appntmnt_date` AS `appntmnt_date`,`tbl_appointment`.`app_msg` AS `app_msg`,`tbl_appointment`.`updated_at` AS `updated_at`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_other_appointment_types`.`name` AS `Other_Appointment`,`tbl_appointment`.`fnl_trcing_outocme` AS `fnl_trcing_outocme`,`tbl_appointment`.`no_calls` AS `no_calls`,`tbl_appointment`.`no_msgs` AS `no_msgs`,`tbl_appointment`.`home_visits` AS `home_visits`,`tbl_appointment`.`fnl_outcome_dte` AS `fnl_outcome_dte`,`tbl_appointment`.`id` AS `appointment_id`,`tbl_appointment_types`.`id` AS `appointment_type_id`,`tbl_appointment_types`.`name` AS `appointment_type_name` from (((((`tbl_client` join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) left join `tbl_other_appointment_types` on((`tbl_appointment`.`id` = `tbl_other_appointment_types`.`appointment_id`))) join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) where ((`tbl_client`.`status` = 'Active') and (`tbl_appointment`.`appntmnt_date` = curdate()) and (`tbl_appointment`.`active_app` = '1')) order by `tbl_appointment`.`appntmnt_date` desc;

-- ----------------------------
-- View structure for todays_appointments
-- ----------------------------
DROP VIEW IF EXISTS `todays_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `todays_appointments` AS select `tbl_client`.`clinic_id` AS `clinic_id`,`tbl_appointment`.`id` AS `appointment_id`,`tbl_client`.`clinic_number` AS `clinic_no`,concat(`tbl_client`.`f_name`,' ',`tbl_client`.`m_name`,' ',`tbl_client`.`l_name`) AS `client_name`,`tbl_appointment`.`appointment_kept` AS `appointment_kept`,`tbl_client`.`phone_no` AS `client_phone_no`,`tbl_appointment_types`.`name` AS `appointment_type`,date_format(`tbl_appointment`.`appntmnt_date`,'%d/%m/%Y') AS `appntmnt_date`,`tbl_appointment`.`created_at` AS `created_at`,`tbl_client`.`file_no` AS `file_no`,`tbl_client`.`buddy_phone_no` AS `buddy_phone_no`,`tbl_users`.`facility_id` AS `facility_id`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_users`.`phone_no` AS `user_phone_no`,`tbl_users`.`id` AS `id`,`tbl_users`.`clinic_id` AS `user_clinic` from (((((`tbl_client` join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) join `tbl_users` on((`tbl_client`.`mfl_code` = `tbl_users`.`facility_id`))) join `tbl_role` on((`tbl_role`.`id` = `tbl_users`.`role_id`))) join `tbl_clinic` on((`tbl_clinic`.`id` = `tbl_client`.`clinic_id`))) where ((cast(`tbl_appointment`.`appntmnt_date` as date) = curdate()) and (`tbl_appointment`.`active_app` = '1') and (`tbl_appointment`.`appointment_kept` is null) and (`tbl_users`.`access_level` = 'Facility') and (`tbl_client`.`status` = 'Active') and (`tbl_users`.`rcv_app_list` = 'Yes') and (not((`tbl_role`.`name` like '%Tracer%'))) and (`tbl_users`.`status` = 'Active') and (`tbl_client`.`clinic_id` = `tbl_users`.`clinic_id`)) group by `tbl_appointment`.`id`;

-- ----------------------------
-- View structure for transfer_clients
-- ----------------------------
DROP VIEW IF EXISTS `transfer_clients`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `transfer_clients` AS select 'Total No Transfers  ' AS `label`,`tbl_partner`.`id` AS `partner_id`,`tbl_partner`.`name` AS `partner`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 0) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)),`tbl_client`.`id`,0)) AS `0-9`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)),`tbl_client`.`id`,0)) AS `10-14`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)),`tbl_appointment`.`id`,0)) AS `15-19`,count(distinct if((((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)),`tbl_client`.`id`,0)) AS `20-24`,count(distinct if(((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25),`tbl_client`.`id`,0)) AS `25+` from ((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) where ((`tbl_client`.`client_type` = 'Transfer') and (cast(`tbl_appointment`.`appntmnt_date` as date) < curdate())) group by month(`tbl_client`.`updated_at`),`tbl_client`.`mfl_code` order by `tbl_client`.`clinic_number`;

-- ----------------------------
-- View structure for unscheduled_refills
-- ----------------------------
DROP VIEW IF EXISTS `unscheduled_refills`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `unscheduled_refills` AS select `tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Un-Scheduled') and (`tbl_appointment`.`app_type_1` = 'Re-Fill')) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for unscheduled_reills
-- ----------------------------
DROP VIEW IF EXISTS `unscheduled_reills`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `unscheduled_reills` AS select `tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Un-Scheduled') and (`tbl_appointment`.`app_type_1` = 'Re-Fill')) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for unscheduled_visits
-- ----------------------------
DROP VIEW IF EXISTS `unscheduled_visits`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `unscheduled_visits` AS select 'Clients with Un-scheduled visits ' AS `label`,`tbl_partner`.`name` AS `partner`,`tbl_partner`.`id` AS `partner_id`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month-year`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 10) then `tbl_appointment`.`client_id` end)) AS `0-9`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then `tbl_appointment`.`client_id` end)) AS `10-14`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then `tbl_appointment`.`client_id` end)) AS `15-19`,count(distinct (case when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then `tbl_appointment`.`client_id` end)) AS `20-24`,count(distinct (case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) then `tbl_appointment`.`client_id` end)) AS `25+`,count(distinct `tbl_appointment`.`client_id`) AS `TOTAL`,count(distinct (case when (`tbl_client`.`gender` = '1') then `tbl_client`.`id` end)) AS `Total_Female`,count(distinct (case when (`tbl_client`.`gender` = '2') then `tbl_client`.`id` end)) AS `Total_Male`,count(distinct (case when (`tbl_client`.`gender` = '3') then `tbl_client`.`id` end)) AS `Total_Transgender`,count(distinct (case when (`tbl_client`.`gender` = '5') then `tbl_client`.`id` end)) AS `Total_Not_Provided` from (((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_client`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) where (`tbl_appointment`.`date_attended` < `tbl_appointment`.`appntmnt_date`) group by year(`tbl_appointment`.`appntmnt_date`),month(`tbl_appointment`.`appntmnt_date`),`tbl_client`.`mfl_code` order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for vw_LTFU_appointments
-- ----------------------------
DROP VIEW IF EXISTS `vw_LTFU_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_LTFU_appointments` AS select `tbl_appointment`.`visit_type` AS `visit_type`,`tbl_appointment`.`unscheduled_date` AS `unscheduled_date`,count(distinct `tbl_appointment`.`id`) AS `no_appointment`,(year(curdate()) - year(`tbl_client`.`clnd_dob`)) AS `age`,(case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 1) then '< 1' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 1) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)) then '1-9 ' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then '10-14' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then '15-19' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then '20-24' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 29)) then '25-29' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 34)) then '30-34' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 39)) then '35-39' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 49)) then '40-49' when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 50) then '50 +' else ' 50 + ' end) AS `age_group`,count(distinct `tbl_appointment`.`id`) AS `lab_investigation`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county_name`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county_name`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner`.`name` AS `partner_name`,`tbl_partner_facility`.`partner_id` AS `partner_id` from ((((((((`tbl_appointment_types` join `tbl_appointment` on((`tbl_appointment`.`app_type_1` = `tbl_appointment_types`.`id`))) join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) where ((0 <> 1) and (`tbl_appointment`.`status` = 'Active') and (`tbl_client`.`status` = 'Active') and (`tbl_appointment`.`active_app` = '1') and (`tbl_appointment`.`app_status` = 'LTFU') and (cast(`tbl_appointment`.`appntmnt_date` as date) < curdate())) group by `tbl_client`.`id` order by `tbl_client`.`clinic_number`;

-- ----------------------------
-- View structure for vw_appointment_kept
-- ----------------------------
DROP VIEW IF EXISTS `vw_appointment_kept`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_appointment_kept` AS select count(distinct `tbl_appointment`.`id`) AS `appointment_kept`,(year(curdate()) - year(`tbl_client`.`clnd_dob`)) AS `age`,(case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 1) then '< 1' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 1) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)) then '1-9 ' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then '10-14' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then '15-19' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then '20-24' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 29)) then '25-29' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 34)) then '30-34' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 39)) then '35-39' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 49)) then '40-49' when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 50) then '50 +' else ' 50 + ' end) AS `age_group`,count(distinct `tbl_appointment`.`id`) AS `lab_investigation`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county_name`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county_name`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner`.`name` AS `partner_name`,`tbl_partner_facility`.`partner_id` AS `partner_id` from ((((((((`tbl_appointment_types` join `tbl_appointment` on((`tbl_appointment`.`app_type_1` = `tbl_appointment_types`.`id`))) join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) where ((0 <> 1) and (`tbl_appointment`.`status` = 'Active') and (`tbl_client`.`status` = 'Active') and (`tbl_appointment`.`appointment_kept` = 'Yes') and (`tbl_appointment`.`active_app` = '0') and (cast(`tbl_appointment`.`appntmnt_date` as date) <= curdate())) group by `tbl_appointment`.`id` order by `tbl_client`.`clinic_number`;

-- ----------------------------
-- View structure for vw_audit_trail
-- ----------------------------
DROP VIEW IF EXISTS `vw_audit_trail`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_audit_trail` AS select `tbl_sys_logs`.`user_id` AS `user_id`,`tbl_sys_logs`.`description` AS `description`,`tbl_sys_logs`.`created_at` AS `created_at`,`tbl_users`.`phone_no` AS `phone_no`,concat(`tbl_users`.`f_name`,' ',`tbl_users`.`m_name`,' ',`tbl_users`.`l_name`) AS `user_name` from (`tbl_sys_logs` join `tbl_users` on((`tbl_users`.`id` = `tbl_sys_logs`.`user_id`)));

-- ----------------------------
-- View structure for vw_client_app_report
-- ----------------------------
DROP VIEW IF EXISTS `vw_client_app_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_client_app_report` AS select `tbl_client`.`clinic_number` AS `clinic_number`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_appointment`.`active_app` AS `active_app`,`tbl_appointment`.`appntmnt_date` AS `appntmnt_date`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `app_month_year`,`tbl_appointment`.`app_status` AS `app_status`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_gender`.`name` AS `gender`,`tbl_groups`.`name` AS `group_name`,`tbl_marital_status`.`marital` AS `marital`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner`.`name` AS `partner_name`,`tbl_client`.`created_at` AS `created_at` from (((((((`tbl_client` join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) where (`tbl_appointment`.`appntmnt_date` > '1970-01-01') order by `tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for vw_client_booked
-- ----------------------------
DROP VIEW IF EXISTS `vw_client_booked`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_client_booked` AS select count(distinct `tbl_appointment`.`id`) AS `count(distinct tbl_appointment.id)`,(year(curdate()) - year(`tbl_client`.`clnd_dob`)) AS `age`,(case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 1) then '< 1' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 1) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)) then '1-9 ' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then '10-14' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then '15-19' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then '20-24' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 29)) then '25-29' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 34)) then '30-34' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 39)) then '35-39' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 49)) then '40-49' when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 50) then '50 +' else ' 50 + ' end) AS `age_group`,count(distinct `tbl_appointment`.`id`) AS `lab_investigation`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county_name`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county_name`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner`.`name` AS `partner_name`,`tbl_partner_facility`.`partner_id` AS `partner_id` from ((((((((`tbl_appointment_types` join `tbl_appointment` on((`tbl_appointment`.`app_type_1` = `tbl_appointment_types`.`id`))) join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) where ((0 <> 1) and (`tbl_appointment`.`status` = 'Active') and (`tbl_client`.`status` = 'Active')) group by `tbl_appointment`.`id` order by `tbl_client`.`clinic_number`;

-- ----------------------------
-- View structure for vw_client_county_maps
-- ----------------------------
DROP VIEW IF EXISTS `vw_client_county_maps`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_client_county_maps` AS select `tbl_county`.`id` AS `id`,`tbl_county`.`name` AS `name`,`tbl_county`.`code` AS `code`,`tbl_county`.`lat` AS `lat`,`tbl_county`.`lng` AS `lng`,concat('No of Clients ',count(`tbl_client`.`id`)) AS `no_clients`,concat('No of Appointments ',count(`tbl_appointment`.`id`)) AS `no_appointments`,'Clients' AS `Clients`,`tbl_partner_facility`.`partner_id` AS `partner_id` from (((`tbl_client` join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` <> 0))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) left join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) group by `tbl_county`.`code`;

-- ----------------------------
-- View structure for vw_client_msgs
-- ----------------------------
DROP VIEW IF EXISTS `vw_client_msgs`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_client_msgs` AS select `tbl_clnt_outgoing`.`id` AS `id`,`tbl_clnt_outgoing`.`created_at` AS `created_at`,`tbl_message_types`.`name` AS `name`,`tbl_clnt_outgoing`.`status` AS `status`,`tbl_clnt_outgoing`.`message_type_id` AS `message_type_id`,`tbl_clnt_outgoing`.`recepient_type` AS `recepient_type` from ((`tbl_clnt_outgoing` join `tbl_client` on((`tbl_client`.`id` = `tbl_clnt_outgoing`.`clnt_usr_id`))) join `tbl_message_types` on((`tbl_message_types`.`id` = `tbl_clnt_outgoing`.`message_type_id`))) where (`tbl_clnt_outgoing`.`recepient_type` = 'Client');

-- ----------------------------
-- View structure for vw_client_performance_monitor
-- ----------------------------
DROP VIEW IF EXISTS `vw_client_performance_monitor`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_client_performance_monitor` AS select `b`.`partner_id` AS `partner_id`,`c`.`unit_name` AS `unit`,`e`.`name` AS `facility`,`a`.`mfl_code` AS `mfl_code`,`b`.`unit_id` AS `unit_id`,count(distinct `a`.`id`) AS `actual_clients`,sum(distinct (case when (`b`.`avg_clients` <> 'NULL') then `b`.`avg_clients` else 0 end)) AS `target_clients` from (((`tbl_client` `a` join `tbl_partner_facility` `b`) join `tbl_unit` `c`) join `tbl_master_facility` `e`) where ((`a`.`mfl_code` = `b`.`mfl_code`) and (`c`.`id` = `b`.`unit_id`) and (`e`.`code` = `b`.`mfl_code`)) group by `a`.`mfl_code`,`b`.`mfl_code`;

-- ----------------------------
-- View structure for vw_client_report
-- ----------------------------
DROP VIEW IF EXISTS `vw_client_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_client_report` AS select `tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_gender`.`name` AS `gender`,`tbl_groups`.`name` AS `group_name`,`tbl_marital_status`.`marital` AS `marital`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner`.`name` AS `partner_name`,`tbl_client`.`created_at` AS `created_at`,date_format(`tbl_client`.`created_at`,'%M %Y') AS `month_year` from ((((((`tbl_client` join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_groups` on((`tbl_groups`.`id` = `tbl_client`.`group_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) group by `tbl_client`.`id` order by `tbl_client`.`created_at`;

-- ----------------------------
-- View structure for vw_client_summary_report
-- ----------------------------
DROP VIEW IF EXISTS `vw_client_summary_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_client_summary_report` AS select `tbl_partner`.`id` AS `partner_id`,`tbl_partner`.`name` AS `partner_name`,`tbl_unit`.`id` AS `unit_id`,`tbl_unit`.`unit_name` AS `unit`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`avg_clients` AS `avg_clients`,count(distinct `tbl_client`.`id`) AS `no_clients`,count(distinct `tbl_appointment`.`id`) AS `no_appointments`,count(distinct (case when (`tbl_client`.`smsenable` = 'Yes') then `tbl_client`.`id` end)) AS `consent_clients`,count(distinct (case when ((`tbl_appointment`.`appntmnt_date` <> '') and (`tbl_appointment`.`appntmnt_date` < curdate())) then `tbl_appointment`.`id` end)) AS `past_appointments`,count(distinct (case when ((`tbl_appointment`.`appntmnt_date` <> '') and (`tbl_appointment`.`appntmnt_date` > curdate())) then `tbl_appointment`.`id` end)) AS `future_appointments`,count(distinct (case when ((`tbl_appointment`.`appntmnt_date` <> '') and (`tbl_appointment`.`appntmnt_date` = curdate())) then `tbl_appointment`.`id` end)) AS `today_appointments`,count(distinct `tbl_clnt_outgoing`.`id`) AS `no_messages`,count(distinct (case when (`tbl_message_types`.`name` = 'Welcome') then `tbl_clnt_outgoing`.`id` end)) AS `appointment_message`,count(distinct (case when (`tbl_message_types`.`name` = 'Appointment') then `tbl_clnt_outgoing`.`id` end)) AS `welcome_message`,count(distinct (case when (`tbl_message_types`.`name` = 'Wellness') then `tbl_clnt_outgoing`.`id` end)) AS `wellness_message`,date_format(`tbl_clnt_outgoing`.`created_at`,'%M %Y') AS `msg_date`,date_format(`tbl_client`.`created_at`,'%M %Y') AS `clnt_date`,date_format(`tbl_appointment`.`created_at`,'%M %Y') AS `appnt_date`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `apntmnt_date`,`tbl_master_facility`.`lat` AS `lat`,`tbl_master_facility`.`lng` AS `lng` from (((((((`tbl_partner_facility` join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_unit` on((`tbl_unit`.`id` = `tbl_partner_facility`.`unit_id`))) left join `tbl_client` on((`tbl_client`.`mfl_code` = `tbl_partner_facility`.`mfl_code`))) left join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) left join `tbl_clnt_outgoing` on((`tbl_clnt_outgoing`.`clnt_usr_id` = `tbl_client`.`id`))) left join `tbl_message_types` on((`tbl_message_types`.`id` = `tbl_clnt_outgoing`.`message_type_id`))) group by `tbl_partner_facility`.`mfl_code` order by `tbl_partner`.`name`,`tbl_unit`.`unit_name`,`tbl_partner_facility`.`mfl_code`;

-- ----------------------------
-- View structure for vw_clinic_bkd_attended
-- ----------------------------
DROP VIEW IF EXISTS `vw_clinic_bkd_attended`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_clinic_bkd_attended` AS select `tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`appointment_kept` = 'Yes') and (`tbl_appointment`.`active_app` = '0') and (`tbl_appointment`.`app_type_1` = 'Clinical Review') and (`tbl_appointment`.`appntmnt_date` <= curdate())) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for vw_clnt_outcome
-- ----------------------------
DROP VIEW IF EXISTS `vw_clnt_outcome`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_clnt_outcome` AS select `tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`file_no` AS `file_no`,concat(`tbl_client`.`f_name`,' ',`tbl_client`.`m_name`,' ',`tbl_client`.`l_name`) AS `client_name`,group_concat(distinct `tbl_appointment`.`appntmnt_date` separator ',') AS `appntmnt_date`,`tbl_appointment`.`id` AS `appointment_id`,`tbl_client`.`id` AS `client_id`,group_concat(distinct `tbl_appointment_types`.`name` separator ',') AS `appointment_type`,`tbl_partner`.`id` AS `partner_id`,`tbl_partner`.`name` AS `partner`,`tbl_county`.`name` AS `county`,`tbl_county`.`id` AS `county_id`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_clnt_outcome`.`tracer_name` AS `tracer_name`,`tbl_outcome`.`name` AS `outcome`,`tbl_final_outcome`.`name` AS `final_outcome`,`tbl_clnt_outcome`.`tracing_date` AS `tracing_date`,`tbl_clnt_outcome`.`id` AS `clnt_outcome_id`,`tbl_final_outcome`.`id` AS `clnt_final_outcome_id`,(case when (`tbl_other_final_outcome`.`outcome` is null) then 'Empty' else `tbl_other_final_outcome`.`outcome` end) AS `other_outcome`,`tbl_clnt_outcome`.`created_at` AS `created_at`,`tbl_appointment`.`app_status` AS `app_status`,(case when (`tbl_appointment`.`date_attended` is null) then (to_days(curdate()) - to_days(`tbl_appointment`.`appntmnt_date`)) else (to_days(`tbl_appointment`.`date_attended`) - to_days(`tbl_appointment`.`appntmnt_date`)) end) AS `days_defaulted` from (((((((((((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_clnt_outcome` on((`tbl_clnt_outcome`.`appointment_id` = `tbl_appointment`.`id`))) join `tbl_outcome` on((`tbl_outcome`.`id` = `tbl_clnt_outcome`.`outcome`))) join `tbl_final_outcome` on((`tbl_final_outcome`.`id` = `tbl_clnt_outcome`.`fnl_outcome`))) join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) left join `tbl_other_final_outcome` on((`tbl_other_final_outcome`.`client_outcome_id` = `tbl_clnt_outcome`.`id`))) group by `tbl_clnt_outcome`.`id`,`tbl_appointment`.`id`,`tbl_client`.`clinic_number`;

-- ----------------------------
-- View structure for vw_consented_clients_report
-- ----------------------------
DROP VIEW IF EXISTS `vw_consented_clients_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_consented_clients_report` AS select count(`tbl_client`.`id`) AS `no_of_clients`,sum((case when (`tbl_client`.`smsenable` = 'Yes') then 1 else 0 end)) AS `no_of_consented_clients`,date_format(`tbl_client`.`created_at`,'%M %y') AS `month_year` from `tbl_client` group by year(`tbl_client`.`created_at`),month(`tbl_client`.`created_at`);

-- ----------------------------
-- View structure for vw_consented_clients_report_copy1
-- ----------------------------
DROP VIEW IF EXISTS `vw_consented_clients_report_copy1`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_consented_clients_report_copy1` AS select count(`tbl_client`.`id`) AS `no_of_clients`,sum((case when (`tbl_client`.`smsenable` = 'Yes') then 1 else 0 end)) AS `no_of_consented_clients`,date_format(`tbl_client`.`created_at`,'%M %y') AS `month_year` from `tbl_client` group by year(`tbl_client`.`created_at`),month(`tbl_client`.`created_at`);

-- ----------------------------
-- View structure for vw_county_performance
-- ----------------------------
DROP VIEW IF EXISTS `vw_county_performance`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_county_performance` AS select count(distinct `b`.`county_id`) AS `actual_counties`,count(distinct `a`.`county_id`) AS `target_counties` from (`tbl_target_county` `a` join `tbl_partner_facility` `b`);

-- ----------------------------
-- View structure for vw_defaulted_appointments
-- ----------------------------
DROP VIEW IF EXISTS `vw_defaulted_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_defaulted_appointments` AS select `tbl_appointment`.`visit_type` AS `visit_type`,`tbl_appointment`.`unscheduled_date` AS `unscheduled_date`,count(distinct `tbl_appointment`.`id`) AS `no_appointment`,(year(curdate()) - year(`tbl_client`.`clnd_dob`)) AS `age`,(case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 1) then '< 1' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 1) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)) then '1-9 ' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then '10-14' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then '15-19' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then '20-24' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 29)) then '25-29' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 34)) then '30-34' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 39)) then '35-39' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 49)) then '40-49' when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 50) then '50 +' else ' 50 + ' end) AS `age_group`,count(distinct `tbl_appointment`.`id`) AS `lab_investigation`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county_name`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county_name`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner`.`name` AS `partner_name`,`tbl_partner_facility`.`partner_id` AS `partner_id` from ((((((((`tbl_appointment_types` join `tbl_appointment` on((`tbl_appointment`.`app_type_1` = `tbl_appointment_types`.`id`))) join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) where ((0 <> 1) and (`tbl_appointment`.`status` = 'Active') and (`tbl_client`.`status` = 'Active') and (`tbl_appointment`.`active_app` = '1') and (`tbl_appointment`.`app_status` = 'Defaulted') and (cast(`tbl_appointment`.`appntmnt_date` as date) < curdate())) group by `tbl_client`.`id` order by `tbl_client`.`clinic_number`;

-- ----------------------------
-- View structure for vw_defaulter_bookings_visits
-- ----------------------------
DROP VIEW IF EXISTS `vw_defaulter_bookings_visits`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_defaulter_bookings_visits` AS select `a`.`id` AS `client_id`,concat(`a`.`f_name`,' ',`a`.`m_name`,' ',`a`.`l_name`) AS `client_name`,`a`.`clinic_number` AS `clinic_number`,`a`.`status` AS `status`,`d`.`expln_app` AS `expln_app`,`d`.`app_type_1` AS `purpose_of_visit`,`c`.`name` AS `gender`,timestampdiff(YEAR,`a`.`dob`,curdate()) AS `age`,`a`.`dob` AS `dob`,curdate() AS `today`,`b`.`appntmnt_date` AS `missed_appointment_date`,`b`.`app_type_1` AS `missed_appointment_type`,`b`.`fnl_outcome_dte` AS `fnl_outcome_dte`,`b`.`active_app` AS `active_app`,`d`.`appntmnt_date` AS `next_clinical_appointment_date`,`d`.`app_type_1` AS `next_clinical_appointment`,`a`.`mfl_code` AS `mfl_code`,`e`.`partner_id` AS `partner_id`,`e`.`county_id` AS `county_id`,`e`.`sub_county_id` AS `sub_county_id`,`a`.`stable` AS `stable` from ((((`tbl_client` `a` join `tbl_appointment` `b` on((`b`.`client_id` = `a`.`id`))) join `tbl_gender` `c` on((`c`.`id` = `a`.`gender`))) join `tbl_partner_facility` `e` on((`e`.`mfl_code` = `a`.`mfl_code`))) left join `tbl_appointment` `d` on((`d`.`client_id` = `a`.`id`))) where ((`b`.`active_app` = '0') and (`d`.`active_app` = '1') and (`d`.`appntmnt_date` > curdate()) and (`d`.`client_id` = `b`.`client_id`));

-- ----------------------------
-- View structure for vw_defaulter_bookings_vists
-- ----------------------------
DROP VIEW IF EXISTS `vw_defaulter_bookings_vists`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_defaulter_bookings_vists` AS select `a`.`id` AS `client_id`,concat(`a`.`f_name`,' ',`a`.`m_name`,' ',`a`.`l_name`) AS `client_name`,`a`.`clinic_number` AS `clinic_number`,`a`.`status` AS `status`,`d`.`expln_app` AS `expln_app`,`c`.`name` AS `gender`,timestampdiff(YEAR,`a`.`dob`,curdate()) AS `age`,`a`.`dob` AS `dob`,curdate() AS `today`,`b`.`appntmnt_date` AS `missed_appointment_date`,`b`.`app_type_1` AS `missed_appointment_type`,`b`.`fnl_outcome_dte` AS `fnl_outcome_dte`,`b`.`active_app` AS `active_app`,`d`.`appntmnt_date` AS `next_re_fill_appointment`,`d`.`app_type_1` AS `next_refill_app`,`a`.`mfl_code` AS `mfl_code`,`e`.`partner_id` AS `partner_id`,`e`.`county_id` AS `county_id`,`e`.`sub_county_id` AS `sub_county_id` from ((((`tbl_client` `a` join `tbl_appointment` `b` on((`b`.`client_id` = `a`.`id`))) join `tbl_gender` `c` on((`c`.`id` = `a`.`gender`))) join `tbl_partner_facility` `e` on((`e`.`mfl_code` = `a`.`mfl_code`))) left join `tbl_appointment` `d` on((`d`.`client_id` = `a`.`id`))) where ((`b`.`active_app` = '0') and (`d`.`active_app` = '1') and (`d`.`app_type_1` = '2') and (`d`.`appntmnt_date` > curdate()) and (`d`.`client_id` = `b`.`client_id`));

-- ----------------------------
-- View structure for vw_defaulter_tracing_details
-- ----------------------------
DROP VIEW IF EXISTS `vw_defaulter_tracing_details`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_defaulter_tracing_details` AS select `a`.`id` AS `client_id`,concat(`a`.`f_name`,' ',`a`.`m_name`,' ',`a`.`l_name`) AS `client_name`,`a`.`clinic_number` AS `clinic_number`,`c`.`name` AS `gender`,date_format(`a`.`art_date`,'%D %M %Y') AS `art_date`,timestampdiff(YEAR,`a`.`dob`,curdate()) AS `age`,date_format(`a`.`enrollment_date`,'%D %M %Y') AS `enrollment_date`,date_format(`a`.`art_date`,'%M') AS `ART_COHORT_MONTH`,date_format(`a`.`dob`,'%D %M %Y') AS `dob`,date_format(curdate(),'%D %M %Y') AS `today`,date_format(`b`.`appntmnt_date`,'%D %M %Y') AS `missed_appointment_date`,`a`.`phone_no` AS `client_phone`,`a`.`shared_no_name` AS `trtmnt_supprtr_name`,`a`.`alt_phone_no` AS `trtmnt_sprtr_phone_no`,`a`.`mfl_code` AS `mfl_code`,`d`.`county_id` AS `county_id`,`d`.`sub_county_id` AS `sub_county_id` from (((`tbl_client` `a` join `tbl_appointment` `b` on((`b`.`client_id` = `a`.`id`))) join `tbl_gender` `c` on((`c`.`id` = `a`.`gender`))) join `tbl_partner_facility` `d` on((`d`.`mfl_code` = `a`.`mfl_code`))) where ((`b`.`app_status` = 'Missed') or (`b`.`app_status` = 'Defaulted') or ((`b`.`app_status` = 'LTFU') and (`b`.`active_app` = '1')));

-- ----------------------------
-- View structure for vw_defaulter_tracing_register_clients
-- ----------------------------
DROP VIEW IF EXISTS `vw_defaulter_tracing_register_clients`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_defaulter_tracing_register_clients` AS select `tbl_client`.`id` AS `id`,`tbl_client`.`clinic_number` AS `clinic_number`,concat(`tbl_client`.`f_name`,' ',`tbl_client`.`m_name`,' ',`tbl_client`.`l_name`) AS `client_name`,(case when (`tbl_client`.`art_date` = '0000-00-00 00:00:00') then 'No' else 'Yes' end) AS `art`,`tbl_client`.`art_date` AS `art_date`,(case when (`tbl_gender`.`name` = 'Male') then 'M' when (`tbl_gender`.`name` = 'Female') then 'F' end) AS `sex`,`tbl_client`.`stable` AS `stable`,timestampdiff(YEAR,`tbl_client`.`dob`,curdate()) AS `age`,`tbl_client`.`enrollment_date` AS `enrollment_date`,date_format(`tbl_client`.`art_date`,'%M') AS `art_cohort_month`,`tbl_appointment`.`appntmnt_date` AS `date_of_missed_appointment`,`tbl_client`.`phone_no` AS `client_phone_no`,`tbl_client`.`shared_no_name` AS `treatment_supporter_name`,`tbl_client`.`alt_phone_no` AS `treatment_supporter_no`,`tbl_client`.`physical_address` AS `physical_address`,`tbl_client`.`mfl_code` AS `mfl_code` from ((`tbl_client` join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) where ((`tbl_appointment`.`appntmnt_date` < curdate()) and (`tbl_appointment`.`active_app` = '1'));

-- ----------------------------
-- View structure for vw_dfc_module
-- ----------------------------
DROP VIEW IF EXISTS `vw_dfc_module`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_dfc_module` AS select `tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`f_name` AS `f_name`,`tbl_client`.`m_name` AS `m_name`,`tbl_client`.`l_name` AS `l_name`,`tbl_gender`.`name` AS `gender`,`tbl_client`.`dob` AS `dob`,`tbl_marital_status`.`marital` AS `marital_status`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_partner`.`name` AS `partner`,`tbl_dfc_module`.`duration_less` AS `duration_less`,`tbl_dfc_module`.`duration_more` AS `duration_more`,`tbl_dfc_module`.`stability_status` AS `stability_status`,`tbl_facility_based`.`name` AS `facility_based`,`tbl_community_model`.`name` AS `community_based`,`tbl_dfc_module`.`refill_date` AS `refill_date`,`tbl_dfc_module`.`clinical_visit_date` AS `clinical_visit_date` from (((((((((((`tbl_client` join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_client`.`marital` = `tbl_marital_status`.`id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_master_facility`.`code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) join `tbl_dfc_module` on((`tbl_dfc_module`.`client_id` = `tbl_client`.`id`))) left join `tbl_facility_based` on((`tbl_facility_based`.`id` = `tbl_dfc_module`.`facility_based`))) left join `tbl_community_model` on((`tbl_community_model`.`id` = `tbl_dfc_module`.`community_based`))) join `tbl_appointment` on((`tbl_appointment`.`id` = `tbl_dfc_module`.`appointment_id`)));

-- ----------------------------
-- View structure for vw_dfc_module_ccc_numbers
-- ----------------------------
DROP VIEW IF EXISTS `vw_dfc_module_ccc_numbers`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_dfc_module_ccc_numbers` AS select `tbl_client`.`clinic_number` AS `clinic_number`,`tbl_dfc_module`.`duration_more` AS `status`,`tbl_dfc_module`.`duration_less` AS `status_two`,`tbl_dfc_module`.`stability_status` AS `stability_status`,`tbl_dfc_module`.`refill_date` AS `refill_date`,`tbl_dfc_module`.`clinical_visit_date` AS `clinical_visit_date` from (((((((((((`tbl_client` join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_client`.`marital` = `tbl_marital_status`.`id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_master_facility`.`code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) join `tbl_dfc_module` on((`tbl_dfc_module`.`client_id` = `tbl_client`.`id`))) left join `tbl_facility_based` on((`tbl_facility_based`.`id` = `tbl_dfc_module`.`facility_based`))) left join `tbl_community_model` on((`tbl_community_model`.`id` = `tbl_dfc_module`.`community_based`))) join `tbl_appointment` on((`tbl_appointment`.`id` = `tbl_dfc_module`.`appointment_id`)));

-- ----------------------------
-- View structure for vw_faces_grouped_client_report
-- ----------------------------
DROP VIEW IF EXISTS `vw_faces_grouped_client_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_faces_grouped_client_report` AS select `tbl_partner`.`name` AS `Partner`,`tbl_county`.`name` AS `County`,`tbl_sub_county`.`name` AS `Sub_County`,`tbl_master_facility`.`name` AS `Facility`,`tbl_master_facility`.`code` AS `MFL`,`tbl_client`.`clinic_number` AS `UPN`,`tbl_gender`.`name` AS `Gender`,`tbl_marital_status`.`marital` AS `Marital_Status`,`tbl_language`.`name` AS `Languages`,`tbl_client`.`phone_no` AS `Phone_NO`,`tbl_client`.`dob` AS `DoB`,group_concat(distinct `tbl_appointment`.`appntmnt_date` separator ',') AS `Appointment_Date`,group_concat(distinct `tbl_appointment_types`.`name` separator ',') AS `Appointment_Types`,group_concat((case when (`tbl_appointment`.`appointment_kept` = 'Yes') then 'Kept' else `tbl_appointment`.`app_status` end) separator ',') AS `Appointment_Status`,group_concat(`tbl_clnt_outcome`.`tracer_name` separator ',') AS `Tracer`,group_concat(`tbl_clnt_outcome`.`tracing_date` separator ',') AS `Tracing_Date`,group_concat(`tbl_outcome`.`name` separator ',') AS `Outcome`,group_concat(`tbl_final_outcome`.`name` separator ',') AS `Final_Outcome`,group_concat(`tbl_other_final_outcome`.`outcome` separator ',') AS `Other_Outcome` from ((((((((((((((`tbl_client` left join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) left join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_master_facility`.`code`))) left join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) left join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) left join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) left join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) left join `tbl_marital_status` on((`tbl_marital_status`.`id` = `tbl_client`.`marital`))) left join `tbl_language` on((`tbl_language`.`id` = `tbl_client`.`language_id`))) left join `tbl_appointment` on((`tbl_appointment`.`client_id` = `tbl_client`.`id`))) left join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `tbl_appointment`.`app_type_1`))) left join `tbl_clnt_outcome` on((`tbl_clnt_outcome`.`appointment_id` = `tbl_appointment`.`id`))) left join `tbl_outcome` on((`tbl_outcome`.`id` = `tbl_clnt_outcome`.`outcome`))) left join `tbl_final_outcome` on((`tbl_final_outcome`.`id` = `tbl_clnt_outcome`.`fnl_outcome`))) left join `tbl_other_final_outcome` on((`tbl_other_final_outcome`.`client_outcome_id` = `tbl_clnt_outcome`.`id`))) group by `tbl_client`.`clinic_number`,`tbl_appointment`.`app_type_1`,`tbl_appointment`.`appntmnt_date`;

-- ----------------------------
-- View structure for vw_facility_geo_codes
-- ----------------------------
DROP VIEW IF EXISTS `vw_facility_geo_codes`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_facility_geo_codes` AS select `tbl_master_facility`.`code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_master_facility`.`lat` AS `latitude`,`tbl_master_facility`.`lng` AS `longitude`,date_format(`tbl_partner_facility`.`created_at`,'%D %M %Y') AS `created_at`,`tbl_master_facility`.`facility_type` AS `facility_type` from (`tbl_partner_facility` join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) group by `tbl_master_facility`.`code`;

-- ----------------------------
-- View structure for vw_facility_list
-- ----------------------------
DROP VIEW IF EXISTS `vw_facility_list`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_facility_list` AS select `tbl_master_facility`.`name` AS `facility_name`,`tbl_master_facility`.`code` AS `mfl_code`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_county`.`name` AS `county`,`tbl_partner`.`name` AS `partner` from ((((`tbl_master_facility` join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_master_facility`.`code`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`)));

-- ----------------------------
-- View structure for vw_facility_performance
-- ----------------------------
DROP VIEW IF EXISTS `vw_facility_performance`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_facility_performance` AS select count(distinct `b`.`mfl_code`) AS `actual_facilities`,count(distinct `a`.`mfl_code`) AS `target_facilities` from (`tbl_target_facility` `a` join `tbl_partner_facility` `b`);

-- ----------------------------
-- View structure for vw_lab_investigation
-- ----------------------------
DROP VIEW IF EXISTS `vw_lab_investigation`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_lab_investigation` AS select `tbl_client`.`clinic_number` AS `clinic_number`,`tbl_appointment_types`.`name` AS `appointment_type`,(year(curdate()) - year(`tbl_client`.`clnd_dob`)) AS `age`,(case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 1) then '< 1' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 1) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)) then '1-9 ' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then '10-14' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then '15-19' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then '20-24' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 29)) then '25-29' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 34)) then '30-34' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 39)) then '35-39' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 49)) then '40-49' when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 50) then '50 +' else ' 50 + ' end) AS `age_group`,count(distinct `tbl_appointment`.`id`) AS `lab_investigation`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county_name`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county_name`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner`.`name` AS `partner_name`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_gender`.`id` AS `gender_id`,`tbl_gender`.`name` AS `gender` from ((((((((`tbl_appointment_types` join `tbl_appointment` on((`tbl_appointment`.`app_type_1` = `tbl_appointment_types`.`id`))) join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) where (`tbl_appointment_types`.`name` = 'Lab Investigation') group by `tbl_appointment`.`id` order by `tbl_client`.`clinic_number`;

-- ----------------------------
-- View structure for vw_missed_Refill_appointments
-- ----------------------------
DROP VIEW IF EXISTS `vw_missed_Refill_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_missed_Refill_appointments` AS select `tbl_appointment`.`app_status` AS `app_status`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`app_status` in ('Missed','Defaulted','LTFU')) and (`tbl_appointment`.`app_type_1` = '1') and (`tbl_appointment`.`appntmnt_date` <= curdate())) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for vw_missed_appointments
-- ----------------------------
DROP VIEW IF EXISTS `vw_missed_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_missed_appointments` AS select `tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`app_status` = 'Missed') and (`tbl_appointment`.`appntmnt_date` <= curdate())) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for vw_missed_clinical_appointments
-- ----------------------------
DROP VIEW IF EXISTS `vw_missed_clinical_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_missed_clinical_appointments` AS select `tbl_appointment`.`app_status` AS `app_status`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`app_status` in ('Missed','Defaulted','LTFU')) and (`tbl_appointment`.`app_type_1` = 'Clinical Review') and (`tbl_appointment`.`appntmnt_date` <= curdate())) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for vw_missed_refill_appointments
-- ----------------------------
DROP VIEW IF EXISTS `vw_missed_refill_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_missed_refill_appointments` AS select `tbl_appointment`.`app_status` AS `app_status`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`app_status` in ('Missed','Defaulted','LTFU')) and (`tbl_appointment`.`app_type_1` = '1') and (`tbl_appointment`.`appntmnt_date` <= curdate())) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for vw_pmtct
-- ----------------------------
DROP VIEW IF EXISTS `vw_pmtct`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_pmtct` AS select `tbl_client`.`clinic_number` AS `clinic_number`,`tbl_client`.`f_name` AS `f_name`,`tbl_client`.`m_name` AS `m_name`,`tbl_client`.`l_name` AS `l_name`,`tbl_gender`.`name` AS `gender`,`tbl_client`.`dob` AS `dob`,`tbl_marital_status`.`marital` AS `marital_status`,`tbl_client`.`mfl_code` AS `mfl_code`,`tbl_master_facility`.`name` AS `facility`,`tbl_county`.`name` AS `county`,`tbl_sub_county`.`name` AS `sub_county`,`tbl_partner`.`name` AS `partner`,`tbl_pmtct`.`hei_no` AS `hei_no`,`tbl_pmtct`.`hei_first_name` AS `hei_first_name`,`tbl_pmtct`.`hei_middle_name` AS `hei_middle_name`,`tbl_pmtct`.`hei_last_name` AS `hei_last_name`,`gender2`.`name` AS `hei_gender`,`tbl_pmtct`.`hei_dob` AS `hei_dob`,`tbl_pmtct`.`pcr_week6` AS `pcr_week6`,`tbl_pmtct`.`pcr_month6` AS `pcr_month6`,`tbl_pmtct`.`pcr_month12` AS `pcr_month12`,`tbl_pmtct`.`type_of_care` AS `type_of_care`,`tbl_pmtct`.`appointment_date` AS `appointment_date`,`tbl_pmtct`.`date_confirmed_positive` AS `date_confirmed_positive` from (((((((((`tbl_client` join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) join `tbl_marital_status` on((`tbl_client`.`marital` = `tbl_marital_status`.`id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_client`.`mfl_code`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_master_facility`.`code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_master_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_master_facility`.`Sub_County_ID`))) join `tbl_pmtct` on((`tbl_pmtct`.`client_id` = `tbl_client`.`id`))) left join `tbl_gender` `gender2` on((`gender2`.`id` = `tbl_pmtct`.`hei_gender`)));

-- ----------------------------
-- View structure for vw_scheduled_Refill_appointments
-- ----------------------------
DROP VIEW IF EXISTS `vw_scheduled_Refill_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_scheduled_Refill_appointments` AS select `tbl_appointment`.`app_status` AS `app_status`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`app_type_1` = '1') and (`tbl_appointment`.`active_app` = 1)) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for vw_scheduled_appointments
-- ----------------------------
DROP VIEW IF EXISTS `vw_scheduled_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_scheduled_appointments` AS select distinct `a`.`id` AS `client_id`,`a`.`clinic_number` AS `clinic_number`,concat(`a`.`f_name`,' ',`a`.`m_name`,' ',`a`.`l_name`) AS `client_name`,`a`.`status` AS `status`,`d`.`expln_app` AS `expln_app`,`c`.`name` AS `gender`,timestampdiff(YEAR,`a`.`dob`,curdate()) AS `age`,`a`.`dob` AS `dob`,curdate() AS `today`,`b`.`date_attended` AS `date_attended`,`g`.`name` AS `appointment_attended`,`b`.`active_app` AS `active_app`,`b`.`appointment_kept` AS `appointment_kept`,(case when (`d`.`appntmnt_date` > curdate()) then `d`.`appntmnt_date` else 'NONE' end) AS `next_re_fill_appointment`,`d`.`app_type_1` AS `next_refill_app`,(case when (`f`.`appntmnt_date` > curdate()) then `f`.`appntmnt_date` else 'NONE' end) AS `next_clinical_appointment`,`f`.`app_type_1` AS `next_clinical_review`,`a`.`mfl_code` AS `mfl_code`,`e`.`partner_id` AS `partner_id`,`e`.`county_id` AS `county_id`,`e`.`sub_county_id` AS `sub_county_id`,`a`.`stable` AS `stable` from ((((((`tbl_client` `a` join `tbl_appointment` `b` on((`b`.`client_id` = `a`.`id`))) join `tbl_gender` `c` on((`c`.`id` = `a`.`gender`))) join `tbl_partner_facility` `e` on((`e`.`mfl_code` = `a`.`mfl_code`))) join `tbl_appointment_types` `g` on((`g`.`id` = `b`.`app_type_1`))) left join `tbl_appointment` `d` on((`d`.`client_id` = `a`.`id`))) left join `tbl_appointment` `f` on((`f`.`client_id` = `a`.`id`))) where (((0 <> 1) and (`d`.`appntmnt_date` > curdate()) and (`f`.`appntmnt_date` > curdate()) and (`d`.`client_id` = `b`.`client_id`) and (`f`.`client_id` = `b`.`client_id`) and (`d`.`active_app` = '1') and (`f`.`active_app` = '1') and (`d`.`app_type_1` = '1')) or (`f`.`app_type_1` = '2')) group by `a`.`id`,`b`.`appntmnt_date` order by `a`.`id`;

-- ----------------------------
-- View structure for vw_scheduled_appointments1
-- ----------------------------
DROP VIEW IF EXISTS `vw_scheduled_appointments1`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_scheduled_appointments1` AS select distinct `a`.`id` AS `client_id`,`a`.`clinic_number` AS `clinic_number`,concat(`a`.`f_name`,' ',`a`.`m_name`,' ',`a`.`l_name`) AS `client_name`,`a`.`status` AS `status`,`d`.`expln_app` AS `expln_app`,`c`.`name` AS `gender`,timestampdiff(YEAR,`a`.`dob`,curdate()) AS `age`,`a`.`dob` AS `dob`,curdate() AS `today`,`b`.`date_attended` AS `date_attended`,`g`.`name` AS `appointment_attended`,`b`.`active_app` AS `active_app`,`b`.`appointment_kept` AS `appointment_kept`,(case when (`d`.`appntmnt_date` > curdate()) then `d`.`appntmnt_date` else 'NONE' end) AS `next_re_fill_appointment`,`d`.`app_type_1` AS `next_refill_app`,(case when (`f`.`appntmnt_date` > curdate()) then `f`.`appntmnt_date` else 'NONE' end) AS `next_clinical_appointment`,`f`.`app_type_1` AS `next_clinical_review`,`a`.`mfl_code` AS `mfl_code`,`e`.`partner_id` AS `partner_id`,`e`.`county_id` AS `county_id`,`e`.`sub_county_id` AS `sub_county_id`,`a`.`stable` AS `stable` from ((((((`tbl_client` `a` join `tbl_appointment` `b` on((`b`.`client_id` = `a`.`id`))) join `tbl_gender` `c` on((`c`.`id` = `a`.`gender`))) join `tbl_partner_facility` `e` on((`e`.`mfl_code` = `a`.`mfl_code`))) join `tbl_appointment_types` `g` on((`g`.`id` = `b`.`app_type_1`))) left join `tbl_appointment` `d` on((`d`.`client_id` = `a`.`id`))) left join `tbl_appointment` `f` on((`f`.`client_id` = `a`.`id`))) where (((0 <> 1) and (`d`.`appntmnt_date` > curdate()) and (`f`.`appntmnt_date` > curdate()) and (`d`.`client_id` = `b`.`client_id`) and (`f`.`client_id` = `b`.`client_id`) and (`d`.`active_app` = '1') and (`f`.`active_app` = '1') and (`d`.`app_type_1` = '1')) or (`f`.`app_type_1` = '2')) group by `a`.`id`,`b`.`appntmnt_date` order by `a`.`id`;

-- ----------------------------
-- View structure for vw_scheduled_appointments2
-- ----------------------------
DROP VIEW IF EXISTS `vw_scheduled_appointments2`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_scheduled_appointments2` AS select distinct `a`.`id` AS `client_id`,`a`.`clinic_number` AS `clinic_number`,concat(`a`.`f_name`,' ',`a`.`m_name`,' ',`a`.`l_name`) AS `client_name`,`a`.`status` AS `status`,`d`.`expln_app` AS `expln_app`,`c`.`name` AS `gender`,timestampdiff(YEAR,`a`.`dob`,curdate()) AS `age`,`a`.`dob` AS `dob`,curdate() AS `today`,`b`.`date_attended` AS `date_attended`,`g`.`name` AS `appointment_attended`,`b`.`active_app` AS `active_app`,`b`.`appointment_kept` AS `appointment_kept`,(case when (`d`.`appntmnt_date` > curdate()) then `d`.`appntmnt_date` else 'NONE' end) AS `next_re_fill_appointment`,`d`.`app_type_1` AS `next_refill_app`,(case when (`f`.`appntmnt_date` > curdate()) then `f`.`appntmnt_date` else 'NONE' end) AS `next_clinical_appointment`,`f`.`app_type_1` AS `next_clinical_review`,`a`.`mfl_code` AS `mfl_code`,`e`.`partner_id` AS `partner_id`,`e`.`county_id` AS `county_id`,`e`.`sub_county_id` AS `sub_county_id`,`a`.`stable` AS `stable` from ((((((`tbl_client` `a` join `tbl_appointment` `b` on((`b`.`client_id` = `a`.`id`))) join `tbl_gender` `c` on((`c`.`id` = `a`.`gender`))) join `tbl_partner_facility` `e` on((`e`.`mfl_code` = `a`.`mfl_code`))) join `tbl_appointment_types` `g` on((`g`.`id` = `b`.`app_type_1`))) left join `tbl_appointment` `d` on((`d`.`client_id` = `a`.`id`))) left join `tbl_appointment` `f` on((`f`.`client_id` = `a`.`id`))) where (((0 <> 1) and (`d`.`appntmnt_date` > curdate()) and (`f`.`appntmnt_date` > curdate()) and (`d`.`client_id` = `b`.`client_id`) and (`f`.`client_id` = `b`.`client_id`) and (`d`.`active_app` = '1') and (`f`.`active_app` = '1') and (`d`.`app_type_1` = '1')) or (`f`.`app_type_1` = '2')) group by `a`.`id`,`b`.`appntmnt_date` order by `a`.`id`;

-- ----------------------------
-- View structure for vw_scheduled_refill_appointments
-- ----------------------------
DROP VIEW IF EXISTS `vw_scheduled_refill_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_scheduled_refill_appointments` AS select `tbl_appointment`.`app_status` AS `app_status`,`tbl_appointment`.`app_type_1` AS `app_type_1`,`tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`app_type_1` = '1') and (`tbl_appointment`.`active_app` = 1)) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for vw_scheduled_visits_attended
-- ----------------------------
DROP VIEW IF EXISTS `vw_scheduled_visits_attended`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_scheduled_visits_attended` AS select `tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Scheduled') and (`tbl_appointment`.`appointment_kept` = 'Yes') and (`tbl_appointment`.`active_app` = '0') and (`tbl_appointment`.`appntmnt_date` <= curdate())) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for vw_system_appointment_analysis
-- ----------------------------
DROP VIEW IF EXISTS `vw_system_appointment_analysis`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_system_appointment_analysis` AS select count(`tbl_appointment`.`id`) AS `total_no_of_appointments`,sum((case when ((`tbl_appointment`.`active_app` = '0') and (`tbl_appointment`.`appointment_kept` = 'Yes') and (`tbl_appointment`.`appntmnt_date` < curdate())) then 1 else 0 end)) AS `honored_appointments`,sum((case when ((`tbl_appointment`.`active_app` = '0') and (`tbl_appointment`.`appointment_kept` = 'No') and (`tbl_appointment`.`appntmnt_date` < curdate())) then 1 else 0 end)) AS `un_honored_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `month_year` from `tbl_appointment` group by year(`tbl_appointment`.`appntmnt_date`),month(`tbl_appointment`.`appntmnt_date`);

-- ----------------------------
-- View structure for vw_system_message_analysis
-- ----------------------------
DROP VIEW IF EXISTS `vw_system_message_analysis`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_system_message_analysis` AS select count(`tbl_clnt_outgoing`.`id`) AS `no_of_msges`,sum((case when ((`tbl_clnt_outgoing`.`recepient_type` = 'User') and (`tbl_clnt_outgoing`.`status` = 'Sent')) then 1 else 0 end)) AS `no_user_msgs`,sum((case when ((`tbl_clnt_outgoing`.`recepient_type` = 'Client') and (`tbl_clnt_outgoing`.`status` = 'Sent')) then 1 else 0 end)) AS `no_client_msgs`,sum((case when ((`tbl_clnt_outgoing`.`message_type_id` = 1) and (`tbl_clnt_outgoing`.`status` = 'Sent')) then 1 else 0 end)) AS `no_appointment_msgs`,sum((case when ((`tbl_clnt_outgoing`.`message_type_id` = 2) and (`tbl_clnt_outgoing`.`status` = 'Sent')) then 1 else 0 end)) AS `no_informative_msgs`,sum((case when ((`tbl_clnt_outgoing`.`message_type_id` = 3) and (`tbl_clnt_outgoing`.`status` = 'Sent')) then 1 else 0 end)) AS `no_welcome_msgs`,sum((case when ((`tbl_clnt_outgoing`.`message_type_id` = 4) and (`tbl_clnt_outgoing`.`status` = 'Sent')) then 1 else 0 end)) AS `no_motivational_msgs`,sum((case when ((`tbl_clnt_outgoing`.`message_type_id` = 5) and (`tbl_clnt_outgoing`.`status` = 'Sent')) then 1 else 0 end)) AS `no_other_msgs`,sum((case when ((`tbl_clnt_outgoing`.`message_type_id` = 6) and (`tbl_clnt_outgoing`.`status` = 'Sent')) then 1 else 0 end)) AS `no_stop_msgs`,sum((case when (`tbl_clnt_outgoing`.`status` = 'Sent') then 1 else 0 end)) AS `no_sent_msgs`,sum((case when (`tbl_clnt_outgoing`.`status` = 'Not Sent') then 1 else 0 end)) AS `no_not_sent_msgs`,date_format(`tbl_clnt_outgoing`.`created_at`,'%M %y') AS `month_year` from `tbl_clnt_outgoing` group by year(`tbl_clnt_outgoing`.`created_at`),month(`tbl_clnt_outgoing`.`created_at`);

-- ----------------------------
-- View structure for vw_tableau_data
-- ----------------------------
DROP VIEW IF EXISTS `vw_tableau_data`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_tableau_data` AS select (case when (`tbl_partner_facility`.`avg_clients` is null) then '0' else `tbl_partner_facility`.`avg_clients` end) AS `no_current_active_clients`,`cl`.`id` AS `client_key`,trim(`cl`.`clinic_number`) AS `clinic_number`,concat(upper(substr(concat(trim(`cl`.`f_name`)),1,1)),lower(substr(concat(trim(`cl`.`f_name`)),2))) AS `first_name`,concat(upper(substr(concat(trim(`cl`.`m_name`)),1,1)),lower(substr(concat(trim(`cl`.`m_name`)),2))) AS `middle_name`,concat(upper(substr(concat(trim(`cl`.`l_name`)),1,1)),lower(substr(concat(trim(`cl`.`l_name`)),2))) AS `last_name`,(case when (`cl`.`phone_no` is null) then 'No Phone Number' else `cl`.`phone_no` end) AS `mobile_no`,(case when (`cl`.`dob` is null) then NULL else `cl`.`dob` end) AS `dob`,`cl`.`enrollment_date` AS `enrollment_date`,(case when (`g`.`name` is null) then 'No Gender' else concat(upper(substr(concat(trim(`g`.`name`)),1,1)),lower(substr(concat(trim(`g`.`name`)),2))) end) AS `gender`,timestampdiff(YEAR,`cl`.`dob`,curdate()) AS `age`,(case when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '0' and '4') then '0-4' when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '5' and '9') then '5-9' when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '10' and '14') then '10-14' when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '15' and '19') then '15-19' when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '20' and '24') then '20-24' when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '25' and '29') then '25-29' when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '30' and '34') then '30-34' when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '35' and '39') then '35-39' when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '40' and '44') then '40-44' when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '45' and '49') then '45-49' when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '50' and '54') then '50-54' when (timestampdiff(YEAR,`cl`.`dob`,curdate()) between '55' and '59') then '55-59' else '60 +' end) AS `age_bracket`,`gp`.`name` AS `client_group_name`,`lg`.`name` AS `client_language`,`cl`.`client_status` AS `client_status`,`cl`.`txt_frequency` AS `txt_frequency`,`cl`.`txt_time` AS `txt_time`,`tbl_time`.`name` AS `text_time`,`cl`.`smsenable` AS `smsenable`,`cl`.`mfl_code` AS `mfl_code`,`cl`.`marital` AS `marital`,`tbl_marital_status`.`marital` AS `marital_status`,`cl`.`wellness_enable` AS `wellness_enable`,`cl`.`motivational_enable` AS `motivational_enable`,`cl`.`client_type` AS `client_type`,`cl`.`prev_clinic` AS `prev_clinic`,`cl`.`transfer_date` AS `transfer_date`,`cl`.`entry_point` AS `entry_point`,`cl`.`welcome_sent` AS `welcome_sent`,`cl`.`consent_date` AS `consent_date`,`cl`.`stable` AS `stable`,`cl`.`physical_address` AS `physical_address`,`cl`.`partner_id` AS `partner_id`,`cl`.`status` AS `STATUS`,`prt`.`name` AS `partner_name`,`cnty`.`id` AS `county_id`,`cnty`.`name` AS `county`,`sb_cnty`.`id` AS `sb_cnty_id`,`sb_cnty`.`name` AS `sb_cnty`,`cl`.`created_by` AS `created_by`,`cl`.`updated_by` AS `updated_by`,`cl`.`art_date` AS `art_date`,`cl`.`created_at` AS `created_at`,`cl`.`updated_at` AS `updated_at`,`apt`.`id` AS `appntmnt_id`,`apt`.`appntmnt_date` AS `appntmnt_date`,(case when ((`tbl_appointment_types`.`name` = 'Clinical Review') or (`tbl_appointment_types`.`name` = 'Clinical-Review') or (`tbl_appointment_types`.`name` = 'CLINICAL')) then 'Clinical Review' when (`tbl_appointment_types`.`name` = ' ') then 'Not Defined' else `tbl_appointment_types`.`name` end) AS `appointment_type`,(case when (`apt`.`app_type_1` is null) then 'NONE' else `apt`.`app_type_1` end) AS `appointment_type_id`,(case when ((`apt`.`appntmnt_date` <> '') and (`apt`.`appntmnt_date` < curdate())) then 'Past Appointment' when ((`apt`.`appntmnt_date` <> '') and (`apt`.`appntmnt_date` = curdate()) and (`apt`.`active_app` = '1')) then 'Today Appointment' when ((`apt`.`appntmnt_date` <> '') and (`apt`.`appntmnt_date` > curdate()) and (`apt`.`active_app` = '1')) then 'Future Appointment' end) AS `appointment_status`,(case when ((`apt`.`appointment_kept` = 'Yes') and (`apt`.`appntmnt_date` < curdate())) then 'Appointment Kept' when ((`apt`.`appointment_kept` = 'No') and (`apt`.`appntmnt_date` < curdate())) then 'Appointment Not Kept' when (`apt`.`appointment_kept` is null) then 'Appointment Open' end) AS `appointment_open_status`,`apt`.`created_at` AS `apt_created_at`,`apt`.`updated_at` AS `apt_updated_at`,`apt`.`app_status` AS `app_status`,`apt`.`created_by` AS `apt_created_by`,`apt`.`updated_by` AS `apt_updated_by`,(case when (`apt`.`entry_point` is null) then 'Not Defined' else `apt`.`entry_point` end) AS `apt_entry_point`,`apt`.`active_app` AS `active_app`,`apt`.`no_calls` AS `no_calls`,`apt`.`home_visits` AS `home_visits`,`clnt_outgoing`.`destination` AS `destination`,`clnt_outgoing`.`source` AS `source`,`clnt_outgoing`.`msg` AS `msg`,`clnt_outgoing`.`created_at` AS `outgoing_created_at`,`clnt_outgoing`.`updated_at` AS `outgoing_updated_at`,`clnt_outgoing`.`status` AS `clnt_outgoing_status`,`clnt_outgoing`.`message_type_id` AS `message_type_id`,`tbl_message_types`.`name` AS `message_type`,`clnt_outgoing`.`id` AS `outgoing_id` from (((((((((((((((`tbl_county` `cnty` join `tbl_sub_county` `sb_cnty` on((`sb_cnty`.`county_id` = `cnty`.`id`))) join `tbl_master_facility` on((`tbl_master_facility`.`Sub_County_ID` = `sb_cnty`.`id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_master_facility`.`code`))) join `tbl_partner` `prt` on((`prt`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_client` `cl` on((`cl`.`mfl_code` = `tbl_master_facility`.`code`))) join `tbl_gender` on((`tbl_gender`.`id` = `cl`.`gender`))) join `tbl_marital_status` on((`tbl_marital_status`.`id` = `cl`.`marital`))) left join `tbl_time` on((`tbl_time`.`id` = `cl`.`txt_time`))) left join `tbl_groups` `gp` on((`cl`.`group_id` = `gp`.`id`))) left join `tbl_language` `lg` on((`cl`.`language_id` = `lg`.`id`))) left join `tbl_gender` `g` on((`cl`.`gender` = `g`.`id`))) left join `tbl_appointment` `apt` on((`apt`.`client_id` = `cl`.`id`))) left join `tbl_appointment_types` on((`tbl_appointment_types`.`id` = `apt`.`app_type_1`))) left join `tbl_clnt_outgoing` `clnt_outgoing` on((`clnt_outgoing`.`clnt_usr_id` = `cl`.`id`))) join `tbl_message_types` on((`tbl_message_types`.`id` = `clnt_outgoing`.`message_type_id`))) where (year(`apt`.`appntmnt_date`) >= '2017');

-- ----------------------------
-- View structure for vw_unscheduled_appointments
-- ----------------------------
DROP VIEW IF EXISTS `vw_unscheduled_appointments`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_unscheduled_appointments` AS select `tbl_appointment`.`visit_type` AS `visit_type`,`tbl_appointment`.`unscheduled_date` AS `unscheduled_date`,count(distinct `tbl_appointment`.`id`) AS `no_appointment`,(year(curdate()) - year(`tbl_client`.`clnd_dob`)) AS `age`,(case when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) < 1) then '< 1' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 1) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 9)) then '1-9 ' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 14)) then '10-14' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 19)) then '15-19' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 24)) then '20-24' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 29)) then '25-29' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 34)) then '30-34' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 39)) then '35-39' when (((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) <= 49)) then '40-49' when ((year(curdate()) - year(`tbl_client`.`clnd_dob`)) >= 50) then '50 +' else ' 50 + ' end) AS `age_group`,count(distinct `tbl_appointment`.`id`) AS `lab_investigation`,`tbl_county`.`id` AS `county_id`,`tbl_county`.`name` AS `county_name`,`tbl_sub_county`.`id` AS `sub_county_id`,`tbl_sub_county`.`name` AS `sub_county_name`,`tbl_master_facility`.`name` AS `facility_name`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner`.`name` AS `partner_name`,`tbl_partner_facility`.`partner_id` AS `partner_id` from ((((((((`tbl_appointment_types` join `tbl_appointment` on((`tbl_appointment`.`app_type_1` = `tbl_appointment_types`.`id`))) join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_partner_facility`.`partner_id`))) join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_partner_facility`.`mfl_code`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_partner_facility`.`county_id`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_partner_facility`.`sub_county_id`))) join `tbl_gender` on((`tbl_gender`.`id` = `tbl_client`.`gender`))) where ((0 <> 1) and (`tbl_appointment`.`status` = 'Active') and (`tbl_client`.`status` = 'Active') and (`tbl_appointment`.`appointment_kept` = 'Yes') and (`tbl_appointment`.`active_app` = '0') and (`tbl_appointment`.`visit_type` = 'Un-Scheduled')) group by `tbl_appointment`.`id` order by `tbl_client`.`clinic_number`;

-- ----------------------------
-- View structure for vw_unscheduled_refills
-- ----------------------------
DROP VIEW IF EXISTS `vw_unscheduled_refills`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_unscheduled_refills` AS select `tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Un-Scheduled') and (`tbl_appointment`.`app_type_1` = 'Re-Fill')) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for vw_unscheduled_vists
-- ----------------------------
DROP VIEW IF EXISTS `vw_unscheduled_vists`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_unscheduled_vists` AS select `tbl_partner_facility`.`partner_id` AS `partner_id`,`tbl_partner_facility`.`mfl_code` AS `mfl_code`,`tbl_partner_facility`.`county_id` AS `county_id`,`tbl_partner_facility`.`sub_county_id` AS `sub_county_id`,count(`tbl_appointment`.`id`) AS `no_of_appointments`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y') AS `appointment_month` from ((`tbl_appointment` join `tbl_client` on((`tbl_client`.`id` = `tbl_appointment`.`client_id`))) join `tbl_partner_facility` on((`tbl_partner_facility`.`mfl_code` = `tbl_client`.`mfl_code`))) where ((`tbl_appointment`.`visit_type` = 'Un-Scheduled') and (`tbl_appointment`.`appntmnt_date` <= curdate())) group by `tbl_partner_facility`.`mfl_code`,date_format(`tbl_appointment`.`appntmnt_date`,'%M %Y');

-- ----------------------------
-- View structure for vw_user_access_report
-- ----------------------------
DROP VIEW IF EXISTS `vw_user_access_report`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_user_access_report` AS select concat(`tbl_users`.`f_name`,' ',`tbl_users`.`m_name`,' ',`tbl_users`.`l_name`) AS `user_name`,`tbl_users`.`dob` AS `dob`,`tbl_users`.`phone_no` AS `phone_no`,`tbl_users`.`e_mail` AS `e_mail`,`tbl_users`.`access_level` AS `access_level`,'Administrator' AS `Administrator`,`tbl_users`.`id` AS `mapping_id` from (`tbl_users` join `tbl_role` on((`tbl_role`.`access_level` = `tbl_users`.`access_level`))) where (`tbl_users`.`access_level` = 'Admin') group by `tbl_users`.`id` union select concat(`tbl_users`.`f_name`,' ',`tbl_users`.`m_name`,' ',`tbl_users`.`l_name`) AS `user_name`,`tbl_users`.`dob` AS `dob`,`tbl_users`.`phone_no` AS `phone_no`,`tbl_users`.`e_mail` AS `e_mail`,`tbl_users`.`access_level` AS `access_level`,`tbl_partner`.`name` AS `name`,`tbl_partner`.`id` AS `mapping_id` from ((`tbl_users` join `tbl_role` on((`tbl_role`.`access_level` = `tbl_users`.`access_level`))) join `tbl_partner` on((`tbl_partner`.`id` = `tbl_users`.`partner_id`))) where (`tbl_users`.`access_level` = 'Partner') group by `tbl_users`.`id` union select concat(`tbl_users`.`f_name`,' ',`tbl_users`.`m_name`,' ',`tbl_users`.`l_name`) AS `user_name`,`tbl_users`.`dob` AS `dob`,`tbl_users`.`phone_no` AS `phone_no`,`tbl_users`.`e_mail` AS `e_mail`,`tbl_users`.`access_level` AS `access_level`,`tbl_county`.`name` AS `name`,`tbl_county`.`id` AS `mapping_id` from ((`tbl_users` join `tbl_role` on((`tbl_role`.`access_level` = `tbl_users`.`access_level`))) join `tbl_county` on((`tbl_county`.`id` = `tbl_users`.`county_id`))) where (`tbl_users`.`access_level` = 'County') group by `tbl_users`.`id` union select concat(`tbl_users`.`f_name`,' ',`tbl_users`.`m_name`,' ',`tbl_users`.`l_name`) AS `user_name`,`tbl_users`.`dob` AS `dob`,`tbl_users`.`phone_no` AS `phone_no`,`tbl_users`.`e_mail` AS `e_mail`,`tbl_users`.`access_level` AS `access_level`,`tbl_sub_county`.`name` AS `name`,`tbl_sub_county`.`id` AS `sub_county_id` from ((`tbl_users` join `tbl_role` on((`tbl_role`.`access_level` = `tbl_users`.`access_level`))) join `tbl_sub_county` on((`tbl_sub_county`.`id` = `tbl_users`.`subcounty_id`))) where (`tbl_users`.`access_level` = 'Sub County') group by `tbl_users`.`id` union select concat(`tbl_users`.`f_name`,' ',`tbl_users`.`m_name`,' ',`tbl_users`.`l_name`) AS `user_name`,`tbl_users`.`dob` AS `dob`,`tbl_users`.`phone_no` AS `phone_no`,`tbl_users`.`e_mail` AS `e_mail`,`tbl_users`.`access_level` AS `access_level`,`tbl_master_facility`.`name` AS `name`,`tbl_master_facility`.`code` AS `mapping_id` from ((`tbl_users` join `tbl_master_facility` on((`tbl_master_facility`.`code` = `tbl_users`.`facility_id`))) join `tbl_role` on((`tbl_role`.`access_level` = `tbl_users`.`access_level`))) where (`tbl_users`.`access_level` = 'Facility') group by `tbl_users`.`id`;

-- ----------------------------
-- View structure for vw_user_msgs
-- ----------------------------
DROP VIEW IF EXISTS `vw_user_msgs`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_user_msgs` AS select `tbl_usr_outgoing`.`id` AS `id`,`tbl_usr_outgoing`.`created_at` AS `created_at`,`tbl_message_types`.`name` AS `name`,`tbl_usr_outgoing`.`status` AS `status`,`tbl_usr_outgoing`.`message_type_id` AS `message_type_id`,`tbl_usr_outgoing`.`recepient_type` AS `recepient_type`,date_format(`tbl_usr_outgoing`.`created_at`,'%M %Y') AS `month_year` from (`tbl_usr_outgoing` join `tbl_message_types` on((`tbl_message_types`.`id` = `tbl_usr_outgoing`.`message_type_id`))) where (`tbl_usr_outgoing`.`recepient_type` = 'User');

SET FOREIGN_KEY_CHECKS = 1;

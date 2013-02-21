SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `wvd_block`;
CREATE TABLE IF NOT EXISTS `wvd_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind_wvd_block_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

DROP TABLE IF EXISTS `wvd_feature`;
CREATE TABLE IF NOT EXISTS `wvd_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'property',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind_wvd_feature_name` (`name`),
  KEY `ind_wvd_feature_type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=66 ;

DROP TABLE IF EXISTS `wvd_history`;
CREATE TABLE IF NOT EXISTS `wvd_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_date` date NOT NULL,
  `to_date` date DEFAULT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `weekly_rate` float NOT NULL,
  `text` text,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wvd_history_FK_room_id` (`room_id`),
  KEY `wvd_history_FK_tenant_id` (`tenant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

DROP TABLE IF EXISTS `wvd_property`;
CREATE TABLE IF NOT EXISTS `wvd_property` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `landlord_id` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT '',
  `block_id` int(11) DEFAULT NULL,
  `rooms_number` int(3) NOT NULL DEFAULT '0',
  `rooms_vacant` text NOT NULL,
  `tenants_currently_in` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wvd_property_FK_landlord_id` (`landlord_id`),
  KEY `ind_wvd_property_block_id` (`block_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

DROP TABLE IF EXISTS `wvd_property_feature`;
CREATE TABLE IF NOT EXISTS `wvd_property_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) unsigned NOT NULL,
  `feature_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind_wvd_property_feature` (`property_id`,`feature_id`),
  KEY `wvd_property_feature_FK_feature_id` (`feature_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=165 ;

DROP TABLE IF EXISTS `wvd_room`;
CREATE TABLE IF NOT EXISTS `wvd_room` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int(10) unsigned NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `size` int(2) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `weekly_rate` float NOT NULL,
  `revenue` float NOT NULL DEFAULT '0',
  `status` enum('A','O','U') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind_wvd_room` (`property_id`,`name`),
  KEY `key_wvd_room_property_id` (`property_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

DROP TABLE IF EXISTS `wvd_room_feature`;
CREATE TABLE IF NOT EXISTS `wvd_room_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(10) unsigned NOT NULL,
  `feature_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind_wvd_room_feature` (`room_id`,`feature_id`),
  KEY `wvd_room_feature_FK_feature_id` (`feature_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

DROP TABLE IF EXISTS `wvd_room_photo`;
CREATE TABLE IF NOT EXISTS `wvd_room_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(10) unsigned NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind_wvd_room_photo` (`room_id`,`photo`),
  KEY `ind_wvd_room_photo_room_id` (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

DROP TABLE IF EXISTS `wvd_tenant_guarantor`;
CREATE TABLE IF NOT EXISTS `wvd_tenant_guarantor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenant_id` int(11) NOT NULL,
  `guarantor_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind_wvd_tenant_guarantor` (`tenant_id`,`guarantor_id`),
  KEY `wvd_tenant_guarantor_FK_guarantor_id` (`guarantor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

DROP TABLE IF EXISTS `wvd_user`;
CREATE TABLE IF NOT EXISTS `wvd_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `copy_dln` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `copy_passport` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dln` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind_wvd_user_username` (`username`),
  UNIQUE KEY `ind_wvd_user_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

DROP TABLE IF EXISTS `wvd_user_notes`;
CREATE TABLE IF NOT EXISTS `wvd_user_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ind_wvd_user_notes_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;


ALTER TABLE `wvd_history`
  ADD CONSTRAINT `wvd_history_FK_room_id` FOREIGN KEY (`room_id`) REFERENCES `wvd_room` (`id`),
  ADD CONSTRAINT `wvd_history_FK_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `wvd_user` (`id`);

ALTER TABLE `wvd_property`
  ADD CONSTRAINT `wvd_property_FK_block_id` FOREIGN KEY (`block_id`) REFERENCES `wvd_block` (`id`),
  ADD CONSTRAINT `wvd_property_FK_landlord_id` FOREIGN KEY (`landlord_id`) REFERENCES `wvd_user` (`id`);

ALTER TABLE `wvd_property_feature`
  ADD CONSTRAINT `wvd_property_feature_FK_feature_id` FOREIGN KEY (`feature_id`) REFERENCES `wvd_feature` (`id`);

ALTER TABLE `wvd_room`
  ADD CONSTRAINT `wvd_room_FK_property_id` FOREIGN KEY (`property_id`) REFERENCES `wvd_property` (`id`);

ALTER TABLE `wvd_room_feature`
  ADD CONSTRAINT `wvd_room_feature_FK_feature_id` FOREIGN KEY (`feature_id`) REFERENCES `wvd_feature` (`id`),
  ADD CONSTRAINT `wvd_room_feature_FK_room_id` FOREIGN KEY (`room_id`) REFERENCES `wvd_room` (`id`);

ALTER TABLE `wvd_room_photo`
  ADD CONSTRAINT `wvd_room_photo_FK_room_id` FOREIGN KEY (`room_id`) REFERENCES `wvd_room` (`id`);

ALTER TABLE `wvd_tenant_guarantor`
  ADD CONSTRAINT `wvd_tenant_guarantor_FK_guarantor_id` FOREIGN KEY (`guarantor_id`) REFERENCES `wvd_user` (`id`),
  ADD CONSTRAINT `wvd_tenant_guarantor_FK_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `wvd_user` (`id`);

ALTER TABLE `wvd_user_notes`
  ADD CONSTRAINT `wvd_user_notes_FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `wvd_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

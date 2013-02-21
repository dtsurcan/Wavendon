-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 26 2012 г., 07:10
-- Версия сервера: 5.1.56
-- Версия PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `wavendon_props`
--

-- --------------------------------------------------------

--
-- Структура таблицы `wvd_block`
--

DROP TABLE IF EXISTS `wvd_block`;
CREATE TABLE IF NOT EXISTS `wvd_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind_wvd_block_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `wvd_block`
--

INSERT INTO `wvd_block` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Block # 1', 'Block # 1 description...', '2012-02-12 12:11:08'),
(2, 'Block # 2', 'Block # 2 description...', '2012-04-15 10:01:06'),
(3, 'Block # 3', 'Block # 3 description...', '2012-04-15 09:10:48'),
(4, 'Block # 4', 'Block # 4 description...\n1111111', '2012-02-12 12:11:08'),
(6, 'Block # 6', '111111\n2222\n333', '2012-12-22 12:13:50'),
(7, 'Block # 5', '55555\n555555\n777778888888', '2012-12-22 12:17:58');

-- --------------------------------------------------------

--
-- Структура таблицы `wvd_feature`
--

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

--
-- Дамп данных таблицы `wvd_feature`
--

INSERT INTO `wvd_feature` (`id`, `name`, `type`, `created_at`) VALUES
(1, 'Fireplace', 'property', '2012-02-12 12:11:08'),
(2, 'Shower', 'room', '2012-04-15 10:01:06'),
(3, 'Bath', 'property', '2012-04-15 09:10:48'),
(4, 'Subway Station near with home', 'property', '2012-02-12 12:11:08'),
(37, 'No dogs or cats', 'room', '2012-11-30 07:13:46'),
(55, 'See by window', 'property', '2012-12-04 12:04:16'),
(56, 'Garden in neibourhood', 'property', '2012-12-07 11:33:56'),
(57, 'Beach of Sea ', 'property', '2012-12-11 12:28:18'),
(58, 'Bus Station near with home', 'property', '2012-12-18 05:23:08'),
(63, 'near with Factory', 'room', '2012-12-20 12:05:58'),
(64, 'balcony', 'property', '2012-12-20 12:11:23'),
(65, 'Near with city', 'property', '2012-12-20 12:12:30');

-- --------------------------------------------------------

--
-- Структура таблицы `wvd_history`
--

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

--
-- Дамп данных таблицы `wvd_history`
--

INSERT INTO `wvd_history` (`id`, `from_date`, `to_date`, `room_id`, `tenant_id`, `weekly_rate`, `text`, `created_at`) VALUES
(2, '2010-03-16', '2011-12-22', 6, 6, 240, 'history text # 2', '2011-12-22 00:00:00'),
(3, '2010-10-16', '2012-01-21', 5, 7, 250, 'history text # 3', '2012-01-21 00:00:00'),
(4, '2011-12-22', NULL, 6, 6, 240, 'history text # 4', '2012-09-23 00:00:00'),
(5, '2012-01-21', NULL, 5, 6, 250, 'history text # 5', '2012-01-21 00:00:00'),
(11, '2010-02-16', '2011-10-31', 3, 1, 220, 'history text # 1', '2011-10-31 00:00:00'),
(12, '2010-03-16', '2011-12-22', 6, 6, 240, 'history text # 2', '2011-12-22 00:00:00'),
(13, '2010-10-16', '2012-01-21', 6, 7, 250, 'history text # 3', '2012-01-21 00:00:00'),
(14, '2011-12-22', NULL, 3, 6, 240, 'history text # 4', '2012-09-23 00:00:00'),
(15, '2012-01-21', NULL, 5, 7, 250, 'history text # 5', '2012-01-21 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `wvd_property`
--

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

--
-- Дамп данных таблицы `wvd_property`
--

INSERT INTO `wvd_property` (`id`, `landlord_id`, `address`, `type`, `block_id`, `rooms_number`, `rooms_vacant`, `tenants_currently_in`, `created_at`) VALUES
(4, 4, 'Brampton, Kambriya CA8 &YAU # 4', 'house', 2, 4599, '1111\n22222211111\n33333', 8999, '2012-04-15 10:01:06'),
(7, 4, 'Brampton, Kambriya CA8 56U, UK # 7', 'flat', 3, 12, '1111\n22222222\n3333\n444\n1111111\n111', 0, '2012-04-15 09:10:48'),
(8, 5, 'Brampton, Kambriya CA8 56U, UK # 8', 'flat', 1, 1, '1  fc\nasdfsd\n  \n11111', 0, '2012-02-12 12:11:08'),
(9, 4, 'Brampton, Kambriya CA8 23AU, UK # 9', 'house', 1, 13, '1 rooms vavcant  \nh\njjjj\nkkkkkkk      r\nqqqqqq\nwwwwww\neeeeeeeee\nrrrrrrrr\n\n\n', 0, '2012-02-12 12:11:08'),
(19, 8, 'adress 19', 'house', 2, 88, '8888\n999999999\n000000000000000000', 88, '2012-12-07 13:26:51'),
(20, 5, 'adress 20', 'house', 1, 5, 'dcv\ndfgvdk,l;k\ngdfg\ndfsgfd\nuuuuuuuu', 43, '2012-12-09 05:55:04'),
(21, 5, 'adress 21', 'house', 2, 2, '333\n4444444\n5555\n88888\n9999', 3, '2012-12-09 06:04:09'),
(22, 4, 'adress 22', 'house', 3, 2, '2\n333\n44444------', 44, '2012-12-09 07:03:41'),
(23, 5, 'adress 23', 'house', 4, 6, 'y6', 6, '2012-12-11 13:25:21'),
(24, 5, 'adress 24', 'house', 7, 4, 'wwwwwwww\n111\n222222', 3, '2012-12-22 11:17:51');

-- --------------------------------------------------------

--
-- Структура таблицы `wvd_property_feature`
--

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

--
-- Дамп данных таблицы `wvd_property_feature`
--

INSERT INTO `wvd_property_feature` (`id`, `property_id`, `feature_id`, `created_at`) VALUES
(44, 12, 3, '2012-12-06 07:52:44'),
(45, 12, 37, '2012-12-06 07:52:44'),
(46, 12, 55, '2012-12-06 07:52:44'),
(47, 12, 1, '2012-12-06 07:52:44'),
(67, 19, 3, '2012-12-07 13:27:16'),
(68, 19, 37, '2012-12-07 13:27:16'),
(69, 19, 56, '2012-12-07 13:27:16'),
(87, 23, 3, '2012-12-11 13:28:00'),
(88, 23, 57, '2012-12-11 13:28:00'),
(89, 23, 1, '2012-12-11 13:28:00'),
(90, 23, 4, '2012-12-11 13:28:00'),
(131, 7, 64, '2012-12-22 08:33:54'),
(132, 7, 3, '2012-12-22 08:33:54'),
(133, 7, 57, '2012-12-22 08:33:54'),
(134, 24, 64, '2012-12-22 11:21:45'),
(135, 24, 3, '2012-12-22 11:21:45'),
(136, 24, 57, '2012-12-22 11:21:45'),
(161, 4, 3, '2012-12-23 08:57:51'),
(162, 4, 57, '2012-12-23 08:57:51'),
(163, 4, 58, '2012-12-23 08:57:51'),
(164, 4, 1, '2012-12-23 08:57:51');

-- --------------------------------------------------------

--
-- Структура таблицы `wvd_room`
--

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

--
-- Дамп данных таблицы `wvd_room`
--

INSERT INTO `wvd_room` (`id`, `property_id`, `name`, `size`, `description`, `weekly_rate`, `revenue`, `status`, `status_description`, `updated_at`, `created_at`) VALUES
(2, 7, 'Bedroom', 12, '2\n22222\n333333\nssssssssssss\n111\n222222\n3333333', 200, 0, 'U', 'unzzzz_-2222222', '2012-09-23 00:00:00', '2012-09-23 00:00:00'),
(3, 4, 'Kitchen', 12, 'Kitchen description...', 250, 100, 'U', 'O111', '2012-11-22 00:00:00', '2012-09-23 00:00:00'),
(5, 4, 'Living Room # 2, 25 meters', 25, 'Living Room # 2, 25 meters description...', 250, 0, 'O', '', '2012-09-23 00:00:00', '2012-09-23 00:00:00'),
(6, 4, 'Living Room # 3, 20 meters', 20, 'Living Room # 3, 20 meters description...', 180, 0, 'U', 'Romm is in repair', '2012-07-14 00:00:00', '2012-07-14 00:00:00'),
(7, 4, 'room # 1', 23, '', 44, 1, 'O', '', NULL, '0000-00-00 00:00:00'),
(9, 4, 'room # 2', 67, '11n2\\n2\\n333', 98, 0, 'U', 'una', NULL, '0000-00-00 00:00:00'),
(16, 4, 'room # 4', 23, '44444\\n444444', 200, 0, 'U', 'una_4', NULL, '2012-12-11 12:58:21'),
(17, 23, 'room # 1', 34, 'ava\\n11111111', 200, 0, 'A', '', NULL, '2012-12-11 13:40:55'),
(18, 23, 'room # 2', 76, 'mnnnnnn', 76, 8, 'A', '', NULL, '2012-12-11 13:45:28'),
(19, 23, 'room # 3', 9, 'oo', 9, 9, 'A', '', NULL, '2012-12-11 13:47:27'),
(24, 7, 'room # 2', 8, '111111\n22222', 9, 19, 'A', '', NULL, '2012-12-15 13:23:36'),
(25, 7, 'room # 3', 8, '44444\\n55555555\\n66666', 8, 8, 'A', '', NULL, '2012-12-15 13:29:13'),
(26, 7, 'room # 4', 8, ',mlkjn111111111n22222222', 8, 99, 'A', '', NULL, '2012-12-16 05:11:48'),
(29, 22, 'room # 1', 8, 'asdsads', 8, 8, 'A', '', NULL, '2012-12-16 07:19:55'),
(30, 24, 'room # 1', 6, '1111\n222222', 7, 6, 'A', '', NULL, '2012-12-22 11:23:23'),
(31, 7, 'room # 1', 2, ';lkl;', 0, 0, 'A', '', NULL, '2012-12-23 13:06:45'),
(32, 4, 'room # 1 VVV', 8, 'unva _-stat\n1111\n22222\n3333', 8, 8, 'U', 'unva _-stat', NULL, '2012-12-24 12:47:51'),
(33, 4, 'room # 44', 234, 'sacasdasfd', 34, 3, 'A', '', NULL, '2012-12-25 05:21:36'),
(34, 4, 'room # 5', 65, 'jmhjk', 66, 66, 'A', '', NULL, '2012-12-25 05:44:54'),
(35, 4, 'room # 10', 87, 'uin 10', 9, 9, 'U', 'una', NULL, '2012-12-25 06:00:11');

-- --------------------------------------------------------

--
-- Структура таблицы `wvd_room_feature`
--

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

--
-- Дамп данных таблицы `wvd_room_feature`
--

INSERT INTO `wvd_room_feature` (`id`, `room_id`, `feature_id`, `created_at`) VALUES
(13, 2, 63, '2012-12-21 07:26:00'),
(14, 2, 37, '2012-12-21 07:26:00'),
(15, 2, 2, '2012-12-21 07:26:00'),
(16, 30, 63, '2012-12-22 11:23:36'),
(17, 30, 37, '2012-12-22 11:23:36'),
(20, 31, 65, '2012-12-23 13:07:47'),
(21, 31, 63, '2012-12-23 13:07:47'),
(23, 32, 65, '2012-12-24 12:48:18'),
(24, 32, 63, '2012-12-24 12:48:18'),
(25, 32, 37, '2012-12-24 12:48:18'),
(26, 32, 2, '2012-12-24 12:48:18'),
(29, 33, 63, '2012-12-25 05:24:28'),
(30, 33, 37, '2012-12-25 05:24:28'),
(31, 33, 2, '2012-12-25 05:24:28'),
(32, 34, 63, '2012-12-25 05:44:54'),
(33, 34, 37, '2012-12-25 05:44:54'),
(34, 34, 2, '2012-12-25 05:44:54'),
(41, 35, 63, '2012-12-25 07:22:44'),
(42, 35, 37, '2012-12-25 07:22:44');

-- --------------------------------------------------------

--
-- Структура таблицы `wvd_room_photo`
--

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

--
-- Дамп данных таблицы `wvd_room_photo`
--

INSERT INTO `wvd_room_photo` (`id`, `room_id`, `photo`, `description`, `created_at`) VALUES
(1, 2, '2ed296524423.jpg', '1111112', '0000-00-00 00:00:00'),
(2, 2, '8ca205fd33c6.jpg', '222333334444', '2012-12-10 11:16:49'),
(3, 2, '97a39a4e2d66.jpg', '6666666', '2012-12-10 11:46:17'),
(4, 2, '670e2f17ca75.jpg', 'zzzzzzzxxxxxxxccccc', '2012-12-10 11:49:10'),
(5, 2, '8084d7c16c26.jpg', 'bbbbbbb', '2012-12-10 11:57:23'),
(6, 2, '43e7f7cc672e.jpg', 'zzzzz', '2012-12-10 11:58:35'),
(15, 9, '09f1468b40.jpg', 'xxxxxxxxx', '2012-12-11 13:11:08'),
(16, 17, '67c54181da98.jpg', 'zzzz', '2012-12-11 13:41:22'),
(17, 19, '8a99cb86a4b2.jpg', 'gggggg', '2012-12-11 13:47:27'),
(19, 7, '8ca205fd33c6.jpg', 'aaaa', '2012-12-12 05:35:15'),
(20, 3, '97a39a4e2d66.jpg', 'xxxxxx', '2012-12-12 06:16:02'),
(21, 2, '19cca7943e03.jpg', 'zzzzzzz', '2012-12-21 07:23:59'),
(22, 2, '197f7b3b025c.jpg', 'mmmmmmmmmm', '2012-12-21 07:26:00'),
(23, 30, '92c10ae679d3.jpg', 'ddddddd', '2012-12-22 11:23:36'),
(26, 32, '92c10ae679d3.jpg', 'BBBBBB', '2012-12-24 12:48:18'),
(28, 35, '172542.jpg', '222', '2012-12-25 06:00:40'),
(29, 35, '97a39a4e2d66.jpg', 'kkkkkkkkk', '2012-12-25 07:22:44');

-- --------------------------------------------------------

--
-- Структура таблицы `wvd_tenant_guarantor`
--

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

--
-- Дамп данных таблицы `wvd_tenant_guarantor`
--

INSERT INTO `wvd_tenant_guarantor` (`id`, `tenant_id`, `guarantor_id`, `created_at`) VALUES
(2, 1, 12, '2011-10-31 00:00:00'),
(17, 1, 3, '2012-12-14 11:31:48'),
(19, 14, 11, '2012-12-14 11:56:11');

-- --------------------------------------------------------

--
-- Структура таблицы `wvd_user`
--

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

--
-- Дамп данных таблицы `wvd_user`
--

INSERT INTO `wvd_user` (`id`, `username`, `password`, `email`, `type`, `title`, `first_name`, `middle_name`, `last_name`, `photo`, `copy_dln`, `copy_passport`, `passport`, `dln`, `created_at`, `updated_at`) VALUES
(1, 'Tenant_1', 'tenant_1', 'Tenant@mail.com', 'tenant', 'Mr', 'First name_1', 'Middle name_1', 'Last name_1', '86c3c8de4450.jpg', NULL, '95f8fa1ef335.jpg', 'Passport', 'Dln', '2007-01-01 00:00:00', '2012-12-25 07:14:52'),
(3, 'guarantor_3', '1234567', 'guarantor3@mail.com', 'guarantor', 'Mr', 'FirstName_3', 'Middle_name_3', 'Last_name_3', '86c3c8de4450.jpg', NULL, '95f8fa1ef335.jpg', '33-o3', 'sder', '2012-11-21 00:00:00', '2012-12-22 12:52:24'),
(4, 'Landlord_4', '123567', 'Landlord_4@mail.com', 'landlord', '', 'FirstName_4', 'Middle_name_4ppppp', 'Last_name_4___', 'beverage_1.jpg', 'Q1.png', 'beverage_4.jpg', '333', '444', '2012-11-21 00:00:00', '2012-12-08 11:46:14'),
(5, 'Landlord_5', 'Landlord_Use', 'Landlord_5@mail.com', 'landlord', 'Mrs', 'FirstName_5', 'Middle_name_5', 'Last_name_5__4', '', NULL, NULL, '333000', '444', '2012-11-21 00:00:00', '2012-12-12 07:23:09'),
(6, 'Tenant_2', '1234567890', 'Tenant_2@mail.com', 'tenant', 'Ms', 'First_Name_2', 'Middle_Name_2', 'Last_Name _2', NULL, NULL, NULL, 'Passport_2', 'dln', '2012-12-04 07:09:22', NULL),
(7, 'Tenant_3_', '123456', 'Tenant_3_@mail.com', 'tenant', 'Mr', 'First_Name_3', 'Middle_Name_3__44', 'Last_Name _3', NULL, NULL, NULL, 'Passport_3', 'dln_3', '2012-12-04 07:29:28', '2012-12-04 07:55:28'),
(8, 'Landlord_88', '12345677', 'Landlord_8@mail.com', 'landlord', '', 'First_Name_8', 'm', 'Last_Name _8', '2ed296524423.jpg', '5c6118393f98.jpg', '4b2c9c910f3f.jpg', 'Passport_8', 'dln_899999999qqqqqqqqq', '2012-12-05 08:50:16', '2012-12-20 07:38:23'),
(9, 'Tenant_9', '123456', 'Tenant_9@mail.com', 'tenant', '', 'First_Name_9', 'Middle_Name_9', 'Last_Name _9', NULL, NULL, NULL, 'Passport_9', 'dln_9', '2012-12-07 11:39:31', '2012-12-07 11:39:31'),
(11, 'Guarantor_11', '123456', 'Guarantor_11@mail.com', 'guarantor', '', 'First_Name_11', '', 'Last_Name _11', 'CD6199D46CB3-13.gif', 'geka.jpg', 'funny_monster2.jpg', 'Passport_11', 'dln_11', '2012-12-08 11:48:51', '2012-12-08 11:48:51'),
(12, 'Guarantor_12', '123456', 'Guarantor_12@mail.com', 'guarantor', 'Mrs', 'First_Name_12', '', 'Last_Name _12', 'man.jpg', '86c3c8de4450.jpg', '8ca205fd33c6.jpg', 'Passport_12', 'dln_12---', '2012-12-09 07:09:58', '2012-12-09 07:10:19'),
(13, 'Tenant_13', '123456', 'Tenant_13@mail.com', 'landlord', '', 'First_Name_13', '', 'Last_Name _13', '92c10ae679d3.jpg', '670e2f17ca75.jpg', '197f7b3b025c.jpg', 'Passport_13', 'dln_13', '2012-12-11 07:04:42', '2012-12-14 07:31:54'),
(14, 'Tenant_14', '123456', 'Tenant_14@mail.com', 'tenant', 'Mr', 'First_Name_13000', '', 'Last_Name _13', '5c6118393f98.jpg', '67c54181da98.jpg', '19cca7943e03.jpg', 'Passport_13', 'dln_13', '2012-12-11 12:14:39', '2012-12-11 12:15:57'),
(15, 'Guarantor_15', '123455', 'Guarantor_15@mail.com', 'guarantor', 'Mrs', 'First_Name_15', '', 'Last_Name _15', '95f8fa1ef335.jpg', NULL, '197f7b3b025c.jpg', 'Passport_15', 'dln_15', '2012-12-20 08:34:58', '2012-12-20 08:35:31'),
(16, 'Guarantor_16', '123456', 'Guarantor_16@mail.com', 'guarantor', 'Mr', 'First_Name_13', 'Middle_Name_10', 'Last_Name _2', NULL, NULL, NULL, 'Passport_2', 'dln_13', '2012-12-20 08:38:42', '2012-12-20 08:38:42'),
(17, 'Tenant_1XX', '123456', 'Tenant_1XX@mail.com', 'tenant', 'Mrs', 'First_Name_13', '', 'Last_Name _13', '86c3c8de4450.jpg', '655abbecd162.jpg', '95f8fa1ef335.jpg', 'Passport_13', 'dln_13', '2012-12-24 12:50:16', '2012-12-24 12:50:16'),
(18, 'Tenant_8', '123456', 'Tenant_8@mail.com', 'tenant', 'Mr', 'First_Name_13', 'Middle_Name_10', 'Last_Name _13', '197f7b3b025c.jpg', NULL, NULL, 'Passport_3', 'dln_13', '2012-12-24 13:02:45', '2012-12-24 13:02:45');

-- --------------------------------------------------------

--
-- Структура таблицы `wvd_user_notes`
--

DROP TABLE IF EXISTS `wvd_user_notes`;
CREATE TABLE IF NOT EXISTS `wvd_user_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ind_wvd_user_notes_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `wvd_user_notes`
--

INSERT INTO `wvd_user_notes` (`id`, `user_id`, `notes`, `created_at`) VALUES
(1, 11, '///////////// CodeIgniter Begin //////////////////      if ( $IsInsert ) {       $this->form_validation->set_rules(''username'', ''Username'', ''required|is_unique[user.username]'');       $this->form_validation->set_rules(''email'', ''Email'', ''required|valid_email|is_unique[user.email]'');     } else {     $this->form_validation->set_rules(''username'', ''Username'', ''required|is_unique[user.username.id.''.$id.'']'');       $this->form_validation->set_rules(''email'', ''Email'', ''required|valid_email|is_unique[user.email.id.''.$id.'']'');     } /_SymfonyProjects/wavendon-props/system/libraries/Form_validation.php 	public function is_unique($str, $field) 	{      //AppUtils::deb( $str, ''$str::'' );     //AppUtils::deb( $field, ''$field::'' );     if (substr_count($field, ''.'') == 3) {       list($table, $field, $id_field, $id_val) = explode(''.'', $field);       //AppUtils::deb( $table, ''-1 $table::'' );       //AppUtils::deb( $id_field, ''-2 $id_field::'' );       //AppUtils::deb( $id_val, ''-3 $id_val::'' );       $query = $this->CI->db->limit(1)->where($field, $str)->where($id_field . '' != '', $id_val)->get($table);     } else {       list($table, $field) = explode(''.'', $field);       //AppUtils::deb( $table, ''-2 $table::'' );       $query = $this->CI->db->limit(1)->get_where($table, array($field => $str));     }     return $query->num_rows() === 0; 	         /* 		list($table, $field)=explode(''.'', $field); 		$query = $this->CI->db->limit(1)->get_where($table, array($field => $str)); 		return $query->num_rows() === 0; */   }  ///////////// CodeIgniter END //////////////////   .htaccess: папки 755 а файлы 644 я просто посмотрел на файлы и папки WordPress и с делал так же (FileZilla умеет рекурсивное изменение, причем умеет отдельно для папок и отдельно для файлов)  .htaccess: папки 755 а файлы 644 я просто посмотрел на файлы и папки WordPress и с делал так же (FileZilla умеет рекурсивное изменение, причем умеет отдельно для папок и отдельно для файлов) http://articles-hosting.ru/117/kak-sdelat-301-redirekt.htmlbook http://shublog.ru/php/kak-sdelat-redirekt/  document.location= "<?php echo url_for( ''@product_listings?page=1&rows_in_pager=50'' ) ?>?select_category="+   encodeURIComponent(category_txt) + "&input_search=" + encodeURIComponent(search_input);   http://api.jquery.com/jQuery.noConflict/  Many JavaScript libraries use $ as a function or variable name, just as jQuery does. In jQuery''s case, $ is just an alias for jQuery, so all functionality is available without using $. If we need to use another JavaScript library alongside jQuery, we can return control of $ back to the other library with a call to $.noConflict():  <script type="text/javascript" src="other_lib.js"></script> <script type="text/javascript" src="jquery.js"></script> <script type="text/javascript">   $.noConflict();   // Code that uses other library''s $ can follow here. </script>  This technique is especially effective in conjunction with the .ready() method''s ability to alias the jQuery object, as within callback passed to .ready() we can use $ if we wish without fear of conflicts later:  <script type="text/javascript" src="other_lib.js"></script> <script type="text/javascript" src="jquery.js"></script> <script type="text/javascript">   $.noConflict();   jQuery(document).ready(function($) {     // Code that uses jQuery''s $ can follow here.   });   // Code that uses other library''s $ can follow here. </script>    ThickBox 3.1 : http://bagryan.ru/archives/30      var HRef= ''<?php echo url_for(''@admin_brand_products_count?id='') ?>'' + Id     $.getJSON(HRef,   {  },     onRelatedProductsCount,     function(x,y,z) {   //Some sort of error       alert(x.responseText);     }     );   }    function onRelatedProductsCount(data) {     var ErrorCode=data.ErrorCode     var RowsCount=data.RowsCount     var brand_id= data.brand_id     if ( parseInt(RowsCount) > 0 ) {       alert( " Can not delete brand with "+RowsCount+" product(s) !" )       return;     }     if ( !confirm("Do you want to delete this Brand ?") ) return;     var Url= ''<?php echo url_for(''@admin_brand_delete?id='') ?>'' + brand_id     document.location= Url    }         $c = new Criteria();     $c->add( PaymentPeer::CAPTURED, false );     $c->addJoin( PledgePeer::ID, PaymentPeer::PLEDGE_ID, Criteria::JOIN );     $Date_1_Cond= $c->getNewCriterion( PledgePeer::END_DATE, $pDate_1, Criteria::GREATER_EQUAL );     $Date_2_Cond= $c->getNewCriterion( PledgePeer::END_DATE, $pDate_2, Criteria::LESS_THAN );     $Date_1_Cond->addAnd( $Date_2_Cond );     $c->add( $Date_1_Cond );     $c->addAscendingOrderByColumn( PaymentPeer::RESOLUTION_DATE );     return PaymentPeer::doSelect($c);  		       echo $this->form->renderGlobalErrors();           foreach($this->form->getFormFieldSchema() as $name=>$formField)    {           $Err= $formField->renderError();           Util::deb($Err,''$Err::'');           if ( !empty($Err) ) {             Util::deb( $formField->renderLabelName(), -21 );             Util::deb( $formField->renderError(), -22 );           }         }       $IsAdmin= $sf_context->getUser()->hasGroup(''admin'');     Util::deb($IsAdmin,''$IsAdmin::'');     $IsSuperAdmin= $sf_context->getUser()->hasGroup(''super admin'');     Util::deb($IsSuperAdmin,''$IsSuperAdmin::'');     $IsPublic= $sf_context->getUser()->hasGroup(''public'');     Util::deb($IsPublic,''$IsPublic::'');         <?php echo $lGuardUser->getCreatedAt( sfConfig::get(''app_application_date_time_format'' ) ) ?>  //////////////// SYMFONY 1.4 BEGIN ////////////////////////   TO READ Tests in symfony 94, Forms 126 LASTREAD 225  Could not perform XLST transformation. Make sure PHP has been compiled/configured to support XSLT. : add extension=php_xslt.dll     build-propel.xml:461:22: Execution of the target buildfile failed. Aborting : in propel.ini remove builder settings   1) Fill default apps/frontend/config/view.yml  2) You can also disable the decoration process altogether by switching the has_layout entry to false.  3)      $con = Propel::getConnection(sfGuardGroupPeer::DATABASE_NAME,  Propel::CONNECTION_WRITE);     $con->beginTransaction();     $con->commit();     $con->rollBack();  4) The job description uses the simple_format_text() helper to format it as HTML, by replacing carriage returns with <br /> for instance.  As this helper belongs to the Text helper group, which is not loaded by default, we have loaded it manually by using the use_helper() helper.  $this->forward404If(!$this->job);  ==  if (!$this->job) {   $this->forward404(); }  Method name      PHP equivalent getMethod() $_SERVER[''REQUEST_METHOD''] getUri() $_SERVER[''REQUEST_URI''] getReferer() $_SERVER[''HTTP_REFERER''] getHost() $_SERVER[''HTTP_HOST''] getLanguages() $_SERVER[''HTTP_ACCEPT_LANGUAGE'']  getCharsets() $_SERVER[''HTTP_ACCEPT_CHARSET''] isXmlHttpRequest() $_SERVER[''X_REQUESTED_WITH''] == ''XMLHttpRequest'' getHttpHeader() $_SERVER getCookie() $_COOKIE isSecure() $_SERVER[''HTTPS''] getFiles() $_FILES getGetParameter() $_GET getPostParameter() $_POST getUrlParameter() $_SERVER[''PATH_INFO''] getRemoteAddress() $_SERVER[''REMOTE_ADDR'']   url_for(array( ''module'' => ''job'', ''action'' => ''show'', ''id'' => $job->getId(), ''company'' => $job->getCompany(), ''location'' => $job->getLocation(), ''position'' => $job->getPosition(), ))  job_show_user: url: /job/:company/:location/:id/:position class: sfPropelRoute options: { model: JobeetJob, type: object } param: { module: job, action: show } requirements: id: d+ sf_method: [get]  static public function slugify($text) { // replace all non letters or digits by - $text = preg_replace(''/W+/'', ''-'', $text); // trim and lowercase $text = strtolower(trim($text, ''-'')); return $text; }  job_show_user: url: /job/:company_slug/:location_slug/:id/:position_slug class: sfPropelRoute options: { model: JobeetJob, type: object } param: { module: job, action: show } requirements: id: d+ sf_method: [get]   public function getCompanySlug() { return Jobeet::slugify($this->getCompany()); }   # apps/frontend/config/routing.yml category: url: /category/:slug class: sfPropelRoute param: { module: category, action: show } options: { model: JobeetCategory, type: object }   // apps/frontend/modules/category/actions/actions.class.php public function executeShow(sfWebRequest $request) {   $this->category = $this->getRoute()->getObject();   $this->pager = new sfPropelPager( ''JobeetJob'', sfConfig::get(''app_max_jobs_on_category'') );   $this->pager->setCriteria($this->category->getActiveJobsCriteria());   $this->pager->setPage($request->getParameter(''page'', 1));   $this->pager->init(); }  $this->mergeForm(new AnotherForm()); $this->embedForm(''name'', new AnotherForm());  You can disable form generation on certain models by passing parameters to the symfony Propel behavior:     classes:       SomeModel:         propel_behaviors:           symfony:             form: false             filter: false  public function configure() {   unset(     $this[''created_at''], $this[''updated_at''],     $this[''expires_at''], $this[''is_activated'']   ); }  public function executeFirstPage($request)   {     $nickname = $request->getParameter(''nickname'');       // Store data in the user session     $this->getUser()->setAttribute(''nickname'', $nickname);   }     public function executeSecondPage()   {     // Retrieve data from the user session with a default value     $nickname = $this->getUser()->getAttribute(''nickname'', ''Anonymous Coward'');   }   public function executeRemoveNickname()   {     $this->getUser()->getAttributeHolder()->remove(''nickname'');   }     public function executeCleanup()   {     $this->getUser()->getAttributeHolder()->clear();   }  }   Instead of unsetting the fields you don�_Tt want to display, you can also explicitly list the fields you want by using the useFields() method: public function configure() {   $this->useFields(array(''category_id'', ''type'', ''company'', ''logo'',   ''url'', ''position'', ''location'', ''description'', ''how_to_apply'',   ''token'', ''is_public'', ''email'')); }  $this->widgetSchema[''type''] = new sfWidgetFormChoice(array( ''choices'' => JobeetJobPeer::$types, ''expanded'' => true, ));   Dropdown list (<select>): array(''multiple'' => false, ''expanded'' => false)  Dropdown box (<select multiple="multiple">): array(''multiple'' => true,''expanded'' => false)  List of radio buttons: array(''multiple'' => false, ''expanded'' => true)  List of checkboxes: array(''multiple'' => true, ''expanded'' => true)  $this->widgetSchema->setLabels(array( ''category_id'' => ''Category'', ''is_public''=>''Public?'', ''how_to_apply''=> ''How to apply?'', ));  The include_javascripts_for_form() and include_stylesheets_for_form() helpers include JavaScript and stylesheet dependencies needed for the form widgets.   index: credentials: [A, B] If a user must have credential A or B, wrap them with two pairs of square brackets: index: credentials: [[A, B]]       $c = new Criteria();     $MainContactCond = $c->getNewCriterion( CharityPeer::MAIN_CONTACT_ID, $ContactId );     $BillingContactCond = $c->getNewCriterion( CharityPeer::BILLING_CONTACT_ID, $ContactId );     $ShippingContactCond = $c->getNewCriterion( CharityPeer::SHIPPING_CONTACT_ID, $ContactId );     $MainContactCond->addOr( $BillingContactCond );     $MainContactCond->addOr( $ShippingContactCond );     $c->add( $MainContactCond );     $c->addAscendingOrderByColumn( CharityPeer::NAME );     return CharityPeer::doSelect($c);    Method render() Description Renders the form (equivalent to the output of echo $form) renderHiddenFields() Renders the hidden fields hasErrors() hasGlobalErrors() getGlobalErrors() Returns true if the form has some errors Returns true if the form has global errors Returns an array of global errors renderGlobalErrors() Renders the global errors The form also behaves like an array of fields. You can access the company field with $form[''company'']. The returned object provides methods to render each element of the field: Method renderRow() render() Description Renders the field row Renders the field widget renderLabel() Renders the field label renderError() Renders the field error messages if any renderHelp() Renders the field help message The echo $form statement is equivalent to: <?php foreach ($form as $widget): ?> <?php echo $widget->renderRow() ?> <?php endforeach ?>   public function executeCreate(sfWebRequest $request) {   $this->form = new JobeetJobForm();   $this->processForm($request, $this->form);   $this->setTemplate(''new''); }  public function executeDelete(sfWebRequest $request) { $request->checkCSRFProtection(); $job = $this->getRoute()->getObject(); $job->delete(); $this->redirect(''job/index''); }     $ php symfony plugin:install sfGuardPlugin class ProjectConfiguration extends sfProjectConfiguration {   public function setup()   {       $this->enablePlugins(''sfPropelPlugin'', ''sfGuardPlugin'');   //////////////// SYMFONY 1.4 END ////////////////////////   C:wampwwwClassifieds...AndRemember.txt//////////////////// CONF /////////////////////////////       dsn:          mysql://dev5:zd0gj7kh2lz@localhost/dev5_softreactor_com_airliners  http://tuzoom.net/MyAdmin/index.php      svn 8Co53g0Yr0i /////////////////// CULTURE /////////////////////// overlib : http://www.bosrup.com/web/overlib/?Command_Reference <a href="#" onMouseOver="overlib(''<?php echo CreatePopupTable($Liner,$single) ?>'', ABOVE, CENTER)"   all:   .settings:     default_culture: fr_FR  // Culture setter $this->getUser()->setCulture(''en_US'');   // Culture getter $culture = $this->getUser()->getCulture();  => en_US  $languages = $request->getLanguages();  <?php use_helper(''Number'') ?>   <?php $sf_user->setCulture(''en_US'') ?> <?php echo format_number(12000.10) ?>  => ''12,000.10''   <?php $sf_user->setCulture(''fr_FR'') ?> <?php echo format_number(12000.10) ?>  => ''12 000,10''  <?php use_helper(''Date'') ?>   <?php echo format_date(time()) ?>  => ''9/14/06''   <?php echo format_datetime(time()) ?>  => ''September 14, 2006 6:11:07 PM CEST''    my_connection:   my_product:     _attributes: { phpName: Product }     id:     price:       float   my_product_i18n:     _attributes: { phpName: ProductI18n }     name:        varchar(50) Using the Generated I18n Objects  Once the corresponding object model is built (don''t forget to call the propel:build-model task after each modification of the schema.yml), you can use your Product class with i18n support as if there were only one table, as shown in Listing 13-8.  Listing 13-8 - Dealing with i18n Objects $product = ProductPeer::retrieveByPk(1); $product->setName(''Nom du produit''); // By default, the culture is the current user culture $product->save();   echo $product->getName();  => ''Nom du produit''   $product->setName(''Product name'', ''en''); // change the value for the ''en'' culture $product->save();   echo $product->getName(''en'');  => ''Product name''   $c = new Criteria(); $c->add(ProductPeer::PRICE, 100, Criteria::LESS_THAN); $products = ProductPeer::doSelectWithI18n($c, $culture); // The $culture argument is optional // The current user culture is used if no culture is given   <?php use_helper(''I18N'') ?>   <?php echo __(''Welcome to our website.'') ?> <?php echo __("Today''s date is ") ?> <?php echo format_date(date()) ?>  //////////////////// DATETIME /////////////////////////         ''depDate'' =>  strtotime ( (string)$OpcionesObj->FechaIda) ,   $format = ''%d/%m/%Y %H:%M:%S''; $strf = strftime($format);          <?php echo $lGuardUser->getCreatedAt( sfConfig::get(''app_application_date_time_format'' ) ) ?> getCreatedAt( ''%B %d, %Y'' ) getCreatedAt(''%Y-%m-%d %H:%M'')  <?php use_helper(''Date'') ?> <?php echo format_date(time()) ?> <?php echo format_datetime(time()) ?> <?php use_helper(''Form'') ?>  <?php echo input_date_tag(''birth_date'', mktime(0, 0, 0, 9, 14, 2006)) ?> sfContext::getInstance()->getRequest()->getParameter(''id'',-1); sfContext::getInstance()->	getRequest()-> $date= $request->getParameter(''birth_date''); $user_culture = $this->getUser()->getCulture();  // Getting a timestamp $timestamp = $this->getContext()->getI18N()->getTimestampForCulture($date, $user_culture);  // Getting a structured date list($d, $m, $y) = $this->getContext()->getI18N()->getDateForCulture($date, $user_culture);  //////////////////// FLASH ////////////////////////////       $this->getUser()->setFlash(''user_message'', ''Must be logged to enter this page!'' );       return $this->redirect( ''@homepage'' );  //////////////////// STR /////////////////////////// str_replace("\n","<br>",$Image->getDescription())          <?php $Description= $DrinksReference->getDescription();         $ConcatStrMaxLength= sfConfig::get(''app_application_ConcatStrMaxLength'',30);         echo strip_tags(Util::ConcatStr( htmlspecialchars_decode($Description), $ConcatStrMaxLength,''...'' ));                  if (strlen($Description)> $ConcatStrMaxLength ) {           echo "<a onmouseover= "return overlib(''". str_replace("\r","",str_replace("\n","",$Description))  . "'',CAPTION,''Description'',BGCOLOR,''#fff'',FGCOLOR,''#fff'',CAPTIONSIZE,''2'',TEXTSIZE,''2'',HAUTO,VAUTO,WIDTH,''250'');" onmouseout= "return nd();" ><b>!</b></a>";                   }                   ?>   //////////////////// IMAGE ///////////////////////// convert -sample 25%x25% input.jpg output.jpg   //////////////////// LOGGED USER /////////////////// $this->user_profile_id= UserProfilePeer::getUserProfileIdByUserId( $this->getUser()->getGuardUser()->getId() ); $this->UserProfile= UserProfilePeer::getUserProfileById( $this->user_profile_id ); $this->UserProfileDetails= UserProfileDetailsPeer::getUserProfileDetailsById($this->user_profile_id);   //////////////////// CONFIG /////////////////////// in view.yml :   javascripts:    [ /js/funcs.js, /js/overlib/overlib.js, /js/jquery/jquery.js ]  ConfigurationPeer::GetConfigurationValue( ''name'', ''Classified site'' ) sfConfig::get(''app_application_name'')    Util::deb(sfConfig::get(''sf_root_dir''));    Util::deb(sfConfig::get(''sf_web_dir''));    $db = sfConfig::get(''sf_data_dir'').DIRECTORY_SEPARATOR.''/database.sqlite'';  sf_admin_web_dir: /sf/sf_admin sf_app: frontend sf_app_base_cache_dir: ''C:wampwwwAirLinerscachefrontend'' sf_app_cache_dir: ''C:wampwwwAirLinerscachefrontenddev'' sf_app_config_dir: ''C:wampwwwAirLinersappsfrontendconfig'' sf_app_dir: ''C:wampwwwAirLinersappsfrontend'' sf_app_i18n_dir: ''C:wampwwwAirLinersappsfrontendi18n'' sf_app_lib_dir: ''C:wampwwwAirLinersappsfrontendlib'' sf_app_module_dir: ''C:wampwwwAirLinersappsfrontendmodules'' sf_app_template_dir: ''C:wampwwwAirLinersappsfrontend	emplates'' sf_apps_dir: ''C:wampwwwAirLinersapps'' sf_cache: false sf_cache_dir: ''C:wampwwwAirLinerscache'' sf_calendar_web_dir: /sf/calendar sf_charset: utf-8 sf_check_lock: false sf_check_symfony_version: false sf_compat_10: false sf_compressed: false sf_config_cache_dir: ''C:wampwwwAirLinerscachefrontenddevconfig'' sf_config_dir: ''C:wampwwwAirLinersconfig'' sf_csrf_secret: false sf_data_dir: ''C:wampwwwAirLinersdata'' sf_debug: true sf_default_culture: en sf_doc_dir: ''C:wampwwwAirLinersdoc''   PATH_SEPARATOR sfConfig::get(''app_admin_email'')  19) parameter = sfConfig::get(''param_name'', $default_value); // Define a setting sfConfig::set(''param_name'', $value);   $test = sfYaml::load(''/path/to/test.yml'');   21) There is no autoload.yml file in the default application configuration directory. If you want to modify the framework settings--for instance,  to autoload classes stored somewhere else in your file structure--create an empty autoload.yml file and override the settings of  $sf_symfony_lib_dir/config/config/autoload.yml or add your own   22) Template Shortcuts: $sf_context: The whole context object (instance of sfContext) $sf_request: The request object (instance of sfRequest) $sf_params : The parameters of the request object $sf_user : The current user session object (instance of sfUser)     $Cookie= sfContext::getInstance()->	getRequest()->getCookie( sfConfig::get(''app_application_ad_watchlist_cookie_name'') );  //////////////////// I18N ///////////////////////// <?php echo __("Save & Close?") ?> <b> <?php echo __("Are you in %1% Family",array(''%1%'' => $DisplayName."''") )?> ? </b>  //////////////////// INTEGER ////////////////////// <?php use_helper(''Number'') ?> <?php echo format_number(12000.10) ?> ?php echo format_currency(1350, ''USD'') ?>    //////////////////// COUNTRY ////////////////////// <?php use_helper(''I18N'') ?>  <?php echo format_country(''US'') ?>  => ''United States''  <?php format_language(''en'') ?>  => ''English''	  <?php echo select_country_tag(''country'', ''US'') ?>    So, never use the input data as default values like in this example: $this->form->setDefaults($request->getParameter(''contact'')). If you test out this code passing a value for both the name and is_admin fields, you''ll get an "Extra field name." global error,   //////////////////// VALIDATION //////////////////////      PostPeer::ZIP => new sfValidatorAnd(array(     new sfValidatorInteger(array(), array( ) ),          new sfValidatorRegex(     array(''pattern'' => sfConfig::get(''app_regex_zip'')),     array (''invalid'' => "Zip code must have 5 digits.")     ),     ),     array(''required''   => true),     array(''required''   => ''Background Color is required.'')          ),        $this->validatorSchema->setPostValidator(       new sfValidatorPropelUnique(array(''model'' => ''Article'', ''column'' => array(''slug'')))     ); 	    //////////////////// TRANSACTION //////////////////////  $con = Propel::getConnection(JobeetJobPeer::DATABASE_NAME,  Propel::CONNECTION_WRITE);     $con->beginTransaction();          $con = Propel::getConnection(JobeetJobPeer::DATABASE_NAME,  Propel::CONNECTION_WRITE);     $con->commit();      $con = Propel::getConnection(JobeetJobPeer::DATABASE_NAME,  Propel::CONNECTION_WRITE);     $con->rollBack();   //////////////////// LINKS //////////////////////    $article = ArticlePeer::retrieveByPK($request->getParameter(''id''));   if (!$article)  {     $this->forward404();   }  //////////////////// SYSTEM //////////////////// sfWebRequest:getUri()	Full URI	''http://localhost/frontend_dev.php/mymodule/myaction'' getPathInfo()	Path info	''/mymodule/myaction'' getReferer()**	Referrer	''http://localhost/frontend_dev.php/'' getHost()	Host name	''localhost'' getScriptName()  $configuration->getRootDir(): Project root directory (normally, should remain at its default value, unless you change the file structure). $configuration->getApplication(): Application name in the project. Necessary to compute file paths. $configuration->getEnvironment(): Environment name (prod, dev, or any other project-specific environment that you define). Will determine which    configuration settings are to be used. Environments are explained later in this chapter. $configuration->isDebug(): Activation of the debug mode (see Chapter 16 for details).   //////////////////// DEBUG ////////////////////////// prod:  .settings:     error_reporting:  <?php echo (E_PARSE | E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR | E_USER_ERROR)."\n" ?>  dev:   .settings:     error_reporting:  <?php echo (E_ALL | E_STRICT)."\n" ?>    // From an action $this->logMessage($message, $level);   // From a template <?php use_helper(''Debug'') ?> <?php log_message($message, $level) ?>  OR  if (sfConfig::get(''sf_logging_enabled'')) {   sfContext::getInstance()->getLogger()->info($message); }  > php symfony log:clear  dev:   .settings:     web_debug:              on  // Initialize the timer and start timing $timer = sfTimerManager::getTimer(''myTimer'');  // Do things ...  // Stop the timer and add the elapsed time $timer->addTime();  // Get the result (and stop the timer if not already stopped) $elapsedTime = $timer->getElapsedTime();  php symfony project:disable APPLICATION_NAME ENVIRONMENT_NAME  php symfony project:enable APPLICATION_NAME ENVIRONMENT_NAME  //////////////////// MODEL OBJECTS //////////////////////  You can check if an object is new by calling isNew(). And if you wonder if an object has been  modified and deserves saving, call its isModified() method.  $article->fromArray(array(   ''title''   => ''My first article'',   ''content'' => ''This is my very first article.\n Hope you enjoy it!'', ));   //////////////////// MODEL SQL //////////////////////  replace doSelect() with a doSelectOne()   $c = new Criteria(); $subSelect = "orders.STATUS IN ( SELECT status.NAME FROM status WHERE status.ORDER_TYPE = ''purchase'' )"; $c->add(StatusPeer.STATUS, $subSelect, Criteria::CUSTOM); $orders = StatusPeer::doSelect($c);  SET FOREIGN_KEY_CHECKS=0; SET FOREIGN_KEY_CHECKS=1;   NO innodb htstp://www.sql.ru/forum/actualthread.aspx?bid=6&tid=855453&hl=engine%20innodb //////////////////// EXTENTIONS //////////////////////  Check the list of symfony plug-ins in the wiki to find behaviors (http://trac.symfony-project.org/wiki/SymfonyPlugins#Behaviors).   hapter 17 explains more about behaviors.  //////////////////// HTML CONTROLS //////////////////////  при успешной загрузке вешать плагин на новые элементы (в опции success ajax-запроса). $.ajax({     // какие-то опции     success: function(data){         // тут что-то вставляется в DOM,         // ну и тут же никто не запрещает сделать следующее:         $("selector").somePlagin({             // опции плагина         });     } });  поправить плагин, повесить событие через live: http://bitbybit.ru/solution/125/  Добрый день. Есть плагин sfFormExtraPlugin, который добавляет среди всего прочего виджет JqueryDate. Нужно подключать JqueryUI.  Ссылка: http://www.symfony-project.org/plugins/sfFormExtraPlugin. Для времени нужно покопаться, пока не нужна была такая возможность, хватало даты.  sfFormExtraPlugin использует плагин jQuery.UI datepicker - а он в свою очередь легко расширяется до DateTimepicker: пример работы можно увидеть  http://www.matte26.com/dev/datetimepicker/index.html почти в самом низу; Можно приспособить под вывод даты и времени sfFormExtraPlugin плагин, а можно пойти более простым путем - описать собственный виджет с  внедренным jQuery.UI DateTimepicker.  button_to()  <a style="cursor:pointer;" onclick="javascript:ShowImageDialog(''<?php echo $NextImageFullName ?>'') " title="Show image"> <?php echo $ImageTag ?> </a>        ''&search_location=''+encodeURIComponent(search_location)+    <script type="text/javascript" language="JavaScript">   <!--    function onSubmit() {     var theForm = document.getElementById("form_beverage_edit");     theForm.submit();   }    //-->   </script>    function ShowAll() {     var theTable= document.getElementById("table_select_country")    // table_select_country  form_restaurant_edit             if (document.getElementsByTagName) {       var trs = theTable.getElementsByTagName(''tr'');       for (var j = 1; j < trs.length; j++) {         var K= trs[j].id.indexOf(''tr_country_'');               if ( K >= 0 ) {           trs[j].style.display= GetShowTRMethod()         }       }     }       }  ////////////// TINY ////////////////     tinyMCE.execCommand(''mceFocus'', false, ''beverage_beverage.DESCRIPTION'');     tinyMCE.execCommand(''mceRemoveControl'', false, ''beverage_beverage.DESCRIPTION'');      document.getElementById(''beverage_beverage.DESCRIPTION'').value= Text     tinyMCE.execCommand(''mceAddControl'', false, ''beverage_beverage.DESCRIPTION'');  //////////////////// Ajax ////////////////////////// <div id="indicator">Data processing beginning</div> <?php echo javascript_tag(   update_element_function(''indicator'', array(     ''content''  => "<strong>Data processing complete</strong>",   )) ) ?>  <div id="emails"></div> <?php echo link_to_remote(image_tag(''refresh''), array(     ''update'' => ''emails'',     ''url''    => ''@list_emails'', ), array(     ''class''  => ''ajax_link'', )) ?>  <?php echo form_tag(''@item_add_regular'') ?>   <label for="item">Item:</label>   <?php echo input_tag(''item'') ?>   <div id="item_suggestion"></div>   <?php echo observe_field(''item'', array(       ''update''   => ''item_suggestion'',       ''url''      => ''@item_being_typed'',   )) ?>   <?php echo submit_tag(''Add'') ?> </form>  <?php echo link_to_remote(''Refresh the letter'', array(   ''url''      => ''publishing/refresh'',   ''complete'' => ''updateJSON(ajax)'' )) ?>   public function executeRefresh()   {     $this->getResponse()->setHttpHeader(''Content-Type'',''application/json; charset=utf-8'');     $output = ''[["title", "My basic letter"], ["name", "Mr Brown"]]'';     return $this->renderText(''(''.$output.'')'');   } Since version 5.2, PHP offers two functions, json_encode() and json_decode(), that all        	new Ajax.Request(''ajax/ce_save.php'',{ 		method:''post'', 		parameters: params, 		asynchronous: false, 		onComplete: function(server) 		{ 			alert(-1); 			//alert( dumpObj(server, "ZZZ", 5, 10 ) ); 			alert(server.responseText); 			var Ref= ''<?php echo SiteHost; ?>admin/ce_list.php?<?php echo PrepareListUrl(false,true); ?>''; 			//var Ref= ''<?php echo SiteHost; ?>admin/ce_editor.php?id=<?php echo $id; ?>''; //FIXIT HIDE 			//alert(Ref); 			//$(''server_response'').innerHTML = server.responseText; 			document.location=Ref 		} 	})  window.onload = bind_events;     function ListGuestbook() {     var HRef= ''profile/Listguestbook'';     alert( "HRef::"+HRef );     new Ajax.Request(HRef,{       method:''post'',       parameters: '''',       asynchronous: false,       onComplete: function(server)       {         alert(-1);         document.getElementById( "div_UserGuestbooksList" ).innerHTML= server.responseText;       }     })   }   //////////////////// jQuery //////////////////////// nodes = $(''firstDiv'', ''secondDiv'');  nodes = $$(''.myclass'');  nodes = $$(''body div#main ul li.last img > span.legend'');    /////////// AUTOCOMPLETE //////////////////// http://www.linkexchanger.su/2008/39.html  http://wiki.github.com/madrobby/scriptaculous/ajax-autocompleter //////////////////////////////////////////////  //////////////////////////// IN WEB Options +FollowSymLinks +ExecCGI   <IfModule mod_rewrite.c>   RewriteEngine On     # uncomment the following line, if you are having trouble   # getting no_script_name to work   #RewriteBase /     # we skip all files with .something   #RewriteCond %{REQUEST_URI} ..+$   #RewriteCond %{REQUEST_URI} !.html$   #RewriteRule .* - [L]     # we check if the .html version is here (caching)   RewriteRule ^$ index.html [QSA]   RewriteRule ^$ index_image.php [QSA]   RewriteRule ^([^.]+)$ $1.html [QSA]   RewriteCond %{REQUEST_FILENAME} !-f     # no, so we redirect to our front web controller   RewriteRule ^(.*)$ index.php [QSA,L] </IfModule>  ///////////////////////////////////// ROOT # -FrontPage-  IndexIgnore .htaccess */.??* *~ *# */HEADER* */README* */_vti*  <Limit GET POST> order deny,allow deny from all allow from all </Limit> <Limit PUT DELETE> order deny,allow deny from all </Limit> AuthName www.dev1.softreactor.com AuthUserFile /home/virtual/site7/fst/var/www/html/_vti_pvt/service.pwd AuthGroupFile /home/virtual/site7/fst/var/www/html/_vti_pvt/service.grp  RewriteEngine On RewriteRule ^(.*)$    /web/$1   ///////////////// FILTERS //////////////////////   public function execute($filterChain)   { // Making variables available to all Actions via Filters     // Remove this if condition if you want the variable available to AJAX actions     if (!$this->getContext()->getRequest()->isXmlHttpRequest()) {             for ($i=0; $i < $this->getContext()->getActionStack()->getSize(); $i++) {          $this->getContext()->getActionStack()->getEntry($i)->getActionInstance()->foo = ''foo''; //////////////////////////////////////////////////   ///////////////// BROWSERS ///////////////////////// addJavascript addStylesheet for css <!--[if IE 7]> <?php echo stylesheet_tag(''my-css-for-IE7'') ?> <![endif]--> <!--[if lte IE 6]> <?php echo stylesheet_tag(''my-css-for-IE6-or-lower'') ?> <![endif]--> ////////////////////////////////////////////////////  /////// web/.htaccess ////////////////// Options +FollowSymLinks +ExecCGI    RewriteEngine On    # uncomment the following line, if you are having trouble   # getting no_script_name to work   #RewriteBase /    # we skip all files with .something   #RewriteCond %{REQUEST_URI} ..+$   #RewriteCond %{REQUEST_URI} !.html$   #RewriteRule .* - [L]    # we check if the .html version is here (caching)   RewriteRule ^$ index.html [QSA]   RewriteRule ^$ info.php [QSA]   RewriteRule ^([^.]+)$ $1.html [QSA]   RewriteCond %{REQUEST_FILENAME} !-f    # no, so we redirect to our front web controller   #RewriteRule ^(.*)$ index.php [QSA,L]   #RewriteRule ^(.*)$    /web/$1     #RewriteEngine On   RewriteCond %{THE_REQUEST} !^(.*)phpinfo.php(.+)$       # no, so we redirect to our front web controller   RewriteRule ^(.*)$ index.php [QSA,L]    #RewriteRule ^(.*)$    /web/$1   ///////////// root/.htaccess RewriteEngine On RewriteRule ^(.*)$    /web/$1    CRUD jobeet-1.4-propel-en: page 154  :  "Virtual" columns With this configuration, the %%category_id%% segment will be replaced by the category primary key. But it would be more meaningful to display the  156 : batch_actions http://forum.symfony-project.org/index.php/m/97660/#msg_97660 $this->validatorSchema[''FieldName''] = new sfValidatorCustom() class sfValidatorCustom extends sfValidatorBase {   public function configure($options = array(), $messages = array())   {     parent::configure($options, $messages);   }      protected function doClean($value)   {     if( Condition )       throw new sfValidatorError($this, ''Error Tex...'');         return parent::doClean($value);   } }  http://dev.twitter.com/pages/libraries   MySQL ERROR 1005 (HY000): Can’t create table ‘Table.frm’ (errno: 150)      1. SET FOREIGN_KEY_CHECKS = 0; -- TOP      2. SET FOREIGN_KEY_CHECKS = 1; -- BOTTOM       Can''t create table ''TT.#sql-52ec_25e'' (errno: 150) SQL1.sql 2 5     ошибка 150 просто указывает на неправильный внешний ключ. из-за плагинной архитектуры в mysql нормально ошибку вывести не смогли. поэтому нужно сразу после получения такой ошибки делать SHOW INNODB STATUS и искать там LATEST FOREIGN KEY ERROR       http://www.verysimple.com/blog/2006/10/22/mysql-error-number-1005-cant-create-table-mydbsql-328_45frm-errno-150/   SHOW INNODB STATUS  Ответ MySQL: Документация #1227 - Access denied; you need the SUPER privilege for this operation    http://www.d1089825.cp.blacknight.com/web/backend.php/ login :  admin@doyles.com/DoylesP@ssw0rd  http://mail.google.com/a/softreactor.com/?ui=2#inbox/1292800f53aee754  &nbsp;&euro;   … готово [8:43:46 EDT] Mykhaylo Legenchenko: http://dev22.softreactor.com/index.php/srvc/get_categories?page=1&sorting=&filter_name= [8:43:53 EDT] Mykhaylo Legenchenko: смотри в чем прикол... [8:44:25 EDT] Mykhaylo Legenchenko: смысл в том чтобы сделать $_SERVER-ы обоих запросов одинаковыми [8:44:44 EDT] Mykhaylo Legenchenko: для этого в index.php вносим var_dump($_SERVER);die; [8:44:49 EDT] Mykhaylo Legenchenko: смотрим различия и фиксим [8:44:56 EDT] Mykhaylo Legenchenko: if (strpos($_SERVER[''REQUEST_URI''], ''/web'') !== 0)  $_SERVER[''REQUEST_URI''] = ''/web'' . $_SERVER[''REQUEST_URI'']; [8:44:57 EDT] Mykhaylo Legenchenko: я профиксил таким кодом [8:45:20 EDT] Mykhaylo Legenchenko: можешь это где-то записать чтобы больше небыло проблем с /web? :)  <?php   index.php: if (strpos($_SERVER[''REQUEST_URI''], ''/web'') !== 0) 	$_SERVER[''REQUEST_URI''] = ''/web'' . $_SERVER[''REQUEST_URI''];  //var_dump($_SERVER);die; require_once(dirname(__FILE__).''/../config/ProjectConfiguration.class.php'');  $configuration = ProjectConfiguration::getApplicationConfiguration(''frontend'', ''prod'', false); sfContext::createInstance($configuration)->dispatch();  .htaccess: #AuthType Basic  RewriteEngine On RewriteRule ^(.*)$    /web/$1       ini_set("memory_limit","400M");     ini_set("max_execution_time","600");  Pagination The sfPropelPager object http://www.symfony-project.org/cookbook/1_2/en/pager', '2011-10-31 00:00:00'),
(5, 11, 'zzzzz\nxxxxxxxxxxxx\ncccccccccccccccccccc\nvvvvvvvvvvvvvvvvvvvvvvvvvvv\nbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2012-12-15 08:44:25'),
(9, 1, 'cccc\nvvvvvvvv\nbbbbb\nnn', '2012-12-24 11:19:09'),
(10, 17, '1111\n22222', '2012-12-24 12:50:44'),
(13, 18, 'r\n\n\nttttt\nttttttt', '2012-12-24 13:02:53'),
(14, 1, 'zzzz\nxxxxx\ncccccc', '2012-12-25 08:21:21'),
(15, 1, 'xxxxx\nccccccc\nvvvvvvv', '2012-12-25 08:21:29'),
(16, 1, 'cccccc\nvvvvvvvvvvv\nbbbbbbbbbbbbbbbb', '2012-12-25 08:30:59'),
(17, 1, 'cccccc\nvvvvvvvvvvv\nbbbbbbbbbbbbbbbb', '2012-12-25 08:31:09'),
(18, 1, 'dd\nWWWWWWW\nEEEEEEEEEEEEE\nRRRRRR\nTT', '2012-12-25 08:33:44');
INSERT INTO `wvd_user_notes` (`id`, `user_id`, `notes`, `created_at`) VALUES
(19, 5, '&lt;?php  if ( ! defined(''BASEPATH'')) exit(''No direct script access allowed'');\n/**\n * CodeIgniter\n *\n * An open source application development framework for PHP 5.1.6 or newer\n *\n * @package  CodeIgniter\n * @author  ExpressionEngine Dev Team\n * @copyright Copyright (c) 2008 - 2011, EllisLab, Inc.\n * @license  http://codeigniter.com/user_guide/license.html\n * @link  http://codeigniter.com\n * @since  Version 1.0\n * @filesource\n */\n\n// ------------------------------------------------------------------------\n\n/**\n * Router Class\n *\n * Parses URIs and determines routing\n *\n * @package  CodeIgniter\n * @subpackage Libraries\n * @author  ExpressionEngine Dev Team\n * @category Libraries\n * @link  http://codeigniter.com/user_guide/general/routing.html\n */\nclass CI_Router {\n\n /**\n  * Config class\n  *\n  * @var object\n  * @access public\n  */\n var $config;\n /**\n  * List of routes\n  *\n  * @var array\n  * @access public\n  */\n var $routes   = array();\n /**\n  * List of error routes\n  *\n  * @var array\n  * @access public\n  */\n var $error_routes = array();\n /**\n  * Current class name\n  *\n  * @var string\n  * @access public\n  */\n var $class   = '''';\n /**\n  * Current method name\n  *\n  * @var string\n  * @access public\n  */\n var $method   = ''index'';\n /**\n  * Sub-directory that contains the requested controller class\n  *\n  * @var string\n  * @access public\n  */\n var $directory  = '''';\n /**\n  * Default controller (and method if specific)\n  *\n  * @var string\n  * @access public\n  */\n var $default_controller;\n\n /**\n  * Constructor\n  *\n  * Runs the route mapping function.\n  */\n function __construct()\n {\n  $this->config =& load_class(''Config'', ''core'');\n  $this->uri =& load_class(''URI'', ''core'');\n  log_message(''debug'', "Router Class Initialized");\n }\n\n // --------------------------------------------------------------------\n\n /**\n  * Set the route mapping\n  *\n  * This function determines what should be served based on the URI request,\n  * as well as any "routes" that have been set in the routing config file.\n  *\n  * @access private\n  * @return void\n  */\n function _set_routing()\n {\n  // Are query strings enabled in the config file?  Normally CI doesn''t utilize query strings\n  // since URI segments are more search-engine friendly, but they can optionally be used.\n  // If this feature is enabled, we will gather the directory/class/method a little differently\n  $segments = array();\n  if ($this->config->item(''enable_query_strings'') === TRUE AND isset($_GET[$this->config->item(''controller_trigger'')]))\n  {\n   if (isset($_GET[$this->config->item(''directory_trigger'')]))\n   {\n    $this->set_directory(trim($this->uri->_filter_uri($_GET[$this->config->item(''directory_trigger'')])));\n    $segments[] = $this->fetch_directory();\n   }\n\n   if (isset($_GET[$this->config->item(''controller_trigger'')]))\n   {\n    $this->set_class(trim($this->uri->_filter_uri($_GET[$this->config->item(''controller_trigger'')])));\n    $segments[] = $this->fetch_class();\n   }\n\n   if (isset($_GET[$this->config->item(''function_trigger'')]))\n   {\n    $this->set_method(trim($this->uri->_filter_uri($_GET[$this->config->item(''function_trigger'')])));\n    $segments[] = $this->fetch_method();\n   }\n  }\n\n  // Load the routes.php file.\n  if (defined(''ENVIRONMENT'') AND is_file&#40;APPPATH.''config/''.ENVIRONMENT.''/routes.php''&#41;)\n  {\n   include(APPPATH.''config/''.ENVIRONMENT.''/routes.php'');\n  }\n  elseif (is_file&#40;APPPATH.''config/routes.php''&#41;)\n  {\n   include(APPPATH.''config/routes.php'');\n  }\n\n  $this->routes = ( ! isset($route) OR ! is_array($route)) ? array() : $route;\n  unset($route);\n\n  // Set the default controller so we can display it in the event\n  // the URI doesn''t correlated to a valid controller.\n  $this->default_controller = ( ! isset($this->routes[''default_controller'']) OR $this->routes[''default_controller''] == '''') ? FALSE : strtolower($this->routes[''default_controller'']);\n\n  // Were there any query string segments?  If so, we''ll validate them and bail out since we''re done.\n  if (count($segments) > 0)\n  {\n   return $this->_validate_request($segments);\n  }\n\n  // Fetch the complete URI string\n  $this->uri->_fetch_uri_string();\n\n  // Is there a URI string? If not, the default controller specified in the "routes" file will be shown.\n  if ($this->uri->uri_string == '''')\n  {\n   return $this->_set_default_controller();\n  }\n\n  // Do we need to remove the URL suffix?\n  $this->uri->_remove_url_suffix();\n\n  // Compile the segments into an array\n  $this->uri->_explode_segments();\n\n  // Parse any custom routing that may exist\n  $this->_parse_routes();\n\n  // Re-index the segment array so that it starts with 1 rather than 0\n  $this->uri->_reindex_segments();\n }\n\n // --------------------------------------------------------------------\n\n /**\n  * Set the default controller\n  *\n  * @access private\n  * @return void\n  */\n function _set_default_controller()\n {\n  if ($this->default_controller === FALSE)\n  {\n   show_error("Unable to determine what should be displayed. A default route has not been specified in the routing file.");\n  }\n  // Is the method being specified?\n  if (strpos($this->default_controller, ''/'') !== FALSE)\n  {\n   $x = explode(''/'', $this->default_controller);\n\n   $this->set_class($x[0]);\n   $this->set_method($x[1]);\n   $this->_set_request($x);\n  }\n  else\n  {\n   $this->set_class($this->default_controller);\n   $this->set_method(''index'');\n   $this->_set_request(array($this->default_controller, ''index''));\n  }\n\n  // re-index the routed segments array so it starts with 1 rather than 0\n  $this->uri->_reindex_segments();\n\n  log_message(''debug'', "No URI present. Default controller set.");\n }\n\n // --------------------------------------------------------------------\n\n /**\n  * Set the Route\n  *\n  * This function takes an array of URI segments as\n  * input, and sets the current class/method\n  *\n  * @access private\n  * @param array\n  * @param bool\n  * @return void\n  */\n function _set_request($segments = array())\n {\n  $segments = $this->_validate_request($segments);\n\n  if (count($segments) == 0)\n  {\n   return $this->_set_default_controller();\n  }\n\n  $this->set_class($segments[0]);\n\n  if (isset($segments[1]))\n  {\n   // A standard method request\n   $this->set_method($segments[1]);\n  }\n  else\n  {\n   // This lets the "routed" segment array identify that the default\n   // index method is being used.\n   $segments[1] = ''index'';\n  }\n\n  // Update our "routed" segment array to contain the segments.\n  // Note: If there is no custom routing, this array will be\n  // identical to $this->uri->segments\n  $this->uri->rsegments = $segments;\n }\n\n // --------------------------------------------------------------------\n\n /**\n  * Validates the supplied segments.  Attempts to determine the path to\n  * the controller.\n  *\n  * @access private\n  * @param array\n  * @return array\n  */\n function _validate_request($segments)\n {\n  if (count($segments) == 0)\n  {\n   return $segments;\n  }\n\n  // Does the requested controller exist in the root folder?\n  if (file_exists(APPPATH.''controllers/''.$segments[0].''.php''))\n  {\n   return $segments;\n  }\n\n  // Is the controller in a sub-folder?\n  if (is_dir(APPPATH.''controllers/''.$segments[0]))\n  {\n   // Set the directory and remove it from the segment array\n   $this->set_directory($segments[0]);\n   $segments = array_slice($segments, 1);\n\n   if (count($segments) > 0)\n   {\n    // Does the requested controller exist in the sub-folder?\n    if ( ! file_exists(APPPATH.''controllers/''.$this->fetch_directory().$segments[0].''.php''))\n    {\n     if ( ! empty($this->routes[''404_override'']))\n     {\n      $x = explode(''/'', $this->routes[''404_override'']);\n\n      $this->set_directory('''');\n      $this->set_class($x[0]);\n      $this->set_method(isset($x[1]) ? $x[1] : ''index'');\n\n      return $x;\n     }\n     else\n     {\n      show_404($this->fetch_directory().$segments[0]);\n     }\n    }\n   }\n   else\n   {\n    // Is the method being specified in the route?\n    if (strpos($this->default_controller, ''/'') !== FALSE)\n    {\n     $x = explode(''/'', $this->default_controller);\n\n     $this->set_class($x[0]);\n     $this->set_method($x[1]);\n    }\n    else\n    {\n     $this->set_class($this->default_controller);\n     $this->set_method(''index'');\n    }\n\n    // Does the default controller exist in the sub-folder?\n    if ( ! file_exists(APPPATH.''controllers/''.$this->fetch_directory().$this->default_controller.''.php''))\n    {\n     $this->directory = '''';\n     return array();\n    }\n\n   }\n\n   return $segments;\n  }\n\n\n  // If we''ve gotten this far it means that the URI does not correlate to a valid\n  // controller class.  We will now see if there is an override\n  if ( ! empty($this->routes[''404_override'']))\n  {\n   $x = explode(''/'', $this->routes[''404_override'']);\n\n   $this->set_class($x[0]);\n   $this->set_method(isset($x[1]) ? $x[1] : ''index'');\n\n   return $x;\n  }\n\n\n  // Nothing else to do at this point but show a 404\n  show_404($segments[0]);\n }\n\n // --------------------------------------------------------------------\n\n /**\n  *  Parse Routes\n  *\n  * This function matches any routes that may exist in\n  * the config/routes.php file against the URI to\n  * determine if the class/method need to be remapped.\n  *\n  * @access private\n  * @return void\n  */\n function _parse_routes()\n {\n  // Turn the segment array into a URI string\n  $uri = implode(''/'', $this->uri->segments);\n\n  // Is there a literal match?  If so we''re done\n  if (isset($this->routes[$uri]))\n  {\n   return $this->_set_request(explode(''/'', $this->routes[$uri]));\n  }\n\n  // Loop through the route array looking for wild-cards\n  foreach ($this->routes as $key => $val)\n  {\n   // Convert wild-cards to RegEx\n   $key = str_replace('':any'', ''. '', str_replace('':num'', ''[0-9] '', $key));\n\n   // Does the RegEx match?\n   if (preg_match(''#^''.$key.''$#'', $uri))\n   {\n    // Do we have a back-reference?\n    if (strpos($val, ''$'') !== FALSE AND strpos($key, ''('') !== FALSE)\n    {\n     $val = preg_replace(''#^''.$key.''$#'', $val, $uri);\n    }\n\n    return $this->_set_request(explode(''/'', $val));\n   }\n  }\n\n  // If we got this far it means we didn''t encounter a\n  // matching route so we''ll set the site default route\n  $this->_set_request($this->uri->segments);\n }\n\n // --------------------------------------------------------------------\n\n /**\n  * Set the class name\n  *\n  * @access public\n  * @param string\n  * @return void\n  */\n function set_class($class)\n {\n  $this->class = str_replace(array(''/'', ''.''), '''', $class);\n }\n\n // --------------------------------------------------------------------\n\n /**\n  * Fetch the current class\n  *\n  * @access public\n  * @return string\n  */\n function fetch_class()\n {\n  return $this->class;\n }\n\n // --------------------------------------------------------------------\n\n /**\n  *  Set the method name\n  *\n  * @access public\n  * @param string\n  * @return void\n  */\n function set_method($method)\n {\n  $this->method = $method;\n }\n\n // --------------------------------------------------------------------\n\n /**\n  *  Fetch the current method\n  *\n  * @access public\n  * @return string\n  */\n function fetch_method()\n {\n  if ($this->method == $this->fetch_class())\n  {\n   return ''index'';\n  }\n\n  return $this->method;\n }\n\n // --------------------------------------------------------------------\n\n /**\n  *  Set the directory name\n  *\n  * @access public\n  * @param string\n  * @return void\n  */\n function set_directory($dir)\n {\n  $this->directory = str_replace(array(''/'', ''.''), '''', $dir).''/'';\n }\n\n // --------------------------------------------------------------------\n\n /**\n  *  Fetch the sub-directory (if any) that contains the requested controller class\n  *\n  * @access public\n  * @return string\n  */\n function fetch_directory()\n {\n  return $this->directory;\n }\n\n // --------------------------------------------------------------------\n\n /**\n  *  Set the controller overrides\n  *\n  * @access public\n  * @param array\n  * @return null\n  */\n function _set_overrides($routing)\n {\n  if ( ! is_array($routing))\n  {\n   return;\n  }\n\n  if (isset($routing[''directory'']))\n  {\n   $this->set_directory($routing[''directory'']);\n  }\n\n  if (isset($routing[''controller'']) AND $routing[''controller''] != '''')\n  {\n   $this->set_class($routing[''controller'']);\n  }\n\n  if (isset($routing[''function'']))\n  {\n   $routing[''function''] = ($routing[''function''] == '''') ? ''index'' : $routing[''function''];\n   $this->set_method($routing[''function'']);\n  }\n }\n\n\n}\n// END Router Class\n\n/* End of file Router.php */\n/* Location: ./system/core/Router.php */', '2012-12-26 06:41:05'),
(20, 5, 'qqqqq\nwwwww\neeeeee', '2012-12-26 06:41:15');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `wvd_history`
--
ALTER TABLE `wvd_history`
  ADD CONSTRAINT `wvd_history_FK_room_id` FOREIGN KEY (`room_id`) REFERENCES `wvd_room` (`id`),
  ADD CONSTRAINT `wvd_history_FK_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `wvd_user` (`id`);

--
-- Ограничения внешнего ключа таблицы `wvd_property`
--
ALTER TABLE `wvd_property`
  ADD CONSTRAINT `wvd_property_FK_block_id` FOREIGN KEY (`block_id`) REFERENCES `wvd_block` (`id`),
  ADD CONSTRAINT `wvd_property_FK_landlord_id` FOREIGN KEY (`landlord_id`) REFERENCES `wvd_user` (`id`);

--
-- Ограничения внешнего ключа таблицы `wvd_property_feature`
--
ALTER TABLE `wvd_property_feature`
  ADD CONSTRAINT `wvd_property_feature_FK_feature_id` FOREIGN KEY (`feature_id`) REFERENCES `wvd_feature` (`id`);

--
-- Ограничения внешнего ключа таблицы `wvd_room`
--
ALTER TABLE `wvd_room`
  ADD CONSTRAINT `wvd_room_FK_property_id` FOREIGN KEY (`property_id`) REFERENCES `wvd_property` (`id`);

--
-- Ограничения внешнего ключа таблицы `wvd_room_feature`
--
ALTER TABLE `wvd_room_feature`
  ADD CONSTRAINT `wvd_room_feature_FK_feature_id` FOREIGN KEY (`feature_id`) REFERENCES `wvd_feature` (`id`),
  ADD CONSTRAINT `wvd_room_feature_FK_room_id` FOREIGN KEY (`room_id`) REFERENCES `wvd_room` (`id`);

--
-- Ограничения внешнего ключа таблицы `wvd_room_photo`
--
ALTER TABLE `wvd_room_photo`
  ADD CONSTRAINT `wvd_room_photo_FK_room_id` FOREIGN KEY (`room_id`) REFERENCES `wvd_room` (`id`);

--
-- Ограничения внешнего ключа таблицы `wvd_tenant_guarantor`
--
ALTER TABLE `wvd_tenant_guarantor`
  ADD CONSTRAINT `wvd_tenant_guarantor_FK_guarantor_id` FOREIGN KEY (`guarantor_id`) REFERENCES `wvd_user` (`id`),
  ADD CONSTRAINT `wvd_tenant_guarantor_FK_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `wvd_user` (`id`);

--
-- Ограничения внешнего ключа таблицы `wvd_user_notes`
--
ALTER TABLE `wvd_user_notes`
  ADD CONSTRAINT `wvd_user_notes_FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `wvd_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

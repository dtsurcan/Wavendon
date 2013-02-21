-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 22 2012 г., 23:59
-- Версия сервера: 4.1.22
-- Версия PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `wavendon_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE IF NOT EXISTS `features` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(1, 'Fireplace'),
(2, 'Shower'),
(3, 'Bath'),
(4, 'Future name');

-- --------------------------------------------------------

--
-- Структура таблицы `guarantors`
--

DROP TABLE IF EXISTS `guarantors`;
CREATE TABLE IF NOT EXISTS `guarantors` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `tenant_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `guarantors`
--

INSERT INTO `guarantors` (`id`, `user_id`, `tenant_id`) VALUES
(1, 11, 2),
(2, 13, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `from_date` date NOT NULL default '0000-00-00',
  `to_date` date NOT NULL default '0000-00-00',
  `text` text NOT NULL,
  `room_id` int(11) NOT NULL default '0',
  `landlord_id` int(11) NOT NULL default '0',
  `weekly_rate` float NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `history`
--

INSERT INTO `history` (`id`, `from_date`, `to_date`, `text`, `room_id`, `landlord_id`, `weekly_rate`) VALUES
(1, '2012-10-16', '2012-10-31', 'Teeeeeeeeeeeeeeeeeexxxxxxxxxxtttttttttttttttttttt', 3, 5, 220);

-- --------------------------------------------------------

--
-- Структура таблицы `landlords`
--

DROP TABLE IF EXISTS `landlords`;
CREATE TABLE IF NOT EXISTS `landlords` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `landlords`
--

INSERT INTO `landlords` (`id`, `user_id`) VALUES
(4, 5),
(7, 8),
(8, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `text` text NOT NULL,
  `date` date NOT NULL default '0000-00-00',
  `user_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `notes`
--


-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `link` varchar(200) NOT NULL default '',
  `description` text NOT NULL,
  `room_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `photos`
--


-- --------------------------------------------------------

--
-- Структура таблицы `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `landlord_id` int(11) NOT NULL default '0',
  `address` text NOT NULL,
  `type` varchar(20) NOT NULL default '',
  `block` text NOT NULL,
  `rooms_number` int(3) NOT NULL default '0',
  `rooms_vacant` text NOT NULL,
  `tenants_currently_in` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `properties`
--

INSERT INTO `properties` (`id`, `landlord_id`, `address`, `type`, `block`, `rooms_number`, `rooms_vacant`, `tenants_currently_in`) VALUES
(2, 8, 'Брамптон, Камбрия CA8 7AU, Великобритания', 'flat', '', 1, '1', 0),
(3, 8, 'Брамптон, Камбрия CA8 7AU, Великобритания', 'flat', '', 1, '1', 0),
(4, 8, 'Брамптон, Камбрия CA8 7AU, Великобритания', 'flat', '', 1, '1', 0),
(5, 8, 'Брамптон, Камбрия CA8 7AU, Великобритания', 'flat', '', 1, '1', 0),
(6, 8, 'Брамптон, Камбрия CA8 7AU, Великобритания', 'flat', '', 1, '1', 0),
(7, 8, 'Брамптон, Камбрия CA8 7AU, Великобритания', 'flat', '', 1, '1', 0),
(8, 8, 'Брамптон, Камбрия CA8 7AU, Великобритания', 'flat', '', 1, '1', 0),
(9, 8, 'Брамптон, Камбрия CA8 7AU, Великобритания', 'flat', '', 1, '1', 0),
(10, 8, '438 summerwood road isleworth', 'flat', '', 1, '1', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `map` int(11) NOT NULL default '0',
  `features` text NOT NULL,
  `size` float NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `description` text NOT NULL,
  `weekly_rate` float NOT NULL default '0',
  `revenue` float NOT NULL default '0',
  `property_id` int(11) NOT NULL default '0',
  `status` varchar(30) NOT NULL default '',
  `unavailable_descr` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `map`, `features`, `size`, `name`, `description`, `weekly_rate`, `revenue`, `property_id`, `status`, `unavailable_descr`) VALUES
(3, 0, '', 300, 'Number_12', 'RoomDescription', 200, 100, 8, 'Available', ''),
(4, 0, '', 300, 'Number_12', 'RoomDescription', 200, 100, 9, 'Available', '');

-- --------------------------------------------------------

--
-- Структура таблицы `room_feature`
--

DROP TABLE IF EXISTS `room_feature`;
CREATE TABLE IF NOT EXISTS `room_feature` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `future_id` int(11) NOT NULL default '0',
  `room_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `room_feature`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tenants`
--

DROP TABLE IF EXISTS `tenants`;
CREATE TABLE IF NOT EXISTS `tenants` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `room_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tenants`
--

INSERT INTO `tenants` (`id`, `user_id`, `room_id`) VALUES
(2, 10, 3),
(3, 12, 0),
(4, 14, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `type` varchar(100) NOT NULL default '',
  `login` varchar(50) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `salt` varchar(3) NOT NULL default '',
  `email` varchar(200) NOT NULL default '',
  `title` varchar(15) NOT NULL default '',
  `first_name` varchar(100) NOT NULL default '',
  `middle_name` varchar(100) NOT NULL default '',
  `last_name` varchar(100) NOT NULL default '',
  `photo` text NOT NULL,
  `copy_dln` text NOT NULL,
  `copy_passport` text NOT NULL,
  `passport` varchar(40) NOT NULL default '',
  `dln` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `type`, `login`, `password`, `salt`, `email`, `title`, `first_name`, `middle_name`, `last_name`, `photo`, `copy_dln`, `copy_passport`, `passport`, `dln`) VALUES
(5, '', '', '', '', '', '', 'asdasd', 'ASdasd', 'adada', '', '', '', '', ''),
(8, '', '', '', '', '', 'asdasda', 'asdas', 'ewfwe', 'fewfew', '', '', '', '', ''),
(9, '', '', '', '', '', 'tenant', 'FName', 'MName', 'LName', '', '', '', '', ''),
(10, '', '', '', '', '', '', 'фывфывфывф', '', '', '', '', '', '', ''),
(11, '', '', '', '', '', 'ф!', 'еококеокео', 'выавы', 'ывавы', '', '', '', '', ''),
(12, '', '', '', '', '', '', 'kslngsng', 'ekn;erlhmel;', 'rkehnerkl;nh', '', '', '', '', ''),
(13, '', '', '', '', '', 'G', 'asdasf', 'egweg', 'efaefs', '', '', '', '', ''),
(14, '', '', '', '', '', '', 'TenantName', 'TenantMName', 'TenantLName', '', '', '', '', '');

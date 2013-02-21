
CREATE TABLE IF NOT EXISTS `feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

alter TABLE  `feature`
  add UNIQUE KEY `ind_feature_name`(`name`);

INSERT INTO `feature` (`id`, `name`, `created_at`) VALUES
(1, 'Fireplace', '2012-02-12 12:11:08'),
(2, 'Shower', '2012-04-15 10:01:06'),
(3, 'Bath', '2012-04-15 09:10:48'),
(4, 'Future name', '2012-02-12 12:11:08');


alter TABLE `feature` (
  add column `type` varchar(10) NOT NULL DEFAULT 'property' after `name` ;
  

alter TABLE  `feature`
  add KEY `ind_feature_type`(`type`);



CREATE TABLE IF NOT EXISTS `property` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `landlord_id` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT '',
  `block` int(1) NOT NULL default 0,
  `rooms_number` int(3) NOT NULL DEFAULT '0',
  `rooms_vacant` text NOT NULL,
  `tenants_currently_in` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

alter TABLE `property`
  add CONSTRAINT `property_FK_landlord_id`
    FOREIGN KEY (`landlord_id`)
    REFERENCES `user` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;


INSERT INTO `property` (`id`, `landlord_id`, `address`, `type`, `block`, `rooms_number`, `rooms_vacant`, `tenants_currently_in`, `created_at` ) VALUES
(2, 4, 'Brampton, Kambriya CA8 7AU, UK', 'flat', 0, 1, '1', 0, '2012-02-12 12:11:08' ),
(3, 8, 'Brampton, Kambriya CA8 UYU, UK', 'house', 1, 1, '1', 0, '2012-02-11 12:10:08'),
(4, 8, 'Brampton, Kambriya CA8 &YAU, UK', 'flat', 1, 1, '1', 0, '2012-04-15 10:01:06'),
(5, 3, 'Brampton, Kambriya CA8 $%AU, UK', 'house', 0, 1, '1', 0, '2012-02-12 12:11:08'),
(6, 8, 'Brampton, Kambriya CA8 7EWU, UK', 'flat', 0, 1, '1', 0, '2012-12-12 02:11:28'),
(7, 5, 'Brampton, Kambriya CA8 FEU, UK', 'flat', 1, 1, '1', 0, '2012-04-15 09:10:48'),
(8, 8, 'Brampton, Kambriya CA8 56U, UK', 'flat', 0, 1, '1', 0, '2012-02-12 12:11:08'),
(9, 7, 'Brampton, Kambriya CA8 23AU, UK', 'house', 1, 1, '1', 0, '2012-02-12 12:11:08'),
(10, 8, '438 summerwood road isleworth', 'flat', 1, 1, '1', 0, '2012-06-22 10:10:38');




CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8_unicode_ci NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `photo` longtext COLLATE utf8_unicode_ci NULL,
  `copy_dln` longtext COLLATE utf8_unicode_ci NULL,
  `copy_passport` longtext COLLATE utf8_unicode_ci NULL,
  `passport` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dln` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `ind_user_username` (`username`),
  UNIQUE KEY `ind_user_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`,  `username`, `password`, `email`, `type`, `title`, `first_name`, `middle_name`, `last_name`, `photo`, `copy_dln`,
  `copy_passport`, `passport`, `dln`, `created_at`, `updated_at`) VALUES
(1, 'Tenant_1', 'tenant_1', 'Tenant@mail.com', 'tenant', 'Mr', 'First name_1', 'Middle name_1', 'Last name_1', 'Photo', 'Copy dln', 'Copy passport', 'Passport', 'Dln', '2007-01-01 00:00:00', NULL),
(2, 'Landlord_1', 'Landlord_User1', 'Landlord@mail.com', 'landlord',  'Mr', 'FirstName_1', 'Middle_name_1', 'Last_name', 'photo', '11', '3222', '333', '444', '2012-11-21', '2012-11-21' ),
(3, 'guarantor_3', 'guarantor_User1', 'guarantor3@mail.com', 'guarantor',  'Mr', 'FirstName_3', 'Middle_name_3', 'Last_name_3', 'photo_3', '23', '333', '33-o3', 'sder', '2012-11-21', '2012-11-21' ),
(4, 'Landlord_4', 'Landlord_User4', 'Landlord_4@mail.com', 'landlord',  'Mr', 'FirstName_4', 'Middle_name_4', 'Last_name_4', 'photo_4', '11', '3222', '333', '444', '2012-11-21', '2012-11-21' ),
(5, 'Landlord_5', 'Landlord_User5', 'Landlord_5@mail.com', 'landlord',  'Mr', 'FirstName_5', 'Middle_name_5', 'Last_name_5', 'photo_5', '11', '3222', '333', '444', '2012-11-21', '2012-11-21' );


alter TABLE `user`
  drop column `photo`;

alter TABLE `user`
  drop column `copy_dln`;

alter TABLE `user`
  drop column `copy_passport`;


alter TABLE `user`
  add column `photo` varchar(100) COLLATE utf8_unicode_ci NULL after `last_name`;

alter TABLE `user`
  add column `copy_dln` varchar(100) COLLATE utf8_unicode_ci NULL after `photo`;

alter TABLE `user`
  add column `copy_passport` varchar(100) COLLATE utf8_unicode_ci NULL after `copy_dln`;


CREATE TABLE IF NOT EXISTS `property_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

alter TABLE  `property_feature`
  add UNIQUE KEY `ind_property_feature`(`property_id`, `feature_id`);

alter TABLE `property_feature`
  add CONSTRAINT `property_feature_FK_feature_id`
    FOREIGN KEY (`feature_id`)
    REFERENCES `feature` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;


alter TABLE `property_feature`
  add CONSTRAINT `property_feature_FK_property_id`
    FOREIGN KEY (`property_id`)
    REFERENCES `property` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;



INSERT INTO `property_feature` (`id`, `property_id`, `feature_id`, `created_at`) VALUES
(1, 4, 1, '2012-02-12 12:11:08'),
(2, 4, 2, '2012-04-15 10:01:06'),
(3, 7, 1, '2012-04-15 09:10:48'),
(4, 7, 2, '2012-02-12 12:11:08');




- Map of the room layout
- Additional Photos ( as many as we want ) with a description for each photo
- Features ( The admin should be able to dynamically add features/facilities (
fireplace, shower, bath etc ) available and then they can be added to the room
by checking the appropriate checkboxes )
- size of the room ( square meters )
- Room Number/Name
- A history of all tenants that have been living in the room and when  !!!
- Description of the room
- Weekly Room Rate (£)
- Revenue generated to date (£)
- Property that the room is in
- Status: Available/Occupied/Unavailable (if unavailable a description should be
provided about why).


DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(2) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NULL,
  `weekly_rate` float NOT NULL,
  `revenue` float NOT NULL default 0,
  `status` enum('A','O','U') COLLATE utf8_unicode_ci NOT NULL,
  `status_description` varchar(255) COLLATE utf8_unicode_ci NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key_room_property_id` (`property_id`),
  UNIQUE KEY `ind_room`(`property_id`, `name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


ALTER TABLE `room`
  ADD CONSTRAINT `room_FK_property_id` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`);



INSERT INTO wavendon_props.room (property_id, name, size, description, weekly_rate, revenue, status, status_description, updated_at, created_at)
VALUES (4, 'Bedroom', 12, 'Bedroom description...', 200, 0, 'A', '', '2012-09-23', '2012-09-23'),
(4, 'Kitchen', 12, 'Kitchen description...', 250, 100, 'A', 'O', '2012-11-22', '2012-09-23'),
 (4, 'Living Room # 1, 22 meters', 22, 'Living Room # 1, 22 meters description...', 200, 0, 'A', '', '2012-09-23', '2012-09-23'),
(4, 'Living Room # 2, 25 meters', 25, 'Living Room # 2, 25 meters description...', 250, 0, 'O', '', '2012-09-23', '2012-09-23'),
(4, 'Living Room # 3, 20 meters', 20, 'Living Room # 3, 20 meters description...', 180, 0, 'U', 'Romm is in repair', '2012-07-14', '2012-07-14');


DROP TABLE IF EXISTS `history` ;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_date` date NOT NULL,
  `to_date` date NULL,
  `room_id` int(10) unsigned NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `weekly_rate` float NOT NULL,
  `text` text NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `history`
  ADD CONSTRAINT `history_FK_room_id` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`);

ALTER TABLE `history`
  ADD CONSTRAINT `history_FK_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `user` (`id`);



INSERT INTO `history` (`id`, `from_date`, `to_date`, `text`, `room_id`, `tenant_id`, `weekly_rate`, `created_at` ) VALUES
(1, '2010-02-16', '2011-10-31', 'history text # 1', 4, 1, 220, '2011-10-31'),
(2, '2010-03-16', '2011-12-22', 'history text # 2', 6, 6, 240, '2011-12-22'),
(3, '2010-10-16', '2012-01-21', 'history text # 3', 5, 7, 250, '2012-01-21'),
(4, '2011-12-22', null, 'history text # 4', 6, 6, 240, '2012-09-23'),
(5, '2012-01-21', null, 'history text # 5', 5, 7, 250, '2012-01-21');







drop TABLE IF  EXISTS `room_photo`;
CREATE TABLE IF NOT EXISTS `room_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(10) unsigned NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci not NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

alter TABLE  `room_photo`
  add UNIQUE KEY `ind_room_photo`(`room_id`, `photo`);

alter TABLE  `room_photo_`
  add KEY `ind_room_photo_room_id`(`room_id`);


alter TABLE `room_photo`
  add CONSTRAINT `room_photo_FK_room_id`
    FOREIGN KEY (`room_id`)
    REFERENCES `room` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;




CREATE TABLE IF NOT EXISTS `tenant_guarantor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenant_id` int(11) NOT NULL,
  `guarantor_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

alter TABLE  `tenant_guarantor`
  add UNIQUE KEY `ind_tenant_guarantor`(`tenant_id`, `guarantor_id`);

alter TABLE `tenant_guarantor`
  add CONSTRAINT `tenant_guarantor_FK_tenant_id`
    FOREIGN KEY (`tenant_id`)
    REFERENCES `user` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;


alter TABLE `tenant_guarantor`
  add CONSTRAINT `tenant_guarantor_FK_guarantor_id`
    FOREIGN KEY (`guarantor_id`)
    REFERENCES `user` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;


CREATE TABLE IF NOT EXISTS `user_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notes` text NOT NULL,  
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
    
alter TABLE  `user_notes`
  add KEY `ind_user_notes_user_id`(`user_id`);
  
alter TABLE `user_notes`
  add CONSTRAINT `user_notes_FK_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;
  

    
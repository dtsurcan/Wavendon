

DROP TABLE IF EXISTS `wvd_room_tenant` ;
CREATE TABLE IF NOT EXISTS `wvd_room_tenant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_date` date NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `weekly_rate` float NOT NULL,
  `text` text NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `wvd_room_tenant`
  ADD CONSTRAINT `wvd_room_tenant_FK_room_id` FOREIGN KEY (`room_id`) REFERENCES `wvd_room` (`id`);

ALTER TABLE `wvd_room_tenant`
  ADD CONSTRAINT `wvd_room_tenant_FK_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `wvd_user` (`id`);



INSERT INTO `wvd_room_tenant` (`id`, `from_date`, `text`, `room_id`, `tenant_id`, `weekly_rate`, `created_at` ) VALUES
(1, '2010-02-16', 'room tenant text # 1', 17, 1, 220, '2011-10-31'),
(2, '2010-03-16', 'room tenant text # 2', 30, 6, 240, '2011-12-22'),
(3, '2010-10-16', 'room tenant text # 3', 17, 9, 250, '2012-01-21'),
(4, '2011-12-22', 'room tenant text # 4', 17, 7, 240, '2012-09-23'),
(5, '2012-01-21', 'room tenant text # 5', 30, 13, 250, '2012-01-21');


alter TABLE `wvd_room` 
  add column `max_tenants` int(2) NOT NULL after `size`;
  
Each Room can have 1 or more tenants ( a maxmimum number of tenants is defined
per room)


alter TABLE `wvd_property`
  add column `updated_at` datetime DEFAULT NULL after `created_at`;
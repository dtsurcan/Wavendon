
CREATE TABLE IF NOT EXISTS `block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

alter TABLE  `block`
  add UNIQUE KEY `ind_block_name`(`name`);

INSERT INTO `block` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Block # 1', 'Block # 1 description...', '2012-02-12 12:11:08'),
(2, 'Block # 2', 'Block # 2 description...', '2012-04-15 10:01:06'),
(3, 'Block # 3', 'Block # 3 description...', '2012-04-15 09:10:48'),
(4, 'Block # 4', 'Block # 4 description...', '2012-02-12 12:11:08');






drop TABLE IF EXISTS `block_property`;
CREATE TABLE IF NOT EXISTS `block_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `block_id` int(11) NOT NULL,
  `property_id` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

alter TABLE  `block_property`
  add UNIQUE KEY `ind_block_property`(`block_id`, `property_id`);

alter TABLE `block_property`
  add CONSTRAINT `block_property_FK_property_id`
    FOREIGN KEY (`property_id`)
    REFERENCES `property` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;


alter TABLE `block_property`
  add CONSTRAINT `block_property_FK_block_id`
    FOREIGN KEY (`block_id`)
    REFERENCES `block` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;




INSERT INTO `block_property` (`id`, `block_id`, `property_id`, `created_at`) VALUES
(1, 2, 7, '2012-02-12 12:11:08'),
(2, 2, 8, '2012-04-15 10:01:06'),
(3, 1, 7, '2012-04-15 09:10:48'),
(4, 1, 8, '2012-02-12 12:11:08');


alter TABLE `property` 
  drop column `block`;

drop TABLE IF EXISTS `block_property`;  


CREATE TABLE IF NOT EXISTS `property` (
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

    
    
    
alter TABLE `property` 
  `block_id` int(11) NULL after `type`;
  
alter TABLE  `property`
  add KEY `ind_property_block_id`(`block_id`);  
  
alter TABLE `property`
  add CONSTRAINT `property_FK_block_id`
    FOREIGN KEY (`block_id`)
    REFERENCES `block` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;
    
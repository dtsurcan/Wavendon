update `wvd_user` set `passport`= concat('passport_' ,id);

update `wvd_user` set `dln`= concat('dln_' ,id);


alter TABLE `wvd_user`
  add UNIQUE KEY `ind_wvd_user_passport` (`passport`);
  
alter TABLE `wvd_user`
  add UNIQUE KEY `ind_wvd_user_dln` (`dln`);
  
  
  
alter TABLE `wvd_user`
  alter `password` `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL default '';
  
  
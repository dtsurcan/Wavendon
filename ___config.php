<?php
$db_host = "localhost";
$db_user = "wavendon_user";
$db_pass = "wavendon_1Qwert";
$db_name = "wavendon_db";
mysql_connect("$db_host", "$db_user", "$db_pass") or die (mysql_error());
mysql_select_db("$db_name") or die (mysql_error());
mysql_query("SET NAMES utf8") or die(mysql_error());
?>
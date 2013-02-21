<?php
class DB
{
    //Database
    private $db_host = "localhost";
    private $db_name = "wavendon_db";
    private $db_user = "wavendon_user";
    private $db_pass = "wavendon_1Qwert";
    private $DBH;

    //Creating class
    function __construct() {
        mysql_connect($this->db_host, $this->db_user, $this->db_pass) or die (mysql_error());
        mysql_select_db($this->db_name) or die (mysql_error());
        mysql_query("SET NAMES utf8") or die(mysql_error());
    }
}
?>
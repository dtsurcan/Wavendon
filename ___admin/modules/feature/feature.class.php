<?php
include_once('../admin/modules/aModule.class.php');
require_once '../mysql.php';

class feature extends aModule
{
	function execute($arr) {

        $mysql = "
            SELECT id, name
            FROM features
            ORDER BY name
        ";
        $features = rows($mysql);

        $_SESSION['smarty']->assign('features', $features);

        $class =get_class();
        $realpath = realpath("../admin/modules/".$class."/".$class.".tpl");
		$_SESSION['smarty']->display($realpath);
	}
}
?>
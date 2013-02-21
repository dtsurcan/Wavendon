<?php
include_once('../admin/modules/aModule.class.php');
require_once '../mysql.php';

class viewuser extends aModule
{
	function execute($arr) {
        $category = $_GET['category'];
        $id = $_GET['id'];
        $mysql_user = "
            SELECT *
            FROM user
            WHERE id = $id
            LIMIT 1
        ";
        $query_user = row($mysql_user);

        $_SESSION['smarty']->assign('action', $_GET['action']);
        $_SESSION['smarty']->assign('viewuser', $query_user);

        $class =get_class();
        $realpath = realpath("../admin/modules/".$class."/".$class.".tpl");
		$_SESSION['smarty']->display($realpath);
	}
}
?>
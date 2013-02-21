<?php
include_once('../admin/modules/aModule.class.php');
require_once '../mysql.php';

class room extends aModule
{
	function execute($arr) {

       $id = $_GET['id'];

        $mysql = "
            SELECT id, size, name, description, weekly_rate, revenue, property_id, status
            FROM rooms
            WHERE id = $id
        ";
        $room = row($mysql);

        $_SESSION['smarty']->assign('room', $room);

        $class =get_class();
        $realpath = realpath("../admin/modules/".$class."/".$class.".tpl");
		$_SESSION['smarty']->display($realpath);
	}
}
?>
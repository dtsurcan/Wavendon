<?php
include_once('../admin/modules/aModule.class.php');
require_once '../mysql.php';

class history extends aModule
{
	function execute($arr) {

        $mysql = "
            SELECT landlords.id, landlords.user_id, user.id, user.first_name, user.last_name, user.middle_name, history.id, history.from_date, history.to_date, history.`text`, history.room_id, history.landlord_id, history.weekly_rate, rooms.id AS ROOMID, rooms.name
            FROM
                user
            INNER JOIN history
                ON history.landlord_id = user.id
            INNER JOIN landlords
                ON user.id = landlords.user_id
            INNER JOIN rooms
                ON history.room_id = rooms.id
            ORDER BY to_date
        ";
        $history = rows($mysql);

        $_SESSION['smarty']->assign('history', $history);

        $class =get_class();
        $realpath = realpath("../admin/modules/".$class."/".$class.".tpl");
		$_SESSION['smarty']->display($realpath);
	}
}
?>
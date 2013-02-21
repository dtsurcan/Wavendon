<?php
include_once('../admin/modules/aModule.class.php');
require_once '../mysql.php';

class property extends aModule
{
	function execute($arr) {
        //echo "<pre>"; print_r($arr);echo "</pre>"; // die();

        if($userid && $user_id != "") {
            $where = " WHERE user.id = $userid ";
        }
        $mysql_user = "
            SELECT
                user.id,
                user.first_name,
                user.last_name,
                landlords.user_id
            FROM
                user
            $where
            INNER JOIN landlords
            ON user.id = landlords.user_id
            ORDER BY user.first_name
        ";
        $query_user = rows($mysql_user);
        $_SESSION['smarty']->assign('user_select', $query_user);

        $class =get_class();
        $realpath = realpath("../admin/modules/".$class."/".$class.".tpl");
		$_SESSION['smarty']->display($realpath);
	}
}
?>
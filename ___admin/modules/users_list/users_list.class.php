<?php
include_once('../admin/modules/aModule.class.php');
require_once '../mysql.php';

class users_list extends aModule
{
	function execute($arr) {
        $id = $_GET['id'];
        if($id && $id != "") {
            $where = " WHERE user.id = $id";
        }
        $category = $_GET['category'];
        if($category == 'tenants') {
            $mysql_user = "
                SELECT t_u.id AS u_id
                     , t_u.first_name AS u_fn
                     , t_u.middle_name AS u_mn
                     , t_u.last_name AS u_ln
                     , t_ut.id AS t_id
                     , t_ut.first_name AS t_fn
                     , t_ut.middle_name AS t_mn
                     , t_ut.last_name AS t_ln
                     , tenants.id
                     , guarantors.id
                FROM
                  tenants
                LEFT OUTER JOIN guarantors
                ON guarantors.tenant_id = tenants.id
                LEFT OUTER JOIN user t_ut
                ON tenants.user_id = t_ut.id
                LEFT OUTER JOIN user t_u
                ON t_u.id = guarantors.user_id
                $where
            ";
        } elseif($category == 'guarantors') {
            $mysql_user = "
                SELECT t_u.id AS u_id
                     , t_u.first_name AS u_fn
                     , t_u.middle_name AS u_mn
                     , t_u.last_name AS u_ln
                     , t_ut.id AS t_id
                     , t_ut.first_name AS t_fn
                     , t_ut.middle_name AS t_mn
                     , t_ut.last_name AS t_ln
                     , tenants.id
                     , guarantors.id
                FROM
                  tenants
                LEFT OUTER JOIN guarantors
                ON guarantors.tenant_id = tenants.id
                LEFT OUTER JOIN user t_u
                ON tenants.user_id = t_u.id
                LEFT OUTER JOIN user t_ut
                ON t_ut.id = guarantors.user_id
                $where
            ";
        }
        $query_user = rows($mysql_user);

        $_SESSION['smarty']->assign('action', $_GET['action']);
        $_SESSION['smarty']->assign('users_list', $query_user);

        $class =get_class();
        $realpath = realpath("../admin/modules/".$class."/".$class.".tpl");
		$_SESSION['smarty']->display($realpath);
	}
}
?>
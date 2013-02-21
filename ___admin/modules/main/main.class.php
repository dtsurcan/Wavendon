<?php
include_once('../admin/modules/aModule.class.php');

class main extends aModule
{
	function execute($arr) {
        //echo "<pre>"; print_r($arr);echo "</pre>"; // die();

        $action = $_GET['action'];
        $category = $_GET['category'];
        $_SESSION['smarty']->assign('action', $_GET['action']);
        $_SESSION['smarty']->assign('category', $_GET['category']);


		/*
		$action = $_GET['action'];
		if($action == 'users') {
			require_once 'users.php';
		} elseif($action == 'property') {
			require_once 'addproperty.php';
			require_once 'addfeature.php';
		}

      //  $_SESSION['smarty']->assign('menu_v',$this->getNodeChildren(1));
      //  $_SESSION['smarty']->assign('page', $arr['send_params']['page']);


*/

        if($action == 'users') {
            $module = 'users_list';
        } elseif ($action == 'property') {
            $module = 'property';
        } elseif ($action == 'viewuser') {
            $module = 'viewuser';
        } elseif ($action == 'feature') {
            $module = 'feature';
        } elseif ($action == 'room') {
            $module = 'room';
        } else {
            $module = 'history';
        }

        $_SESSION['smarty']->assign('module', $module);
        $class = get_class();
        $realpath = realpath("../admin/modules/".$class."/".$class.".tpl");
		$_SESSION['smarty']->display($realpath);
	}
}
?>
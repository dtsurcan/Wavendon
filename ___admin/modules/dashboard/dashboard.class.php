<?php
include_once('../admin/modules/aModule.class.php');
require_once '../mysql.php';

class dashboard extends aModule
{
	function execute($arr) {

        $action = $_GET['action'];
        $category = $_GET['category'];
        $id = $_GET['id'];

        $dashboard = array('action', 'category');

        if($action == 'users') {
            $dashboard['action'] = 'Users';
            $dashboard['category'] = ucfirst($category);
        } elseif ($action == 'property') {
            $dashboard['action'] = 'Property';
        } elseif ($action == 'viewuser') {
            $dashboard['action'] = 'Veiw User';
        } elseif ($action == 'feature') {
            $dashboard['action'] = 'Feature';
        } elseif ($action == 'room') {
            $dashboard['action'] = 'Room';
        } else {
            $dashboard['action'] = 'History';
        }

        $_SESSION['smarty']->assign('dashboard', $dashboard);

        $class =get_class();
        $realpath = realpath("../admin/modules/".$class."/".$class.".tpl");
		$_SESSION['smarty']->display($realpath);
	}
}
?>
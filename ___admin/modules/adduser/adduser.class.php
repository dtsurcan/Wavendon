<?php
include_once('../admin/modules/aModule.class.php');

class adduser extends aModule
{
	function execute($arr) {
        //echo "<pre>"; print_r($arr);echo "</pre>"; // die();

        $class = get_class();
        $realpath = realpath("../admin/modules/".$class."/".$class.".tpl");
		$_SESSION['smarty']->display($realpath);
	}
}
?>
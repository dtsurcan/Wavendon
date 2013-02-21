<?php
include_once('aModule.class.php');

class mod extends aModule
{
	var $mod_name=null;
	function execute($arr)
	{
		$this->mod_display_from_base();
	}
}

?>
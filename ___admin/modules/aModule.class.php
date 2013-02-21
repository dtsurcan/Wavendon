<?php

include_once('lib/JSON.php');

class aModule{
	var $action = "";

	function mod_execute($params,$protocol='HTTP'){

		$this->mod_name=$params['mod_name'];
		$this->action=$params['action'];
		$this->prot=$protocol;

		$send_params=($_SERVER["REQUEST_METHOD"] == "POST")? $_POST	: $_GET;
		$params['send_params'] = $send_params;

		$this->execute($params);
	}

	function mod_display($protocol){
		$tpl_path=$this->mod_name.'/'.$this->mod_name.'.tpl';

		switch($protocol){

			case 'HTTP': $_SESSION['smarty']->display($tpl_path);
			break;

			case 'AJAX': $output=$_SESSION['smarty']->fetch($tpl_path);
						 $this->mod_responceXML($output);
			break;
		}
	}

	function mod_display_from_base(){

    $_SESSION['smarty']->register_resource("db2", array("db2_get_template",
                                       "db2_get_timestamp",
                                       "db2_get_secure",
                                       "db2_get_trusted"));

    $_SESSION['smarty']->display("db2:".$this->mod_name);

	}

}

	class Page
	{
		var $args;
		var $main_template;
		var $redirect_timeout;
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        function getMenuNodes($id=0)
        {
        	$result=rows("SELECT id,title,image FROM `tree` WHERE `parent_id` = ".$id." AND status <> 4 ORDER BY `sort` ASC ");
            return $result;
        }
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        function getPageChildren($id=0)
        {
        	$result = rows("SELECT * FROM `pages` WHERE `parent_id` = ".$id." ORDER BY `sort` ASC ");
            return $result;
        }
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        function getChildren($id=0)
        {
        	$result = rows("SELECT * FROM `tree` WHERE `parent_id` = ".$id." ORDER BY `sort` ASC ");
            return $result;
        }
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        function getNode($id=0)
        {
        	$result = rows("SELECT * FROM `tree` WHERE `id` = ".$id." ORDER BY `sort` ASC ");
            return $result;
        }
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		function Page($main_template = NULL)
		{
			$this->Init();
		}
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		function Init()
		{
			$this->main_template = NULL;
			$this->args = array();
			$this->args[__PAGE_CONTENT_REPLACEMENT__] = "";
			$this->args[__PAGE_TITLE_REPLACEMENT__] = "";
			$this->redirect_timeout = NULL;
		}
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        function getRequest()
        {
    		$params = array_merge($_GET, $_POST);
    		reset($params);
    		while(list($key,$value) = each($params)){
    			if (gettype($params[$key]) != "array"){
                    if (get_magic_quotes_gpc()){
                        $value = stripslashes(trim($value));
                    }
                    $params[$key] = $value;
    			}
    		}

            return $params;
        }
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		function assign($arg, $value = NULL)
		{
			if ($value === NULL && is_array($arg)){
				foreach($arg as $_name => $_value){
					$this->_assignArg($_name, $_value);
				}
			}else{
				$this->_assignArg($arg, $value);
			}
		}
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		function setMainTemplate($main_template)
		{
			$this->main_template = $main_template;
		}
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		function setTitle($value)
		{
			$this->args[__PAGE_TITLE_REPLACEMENT__] = $value;
		}
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		function setContent($value)
		{
			$this->args[__PAGE_CONTENT_REPLACEMENT__] = $value;
		}
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        function setRedirectTimeout($timeout = 10000){
        	if ( !is_int($timeout) ) return false;
        	else $this->redirect_timeout = $timeout;

        	return true;
		}
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		function getPage($main_template = NULL)
		{
			if ($main_template === NULL){
				if ($this->main_template !== NULL) $main_template = $this->main_template;
				else BaseError :: setFatalError("No Main Template Name specified.",__FILE__,"Page","getPage",__LINE__);
			}
			//__________________________________________________________________________


			//$smarty = new Smarty();
			if (isset($this->args) && is_array($this->args) && sizeof($this->args) != 0){
				$smarty->assign($this->args);

			}
	      //  $smarty->assign("SITE_URL",SITE_URL);
          //  $default_charset =  Settings :: SettingVar("default_charset","iso-8859-1");
          //  $smarty->assign("__PAGE_CHARSET_REPLACEMENT__",$default_charset);


            return $smarty->fetch($main_template);

		}
		//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		function getRedirect($redirect_msg, $redirect_url, $redirect_template = "redirect.tpl", $main_template = NULL)
		{
			if ( $this->redirect_timeout === NULL || !is_int($this->redirect_timeout) ){
				$this->setRedirectTimeout(10000);
			}
			$this->assign("__PAGE_REDIRECT_TIMEOUT_REPLACEMENT__",$this->redirect_timeout);
			$this->assign("__PAGE_REDIRECT_MESSAGE_REPLACEMENT__",$redirect_msg);
			$this->assign("__PAGE_REDIRECT_URL_REPLACEMENT__",$redirect_url);
			//__________________________________________________________________________
			$smarty =new smarty();
			if (isset($this->args) && is_array($this->args) && sizeof($this->args) != 0){
				$smarty->assign($this->args);
			}
	        $smarty->assign("SITE_URL",SITE_URL);
	        $this->setContent($smarty->fetch('redirect.tpl'));
	        return $this->getPage($main_template);
		}
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		function _assignArg($arg, $value)
		{
			$this->args[$arg] = $value;
		}
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	}

?>
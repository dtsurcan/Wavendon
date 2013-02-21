<?php
function smarty_function_mod($params, &$smarty){

	if (!isset($params['mod_name'])) {
		$smarty->trigger_error("aa: missing 'mod_name'");
		return;
	}

	$modname=$params['mod_name'];
	$action=$params['action'];

	$session_name=$modname."_".random_chars(); //$modname."__".$action;

	if(!isset($_SESSION[$session_name])) $_SESSION[$session_name]=$params;

	if (!isset($params['action']))
    {
        $mod_path='../admin/modules/mod.class.php';
        include_once($mod_path);

        $oMod=new mod;
        $oMod->mod_execute($_SESSION[$session_name]);
	}
    else
    {
        $mod_path='../admin/modules/'.$modname.'/'.$modname.'.class.php';
        include_once($mod_path);

        $oMod=new $modname;
        $oMod->mod_execute($_SESSION[$session_name]);
    }
}

	function random_chars($num = 5)
	{
        //To Pull 7 Unique Random Values Out Of AlphaNumeric

        //removed number 0, capital o, number 1 and small L
        //Total: keys = 32, elements = 33
        $characters = array(
        "A","B","C","D","E","F","G","H","J","K","L","M",
        "N","P","Q","R","S","T","U","V","W","X","Y","Z",
        "1","2","3","4","5","6","7","8","9");

        //make an "empty container" or array for our keys
        $keys = array();

        //first count of $keys is empty so "1", remaining count is 1-6 = total 7 times
        while(count($keys) < $num) {
            //"0" because we use this to FIND ARRAY KEYS which has a 0 value
            //"-1" because were only concerned of number of keys which is 32 not 33
            //count($characters) = 33
            $x = mt_rand(0, count($characters)-1);
            if(!in_array($x, $keys)) {
               $keys[] = $x;
            }
        }

        foreach($keys as $key){
           $random_chars .= $characters[$key];
        }

        return $random_chars;
    }
?>
<?php
//Start SESSION
session_start();

//Require files
require_once "../config.php";
require_once "../mysql.php";

//Class
$class_dir = "class";
$class_real_dir = realpath($class_dir);
require_once $class_real_dir . "/users.class.php";
$user = new Users;

//Smarty
$smarty_dir = "lib/smarty/Smarty.class.php"; //Relative path to Smarty
$tpl_dir = "modules"; //Relative path to Templates
$tpl_real_dir = realpath($tpl_dir); //Absolute path (from root) to Templates
require_once($smarty_dir); //Connect Smarty
$smarty = new Smarty(); //Smarty class instance
$smarty->template_dir = $tpl_real_dir; //Change defoult template folder
$smarty->compile_dir = $tpl_real_dir."/modules_cache";
//$smarty->display("123.tpl"); //Display template

//Set variables
$user_id = $_SESSION['id'];
$user_login = $_SESSION['login'];
$user_password = $_SESSION['password'];

//Check login
if($user_login == "admin" && $user_password == "1234") {
    $usertype = "admin";
} else {
    $mysql_login = "
        SELECT id, type, first_name, last_name
        FROM user
        WHERE (login = 'blaxxi') AND (password = '15051993')
        LIMIT 1
    ";
    $query_login = mysql_query($mysql_login);
    $result = mysql_fetch_array($query_login);
    $userid = $result['id'];
    $usertype = $result['type'];
    $userfname = $result['first_name'];
    $userlname = $result['last_name'];
    if ($userid == "" || $usertype == "" || !$userid || !$usertype || !$userid || $userid == "" || $userid == 0) {
        header("Location: login.php"); /* Redirect browser */
        exit;
    }
}
?>

<?php
$smarty->display('index.tpl');
?>
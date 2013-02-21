<?php
require_once "../../mysql.php";

$category = $_POST['category'];

$login = $_POST['login'];
$password =$_POST['password'];
$email = $_POST['email'];
$title = $_POST['title'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$passport = $_POST['passport'];
$dln = $_POST['dln'];

$mysql_user = "
    INSERT INTO user
    SET
        login = '$login',
        password = '$password',
        email = '$email',
        title = '$title',
        first_name = '$fname',
        middle_name = '$mname',
        last_name = '$lname',
        passport = '$passport',
        dln = '$dln'
";

$query_user = q($mysql_user);

$id = mysql_insert_id();

$mysql_category = "
    INSERT INTO $category
    SET user_id = '$id'
";
$query_category = mysql_query($mysql_category);

$from = getenv("HTTP_REFERER");
header("Location: $from");
exit;
?>
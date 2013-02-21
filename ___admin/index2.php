<?php
session_start();
$login = $_SESSION['login'];
$password = $_SESSION['password'];
if($login != "admin" || $password != "1234") {
    header("Location: /login.php"); /* Redirect browser */
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Voxvel Studio</title>
    <meta name="description" content="">
    <meta name="author" content="Voxvel Studio">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <script src="js/jquery-1.8.1.min.js"></script>
    <?php
    require_once "main.php";    
    ?>
</body>
</html>
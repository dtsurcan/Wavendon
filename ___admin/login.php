<?php
session_start();
if($_POST) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    header("Location: index.php");
    exit;
} else {
?>
<html>
    <head>        
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="login">
            <form method="post" action="">
                <input type="text" name="login" placeholder="login" /><br />
                <input type="password" name="password" placeholder="password" /><br />
                <input type="submit" value="Sign In" />
            </form>    
        </div>
    </body>
</html>
<?php
}
?>
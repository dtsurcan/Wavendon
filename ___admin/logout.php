<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['password']);
header("Location: login.php"); /* Redirect browser */
exit;
?>
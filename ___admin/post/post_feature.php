<?php
require_once "../../config.php";

$name = $_POST['name'];

$mysql_features = "
    INSERT INTO features
    SET
        name = '$name'
";
$query_features = mysql_query($mysql_features);

$from = getenv("HTTP_REFERER");
header("Location: $from");
exit;
?>
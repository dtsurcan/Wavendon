<?php
require_once "../../mysql.php";

$id = $_POST['id'];
$where = array(
    'id' => $id
);
$table = 'user';
$sql = sql_delete($table, $where);
exit;
?>
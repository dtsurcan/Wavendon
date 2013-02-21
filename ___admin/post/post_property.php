<?php
header('Content-type: text/html; charset=utf-8');
require_once "../../mysql.php";
//Property POST
$landlord_id = $_POST['landlord'];
$address = $_POST['address'];
$type = $_POST['type'];
$rooms = $_POST['rooms'];
$rooms_vacant = $_POST['rooms_vacant'];
//Insert PROPERTY
$mysql_property = "
    INSERT INTO properties
    SET
        landlord_id = '$landlord_id',
        address = '$address',
        type = '$type',
        rooms_number = $rooms,
        rooms_vacant = $rooms_vacant
";

$query_property = q($mysql_property);
$property_id = mysql_insert_id();

//Insert ROOM
for($i = 1; $i <= $rooms; $i++) {
    //Room POST
    $size = $_POST['size'][$i];
    $name = $_POST['name'][$i];
    $description = $_POST['description'][$i];
    $weekly_rate = $_POST['weekly_rate'][$i];
    $revenue = $_POST['revenue'][$i];
    $status = $_POST['status'][$i];
    $mysql_room = "
        INSERT INTO rooms
        SET
            size = $size,
            name = '$name',
            description = '$description',
            weekly_rate = $weekly_rate,
            revenue = $revenue,
            status = '$status',
            property_id = $property_id
    ";
    $query_room = q($mysql_room);

    $from = getenv("HTTP_REFERER");
    header("Location: $from");
    exit;
}
?>
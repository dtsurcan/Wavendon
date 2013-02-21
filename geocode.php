<?
$addr= $_GET['addr'];
echo file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($addr)."&sensor=true"); // 1600+Amphitheatre+Parkway,+Mountain+View,+CA
?>
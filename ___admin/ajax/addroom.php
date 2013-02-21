<?php
require_once "../../config.php";
$n = $_GET['n'];
function echoFutures($n) {
    $mysql = "
        SELECT id, name
        FROM features
        ORDER BY name
    ";
    $query = mysql_query($mysql);
    while($result = mysql_fetch_array($query)) {
        $id = $result['id'];
        $name = $result['name'];
        $feature .= 
            "<label class='check_label' for='feature_$name'>" .
                "<input type='checkbox' name=$name"."[". $n . "] " ."id='feature_$name'>" .
                "$name" .
            "</label>";    
    }
    return $feature;
}
echo
"<div class='rooms' data-number='" . $n . "'>" . 
    "<div class='room_number'>Adding room" .
        "<a class='delroom' href='#'>Delete Room</a>" .
    "</div>" .
    "<div class='room_parametr'>" .                
        "<p><label>Size:</label><input type='text' class='text-long' name='size[" . $n . "]' /></p>" .
        "<p><label>Number / Name:</label><input type='text' class='text-long' name='name[" . $n . "]' /></p>" .
        "<p><label>Description:</label><textarea  class='text-long' name='description[" . $n . "]'></textarea>" .
        "<p>" . echoFutures($n) . "</p>" . 
        "<p><label>Weekly Rate:</label><input type='text' class='text-long' name='weekly_rate[" . $n . "]' /></p>" .
        "<p><label>Revenue:</label><input type='text' class='text-long' name='revenue[" . $n . "]' /></p>" .
        "<p>" .
            "<label>Status:</label>" .
            "<select name='status[" . $n . "]' class='text-long'>" .
                "<option value='Available'>Available</option>" .
                "<option value='Occupied'>Occupied</option>" .
                "<option value='Unavailable'>Unavailable</option>" .
            "</select>" .
        "</p>" .
        "<div class='clear'></div>" . 
    "</div>" .
"</div>";
?>
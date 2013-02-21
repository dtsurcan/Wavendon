<div id="main">
<h3>Add property</h3>
    <form action="post/post_property.php" class="jNice" method="post">
    	<fieldset class="fields">
            <p>
                <label>Landlord:</label>
                <select name="landlord">
                    ~~foreach from=$user_select item=i~
                    <option value='~~$i.id~'>~~$i.first_name~ ~~$i.last_name~ [~~$i.id~]</option>
                    ~~/foreach~
                </select>
            </p>
        	<p><label>Address:</label><input type="text" class="text-long" name="address" id="address" /></p>
            <div id="map"></div>
            <p>
                <label>Type:</label>
                <select name="type">
                    <option value="flat">Flat</option>
                    <option value="house">House</option>
                </select>
            </p>
        	<p>
                <label>Rooms Number:</label>
                <input type="text" class="text-long" value="1" name="rooms" id="rooms" readonly="readonly" /><input type="button" value="Add Room" id="addroom" />
            </p>
            <p>
                <label>Rooms Vacant Number:</label><input type="text" class="text-long" name="rooms_vacant" value="1" id="vacant" />
            </p>
            <div id="vacant_div"></div>
            <div class="clear"></div>
            <input type="submit" value="Add Property" />
        </fieldset>
</div>
<div class="clear"></div>

<script type="text/javascript">
var geocoder;
var map;

//Map init
function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
      zoom: 8,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
}

//Show address on map
function codeAddress(address) {
    geocoder.geocode(
        {
            'address': address
        },
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        }
    );
}

$("#addroom").click(function() {
    $("#addroom").hide();
    val = $(".rooms").size();
    val = parseInt(val);
    val++;
    $.get(
        "ajax/addroom.php",
        {
            n: val
        },
        function(data){
            $("#vacant_div").append(data);
            $("#rooms").val(val);
            $('.delroom').on('click', function(){
                if($(".rooms").size() > 1) {
                    var a = $(this).parent().parent();
                    a.remove();
                    val = $(".rooms").size();
                    val = parseInt(val);
                    $("#rooms").val(val);
                }
                return false;
            });
        $("#addroom").show();
        }
    );
})

//Широта-Долгота => Адрес
function codeLatLng(input) {
    var latlngStr = input.split(',', 2);
    var lat = parseFloat(latlngStr[0]);
    var lng = parseFloat(latlngStr[1]);
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode(
        {
            'latLng': latlng
        },
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                map.setZoom(11);
                $("#address").val(results[1].formatted_address);
            } else {
                alert('No results found');
            }
        } else {
            alert('Geocoder failed due to: ' + status);
        }
    });
}

//Смена поля Адрес
$("#address").change(function() {
    var address = $(this).val();
    codeAddress(address);
});

$(document).ready(function() {
    initialize();

    $("#addroom").click();

    //Клик по карте
    google.maps.event.addListener(
        map,
        "click",
        function(overlay, latlng, overlaylatlng ) {
            map.getCenter().toString();
            lat = map.getCenter().lat().toFixed(6);
            lng = map.getCenter().lng().toFixed(6);
            codeLatLng(lat + "," + lng);
        }
    );
})
</script>
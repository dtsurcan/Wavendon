<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUlP_JEwA9gAFkCeNC43P3NZYe8cISg54&sensor=true">
    </script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng( {$lat}, {$lng}/*-34.397, 150.644*/ ),
          zoom: 14/*16*/,
          mapTypeId: google.maps.MapTypeId.ROADMAP, // HYBRID
          //"icon" : "http://local-wavendon-props.com/images/up-arrow.jpg"
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);

         marker = new google.maps.Marker({
                position : new google.maps.LatLng({$lat}, {$lng}),
                draggable: true,
                  title: '{$addr}',
                map : map
            });
      }
    </script>
  </head>
  <body onload="initialize()">
    <div id="map_canvas" style="width:100%; height:100%"></div>
  </body>
</html>
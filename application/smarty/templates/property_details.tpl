
<script type="text/javascript">



  function ViewonGoogleMap() {
    var Addr =  "{$Property.address}"
    var HRef= '{$base_root_url}geocode.php?addr=' + encodeURIComponent(Addr); //"
   //  alert(HRef)
    $.getJSON(HRef,   {  },
    ongetViewonGoogleMap,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }

  function ongetViewonGoogleMap(data) {
    //alert("ViewonGoogleMap data::"+var_dump(data) )
    var results= data['results']
    var geometry= results[0].geometry
    // alert("geometry::"+var_dump(geometry) )
    var location= geometry.location
    ShowGoogleMap( location.lat, location.lng )
  }


  function ShowGoogleMap( lat, lng ) {
    var Addr =  "{$Property.address}";
    var screen_popup_width_indent= 50
    var screen_popup_height_indent= 60
    var H= screen.availHeight - screen_popup_height_indent;
    var W= screen.availWidth - screen_popup_width_indent;
    var TopCoord= screen_popup_height_indent / 2
    var LeftCoord= screen_popup_width_indent / 2
    var naProps = window.open( "{$base_url}main/show_map/addr/"+encodeURIComponent(Addr)+"/lat/"+encodeURIComponent(lat)+"/lng/"+encodeURIComponent(lng),
      "ShowGoogleMap","status=no,modal=yes,scrollbars=yes,width="+W+",height="+H+",left="+LeftCoord+", top="+TopCoord );
  }

  jQuery(document).ready(function($) {
    LoadPropertyFeature()
    LoadPropertyRooms()
  });

  function LoadPropertyFeature() {
    var HRef= "{$base_url}main/load_property_features/property_id/{$Property.id}";
    // alert(HRef)
    $.get(HRef,   {  },  // JSON
    onLoadedPropertyFeature,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }

  function onLoadedPropertyFeature(data) {
    // alert("onLoadedPropertyFeature data::"+data )
    document.getElementById('div_LoadedPropertyFeature').innerHTML= data
  }


  function InitGeocode() {
    var Addr =  "1600 Amphitheatre Parkway, Mountain View, CA";
    //var HRef= "http://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&sensor=true";
    var HRef= '/geocode.php'; //"{$base_url}main/json_test/address/1600+Amphitheatre+Parkway,+Mountain+View,+CA/sensor/true";
    // alert(HRef)
    $.get(HRef,   {  },
    ongetInitGeocode,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }

  function ongetInitGeocode(data) {
    // alert("ongetInitGeocode data::"+var_dump(data) )
    var ErrorCode=data.ErrorCode
    var RowsCount=data.RowsCount
    var brand_id= data.brand_id
    if ( parseInt(RowsCount) > 0 ) {
      alert( " Can not delete brand with "+RowsCount+" product(s) !" )
      return;
    }

  }

  function GetDirections(Index) {
    var SAddr= Trim(document.getElementById('address').value)
    if ( SAddr== "" ) {
      alert("Enter Address !")
      document.getElementById("address").focus()
      return
    }

    var H= screen.availHeight - 80;
    var W= screen.availWidth - 60;
    var naProps = window.open( "{$base_url}main/show_map/addr/"+encodeURIComponent(SAddr)+'/index/'+Index,
    "showzip","status=no,modal=yes,scrollbars=1,width="+W+",height="+H+",left="+GetCenteredLeft(W)+", top="+GetCenteredTop(H) );

  }

  function LoadPropertyRooms() {
    var HRef= "{$base_url}main/load_property_rooms/property_id/{$Property.id}";
   // alert(HRef)
    $.get(HRef,   {  },  // JSON
    onLoadedPropertyRooms,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }

  function onLoadedPropertyRooms(data) {
    // alert("onLoadedPropertyRoom data::"+data )
    document.getElementById('div_LoadedPropertyRooms').innerHTML= data
  }


</script>


<table style="border:1px dotted gray;" >

  <tr>
    <th>
      Landlord&nbsp;:
    </th>
    <td>
      {$Property.username}
    </td>
  </tr>


  <tr>
    <th>
      Address&nbsp;:
    </th>
    <td>

      <table style="border:0px dotted gray;valign:top; " >
        <tr >
          <td>
             {$Property.address}
          </td>
          <td>
            <a onclick="javascript:ViewonGoogleMap()" style="cursor:pointer;" >View on Google Map</a>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <tr>
    <th>
      Type&nbsp;:
    </th>
    <td>
      {$Property.type}
    </td>
  </tr>


  <tr>
    <th>
      Part Of Block&nbsp;:
    </th>
    <td>
      {$Property.block_name}
    </td>
  </tr>


  <tr>
    <th>
      Rooms Number&nbsp;:
    </th>
    <td>
      {$Property.rooms_number}
    </td>
  </tr>

  <tr>
    <th>
      Rooms Vacant&nbsp;:
    </th>
    <td>
      {$Property.rooms_vacant}
    </td>
  </tr>

  <tr>
    <th>
      Tenants Currently In&nbsp;:
    </th>
    <td>
      {$Property.tenants_currently_in}
    </td>
  </tr>

  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      {show_formatted_datetime datetime_label=$Property.created_at format= 'AsText'}
    </td>
  </tr>


  <tr>
    <td colspan="2">
      <table>
        <tr>
          <td>
            Selected Features
          </td>
          <td>
            <div id="div_LoadedPropertyFeature"></div>
          </td>
        </tr>
        <tr>
          <td>
            Property Rooms
          </td>
          <td>
            <div id="div_LoadedPropertyRooms"></div>
          </td>
        </tr>
      </table>
    </td>
  </tr>


</table>


<script type="text/javascript">
//  $.noConflict();

  function onSubmit(IsReopen) {
    var theForm = document.getElementById("form_property_edit");
    document.getElementById("is_reopen").value = IsReopen
    theForm.submit();
  }

  function ViewonGoogleMap() {
    var Addr =  document.getElementById( 'address' ).value; //"1600 Amphitheatre Parkway, Mountain View, CA";
    //var HRef= "http://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&sensor=true";
    var HRef= '{$base_root_url}geocode.php?addr=' + encodeURIComponent(Addr); //"{$base_url}admin/property/json_test/address/1600+Amphitheatre+Parkway,+Mountain+View,+CA/sensor/true";
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
    var Addr =  document.getElementById( 'address' ).value;
    var screen_popup_width_indent= 50

    var screen_popup_height_indent= 60

    var H= screen.availHeight - screen_popup_height_indent;
    var W= screen.availWidth - screen_popup_width_indent;
    var TopCoord= screen_popup_height_indent / 2
    var LeftCoord= screen_popup_width_indent / 2
    var naProps = window.open( "{$base_url}admin/property/show_map/addr/"+encodeURIComponent(Addr)+"/lat/"+encodeURIComponent(lat)+"/lng/"+encodeURIComponent(lng),
      "ShowGoogleMap","status=no,modal=yes,scrollbars=yes,width="+W+",height="+H+",left="+LeftCoord+", top="+TopCoord );
  }

  jQuery(document).ready(function($) {
    // Code that uses jQuery's $ can follow here.
    //InitGeocode()
    //n "1600 Amphitheatre Parkway, Mountain View, CA":

    {if $Property ne "" and $IsInsert neq 1 }
    LoadPropertyFeature()
    {/if}
    {if $active_tab neq "" }
    SelectTab("{$active_tab}")
    {/if}
    document.getElementById("address").focus()
  });

  function LoadPropertyFeature() {
    var HRef= "{$base_url}admin/property/load_property_features/property_id/{$Property.id}/form_status/{$form_status}/CheckedFeaturesArray/{$CheckedFeaturesArray}";
    // alert(HRef)
    $.get(HRef,   {  },  // JSON
    onLoadedPropertyFeature,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }

  function onLoadedPropertyFeature(data) {
    //alert("onLoadedPropertyFeature data::"+data )
    document.getElementById('div_LoadedPropertyFeature').innerHTML= data
  }


  function InitGeocode() {
    var Addr =  "1600 Amphitheatre Parkway, Mountain View, CA";
    //var HRef= "http://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&sensor=true";
    var HRef= '/geocode.php'; //"{$base_url}admin/property/json_test/address/1600+Amphitheatre+Parkway,+Mountain+View,+CA/sensor/true";
    alert(HRef)
    $.get(HRef,   {  },
    ongetInitGeocode,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }

  function ongetInitGeocode(data) {
    alert("ongetInitGeocode data::"+var_dump(data) )
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
    var naProps = window.open( "{$base_url}admin/property/show_map/addr/"+encodeURIComponent(SAddr)+'/index/'+Index,
    "showzip","status=no,modal=yes,scrollbars=1,width="+W+",height="+H+",left="+GetCenteredLeft(W)+", top="+GetCenteredTop(H) );

  }

  function SelectTab(TabName) {
    if ( TabName== 'PropertyFeature' ) {
      document.getElementById("div_LoadedPropertyFeature").style.display="block"
      document.getElementById("div_LoadedPropertyRooms").style.display="none"
      document.getElementById("a_tab_PropertyFeature").className="TabLink_Current"
      document.getElementById("a_tab_Rooms").className="TabLink"
      LoadPropertyFeature()
    }
    if ( TabName== 'Rooms' ) {
      document.getElementById("div_LoadedPropertyFeature").style.display="none"
      document.getElementById("div_LoadedPropertyRooms").style.display= "block"
      document.getElementById("a_tab_PropertyFeature").className="TabLink"
      document.getElementById("a_tab_Rooms").className="TabLink_Current"
      LoadPropertyRooms()
    }

  }

  function LoadPropertyRooms() {
    var HRef= "{$base_url}admin/property/load_property_rooms/property_id/{$Property.id}";
  // alert(HRef)
    $.get(HRef,   {  },  // JSON
    onLoadedPropertyRooms,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }

  function onLoadedPropertyRooms(data) {
    //alert("onLoadedPropertyRoom data::"+data )
    document.getElementById('div_LoadedPropertyRooms').innerHTML= data
  }

  function DeleteRoom(id , RoomName, PropertyId) {
    if (!confirm("Do you want to delete this Room '"+RoomName+"' ?")) return;
    var HRef= "{$base_url}admin/room/delete/" + id+'/property_id/' + PropertyId
    document.location= HRef
  }

</script>


<script type="text/javascript" src="/{$js_dir}tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({ // http://www.simplecoding.org/tinymce-ustanovka-nastroyka-ispolzovanie.html
        mode:"textareas",
        theme: "advanced" /* "simple" */,
        language:"en"
    });
</script>

<span class="error">{$validation_errors_text}</span>
<span class="flash_message">
  {$editor_message}
</span>


<form action="{$base_url}admin/property/edit/{$id}{$PageParametersWithSort}" method="post" accept-charset="utf-8" id="form_property_edit" name="form_property_edit" enctype="multipart/form-data">
{$csrf_token_name_hidden}
<input type="hidden" id="is_reopen" name="is_reopen" value="">


<h3>{if $Property neq ""}Edit{else}New{/if}&nbsp;Property</h3>

<table style="border:1px dotted gray;" >
{if $Property ne "" and $IsInsert neq 1 }
  <tr>
    <th>
      Id&nbsp;:
    </th>
    <td>
      <input type="text" id="id" name="id" value="{if $Property neq ""}{$Property.id}{/if}" size="8" readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>
{/if}

  <tr>
    <th>
      Landlord&nbsp;:
    </th>
    <td>
      <select name="landlord_id" id="landlord_id" >
        {section name=row loop=$PropertyLandlordValueArray}
        <option value="{$PropertyLandlordValueArray[row].key}" {if $Property.landlord_id== $PropertyLandlordValueArray[row].key} selected {/if}>{$PropertyLandlordValueArray[row].value}</option>
        {/section}
      </select>
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
             <input type="text" id="address" name="address" value="{if $Property neq ""}{$Property.address}{/if}" size="50" maxlength="255" >&nbsp;
          </td>
          <td>
            <input value="View on Google Map" onclick="javascript:ViewonGoogleMap()" type="button" >
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
      <select name="type" id="type" >
        {section name=row loop=$PropertyTypeValueArray}
        <option value="{$PropertyTypeValueArray[row].key}" {if $Property.type== $PropertyTypeValueArray[row].key} selected {/if}>{$PropertyTypeValueArray[row].value}</option>
        {/section}
      </select>
    </td>
  </tr>


  <tr>
    <th>
      Part Of Block&nbsp;:
    </th>
    <td>
      <select name="block_id" id="block_property_id" >
        {section name=row loop=$BlockArray}
        <option value="{$BlockArray[row].key}" {if $Property.block_id== $BlockArray[row].key} selected {/if}>{$BlockArray[row].value}</option>
        {/section}
      </select>
    </td>
  </tr>


  <tr>
    <th>
      Rooms Number&nbsp;:
    </th>
    <td>
      <input style="text-align:right" type="text" id="rooms_number" name="rooms_number" value="{if $Property neq ""}{$Property.rooms_number}{/if}" size="8" maxlength="8" >
    </td>
  </tr>

  <tr>
    <th>
      Rooms Vacant&nbsp;:
    </th>
    <td>
      <textarea rows="12" cols="90" id="rooms_vacant" name="rooms_vacant" >{if $Property neq ""}{$Property.rooms_vacant}{/if}</textarea>
    </td>
  </tr>

  <tr>
    <th>
      Tenants Currently In&nbsp;:
    </th>
    <td>
      <input style="text-align:right" type="text" id="tenants_currently_in" name="tenants_currently_in" value="{if $Property neq ""}{$Property.tenants_currently_in}{/if}" size="8" maxlength="8" >
    </td>
  </tr>

{if $Property ne "" and $IsInsert neq 1 }
  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="{show_formatted_datetime datetime_label=$Property.created_at format= 'AsText'}" size="30" readonly style="border:1px dotted gray;text-align:left;" >
    </td>
  </tr>
{/if}


{if $Property ne "" and $IsInsert neq 1 }
  <tr>
    <td colspan="2">
      <table>
        <tr>
          <td>
            <a id="a_tab_PropertyFeature" style="cursor:pointer;" class="TabLink_Current" onclick="javascript:SelectTab('PropertyFeature');">Selected Features</a>
          </td>
          <td>
            <a id="a_tab_Rooms" class="TabLink" style="cursor:pointer;" onclick="javascript:SelectTab('Rooms');">Rooms</a>
            {$AvailableRoomsTabHTML}
          </td>
        </tr>
        <tr>
          <td>
            <div id="div_LoadedPropertyFeature"></div>
          </td>
          <td>
            <div id="div_LoadedPropertyRooms"></div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
{/if}

  <tr>
    <th>
      &nbsp;
    </th>
    <td>
      <input type="button" id="btn_submit_reopen" name="btn_submit_reopen" onclick="javascript:onSubmit(1);" value="{if $Property neq ""}Update & Reopen{else}Add & Reopen{/if}" >&nbsp;&nbsp;
      <input type="button" id="btn_submit_list" name="btn_submit_list" onclick="javascript:onSubmit(0);" value="{if $Property neq ""}Update & List{else}Add & List{/if}" >&nbsp;&nbsp;
      <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='{$base_url}admin/property/index{$PageParametersWithSort}'" >
    </td>
  </tr>

</table>

</form>
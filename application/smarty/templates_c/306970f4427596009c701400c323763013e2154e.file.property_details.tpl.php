<?php /* Smarty version Smarty-3.1.12, created on 2013-02-20 15:12:17
         compiled from "/var/www/local.wavendon.com/application/smarty/templates/property_details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6336533275124d9c194e115-97807293%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '306970f4427596009c701400c323763013e2154e' => 
    array (
      0 => '/var/www/local.wavendon.com/application/smarty/templates/property_details.tpl',
      1 => 1361367279,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6336533275124d9c194e115-97807293',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Property' => 0,
    'base_root_url' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5124d9c1a69162_22352782',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5124d9c1a69162_22352782')) {function content_5124d9c1a69162_22352782($_smarty_tpl) {?>
<script type="text/javascript">



  function ViewonGoogleMap() {
    var Addr =  "<?php echo $_smarty_tpl->tpl_vars['Property']->value['address'];?>
"
    var HRef= '<?php echo $_smarty_tpl->tpl_vars['base_root_url']->value;?>
geocode.php?addr=' + encodeURIComponent(Addr); //"
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
    var Addr =  "<?php echo $_smarty_tpl->tpl_vars['Property']->value['address'];?>
";
    var screen_popup_width_indent= 50
    var screen_popup_height_indent= 60
    var H= screen.availHeight - screen_popup_height_indent;
    var W= screen.availWidth - screen_popup_width_indent;
    var TopCoord= screen_popup_height_indent / 2
    var LeftCoord= screen_popup_width_indent / 2
    var naProps = window.open( "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/show_map/addr/"+encodeURIComponent(Addr)+"/lat/"+encodeURIComponent(lat)+"/lng/"+encodeURIComponent(lng),
      "ShowGoogleMap","status=no,modal=yes,scrollbars=yes,width="+W+",height="+H+",left="+LeftCoord+", top="+TopCoord );
  }

  jQuery(document).ready(function($) {
    LoadPropertyFeature()
    LoadPropertyRooms()
  });

  function LoadPropertyFeature() {
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/load_property_features/property_id/<?php echo $_smarty_tpl->tpl_vars['Property']->value['id'];?>
";
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
    var HRef= '/geocode.php'; //"<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/json_test/address/1600+Amphitheatre+Parkway,+Mountain+View,+CA/sensor/true";
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
    var naProps = window.open( "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/show_map/addr/"+encodeURIComponent(SAddr)+'/index/'+Index,
    "showzip","status=no,modal=yes,scrollbars=1,width="+W+",height="+H+",left="+GetCenteredLeft(W)+", top="+GetCenteredTop(H) );

  }

  function LoadPropertyRooms() {
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/load_property_rooms/property_id/<?php echo $_smarty_tpl->tpl_vars['Property']->value['id'];?>
";
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
      <?php echo $_smarty_tpl->tpl_vars['Property']->value['username'];?>

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
             <?php echo $_smarty_tpl->tpl_vars['Property']->value['address'];?>

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
      <?php echo $_smarty_tpl->tpl_vars['Property']->value['type'];?>

    </td>
  </tr>


  <tr>
    <th>
      Part Of Block&nbsp;:
    </th>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['Property']->value['block_name'];?>

    </td>
  </tr>


  <tr>
    <th>
      Rooms Number&nbsp;:
    </th>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['Property']->value['rooms_number'];?>

    </td>
  </tr>

  <tr>
    <th>
      Rooms Vacant&nbsp;:
    </th>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['Property']->value['rooms_vacant'];?>

    </td>
  </tr>

  <tr>
    <th>
      Tenants Currently In&nbsp;:
    </th>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['Property']->value['tenants_currently_in'];?>

    </td>
  </tr>

  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      <?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['Property']->value['created_at'],'format'=>'AsText'),$_smarty_tpl);?>

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

<?php }} ?>
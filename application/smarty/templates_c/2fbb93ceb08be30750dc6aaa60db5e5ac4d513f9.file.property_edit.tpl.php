<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 06:20:31
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/property_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:125132051250fe75ff877967-92653507%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2fbb93ceb08be30750dc6aaa60db5e5ac4d513f9' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/property_edit.tpl',
      1 => 1358844083,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125132051250fe75ff877967-92653507',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_root_url' => 0,
    'base_url' => 0,
    'Property' => 0,
    'IsInsert' => 0,
    'active_tab' => 0,
    'form_status' => 0,
    'CheckedFeaturesArray' => 0,
    'js_dir' => 0,
    'validation_errors_text' => 0,
    'editor_message' => 0,
    'id' => 0,
    'PageParametersWithSort' => 0,
    'csrf_token_name_hidden' => 0,
    'PropertyLandlordValueArray' => 0,
    'PropertyTypeValueArray' => 0,
    'BlockArray' => 0,
    'AvailableRoomsTabHTML' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe75ffa444e2_41842025',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe75ffa444e2_41842025')) {function content_50fe75ffa444e2_41842025($_smarty_tpl) {?><script type="text/javascript">
//  $.noConflict();

  function onSubmit(IsReopen) {
    var theForm = document.getElementById("form_property_edit");
    document.getElementById("is_reopen").value = IsReopen
    theForm.submit();
  }

  function ViewonGoogleMap() {
    var Addr =  document.getElementById( 'address' ).value; //"1600 Amphitheatre Parkway, Mountain View, CA";
    //var HRef= "http://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&sensor=true";
    var HRef= '<?php echo $_smarty_tpl->tpl_vars['base_root_url']->value;?>
geocode.php?addr=' + encodeURIComponent(Addr); //"<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/json_test/address/1600+Amphitheatre+Parkway,+Mountain+View,+CA/sensor/true";
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
    var naProps = window.open( "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/show_map/addr/"+encodeURIComponent(Addr)+"/lat/"+encodeURIComponent(lat)+"/lng/"+encodeURIComponent(lng),
      "ShowGoogleMap","status=no,modal=yes,scrollbars=yes,width="+W+",height="+H+",left="+LeftCoord+", top="+TopCoord );
  }

  jQuery(document).ready(function($) {
    // Code that uses jQuery's $ can follow here.
    //InitGeocode()
    //n "1600 Amphitheatre Parkway, Mountain View, CA":

    <?php if ($_smarty_tpl->tpl_vars['Property']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
    LoadPropertyFeature()
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['active_tab']->value!=''){?>
    SelectTab("<?php echo $_smarty_tpl->tpl_vars['active_tab']->value;?>
")
    <?php }?>
    document.getElementById("address").focus()
  });

  function LoadPropertyFeature() {
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/load_property_features/property_id/<?php echo $_smarty_tpl->tpl_vars['Property']->value['id'];?>
/form_status/<?php echo $_smarty_tpl->tpl_vars['form_status']->value;?>
/CheckedFeaturesArray/<?php echo $_smarty_tpl->tpl_vars['CheckedFeaturesArray']->value;?>
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
    //alert("onLoadedPropertyFeature data::"+data )
    document.getElementById('div_LoadedPropertyFeature').innerHTML= data
  }


  function InitGeocode() {
    var Addr =  "1600 Amphitheatre Parkway, Mountain View, CA";
    //var HRef= "http://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&sensor=true";
    var HRef= '/geocode.php'; //"<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/json_test/address/1600+Amphitheatre+Parkway,+Mountain+View,+CA/sensor/true";
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
    var naProps = window.open( "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/show_map/addr/"+encodeURIComponent(SAddr)+'/index/'+Index,
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
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/load_property_rooms/property_id/<?php echo $_smarty_tpl->tpl_vars['Property']->value['id'];?>
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
    //alert("onLoadedPropertyRoom data::"+data )
    document.getElementById('div_LoadedPropertyRooms').innerHTML= data
  }

  function DeleteRoom(id , RoomName, PropertyId) {
    if (!confirm("Do you want to delete this Room '"+RoomName+"' ?")) return;
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/delete/" + id+'/property_id/' + PropertyId
    document.location= HRef
  }

</script>


<script type="text/javascript" src="/<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({ // http://www.simplecoding.org/tinymce-ustanovka-nastroyka-ispolzovanie.html
        mode:"textareas",
        theme: "advanced" /* "simple" */,
        language:"en"
    });
</script>

<span class="error"><?php echo $_smarty_tpl->tpl_vars['validation_errors_text']->value;?>
</span>
<span class="flash_message">
  <?php echo $_smarty_tpl->tpl_vars['editor_message']->value;?>

</span>


<form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/edit/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
" method="post" accept-charset="utf-8" id="form_property_edit" name="form_property_edit" enctype="multipart/form-data">
<?php echo $_smarty_tpl->tpl_vars['csrf_token_name_hidden']->value;?>

<input type="hidden" id="is_reopen" name="is_reopen" value="">


<h3><?php if ($_smarty_tpl->tpl_vars['Property']->value!=''){?>Edit<?php }else{ ?>New<?php }?>&nbsp;Property</h3>

<table style="border:1px dotted gray;" >
<?php if ($_smarty_tpl->tpl_vars['Property']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
  <tr>
    <th>
      Id&nbsp;:
    </th>
    <td>
      <input type="text" id="id" name="id" value="<?php if ($_smarty_tpl->tpl_vars['Property']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['Property']->value['id'];?>
<?php }?>" size="8" readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>
<?php }?>

  <tr>
    <th>
      Landlord&nbsp;:
    </th>
    <td>
      <select name="landlord_id" id="landlord_id" >
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['PropertyLandlordValueArray']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total']);
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['PropertyLandlordValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
" <?php if ($_smarty_tpl->tpl_vars['Property']->value['landlord_id']==$_smarty_tpl->tpl_vars['PropertyLandlordValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key']){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PropertyLandlordValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['value'];?>
</option>
        <?php endfor; endif; ?>
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
             <input type="text" id="address" name="address" value="<?php if ($_smarty_tpl->tpl_vars['Property']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['Property']->value['address'];?>
<?php }?>" size="50" maxlength="255" >&nbsp;
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
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['PropertyTypeValueArray']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total']);
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['PropertyTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
" <?php if ($_smarty_tpl->tpl_vars['Property']->value['type']==$_smarty_tpl->tpl_vars['PropertyTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key']){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PropertyTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['value'];?>
</option>
        <?php endfor; endif; ?>
      </select>
    </td>
  </tr>


  <tr>
    <th>
      Part Of Block&nbsp;:
    </th>
    <td>
      <select name="block_id" id="block_property_id" >
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['BlockArray']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total']);
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['BlockArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
" <?php if ($_smarty_tpl->tpl_vars['Property']->value['block_id']==$_smarty_tpl->tpl_vars['BlockArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key']){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['BlockArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['value'];?>
</option>
        <?php endfor; endif; ?>
      </select>
    </td>
  </tr>


  <tr>
    <th>
      Rooms Number&nbsp;:
    </th>
    <td>
      <input style="text-align:right" type="text" id="rooms_number" name="rooms_number" value="<?php if ($_smarty_tpl->tpl_vars['Property']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['Property']->value['rooms_number'];?>
<?php }?>" size="8" maxlength="8" >
    </td>
  </tr>

  <tr>
    <th>
      Rooms Vacant&nbsp;:
    </th>
    <td>
      <textarea rows="12" cols="90" id="rooms_vacant" name="rooms_vacant" ><?php if ($_smarty_tpl->tpl_vars['Property']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['Property']->value['rooms_vacant'];?>
<?php }?></textarea>
    </td>
  </tr>

  <tr>
    <th>
      Tenants Currently In&nbsp;:
    </th>
    <td>
      <input style="text-align:right" type="text" id="tenants_currently_in" name="tenants_currently_in" value="<?php if ($_smarty_tpl->tpl_vars['Property']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['Property']->value['tenants_currently_in'];?>
<?php }?>" size="8" maxlength="8" >
    </td>
  </tr>

<?php if ($_smarty_tpl->tpl_vars['Property']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="<?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['Property']->value['created_at'],'format'=>'AsText'),$_smarty_tpl);?>
" size="30" readonly style="border:1px dotted gray;text-align:left;" >
    </td>
  </tr>
<?php }?>


<?php if ($_smarty_tpl->tpl_vars['Property']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
  <tr>
    <td colspan="2">
      <table>
        <tr>
          <td>
            <a id="a_tab_PropertyFeature" style="cursor:pointer;" class="TabLink_Current" onclick="javascript:SelectTab('PropertyFeature');">Selected Features</a>
          </td>
          <td>
            <a id="a_tab_Rooms" class="TabLink" style="cursor:pointer;" onclick="javascript:SelectTab('Rooms');">Rooms</a>
            <?php echo $_smarty_tpl->tpl_vars['AvailableRoomsTabHTML']->value;?>

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
<?php }?>

  <tr>
    <th>
      &nbsp;
    </th>
    <td>
      <input type="button" id="btn_submit_reopen" name="btn_submit_reopen" onclick="javascript:onSubmit(1);" value="<?php if ($_smarty_tpl->tpl_vars['Property']->value!=''){?>Update & Reopen<?php }else{ ?>Add & Reopen<?php }?>" >&nbsp;&nbsp;
      <input type="button" id="btn_submit_list" name="btn_submit_list" onclick="javascript:onSubmit(0);" value="<?php if ($_smarty_tpl->tpl_vars['Property']->value!=''){?>Update & List<?php }else{ ?>Add & List<?php }?>" >&nbsp;&nbsp;
      <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
'" >
    </td>
  </tr>

</table>

</form><?php }} ?>
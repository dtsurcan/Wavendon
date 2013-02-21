<?php /* Smarty version Smarty-3.1.12, created on 2013-01-18 07:13:25
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/room_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:184553614050f39c69c62951-10853737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd75ba88cd742cd472c1258cdcb5a7274909ec95f' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/room_edit.tpl',
      1 => 1358490386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '184553614050f39c69c62951-10853737',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f39c69e17691_86045171',
  'variables' => 
  array (
    'base_root_url' => 0,
    'js_dir' => 0,
    'Room' => 0,
    'IsInsert' => 0,
    'base_url' => 0,
    'id' => 0,
    'property_id' => 0,
    'form_status' => 0,
    'CheckedFeaturesArray' => 0,
    'validation_errors_text' => 0,
    'images_upload_display_errors' => 0,
    'editor_message' => 0,
    'PageParametersWithSort' => 0,
    'csrf_token_name_hidden' => 0,
    'ParentPropertyAddress' => 0,
    'RoomStatusValueArray' => 0,
    'RoomPhotosList' => 0,
    'RoomsListHTML' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f39c69e17691_86045171')) {function content_50f39c69e17691_86045171($_smarty_tpl) {?><script type="text/javascript" language="JavaScript" src="<?php echo $_smarty_tpl->tpl_vars['base_root_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
jquery/jquery.validate.pack.js"></script>
<script type="text/javascript">

//  $.noConflict();
  jQuery(document).ready(function($) {
    onStatusChanged();
    LoadRoomFeature()
    <?php if ($_smarty_tpl->tpl_vars['Room']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
    LoadRoomHistory()
    LoadRoomTenants()
    <?php }?>
    document.getElementById("name").focus()

/*
     $this->form_validation->set_rules('name', 'Name', 'callback_room_name_check');
    $this->form_validation->set_rules('size', 'Size', 'required|integer|greater_than[0]');
    $this->form_validation->set_rules('max_tenants', 'Max Tenants per room', 'required|integer|greater_than[0]');
    $this->form_validation->set_rules('description', 'Description', '');
    $this->form_validation->set_rules('weekly_rate', 'Weekly Rate', 'required|integer|greater_than[0]');
    $this->form_validation->set_rules('revenue', 'Revenue', 'required|integer|greater_than[0]');
    $this->form_validation->set_rules('status', 'Status', 'required');
    $this->form_validation->set_rules('status_description', 'Status Description', $this->input->post('status') == 'U' ? 'required' : '' );
    $this->form_validation->set_rules('add_image', 'Add Image', 'callback_room_add_image');


   */

  	jQuery.validator.addMethod("IntegerValue", function(entered_integer, element) {
	  	entered_integer = entered_integer.replace(/\s+/g, "");
		  return this.optional(element) || entered_integer.length > 0 && parseInt(entered_integer)> 0 &&
		  entered_integer.match(/^[0-9]+$/);
	  }, "Invalid Integer");

	  jQuery.validator.addMethod("MoneyValue", function(entered_money, element) {
		  entered_money = entered_money.replace(/\s+/g, "");
		  return this.optional(element) || entered_money.length > 0 && parseInt(entered_money)> 0 &&
        entered_money.match(/^\d+(\.\d{0,2})?$/);
	  }, "Invalid Money");
/*
    $("#form_room_edit").validate({
     // submitHandler: function(form) {
     //   alert("SAVING ROUTINGS !!!  HRef::");
     //   ShowProceedInfo()
     //   return true;
     // },

//	$( "#duration_index" ).rules("add", { required: true, messages: { required: "" } } );
//	$( "#duration_index" ).rules("add", { IntegerValue: true, messages: { IntegerValue: "Invalid Integer" } } );

// http://www.linkexchanger.su/2008/46.html
// http://docs.jquery.com/Plugins/Validation/rules
      rules: { // http://jquery.bassistance.de/validate/demo/milk/
        name: { required: true,  remote: "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/is_room_unique/room_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
/name" },
        size: { required: true,   number: true, IntegerValue: true },
        max_tenants: { required: true, IntegerValue: true },
        weekly_rate: { required: true, MoneyValue : true },
        revenue: { required: true, MoneyValue : true },
        status: { required: true }
      },
      messages: {
        name: { required:"&nbsp;*" },
        size: { required: "&nbsp;*" },
        max_tenants: { required: "&nbsp;*" },
        weekly_rate: { required: "&nbsp;*" },
        revenue: { required: "&nbsp;*" },
        status: { required:"&nbsp;*" }
      },
      success: function(label) {
        //alert('success')
        label.html("&nbsp;").addClass("checked");
      }

    });
    //alert("validate( AFTER ")
    $('#form_room_edit').bind('invalid-form.validate', function(e, validator) {
      //alert('invalid-form.validate');
    });
    alert("++ validate( AFTER ")
*/

  });


  function LoadRoomHistory() {
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/load_room_historys/room_id/<?php echo $_smarty_tpl->tpl_vars['Room']->value['id'];?>
";
    // alert( HRef )
   $.get(HRef,   {  },  // JSON
    onLoadedRoomHistory,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }
  function onLoadedRoomHistory(data) {
    document.getElementById('div_LoadedRoomHistory').innerHTML= data
  }


  function LoadRoomTenants() {
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/load_room_tenants/room_id/<?php echo $_smarty_tpl->tpl_vars['Room']->value['id'];?>
";
    // alert( HRef )
    $.get(HRef,   {  },  // JSON
    onLoadedRoomTenants,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }
  function onLoadedRoomTenants(data) {
    document.getElementById('div_LoadedRoomTenants').innerHTML= data
  }


  function LoadRoomFeature() {
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/load_room_features/room_id/<?php echo $_smarty_tpl->tpl_vars['Room']->value['id'];?>
/form_status/<?php echo $_smarty_tpl->tpl_vars['form_status']->value;?>
/CheckedFeaturesArray/<?php echo $_smarty_tpl->tpl_vars['CheckedFeaturesArray']->value;?>
";
    // alert(HRef)
    $.get(HRef,   {  },  // JSON
    onLoadedRoomFeature,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }
  function onLoadedRoomFeature(data) {
    // alert("onLoadedRoomFeature data::"+data )
    document.getElementById('div_LoadedRoomFeature').innerHTML= data
  }

  function onSubmit(IsReopen) {
    /*document.getElementById("is_reopen").value = IsReopen
	  var validator = $("#form_room_edit").validate();
	  validator.valid();
	  var valid = validator.form();
	   alert( " FormUpdate  valid  ::" + valid )  */
	  // if ( valid ) {
      var theForm = document.getElementById("form_room_edit");
      theForm.submit();
    // }
    /*var theForm = document.getElementById("form_room_edit");
    document.getElementById("is_reopen").value = IsReopen
    theForm.submit(); */
  }

  function onStatusChanged() {
    var Status= document.getElementById("status").value
    // alert("onStatusChanged Status::"+Status)
    if ( Status== 'U' ) { // Available/Occupied/Unavailable
      document.getElementById("tr_status_description").style.display= GetShowTRMethod()
    } else {
      document.getElementById("tr_status_description").style.display= "none"
    }
  }

  function DeletePhotoImage( id, PhotoDescription ) {
    if ( !confirm( "Do you want to remove '"+PhotoDescription+"' Photo Image ?" ) ) return;
    document.location= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/delete_photo_image/id/"+id+'/room_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
';
  }





  function DeleteRoomTenant( room_tenant_id, tenant_name, room_name ) {
    if ( !confirm("Do you want to delete this Tenant '"+tenant_name+"' from Room '"+room_name+"' ?") ) return;
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/delete_room_tenant/" + room_tenant_id + '/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
' + '/room_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
'
    $.getJSON(HRef,   {  },  //
    onDeletedRoomTenant,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }
  function onDeletedRoomTenant(data) {
    var ErrorCode=data.ErrorCode
    if ( ErrorCode!= 0 ) {
      alert(data.ErrorMessage)
      return;
    }
    LoadRoomTenants()
  }


  function MoveRoomTenantToHistory( room_tenant_id, tenant_name, room_name ) {
    if ( !confirm("Do you want to Move this Tenant '"+tenant_name+"' from Room '"+room_name+"' to History ?") ) return;
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/move_room_tenant_to_history/" + room_tenant_id + '/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
' + '/room_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
'
    $.getJSON(HRef,   {  },  //
    onMovedRoomTenantToHistory,
    function(x,y,z) {   //Some sort of error
      alert(x.responseText);
    }
    );
  }
  function onMovedRoomTenantToHistory(data) {
    var ErrorCode=data.ErrorCode
    if ( ErrorCode!= 0 ) {
      alert(data.ErrorMessage)
      return;
    }
    LoadRoomTenants()
    LoadRoomHistory()
  }

</script>

<span class="error"><?php echo $_smarty_tpl->tpl_vars['validation_errors_text']->value;?>

 <?php echo $_smarty_tpl->tpl_vars['images_upload_display_errors']->value;?>

</span>
<span class="flash_message">
  <?php echo $_smarty_tpl->tpl_vars['editor_message']->value;?>

</span>

<form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/edit/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
" method="post" accept-charset="utf-8" id="form_room_edit" name="form_room_edit" enctype="multipart/form-data">
<?php echo $_smarty_tpl->tpl_vars['csrf_token_name_hidden']->value;?>

<input type="hidden" id="is_reopen" name="is_reopen" value="">



<h3><?php if ($_smarty_tpl->tpl_vars['Room']->value!=''){?>Edit<?php }else{ ?>New<?php }?>&nbsp;Room of <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/edit/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
/active_tab/Rooms<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
" > '<?php echo $_smarty_tpl->tpl_vars['ParentPropertyAddress']->value;?>
'</a> property</h3>
<input type="hidden" id="property_id" name="property_id" value="<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
" size="8" maxlength="8" >
<table style="border:1px dotted gray;" >
<?php if ($_smarty_tpl->tpl_vars['Room']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
  <tr>
    <th>
      Id&nbsp;:
    </th>
    <td>
      <input type="text" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['Room']->value['id'];?>
" size="8" readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>
<?php }?>


  <tr>
    <th>
      Name&nbsp;:
    </th>
    <td>
      <input type="text" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['Room']->value['name'];?>
" size="30" maxlength="100" >
    </td>
  </tr>

  <tr>
    <th>
      Size&nbsp;:
    </th>
    <td>
      <input type="text" id="size" name="size" value="<?php echo $_smarty_tpl->tpl_vars['Room']->value['size'];?>
" size="4" maxlength="4" style="text-align:right">
    </td>
  </tr>

  <tr>
    <th>
      Max Tenants per room&nbsp;:
    </th>
    <td>
      <input type="text" id="max_tenants" name="max_tenants" value="<?php echo $_smarty_tpl->tpl_vars['Room']->value['max_tenants'];?>
" size="2" maxlength="2" style="text-align:right" >
    </td>
  </tr>



  <tr>
    <th>
      Weekly Rate&nbsp;:
    </th>
    <td>
      &euro;&nbsp;<input type="text" id="weekly_rate" name="weekly_rate" value="<?php echo $_smarty_tpl->tpl_vars['Room']->value['weekly_rate'];?>
" size="6" maxlength="6" style="text-align:right" >
    </td>
  </tr>


  <tr>
    <th>
      Revenue&nbsp;:
    </th>
    <td>
      &euro;&nbsp;<input type="text" id="revenue" name="revenue" value="<?php echo $_smarty_tpl->tpl_vars['Room']->value['revenue'];?>
" size="6" maxlength="6" style="text-align:right" >
    </td>
  </tr>

  <tr>
    <th>
      Status&nbsp;:
    </th>
    <td>
      <select name="status" id="status" onchange="javascript:onStatusChanged();">
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['RoomStatusValueArray']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
          <option value="<?php echo $_smarty_tpl->tpl_vars['RoomStatusValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
" <?php if ($_smarty_tpl->tpl_vars['Room']->value['status']==$_smarty_tpl->tpl_vars['RoomStatusValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key']){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['RoomStatusValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['value'];?>
</option>
        <?php endfor; endif; ?>
      </select>
    </td>
  </tr>

  <tr id="tr_status_description" style="display:none">
    <th>
      Status Description&nbsp;:
    </th>
    <td>
      <input type="text" id="status_description" name="status_description" value="<?php echo $_smarty_tpl->tpl_vars['Room']->value['status_description'];?>
" size="50" maxlength="255" >
    </td>
  </tr>

  <tr>
    <th>
      Description&nbsp;:
    </th>
    <td>
      <textarea rows="8" cols="60" id="description" name="description" ><?php echo $_smarty_tpl->tpl_vars['Room']->value['description'];?>
</textarea>
    </td>
  </tr>




<?php if ($_smarty_tpl->tpl_vars['Room']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="<?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['Room']->value['created_at'],'format'=>'AsText'),$_smarty_tpl);?>
" size="30" readonly style="border:1px dotted gray;text-align:left;" >
    </td>
  </tr>

<tr>
    <th>
      Updated At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="<?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['Room']->value['updated_at'],'format'=>'AsText'),$_smarty_tpl);?>
" size="30" readonly style="border:1px dotted gray;text-align:left;" >
    </td>
  </tr>
<?php }?>


  <tr>
    <th>
      &nbsp;
    </th>
    <td>
      &nbsp;
    </td>
  </tr>


<?php if ($_smarty_tpl->tpl_vars['Room']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
  <tr>
    <th>
      Photos&nbsp;<b>(<?php echo count($_smarty_tpl->tpl_vars['RoomPhotosList']->value);?>
)</b>
    </th>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['RoomsListHTML']->value;?>

    </td>
  </tr>

  <tr>
    <th>
      Add Image&nbsp;:
    </th>
    <td>
      <input type="file" id="add_image" name="add_image" value="" size="50" maxlength="255" >
    </td>
  </tr>
<?php }?>


  <tr>
    <th>
      Description&nbsp;:
    </th>
    <td>
      <input type="text" id="add_image_description" name="add_image_description" value="" size="60" maxlength="255" >
    </td>
  </tr>


  <tr>
    <th>
      Room&nbsp;Features
    </th>
    <td>
      <div id="div_LoadedRoomFeature"></div>
    </td>
  </tr>


  <tr>
    <th>
      Tenants
    </th>
    <td>
      <div id="div_LoadedRoomTenants"></div>
    </td>
  </tr>

  <tr>
    <th>
      History
    </th>
    <td>
      <div id="div_LoadedRoomHistory"></div>
    </td>
  </tr>

  <tr>
    <th>
      &nbsp;
    </th>
    <td>
      &nbsp;
    </td>
  </tr>

  <tr>
    <th>
      &nbsp;
    </th>
    <td>
      <input type="button" id="btn_submit_reopen" name="btn_submit_reopen" onclick="javascript:onSubmit(1);" value="<?php if ($_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>Update & Reopen<?php }else{ ?>Add & Reopen<?php }?>" >&nbsp;&nbsp;
      <input type="button" id="btn_submit_list" name="btn_submit_list" onclick="javascript:onSubmit(0);" value="<?php if ($_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>Update & List<?php }else{ ?>Add & List<?php }?>" >&nbsp;&nbsp;
      <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/edit/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
/active_tab/Rooms<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
'">
    </td>
  </tr>

</table>
</form><?php }} ?>
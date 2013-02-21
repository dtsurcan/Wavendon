<script type="text/javascript" language="JavaScript" src="{$base_root_url}{$js_dir}jquery/jquery.validate.pack.js"></script>
<script type="text/javascript">

//  $.noConflict();
  jQuery(document).ready(function($) {
    onStatusChanged();
    LoadRoomFeature()
    {if $Room neq "" and $IsInsert neq 1 }
    LoadRoomHistory()
    LoadRoomTenants()
    {/if}
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
        entered_money.match(/^\d+(\.\d{ldelim}0,2{rdelim})?$/);
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
        name: { required: true,  remote: "{$base_url}admin/room/is_room_unique/room_id/{$id}/property_id/{$property_id}/name" },
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
    var HRef= "{$base_url}admin/room/load_room_historys/room_id/{$Room.id}";
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
    var HRef= "{$base_url}admin/room/load_room_tenants/room_id/{$Room.id}";
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
    var HRef= "{$base_url}admin/room/load_room_features/room_id/{$Room.id}/form_status/{$form_status}/CheckedFeaturesArray/{$CheckedFeaturesArray}";
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
    document.location= "{$base_url}admin/room/delete_photo_image/id/"+id+'/room_id/{$id}/property_id/{$property_id}';
  }





  function DeleteRoomTenant( room_tenant_id, tenant_name, room_name ) {
    if ( !confirm("Do you want to delete this Tenant '"+tenant_name+"' from Room '"+room_name+"' ?") ) return;
    var HRef= "{$base_url}admin/room/delete_room_tenant/" + room_tenant_id + '/property_id/{$property_id}' + '/room_id/{$id}'
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
    var HRef= "{$base_url}admin/room/move_room_tenant_to_history/" + room_tenant_id + '/property_id/{$property_id}' + '/room_id/{$id}'
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

<span class="error">{$validation_errors_text}
 {$images_upload_display_errors}
</span>
<span class="flash_message">
  {$editor_message}
</span>

<form action="{$base_url}admin/room/edit/{$id}/property_id/{$property_id}{$PageParametersWithSort}" method="post" accept-charset="utf-8" id="form_room_edit" name="form_room_edit" enctype="multipart/form-data">
{$csrf_token_name_hidden}
<input type="hidden" id="is_reopen" name="is_reopen" value="">



<h3>{if $Room neq ""}Edit{else}New{/if}&nbsp;Room of <a href="{$base_url}admin/property/edit/{$property_id}/active_tab/Rooms{$PageParametersWithSort}" > '{$ParentPropertyAddress}'</a> property</h3>
<input type="hidden" id="property_id" name="property_id" value="{$property_id}" size="8" maxlength="8" >
<table style="border:1px dotted gray;" >
{if $Room neq "" and $IsInsert neq 1 }
  <tr>
    <th>
      Id&nbsp;:
    </th>
    <td>
      <input type="text" id="id" name="id" value="{$Room.id}" size="8" readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>
{/if}


  <tr>
    <th>
      Name&nbsp;:
    </th>
    <td>
      <input type="text" id="name" name="name" value="{$Room.name}" size="30" maxlength="100" >
    </td>
  </tr>

  <tr>
    <th>
      Size&nbsp;:
    </th>
    <td>
      <input type="text" id="size" name="size" value="{$Room.size}" size="4" maxlength="4" style="text-align:right">
    </td>
  </tr>

  <tr>
    <th>
      Max Tenants per room&nbsp;:
    </th>
    <td>
      <input type="text" id="max_tenants" name="max_tenants" value="{$Room.max_tenants}" size="2" maxlength="2" style="text-align:right" >
    </td>
  </tr>



  <tr>
    <th>
      Weekly Rate&nbsp;:
    </th>
    <td>
      &euro;&nbsp;<input type="text" id="weekly_rate" name="weekly_rate" value="{$Room.weekly_rate}" size="6" maxlength="6" style="text-align:right" >
    </td>
  </tr>


  <tr>
    <th>
      Revenue&nbsp;:
    </th>
    <td>
      &euro;&nbsp;<input type="text" id="revenue" name="revenue" value="{$Room.revenue}" size="6" maxlength="6" style="text-align:right" >
    </td>
  </tr>

  <tr>
    <th>
      Status&nbsp;:
    </th>
    <td>
      <select name="status" id="status" onchange="javascript:onStatusChanged();">
        {section name=row loop=$RoomStatusValueArray}
          <option value="{$RoomStatusValueArray[row].key}" {if $Room.status eq $RoomStatusValueArray[row].key} selected {/if}>{$RoomStatusValueArray[row].value}</option>
        {/section}
      </select>
    </td>
  </tr>

  <tr id="tr_status_description" style="display:none">
    <th>
      Status Description&nbsp;:
    </th>
    <td>
      <input type="text" id="status_description" name="status_description" value="{$Room.status_description}" size="50" maxlength="255" >
    </td>
  </tr>

  <tr>
    <th>
      Description&nbsp;:
    </th>
    <td>
      <textarea rows="8" cols="60" id="description" name="description" >{$Room.description}</textarea>
    </td>
  </tr>




{if $Room neq "" and $IsInsert neq 1 }
  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="{show_formatted_datetime datetime_label=$Room.created_at format= 'AsText'}" size="30" readonly style="border:1px dotted gray;text-align:left;" >
    </td>
  </tr>

<tr>
    <th>
      Updated At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="{show_formatted_datetime datetime_label=$Room.updated_at format= 'AsText'}" size="30" readonly style="border:1px dotted gray;text-align:left;" >
    </td>
  </tr>
{/if}


  <tr>
    <th>
      &nbsp;
    </th>
    <td>
      &nbsp;
    </td>
  </tr>


{if $Room neq "" and $IsInsert neq 1 }
  <tr>
    <th>
      Photos&nbsp;<b>({$RoomPhotosList|count})</b>
    </th>
    <td>
      {$RoomsListHTML}
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
{/if}


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
      <input type="button" id="btn_submit_reopen" name="btn_submit_reopen" onclick="javascript:onSubmit(1);" value="{if $IsInsert ne 1}Update & Reopen{else}Add & Reopen{/if}" >&nbsp;&nbsp;
      <input type="button" id="btn_submit_list" name="btn_submit_list" onclick="javascript:onSubmit(0);" value="{if $IsInsert ne 1}Update & List{else}Add & List{/if}" >&nbsp;&nbsp;
      <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='{$base_url}admin/property/edit/{$property_id}/active_tab/Rooms{$PageParametersWithSort}'">
    </td>
  </tr>

</table>
</form>
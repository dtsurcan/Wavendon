<script type="text/javascript">

  //  $.noConflict();
  jQuery(document).ready(function($) {
    {if $User neq "" and $IsInsert neq 1 }
    onTypeChanged()
    UserNotesLoad()
    {/if}
    document.getElementById("username").focus()
  });

  function RecreatePassword() {
    if ( !confirm("Do you want to recreate password and send it to user at his email ?") ) return;
    var HRef= '{$base_url}admin/user/recreate_password/id/{$id}';
    //alert(HRef)

    $.getJSON(HRef,   {  },  // JSON
      onRecreatedPassword,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  } // span_user_has_password

  function onRecreatedPassword(data) {
    //alert("onRecreatedPassword data::"+var_dump(data) )
    alert(data.message)
    if ( parseInt(data.ErrorCode) == 0) {
      document.getElementById('span_user_has_password').innerHTML= "Has password"
    } else {
      document.getElementById('span_user_has_password').innerHTML= "<b>Has no password</b>"
    }
  }


  function onSubmit(IsReopen) {
    var theForm = document.getElementById("form_user_edit");
    document.getElementById("is_reopen").value = IsReopen
    theForm.submit();
  }

  function UserNotesLoad() {
    var HRef= "{$base_url}admin/user/load_user_notes/user_id/{$id}";
    $.get(HRef,   {  },  // JSON
      onUserNotesLoaded,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  } // UserNotesLoad()
  function onUserNotesLoaded(data) {
    //alert("onUserNotesLoaded data::"+data )
    document.getElementById('div_UserNotes').innerHTML= data
  }


  function onTypeChanged() {
    var Type= document.getElementById("type").value
    // alert("onStatusChanged Type::"+Type)
    if ( Type== 'tenant' ) { // A Tennant can be linked to 1 or more Guarantor   'tenant' => 'Tenant', 'guarantor' => 'Guarantor', 'landlord' => 'Landlord');
      var HRef= "{$base_url}admin/user/load_linked_guarantors/user_id/{$id}";
      //alert(HRef)
      $.get(HRef,   {  },  // JSON
        onLoadedLinkedGuarantors,
        function(x,y,z) {   //Some sort of error
          alert(x.responseText);
        }
      );
      document.getElementById("tr_linked_guarantors").style.display= GetShowTRMethod()
      document.getElementById("span_people_type").innerHTML= 'Linked Guarantors'
      return;
    }


    if ( Type== 'guarantor' ) { // A Tennant can be linked to 1 or more Guarantor   'tenant' => 'Tenant', 'guarantor' => 'Guarantor', 'landlord' => 'Landlord');
      var HRef= "{$base_url}admin/user/load_linked_tenants/user_id/{$id}";
      //alert(HRef)
      $.get(HRef,   {  },  // JSON
        onLoadedLinkedGuarantors,
        function(x,y,z) {   //Some sort of error
          alert(x.responseText);
        }
      );
      document.getElementById("tr_linked_guarantors").style.display= GetShowTRMethod()
      document.getElementById("span_people_type").innerHTML= 'Linked Tenant'
      return;
    }
    document.getElementById("tr_linked_guarantors").style.display= "none"
  }

  function onLoadedLinkedGuarantors(data) {
    //alert("onLoadedLinkedGuarantors data::"+data )
    document.getElementById('div_LoadedLinkedGuarantors').innerHTML= data
  }

  function AddNewTenantGuarantor() {
    // alert( "AddNewTenantGuarantor()")
    document.getElementById("tr_enter_value_tenant_guarantor").style.display= GetShowTRMethod()
    document.getElementById("tr_add_new_tenant_guarantor").style.display= "none"
  }

  function CancelNewTenantGuarantor() {
    //alert( "CancelNewTenantGuarantor()")
    document.getElementById("tr_enter_value_tenant_guarantor").style.display= "none"
    document.getElementById("tr_add_new_tenant_guarantor").style.display= GetShowTRMethod()
    document.getElementById("select_new_tenant_guarantor").value= ""
  }

  function SaveNewTenantGuarantor() {
    var tenant_guarantor_id= document.getElementById("select_new_tenant_guarantor").value
    //alert( "SaveNewTenantGuarantor() tenant_guarantor_id::"+tenant_guarantor_id )
    if ( Trim(tenant_guarantor_id) == "" ) {
      alert("Select Guarantor!")
      document.getElementById("select_new_tenant_guarantor").focus()
      return;
    }
    var HRef= "{$base_url}admin/user/save_linked_guarantor/tenant_id/{$id}/guarantor_id/"+tenant_guarantor_id;
    //alert(HRef)
    $.getJSON(HRef,   {  },
      onSavedNewTenantGuarantor,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  }

  function onSavedNewTenantGuarantor(data) {
    //alert("oSavedNewTenantGuarantor data::"+data )
  	if ( parseInt(data.ErrorCode) == 0 ) {
      onTypeChanged()
		} else {
		  alert((data.ErrorMessage))
		}
  }

  function DeleteTenantGuarantor( id, TenantGuarantorName ) {
    if ( !confirm( "Do you want to remove '"+TenantGuarantorName+"' Guarantor ?" ) ) return;
    var HRef= "{$base_url}admin/user/delete_linked_guarantor/id/"+id;
    // alert(HRef)
    $.getJSON(HRef,   {  },
      onDeletedTenantGuarantor,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  }

  function onDeletedTenantGuarantor(data) {
    // alert("onDeletedTenantGuarantor data::"+data )
  	if ( parseInt(data.ErrorCode) == 0 ) {
      onTypeChanged()
		} else {
		  alert((data.ErrorMessage))
		}
  }

// SaveNewTenantGuarantorByTenant()
  function SaveNewTenantGuarantorByTenant() {
    var tenant_guarantor_id= document.getElementById("select_new_tenant_guarantor").value
    // alert( "SaveNewTenantGuarantorByTenant() tenant_guarantor_id::"+tenant_guarantor_id )
    if ( Trim(tenant_guarantor_id) == "" ) {
      // alert("Select Tenant!")
      document.getElementById("select_new_tenant_guarantor").focus()
      return;
    }
    var HRef= "{$base_url}admin/user/save_linked_guarantor/guarantor_id/{$id}/tenant_id/"+tenant_guarantor_id;
    // alert(HRef)
    $.getJSON(HRef,   {  },
      onSavedNewTenantGuarantorByTenant,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  }

  function onSavedNewTenantGuarantorByTenant(data) {
   // alert("oSavedNewTenantGuarantorByTenant data::"+data )
  	if ( parseInt(data.ErrorCode) == 0 ) {
      onTypeChanged()
		} else {
		  alert((data.ErrorMessage))
		}
  }

  function UserNotesLoad() {
    var HRef= "{$base_url}admin/user/load_user_notes/user_id/{$id}";
    //alert(HRef)
    $.get(HRef,   {  },  // JSON
      onUserNotesLoaded,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  } // UserNotesLoad()
  function onUserNotesLoaded(data) {
    //alert("onUserNotesLoaded data::"+data )
    document.getElementById('div_UserNotes').innerHTML= data
  }

  function SaveNewUserNotes() {
    var NewUserNotes = Trim(document.getElementById("textarea_NewUserNotes").value)
    //alert( "SaveNewUserNotes()  NewUserNotes::"+NewUserNotes )
    if ( NewUserNotes == "" ) {
      alert( "Fill User Notes !")
      document.getElementById("textarea_NewUserNotes").focus()
      return
    }

    /*
    var HRef= "{$base_url}admin/user/save_new_user_notes/user_id/{$id}/notes/" + encodeURIComponent(NewUserNotes);
    // alert(HRef)
    $.getJSON(HRef,   {  },
      onSavedNewUserNotes,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    ); */


    var HRef= "{$base_url}admin/user/save_new_user_notes"

    //alert(HRef)
    var DataArray= {
			"user_id" : '{$id}',
			"notes" :NewUserNotes,
      'csrf_test_name': $.cookie('csrf_cookie_name')
	  };
    //alert("DataArray::"+var_dump(DataArray) )

  	jQuery.ajax({
      url: HRef,
      type: "POST",
      data: DataArray,
      success: onSavedNewUserNotes,
      dataType: "json"
    });
  }

  function onSavedNewUserNotes(data) {
    // alert("onSavedNewUserNotes data::"+data );
  	if ( parseInt(data.ErrorCode) == 0 ) {
      UserNotesLoad();
      document.getElementById("textarea_NewUserNotes").value= ''
		} else {
		  alert((data.ErrorMessage));
		}
  }

  function ShowUserNotes(id) {
	  var HRef= '{$base_url}admin/user/show_usernotes/id/'+id+'?width=640&height=800'
	  tb_show( "User Notes", HRef, "/images/help.png" );
  }


  function DeleteUserNotes( id, UserNotesShort ) {
    if ( !confirm( "Do you want to remove '"+UserNotesShort+"' User Notes ?" ) ) return;
    var HRef= "{$base_url}admin/user/delete_user_notes/id/"+id;
    $.getJSON(HRef,   {  },
      onDeleteUserNotes,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  }

  function onDeleteUserNotes(data) {
  	if ( parseInt(data.ErrorCode) == 0 ) {
      UserNotesLoad()
		} else {
		  alert((data.ErrorMessage))
		}
  }

</script>

<span class="error">{$validation_errors_text}
  {$images_upload_display_errors}
</span>

<span class="flash_message">
  {$editor_message}
</span>


<form action="{$base_url}admin/user/edit/{$id}{$PageParametersWithSort}" method="post" accept-charset="utf-8" id="form_user_edit" name="form_user_edit" enctype="multipart/form-data">
{$csrf_token_name_hidden}
<input type="hidden" id="is_reopen" name="is_reopen" value="">

<h3>{if $User neq ""}Edit{else}New{/if}&nbsp;People</h3>

<table style="border:1px dotted gray;" >
  {if $User neq "" and $IsInsert neq 1 }
    <tr>
      <th>
        Id&nbsp;:
      </th>
      <td>
        <input type="text" id="id" name="id" value="{if $User neq ""}{$User.id}{/if}" size="8" readonly style="border:1px dotted gray;text-align: right;" >
      </td>
    </tr>
  {/if}


  <tr>
    <th>
      Username&nbsp;:
    </th>
    <td>
      <input type="text" id="username" name="username" value="{if $User neq ""}{$User.username}{/if}" size="30" maxlength="255" >
    </td>
  </tr>

  <tr>
    <th>
      Password&nbsp;:
    </th>
    <td>
      <!-- <input type="text" id="password" name="password" value="{if $User neq ""}{$User.password}{/if}" size="30" maxlength="255" >  -->
      <span id="span_user_has_password">{if $User.password neq "" and $User.password|strlen eq 32}Has password{else}<b>Has no password</b>{/if}</span>
      {if $User neq "" and $IsInsert neq 1 }
        &nbsp;&nbsp;<input type="button" id="password" name="password" value="Recreate password and send to user" onclick="javascript:RecreatePassword()" >
      {/if}
    </td>
  </tr>

  <tr>
    <th>
      Email&nbsp;:
    </th>
    <td>
      <input type="text" id="email" name="email" value="{if $User neq ""}{$User.email}{/if}" size="30" maxlength="255" >
    </td>
  </tr>

  <tr>
    <th>
      Type&nbsp;:
    </th>
    <td>
      <select name="type" id="type"  onchange="javascript:onTypeChanged();" >
        {section name=row loop=$UserTypeValueArray}
          <option value="{$UserTypeValueArray[row].key}" {if $User.type eq $UserTypeValueArray[row].key} selected {/if}>{$UserTypeValueArray[row].value}</option>
        {/section}
      </select>
    </td>
  </tr>



  <tr id="tr_linked_guarantors" style="display:none">
    <th>
      <span id="span_people_type"></span>&nbsp;:
    </th>
    <td>
      <idiv id="div_LoadedLinkedGuarantors"></div>
    </td>
  </tr>


    <tr>
      <th>
        Title&nbsp;:
      </th>
      <td>
        <select name="title" id="title" >
        {section name=row loop=$UserTitleValueArray}
          <option value="{$UserTitleValueArray[row].key}" {if $User.title eq $UserTitleValueArray[row].key} selected {/if}>{$UserTitleValueArray[row].value}</option>
        {/section}
        </select>
      </td>
    </tr>



    <tr>
      <th>
        First Name&nbsp;:
      </th>
      <td>
        <input type="text" id="first_name" name="first_name" value="{if $User neq ""}{$User.first_name}{/if}" size="30" maxlength="50" >
      </td>
    </tr>

    <tr>
      <th>
        Middle Name&nbsp;:
      </th>
      <td>
        <input type="text" id="middle_name" name="middle_name" value="{if $User neq ""}{$User.middle_name}{/if}" size="30" maxlength="50" >
      </td>
    </tr>

    <tr>
      <th>
        Last Name&nbsp;:
      </th>
      <td>
        <input type="text" id="last_name" name="last_name" value="{if $User neq ""}{$User.last_name}{/if}" size="30" maxlength="50" >
      </td>
    </tr>

    <tr>
      <th>
        Passport&nbsp;:
      </th>
      <td>
        <input type="text" id="passport" name="passport" value="{if $User neq ""}{$User.passport}{/if}" size="50" maxlength="50" >
      </td>
    </tr>

    <tr>
      <th>
        DLN&nbsp;:
      </th>
      <td>
        <input type="text" id="dln" name="dln" value="{if $User neq ""}{$User.dln}{/if}" size="50" maxlength="50" >
      </td>
    </tr>

    <tr>
      <th>
        Photo&nbsp;:
      </th>
      <td>
        <input type="file" id="photo" name="photo" value="" size="50" maxlength="255" >
        {$photo_image_preview_html}
      </td>
    </tr>


    <tr>
      <th>
        Passport Copy&nbsp;:
      </th>
      <td>
        <input type="file" id="copy_passport" name="copy_passport" value="" size="50" maxlength="255" >
        {$copy_passport_image_preview_html}
      </td>
    </tr>


    <tr>
      <th>
        DLN Copy&nbsp;:
      </th>
      <td>
        <input type="file" id="copy_dln" name="copy_dln" value="" size="50" maxlength="255" >
        {$copy_dln_image_preview_html}
      </td>
    </tr>



    {if $User neq "" and $IsInsert neq 1 }
      <tr>
        <th>
          Created At&nbsp;:
        </th>
        <td>
          <input type="text" id="created_at" name="created_at" value="{show_formatted_datetime datetime_label=$User.created_at format= 'AsText'}" size="30" readonly style="border:1px dotted gray;text-align:left;" >
        </td>
      </tr>

      <tr>
        <th>
          Updated At&nbsp;:
        </th>
        <td>
          <input type="text" id="created_at" name="created_at" value="{show_formatted_datetime datetime_label=$User.updated_at format= 'AsText'}" size="30" readonly style="border:1px dotted gray;text-align:left;" >
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

    <tr>
      <th>
        &nbsp;
      </th>
      <td>
        <input type="button" id="btn_submit_reopen" name="btn_submit_reopen" onclick="javascript:onSubmit(1);" value="{if $IsInsert ne 1}Update & Reopen{else}Add & Reopen{/if}" >&nbsp;&nbsp;
        <input type="button" id="btn_submit_list" name="btn_submit_list" onclick="javascript:onSubmit(0);" value="{if $IsInsert ne 1}Update & List{else}Add & List{/if}" >&nbsp;&nbsp;
        <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='{$base_url}admin/user/index{$PageParametersWithSort}'">
      </td>
    </tr>

  {if $User neq "" and $IsInsert neq 1 }
  <tr >
    <td colspan="2">
      <div id="div_UserNotes"></div>
    </td>
  </tr>

  <tr >
    <td colspan="2">
      &nbsp;<b>Add New User Notes</b><br>
      <textarea cols="100" rows="10" name="textarea_NewUserNotes" id="textarea_NewUserNotes"></textarea>&nbsp;
    </td>
  </tr>

  <tr >
    <td>
      &nbsp;
    </td>
    <td>
      <a href="javascript:SaveNewUserNotes()">Save</a>&nbsp;
    </td>
  </tr>
  {/if}



</table>
</form>
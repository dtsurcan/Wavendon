<?php /* Smarty version Smarty-3.1.12, created on 2013-01-19 07:03:45
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/user_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127765328250f25068ae3fb6-70875614%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e76c7550ad20b78c7d3986e4c7d164c4590af41f' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/user_edit.tpl',
      1 => 1358575375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127765328250f25068ae3fb6-70875614',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f25068ccfb75_70880579',
  'variables' => 
  array (
    'User' => 0,
    'IsInsert' => 0,
    'base_url' => 0,
    'id' => 0,
    'validation_errors_text' => 0,
    'images_upload_display_errors' => 0,
    'editor_message' => 0,
    'PageParametersWithSort' => 0,
    'csrf_token_name_hidden' => 0,
    'UserTypeValueArray' => 0,
    'UserTitleValueArray' => 0,
    'photo_image_preview_html' => 0,
    'copy_passport_image_preview_html' => 0,
    'copy_dln_image_preview_html' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f25068ccfb75_70880579')) {function content_50f25068ccfb75_70880579($_smarty_tpl) {?><script type="text/javascript">

  //  $.noConflict();
  jQuery(document).ready(function($) {
    <?php if ($_smarty_tpl->tpl_vars['User']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
    onTypeChanged()
    UserNotesLoad()
    <?php }?>
    document.getElementById("username").focus()
  });

  function RecreatePassword() {
    if ( !confirm("Do you want to recreate password and send it to user at his email ?") ) return;
    var HRef= '<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/recreate_password/id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
';
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
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/load_user_notes/user_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
";
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
      var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/load_linked_guarantors/user_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
";
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
      var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/load_linked_tenants/user_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
";
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
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/save_linked_guarantor/tenant_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/guarantor_id/"+tenant_guarantor_id;
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
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/delete_linked_guarantor/id/"+id;
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
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/save_linked_guarantor/guarantor_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/tenant_id/"+tenant_guarantor_id;
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
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/load_user_notes/user_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
";
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
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/save_new_user_notes/user_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/notes/" + encodeURIComponent(NewUserNotes);
    // alert(HRef)
    $.getJSON(HRef,   {  },
      onSavedNewUserNotes,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    ); */


    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/save_new_user_notes"

    //alert(HRef)
    var DataArray= {
			"user_id" : '<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
',
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
	  var HRef= '<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/show_usernotes/id/'+id+'?width=640&height=800'
	  tb_show( "User Notes", HRef, "/images/help.png" );
  }


  function DeleteUserNotes( id, UserNotesShort ) {
    if ( !confirm( "Do you want to remove '"+UserNotesShort+"' User Notes ?" ) ) return;
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/delete_user_notes/id/"+id;
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

<span class="error"><?php echo $_smarty_tpl->tpl_vars['validation_errors_text']->value;?>

  <?php echo $_smarty_tpl->tpl_vars['images_upload_display_errors']->value;?>

</span>

<span class="flash_message">
  <?php echo $_smarty_tpl->tpl_vars['editor_message']->value;?>

</span>


<form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/edit/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
" method="post" accept-charset="utf-8" id="form_user_edit" name="form_user_edit" enctype="multipart/form-data">
<?php echo $_smarty_tpl->tpl_vars['csrf_token_name_hidden']->value;?>

<input type="hidden" id="is_reopen" name="is_reopen" value="">

<h3><?php if ($_smarty_tpl->tpl_vars['User']->value!=''){?>Edit<?php }else{ ?>New<?php }?>&nbsp;People</h3>

<table style="border:1px dotted gray;" >
  <?php if ($_smarty_tpl->tpl_vars['User']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
    <tr>
      <th>
        Id&nbsp;:
      </th>
      <td>
        <input type="text" id="id" name="id" value="<?php if ($_smarty_tpl->tpl_vars['User']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['User']->value['id'];?>
<?php }?>" size="8" readonly style="border:1px dotted gray;text-align: right;" >
      </td>
    </tr>
  <?php }?>


  <tr>
    <th>
      Username&nbsp;:
    </th>
    <td>
      <input type="text" id="username" name="username" value="<?php if ($_smarty_tpl->tpl_vars['User']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['User']->value['username'];?>
<?php }?>" size="30" maxlength="255" >
    </td>
  </tr>

  <tr>
    <th>
      Password&nbsp;:
    </th>
    <td>
      <!-- <input type="text" id="password" name="password" value="<?php if ($_smarty_tpl->tpl_vars['User']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['User']->value['password'];?>
<?php }?>" size="30" maxlength="255" >  -->
      <span id="span_user_has_password"><?php if ($_smarty_tpl->tpl_vars['User']->value['password']!=''&&strlen($_smarty_tpl->tpl_vars['User']->value['password'])==32){?>Has password<?php }else{ ?><b>Has no password</b><?php }?></span>
      <?php if ($_smarty_tpl->tpl_vars['User']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
        &nbsp;&nbsp;<input type="button" id="password" name="password" value="Recreate password and send to user" onclick="javascript:RecreatePassword()" >
      <?php }?>
    </td>
  </tr>

  <tr>
    <th>
      Email&nbsp;:
    </th>
    <td>
      <input type="text" id="email" name="email" value="<?php if ($_smarty_tpl->tpl_vars['User']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['User']->value['email'];?>
<?php }?>" size="30" maxlength="255" >
    </td>
  </tr>

  <tr>
    <th>
      Type&nbsp;:
    </th>
    <td>
      <select name="type" id="type"  onchange="javascript:onTypeChanged();" >
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['UserTypeValueArray']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
          <option value="<?php echo $_smarty_tpl->tpl_vars['UserTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
" <?php if ($_smarty_tpl->tpl_vars['User']->value['type']==$_smarty_tpl->tpl_vars['UserTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key']){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['UserTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['value'];?>
</option>
        <?php endfor; endif; ?>
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
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['UserTitleValueArray']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
          <option value="<?php echo $_smarty_tpl->tpl_vars['UserTitleValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
" <?php if ($_smarty_tpl->tpl_vars['User']->value['title']==$_smarty_tpl->tpl_vars['UserTitleValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key']){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['UserTitleValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['value'];?>
</option>
        <?php endfor; endif; ?>
        </select>
      </td>
    </tr>



    <tr>
      <th>
        First Name&nbsp;:
      </th>
      <td>
        <input type="text" id="first_name" name="first_name" value="<?php if ($_smarty_tpl->tpl_vars['User']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['User']->value['first_name'];?>
<?php }?>" size="30" maxlength="50" >
      </td>
    </tr>

    <tr>
      <th>
        Middle Name&nbsp;:
      </th>
      <td>
        <input type="text" id="middle_name" name="middle_name" value="<?php if ($_smarty_tpl->tpl_vars['User']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['User']->value['middle_name'];?>
<?php }?>" size="30" maxlength="50" >
      </td>
    </tr>

    <tr>
      <th>
        Last Name&nbsp;:
      </th>
      <td>
        <input type="text" id="last_name" name="last_name" value="<?php if ($_smarty_tpl->tpl_vars['User']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['User']->value['last_name'];?>
<?php }?>" size="30" maxlength="50" >
      </td>
    </tr>

    <tr>
      <th>
        Passport&nbsp;:
      </th>
      <td>
        <input type="text" id="passport" name="passport" value="<?php if ($_smarty_tpl->tpl_vars['User']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['User']->value['passport'];?>
<?php }?>" size="50" maxlength="50" >
      </td>
    </tr>

    <tr>
      <th>
        DLN&nbsp;:
      </th>
      <td>
        <input type="text" id="dln" name="dln" value="<?php if ($_smarty_tpl->tpl_vars['User']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['User']->value['dln'];?>
<?php }?>" size="50" maxlength="50" >
      </td>
    </tr>

    <tr>
      <th>
        Photo&nbsp;:
      </th>
      <td>
        <input type="file" id="photo" name="photo" value="" size="50" maxlength="255" >
        <?php echo $_smarty_tpl->tpl_vars['photo_image_preview_html']->value;?>

      </td>
    </tr>


    <tr>
      <th>
        Passport Copy&nbsp;:
      </th>
      <td>
        <input type="file" id="copy_passport" name="copy_passport" value="" size="50" maxlength="255" >
        <?php echo $_smarty_tpl->tpl_vars['copy_passport_image_preview_html']->value;?>

      </td>
    </tr>


    <tr>
      <th>
        DLN Copy&nbsp;:
      </th>
      <td>
        <input type="file" id="copy_dln" name="copy_dln" value="" size="50" maxlength="255" >
        <?php echo $_smarty_tpl->tpl_vars['copy_dln_image_preview_html']->value;?>

      </td>
    </tr>



    <?php if ($_smarty_tpl->tpl_vars['User']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
      <tr>
        <th>
          Created At&nbsp;:
        </th>
        <td>
          <input type="text" id="created_at" name="created_at" value="<?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['User']->value['created_at'],'format'=>'AsText'),$_smarty_tpl);?>
" size="30" readonly style="border:1px dotted gray;text-align:left;" >
        </td>
      </tr>

      <tr>
        <th>
          Updated At&nbsp;:
        </th>
        <td>
          <input type="text" id="created_at" name="created_at" value="<?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['User']->value['updated_at'],'format'=>'AsText'),$_smarty_tpl);?>
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

    <tr>
      <th>
        &nbsp;
      </th>
      <td>
        <input type="button" id="btn_submit_reopen" name="btn_submit_reopen" onclick="javascript:onSubmit(1);" value="<?php if ($_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>Update & Reopen<?php }else{ ?>Add & Reopen<?php }?>" >&nbsp;&nbsp;
        <input type="button" id="btn_submit_list" name="btn_submit_list" onclick="javascript:onSubmit(0);" value="<?php if ($_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>Update & List<?php }else{ ?>Add & List<?php }?>" >&nbsp;&nbsp;
        <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
'">
      </td>
    </tr>

  <?php if ($_smarty_tpl->tpl_vars['User']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
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
  <?php }?>



</table>
</form><?php }} ?>
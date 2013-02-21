<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 06:28:30
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/block_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:51671092850fe77de1629d5-50441343%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc3a61147684d76d7e187946c50a7ffaa785c0cd' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/block_edit.tpl',
      1 => 1358844079,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '51671092850fe77de1629d5-50441343',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Block' => 0,
    'IsInsert' => 0,
    'base_url' => 0,
    'id' => 0,
    'PageParametersWithSort' => 0,
    'csrf_token_name_hidden' => 0,
    'validation_errors_text' => 0,
    'editor_message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe77de2597d6_81252116',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe77de2597d6_81252116')) {function content_50fe77de2597d6_81252116($_smarty_tpl) {?>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    <?php if ($_smarty_tpl->tpl_vars['Block']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
    BlockPropertiesLoad()
    <?php }?>
    document.getElementById("name").focus()
  });

  function OpenPropertysSelection(Fieldname) {
    //alert("OpenPropertysSelection Fieldname::"+Fieldname )

    var screen_popup_width_indent= 50
    var screen_popup_height_indent= 100
    var H= screen.availHeight - screen_popup_height_indent;
    var W= screen.availWidth - screen_popup_width_indent;
    var TopCoord= screen_popup_height_indent / 2
    var LeftCoord= screen_popup_width_indent / 2

    var naProps = window.open( "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/index/page/1/is_selection/1/is_onlyunusedinblocks/1",
      "property_list","status=no,modal=yes,scrollbars=yes,width="+W+",height="+H+",left="+LeftCoord+", top="+TopCoord );

  }
  function FillProperty( SelectedID, SelectedNAME ) {
    FillDdlbValue( "select_new_block_property", SelectedID, SelectedNAME )
  }

  function BlockPropertiesLoad() {
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/load_block_properties/block_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
";
    //alert(HRef)
    $.get(HRef,   {  },  // JSON
      onBlockPropertiesLoaded,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  }
  function onBlockPropertiesLoaded(data) {
    document.getElementById('div_LoadedLinkedProperties').innerHTML= data;
  }

  function onSubmit(IsReopen) {
    var theForm = document.getElementById("form_block_edit");
    document.getElementById("is_reopen").value = IsReopen
    theForm.submit();
  }


  ////////////////////////////////////
  function AddNewPropertyToBlock() {
    document.getElementById("tr_enter_value_block_property").style.display= GetShowTRMethod()
    document.getElementById("tr_add_new_block_property").style.display= "none"
  }

  function CancelNewTenantGuarantor() {
    document.getElementById("tr_enter_value_block_property").style.display= "none"
    document.getElementById("tr_add_new_block_property").style.display= GetShowTRMethod()
    document.getElementById("select_new_block_property").value= ""
  }

  function SaveNewBlockProperty() {
    var block_property_id= document.getElementById("select_new_block_property").value
    if ( Trim(block_property_id) == "" ) {
      alert("Select Property!")
      document.getElementById("select_new_block_property").focus()
      return;
    }
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/save_block_property/block_id/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/property_id/"+block_property_id;
    // alert(HRef)
    $.getJSON(HRef,   {  },
      onSavedBlockProperty,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  }

  function onSavedBlockProperty(data) {
    // alert("onSavedBlockProperty data::"+var_dump(data) )
  	if ( parseInt(data.ErrorCode) == 0 ) {
      BlockPropertiesLoad()
		} else {
		  alert((data.ErrorMessage))
		}
  }

  function DeleteBlockProperty( id, PropertyName ) {
    if ( !confirm( "Do you want to clear block of '"+PropertyName+"' Property ?" ) ) return;
    var HRef= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/delete_block_property/property_id/"+id;
    // alert(HRef)
    $.getJSON(HRef,   {  },
      onDeleteBlockProperty,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  }

  function onDeleteBlockProperty(data) {
//     alert("onDeleteBlockProperty data::"+var_dump(data) )
  	if ( parseInt(data.ErrorCode) == 0 ) {
      BlockPropertiesLoad()
		} else {
		  alert((data.ErrorMessage))
		}
  }


</script>


<form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/edit/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
" method="post" accept-charset="utf-8" id="form_block_edit" name="form_block_edit" enctype="multipart/form-data">
<?php echo $_smarty_tpl->tpl_vars['csrf_token_name_hidden']->value;?>


<input type="hidden" id="is_reopen" name="is_reopen" value="">


<h3><?php if ($_smarty_tpl->tpl_vars['Block']->value==''){?>New<?php }else{ ?>Edit<?php }?>&nbsp;Block</h3>
<span class="error"><?php echo $_smarty_tpl->tpl_vars['validation_errors_text']->value;?>
</span>
<span class="flash_message">
  <?php echo $_smarty_tpl->tpl_vars['editor_message']->value;?>

</span>

<table style="border:1px dotted gray;" >
<?php if ($_smarty_tpl->tpl_vars['Block']->value!=''){?>
  <tr>
    <th>
      Id&nbsp;:
    </th>
    <td>
      <input type="text" id="id" name="id" value="<?php if ($_smarty_tpl->tpl_vars['Block']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['Block']->value['id'];?>
<?php }?>" size="8" readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>
<?php }?>

  <tr>
    <th>
      Name&nbsp;:
    </th>
    <td>
      <input type="text" id="name" name="name" value="<?php if ($_smarty_tpl->tpl_vars['Block']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['Block']->value['name'];?>
<?php }?>" size="50" maxlength="50" >
    </td>
  </tr>

  <tr>
    <th>
      Description&nbsp;:
    </th>
    <td>
      <textarea rows="8" cols="60" id="description" name="description" ><?php if ($_smarty_tpl->tpl_vars['Block']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['Block']->value['description'];?>
<?php }?></textarea>
    </td>
  </tr>

  <tr id="tr_block_linked_properties" >
    <th>
      Have Properties&nbsp;:
    </th>
    <td>
      <idiv id="div_LoadedLinkedProperties"></div>
    </td>
  </tr>

<?php if ($_smarty_tpl->tpl_vars['Block']->value!=''){?>
  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="<?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['Block']->value['created_at'],'format'=>'AsText'),$_smarty_tpl);?>
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
      <input type="button" id="btn_submit_reopen" name="btn_submit_reopen" onclick="javascript:onSubmit(1);" value="<?php if ($_smarty_tpl->tpl_vars['Block']->value!=''){?>Update & Reopen<?php }else{ ?>Add & Reopen<?php }?>" >&nbsp;&nbsp;
      <input type="button" id="btn_submit_list" name="btn_submit_list" onclick="javascript:onSubmit(0);" value="<?php if ($_smarty_tpl->tpl_vars['Block']->value!=''){?>Update & List<?php }else{ ?>Add & List<?php }?>" >&nbsp;&nbsp;
      <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
'">
    </td>
  </tr>

</table>
</form>

<?php }} ?>
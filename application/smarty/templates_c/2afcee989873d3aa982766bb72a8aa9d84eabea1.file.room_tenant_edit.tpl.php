<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 06:27:18
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/room_tenant_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160706834050fe77963547a5-22973459%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2afcee989873d3aa982766bb72a8aa9d84eabea1' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/room_tenant_edit.tpl',
      1 => 1358844084,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160706834050fe77963547a5-22973459',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_root_url' => 0,
    'js_dir' => 0,
    'DatePickerSelectionFormat' => 0,
    'base_url' => 0,
    'id' => 0,
    'property_id' => 0,
    'room_id' => 0,
    'PageParametersWithSort' => 0,
    'csrf_token_name_hidden' => 0,
    'RoomTenant' => 0,
    'validation_errors_text' => 0,
    'editor_message' => 0,
    'IsInsert' => 0,
    'TenantsList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe77964469d9_19801200',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe77964469d9_19801200')) {function content_50fe77964469d9_19801200($_smarty_tpl) {?><script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_root_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
jquery/ui.datepicker.js"></script>

<script type="text/javascript">

  jQuery(document).ready(function($) {
    jQuery( "#from_date" ).datepicker({ // http://docs.jquery.com/UI/API/1.8/Datepicker#options
      dateFormat: '<?php echo $_smarty_tpl->tpl_vars['DatePickerSelectionFormat']->value;?>
',
      minDate:    new Date(2012, 1, 1),
      maxDate:    new Date(2028, 12, 31)
    });  // $( ".selector" ).datepicker( "option", "changeMonth", true );
    $( "#from_date" ).datepicker( "option", "changeMonth", true );
    $( "#from_date" ).datepicker( "option", "changeYear", true );
    $( "#from_date" ).datepicker( "option", "closeText", "Close" );
    $( "#from_date" ).datepicker( "option", "constrainInput", true );


//alert("AFTER")

  });


  function onSubmit(IsReopen) {
    var theForm = document.getElementById("form_room_tenant_edit");
    document.getElementById("is_reopen").value = IsReopen
    theForm.submit();
  }



</script>

<form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/room_tenant_edit/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
/room_id/<?php echo $_smarty_tpl->tpl_vars['room_id']->value;?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
" method="post" accept-charset="utf-8" id="form_room_tenant_edit" name="form_room_tenant_edit" enctype="multipart/form-data">
<?php echo $_smarty_tpl->tpl_vars['csrf_token_name_hidden']->value;?>

<input type="hidden" id="is_reopen" name="is_reopen" value="">


<h3><?php if ($_smarty_tpl->tpl_vars['RoomTenant']->value!=''){?>Edit<?php }else{ ?>New<?php }?>&nbsp;RoomTenant</h3>
<span class="error"><?php echo $_smarty_tpl->tpl_vars['validation_errors_text']->value;?>
</span>
<span class="flash_message">
  <?php echo $_smarty_tpl->tpl_vars['editor_message']->value;?>

</span>

<table style="border:1px dotted gray;" >
<?php if ($_smarty_tpl->tpl_vars['RoomTenant']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
  <tr>
    <th>
      Id&nbsp;:
    </th>
    <td>
      <input type="text" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['RoomTenant']->value['id'];?>
" size="8" readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>
<?php }?>

  <tr>
    <th>
      From Date&nbsp;:
    </th>
    <td>
      <input type="text" id="from_date" name="from_date" value="<?php echo $_smarty_tpl->tpl_vars['RoomTenant']->value['from_date'];?>
" size="10" maxlength="10"
        readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>


  <tr>
    <th>
      Tenant&nbsp;:
    </th>
    <td>
      <select name="tenant_id" id="tenant_id" >
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['TenantsList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <option value="<?php echo $_smarty_tpl->tpl_vars['TenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
" <?php if ($_smarty_tpl->tpl_vars['RoomTenant']->value['tenant_id']==$_smarty_tpl->tpl_vars['TenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key']){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['TenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['value'];?>
</option>
        <?php endfor; endif; ?>
      </select>
    </td>
  </tr>


  <tr>
    <th>
      Weekly Rate&nbsp;:
    </th>
    <td>
      &euro;&nbsp;<input type="text" id="weekly_rate" name="weekly_rate" value="<?php echo $_smarty_tpl->tpl_vars['RoomTenant']->value['weekly_rate'];?>
" size="6" maxlength="6" style="text-align:right" >
    </td>
  </tr>


  <tr>
    <th>
      Description&nbsp;:
    </th>
    <td>
      <textarea rows="8" cols="60" id="text" name="text" ><?php echo $_smarty_tpl->tpl_vars['RoomTenant']->value['text'];?>
</textarea>
    </td>
  </tr>



<?php if ($_smarty_tpl->tpl_vars['RoomTenant']->value!=''&&$_smarty_tpl->tpl_vars['IsInsert']->value!=1){?>
  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="<?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['RoomTenant']->value['created_at'],'format'=>'AsText'),$_smarty_tpl);?>
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
admin/room/edit/<?php echo $_smarty_tpl->tpl_vars['room_id']->value;?>
/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
'">
    </td>
  </tr>

</table>
</form>
<?php }} ?>
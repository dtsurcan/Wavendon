<?php /* Smarty version Smarty-3.1.12, created on 2013-01-14 05:50:20
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/loaded_room_tenant_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131505569450f39c6a335bc9-82448331%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14e4c0e0b28e6e3da8d01ad3117a0e7cb5fa36a4' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/loaded_room_tenant_list.tpl',
      1 => 1358142611,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131505569450f39c6a335bc9-82448331',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f39c6a4de5e4_26578344',
  'variables' => 
  array (
    'RoomTenantsList' => 0,
    'max_tenants' => 0,
    'base_url' => 0,
    'room_id' => 0,
    'property_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f39c6a4de5e4_26578344')) {function content_50f39c6a4de5e4_26578344($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['RoomTenantsList']->value)==0){?>
  <h4>No Room Tenants</h4>
  <?php if ($_smarty_tpl->tpl_vars['max_tenants']->value<=count($_smarty_tpl->tpl_vars['RoomTenantsList']->value)){?>
    <small>No more tenants are possible.</small>
  <?php }else{ ?>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/room_tenant_edit/0/room_id/<?php echo $_smarty_tpl->tpl_vars['room_id']->value;?>
/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
">New Room Tenant</a>
  <?php }?>
  <?php return; ?>
<?php }?>

<table style="border:1px dotted gray;">
  <tr>
    <th>Room</th>
    <th>Tenant</th>
    <th>From Date</th>
    <th>Weekly Rate</th>
    <th>Text</th>
    <th>Created At</th>
  </tr>
  <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['RoomTenantsList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <tr>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_name'];?>

    </td>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['tenant_name'];?>

    </td>
    <td style="text-align:center" >
      <?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['from_date'],'format'=>'DateAsText'),$_smarty_tpl);?>

    </td>
    <td style="text-align:right" >
      &euro;&nbsp;<?php echo $_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['weekly_rate'];?>

    </td>
    <td>
      <?php echo smConcatStr(array('str'=>$_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['text'],'len'=>60),$_smarty_tpl);?>

    </td>

    <td style="text-align:center">
      <?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['created_at'],'format'=>'AsText'),$_smarty_tpl);?>

    </td>
    <td>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/room_tenant_edit/<?php echo $_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
/room_id/<?php echo $_smarty_tpl->tpl_vars['room_id']->value;?>
/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
">Edit</a>&nbsp;
    </td>
    <td>
      <a href="javascript:DeleteRoomTenant('<?php echo $_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['tenant_name'];?>
', '<?php echo $_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_name'];?>
' )" >Delete</a>&nbsp;
    </td>
    <td>
      <a href="javascript:MoveRoomTenantToHistory('<?php echo $_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['tenant_name'];?>
', '<?php echo $_smarty_tpl->tpl_vars['RoomTenantsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_name'];?>
' )" >Move To History</a>&nbsp;
    </td>

  </tr>
  <?php endfor; endif; ?>

  <tr>
    <td colspan="8">&nbsp;
    </td>
  </tr>
  <tr>
    <td colspan="8">
  <?php if ($_smarty_tpl->tpl_vars['max_tenants']->value<=count($_smarty_tpl->tpl_vars['RoomTenantsList']->value)){?>
    <small>No more tenants are possible.</small>
  <?php }else{ ?>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/room_tenant_edit/0/room_id/<?php echo $_smarty_tpl->tpl_vars['room_id']->value;?>
/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
">New Room Tenant</a>
  <?php }?>
    </td>
  </tr>

</table>
<?php }} ?>
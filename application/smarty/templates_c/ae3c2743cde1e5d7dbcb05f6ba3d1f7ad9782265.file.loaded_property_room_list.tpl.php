<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 06:25:17
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/loaded_property_room_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59650650fe771d896d00-06347272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae3c2743cde1e5d7dbcb05f6ba3d1f7ad9782265' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/loaded_property_room_list.tpl',
      1 => 1358844081,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59650650fe771d896d00-06347272',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'RoomsList' => 0,
    'PageParametersWithSort' => 0,
    'property_id' => 0,
    'RowsInTable' => 0,
    'ControllerRef' => 0,
    'pagination_links' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe771d9f97c4_18786922',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe771d9f97c4_18786922')) {function content_50fe771d9f97c4_18786922($_smarty_tpl) {?><form id="form_rooms" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/index" method="POST" >


<?php if (count($_smarty_tpl->tpl_vars['RoomsList']->value)==0){?>
  <div>No Data Found</div>
  <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/edit/0<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
" >New Room</a>
  <?php return; ?>
<?php }?>

<?php echo count($_smarty_tpl->tpl_vars['RoomsList']->value);?>
&nbsp;Row<?php if (count($_smarty_tpl->tpl_vars['RoomsList']->value)>0){?>s<?php }?>&nbsp;of&nbsp;<?php echo $_smarty_tpl->tpl_vars['RowsInTable']->value;?>
&nbsp;
<table style="border:1px dotted gray;" >

  <tr>
    <th>Name</th>
    <th>Size</th>
    <th>Max Tenants per room</th>
    <th>Description</th>
    <th>Weekly Rate</th>
    <th>Revenue</th>
    <th>Status</th>
    <th>Created At</th>
    <th>Updated At</th>
    <th colspan="2">&nbsp;</th>
  </tr>


  <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['RoomsList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['name'];?>

        <?php if ($_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_photo_room_count']>0||$_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_tenant_room_count']>0){?>&nbsp;&nbsp;<small>(<?php }?>
        <?php if ($_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_photo_room_count']>0){?>
          <?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_photo_room_count'];?>
&nbsp;Photo<?php if ($_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_photo_room_count']>1){?>s<?php }?>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_photo_room_count']>0&&$_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_tenant_room_count']>0){?>,&nbsp;<?php }?>

        <?php if ($_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_photo_room_count']>0&&$_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_tenant_room_count']>0){?>
          <?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_tenant_room_count'];?>
&nbsp;Tenant<?php if ($_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_tenant_room_count']>0){?>s<?php }?>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_photo_room_count']>0||$_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_tenant_room_count']>0){?>&nbsp;)&nbsp;</small><?php }?>
    </td>
    <td style="text-align:right" >
      <?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['size'];?>

    </td>
    <td style="text-align:right">
      <?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['max_tenants'];?>

    </td>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['description'];?>

    </td>
    <td style="text-align:right" >
      &euro;&nbsp;<?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['weekly_rate'];?>

    </td>
    <td style="text-align:right">
      &euro;&nbsp;<?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['revenue'];?>

    </td>


    <td>
      <?php echo smShowRoomStatusTitle(array('status'=>$_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['status'],'ControllerRef'=>$_smarty_tpl->tpl_vars['ControllerRef']->value),$_smarty_tpl);?>

    </td>

    <td style="text-align:center">
      <?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['updated_at'],'format'=>'AsText'),$_smarty_tpl);?>

    </td>
    <td style="text-align:center">
      <?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['created_at'],'format'=>'AsText'),$_smarty_tpl);?>

    </td>
    <td>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/edit/<?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
" >Edit</a>
    </td>
    <td>
      <a href="javascript:DeleteRoom('<?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['name'];?>
', '<?php echo $_smarty_tpl->tpl_vars['RoomsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['property_id'];?>
' )" >Delete</a>
    </td>
  </tr>
  <?php endfor; endif; ?>
</table>
<?php echo $_smarty_tpl->tpl_vars['pagination_links']->value;?>

<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/room/edit/0/property_id/<?php echo $_smarty_tpl->tpl_vars['property_id']->value;?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
">New Room</a>

</form><?php }} ?>
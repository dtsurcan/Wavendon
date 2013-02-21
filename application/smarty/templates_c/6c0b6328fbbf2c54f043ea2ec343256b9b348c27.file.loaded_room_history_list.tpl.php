<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 06:26:06
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/loaded_room_history_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:148826674450fe774ebe86e0-07211051%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c0b6328fbbf2c54f043ea2ec343256b9b348c27' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/loaded_room_history_list.tpl',
      1 => 1358844081,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '148826674450fe774ebe86e0-07211051',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'HistorysList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe774ec663d5_77085849',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe774ec663d5_77085849')) {function content_50fe774ec663d5_77085849($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['HistorysList']->value)==0){?>
  <h4>No History</h4>
  <?php return; ?>
<?php }?>

<table style="border:1px dotted gray;">
  <tr>
    <th>Room</th>
    <th>Tenant</th>
    <th>From Date</th>
    <th>To Date</th>
    <th>Weekly Rate</th>
    <th>History Text</th>
    <th>Created At</th>
  </tr>
  <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['HistorysList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <?php echo $_smarty_tpl->tpl_vars['HistorysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['room_name'];?>

    </td>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['HistorysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['tenant_name'];?>

    </td>
    <td style="text-align:center" >
      <?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['HistorysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['from_date'],'format'=>'DateAsText'),$_smarty_tpl);?>

    </td>
    <td style="text-align:center" >
      <?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['HistorysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['to_date'],'format'=>'DateAsText'),$_smarty_tpl);?>

    </td>
    <td style="text-align:right" >
      &euro;&nbsp;<?php echo $_smarty_tpl->tpl_vars['HistorysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['weekly_rate'];?>

    </td>
    <td>
      <?php echo smConcatStr(array('str'=>$_smarty_tpl->tpl_vars['HistorysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['text'],'len'=>60),$_smarty_tpl);?>

    </td>
    <td style="text-align:center" >
      <?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['HistorysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['created_at'],'format'=>'AsText'),$_smarty_tpl);?>

    </td>
  </tr>
  <?php endfor; endif; ?>
</table>
<?php }} ?>
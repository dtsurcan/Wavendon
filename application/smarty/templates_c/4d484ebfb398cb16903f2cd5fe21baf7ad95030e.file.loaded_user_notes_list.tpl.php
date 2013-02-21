<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 04:02:43
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/loaded_user_notes_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:121380905850fe55b301a901-23973380%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d484ebfb398cb16903f2cd5fe21baf7ad95030e' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/loaded_user_notes_list.tpl',
      1 => 1358844082,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121380905850fe55b301a901-23973380',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'UserNotesList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe55b308fdb1_01358410',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe55b308fdb1_01358410')) {function content_50fe55b308fdb1_01358410($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['UserNotesList']->value)>0){?>
  <table style="border:1px dotted gray;">
    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['UserNotesList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <?php echo smConcatStr(array('str'=>$_smarty_tpl->tpl_vars['UserNotesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['notes'],'len'=>60),$_smarty_tpl);?>

      </td>

      <td>
        <a href="javascript:ShowUserNotes(<?php echo $_smarty_tpl->tpl_vars['UserNotesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
)" >View Full Notes</a>
      </td>
      <td>
        <?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['UserNotesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['created_at'],'format'=>'AsText'),$_smarty_tpl);?>

      </td>
      <td>
        <a style="cursor:pointer;" onclick="javascript:DeleteUserNotes(<?php echo $_smarty_tpl->tpl_vars['UserNotesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
,'<?php echo smShowshowTitleOfText(array('str'=>$_smarty_tpl->tpl_vars['UserNotesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['notes'],'maxlen'=>60,'is_replace_crlf'=>1),$_smarty_tpl);?>
')" >Delete</a>
      </td>
    </tr>
    <?php endfor; endif; ?>
  </table>
<?php }?><?php }} ?>
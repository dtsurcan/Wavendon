<?php /* Smarty version Smarty-3.1.12, created on 2013-01-13 06:12:57
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/loaded_user_notes_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197281555750f250691ec965-03092769%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec9f608c5a7c8217febd20de36452abd5ab20e57' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/loaded_user_notes_list.tpl',
      1 => 1357648250,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197281555750f250691ec965-03092769',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'UserNotesList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f25069278039_79126381',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f25069278039_79126381')) {function content_50f25069278039_79126381($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['UserNotesList']->value)>0){?>
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
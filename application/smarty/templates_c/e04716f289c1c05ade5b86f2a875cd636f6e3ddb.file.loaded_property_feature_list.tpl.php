<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 06:25:07
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/loaded_property_feature_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:168852045050fe77131d0535-91087860%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e04716f289c1c05ade5b86f2a875cd636f6e3ddb' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/loaded_property_feature_list.tpl',
      1 => 1358844081,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '168852045050fe77131d0535-91087860',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CkeckedFeaturesList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe7713218952_30115569',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe7713218952_30115569')) {function content_50fe7713218952_30115569($_smarty_tpl) {?><table style="border:1px dotted gray;">
  <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['CkeckedFeaturesList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <?php echo $_smarty_tpl->tpl_vars['CkeckedFeaturesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['value'];?>

    </td>
    <td>
     <input type="checkbox" value="1" id="cbx_property_feature_<?php echo $_smarty_tpl->tpl_vars['CkeckedFeaturesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
" name="cbx_property_feature_<?php echo $_smarty_tpl->tpl_vars['CkeckedFeaturesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
" <?php echo $_smarty_tpl->tpl_vars['CkeckedFeaturesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['checked'];?>
 >
    </td>
  </tr>
  <?php endfor; endif; ?>
</table><?php }} ?>
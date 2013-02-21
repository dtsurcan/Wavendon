<?php /* Smarty version Smarty-3.1.12, created on 2013-01-13 06:12:59
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/showimage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:66253680750f2506bb638b8-99505786%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd8ddf72df2e59e6dd5819e2f0ac7eebd0dee9a9' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/showimage.tpl',
      1 => 1357648804,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66253680750f2506bb638b8-99505786',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'image' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f2506bba55d8_60545693',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f2506bba55d8_60545693')) {function content_50f2506bba55d8_60545693($_smarty_tpl) {?><table align="center" valign="middle" width="100%" height="100%" style="border:0px">
  <tr>
    <td>
      <img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
 ">
    </td>
  </tr>
</table>
<?php }} ?>
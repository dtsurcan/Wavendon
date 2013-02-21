<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 04:02:33
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:122624136850fe55a9498da0-86223794%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '851a202bc514664c9cef1086932b937430520c96' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/index.tpl',
      1 => 1358844080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122624136850fe55a9498da0-86223794',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'PhpInfoHRef' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe55a94d9bc7_09994227',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe55a94d9bc7_09994227')) {function content_50fe55a94d9bc7_09994227($_smarty_tpl) {?><table border="0px dotted gray;">
  <tr>
    <td>
      <b>Administration Zone</b>
    </td>
  </tr>
  <tr>
    <td>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/index/page/1">Users</a>
    </td>
  </tr>

  <tr>
    <td>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/feature/index/page/1">Features</a>
    </td>
  </tr>

  <tr>
    <td>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/index/page/1">Properties</a>
    </td>
  </tr>

  <tr>
    <td>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/index/page/1">Blocks</a>
    </td>
  </tr>

  <tr>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['PhpInfoHRef']->value;?>

    </td>
  </tr>


</table><?php }} ?>
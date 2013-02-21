<?php /* Smarty version Smarty-3.1.12, created on 2013-01-13 06:13:32
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:71107195350f2508c2f0a53-43826682%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e068d23dee1698007db029e66b91adcf51eb2209' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/index.tpl',
      1 => 1357994016,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71107195350f2508c2f0a53-43826682',
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
  'unifunc' => 'content_50f2508c3406b6_51560446',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f2508c3406b6_51560446')) {function content_50f2508c3406b6_51560446($_smarty_tpl) {?><table border="0px dotted gray;">
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
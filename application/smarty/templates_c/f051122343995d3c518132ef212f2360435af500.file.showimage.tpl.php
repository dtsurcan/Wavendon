<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 04:02:53
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/showimage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:87182556050fe55bd20e644-51601132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f051122343995d3c518132ef212f2360435af500' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/showimage.tpl',
      1 => 1358844085,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '87182556050fe55bd20e644-51601132',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'image' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe55bd23fe24_57286897',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe55bd23fe24_57286897')) {function content_50fe55bd23fe24_57286897($_smarty_tpl) {?><table align="center" valign="middle" width="100%" height="100%" style="border:0px">
  <tr>
    <td>
      <img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
 ">
    </td>
  </tr>
</table>
<?php }} ?>
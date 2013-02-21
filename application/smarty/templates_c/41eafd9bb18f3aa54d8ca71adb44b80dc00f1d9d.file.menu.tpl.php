<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 04:01:49
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17432603250fe557d01fae5-20012532%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '41eafd9bb18f3aa54d8ca71adb44b80dc00f1d9d' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/menu.tpl',
      1 => 1358844083,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17432603250fe557d01fae5-20012532',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'admin_link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe557d069257_77488198',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe557d069257_77488198')) {function content_50fe557d069257_77488198($_smarty_tpl) {?>
        <div class="top_menu">
          <table style="border:0px dotted">
              <td>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/user/index/page/1"  class="<?php if ($_smarty_tpl->tpl_vars['admin_link']->value=='user'){?>current_admin_menu<?php }else{ ?>admin_menu<?php }?>"  >Peoples</a>
              </td>
              <td>
               <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/feature/index/page/1" class="<?php if ($_smarty_tpl->tpl_vars['admin_link']->value=='feature'){?>current_admin_menu<?php }else{ ?>admin_menu<?php }?>" >Features</a>
              </td>
              <td>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/index/page/1"  class="<?php if ($_smarty_tpl->tpl_vars['admin_link']->value=='property'||$_smarty_tpl->tpl_vars['admin_link']->value=='room'||$_smarty_tpl->tpl_vars['admin_link']->value=='tenant_edit'){?>current_admin_menu<?php }else{ ?>admin_menu<?php }?>"  >Properties</a>
              </td>
              <td>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/index/page/1"  class="<?php if ($_smarty_tpl->tpl_vars['admin_link']->value=='block'){?>current_admin_menu<?php }else{ ?>admin_menu<?php }?>"  >Blocks</a>
              </td>
            </tr>
          </table>
        </div>
<?php }} ?>
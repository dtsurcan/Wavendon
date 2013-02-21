<?php /* Smarty version Smarty-3.1.12, created on 2013-01-13 06:12:56
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173612068450f25068a85d23-90388745%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd019792e2e2e30c58471b3e3fc7d36d364691bc5' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/menu.tpl',
      1 => 1357387596,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173612068450f25068a85d23-90388745',
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
  'unifunc' => 'content_50f25068ad81a0_87540477',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f25068ad81a0_87540477')) {function content_50f25068ad81a0_87540477($_smarty_tpl) {?>
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
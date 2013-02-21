<?php /* Smarty version Smarty-3.1.12, created on 2013-01-13 06:12:56
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:81259571050f25068ce1455-96258253%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac8b998fe16a04d8666b3ca7be8136e2626baf3e' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/footer.tpl',
      1 => 1357995475,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81259571050f25068ce1455-96258253',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LoggedUserName' => 0,
    'DateFormat' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f25068d05d15_87817741',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f25068d05d15_87817741')) {function content_50f25068d05d15_87817741($_smarty_tpl) {?>     </div> <!-- end of div container -->

      <div id="footer">
        <div class="content">
          Copyright Wavendon 2012.&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['LoggedUserName']->value;?>
&nbsp;&nbsp;&nbsp;Today&nbsp;:&nbsp;<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['DateFormat']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo print_current_date(array('format'=>$_tmp1),$_smarty_tpl);?>

          <ul style="list-style-type:none; ">
            <li class="last" ><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/admin">Administrator zone</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/">Main</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/about">About</a></li>
            <li class="Support"><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/support">Support</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/contact_us">Contact Us</a></li>
            <li class="last"><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/sponsors">Sponsors</a></li>
          </ul>
        </div>
      </div>

  </body>
</html>
<?php }} ?>
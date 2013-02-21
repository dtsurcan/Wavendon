<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 04:01:49
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:64137589050fe557d087284-85539923%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf5ced4a68968de53cba216ced3b2984692a401c' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/footer.tpl',
      1 => 1358844079,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64137589050fe557d087284-85539923',
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
  'unifunc' => 'content_50fe557d0ae780_58560547',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe557d0ae780_58560547')) {function content_50fe557d0ae780_58560547($_smarty_tpl) {?>     </div> <!-- end of div container -->

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
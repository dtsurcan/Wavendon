<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 06:29:15
         compiled from "/home/wavendon/public_html/application/smarty/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:179525760550fe780b64c9b8-60793201%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0d6a5e6c80103f012bb12436e1160f861e09395' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/footer.tpl',
      1 => 1358844023,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '179525760550fe780b64c9b8-60793201',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'DateFormat' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe780b66a8d4_43691288',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe780b66a8d4_43691288')) {function content_50fe780b66a8d4_43691288($_smarty_tpl) {?>     </div> <!-- end of div container -->

      <div id="footer">
        <div class="content">
          Copyright Wavendon 2012.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Today&nbsp;:&nbsp;<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['DateFormat']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo print_current_date(array('format'=>$_tmp1),$_smarty_tpl);?>

          <ul style="list-style-type:none; ">
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
">Main</a></li>
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
</html><?php }} ?>
<?php /* Smarty version Smarty-3.1.12, created on 2013-02-20 15:11:48
         compiled from "/var/www/local.wavendon.com/application/smarty/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7278242115124d9a40ce040-16683869%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '890f05d0b2cded9a9e9c1d3d5bf8f66bf077ca37' => 
    array (
      0 => '/var/www/local.wavendon.com/application/smarty/templates/footer.tpl',
      1 => 1361367281,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7278242115124d9a40ce040-16683869',
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
  'unifunc' => 'content_5124d9a41066c1_86491020',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5124d9a41066c1_86491020')) {function content_5124d9a41066c1_86491020($_smarty_tpl) {?>     </div> <!-- end of div container -->

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
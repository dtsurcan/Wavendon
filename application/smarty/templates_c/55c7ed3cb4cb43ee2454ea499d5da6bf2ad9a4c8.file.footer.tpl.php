<?php /* Smarty version Smarty-3.1.12, created on 2013-01-18 05:09:29
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:201139741150f8d9098eb718-00302094%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55c7ed3cb4cb43ee2454ea499d5da6bf2ad9a4c8' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/footer.tpl',
      1 => 1357994977,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201139741150f8d9098eb718-00302094',
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
  'unifunc' => 'content_50f8d90992fce7_22539693',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f8d90992fce7_22539693')) {function content_50f8d90992fce7_22539693($_smarty_tpl) {?>     </div> <!-- end of div container -->

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
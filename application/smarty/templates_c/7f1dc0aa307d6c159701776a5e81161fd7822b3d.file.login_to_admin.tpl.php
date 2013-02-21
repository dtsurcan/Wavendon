<?php /* Smarty version Smarty-3.1.12, created on 2013-01-14 05:14:16
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/login_to_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:141797839850f39428ccf5e5-84471836%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f1dc0aa307d6c159701776a5e81161fd7822b3d' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/login_to_admin.tpl',
      1 => 1357994057,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141797839850f39428ccf5e5-84471836',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'validation_errors_text' => 0,
    'login_message' => 0,
    'base_url' => 0,
    'csrf_token_name_hidden' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f39428ec3962_82071537',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f39428ec3962_82071537')) {function content_50f39428ec3962_82071537($_smarty_tpl) {?><script type="text/javascript">

//  $.noConflict();
  jQuery(document).ready(function($) {
    document.getElementById("login").focus()
  });
</script>

<h3>Enter to system</h3>
<span class="error"><?php echo $_smarty_tpl->tpl_vars['validation_errors_text']->value;?>

  <?php echo $_smarty_tpl->tpl_vars['login_message']->value;?>

</span>

<form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/admin/login" method="post" accept-charset="utf-8" id="form_login" name="form_login" enctype="multipart/form-data">
<?php echo $_smarty_tpl->tpl_vars['csrf_token_name_hidden']->value;?>



<table border="0px dotted green;">

  <tr>
    <th>
      Login&nbsp;:
    </th>
    <td>
      <input type="text" id="login" name="login" value="" size="20" maxlength="50" >
    </td>
  </tr>

  <tr>
    <th>
      Password&nbsp;:
    </th>
    <td>
      <input type="password" id="password" name="password" value="" size="20" maxlength="50" >
    </td>
  </tr>

  <tr>
    <th>
      &nbsp;
    </th>
    <td>
      <input type="submit" id="btn_submit" name="btn_submit" value="Submit" >&nbsp;&nbsp;
      <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/admin/admin/login'">
    </td>
  </tr>

</table>
</form><?php }} ?>
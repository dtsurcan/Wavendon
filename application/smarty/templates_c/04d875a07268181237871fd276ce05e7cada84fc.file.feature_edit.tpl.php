<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 06:20:00
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/feature_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162755864350fe75e0eeac49-11286577%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04d875a07268181237871fd276ce05e7cada84fc' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/feature_edit.tpl',
      1 => 1358844079,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162755864350fe75e0eeac49-11286577',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'id' => 0,
    'PageParametersWithSort' => 0,
    'csrf_token_name_hidden' => 0,
    'Feature' => 0,
    'validation_errors_text' => 0,
    'editor_message' => 0,
    'FeatureTypeValueArray' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe75e107f277_45221967',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe75e107f277_45221967')) {function content_50fe75e107f277_45221967($_smarty_tpl) {?><script type="text/javascript">

  //  $.noConflict();
  jQuery(document).ready(function($) {
    document.getElementById("name").focus()
  });

  function onSubmit(IsReopen) {
    var theForm = document.getElementById("form_feature_edit");
    document.getElementById("is_reopen").value = IsReopen
    theForm.submit();
  }
</script>


<form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/feature/edit/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
" method="post" accept-charset="utf-8" id="form_feature_edit" name="form_feature_edit" enctype="multipart/form-data">
<?php echo $_smarty_tpl->tpl_vars['csrf_token_name_hidden']->value;?>

<input type="hidden" id="is_reopen" name="is_reopen" value="">

<h3><?php if ($_smarty_tpl->tpl_vars['Feature']->value==''){?> New<?php }else{ ?>Edit<?php }?>&nbsp;Feature</h3>
<span class="error"><?php echo $_smarty_tpl->tpl_vars['validation_errors_text']->value;?>
</span>
<span class="flash_message">
  <?php echo $_smarty_tpl->tpl_vars['editor_message']->value;?>

</span>

<table style="border:1px dotted gray;" >
<?php if (($_smarty_tpl->tpl_vars['Feature']->value['id']!=''&&$_smarty_tpl->tpl_vars['Feature']->value['id']!="0")){?>
  <tr>
    <th>
      Id&nbsp;:
    </th>
    <td>
      <input type="text" id="id" name="id" value="<?php if ($_smarty_tpl->tpl_vars['Feature']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['Feature']->value['id'];?>
<?php }?>" size="8" readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>
<?php }?>

  <tr>
    <th>
      Name&nbsp;:
    </th>
    <td>
      <input type="text" id="name" name="name" value="<?php if ($_smarty_tpl->tpl_vars['Feature']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['Feature']->value['name'];?>
<?php }?>" size="50" maxlength="50" >
    </td>
  </tr>

  <tr>
    <th>
      Type&nbsp;:
    </th>
    <td>
      <select name="type" id="type" >
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['FeatureTypeValueArray']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['row']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['row']['total']);
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['FeatureTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
" <?php if ($_smarty_tpl->tpl_vars['Feature']->value['type']==$_smarty_tpl->tpl_vars['FeatureTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key']){?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['FeatureTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['value'];?>
</option>
        <?php endfor; endif; ?>
      </select>
    </td>
  </tr>

<?php if ($_smarty_tpl->tpl_vars['Feature']->value['created_at']!=''){?>
  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="<?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['Feature']->value['created_at'],'format'=>'AsText'),$_smarty_tpl);?>
" size="30" readonly style="border:1px dotted gray;text-align:left;" >
    </td>
  </tr>
<?php }?>


  <tr>
    <th>
      &nbsp;
    </th>
    <td>
      &nbsp;
    </td>
  </tr>

  <tr>
    <th>
      &nbsp;
    </th>
    <td>
      <input type="button" id="btn_submit_reopen" name="btn_submit_reopen" onclick="javascript:onSubmit(1);" value="<?php if ($_smarty_tpl->tpl_vars['Feature']->value==''){?>Add & Reopen<?php }else{ ?>Update & Reopen<?php }?>" >&nbsp;&nbsp;
      <input type="button" id="btn_submit_list" name="btn_submit_list" onclick="javascript:onSubmit(0);" value="<?php if ($_smarty_tpl->tpl_vars['Feature']->value==''){?>Add & List<?php }else{ ?>Update & List<?php }?>" >&nbsp;&nbsp;
      <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/feature/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
'">
    </td>
  </tr>

</table>
</form><?php }} ?>
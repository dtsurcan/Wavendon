<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 06:28:25
         compiled from "/home/wavendon/public_html/application/smarty/templates/admin/block_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169406066450fe77d9a074b6-93661588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e6354252c51f4470073987ab2e2fa145187c906' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/admin/block_list.tpl',
      1 => 1358844078,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169406066450fe77d9a074b6-93661588',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'editor_message' => 0,
    'PageParametersWithSort' => 0,
    'csrf_token_name_hidden' => 0,
    'page' => 0,
    'sorting' => 0,
    'sort' => 0,
    'filter_name' => 0,
    'BlocksList' => 0,
    'RowsInTable' => 0,
    'PageParametersWithoutSort' => 0,
    'images_dir_full_url' => 0,
    'pagination_links' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe77d9b3e795_90782037',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe77d9b3e795_90782037')) {function content_50fe77d9b3e795_90782037($_smarty_tpl) {?>
<script type="text/javascript" language="JavaScript">
  <!--
  //jQuery.noConflict();
  function DeleteBlock(id, name) {
    if (!confirm("Do you want to delete '"+name+"' block ?")) return;
    document.location= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/delete/" + id
  }
  //-->
</script>


<h3>Blocks List</h3>
<span class="flash_message">
  <?php echo $_smarty_tpl->tpl_vars['editor_message']->value;?>

</span>

<form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/index/page/1<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
" method="post" accept-charset="utf-8" id="form_blocks" name="form_blocks" enctype="multipart/form-data">
<?php echo $_smarty_tpl->tpl_vars['csrf_token_name_hidden']->value;?>



<input type="hidden" id="page" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" >
<input type="hidden" id="sorting" name="sorting" value="<?php echo $_smarty_tpl->tpl_vars['sorting']->value;?>
" >
<input type="hidden" id="sort" name="sort" value="<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
" >

<table style="border:1px dotted gray;" >
  <tr>
    <td>
      <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['filter_name']->value;?>
" size="20" maxlength="50" name="filter_name" id="filter_name" >&nbsp;
    </td>
    <td>
      <input type="submit" value="Filter">
    </td>
  </tr>


</table>


<?php if ((count($_smarty_tpl->tpl_vars['BlocksList']->value)==0)){?>
  <div>No Data Found</div>
  <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/edit/0<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
">New Block</a>
<?php }?>

  <?php echo count($_smarty_tpl->tpl_vars['BlocksList']->value);?>
&nbsp;Row<?php if (count($_smarty_tpl->tpl_vars['BlocksList']->value)>0){?>s<?php }?>&nbsp;of&nbsp;<?php echo $_smarty_tpl->tpl_vars['RowsInTable']->value;?>
&nbsp;(&nbsp;Page # <b><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</b>&nbsp;)
<table style="border:1px dotted gray;" >

  <tr>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/name<?php echo smShowSortingDirectory(array('fieldname'=>"name",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Name&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"name",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th>
      Description
      </a>
    </th>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/created_at<?php echo smShowSortingDirectory(array('fieldname'=>"created_at",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Created At&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"created_at",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th colspan="2">&nbsp;</th>
  </tr>

  <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['BlocksList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <tr>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['BlocksList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['name'];?>

      <?php if ($_smarty_tpl->tpl_vars['BlocksList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['property_block_count']>0){?>
        &nbsp;&nbsp;&nbsp;&nbsp;<small>( <b><?php echo $_smarty_tpl->tpl_vars['BlocksList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['property_block_count'];?>
</b> Related Propert<?php if (count($_smarty_tpl->tpl_vars['BlocksList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['property_block_count'])>1){?>ies<?php }else{ ?>y<?php }?>&nbsp;)</small>
      <?php }?>
    </td>
    <td>
      <?php echo smConcatStr(array('str'=>$_smarty_tpl->tpl_vars['BlocksList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['description'],'len'=>60),$_smarty_tpl);?>

    </td>
    <td>
      <?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['BlocksList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['created_at'],'format'=>'AsText'),$_smarty_tpl);?>

    </td>
    <td>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/edit/<?php echo $_smarty_tpl->tpl_vars['BlocksList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
">Edit</a>
    </td>
    <td>
      <a href="javascript:DeleteBlock('<?php echo $_smarty_tpl->tpl_vars['BlocksList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['BlocksList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['name'];?>
' )" >Delete</a>
    </td>
  </tr>
  <?php endfor; endif; ?>
</table>
<?php echo $_smarty_tpl->tpl_vars['pagination_links']->value;?>

<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/block/edit/0<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
">New Block</a>

</form>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 06:29:15
         compiled from "/home/wavendon/public_html/application/smarty/templates/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187807498850fe780b47f929-36678412%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df7a7fbf53f52be3e275516c79503ed3f427c52a' => 
    array (
      0 => '/home/wavendon/public_html/application/smarty/templates/main.tpl',
      1 => 1358844024,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187807498850fe780b47f929-36678412',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'sorting' => 0,
    'sort' => 0,
    'PropertyLandlordValueArray' => 0,
    'filter_landlord_id' => 0,
    'PropertyTypeValueArray' => 0,
    'filter_type' => 0,
    'filter_address' => 0,
    'PropertysList' => 0,
    'RowsInTable' => 0,
    'base_url' => 0,
    'PageParametersWithoutSort' => 0,
    'images_dir_full_url' => 0,
    'ControllerRef' => 0,
    'PageParametersWithSort' => 0,
    'pagination_links' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe780b641222_14235153',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe780b641222_14235153')) {function content_50fe780b641222_14235153($_smarty_tpl) {?>
<h3>Properties List</h3>


<input type="hidden" id="page" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" >
<input type="hidden" id="sorting" name="sorting" value="<?php echo $_smarty_tpl->tpl_vars['sorting']->value;?>
" >
<input type="hidden" id="sort" name="sort" value="<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
" >
<!--
<table style="border:1px dotted gray;">
  <tr>
    <td>
      Landlord&nbsp;:
    </td>
    <td>
      <select name="filter_landlord_id" id="filter_landlord_id" >
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['PropertyLandlordValueArray']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <option value="<?php echo $_smarty_tpl->tpl_vars['PropertyLandlordValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
"<?php if ($_smarty_tpl->tpl_vars['filter_landlord_id']->value==$_smarty_tpl->tpl_vars['PropertyLandlordValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key']){?> selected <?php }?> > <?php echo $_smarty_tpl->tpl_vars['PropertyLandlordValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['value'];?>
 </option>
        <?php endfor; endif; ?>
      </select>
    </td>

    <td>
      Type&nbsp;:
    </td>
    <td>
      <select name="filter_type" id="filter_type" >
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['PropertyTypeValueArray']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <option value="<?php echo $_smarty_tpl->tpl_vars['PropertyTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key'];?>
" <?php if ($_smarty_tpl->tpl_vars['filter_type']->value==$_smarty_tpl->tpl_vars['PropertyTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['key']){?>selected <?php }?>  ><?php echo $_smarty_tpl->tpl_vars['PropertyTypeValueArray']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['value'];?>
</option>
        <?php endfor; endif; ?>
      </select>
    </td>
  </tr>

  <tr>
    <td>
      Address&nbsp;:
    </td>
    <td>
      <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['filter_address']->value;?>
" size="20" maxlength="50" name="filter_address" id="filter_address" >
    </td>

    <td>
      &nbsp;
    </td>
    <td>
      <input type="submit" value="Filter">
    </td>
  </tr>

</table>
-->

<?php if (count($_smarty_tpl->tpl_vars['PropertysList']->value)==0){?>
  <div>No Data Found</div>
<?php }?>

<?php echo count($_smarty_tpl->tpl_vars['PropertysList']->value);?>
&nbsp;Row<?php if (count($_smarty_tpl->tpl_vars['PropertysList']->value)>0){?>s<?php }?>&nbsp;of&nbsp;<?php echo $_smarty_tpl->tpl_vars['RowsInTable']->value;?>
&nbsp;(&nbsp;Page # <b><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</b>&nbsp;)
<table style="border:1px dotted gray;" >

  <tr>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/user.username<?php echo smShowSortingDirectory(array('fieldname'=>"user.username",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Landlord&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"user.username",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/address<?php echo smShowSortingDirectory(array('fieldname'=>"address",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Address&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"address",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/property.type<?php echo smShowSortingDirectory(array('fieldname'=>"property.type",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Type&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"property.type",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/block.name<?php echo smShowSortingDirectory(array('fieldname'=>"block.name",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Block&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"block.name",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/rooms_number<?php echo smShowSortingDirectory(array('fieldname'=>"rooms_number",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Rooms Number&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"rooms_number",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th>
      Rooms Vacant
    </th>

    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/tenants_currently_in<?php echo smShowSortingDirectory(array('fieldname'=>"tenants_currently_in",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Tenants Currently In&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"tenants_currently_in",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>

    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/property.created_at<?php echo smShowSortingDirectory(array('fieldname'=>"property.created_at",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Created At&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"property.created_at",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th colspan="1">&nbsp;</th>
  </tr>


  <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['row'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['row']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['name'] = 'row';
$_smarty_tpl->tpl_vars['smarty']->value['section']['row']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['PropertysList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['username'];?>

    </td>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['address'];?>

    </td>
    <td>
      <?php echo smShowPropertyTypeTitle(array('type'=>$_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['type'],'ControllerRef'=>$_smarty_tpl->tpl_vars['ControllerRef']->value),$_smarty_tpl);?>

    </td>
    <td>
      <?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['block_name'];?>

    </td>
    <td style="text-align:right" >
      <?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['rooms_number'];?>

    </td>
    <td style="text-align:left">
      <?php echo smConcatStr(array('str'=>$_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['rooms_vacant'],'len'=>60),$_smarty_tpl);?>

    </td>
    <td style="text-align:right">
      <?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['tenants_currently_in'];?>

    </td>
    <td style="text-align:center">
      <?php echo smShowFormattedDatetime(array('datetime_label'=>$_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['created_at'],'format'=>'AsText'),$_smarty_tpl);?>

    </td>
    <td>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
main/details/<?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
">Details...</a>
    </td>
  </tr>
  <?php endfor; endif; ?>
</table>
<?php echo $_smarty_tpl->tpl_vars['pagination_links']->value;?>


<?php }} ?>
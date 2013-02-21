<?php /* Smarty version Smarty-3.1.12, created on 2013-01-14 10:58:53
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/property_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:102223742950f26b499c1ea8-31038742%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72dae4ab5d47c350e1e1a66fd21fba456466eb58' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/property_list.tpl',
      1 => 1358161133,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102223742950f26b499c1ea8-31038742',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f26b49c0a918_21961596',
  'variables' => 
  array (
    'base_url' => 0,
    'editor_message' => 0,
    'csrf_token_name_hidden' => 0,
    'page' => 0,
    'sorting' => 0,
    'sort' => 0,
    'is_selection' => 0,
    'is_onlyunusedinblocks' => 0,
    'PropertyLandlordValueArray' => 0,
    'filter_landlord_id' => 0,
    'PropertyTypeValueArray' => 0,
    'filter_type' => 0,
    'filter_address' => 0,
    'PropertysList' => 0,
    'PageParametersWithSort' => 0,
    'RowsInTable' => 0,
    'PageParametersWithoutSort' => 0,
    'images_dir_full_url' => 0,
    'ControllerRef' => 0,
    'pagination_links' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f26b49c0a918_21961596')) {function content_50f26b49c0a918_21961596($_smarty_tpl) {?><script type="text/javascript" language="JavaScript">
  <!--

  var SelectedID= -1;

  jQuery.noConflict();
  function DeleteProperty(id , LandlordName, Address) {
    if (!confirm("Do you want to delete this property of '"+LandlordName+"' on '"+Address+"' with all related data?")) return;
    document.location= "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/delete/" + id
  }

  function SelectProperty() {
    // alert("SelectProperty()::")
    if ( SelectedID == -1 ) {
      alert("Select Property!")
      return;
    }
    window.close();
    opener.FillProperty( SelectedID, SelectedNAME );
    return;
  }

  /* function doCancel() {
    window.close();
  } */

  function SelectionClicked(ObjId, ObjName) {
    var theForm = document.getElementById("form_propertys");
    for (i=0; i< theForm.elements.length; i++) {
      var ElemId= theForm.elements[i].id
      K= ElemId.indexOf('cbx_select_');
      if ( K> -1 && ( 'cbx_select_'+ObjId ) != ElemId  ) {
        theForm.elements[i].checked= false
      }
    }

    if ( document.getElementById('cbx_select_'+ObjId) ) {
      if ( document.getElementById('cbx_select_'+ObjId).checked ) {
        SelectedID= ObjId
        SelectedNAME= ObjName
        //alert( "++ SelectedID::"+SelectedID + "  SelectedNAME::"+SelectedNAME )
      } else {
        SelectedID= -1
        SelectedNAME= ''
        //alert( " -- SelectedID::"+SelectedID + "  SelectedNAME::"+SelectedNAME )
      }
    }
  }

  //-->
</script>


<h3>Properties List</h3>
<span class="flash_message">
  <?php echo $_smarty_tpl->tpl_vars['editor_message']->value;?>

</span>


<form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/index/page/1" method="post" accept-charset="utf-8" id="form_propertys" name="form_propertys" enctype="multipart/form-data">
<?php echo $_smarty_tpl->tpl_vars['csrf_token_name_hidden']->value;?>


<input type="hidden" id="page" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" >
<input type="hidden" id="sorting" name="sorting" value="<?php echo $_smarty_tpl->tpl_vars['sorting']->value;?>
" >
<input type="hidden" id="sort" name="sort" value="<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
" >
<input type="hidden" id="is_selection" name="is_selection" value="<?php echo $_smarty_tpl->tpl_vars['is_selection']->value;?>
" >
<input type="hidden" id="is_onlyunusedinblocks" name="is_onlyunusedinblocks" value="<?php echo $_smarty_tpl->tpl_vars['is_onlyunusedinblocks']->value;?>
" >

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


<?php if (count($_smarty_tpl->tpl_vars['PropertysList']->value)==0){?>
  <div>No Data Found</div>
  <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/edit/0<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
">New Property</a>
<?php }?>

<?php echo count($_smarty_tpl->tpl_vars['PropertysList']->value);?>
&nbsp;Row<?php if (count($_smarty_tpl->tpl_vars['PropertysList']->value)>0){?>s<?php }?>&nbsp;of&nbsp;<?php echo $_smarty_tpl->tpl_vars['RowsInTable']->value;?>
&nbsp;(&nbsp;Page # <b><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</b>&nbsp;)
<table style="border:1px dotted gray;" >

  <tr>
    <?php if ($_smarty_tpl->tpl_vars['is_selection']->value==1){?>
    <th>
      &nbsp;
    </th>
    <?php }?>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/user.username<?php echo smShowSortingDirectory(array('fieldname'=>"user.username",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Landlord&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"user.username",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/address<?php echo smShowSortingDirectory(array('fieldname'=>"address",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Address&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"address",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/property.type<?php echo smShowSortingDirectory(array('fieldname'=>"property.type",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Type&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"property.type",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/block.name<?php echo smShowSortingDirectory(array('fieldname'=>"block.name",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Block&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"block.name",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
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
admin/property/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/tenants_currently_in<?php echo smShowSortingDirectory(array('fieldname'=>"tenants_currently_in",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Tenants Currently In&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"tenants_currently_in",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>

    <th>
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/index<?php echo $_smarty_tpl->tpl_vars['PageParametersWithoutSort']->value;?>
/sorting/property.created_at<?php echo smShowSortingDirectory(array('fieldname'=>"property.created_at",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>
" >Created At&nbsp;
        <?php echo smShowListSortingImage(array('fieldname'=>"property.created_at",'sorting'=>$_smarty_tpl->tpl_vars['sorting']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value,'images_dir_full_url'=>$_smarty_tpl->tpl_vars['images_dir_full_url']->value),$_smarty_tpl);?>

      </a>
    </th>
    <th colspan="2">&nbsp;</th>
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
    <?php if ($_smarty_tpl->tpl_vars['is_selection']->value==1){?>
    <td>
      &nbsp;<input type="checkbox" id="cbx_select_<?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
" onclick="SelectionClicked(<?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
, '<?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['address'];?>
' ) ">
    </td>
    <?php }?>
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
admin/property/edit/<?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
">Edit</a>
    </td>
    <td>
      <a href="javascript:DeleteProperty('<?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['id'];?>
<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['username'];?>
', '<?php echo $_smarty_tpl->tpl_vars['PropertysList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['row']['index']]['address'];?>
' )" >Delete</a>
    </td>
  </tr>
  <?php endfor; endif; ?>
</table>
    <?php if ($_smarty_tpl->tpl_vars['is_selection']->value==1){?>
      <input type="button" value="Select" onclick="javascript:SelectProperty()" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" value="Cancel" onclick="javascript:window.close(); " >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php }?>

<?php echo $_smarty_tpl->tpl_vars['pagination_links']->value;?>

<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
admin/property/edit/0<?php echo $_smarty_tpl->tpl_vars['PageParametersWithSort']->value;?>
">New Property</a>

</form><?php }} ?>
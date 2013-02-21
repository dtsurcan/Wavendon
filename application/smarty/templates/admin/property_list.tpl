<script type="text/javascript" language="JavaScript">
  <!--

  var SelectedID= -1;

  jQuery.noConflict();
  function DeleteProperty(id , LandlordName, Address) {
    if (!confirm("Do you want to delete this property of '"+LandlordName+"' on '"+Address+"' with all related data?")) return;
    document.location= "{$base_url}admin/property/delete/" + id
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
  {$editor_message}
</span>


<form action="{$base_url}admin/property/index/page/1" method="post" accept-charset="utf-8" id="form_propertys" name="form_propertys" enctype="multipart/form-data">
{$csrf_token_name_hidden}

<input type="hidden" id="page" name="page" value="{$page}" >
<input type="hidden" id="sorting" name="sorting" value="{$sorting}" >
<input type="hidden" id="sort" name="sort" value="{$sort}" >
<input type="hidden" id="is_selection" name="is_selection" value="{$is_selection}" >
<input type="hidden" id="is_onlyunusedinblocks" name="is_onlyunusedinblocks" value="{$is_onlyunusedinblocks}" >

<table style="border:1px dotted gray;">
  <tr>
    <td>
      Landlord&nbsp;:
    </td>
    <td>
      <select name="filter_landlord_id" id="filter_landlord_id" >
        {section name=row loop=$PropertyLandlordValueArray}
        <option value="{$PropertyLandlordValueArray[row].key}"{if $filter_landlord_id eq $PropertyLandlordValueArray[row].key} selected {/if} > {$PropertyLandlordValueArray[row].value} </option>
        {/section}
      </select>
    </td>

    <td>
      Type&nbsp;:
    </td>
    <td>
      <select name="filter_type" id="filter_type" >
        {section name=row loop=$PropertyTypeValueArray}
        <option value="{$PropertyTypeValueArray[row].key}" {if $filter_type eq $PropertyTypeValueArray[row].key}selected {/if}  >{$PropertyTypeValueArray[row].value}</option>
        {/section}
      </select>
    </td>
  </tr>

  <tr>
    <td>
      Address&nbsp;:
    </td>
    <td>
      <input type="text" value="{$filter_address}" size="20" maxlength="50" name="filter_address" id="filter_address" >
    </td>

    <td>
      &nbsp;
    </td>
    <td>
      <input type="submit" value="Filter">
    </td>
  </tr>


</table>


{if count($PropertysList) eq 0 }
  <div>No Data Found</div>
  <a href="{$base_url}admin/property/edit/0{$PageParametersWithSort}">New Property</a>
{/if}

{$PropertysList|count}&nbsp;Row{if count($PropertysList) gt 0}s{/if}&nbsp;of&nbsp;{$RowsInTable}&nbsp;(&nbsp;Page # <b>{$page}</b>&nbsp;)
<table style="border:1px dotted gray;" >

  <tr>
    {if $is_selection eq 1}
    <th>
      &nbsp;
    </th>
    {/if}
    <th>
      <a href="{$base_url}admin/property/index{$PageParametersWithoutSort}/sorting/user.username{show_sorting_directory fieldname="user.username" sorting=$sorting sort=$sort}" >Landlord&nbsp;
        {show_list_sorting_image fieldname="user.username" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}admin/property/index{$PageParametersWithoutSort}/sorting/address{show_sorting_directory fieldname="address" sorting=$sorting sort=$sort}" >Address&nbsp;
        {show_list_sorting_image fieldname="address" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}admin/property/index{$PageParametersWithoutSort}/sorting/property.type{show_sorting_directory fieldname="property.type" sorting=$sorting sort=$sort}" >Type&nbsp;
        {show_list_sorting_image fieldname="property.type" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}admin/property/index{$PageParametersWithoutSort}/sorting/block.name{show_sorting_directory fieldname="block.name" sorting=$sorting sort=$sort}" >Block&nbsp;
        {show_list_sorting_image fieldname="block.name" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}admin/property/index{$PageParametersWithoutSort}/sorting/rooms_number{show_sorting_directory fieldname="rooms_number" sorting=$sorting sort=$sort}" >Rooms Number&nbsp;
        {show_list_sorting_image fieldname="rooms_number" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      Rooms Vacant
    </th>

    <th>
      <a href="{$base_url}admin/property/index{$PageParametersWithoutSort}/sorting/tenants_currently_in{show_sorting_directory fieldname="tenants_currently_in" sorting=$sorting sort=$sort}" >Tenants Currently In&nbsp;
        {show_list_sorting_image fieldname="tenants_currently_in" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>

    <th>
      <a href="{$base_url}admin/property/index{$PageParametersWithoutSort}/sorting/property.created_at{show_sorting_directory fieldname="property.created_at" sorting=$sorting sort=$sort}" >Created At&nbsp;
        {show_list_sorting_image fieldname="property.created_at" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th colspan="2">&nbsp;</th>
  </tr>


  {section name=row loop=$PropertysList}
  <tr>
    {if $is_selection eq 1}
    <td>
      &nbsp;<input type="checkbox" id="cbx_select_{$PropertysList[row].id}" onclick="SelectionClicked({$PropertysList[row].id}, '{$PropertysList[row].address}' ) ">
    </td>
    {/if}
    <td>
      {$PropertysList[row].username}
    </td>
    <td>
      {$PropertysList[row].address}
    </td>
    <td>
      {show_property_type_title type=$PropertysList[row].type ControllerRef= $ControllerRef}
    </td>
    <td>
      {$PropertysList[row].block_name}
    </td>
    <td style="text-align:right" >
      {$PropertysList[row].rooms_number}
    </td>
    <td style="text-align:left">
      {concat_str str=$PropertysList[row].rooms_vacant len=60}
    </td>
    <td style="text-align:right">
      {$PropertysList[row].tenants_currently_in}
    </td>
    <td style="text-align:center">
      {show_formatted_datetime datetime_label=$PropertysList[row].created_at format= 'AsText'}
    </td>
    <td>
      <a href="{$base_url}admin/property/edit/{$PropertysList[row].id}{$PageParametersWithSort}">Edit</a>
    </td>
    <td>
      <a href="javascript:DeleteProperty('{$PropertysList[row].id}{$PageParametersWithSort}', '{$PropertysList[row].username}', '{$PropertysList[row].address}' )" >Delete</a>
    </td>
  </tr>
  {/section}
</table>
    {if $is_selection eq 1}
      <input type="button" value="Select" onclick="javascript:SelectProperty()" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" value="Cancel" onclick="javascript:window.close(); " >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    {/if}

{$pagination_links}
<a href="{$base_url}admin/property/edit/0{$PageParametersWithSort}">New Property</a>

</form>
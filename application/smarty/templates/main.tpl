
<h3>Properties List</h3>


<input type="hidden" id="page" name="page" value="{$page}" >
<input type="hidden" id="sorting" name="sorting" value="{$sorting}" >
<input type="hidden" id="sort" name="sort" value="{$sort}" >
<!--
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
-->

{if count($PropertysList) eq 0 }
  <div>No Data Found</div>
{/if}

{$PropertysList|count}&nbsp;Row{if count($PropertysList) gt 0}s{/if}&nbsp;of&nbsp;{$RowsInTable}&nbsp;(&nbsp;Page # <b>{$page}</b>&nbsp;)
<table style="border:1px dotted gray;" >

  <tr>
    <th>
      <a href="{$base_url}main/index{$PageParametersWithoutSort}/sorting/user.username{show_sorting_directory fieldname="user.username" sorting=$sorting sort=$sort}" >Landlord&nbsp;
        {show_list_sorting_image fieldname="user.username" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}main/index{$PageParametersWithoutSort}/sorting/address{show_sorting_directory fieldname="address" sorting=$sorting sort=$sort}" >Address&nbsp;
        {show_list_sorting_image fieldname="address" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}main/index{$PageParametersWithoutSort}/sorting/property.type{show_sorting_directory fieldname="property.type" sorting=$sorting sort=$sort}" >Type&nbsp;
        {show_list_sorting_image fieldname="property.type" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}main/index{$PageParametersWithoutSort}/sorting/block.name{show_sorting_directory fieldname="block.name" sorting=$sorting sort=$sort}" >Block&nbsp;
        {show_list_sorting_image fieldname="block.name" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}main/index{$PageParametersWithoutSort}/sorting/rooms_number{show_sorting_directory fieldname="rooms_number" sorting=$sorting sort=$sort}" >Rooms Number&nbsp;
        {show_list_sorting_image fieldname="rooms_number" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      Rooms Vacant
    </th>

    <th>
      <a href="{$base_url}main/index{$PageParametersWithoutSort}/sorting/tenants_currently_in{show_sorting_directory fieldname="tenants_currently_in" sorting=$sorting sort=$sort}" >Tenants Currently In&nbsp;
        {show_list_sorting_image fieldname="tenants_currently_in" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>

    <th>
      <a href="{$base_url}main/index{$PageParametersWithoutSort}/sorting/property.created_at{show_sorting_directory fieldname="property.created_at" sorting=$sorting sort=$sort}" >Created At&nbsp;
        {show_list_sorting_image fieldname="property.created_at" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th colspan="1">&nbsp;</th>
  </tr>


  {section name=row loop=$PropertysList}
  <tr>
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
      <a href="{$base_url}main/details/{$PropertysList[row].id}{$PageParametersWithSort}">Details...</a>
    </td>
  </tr>
  {/section}
</table>
{$pagination_links}


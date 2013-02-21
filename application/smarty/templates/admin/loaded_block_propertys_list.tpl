<table style="border:1px dotted gray;">
  {section name=row loop=$PropertysList}
  <tr>
    <td>
      <a href="{$base_url}admin/property/edit/{$PropertysList[row].id}">{$PropertysList[row].address}</a>
    </td>
    <td>
      <a style="cursor:pointer;" onclick="javascript:DeleteBlockProperty({$PropertysList[row].id}, '{$PropertysList[row].address}') "   >Clear</a>
    </td>
  </tr>
  {/section}


  <tr id="tr_add_new_block_property">
    <td>
      &nbsp;
    </td>
    <td>
      <a href="javascript:AddNewPropertyToBlock()">Add New Property to this Block</a>
    </td>
  </tr>

  <tr id="tr_enter_value_block_property" style="display:none">
    <td>
      &nbsp;Select New Property
    </td>
    <td>
      <select name="select_new_block_property" id="select_new_block_property" >
        {section name=row loop=$CommonPropertysList}
          <option value="{$CommonPropertysList[row].id}" > {$CommonPropertysList[row].address}</option>
        {/section}
      </select>&nbsp;<!-- <input type="button" value="..." onclick="javascript:OpenPropertysSelection('select_new_block_property')"><br>  -->
      <a href="javascript:SaveNewBlockProperty()">Save</a>&nbsp;
      <a href="javascript:CancelNewTenantGuarantor()">Cancel</a>

    </td>
  </tr>

</table>
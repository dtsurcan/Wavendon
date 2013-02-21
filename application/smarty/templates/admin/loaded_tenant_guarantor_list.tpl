
<table style="border:1px dotted gray;">
  {section name=row loop=$TenantGuarantorsList}
  <tr>
    <td>
      <a href="{$base_url}admin/user/edit/{$TenantGuarantorsList[row].guarantor_id}">{$TenantGuarantorsList[row].username}</a>
    </td>
    <td>
      <a style="cursor:pointer;" onclick="javascript:DeleteTenantGuarantor({$TenantGuarantorsList[row].id}, '{$TenantGuarantorsList[row].username}' )" >Delete</a>
    </td>
  </tr>
  {/section}


  <tr id="tr_add_new_tenant_guarantor">
    <td>
      &nbsp;
    </td>
    <td>
      <a href="javascript:AddNewTenantGuarantor()">Add New</a>
    </td>
  </tr>

  <tr id="tr_enter_value_tenant_guarantor" style="display:none">
    <td>
      &nbsp;Select New Guarantor
    </td>
    <td>
      <select name="select_new_tenant_guarantor" id="select_new_tenant_guarantor" >
        {section name=row loop=$GuarantorsList}
          <option value="{$GuarantorsList[row].key}" > {$GuarantorsList[row].value}</option>
        {/section}
      </select><br>

      <a href="javascript:SaveNewTenantGuarantor()">Save</a>&nbsp;
      <a href="javascript:CancelNewTenantGuarantor()">Cancel</a>
    </td>
  </tr>



</table>
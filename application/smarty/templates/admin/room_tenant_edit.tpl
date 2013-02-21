<script type="text/javascript" src="{$base_root_url}{$js_dir}jquery/ui.datepicker.js"></script>

<script type="text/javascript">

  jQuery(document).ready(function($) {
    jQuery( "#from_date" ).datepicker({ // http://docs.jquery.com/UI/API/1.8/Datepicker#options
      dateFormat: '{$DatePickerSelectionFormat}',
      minDate:    new Date(2012, 1, 1),
      maxDate:    new Date(2028, 12, 31)
    });  // $( ".selector" ).datepicker( "option", "changeMonth", true );
    $( "#from_date" ).datepicker( "option", "changeMonth", true );
    $( "#from_date" ).datepicker( "option", "changeYear", true );
    $( "#from_date" ).datepicker( "option", "closeText", "Close" );
    $( "#from_date" ).datepicker( "option", "constrainInput", true );


//alert("AFTER")

  });


  function onSubmit(IsReopen) {
    var theForm = document.getElementById("form_room_tenant_edit");
    document.getElementById("is_reopen").value = IsReopen
    theForm.submit();
  }



</script>

<form action="{$base_url}admin/room/room_tenant_edit/{$id}/property_id/{$property_id}/room_id/{$room_id}{$PageParametersWithSort}" method="post" accept-charset="utf-8" id="form_room_tenant_edit" name="form_room_tenant_edit" enctype="multipart/form-data">
{$csrf_token_name_hidden}
<input type="hidden" id="is_reopen" name="is_reopen" value="">


<h3>{if $RoomTenant neq ""}Edit{else}New{/if}&nbsp;RoomTenant</h3>
<span class="error">{$validation_errors_text}</span>
<span class="flash_message">
  {$editor_message}
</span>

<table style="border:1px dotted gray;" >
{if $RoomTenant neq "" and $IsInsert neq 1 }
  <tr>
    <th>
      Id&nbsp;:
    </th>
    <td>
      <input type="text" id="id" name="id" value="{$RoomTenant.id}" size="8" readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>
{/if}

  <tr>
    <th>
      From Date&nbsp;:
    </th>
    <td>
      <input type="text" id="from_date" name="from_date" value="{$RoomTenant.from_date}" size="10" maxlength="10"
        readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>


  <tr>
    <th>
      Tenant&nbsp;:
    </th>
    <td>
      <select name="tenant_id" id="tenant_id" >
        {section name=row loop=$TenantsList}
        <option value="{$TenantsList[row].key}" {if $RoomTenant.tenant_id eq $TenantsList[row].key} selected {/if}>{$TenantsList[row].value}</option>
        {/section}
      </select>
    </td>
  </tr>


  <tr>
    <th>
      Weekly Rate&nbsp;:
    </th>
    <td>
      &euro;&nbsp;<input type="text" id="weekly_rate" name="weekly_rate" value="{$RoomTenant.weekly_rate}" size="6" maxlength="6" style="text-align:right" >
    </td>
  </tr>


  <tr>
    <th>
      Description&nbsp;:
    </th>
    <td>
      <textarea rows="8" cols="60" id="text" name="text" >{$RoomTenant.text}</textarea>
    </td>
  </tr>



{if $RoomTenant neq "" and $IsInsert neq 1 }
  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="{show_formatted_datetime datetime_label=$RoomTenant.created_at format= 'AsText'}" size="30" readonly style="border:1px dotted gray;text-align:left;" >
    </td>
  </tr>
{/if}


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
      <input type="button" id="btn_submit_reopen" name="btn_submit_reopen" onclick="javascript:onSubmit(1);" value="{if $IsInsert ne 1}Update & Reopen{else}Add & Reopen{/if}" >&nbsp;&nbsp;
      <input type="button" id="btn_submit_list" name="btn_submit_list" onclick="javascript:onSubmit(0);" value="{if $IsInsert ne 1}Update & List{else}Add & List{/if}" >&nbsp;&nbsp;
      <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='{$base_url}admin/room/edit/{$room_id}/property_id/{$property_id}{$PageParametersWithSort}'">
    </td>
  </tr>

</table>
</form>

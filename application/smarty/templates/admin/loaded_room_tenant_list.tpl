{if count($RoomTenantsList) eq 0 }
  <h4>No Room Tenants</h4>
  {if $max_tenants lte count($RoomTenantsList) }
    <small>No more tenants are possible.</small>
  {else}
    <a href="{$base_url}admin/room/room_tenant_edit/0/room_id/{$room_id}/property_id/{$property_id}">New Room Tenant</a>
  {/if}
  {return}
{/if}

<table style="border:1px dotted gray;">
  <tr>
    <th>Room</th>
    <th>Tenant</th>
    <th>From Date</th>
    <th>Weekly Rate</th>
    <th>Text</th>
    <th>Created At</th>
  </tr>
  {section name=row loop=$RoomTenantsList}
  <tr>
    <td>
      {$RoomTenantsList[row].room_name}
    </td>
    <td>
      {$RoomTenantsList[row].tenant_name}
    </td>
    <td style="text-align:center" >
      {show_formatted_datetime datetime_label=$RoomTenantsList[row].from_date format= 'DateAsText'}
    </td>
    <td style="text-align:right" >
      &euro;&nbsp;{$RoomTenantsList[row].weekly_rate}
    </td>
    <td>
      {concat_str str=$RoomTenantsList[row].text len=60}
    </td>

    <td style="text-align:center">
      {show_formatted_datetime datetime_label=$RoomTenantsList[row].created_at format= 'AsText'}
    </td>
    <td>
      <a href="{$base_url}admin/room/room_tenant_edit/{$RoomTenantsList[row].id}/room_id/{$room_id}/property_id/{$property_id}">Edit</a>&nbsp;
    </td>
    <td>
      <a href="javascript:DeleteRoomTenant('{$RoomTenantsList[row].id}', '{$RoomTenantsList[row].tenant_name}', '{$RoomTenantsList[row].room_name}' )" >Delete</a>&nbsp;
    </td>
    <td>
      <a href="javascript:MoveRoomTenantToHistory('{$RoomTenantsList[row].id}', '{$RoomTenantsList[row].tenant_name}', '{$RoomTenantsList[row].room_name}' )" >Move To History</a>&nbsp;
    </td>

  </tr>
  {/section}

  <tr>
    <td colspan="8">&nbsp;
    </td>
  </tr>
  <tr>
    <td colspan="8">
  {if $max_tenants lte count($RoomTenantsList)}
    <small>No more tenants are possible.</small>
  {else}
    <a href="{$base_url}admin/room/room_tenant_edit/0/room_id/{$room_id}/property_id/{$property_id}">New Room Tenant</a>
  {/if}
    </td>
  </tr>

</table>

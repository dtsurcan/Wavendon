
{if count($RoomsList) eq 0 }
  <div>No Data Found</div>
  {return}
{/if}

{$RoomsList|count}&nbsp;Row{if count($RoomsList) gt 0}s{/if}&nbsp;of&nbsp;{$RowsInTable}&nbsp;
<table style="border:1px dotted gray;" >

  <tr>
    <th>Name</th>
    <th>Size</th>
    <th>Max Tenants per room</th>
    <th>Description</th>
    <th>Weekly Rate</th>
    <th>Revenue</th>
    <th>Status</th>
    <th>Created At</th>
    <th>Updated At</th>
  </tr>


  {section name=row loop=$RoomsList}
  <tr>
    <td>
      {$RoomsList[row].name}
        {if $RoomsList[row].room_photo_room_count gt 0 or $RoomsList[row].room_tenant_room_count gt 0}&nbsp;&nbsp;<small>({/if}
        {if $RoomsList[row].room_photo_room_count gt 0}
          {$RoomsList[row].room_photo_room_count}&nbsp;Photo{if $RoomsList[row].room_photo_room_count gt 1}s{/if}
        {/if}

        {if $RoomsList[row].room_photo_room_count gt 0 and $RoomsList[row].room_tenant_room_count gt 0},&nbsp;{/if}

        {if $RoomsList[row].room_photo_room_count gt 0 and $RoomsList[row].room_tenant_room_count gt 0}
          {$RoomsList[row].room_tenant_room_count}&nbsp;Tenant{if $RoomsList[row].room_tenant_room_count gt 0}s{/if}
        {/if}
        {if $RoomsList[row].room_photo_room_count gt 0 or $RoomsList[row].room_tenant_room_count gt 0}&nbsp;)&nbsp;</small>{/if}
    </td>
    <td style="text-align:right" >
      {$RoomsList[row].size}
    </td>
    <td style="text-align:right">
      {$RoomsList[row].max_tenants}
    </td>
    <td>
      {$RoomsList[row].description}
    </td>
    <td style="text-align:right" >
      &euro;&nbsp;{$RoomsList[row].weekly_rate}
    </td>
    <td style="text-align:right">
      &euro;&nbsp;{$RoomsList[row].revenue}
    </td>


    <td>
      {show_room_status_title status=$RoomsList[row].status ControllerRef= $ControllerRef}
    </td>

    <td style="text-align:center">
      {show_formatted_datetime datetime_label=$RoomsList[row].updated_at format= 'AsText'}
    </td>
    <td style="text-align:center">
      {show_formatted_datetime datetime_label=$RoomsList[row].created_at format= 'AsText'}
    </td>
  </tr>
  {/section}
</table>
{$pagination_links}

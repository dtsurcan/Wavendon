{if count($HistorysList) eq 0 }
  <h4>No History</h4>
  {return}
{/if}

<table style="border:1px dotted gray;">
  <tr>
    <th>Room</th>
    <th>Tenant</th>
    <th>From Date</th>
    <th>To Date</th>
    <th>Weekly Rate</th>
    <th>History Text</th>
    <th>Created At</th>
  </tr>
  {section name=row loop=$HistorysList}
  <tr>
    <td>
      {$HistorysList[row].room_name}
    </td>
    <td>
      {$HistorysList[row].tenant_name}
    </td>
    <td style="text-align:center" >
      {show_formatted_datetime datetime_label=$HistorysList[row].from_date format= 'DateAsText'}
    </td>
    <td style="text-align:center" >
      {show_formatted_datetime datetime_label=$HistorysList[row].to_date format= 'DateAsText'}
    </td>
    <td style="text-align:right" >
      &euro;&nbsp;{$HistorysList[row].weekly_rate}
    </td>
    <td>
      {concat_str str=$HistorysList[row].text len=60}
    </td>
    <td style="text-align:center" >
      {show_formatted_datetime datetime_label=$HistorysList[row].created_at format= 'AsText'}
    </td>
  </tr>
  {/section}
</table>

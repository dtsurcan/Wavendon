<table style="border:0px dotted gray;">
  {section name=row loop=$RoomFeaturesCheckedList}
  <tr>
    <td>
      {$RoomFeaturesCheckedList[row].value}
    </td>
    <td>
     <input type="checkbox" value="1" id="cbx_room_feature_{$RoomFeaturesCheckedList[row].key}" name="cbx_room_feature_{$RoomFeaturesCheckedList[row].key}" {$RoomFeaturesCheckedList[row].checked} >
    </td>
  </tr>
  {/section}
</table>

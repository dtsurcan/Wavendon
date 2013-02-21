{if count($UserNotesList) gt 0 }
  <table style="border:1px dotted gray;">
    {section name=row loop=$UserNotesList}
    <tr>
      <td>
        {concat_str str=$UserNotesList[row].notes len=60}
      </td>

      <td>
        <a href="javascript:ShowUserNotes({$UserNotesList[row].id})" >View Full Notes</a>
      </td>
      <td>
        {show_formatted_datetime datetime_label=$UserNotesList[row].created_at format= 'AsText'}
      </td>
      <td>
        <a style="cursor:pointer;" onclick="javascript:DeleteUserNotes({$UserNotesList[row].id},'{show_title_of_text str=$UserNotesList[row].notes maxlen=60 is_replace_crlf=1}')" >Delete</a>
      </td>
    </tr>
    {/section}
  </table>
{/if}
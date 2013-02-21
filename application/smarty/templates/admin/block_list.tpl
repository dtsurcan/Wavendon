
<script type="text/javascript" language="JavaScript">
  <!--
  //jQuery.noConflict();
  function DeleteBlock(id, name) {
    if (!confirm("Do you want to delete '"+name+"' block ?")) return;
    document.location= "{$base_url}admin/block/delete/" + id
  }
  //-->
</script>


<h3>Blocks List</h3>
<span class="flash_message">
  {$editor_message}
</span>

<form action="{$base_url}admin/block/index/page/1{$PageParametersWithSort}" method="post" accept-charset="utf-8" id="form_blocks" name="form_blocks" enctype="multipart/form-data">
{$csrf_token_name_hidden}


<input type="hidden" id="page" name="page" value="{$page}" >
<input type="hidden" id="sorting" name="sorting" value="{$sorting}" >
<input type="hidden" id="sort" name="sort" value="{$sort}" >

<table style="border:1px dotted gray;" >
  <tr>
    <td>
      <input type="text" value="{$filter_name}" size="20" maxlength="50" name="filter_name" id="filter_name" >&nbsp;
    </td>
    <td>
      <input type="submit" value="Filter">
    </td>
  </tr>


</table>


{if ( count($BlocksList) eq 0 ) }
  <div>No Data Found</div>
  <a href="{$base_url}admin/block/edit/0{$PageParametersWithSort}">New Block</a>
{/if}

  {$BlocksList|count}&nbsp;Row{if count($BlocksList) gt 0}s{/if}&nbsp;of&nbsp;{$RowsInTable}&nbsp;(&nbsp;Page # <b>{$page}</b>&nbsp;)
<table style="border:1px dotted gray;" >

  <tr>
    <th>
      <a href="{$base_url}admin/block/index{$PageParametersWithoutSort}/sorting/name{show_sorting_directory fieldname="name" sorting=$sorting sort=$sort}" >Name&nbsp;
        {show_list_sorting_image fieldname="name" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      Description
      </a>
    </th>
    <th>
      <a href="{$base_url}admin/block/index{$PageParametersWithoutSort}/sorting/created_at{show_sorting_directory fieldname="created_at" sorting=$sorting sort=$sort}" >Created At&nbsp;
        {show_list_sorting_image fieldname="created_at" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th colspan="2">&nbsp;</th>
  </tr>

  {section name=row loop=$BlocksList}
  <tr>
    <td>
      {$BlocksList[row].name}
      {if $BlocksList[row].property_block_count gt 0}
        &nbsp;&nbsp;&nbsp;&nbsp;<small>( <b>{$BlocksList[row].property_block_count}</b> Related Propert{if count($BlocksList[row].property_block_count) gt 1}ies{else}y{/if}&nbsp;)</small>
      {/if}
    </td>
    <td>
      {concat_str str=$BlocksList[row].description len=60}
    </td>
    <td>
      {show_formatted_datetime datetime_label=$BlocksList[row].created_at format= 'AsText'}
    </td>
    <td>
      <a href="{$base_url}admin/block/edit/{$BlocksList[row].id}{$PageParametersWithSort}">Edit</a>
    </td>
    <td>
      <a href="javascript:DeleteBlock('{$BlocksList[row].id}{$PageParametersWithSort}', '{$BlocksList[row].name}' )" >Delete</a>
    </td>
  </tr>
  {/section}
</table>
{$pagination_links}
<a href="{$base_url}admin/block/edit/0{$PageParametersWithSort}">New Block</a>

</form>

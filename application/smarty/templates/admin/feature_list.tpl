<script type="text/javascript" language="JavaScript">
  <!--
  //jQuery.noConflict();
  function DeleteFeature(id, name) {
    if (!confirm("Do you want to delete '"+name+"' feature ?")) return;
    document.location= "{$base_url}admin/feature/delete/" + id
  }
  //-->
</script>


<h3>Features List</h3>
<span class="flash_message">
  {$editor_message}
</span>

<form action="{$base_url}admin/feature/index/page/1" method="post" accept-charset="utf-8" id="form_features" name="form_features" enctype="multipart/form-data">
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

{if count($FeaturesList) eq 0}
  <div>No Data Found</div>
  <a href="{$base_url}admin/feature/edit/0{$PageParametersWithSort}">New Feature</a>
{/if}

  {$FeaturesList|count}&nbsp;Row{if count($FeaturesList) gt 0}s{/if}&nbsp;of&nbsp;{$RowsInTable}&nbsp;(&nbsp;Page # <b>{$page}</b>&nbsp;)
<table style="border:1px dotted gray;" >

  <tr>
    <th>
      <a href="{$base_url}admin/feature/index{$PageParametersWithoutSort}/sorting/name{show_sorting_directory fieldname="name" sorting=$sorting sort=$sort}" >Name&nbsp;
        {show_list_sorting_image fieldname="name" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}admin/feature/index{$PageParametersWithoutSort}/sorting/type{show_sorting_directory fieldname="type" sorting=$sorting sort=$sort}" >Type&nbsp;
        {show_list_sorting_image fieldname="type" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}admin/feature/index{$PageParametersWithoutSort}/sorting/created_at{show_sorting_directory fieldname="created_at" sorting=$sorting sort=$sort}" >Created At&nbsp;
        {show_list_sorting_image fieldname="created_at" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th colspan="2">&nbsp;</th>
  </tr>

  {section name=row loop=$FeaturesList}
  <tr>
    <td>
      {$FeaturesList[row].name}
      {if $FeaturesList[row].property_feature_count gt 0}
        &nbsp;&nbsp;&nbsp;&nbsp;<small>( <b>{$FeaturesList[row].property_feature_count}</b> Related Propert{if count($FeaturesList[row].property_feature_count) gt 1}ies{else}y{/if}&nbsp;)</small>
      {/if}

      {if $FeaturesList[row].room_feature_count gt 0}
        &nbsp;&nbsp;&nbsp;&nbsp;<small>( <b>{$FeaturesList[row].room_feature_count}</b> Related Room{if $FeaturesList[row].room_feature_count gt 1}s{/if}&nbsp;)</small>
      {/if}

    </td>
    <td>
      {show_feature_type_title type=$FeaturesList[row].type ControllerRef= $ControllerRef}
    </td>
    <td>
      {show_formatted_datetime datetime_label=$FeaturesList[row].created_at format= 'AsText'}
    </td>
    <td>
      <a href="{$base_url}admin/feature/edit/{$FeaturesList[row].id}{$PageParametersWithSort}">Edit</a>
    </td>
    <td>
      &nbsp;{if $FeaturesList[row].property_feature_count eq 0 and $FeaturesList[row].room_feature_count eq 0}
      <a href="javascript:DeleteFeature('{$FeaturesList[row].id}','{$FeaturesList[row].name}' )" >Delete</a>
      {/if}
    </td>
  </tr>

  {/section}
</table>
{$pagination_links}
<a href="{$base_url}admin/feature/edit/0{$PageParametersWithSort}">New Feature</a>

</form>
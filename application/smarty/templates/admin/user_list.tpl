<script type="text/javascript" language="JavaScript">
  <!--
  //jQuery.noConflict();
  function DeleteUser(id, username ) {
    if (!confirm("Do you want to delete '"+username+"' user ?")) return;
    document.location= "{$base_url}admin/user/delete/" + id
  }
  //-->
</script>


<h3>Peoples List</h3>
<span class="flash_message">
  {$editor_message}
</span>

<form action="{$base_url}admin/user/index/page/1{$PageParametersWithSort}" method="post" accept-charset="utf-8" id="form_users" name="form_users" enctype="multipart/form-data">
{$csrf_token_name_hidden}

<input type="hidden" id="page" name="page" value="{$page}" >
<input type="hidden" id="sorting" name="sorting" value="{$sorting}" >
<input type="hidden" id="sort" name="sort" value="{$sort}" >

<table style="border:1px dotted gray;" >
  <tr>

    <td>
      Type&nbsp;:
    </td>
    <td>
      <select name="filter_type" id="filter_type" >
        {section name=row loop=$UserTypeValueArray}
        <option value="{$UserTypeValueArray[row].key}" {if $UserTypeValueArray[row].key eq $filter_type} selected{/if} >{$UserTypeValueArray[row].value}</option>
        {/section}
      </select>
    </td>
  </tr>

  <tr>
    <td>
      User name&nbsp;:
    </td>
    <td>
      <input type="text" value="{$filter_username}" size="20" maxlength="50" name="filter_username" id="filter_username" >
    </td>

  </tr>

  <tr>
    <td>
      &nbsp;
    </td>
    <td>
      <input type="submit" value="Filter">
    </td>
  </tr>


</table>


{if count($UsersList) eq 0}
  <div>No Data Found</div>
  <a href="{$base_url}admin/user/edit/0">New User</a>
{/if}

{$UsersList|count}&nbsp;Row{if count($UsersList) gt 0}s{/if}&nbsp;of&nbsp;{$RowsInTable}&nbsp;(&nbsp;Page # <b>{$page}</b>&nbsp;)
<table style="border:1px dotted gray;" >

  <tr>
    <th>
      <a href="{$base_url}admin/user/index{$PageParametersWithoutSort}/sorting/username{show_sorting_directory fieldname="username" sorting=$sorting sort=$sort}" >Username&nbsp;
        {show_list_sorting_image fieldname="username" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}admin/user/index{$PageParametersWithoutSort}/sorting/email{show_sorting_directory fieldname="email" sorting=$sorting sort=$sort}" >Email&nbsp;
        {show_list_sorting_image fieldname="email" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>

    <th>
      <a href="{$base_url}admin/user/index{$PageParametersWithoutSort}/sorting/type{show_sorting_directory fieldname="type" sorting=$sorting sort=$sort}" >Type&nbsp;
        {show_list_sorting_image fieldname="type" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}admin/user/index{$PageParametersWithoutSort}/sorting/title{show_sorting_directory fieldname="title" sorting=$sorting sort=$sort}" >Title&nbsp;
        {show_list_sorting_image fieldname="title" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}admin/user/index{$PageParametersWithoutSort}/sorting/first_name{show_sorting_directory fieldname="first_name" sorting=$sorting sort=$sort}" >First Name&nbsp;
        {show_list_sorting_image fieldname="first_name" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>

    <th>
      <a href="{$base_url}admin/user/index{$PageParametersWithoutSort}/sorting/middle_name{show_sorting_directory fieldname="middle_name" sorting=$sorting sort=$sort}" >Middle Name&nbsp;
        {show_list_sorting_image fieldname="middle_name" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>

    <th>
      <a href="{$base_url}admin/user/index{$PageParametersWithoutSort}/sorting/last_name{show_sorting_directory fieldname="last_name" sorting=$sorting sort=$sort}" >Last Name&nbsp;
        {show_list_sorting_image fieldname="last_name" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>

    <th>
      <a href="{$base_url}admin/user/index{$PageParametersWithoutSort}/sorting/created_at{show_sorting_directory fieldname="created_at" sorting=$sorting sort=$sort}" >Created At&nbsp;
        {show_list_sorting_image fieldname="created_at" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th>
      <a href="{$base_url}admin/user/index{$PageParametersWithoutSort}/sorting/updated_at{show_sorting_directory fieldname="updated_at" sorting=$sorting sort=$sort}" >Updated At&nbsp;
        {show_list_sorting_image fieldname="updated_at" sorting=$sorting sort=$sort images_dir_full_url=$images_dir_full_url}
      </a>
    </th>
    <th colspan="2">&nbsp;</th>
  </tr>


  {section name=row loop=$UsersList}
  <tr>
    <td>
      {$UsersList[row].username}

      {if $UsersList[row].property_user_count gt 0}
        &nbsp;&nbsp;&nbsp;&nbsp;<small>( <b>{$UsersList[row].property_user_count}</b> Related Propert{if count($UsersList[row].property_user_count) gt 1}ies{else}y{/if}&nbsp;)</small>
      {/if}

    </td>
    <td>
      {$UsersList[row].email}
    </td>
    <td>
      {show_user_type_title type=$UsersList[row].type ControllerRef= $ControllerRef}
    </td>
    <td>
      {$UsersList[row].title}
    </td>
    <td>
      {$UsersList[row].first_name}
    </td>
    <td>
      {$UsersList[row].middle_name}
    </td>
    <td>
      {$UsersList[row].last_name}
    </td>
    <td>
      {show_formatted_datetime datetime_label=$UsersList[row].created_at format= 'AsText'}
    </td>
    <td>
      {show_formatted_datetime datetime_label=$UsersList[row].updated_at format= 'AsText'}
    </td>
    <td>
      <a href="{$base_url}admin/user/edit/{$UsersList[row].id}{$PageParametersWithSort}">Edit</a>
    </td>
    <td>&nbsp;
      {if $UsersList[row].property_user_count eq 0}
        <a href="javascript:DeleteUser( '{$UsersList[row].id}{$PageParametersWithSort}', '{$UsersList[row].username}' )" >Delete</a>
      {/if}
    </td>
  </tr>
  {/section}
</table>
{$pagination_links}
<a href="{$base_url}admin/user/edit/0{$PageParametersWithSort}">New User</a>

</form>
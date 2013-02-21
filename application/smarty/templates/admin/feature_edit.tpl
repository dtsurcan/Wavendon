<script type="text/javascript">

  //  $.noConflict();
  jQuery(document).ready(function($) {
    document.getElementById("name").focus()
  });

  function onSubmit(IsReopen) {
    var theForm = document.getElementById("form_feature_edit");
    document.getElementById("is_reopen").value = IsReopen
    theForm.submit();
  }
</script>


<form action="{$base_url}admin/feature/edit/{$id}{$PageParametersWithSort}" method="post" accept-charset="utf-8" id="form_feature_edit" name="form_feature_edit" enctype="multipart/form-data">
{$csrf_token_name_hidden}
<input type="hidden" id="is_reopen" name="is_reopen" value="">

<h3>{if $Feature eq ""} New{else}Edit{/if}&nbsp;Feature</h3>
<span class="error">{$validation_errors_text}</span>
<span class="flash_message">
  {$editor_message}
</span>

<table style="border:1px dotted gray;" >
{if ( $Feature.id neq "" and $Feature.id neq "0" )}
  <tr>
    <th>
      Id&nbsp;:
    </th>
    <td>
      <input type="text" id="id" name="id" value="{if $Feature neq ""}{$Feature.id}{/if}" size="8" readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>
{/if}

  <tr>
    <th>
      Name&nbsp;:
    </th>
    <td>
      <input type="text" id="name" name="name" value="{if $Feature neq ""}{$Feature.name}{/if}" size="50" maxlength="50" >
    </td>
  </tr>

  <tr>
    <th>
      Type&nbsp;:
    </th>
    <td>
      <select name="type" id="type" >
        {section name=row loop=$FeatureTypeValueArray}
          <option value="{$FeatureTypeValueArray[row].key}" {if $Feature.type eq $FeatureTypeValueArray[row].key} selected {/if} >{$FeatureTypeValueArray[row].value}</option>
        {/section}
      </select>
    </td>
  </tr>

{if $Feature.created_at neq "" }
  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="{show_formatted_datetime datetime_label=$Feature.created_at format= 'AsText'}" size="30" readonly style="border:1px dotted gray;text-align:left;" >
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
      <input type="button" id="btn_submit_reopen" name="btn_submit_reopen" onclick="javascript:onSubmit(1);" value="{if $Feature eq ""}Add & Reopen{else}Update & Reopen{/if}" >&nbsp;&nbsp;
      <input type="button" id="btn_submit_list" name="btn_submit_list" onclick="javascript:onSubmit(0);" value="{if $Feature eq ""}Add & List{else}Update & List{/if}" >&nbsp;&nbsp;
      <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='{$base_url}admin/feature/index{$PageParametersWithSort}'">
    </td>
  </tr>

</table>
</form>
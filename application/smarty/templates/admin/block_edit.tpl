
<script type="text/javascript">
  jQuery(document).ready(function($) {
    {if $Block neq "" and $IsInsert neq 1 }
    BlockPropertiesLoad()
    {/if}
    document.getElementById("name").focus()
  });

  function OpenPropertysSelection(Fieldname) {
    //alert("OpenPropertysSelection Fieldname::"+Fieldname )

    var screen_popup_width_indent= 50
    var screen_popup_height_indent= 100
    var H= screen.availHeight - screen_popup_height_indent;
    var W= screen.availWidth - screen_popup_width_indent;
    var TopCoord= screen_popup_height_indent / 2
    var LeftCoord= screen_popup_width_indent / 2

    var naProps = window.open( "{$base_url}admin/property/index/page/1/is_selection/1/is_onlyunusedinblocks/1",
      "property_list","status=no,modal=yes,scrollbars=yes,width="+W+",height="+H+",left="+LeftCoord+", top="+TopCoord );

  }
  function FillProperty( SelectedID, SelectedNAME ) {
    FillDdlbValue( "select_new_block_property", SelectedID, SelectedNAME )
  }

  function BlockPropertiesLoad() {
    var HRef= "{$base_url}admin/block/load_block_properties/block_id/{$id}";
    //alert(HRef)
    $.get(HRef,   {  },  // JSON
      onBlockPropertiesLoaded,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  }
  function onBlockPropertiesLoaded(data) {
    document.getElementById('div_LoadedLinkedProperties').innerHTML= data;
  }

  function onSubmit(IsReopen) {
    var theForm = document.getElementById("form_block_edit");
    document.getElementById("is_reopen").value = IsReopen
    theForm.submit();
  }


  ////////////////////////////////////
  function AddNewPropertyToBlock() {
    document.getElementById("tr_enter_value_block_property").style.display= GetShowTRMethod()
    document.getElementById("tr_add_new_block_property").style.display= "none"
  }

  function CancelNewTenantGuarantor() {
    document.getElementById("tr_enter_value_block_property").style.display= "none"
    document.getElementById("tr_add_new_block_property").style.display= GetShowTRMethod()
    document.getElementById("select_new_block_property").value= ""
  }

  function SaveNewBlockProperty() {
    var block_property_id= document.getElementById("select_new_block_property").value
    if ( Trim(block_property_id) == "" ) {
      alert("Select Property!")
      document.getElementById("select_new_block_property").focus()
      return;
    }
    var HRef= "{$base_url}admin/block/save_block_property/block_id/{$id}/property_id/"+block_property_id;
    // alert(HRef)
    $.getJSON(HRef,   {  },
      onSavedBlockProperty,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  }

  function onSavedBlockProperty(data) {
    // alert("onSavedBlockProperty data::"+var_dump(data) )
  	if ( parseInt(data.ErrorCode) == 0 ) {
      BlockPropertiesLoad()
		} else {
		  alert((data.ErrorMessage))
		}
  }

  function DeleteBlockProperty( id, PropertyName ) {
    if ( !confirm( "Do you want to clear block of '"+PropertyName+"' Property ?" ) ) return;
    var HRef= "{$base_url}admin/block/delete_block_property/property_id/"+id;
    // alert(HRef)
    $.getJSON(HRef,   {  },
      onDeleteBlockProperty,
      function(x,y,z) {   //Some sort of error
        alert(x.responseText);
      }
    );
  }

  function onDeleteBlockProperty(data) {
//     alert("onDeleteBlockProperty data::"+var_dump(data) )
  	if ( parseInt(data.ErrorCode) == 0 ) {
      BlockPropertiesLoad()
		} else {
		  alert((data.ErrorMessage))
		}
  }


</script>


<form action="{$base_url}admin/block/edit/{$id}{$PageParametersWithSort}" method="post" accept-charset="utf-8" id="form_block_edit" name="form_block_edit" enctype="multipart/form-data">
{$csrf_token_name_hidden}

<input type="hidden" id="is_reopen" name="is_reopen" value="">


<h3>{if $Block eq ""}New{else}Edit{/if}&nbsp;Block</h3>
<span class="error">{$validation_errors_text}</span>
<span class="flash_message">
  {$editor_message}
</span>

<table style="border:1px dotted gray;" >
{if $Block neq "" }
  <tr>
    <th>
      Id&nbsp;:
    </th>
    <td>
      <input type="text" id="id" name="id" value="{if $Block neq ""}{$Block.id}{/if}" size="8" readonly style="border:1px dotted gray;text-align: right;" >
    </td>
  </tr>
{/if}

  <tr>
    <th>
      Name&nbsp;:
    </th>
    <td>
      <input type="text" id="name" name="name" value="{if $Block neq ""}{$Block.name}{/if}" size="50" maxlength="50" >
    </td>
  </tr>

  <tr>
    <th>
      Description&nbsp;:
    </th>
    <td>
      <textarea rows="8" cols="60" id="description" name="description" >{if $Block neq ""}{$Block.description}{/if}</textarea>
    </td>
  </tr>

  <tr id="tr_block_linked_properties" >
    <th>
      Have Properties&nbsp;:
    </th>
    <td>
      <idiv id="div_LoadedLinkedProperties"></div>
    </td>
  </tr>

{if $Block neq "" }
  <tr>
    <th>
      Created At&nbsp;:
    </th>
    <td>
      <input type="text" id="created_at" name="created_at" value="{show_formatted_datetime datetime_label=$Block.created_at format= 'AsText'}" size="30" readonly style="border:1px dotted gray;text-align:left;" >
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
      <input type="button" id="btn_submit_reopen" name="btn_submit_reopen" onclick="javascript:onSubmit(1);" value="{if $Block neq ""}Update & Reopen{else}Add & Reopen{/if}" >&nbsp;&nbsp;
      <input type="button" id="btn_submit_list" name="btn_submit_list" onclick="javascript:onSubmit(0);" value="{if $Block neq ""}Update & List{else}Add & List{/if}" >&nbsp;&nbsp;
      <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='{$base_url}admin/block/index{$PageParametersWithSort}'">
    </td>
  </tr>

</table>
</form>


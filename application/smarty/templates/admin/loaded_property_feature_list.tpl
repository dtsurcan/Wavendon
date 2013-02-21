<table style="border:1px dotted gray;">
  {section name=row loop=$CkeckedFeaturesList}
  <tr>
    <td>
      {$CkeckedFeaturesList[row].value}
    </td>
    <td>
     <input type="checkbox" value="1" id="cbx_property_feature_{$CkeckedFeaturesList[row].key}" name="cbx_property_feature_{$CkeckedFeaturesList[row].key}" {$CkeckedFeaturesList[row].checked} >
    </td>
  </tr>
  {/section}
</table>
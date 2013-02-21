<script type="text/javascript">

//  $.noConflict();
  jQuery(document).ready(function($) {
    document.getElementById("login").focus()
  });
</script>

<h3>Enter to system</h3>
<span class="error">{$validation_errors_text}
  {$login_message}
</span>

<form action="{$base_url}admin/admin/login" method="post" accept-charset="utf-8" id="form_login" name="form_login" enctype="multipart/form-data">
{$csrf_token_name_hidden}


<table border="0px dotted green;">

  <tr>
    <th>
      Login&nbsp;:
    </th>
    <td>
      <input type="text" id="login" name="login" value="" size="20" maxlength="50" >
    </td>
  </tr>

  <tr>
    <th>
      Password&nbsp;:
    </th>
    <td>
      <input type="password" id="password" name="password" value="" size="20" maxlength="50" >
    </td>
  </tr>

  <tr>
    <th>
      &nbsp;
    </th>
    <td>
      <input type="submit" id="btn_submit" name="btn_submit" value="Submit" >&nbsp;&nbsp;
      <input type="button" id="btn_cancel" name="btn_cancel" value="Cancel" onclick="javascript:document.location='{$base_url}/admin/admin/login'">
    </td>
  </tr>

</table>
</form>
<div id="main">
    ~~debug~
	<h3>~~$dashboard.category~</h3>
	<table cellpadding="0" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Guarantor / Tenant</th>
            <th>Actions</th>
        </tr>
        ~~foreach from=$users_list item=i~
        <tr>
            <td>
                ~~$i.id~
            </td>
            <td>
                ~~$i.t_fn~ ~~$i.t_ln~
            </td>
            <td>
                ~~$i.email~
            </td>
            <td>
                ~~$i.u_fn~ ~~$i.u_ln~
            </td>
            <td class='action'>
                <a href='index.php?action=viewuser&id=~~$i.id~' class='view'>View</a><a href='#' class='edit'>Edit</a><a href='#' data-id='~~$i.id~' class='delete delete_user'>Delete</a>
            </td>
        </tr>
        ~~/foreach~
    </table>
    ~~mod mod_name="adduser" action=""~
</div>
<div class="clear"></div>
<script>
$('.delete_user').click(function(){
    var user_id = $(this).attr('data-id');
    var userstring = $(this);
    if(confirm("Are You sure?")) {
        $.post(
            "post/delete_user.php",
            {
                id: user_id
            },
            function(data) {
                userstring.parent().parent().remove();
            }
        );
    }
    return false;
});
</script>
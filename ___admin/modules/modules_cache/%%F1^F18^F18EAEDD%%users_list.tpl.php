<?php /* Smarty version 2.6.11, created on 2012-11-22 04:19:39
         compiled from /home/wavendon/public_html/admin/modules/users_list/users_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'debug', '/home/wavendon/public_html/admin/modules/users_list/users_list.tpl', 2, false),array('function', 'mod', '/home/wavendon/public_html/admin/modules/users_list/users_list.tpl', 32, false),)), $this); ?>
<div id="main">
    <?php echo smarty_function_debug(array(), $this);?>

	<h3><?php echo $this->_tpl_vars['dashboard']['category']; ?>
</h3>
	<table cellpadding="0" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Guarantor / Tenant</th>
            <th>Actions</th>
        </tr>
        <?php $_from = $this->_tpl_vars['users_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
        <tr>
            <td>
                <?php echo $this->_tpl_vars['i']['id']; ?>

            </td>
            <td>
                <?php echo $this->_tpl_vars['i']['t_fn']; ?>
 <?php echo $this->_tpl_vars['i']['t_ln']; ?>

            </td>
            <td>
                <?php echo $this->_tpl_vars['i']['email']; ?>

            </td>
            <td>
                <?php echo $this->_tpl_vars['i']['u_fn']; ?>
 <?php echo $this->_tpl_vars['i']['u_ln']; ?>

            </td>
            <td class='action'>
                <a href='index.php?action=viewuser&id=<?php echo $this->_tpl_vars['i']['id']; ?>
' class='view'>View</a><a href='#' class='edit'>Edit</a><a href='#' data-id='<?php echo $this->_tpl_vars['i']['id']; ?>
' class='delete delete_user'>Delete</a>
            </td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <?php echo smarty_function_mod(array('mod_name' => 'adduser','action' => ""), $this);?>

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
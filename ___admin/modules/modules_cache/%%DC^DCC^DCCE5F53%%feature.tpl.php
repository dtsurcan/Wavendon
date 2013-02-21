<?php /* Smarty version 2.6.11, created on 2012-10-18 09:54:05
         compiled from /home/wavendon/public_html/admin/modules/feature/feature.tpl */ ?>
<div id="main">
    <h3>Add feature</h3>
    <form action="post/post_feature.php" class="jNice" method="post">
    	<fieldset class="fields">
        	<p><label>Feature name:</label><input type="text" class="text-long" name="name" id="feature" /></p>
            <div class="clear"></div>
            <input type="submit" value="Add Feature" />
        </fieldset>
    </form>
    <div class="clear"></div>
    <h3>Features</h3>
    <table>
        <tr>
            <th>ID:</th>
            <th>Feature Name:</th>
        </tr>
        <?php $_from = $this->_tpl_vars['features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
        <tr>
            <td><?php echo $this->_tpl_vars['i']['id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['i']['name']; ?>
</td>
        <tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<script type="text/javascript">
</script>
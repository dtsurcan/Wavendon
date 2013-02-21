<?php /* Smarty version 2.6.11, created on 2012-11-22 04:19:34
         compiled from /home/wavendon/public_html/admin/modules/history/history.tpl */ ?>
<div id="main">
    <h3>History</h3>
    <table>
        <tr>
            <th>ID:</th>
            <th>From (date):</th>
            <th>To (date):</th>
            <th>Room:</th>
            <th>Landlord:</th>
            <th>Weekly Rate:</th>
        </tr>
        <?php $_from = $this->_tpl_vars['history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
        <tr>
            <td><?php echo $this->_tpl_vars['i']['id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['i']['from_date']; ?>
</td>
            <td><?php echo $this->_tpl_vars['i']['to_date']; ?>
</td>
            <td><a class="blue" href="index.php?action=room&id=<?php echo $this->_tpl_vars['i']['ROOMID']; ?>
"><?php echo $this->_tpl_vars['i']['name']; ?>
</a></td>
            <td><a class="blue" href="index.php?action=users&category=landlords&id=<?php echo $this->_tpl_vars['i']['landlord_id']; ?>
"><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['middle_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name']; ?>
</a></td>
            <td><strong>&pound;<?php echo $this->_tpl_vars['i']['weekly_rate']; ?>
</strong></td>
        <tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<script type="text/javascript">
</script>
<?php /* Smarty version 2.6.11, created on 2012-03-12 14:05:25
         compiled from firms/firms.tpl */ ?>


<?php $_from = $this->_tpl_vars['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<li onClick="fill('<?php echo $this->_tpl_vars['i']['id']; ?>
');"><?php echo $this->_tpl_vars['i']['name']; ?>
</li>
<?php endforeach; endif; unset($_from); ?>


        

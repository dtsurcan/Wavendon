<?php /* Smarty version 2.6.11, created on 2012-11-22 04:19:39
         compiled from /home/wavendon/public_html/admin/modules/main/main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'mod', '/home/wavendon/public_html/admin/modules/main/main.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_mod(array('mod_name' => 'dashboard','action' => ""), $this);?>

<?php echo smarty_function_mod(array('mod_name' => ($this->_tpl_vars['module']),'action' => ""), $this);?>
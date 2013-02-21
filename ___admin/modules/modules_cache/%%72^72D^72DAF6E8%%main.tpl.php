<?php /* Smarty version 2.6.11, created on 2012-11-22 04:19:39
         compiled from main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'mod', 'main.tpl', 42, false),)), $this); ?>
<div id="wrapper">
	<h1><a href="index.php"><span class="blue">Waven</span><span class="orange">don</span> <span class="grey">Properties</span></a></h1>
    <ul id="mainNav">
    	<li><a href="#" class="active">DASHBOARD</a></li> <!-- Use the "active" class for the active menu item  -->
        <!--
    	<li><a href="#">ADMINISTRATION</a></li>
    	<li><a href="#">DESIGN</a></li>
    	<li><a href="#">OPTION</a></li>
        -->
    	<li class="logout"><a href="logout.php"><?php echo '<?php'; ?>
 echo $userfname." ".$userlname." (".$usertype.") - "; <?php echo '?>'; ?>
LOGOUT</a></li>
    </ul>
	<div id="containerHolder">
		<div id="container">
    		<div id="sidebar">
            	<ul class="sideNav">
                    <?php echo '<?php'; ?>
 if($usertype == "admin") {<?php echo '?>'; ?>

                    <li><h4>Users</a></h4>
                	<li><a href="index.php?action=users&category=landlords">Landlords</a></li>
                	<li><a href="index.php?action=users&category=guarantors">Guarantors</a></li>
                	<li><a href="index.php?action=users&category=tenants">Tenants</a></li>
                    <?php echo '<?php'; ?>
 } <?php echo '?>'; ?>

                    <li><h4>Rooms</a></h4>
                	<li><a href="index.php?action=property">Properties</a></li>
                    <?php echo '<?php'; ?>
 if($usertype == "admin") {<?php echo '?>'; ?>

                	<li><a href="index.php?action=feature">Features</a></li>
                    <?php echo '<?php'; ?>
 } <?php echo '?>'; ?>

                    <li><h4>Other</a></h4>
                	<li><a href="index.php?action=history" class="active">History</a></li>
                </ul>
            </div>
            <div id="content">
			     <?php echo smarty_function_mod(array('mod_name' => 'main','action' => ""), $this);?>

                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
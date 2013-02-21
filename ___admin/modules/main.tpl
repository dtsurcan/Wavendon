<div id="wrapper">
	<h1><a href="index.php"><span class="blue">Waven</span><span class="orange">don</span> <span class="grey">Properties</span></a></h1>
    <ul id="mainNav">
    	<li><a href="#" class="active">DASHBOARD</a></li> <!-- Use the "active" class for the active menu item  -->
        <!--
    	<li><a href="#">ADMINISTRATION</a></li>
    	<li><a href="#">DESIGN</a></li>
    	<li><a href="#">OPTION</a></li>
        -->
    	<li class="logout"><a href="logout.php"><?php echo $userfname." ".$userlname." (".$usertype.") - "; ?>LOGOUT</a></li>
    </ul>
	<div id="containerHolder">
		<div id="container">
    		<div id="sidebar">
            	<ul class="sideNav">
                    <?php if($usertype == "admin") {?>
                    <li><h4>Users</a></h4>
                	<li><a href="index.php?action=users&category=landlords">Landlords</a></li>
                	<li><a href="index.php?action=users&category=guarantors">Guarantors</a></li>
                	<li><a href="index.php?action=users&category=tenants">Tenants</a></li>
                    <?php } ?>
                    <li><h4>Rooms</a></h4>
                	<li><a href="index.php?action=property">Properties</a></li>
                    <?php if($usertype == "admin") {?>
                	<li><a href="index.php?action=feature">Features</a></li>
                    <?php } ?>
                    <li><h4>Other</a></h4>
                	<li><a href="index.php?action=history" class="active">History</a></li>
                </ul>
            </div>
            <div id="content">
			     ~~ mod mod_name="main" action=""~
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
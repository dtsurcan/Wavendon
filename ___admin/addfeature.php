<?php
$action = ucfirst($action);
?>
<h2>
    Dashboard 
    <?php
    if($action) {
        echo " &raquo; ";
        echo "<a href='#' class='active'>";
        echo $action;
        echo "</a>";
    }
    ?>
</h2>                
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
        <?php
        function futureBlock() {
            $mysql = "
                SELECT id, name
                FROM features
                ORDER BY name
            ";
            $query = mysql_query($mysql);
            while($result = mysql_fetch_array($query)) {
                $id = $result['id'];
                $name = $result['name'];
                echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td>$name</td>";
                echo "<tr>";
            }
        }
        futureBlock();
        ?>
    </table>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<script type="text/javascript">
</script>
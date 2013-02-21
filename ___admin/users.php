<?php
$category = $_GET['category'];
$category = ucfirst($category);
$action = ucfirst($action);
?>


<div id="main">
	<h3><?php echo $category; ?></h3>
	<table cellpadding="0" cellspacing="0">
        <?php
        $mysql_user = "
            SELECT
                user.id,
                user.login,
                user.`password`,
                user.salt,
                user.email,
                user.title,
                user.first_name,
                user.middle_name,
                user.last_name,
                user.photo,
                user.copy_dln,
                user.passport,
                user.dln,
                user.copy_passport,
                $category.user_id
            FROM
                user
            INNER JOIN $category
            ON user.id = $category.user_id
        ";
        $query_user = mysql_query($mysql_user);
        while($result = mysql_fetch_array($query_user)) {
            $user_id = $result["id"];
            $user_title = $result["title"];
            $user_fname = $result["first_name"];
            $user_lname = $result["last_name"];
            $user_email = $result["email"];
            echo "<tr>";
                echo "<td>";
                    echo $user_id;
                echo "</td>";
                echo "<td>";
                    echo $user_title." ".$user_fname." ".$user_lname;
                echo "</td>";
                echo "<td>";
                    echo $user_email;
                echo "</td>";
                echo "<td class='action'>";
                    echo "<a href='#' class='view'>View</a><a href='#' class='edit'>Edit</a><a href='#' class='delete'>Delete</a>";
                echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php require "adduser.php"; ?>
</div>
<div class="clear"></div>
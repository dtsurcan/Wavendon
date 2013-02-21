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
        ~~foreach from=$features item=i~
        <tr>
            <td>~~$i.id~</td>
            <td>~~$i.name~</td>
        <tr>
        ~~/foreach~
    </table>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<script type="text/javascript">
</script>
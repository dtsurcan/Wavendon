<h3>Add user</h3>
<form action="post/post_user.php" class="jNice" method="post">
	<fieldset class="fields">
        <p>
            <label>Category:</label>
            <select name="category">
                <option value="landlords">landlord</option>
                <option value="guarantors">Guarantor</option>
                <option value="tenants">Tenant</option>
            </select> 
        </p>
    	<p><label>Login:</label><input type="text" class="text-long" name="login" /></p>
    	<p><label>Password:</label><input type="text" class="text-long" name="password" /></p>
    	<p><label>Email:</label><input type="text" class="text-long" name="email" /></p>
    	<p><label>Title:</label><input type="text" class="text-long" name="title" /></p>
    	<p><label>First Name:</label><input type="text" class="text-long" name="fname" /></p>
    	<p><label>Middle Name:</label><input type="text" class="text-long" name="mname" /></p>
    	<p><label>Last Name:</label><input type="text" class="text-long" name="lname" /></p>
    	<p><label>Photo:</label><input type="file" class="text-long" /></p>
    	<p><label>Passport Copy:</label><input type="file" class="text-long" /></p>
    	<p><label>Driver License Copy:</label><input type="file" class="text-long" /></p>
    	<p><label>Passport Number:</label><input type="text" class="text-long" name="passport" /></p>
    	<p><label>Driver License Number:</label><input type="text" class="text-long" name="dln" /></p>
        <div class="clear"></div>
        <input type="submit" value="Add landlord" />
    </fieldset>
</form>
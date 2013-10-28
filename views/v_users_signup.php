<h2> Signup </h2>
<?php if(isset($source)): ?>
        <div class='error'>
            <?php if($source == "empty") {
                echo "All fields are required. Please try again."; 
            	} else {
                echo "Email already in use. Please try a different email address."; }
                    ?>
        </div>
        <br>
    <?php endif; ?>

<form method='POST' action='/users/p_signup'>

	First Name <input type='text' name='first_name' required><br>
	Last Name <input type='text' name='last_name' required><br>
	Email <input type='email' name='email' required ><br>
	Password <input type='password' name='password'><br>

	<input type='submit' value='sign up'>
</form>
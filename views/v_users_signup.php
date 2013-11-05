<div id='signup'>
    <h2> Sign up for a Ticker account </h2>
    <?php if(isset($source)): ?>
        <div class='error'>
            <?php if($source == "empty") {
                echo "All fields are required. Please try again."; 
            	} else {
                echo "Email already in use. Please try a different email address."; }?>
        </div>
        <br>
    <?php endif; ?>
    <form method='POST' action='/users/p_signup'>
        Name <input type='text' name='first_name' placeholder='Company name' required><br>
        Ticker <input type='text' name='ticker_name' placeholder='Ticker symbol' maxlength="4" required><br>
        Email <input type='email' name='email' placeholder='Email' required ><br>
        Password <input type='password' name='password' placeholder='Password' required><br>
        <br>
        <input type='submit' value='Sign up'>
    </form>
</div>

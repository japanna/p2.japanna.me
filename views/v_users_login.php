<form method='POST' action='/users/p_login'>
    Email<br>
    <input type='text' name='email' autofocus required>
    <br><br>
    Password<br>
    <input type='password' name='password' required>
    <br><br>

    <?php if(isset($source)): ?>
        <div class='error'>
            <?php if($source == "Email") {
                echo "Email not found. Please try again."; }
                else if($source == "Password"){
                echo "Wrong password. Please try again."; }?>
        </div>
        <br>
    <?php endif; ?>
    <input type='submit' value='Log in'>
</form>
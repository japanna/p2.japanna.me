<form method='POST' action='/users/p_login'>

    Email<br>
    <input type='text' name='email'>

    <br><br>

    Password<br>
    <input type='password' name='password'>

    <br><br>

    <?php if(isset($source)): ?>
        <div class='error'>
            <?php if($source == "Email") {
                echo "Email Oops! " . $source . " not found. Please try again."; }
                else {
                    echo "PWD Oops! " . $source . " not found. Please try again."; }
                    ?>
        </div>
        <br>
    <?php endif; ?>



    <input type='submit' value='Log in'>

</form>
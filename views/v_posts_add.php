
<?php if(isset($error)): ?>
        <div class='error'>
             <?php   echo "Please say something.";  ?>
            
        </div>
        <br>
    <?php endif; ?>
<form method='POST' action='/posts/p_add'>

    <label for='content'>New Post:</label><br>
    <textarea name='content' id='content' required></textarea>

    <br><br>
    <input type='submit' value='New post'>

</form> 
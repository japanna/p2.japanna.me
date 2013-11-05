<div id='posts_add'>
	<?php if(isset($type)): ?>
        <div class='message'>
            <?php if($type == "error") {
                echo "You didn't report anything. Please try again."; }
                else if($type == "posted"){
                    echo "You just posted a great report! Ka-ching!"; }?>
        </div>
        <br>
    <?php endif; ?>
	<form method='POST' action='/posts/p_add'>
	    <label for='content'>Report something...</label><br>
	    <textarea name='content' id='content' maxlength="140" wrap="hard" cols="45" rows="5" placeholder='Feeling up or down?' autofocus required></textarea>
		<br><br>
	    <input type='submit' value='New Tick!'>
	</form> 
</div>
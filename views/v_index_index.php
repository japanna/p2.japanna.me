<div id='index'>
<!-- If not logged in, show login / signup landing page -->
<?php if(!$user): ?>
	<div id='users_login'>
	<h2>Log in</h2>
		<?=$moreContent;?>    
	</div>
	<div id='users_signup'>
		<h2>New to Ticker?</h2>
		<p>Ticker is where stocks come to post reports - annually, quarterly, socially.</p> 
		<p class='plus_one'>+1 Upload profile picture</p>
		<p class='plus_one'>+1 Receive an email upon signup</p>
		<p><a href='/users/signup'>Sign up!</a> </p>
	</div>
</div>
<!-- If logged in, redirect to user's homepage -->
<? else: Router::redirect("/posts")?>
<?php endif; ?>

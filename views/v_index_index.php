<!-- 
<h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1> -->

<!-- If not logged in, show login / signup landing page -->
<?php if(!$user): ?>
	<h2> Sign in  </h2>
	
	<?=$moreContent;?>    
	
	<h2>Sign up</h2>
	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
	sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat <a href='/users/signup'>volupat. </a> </p>
<!-- If logged in, redirect to user's homepage -->
<? else: Router::redirect("/posts")?>
<?php endif; ?>
<div id='users_profile'>
	<h2><?=$user->first_name?>'s Ticker profile</h2>
	<h3>Update Ticker picture</h3>
	<img src="/uploads/avatars/<?=$user->img?>" alt="User profile" width="80" height="80">
	<form method='POST' enctype="multipart/form-data" action='/users/p_upload/'>
		<input type='file' name='photo'><br>
		<input type='submit'>
	<form>
</div>


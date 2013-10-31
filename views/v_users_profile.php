<h2><?=$user->first_name?> <?=$user->last_name?>'s profile</h2>
<img id="" src="/uploads/avatars/<?=$user->img?>" alt="" width="80" height="80">


<h2>Update profile picture</h2>
<form method='POST' enctype="multipart/form-data" action='/users/p_upload/'>
	
		<input type='file' name='photo'><br>
		<input type='submit'>

	<form>


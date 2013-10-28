<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Common CSS/JSS -->
    <link rel="stylesheet" href="/css/style.css">
    <!--<script src="http://use.edgefonts.net/cabin.js"></script>  Adobe's Edgefonts script -->

	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>
<body>	
    <header>
        <h1><a href='/'>Kramer</a></h1>
    </header>
    <nav> 
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
            <a href='/posts'>Posts </a>    <!-- My stream -->
            <a href='/posts/users'> Users </a> <!-- List of all users -->
            <a href='/posts/add'>Say! </a> 
            <a href='/users/profile'>Profile </a> <!-- My settings -->
            <a href='/users/logout'>Logout </a>
        <?php endif; ?>
    </nav>
    <section id="content">
        <?php if(isset($content)) echo $content; ?>
    </section>
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
<footer>This is the footer</footer>
</html>
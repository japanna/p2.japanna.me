<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Common CSS/JSS -->
    <link rel="stylesheet" href="/css/style.css">
    <script src="http://use.edgefonts.net/cabin.js"></script>  <!-- Adobe's Edgefonts script -->

	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
</head>
<body>	
    <header>
        <h1><a href='/'>$ Ticker</a></h1>
    </header>
    <nav> 
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
        <ul class="sitenav1">
            <li><a href='/posts'>Ticks</a></li>    <!-- My stream -->
            <li><a href='/posts/users'>Tickers</a></li> <!-- List of all users -->
            <li><a href='/posts/add'>Tick!</a></li> 
        </ul>
        <ul class="sitenav2">
            <li><a href='/users/profile'>Profile</a> </li>
            <li><a href='/users/logout'>Logout  </a></li>
        </ul>
        <?php endif; ?>
    </nav>
    
        <?php if(isset($content)) echo $content; ?>
    
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
<footer>© 2013 <a href='http://www.twitter.com/japanna'>@japanna</a></footer>
</html>


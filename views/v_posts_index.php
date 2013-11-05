<div id='posts'>
	<h1>Ticks</h1>	
	<?php foreach($posts as $post): ?>
	<article>
		<img id="profile_pic" src="/uploads/avatars/<?=$post['img']?>" alt="<?=$post['first_name']?> <?=$post['last_name']?>" width="60" height="60">
    	<h2>$<?=$post['ticker_name']?> <span>(<?=$post['first_name']?>)</span>
    	<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>
    	EST</time> </h2>
		<p><?=$post['content']?></p>
	</article>
	<?php endforeach; ?>
</div>
<?php foreach($posts as $post): ?>

<article>
	<img src="/uploads/avatars/<?=$post['img']?>" alt="<?=$post['first_name']?> <?=$post['last_name']?>" width="80" height="80">
    <h1><?=$post['first_name']?> <?=$post['last_name']?> posted:</h1>

    <p><?=$post['content']?></p>

    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>
    </time>

</article>

<?php endforeach; ?>
<div id='posts_users'>
    <h1>Tickers</h1>
    <div id='ticker_list'>
        <? foreach($users as $user): ?>
            <!-- Print this user's name -->
            <?= "$".$user['ticker_name']; ?> 

            <!-- If there exists a connection with this user, show a unfollow link -->
            <? if(isset($connections[$user['user_id']])): ?>
                <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

            <!-- Otherwise, show the follow link -->
            <? else: ?>
                <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
            <? endif; ?>
            <br><br>    
        <? endforeach; ?>
    </div>
</div>
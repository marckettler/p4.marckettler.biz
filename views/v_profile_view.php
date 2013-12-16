<div class="container">
    <article class="panel panel-default">
        <div class="panel-heading">
            <p class="panel-title"><strong><?=$user_profile['first_name'];?> <?=$user_profile['last_name'];?> - <?=$user_profile['email'];?></strong></p>
        </div>
        <div class="panel-body">
        <? if(isset($updated)): ?>
            <p class="text-center">
                <strong class="text-success">You have successfully updated your Profile</strong>
            </p>
        <? endif; ?>
            <p class="h4">
                Created: <?=Time::display($user_profile['created'])?><br>
                Last Log in: <?=Time::display($user_profile['last_login'])?><br>
                Last Profile Edit: <?=Time::display($user_profile['modified'])?><br>
                <a class="btn btn-sm btn-primary" href="/">Back to Dashboard</a>
            </p>
        </div>
    </article>
</div>
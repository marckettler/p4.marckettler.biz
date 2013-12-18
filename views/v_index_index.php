
<? if($user): ?>
    <p>
        Welcome to BBSB Team Manager
    </p>
    <p>
        You are logged in as <?= $user->email ?>
    </p>
<? else: ?>
    <p>
        Not Logged in.
    </p>
<? endif ?>
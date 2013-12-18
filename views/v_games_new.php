<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Start New Scorecard</div>
    <div class="panel-body">
        <p>Click on the team for which you want to start a Scorecard</p>
    </div>

    <!-- List group -->
    <div class="list-group">
        <? if($teams): ?>
            <? foreach($teams as $team): ?>
                <a href="/games/init_game/<?= $team['team_id'] ?>/<? echo urlencode($team['team_name']) ?>" class="list-group-item"><?= $team['team_name'] ?></a>
            <?php endforeach; ?>
        <? else: ?>
            <a href="/" class="list-group-item"> No valid teams. You must create at team or add players to an existing team min lineup is 9.</a>
        <? endif ?>
    </div>
</div>
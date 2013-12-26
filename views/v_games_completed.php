<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">View Complete Scorecard</div>
    <div class="panel-body">
        <p>Click on the Scorecard you wish to view</p>
    </div>

    <!-- List group -->
    <div class="list-group">
        <? if($teams): ?>
            <? foreach($teams as $team): ?>
                <div class="list-group-item">
                    <a class="btn btn-primary" href="/games/load_game/<?= $team['game_id']?>/1"><?= $team['team_name'] ?> game <?= $team['game_id']?></a>
                </div>
            <?php endforeach; ?>
        <? else: ?>
            <div class="list-group-item">
                No complete scorecards. You must <a href="/games/new_game" class="btn btn-danger">Start a Scorecard</a> or
                <a href="/games/incomplete_game" class="btn btn-danger">Continue a Scorecards</a>
            </div>
        <? endif ?>
    </div>
</div>
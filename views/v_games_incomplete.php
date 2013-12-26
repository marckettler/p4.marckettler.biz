<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Continue Incomplete Scorecard</div>
    <div class="panel-body">
        <p>Click on the team for which you want to continue a Scorecard</p>
    </div>

    <!-- List group -->
    <div class="list-group">
        <? if($teams): ?>
            <? foreach($teams as $team): ?>
                <div class="list-group-item">
                    <a class="btn btn-primary" href="/games/load_game/<?= $team['game_id']?>/0"><?= $team['team_name'] ?> game <?= $team['game_id']?></a>
                </button>
                </div>
            <?php endforeach; ?>
        <? else: ?>
            <div class="list-group-item">
                No Incomplete scorecards. You must <a href="/games/new_game" class="btn btn-danger">Start a Scorecard</a> or
                <a href="/games/completed_game" class="btn btn-danger">View Completed Scorecards</a>
            </div>
        <? endif ?>
    </div>
</div>
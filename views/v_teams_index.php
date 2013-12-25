<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">My Teams</div>
    <div class="panel-body">
        <h3>Click on a team to view team stats</h3>
    </div>

    <!-- List group -->
    <div class="list-group">
        <? foreach($teams as $team): ?>
            <p class="list-group-item"><a href="/teams/view/<?= $team['team_id'] ?>" class="btn btn-primary"><?= $team['team_name'] ?></a></p>
        <?php endforeach; ?>
    </div>
</div>
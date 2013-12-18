<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">My Teams</div>
    <div class="panel-body">
        <p>Click on a team to view and edit the roster and batting order</p>
    </div>

    <!-- List group -->
    <div class="list-group">
        <? foreach($teams as $team): ?>
            <a href="/teams/view/<?= $team['team_id'] ?>" class="list-group-item"><?= $team['team_name'] ?></a>
        <?php endforeach; ?>
    </div>
</div>
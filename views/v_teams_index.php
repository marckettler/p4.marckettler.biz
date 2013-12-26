<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">My Teams</div>
    <div class="panel-body">
        <h3>Click on a team to view team stats</h3>
    </div>

    <!-- List group -->
    <div class="list-group">
        <? if(count($teams)>0): ?>
            <? foreach($teams as $team): ?>
                <p class="list-group-item"><a href="/teams/view/<?= $team['team_id'] ?>" class="btn btn-primary"><?= $team['team_name'] ?></a></p>
            <?php endforeach; ?>
        <? else: ?>
            <p class="list-group-item"> You have no teams. <a href="/teams/create/" class="btn btn-danger">Create a Team</a></p>
        <? endif ?>
    </div>
</div>
<div class="panel">
    <div class="table-responsive">
        <table table id="playerData">
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
            <? foreach($players as $player): ?>
                <tr>
                    <td><?= $player['team_name'] ?></td>
                    <td><?= $player['player_name'] ?></td>
                </tr>
            <? endforeach ?>
            </tbody>
        </table>
    </div>
</div>
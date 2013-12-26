<div class="panel">
    <input type="hidden" id="team_id" value="<?=$team_id?>">
    <div class="panel-body">
        <h3><span class="label label-success"><?=$team_name?></span></h3>
        <? if($player_count>0): ?>
            <? if($game_count>0): ?>
                <div class="table-responsive">
                    <table id="teamData">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>S</th>
                                <th>D</th>
                                <th>T</th>
                                <th>HR</th>
                                <th>BB</th>
                                <th>IBB</th>
                                <th>HBP</th>
                                <th>R</th>
                                <th>RBIs</th>
                                <th>SB</th>
                                <th>Sac</th>
                                <th>K</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="13" class="dataTables_empty">Loading data from server</td>
                        </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Totals</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <? else: ?>
                <p>
                    You have not saved any games. <a class="btn btn-danger" href="/games/new_game">Start a Scorecard</a>
                </p>
            <? endif ?>
        <? else: ?>
            <p>
                You have not added any players to this team. <a class="btn btn-danger" href="/players/create">Create a Player</a>
            </p>
        <? endif ?>
    </div>
</div>
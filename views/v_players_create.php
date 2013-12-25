<div class="panel">
    <div class="panel-body">
        <form role="form" method="post" action="/players/p_create">
            <div class="form-group">
                <label for="playerName">Player's Display Name</label>
                <input type="text" class="form-control" name="player_name" id="playerName" placeholder="Name" required>
                <label for="teamID">Place on Roster of</label>
                <select class="form-control" name="team_id" id="teamID">
                <? foreach($teams as $team): ?>
                    <option value="<?= $team['team_id'] ?>"> <?= $team['team_name'] ?></option>
                <? endforeach ?>
                </select>
                <label for="playerNumbrt" id="playerNumberLabel">Player's Number</label>
                <input type="text" class="form-control" name="number" id="playerNumber" placeholder="Number" maxlength="2" required>
            </div>
            <? if(!isset($exists)): ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_me"> I am this player
                    </label>
                </div>
            <? endif ?>

            <button type="submit" class="btn btn-success" id="createPlayerButton">Create Player</button>
            <a class="btn btn-danger" href="/">Cancel</a>
        </form>
    </div>
</div>
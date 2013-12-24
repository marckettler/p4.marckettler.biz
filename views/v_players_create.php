<form role="form" method="post" action="/players/p_create">
    <div class="form-group">
        <label for="playerName">Player's Display Name</label>
        <input type="text" class="form-control" name="player_name" id="playerName" placeholder="Name">
        <label for="teamID">Place on Roster of</label>
        <select class="form-control" name="team_id" id="teamID">
        <? foreach($teams as $team): ?>
            <option value="<?= $team['team_id'] ?>"> <?= $team['team_name'] ?></option>
        <? endforeach ?>
        </select>
        <label for="playerNumbrt">Player's Number</label>
        <input type="text" class="form-control" name="number" id="playerNumber" placeholder="Number">
    </div>
    <? if(!isset($exists)): ?>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_me"> I am this player
            </label>
        </div>
    <? endif ?>

    <button type="submit" class="btn btn-success">Create Player</button>
</form>
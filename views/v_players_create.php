<form role="form" method="post" action="/players/p_create">
    <div class="form-group">
        <label for="playerName">Player's Display Name</label>
        <input type="text" class="form-control" name="player_name" id="playerName" placeholder="Name">
        <? if(isset($teams)): ?>
            <? if(count($teams)>0): ?>
                <label for="teamID">Place on Roster of</label>
                <select class="form-control" name="team_id" id="teamID">
                <option value="0">Create player with no team selected</option>
                <? foreach($teams as $team): ?>
                    <option value="<?= $team['team_id'] ?>"> <?= $team['team_name'] ?></option>
                <? endforeach ?>
                </select>
            <? endif ?>
            <label for="batting">Batting Order Position</label>
            <select class="form-control" name="batting" id="batting">
                <? for($i=1;$i<10;$i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <? endfor ?>
            </select>
            <label for="position">Position</label>
            <select class="form-control" name="position" id="position">
                <option value="1">Pitcher</option>
                <option value="2">Catcher</option>
                <option value="3">First Base</option>
                <option value="4">Second Base</option>
                <option value="5">Third Base</option>
                <option value="6">Shortstop</option>
                <option value="7">Left Field</option>
                <option value="8">Center Field</option>
                <option value="9">Right Field</option>
                <option value="0">Designated Hitter</option>
                <option value="10">Extra Outfielder</option>
            </select>
        <? endif ?>
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
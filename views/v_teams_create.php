<form role="form" method="post" action="/teams/p_create">
    <? if(isset($dupe)): ?>
        <h3><span class="label label-danger"><?= $team_name ?> already exists! Choose a new team name</span></h3>
    <? endif ?>
    <div class="form-group">
        <label for="teamName">Team Name</label>
        <input type="text" class="form-control" name="team_name" id="teamName" placeholder="Team Name">
    </div>
    <button type="submit" class="btn btn-success">Create Team</button>
</form>
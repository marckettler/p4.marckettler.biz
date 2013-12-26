<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Start New Scorecard</div>
    <div class="panel-body">
        <p>Click on the team for which you want to start a Scorecard</p>
    </div>

    <!-- List group -->
    <div class="list-group">
        <? if($teams): ?>
            <? foreach($teams as $team): ?>
                <div class="list-group-item">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_<?= $team['team_id']?>">
                    <? echo $team['team_name'] ?>
                </button>
                </div>
            <?php endforeach; ?>
        <? else: ?>
            <div class="list-group-item">
                No valid teams. You must <a href="/teams/create" class="btn btn-danger">Create a Team</a> or <a href="/players/create" class="btn btn-danger">Add Players</a> to an existing team.<br>
                The minimum line up for a team is 9 players.
            </div>
        <? endif ?>
    </div>
</div>
<? foreach($rosters as $roster): ?>
<!-- Modal -->
<div class="modal fade" id="modal_<?= $roster[0]['team_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Choose Line up for <?= $roster[0]['team_name']?></h4>
            </div>
            <form method="POST" action="/games/p_new_game">
            <div class="modal-body">
                    <ul id="lineup" class="pull-left lineup">
                        <li class="ui-state-default ui-state-disabled">
                            Lineup
                            <input type="hidden" name="team_id" value="<?= $roster[0]['team_id']?>">
                        </li>

                        <? foreach($roster as $player): ?>
                        <li class="ui-state-default">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            <?= $player['player_name'] ?>
                            <input type="hidden" name="players[]" value="<?= $player['player_id'] ?>">
                        </li>

                        <? endforeach; ?>
                    </ul>
                    <ul id="positions" class="pull-left positions">
                        <li class="ui-state-default ui-state-disabled">Position</li>
                        <li class="ui-state-default">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            First
                            <input type="hidden" name="positions[]" value="3">
                        </li>
                        <li class="ui-state-default">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            Second
                            <input type="hidden" name="positions[]" value="4">
                        </li>
                        <li class="ui-state-default">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            Third
                            <input type="hidden" name="positions[]" value="5">
                        </li>
                        <li class="ui-state-default">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            Shortstop
                            <input type="hidden" name="positions[]" value="6">
                        </li>
                        <li class="ui-state-default">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            LF
                            <input type="hidden" name="positions[]" value="7">
                        </li>
                        <li class="ui-state-default">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            CF
                            <input type="hidden" name="positions[]" value="8">
                        </li>
                        <li class="ui-state-default">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            RF
                            <input type="hidden" name="positions[]" value="9">
                        </li>
                        <li class="ui-state-default">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            C
                            <input type="hidden" name="positions[]" value="2">
                        </li>
                        <li class="ui-state-default">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            DH
                            <input type="hidden" name="positions[]" value="0">
                        </li>
                        <li class="ui-state-default">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            P
                            <input type="hidden" name="positions[]" value="9">
                        </li>
                    </ul>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Start Game</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<? endforeach; ?>
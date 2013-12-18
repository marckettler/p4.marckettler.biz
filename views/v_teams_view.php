<div class="table-responsive">
    <table class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th>Name</th>
                <th>Hits</th>
                <th>Singles</th>
                <th>Doubles</th>
                <th>Triples</th>
                <th>Home Runs</th>
            </tr>
        </thead>
        <tbody>
        <?  $hits_total = 0;
            $singles_total = 0;
            $doubles_total = 0;
            $triples_total = 0;
            $home_runs_total = 0;
            foreach($players as $player): ?>
            <tr>
                <td><?= $player['player_name'] ?></td>
                <td><?  $hits_total += $player['singles']+$player['doubles']+$player['triples']+$player['home_runs']; echo $player['singles']+$player['doubles']+$player['triples']+$player['home_runs']; ?></td>
                <td><? $singles_total += $player['singles']; echo $player['singles']; ?></td>
                <td><? $doubles_total += $player['doubles']; echo $player['doubles']; ?></td>
                <td><? $triples_total += $player['triples']; echo $player['triples']; ?></td>
                <td><? $home_runs_total += $player['home_runs']; echo $player['home_runs']; ?></td>
            </tr>
        <? endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td><b>Totals</b></td>
                <td><b><?= $hits_total ?></b></td>
                <td><b><?= $singles_total ?></b></td>
                <td><b><?= $doubles_total ?></b></td>
                <td><b><?= $triples_total ?></b></td>
                <td><b><?= $home_runs_total ?></b></td>
            </tr>
        </tfoot>
    </table>
</div>
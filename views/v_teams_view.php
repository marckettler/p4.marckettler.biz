<input type="hidden" id="team_id" value="<?=$team_id?>">
<h3><span class="label label-success"><?=$team_name?></span></h3>
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
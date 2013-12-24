/**
 * Created by Marc Kettler on 12/20/13.
 */

$(document).ready(function() {
    $('#teamData').dataTable( {
        "bPaginate": false,
        "bInfo": false,
        "bFilter": false,
        "bSort": false,
        "bAutoWidth": false,
        "bServerSide": true,
        "sAjaxSource": "/teams/ajax_get_player_stats/1",
        "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
            /*
             * Calculate the total market share for all browsers in this table (ie inc. outside
             * the pagination)
             */
            var singles = 0;
            var doubles = 0;
            var triples = 0;
            var homeRuns = 0;
            var bb = 0;
            var ibb = 0;
            var hbp = 0;
            var r = 0;
            var rbis = 0;
            var sb = 0;
            var sac = 0;
            var k = 0;

            for ( var i=0 ; i<aaData.length ; i++ )
            {
                singles += Number(aaData[i][1]);
                doubles += Number(aaData[i][2]);
                triples += Number(aaData[i][3]);
                homeRuns += Number(aaData[i][4]);
                bb += Number(aaData[i][5]);
                ibb += Number(aaData[i][6]);
                hbp += Number(aaData[i][7]);
                r += Number(aaData[i][8]);
                rbis += Number(aaData[i][9]);
                sb += Number(aaData[i][10]);
                sac += Number(aaData[i][11]);
                k += Number(aaData[i][12]);
            }

            /* Modify the footer row to match what we want */
            var nCells = nRow.getElementsByTagName('th');
            nCells[1].innerHTML = singles;
            nCells[2].innerHTML = doubles;
            nCells[3].innerHTML = triples;
            nCells[4].innerHTML = homeRuns;
            nCells[5].innerHTML = bb;
            nCells[6].innerHTML = ibb;
            nCells[7].innerHTML = hbp;
            nCells[8].innerHTML = r;
            nCells[9].innerHTML = rbis;
            nCells[10].innerHTML = sb;
            nCells[11].innerHTML = sac;
            nCells[12].innerHTML = k;
        }
    } );
} );
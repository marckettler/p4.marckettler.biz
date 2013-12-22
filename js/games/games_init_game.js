/**
 * Created by Marc Kettler on 12/20/13.
 */

var scoreCard;
var controlArea;

$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: '/games/load_team/'+$("#team_id")[0].value,
        beforeSend: function() {
            // Display a loading message while waiting for the ajax call to complete
            $('.next-ab').hide();
            $('.fo').hide();
            $('.go').hide();
            $('.fco').hide();
            $('.po').hide();
            $('.dp').hide();
            $('.tp').hide();
            $('.on-base').hide();
            $('.fielders-choice-out').hide();
            $('h3').hide();
        },
        success: function(response) {
            // Enject the results received from process.php into the results div
            $('.next-ab').show();
            $('.fo').show();
            $('.go').show();
            $('.fco').show();
            $('.po').show();
            $('.dp').show();
            $('.tp').show();
            $('.on-base').show();
            $('.fielders-choice-out').show();
            $('h3').show();
            var load = $('#load_game')[0].value;
            scoreCard = new ScoreCard($("#bg"),$("#fg"),$.parseJSON(response),$("#team_name")[0].value,$("#game_id")[0].value,load);
            controlArea = new ControlArea(scoreCard);
            scoreCard.controlArea = controlArea;
            if(load==1)
            {
                scoreCard.loadGame(0);
            }
        }
    }); // end ajax setup
} );
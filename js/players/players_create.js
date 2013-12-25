/**
 * Created by Marc Kettler on 12/20/13.
 */

$(document).ready(function() {
    $('#playerNumber').keyup(function(event) {
        var teamID = $('#teamID')[0].selectedOptions[0].value;
        var data = {"player_number":event.target.value,"team_id":teamID};
        $.ajax({
            type: 'POST',
            url: '/players/ajax_check_player_number/',
            data: data,
            success: function(response) {
                switch(response)
                {
                    case 'dupe':
                        $("#playerNumberLabel").text("Player Number in use choose different number");
                        $("#createPlayerButton").attr("disabled", "disabled");
                    break;
                    case 'num':
                        $("#playerNumberLabel").text("Player Number");
                        $("#createPlayerButton").removeAttr("disabled");
                    break;
                    case 'nan':
                        $("#playerNumberLabel").text("Player Number must be a number");
                        $("#createPlayerButton").attr("disabled", "disabled");
                    break;
                }
            }
        }); // end ajax setup
    });
});
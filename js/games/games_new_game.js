/**
 * Created by Marc Kettler on 12/20/13.
 * Used to set line ups and positions for a new game
 */
$(document).ready(function() {
    var lineUps = $(".lineup");
    var positions = $(".positions");
    for (var i = 0; i < lineUps.length; i++) {
        lineUps.sortable({
            axis: 'y',
            items: "li:not(.ui-state-disabled)"
        });
        positions.sortable({
            axis: 'y',
            items: "li:not(.ui-state-disabled)"
        });

    }
});


/**
 * Created by Marc Kettler on 12/20/13.
 */
$(document).ready(function() {
    var scoreCard;
    var controlArea;
    scoreCard = new ScoreCard($("#bg"),$("#fg"),9);
    controlArea = new ControlArea(scoreCard);
    scoreCard.controlArea = controlArea;
});


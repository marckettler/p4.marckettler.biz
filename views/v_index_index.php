<article class="jumbotron">
    <!-- display landing page for logged in user -->
    <? if($user): ?>
        <div>
            <h3>Welcome back <?=$user->first_name?></h3>
        </div>
    <? else: ?>
        <h3 class="text-center">
           Welcome to Baseball/Softball Team Manager
        </h3>
        <p>
            This application is designed to allow users to transpose baseball or softball scorecards
            into a computer environment that will then display player stats for the manager.<br>

            The interface also allows you to keep score on the fly while watching a game.
            While not specifically intended for "Stat Geeks" it can be used to track your favorite professional teams.<br>
        </p>
        <p>
            Inspiration for the score card notation used in this application was drawn from <br>
            <a href="http://dcortesi.home.mindspring.com/scoring/" target="_blank">Project Scoresheet</a>
            and <a href="http://www.reisnerscorekeeping.com/" target="_blank">Reisner's Scorekeeping</a>
        </p>

        <p>
            If you have an account you can  <a href="/users/login" class="btn btn-success">Log In</a>
        </p>

        <p>
            To see a demonstration version of the score card <a href="/games/demo_game" class="btn btn-primary">Click Here</a>
        </p>
    <? endif ?>
</article>

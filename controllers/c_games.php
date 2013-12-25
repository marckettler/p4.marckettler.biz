<?php
class games_controller extends base_controller
{
    /*-------------------------------------------------------------------------------------------------
    Games Controller
    -------------------------------------------------------------------------------------------------*/
    public function __construct()
	{
		parent::__construct();
	} # end constructor

    public function ajax_load_team($game_id)
    {
        $lineup = $this->get_lineup($game_id);
        echo json_encode($lineup);
    }

    public function ajax_load_game()
    {
        # get the play log of the current game
        $q = "SELECT play_log FROM games
              WHERE game_id = ".$_COOKIE['game_id'];
        $result = DB::instance(DB_NAME)->select_rows($q);
        echo json_encode($result);
    }

    public function ajax_save_play($play_log,$game_id,$message)
    {
        $qArray = Array( "play_log" => $play_log);
        DB::instance(DB_NAME)->update('games',$qArray,"WHERE game_id = $game_id");

        echo $message;
    }

    public function ajax_close_game()
    {
        @setcookie("game_id", "0", time()-3600, '/');
    }

    public function ajax_end_game()
    {
        $qArray = Array( "completed" => 1);
        $game_id = $_COOKIE['game_id'];
        DB::instance(DB_NAME)->update('games',$qArray,"WHERE game_id = $game_id");
        @setcookie("game_id", "0", time()-3600, '/');

    }

    # Render Scorecard for a new game
    # $team_id of the team you are keeping score for
    public function init_game($team_id)
    {
        if(!$this->user){
            Router::redirect("/");
        }
        $this->template->content = View::instance('v_games_game');
        //if the game is not current create a new game
        if(!isset($_COOKIE['game_id']))
        {
            die("Something is horribly wrong");
        }
        //get team name
        $q = "SELECT team_name FROM teams WHERE $team_id = team_id";
        $team = DB::instance(DB_NAME)->select_rows($q);
        $game_id = $_COOKIE['game_id'];
        $this->template->content->load_game = $game_id;
        $this->template->title = "Game $game_id";
        $this->template->scoreCard = 'true';
        $this->template->content->team_id = $team_id;
        $this->template->content->team_name = $team[0]['team_name'];
        $this->template->content->game_id = $game_id;

        $client_files_h = Array(
            '/css/scorecard.css',
            '/css/black-tie/jquery-ui-1.10.3.custom.css'
        );
        $client_files_b = Array(
            '/js/jquery-1.9.1.js',
            '/js/jquery-ui-1.10.3.custom.js',
            '/js/score-card.js',
            '/js/games/games_init_game.js'
        );
        $this->template->client_files_head = Utils::load_client_files($client_files_h);
        $this->template->client_files_body = Utils::load_client_files($client_files_b);

        echo $this->template;
    } # end init game

    # Render Scorecard for a new game
    # $team_id of the team you are keeping score for
    public function demo_game()
    {
        #Setup view
        $this->template->content = View::instance('v_games_demo');
        $this->template->title = 'New Game Info';
        $this->template->scoreCard = 'true';

        $client_files_h = Array(
            '/css/scorecard.css',
            '/css/black-tie/jquery-ui-1.10.3.custom.css'
        );
        $client_files_b = Array(
            '/js/jquery-ui-1.10.3.custom.js',
            '/js/demo-score-card.js',
            '/js/games/games_demo_game.js'
        );
        $this->template->client_files_head = Utils::load_client_files($client_files_h);
        $this->template->client_files_body = Utils::load_client_files($client_files_b);
        echo $this->template;
    } # end init game

    # Render Scorecard for a new game
    # $team_id of the team you are keeping score for
    public function new_game()
    {
        if(!$this->user){
            Router::redirect("/");
        }
        #Setup view
        $this->template->content = View::instance('v_games_new');
        $this->template->title = 'New Game Info';
        $my_teams = $this->get_my_teams();
        $valid_lineup = Array();
        $valid_teams = Array();
        foreach($my_teams as $team)
        {
            if($this->valid_lineup($team['team_id']))
            {
                $valid_lineup[] = $team;
                $valid_teams[] = $this->get_players($team['team_id']);
            }
        }

        $this->template->content->rosters = $valid_teams;
        $this->template->content->teams = $valid_lineup;

        $client_files_h = Array(
            '/css/roster.css',
            '/css/black-tie/jquery-ui-1.10.3.custom.css'
        );
        $client_files_b = Array(
            '/js/jquery-1.9.1.js',
            '/js/jquery-ui-1.10.3.custom.js',
            '/js/games/games_new_game.js'
        );

        $this->template->client_files_body = Utils::load_client_files($client_files_b);
        $this->template->client_files_head = Utils::load_client_files($client_files_h);

        echo $this->template;
    } # end view

    public function p_new_game()
    {
        if(!$this->user){
            Router::redirect("/");
        }
        extract($_POST);
        $qArray = Array( "teams_team_id" => $team_id);
        # Insert using DB function that will sanitize the input
        $game_id = DB::instance(DB_NAME)->insert('games',$qArray);
        @setcookie("game_id", $game_id, strtotime('+1 year'), '/');
        for($i = 0;$i<count($players);$i++)
        {
            $qArray = Array(
                "players_game_player_id" => $players[$i],
                "players_game_game_id" => $game_id,
                "batting" => ($i+1),
                "position" => $positions[$i],
            );
            DB::instance(DB_NAME)->insert('players_game_stats',$qArray);
        }

        Router::redirect("/games/init_game/$team_id[0]");
    }

    # private helper function
    # DB call that checks to see if a team has a valid lineup
    private function valid_lineup($team_id)
    {
        # Build the query to get all of the user's teams
        $q = "SELECT * FROM plays_for_team WHERE plays_for_team_id = ".$team_id;
        $result = DB::instance(DB_NAME)->select_rows($q);
        return count($result)>=9;

    } # end get_all_users

    # private helper function
    # DB call that returns the $team_id roster to be displayed as a table
    private function get_lineup($game_id)
    {
        # Build the query to get all of the user's teams
        $q = "SELECT player_id,player_name,number,position
              FROM players,plays_for_team,players_game_stats
              WHERE player_id = players_game_player_id
              AND players_player_id = player_id
              AND players_game_game_id = ".$game_id." ORDER BY batting ASC";
        return DB::instance(DB_NAME)->select_rows($q);

    } # end get_players

} # eoc
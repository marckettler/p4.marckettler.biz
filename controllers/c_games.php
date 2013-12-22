<?php
class games_controller extends base_controller
{
    /*-------------------------------------------------------------------------------------------------
    Games Controller
    -------------------------------------------------------------------------------------------------*/
    public function __construct()
	{
		parent::__construct();
        /*if(!$this->user){
            Router::redirect("/");
        }*/
	} # end constructor

    public function load_team($team_id)
    {
        $lineup = $this->get_players($team_id);
        echo json_encode($lineup);
    }

    public function ajax_load_game()
    {

                # Build the query to get all of the user's teams
        $q = "SELECT play_log FROM marckett_p4_marckettler_biz.games
              WHERE game_id = ".$_COOKIE['game_id'];
        $result = DB::instance(DB_NAME)->select_rows($q);
        echo json_encode($result);
    }

    public function save_play($play_log,$game_id)
    {
        $qArray = Array( "play_log" => $play_log);
        DB::instance(DB_NAME)->update('games',$qArray,"WHERE game_id = $game_id");
        echo "Game state updates";
    }
    # Render Scorecard for a new game
    # $team_id of the team you are keeping score for
    public function init_game($team_id,$team_name)
    {
        $game_id=0;
        $this->template->content = View::instance('v_games_game');
        //if the game is not current create a new game
        if(!isset($_COOKIE['game_id']))
        {
            $qArray = Array( "teams_team_id" => $team_id);
            # Insert using DB function that will sanitize the input
            $game_id = DB::instance(DB_NAME)->insert('games',$qArray);
            @setcookie("game_id", $game_id, strtotime('+1 year'), '/');
        }
        else
        {
            @setcookie("game_id", "5",strtotime('+1 year') , '/');
            $game_id = $_COOKIE['game_id'];
            $this->template->content->load_game = $game_id;
            /*
             * save for later for deleting cookie
            @setcookie("game_id", "0", time()-3600, '/');
            */
            //die("Load game should happen here but for now just unsetting cookie game_id=$game_id");
        }

        $this->template->title = "Game $game_id";
        $this->template->scoreCard = 'true';
        $this->template->content->team_id = $team_id;
        $this->template->content->team_name = $team_name;
        $this->template->content->game_id = $game_id;

        $client_files_h = Array(
            '/css/p4.css',
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
        $this->template->content = View::instance('v_games_game');
        $this->template->title = 'New Game Info';
        $this->template->scoreCard = 'true';

        $client_files_h = Array(
            '/css/p4.css',
            '/css/black-tie/jquery-ui-1.10.3.custom.css'
        );
        $client_files_b = Array(
            '/js/jquery-1.9.1.js',
            '/js/jquery-ui-1.10.3.custom.js',
            '/js/demo-score-card.js'
        );
        $this->template->client_files_head = Utils::load_client_files($client_files_h);
        $this->template->client_files_body = Utils::load_client_files($client_files_b);
        $this->template->client_files_head .= '<script> var scoreCard;
                                                        var controlArea;
                                                        function pageLoad()
                                                        {
                                                            scoreCard = new ScoreCard($("#bg"),$("#fg"),9);
                                                            controlArea = new ControlArea(scoreCard);
                                                            scoreCard.controlArea = controlArea;
                                                        }
                                              </script>';
        echo $this->template;
    } # end init game

    # Render Scorecard for a new game
    # $team_id of the team you are keeping score for
    public function new_game()
    {
        #Setup view
        $this->template->content = View::instance('v_games_new');
        $this->template->title = 'New Game Info';
        $my_teams = $this->get_my_teams();
        $valid_lineup = Array();
        foreach($my_teams as $team)
        {
            if($this->valid_lineup($team['team_id']))
            {
                $valid_lineup[] = $team;
            }
        }
        $this->template->content->teams = $valid_lineup;

        echo $this->template;
    } # end view

    # private helper function
    # DB call that checks to see if a team has a valid lineup
    private function valid_lineup($team_id)
    {
        # Build the query to get all of the user's teams
        $q = "SELECT * FROM plays_for_team WHERE teams_team_id = ".$team_id;
        $result = DB::instance(DB_NAME)->select_rows($q);
        return count($result)>=9;

    } # end get_all_users


} # eoc
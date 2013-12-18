<?php
class games_controller extends base_controller
{
    /*-------------------------------------------------------------------------------------------------
    Games Controller
    -------------------------------------------------------------------------------------------------*/
    public function __construct()
	{
		parent::__construct();
        if(!$this->user){
            Router::redirect("/");
        }
	} # end constructor

    # Render Scorecard for a new game
    # $team_id of the team you are keeping score for
    public function init_game($team_id,$team_name)
    {

        //todo add query to store game info

        #Setup view
        $this->template->content = View::instance('v_games_game');
        $this->template->title = 'New Game Info';
        $this->template->scoreCard = 'true';
        $lineup = $this->get_players($team_id);

        $client_files_h = Array(
            '/css/p4.css',
            '/css/black-tie/jquery-ui-1.10.3.custom.css'
        );
        $client_files_b = Array(
            '/js/jquery-1.9.1.js',
            '/js/jquery-ui-1.10.3.custom.js',
            '/js/score-card.js'
        );
        $this->template->client_files_head = Utils::load_client_files($client_files_h);
        $this->template->client_files_body = Utils::load_client_files($client_files_b);
        $this->template->client_files_head .= '<script> var scoreCard;
                                                        var controlArea;
                                                        function pageLoad()
                                                        {
                                                            scoreCard = new ScoreCard($("#bg"),$("#fg"),'.json_encode($lineup).',"'.urldecode($team_name).'");
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

        //todo add query to store game info

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
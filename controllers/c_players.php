<?php
class players_controller extends base_controller
{
    /*-------------------------------------------------------------------------------------------------
     Users Controller
     -------------------------------------------------------------------------------------------------*/
	public function __construct()
	{
		parent::__construct();
        if(!$this->user){
            Router::redirect("/");
        }
	} # end constructor

    # Create Player Page
    public function create()
    {
        #Setup view
        $this->template->content = View::instance('v_players_create');
        $this->template->title = 'Create a Player';

        $q = "SELECT * FROM players WHERE users_user_id =".$this->user->user_id;
        $playerExists = DB::instance(DB_NAME)->query($q);

        if($playerExists->num_rows)
        {
            $this->template->content->exists = true;
        }

        # Get teams of the currently logged in user
        $teams = $this->get_my_teams();
        $this->template->content->teams = $teams;

        echo $this->template;
    } # end create

    public function p_create()
    {
        # Clean input
        $_POST['player_name'] = $this->stop_xss($_POST['player_name']);
        # check to see if the current user is this player
        if(isset($_POST['is_me']))
        {
            $_POST['users_user_id'] = $this->user->user_id;
            unset($_POST['is_me']);
        }
        #save and unset team_id, batting, and position for adding to a team
        $team_id = $_POST['team_id'];
        $number = $_POST['number'];
        unset($_POST['team_id']);
        unset($_POST['number']);
        # Insert new player
        $player_id = DB::instance(DB_NAME)->insert('players',$_POST);
        #clean post so it can be reused for team info
        unset($_POST);
        #add to a team if a team was selected
        if($team_id!=0)
        {
            $_POST['players_player_id'] = $player_id;
            $_POST['teams_team_id'] = $team_id;
            $_POST['number'] = $number;
            DB::instance(DB_NAME)->insert('plays_for_team',$_POST);
        }

        Router::redirect('/players/create/');
    } # end create

    public function ajax_update_player()
    {
        $player_id = $_POST['player_id'];
        $game_id = $_COOKIE['game_id'];
        $player_name = $_POST['name'];
        unset($_POST['player_id']);
        unset($_POST['name']);
        unset($_POST['number']);
        DB::instance(DB_NAME)->update('players_game_stats',$_POST,"WHERE players_game_player_id = $player_id AND players_game_game_id = $game_id");
        echo "Stats for $player_name have been saved";
    }

    public function view_all()
    {
        #Setup view
        $this->template->content = View::instance('v_players_view_all');
        $this->template->title = 'View all Players';

        $q = "SELECT team_name,player_name
              FROM players, plays_for_team, teams
              WHERE player_id = players_player_id
              AND team_id = teams_team_id
              AND managers_user_id = ".$this->user->user_id;

        # Get teams of the currently logged in user
        $players = DB::instance(DB_NAME)->select_rows($q);
        $this->template->content->players = $players;

        echo $this->template;
    }
} # eoc
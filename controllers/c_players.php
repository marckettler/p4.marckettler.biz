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
        $batting = $_POST['batting'];
        $position = $_POST['position'];
        unset($_POST['team_id']);
        unset($_POST['batting']);
        unset($_POST['position']);
        # Insert new player
        $player_id = DB::instance(DB_NAME)->insert('players',$_POST);
        #clean post so it can be reused for team info
        unset($_POST);
        #add to a team if a team was selected
        if($team_id!=0)
        {
            $_POST['players_player_id'] = $player_id;
            $_POST['teams_team_id'] = $team_id;
            $_POST['batting'] = $batting;
            $_POST['position'] = $position;
            DB::instance(DB_NAME)->insert('plays_for_team',$_POST);
        }

        Router::redirect('/players/create/');
    } # end create

    # private helper function
    # DB call that returns the current user's teams or
    private function get_my_teams()
    {
        # Build the query to get all of the user's teams
        $q = "SELECT * FROM teams WHERE managers_user_id =".$this->user->user_id;
        return DB::instance(DB_NAME)->select_rows($q);

    } # end get_all_users

} # eoc
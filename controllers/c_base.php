<?php

class base_controller {
	
	public $user;
	public $userObj;
	public $template;
	public $email_template;

	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
						
		# Instantiate User obj
			$this->userObj = new User();
			
		# Authenticate / load user
			$this->user = $this->userObj->authenticate();					
						
		# Set up templates
			$this->template 	  = View::instance('_v_template');
			$this->email_template = View::instance('_v_email');			
								
		# So we can use $user in views			
			$this->template->set_global('user', $this->user);
			
	}

    # Method to clean inputs that include XSS Attacks
    protected function stop_xss($input)
    {
        # Probably need to do more than this
        return strip_tags($input);
    } # End stop_xss

    # private helper function
    # DB call that returns the $team_id roster to be displayed as a table
    protected function get_players($team_id)
    {
        # Build the query to get all of the user's teams
        $q = "SELECT player_id,player_name , team_name , team_id
              FROM players,plays_for_team,teams
              WHERE player_id = players_player_id
              AND team_id = plays_for_team_id
              AND team_id = ".$team_id." ORDER BY player_id ASC";
        return DB::instance(DB_NAME)->select_rows($q);

    } # end get_players

    # private helper function
    # DB call that returns the $team_id roster to be displayed as a table
    protected function get_players_stats($team_id)
    {
        # Build the query to get all of the user's teams
        $q = "SELECT player_name, sum(singles) as singles,
	        sum(doubles) as doubles,sum(triples) as triples,
            sum(home_runs) as home_runs,sum(walks) as walks,
            sum(intentional_walks) as intentional_walks,
            sum(hit_by_pitch) as hit_by_pitch,sum(runs) as runs,
            sum(rbis) as rbis,sum(stolen_bases) as stolen_bases,
            sum(sacrifice) as sacrifice,sum(strikeouts) as strikeouts
            FROM players, plays_for_team , players_game_stats, games , teams
            WHERE player_id = players_player_id
            AND player_id = players_game_player_id
            AND teams_team_id = plays_for_team_id
            AND team_id = plays_for_team_id
            AND game_id = players_game_game_id
            AND team_id = $team_id
            GROUP BY player_id";
        return DB::instance(DB_NAME)->select_rows($q);

    } # end get_players
    # private helper function
    # DB call that returns the current user's teams or
    protected function get_my_teams()
    {
        # Build the query to get all of the user's teams
        $q = "SELECT * FROM teams WHERE managers_user_id =".$this->user->user_id;
        return DB::instance(DB_NAME)->select_rows($q);

    } # end get_all_users

} # eoc

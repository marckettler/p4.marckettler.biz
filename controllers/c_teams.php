<?php
class teams_controller extends base_controller
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

    # Index
	public function index()
	{
        #Setup view
        $this->template->content = View::instance('v_teams_index');
        $this->template->title = 'My Teams';

        # Get teams of the currently logged in user
        $teams = $this->get_my_teams();
        $this->template->content->teams = $teams;

        echo $this->template;
	} # end logout

    # Create Team Page
    public function create($dupe=null,$team_name=NULL)
    {
        #Setup view
        $this->template->content = View::instance('v_teams_create');
        $this->template->title = 'Create a Team';
        if(isset($dupe))
        {
            $this->template->content->dupe = $dupe;
            $this->template->content->team_name = urldecode($team_name);
        }

        echo $this->template;
    } # end create

    public function p_create()
    {
        # Clean input
        $_POST['team_name'] = $this->stop_xss($_POST['team_name']);
        # Associate this team with current user
        $_POST['managers_user_id'] = $this->user->user_id;
        # Insert using DB function that will sanitize the input
        $team_name = $_POST['team_name'];
        $q = "SELECT * FROM teams WHERE team_name='$team_name'";

        if(count(DB::instance(DB_NAME)->select_rows($q))==0)
        {
            DB::instance(DB_NAME)->insert('teams',$_POST);
        }
        else
        {
            Router::redirect("/teams/create/dupe/".urlencode($team_name));
        }

        Router::redirect('/teams/index/');
    } # end create

    public function view($team_id)
    {
        # Build the query to get all of the user's teams
        $q = "SELECT team_name
              FROM teams
              WHERE team_id = ".$team_id;
        $result = DB::instance(DB_NAME)->select_rows($q);
        #Setup view
        $this->template->content = View::instance('v_teams_view');
        $this->template->title = $result[0]['team_name'];
        $this->template->content->team_name = $result[0]['team_name'];
        $this->template->content->team_id = $team_id;
        #Load dataTables css
        $client_files_head = Array(
            "/css/jquery.dataTables.css"
        );

        $this->template->client_files_head = Utils::load_client_files($client_files_head);


        # Load JS files
        $client_files_body = Array(
            "/js/jquery.dataTables.js",
            "/js/teams/teams_view.js"
        );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        echo $this->template;
    }

    public function ajax_get_player_stats($team_id)
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
        $result = DB::instance(DB_NAME)->select_rows($q);
        $output['aaData'] = Array();
        $aColumns = array( 'player_name', 'singles', 'doubles', 'triples', 'home_runs', 'walks', 'intentional_walks', 'hit_by_pitch', 'runs', 'rbis', 'stolen_bases', 'sacrifice', 'strikeouts');
        foreach($result as $aRow)
        {
            $row = array();
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $row[] = $aRow[ $aColumns[$i] ];
            }
            $output['aaData'][] = $row;
        }
        echo json_encode($output);

    } # end get_players

} # eoc
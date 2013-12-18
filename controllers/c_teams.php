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
    public function create()
    {
        #Setup view
        $this->template->content = View::instance('v_teams_create');
        $this->template->title = 'Create a Team';

        echo $this->template;
    } # end create

    public function p_create()
    {
        # Clean input
        $_POST['team_name'] = $this->stop_xss($_POST['team_name']);
        # Associate this team with current user
        $_POST['managers_user_id'] = $this->user->user_id;
        # Insert using DB function that will sanitize the input
        DB::instance(DB_NAME)->insert('teams',$_POST);

        Router::redirect('/teams/index/');
    } # end create

    public function view($team_id)
    {
        #Setup view
        $this->template->content = View::instance('v_teams_view');
        $this->template->title = 'Create a Team';
        $players = $this->get_players_stats($team_id);
        $this->template->content->players = $players;
        echo $this->template;
    }

} # eoc
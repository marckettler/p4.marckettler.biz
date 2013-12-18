<?php
class users_controller extends base_controller
{
    /*-------------------------------------------------------------------------------------------------
     Users Controller
     -------------------------------------------------------------------------------------------------*/
	public function __construct()
	{
		parent::__construct();
	} # end constructor

	# Render Sign up page
	public function create()
	{
        # Non-Members Only
        if($this->user)
        {
            Router::redirect("/");
        }
		# Setup view
		$this->template->content = View::instance('v_users_create');
		$this->template->title   = "Create Account";
        # Add common form inputs
        $this->template->content->common_form_inputs = View::instance("v_common_form_inputs");
		# Render template
		echo $this->template;	
	} #end create user

    # Process Create User
	public function p_create()
	{
        $_POST['first_name'] = $this->stop_xss($_POST['first_name']);
        $_POST['last_name'] = $this->stop_xss($_POST['last_name']);
        # User Object performs signup and sanitizes input will redirect on error
        $this->user = $this->userObj->signup($_POST);
        # Makes sure the user is logged in
        $this->userObj->login($_POST["email"],$_POST["password"]);
        # Sign up complete forward to profile page
        Router::redirect("/");
	} #end create user post

    # Render Log In Page
	public function login($error = NULL)
	{
        # If logged in goto index
        if($this->user)
        {
            Router::redirect("/");
        }
		# Setup view
		$this->template->content = View::instance("v_users_login");
		$this->template->title   = "Log In";
        if($error=="error")
        {
            $this->template->content->error = $error;
        }
        $this->template->content->common_form_inputs = View::instance("v_common_form_inputs");
		echo $this->template;
	} #end login

    # Process login
	public function p_login()
	{	
		# Check to see if User is in the database login method will sanitize inputs
		$user_token = $this->userObj->login($_POST['email'],$_POST['password']);
		
		if($user_token)
		{
			Router::redirect("/");
		}
		else
		{	
			# Invalid login attempt redirect to login page with error flag
			Router::redirect("/users/login/error");
		}		
	} # end login post	

    # Logout
	public function logout()
	{
		#Log the current user out
		$this->userObj->logout($this->user->email);
		#Redirect to index
		Router::redirect('/');
	} # end logout

    # private helper function
    # DB call that gets all users
    private function get_all_users()
    {
        # Build the query to get all the users
        $q = "SELECT * FROM users";
        return DB::instance(DB_NAME)->select_rows($q);

    } # end get_all_users
} # eoc
<?php
class profile_controller extends base_controller
{
    /*-------------------------------------------------------------------------------------------------
    Profile Controller
    -------------------------------------------------------------------------------------------------*/
    public function __construct()
	{
		parent::__construct();
        if(!$this->user){
            Router::redirect("/");
        }
	} # end constructor

    # Render /profile/view
    # $param used as updated flag
    # or the user_id of the profile to view
    public function view($param = NULL)
    {

        $q = "SELECT * FROM users WHERE user_id=".(is_numeric($param) ? $param : $this->user->user_id);
        $user = DB::instance(DB_NAME)->select_row($q);

        #Setup view
        $this->template->content = View::instance('v_profile_view');
        $this->template->title = "Profile of ".$user['first_name'];
        $this->template->content->user_profile = $user;
        if($param=="updated")
        {
            $this->template->content->updated = $param;
        }
        echo $this->template;
    } # end view

    # Render /posts/edit
    # $email_error is a flag that detects if there was an error updated the profile
    public function edit($email_error = NULL)
    {
        #Setup view
        $this->template->content = View::instance('v_profile_edit');
        $this->template->title = "Profile of ".$this->user->first_name;
        if($email_error=="email_error")
        {
            $this->template->content->email_error = $email_error;
        }
        echo $this->template;
    } # end edit

    # Process edit profile form
    public function p_edit()
    {
        # simplify if statements with these variables
        $email_unchanged = $this->user->email == $_POST["email"];
        $first_name_unchanged = $this->user->first_name == $_POST["first_name"];
        $last_name_unchanged = $this->user->last_name == $_POST["last_name"];
        $email_unique = $this->userObj->confirm_unique_email($_POST["email"]);

        # check to see if email is unchanged or unique
        if( $email_unchanged || $email_unique)
        {
            # Email valid now check to if they changed something
            if($email_unchanged && $first_name_unchanged && $last_name_unchanged)
            {
                # If nothing has changed redirect to redirect to view profile
                Router::redirect("/profile/view");
            }

            # set up query to update user
            $_POST["modified"] = Time::now();
            $cond = "WHERE user_id=".$this->user->user_id;
            DB::instance(DB_NAME)->update("users",$_POST,$cond);
            Router::redirect("/profile/view/updated");
        }
        else
        {
            # redirect with error flag
            Router::redirect("/profile/edit/email_error");
        }
    } # end p_edit
} # eoc
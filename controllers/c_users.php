<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        
    } 

    public function signup($error = NULL, $source = NULL) {

        # Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = "Sign Up";

            # Pass data to the view
            $this->template->content->source = $source;

        # Render template
            echo $this->template;

    }

    public function p_signup() {
        # Make sure user can't access /users/p_signup/ without submitting the form
        if(empty($_POST['email'])) {
            die("Members only. <a href='/'>Back</a>");
        }

        # If they weren't redirected away, continue:

        # Make sure that all of the form fields are filled out (also done client side)
        if(ctype_space($_POST['email']) OR ctype_space($_POST['password'])
            OR ctype_space($_POST['first_name']) OR ctype_space($_POST['ticker_name'])) {
            # If any of the fields are empty, display error message
            Router::redirect("/users/signup/error/empty"); 
        } else {
        # Make sure that the provided email is not already in database
            
            # Search the db for this email 
            # Retrieve if exists
            $q = "SELECT email 
            FROM users 
            WHERE email = '".$_POST['email']."'";

            $email = DB::instance(DB_NAME)->select_field($q);

        # If we didn't find this email in the database, sign up
        if(!$email) {

        # Store the time that the account was created and modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Encrypt the password  
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Create an encrypted token via their email address and a random string
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        # Insert user into database
        # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
        $user_id = DB::instance(DB_NAME)->insert('users', $_POST); 
        
         # User is automatically logged in after signing up
        setcookie("token", $_POST['token'], strtotime('+4 weeks'), '/');

        # send signup confirmation email (+1 feature #1) 
            $to[] = Array("name" => $_POST['first_name'], "email" => $_POST['email']);
            $from = Array("name" => APP_NAME, "email" => APP_EMAIL);
            $subject = $_POST['first_name']." just signed up for Ticker!";
            $body = "Hi, ". $_POST['first_name'].".  Welcome to Ticker!";
            $cc  = "";
            $bcc = "";
            $email = Email::send($to, $from, $subject, $body, false, $cc, $bcc);

        # Make them follow themselves by default (the follow function will redirect to list of other users to follow)
        Router::redirect("/posts/follow/$user_id");

        } else {
            Router::redirect("/users/signup/error/email"); 
        }
        }
    }

    public function login($error = NULL, $source = NULL) {
        # If user is already logged in; redirect them to the login page
        if($this->user) {
            Router::redirect('/posts');
        }

        # If they weren't redirected away, continue:

        # Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

        # Pass data to the view
        $this->template->content->source = $source;
        
        # Render template
        echo $this->template;

    }

    public function p_login() {
        # Make sure user can't access /users/p_login/ without submitting the form
        if(empty($_POST['email'])) {
            die("Members only. <a href='/'>Back</a>");
        }

        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Retrieve the token if it's available
        $q = "SELECT token 
            FROM users 
            WHERE email = '".$_POST['email']."' 
            AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

        # If we didn't find a matching token in the database, it means login failed either by email or password
        if(!$token) {
            
            # Retrieve email if it's available
            $q_email = "SELECT email 
            FROM users 
            WHERE email = '".$_POST['email']."'"; 
        
            $email = DB::instance(DB_NAME)->select_field($q_email);

            # If email was not found, display an email error message
            if(!$email) {
                Router::redirect("/users/login/error/Email"); 
            # Else it was a password error, display a password error message    
            } else {
                Router::redirect("/users/login/error/Password");
            }

        # But if we did, login succeeded! 
        } else {
            # Store the time of this login in "last login"
            $data = Array("last_login" => Time::now());
        
            # Insert time of last login
            DB::instance(DB_NAME)->update("users", $data, "WHERE token = '$token'");
            
            /* 
            Store this token in a cookie using setcookie()
            Important Note: *Nothing* else can echo to the page before setcookie is called
            Not even one single white space.
            param 1 = name of the cookie
            param 2 = the value of the cookie
            param 3 = when to expire
            param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
            */
            setcookie("token", $token, strtotime('+4 weeks'), '/');

            # Send them to their feed
            Router::redirect("/posts");

        }

    }

    public function logout() {

    # Generate and save a new token for next login
    $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

    # Create the data array we'll use with the update method
    # In this case, we're only updating one field, so our array only has one entry
    $data = Array("token" => $new_token);

    # Do the update
    DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

    # Delete their token cookie by setting it to a date in the past - effectively logging them out
    setcookie("token", "", strtotime('-1 year'), '/');

    # Send them back to the main index.
    Router::redirect("/");

}

    public function profile($user_profile = NULL) {

        # If user is blank, they're not logged in; redirect them to the login page
        if(!$this->user) {
            Router::redirect('/');
        }

        # If they weren't redirected away, continue:

        # Setup view
        $this->template->content = View::instance('v_users_profile');
        $this->template->title   = $this->user->first_name."'s profile";
        
        # Render template
        echo $this->template;
    }

    public function p_upload() {

        $data = Array("img" => $this->user->user_id.".jpg", "modified" => Time::now());
        DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");

        # Upload profile image
        Upload::upload($_FILES, "/uploads/avatars/", array("jpg"), $this->user->user_id);

        # Send them back to profile site
        Router::redirect('/users/profile');
    }

} # end of the class
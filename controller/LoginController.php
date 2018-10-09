<?php

class LoginController {
    private $loginView;

    public function __construct() {

        $this->loginView = new LoginView();

    }
    // IF IS tryingto Login

    public function Login(){


       $credentials = $this->loginView->getCredentialsInForm();
        // Change correct credentials to database query.
       if ($credentials->username == $this->loginView->correctCredentials->username &&
           $credentials->password == $this->loginView->correctCredentials->password) {
           $_SESSION['username'] = $credentials->username;
           $_SESSION['password'] = $credentials->password;
   
           if($this->loginView->keepMeLoggedIn()) {
               $this->setCookieLife();
   
               echo $_COOKIE[$cookie];
           }
        }    
    }

    // public function setCookieLife()
    // {   
    //     $cookie = 'user';
    //     setcookie($cookie, rand(1, 100000), time() + (86400 * 30));
    // }
}
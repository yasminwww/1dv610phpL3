<?php

class LoginController {
    private $loginView;

    public function __construct() {

        $this->loginView = new LoginView();

    }
    // IF IS tryingto Login

    public function Login(){


       $credentials = $this->loginView->getCredentialsInForm();
   
       if ($credentials->username == $this->loginView->correctCredentials->username &&
           $credentials->password == $this->loginView->correctCredentials->password) {
           $_SESSION['username'] = $credentials->username;
           $_SESSION['password'] = $credentials->password;
   
           if($this->loginView->keepMeLoggedIn()) {
                   // echo "hejj";
               $this->setCookieLife();
   
               echo $_COOKIE[$cookie];
           }
        }    
    }
}
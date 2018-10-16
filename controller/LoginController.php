<?php

// class LoginController {
//     private $loginView;

//     public function __construct() {

//         $this->loginView = new LoginView();
//         $this->database = new Database();

//     }
//     // IF IS tryingto Login

//     public function Login(){


//        $credentials = $this->loginView->getCredentialsInForm();
//         // Change correct credentials to database query.
//         $username = $credentials->username;
//         $password = $credentials->password;
//        if ($this->database->getUserFromDatabase($username, $password)) {
          

//             $_SESSION['username'] = $credentials->username;
//             $_SESSION['password'] = $credentials->password;
//         }    
//     }

//     // public function isAuthorised() : bool
// 	// {
//     //     $username = $_SESSION['username'];
//     //     $password = $_SESSION['password'];

//     //     return isset($username) && isset($password) &&  
//     //            $this->database->getUserFromDatabase($username, $password) == true;
// 	// }

// }
<?php
// class RegisterController
// {

//     private $database;
    


//     public function __construct()
//     {
//         $this->database = new Database();
//         $this->registerView = new RegisterView();
//         $this->lv = new LoginView();


//     }

//     public function registerUser()
//     {
//         if($this->registerView->isTryingToSignup()) {

//             $credentials = $this->registerView->getCredentialsInRegisterForm();
//         }
//         // debug_print_backtrace();
//         if ($this->registerView->isUserValid()) {
//             // Check is user already exists.
//             if($this->database->getUserFromDatabase($credentials->username, $credentials->password)) {
//                 // return
//             }
//             // Save user to database.
//             $this->database->saveUser($credentials->username, $credentials->password);
//         }
//     }
    
// }

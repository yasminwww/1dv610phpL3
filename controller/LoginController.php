<?php

class LoginController {
    private $database;
    private $loginView;

    public function __construct(Database $db, LoginView $lv) {

        $this->database = $db;
        $this->loginView = $lv;
    }


    public function login() {
        $credentials = $this->loginView->getCredentialsInForm();
        $username = $credentials->getUsername();
        $password = $credentials->getPassword();

        if($this->loginView->isTryingToLogin()) {
        if (!$this->database->isCorrectPasswordForUsername($username, $password)) {
                return false;
            } else {
                $_SESSION['username'] = $credentials->getUsername();
                $_SESSION['password'] = $credentials->getPassword();
                $this->loginView->setMessage($this->loginView->welcomeMessage());
                return true;
            }
        }  
    }
}
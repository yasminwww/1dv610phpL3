<?php

class LoginController {



    private $database;
    private $loginView;
    private $validation;
    private $session;

    public function __construct(Database $db, LoginView $lv, InputValidation $iv, SessionModel $sm) {

        $this->database = $db;
        $this->loginView = $lv;
        $this->validation = $iv;
        $this->session = $sm;

    }


    public function login() {
        $credentials = $this->loginView->getCredentialsInForm();

        $this->loginView->setMessage($this->validation->validationMessageLogin($credentials));

        $username = $credentials->getUsername();
        $password = $credentials->getPassword();

        if($this->loginView->isTryingToLogin()) {
        if (!$this->database->isCorrectPasswordForUsername($username, $password)) {
            return false;
        } else {
           $this->session->saveSessionUsername($credentials->getUsername());
           $this->session->saveSessionPassword($credentials->getPassword());
            $this->loginView->setMessage($this->loginView->welcomeMessage());
            return true;
        }
       } 
    }
}
<?php
class RegisterController
{

    private $database;
    


    public function __construct()
    {
        $this->database = new Database();
        $this->registerView = new RegisterView();

    }

    public function registerUser()
    {
        if($this->registerView->isTryingToSignup()) {

            $credentials = $this->registerView->getCredentialsInRegisterForm();
        }
        // debug_print_backtrace();
        if ($this->registerView->isUserValid()) {
            
            // Save user to database.
            $this->database->saveUser($credentials->username, $credentials->password);
        }
    }
}

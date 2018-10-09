<?php
class RegisterController
{

    private $database;

    public function __construct()
    {
        $this->database;
        $this->registerView = new RegisterView();
    }

    public function registerUser()
    {

        $credentials = $this->registerView->getCredentialsInRegisterForm();
        // debug_print_backtrace();
        if ($credentials->username >= 3 && $credentials->password >= 6) {
            $_SESSION['username'] = $credentials->username;
            $_SESSION['password'] = $credentials->password;

        }
    }
}

<?php
class RegisterController
{

    private $database;
    private $loginView;
    private $validation;
    private $registerView;

    


    public function __construct(Database $db, RegisterView $rv, LoginView $lv, InputValidation $iv)
    {
        $this->database     = $db;
        $this->loginView    = $rv;
        $this->validation   = $iv;
        $this->registerView = $rv;
    }

    public function registerUser() {
        $credentials = $this->registerView->getCredentialsInForm();
        $passwordRepeat = $this->registerView->getRequestPasswordRepeatFromRegistration();
        $message = $this->validation->validationMessageRegister($credentials, $passwordRepeat);

        if ($this->registerView->isTryingToSignup()) {
                $this->registerView->setMessage($message);
            if ($this->validation->isMessageForValidatedUser($message)) {
                $this->loginView->setMessage($message);
                $this->database->saveUser($credentials->getUsername(), md5($credentials->getPassword()));
                return true;
            } else {
                return false;
            }
        }
    }
    
}

<?php


class MainController {

    private $layoutView;
    private $loginView;
    private $timeView;
    private $registerView;

    // private $registerController;
    // private $loginController;

    private $database;
    private $credentials;
    private $validation;


    public function __construct(LayoutView $v, Database $db, LoginView $lv, RegisterView $rv) {
        $this->layoutView   = $v;
        $this->loginView    = $lv;
        $this->registerView = $rv;
        $this->database     = $db;
        $this->validation   = new InputValidation();
        $this->timeView     = new DateTimeView();
    }

    public function runLoginOrRegister() {
        if ($this->loginView->isLoggingOut($this->validation->isAuthorised())) {
                $this->killSession();
                $this->loginView->setMessage($this->loginView->logoutMessage());
                $this->layoutView->render(false, $this->loginView, $this->timeView);
                return;
        } else if ($this->loginView->isNavigatingToRegistration()) {

            if($this->registerUser()) {
                return $this->layoutView->render(false, $this->loginView, $this->timeView);
            } else {
                return $this->layoutView->render(false, $this->registerView, $this->timeView);
            }
        } else if ($this->loginView->isTryingToLogin()) {
            $this->loginView->setMessage($this->validation->validationMessageLogin($this->loginView->getCredentialsInForm()));
            $this->login();
        }
            // Default view
            $this->renderHTML($this->loginView);
    }


    private function renderHTML($view) {
        $this->layoutView->render($this->validation->isAuthorised(), $view, $this->timeView);
    }


    public function killSession() {
        session_destroy();
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

     public function registerUser() {
        $credentials = $this->registerView->getCredentialsInForm();
        $passwordRepeat = $this->registerView->getRequestPasswordRepeatFromRegistration();
        $message = $this->validation->validationMessageRegister($credentials, $passwordRepeat);

        if ($this->registerView->isTryingToSignup()) {
                $this->registerView->setMessage($message);
            if ($this->validation->isMessageForValidatedUser($message)) {
                  $this->loginView->setMessage($message);
                  $this->database->saveUser($credentials->getUsername(), $credentials->getPassword());
                return true;
            } else {
                return false;
            }
        }
    }
}

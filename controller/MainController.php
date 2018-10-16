<?php


class MainController
{

    private $layoutView;
    private $loginView;
    private $timeView;

    private $registerView;

    // private $registerController;
    // private $loginController;

    private $database;

    private $credentials;



    public function __construct() {
        $this->layoutView = new LayoutView();
        $this->loginView = new LoginView();
        $this->timeView = new DateTimeView();
        $this->registerView = new RegisterView();
        $this->database = new Database();

        $this->credentials = $this->registerView->getCredentialsInRegisterForm();



        // $this->registerController = new RegisterController();
        // $this->loginController = new LoginController();

    }

    public function runLoginOrRegister() {

        if($this->loginView->isNavigatingToRegistration()) {
              $this->registerUser();
            //   if(!$this->registerView->isUserValid()){}
            $this->layoutView->render($this->loginView->isAuthorised(), $this->registerView, $this->timeView);
            return;


        } else if ($this->loginView->isTryingToLogin()) {
            $this->Login();
            $this->loginView->setMessage($this->loginView->welcomeMessage());

        } else if ($this->loginView->isLoggingOut()) {
            $this->killSession();
            $this->loginView->setMessage($this->loginView->logoutMessage());
            $this->layoutView->render(false, $this->loginView, $this->timeView);
            return;
        }
            // Default
            $this->renderHTML($this->loginView);

    }


    public function Login() {
        $credentials = $this->loginView->getCredentialsInForm();
        echo $credentials->username;
         // Change correct credentials to database query.
         $username = $credentials->username;
         $password = $credentials->password;
         
        if ($this->database->getUserFromDatabase($username, $password)) {
           
             $_SESSION['username'] = $credentials->username;
             $_SESSION['password'] = $credentials->password;
         }    
        //  $this->renderHTML($this->loginView);

     }

     public function registerUser() {
         if($this->registerView->isTryingToSignup()) {
            
            // $credentials = $this->registerView->getCredentialsInRegisterForm();

            $this->registerView->setMessage($this->registerView->validationMessageRegister());
         }
         
         // debug_print_backtrace();
         if ($this->registerView->isUserValid()) {
             // Check is user already exists.
             if($this->checkUsername() == true) {
                 echo 'user finns';
                $this->loginView->setMessage($this->registerView->validationMessageRegister());
                // Save user to database.
                $this->database->saveUser($this->credentials->username, $this->credentials->password);
            } else {
                echo 'user finns inte';
            }
            $this->renderHTML($this->loginView);
     }
    }

     private function renderHTML($view) {
        $this->layoutView->render($this->loginView->isAuthorised(), $view, $this->timeView);
    }

    public function killSession() {
        session_destroy();
    }
}




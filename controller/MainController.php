<?php


class MainController
{

    private $layoutView;
    private $loginView;
    private $timeView;

    private $registerView;

    private $registerController;
    private $loginController;





    public function __construct() {
        $this->layoutView = new LayoutView();
        $this->loginView = new LoginView();
        $this->timeView = new DateTimeView();
        $this->registerView = new RegisterView();

        $this->registerController = new RegisterController();
        $this->loginController = new LoginController();

    }

    public function run() {

        if ($this->registerView->isTryingToSignup()) {

          $this->registerController->registerUser();


        } else if ($this->loginView->isTryingToLogin()) {
            // skicka till login controller
            $this->loginController->Login();
            // $credentials = $this->loginView->getCredentialsInForm();

            // if ($credentials->username == $this->loginView->correctCredentials->username &&
            //     $credentials->password == $this->loginView->correctCredentials->password) {
            //     $_SESSION['username'] = $credentials->username;
            //     $_SESSION['password'] = $credentials->password;

            //     if($this->loginView->keepMeLoggedIn()) {
            //             // echo "hejj";
            //         $this->setCookieLife();

            //         echo $_COOKIE[$cookie];
            //     }
                // $_SESSION['message'] = 'Welcome';
                // echo $_SESSION['username'];

            // }
            // }
        } else if ($this->loginView->isLoggingOut()) {
            $this->killSession();
            $this->layoutView->render(false, $this->loginView, $this->timeView);
            return;
        }


        $this->renderHTML();
    }

    private function renderHTML() {
        $this->layoutView->render($this->loginView->isAuthorised(), $this->loginView, $this->timeView);
    }

    public function killSession() {
        session_destroy();
    }

    // public function setCookieLife()
    // {   
    //     $cookie = 'user';
    //     setcookie($cookie, rand(1, 100000), time() + (86400 * 30));
    // }
}




<?php


class MainController
{

    private $layoutView;
    private $loginView;
    private $timeView;

    // private $registerView;


    private $database;


    public function __construct()
    {
        $this->layoutView = new LayoutView();
        $this->loginView = new LoginView();
        $this->timeView = new DateTimeView();

        // $this->registerView = new RegisterView();

    }

    public function run()
    {
        // if($this->loginView->isNavigatingToRegistration()) {
        if ($this->loginView->isTryingToSignup()) {
            $credentials = $this->loginView->getCredentialsInRegisterForm();
                // debug_print_backtrace();
            if ($credentials->username >= 3 && $credentials->password >= 6) {
                $_SESSION['username'] = $credentials->username;
                $_SESSION['password'] = $credentials->password;
                    //echo $_SESSION['username'];
            }
        // }



        } else if ($this->loginView->isTryingToLogin()) {

            $credentials = $this->loginView->getCredentialsInForm();

            if ($credentials->username == $this->loginView->correctCredentials->username &&
                $credentials->password == $this->loginView->correctCredentials->password) {
                $_SESSION['username'] = $credentials->username;
                $_SESSION['password'] = $credentials->password;

                if($this->loginView->keepMeLoggedIn()) {
                        // echo "hejj";
                    $this->setCookieLife();

                    echo $_COOKIE[$cookie];
                }
                // $_SESSION['message'] = 'Welcome';
                // echo $_SESSION['username'];

            // }
            }
        } else if ($this->loginView->isLoggingOut()) {
            $this->killSession();
            $this->layoutView->render(false, $this->loginView, $this->timeView);
            return;
        }


        $this->renderHTML();
    }

    private function renderHTML()
    {
        $this->layoutView->render($this->loginView->isAuthorised(), $this->loginView, $this->timeView);
    }

    public function killSession()
    {
        session_destroy();
    }

    // public function setCookieLife()
    // {   
    //     $cookie = 'user';
    //     setcookie($cookie, rand(1, 100000), time() + (86400 * 30));
    // }
}




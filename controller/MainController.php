<?php


class MainController
{

    private $layoutView;
    private $loginView;
    private $timeView;

    // private $registerView;

    private $registerController;
    private $loginController;





    public function __construct() {
        $this->layoutView = new LayoutView();
        $this->loginView = new LoginView();
        $this->timeView = new DateTimeView();
        // $this->registerView = new RegisterView();

        $this->registerController = new RegisterController();
        $this->loginController = new LoginController();

    }

    public function runLoginOrRegister() {

        if($this->loginView->isNavigatingToRegistration()) {

              $this->registerController->registerUser();

        } else if ($this->loginView->isTryingToLogin()) {

            $this->loginController->Login();

        } else if ($this->loginView->isLoggingOut()) {

            $this->killSession();
            $this->layoutView->render(false, $this->loginView, $this->timeView);
            return;
        }

        // Default
        $this->renderHTML();
    }

    private function renderHTML() {
        $this->layoutView->render($this->loginView->isAuthorised(), $this->loginView, $this->timeView);
    }

    public function killSession() {
        session_destroy();
    }

}




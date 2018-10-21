<?php


class MainController {

    private $layoutView;
    private $loginView;
    private $timeView;
    private $registerView;
    // private $todoController;
    // private $loginController;


    // private $registerController;

    private $database;
    private $credentials;
    private $validation;


    public function __construct(LayoutView $v, LoginView &$lv, RegisterView $rv, TodoController $tc, LoginController $lc,RegisterController $rc, Database $db) {
        $this->layoutView           = $v;
        $this->loginView            = $lv;
        $this->registerView         = $rv;
        $this->loginController      = $lc;
        $this->database             = $db;
        $this->timeView             = new DateTimeView();
        $this->todoController       = $tc;
        $this->registerController   = $rc;

    }

    
    public function runLoginOrRegister() {
 
        if ($this->loginView->isLoggingOut($this->isAuthorised())) {
                $this->killSession();
                $this->loginView->setMessage($this->loginView->logoutMessage());
                $this->layoutView->render(false, $this->loginView, $this->timeView, '');
                return;
        } else if ($this->loginView->isNavigatingToRegistration()) {

            if($this->registerController->registerUser()) {
                $this->loginView->setPrefilledUsername($this->registerView->getRequestUserNameFromRegistration());
                return $this->layoutView->render(false, $this->loginView, $this->timeView, '');
            } else {
                return $this->layoutView->render(false, $this->registerView, $this->timeView, '');
            }
        } else if ($this->loginView->isTryingToLogin() && !$this->isAuthorised()) {
            $this->loginView->setPrefilledUsername($this->loginView->getRequestUserName());
            $this->loginController->login();
        }
            // Default view
            $this->renderHTML($this->loginView);
    }


    private function renderHTML($view) {
        $renderedTodoHTML = $this->isAuthorised() ? $this->todoController->render() : '';
        $this->layoutView->render($this->isAuthorised(), $view, $this->timeView, $renderedTodoHTML);
    }


    public function killSession() {
        session_destroy();
    }


    public function isAuthorised() : bool {
        return isset($_SESSION['username']) && isset($_SESSION['password']) && 
            $this->database->isExistingUsername($_SESSION['username']);
    }
}

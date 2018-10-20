<?php

class RegisterView {


    private static $loginForm           = 'login';
    private static $registerMessageId   = 'RegisterView::Message';
    private static $registerName        = 'RegisterView::UserName';
    private static $registerPassword    = 'RegisterView::Password';
    private static $submitSignup        = 'RegisterView::Register';
    private static $passwordRepeat      = 'RegisterView::PasswordRepeat';
    
    private $message = '';
    private $database;

	public function __construct() {
        $this->database = new Database();
    }

    public function response($isLoggedIn) {
        if (!$isLoggedIn) {
          return  $this->generateRegisterFormHTML($this->message);
        }
    }
    public function generateRegisterFormHTML($message) {

        return '
        <a href="?' . self::$loginForm . '">Back to login</a>
                <form method="POST">
                    <fieldset>
                        <legend>Sign Up - enter Username and password</legend>
                        <p id="' . self::$registerMessageId . '">' . $message . '</p>
                        
                        <label for="' . self::$registerName . '">Username :</label>
                        <input type="text" id="' . self::$registerName . '" name="' . self::$registerName . '" value="' . strip_tags($this->getRequestUserNameFromRegistration()) . '" />
                        <label for="' . self::$registerPassword . '">Password :</label>
                        <input type="password" id="' . self::$registerPassword . '" name="' . self::$registerPassword . '" />
                        <label for="' . self::$passwordRepeat . '">Repeat Password :</label>
                        <input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />
                        <input type="submit" name="' . self::$submitSignup . '" value="SignUp" />
                    </fieldset>
                </form>';
    }

    public function isNavigatingToLogin() : bool {
        return isset($_GET[self::$loginForm]);
    }


    public function isTryingToSignup() : bool {
		return isset($_POST[self::$submitSignup]);
	}


    public function getRequestUserNameFromRegistration() : string {
        return (isset($_POST[self::$registerName]) ? $_POST[self::$registerName] : '');
    }


    public function getRequestPasswordFromRegistration() : string {
        return (isset($_POST[self::$registerPassword]) ? $_POST[self::$registerPassword] : '');
    }

    public function getRequestPasswordRepeatFromRegistration() : string {
        return (isset($_POST[self::$passwordRepeat]) ? $_POST[self::$passwordRepeat] : '');
    }


    public function setMessage($message) {
        $this->message = $message;
    }

    public function getCredentialsInForm()
    {
        return new Credentials($this->getRequestUserNameFromRegistration(), $this->getRequestPasswordFromRegistration());
    }
    
}

<?php

class RegisterView {


    private static $registerName = 'RegisterView::UserName';
    private static $registerPassword = 'RegisterView::Password';

    private static $submitSignup = 'RegisterView::Register';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $loginForm = 'login';
    private static $registerMessageId = 'RegisterView::Message';
    

	public function __construct()
	{
		$this->correctCredentials = new Credentials('Admin', 'Password');
	}

        public function generateRegisterFormHTML($message)
        {
    
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

    public function isNavigatingToLogin() : bool
    {
        return isset($_GET[self::$loginForm]);
    }


    public function isTryingToSignup() : bool
    {
		return isset($_POST[self::$submitSignup]);
	}


    public function getRequestUserNameFromRegistration()
    {
        if (isset($_POST[self::$registerName])) {
            return $_POST[self::$registerName];
        }
    }

    public function getRequestPasswordFromRegistration()
    {
        if (isset($_POST[self::$registerPassword])) {
            return $_POST[self::$registerPassword];
        }
    }


    public function isUsernameTooShort() : bool
    {
        return strlen($this->getRequestUserNameFromRegistration()) < 3;
    }

    public function isPasswordTooShort() : bool
    {
        return strlen($this->getRequestPasswordFromRegistration()) < 6;
    }
    
    
    public function validationMessageRegister() : string
    {
        if (!ctype_alnum($this->getRequestUserNameFromRegistration()) && !empty($this->getRequestUserNameFromRegistration())) {
            return 'Username contains invalid characters.';
        }

        if ($this->isUsernameTooShort() && $this->isPasswordTooShort()) {
            return 'Username has too few characters, at least 3 characters. Password has too few characters, at least 6 characters.';
        }

        if ($this->isUsernameTooShort()) {
            return 'Username has too few characters, at least 3 characters.';
        }

        if ($this->isPasswordTooShort()) {
            return ' Password has too few characters, at least 6 characters.';
        } else if ($this->getRequestPasswordFromRegistration() != $_POST[self::$passwordRepeat]) {

            return 'Passwords do not match.';

        } else if ($this->getRequestUserNameFromRegistration() == $this->correctCredentials->username) {

            return 'User exists, pick another username.';

        } else {

            return 'Registered new user.';
        }
    }


    public function getCredentialsInRegisterForm()
    {
        return new Credentials($this->getRequestUserNameFromRegistration(), $this->getRequestPasswordFromRegistration());
    }
    
    }

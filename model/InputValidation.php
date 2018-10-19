<?php
class InputValidation {

    private static $VALIDATED_USER_MESSAGE = 'Registered new user.';

    private $database;

    public function __construct() {

        $this->database = new Database();

    }

    public function isUsernameTooShort($username) : bool {
        return strlen($username) < 3;
    }


    public function isPasswordTooShort($password) : bool {
        return strlen($password) < 6;
    }

    public function validationMessageRegister($credentials, $passwordRepeat) : string {

        if (!ctype_alnum($credentials->getUsername()) && !empty($credentials->getPassword())) {
            return 'Username contains invalid characters.';
        }

        if ($this->isUsernameTooShort($credentials->getUsername()) && $this->isPasswordTooShort($credentials->getPassword())) {
            return 'Username has too few characters, at least 3 characters. Password has too few characters, at least 6 characters.';
        }

        if ($this->isUsernameTooShort($credentials->getUsername())) {
            return 'Username has too few characters, at least 3 characters.';
        }

        if ($this->isPasswordTooShort($credentials->getPassword())) {
            return ' Password has too few characters, at least 6 characters.';

        } else if ($credentials->getPassword() != $passwordRepeat) {
            return 'Passwords do not match.';

        } else if ($this->database->isExistingUsername($credentials->getUsername())) {
            return 'User exists, pick another username.';

        } else {
            return self::$VALIDATED_USER_MESSAGE;
        }
    }


    public function isMessageForValidatedUser($message) : bool {
        return $message == self::$VALIDATED_USER_MESSAGE;
    }
    

    public function isAuthorised() : bool
        {
            return isset($_SESSION['username']) && isset($_SESSION['password']) && 
                $this->database->isExistingUsername($_SESSION['username']);
        }


        public function validationMessageLogin($credentials) : string
        {
    
            if (empty($credentials->getUsername())) {
    
                return 'Username is missing';
    
            } else if (empty($credentials->getPassword())) {
    
                return 'Password is missing';
    
            } else if (!$this->database->isCorrectPasswordForUsername($credentials->getUsername(), $credentials->getPassword())) {
    
                return 'Wrong name or password';
    
            } else {
    
                return '';
            }
        }

    }
<?php

class SessionModel {

    private static $SESSION_USERNAME = 'username';
    private static $SESSION_PASSWORD = 'password';


    public function saveSessionUsername($username) {
        $_SESSION[self::$SESSION_USERNAME] = $username;
    }  
    

    public function saveSessionPassword($password) {
        $_SESSION[self::$SESSION_PASSWORD] = $password;
    }
    

    public function getSessionUsername() : string {
        if (isset($_SESSION[self::$SESSION_USERNAME])) {
            return $_SESSION[self::$SESSION_USERNAME];
        } else  {
            return '';
        }
    }
    
    public function getSessionPassword() : string {
        if (isset($_SESSION[self::$SESSION_PASSWORD])) {
            return $_SESSION[self::$SESSION_PASSWORD];
        } else  {
            return '';
        }
    }



}
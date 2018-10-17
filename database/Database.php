<?php

require_once('new_config.php');


class Database {

    private $connection;

    function __construct() {
        $this->open_db_connection();
        // $this->createTable();
    }

    public function getConnection () {
        return $this->connection;
    }
    

    public function open_db_connection() {
         $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if($this->connection->connect_error) {
            die("database failed" . $this->connection->connect_error);
        }
    }

    // $sql = SQL Sträng med query instruktion.
    public function query($sql) {
        $result = mysqli_query($this->connection, $sql);
        return (!$result ? false : $result);
    }

    
    public function saveUser($username, $password) : void {

        $query = "INSERT INTO users(username, password) VALUES ('$username', '$password')";
        $result = $this->query($query);
    }


    public function isExistingUsername($username) {

        $query = "SELECT COUNT(*) FROM users WHERE username = '$username'";
        $result = $this->query($query);
        echo 'true';
        echo true;
        echo 'false';
        echo false;
        return (!$result ? false : true);
    }


    // public function checkForExistingPassword($password) {

    //     $query = "SELECT * FROM users WHERE password = '$password'";
    //     $result = $this->query($query);
    //     return (!$result ? false : true);
    // }


    public function createTable() {
      return $sql = "CREATE TABLE IF NOT EXISTS users(
            username VARCHAR(13) NOT NULL,
            password VARCHAR(13) NOT NULL
        )";
    }
    // public function escapeStringForMySQLQuery($string) {

    //   $escaped_string = mysqli_escape_string($this->connection, $string);
    //   return $escaped_string;
    // }

        public function isCorrectPasswordForUsername($username, $password) {

        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $this->query($query);
        //$numberOfRows = mysqli_num_rows($result);
        //return $numberOfRows > 0;
        // var_dump($result);
        return $result->num_rows > 0;
    }
}

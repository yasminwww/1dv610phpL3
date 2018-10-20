<?php

require_once('new_config.php');


class Database {

    private $connection;

    function __construct() {
        $this->openDBConnection();
    }

    public function getConnection () {
        return $this->connection;
    }
    

    public function openDBConnection() {
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if($this->connection->connect_error) {
            die("database failed" . $this->connection->connect_error);
        }
    }


    public function query($sql) {

        $result = mysqli_query($this->connection, $sql);
        return (!$result ? false : $result);
    }


    public function isExistingUsername($username) : bool {

        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->query($query);
        return $result->num_rows > 0;
    }

    
    public function isCorrectPasswordForUsername($username, $password) : bool {

        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $this->query($query);
        return $result->num_rows > 0;
    }
    
    
    public function saveUser($username, $password) : void {

        $query = "INSERT INTO users(username, password) VALUES ('$username', '$password')";
        $result = $this->query($query);
    }


    public function saveTodo(TodoModel $todo) : void {

        $query = "INSERT INTO todos(ownerID, text) VALUES ('$todo->ownerID', '$todo->text')";
        $result = $this->query($query);
    }

    
    public function getOwnerID($username) {
        $query = "SELECT id FROM users WHERE username = '$username'";
        $result = $this->query($query);
        return $result->fetch_row()[0];
    }


    public function getTodoItemsForUser($ownerID) {
        $query = "SELECT * FROM todos WHERE ownerID = '$ownerID'";
        $result = $this->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function deleteTodo($todoID) {
        $query = "DELETE FROM todos WHERE id = '$todoID'";
        $result = $this->query($query);
    }

    // Not used yet. 
    public function createTable() {
        return $sql = "CREATE TABLE IF NOT EXISTS users(
                    id INT NOT NULL AUTO_INCREMENT,
                    username VARCHAR(13) NOT NULL,
                    password VARCHAR(13) NOT NULL
                    )";
    }
}
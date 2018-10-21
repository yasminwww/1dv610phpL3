<?php

require_once('new_config.php');


class Database {

    private $connection;

    function __construct() {
        $this->openDBConnection();
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
        $username = $this->safeString($username);

        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->query($query);
        return $result->num_rows > 0;
    }

    
    public function isCorrectPasswordForUsername($username, $password) : bool {
        $username = $this->safeString($username);
        $password = $this->safeString($password);

        $hashedPassword = md5($password);
        $query = "SELECT * FROM users WHERE BINARY username = '$username' AND password = '$hashedPassword'";
        $result = $this->query($query);
        return $result->num_rows > 0;
    }
    
    
    public function saveUser($username, $password) : void {
        $username = $this->safeString($username);

        $query = "INSERT INTO users(username, password) VALUES ('$username', '$password')";
        $result = $this->query($query);
    }


    public function saveTodo(TodoModel $todo) : void {
        $todo->text = $this->safeString($todo->text);

        $query = "INSERT INTO todos(ownerID, text) VALUES ('$todo->ownerID', '$todo->text')";
        $result = $this->query($query);
    }

    
    public function getOwnerID($username) {
        $username = $this->safeString($username);

        $query = "SELECT id FROM users WHERE username = '$username'";
        $result = $this->query($query);
        return $result->fetch_all(MYSQLI_ASSOC)[0]['id'];
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

    public function safeString($param) {
       return (!ctype_alnum($param) ? '' : mysqli_real_escape_string($this->connection, $param));
        // return mysqli_real_escape_string($this->connection, $param);
    }
}
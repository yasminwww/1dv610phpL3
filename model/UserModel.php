<?php
// require_once('init.php');


class User{
    
    // Undgå error vid start.
    private $username = null;
	private $password = null;
	// private $database;

	public function __construct($username, $password) {
		$this->username = $username;
		$this->password = $password;
	}

    public function getUsername() {
        return $this->username;
}
	// public function checkForDublicatedUsernames() {
	// }

	public function saveUser($database) {

			$query = "INSERT INTO users(username, password) VALUES ('$this->username', '$this->password')";
			echo $query;
			// var_dump($database);
			$result = $database->query($query);

	}

}

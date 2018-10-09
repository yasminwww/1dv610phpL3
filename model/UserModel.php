<?php
// require_once('init.php');


class User
{
    
    // Undgå error vid start.
	private $username;
	private $password;

	public function __construct()
	{
		$this->username = $username;
		$this->password = $password;
	}

	public function getUsername()
	{
		return $this->username;
	}
	public function getPassword()
	{
		return $this->password;

	}
}

<?php
class Credentials
{
	public $username;
	public $password;
	// Bool 
	// public $keepUserLoggedIn;

	public function __construct(string $username, string $password)
	{
		$this->username = $username;
		$this->password = $password;
	}
}

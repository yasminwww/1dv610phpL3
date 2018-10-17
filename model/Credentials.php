<?php
class Credentials
{
	public $username;
	public $password;
	public $repeatPassword;


	// Bool 
	// public $keepUserLoggedIn;

	public function __construct(string $username, string $password)
	{
		$this->username = $username;
		$this->password = $password;

	}
	// Only set repeatpassword when needed. 
	public function setRepeatPassword($rep) {
		$this->repeatPassword = $rep;
	}

	public function getUsername() {
		return $this->username;
	}
	public function getPassword() {
		return $this->password;
	}
	public function getRepeatPassword() {
		return $this->repeatPassword;
	}
}

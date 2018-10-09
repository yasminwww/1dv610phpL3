<?php
class Credentials
{
	public $username;
	public $password;

	public function __construct(string $username, string $password)
	{
		$this->username = $username;
		$this->password = $password;
	}
}

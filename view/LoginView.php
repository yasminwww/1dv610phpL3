<?php

class LoginView
{

	private static $signupForm 		= "register";
	private static $login 			= 'LoginView::Login';
	private static $logout 			= 'LoginView::Logout';
	private static $name 			= 'LoginView::UserName';
	private static $password 		= 'LoginView::Password';
	private static $keep 			= 'LoginView::KeepMeLoggedIn';
	private static $messageId 		= 'LoginView::Message';

	private static $cookieName 		= "LoginView::CookieName";
	private static $cookiePassword 	= "LoginView::CookiePassword";


	private $message = '';
	private $database;

	private $prefilledUsername = '';

	public function __construct(RegisterView $registerView)
	{
		$this->registerView = $registerView;
	}


    public function response(bool $isLoggedIn) {
        if ($isLoggedIn) {
			$response = $this->generateLogoutButtonHTML();
			// $response .= $renderedTodoHTML;
        } else {
            $response = $this->generateLoginFormHTML();
        }
        return $response;
	}


	/**
	 * Generate HTML code on the output buffer for the logout button
	 * @param $message, String output message
	 * @return  void, BUT writes to standard output!
	 */
	public function generateLogoutButtonHTML()
	{
		return '
		<form method="POST">
			<p id="' . self::$messageId . '">' . $this->message . '</p>
			<input type="submit" class="btn btn-outline-dark float-right" name="' . self::$logout . '" value="logout" />
		</form>
		';
	}


	/**
	 * Generate HTML code on the output buffer for the logout button
	 * @param $message, String output message
	 * @return  void, BUT writes to standard output!
	 */
	public function generateLoginFormHTML()
	{

		return ' 
		<a href="?' . self::$signupForm . '">Register a new user</a>
		<form method="POST">
			<fieldset>
				<legend>Login - enter Username and password</legend>
				<p id="' . self::$messageId . '">' . $this->message . '</p>
				<label for="' . self::$name . '">Username :</label>
				<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->prefilledUsername . '" />
				<label for="' . self::$password . '">Password :</label>
				<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
				<label for="' . self::$keep . '">Keep me logged in  :</label>
				<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
				<input type="submit" class="btn btn-info" name="' . self::$login . '" value="Login" />
			</fieldset>
        </form>
		';
	}

	public function isNavigatingToRegistration() : bool
	{
		return isset($_GET[self::$signupForm]);
	}


	public function isTryingToLogin() : bool
	{
		return isset($_POST[self::$login]);
	}


	public function setPrefilledUsername($preset)
	{
		$this->prefilledUsername = $preset;
	}


	public function isLoggingOut($isAuthorised) : bool
	{
		return isset($_POST[self::$logout]) && $isAuthorised;
	}


	public function getRequestUserName()
	{
		return (isset($_POST[self::$name]) ? $_POST[self::$name] : '');

	}


	public function getRequestPassword()
	{
		return (isset($_POST[self::$password]) ? $_POST[self::$password] : '');
	}


	public function isKeepUserLoggedIn() {
		return isset($_POST[self::$keep]);
	}

	
    public function setMessage($message) {
        $this->message = $message;
    }


	public function getCredentialsInForm()
	{
		return new Credentials($this->getRequestUserName(), $this->getRequestPassword());
	}


	public function welcomeMessage() : string {
		return 'Welcome';
	}

	public function logoutMessage() : string {
		return 'Bye bye!';
	}
}
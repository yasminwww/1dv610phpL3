<?php

// public function response() {

// 	if ($this->isLoggingOut()) {
// 		return $this->generateLoginFormHTML($this->logoutMessage());
// 	}
// 	if ($this->registerView->isTryingToSignup()) {
        
// 		if ($this->registerView->isUserValid()) {

// 			return $this->generateLoginFormHTML($this->registerView->validationMessageRegister());

// 		} else {

// 			return $this->registerView->generateRegisterFormHTML($this->registerView->validationMessageRegister());
// 		}
// 	}

// 	if ($this->isNavigatingToRegistration()) {
// 		return $this->registerView->generateRegisterFormHTML('');
// 	}
// 	if ($this->isTryingToLogin()) {

// 		if ($this->isAuthorised() && !isset($_SESSION['already-loggedin'])) {

// 			$_SESSION['already-loggedin'] = true;
// 			return $this->generateLogoutButtonHTML($this->welcomeMessage());

// 		} else if ($this->isAuthorised() && isset($_SESSION['already-loggedin'])) {

// 			return $this->generateLogoutButtonHTML('');

// 		} else {
// 			return $this->generateLoginFormHTML($this->validationMessageLogin());
// 		}
// 	} else if ($this->isAuthorised()) {
// 		return $this->generateLogoutButtonHTML('');
// 	} else {
// 		return $this->generateLoginFormHTML('');
// 	}
// }
<?php

//INCLUDE THE FILES NEEDED...
require_once('controller/MainController.php');
// require_once('controller/RegisterController.php');
// require_once('controller/LoginController.php');

require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('model/Credentials.php');
require_once('database/Database.php');
require_once('model/InputValidation.php');



//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();
$db = new Database();
$db->createTable();

$lv = new LayoutView();
$controller = new MainController($lv, $db);
$controller->runLoginOrRegister(); //renderHTML();
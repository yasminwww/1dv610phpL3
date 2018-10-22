<?php

//INCLUDE THE FILES NEEDED...
require_once('controller/MainController.php');
require_once('controller/TodoController.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');

require_once('view/TodoView.php');
require_once('view/LoginView.php');
require_once('view/LayoutView.php');
require_once('view/DateTimeView.php');
require_once('view/RegisterView.php');
require_once('model/TodoModel.php');
require_once('model/Credentials.php');
require_once('model/InputValidation.php');

require_once('database/Database.php');
require_once('model/InputValidation.php');
require_once('model/SessionModel.php');



//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();
$db = new Database();
$db->createTable();

$iv = new InputValidation();

$v = new LayoutView();
$rv = new RegisterView();

$todo = new TodoController($db, $iv);
$todo->createAndSaveTodo();

$lv = new LoginView($rv, $todo);
$sm = new SessionModel();
$lc = new LoginController($db, $lv, $iv, $sm);
$rc = new RegisterController($db, $rv, $lv, $iv);




$controller = new MainController($v, $lv, $rv, $todo, $lc, $rc, $db);
$controller->runLoginOrRegister(); 
//renderHTML();
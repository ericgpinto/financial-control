<?php

require_once "db/ConexaoPDO.php";

require_once "class/User.php";
require_once "class/Project.php";
require_once "class/Account.php";
require_once "class/Movement.php";

require_once "dao/UserDAO.php";
require_once "dao/ProjectDAO.php";
require_once "dao/AccountDAO.php";
require_once "dao/MovementDAO.php";

require_once "controllers/UserController.php";
require_once "controllers/ProjectController.php";
require_once "controllers/AccountController.php";
require_once "controllers/MovementController.php";

require "vendor/autoload.php";

$config = [
	'settings'             => [
		'displayErrorDetails' => true,
		'addContentLengthHeader' => false
	],
];
?>
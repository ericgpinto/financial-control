<?php
// include para criação de conexão com banco de dados
require_once "db/ConexaoPDO.php";

// includes de classes
require_once "class/User.php";
require_once "class/Project.php";
require_once "class/Account.php";
require_once "class/Movement.php";

// includes de DAO
require_once "dao/UserDAO.php";
require_once "dao/ProjectDAO.php";
require_once "dao/AccountDAO.php";
require_once "dao/MovementDAO.php";

// includes de controllers
require_once "controllers/UserController.php";
require_once "controllers/ProjectController.php";
require_once "controllers/AccountController.php";
require_once "controllers/MovementController.php";

// include de autoload do Slim
require "vendor/autoload.php";

// configuração do Slim para exibição dos detalhes na ocorrência de erros
$config = [
	'settings'             => [
		'displayErrorDetails' => true,
		'addContentLengthHeader' => false
	],
];
?>
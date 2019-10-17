<?php
// include para criação de conexão com banco de dados
require_once "db/PDOFactory.php";

// includes de classes
require_once "class/Produto.php";
require_once "class/Usuario.php";

// includes de DAO
require_once "dao/ProdutoDAO.php";
require_once "dao/UsuarioDAO.php";

// includes de controllers
require_once "controllers/ProdutoController.php";
require_once "controllers/UsuarioController.php";

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
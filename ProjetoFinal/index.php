<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require "vendor/autoload.php";
	require_once "db/ConexaoPDO.php";
	require_once "class/Usuario.php";
	require_once "dao/UsuarioDAO.php";
	require_once "controllers/UsuarioController.php";

	$config = [
		'settings' => [
			'displayErrorDetails' => true,
			'addContentLengthHeader' => false,
		]
	];

	$app = new \Slim\App($config);

	$app->group("/usuarios",
		function(){
			$this->get("", "UsuarioController:listar");
			$this->get("/{id:[0-9]+}","UsuarioController:buscarPorId");
			$this->post("","UsuarioController:inserir");
			$this->put('/{id:[0-9]+}',"UsuarioController:atualizar"); 
			$this->delete('/{id:[0-9]+}', "UsuarioController:deletar");
		}
	);

	$app->run();
?>
<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require "vendor/autoload.php";
	require_once "db/PDOFactory.php";
	require_once "class/Produto.php";
	require_once "dao/ProdutoDAO.php";
	require_once "controllers/ProdutoController.php";

	$config = [
		'settings' => [
			'displayErrorDetails' => true,
			'addContentLengthHeader' => false,
		]
	];

	$app = new \Slim\App($config);

	$app->group("/produtos",
		function(){
			$this->get("", "ProdutoController:listar");
			$this->get("/{id:[0-9]+}","ProdutoController:buscarPorId");
			$this->post("","ProdutoController:inserir");
			$this->put('/{id:[0-9]+}',"ProdutoController:atualizar"); 
			$this->delete('/{id:[0-9]+}', "ProdutoController:deletar");
		}
	);

	$app->run();
?>
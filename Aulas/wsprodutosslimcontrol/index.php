<?php
// inclui o cabeçalho com requires e configs
require_once "header.php";

// passar a variável $config como parâmetro da instância do Slim
$app = new \Slim\App($config);

// criação de rota de autenticação para geração de token
// {...}
$app->post("/auth", "UsuarioController:autenticar");


// agrupamento para organizar o web service chamando os métodos do controller
$app->group("/produtos",
	function () {
		$this->get("", "ProdutoController:listar");
		$this->get("/{id:[0-9]+}", "ProdutoController:buscarPorId");
		$this->post("", "ProdutoController:inserir");
		$this->put("/{id:[0-9]+}", "ProdutoController:atualizar");
		$this->delete("/{id:[0-9]+}", "ProdutoController:deletar");
	})
	->add("UsuarioController::validarToken");

$app->run();
?>

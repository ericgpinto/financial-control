<?php
	include_once 'class/Produto.php';
	include_once 'ProdutoDAO.php';
	
	// recebe o método pela requisição do servidor
	$method = $_SERVER["REQUEST_METHOD"];

	// avalia qual foi o método encaminhado
	switch($method)
	{
		// recuperação de dados (a lista copleta ou específico)
		case "GET":

			// Se tem id, busca o produto por id
			if(!empty($_GET["id"])) {
				// converte o id para numérico
				$id = intval($_GET["id"]);
				// cria o objeto DAO e acessa o método de busca por ID
				$dao = new ProdutoDAO();		
				$produto = $dao->buscarPorId($id);
				// faz a codificaçao dos dados para json
				$produto_json = json_encode($produto);
				header('Content-Type:application/json');
				echo($produto_json);
			}
			//senão, retorna todos os produtos
			else {
				// cria o objeto DAO e acessa o método de listagem de dados
				$dao = new ProdutoDAO();
				$produtos =  $dao->listar();	
				// faz a codificaçao dos dados para json
				$produto_json = json_encode($produtos);
				header('Content-Type:application/json');
				echo($produto_json);			
			}
		break;

		// criação de dados 
		case "POST":
			// recebe os dados de input e codifica para JSON
			$data = file_get_contents("php://input");
			$var = json_decode($data);
			// instância um objeto Produto com os dados vindos do input
			$produto = new Produto(0, $var->nome, $var->preco);
			// cria o objeto DAO e acessa o método de inserção de dados
			$dao = new ProdutoDAO();
			$produto = $dao->inserir($produto);
 			// faz a codificaçao dos dados para json	
			$produto_json = json_encode($produto);
			header('HTTP/1.1 201 Created');
			header('Content-Type:application/json');
			echo($produto_json);
		break;

		case "PUT":
			// verifica se o ID foi encaminhado
			if(!empty($_GET["id"])) {
				// converte o id para numérico
				$id = intval($_GET["id"]);
				// recebe os dados de input e codifica para JSON
				$data = file_get_contents("php://input");
				// decodifica dados em formato JSON e cria objeto
				$var = json_decode($data);
				$produto = new Produto($id, $var->nome, $var->preco);
				// cria o objeto DAO e acessa o método de edição de dados
				$dao = new ProdutoDAO();
				$dao->atualizar($produto);
				// faz a codificaçao dos dados para json	
				$produto_json = json_encode($produto);
				header('Content-Type:application/json');
				echo($produto_json);				
			}
		break;
		
		case "DELETE":
			// verifica se o ID foi encaminhado
			if(!empty($_GET["id"])) {
				// converte o id para numérico
				$id = intval($_GET["id"]);
				// cria o objeto DAO e acessa o método de exclusão de dados
				$dao = new ProdutoDAO();
				$produto = $dao->buscarPorId($id);
				$dao->deletar($id);				
				// faz a codificaçao dos dados para json	
				$produto_json = json_encode($produto);
				header('Content-Type:application/json');
				echo($produto_json);
			}
		break;
		
		default:
			// caso não encontre o método requisitado apresenta mensagem
			header("HTTP/1.0 405 Method Not Allowed");
		break;
	}
 
?>
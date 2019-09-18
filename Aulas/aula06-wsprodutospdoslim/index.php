<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once "vendor/autoload.php";
    require_once "ProdutoDAO.php";

    $config = [
        'settings' => [
            'displayErrorDetails' => true,
            'addContentLengthHeader' => false,
        ]
    ];

    $app = new \Slim\App($config);

  
    $app->get("/produtos", 
        function(Request $req, Response $res, array $args)
            {
                $dao = new ProdutoDAO();
                $produtos = $dao->listar();
                $res = $res->withJson($produtos);
                $res = $res->withHeader("Content-type","application/json");
                return $res;
            }
    );

    $app->get("/produtos/{id}",
            function(Request $req, Response $res, array $args)
            {
                $id = (int) $args['id'];
                $dao = new ProdutoDAO();		
				$produto = $dao->buscarPorId($id);
				$res = $res->withJson($produto);
                $res = $res->withHeader("Content-type","application/json");
                return $res;
            }
    );

    $app->post("/produtos", 
        function(Request $req, Response $res, array $args)
        {
            $nome = file_get_contents("php://input");
			$var = json_decode($nome);
			$produto = new Produto(0, $var->nome, $var->preco);
			$dao = new ProdutoDAO();
            $produto = $dao->inserir($produto);
            $res = $res->withJson($produto);
            $res = $res->withHeader("Content-type","application/json");
            return $res;
        }
    );


    $app->run();
?>
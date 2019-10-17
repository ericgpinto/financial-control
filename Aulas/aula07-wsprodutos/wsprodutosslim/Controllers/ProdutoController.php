<?php

    class produtoController {

        public function listar($request, $response, $args) {
            $dao = new ProdutoDAO();
            $lista = $dao->listar();
            $response = $response->withJson($lista);
            $response = $response->withHeader("Content-type", "application/json");
            return $response;
        }

       public function buscarPorId($request, $response, $args) {
            $id = (int) $args['id'];
            $dao = new ProdutoDAO();
            $produto = $dao->buscarPorId($id);
            $response = $response->withJson($produto);
            $response = $response->withHeader('Content-type', 'application/json');    
            return $response;
        }

        public function inserir($request, $response, $args) {
            $var = $request->getParsedBody();
            $produto = new Produto(0,$var['nome'],$var['preco']);
            $dao = new ProdutoDAO();
            $produto = $dao->inserir($produto);
            $response = $response->withJson($produto);
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withStatus(201);
            return $response;
        }


        public function atualizar ($request, $response, $args) {
            $id = (int) $args['id'];
            $var = $request->getParsedBody();
            $produto = new Produto($id,$var['nome'],$var['preco']);
            $dao = new ProdutoDAO;
            $dao->atualizar($produto);
            $response = $response->withJson($produto);
            $response = $response->withHeader('Content-type', 'application/json');
            return $response;

        }

        public function deletar (Request $request, Response $response, array $args) {
            $id = (int) $args['id'];
            $dao = new ProdutoDAO();
            $produto = $dao->buscarPorId($id);
            $dao->deletar($id);
            $response = $response->withJson($produto);
            $response = $response->withHeader('Content-type', 'application/json');
            return $response;
        }


    }
?>

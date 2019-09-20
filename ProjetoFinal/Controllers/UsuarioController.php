<?php

    class usuarioController {

        public function listar($request, $response, $args) {
            $dao = new UsuarioDAO();
            $lista = $dao->listar();
            $response = $response->withJson($lista);
            $response = $response->withHeader("Content-type", "application/json");
            return $response;
        }

       public function buscarPorId($request, $response, $args) {
            $id = (int) $args['id'];
            $dao = new UsuarioDAO();
            $usuario = $dao->buscarPorId($id);
            $response = $response->withJson($usuario);
            $response = $response->withHeader('Content-type', 'application/json');    
            return $response;
        }

        public function inserir($request, $response, $args) {
            $var = $request->getParsedBody();
            $usuario = new Usuario(0,$var['nomeUsuario'],$var['senhaUsuario']);
            $dao = new UsuarioDAO();
            $usuario = $dao->inserir($usuario);
            $response = $response->withJson($usuario);
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withStatus(201);
            return $response;
        }


        public function atualizar ($request, $response, $args) {
            $id = (int) $args['id'];
            $var = $request->getParsedBody();
            $usuario = new Usuario($id,$var['nomeUsuario'],$var['senhaUsuario']);
            $dao = new UsuarioDAO;
            $dao->atualizar($usuario);
            $response = $response->withJson($usuario);
            $response = $response->withHeader('Content-type', 'application/json');
            return $response;

        }

        public function deletar (Request $request, Response $response, array $args){
            $id = (int) $args['idUsuario'];
            $dao = new UsuarioDAO();
            $usuario = $dao->buscarPorId($id);
            $dao->deletar($id);
            $response = $response->withJson($usuario);
            $response = $response->withHeader('Content-type', 'application/json');
            return $response;
        }

    }
?>

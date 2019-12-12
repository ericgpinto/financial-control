<?php

    class MotorController{

        public function listar($request, $response,$args) {
            $dao = new MotorDAO;    
            $array_motores = $dao->listar();            
            $response = $response->withJson($array_motores);
            $response = $response->withHeader('Content-type', 'application/json');    
            return $response;
        }

        public function buscarPorId($request, $response, $args) {
            $id = (int) $args['id'];
            $dao = new MotorDAO;    
            $motor = $dao->buscarPorId($id);  
            $response = $response->withJson($motor);
            $response = $response->withHeader('Content-type', 'application/json');    
            return $response;
        }

        public function inserir( $request, $response, $args) {
            $var = $request->getParsedBody();
            $motor = new Motor(0, $var['nome'], $var['imagem'], $var['descricao'], $var['uso']);
            $dao = new MotorDAO;    
            $motor = $dao->inserir($motor);
            $response = $response->withJson($motor);
            $response = $response->withHeader('Content-type', 'application/json');    
            $response = $response->withStatus(201);
            return $response;
        }
        
        public function atualizar($request, $response, $args) {
            $id = (int) $args['id'];
            $var = $request->getParsedBody();
            $motor = new Motor($id, $var['nome'], $var['imagem'], $var['descricao'], $var['uso']);
            $dao = new MotorDAO;    
            $dao->atualizar($motor);
            $response = $response->withJson($motor);
            $response = $response->withHeader('Content-type', 'application/json');    
            return $response;        
        }

        public function deletar($request, $response, $args) {
            $id = (int) $args['id'];
            $dao = new MotorDAO; 
            $motor = $dao->buscarPorId($id);   
            $dao->deletar($id);
            $response = $response->withJson($motor);
            $response = $response->withHeader('Content-type', 'application/json');    
            return $response;
        }
    }

?>
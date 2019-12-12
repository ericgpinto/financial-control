<?php

    class MotorDAO
    {

        public function inserir(Motor $motor) {
            $qInserir = "INSERT INTO motores(nome,imagem,descricao,uso) VALUES (:nome,:imagem,:descricao,:uso)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$motor->nome);
            $comando->bindParam(":imagem",$motor->imagem);
            $comando->bindParam(":descricao",$motor->descricao);
            $comando->bindParam(":uso",$motor->uso);
            $comando->execute();
            $motor->id = $pdo->lastInsertId();
            return $motor;
        }

        public function deletar($id) {
            $qDeletar = "DELETE from motores WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
        }

        public function atualizar(Motor $motor) {
            $qAtualizar = "UPDATE motores SET nome=:nome, imagem=:imagem, descricao=:descricao, uso=:uso WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$motor->nome);
            $comando->bindParam(":imagem",$motor->imagem);
            $comando->bindParam(":descricao",$motor->descricao);
            $comando->bindParam(":uso",$motor->uso);
            $comando->bindParam(":id",$motor->id);
            $comando->execute();        
        }

        public function listar() {
		    $query = 'SELECT * FROM motores';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $motores=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $motores[] = new Motor($row->id,$row->nome,$row->imagem,$row->descricao,$row->uso);
            }
            return $motores;
        }

        public function buscarPorId($id) {
 		    $query = 'SELECT * FROM motores WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
            return new Motor($result->id,$result->nome,$result->imagem,$result->descricao,$result->uso);
        }
    }
?>
<?php

	class UsuarioDAO {

		public function listar() {
			$query = "SELECT * FROM usuarios";
			$pdo = ConexaoPDO::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$usuarios = array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$usuarios[] = new Usuario($row->idUsuario,$row->nomeUsuario,$row->senhaUsuario);
			}
			return $usuarios;
		}

		public function buscarPorId($idUsuario) {
			$query = "SELECT * FROM usuarios WHERE idUsuario = :idUsuario";		
			$pdo = ConexaoPDO::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("idUsuario", $idUsuario);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Usuario($resultado->idUsuario, $resultado->nomeUsuario, $resultado->senhaUsuario);           
		}

		public function inserir(Usuario $usuario) {
			$query = "INSERT INTO usuarios(nomeUsuario, senhaUsuario) VALUES (:nomeUsuario, :senhaUsuario)";            
			$pdo = ConexaoPDO::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nomeUsuario", $usuario->nomeUsuario);
			$comando->bindParam(":senhaUsuario", $usuario->senhaUsuario);
			$comando->execute();
			$usuario->idUsuario = $pdo->lastInsertId();
			return $usuario;
		}

		public function atualizar(Usuario $usuario) {
			$query = "UPDATE usuarios SET nomeUsuario = :nomeUsuario, senhaUsuario = :senhaUsuario WHERE idUsuario = :idUsuario";            
			$pdo = ConexaoPDO::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nomeUsuario", $usuario->nomeUsuario);
			$comando->bindParam(":senhaUsuario", $usuario->senhaUsuario);
			$comando->bindParam(":idUsuario", $usuario->idUsuario);
			$comando->execute(); 
		}

		public function deletar($idUsuario) {
			$query = "DELETE from usuarios WHERE idUsuario = :idUsuario";            
			$pdo = ConexaoPDO::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":idUsuario", $idUsuario);
			$comando->execute();
		}
	}
?>
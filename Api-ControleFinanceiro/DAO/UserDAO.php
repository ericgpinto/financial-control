<?php

	class UserDAO {

		public function getUsers() {
			$query = "SELECT * FROM users";
			$pdo = ConexaoPDO::getConexao();
			$command = $pdo->prepare($query);
			$command->execute();
			$usuarios = array();	
			while($row = $command->fetch(PDO::FETCH_OBJ)) {
				$usuarios[] = new User($row->idUser,$row->name,$row->login,$row->password,
				$row->active_status);
			}
			return $usuarios;
		}

		public function getByLogin($login) {
			$query   = "SELECT * FROM users WHERE login = :login";
			$pdo     = ConexaoPDO::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam('login', $login);
			$comando->execute();
			$result = $comando->fetch(PDO::FETCH_OBJ);
			
			if(empty($result))
				return false;
			else
				return new User($result->idUser, $result->name, $result->login, $result->password,$result->active_status);
		}
		
		public function getUsersById($idUser) {
			$query = "SELECT * FROM users WHERE idUser = :idUser";		
			$pdo = ConexaoPDO::getConexao(); 
			$command = $pdo->prepare($query);
			$command->bindParam ("idUser", $idUser);
			$command->execute();
			$resultado = $command->fetch(PDO::FETCH_OBJ);
			return new User($resultado->idUser, $resultado->name, $resultado->login, 
			$resultado->password, $resultado->active_status);           
		}

		public function insertUser(User $user) {
			$query = "INSERT INTO users(name, login, password, active_status) 
			          VALUES (:name,:login, :password, :active_status)";            
			$pdo = ConexaoPDO::getConexao();
			$command = $pdo->prepare($query);
			$command->bindParam(":name", $user->name);
			$command->bindParam(":login", $user->login);
			$command->bindParam(":password", $user->password);
			$command->bindParam(":active_status", $user->active_status);
			$command->execute();
			$user->idUser = $pdo->lastInsertId();
			return $user;
		}

		public function updateUser(User $users) {
			$query = "UPDATE users SET name = :name, login = :login, password = :password, 
			                           active_status = :active_status
			          WHERE idUser = :idUser";            
			$pdo = ConexaoPDO::getConexao();
			$command = $pdo->prepare($query);
			$command->bindParam(":idUser", $users->idUser);
			$command->bindParam(":name", $users->name);
			$command->bindParam(":login", $users->login);
			$command->bindParam(":password", $users->password);
			$command->bindParam(":active_status", $users->active_status);
			$command->execute(); 
		}

	}
?>
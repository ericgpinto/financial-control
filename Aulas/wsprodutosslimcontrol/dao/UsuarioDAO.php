<?php

class UserDAO {

	public function buscarPorId($id) {
		$query   = 'SELECT * FROM usuarios WHERE id=:id';
		$pdo     = ConexaoPDO::getConexao();
		$comando = $pdo->prepare($query);
		$comando->bindParam('id', $id);
		$comando->execute();
		$result = $comando->fetch(PDO::FETCH_OBJ);
		return new User($result->idUser, $result->name, $result->login, $result->password, $result->active_status);
	}

	public function buscarPorLogin($login) {
		$query   = "SELECT * FROM usuarios WHERE login = :login";
		$pdo     = ConexaoPDO::getConexao();
		$comando = $pdo->prepare($query);
		$comando->bindParam('login', $login);
		$comando->execute();
		$result = $comando->fetch(PDO::FETCH_OBJ);
		
		if(empty($result))
			return false;
		else
		return new User($result->idUser, $result->name, $result->login, $result->password, $result->active_status);
	}
}
?>
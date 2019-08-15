<?php
	
	// verifica se as informações vieram 
	// através do método POST
	if(isset($_POST))
	{
		// chamada da classe para instância
		include "class/Usuario.php";
		include "class/UsuarioPF.php";
		include "class/UsuarioPJ.php";

		// recebe os valores vindos do formulário através de post
		$id = $_POST["id"];
		$nome = $_POST["nome"];
		$email = $_POST["email"];
		$senha = $_POST["senha"];

		// instancia um objeto do tipo Usuario passando informações pelo construtor
		$usuario = new Usuario($id, $nome, $email, $senha);
		echo "Objeto Usuario: ".$usuario."<br>";

		if($_POST["tipo"] == "PF") {
			$cpf = $_POST["cpf"];
			$datanasc = $_POST["datanasc"];			
			$usuarioPF = new UsuarioPF($id, $nome, $email, $senha, $cpf, $datanasc);
			echo "Objeto UsuarioPF: ".$usuarioPF."<br>";
		} else if($_POST["tipo"] == "PJ") {
			$cnpj = $_POST["cnpj"];
			$razaosocial = $_POST["razaosocial"];
			$usuarioPJ = new UsuarioPJ($id, $nome, $email, $senha, $cnpj, $razaosocial);
			echo "Objeto UsuarioPJ: ".$usuarioPJ."<br>";
		}

		

	}
	
?>
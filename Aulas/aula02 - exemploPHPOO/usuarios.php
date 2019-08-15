<?php
	 
	// necessário realizar a chamada de inclusão das classes para
	// sua utilização na criação dos objetos
	include "class/Usuario.php";
	include "class/UsuarioPJ.php";
	include "class/UsuarioPF.php";

	// criação de um objeto da classe Usuario passando parâmetros
	$user1 = new Usuario(1, "João do Silva", "joao@silva.com", "lerolero");
	echo $user1."<br><br>";

	// criação de um objeto da classe Usuario sem passagem de parâmetro
	$user2 = new Usuario();
	// informações passadas para o objeto a partir do __set() genérico da classe
	$user2->id = 2;
	$user2->nome = "Maria Oliveira";
	$user2->email = "maria@oliveira.com";
	$user2->senha = "biluteteia";

	// impressão dos dados (equivale a chamada do __get())
	echo "Email: ".$user2->email."<br><br>";

	// criação de um objeto de subclasse UsuarioDados com passagem de parâmetros 
	$user3 = new UsuarioPJ(3, "José Porto", "jose@porto.com", "ieiera", "11.222.333/0001-44", "Leoncio Distribuições");
		
	// impressão dos dados do objeto (chamada do toString())
	echo $user3."<br><br>";

	// criação de um objeto de subclasse UsuarioDados com passagem de parâmetros 
	$user4 = new UsuarioPF(4, "Ana Moreira", "ana@moreira.com", "ieieioio", "111.222.333-44", "10/10/1976");
	echo $user4."<br><br>";

?>
<?php

// herança utilizando a palavra extends para designar 
// que a classe UsuarioDados herda os atributos e métodos
// da classe Usuario
class UsuarioPF extends Usuario {

	// declaração de atributos da subclasse
	private $cpf;
	private $datanasc;

	// criação do construtor desta classe
	// recebe os parâmetros para a superclasse e para esta classe
	function __construct($id, $nome, $email, $senha, $cpf, $datanasc) {
		// chamada do construtor da superclasse
		// esquivale ao super() em Java
		parent::__construct($id, $nome, $email, $senha);
		$this->cpf = $cpf;
		$this->datanasc = $datanasc;
	}

    function __toString() {
		// usa o toString() da superclasse concatenada com os dados dessa classe
		return parent::__toString()." com CPF ".$this->cpf." e data de nascimento ".$this->datanasc; 
	}
}

?>
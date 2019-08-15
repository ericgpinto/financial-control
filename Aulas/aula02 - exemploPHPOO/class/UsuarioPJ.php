<?php

// herança utilizando a palavra extends para designar 
// que a classe UsuarioDados herda os atributos e métodos
// da classe Usuario
class UsuarioPJ extends Usuario {

	// declaração de atributos da subclasse
	private $cnpj;
	private $razaosocial;

	// criação do construtor desta classe
	// recebe os parâmetros para a superclasse e para esta classe
	function __construct($id, $nome, $email, $senha, $cnpj, $razaosocial) {
		// chamada do construtor da superclasse
		// esquivale ao super() em Java
		parent::__construct($id, $nome, $email, $senha);
		$this->cnpj = $cnpj;
		$this->razaosocial = $razaosocial;
	}

	function __toString() {
		// usa o toString() da superclasse concatenada com os dados dessa classe
		return parent::__toString()." com CNPJ ".$this->cnpj." e razão social ".$this->razaosocial; 
	}
}

?>
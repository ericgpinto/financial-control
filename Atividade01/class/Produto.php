<?php

	class Produto{
		
		private $codigo;
		private $nome;
		private $valor;
		private $categoria;
	}


	function __construct($codigo, $nome, $valor, $categoria){
		$this->valor = $codigo;
		$this->valor = $nome;
		$this->valor = $valor;
		$this->categoria = $categoria;

	}

    function __toString() {
        return "{Codigo: ".$this->codigo." * Nome: ".$this->nome." * Valor: ".$this->valor." * Categoria: ".$this->categoria."}";
    }
?>
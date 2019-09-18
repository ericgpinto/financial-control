<?php

class Produto {

    private $codigo;
    private $nome;
    private $valor;
    private $categoria; // receberĂˇ um objeto da classe categoria

    function __construct($codigo, $nome, $valor, $categoria) {
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->valor = $valor;
        $this->categoria = $categoria;
    }

    function __set($prop, $val) {
        $this->$prop = $val;
    }

    function __get($prop) {
        return $this->$prop;
    }
    
    public function __toString() {
        return "{Codigo: ".$this->codigo." * Nome: ".$this->nome." * Valor: ".$this->valor." * Categoria: ".$this->categoria."}";
    }

}

?>

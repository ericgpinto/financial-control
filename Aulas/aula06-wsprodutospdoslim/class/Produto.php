<?php

// definição de classe
class Produto {

    // definição de atributos da classe
    public $id;
    public $nome;
    public $preco;

    // construtor da classe
    function __construct($id, $nome, $preco) {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
    }

}

?>
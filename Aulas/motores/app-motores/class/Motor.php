<?php
    class Motor {
        public $id;
        public $nome;
        public $imagem;
        public $descricao;
        public $uso;

        function __construct($id, $nome, $imagem, $descricao, $uso){
            $this->id = $id;
            $this->nome = $nome;
            $this->imagem = $imagem;            
            $this->descricao = $descricao;
            $this->uso = $uso;
        }
    }
?>
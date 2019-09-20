<?php
    class Usuario
    {
        public $idUsuario;
        public $nomeUsuario;
        public $senhaUsuario;

        function __construct($idUsuario, $nomeUsuario, $senhaUsuario)
        {
            $this->idUsuario = $idUsuario;
            $this->nomeUsuario = $nomeUsuario;
            $this->senhaUsuario = $senhaUsuario;
        }
    }
?>

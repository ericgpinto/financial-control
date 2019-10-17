<?php
    class User
    {
        public $idUser;
        public $name;
        public $login;
        public $password;
        public $active_status;

        function __construct($idUser, $name, $login, $password, $active_status)
        {
            $this->idUser = $idUser;
            $this->name = $name;
            $this->login = $login;
            $this->password = $password;
            $this->active_status = $active_status;
        }
    }
?>

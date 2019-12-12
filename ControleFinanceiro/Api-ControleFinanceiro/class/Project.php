<?php
    class Project 
    {
        public $idProject;
        public $idUser;
        public $description;
        public $creationDate;
        public $realizationDate;
        public $price;

        function __construct($idProject, $idUser, $description, $creationDate, $realizationDate, 
        $price)
        {
            $this->idProject = $idProject;
            $this->idUser = $idUser;
            $this->description = $description;
            $this->creationDate = $creationDate;
            $this->realizationDate = $realizationDate;
            $this->price = $price;
        }
    }
?>

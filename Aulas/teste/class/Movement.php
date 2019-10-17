<?php
    class Movement 
    {
        public $idMovement;
        public $idAccount;
        public $movementDate;
        public $price;

        function __construct($idMovement, $idAccount, $movementDate, $price)
        {
            $this->idMovement = $idMovement;
            $this->idAccount = $idAccount;
            $this->movementDate = $movementDate;
            $this->price = $price;
        }
    }
?>

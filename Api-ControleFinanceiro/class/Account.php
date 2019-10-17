<?php
    class Account 
    {
        public $idAccount;
        public $accountName;
        public $accountType;
        public $accountStatus;

        function __construct($idAccount, $accountName, $accountType, $accountStatus)
        {
            $this->idAccount = $idAccount;
            $this->accountName = $accountName;
            $this->accountType = $accountType;
            $this->accountStatus = $accountStatus;
        }
    }
?>

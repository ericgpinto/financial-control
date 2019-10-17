<?php

	class AccountDAO {

		public function getAccounts() {
			$query = "  SELECT a.idAccount, a.accountName, 
							CASE
								WHEN 
									a.accountType = 1  
								THEN 
									'Receita'
								ELSE 
									'Despesa'
							END as type, 
							CASE
								WHEN 
									a.accountStatus = 0
								THEN 
									'Ativo'
								ELSE
									'Inativo'
							END as status
						FROM accounts a";
			$pdo = ConexaoPDO::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$accounts = array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$accounts[] = new Account($row->idAccount,$row->accountName,$row->type,
				$row->status);
			}
			return $accounts;
		}

		public function getAccountsById($idAccount) {
			$query = "SELECT * FROM accounts WHERE idAccount = :idAccount";		
			$pdo = ConexaoPDO::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("idAccount", $idAccount);
			$comando->execute();
			$result = $comando->fetch(PDO::FETCH_OBJ);
			return new Account($result->idAccount, $result->accountName, $result->accountType, 
			$result->accountStatus);           
		}

		public function insertAccount(Account $account) {
			$query = "INSERT INTO accounts(accountName, accountType, accountStatus) 
			          VALUES (:accountName, :accountType, :accountStatus)";            
			$pdo = ConexaoPDO::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":accountName", $account->accountName);
			$comando->bindParam(":accountType", $account->accountType);
			$comando->bindParam(":accountStatus", $account->accountStatus);
			$comando->execute();
			$account->idAccount = $pdo->lastInsertId();
			return $account;
		}

		public function updateAccount(Account $account) {
			$query = "UPDATE accounts 
					SET accountName = :accountName, accountType = :accountType, accountStatus =:accountStatus
					WHERE idAccount = :idAccount";            
			$pdo = ConexaoPDO::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":idAccount", $account->idAccount);
			$comando->bindParam(":accountName", $account->accountName);
			$comando->bindParam(":accountType", $account->accountType);
			$comando->bindParam(":accountStatus", $account->accountStatus);
			$comando->execute(); 
		}

		//atualiza o status da conta [0 - Ativo] para [1- Inativo]
		public function updateAccountStatus($idAccount) {
			$query = "UPDATE accounts 
			          SET accountStatus = 1
			          WHERE idAccount = :idAccount";            
			$pdo = ConexaoPDO::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("idAccount", $idAccount);
			$comando->execute();
			$result = $comando->fetch(PDO::FETCH_OBJ);
			return new Account($result->idAccount, $result->accountName, $result->accountType, 
			$result->accountStatus);     
		}
	}
?>
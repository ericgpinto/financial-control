<?php

	class MovementDAO {

		public function getMovements() {
			$query = "SELECT f.idMovement, a.accountName, f.movementDate, f.price 
					  FROM financial_movements f 
					  LEFT JOIN accounts a ON a.idAccount = f.idAccount 
					  WHERE a.accountStatus = 0";
			$pdo = ConexaoPDO::getConexao();
			$command = $pdo->prepare($query);
			$command->execute();
			$movements = array();	
			while($row = $command->fetch(PDO::FETCH_OBJ)) {
                $movements[] = new Movement($row->idMovement,$row->accountName,
                $row->movementDate, $row->price);
			}
			return $movements;
		}

		public function getMovementsById($idMovement) {
			$query = "SELECT * FROM financial_movements WHERE idMovement = :idMovement";		
			$pdo = ConexaoPDO::getConexao(); 
			$command = $pdo->prepare($query);
			$command->bindParam ("idMovement", $idMovement);
			$command->execute();
			$resultado = $command->fetch(PDO::FETCH_OBJ);
			return new Movement($resultado->idMovement,$resultado->idAccount,
            $resultado->movementDate, $resultado->price);           
		}

		public function insertMovement(Movement $movement) {
			$query = "INSERT INTO financial_movements(idAccount, movementDate, 
			                      price) 
			          VALUES (:idAccount, :movementDate, :price)";            
			$pdo = ConexaoPDO::getConexao();
			$command = $pdo->prepare($query);
			$command->bindParam(":idAccount", $movement->idAccount);
            $command->bindParam(":movementDate", $movement->movementDate);
            $command->bindParam(":price", $movement->price);
			$command->execute();
			$movement->idMovement = $pdo->lastInsertId();
			return $movement;
		}

		public function updateMovement(Movement $movement) {
			$query = "UPDATE financial_movements SET idAccount = :idAccount, 
                                            movementDate = :movementDate,
                                            price = :price
			          WHERE idMovement = :idMovement";            
			$pdo = ConexaoPDO::getConexao();
			$command = $pdo->prepare($query);
			$command->bindParam(":idMovement", $movement->idMovement);
			$command->bindParam(":idAccount", $movement->idAccount);
            $command->bindParam(":movementDate", $movement->movementDate);
            $command->bindParam(":price", $movement->price);
			$command->execute(); 
		}

		public function deleteMovement($idMovement) {
			$query = "DELETE from financial_movements 
			          WHERE idMovement = :idMovement";            
			$pdo = ConexaoPDO::getConexao();
			$command = $pdo->prepare($query);
			$command->bindParam(":idMovement", $idMovement);
			$command->execute();
		}
	}
?>
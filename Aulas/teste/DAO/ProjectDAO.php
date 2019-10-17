<?php

	class ProjectDAO {

		public function getProjects() {
			$query = "SELECT * FROM projects";
			$pdo = ConexaoPDO::getConexao();
			$command = $pdo->prepare($query);
			$command->execute();
			$project = array();	
			while($row = $command->fetch(PDO::FETCH_OBJ)) {
				$project[] = new Project($row->idProject,$row->idUser,$row->description,
				$row->creationDate,$row->realizationDate,$row->price);
			}
			return $project;
		}

		//Simula o sucesso financeiro do projeto
		public function getSimulationByIdProject($idProject){
			$query = "	SELECT 
							CASE 
								WHEN 
									p.price - E.saldo < 0 
								THEN 
									CONCAT('Parabéns! Você já pode realizar o projeto ', p.description,'. Saldo: R$ ',
									        CAST(E.saldo - p.price AS DECIMAL(10,2))) 
								WHEN 
									p.price - E.saldo > 0 
								THEN 
									CONCAT('Ops! Você ainda precisa economizar R$ ',
									        CAST(p.price - E.saldo AS DECIMAL(10,2)), ' para ', p.description) 
							END as statusProjeto 
	   		 			    FROM (select SUM(receitas) - SUM(despesas) as saldo 
							FROM (SELECT SUM(CASE WHEN a.accountType = 1 THEN f.price ELSE 0 END) as receitas, 
									     SUM(CASE WHEN a.accountType = 2 THEN f.price ELSE 0 END) as despesas 
						FROM financial_movements f 
						LEFT JOIN accounts a ON a.idAccount = f.idAccount AND a.accountStatus = 0
						GROUP BY a.accountType) AS T) as E, projects p 
						WHERE p.idProject = :idProject";	
			$pdo = ConexaoPDO::getConexao(); 
			$command = $pdo->prepare($query);
			$command->bindParam ("idProject", $idProject);
			$command->execute();
			$resultado = $command->fetch(PDO::FETCH_OBJ);
			return $resultado;	
		}

		public function getProjectsById($idProject) {
			$query = "SELECT * FROM projects WHERE idProject = :idProject";		
			$pdo = ConexaoPDO::getConexao(); 
			$command = $pdo->prepare($query);
			$command->bindParam ("idProject", $idProject);
			$command->execute();
			$resultado = $command->fetch(PDO::FETCH_OBJ);
			return new Project($resultado->idProject, $resultado->idUser, $resultado->description,
			$resultado->creationDate, $resultado->realizationDate,$resultado->price);           
		}

		public function insertProject(Project $project) {
			$query = "INSERT INTO projects(idUser, description, creationDate, realizationDate, 
			                               price) 
			          VALUES (:idUser, :description,:creationDate, :realizationDate, :price)";            
			$pdo = ConexaoPDO::getConexao();
			$command = $pdo->prepare($query);
			$command->bindParam(":idUser", $project->idUser);
			$command->bindParam(":description", $project->description);
			$command->bindParam(":creationDate", $project->creationDate);
			$command->bindParam(":realizationDate", $project->realizationDate);
			$command->bindParam(":price", $project->price);
			$command->execute();
			$project->idProject = $pdo->lastInsertId();
			return $project;
		}

		public function updateProject(Project $project) {
			$query = "UPDATE projects SET idUser = :idUser, description = :description, 
			                              creationDate = :creationDate, 
										  realizationDate = :realizationDate,
			                              price = :price
			          WHERE idProject = :idProject";            
			$pdo = ConexaoPDO::getConexao();
			$command = $pdo->prepare($query);
			$command->bindParam(":idProject", $project->idProject);
			$command->bindParam(":idUser", $project->idUser);
			$command->bindParam(":description", $project->description);
			$command->bindParam(":creationDate", $project->creationDate);
			$command->bindParam(":realizationDate", $project->realizationDate);
			$command->bindParam(":price", $project->price);
			$command->execute(); 
		}

		public function deleteProject($idProject) {
			$query = "DELETE from projects WHERE idProject = :idProject";            
			$pdo = ConexaoPDO::getConexao();
			$command = $pdo->prepare($query);
			$command->bindParam(":idProject", $idProject);
			$command->execute();
		}
	}
?>
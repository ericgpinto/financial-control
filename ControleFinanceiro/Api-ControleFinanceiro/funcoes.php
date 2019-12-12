<?php
require_once "db/ConexaoPDO.php";

$retorno = array();
if($_GET['acao'] == 'contas'){
	$sql = $pdo->prepare("SELECT * FROM accounts");
	$sql->execute();	
	$n = 0;
	$retorno['qtd'] = $sql->rowCount();
	while($ln = $sql->fetchObject()){
		$retorno['accountName'][$n] = $ln->accountName;
		$retorno['idAccount'][$n] 	= $ln->idAccount;
		$n++;
	}	
}

die(json_encode($retorno));
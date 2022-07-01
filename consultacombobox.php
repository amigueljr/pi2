<?php
include "classes/conexao.php";
$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
$valor = isset($_GET['valor']) ? $_GET['valor'] : '';

// die();

function getFilterHoraInicial($valor){

	$banco = new Banco();
	$pdo = $banco->getConnection();
	$sql = 'SELECT hora_evento FROM inspecoes WHERE data_evento = ?';
	$stm = $pdo->prepare($sql);
	$stm->bindValue(1, $valor);
	$stm->execute();
	sleep(1);
	// echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
	$result = $stm->fetchAll();
	echo json_encode($result);
	 $pdo = null;
}

function getFilterHoraFinal($valor){

	$banco = new Banco();
	$pdo = $banco->getConnection();
	$sql = 'SELECT hora_evento FROM inspecoes WHERE data_evento = ?';
	$stm = $pdo->prepare($sql);
	$stm->bindValue(1, $valor);
	$stm->execute();
	sleep(1);
	// echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
	$result = $stm->fetchAll();
	echo json_encode($result);
	 $pdo = null;
}

if (! empty($opcao)){
	switch ($opcao)
	{
		case 'data_inicial':
			{
				echo getFilterHoraInicial($valor);
				break;
			}
		case 'data_final':
			{
				echo getFilterHoraFinal($valor);
				break;
			}
		// case 'subcategoriab':
		// 	{
		// 		echo getFilterSubcategoriaB($valor);
		// 		break;
		// 	}
	}
}



function getFilterSubcategoria($categoria){
	$banco = new Banco();
	$pdo = $banco->getConnection();
	$sql = 'SELECT subcategoria FROM subcategoria WHERE categoria = ?';
	$stm = $pdo->prepare($sql);
	$stm->bindValue(1, $categoria);
	$stm->execute();
	//sleep(1);
	echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
$pdo = null;
}

function getFilterSubcategoriaB($subcategoria){
	$banco = new Banco();
	$pdo = $banco->getConnection();
	$sql = 'SELECT subcategoriab FROM subcategoriab WHERE subcategoria = ?';
	$stm = $pdo->prepare($sql);
	$stm->bindValue(1, $subcategoria);
	$stm->execute();
	//sleep(1);
	echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
$pdo = null;
}
?>
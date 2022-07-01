<?php
include "classes/conexao.php";
include "classes/evento.php";


function getDatasIniciais(){
    $conexao = new Banco();
    $con = $conexao->getConnection();
    $query = 'SELECT DISTINCT data_evento FROM inspecoes';
    $stmt = $con->prepare($query);
    $stmt->execute();
    // echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    // $con = null;
}




function getFilterCategoria($marca){
	$banco = new Banco();
	$pdo = $banco->getConnection();
	$sql = 'SELECT categoria FROM cat_por_marca WHERE marca = ?';
	$stm = $pdo->prepare($sql);
	$stm->bindValue(1, $marca);
	$stm->execute();
	//sleep(1);
	echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
$pdo = null;
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
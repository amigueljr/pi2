<?php
include "classes/conexao.php";
$dataInicio = isset($_GET['dataInicio']) ? $_GET['dataInicio'] : '';
$horaInicio = isset($_GET['hora_inicial']) ? $_GET['hora_inicial'] : '';
$dataFim = isset($_GET['dataFim']) ? $_GET['dataFim'] : '';
$horaFim = isset($_GET['hora_final']) ? $_GET['hora_final'] : '';

// echo 'data inicio: '.$dataInicio."<br>";
// echo 'hora inicio: '.$horaInicio."<br>";
// echo 'data final: '.$dataFim."<br>";
// echo 'hora final: '.$horaFim."<br>";

// $json_str = array("dataInicio"=>$dataInicio, "horaInicio"=>$horaInicio, "dataFinal"=>$dataFim, "horaFinal"=>$horaFim);

// //faz o parsing da string, criando o array "empregados"
// echo json_encode($json_str);

    $banco = new Banco();
	$pdo = $banco->getConnection();
	// $sql = 'SELECT data_evento, hora_evento, stat FROM inspecoes WHERE hora_evento BETWEEN ? AND ? AND Exists (SELECT * FROM inspecoes WHERE data_evento BETWEEN ? AND ?)';
    // select * from tabela where exists(select * from tabela);
    $sql = 'SELECT COUNT(stat) as qtdeB FROM inspecoes WHERE hora_evento BETWEEN ? AND ? AND Exists (SELECT COUNT(stat) FROM inspecoes WHERE data_evento BETWEEN ? AND ?) AND stat = "B"';
    $sql2 = 'SELECT COUNT(stat) as qtdeE FROM inspecoes WHERE hora_evento BETWEEN ? AND ? AND Exists (SELECT COUNT(stat) FROM inspecoes WHERE data_evento BETWEEN ? AND ?) AND stat = "E"';

	$stm = $pdo->prepare($sql);
	$stm->bindValue(1, $horaInicio);
    $stm->bindValue(2, $horaFim);
    $stm->bindValue(3, $dataInicio);
    $stm->bindValue(4, $dataFim);
	$stm->execute();
	sleep(1);

    $stm2 = $pdo->prepare($sql2);
	$stm2->bindValue(1, $horaInicio);
    $stm2->bindValue(2, $horaFim);
    $stm2->bindValue(3, $dataInicio);
    $stm2->bindValue(4, $dataFim);
	$stm2->execute();
	sleep(1);
    $result1 = $stm->fetchAll(PDO::FETCH_ASSOC);
    $result2 = $stm2->fetchAll(PDO::FETCH_ASSOC);

    $json_str = array("boas"=>$result1, "ruins"=>$result2);
	 echo json_encode($json_str);
	// $result = $stm->fetchAll();
    // $result2 = $stm2->fetchAll();
    // // $result3 = array("Boas: "=>$result, "Ruins: "=>$result2.[0]);
    // $result3 = array($result);
	// echo json_encode($result2);
    

	 $pdo = null;

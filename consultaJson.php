<?php
include "classes/conexao.php";
include "classes/evento.php";
 if(isset($_GET['busca'])){
     if($_GET['busca'] == 'tudo'){
        $banco = new Banco();
        $dados = new Evento($banco->getConnection());
        $stmt = $dados->consultar();
        $dado = '-';
        $vetor = array();
        array("id"=>"{$dado}","nome_arquivo"=>"{$dado}","data_upload"=>"{$dado}","status"=>"{$dado}");
      

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $vetor[] = ["id"=>"{$row['id']}","nome_arquivo"=>"{$row['nome_arquivo']}","data_upload"=>"{$row['data_upload']}","data_evento"=>"{$row['data_evento']}","hora_evento"=>"{$row['hora_evento']}","status"=>"{$row['stat']}"];
        }
        $jsonFile = json_encode($vetor);
        echo $jsonFile;
     }
 }

